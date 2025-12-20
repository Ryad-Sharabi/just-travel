<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - Just Travel</title>
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
            min-height: 100vh;
            background: var(--bg-page);
            color: var(--text-main);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .container {
            width: 100%;
            max-width: 500px;
        }

        .card {
            background: var(--bg-card);
            border-radius: 24px;
            padding: 3rem;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
            animation: fadeInUp 0.6s ease-out;
        }

        @media(max-width: 600px) {
            .card {
                padding: 2rem;
            }
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--secondary);
            text-decoration: none;
            font-weight: 600;
            margin-bottom: 2rem;
            transition: var(--transition);
        }

        .back-link:hover {
            color: var(--primary);
            transform: translateX(-3px);
        }

        [dir="rtl"] .back-link:hover {
            transform: translateX(3px);
        }

        .icon-wrapper {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, rgba(9, 132, 227, 0.1) 0%, rgba(0, 206, 201, 0.1) 100%);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 2rem;
        }

        .icon-wrapper i {
            font-size: 2.5rem;
            background: var(--gradient-hero);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .title {
            font-size: 2rem;
            font-weight: 800;
            color: var(--text-main);
            margin-bottom: 0.75rem;
            text-align: center;
        }

        .subtitle {
            color: var(--text-muted);
            font-size: 1rem;
            text-align: center;
            margin-bottom: 2.5rem;
            line-height: 1.6;
        }

        .form-group {
            margin-bottom: 1.5rem;
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

        .btn-submit:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        .alert {
            padding: 14px 18px;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 0.95rem;
            animation: slideDown 0.3s ease-out;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        [data-theme="dark"] .alert-success {
            background: rgba(40, 167, 69, 0.2);
            color: #6cff8a;
            border-color: rgba(40, 167, 69, 0.3);
        }

        .alert-error {
            background: #ffe6e6;
            color: #d63031;
            border: 1px solid #ffb8b8;
        }

        [data-theme="dark"] .alert-error {
            background: rgba(214, 48, 49, 0.2);
            color: #ff6b6b;
            border-color: rgba(214, 48, 49, 0.3);
        }

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

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>
    <div class="top-nav">
        <button id="themeToggle" class="nav-btn">
            <i class="fa-solid fa-moon"></i>
        </button>
    </div>

    <div class="container">
        <div class="card">
            <a href="{{ route('login') }}" class="back-link">
                <i class="fa-solid fa-arrow-left"></i>
                <span data-t="back_to_login">Back to Login</span>
            </a>

            <div class="icon-wrapper">
                <i class="fa-solid fa-key"></i>
            </div>

            <h1 class="title" data-t="forgot_title">Forgot Password?</h1>
            <p class="subtitle" data-t="forgot_subtitle">Enter your email address and we'll send you a verification code to reset your password.</p>

            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fa-solid fa-circle-check"></i>
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-error">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    {{ session('error') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-error">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('password.send-code') }}" method="POST" id="forgotForm">
                @csrf
                <div class="form-group">
                    <label for="email" class="form-label" data-t="label_email">Email Address</label>
                    <div class="input-wrapper">
                        <input type="email" id="email" name="email" class="form-input" 
                            placeholder="Enter your email" data-t-placeholder="placeholder_email" 
                            value="{{ old('email') }}" required autofocus>
                        <i class="fa-regular fa-envelope input-icon"></i>
                    </div>
                </div>

                <button type="submit" class="btn-submit" id="submitBtn">
                    <span data-t="btn_send_code">Send Reset Code</span>
                    <i class="fa-solid fa-paper-plane"></i>
                </button>
            </form>
        </div>
    </div>

    <script>
        const themeToggle = document.getElementById('themeToggle');
        const sunIcon = '<i class="fa-solid fa-sun"></i>';
        const moonIcon = '<i class="fa-solid fa-moon"></i>';

        const langDictionary = {
            en: {
                back_to_login: "Back to Login",
                forgot_title: "Forgot Password?",
                forgot_subtitle: "Enter your email address and we'll send you a verification code to reset your password.",
                label_email: "Email Address",
                placeholder_email: "Enter your email",
                btn_send_code: "Send Reset Code",
                btn_sending: "Sending..."
            },
            ar: {
                back_to_login: "العودة لتسجيل الدخول",
                forgot_title: "نسيت كلمة المرور؟",
                forgot_subtitle: "أدخل عنوان بريدك الإلكتروني وسنرسل لك رمز التحقق لإعادة تعيين كلمة المرور.",
                label_email: "عنوان البريد الإلكتروني",
                placeholder_email: "أدخل بريدك الإلكتروني",
                btn_send_code: "إرسال رمز إعادة التعيين"
            },
            ru: {
                back_to_login: "Вернуться к входу",
                forgot_title: "Забыли пароль?",
                forgot_subtitle: "Введите ваш email, и мы отправим вам код подтверждения для сброса пароля.",
                label_email: "Email адрес",
                placeholder_email: "Введите ваш email",
                btn_send_code: "Отправить код"
            },
            zh: {
                back_to_login: "返回登录",
                forgot_title: "忘记密码？",
                forgot_subtitle: "输入您的电子邮件地址，我们将向您发送验证码以重置密码。",
                label_email: "电子邮件地址",
                placeholder_email: "输入您的电子邮件",
                btn_send_code: "发送重置代码"
            },
            fr: {
                back_to_login: "Retour à la connexion",
                forgot_title: "Mot de passe oublié?",
                forgot_subtitle: "Entrez votre adresse e-mail et nous vous enverrons un code de vérification pour réinitialiser votre mot de passe.",
                label_email: "Adresse e-mail",
                placeholder_email: "Entrez votre e-mail",
                btn_send_code: "Envoyer le code"
            }
        };

        function applyLang(lang) {
            document.documentElement.setAttribute('lang', lang);
            document.documentElement.dir = (lang === 'ar') ? 'rtl' : 'ltr';
            if (langDictionary[lang]) {
                document.querySelectorAll('[data-t]').forEach(el => {
                    const key = el.getAttribute('data-t');
                    if (langDictionary[lang][key]) {
                        el.textContent = langDictionary[lang][key];
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

        // Form submission handling
        document.getElementById('forgotForm').addEventListener('submit', function(e) {
            const btn = document.getElementById('submitBtn');
            btn.disabled = true;
            btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> <span data-t="btn_sending">Sending...</span>';
        });
    </script>
    @include('partials.cookie-consent')
</body>

</html>

