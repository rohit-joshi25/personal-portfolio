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

    .page-header {
        text-align: center;
        margin-bottom: 80px
    }

    .page-header h1 {
        font-size: 3rem;
        margin: 0 0 16px;
        font-weight: 700;
        letter-spacing: -1px
    }

    .page-header p {
        color: var(--muted);
        font-size: 18px;
        margin: 0;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto
    }

    .services-grid {
        display: grid;
        gap: 32px;
        grid-template-columns: repeat(3, 1fr);
        margin-bottom: 80px;
    }

    .service-card {
        background: var(--card);
        padding: 32px;
        border-radius: var(--radius);
        border: 1px solid rgba(255, 255, 255, 0.03);
        transition: all 0.3s;
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .service-card:hover {
        border-color: rgba(79, 124, 255, 0.2);
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(79, 124, 255, 0.1);
    }

    .service-icon {
        width: 64px;
        height: 64px;
        border-radius: 12px;
        background: rgba(79, 124, 255, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        color: var(--primary);
    }

    .service-card h3 {
        margin: 0;
        font-size: 1.3rem;
        font-weight: 700;
        color: var(--text)
    }

    .service-card p {
        margin: 0;
        color: var(--muted);
        font-size: 14px;
        line-height: 1.7
    }

    .service-features {
        list-style: none;
        margin: 8px 0;
        padding: 0;
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .service-features li {
        color: var(--muted);
        font-size: 13px;
        display: flex;
        gap: 8px;
        align-items: flex-start;
    }

    .service-features li:before {
        content: '✓';
        color: var(--primary);
        font-weight: 700;
        flex-shrink: 0;
    }

    .service-price {
        margin-top: auto;
        padding-top: 16px;
        border-top: 1px solid rgba(255, 255, 255, 0.05);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .service-price span {
        color: var(--primary);
        font-weight: 700;
        font-size: 1.2rem;
    }

    .cta-btn {
        background: rgba(79, 124, 255, 0.1);
        color: var(--primary);
        padding: 10px 16px;
        border-radius: 6px;
        border: 1px solid rgba(79, 124, 255, 0.2);
        font-weight: 600;
        font-size: 13px;
        cursor: pointer;
        transition: all 0.2s;
        text-align: center;
    }

    .cta-btn:hover {
        background: rgba(79, 124, 255, 0.2);
        border-color: rgba(79, 124, 255, 0.4);
    }

    .process-section {
        margin: 80px 0;
        background: linear-gradient(135deg, rgba(79, 124, 255, 0.05), rgba(0, 212, 255, 0.02));
        padding: 60px 40px;
        border-radius: var(--radius);
        border: 1px solid rgba(79, 124, 255, 0.1);
    }

    .process-section h2 {
        text-align: center;
        font-size: 2rem;
        margin: 0 0 60px;
        color: var(--primary);
    }

    .process-steps {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 32px;
    }

    .process-step {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
    }

    .step-number {
        width: 56px;
        height: 56px;
        border-radius: 50%;
        background: rgba(79, 124, 255, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        font-weight: 700;
        color: var(--primary);
        margin-bottom: 16px;
    }

    .process-step h3 {
        margin: 0 0 12px;
        font-weight: 700;
        color: var(--text)
    }

    .process-step p {
        margin: 0;
        color: var(--muted);
        font-size: 14px;
        line-height: 1.6
    }

    .faq-section {
        margin: 80px 0
    }

    .faq-section h2 {
        text-align: center;
        font-size: 2rem;
        margin: 0 0 60px;
        color: var(--primary);
    }

    .faq-grid {
        display: grid;
        gap: 20px;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    }

    .faq-item {
        background: var(--card);
        padding: 24px;
        border-radius: var(--radius);
        border: 1px solid rgba(255, 255, 255, 0.03);
        cursor: pointer;
        transition: all 0.2s;
    }

    .faq-item:hover {
        border-color: rgba(79, 124, 255, 0.2)
    }

    .faq-question {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-weight: 600;
        color: var(--text);
        gap: 16px;
    }

    .faq-icon {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        background: rgba(79, 124, 255, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary);
        transition: transform 0.2s;
        flex-shrink: 0;
    }

    .faq-answer {
        display: none;
        color: var(--muted);
        margin-top: 16px;
        font-size: 14px;
        line-height: 1.7;
    }

    .faq-item.active .faq-answer {
        display: block
    }

    .faq-item.active .faq-icon {
        transform: rotate(180deg)
    }

    .cta-section {
        text-align: center;
        margin: 80px 0;
        padding: 60px 40px;
        background: linear-gradient(135deg, rgba(79, 124, 255, 0.1), rgba(0, 212, 255, 0.05));
        border-radius: var(--radius);
        border: 1px solid rgba(79, 124, 255, 0.2);
    }

    .cta-section h2 {
        margin: 0 0 16px;
        font-size: 2rem;
        color: var(--text)
    }

    .cta-section p {
        margin: 0 0 32px;
        color: var(--muted);
        font-size: 16px;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto
    }

    .btn-primary {
        background: var(--primary);
        color: #fff;
        padding: 14px 32px;
        border-radius: 8px;
        border: 0;
        font-weight: 600;
        cursor: pointer;
        font-size: 14px;
        transition: all 0.3s;
        display: inline-block;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 24px rgba(79, 124, 255, 0.4);
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
        margin-bottom: 40px;
    }

    .back-btn:hover {
        background: rgba(79, 124, 255, 0.2)
    }

    footer {
        padding: 32px 28px;
        text-align: center;
        color: var(--muted);
        border-top: 1px solid rgba(255, 255, 255, 0.03);
        margin-top: 60px;
        font-size: 13px
    }

    @media (max-width: 992px) {
        .services-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media(max-width:768px) {
        .page-header h1 {
            font-size: 2rem
        }

        nav {
            display: none
        }

        .services-grid {
            grid-template-columns: 1fr
        }

        .process-steps {
            grid-template-columns: 1fr
        }

        .faq-grid {
            grid-template-columns: 1fr
        }
    }
</style>
@endsection

@section('content')

</head>

<body>
    <main>
        <!-- Page Header -->
        <div class="page-header" data-aos="fade-down">
            <h1>My Services</h1>
            <p>I offer comprehensive web development solutions tailored to your business needs. From custom applications
                to API development, I've got you covered.</p>
        </div>

        <!-- Services Grid -->
        <div class="services-grid">

            <!-- Service 1: Web Development -->
            <div class="service-card" data-aos="fade-up">
                <div class="service-icon">
                    <i class="fas fa-code"></i>
                </div>
                <h3>Web Development</h3>
                <p>Custom web applications built with modern technologies and best practices.</p>
                <ul class="service-features">
                    <li>Responsive Design</li>
                    <li>Performance Optimized</li>
                    <li>SEO Friendly</li>
                    <li>Cross-browser Compatible</li>
                </ul>
                <div class="service-price">
                    <span>Custom Quote</span>
                    <button class="cta-btn">Inquire</button>
                </div>
            </div>

            <!-- Service 2: Laravel Development -->
            <div class="service-card" data-aos="fade-up" data-aos-delay="100">
                <div class="service-icon">
                    <i class="fab fa-laravel"></i>
                </div>
                <h3>Laravel Development</h3>
                <p>Scalable, secure, and maintainable Laravel applications for your business.</p>
                <ul class="service-features">
                    <li>Full-stack Development</li>
                    <li>Database Design</li>
                    <li>Authentication & Authorization</li>
                    <li>Testing & Quality Assurance</li>
                </ul>
                <div class="service-price">
                    <span>Custom Quote</span>
                    <button class="cta-btn">Inquire</button>
                </div>
            </div>

            <!-- Service 3: API Development -->
            <div class="service-card" data-aos="fade-up" data-aos-delay="200">
                <div class="service-icon">
                    <i class="fas fa-plug"></i>
                </div>
                <h3>API Development</h3>
                <p>RESTful and modern APIs designed for scalability and security.</p>
                <ul class="service-features">
                    <li>REST API Design</li>
                    <li>GraphQL Implementation</li>
                    <li>Authentication (JWT, OAuth)</li>
                    <li>API Documentation</li>
                </ul>
                <div class="service-price">
                    <span>Custom Quote</span>
                    <button class="cta-btn">Inquire</button>
                </div>
            </div>

            <!-- Service 4: Backend Solutions -->
            <div class="service-card" data-aos="fade-up" data-aos-delay="300">
                <div class="service-icon">
                    <i class="fas fa-database"></i>
                </div>
                <h3>Backend Solutions</h3>
                <p>Robust backend systems optimized for performance and reliability.</p>
                <ul class="service-features">
                    <li>Server Architecture Design</li>
                    <li>Database Optimization</li>
                    <li>Caching Strategies</li>
                    <li>Scalability Planning</li>
                </ul>
                <div class="service-price">
                    <span>Custom Quote</span>
                    <button class="cta-btn">Inquire</button>
                </div>
            </div>

            <!-- Service 5: Code Refactoring -->
            <div class="service-card" data-aos="fade-up" data-aos-delay="400">
                <div class="service-icon">
                    <i class="fas fa-wrench"></i>
                </div>
                <h3>Code Refactoring</h3>
                <p>Improve your codebase quality, performance, and maintainability.</p>
                <ul class="service-features">
                    <li>Code Quality Assessment</li>
                    <li>Performance Optimization</li>
                    <li>Technical Debt Reduction</li>
                    <li>Best Practices Implementation</li>
                </ul>
                <div class="service-price">
                    <span>Custom Quote</span>
                    <button class="cta-btn">Inquire</button>
                </div>
            </div>

            <!-- Service 6: Consultation -->
            <div class="service-card" data-aos="fade-up" data-aos-delay="500">
                <div class="service-icon">
                    <i class="fas fa-comments"></i>
                </div>
                <h3>Technical Consultation</h3>
                <p>Expert guidance on architecture, technology selection, and development strategy.</p>
                <ul class="service-features">
                    <li>Architecture Planning</li>
                    <li>Technology Stack Advice</li>
                    <li>Scalability Consulting</li>
                    <li>Security Reviews</li>
                </ul>
                <div class="service-price">
                    <span>$10/hour</span>
                    <button class="cta-btn">Book Now</button>
                </div>
            </div>

        </div>
        <!-- Process Section -->
        <div class="process-section" data-aos="fade-up">
            <h2>How I Work</h2>
            <div class="process-steps">
                <div class="process-step">
                    <div class="step-number">1</div>
                    <h3>Discovery</h3>
                    <p>Understand your project requirements, goals, and constraints in detail.</p>
                </div>
                <div class="process-step">
                    <div class="step-number">2</div>
                    <h3>Planning</h3>
                    <p>Create a detailed plan with timeline, deliverables, and technical approach.</p>
                </div>
                <div class="process-step">
                    <div class="step-number">3</div>
                    <h3>Development</h3>
                    <p>Build your project using agile methodology with regular updates and demos.</p>
                </div>
                <div class="process-step">
                    <div class="step-number">4</div>
                    <h3>Testing</h3>
                    <p>Comprehensive testing to ensure quality, performance, and security.</p>
                </div>
                <div class="process-step">
                    <div class="step-number">5</div>
                    <h3>Deployment</h3>
                    <p>Launch your project with zero downtime and proper monitoring setup.</p>
                </div>
                <div class="process-step">
                    <div class="step-number">6</div>
                    <h3>Support</h3>
                    <p>Ongoing support and maintenance to keep your application running smoothly.</p>
                </div>
            </div>
        </div>

        <!-- FAQ Section -->
        <div class="faq-section" data-aos="fade-up">
            <h2>Frequently Asked Questions</h2>
            <div class="faq-grid">

                <div class="faq-item">
                    <div class="faq-question">
                        <span>What's your minimum project budget?</span>
                        <div class="faq-icon"><i class="fas fa-chevron-down"></i></div>
                    </div>
                    <div class="faq-answer">
                        There's no strict minimum, but I typically work on projects starting from $1,000. For smaller
                        projects, I'd recommend hourly consulting. Let's discuss your needs!
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">
                        <span>How long does a typical project take?</span>
                        <div class="faq-icon"><i class="fas fa-chevron-down"></i></div>
                    </div>
                    <div class="faq-answer">
                        Project duration varies based on complexity and scope. Simple websites take 2-4 weeks, while
                        larger applications can take 2-6 months. I'll provide a timeline during the planning phase.
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">
                        <span>Do you offer maintenance and support?</span>
                        <div class="faq-icon"><i class="fas fa-chevron-down"></i></div>
                    </div>
                    <div class="faq-answer">
                        Yes! I offer flexible support packages after project completion. This includes bug fixes,
                        security updates, feature enhancements, and performance optimization.
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">
                        <span>What technologies do you work with?</span>
                        <div class="faq-icon"><i class="fas fa-chevron-down"></i></div>
                    </div>
                    <div class="faq-answer">
                        I specialize in PHP/Laravel for backend, MySQL for databases, and modern JavaScript frameworks.
                        I'm also comfortable with other technologies depending on project requirements.
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">
                        <span>Do you sign NDAs?</span>
                        <div class="faq-icon"><i class="fas fa-chevron-down"></i></div>
                    </div>
                    <div class="faq-answer">
                        Absolutely! I'm happy to sign NDAs to protect your intellectual property and business
                        confidentiality. Your privacy is important to me.
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">
                        <span>Can you work with existing code?</span>
                        <div class="faq-icon"><i class="fas fa-chevron-down"></i></div>
                    </div>
                    <div class="faq-answer">
                        Yes! I regularly work on legacy projects, debugging, refactoring, and adding new features. I
                        assess code quality and discuss improvement strategies with you.
                    </div>
                </div>

            </div>
        </div>

        <!-- CTA Section -->
        <div class="cta-section" data-aos="fade-up">
            <h2>Ready to Get Started?</h2>
            <p>Let's discuss your project requirements and find the perfect solution for your business. I'm available
                for consultations and project inquiries.</p>
            <a href="{{ route('home') }}#contact" class="btn-primary">
                <i class="fas fa-envelope" style="margin-right:8px"></i> Get in Touch
            </a>
        </div>

    </main>

    @endsection

    @section('extra-scripts')

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 700,
            once: true
        });

        // FAQ Toggle
        const faqItems = document.querySelectorAll('.faq-item');
        faqItems.forEach(item => {
            item.addEventListener('click', () => {
                const isActive = item.classList.contains('active');

                // Close all items
                faqItems.forEach(i => i.classList.remove('active'));

                // Open clicked item if it wasn't active
                if (!isActive) {
                    item.classList.add('active');
                }
            });
        });

        // Service Button Click Handler
        const cta_buttons = document.querySelectorAll('.cta-btn');
        cta_buttons.forEach(btn => {
            btn.addEventListener('click', () => {
                const service = btn.closest('.service-card').querySelector('h3').textContent;
                window.location.href = `{{ route('home') }}#contact?service=${encodeURIComponent(service)}`;
            });
        });
    </script>
    @endsection