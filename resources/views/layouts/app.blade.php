<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description"
        content="{{ $description ?? 'Rohit Joshi – Laravel Developer. Portfolio, services, skills, blog, gallery and certifications.' }}" />
    <title>{{ $title ?? 'Rohit Joshi | Laravel Developer' }}</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />

    <style>
        :root {
            --bg: #07060a;
            --primary: #4f7cff;
            --text: #e6eef8;
            --muted: #9aa6bd;
            --glass: rgba(20, 20, 30, 0.5);
            --border-color: rgba(255, 255, 255, 0.07);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html,
        body {
            font-family: 'Inter', system-ui, -apple-system, Segoe UI, Roboto, "Helvetica Neue", Arial;
            background: var(--bg);
            color: var(--text);
            -webkit-font-smoothing: antialiased;
            line-height: 1.6;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        .app-wrapper {
            margin-top: 100px;
            width: 100%;
        }

        /* --- Header --- */
        .header-container {
            position: fixed;
            top: 20px;
            left: 0;
            right: 0;
            z-index: 1200;
            display: flex;
            justify-content: center;
        }

        .navbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            /* Increased side padding for balance */
            padding: 8px 25px;
            /* This 60px gap pushes the Logo and Links apart */
            gap: 60px;
            width: auto;
            background: var(--glass);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid var(--border-color);
            border-radius: 999px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 700;
            font-size: 18px;
            padding-left: 8px;
        }

        .logo img {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            object-fit: cover;
        }

        .logo span {
            color: var(--primary);
        }

        .desktop-nav {
            display: flex;
            gap: 20px;
            align-items: center;
        }

        .desktop-nav a {
            position: relative;
            font-weight: 500;
            font-size: 14px;
            color: var(--muted);
            padding: 8px 4px;
            transition: color 0.3s ease;
        }

        .desktop-nav a:hover {
            color: var(--text);
        }

        .desktop-nav a.active {
            color: var(--text);
        }

        .desktop-nav a.active::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 5px;
            height: 5px;
            background: var(--primary);
            border-radius: 50%;
            box-shadow: 0 0 8px var(--primary), 0 0 12px var(--primary);
        }

        .cta-button {
            background: var(--primary);
            color: #fff !important;
            padding: 8px 20px !important;
            border-radius: 999px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .cta-button:hover {
            box-shadow: 0 0 15px rgba(79, 124, 255, 0.6);
            transform: translateY(-2px);
        }

        /* --- Mobile Navigation --- */
        #menu-toggle {
            display: none;
        }

        .mobile-nav {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(7, 6, 10, 0.9);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 2rem;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.4s ease, visibility 0.4s ease;
            z-index: 1100;
        }

        .mobile-nav.open {
            opacity: 1;
            visibility: visible;
        }

        .mobile-nav a {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--text);
        }

        .mobile-nav a.active {
            color: var(--primary);
        }

        /* --- Footer --- */
        footer {
            padding: 32px 28px;
            text-align: center;
            color: var(--muted);
            border-top: 1px solid var(--border-color);
            font-size: 13px;
            margin-top: 64px;
        }

        @media (max-width: 860px) {
            .desktop-nav {
                display: none;
            }

            #menu-toggle {
                display: block;
                background: none;
                border: 0;
                color: var(--text);
                font-size: 20px;
                cursor: pointer;
                z-index: 1300;
                position: fixed;
                top: 28px;
                right: 28px;
            }

            .header-container {
                justify-content: flex-start;
                top: 16px;
                left: 16px;
            }

            .navbar {
                padding: 6px 8px;
            }
        }
    </style>

    @yield('extra-styles')
</head>

<body>
    <header class="header-container">
        <div class="navbar">
            <a class="logo" href="{{ route('home') }}">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSn-mLqVUisgZmQ_I9xw8PEzAtgXSxbUM3pFw&s"
                    alt="Rohit Joshi Logo">
                <span>Rohit</span>
            </a>

            <nav class="desktop-nav" aria-label="Main navigation">
                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
                <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">About</a>
                <a href="{{ route('services.index') }}"
                    class="{{ request()->routeIs('services.*') ? 'active' : '' }}">Services</a>

                <a href="{{ route('blog.index') }}" class="{{ request()->routeIs('blog.*') ? 'active' : '' }}">Blog</a>
                <a href="{{ route('home') }}#gallery">Gallery</a>
                <a href="{{ route('home') }}#contact" class="cta-button">Contact</a>
            </nav>
        </div>
    </header>

    <!-- Mobile Menu Toggle -->
    <button id="menu-toggle" aria-label="Toggle menu"><i class="fas fa-bars"></i></button>

    <!-- Full-screen Mobile Nav -->
    <nav class="mobile-nav" id="mobile-nav" aria-label="Mobile navigation">
        <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
        <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">About</a>
        <a href="{{ route('services.index') }}"
            class="{{ request()->routeIs('services.*') ? 'active' : '' }}">Services</a>
        <a href="{{ route('home') }}#skills">Skills</a>
        <a href="{{ route('home') }}#projects">Projects</a>
        <a href="{{ route('blog.index') }}" class="{{ request()->routeIs('blog.*') ? 'active' : '' }}">Blog</a>
        <a href="{{ route('home') }}#gallery">Gallery</a>
        <a href="{{ route('home') }}#contact">Contact</a>
    </nav>

    <div class="app-wrapper">
        @yield('content')
    </div>

    <footer>
        &copy; {{ date('Y') }} Rohit Joshi • Laravel Developer • <a href="{{ route('home') }}#contact"
            style="color:var(--primary);font-weight:600">Get in Touch</a>
    </footer>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ duration: 700, once: true });

        const menuToggle = document.getElementById('menu-toggle');
        const mobileNav = document.getElementById('mobile-nav');
        const mobileNavLinks = mobileNav.querySelectorAll('a');

        menuToggle.addEventListener('click', () => {
            const isOpen = mobileNav.classList.toggle('open');
            menuToggle.innerHTML = isOpen ? '<i class="fas fa-times"></i>' : '<i class="fas fa-bars"></i>';
            document.body.style.overflow = isOpen ? 'hidden' : '';
        });

        // Close menu when a link is clicked
        mobileNavLinks.forEach(link => {
            link.addEventListener('click', () => {
                mobileNav.classList.remove('open');
                menuToggle.innerHTML = '<i class="fas fa-bars"></i>';
                document.body.style.overflow = '';
            });
        });
    </script>

    @yield('extra-scripts')
</body>

</html>