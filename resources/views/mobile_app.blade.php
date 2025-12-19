<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Get the App - Just Travel</title>
    @include('partials.clarity')

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700;800&display=swap" rel="stylesheet">
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
            color: white !important;
            box-shadow: 0 4px 15px rgba(9, 132, 227, 0.4);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(9, 132, 227, 0.6);
        }

        /* Header */
        header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            padding: 10px 0;
            z-index: 1000;
            background: var(--bg-card);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            border-bottom: 1px solid var(--border-color);
            transition: var(--transition);
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--text-main);
            text-decoration: none;
        }

        .nav-links {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .nav-links a {
            text-decoration: none;
            color: var(--text-main);
            font-weight: 600;
            transition: var(--transition);
            padding: 0.6rem 1.4rem;
            border-radius: 50px;
            font-size: 0.9rem;
            border: 1px solid transparent;
        }

        .nav-links a:hover {
            background: rgba(9, 132, 227, 0.1);
            color: var(--primary);
        }

        .theme-toggle-btn {
            background: transparent;
            border: none;
            color: var(--text-main);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: var(--transition);
            font-size: 1.2rem;
        }

        .theme-toggle-btn:hover {
            background: rgba(0, 0, 0, 0.05);
            color: var(--primary);
        }

        /* Hero Section */
        .app-hero {
            padding: 120px 0 60px;
            display: flex;
            align-items: center;
            min-height: 90vh;
        }

        .app-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
        }

        .app-text {
            animation: fadeInRight 0.8s ease-out;
        }

        .app-title {
            font-size: 3.5rem;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 1.5rem;
            background: var(--gradient-hero);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .app-description {
            font-size: 1.2rem;
            line-height: 1.7;
            color: var(--text-muted);
            margin-bottom: 2.5rem;
        }

        .feature-list {
            list-style: none;
            margin-bottom: 2.5rem;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1rem;
            font-size: 1.1rem;
            color: var(--text-main);
        }

        .feature-icon {
            color: var(--primary);
            font-size: 1.2rem;
        }

        .download-buttons {
            display: flex;
            gap: 1.5rem;
        }

        .store-btn {
            display: flex;
            align-items: center;
            gap: 10px;
            background: #000;
            color: #fff;
            padding: 10px 20px;
            border-radius: 12px;
            text-decoration: none;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        [data-theme="dark"] .store-btn {
            background: #fff;
            color: #000;
        }

        .store-btn:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .store-icon {
            font-size: 2rem;
        }

        .store-text {
            display: flex;
            flex-direction: column;
            line-height: 1.2;
        }

        .store-subtitle {
            font-size: 0.7rem;
            text-transform: uppercase;
        }

        .store-title {
            font-size: 1.1rem;
            font-weight: 700;
        }

        .app-visual {
            position: relative;
            animation: fadeInLeft 0.8s ease-out;
        }

        .phone-mockup {
            width: 100%;
            max-width: 450px;
            border-radius: 40px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            border: 8px solid var(--text-main);
            overflow: hidden;
            margin: 0 auto;
            display: block;
        }

        .mockup-img {
            width: 100%;
            display: block;
            height: auto;
        }

        /* Animations */
        @keyframes fadeInRight {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes fadeInLeft {
            from {
                opacity: 0;
                transform: translateX(30px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @media (max-width: 900px) {
            .app-content {
                grid-template-columns: 1fr;
                text-align: center;
            }

            .app-text {
                order: 2;
            }

            .app-visual {
                order: 1;
            }

            .feature-item {
                justify-content: center;
            }

            .download-buttons {
                justify-content: center;
            }

            .nav-links {
                display: none;
            }
        }
    </style>
</head>

<body>

    <header>
        <div class="container">
            <nav>
                <a href="{{ url('/') }}" class="logo">
                    <img src="{{ asset('images/logo.png') }}" alt="Just Travel"
                        style="height: 50px; border-radius: 8px;">
                </a>
                <div class="nav-links">
                    <a href="{{ url('/') }}" data-t="nav_home">Home</a>
                    <a href="{{ route('home') }}" data-t="nav_flights">Flights</a>
                </div>
                <button id="themeToggle" class="theme-toggle-btn" title="Toggle Dark/Light Mode">
                    <i class="fa-solid fa-moon"></i>
                </button>
            </nav>
        </div>
    </header>

    <div class="container">
        <section class="app-hero">
            <div class="app-content">
                <div class="app-text">
                    <h1 class="app-title" data-t="app_title">Your AI Travel Companion in Your Pocket</h1>
                    <p class="app-description" data-t="app_desc">
                        Experience the power of AI travel planning anywhere, anytime. Download the Just Travel app to
                        discover destinations, book flights and hotels, and manage your itineraries on the go.
                    </p>
                    <ul class="feature-list">
                        <li class="feature-item">
                            <i class="fa-solid fa-wand-magic-sparkles feature-icon"></i>
                            <span data-t="feat_ai">AI-Powered Travel Assistant</span>
                        </li>
                        <li class="feature-item">
                            <i class="fa-solid fa-plane-departure feature-icon"></i>
                            <span data-t="feat_flights">Find the Best Flight Deals</span>
                        </li>
                        <li class="feature-item">
                            <i class="fa-solid fa-hotel feature-icon"></i>
                            <span data-t="feat_hotels">Luxury & Budget Hotels</span>
                        </li>
                        <li class="feature-item">
                            <i class="fa-solid fa-car feature-icon"></i>
                            <span data-t="feat_cars">Car Rental Services</span>
                        </li>
                    </ul>

                    <div class="download-buttons">
                        <a href="https://play.google.com/store/apps/details?id=com.goadvice.travel&pcampaignid=web_share"
                            target="_blank" class="store-btn">
                            <i class="fa-brands fa-google-play store-icon"></i>
                            <div class="store-text">
                                <span class="store-subtitle">Get it on</span>
                                <span class="store-title">Google Play</span>
                            </div>
                        </a>
                        <a href="https://apps.apple.com/ch/app/just-travel/id6747309638" target="_blank"
                            class="store-btn">
                            <i class="fa-brands fa-apple store-icon"></i>
                            <div class="store-text">
                                <span class="store-subtitle">Download on the</span>
                                <span class="store-title">App Store</span>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="app-visual">
                    <div class="phone-mockup">
                        <img src="{{ asset('images/mobile.jpg') }}" alt="Just Travel App Interface" class="mockup-img">
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>
        // Theme Toggle Logic
        const themeToggle = document.getElementById('themeToggle');
        const sunIcon = '<i class="fa-solid fa-sun"></i>';
        const moonIcon = '<i class="fa-solid fa-moon"></i>';

        const savedTheme = localStorage.getItem('theme') || 'light';
        document.documentElement.setAttribute('data-theme', savedTheme);
        themeToggle.innerHTML = savedTheme === 'dark' ? sunIcon : moonIcon;

        themeToggle.addEventListener('click', () => {
            const currentTheme = document.documentElement.getAttribute('data-theme');
            const newTheme = currentTheme === 'light' ? 'dark' : 'light';
            document.documentElement.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);
            themeToggle.innerHTML = newTheme === 'dark' ? sunIcon : moonIcon;
        });

        // Simple localization for static demo (can be expanded to full dictionary if needed)
        const lang = localStorage.getItem('lang') || 'en';
        document.documentElement.setAttribute('lang', lang);
        document.documentElement.dir = (lang === 'ar') ? 'rtl' : 'ltr';

        const dictionary = {
            ar: {
                app_title: "رفيق سفرك بالذكاء الاصطناعي في جيبك",
                app_desc: "استمتع بقوة تخطيط السفر بالذكاء الاصطناعي في أي مكان وزمان. قم بتنزيل تطبيق Just Travel لاكتشاف الوجهات وحجز الرحلات والفنادق وإدارة مساراتك أثناء التنقل.",
                feat_ai: "مساعد سفر بالذكاء الاصطناعي",
                feat_flights: "اعثر على أفضل عروض الرحلات",
                feat_hotels: "فنادق فاخرة واقتصادية",
                feat_cars: "خدمات تأجير السيارات",
                nav_home: "الرئيسية",
                nav_flights: "الرحلات"
            },
            fr: {
                app_title: "Votre compagnon de voyage IA dans votre poche",
                app_desc: "Profitez de la puissance de la planification de voyage par IA partout et à tout moment. Téléchargez l'application Just Travel pour découvrir des destinations, réserver des vols et des hôtels et gérer vos itinéraires.",
                feat_ai: "Assistant de voyage IA",
                feat_flights: "Trouvez les meilleures offres de vol",
                feat_hotels: "Hôtels de luxe et économiques",
                feat_cars: "Services de location de voitures",
                nav_home: "Accueil",
                nav_flights: "Vols"
            },
            ru: {
                app_title: "Ваш ИИ-путеводитель в кармане",
                app_desc: "Оцените мощь планирования путешествий с ИИ в любом месте и в любое время. Скачайте приложение Just Travel, чтобы открывать направления, бронировать рейсы и отели, а также управлять маршрутами на ходу.",
                feat_ai: "AI-помощник в путешествиях",
                feat_flights: "Лучшие предложения на авиабилеты",
                feat_hotels: "Роскошные и бюджетные отели",
                feat_cars: "Услуги проката автомобилей",
                nav_home: "Главная",
                nav_flights: "Рейсы"
            },
            zh: {
                app_title: "您口袋里的 AI 旅行伴侣",
                app_desc: "随时随地体验 AI 旅行规划的强大功能。下载 Just Travel 应用程序，通过手机发现目的地、预订航班和酒店，并管理您的行程。",
                feat_ai: "AI 旅行助手",
                feat_flights: "查找最佳航班优惠",
                feat_hotels: "豪华和经济型酒店",
                feat_cars: "汽车租赁服务",
                nav_home: "主页",
                nav_flights: "航班"
            }
        };

        if (dictionary[lang]) {
            document.querySelectorAll('[data-t]').forEach(el => {
                const key = el.getAttribute('data-t');
                if (dictionary[lang][key]) {
                    el.innerText = dictionary[lang][key];
                }
            });
        }
    </script>
</body>

</html>