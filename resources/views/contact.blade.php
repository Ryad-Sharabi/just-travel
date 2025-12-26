<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contact Us - Just Travel</title>
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
            --gradient-hero: linear-gradient(135deg, #0984e3 0%, #00cec9 100%);
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
            line-height: 1.6;
            transition: background-color 0.3s ease, color 0.3s ease;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 0 2rem;
            width: 100%;
        }

        /* Header */
        header {
            background: var(--bg-card);
            border-bottom: 1px solid var(--border-color);
            padding: 1rem 0;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: var(--text-main);
            font-weight: 700;
            font-size: 1.5rem;
        }

        .logo img {
            height: 40px;
            border-radius: 8px;
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .theme-toggle-btn,
        .lang-toggle-btn {
            background: var(--bg-page);
            border: 1px solid var(--border-color);
            color: var(--text-main);
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
            color: var(--primary);
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
            text-align: left;
        }

        [dir="rtl"] .lang-option {
            text-align: right;
            flex-direction: row-reverse;
        }

        .lang-option:hover {
            background: rgba(0, 206, 201, 0.1);
            color: var(--primary);
            transform: translateX(5px);
        }

        /* Main Content */
        main {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 4rem 0;
        }

        .contact-wrapper {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
            width: 100%;
            align-items: center;
        }

        .contact-info-section h1 {
            font-size: 3.5rem;
            font-weight: 800;
            line-height: 1.1;
            margin-bottom: 1.5rem;
            background: var(--gradient-hero);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .contact-info-section p {
            font-size: 1.2rem;
            color: var(--text-muted);
            margin-bottom: 3rem;
        }

        .contact-card {
            background: var(--bg-card);
            border-radius: 30px;
            padding: 3rem;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.1);
            border: 1px solid var(--border-color);
        }

        .contact-method {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 2.5rem;
            text-decoration: none;
            color: var(--text-main);
            transition: var(--transition);
        }

        .contact-method:last-child {
            margin-bottom: 0;
        }

        .contact-icon {
            width: 60px;
            height: 60px;
            background: var(--bg-page);
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: var(--secondary);
            border: 1px solid var(--border-color);
            transition: var(--transition);
        }

        .contact-method:hover .contact-icon {
            background: var(--gradient-hero);
            color: white;
            transform: translateY(-5px) rotate(-10deg);
            box-shadow: 0 10px 20px rgba(9, 132, 227, 0.3);
        }

        .contact-text h3 {
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--text-muted);
            margin-bottom: 4px;
        }

        .contact-text p {
            font-size: 1.2rem;
            font-weight: 700;
        }

        /* Footer */
        footer {
            background: var(--bg-footer);
            color: #bdc3c7;
            padding: 3rem 0;
            text-align: center;
            margin-top: auto;
        }

        @media (max-width: 900px) {
            .contact-wrapper {
                grid-template-columns: 1fr;
                text-align: center;
            }

            .contact-method {
                justify-content: center;
                text-align: left;
            }

            .contact-info-section h1 {
                font-size: 2.5rem;
            }
        }
    </style>
</head>

