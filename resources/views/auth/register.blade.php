<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account - Just Travel</title>
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
            background: url('https://images.unsplash.com/photo-1502791451862-7bd8c1df43a7?q=80&w=2664&auto=format&fit=crop') no-repeat center center/cover;
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
            padding: 2rem 5rem;
            position: relative;
            background: var(--bg-card);
            overflow-y: auto;
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
            height: 45px;
            margin-bottom: 1.5rem;
            border-radius: 10px;
        }

        .title {
            font-size: 2rem;
            font-weight: 800;
            color: var(--text-main);
            margin-bottom: 0.5rem;
            letter-spacing: -1px;
        }

        .subtitle {
            color: var(--gray);
            font-size: 0.95rem;
        }

        .form-row {
            display: flex;
            gap: 15px;
        }

        .form-group {
            margin-bottom: 1.2rem;
            position: relative;
            flex: 1;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--text-main);
            font-weight: 600;
            font-size: 0.9rem;
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
            padding: 14px 20px 14px 45px;
            border: 2px solid var(--border-color);
            border-radius: 14px;
            font-size: 0.95rem;
            color: var(--text-main);
            background: var(--bg-input);
            transition: var(--transition);
            outline: none;
        }

        [dir="rtl"] .form-input {
            padding: 14px 45px 14px 20px;
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
            margin-top: 2rem;
            text-align: center;
            font-size: 0.95rem;
            color: var(--gray);
            padding-bottom: 2rem;
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

        /* Profile Upload Styles */
        .profile-upload-container {
            position: relative;
            cursor: pointer;
            width: 120px;
            margin: 0 auto;
        }

        .profile-upload-gradient {
            padding: 4px;
            background: var(--gradient-hero);
            border-radius: 50%;
            display: inline-block;
            position: relative;
            transition: transform 0.3s ease;
        }

        .profile-upload-gradient:hover {
            transform: scale(1.05);
        }

        .profile-upload-label {
            display: block;
            width: 110px;
            height: 110px;
            border-radius: 50%;
            overflow: hidden;
            position: relative;
            background: var(--bg-card);
            border: 4px solid var(--bg-card);
        }

        .profile-preview {
            width: 100%;
            height: 100%;
            object-fit: cover;
            background-color: var(--bg-page);
        }

        .default-avatar-icon {
            width: 100%;
            height: 100%;
            background: var(--bg-page);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3.5rem;
            color: var(--border-color);
            transition: var(--transition);
        }

        .profile-upload-gradient:hover .default-avatar-icon {
            color: var(--secondary);
            background: var(--bg-input);
        }

        .upload-fab {
            position: absolute;
            bottom: 5px;
            right: 5px;
            width: 32px;
            height: 32px;
            background: var(--dark);
            border: 3px solid var(--bg-card);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 0.9rem;
            z-index: 5;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }

        .profile-upload-container:hover .upload-fab {
            background: var(--secondary);
            transform: scale(1.1) rotate(10deg);
        }

        .hidden-file-input {
            width: 0.1px;
            height: 0.1px;
            opacity: 0;
            overflow: hidden;
            position: absolute;
            z-index: -1;
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
                <div class="visual-title" data-t="visual_title">Join the adventure.</div>
                <p class="visual-text" data-t="visual_text">Create your account to start planning trips with AI, saving
                    favorites, and exploring the world effortlessly.</p>
            </div>
        </div>

        <!-- Form Side -->
        <div class="form-side">
            <div class="auth-header">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('images/logo.png') }}" alt="Just Travel" class="logo-img">
                </a>
                <h1 class="title" data-t="reg_title">Create Account</h1>
                <p class="subtitle" data-t="reg_subtitle">Enter your details to get started.</p>
            </div>

            @if(session('error'))
                <div class="alert-error">
                    <i class="fa-solid fa-circle-exclamation"></i> {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('register.post') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Profile Image Upload (Top) -->
                <div class="form-group" style="display: flex; justify-content: center; margin-bottom: 2rem;">
                    <div class="profile-upload-container">
                        <label for="profile_image" class="profile-upload-gradient">
                            <div class="profile-upload-label">
                                <div id="avatar-icon" class="default-avatar-icon">
                                    <i class="fa-solid fa-user"></i>
                                </div>
                                <img id="profile-preview" src="" alt="Profile" class="profile-preview"
                                    style="display: none;">
                            </div>
                            <div class="upload-fab">
                                <i class="fa-solid fa-camera"></i>
                            </div>
                        </label>
                        <input type="file" id="profile_image" name="profile_image" accept="image/*"
                            class="hidden-file-input" onchange="previewImage(event)">
                        <p style="text-align: center; font-size: 0.85rem; color: #b2bec3; margin-top: 15px; font-weight: 500;"
                            data-t="upload_photo">
                            Upload Profile Photo
                        </p>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="first_name" class="form-label" data-t="label_fname">First Name</label>
                        <div class="input-wrapper">
                            <input type="text" id="first_name" name="first_name" class="form-input" placeholder="John"
                                data-t-placeholder="placeholder_fname" required>
                            <i class="fa-regular fa-user input-icon"></i>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="last_name" class="form-label" data-t="label_lname">Last Name</label>
                        <div class="input-wrapper">
                            <input type="text" id="last_name" name="last_name" class="form-input" placeholder="Doe"
                                data-t-placeholder="placeholder_lname" required>
                            <i class="fa-regular fa-user input-icon"></i>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="email" class="form-label" data-t="label_email">Email Address</label>
                    <div class="input-wrapper">
                        <input type="email" id="email" name="email" class="form-input" placeholder="example@gmail.com"
                            data-t-placeholder="placeholder_email" required>
                        <i class="fa-regular fa-envelope input-icon"></i>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="password" class="form-label" data-t="label_password">Password</label>
                        <div class="input-wrapper">
                            <input type="password" id="password" name="password" class="form-input"
                                placeholder="Min 6 chars" data-t-placeholder="placeholder_password" required>
                            <i class="fa-solid fa-lock input-icon"></i>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation" class="form-label" data-t="label_confirm">Confirm</label>
                        <div class="input-wrapper">
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                class="form-input" placeholder="Re-enter" data-t-placeholder="placeholder_confirm"
                                required>
                            <i class="fa-solid fa-check-double input-icon"></i>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn-submit">
                    <span data-t="btn_register">Get Started</span> <i class="fa-solid fa-arrow-right"></i>
                </button>
            </form>

            <div class="footer-links">
                <span data-t="already_account">Already have an account?</span> <a href="{{ route('login') }}"
                    class="link-highlight" data-t="sign_in">Sign In</a>
            </div>
        </div>
    </div>
    <script>
        function previewImage(event) {
            const input = event.target;
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const img = document.getElementById('profile-preview');
                    const icon = document.getElementById('avatar-icon');
                    img.src = e.target.result;
                    img.style.display = 'block';
                    icon.style.display = 'none';
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

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
                visual_title: "Join the adventure.",
                visual_text: "Create your account to start planning trips with AI, saving favorites, and exploring the world effortlessly.",
                reg_title: "Create Account",
                reg_subtitle: "Enter your details to get started.",
                upload_photo: "Upload Profile Photo",
                label_fname: "First Name",
                placeholder_fname: "John",
                label_lname: "Last Name",
                placeholder_lname: "Doe",
                label_email: "Email Address",
                placeholder_email: "example@gmail.com",
                label_password: "Password",
                placeholder_password: "Min 6 chars",
                label_confirm: "Confirm",
                placeholder_confirm: "Re-enter",
                btn_register: "Get Started",
                already_account: "Already have an account?",
                sign_in: "Sign In"
            },
            ar: {
                visual_title: "انضم إلى المغامرة.",
                visual_text: "أنشئ حسابك لبدء التخطيط للرحلات بالذكاء الاصطناعي، وحفظ مفضلاتك، واستكشاف العالم بسهولة.",
                reg_title: "إنشاء حساب",
                reg_subtitle: "أدخل بياناتك للبدء.",
                upload_photo: "تحميل صورة الملف الشخصي",
                label_fname: "الاسم الأول",
                placeholder_fname: "أحمد",
                label_lname: "الاسم الأخير",
                placeholder_lname: "علي",
                label_email: "البريد الإلكتروني",
                placeholder_email: "example@gmail.com",
                label_password: "كلمة المرور",
                placeholder_password: "6 أحرف على الأقل",
                label_confirm: "تأكيد كلمة المرور",
                placeholder_confirm: "أعد الإدخال",
                btn_register: "ابدأ الآن",
                already_account: "لديك حساب بالفعل؟",
                sign_in: "تسجيل الدخول"
            },
            ru: {
                visual_title: "Присоединяйтесь к приключению.",
                visual_text: "Создайте аккаунт, чтобы планировать поездки с ИИ, сохранять избранное и легко исследовать мир.",
                reg_title: "Создать аккаунт",
                reg_subtitle: "Введите данные для начала.",
                upload_photo: "Загрузить фото",
                label_fname: "Имя",
                placeholder_fname: "Иван",
                label_lname: "Фамилия",
                placeholder_lname: "Иванов",
                label_email: "Email",
                placeholder_email: "example@gmail.com",
                label_password: "Пароль",
                placeholder_password: "Мин. 6 символов",
                label_confirm: "Подтвердите",
                placeholder_confirm: "Повторите ввод",
                btn_register: "Начать",
                already_account: "Уже есть аккаунт?",
                sign_in: "Войти"
            },
            zh: {
                visual_title: "加入冒险。",
                visual_text: "创建您的帐户，即可开始使用 AI 规划旅行，保存收藏夹并轻松探索世界。",
                reg_title: "创建帐户",
                reg_subtitle: "输入您的详细信息以开始。",
                upload_photo: "上传个人资料照片",
                label_fname: "名字",
                placeholder_fname: "John",
                label_lname: "姓氏",
                placeholder_lname: "Doe",
                label_email: "电子邮件地址",
                placeholder_email: "example@gmail.com",
                label_password: "密码",
                placeholder_password: "至少 6 个字符",
                label_confirm: "确认",
                placeholder_confirm: "重新输入",
                btn_register: "立即开始",
                already_account: "已有帐户？",
                sign_in: "登录"
            },
            fr: {
                visual_title: "Rejoignez l'aventure.",
                visual_text: "Créez votre compte pour commencer à planifier des voyages avec l'IA, enregistrer vos favoris et explorer le monde sans effort.",
                reg_title: "Créer un compte",
                reg_subtitle: "Entrez vos coordonnées pour commencer.",
                upload_photo: "Télécharger une photo de profil",
                label_fname: "Prénom",
                placeholder_fname: "Jean",
                label_lname: "Nom",
                placeholder_lname: "Dupont",
                label_email: "Adresse Email",
                placeholder_email: "exemple@gmail.com",
                label_password: "Mot de passe",
                placeholder_password: "Min 6 caractères",
                label_confirm: "Confirmer",
                placeholder_confirm: "Entrez à nouveau",
                btn_register: "Commencer",
                already_account: "Vous avez déjà un compte ?",
                sign_in: "Se connecter"
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
    @include('partials.cookie-consent')
    @include('partials.whatsapp-button')
</body>

</html>