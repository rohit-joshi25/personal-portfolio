<?php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class GitHubController extends Controller
{
    public function activity()
    {
        $username = config('services.github.username', env('GITHUB_USERNAME', ''));
        $token = config('services.github.token', env('GITHUB_TOKEN', ''));

        if (empty($token) || empty($username)) {
            return response()->json(['error' => 'GitHub credentials not configured'], 500);
        }

        // cache for 15 minutes
        return Cache::remember("github.activity.{$username}", 900, function () use ($username, $token) {
            // user
            $user = Http::withToken($token)->get("https://api.github.com/users/{$username}")->json();

            // repos (100 latest)
            $repos = Http::withToken($token)
                ->get("https://api.github.com/users/{$username}/repos", ['per_page' => 100, 'sort' => 'updated'])
                ->json();

            $stars = $forks = 0;
            $publicRepos = [];
            if (is_array($repos)) {
                foreach ($repos as $r) {
                    $stars += $r['stargazers_count'] ?? 0;
                    $forks += $r['forks_count'] ?? 0;
                    if (empty($r['private']) && empty($r['fork'])) {
                        $publicRepos[] = $r['name'];
                    }
                }
            }

            // estimate commits (sample first 30 public repos)
            $commitEstimate = 0;
            foreach (array_slice($publicRepos, 0, 30) as $repoName) {
                $res = Http::withToken($token)
                    ->get("https://api.github.com/repos/{$username}/{$repoName}/commits", ['per_page' => 1]);
                if ($res->ok()) {
                    $link = $res->header('Link');
                    if ($link && preg_match('/&page=(\d+)>; rel="last"/', $link, $m)) {
                        $commitEstimate += intval($m[1]);
                    } else {
                        $body = $res->json();
                        $commitEstimate += is_array($body) ? count($body) : 0;
                    }
                }
            }

            // GraphQL contributions (last 12 months)
            $gql = <<<'GQL'
query ($login: String!) {
  user(login: $login) {
    contributionsCollection {
      contributionCalendar {
        weeks {
          contributionDays {
            date
            contributionCount
          }
        }
      }
    }
  }
}
GQL;
            $gqlRes = Http::withToken($token)
                ->post('https://api.github.com/graphql', [
                    'query' => $gql,
                    'variables' => ['login' => $username],
                ])->json();

            $contribMap = [];
            $weeks = $gqlRes['data']['user']['contributionsCollection']['contributionCalendar']['weeks'] ?? null;
            if (is_array($weeks)) {
                foreach ($weeks as $week) {
                    foreach ($week['contributionDays'] as $day) {
                        $contribMap[$day['date']] = $day['contributionCount'];
                    }
                }
            }

            return [
                'followers' => $user['followers'] ?? 0,
                'public_repos' => $user['public_repos'] ?? count($publicRepos),
                'stars' => $stars,
                'forks' => $forks,
                'commit_estimate' => $commitEstimate,
                'contributions' => $contribMap,
            ];
        });
    }
}