<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Why I Chose Web Development | Rohit Joshi</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
  <style>
    :root{
      --bg:#0a0e27; --card:#131829; --text:#e8eaed; --muted:#a8adb8;
      --primary:#4f7cff; --accent:#00d4ff; --radius:10px;
    }
    *{box-sizing:border-box}
    html,body{
      font-family:'Inter',system-ui,-apple-system,Segoe UI,Roboto;
      background-color:var(--bg); color:var(--text); margin:0; padding:0;
      line-height:1.7;
    }
    a{color:inherit;text-decoration:none}
    
    header{
      position:fixed; left:0; right:0; top:0; height:64px;
      display:flex; align-items:center; justify-content:space-between;
      padding:0 32px; z-index:1200;
      background: rgba(10,14,39,0.95);
      border-bottom:1px solid rgba(255,255,255,0.05);
      backdrop-filter: blur(8px);
    }
    .logo{display:flex;align-items:center;gap:10px;font-weight:700;font-size:18px}
    .logo img{width:40px;height:40px;border-radius:6px}
    nav{display:flex;gap:28px}
    nav a{font-weight:500; font-size:14px; color:var(--muted); transition:color 0.2s}
    nav a:hover{color:var(--primary)}
    
    main{max-width:800px;margin:100px auto 60px;padding:0 28px}
    
    .back-link{
      display:inline-flex; align-items:center; gap:8px;
      padding:10px 16px; background:rgba(79,124,255,0.1);
      border:1px solid rgba(79,124,255,0.2); border-radius:6px;
      color:var(--primary); font-weight:600; font-size:13px;
      transition:all 0.2s; margin-bottom:40px;
    }
    .back-link:hover{background:rgba(79,124,255,0.2)}
    
    .article-header{margin-bottom:40px}
    .article-header h1{
      font-size:2.5rem; margin:0 0 16px; font-weight:700;
      letter-spacing:-0.5px; line-height:1.2;
    }
    .article-meta{
      display:flex; gap:20px; flex-wrap:wrap; font-size:13px;
      color:var(--muted); margin-bottom:24px;
    }
    .article-meta span{display:flex;align-items:center;gap:6px}
    .article-meta i{color:var(--primary)}
    
    .featured-image{
      width:100%; height:400px; object-fit:cover;
      border-radius:12px; margin-bottom:40px;
      border:1px solid rgba(79,124,255,0.2);
    }
    
    .article-content{color:var(--text)}
    .article-content h2{
      font-size:1.8rem; margin:40px 0 16px;
      color:var(--primary); font-weight:700;
    }
    .article-content h3{
      font-size:1.3rem; margin:28px 0 12px;
      color:var(--text); font-weight:700;
    }
    .article-content p{margin:16px 0;color:var(--muted);line-height:1.8}
    .article-content ul, .article-content ol{margin:16px 0;padding-left:24px}
    .article-content li{margin-bottom:12px;color:var(--muted)}
    .article-content strong{color:var(--text);font-weight:700}
    .article-content em{color:var(--accent);font-style:italic}
    
    .code-block{
      background:var(--card); padding:20px; border-radius:8px;
      border:1px solid rgba(79,124,255,0.2); margin:20px 0;
      overflow-x:auto; border-left:4px solid var(--primary);
    }
    .code-block code{
      font-family:'Courier New',monospace; color:var(--accent);
      font-size:13px; line-height:1.6;
    }
    
    .highlight{
      background:rgba(79,124,255,0.1); padding:20px;
      border-radius:8px; border-left:4px solid var(--primary);
      margin:20px 0;
    }
    .highlight p{margin:0;color:var(--text)}
    .highlight strong{color:var(--accent)}
    
    .callout{
      padding:20px; border-radius:8px; margin:20px 0;
      display:flex; gap:16px; align-items:flex-start;
    }
    .callout.info{background:rgba(79,124,255,0.1);border-left:4px solid var(--primary)}
    .callout.success{background:rgba(76,175,80,0.1);border-left:4px solid #4caf50}
    
    .callout-icon{
      font-size:24px; flex-shrink:0; line-height:1;
    }
    .callout.info .callout-icon{color:var(--primary)}
    .callout.success .callout-icon{color:#4caf50}
    
    .toc{
      background:var(--card); padding:24px; border-radius:8px;
      border:1px solid rgba(79,124,255,0.2); margin-bottom:40px;
    }
    .toc h3{margin:0 0 16px;font-size:1.1rem;color:var(--text)}
    .toc ol{margin:0;padding-left:20px}
    .toc li{margin-bottom:8px}
    .toc a{color:var(--primary);transition:color 0.2s}
    .toc a:hover{color:var(--accent)}
    
    .article-footer{
      margin-top:60px; padding-top:40px;
      border-top:1px solid rgba(255,255,255,0.05);
    }
    
    .author-card{
      background:var(--card); padding:24px; border-radius:8px;
      border:1px solid rgba(79,124,255,0.2); display:flex;
      gap:20px; align-items:flex-start;
    }
    .author-avatar{
      width:80px; height:80px; border-radius:8px;
      background:rgba(79,124,255,0.1); flex-shrink:0;
      display:flex; align-items:center; justify-content:center;
      font-size:32px;
    }
    .author-info h4{margin:0 0 6px;color:var(--text)}
    .author-info p{margin:0;color:var(--muted);font-size:13px}
    
    .nav-posts{
      display:grid; grid-template-columns:1fr 1fr;
      gap:20px; margin-top:40px;
    }
    .nav-post{
      padding:20px; background:var(--card); border-radius:8px;
      border:1px solid rgba(79,124,255,0.2); transition:all 0.2s;
    }
    .nav-post:hover{border-color:rgba(79,124,255,0.4);background:rgba(79,124,255,0.02)}
    .nav-post small{color:var(--muted);font-size:12px}
    .nav-post h4{margin:8px 0 0;color:var(--primary);font-size:1rem}
    
    footer{padding:32px 28px;text-align:center;color:var(--muted);
      border-top:1px solid rgba(255,255,255,0.03);margin-top:60px;font-size:13px}
    
    @media(max-width:768px){
      .article-header h1{font-size:1.8rem}
      .featured-image{height:250px}
      nav{display:none}
      .nav-posts{grid-template-columns:1fr}
      .author-card{flex-direction:column;text-align:center}
    }
  </style>
</head>
<body>

  <header>
    <a class="logo" href="{{ route('home') }}">
      <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSn-mLqVUisgZmQ_I9xw8PEzAtgXSxbUM3pFw&s" alt="logo">
      <span style="color:var(--primary)">Rohit</span>
    </a>
    <nav>
      <a href="{{ route('home') }}">Home</a>
      <a href="{{ route('home') }}#projects">Projects</a>
      <a href="{{ route('blog.index') }}">Blog</a>
      <a href="{{ route('home') }}#contact">Contact</a>
    </nav>
  </header>

  <main>
    <a href="{{ route('blog.index') }}" class="back-link">
      <i class="fas fa-arrow-left"></i> Back to Blog
    </a>

    <article class="article-content">
      
      <div class="article-header">
        <h1>Why I Chose Web Development</h1>
        <div class="article-meta">
          <span><i class="fas fa-calendar"></i> April 2025</span>
          <span><i class="fas fa-clock"></i> 5 min read</span>
          <span><i class="fas fa-user"></i> Rohit Joshi</span>
          <span><i class="fas fa-tag"></i> Career, Learning, Web Dev</span>
        </div>
      </div>

      <img src="https://images.unsplash.com/photo-1517694712202-14dd9538aa97?w=800&h=400&fit=crop" alt="Why I Chose Web Development" class="featured-image">

      <!-- Table of Contents -->
      <div class="toc">
        <h3><i class="fas fa-list" style="margin-right:8px"></i> Table of Contents</h3>
        <ol>
          <li><a href="#intro">Introduction</a></li>
          <li><a href="#inspired">What Inspired Me</a></li>
          <li><a href="#learned">What I've Learned</a></li>
          <li><a href="#why">Why It Still Excites Me</a></li>
          <li><a href="#next">What's Next</a></li>
        </ol>
      </div>

      <h2 id="intro">The Beginning of My Journey</h2>
      <p>Back in 2021, I was just a curious student playing around with HTML in a text editor. Little did I know that curiosity would evolve into a career-defining passion. Building a simple webpage and seeing it live in a browser felt like <strong>pure magic</strong> to me.</p>

      <p>What drew me in was the instant feedback. I could write a few lines of code, hit refresh, and boom — the result was right there. Unlike traditional programming where things were more abstract, web development felt alive and <em>visual</em>. I could see the impact of my code immediately.</p>

      <div class="highlight">
        <p><strong>That moment changed everything for me.</strong> I realized I wanted to build things that real people could interact with, see, and use. The combination of creativity and logic was irresistible.</p>
      </div>

      <h2 id="inspired">💡 What Inspired Me</h2>
      <p>I found inspiration from platforms like <a href="https://dev.to" target="_blank">Dev.to</a> and <a href="https://hashnode.com" target="_blank">Hashnode</a>, where developers shared their learnings and projects openly. YouTube creators like Traversy Media and Kevin Powell made learning not just easier but actually <strong>fun</strong>.</p>

      <p>I also followed several people on Twitter (now X) who posted daily about what they were building. That inspired me to #BuildInPublic too. Watching people share wins, struggles, and progress made me realize that I wasn't alone on this journey. There was a whole community of learners just like me.</p>

      <div class="callout info">
        <div class="callout-icon"><i class="fas fa-lightbulb"></i></div>
        <div>
          <strong>Community matters.</strong> Surrounding yourself with people who are learning and building alongside you accelerates your growth exponentially.
        </div>
      </div>

      <h2 id="learned">🚀 What I've Learned</h2>
      <p>Over the last few years, I've learned and built using:</p>
      <ul>
        <li><strong>Frontend:</strong> HTML, CSS, JavaScript, React, TailwindCSS</li>
        <li><strong>Backend:</strong> PHP, Laravel, MySQL, RESTful APIs</li>
        <li><strong>Tools:</strong> Git, GitHub, Docker, Postman, VS Code</li>
      </ul>

      <p>I've also participated in <strong>15+ hackathons and ideathons</strong> and won 6 of them. These events were crash courses in problem-solving, teamwork, and quick thinking under pressure.</p>

      <p>Beyond coding, I learned how to:</p>
      <ul>
        <li>Communicate ideas clearly and concisely</li>
        <li>Pitch projects to judges and clients</li>
        <li>Manage time effectively under tight deadlines</li>
        <li>Collaborate with designers, developers, and stakeholders</li>
        <li>Handle feedback and criticism constructively</li>
      </ul>

      <p><em>These soft skills turned out to be just as important as technical knowledge.</em></p>

      <h2 id="why">🔍 Why It Still Excites Me</h2>
      <p>The web is always evolving — new APIs, frameworks, performance techniques, and best practices emerge constantly. It's impossible to get bored.</p>

      <p>I love the balance of <strong>logic and creativity</strong>. Whether it's coding a feature or designing a UI, it pushes me to improve daily. There's always something new to learn, a problem to solve, or a better way to do something.</p>

      <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=800&h=400&fit=crop" alt="Web Developer at Work" class="featured-image">

      <p>Also, the joy of <strong>shipping something people can interact with</strong> — even if it's just a simple tool — is unmatched. Knowing that your code is helping someone, solving their problem, or making their life easier is incredibly rewarding.</p>

      <div class="callout success">
        <div class="callout-icon"><i class="fas fa-check-circle"></i></div>
        <div>
          <strong>The best part?</strong> Building in public means people you've never met can see your work, learn from it, and get inspired. That ripple effect is something I never expected when I started.
        </div>
      </div>

      <h2 id="next">👨‍💻 What's Next</h2>
      <p>I'm currently freelancing, open to collaborations, and contributing to open-source projects. My future goals include:</p>
      <ul>
        <li>Diving deeper into backend systems and architecture</li>
        <li>Building SaaS products from idea to launch</li>
        <li>Sharing more of what I build with the community</li>
        <li>Mentoring junior developers and helping them avoid my mistakes</li>
        <li>Speaking at tech conferences and meetups</li>
      </ul>

      <p><strong>If you're just getting started in web development — here's my advice:</strong></p>
      <ul>
        <li>Don't wait for the perfect course or tool</li>
        <li>Start building. Build ugly if you have to. Build often.</li>
        <li>Share your progress, even if it's not perfect</li>
        <li>Join communities, ask questions, and help others</li>
        <li>Remember: every expert was once a beginner</li>
      </ul>

      <p><em>The rest follows.</em> 🚀</p>

    </article>

    <!-- Author Card -->
    <div class="article-footer">
      <div class="author-card">
        <div class="author-avatar">👨‍💻</div>
        <div class="author-info">
          <h4>Rohit Joshi</h4>
          <p>Laravel Developer & Backend Specialist. Passionate about building scalable web applications and sharing knowledge with the developer community.</p>
          <div style="display:flex;gap:12px;margin-top:12px">
            <a href="https://github.com/rohit-joshi25" target="_blank" style="color:var(--primary);transition:color 0.2s" title="GitHub">
              <i class="fab fa-github"></i> GitHub
            </a>
            <a href="https://www.linkedin.com/in/rohit-joshi-064ba926a/" target="_blank" style="color:var(--primary);transition:color 0.2s" title="LinkedIn">
              <i class="fab fa-linkedin"></i> LinkedIn
            </a>
          </div>
        </div>
      </div>

      <!-- Navigation to Other Posts -->
      <h3 style="margin-top:40px;margin-bottom:20px">Read Next</h3>
      <div class="nav-posts">
        <a href="{{ route('blog.post2') }}" class="nav-post">
          <small>Next Post →</small>
          <h4>PHP vs JavaScript for Backend</h4>
        </a>
        <a href="{{ route('blog.post3') }}" class="nav-post">
          <small>Read Later →</small>
          <h4>Laravel Best Practices</h4>
        </a>
      </div>
    </div>

  </main>

  <footer>
    &copy; 2025 Rohit Joshi • Laravel Developer • <a href="{{ route('home') }}#contact" style="color:var(--primary);font-weight:600">Get in Touch</a>
  </footer>

</body>
</html>