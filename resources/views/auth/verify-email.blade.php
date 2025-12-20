<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Email - Just Travel</title>
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
            background: url('https://images.unsplash.com/photo-1579548122080-c35fd6820ecb?q=80&w=2670&auto=format&fit=crop') no-repeat center center/cover;
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding: 4rem;
            color: white;
            display: none;
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
            margin-bottom: 2rem;
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
            line-height: 1.5;
            margin-bottom: 1.5rem;
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

        .btn-logout {
            margin-top: 1.5rem;
            background: transparent;
            border: 1px solid var(--border-color);
            padding: 12px;
            width: 100%;
            border-radius: 14px;
            color: var(--text-muted);
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
        }

        .btn-logout:hover {
            border-color: #d63031;
            color: #d63031;
            background: rgba(214, 48, 49, 0.05);
        }

        .alert-success {
            background: #e6fffa;
            color: #00b894;
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 2rem;
            border: 1px solid #b2f5ea;
            font-size: 0.9rem;
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
                <div class="visual-title" data-t="visual_title">Secure your journey.</div>
                <p class="visual-text" data-t="visual_text">Verify your email to unlock all features of Just Travel and
                    start your AI-powered adventure.</p>
            </div>
        </div>

        <!-- Form Side -->
        <div class="form-side">
            <div class="auth-header">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('images/logo.png') }}" alt="Just Travel" class="logo-img">
                </a>
                <h1 class="title" data-t="verify_title">Verify Email</h1>
                <p class="subtitle" data-t="verify_subtitle">
                    Thanks for signing up! Before getting started, could you verify your email address by clicking on
                    the link we just emailed to you?
                </p>
            </div>

            @if (session('success') == 'Verification link sent!')
                <div class="alert-success" data-t="alert_sent">
                    A new verification link has been sent to the email address you provided during registration.
                </div>
            @endif

            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="btn-submit">
                    <span data-t="btn_resend">Resend Verification Email</span> <i class="fa-regular fa-paper-plane"></i>
                </button>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn-logout" data-t="btn_logout">Log Out</button>
            </form>
        </div>
    </div>

    <script>
        const themeToggle = document.getElementById('themeToggle');
        const langToggle = document.getElementById('langToggle');
        const langDropdown = document.getElementById('langDropdown');
        const sunIcon = '<i class="fa-solid fa-sun"></i>';
        const moonIcon = '<i class="fa-solid fa-moon"></i>';

        function playClickSound() {
            try {
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
            } catch (e) { }
        }

        const langDictionary = {
            en: {
                visual_title: "Secure your journey.",
                visual_text: "Verify your email to unlock all features of Just Travel and start your AI-powered adventure.",
                verify_title: "Verify Email",
                verify_subtitle: "Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you?",
                alert_sent: "A new verification link has been sent to the email address you provided during registration.",
                btn_resend: "Resend Verification Email",
                btn_logout: "Log Out"
            },
            ar: {
                visual_title: "قم بتأمين رحلتك.",
                visual_text: "تحقق من بريدك الإلكتروني لفتح جميع ميزات Just Travel وابدأ مغامرتك المدعومة بالذكاء الاصطناعي.",
                verify_title: "تحقق من البريد الإلكتروني",
                verify_subtitle: "شكراً لتسجيلك! قبل البدء، هل يمكنك التحقق من عنوان بريدك الإلكتروني من خلال النقر على الرابط الذي أرسلناه إليك للتو؟",
                alert_sent: "تم إرسال رابط تحقق جديد إلى عنوان البريد الإلكتروني الذي قدمته أثناء التسجيل.",
                btn_resend: "إعادة إرسال بريد التحقق",
                btn_logout: "تسجيل الخروج"
            },
            ru: {
                visual_title: "Защитите свое путешествие.",
                visual_text: "Подтвердите свой email, чтобы разблокировать все функции Just Travel и начать приключение с ИИ.",
                verify_title: "Подтвердите Email",
                verify_subtitle: "Спасибо за регистрацию! Прежде чем начать, подтвердите свой email, нажав на ссылку, которую мы вам отправили.",
                alert_sent: "Новая ссылка для подтверждения была отправлена на указанный вами email.",
                btn_resend: "Отправить письмо повторно",
                btn_logout: "Выйти"
            },
            zh: {
                visual_title: "保障您的旅程。",
                visual_text: "验证您的电子邮件以解锁 Just Travel 的所有功能并开始您的 AI 驱动的冒险。",
                verify_title: "验证电子邮件",
                verify_subtitle: "感谢注册！在开始之前，能否请您点击我们刚刚发送给您的链接来验证您的电子邮件地址？",
                alert_sent: "新的验证链接已发送到您注册时提供的电子邮件地址。",
                btn_resend: "重新发送验证邮件",
                btn_logout: "退出"
            },
            fr: {
                visual_title: "Sécurisez votre voyage.",
                visual_text: "Vérifiez votre email pour débloquer toutes les fonctionnalités de Just Travel et commencer votre aventure alimentée par l'IA.",
                verify_title: "Vérifier l'email",
                verify_subtitle: "Merci de votre inscription ! Avant de commencer, pourriez-vous vérifier votre adresse email en cliquant sur le lien que nous venons de vous envoyer ?",
                alert_sent: "Un nouveau lien de vérification a été envoyé à l'adresse email fournie lors de l'inscription.",
                btn_resend: "Renvoyer l'email de vérification",
                btn_logout: "Déconnexion"
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
</body>

</html>