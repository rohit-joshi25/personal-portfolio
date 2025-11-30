@extends('layouts.app')

@section('extra-styles')
<style>
    :root{
      --bg:#0a0e27; --card:#131829; --text:#e8eaed; --muted:#a8adb8;
      --primary:#4f7cff; --accent:#00d4ff; --glass: rgba(255,255,255,0.02);
      --radius:10px; --shadow: 0 4px 20px rgba(0,0,0,0.6);
      --maxWidth:1200px;
    }
    *{box-sizing:border-box}
    html,body{height:100%;margin:0;font-family:'Inter',system-ui,-apple-system,Segoe UI,Roboto,"Helvetica Neue",Arial;
      background:var(--bg); color:var(--text); -webkit-font-smoothing:antialiased; line-height:1.6}
    a{color:inherit;text-decoration:none}

    main{max-width:var(--maxWidth); margin:100px auto 60px; padding:0 28px}
    
    .hero{display:grid;grid-template-columns:1fr 380px;gap:40px;align-items:center}
    .hero-left h1{font-size:3rem;line-height:1.1;margin:0 0 12px;font-weight:700;letter-spacing:-1px}
    .typewriter{color:var(--primary); font-weight:700}
    .hero p{color:var(--muted); margin-bottom:20px; font-size:16px; line-height:1.8}
    
    .cta-row{display:flex;gap:14px;flex-wrap:wrap;margin-top:24px}
    .btn{background:var(--primary); color:#fff; padding:12px 24px;border-radius:8px;border:0;font-weight:600;cursor:pointer;font-size:14px;transition:all 0.3s}
    .btn:hover{transform:translateY(-2px);box-shadow:0 8px 20px rgba(79,124,255,0.4)}
    .btn.ghost{background:transparent;border:1px solid rgba(255,255,255,0.08); color:var(--text)}
    .btn.ghost:hover{background:rgba(255,255,255,0.03);border-color:rgba(255,255,255,0.15)}
    
    .hero-right{background:linear-gradient(135deg, rgba(79,124,255,0.08), rgba(0,212,255,0.03)); padding:20px; border-radius:12px; border:1px solid rgba(255,255,255,0.05)}
    .profile-pic{width:100%;border-radius:12px;object-fit:cover;display:block}
    
    .grid{display:grid; gap:24px; grid-template-columns:repeat(auto-fit,minmax(280px,1fr))}
    .card{background:var(--card); padding:24px; border-radius:var(--radius); border:1px solid rgba(255,255,255,0.03); transition:all 0.3s}
    .card:hover{border-color:rgba(79,124,255,0.2);transform:translateY(-4px)}
    
    h2.section-title{font-size:1.8rem;margin:0 0 28px;color:var(--text);font-weight:700}
    
    .services .card{display:flex;gap:16px;align-items:flex-start}
    .service-icon{width:50px;height:50px;border-radius:10px;background:rgba(79,124,255,0.1);display:flex;align-items:center;justify-content:center;font-size:22px;color:var(--primary);flex-shrink:0}
    .service-content h3{margin:0;font-size:1.05rem;font-weight:600}
    .service-content p{margin:6px 0 0;color:var(--muted);font-size:14px}
    
    .skill{margin-bottom:16px}
    .skill .row{display:flex;justify-content:space-between;font-size:13px;margin-bottom:8px;color:var(--muted);font-weight:500}
    .bar{height:8px;background:rgba(255,255,255,0.04);border-radius:999px;overflow:hidden}
    .bar > i{display:block;height:100%; width:0%; background:linear-gradient(90deg,var(--primary),var(--accent)); border-radius:999px; transition:width 1000ms cubic-bezier(0.25,0.46,0.45,0.94)}
    
    .blog-post{display:flex;flex-direction:column;gap:12px}
    .blog-post h3{margin:0;font-weight:700;color:var(--text)}
    .blog-meta{display:flex;gap:12px;flex-wrap:wrap;font-size:12px;color:var(--muted)}
    .blog-excerpt{color:var(--muted);font-size:14px;line-height:1.6}
    .blog-post a{color:var(--primary);font-weight:600;display:inline-flex;gap:6px;align-items:center}
    
    .gallery-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(150px,1fr)); gap:12px}
    .gallery-grid img{width:100%;height:120px;object-fit:cover;border-radius:10px;cursor:pointer;display:block;transition:all 0.3s;border:1px solid rgba(255,255,255,0.05)}
    .gallery-grid img:hover{transform:scale(1.05);border-color:rgba(79,124,255,0.3)}
    
    .lightbox{
      position:fixed; inset:0; display:none; align-items:center; justify-content:center;
      background:rgba(0,0,0,0.92); z-index:2000; padding:20px;
    }
    .lightbox.show{display:flex}
    .lightbox img{max-width:90%; max-height:80vh; border-radius:12px; box-shadow:0 20px 60px rgba(0,0,0,0.8)}
    .lightbox .controls{position:absolute; top:20px; right:20px;display:flex;gap:10px;z-index:2001}
    .lightbox button{background:rgba(255,255,255,0.08);border:1px solid rgba(255,255,255,0.1);color:var(--text);padding:10px 12px;border-radius:8px;cursor:pointer;transition:all 0.2s}
    .lightbox button:hover{background:rgba(255,255,255,0.15)}
    
    .tool-badge{display:inline-flex;align-items:center;gap:8px;padding:8px 14px;background:rgba(79,124,255,0.1);border:1px solid rgba(79,124,255,0.2);border-radius:999px;font-size:13px;font-weight:600;color:var(--primary);margin-right:8px;margin-bottom:8px}
    .tool-badge i{font-size:16px}
    
    .certs .cert-row{display:flex;gap:16px;align-items:flex-start}
    .cert-badge{width:60px;height:60px;border-radius:10px;background:linear-gradient(135deg,var(--primary),var(--accent));display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700;font-size:14px;flex-shrink:0}
    .cert-content h4{margin:0;font-size:1rem;font-weight:600}
    .cert-content p{margin:6px 0 0;color:var(--muted);font-size:13px}
    
    .muted{color:var(--muted);font-size:14px}
    .pill{display:inline-block;padding:6px 12px;border-radius:999px;background:rgba(79,124,255,0.1);font-weight:600;color:var(--primary);font-size:12px;border:1px solid rgba(79,124,255,0.2)}
    
    #personal-greeting{font-size:14px;color:var(--accent);font-weight:500;display:inline-block;margin-bottom:20px}

    @media (max-width:960px){.hero{grid-template-columns:1fr;}.hero-right{order:2}.hero-left{order:1}.profile-pic{max-width:240px;margin:0 auto}.hero-left h1{font-size:2.2rem}}
    @media (max-width:720px){.hero-left h1{font-size:1.8rem} h2.section-title{font-size:1.4rem}}
  </style>
