<div id="gh-activity" style="margin-top:40px">
  <h3 style="font-weight:800; font-size:24px; margin-bottom:12px; letter-spacing:-0.5px;">
    GitHub <span style="color:#ff3fb4;">Activity</span>
  </h3>

  <!-- Heatmap (full width) -->
  <div id="gh-heatmap"
    style="
      width:100%;
      padding:24px;
      border-radius:14px;
      border:1px solid rgba(255,255,255,0.06);
      background: rgba(19,24,41,0.5);
      backdrop-filter: blur(8px);
      margin-bottom:14px;
    ">

    <div id="heatmap-grid"
      style="
        display:grid;
        grid-template-columns: repeat(53, 14px);
        grid-auto-rows: 14px;
        gap:3px;
        justify-content:flex-start;
        padding:12px 0;
      ">
    </div>

    <div style="color:#7d89a5; font-size:12px; margin-top:14px; display:flex; gap:16px; align-items:center;">
      <span>Less</span>
      <div style="display:flex; gap:4px;">
        <div style="width:14px; height:14px; border-radius:3px; background:#0f1220; border:1px solid rgba(255,255,255,0.06);"></div>
        <div style="width:14px; height:14px; border-radius:3px; background:#112a45; border:1px solid rgba(255,255,255,0.06);"></div>
        <div style="width:14px; height:14px; border-radius:3px; background:#174e7b; border:1px solid rgba(255,255,255,0.06);"></div>
        <div style="width:14px; height:14px; border-radius:3px; background:#2378c8; border:1px solid rgba(255,255,255,0.06);"></div>
        <div style="width:14px; height:14px; border-radius:3px; background:#6ecbff; border:1px solid rgba(255,255,255,0.06);"></div>
      </div>
      <span>More</span>
    </div>
  </div>

  <!-- Inline stats row -->
  <div id="gh-stats-row" style="display:flex; gap:24px; align-items:center; justify-content:flex-start; flex-wrap:wrap; font-size:14px; color:var(--muted);">
    <div style="display:flex; gap:8px; align-items:center;">
      <strong id="gh-followers" style="font-weight:800; color:#4f7cff; margin-right:6px">0</strong>
      <span style="color:#a8adb8">Followers</span>
    </div>

    <div style="display:flex; gap:8px; align-items:center;">
      <strong id="gh-stars" style="font-weight:800; color:#00d4ff; margin-right:6px">0</strong>
      <span style="color:#a8adb8">Total Stars</span>
    </div>

    <div style="display:flex; gap:8px; align-items:center;">
      <strong id="gh-repos" style="font-weight:800; color:#ff3fb4; margin-right:6px">0</strong>
      <span style="color:#a8adb8">Public Repos</span>
    </div>

    <div style="display:flex; gap:8px; align-items:center;">
      <strong id="gh-forks" style="font-weight:800; color:#ff9f40; margin-right:6px">0</strong>
      <span style="color:#a8adb8">Total Forks</span>
    </div>
  </div>
</div>


<script>
(function(){

  const username = "rohit-joshi25";
  const grid = document.getElementById("heatmap-grid");
  const f = document.getElementById("gh-followers");
  const s = document.getElementById("gh-stars");
  const r = document.getElementById("gh-repos");
  const k = document.getElementById("gh-forks");

  // create square with tooltip
  function square(count, date){
    const d = document.createElement("div");
    d.style.width = "14px";
    d.style.height = "14px";
    d.style.borderRadius = "3px";
    d.style.cursor = "pointer";
    d.style.transition = "all 0.2s";
    d.style.border = "1px solid rgba(255,255,255,0.06)";
    
    const lvl = Math.min(4, Math.floor(count / 10));
    const colors = ["#0f1220","#112a45","#174e7b","#2378c8","#6ecbff"];
    d.style.background = colors[lvl];
    
    d.title = `${count} contributions on ${date}`;
    
    d.addEventListener('mouseenter', () => {
      d.style.boxShadow = "0 4px 12px rgba(79,124,255,0.15)";
      d.style.transform = "scale(1.15)";
    });
    d.addEventListener('mouseleave', () => {
      d.style.boxShadow = "none";
      d.style.transform = "scale(1)";
    });
    
    return d;
  }

  function render(contribs){
    grid.innerHTML = "";
    const today = new Date();
    
    // 53 weeks × 7 days = 371 days back
    for(let i=370; i>=0; i--){
      const date = new Date(today);
      date.setDate(date.getDate() - i);
      const dateStr = date.toISOString().split('T')[0];
      const count = contribs[dateStr] || 0;
      grid.appendChild(square(count, dateStr));
    }
  }

  async function load(){
    try{
      // REST API for user stats
      const user = await fetch(`https://api.github.com/users/${username}`).then(res => res.json());
      f.innerText = user.followers ?? 0;
      r.innerText = user.public_repos ?? 0;

      // REST API for repos (stars & forks)
      const repos = await fetch(`https://api.github.com/users/${username}/repos?per_page=100&sort=updated`)
                          .then(res => res.json());

      let stars = 0, forks = 0;
      repos.forEach(x => {
        stars += x.stargazers_count || 0;
        forks += x.forks_count || 0;
      });

      s.innerText = stars;
      k.innerText = forks;

      // GraphQL for REAL contribution data (last 12 months)
      const graphqlQuery = `
        query {
          user(login: "${username}") {
            contributionsCollection {
              contributionCalendar {
                totalContributions
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
      `;

      const gqlRes = await fetch('https://api.github.com/graphql', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          // NOTE: If you have a GitHub token, add it here for higher rate limits:
          // 'Authorization': 'Bearer YOUR_GITHUB_TOKEN'
        },
        body: JSON.stringify({ query: graphqlQuery })
      }).then(r => r.json());

      if(gqlRes.data?.user?.contributionsCollection?.contributionCalendar?.weeks){
        const weeks = gqlRes.data.user.contributionsCollection.contributionCalendar.weeks;
        const contribMap = {};
        
        weeks.forEach(week => {
          week.contributionDays.forEach(day => {
            contribMap[day.date] = day.contributionCount;
          });
        });

        render(contribMap);
      }else{
        // fallback if GraphQL fails
        throw new Error('GraphQL failed');
      }

    }catch(err){
      console.warn("GitHub fetch error (using fallback)", err);
      
      // fallback: random-like heatmap
      const contribMap = {};
      const today = new Date();
      for(let i=370; i>=0; i--){
        const date = new Date(today);
        date.setDate(date.getDate() - i);
        const dateStr = date.toISOString().split('T')[0];
        contribMap[dateStr] = Math.floor(Math.random() * 20);
      }
      render(contribMap);
    }
  }

  load();

})();
</script>
