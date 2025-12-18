<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Privacy Policy - Just Travel</title>
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
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 0 2rem;
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

        /* Policy Content */
        .policy-header {
            padding: 6rem 0 3rem;
            text-align: center;
        }

        .policy-title {
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 1rem;
            background: var(--gradient-hero);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .last-updated {
            color: var(--text-muted);
            font-weight: 500;
        }

        .policy-card {
            background: var(--bg-card);
            border-radius: 30px;
            padding: 3rem;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--border-color);
            margin-bottom: 5rem;
        }

        .policy-section {
            margin-bottom: 2.5rem;
        }

        .policy-section h2 {
            font-size: 1.8rem;
            color: var(--secondary);
            margin-bottom: 1.2rem;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .policy-section h2 i {
            font-size: 1.4rem;
            opacity: 0.8;
        }

        .policy-section p {
            color: var(--text-main);
            font-size: 1.1rem;
            margin-bottom: 1rem;
            opacity: 0.9;
        }

        .policy-section ul {
            margin-left: 1.5rem;
            margin-bottom: 1rem;
            color: var(--text-main);
            opacity: 0.9;
        }

        [dir="rtl"] .policy-section ul {
            margin-left: 0;
            margin-right: 1.5rem;
        }

        .policy-section ul li {
            margin-bottom: 0.5rem;
        }

        /* Footer */
        footer {
            background: var(--bg-footer);
            color: #bdc3c7;
            padding: 4rem 0 2rem;
            text-align: center;
        }

        .footer-logo {
            font-size: 1.8rem;
            font-weight: 800;
            color: var(--white);
            margin-bottom: 1rem;
            display: inline-block;
            background: var(--gradient-hero);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-decoration: none;
        }

        @media (max-width: 768px) {
            .policy-title {
                font-size: 2.2rem;
            }

            .policy-card {
                padding: 2rem;
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

    <main class="container">
        <div class="policy-header">
            <h1 class="policy-title" data-t="policy_title">Privacy Policy</h1>
            <p class="last-updated"><span data-t="last_updated">Last Updated</span>: {{ date('F d, Y') }}</p>
        </div>

        <div class="policy-card">
            <div class="policy-section">
                <h2><i class="fa-solid fa-shield-halved"></i> <span data-t="s1_title">1. Introduction</span></h2>
                <p data-t="s1_desc">Welcome to Just Travel. We are committed to protecting your personal information and
                    your right to privacy. If you have any questions or concerns about our policy, or our practices with
                    regards to your personal information, please contact us.</p>
            </div>

            <div class="policy-section">
                <h2><i class="fa-solid fa-database"></i> <span data-t="s2_title">2. Information We Collect</span></h2>
                <p data-t="s2_desc">We collect information that you provide to us directly when you register on our
                    platform, use the JustMine AI assistant, or submit feedback. This includes:</p>
                <ul>
                    <li data-t="s2_i1">Personal identity information (Name, Email).</li>
                    <li data-t="s2_i2">Travel preferences and search history.</li>
                    <li data-t="s2_i3">Chat conversations with our AI assistant to improve recommendations.</li>
                </ul>
            </div>

            <div class="policy-section">
                <h2><i class="fa-solid fa-robot"></i> <span data-t="s3_title">3. How We Use AI (JustMine)</span></h2>
                <p data-t="s3_desc">Our "JustMine" AI Assistant uses the Gemini API to process your travel queries and
                    generate personalized itineraries. Your conversation data is specifically used to:</p>
                <ul>
                    <li data-t="s3_i1">Provide accurate destination suggestions based on weather and budget.</li>
                    <li data-t="s3_i2">Generate custom travel plans and itineraries.</li>
                    <li data-t="s3_i3">Improve our AI model's understanding of user preferences.</li>
                </ul>
            </div>

            <div class="policy-section">
                <h2><i class="fa-solid fa-lock"></i> <span data-t="s4_title">4. Data Security</span></h2>
                <p data-t="s4_desc">We implement a variety of security measures to maintain the safety of your personal
                    information. We use state-of-the-art encryption to protect your data during transmission and while
                    at rest in our databases.</p>
            </div>

            <div class="policy-section">
                <h2><i class="fa-solid fa-cookie-bite"></i> <span data-t="s5_title">5. Cookies</span></h2>
                <p data-t="s5_desc">We use cookies to enhance your experience, remember your login details, and track
                    your preferences (like your Dark Mode settings). You can choose to disable cookies through your
                    browser settings, but it may affect some features of the platform.</p>
            </div>

            <div class="policy-section">
                <h2><i class="fa-solid fa-envelope"></i> <span data-t="s6_title">6. Contact Us</span></h2>
                <p data-t="s6_desc">If you have any questions about this Privacy Policy, you can reach out to our team
                    at info@justtravel.pro.</p>
            </div>
        </div>
    </main>

    <footer>
        <div class="container">
            <a href="{{ url('/') }}" class="footer-logo">Just Travel.</a>
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
                policy_title: "Privacy Policy",
                last_updated: "Last Updated",
                s1_title: "1. Introduction",
                s1_desc: "Welcome to Just Travel. We are committed to protecting your personal information and your right to privacy. If you have any questions or concerns about our policy, or our practices with regards to your personal information, please contact us.",
                s2_title: "2. Information We Collect",
                s2_desc: "We collect information that you provide to us directly when you register on our platform, use the JustMine AI assistant, or submit feedback. This includes:",
                s2_i1: "Personal identity information (Name, Email).",
                s2_i2: "Travel preferences and search history.",
                s2_i3: "Chat conversations with our AI assistant to improve recommendations.",
                s3_title: "3. How We Use AI (JustMine)",
                s3_desc: 'Our "JustMine" AI Assistant uses the Gemini API to process your travel queries and generate personalized itineraries. Your conversation data is specifically used to:',
                s3_i1: "Provide accurate destination suggestions based on weather and budget.",
                s3_i2: "Generate custom travel plans and itineraries.",
                s3_i3: "Improve our AI model's understanding of user preferences.",
                s4_title: "4. Data Security",
                s4_desc: "We implement a variety of security measures to maintain the safety of your personal information. We use state-of-the-art encryption to protect your data during transmission and while at rest in our databases.",
                s5_title: "5. Cookies",
                s5_desc: "We use cookies to enhance your experience, remember your login details, and track your preferences (like your Dark Mode settings). You can choose to disable cookies through your browser settings, but it may affect some features of the platform.",
                s6_title: "6. Contact Us",
                s6_desc: "If you have any questions about this Privacy Policy, you can reach out to our team at info@justtravel.pro.",
                footer_copy: "© {{ date('Y') }} Just Travel Inc. All rights reserved."
            },
            ar: {
                brand_name: "جست ترافل.",
                policy_title: "سياسة الخصوصية",
                last_updated: "آخر تحديث",
                s1_title: "1. مقدمة",
                s1_desc: "مرحبًا بك في جست ترافل. نحن ملتزمون بحماية معلوماتك الشخصية وحقك في الخصوصية. إذا كان لديك أي أسئلة أو استفسارات حول سياستنا، أو ممارساتنا فيما يتعلق بمعلوماتك الشخصية، يرجى الاتصال بنا.",
                s2_title: "2. المعلومات التي نجمعها",
                s2_desc: "نحن نجمع المعلومات التي تقدمها لنا مباشرة عند التسجيل في منصتنا، أو استخدام مساعد JustMine الذكي، أو تقديم الملاحظات. يشمل ذلك:",
                s2_i1: "معلومات الهوية الشخصية (الاسم، البريد الإلكتروني).",
                s2_i2: "تفضيلات السفر وسجل البحث.",
                s2_i3: "محادثات الدردشة مع مساعدنا الذكي لتحسين التوصيات.",
                s3_title: "3. كيف نستخدم الذكاء الاصطناعي (JustMine)",
                s3_desc: 'يستخدم مساعدنا "JustMine" واجهة برمجة تطبيقات Gemini لمعالجة استفسارات السفر الخاصة بك وإنشاء مسارات مخصصة. تُستخدم بيانات المحادثة الخاصة بك خصيصًا لـ:',
                s3_i1: "تقديم اقتراحات دقيقة للوجهات بناءً على الطقس والميزانية.",
                s3_i2: "إنشاء خطط ومسارات سفر مخصصة.",
                s3_i3: "تحسين فهم نموذج الذكاء الاصطناعي الخاص بنا لتفضيلات المستخدم.",
                s4_title: "4. أمن البيانات",
                s4_desc: "نحن نطبق مجموعة متنوعة من الإجراءات الأمنية للحفاظ على سلامة معلوماتك الشخصية. نستخدم تشفيرًا متطورًا لحماية بياناتك أثناء الإرسال وأثناء حفظها في قواعد بياناتنا.",
                s5_title: "5. ملفات تعريف الارتباط (Cookies)",
                s5_desc: "نحن نستخدم ملفات تعريف الارتباط لتحسين تجربتك، وتذكر تفاصيل تسجيل الدخول الخاصة بك، وتتبع تفضيلاتك (مثل إعدادات الوضع الداكن). يمكنك اختيار تعطيل ملفات تعريف الارتباط من خلال إعدادات متصفحك، ولكن قد يؤثر ذلك على بعض ميزات المنصة.",
                s6_title: "6. اتصل بنا",
                s6_desc: "إذا كان لديك أي أسئلة حول سياسة الخصوصية هذه، يمكنك التواصل مع فريقنا على info@justtravel.pro.",
                footer_copy: "© {{ date('Y') }} جست ترافل. جميع الحقوق محفوظة."
            },
            ru: {
                brand_name: "Just Travel.",
                policy_title: "Политика конфиденциальности",
                last_updated: "Последнее обновление",
                s1_title: "1. Введение",
                s1_desc: "Добро пожаловать в Just Travel. Мы защищаем вашу личную информацию. Свяжитесь с нами при возникновении вопросов.",
                s2_title: "2. Информация, которую мы собираем",
                s2_desc: "Мы собираем данные, которые вы предоставляете при регистрации, использовании AI или обратной связи. Это включает:",
                s2_i1: "Личные данные (Имя, Email).",
                s2_i2: "Предпочтения и история поиска.",
                s2_i3: "Чаты с AI для улучшения рекомендаций.",
                s3_title: "3. Как мы используем AI (JustMine)",
                s3_desc: 'Наш AI-ассистент "JustMine" использует Gemini API для обработки запросов. Ваши данные используются для:',
                s3_i1: "Точных предложений направлений.",
                s3_i2: "Создания маршрутов.",
                s3_i3: "Обучения модели предпочтениям пользователей.",
                s4_title: "4. Безопасность данных",
                s4_desc: "Мы используем шифрование для защиты ваших данных при передаче и хранении.",
                s5_title: "5. Cookies",
                s5_desc: "Мы используем cookies для улучшения опыта и сохранения настроек. Вы можете отключить их в браузере.",
                s6_title: "6. Связаться с нами",
                s6_desc: "По вопросам Политики обращайтесь на info@justtravel.pro.",
                footer_copy: "© {{ date('Y') }} Just Travel Inc. Все права защищены."
            },
            zh: {
                brand_name: "Just Travel.",
                policy_title: "隐私政策",
                last_updated: "最后更新",
                s1_title: "1. 简介",
                s1_desc: "欢迎来到 Just Travel。我们致力于保护您的个人信息和隐私权。如果您对我们的政策或我们关于您的个人信息的做法有任何疑问或疑虑，请联系我们。",
                s2_title: "2. 我们收集的信息",
                s2_desc: "当您在我们的平台上注册、使用 JustMine AI 助手或提交反馈时，我们会收集您直接提供给我们的信息。这包括：",
                s2_i1: "个人身份信息（姓名，电子邮件）。",
                s2_i2: "旅行偏好和搜索历史。",
                s2_i3: "与我们 AI 助手的聊天对话，以改进推荐。",
                s3_title: "3. 我们如何使用 AI (JustMine)",
                s3_desc: '我们的 "JustMine" AI 助手使用 Gemini API 处理您的旅行查询并生成个性化行程。您的对话数据专门用于：',
                s3_i1: "根据天气和预算提供准确的目的地建议。",
                s3_i2: "生成自定义旅行计划和行程。",
                s3_i3: "提高我们的 AI 模型对用户偏好的理解。",
                s4_title: "4. 数据安全",
                s4_desc: "我们采取各种安全措施来保护您的个人信息的安全。我们使用最先进的加密技术来保护您的数据在传输过程中和在我们数据库中静止时的安全。",
                s5_title: "5. Cookie",
                s5_desc: "我们使用 cookie 来增强您的体验，记住您的登录详细信息，并跟踪您的偏好（如您的深色模式设置）。您可以选择通过浏览器设置禁用 cookie，但这可能会影响平台的某些功能。",
                s6_title: "6. 联系我们",
                s6_desc: "如果您对本隐私政策有任何疑问，可以联系我们的团队：info@justtravel.pro。",
                footer_copy: "© {{ date('Y') }} Just Travel Inc. 保留所有权利。"
            },
            fr: {
                brand_name: "Just Travel.",
                policy_title: "Politique de Confidentialité",
                last_updated: "Dernière mise à jour",
                s1_title: "1. Introduction",
                s1_desc: "Bienvenue chez Just Travel. Nous nous engageons à protéger vos informations personnelles et votre droit à la vie privée. Si vous avez des questions ou des préoccupations concernant notre politique ou nos pratiques concernant vos informations personnelles, veuillez nous contacter.",
                s2_title: "2. Informations que nous collectons",
                s2_desc: "Nous collectons les informations que vous nous fournissez directement lorsque vous vous inscrivez sur notre plateforme, utilisez l'assistant IA JustMine ou soumettez des commentaires. Cela comprend :",
                s2_i1: "Informations d'identité personnelle (Nom, Email).",
                s2_i2: "Préférences de voyage et historique de recherche.",
                s2_i3: "Conversations par chat avec notre assistant IA pour améliorer les recommandations.",
                s3_title: "3. Comment nous utilisons l'IA (JustMine)",
                s3_desc: 'Notre assistant IA "JustMine" utilise l\'API Gemini pour traiter vos demandes de voyage et générer des itinéraires personnalisés. Les données de votre conversation sont spécifiquement utilisées pour :',
                s3_i1: "Fournir des suggestions de destination précises basées sur la météo et le budget.",
                s3_i2: "Générer des plans de voyage et des itinéraires personnalisés.",
                s3_i3: "Améliorer la compréhension des préférences des utilisateurs par notre modèle IA.",
                s4_title: "4. Sécurité des données",
                s4_desc: "Nous mettons en œuvre une variété de mesures de sécurité pour maintenir la sécurité de vos informations personnelles. Nous utilisons un cryptage de pointe pour protéger vos données pendant la transmission et lorsqu'elles sont stockées dans nos bases de données.",
                s5_title: "5. Cookies",
                s5_desc: "Nous utilisons des cookies pour améliorer votre expérience, mémoriser vos informations de connexion et suivre vos préférences (comme vos paramètres de mode sombre). Vous pouvez choisir de désactiver les cookies via les paramètres de votre navigateur, mais cela peut affecter certaines fonctionnalités de la plateforme.",
                s6_title: "6. Contactez-nous",
                s6_desc: "Si vous avez des questions sur cette politique de confidentialité, vous pouvez contacter notre équipe à info@justtravel.pro.",
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
</body>

</html>