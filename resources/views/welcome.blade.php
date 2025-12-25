<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Just Travel - AI Powered Journeys</title>
    @include('partials.clarity')

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <script>
        (function () {
            const savedTheme = localStorage.getItem('theme') || 'light';
            document.documentElement.setAttribute('data-theme', savedTheme);
        })();
    </script>

    <style>
        :root {
            --primary: #00cec9;
            --primary-dark: #00b894;
            --secondary: #0984e3;
            --dark: #2d3436;
            --light: #dfe6e9;
            --white: #ffffff;
            --bg-page: #f7f9fc;
            --bg-card: #ffffff;
            --bg-footer: linear-gradient(to right, #1a1c20, #2d3436);
            --text-main: #2d3436;
            --text-muted: #636e72;
            --border-color: rgba(0, 0, 0, 0.05);
            --overlay-dark: rgba(0, 0, 0, 0.4);
            --gradient-hero: linear-gradient(135deg, #0984e3 0%, #00cec9 100%);
            --glass: rgba(255, 255, 255, 0.1);
            --transition: all 0.3s ease;
        }

        [data-theme="dark"] {
            --bg-page: #0f172a;
            --bg-card: #1e293b;
            --bg-footer: linear-gradient(to right, #020617, #0f172a);
            --white: #1e293b;
            --text-main: #f1f5f9;
            --text-muted: #94a3b8;
            --dark: #f8fafc;
            --light: #334155;
            --border-color: rgba(255, 255, 255, 0.1);
            --glass: rgba(0, 0, 0, 0.3);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Outfit', sans-serif;
        }

        body {
            background-color: var(--bg-page);
            color: var(--text-main);
            overflow-x: hidden;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        /* Utility */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .btn {
            display: inline-block;
            padding: 12px 30px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: var(--transition);
            cursor: pointer;
            border: none;
        }

        .btn-primary {
            background: var(--gradient-hero);
            color: var(--white);
            box-shadow: 0 4px 15px rgba(9, 132, 227, 0.4);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(9, 132, 227, 0.6);
        }

        .btn-outline {
            border: 2px solid var(--white);
            color: var(--white);
            background: transparent;
        }

        .btn-outline:hover {
            background: var(--white);
            color: var(--secondary);
        }

        /* App Download Banner */
        .app-banner {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background: var(--gradient-hero);
            padding: 12px 0;
            z-index: 1001;
            display: none;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .app-banner.show {
            display: block;
        }

        .app-banner.hide {
            transform: translateY(-100%);
        }

        .app-banner-content {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
            position: relative;
        }

        .app-banner-logo {
            height: 35px;
            width: auto;
            border-radius: 6px;
            object-fit: contain;
        }

        .app-banner-text {
            color: var(--white);
            font-size: 0.95rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .app-banner-link {
            color: var(--white);
            text-decoration: none;
            font-weight: 600;
            padding: 6px 16px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            transition: var(--transition);
            border: 1px solid rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(8px);
        }

        .app-banner-link:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-1px);
        }

        .app-banner-close {
            position: absolute;
            right: 2rem;
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: var(--white);
            width: 28px;
            height: 28px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: var(--transition);
            backdrop-filter: blur(8px);
        }

        .app-banner-close:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: scale(1.1);
        }

        @media (max-width: 768px) {
            .app-banner-text {
                font-size: 0.85rem;
            }

            .app-banner-link {
                padding: 5px 12px;
                font-size: 0.85rem;
            }

            .app-banner-close {
                right: 1rem;
            }

            .app-banner-content {
                padding: 0 3rem 0 1rem;
            }
        }

        /* Header */
        header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            padding: 20px 0;
            z-index: 1000;
            transition: var(--transition);
        }

        body.has-banner header {
            top: 60px;
        }

        /* Floating WhatsApp Button */
        .whatsapp-float {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 60px;
            height: 60px;
            background: #25D366;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 20px rgba(37, 211, 102, 0.4);
            z-index: 999;
            transition: var(--transition);
            text-decoration: none;
            color: var(--white);
            font-size: 1.8rem;
            animation: pulse-whatsapp 2s infinite;
        }

        .whatsapp-float:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 30px rgba(37, 211, 102, 0.6);
        }

        .whatsapp-float:active {
            transform: scale(0.95);
        }

        @keyframes pulse-whatsapp {
            0%, 100% {
                box-shadow: 0 4px 20px rgba(37, 211, 102, 0.4);
            }
            50% {
                box-shadow: 0 4px 30px rgba(37, 211, 102, 0.6), 0 0 0 10px rgba(37, 211, 102, 0.1);
            }
        }

        @media (max-width: 768px) {
            .whatsapp-float {
                bottom: 20px;
                right: 20px;
                width: 55px;
                height: 55px;
                font-size: 1.6rem;
            }
        }

        header.scrolled {
            background: var(--bg-card);
            padding: 10px 0;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            border-bottom: 1px solid var(--border-color);
        }

        header.scrolled .logo,
        header.scrolled .nav-links a {
            color: var(--text-main);
        }

        header.scrolled .theme-toggle-btn {
            background: var(--bg-page);
            color: var(--text-main);
            border-color: var(--border-color);
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--white);
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-decoration: none;
        }

        .nav-links {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .nav-links a {
            text-decoration: none;
            color: var(--white);
            font-weight: 600;
            transition: var(--transition);
            padding: 0.6rem 1.4rem;
            border-radius: 50px;
            font-size: 0.9rem;
            border: 1px solid rgba(255, 255, 255, 0.1);
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(8px);
        }

        [data-theme="dark"] .nav-links a {
            background: rgba(255, 255, 255, 0.03);
            border-color: rgba(255, 255, 255, 0.08);
            color: rgba(255, 255, 255, 0.9);
        }

        .nav-links a:hover {
            background: var(--gradient-hero);
            color: white !important;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 206, 201, 0.4);
            border-color: transparent;
        }

        header.scrolled .nav-links a {
            color: var(--text-main);
            background: rgba(0, 0, 0, 0.03);
            border-color: rgba(0, 0, 0, 0.05);
        }

        [data-theme="dark"] header.scrolled .nav-links a {
            color: var(--text-main);
            background: rgba(255, 255, 255, 0.05);
            border-color: rgba(255, 255, 255, 0.1);
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .btn-get-started {
            background: var(--white);
            color: var(--secondary);
            padding: 10px 25px;
            border-radius: 50px;
            font-weight: 700;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .btn-get-started::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: var(--gradient-hero);
            z-index: -1;
            transition: transform 0.4s ease;
            transform: scaleX(0);
            transform-origin: right;
        }

        .btn-get-started:hover::before {
            transform: scaleX(1);
            transform-origin: left;
        }

        .btn-get-started:hover {
            color: var(--white);
            box-shadow: 0 4px 20px rgba(0, 206, 201, 0.4);
        }

        .theme-toggle-btn,
        .lang-toggle-btn {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: var(--white);
            width: 45px;
            height: 45px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: var(--transition);
            font-size: 1.2rem;
            position: relative;
        }

        .lang-toggle-btn:hover,
        .theme-toggle-btn:hover {
            background: var(--gradient-hero);
            border-color: transparent;
            transform: scale(1.1);
        }

        /* Language Dropdown */
        .lang-dropdown {
            position: absolute;
            top: calc(100% + 15px);
            right: 0;
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 20px;
            width: 180px;
            padding: 10px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            opacity: 0;
            visibility: hidden;
            transform: translateY(10px);
            transition: var(--transition);
            z-index: 1001;
            backdrop-filter: blur(15px);
        }

        .lang-dropdown.active {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .lang-option {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 15px;
            border-radius: 12px;
            color: var(--text-main);
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 600;
            transition: var(--transition);
            cursor: pointer;
        }

        .lang-option:hover {
            background: rgba(0, 206, 201, 0.1);
            color: var(--primary);
            transform: translateX(5px);
        }

        [data-theme="dark"] .lang-dropdown {
            background: rgba(30, 41, 59, 0.8);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.4);
        }

        header.scrolled .lang-toggle-btn {
            background: var(--bg-page);
            color: var(--text-main);
            border-color: var(--border-color);
        }

        [data-theme="dark"] .theme-toggle-btn {
            background: rgba(30, 41, 59, 0.6);
            border-color: rgba(255, 255, 255, 0.1);
        }

        /* Hero Section */
        .hero {
            position: relative;
            height: 100vh;
            min-height: 700px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            /* Updated Hero Image */
            background: url('https://images.unsplash.com/photo-1502791451862-7bd8c1df43a7?q=80&w=2664&auto=format&fit=crop') no-repeat center center/cover;
            color: var(--white);
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: var(--overlay-dark);
            /* Dark overlay */
            z-index: 1;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            max-width: 800px;
            padding: 2rem;
        }

        .hero-badge {
            display: inline-block;
            background: rgba(0, 206, 201, 0.1);
            backdrop-filter: blur(10px);
            padding: 8px 16px;
            border-radius: 20px;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
            font-weight: 700;
            color: var(--primary);
            border: 1px solid rgba(0, 206, 201, 0.3);
            letter-spacing: 1px;
            text-transform: uppercase;
            animation: fadeInDown 0.8s ease-out;
        }

        .hero-title {
            font-size: 4rem;
            font-weight: 800;
            line-height: 1.1;
            margin-bottom: 1.5rem;
            color: #ffffff;
            animation: fadeInUp 1s ease-out 0.2s backwards;
        }

        .text-accent {
            background: linear-gradient(to right, #00cec9, #0984e3);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-shadow: 0 10px 20px rgba(0, 206, 201, 0.2);
        }

        .text-primary {
            color: var(--primary) !important;
        }

        .text-white {
            color: #ffffff !important;
        }

        .hero-text {
            font-size: 1.25rem;
            line-height: 1.6;
            margin-bottom: 2.5rem;
            color: rgba(255, 255, 255, 0.85);
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
            animation: fadeInUp 1s ease-out 0.4s backwards;
        }

        .hero-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            animation: fadeInUp 1s ease-out 0.6s backwards;
        }

        /* Animations */
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Features Section */
        .features {
            padding: 6rem 0;
            background: var(--bg-card);
        }

        .section-header {
            text-align: center;
            margin-bottom: 4rem;
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 1rem;
        }

        .section-subtitle {
            font-size: 1.1rem;
            color: var(--text-muted);
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 3rem;
        }

        .feature-card {
            background: var(--bg-page);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            transition: var(--transition);
            border: 1px solid var(--border-color);
            display: flex;
            flex-direction: column;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .feature-image {
            height: 250px;
            width: 100%;
            object-fit: cover;
            transition: var(--transition);
        }

        .feature-card:hover .feature-image {
            transform: scale(1.05);
        }

        .feature-content {
            padding: 2rem;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .feature-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: var(--secondary);
        }

        .feature-desc {
            color: #636e72;
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }

        .feature-link {
            margin-top: auto;
            color: var(--primary-dark);
            text-decoration: none;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .feature-link:hover {
            text-decoration: underline;
        }

        /* Modern Grid Layout for "Showcase" */
        .showcase {
            padding: 6rem 0;
            background: var(--bg-page);
        }

        .showcase-row {
            display: flex;
            align-items: center;
            gap: 4rem;
            margin-bottom: 6rem;
        }

        .showcase-row:last-child {
            margin-bottom: 0;
        }

        .showcase-row:nth-child(even) {
            flex-direction: row-reverse;
        }

        .showcase-img-wrapper {
            flex: 1;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.1);
        }

        .showcase-img {
            width: 100%;
            height: 350px;
            object-fit: cover;
            display: block;
            transition: transform 0.6s ease;
        }

        .showcase-img-wrapper:hover .showcase-img {
            transform: scale(1.05);
        }

        .showcase-text {
            flex: 1;
        }

        .showcase-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            background: var(--gradient-hero);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .showcase-p {
            font-size: 1.1rem;
            line-height: 1.8;
            color: #636e72;
            margin-bottom: 2rem;
        }

        /* Modern Footer */
        footer {
            background: var(--bg-footer);
            color: #bdc3c7;
            padding: 5rem 0 2rem;
            position: relative;
            overflow: hidden;
            transition: var(--transition);
        }

        footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--gradient-hero);
        }

        .footer-content {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 4rem;
            margin-bottom: 4rem;
        }

        .footer-col-right {
            text-align: right;
        }

        .footer-logo {
            font-size: 2rem;
            font-weight: 800;
            color: var(--white);
            margin-bottom: 1.5rem;
            display: inline-block;
            background: var(--gradient-hero);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .footer-desc {
            font-size: 1rem;
            line-height: 1.7;
            margin-bottom: 2rem;
            max-width: 300px;
        }

        .footer-col h4 {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            color: var(--white);
            letter-spacing: 0.5px;
        }

        .footer-col ul {
            list-style: none;
        }

        .footer-col ul li {
            margin-bottom: 1rem;
        }

        .footer-col ul li a {
            color: #bdc3c7;
            text-decoration: none;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
        }

        .footer-col ul li a:hover {
            color: var(--primary);
            transform: translateX(5px);
        }

        .social-links {
            display: flex;
            gap: 1rem;
        }

        .social-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.05);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            text-decoration: none;
            transition: var(--transition);
        }

        .social-icon:hover {
            background: var(--primary);
            transform: translateY(-3px);
        }

        .copyright {
            text-align: center;
            padding-top: 2rem;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            font-size: 0.9rem;
            color: #636e72;
        }

        @media (max-width: 900px) {
            .hero-title {
                font-size: 3rem;
            }

            .showcase-row {
                flex-direction: column;
            }

            .showcase-row:nth-child(even) {
                flex-direction: column;
            }

            .nav-links {
                display: none;
            }

            /* Hide nav on mobile for simplicity */

            .footer-content {
                grid-template-columns: 1fr;
                gap: 2rem;
                text-align: center;
            }

            .footer-col-right {
                text-align: center;
            }

            .footer-desc {
                margin: 0 auto 2rem;
            }

            .social-links {
                justify-content: center;
            }

            .footer-logo {
                display: block;
            }
        }
    </style>