@endsection

@section('content')

<!-- Welcome Modal / localStorage greeting -->
<div id="welcome-screen" style="position:fixed;inset:0;background:linear-gradient(135deg,#0a0e27,#131829);display:flex;align-items:center;justify-content:center;z-index:1500;">
  <div style="text-align:center;color:#fff;padding:32px;max-width:760px">
    <h1 style="margin:0;font-size:2.2rem;font-weight:700">Welcome 👋</h1>
    <p style="color:rgba(255,255,255,0.8);margin:12px 0 24px;font-size:16px">Explore my Laravel projects and insights</p>
    <button class="btn" onclick="showModal()">Enter your details →</button>
    <div style="margin-top:14px"><button class="btn ghost" onclick="skipWelcome()">Browse portfolio</button></div>
  </div>
</div>

<!-- Modal collects name/email -->
<div id="welcome-modal" style="position:fixed;inset:0;display:none;align-items:center;justify-content:center;background:rgba(0,0,0,0.7);z-index:1600">
  <div style="width:92%;max-width:420px;background:var(--card);padding:28px;border-radius:12px;border:1px solid rgba(255,255,255,0.05)">
    <h3 style="margin:0 0 8px;color:var(--primary);font-weight:700">Let's Connect</h3>
    <p class="muted" style="margin:0 0 16px">I'll personalize your experience on my portfolio.</p>
    <input id="modal-name" placeholder="Full name" style="width:100%;padding:12px;border-radius:8px;border:1px solid rgba(255,255,255,0.08);background:rgba(255,255,255,0.02);color:var(--text);margin-bottom:12px;font-size:14px">
    <input id="modal-email" placeholder="Email address" type="email" style="width:100%;padding:12px;border-radius:8px;border:1px solid rgba(255,255,255,0.08);background:rgba(255,255,255,0.02);color:var(--text);margin-bottom:16px;font-size:14px">
    <div style="display:flex;gap:10px">
      <button class="btn" style="flex:1" onclick="submitVisitor()">Continue</button>
      <button class="btn ghost" style="flex:1" onclick="closeModal()">Cancel</button>
    </div>
  </div>
</div>

