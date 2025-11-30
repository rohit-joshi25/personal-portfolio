<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class GithubActivityController extends Controller
{
    public function index(Request $request)
    {
        $username = config('services.github.username', 'rohit-joshi25');
        $cacheKey = "github_activity_{$username}";
        $cached = Cache::get($cacheKey);

        if ($cached) {
            return view('partials.github-activity', $cached);
        }

        $token = config('services.github.token');
        if (!$token) {
            abort(500, 'GitHub token not configured. Set GITHUB_TOKEN in .env');
        }

        // 1) GraphQL - contributions calendar (from start of year -> today)
        $from = Carbon::now()->startOfYear()->toIso8601String();
        $to   = Carbon::now()->toIso8601String();

        $graphqlQuery = <<<'GRAPHQL'
query ($login: String!, $from: DateTime!, $to: DateTime!) {
  user(login: $login) {
    name
    contributionsCollection(from: $from, to: $to) {
      contributionCalendar {
        totalContributions
        weeks {
          contributionDays {
            date
            contributionCount
            color
            weekday
          }
        }
      }
    }
  }
}
GRAPHQL;

        $gqlResponse = Http::withToken($token)
            ->post('https://api.github.com/graphql', [
                'query' => $graphqlQuery,
                'variables' => [
                    'login' => $username,
                    'from' => $from,
                    'to' => $to,
                ],
            ]);

        if ($gqlResponse->failed()) {
            abort(500, 'GitHub GraphQL request failed: ' . $gqlResponse->body());
        }

        $gqlData = $gqlResponse->json();
        $weeks = data_get($gqlData, 'data.user.contributionsCollection.contributionCalendar.weeks', []);

        // Convert weeks structure into simple array for view
        $calendarWeeks = [];
        foreach ($weeks as $w) {
            $weekDays = [];
            foreach ($w['contributionDays'] as $day) {
                $weekDays[] = [
                    'date' => $day['date'],
                    'count' => $day['contributionCount'],
                    // GraphQL returns a color hex (like "#ebedf0" etc.)
                    'color' => $day['color'] ?? null,
                ];
            }
            $calendarWeeks[] = $weekDays;
        }

        $totalContributions = data_get($gqlData, 'data.user.contributionsCollection.contributionCalendar.totalContributions', 0);
        $name = data_get($gqlData, 'data.user.name', $username);

        // 2) REST - user stats (followers, public_repos etc.)
        $userResp = Http::withToken($token)->get("https://api.github.com/users/{$username}");
        if ($userResp->failed()) abort(500, 'GitHub user request failed.');

        $userJson = $userResp->json();
        $followers = $userJson['followers'] ?? 0;
        $publicRepos = $userJson['public_repos'] ?? 0;

        // 3) REST - list repos (paginated) to sum stars and forks
        $page = 1;
        $perPage = 100;
        $totalStars = 0;
        $totalForks = 0;

        do {
            $reposResp = Http::withToken($token)
                ->get("https://api.github.com/users/{$username}/repos", [
                    'per_page' => $perPage,
                    'page' => $page,
                    'type' => 'owner',
                    'sort' => 'pushed'
                ]);

            if ($reposResp->failed()) break;

            $repos = $reposResp->json();
            foreach ($repos as $r) {
                $totalStars += $r['stargazers_count'] ?? 0;
                $totalForks += $r['forks_count'] ?? 0;
            }

            $page++;
        } while (count($repos) === $perPage);

        $data = [
            'username' => $username,
            'name' => $name,
            'totalContributions' => $totalContributions,
            'calendarWeeks' => $calendarWeeks,
            'followers' => $followers,
            'publicRepos' => $publicRepos,
            'totalStars' => $totalStars,
            'totalForks' => $totalForks,
        ];

        // Cache for 60 minutes
        Cache::put($cacheKey, $data, now()->addMinutes(60));

        return view('partials.github-activity', $data);
    }
}
