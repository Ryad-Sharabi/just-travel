<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Just Travel</title>
    @include('partials.clarity')
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700;800&display=swap" rel="stylesheet">
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
            --gray: #636e72;
            --white: #ffffff;
            --bg-page: #f7f9fc;
            --bg-card: #ffffff;
            --bg-input: #fdfdfd;
            --text-main: #2d3436;
            --text-muted: #636e72;
            --border-color: #edeff2;
            --gradient-hero: linear-gradient(135deg, #0984e3 0%, #00cec9 100%);
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        [data-theme="dark"] {
            --bg-page: #0f172a;
            --bg-card: #1e293b;
            --bg-input: #334155;
            --white: #1e293b;
            --light: #0f172a;
            --dark: #f8fafc;
            --text-main: #f1f5f9;
            --text-muted: #94a3b8;
            --border-color: rgba(255, 255, 255, 0.1);
            --gray: #94a3b8;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Outfit', sans-serif;
        }

        body {
            height: 100vh;
            background: var(--bg-page);
            color: var(--text-main);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .container {
            width: 100%;
            height: 100%;
            display: flex;
            background: var(--bg-card);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        /* Left Side - Image */
        .visual-side {
            flex: 1.2;
            background: url('https://images.unsplash.com/photo-1469854523086-cc02fe5d8800?q=80&w=2621&auto=format&fit=crop') no-repeat center center/cover;
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding: 4rem;
            color: white;
            display: none;
            /* Hidden on mobile */
        }

        @media(min-width: 900px) {
            .visual-side {
                display: flex;
            }
        }

        .visual-side::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.8) 0%, rgba(0, 0, 0, 0.2) 50%, rgba(9, 132, 227, 0.3) 100%);
            z-index: 1;
        }

        .visual-content {
            position: relative;
            z-index: 2;
            animation: fadeInUp 0.8s ease-out 0.2s backwards;
        }

        .visual-title {
            font-size: 3rem;
            font-weight: 800;
            line-height: 1.1;
            margin-bottom: 1rem;
            text-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }

        .visual-text {
            font-size: 1.2rem;
            opacity: 0.9;
            max-width: 80%;
            line-height: 1.6;
            margin-bottom: 2rem;
        }

        /* Right Side - Form */
        .form-side {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 4rem 5rem;
            position: relative;
            background: var(--bg-card);
        }

        @media(max-width: 600px) {
            .form-side {
                padding: 2rem;
            }
        }

        .auth-header {
            margin-bottom: 3rem;
            position: relative;
        }

        .logo-img {
            height: 50px;
            margin-bottom: 2rem;
            border-radius: 12px;
        }

        .title {
            font-size: 2.2rem;
            font-weight: 800;
            color: var(--text-main);
            margin-bottom: 0.5rem;
            letter-spacing: -1px;
        }

        .subtitle {
            color: var(--gray);
            font-size: 1rem;
        }

        /* Form Elements */
        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .form-label {
            display: block;
            margin-bottom: 0.6rem;
            color: var(--text-main);
            font-weight: 600;
            font-size: 0.95rem;
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: #b2bec3;
            transition: var(--transition);
        }

        [dir="rtl"] .input-icon {
            left: auto;
            right: 18px;
        }

        .form-input {
            width: 100%;
            padding: 16px 20px 16px 50px;
            border: 2px solid var(--border-color);
            border-radius: 16px;
            font-size: 1rem;
            color: var(--text-main);
            background: var(--bg-input);
            transition: var(--transition);
            outline: none;
        }

        [dir="rtl"] .form-input {
            padding: 16px 50px 16px 20px;
        }

        .form-input:focus {
            border-color: var(--secondary);
            background: var(--bg-card);
            box-shadow: 0 10px 25px rgba(9, 132, 227, 0.1);
        }

        .form-input:focus+.input-icon {
            color: var(--secondary);
        }

        .btn-submit {
            width: 100%;
            padding: 16px;
            background: var(--gradient-hero);
            border: none;
            color: white;
            font-size: 1.1rem;
            font-weight: 700;
            border-radius: 16px;
            cursor: pointer;
            transition: var(--transition);
            box-shadow: 0 10px 20px rgba(9, 132, 227, 0.3);
            margin-top: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-submit:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(9, 132, 227, 0.4);
            filter: brightness(1.1);
        }

        .footer-links {
            margin-top: 2.5rem;
            text-align: center;
            font-size: 0.95rem;
            color: var(--gray);
        }

        .link-highlight {
            color: var(--secondary);
            text-decoration: none;
            font-weight: 700;
            transition: var(--transition);
        }

        .link-highlight:hover {
            color: var(--primary-dark);
        }

        .alert-error {
            background: #ffe6e6;
            color: #d63031;
            padding: 12px 18px;
            border-radius: 12px;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.95rem;
            border: 1px solid #ffb8b8;
            animation: shake 0.4s ease-in-out;
        }

        /* Language Switcher */
        .top-nav {
            position: absolute;
            top: 2rem;
            right: 2rem;
            display: flex;
            gap: 1rem;
            z-index: 100;
        }

        [dir="rtl"] .top-nav {
            right: auto;
            left: 2rem;
        }

        .nav-btn {
            background: var(--bg-card);
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
            font-size: 1.1rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .nav-btn:hover {
            color: var(--primary);
            transform: translateY(-2px);
        }

        .lang-dropdown {
            position: absolute;
            top: 55px;
            right: 0;
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            width: 150px;
            padding: 8px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            opacity: 0;
            visibility: hidden;
            transform: translateY(10px);
            transition: var(--transition);
        }

        [dir="rtl"] .lang-dropdown {
            right: auto;
            left: 0;
        }

        .lang-dropdown.active {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .lang-option {
            padding: 10px;
            border-radius: 8px;
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

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes shake {

            0%,
            100% {
                transform: translateX(0);
            }

            25% {
                transform: translateX(-5px);
            }

            75% {
                transform: translateX(5px);
            }
        }
    </style>
</head>

<body>
    <div class="top-nav">
        <div style="position: relative;">
            <button id="langToggle" class="nav-btn" title="Language">
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
        <button id="themeToggle" class="nav-btn">
            <i class="fa-solid fa-moon"></i>
        </button>
    </div>

    <div class="container">
        <!-- Visual Side -->
        <div class="visual-side">
            <div class="visual-content">
                <div class="visual-title" data-t="visual_title">Explore the world with AI.</div>
                <p class="visual-text" data-t="visual_text">Discover new destinations, book seamlessly, and enjoy
                    personalized itineraries crafted just for you.</p>
            </div>
        </div>

        <!-- Form Side -->
        <div class="form-side">
            <div class="auth-header">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('images/logo.png') }}" alt="Just Travel" class="logo-img">
                </a>
                <h1 class="title" data-t="login_title">Welcome back!</h1>
                <p class="subtitle" data-t="login_subtitle">Please enter your details to sign in.</p>
            </div>

            @if(session('error'))
                <div class="alert-error">
                    <i class="fa-solid fa-circle-exclamation"></i> {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('login.post') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="email" class="form-label" data-t="label_email">Email</label>
                    <div class="input-wrapper">
                        <input type="email" id="email" name="email" class="form-input" placeholder="Enter your email"
                            data-t-placeholder="placeholder_email" required autofocus>
                        <i class="fa-regular fa-envelope input-icon"></i>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password" class="form-label" data-t="label_password">Password</label>
                    <div class="input-wrapper">
                        <input type="password" id="password" name="password" class="form-input" placeholder="••••••••"
                            required>
                        <i class="fa-solid fa-lock input-icon"></i>
                    </div>
                </div>

                <div class="form-group" style="display: flex; align-items: center; gap: 10px; margin-bottom: 20px;">
                    <input type="checkbox" name="remember" id="remember"
                        style="width: 18px; height: 18px; cursor: pointer; accent-color: var(--primary);">
                    <label for="remember"
                        style="font-size: 0.95rem; color: var(--text-main); cursor: pointer; user-select: none;"
                        data-t="remember_me">Remember Me</label>
                </div>

                <button type="submit" class="btn-submit">
                    <span data-t="btn_login">Sign In</span> <i class="fa-solid fa-arrow-right"></i>
                </button>
            </form>

            <div class="footer-links">
                <span data-t="no_account">Don't have an account?</span> <a href="{{ route('register') }}"
                    class="link-highlight" data-t="create_account">Create free account</a>
            </div>
        </div>
    </div>

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
                visual_title: "Explore the world with AI.",
                visual_text: "Discover new destinations, book seamlessly, and enjoy personalized itineraries crafted just for you.",
                login_title: "Welcome back!",
                login_subtitle: "Please enter your details to sign in.",
                label_email: "Email",
                placeholder_email: "Enter your email",
                label_password: "Password",
                btn_login: "Sign In",
                no_account: "Don't have an account?",
                create_account: "Create free account",
                remember_me: "Remember Me"
            },
            ar: {
                visual_title: "استكشف العالم بالذكاء الاصطناعي.",
                visual_text: "اكتشف وجهات جديدة، احجز بسلاسة، واستمتع بمسارات رحلات مخصصة مصممة خصيصًا لك.",
                login_title: "مرحباً بعودتك!",
                login_subtitle: "يرجى إدخال بياناتك لتسجيل الدخول.",
                label_email: "البريد الإلكتروني",
                placeholder_email: "أدخل بريدك الإلكتروني",
                label_password: "كلمة المرور",
                btn_login: "تسجيل الدخول",
                no_account: "ليس لديك حساب؟",
                create_account: "أنشئ حساباً مجانياً",
                remember_me: "تذكرني"
            },
            ru: {
                visual_title: "Исследуйте мир с ИИ.",
                visual_text: "Открывайте новые направления, бронируйте без проблем и наслаждайтесь персонализированными маршрутами, созданными специально для вас.",
                login_title: "С возвращением!",
                login_subtitle: "Пожалуйста, введите свои данные для входа.",
                label_email: "Email",
                placeholder_email: "Введите ваш email",
                label_password: "Пароль",
                btn_login: "Войти",
                no_account: "Нет аккаунта?",
                create_account: "Создать бесплатный аккаунт",
                remember_me: "Запомнить меня"
            },
            zh: {
                visual_title: "与 AI 一起探索世界。",
                visual_text: "发现新目的地，无缝预订，享受专为您打造的个性化行程。",
                login_title: "欢迎回来！",
                login_subtitle: "请输入您的详细信息以登录。",
                label_email: "电子邮件",
                placeholder_email: "输入您的电子邮件",
                label_password: "密码",
                btn_login: "登录",
                no_account: "没有帐户？",
                no_account: "没有帐户？",
                create_account: "创建免费帐户",
                remember_me: "记住我"
            },
            fr: {
                visual_title: "Explorez le monde avec l'IA.",
                visual_text: "Découvrez de nouvelles destinations, réservez en toute transparence et profitez d'itinéraires personnalisés conçus spécialement pour vous.",
                login_title: "Bon retour !",
                login_subtitle: "Veuillez entrer vos coordonnées pour vous connecter.",
                label_email: "Email",
                placeholder_email: "Entrez votre email",
                label_password: "Mot de passe",
                btn_login: "Se connecter",
                no_account: "Vous n'avez pas de compte ?",
                create_account: "Créer un compte gratuit",
                remember_me: "Se souvenir de moi"
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
                document.querySelectorAll('[data-t-placeholder]').forEach(el => {
                    const key = el.getAttribute('data-t-placeholder');
                    if (langDictionary[lang][key]) {
                        el.placeholder = langDictionary[lang][key];
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
</body>

</html>