<main id="home">
  <h3 id="personal-greeting"></h3>

  <!-- HERO -->
  <section class="hero" aria-label="Introduction">
    <div class="hero-left" data-aos="fade-right">
      <div style="display:flex;align-items:center;gap:12px;margin-bottom:16px">
        <span class="pill">Laravel Developer</span>
        <span class="muted">Chandigarh, India</span>
      </div>

      <h1>Laravel Developer & Backend Specialist</h1>
      <div style="font-size:1.1rem;margin-bottom:12px;color:var(--accent);font-weight:600">
        <span class="typewriter" id="typewriter"></span>
      </div>
      <p>I craft robust, scalable web applications with Laravel. Specializing in API development, database architecture, and clean code practices to deliver production-ready solutions.</p>

      <div class="cta-row">
        <a class="btn" href="#projects">View Projects</a>
        <a class="btn ghost" href="#contact">Get in Touch</a>
      </div>

      <div style="display:flex;gap:16px;margin-top:28px;flex-wrap:wrap">
        <div class="card" style="min-width:130px;text-align:center;flex:0 0 auto">
          <div style="font-weight:700;font-size:1.4rem;color:var(--primary)">10+</div>
          <div class="muted" style="font-size:13px">Projects</div>
        </div>
        <div class="card" style="min-width:130px;text-align:center;flex:0 0 auto">
          <div style="font-weight:700;font-size:1.4rem;color:var(--primary)">1+ Yrs</div>
          <div class="muted" style="font-size:13px">Experience</div>
        </div>
        <div class="card" style="min-width:130px;text-align:center;flex:0 0 auto">
          <div style="font-weight:700;font-size:1.4rem;color:var(--primary)">BCA</div>
          <div class="muted" style="font-size:13px">Degree</div>
        </div>
      </div>
    </div>

    <aside class="hero-right" data-aos="fade-left">
      <img class="profile-pic" src="{{ asset('image/IMG_20241020_164308.jpg') }}" alt="Rohit Joshi" loading="lazy">
      <div style="display:flex;justify-content:space-between;align-items:center;margin-top:16px">
        <div>
          <div style="font-weight:700;font-size:15px">Rohit Joshi</div>
          <div class="muted" style="font-size:13px">Laravel Developer</div>
        </div>
        <div style="display:flex;gap:12px;align-items:center">
          <a href="https://github.com/rohit-joshi25" target="_blank" aria-label="GitHub" style="color:var(--primary);transition:all 0.2s;width:36px;height:36px;display:flex;align-items:center;justify-content:center;border-radius:8px;background:rgba(79,124,255,0.1)" title="GitHub"><i class="fab fa-github"></i></a>
          <a href="https://www.linkedin.com/in/rohit-joshi-064ba926a/" target="_blank" aria-label="LinkedIn" style="color:var(--primary);transition:all 0.2s;width:36px;height:36px;display:flex;align-items:center;justify-content:center;border-radius:8px;background:rgba(79,124,255,0.1)" title="LinkedIn"><i class="fab fa-linkedin"></i></a>
        </div>
      </div>
    </aside>
  </section>

  <!-- SERVICES -->
  <section id="services" style="margin-top:60px" data-aos="fade-up">
    <h2 class="section-title">Services</h2>
    <div class="grid services">
      <div class="card">
        <div style="display:flex;gap:16px">
          <span class="service-icon"><i class="fas fa-code"></i></span>
          <div class="service-content">
            <h3>Laravel Development</h3>
            <p>Custom web applications built with modern Laravel practices and clean architecture.</p>
          </div>
        </div>
      </div>

      <div class="card">
        <div style="display:flex;gap:16px">
          <span class="service-icon"><i class="fas fa-database"></i></span>
          <div class="service-content">
            <h3>Database Design</h3>
            <p>Efficient MySQL schema design, optimization, and migrations for scalable applications.</p>
          </div>
        </div>
      </div>

      <div class="card">
        <div style="display:flex;gap:16px">
          <span class="service-icon"><i class="fas fa-api"></i></span>
          <div class="service-content">
            <h3>API Development</h3>
            <p>RESTful APIs with authentication, validation, and comprehensive documentation.</p>
          </div>
        </div>
      </div>

      <div class="card">
        <div style="display:flex;gap:16px">
          <span class="service-icon"><i class="fas fa-wrench"></i></span>
          <div class="service-content">
            <h3>Maintenance & Support</h3>
            <p>Bug fixes, code optimization, performance tuning, and ongoing technical support.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- SKILLS -->
  <section id="skills" style="margin-top:60px" data-aos="fade-up">
    <h2 class="section-title">Technical Skills</h2>
    <div class="card">
      <div style="display:flex;gap:24px;flex-wrap:wrap">
        <div style="flex:1;min-width:280px">
          <div class="skill">
            <div class="row"><span>Laravel</span><strong>85%</strong></div>
            <div class="bar"><i data-width="85%"></i></div>
          </div>
          <div class="skill">
            <div class="row"><span>PHP</span><strong>85%</strong></div>
            <div class="bar"><i data-width="85%"></i></div>
          </div>
          <div class="skill">
            <div class="row"><span>MySQL</span><strong>80%</strong></div>
            <div class="bar"><i data-width="80%"></i></div>
          </div>
        </div>

        <div style="flex:1;min-width:280px">
          <div class="skill">
            <div class="row"><span>RESTful APIs</span><strong>80%</strong></div>
            <div class="bar"><i data-width="80%"></i></div>
          </div>
          <div class="skill">
            <div class="row"><span>JavaScript</span><strong>70%</strong></div>
            <div class="bar"><i data-width="70%"></i></div>
          </div>
          <div class="skill">
            <div class="row"><span>Git & DevOps</span><strong>75%</strong></div>
            <div class="bar"><i data-width="75%"></i></div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- PROJECTS preview -->
  <section id="projects" style="margin-top:60px" data-aos="fade-up">
    <h2 class="section-title">Selected Projects</h2>
    <div class="grid">
      <div class="card">
        <h3 style="margin:0 0 8px;font-weight:700">Student Portal</h3>
        <div class="pill" style="margin-bottom:12px;display:inline-block">Laravel • MySQL • Eloquent</div>
        <p class="muted" style="margin:0 0 12px">Role-based access control, student dashboards, result management, and admin panels with advanced filtering.</p>
        <a href="https://github.com/rohit-joshi25/student-portal-laravel" target="_blank" class="muted" style="color:var(--primary);font-weight:600;display:inline-flex;gap:6px;align-items:center">View on GitHub <i class="fas fa-arrow-right" style="font-size:12px"></i></a>
      </div>

      <div class="card">
        <h3 style="margin:0 0 8px;font-weight:700">E-Auction System</h3>
        <div class="pill" style="margin-bottom:12px;display:inline-block">Laravel • MySQL • Blade</div>
        <p class="muted" style="margin:0 0 12px">Real-time bidding system with cart management, session handling, and auction workflow automation.</p>
        <a href="https://github.com/rohit-joshi25/E-auction-website" target="_blank" class="muted" style="color:var(--primary);font-weight:600;display:inline-flex;gap:6px;align-items:center">View on GitHub <i class="fas fa-arrow-right" style="font-size:12px"></i></a>
      </div>

      <div class="card">
        <h3 style="margin:0 0 8px;font-weight:700">This Portfolio</h3>
        <div class="pill" style="margin-bottom:12px;display:inline-block">Laravel • Blade • Responsive</div>
        <p class="muted" style="margin:0 0 12px">Modern portfolio with animations, dark theme, visitor tracking, and accessibility best practices.</p>
      </div>
    </div>
  </section>

  <!-- BLOG SECTION -->
  <section id="blog" style="margin-top:60px" data-aos="fade-up">
    <h2 class="section-title">Latest Blog Posts</h2>
    <div class="grid">
      <div class="card blog-post">
        <h3>Why I Chose Web Development</h3>
        <div class="blog-meta">
          <span><i class="fas fa-calendar"></i> April 2025</span>
          <span><i class="fas fa-clock"></i> 5 min read</span>
        </div>
        <p class="blog-excerpt">Exploring my journey from curious student to passionate web developer. Lessons learned, inspiration found, and what drives me to keep building.</p>
        <a href="{{ route('blog.post1') }}">Read Full Article <i class="fas fa-arrow-right"></i></a>
      </div>

      <div class="card blog-post">
        <h3>PHP vs JavaScript for Backend</h3>
        <div class="blog-meta">
          <span><i class="fas fa-calendar"></i> March 2025</span>
          <span><i class="fas fa-clock"></i> 8 min read</span>
        </div>
        <p class="blog-excerpt">A detailed comparison of PHP and Node.js for backend development. When to use each, pros/cons, and which fits your project.</p>
        <a href="{{ route('blog.post2') }}">Read Full Article <i class="fas fa-arrow-right"></i></a>
      </div>

      <div class="card blog-post">
        <h3>Laravel Best Practices</h3>
        <div class="blog-meta">
          <span><i class="fas fa-calendar"></i> February 2025</span>
          <span><i class="fas fa-clock"></i> 6 min read</span>
        </div>
        <p class="blog-excerpt">Essential Laravel patterns and practices for writing clean, maintainable code. Database optimization, caching strategies, and security tips.</p>
        <a href="#">Read Full Article <i class="fas fa-arrow-right"></i></a>
      </div>
    </div>
  </section>

  <!-- TOOLS & STACK -->
  <section id="tools" style="margin-top:60px" data-aos="fade-up">
    <h2 class="section-title">Tools & Stack</h2>
    <div class="card">
      <div style="display:flex;flex-wrap:wrap">
        <span class="tool-badge"><i class="fab fa-laravel"></i> Laravel</span>
        <span class="tool-badge"><i class="fab fa-php"></i> PHP 8</span>
        <span class="tool-badge"><i class="fas fa-database"></i> MySQL</span>
        <span class="tool-badge"><i class="fab fa-git"></i> Git</span>
        <span class="tool-badge"><i class="fab fa-js"></i> JavaScript</span>
        <span class="tool-badge"><i class="fab fa-html5"></i> HTML5</span>
        <span class="tool-badge"><i class="fab fa-css3"></i> Tailwind CSS</span>
        <span class="tool-badge"><i class="fab fa-bootstrap"></i> Bootstrap</span>
        <span class="tool-badge"><i class="fas fa-cube"></i> Postman</span>
        <span class="tool-badge"><i class="fas fa-server"></i> Docker</span>
        <span class="tool-badge"><i class="fab fa-github"></i> GitHub</span>
        <span class="tool-badge"><i class="fas fa-code"></i> VS Code</span>
        <span class="tool-badge"><i class="fas fa-terminal"></i> Composer</span>
        <span class="tool-badge"><i class="fas fa-box"></i> NPM</span>
        <span class="tool-badge"><i class="fas fa-leaf"></i> Eloquent ORM</span>
        <span class="tool-badge"><i class="fas fa-shield"></i> Laravel Middleware</span>
      </div>
    </div>
  </section>

  <!-- GALLERY SECTION -->
  <section id="gallery" style="margin-top:60px" data-aos="fade-up">
    <h2 class="section-title">Project Gallery</h2>
    <div class="gallery-grid" id="galleryGrid">
      <img src="https://images.unsplash.com/photo-1517694712202-14dd9538aa97?w=300&h=120&fit=crop" alt="Laravel Development" loading="lazy">
      <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?w=300&h=120&fit=crop" alt="Web Development" loading="lazy">
      <img src="https://images.unsplash.com/photo-1517694712162-7bcfe14e70c4?w=300&h=120&fit=crop" alt="Coding Setup" loading="lazy">
      <img src="https://images.unsplash.com/photo-1516321318423-f06f70d504d0?w=300&h=120&fit=crop" alt="Database Design" loading="lazy">
      <img src="https://images.unsplash.com/photo-1510941282202-fc26e67b3e84?w=300&h=120&fit=crop" alt="API Development" loading="lazy">
      <img src="https://images.unsplash.com/photo-1517694712985-fd3500aaf928?w=300&h=120&fit=crop" alt="Tech Stack" loading="lazy">
    </div>
  </section>

  <!-- Lightbox -->
  <div id="lightbox" class="lightbox">
    <img id="lightboxImg" src="" alt="">
    <div class="controls">
      <button id="prevBtn"><i class="fas fa-chevron-left"></i></button>
      <button id="nextBtn"><i class="fas fa-chevron-right"></i></button>
      <button id="closeBtn"><i class="fas fa-times"></i></button>
    </div>
  </div>

  <!-- CERTIFICATIONS -->
  <section id="certs" style="margin-top:60px" data-aos="fade-up">
    <h2 class="section-title">Certifications</h2>
    <div class="grid certs">
      <div class="card cert-row">
        <div class="cert-badge">SQL</div>
        <div class="cert-content">
          <h4>Database Management with SQL</h4>
          <p class="muted">HackerRank • Jan 2024 · <a href="https://www.hackerrank.com/certificates/95556d4912b4" target="_blank" style="color:var(--primary);font-weight:600">Verify</a></p>
        </div>
      </div>

      <div class="card cert-row">
        <div class="cert-badge">LAR</div>
        <div class="cert-content">
          <h4>Laravel Development Training</h4>
          <p class="muted">In-progress · Building production-level applications and mastering framework best practices.</p>
        </div>
      </div>

      <div class="card cert-row">
        <div class="cert-badge">WEB</div>
        <div class="cert-content">
          <h4>Responsive Web Design</h4>
          <p class="muted">Coursera • Modern JavaScript, CSS frameworks, and accessibility standards.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- CONTACT -->
  <section id="contact" style="margin-top:60px;margin-bottom:60px" data-aos="fade-up">
    <h2 class="section-title">Get In Touch</h2>
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:40px;align-items:start">
      
      <!-- Contact Form -->
      <div>
        <div class="card" style="padding:32px">
          <h3 style="margin:0 0 8px;font-weight:700;color:var(--text)">Send a Message</h3>
          <p class="muted" style="margin:0 0 24px">Fill out the form and I'll get back to you within 24 hours.</p>
          
          <form class="contact-form" action="https://formspree.io/f/mnnvrjjl" method="POST" style="display:flex;flex-direction:column;gap:14px">
            <div style="display:flex;flex-direction:column;gap:6px">
              <label style="font-weight:600;font-size:13px;color:var(--text)">Full Name</label>
              <input name="name" placeholder="John Doe" required style="padding:12px;border-radius:8px;border:1px solid rgba(255,255,255,0.08);background:rgba(255,255,255,0.02);color:var(--text);font-size:14px;transition:all 0.2s" onfocus="this.style.borderColor='rgba(79,124,255,0.4)';this.style.background='rgba(79,124,255,0.05)'" onblur="this.style.borderColor='rgba(255,255,255,0.08)';this.style.background='rgba(255,255,255,0.02)'">
            </div>

            <div style="display:flex;flex-direction:column;gap:6px">
              <label style="font-weight:600;font-size:13px;color:var(--text)">Email Address</label>
              <input name="_replyto" type="email" placeholder="your@email.com" required style="padding:12px;border-radius:8px;border:1px solid rgba(255,255,255,0.08);background:rgba(255,255,255,0.02);color:var(--text);font-size:14px;transition:all 0.2s" onfocus="this.style.borderColor='rgba(79,124,255,0.4)';this.style.background='rgba(79,124,255,0.05)'" onblur="this.style.borderColor='rgba(255,255,255,0.08)';this.style.background='rgba(255,255,255,0.02)'">
            </div>

            <div style="display:flex;flex-direction:column;gap:6px">
              <label style="font-weight:600;font-size:13px;color:var(--text)">Subject</label>
              <input name="subject" placeholder="Project inquiry" style="padding:12px;border-radius:8px;border:1px solid rgba(255,255,255,0.08);background:rgba(255,255,255,0.02);color:var(--text);font-size:14px;transition:all 0.2s" onfocus="this.style.borderColor='rgba(79,124,255,0.4)';this.style.background='rgba(79,124,255,0.05)'" onblur="this.style.borderColor='rgba(255,255,255,0.08)';this.style.background='rgba(255,255,255,0.02)'">
            </div>

            <div style="display:flex;flex-direction:column;gap:6px">
              <label style="font-weight:600;font-size:13px;color:var(--text)">Message</label>
              <textarea name="message" rows="6" placeholder="Tell me about your project or inquiry..." required style="padding:12px;border-radius:8px;border:1px solid rgba(255,255,255,0.08);background:rgba(255,255,255,0.02);color:var(--text);font-size:14px;resize:vertical;transition:all 0.2s;font-family:inherit" onfocus="this.style.borderColor='rgba(79,124,255,0.4)';this.style.background='rgba(79,124,255,0.05)'" onblur="this.style.borderColor='rgba(255,255,255,0.08)';this.style.background='rgba(255,255,255,0.02)'"></textarea>
            </div>

            <button class="btn" type="submit" style="margin-top:8px;width:100%;display:flex;align-items:center;justify-content:center;gap:8px">
              <i class="fas fa-paper-plane"></i> Send Message
            </button>
            <p class="muted" style="margin:0;font-size:12px;text-align:center">We respect your privacy. Your email won't be shared.</p>
          </form>
        </div>
      </div>

      <!-- Contact Info -->
      <div style="display:flex;flex-direction:column;gap:20px">
        
        <!-- Quick Info Card -->
        <div class="card" style="padding:24px">
          <h3 style="margin:0 0 16px;font-weight:700;color:var(--text)">Let's Connect</h3>
          <div style="display:flex;flex-direction:column;gap:16px">
            
            <div style="display:flex;gap:12px">
              <div style="width:44px;height:44px;border-radius:10px;background:rgba(79,124,255,0.1);display:flex;align-items:center;justify-content:center;flex-shrink:0">
                <i class="fas fa-envelope" style="color:var(--primary);font-size:18px"></i>
              </div>
              <div>
                <div style="font-weight:600;color:var(--text);font-size:14px">Email</div>
                <a href="mailto:rohitjoshi2899@gmail.com" style="color:var(--primary);font-size:13px;display:flex;gap:6px;align-items:center;margin-top:4px">
                  rohitjoshi2899@gmail.com
                  <i class="fas fa-arrow-right" style="font-size:11px"></i>
                </a>
              </div>
            </div>

            <div style="display:flex;gap:12px">
              <div style="width:44px;height:44px;border-radius:10px;background:rgba(79,124,255,0.1);display:flex;align-items:center;justify-content:center;flex-shrink:0">
                <i class="fas fa-map-marker-alt" style="color:var(--primary);font-size:18px"></i>
              </div>
              <div>
                <div style="font-weight:600;color:var(--text);font-size:14px">Location</div>
                <p class="muted" style="margin:4px 0 0;font-size:13px">Chandigarh, India</p>
              </div>
            </div>

            <div style="display:flex;gap:12px">
              <div style="width:44px;height:44px;border-radius:10px;background:rgba(79,124,255,0.1);display:flex;align-items:center;justify-content:center;flex-shrink:0">
                <i class="fas fa-clock" style="color:var(--primary);font-size:18px"></i>
              </div>
              <div>
                <div style="font-weight:600;color:var(--text);font-size:14px">Response Time</div>
                <p class="muted" style="margin:4px 0 0;font-size:13px">Within 24 hours</p>
              </div>
            </div>

          </div>
        </div>

        <!-- Social Links Card -->
        <div class="card" style="padding:24px">
          <h3 style="margin:0 0 16px;font-weight:700;color:var(--text)">Follow Me</h3>
          <div style="display:flex;flex-direction:column;gap:10px">
            <a href="https://github.com/rohit-joshi25" target="_blank" style="display:flex;align-items:center;gap:12px;padding:12px;background:rgba(79,124,255,0.05);border:1px solid rgba(79,124,255,0.15);border-radius:8px;color:var(--primary);font-weight:600;font-size:14px;transition:all 0.2s;text-decoration:none" onmouseover="this.style.background='rgba(79,124,255,0.1)';this.style.borderColor='rgba(79,124,255,0.3)'" onmouseout="this.style.background='rgba(79,124,255,0.05)';this.style.borderColor='rgba(79,124,255,0.15)'">
              <i class="fab fa-github" style="font-size:18px;width:24px"></i>
              GitHub
              <i class="fas fa-arrow-right" style="font-size:12px;margin-left:auto"></i>
            </a>

            <a href="https://www.linkedin.com/in/rohit-joshi-064ba926a/" target="_blank" style="display:flex;align-items:center;gap:12px;padding:12px;background:rgba(79,124,255,0.05);border:1px solid rgba(79,124,255,0.15);border-radius:8px;color:var(--primary);font-weight:600;font-size:14px;transition:all 0.2s;text-decoration:none" onmouseover="this.style.background='rgba(79,124,255,0.1)';this.style.borderColor='rgba(79,124,255,0.3)'" onmouseout="this.style.background='rgba(79,124,255,0.05)';this.style.borderColor='rgba(79,124,255,0.15)'">
              <i class="fab fa-linkedin" style="font-size:18px;width:24px"></i>
              LinkedIn
              <i class="fas fa-arrow-right" style="font-size:12px;margin-left:auto"></i>
            </a>

            <a href="https://twitter.com" target="_blank" style="display:flex;align-items:center;gap:12px;padding:12px;background:rgba(79,124,255,0.05);border:1px solid rgba(79,124,255,0.15);border-radius:8px;color:var(--primary);font-weight:600;font-size:14px;transition:all 0.2s;text-decoration:none" onmouseover="this.style.background='rgba(79,124,255,0.1)';this.style.borderColor='rgba(79,124,255,0.3)'" onmouseout="this.style.background='rgba(79,124,255,0.05)';this.style.borderColor='rgba(79,124,255,0.15)'">
              <i class="fab fa-twitter" style="font-size:18px;width:24px"></i>
              Twitter
              <i class="fas fa-arrow-right" style="font-size:12px;margin-left:auto"></i>
            </a>

            <a href="https://www.buymeacoffee.com/rohitjoshi8" target="_blank" style="display:flex;align-items:center;gap:12px;padding:12px;background:rgba(0,212,255,0.05);border:1px solid rgba(0,212,255,0.2);border-radius:8px;color:var(--accent);font-weight:600;font-size:14px;transition:all 0.2s;text-decoration:none;margin-top:4px" onmouseover="this.style.background='rgba(0,212,255,0.1)';this.style.borderColor='rgba(0,212,255,0.4)'" onmouseout="this.style.background='rgba(0,212,255,0.05)';this.style.borderColor='rgba(0,212,255,0.2)'">
              <i class="fas fa-mug-hot" style="font-size:18px;width:24px"></i>
              Buy Me Coffee
              <i class="fas fa-arrow-right" style="font-size:12px;margin-left:auto"></i>
            </a>
          </div>
        </div>

      </div>
    </div>

    <!-- Response Message -->
    <div id="formMessage" style="display:none;margin-top:24px;padding:16px;border-radius:10px;background:rgba(0,212,255,0.1);border:1px solid rgba(0,212,255,0.3);color:var(--accent);text-align:center;font-weight:600">
      ✓ Thanks for reaching out! I'll get back to you soon.
    </div>
  </section>