<body>
    <header>
        <div class="container">
            <nav>
                <a href="{{ url('/') }}" class="logo">
                    <img src="{{ asset('images/logo.png') }}" alt="Just Travel">
                    <span data-t="brand_name">Just Travel.</span>
                </a>
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
                    <button id="themeToggle" class="theme-toggle-btn">
                        <i class="fa-solid fa-moon"></i>
                    </button>
                </div>
            </nav>
        </div>
    </header>

    <main>
        <div class="container">
            <div class="contact-wrapper">
                <div class="contact-info-section">
                    <h1 data-t="contact_title">Get In <span style="display: block;">Touch.</span></h1>
                    <p data-t="contact_subtitle">Have questions about your travel plans or our AI assistant? Our team is
                        here to help you 24/7.</p>
                </div>

                <div class="contact-card">
                    <a href="mailto:info@justtravel.pro" class="contact-method">
                        <div class="contact-icon">
                            <i class="fa-solid fa-envelope"></i>
                        </div>
                        <div class="contact-text">
                            <h3 data-t="email_label">Email Us</h3>
                            <p>info@justtravel.pro</p>
                        </div>
                    </a>

                    <a href="tel:+971507466975" class="contact-method">
                        <div class="contact-icon">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                        <div class="contact-text">
                            <h3 data-t="call_label">Call Us</h3>
                            <p>+971 50 746 6975</p>
                        </div>
                    </a>

                    <a href="https://justtravel.pro" target="_blank" class="contact-method">
                        <div class="contact-icon">
                            <i class="fa-solid fa-globe"></i>
                        </div>
                        <div class="contact-text">
                            <h3 data-t="web_label">Website</h3>
                            <p>justtravel.pro</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <div class="container">
            <p data-t="footer_copy">&copy; {{ date('Y') }} Just Travel Inc. All rights reserved.</p>
        </div>
    </footer>

    <script>
        const themeToggle = document.getElementById('themeToggle');
        const langToggle = document.getElementById('langToggle');
        const langDropdown = document.getElementById('langDropdown');
        const sunIcon = '<i class="fa-solid fa-sun"></i>';
        const moonIcon = '<i class="fa-solid fa-moon"></i>';

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

        const langDictionary = {
            en: {
                brand_name: "Just Travel.",
                contact_title: 'Get In <span style="display: block;">Touch.</span>',
                contact_subtitle: "Have questions about your travel plans or our AI assistant? Our team is here to help you 24/7.",
                email_label: "Email Us",
                call_label: "Call Us",
                web_label: "Website",
                footer_copy: "© {{ date('Y') }} Just Travel Inc. All rights reserved."
            },
            ar: {
                brand_name: "جست ترافل.",
                contact_title: 'ابقَ على <span style="display: block;">تواصل.</span>',
                contact_subtitle: "هل لديك أسئلة حول خطط سفرك أو مساعدنا الذكي؟ فريقنا هنا لمساعدتك على مدار الساعة.",
                email_label: "راسلنا بريدياً",
                call_label: "اتصل بنا",
                web_label: "موقعنا الإلكتروني",
                footer_copy: "© {{ date('Y') }} جست ترافل. جميع الحقوق محفوظة."
            },
            ru: {
                brand_name: "Just Travel.",
                contact_title: 'Свяжитесь с <span style="display: block;">Нами.</span>',
                contact_subtitle: "Есть вопросы о планах или нашем AI? Наша команда готова помочь 24/7.",
                email_label: "Напишите нам",
                call_label: "Позвоните нам",
                web_label: "Веб-сайт",
                footer_copy: "© {{ date('Y') }} Just Travel Inc. Все права защищены."
            },
            zh: {
                brand_name: "Just Travel.",
                contact_title: '取得<span style="display: block;">联系。</span>',
                contact_subtitle: "对您的旅行计划或我们的 AI 助手有疑问？我们的团队 24/7 为您提供帮助。",
                email_label: "发送邮件",
                call_label: "致电我们",
                web_label: "网站",
                footer_copy: "© {{ date('Y') }} Just Travel Inc. 保留所有权利。"
            },
            fr: {
                brand_name: "Just Travel.",
                contact_title: 'Prenez <span style="display: block;">Contact.</span>',
                contact_subtitle: "Vous avez des questions sur vos projets de voyage ou notre assistant IA ? Notre équipe est là pour vous aider 24h/24 et 7j/7.",
                email_label: "Envoyez-nous un email",
                call_label: "Appelez-nous",
                web_label: "Site Web",
                footer_copy: "© {{ date('Y') }} Just Travel Inc. Tous droits réservés."
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

        const savedLang = localStorage.getItem('lang') || 'en';
        applyLang(savedLang);

        langToggle.addEventListener('click', (e) => {
            e.stopPropagation();
            playClickSound();
            langDropdown.classList.toggle('active');
        });

        document.addEventListener('click', () => {
            langDropdown.classList.remove('active');
        });

        const savedTheme = localStorage.getItem('theme') || 'light';
        document.documentElement.setAttribute('data-theme', savedTheme);
        themeToggle.innerHTML = savedTheme === 'dark' ? sunIcon : moonIcon;

        themeToggle.addEventListener('click', () => {
            playClickSound();
            const currentTheme = document.documentElement.getAttribute('data-theme');
            const newTheme = currentTheme === 'light' ? 'dark' : 'light';
            document.documentElement.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);
            themeToggle.innerHTML = newTheme === 'dark' ? sunIcon : moonIcon;
        });
    </script>
    @include('partials.cookie-consent')
    @include('partials.whatsapp-button')
</body>

</html>