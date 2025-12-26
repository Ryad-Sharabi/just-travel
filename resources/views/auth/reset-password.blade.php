<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Just Travel</title>
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

        .code-input {
            text-align: center;
            font-size: 1.5rem;
            letter-spacing: 8px;
            font-weight: 700;
            padding: 16px 20px;
        }

        .password-toggle {
            position: absolute;
            right: 18px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #b2bec3;
            transition: var(--transition);
        }

        [dir="rtl"] .password-toggle {
            right: auto;
            left: 18px;
        }

        .password-toggle:hover {
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
            <a href="{{ route('password.forgot') }}" class="back-link">
                <i class="fa-solid fa-arrow-left"></i>
                <span data-t="back_to_forgot">Back</span>
            </a>

            <div class="icon-wrapper">
                <i class="fa-solid fa-lock"></i>
            </div>

            <h1 class="title" data-t="reset_title">Reset Password</h1>
            <p class="subtitle" data-t="reset_subtitle">Enter the verification code sent to your email and create a new password.</p>

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

            <form action="{{ route('password.reset.post') }}" method="POST" id="resetForm">
                @csrf
                <div class="form-group">
                    <label for="code" class="form-label" data-t="label_code">Verification Code</label>
                    <div class="input-wrapper">
                        <input type="text" id="code" name="code" class="form-input code-input" 
                            placeholder="000000" maxlength="6" pattern="[0-9]{6}" 
                            inputmode="numeric" required autofocus>
                        <i class="fa-solid fa-shield-halved input-icon"></i>
                    </div>
                    <small style="color: var(--text-muted); font-size: 0.85rem; margin-top: 0.5rem; display: block;" data-t="code_hint">Enter the 6-digit code sent to your email</small>
                </div>

                <div class="form-group">
                    <label for="password" class="form-label" data-t="label_password">New Password</label>
                    <div class="input-wrapper">
                        <input type="password" id="password" name="password" class="form-input" 
                            placeholder="Enter new password" data-t-placeholder="placeholder_password" 
                            minlength="6" required>
                        <i class="fa-solid fa-lock input-icon"></i>
                        <span class="password-toggle" onclick="togglePassword('password')">
                            <i class="fa-solid fa-eye" id="passwordToggle"></i>
                        </span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password_confirmation" class="form-label" data-t="label_confirm_password">Confirm Password</label>
                    <div class="input-wrapper">
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-input" 
                            placeholder="Confirm new password" data-t-placeholder="placeholder_confirm_password" 
                            minlength="6" required>
                        <i class="fa-solid fa-lock input-icon"></i>
                        <span class="password-toggle" onclick="togglePassword('password_confirmation')">
                            <i class="fa-solid fa-eye" id="passwordConfirmationToggle"></i>
                        </span>
                    </div>
                </div>

                <button type="submit" class="btn-submit" id="submitBtn">
                    <span data-t="btn_reset">Reset Password</span>
                    <i class="fa-solid fa-check"></i>
                </button>
            </form>
        </div>
    </div>

    <script>
        const themeToggle = document.getElementById('themeToggle');
        const sunIcon = '<i class="fa-solid fa-sun"></i>';
        const moonIcon = '<i class="fa-solid fa-moon"></i>';

        // Code input formatting
        document.getElementById('code').addEventListener('input', function(e) {
            this.value = this.value.replace(/[^0-9]/g, '');
        });

        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const toggle = document.getElementById(fieldId + 'Toggle');
            if (field.type === 'password') {
                field.type = 'text';
                toggle.classList.remove('fa-eye');
                toggle.classList.add('fa-eye-slash');
            } else {
                field.type = 'password';
                toggle.classList.remove('fa-eye-slash');
                toggle.classList.add('fa-eye');
            }
        }

        const langDictionary = {
            en: {
                back_to_forgot: "Back",
                reset_title: "Reset Password",
                reset_subtitle: "Enter the verification code sent to your email and create a new password.",
                label_code: "Verification Code",
                code_hint: "Enter the 6-digit code sent to your email",
                label_password: "New Password",
                placeholder_password: "Enter new password",
                label_confirm_password: "Confirm Password",
                placeholder_confirm_password: "Confirm new password",
                btn_reset: "Reset Password",
                btn_resetting: "Resetting..."
            },
            ar: {
                back_to_forgot: "رجوع",
                reset_title: "إعادة تعيين كلمة المرور",
                reset_subtitle: "أدخل رمز التحقق المرسل إلى بريدك الإلكتروني وأنشئ كلمة مرور جديدة.",
                label_code: "رمز التحقق",
                code_hint: "أدخل الرمز المكون من 6 أرقام المرسل إلى بريدك الإلكتروني",
                label_password: "كلمة المرور الجديدة",
                placeholder_password: "أدخل كلمة المرور الجديدة",
                label_confirm_password: "تأكيد كلمة المرور",
                placeholder_confirm_password: "أكد كلمة المرور الجديدة",
                btn_reset: "إعادة تعيين كلمة المرور"
            },
            ru: {
                back_to_forgot: "Назад",
                reset_title: "Сброс пароля",
                reset_subtitle: "Введите код подтверждения, отправленный на ваш email, и создайте новый пароль.",
                label_code: "Код подтверждения",
                code_hint: "Введите 6-значный код, отправленный на ваш email",
                label_password: "Новый пароль",
                placeholder_password: "Введите новый пароль",
                label_confirm_password: "Подтвердите пароль",
                placeholder_confirm_password: "Подтвердите новый пароль",
                btn_reset: "Сбросить пароль"
            },
            zh: {
                back_to_forgot: "返回",
                reset_title: "重置密码",
                reset_subtitle: "输入发送到您电子邮件的验证码并创建新密码。",
                label_code: "验证码",
                code_hint: "输入发送到您电子邮件的6位数字代码",
                label_password: "新密码",
                placeholder_password: "输入新密码",
                label_confirm_password: "确认密码",
                placeholder_confirm_password: "确认新密码",
                btn_reset: "重置密码"
            },
            fr: {
                back_to_forgot: "Retour",
                reset_title: "Réinitialiser le mot de passe",
                reset_subtitle: "Entrez le code de vérification envoyé à votre e-mail et créez un nouveau mot de passe.",
                label_code: "Code de vérification",
                code_hint: "Entrez le code à 6 chiffres envoyé à votre e-mail",
                label_password: "Nouveau mot de passe",
                placeholder_password: "Entrez le nouveau mot de passe",
                label_confirm_password: "Confirmer le mot de passe",
                placeholder_confirm_password: "Confirmer le nouveau mot de passe",
                btn_reset: "Réinitialiser le mot de passe"
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
        document.getElementById('resetForm').addEventListener('submit', function(e) {
            const btn = document.getElementById('submitBtn');
            btn.disabled = true;
            btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> <span data-t="btn_resetting">Resetting...</span>';
        });
    </script>
    @include('partials.cookie-consent')
    @include('partials.whatsapp-button')
</body>

</html>