</main>

@endsection

@section('extra-scripts')
<script>
  // Typewriter effect
  const phrases = ["Building scalable Laravel apps", "Crafting robust backends", "Mastering clean code practices"];
  let idx = 0, typePos = 0, forward = true;
  const tw = document.getElementById('typewriter');
  
  function tick(){
    const p = phrases[idx];
    if(forward){ typePos++; if(typePos>p.length){ forward=false; setTimeout(tick,1500); return; } }
    else { typePos--; if(typePos===0){ forward=true; idx=(idx+1)%phrases.length; } }
    tw.textContent = p.slice(0,typePos);
    setTimeout(tick, forward?50:30);
  }
  tick();

  // Welcome modal functionality
  const welcomeScreen = document.getElementById('welcome-screen');
  const welcomeModal = document.getElementById('welcome-modal');

  function showModal() { 
    welcomeModal.style.display = 'flex'; 
  }

  function closeModal() { 
    welcomeModal.style.display = 'none'; 
  }

  function skipWelcome() {
    localStorage.setItem('visitorSkipped', '1');
    welcomeScreen.style.display = 'none';
    welcomeModal.style.display = 'none';
  }

  function submitVisitor() {
    const name = document.getElementById('modal-name').value.trim();
    const email = document.getElementById('modal-email').value.trim();
    if (!name || !email) { 
      alert('Please fill both fields'); 
      return; 
    }

    localStorage.setItem('visitorName', name);
    localStorage.setItem('visitorEmail', email);
    document.getElementById('personal-greeting').innerText = `Welcome, ${name}! 👋`;

    welcomeModal.style.display = 'none';
    welcomeScreen.style.display = 'none';

    try {
      const fd = new FormData();
      fd.append("Visitor Name", name);
      fd.append("Visitor Email", email);
      fetch("https://formspree.io/f/mnnvrjjl", { 
        method: "POST", 
        body: fd, 
        headers: { Accept: "application/json" } 
      });
    } catch (e) {}
  }

  // Check localStorage on page load
  window.addEventListener('load', () => {
    const name = localStorage.getItem('visitorName');
    const skipped = localStorage.getItem('visitorSkipped');
    if(name) {
      welcomeScreen.style.display='none';
      welcomeModal.style.display='none';
      document.getElementById('personal-greeting').innerText = `Welcome back, ${name}! 👋`;
    }
    else if(skipped==='1') {
      welcomeScreen.style.display='none';
      welcomeModal.style.display='none';
    }
  });

  // Skill bars animation
  const bars = document.querySelectorAll('.bar > i');
  const obs = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if(entry.isIntersecting){
        const el = entry.target;
        const w = el.getAttribute('data-width') || '60%';
        el.style.width = w;
        obs.unobserve(el);
      }
    });
  }, {threshold:0.3});
  bars.forEach(b=>obs.observe(b));

  // Gallery lightbox
  const galleryGrid = document.getElementById('galleryGrid');
  const lightbox = document.getElementById('lightbox');
  const lightboxImg = document.getElementById('lightboxImg');
  const imgs = Array.from(galleryGrid.querySelectorAll('img'));
  let currentIndex = 0;

  function openLightbox(i){ 
    currentIndex = i; 
    lightboxImg.src = imgs[i].src; 
    lightbox.classList.add('show'); 
  }

  function closeLightbox(){ 
    lightbox.classList.remove('show'); 
  }

  function nextImg(){ 
    currentIndex = (currentIndex+1)%imgs.length; 
    lightboxImg.src = imgs[currentIndex].src; 
  }

  function prevImg(){ 
    currentIndex = (currentIndex-1+imgs.length)%imgs.length; 
    lightboxImg.src = imgs[currentIndex].src; 
  }

  imgs.forEach((img, i) => { 
    img.addEventListener('click', () => openLightbox(i)); 
  });
  
  document.getElementById('closeBtn').addEventListener('click', closeLightbox);
  document.getElementById('nextBtn').addEventListener('click', nextImg);
  document.getElementById('prevBtn').addEventListener('click', prevImg);

  document.addEventListener('keydown', (e) => {
    if(lightbox.classList.contains('show')){
      if(e.key==='Escape') closeLightbox();
      if(e.key==='ArrowRight') nextImg();
      if(e.key==='ArrowLeft') prevImg();
    }
  });

  // Modal keyboard navigation
  if(welcomeModal) {
    welcomeModal.addEventListener('keydown', (e) => { 
      if(e.key==='Escape') closeModal(); 
    });
  }
</script>
@endsection