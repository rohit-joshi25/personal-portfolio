@extends('layouts.app')

@section('extra-styles')
<style>
  :root{
    --bg:#07060a;
    --card:#0f1220;
    --text:#e6eef8;
    --muted:#9aa6bd;
    --primary:#4f7cff;   /* blue neon */
    --accent:#8a3fff;    /* magenta accent for highlights */
    --neon: linear-gradient(90deg,var(--primary),#00d4ff);
    --radius:14px;
    --maxWidth:1200px;
  }

  /* page container */
  main { max-width: var(--maxWidth); margin: 100px auto 80px; padding: 0 24px; color:var(--text); }

  /* HERO - left text, right stacked images */
  .about-hero { display:grid; grid-template-columns: 1fr 420px; gap:40px; align-items:center; margin-bottom:70px; }
  .eyebrow { font-size:12px; color:var(--muted); letter-spacing:2px; text-transform:uppercase; margin-bottom:10px;}
  .hero-title { font-size:40px; line-height:1.05; font-weight:700; margin:0 0 16px; color:var(--text); }
  .hero-title .accent { background: linear-gradient(90deg,var(--primary),var(--accent)); -webkit-background-clip:text; color:transparent; }
  .hero-lead { color:var(--muted); font-size:15px; line-height:1.8; margin-bottom:22px; max-width:680px; }
  .hero-actions { display:flex; gap:12px; margin-top:18px; }

  .btn-primary {
    background: linear-gradient(90deg, rgba(79,124,255,0.14), rgba(0,212,255,0.06));
    color:var(--text); padding:12px 18px; border-radius:10px; border:1px solid rgba(79,124,255,0.15); font-weight:700;
  }
  .btn-outline { background:transparent; border:1px solid rgba(255,255,255,0.06); padding:12px 18px; border-radius:10px; color:var(--muted); font-weight:700; }

  /* stacked images on right */
  .stack { position:relative; width:100%; height:360px; display:flex; align-items:center; justify-content:center; }
  .stack .card {
    position:absolute; width:250px; height:250px; border-radius:18px; overflow:hidden; box-shadow: 0 18px 50px rgba(0,0,0,0.7);
    border:1px solid rgba(255,255,255,0.04); background:linear-gradient(180deg, rgba(255,255,255,0.02), rgba(255,255,255,0.01));
    transform-origin:center; transition: transform .35s ease, box-shadow .25s ease;
  }
  .stack .card img{ width:100%; height:100%; object-fit:cover; display:block; }

  .stack .card.c1 { right:0; top:40px; transform:rotate(-6deg); z-index:10; }
  .stack .card.c2 { left:20px; top:0; transform:rotate(6deg) scale(0.98); z-index:20; }
  .stack .card.c3 { right:60px; top:90px; transform:rotate(-2deg) scale(1.02); z-index:30; }

  .stack .card:hover { transform: translateY(-6px) scale(1.03); box-shadow: 0 28px 70px rgba(0,0,0,0.75); }

  /* Experience / timeline */
  .section-title { font-size:22px; font-weight:800; margin:40px 0 18px; color:var(--text); }
  .timeline { display:grid; grid-template-columns: 220px 1fr; gap:24px; align-items:start; margin-bottom:18px; }
  .timeline-left { color:var(--muted); font-weight:600; }
  .timeline-card { background:var(--card); border-radius:12px; padding:22px; border:1px solid rgba(255,255,255,0.04); }
  .timeline-role { font-weight:700; color:var(--text); margin-bottom:6px; }
  .timeline-company { color:var(--primary); font-weight:700; margin-bottom:6px; }
  .timeline-desc { color:var(--muted); line-height:1.7; font-size:14px; }

  /* dev insights - stats */
  .stats-grid { display:grid; grid-template-columns: repeat(auto-fit,minmax(160px,1fr)); gap:18px; margin-top:20px; }
  .stat-box { padding:22px; border-radius:12px; background:var(--card); border:1px solid rgba(255,255,255,0.04); text-align:center; }
  .stat-num { font-size:20px; font-weight:800; color:var(--primary); }
  .stat-label { color:var(--muted); font-weight:600; margin-top:6px; font-size:13px; }

  /* skills badges */
  .skills { display:flex; gap:10px; flex-wrap:wrap; margin-top:12px; }
  .badge { padding:8px 12px; border-radius:999px; background:rgba(79,124,255,0.08); color:var(--primary); font-weight:700; font-size:13px; border:1px solid rgba(79,124,255,0.12); }

  /* CTA big banner */
  .big-cta { margin-top:60px; padding:40px; border-radius:16px; background: linear-gradient(180deg, rgba(11,13,24,0.85), rgba(14,16,30,0.9)); border:1px solid rgba(79,124,255,0.1); text-align:center; }
  .big-cta h3 { font-size:26px; margin:0 0 10px; }
  .big-cta p { color:var(--muted); margin-bottom:16px; }

  /* GitHub activity partial container spacing */
  .github-section { margin-top:40px; }

  @media(max-width:980px){
    .about-hero { grid-template-columns: 1fr; }
    .stack { height:320px; margin-top:12px; }
    .stack .card { width:200px; height:200px; border-radius:14px; }
  }
  @media(max-width:560px){
    main { margin-top:80px; }
    .hero-title { font-size:28px; }
    .stack { height:260px; }
  }
</style>
@endsection

@section('content')
<main>
  <!-- HERO -->
  <section class="about-hero" data-aos="fade-up">
    <div>
      <div class="eyebrow">More • About Me</div>
      <h1 class="hero-title">I'm Rohit, a <span class="accent">creative backend</span> developer</h1>
      <p class="hero-lead">
        I'm a backend-focused Laravel developer building scalable, production-ready systems.
        I specialise in clean architecture, efficient MySQL schemas, and RESTful APIs — and I enjoy turning ideas into real-world products.
      </p>

      <div class="hero-actions">
        <a class="btn-primary" href="#contact">Get in Touch</a>
        <a class="btn-outline" href="https://github.com/rohit-joshi25" target="_blank">View GitHub</a>
      </div>
    </div>

    <div class="stack" aria-hidden="true">
      <!-- three overlapping cards (option 2) -->
      <div class="card c1"><img src="{{ asset('image/IMG_20241020_164308.jpg') }}" alt="Rohit"></div>
      <div class="card c2"><img src="https://images.unsplash.com/photo-1517694712202-14dd9538aa97?w=800&auto=format&fit=crop&q=80" alt="project"></div>
      <div class="card c3"><img src="{{ asset('image/WhatsApp Image 2025-04-21 at 16.26.30_cabb0dfe.jpg') }}" alt="landscape"></div>
    </div>
  </section>

  <!-- EXPERIENCE -->
  <section data-aos="fade-up">
    <h2 class="section-title">Experience</h2>

    <div class="timeline">
      <div class="timeline-left">
        <div style="font-weight:700">Jan 2025 — Present</div>
        <div class="muted">Full-time / Remote</div>
      </div>

      <div>
        <div class="timeline-card">
          <div class="timeline-role">Laravel Developer (Training)</div>
          <div class="timeline-company">Sane Overseas Pvt Ltd</div>
          <div class="timeline-desc">
            <ul style="margin:10px 0 0 18px">
              <li>Built Student Portal (Role-based auth, dashboards, results).</li>
              <li>Built E-Auction system with bidding and session flow.</li>
              <li>APIs, controllers, middleware, validation & DB optimization.</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- DEVELOPER INSIGHTS -->
  <section class="github-section" data-aos="fade-up">
    <h2 class="section-title">Developer Insights</h2>

    <div class="stats-grid">
      <div class="stat-box">
        <div class="stat-num" id="gh-repos-count">—</div>
        <div class="stat-label">GitHub Repositories</div>
      </div>
      <div class="stat-box">
        <div class="stat-num" id="gh-public-count">—</div>
        <div class="stat-label">Public Projects</div>
      </div>
      <div class="stat-box">
        <div class="stat-num" id="gh-commits-count">—</div>
        <div class="stat-label">Commits (est)</div>
      </div>
      <div class="stat-box">
        <div class="stat-num" id="gh-followers-count">—</div>
        <div class="stat-label">Followers</div>
      </div>
    </div>

    <div style="margin-top:18px" class="skills">
      <span class="badge">Laravel</span>
      <span class="badge">PHP 8</span>
      <span class="badge">MySQL</span>
      <span class="badge">REST APIs</span>
      <span class="badge">Git</span>
      <span class="badge">Blade</span>
      <span class="badge">JavaScript</span>
    </div>

    {{-- GitHub Activity partial (client-driven) --}}
    @include('partials.github-activity')
  </section>

  <!-- CTA -->
  <section class="big-cta" data-aos="fade-up">
    <h3>From concept to creation — let's make it happen</h3>
    <p>I'm available for full-time roles & freelance projects. I build production-ready web apps with Laravel.</p>
    <a class="btn-primary" href="#contact">Get in Touch</a>
  </section>
</main>
@endsection

@section('extra-scripts')
<script>
  AOS.init({ duration:700, once:true });

  // little hover parallax for stack
  document.querySelectorAll('.stack .card').forEach((c, i) => {
    c.addEventListener('mousemove', (ev) => {
      const rect = c.getBoundingClientRect();
      const x = (ev.clientX - rect.left) / rect.width - 0.5;
      const y = (ev.clientY - rect.top) / rect.height - 0.5;
      c.style.transform = `translate(${x*6}px, ${y*6}px) rotate(${(i-1)*4}deg) scale(1.02)`;
    });
    c.addEventListener('mouseleave', () => {
      // restore
      if (c.classList.contains('c1')) c.style.transform = 'rotate(-6deg)';
      if (c.classList.contains('c2')) c.style.transform = 'rotate(6deg) scale(0.98)';
      if (c.classList.contains('c3')) c.style.transform = 'rotate(-2deg) scale(1.02)';
    });
  });

  // Fetch GitHub stats
  (function(){
    const username = 'rohit-joshi25';
    const reposEl = document.getElementById('gh-repos-count');
    const publicEl = document.getElementById('gh-public-count');
    const commitsEl = document.getElementById('gh-commits-count');
    const followersEl = document.getElementById('gh-followers-count');

    async function fetchStats(){
      try {
        // User info (followers + public repos)
        const userRes = await fetch(`https://api.github.com/users/${username}`);
        const userData = await userRes.json();
        
        if(!userRes.ok) throw new Error('User fetch failed');

        followersEl.textContent = userData.followers ?? 0;
        reposEl.textContent = userData.public_repos ?? 0;

        // Get all repos to count public + estimate commits
        const reposRes = await fetch(`https://api.github.com/users/${username}/repos?per_page=100&sort=updated`);
        const repos = await reposRes.json();
        
        if(!reposRes.ok) throw new Error('Repos fetch failed');

        // Count public repos (filter out forks if needed)
        const publicRepos = repos.filter(r => !r.private && !r.fork).length;
        publicEl.textContent = publicRepos;

        // Estimate total commits from repos
        let totalCommits = 0;
        for(const repo of repos.slice(0, 30)) { // check first 30 repos
          try {
            const commitsRes = await fetch(`https://api.github.com/repos/${username}/${repo.name}/commits?per_page=1`);
            if(commitsRes.ok) {
              const link = commitsRes.headers.get('link');
              // Extract total from Link header (pagination)
              const match = link?.match(/&page=(\d+)>; rel="last"/);
              const count = match ? parseInt(match[1]) : 1;
              totalCommits += count;
            }
          } catch(e) {
            console.warn(`Could not fetch commits for ${repo.name}`, e);
          }
        }

        commitsEl.textContent = totalCommits > 0 ? totalCommits : '500+';

      } catch(err) {
        console.warn('GitHub stats fetch failed:', err);
        // Keep dashes if API fails
      }
    }

    fetchStats();
  })();
</script>
@endsection
