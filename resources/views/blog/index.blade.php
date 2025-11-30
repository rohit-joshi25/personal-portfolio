@extends('layouts.app')

@section('extra-styles')
    <style>
        :root {
            --bg: #0a0e27;
            --card: #131829;
            --text: #e8eaed;
            --muted: #a8adb8;
            --primary: #4f7cff;
            --accent: #00d4ff;
            --radius: 10px;
            --maxWidth: 1200px;
            /* increased to match services page */
        }

        * {
            box-sizing: border-box
        }

        html,
        body {
            height: 100%;
            margin: 0;
            font-family: 'Inter', system-ui, -apple-system, Segoe UI, Roboto;
            background: var(--bg);
            color: var(--text);
            -webkit-font-smoothing: antialiased;
            line-height: 1.6
        }

        a {
            color: inherit;
            text-decoration: none
        }

        header {
            position: fixed;
            left: 0;
            right: 0;
            top: 0;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 32px;
            z-index: 1200;
            background: rgba(10, 14, 39, 0.95);
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(8px);
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 700;
            font-size: 18px
        }

        .logo img {
            width: 40px;
            height: 40px;
            border-radius: 6px
        }

        nav {
            display: flex;
            gap: 28px
        }

        nav a {
            font-weight: 500;
            font-size: 14px;
            color: var(--muted);
            transition: color 0.2s
        }

        nav a:hover {
            color: var(--primary)
        }

        main {
            max-width: var(--maxWidth);
            margin: 100px auto 60px;
            padding: 0 28px
        }

        .blog-header {
            text-align: center;
            margin-bottom: 60px
        }

        .blog-header h1 {
            font-size: 2.8rem;
            margin: 0 0 12px;
            font-weight: 700;
            letter-spacing: -0.5px
        }

        .blog-header p {
            color: var(--muted);
            font-size: 16px;
            margin: 0
        }

        .blog-grid {
            display: grid;
            gap: 32px;
            grid-template-columns: 1fr
        }

        .blog-card {
            background: var(--card);
            padding: 32px;
            border-radius: var(--radius);
            border: 1px solid rgba(255, 255, 255, 0.03);
            transition: all 0.3s;
            display: grid;
            grid-template-columns: 1fr 200px;
            grid-template-columns: 1fr 260px;
            gap: 24px;
            align-items: start;
        }

        .blog-card:hover {
            border-color: rgba(79, 124, 255, 0.2);
            transform: translateY(-4px)
        }

        .blog-content h2 {
            margin: 0 0 12px;
            font-size: 1.5rem;
            font-weight: 700
        }

        .blog-content h2 a {
            color: var(--text)
        }

        .blog-content h2 a:hover {
            color: var(--primary)
        }

        .blog-meta {
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
            margin-bottom: 16px;
            font-size: 13px
        }

        .blog-meta span {
            display: flex;
            align-items: center;
            gap: 6px;
            color: var(--muted)
        }

        .blog-meta i {
            color: var(--primary)
        }

        .blog-excerpt {
            color: var(--muted);
            font-size: 15px;
            line-height: 1.7;
            margin-bottom: 16px
        }

        .blog-tags {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
            margin-bottom: 16px
        }

        .tag {
            display: inline-block;
            padding: 6px 12px;
            background: rgba(79, 124, 255, 0.1);
            border: 1px solid rgba(79, 124, 255, 0.2);
            border-radius: 999px;
            font-size: 12px;
            font-weight: 600;
            color: var(--primary)
        }

        .tag:hover {
            background: rgba(79, 124, 255, 0.2)
        }

        .read-more {
            color: var(--primary);
            font-weight: 600;
            display: inline-flex;
            gap: 6px;
            align-items: center;
            transition: gap 0.2s
        }

        .read-more:hover {
            gap: 10px
        }

        .read-more i {
            font-size: 12px
        }

        .blog-image {
            width: 200px;
            height: 160px;
            width: 260px;
            height: 160px;
            border-radius: 8px;
            object-fit: cover;
            border: 1px solid rgba(79, 124, 255, 0.2);
        }

        .sidebar {
            display: flex;
            flex-direction: column;
            gap: 24px
        }

        .sidebar-card {
            background: var(--card);
            padding: 20px;
            border-radius: var(--radius);
            border: 1px solid rgba(255, 255, 255, 0.03);
        }

        .sidebar-card h3 {
            margin: 0 0 12px;
            font-weight: 700;
            color: var(--text)
        }

        .sidebar-card p {
            margin: 0;
            color: var(--muted);
            font-size: 13px
        }

        .search-box {
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            border: 1px solid rgba(255, 255, 255, 0.08);
            background: rgba(255, 255, 255, 0.02);
            color: var(--text);
            font-size: 14px;
            margin-bottom: 16px;
            transition: all 0.2s;
        }

        .search-box:focus {
            outline: none;
            border-color: rgba(79, 124, 255, 0.4);
            background: rgba(79, 124, 255, 0.05)
        }

        .category-list {
            display: flex;
            flex-direction: column;
            gap: 8px
        }

        .category-item {
            padding: 10px 12px;
            border-radius: 6px;
            background: rgba(79, 124, 255, 0.05);
            color: var(--muted);
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            border-left: 3px solid transparent;
        }

        .category-item:hover {
            background: rgba(79, 124, 255, 0.1);
            border-left-color: var(--primary);
            color: var(--text)
        }

        footer {
            padding: 32px 28px;
            text-align: center;
            color: var(--muted);
            border-top: 1px solid rgba(255, 255, 255, 0.03);
            margin-top: 60px;
            font-size: 13px
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 16px;
            background: rgba(79, 124, 255, 0.1);
            border: 1px solid rgba(79, 124, 255, 0.2);
            border-radius: 6px;
            color: var(--primary);
            font-weight: 600;
            font-size: 13px;
            transition: all 0.2s;
            margin-bottom: 40px
        }

        .back-btn:hover {
            background: rgba(79, 124, 255, 0.2)
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px
        }

        .empty-state i {
            font-size: 48px;
            color: var(--muted);
            margin-bottom: 16px;
            opacity: 0.5
        }

        .empty-state p {
            color: var(--muted);
            font-size: 16px
        }

        @media(max-width:768px) {
            .blog-card {
                grid-template-columns: 1fr;
                gap: 16px
            }

            .blog-image {
                width: 100%;
                height: 200px
            }

            nav {
                display: none
            }

            .blog-header h1 {
                font-size: 2rem
            }
        }

        .muted {
            color: var(--muted)
        }
    </style>