</head>

<body class="antialiased">

    <!-- App Download Banner -->
    <div class="app-banner" id="appBanner">
        <div class="app-banner-content">
            <img src="{{ asset('images/logo.jpg') }}" alt="Just Travel" class="app-banner-logo">
            <div class="app-banner-text">
                <i class="fa-solid fa-mobile-screen-button"></i>
                <span data-t="banner_text">Download our app for the best travel experience!</span>
            </div>
            <a href="{{ route('mobile.app') }}" class="app-banner-link" data-t="banner_link">Get the App</a>
            <button class="app-banner-close" id="closeBanner" aria-label="Close banner">
                <i class="fa-solid fa-times"></i>
            </button>
        </div>
    </div>

    <header>
        <div class="container">
            <nav>
                <a href="#" class="logo">
                    <img src="{{ asset('images/logo.png') }}" alt="Just Travel"
                        style="height: 50px; border-radius: 8px;">
                </a>
                <div class="nav-links">
                    <a href="{{ url('/') }}" data-t="nav_home">Home</a>
                    <a href="{{ route('home') }}" data-t="nav_flights">Flights</a>
                    <a href="{{ route('ai.chat') }}" data-t="nav_ai">AI Planner</a>
                </div>

                <div class="nav-actions">
                    <div style="position: relative;">
                        <button id="langToggle" class="lang-toggle-btn" title="Choose Language">
                            <i class="fa-solid fa-globe"></i>
                        </button>
                        <div id="langDropdown" class="lang-dropdown">
                            <div class="lang-option" onclick="changeLang('en')">
                                <img src="https://flagcdn.com/w20/gb.png" width="20" alt="EN"> English
                            </div>
                            <div class="lang-option" onclick="changeLang('ar')">
                                <img src="https://flagcdn.com/w20/ae.png" width="20" alt="AR"> العربية
                            </div>
                            <div class="lang-option" onclick="changeLang('ru')">
                                <img src="https://flagcdn.com/w20/ru.png" width="20" alt="RU"> Russian
                            </div>
                            <div class="lang-option" onclick="changeLang('zh')">
                                <img src="https://flagcdn.com/w20/cn.png" width="20" alt="ZH"> Chinese
                            </div>
                            <div class="lang-option" onclick="changeLang('fr')">
                                <img src="https://flagcdn.com/w20/fr.png" width="20" alt="FR"> French
                            </div>
                        </div>
                    </div>
                    <button id="themeToggle" class="theme-toggle-btn" title="Toggle Dark/Light Mode">
                        <i class="fa-solid fa-moon"></i>
                    </button>
                    @if (Route::has('login'))
                        @if(Auth::guard('flutter_web')->check())
                            <a href="{{ url('/home') }}" class="btn btn-get-started">Get Started</a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-get-started">Get Started</a>
                        @endif
                    @else
                        {{-- Fallback for Voyager Admin if standard auth is missing --}}
                        <a href="{{ url('/admin/login') }}" class="btn btn-get-started" data-t="btn_get_started">Get
                            Started</a>
                    @endif
                </div>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container hero-content">
            <span class="hero-badge" data-t="hero_badge">AI-Powered Travel</span>
            <h1 class="hero-title">
                <span data-t="hero_title_p1">Explore the</span> <span class="text-primary"
                    data-t="hero_title_p2">World</span>
                <br>
                <span class="text-accent" data-t="hero_title_p3">Intelligently</span>
            </h1>
            <p class="hero-text" data-t="hero_desc_new">Plan your perfect trip with our advanced AI travel assistant.
                Flights, hotels, and experiences curated just for you.</p>
            <div class="hero-buttons">
                @if (Route::has('login'))
                    <a href="{{ route('login') }}" class="btn btn-primary" data-t="btn_start">Start Your Journey</a>
                @else
                    <a href="{{ route('home') }}" class="btn btn-primary" data-t="btn_start">Start Your Journey</a>
                @endif
                <a href="#features" class="btn btn-outline" data-t="btn_learn">Learn More</a>
            </div>
        </div>
    </section>

    <!-- Showcase Section -->
    <section class="showcase" id="features">
        <div class="container">

            <!-- AI Planner -->
            <div class="showcase-row">
                <div class="showcase-img-wrapper">
                    <video src="{{ asset('images/AI.mp4') }}" class="showcase-img" autoplay loop muted playsinline></video>
                </div>
                <div class="showcase-text">
                    <h2 class="showcase-title" data-t="f1_title">Your Personal AI Guide</h2>
                    <p class="showcase-p" data-t="f1_desc">
                        Meet <strong>JustMine</strong>, your smart travel companion using Gemini AI.
                        Simply chat to discover hidden gems, get weather-based suggestions, and build custom itineraries
                        in seconds.
                    </p>
                    <a href="{{ route('ai.chat') }}" class="btn btn-primary" data-t="btn_ai">Try AI Chat</a>
                </div>
            </div>

            <!-- Flights & Data -->
            <div class="showcase-row">
                <div class="showcase-img-wrapper">
                    <img src="{{ asset('images/section2.jpg') }}" alt="Flights" class="showcase-img">
                </div>
                <div class="showcase-text">
                    <h2 class="showcase-title" data-t="f2_title">Smart Flight Search</h2>
                    <p class="showcase-p" data-t="f2_desc">
                        Access real-time data for flights, airports, and car rentals.
                        Our comprehensive search engine connects you to thousands of destinations with the best rates
                        and easiest booking flow.
                    </p>
                    <a href="{{ route('home') }}" class="btn btn-primary" data-t="btn_flights">Browse Flights</a>
                </div>
            </div>

            <!-- Feedback & Community (App) -->
            <div class="showcase-row">
                <div class="showcase-img-wrapper">
                    <img src="{{ asset('images/section3.jpg') }}" alt="Mobile App" class="showcase-img">
                </div>
                <div class="showcase-text">
                    <h2 class="showcase-title" data-t="f3_title">Seamless Mobile Experience</h2>
                    <p class="showcase-p" data-t="f3_desc">
                        Take Just Travel with you. Our mobile-first design ensures you can manage your bookings,
                        give feedback, and update your profile on the go.
                    </p>
                    <a href="{{ route('mobile.app') }}" class="btn btn-primary" data-t="btn_app">Get the App</a>
                </div>
            </div>

        </div>
    </section>

    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-col">
                    <a href="{{ url('/') }}" class="footer-logo">Just Travel.</a>
                    <p class="footer-desc">
                        Revolutionizing travel planning with the power of Artificial Intelligence.
                        Your journey starts with a simple conversation.
                    </p>
                    <div class="social-links">
                        <a href="https://www.facebook.com/share/1A972y5gPs/" target="_blank" class="social-icon">
                            <i class="fa-brands fa-facebook-f"></i>
                        </a>
                        <a href="https://www.instagram.com/just_travel79?igsh=aTBwYmE3NjIydjJx&utm_source=qr"
                            target="_blank" class="social-icon">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                        <a href="https://www.tiktok.com/@just.travel64?_r=1&_t=ZS-92IN2aGJYNI" target="_blank"
                            class="social-icon">
                            <i class="fa-brands fa-tiktok"></i>
                        </a>
                    </div>
                </div>
                <div class="footer-col footer-col-right">
                    <h4 data-t="footer_legal">Legal</h4>
                    <ul>
                        <li><a href="{{ route('privacy') }}" data-t="footer_privacy">Privacy Policy</a></li>
                        <li><a href="{{ route('contact') }}" data-t="footer_contact">Contact Us</a></li>
                        <li><a href="{{ route('terms') }}" data-t="footer_terms">Terms of Service</a></li>
                    </ul>
                </div>
            </div>
            <div class="copyright">
                &copy; {{ date('Y') }} Just Travel Inc. All rights reserved.
            </div>
        </div>
    </footer>

    <script>
        // App Banner Functionality
        (function() {
            const appBanner = document.getElementById('appBanner');
            const closeBannerBtn = document.getElementById('closeBanner');
            const bannerDismissed = localStorage.getItem('appBannerDismissed');

            if (!bannerDismissed && appBanner) {
                appBanner.classList.add('show');
                document.body.classList.add('has-banner');
            }

            if (closeBannerBtn) {
                closeBannerBtn.addEventListener('click', function() {
                    appBanner.classList.add('hide');
                    setTimeout(function() {
                        appBanner.classList.remove('show');
                        document.body.classList.remove('has-banner');
                    }, 300);
                    localStorage.setItem('appBannerDismissed', 'true');
                });
            }
        })();

        const themeToggle = document.getElementById('themeToggle');
        const langToggle = document.getElementById('langToggle');
        const langDropdown = document.getElementById('langDropdown');
        const sunIcon = '<i class="fa-solid fa-sun"></i>';
        const moonIcon = '<i class="fa-solid fa-moon"></i>';

        // Sound Synthesis for interaction
        function playClickSound() {
            const context = new (window.AudioContext || window.webkitAudioContext)();
            const oscillator = context.createOscillator();
            const gain = context.createGain();

            oscillator.type = 'sine';
            oscillator.frequency.setValueAtTime(800, context.currentTime);
            oscillator.frequency.exponentialRampToValueAtTime(100, context.currentTime + 0.1);

            gain.gain.setValueAtTime(0.3, context.currentTime);
            gain.gain.exponentialRampToValueAtTime(0.01, context.currentTime + 0.1);

            oscillator.connect(gain);
            gain.connect(context.destination);

            oscillator.start();
            oscillator.stop(context.currentTime + 0.1);
        }

        // Check for saved theme
        const savedTheme = localStorage.getItem('theme') || 'light';
        document.documentElement.setAttribute('data-theme', savedTheme);
        themeToggle.innerHTML = savedTheme === 'dark' ? sunIcon : moonIcon;

        themeToggle.addEventListener('click', () => {
            playClickSound();
            const currentTheme = document.documentElement.getAttribute('data-theme');
            const newTheme = currentTheme === 'light' ? 'dark' : 'light';

            document.documentElement.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);

            // Update icon
            themeToggle.innerHTML = newTheme === 'dark' ? sunIcon : moonIcon;

            // Subtle pulse animation
            themeToggle.classList.add('pulse');
            setTimeout(() => themeToggle.classList.remove('pulse'), 500);
        });

        const langDictionary = {
            en: {
                btn_get_started: "Get Started",
                hero_accent: "Elevate Your Travel Experience",
                hero_title: 'Your Journey Starts with <span class="hero-accent">Artificial Intelligence</span>',
                hero_desc: "Revolutionizing travel planning with the power of Artificial Intelligence. Your journey starts with a simple conversation.",
                btn_start_journey: "Start Your Journey",
                btn_learn_more: "Learn More",
                f1_title: "Your Personal AI Guide",
                f1_desc: "Meet <strong>JustMine</strong>, your smart travel companion using Gemini AI. Simply chat to discover hidden gems, get weather-based suggestions, and build custom itineraries in seconds.",
                btn_ai: "Try AI Chat",
                f2_title: "Smart Flight Search",
                f2_desc: "Access real-time data for flights, airports, and car rentals. Our comprehensive search engine connects you to thousands of destinations with the best rates and easiest booking flow.",
                btn_flights: "Browse Flights",
                f3_title: "Seamless Mobile Experience",
                f3_desc: "Take Just Travel with you. Our mobile-first design ensures you can manage bookings and profile on the go.",
                btn_app: "Get the App",
                banner_text: "Download our app for the best travel experience!",
                banner_link: "Get the App",
                footer_legal: "Legal",
                footer_privacy: "Privacy Policy",
                footer_contact: "Contact Us",
                footer_terms: "Terms of Service"
            },
            ar: {
                nav_home: "الرئيسية",
                nav_flights: "الرحلات",
                nav_ai: "مخطط الذكاء الاصطناعي",
                btn_get_started: "ابدأ الآن",
                hero_badge: "سفر مدعوم بالذكاء الاصطناعي",
                hero_title_p1: "استكشف",
                hero_title_p2: "العالم",
                hero_title_p3: "بذكاء",
                hero_desc_new: "خطط لرحلتك المثالية مع مساعد السفر المتقدم بالذكاء الاصطناعي. رحلات جوية، فنادق، وتجارب منسقة خصيصًا لك.",
                btn_start: "ابدأ رحلتك",
                btn_learn: "تعرف على المزيد",
                f1_title: "دليلك الشخصي بالذكاء الاصطناعي",
                f1_desc: "تعرف على JustMine، رفيقك الذكي في السفر باستخدام Gemini AI. دردش ببساطة لاكتشاف الجواهر الخفية وبناء مسارات مخصصة.",
                btn_ai: "جرب الدردشة كشفيًا",
                f2_title: "بحث ذكي عن الرحلات",
                f2_desc: "الوصول إلى بيانات فورية للرحلات والمطارات وتأجير السيارات مع ضمان أفضل الأسعار.",
                btn_flights: "تصفح الرحلات",
                f3_title: "تجربة هاتف محمولة سلسة",
                f3_desc: "خذ Just Travel معك. يضمن تصميمنا الموجه للهواتف إدارة حجوزاتك وحسابك أثناء التنقل.",
                btn_app: "احصل على التطبيق",
                banner_text: "قم بتنزيل تطبيقنا للحصول على أفضل تجربة سفر!",
                banner_link: "احصل على التطبيق",
                footer_legal: "قانوني",
                footer_privacy: "سياسة الخصوصية",
                footer_contact: "اتصل بنا",
                footer_terms: "شروط الخدمة"
            },
            zh: {
                nav_home: "主页",
                nav_flights: "航班",
                nav_ai: "AI 规划师",
                btn_get_started: "立即开始",
                hero_accent: "提升您的旅行体验",
                hero_title: '您的旅程从<span class="hero-accent">人工智能</span>开始',
                hero_desc: "利用人工智能的力量彻底改变旅行规划。您的旅程从简单的对话开始。",
                btn_start_journey: "开始您的旅程",
                btn_learn_more: "了解更多",
                f1_title: "您的个人 AI 向导",
                f1_desc: "认识 <strong>JustMine</strong>，您的智能旅行伴侣，由 Gemini AI 提供支持。只需聊天即可发现隐藏的宝石，获取基于天气的建议，并在几秒钟内构建自定义行程。",
                btn_ai: "尝试 AI 聊天",
                f2_title: "智能航班搜索",
                f2_desc: "访问航班、机场和汽车租赁的实时数据。我们的综合搜索引擎将您连接到数千个目的地，提供最优惠的价格和最简单的预订流程。",
                btn_flights: "浏览航班",
                f3_title: "无缝移动体验",
                f3_desc: "随身携带 Just Travel。我们的移动优先设计确保您可以随时随地管理预订和个人资料。",
                btn_app: "获取应用",
                footer_legal: "法律",
                footer_privacy: "隐私政策",
                footer_contact: "联系我们",
                footer_terms: "服务条款",
                hero_badge: "AI 驱动的旅行",
                hero_title_p1: "探索",
                hero_title_p2: "世界",
                hero_title_p3: "智能地",
                hero_desc_new: "与高级 AI 旅行助手一起规划您的完美旅程。专门为您策划的航班、酒店和体验。",
                btn_start: "开始您的旅程",
                btn_learn: "了解更多"
            },
            ru: {
                nav_home: "Главная",
                nav_flights: "Рейсы",
                nav_ai: "AI Планировщик",
                btn_get_started: "Начать",
                hero_badge: "Путешествия с AI",
                hero_title_p1: "Исследуй",
                hero_title_p2: "Мир",
                hero_title_p3: "Разумно",
                hero_desc_new: "Планируйте идеальное путешествие с нашим продвинутым AI-ассистентом. Рейсы, отели и впечатления, подобранные специально для вас.",
                btn_start: "Начать путешествие",
                btn_learn: "Узнать больше",
                f1_title: "Ваш личный AI-гид",
                f1_desc: "Встречайте <strong>JustMine</strong>, вашего умного спутника с Gemini AI. Просто общайтесь, чтобы найти скрытые жемчужины и создать маршрут за секунды.",
                btn_ai: "Попробовать AI чат",
                f2_title: "Умный поиск рейсов",
                f2_desc: "Доступ к реальным данным о рейсах, аэропортах и аренде авто. Наш поиск соединяет вас с тысячами направлений по лучшим ценам.",
                btn_flights: "Смотреть рейсы",
                f3_title: "Удобство на мобильных",
                f3_desc: "Возьмите Just Travel с собой. Наш мобильный дизайн позволяет управлять бронированиями и профилем на ходу.",
                btn_app: "Скачать приложение",
                footer_legal: "Правовая информация",
                footer_privacy: "Политика конфиденциальности",
                footer_contact: "Контакты",
                footer_contact: "Контакты",
                footer_terms: "Условия использования"
            },
            fr: {
                nav_home: "Accueil",
                nav_flights: "Vols",
                nav_ai: "Planificateur IA",
                btn_get_started: "Commencer",
                hero_badge: "Voyage propulsé par l'IA",
                hero_title_p1: "Explorez",
                hero_title_p2: "le Monde",
                hero_title_p3: "Intelligemment",
                hero_desc_new: "Planifiez votre voyage parfait avec notre assistant de voyage IA avancé. Vols, hôtels et expériences sélectionnés juste pour vous.",
                btn_start: "Commencez votre voyage",
                btn_learn: "En savoir plus",
                f1_title: "Votre guide IA personnel",
                f1_desc: "Rencontrez <strong>JustMine</strong>, votre compagnon de voyage intelligent utilisant Gemini AI. Discutez simplement pour découvrir des joyaux cachés, obtenir des suggestions basées sur la météo et créer des itinéraires personnalisés en quelques secondes.",
                btn_ai: "Essayer le chat IA",
                f2_title: "Recherche de vol intelligente",
                f2_desc: "Accédez aux données en temps réel pour les vols, les aéroports et les locations de voitures. Notre moteur de recherche complet vous connecte à des milliers de destinations avec les meilleurs tarifs et le flux de réservation le plus simple.",
                btn_flights: "Parcourir les vols",
                f3_title: "Expérience mobile fluide",
                f3_desc: "Emportez Just Travel avec vous. Notre conception mobile-first garantit que vous pouvez gérer vos réservations et votre profil lors de vos déplacements.",
                btn_app: "Obtenir l'application",
                footer_legal: "Légal",
                footer_privacy: "Politique de confidentialité",
                footer_contact: "Contactez-nous",
                footer_terms: "Conditions d'utilisation"
            }
        };

        function changeLang(lang) {
            playClickSound();
            localStorage.setItem('lang', lang);
            applyLang(lang);
            langDropdown.classList.remove('active');
        }

        function applyLang(lang) {
            document.documentElement.setAttribute('lang', lang);
            document.documentElement.dir = (lang === 'ar') ? 'rtl' : 'ltr';

            if (langDictionary[lang]) {
                document.querySelectorAll('[data-t]').forEach(el => {
                    const key = el.getAttribute('data-t');
                    if (langDictionary[lang][key]) {
                        el.innerHTML = langDictionary[lang][key];
                    }
                });
            }
        }

        // Initialize language
        const savedLang = localStorage.getItem('lang') || 'en';
        applyLang(savedLang);

        // Language Dropdown Logic
        langToggle.addEventListener('click', (e) => {
            e.stopPropagation();
            playClickSound();
            langDropdown.classList.toggle('active');
        });

        document.addEventListener('click', () => {
            langDropdown.classList.remove('active');
        });

        // Header scroll effect
        window.addEventListener('scroll', () => {
            const header = document.querySelector('header');
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });
    </script>
    @include('partials.cookie-consent')
    
    <!-- Floating WhatsApp Button -->
    <a href="https://wa.me/971507466975" target="_blank" class="whatsapp-float" aria-label="Contact us on WhatsApp" title="Chat with us on WhatsApp">
        <i class="fa-brands fa-whatsapp"></i>
    </a>
</body>
<!-- 
    Note to User:
    The images used are placeholders from Unsplash.
    To use your uploaded images, place them in the public folder (e.g., public/img/robot.jpg)
    and update the src attributes in this file logic.
-->

</html>