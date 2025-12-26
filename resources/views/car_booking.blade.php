<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Book Car - Just Travel</title>
    @include('partials.clarity')
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

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
            --light: #f7f9fc;
            --white: #ffffff;
            --bg-page: #f7f9fc;
            --bg-sidebar: #ffffff;
            --bg-card: #ffffff;
            --bg-input: #f8f9fa;
            --text-main: #2d3436;
            --text-muted: #636e72;
            --border-color: rgba(0, 0, 0, 0.05);
            --gradient-hero: linear-gradient(135deg, #0984e3 0%, #00cec9 100%);
            --sidebar-width: 100px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        [data-theme="dark"] {
            --bg-page: #020617;
            --bg-sidebar: #0f172a;
            --bg-card: #0f172a;
            --bg-input: #1e293b;
            --white: #0f172a;
            --light: #1e293b;
            --dark: #f8fafc;
            --text-main: #f8fafc;
            --text-muted: #94a3b8;
            --border-color: rgba(0, 206, 201, 0.2);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Outfit', sans-serif;
        }

        html,
        body {
            width: 100%;
            max-width: 100vw;
            overflow-x: hidden;
            position: relative;
        }

        body {
            background-color: var(--bg-page);
            color: var(--text-main);
            display: flex;
            min-height: 100vh;
            transition: var(--transition);
        }

        /* Sidebar */
        .sidebar {
            width: var(--sidebar-width);
            background: var(--bg-sidebar);
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 2rem 0;
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.05);
            z-index: 100;
            border-right: 1px solid var(--border-color);
        }

        [dir="rtl"] .sidebar {
            left: auto;
            right: 0;
            border-right: none;
            border-left: 1px solid var(--border-color);
        }

        .brand-logo {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            margin-bottom: 3rem;
            object-fit: cover;
        }

        .nav-item {
            width: 50px;
            height: 50px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #b2bec3;
            font-size: 1.4rem;
            margin-bottom: 2rem;
            cursor: pointer;
            transition: var(--transition);
            text-decoration: none;
        }

        .nav-item:hover,
        .nav-item.active {
            color: #ffffff;
            background: var(--gradient-hero);
            box-shadow: 0 8px 25px rgba(0, 206, 201, 0.4);
            transform: translateY(-2px);
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            padding: 1.5rem;
            width: calc(100% - var(--sidebar-width));
            min-width: 0;
        }

        [dir="rtl"] .main-content {
            margin-left: 0;
            margin-right: var(--sidebar-width);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .page-title {
            font-size: 1.8rem;
            font-weight: 800;
            color: var(--text-main);
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .lang-toggle-btn,
        .theme-toggle-btn {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            color: var(--text-main);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: var(--transition);
        }

        /* Language Dropdown */
        .lang-dropdown {
            position: absolute;
            top: 100%;
            margin-top: 10px;
            right: 0;
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 15px;
            width: 150px;
            padding: 8px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            opacity: 0;
            visibility: hidden;
            transition: var(--transition);
            z-index: 1001;
        }

        .lang-dropdown.active {
            opacity: 1;
            visibility: visible;
            transform: translateY(5px);
        }

        .lang-option {
            padding: 10px;
            border-radius: 10px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.9rem;
            font-weight: 600;
            transition: var(--transition);
        }

        .lang-option:hover {
            background: rgba(0, 206, 201, 0.1);
            color: var(--primary);
        }

        .booking-widget-container {
            background: var(--bg-card);
            border-radius: 24px;
            padding: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--border-color);
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .booking-widget-container::-webkit-scrollbar {
            height: 6px;
        }

        .booking-widget-container::-webkit-scrollbar-thumb {
            background: var(--primary);
            border-radius: 10px;
        }

        @media (max-width: 800px) {
            .sidebar {
                width: 100%;
                height: 70px;
                flex-direction: row;
                bottom: 0;
                top: auto;
                padding: 0 1rem;
                justify-content: space-around;
                border-right: none;
                border-top: 1px solid var(--border-color);
            }

            [dir="rtl"] .sidebar {
                border-left: none;
            }

            .main-content {
                margin-left: 0 !important;
                margin-right: 0 !important;
                padding-bottom: 90px;
                width: 100%;
            }

            .brand-logo {
                display: none;
            }

            .nav-item {
                margin-bottom: 0;
            }
        }
    </style>
</head>

<body>
    <aside class="sidebar">
        <a href="{{ url('/') }}">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="brand-logo">
        </a>
        <a href="{{ route('home') }}" class="nav-item" title="Airports">
            <i class="fa-solid fa-plane"></i>
        </a>
        <a href="{{ route('hotels') }}" class="nav-item" title="Hotels">
            <i class="fa-solid fa-hotel"></i>
        </a>
        <a href="{{ route('cars') }}" class="nav-item active" title="Cars">
            <i class="fa-solid fa-car"></i>
        </a>
        <a href="{{ route('ai.chat') }}" class="nav-item" title="AI Assistant">
            <i class="fa-solid fa-wand-magic-sparkles"></i>
        </a>
    </aside>

    <main class="main-content">
        <header class="header">
            <h1 class="page-title" data-t="car_title">Book Your Ride</h1>
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
                        <div class="lang-option" onclick="changeLang('es')">
                            <img src="https://flagcdn.com/w20/es.png" width="20" alt="ES"> Spanish
                        </div>
                        <div class="lang-option" onclick="changeLang('de')">
                            <img src="https://flagcdn.com/w20/de.png" width="20" alt="DE"> German
                        </div>
                        <div class="lang-option" onclick="changeLang('it')">
                            <img src="https://flagcdn.com/w20/it.png" width="20" alt="IT"> Italian
                        </div>
                    </div>
                </div>
                <button id="themeToggle" class="theme-toggle-btn">
                    <i class="fa-solid fa-moon"></i>
                </button>
            </div>
        </header>

        <div class="booking-widget-container">
            <!-- Travelpayouts Taxi/Transfer Widget -->
            <script async
                src="https://tpwdgt.com/content?trs=383987&shmarker=601947&powered_by=true&country=14&lang=en&width=100&background=light&logo=true&header=true&gearbox=false&cars=false&border=true&footer=true&campaign_id=87&promo_id=4322"
                charset="utf-8"></script>
        </div>
    </main>

    <script>
        const themeToggle = document.getElementById('themeToggle');
        const langToggle = document.getElementById('langToggle');
        const langDropdown = document.getElementById('langDropdown');
        const sunIcon = '<i class="fa-solid fa-sun"></i>';
        const moonIcon = '<i class="fa-solid fa-moon"></i>';

        function playClickSound() {
            try {
                const context = new (window.AudioContext || window.webkitAudioContext)();
                if (context.state === 'suspended') context.resume();
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
            } catch (e) {
                console.log("Audio play failed", e);
            }
        }

        const langDictionary = {
            en: {
                car_title: "Book Your Ride",
                sidebar_airports: "Airports",
                sidebar_hotels: "Hotels",
                sidebar_cars: "Cars",
                sidebar_ai: "AI Assistant"
            },
            ar: {
                car_title: "احجز رحلتك",
                sidebar_airports: "المطارات",
                sidebar_hotels: "الفنادق",
                sidebar_cars: "السيارات",
                sidebar_ai: "مساعد الذكاء الاصطناعي"
            },
            ru: {
                car_title: "Забронируйте поездку",
                sidebar_airports: "Аэропорты",
                sidebar_hotels: "Отели",
                sidebar_cars: "Авто",
                sidebar_ai: "AI Ассистент"
            },
            zh: {
                car_title: "预订您的行程",
                sidebar_airports: "机场",
                sidebar_hotels: "酒店",
                sidebar_cars: "汽车",
                sidebar_ai: "AI 助手"
            },
            fr: {
                car_title: "Réservez votre trajet",
                sidebar_airports: "Aéroports",
                sidebar_hotels: "Hôtels",
                sidebar_cars: "Voitures",
                sidebar_ai: "Assistant IA"
            },
            es: {
                car_title: "Reserva tu viaje",
                sidebar_airports: "Aeropuertos",
                sidebar_hotels: "Hoteles",
                sidebar_cars: "Coches",
                sidebar_ai: "Asistente IA"
            },
            de: {
                car_title: "Buchen Sie Ihre Fahrt",
                sidebar_airports: "Flughäfen",
                sidebar_hotels: "Hotels",
                sidebar_cars: "Autos",
                sidebar_ai: "KI-Assistent"
            },
            it: {
                car_title: "Prenota la tua corsa",
                sidebar_airports: "Aeroporti",
                sidebar_hotels: "Hotel",
                sidebar_cars: "Auto",
                sidebar_ai: "Assistente IA"
            }
        };

        function changeLang(lang) {
            playClickSound();
            localStorage.setItem('lang', lang);
            applyLang(lang);
            if (langDropdown) langDropdown.classList.remove('active');
        }

        function applyLang(lang) {
            document.documentElement.setAttribute('lang', lang);
            document.documentElement.dir = (lang === 'ar') ? 'rtl' : 'ltr';

            // Handle body class for RTL specific tweaks
            if (lang === 'ar') document.body.classList.add('rtl');
            else document.body.classList.remove('rtl');

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

        if (langToggle) {
            langToggle.addEventListener('click', (e) => {
                e.stopPropagation();
                playClickSound();
                langDropdown.classList.toggle('active');
            });
        }

        document.addEventListener('click', (e) => {
            if (langDropdown && !langDropdown.contains(e.target) && !langToggle.contains(e.target)) {
                langDropdown.classList.remove('active');
            }
        });

        const savedTheme = localStorage.getItem('theme') || 'light';
        document.documentElement.setAttribute('data-theme', savedTheme);
        themeToggle.innerHTML = savedTheme === 'dark' ? sunIcon : moonIcon;

        if (themeToggle) {
            themeToggle.addEventListener('click', () => {
                playClickSound();
                const currentTheme = document.documentElement.getAttribute('data-theme');
                const newTheme = currentTheme === 'light' ? 'dark' : 'light';
                document.documentElement.setAttribute('data-theme', newTheme);
                localStorage.setItem('theme', newTheme);
                themeToggle.innerHTML = newTheme === 'dark' ? sunIcon : moonIcon;
            });
        }
    </script>
    @include('partials.cookie-consent')
    @include('partials.whatsapp-button')
</body>

</html>