@endsection

@section('content')
    <main>

        <div class="blog-header" data-aos="fade-down">
            <h1>My Blog</h1>
            <p>Insights on Laravel, PHP, web development, and backend architecture</p>
        </div>

        <div style="display:grid;grid-template-columns:1fr 280px;gap:40px">

            <!-- Blog Posts -->
            <div class="blog-grid">

                <!-- Post 1 -->
                <div class="blog-card" data-aos="fade-up">
                    <div class="blog-content">
                        <h2><a href="{{ route('blog.post1') }}">Why I Chose Web Development</a></h2>
                        <div class="blog-meta">
                            <span><i class="fas fa-calendar"></i> April 2025</span>
                            <span><i class="fas fa-clock"></i> 5 min read</span>
                            <span><i class="fas fa-user"></i> Rohit Joshi</span>
                        </div>
                        <p class="blog-excerpt">Exploring my journey from curious student to passionate web developer.
                            Lessons learned, inspiration found, and what drives me to keep building remarkable things.
                        </p>
                        <div class="blog-tags">
                            <span class="tag">Web Development</span>
                            <span class="tag">Career</span>
                            <span class="tag">Learning</span>
                        </div>
                        <a href="{{ route('blog.post1') }}" class="read-more">Read Full Article <i
                                class="fas fa-arrow-right"></i></a>
                    </div>
                    <img src="https://images.unsplash.com/photo-1517694712202-14dd9538aa97?w=200&h=160&fit=crop"
                        alt="Why I Chose Web Development" class="blog-image">
                </div>

                <!-- Post 2 -->
                <div class="blog-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="blog-content">
                        <h2><a href="{{ route('blog.post2') }}">PHP vs JavaScript for Backend</a></h2>
                        <div class="blog-meta">
                            <span><i class="fas fa-calendar"></i> March 2025</span>
                            <span><i class="fas fa-clock"></i> 8 min read</span>
                            <span><i class="fas fa-user"></i> Rohit Joshi</span>
                        </div>
                        <p class="blog-excerpt">A detailed comparison of PHP and Node.js for backend development. When
                            to use each, pros/cons, performance benchmarks, and which fits your project best.</p>
                        <div class="blog-tags">
                            <span class="tag">PHP</span>
                            <span class="tag">JavaScript</span>
                            <span class="tag">Backend</span>
                            <span class="tag">Comparison</span>
                        </div>
                        <a href="{{ route('blog.post2') }}" class="read-more">Read Full Article <i
                                class="fas fa-arrow-right"></i></a>
                    </div>
                    <img src="https://images.unsplash.com/photo-1517694712202-14dd9538aa97?w=200&h=160&fit=crop"
                        alt="PHP vs JavaScript" class="blog-image">
                </div>

                <!-- Post 3 -->
                <div class="blog-card" data-aos="fade-up" data-aos-delay="200">
                    <div class="blog-content">
                        <h2><a href="{{ route('blog.post3') }}">Laravel Best Practices</a></h2>
                        <div class="blog-meta">
                            <span><i class="fas fa-calendar"></i> February 2025</span>
                            <span><i class="fas fa-clock"></i> 6 min read</span>
                            <span><i class="fas fa-user"></i> Rohit Joshi</span>
                        </div>
                        <p class="blog-excerpt">Essential Laravel patterns and practices for writing clean, maintainable
                            code. Database optimization, caching strategies, security tips, and production-ready
                            techniques.</p>
                        <div class="blog-tags">
                            <span class="tag">Laravel</span>
                            <span class="tag">PHP</span>
                            <span class="tag">Best Practices</span>
                            <span class="tag">Code Quality</span>
                        </div>
                        <a href="{{ route('blog.post3') }}" class="read-more">Read Full Article <i
                                class="fas fa-arrow-right"></i></a>
                    </div>
                    <img src="https://images.unsplash.com/photo-1517694712202-14dd9538aa97?w=200&h=160&fit=crop"
                        alt="Laravel Best Practices" class="blog-image">
                </div>

            </div>

            <!-- Sidebar -->
            <aside class="sidebar">

                <!-- Search -->
                <div class="sidebar-card">
                    <input type="text" class="search-box" placeholder="Search articles..." id="searchInput">
                </div>

                <!-- Categories -->
                <div class="sidebar-card">
                    <h3><i class="fas fa-list" style="color:var(--primary);margin-right:8px"></i> Categories</h3>
                    <div class="category-list">
                        <div class="category-item">📱 Web Development</div>
                        <div class="category-item">🐘 PHP</div>
                        <div class="category-item">🚀 Laravel</div>
                        <div class="category-item">⚙️ Backend</div>
                        <div class="category-item">💡 Tips & Tricks</div>
                    </div>
                </div>

                <!-- About Author -->
                <div class="sidebar-card">
                    <h3><i class="fas fa-user-circle" style="color:var(--primary);margin-right:8px"></i> About Author
                    </h3>
                    <p>Laravel developer passionate about building scalable web applications and sharing knowledge with
                        the community.</p>
                    <div style="display:flex;gap:10px;margin-top:12px">
                        <a href="https://github.com/rohit-joshi25" target="_blank"
                            style="width:32px;height:32px;border-radius:6px;background:rgba(79,124,255,0.1);display:flex;align-items:center;justify-content:center;color:var(--primary);transition:all 0.2s"
                            title="GitHub">
                            <i class="fab fa-github"></i>
                        </a>
                        <a href="https://www.linkedin.com/in/rohit-joshi-064ba926a/" target="_blank"
                            style="width:32px;height:32px;border-radius:6px;background:rgba(79,124,255,0.1);display:flex;align-items:center;justify-content:center;color:var(--primary);transition:all 0.2s"
                            title="LinkedIn">
                            <i class="fab fa-linkedin"></i>
                        </a>
                        <a href="https://twitter.com" target="_blank"
                            style="width:32px;height:32px;border-radius:6px;background:rgba(79,124,255,0.1);display:flex;align-items:center;justify-content:center;color:var(--primary);transition:all 0.2s"
                            title="Twitter">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </div>
                </div>

                <!-- Newsletter -->
                <div class="sidebar-card"
                    style="background:linear-gradient(135deg,rgba(79,124,255,0.1),rgba(0,212,255,0.05));border:1px solid rgba(79,124,255,0.2)">
                    <h3 style="color:var(--accent)"><i class="fas fa-envelope" style="margin-right:8px"></i> Subscribe
                    </h3>
                    <p style="margin-bottom:12px">Get latest articles delivered to your inbox.</p>
                    <form style="display:flex;flex-direction:column;gap:8px"
                        onsubmit="event.preventDefault();alert('Thanks for subscribing!')">
                        <input type="email" placeholder="Your email" required
                            style="padding:10px;border-radius:6px;border:1px solid rgba(255,255,255,0.1);background:rgba(255,255,255,0.02);color:var(--text);font-size:12px">
                        <button type="submit"
                            style="padding:10px;background:var(--primary);color:#fff;border:0;border-radius:6px;font-weight:600;cursor:pointer;font-size:12px;transition:all 0.2s">Subscribe</button>
                    </form>
                </div>

            </aside>

        </div>

    </main>
@endsection

@section('extra-scripts')
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ duration: 700, once: true });

        // Search functionality
        const searchInput = document.getElementById('searchInput');
        const blogCards = document.querySelectorAll('.blog-card');

        searchInput.addEventListener('input', (e) => {
            const query = e.target.value.toLowerCase();
            blogCards.forEach(card => {
                const title = card.querySelector('h2').textContent.toLowerCase();
                const excerpt = card.querySelector('.blog-excerpt').textContent.toLowerCase();
                const tags = Array.from(card.querySelectorAll('.tag')).map(t => t.textContent.toLowerCase()).join(' ');

                if (title.includes(query) || excerpt.includes(query) || tags.includes(query)) {
                    card.style.display = 'grid';
                } else {
                    card.style.display = 'none';
                }
            });
        });

        // Category filtering
        const categoryItems = document.querySelectorAll('.category-item');
        categoryItems.forEach(item => {
            item.addEventListener('click', () => {
                categoryItems.forEach(i => i.style.background = 'rgba(79,124,255,0.05)');
                item.style.background = 'rgba(79,124,255,0.2)';
            });
        });
    </script>
@endsection