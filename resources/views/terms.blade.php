<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Terms & Conditions - Just Travel</title>
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
            --text-main: #2d3436;
            --text-muted: #636e72;
            --border-color: rgba(0, 0, 0, 0.05);
            --gradient-hero: linear-gradient(135deg, #0984e3 0%, #00cec9 100%);
            --transition: all 0.3s ease;
        }

        [data-theme="dark"] {
            --bg-page: #0f172a;
            --bg-card: #1e293b;
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
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        header {
            background: var(--bg-card);
            border-bottom: 1px solid var(--border-color);
            padding: 1.5rem 0;
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

        /* Terms Content */
        .content-section {
            padding: 5rem 0;
        }

        .terms-header {
            text-align: center;
            margin-bottom: 5rem;
        }

        .terms-header h1 {
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 1rem;
            background: var(--gradient-hero);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .last-updated {
            color: var(--text-muted);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-size: 0.8rem;
        }

        .terms-card {
            background: var(--bg-card);
            border-radius: 40px;
            padding: 4rem;
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--border-color);
        }

        .term-block {
            margin-bottom: 3.5rem;
        }

        .term-block:last-child {
            margin-bottom: 0;
        }

        .term-block h2 {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 15px;
            color: var(--secondary);
        }

        .term-block h2 i {
            font-size: 1.2rem;
            opacity: 0.8;
        }

        .term-block p {
            font-size: 1.1rem;
            color: var(--text-muted);
            margin-bottom: 1rem;
        }

        .term-block ul {
            list-style: none;
            padding-left: 1rem;
        }

        [dir="rtl"] .term-block ul {
            padding-left: 0;
            padding-right: 1rem;
        }

        .term-block ul li {
            position: relative;
            padding-left: 25px;
            margin-bottom: 1rem;
            color: var(--text-muted);
            font-size: 1.05rem;
        }

        [dir="rtl"] .term-block ul li {
            padding-left: 0;
            padding-right: 25px;
        }

        .term-block ul li::before {
            content: "\f00c";
            font-family: "Font Awesome 6 Free";
            font-weight: 900;
            position: absolute;
            left: 0;
            color: var(--primary);
            font-size: 0.9rem;
        }

        [dir="rtl"] .term-block ul li::before {
            left: auto;
            right: 0;
        }

        footer {
            padding: 4rem 0;
            text-align: center;
            color: var(--text-muted);
            border-top: 1px solid var(--border-color);
            margin-top: 5rem;
        }

        @media (max-width: 768px) {
            .terms-header h1 {
                font-size: 2.5rem;
            }

            .terms-card {
                padding: 2.5rem 1.5rem;
                border-radius: 30px;
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

    <main class="content-section">
        <div class="container">
            <div class="terms-header">
                <span class="last-updated"><span data-t="last_updated">Last Updated</span>: March 2024</span>
                <h1 data-t="terms_title">Terms & Conditions</h1>
                <p style="color: var(--text-muted); max-width: 600px; margin: 1rem auto auto;" data-t="terms_subtitle">
                    Please read these terms carefully before using our AI-powered travel services.</p>
            </div>

            <div class="terms-card">
                <div class="term-block">
                    <h2><i class="fa-solid fa-handshake"></i> <span data-t="s1_title">1. Acceptance of Terms</span></h2>
                    <p data-t="s1_desc">By accessing or using Just Travel, you agree to be bound by these Terms and
                        Conditions and all applicable laws and regulations. If you do not agree with any of these terms,
                        you are prohibited from using this site.</p>
                </div>

                <div class="term-block">
                    <h2><i class="fa-solid fa-robot"></i> <span data-t="s2_title">2. AI Service Disclaimer</span></h2>
                    <p data-t="s2_desc">Just Travel utilizes Artificial Intelligence to provide travel recommendations,
                        itineraries, and conversational assistance. While we strive for accuracy:</p>
                    <ul>
                        <li data-t="s2_i1">AI-generated content is for informational purposes only.</li>
                        <li data-t="s2_i2">Availability and pricing are subject to real-time changes from our partners.
                        </li>
                        <li data-t="s2_i3">We are not liable for inaccuracies in itineraries or suggestions provided by
                            the AI.</li>
                    </ul>
                </div>

                <div class="term-block">
                    <h2><i class="fa-solid fa-user-shield"></i> <span data-t="s3_title">3. User Responsibilities</span>
                    </h2>
                    <p data-t="s3_desc">When using our platform, you agree to provide accurate information and maintain
                        the security of your account. You are responsible for:</p>
                    <ul>
                        <li data-t="s3_i1">Verifying all travel documents and visa requirements.</li>
                        <li data-t="s3_i2">Ensuring the accuracy of booking details before payment.</li>
                        <li data-t="s3_i3">Abiding by the specific terms of our partners (Hotels, Airlines, Car
                            Rentals).</li>
                    </ul>
                </div>

                <div class="term-block">
                    <h2><i class="fa-solid fa-credit-card"></i> <span data-t="s4_title">4. Bookings & Payments</span>
                    </h2>
                    <p data-t="s4_desc">Just Travel acts as an intermediary between users and travel providers. Payments
                        made through our platform are processed by secure third-party gateways. Refund and cancellation
                        policies are dictated by the underlying service provider.</p>
                </div>

                <div class="term-block">
                    <h2><i class="fa-solid fa-gavel"></i> <span data-t="s5_title">5. Limitation of Liability</span></h2>
                    <p data-t="s5_desc">To the maximum extent permitted by law, Just Travel shall not be liable for any
                        indirect, incidental, special, consequential, or punitive damages resulting from your use of the
                        service or any travel delays and cancellations.</p>
                </div>

                <div class="term-block">
                    <h2><i class="fa-solid fa-envelope-open-text"></i> <span data-t="s6_title">6. Contact
                            Information</span></h2>
                    <p data-t="s6_desc">If you have any questions regarding these Terms, please contact us at:</p>
                    <p style="font-weight: 700; color: var(--text-main);">info@justtravel.pro</p>
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
                terms_title: "Terms & Conditions",
                terms_subtitle: "Please read these terms carefully before using our AI-powered travel services.",
                last_updated: "Last Updated",
                s1_title: "1. Acceptance of Terms",
                s1_desc: "By accessing or using Just Travel, you agree to be bound by these Terms and Conditions and all applicable laws and regulations. If you do not agree with any of these terms, you are prohibited from using this site.",
                s2_title: "2. AI Service Disclaimer",
                s2_desc: "Just Travel utilizes Artificial Intelligence to provide travel recommendations, itineraries, and conversational assistance. While we strive for accuracy:",
                s2_i1: "AI-generated content is for informational purposes only.",
                s2_i2: "Availability and pricing are subject to real-time changes from our partners.",
                s2_i3: "We are not liable for inaccuracies in itineraries or suggestions provided by the AI.",
                s3_title: "3. User Responsibilities",
                s3_desc: "When using our platform, you agree to provide accurate information and maintain the security of your account. You are responsible for:",
                s3_i1: "Verifying all travel documents and visa requirements.",
                s3_i2: "Ensuring the accuracy of booking details before payment.",
                s3_i3: "Abiding by the specific terms of our partners (Hotels, Airlines, Car Rentals).",
                s4_title: "4. Bookings & Payments",
                s4_desc: "Just Travel acts as an intermediary between users and travel providers. Payments made through our platform are processed by secure third-party gateways. Refund and cancellation policies are dictated by the underlying service provider.",
                s5_title: "5. Limitation of Liability",
                s5_desc: "To the maximum extent permitted by law, Just Travel shall not be liable for any indirect, incidental, special, consequential, or punitive damages resulting from your use of the service or any travel delays and cancellations.",
                s6_title: "6. Contact Information",
                s6_desc: "If you have any questions regarding these Terms, please contact us at:",
                footer_copy: "© {{ date('Y') }} Just Travel Inc. All rights reserved."
            },
            ar: {
                brand_name: "جست ترافل.",
                terms_title: "الشروط والأحكام",
                terms_subtitle: "يرجى قراءة هذه الشروط بعناية قبل استخدام خدمات السفر المدعومة بالذكاء الاصطناعي الخاصة بنا.",
                last_updated: "آخر تحديث",
                s1_title: "1. قبول الشروط",
                s1_desc: "من خلال الوصول إلى جست ترافل أو استخدامه، فإنك توافق على الالتزام بهذه الشروط والأحكام وجميع القوانين واللوائح المعمول بها. إذا كنت لا توافق على أي من هذه الشروط، فيحظر عليك استخدام هذا الموقع.",
                s2_title: "2. إخلاء مسؤولية خدمة الذكاء الاصطناعي",
                s2_desc: "تستخدم جست ترافل الذكاء الاصطناعي لتقديم توصيات السفر ومسارات الرحلة والمساعدة في المحادثة. بينما نسعى جاهدين للدقة:",
                s2_i1: "المحتوى الناتج عن الذكاء الاصطناعي لأغراض إعلامية فقط.",
                s2_i2: "التوفر والأسعار عرضة للتغييرات في الوقت الفعلي من شركائنا.",
                s2_i3: "نحن لسنا مسؤولين عن عدم الدقة في مسارات الرحلة أو الاقتراحات المقدمة من قبل الذكاء الاصطناعي.",
                s3_title: "3. مسؤوليات المستخدم",
                s3_desc: "عند استخدام منصتنا، فإنك توافق على تقديم معلومات دقيقة والحفاظ على أمن حسابك. أنت مسؤول عن:",
                s3_i1: "التحقق من جميع وثائق السفر ومتطلبات التأشيرة.",
                s3_i2: "التأكد من دقة تفاصيل الحجز قبل الدفع.",
                s3_i3: "الالتزام بالشروط المحددة لشركائنا (الفنادق، شركات الطيران، تأجير السيارات).",
                s4_title: "4. الحجوزات والمدفوعات",
                s4_desc: "تعمل جست ترافل كوسيط بين المستخدمين ومزودي خدمات السفر. تتم معالجة المدفوعات التي تتم من خلال منصتنا بواسطة بوابات دفع آمنة تابعة لجهات خارجية. يتم تحديد سياسات الاسترداد والإلغاء من قبل مزود الخدمة الأساسي.",
                s5_title: "5. تحديد المسؤولية",
                s5_desc: "إلى أقصى حد يسمح به القانون، لن تكون جست ترافل مسؤولة عن أي أضرار غير مباشرة أو عرضية أو خاصة أو تبعية أو عقابية ناتجة عن استخدامك للخدمة أو أي تأخيرات أو إلغاءات في السفر.",
                s6_title: "6. معلومات الاتصل",
                s6_desc: "إذا كان لديك أي أسئلة بخصوص هذه الشروط، يرجى الاتصال بنا على:",
                footer_copy: "© {{ date('Y') }} جست ترافل. جميع الحقوق محفوظة."
            },
            ru: {
                brand_name: "Just Travel.",
                terms_title: "Условия и положения",
                terms_subtitle: "Пожалуйста, внимательно прочитайте эти условия перед использованием наших AI-сервисов.",
                last_updated: "Последнее обновление",
                s1_title: "1. Принятие условий",
                s1_desc: "Используя Just Travel, вы соглашаетесь с данными Условиями и всеми применимыми законами. Если вы не согласны, использование сайта запрещено.",
                s2_title: "2. Отказ от ответственности AI",
                s2_desc: "Just Travel использует ИИ для рекомендаций. Хотя мы стремимся к точности:",
                s2_i1: "Контент ИИ носит ознакомительный характер.",
                s2_i2: "Наличие и цены могут меняться в реальном времени.",
                s2_i3: "Мы не несем ответственности за неточности ИИ.",
                s3_title: "3. Обязанности пользователя",
                s3_desc: "Используя платформу, вы обязуетесь предоставлять точные данные и защищать аккаунт. Вы отвечаете за:",
                s3_i1: "Проверку документов и виз.",
                s3_i2: "Точность деталей бронирования.",
                s3_i3: "Соблюдение правил партнеров (Отели, Авиакомпании).",
                s4_title: "4. Бронирование и оплата",
                s4_desc: "Just Travel — посредник. Платежи проходят через защищенные шлюзы. Возврат и отмена зависят от провайдера услуг.",
                s5_title: "5. Ограничение ответственности",
                s5_desc: "Just Travel не несет ответственности за косвенные убытки или задержки рейсов в рамках закона.",
                s6_title: "6. Контакты",
                s6_desc: "Если у вас есть вопросы по Условиям, свяжитесь с нами:",
                footer_copy: "© {{ date('Y') }} Just Travel Inc. Все права защищены."
            },
            zh: {
                brand_name: "Just Travel.",
                terms_title: "条款与条件",
                terms_subtitle: "在使用我们的 AI 驱动的旅行服务之前，请仔细阅读这些条款。",
                last_updated: "最后更新",
                s1_title: "1. 接受条款",
                s1_desc: "访问或使用 Just Travel，即表示您同意遵守这些条款和条件以及所有适用的法律和法规。如果您不同意这些条款中的任何一项，则禁止您使用本网站。",
                s2_title: "2. AI 服务免责声明",
                s2_desc: "Just Travel 利用人工智能提供旅行建议、行程和对话帮助。虽然我们力求准确：",
                s2_i1: "AI 生成的内容仅供参考。",
                s2_i2: "可用性和价格可能会根据我们合作伙伴的实时变化而变化。",
                s2_i3: "对于 AI 提供的行程或建议中的不准确之处，我们概不负责。",
                s3_title: "3. 用户责任",
                s3_desc: "使用我们的平台时，您同意提供准确的信息并维护您帐户的安全。您负责：",
                s3_i1: "验证所有旅行证件和签证要求。",
                s3_i2: "确保预订详细信息在付款前准确无误。",
                s3_i3: "遵守我们合作伙伴（酒店、航空公司、租车）的具体条款。",
                s4_title: "4. 预订与付款",
                s4_desc: "Just Travel 充当用户与旅行提供商之间的中介。通过我们平台进行的付款由安全的第三方网关处理。退款和取消政策由底层服务提供商决定。",
                s5_title: "5. 责任限制",
                s5_desc: "在法律允许的最大范围内，Just Travel 不对因您使用服务或任何旅行延误和取消而导致的任何间接、附带、特殊、后果性或惩罚性损害负责。",
                s6_title: "6. 联系信息",
                s6_desc: "如果您对这些条款有任何疑问，请联系我们：",
                footer_copy: "© {{ date('Y') }} Just Travel Inc. 保留所有权利。"
            },
            fr: {
                brand_name: "Just Travel.",
                terms_title: "Termes et Conditions",
                terms_subtitle: "Veuillez lire attentivement ces conditions avant d'utiliser nos services de voyage alimentés par l'IA.",
                last_updated: "Dernière mise à jour",
                s1_title: "1. Acceptation des conditions",
                s1_desc: "En accédant ou en utilisant Just Travel, vous acceptez d'être lié par ces Termes et Conditions et toutes les lois et réglementations applicables. Si vous n'êtes pas d'accord avec l'une de ces conditions, il vous est interdit d'utiliser ce site.",
                s2_title: "2. Avertissement sur le service IA",
                s2_desc: "Just Travel utilise l'intelligence artificielle pour fournir des recommandations de voyage, des itinéraires et une assistance conversationnelle. Bien que nous nous efforcions d'être précis :",
                s2_i1: "Le contenu généré par l'IA est à titre informatif uniquement.",
                s2_i2: "La disponibilité et les prix sont sujets à des changements en temps réel de la part de nos partenaires.",
                s2_i3: "Nous ne sommes pas responsables des inexactitudes dans les itinéraires ou les suggestions fournies par l'IA.",
                s3_title: "3. Responsabilités de l'utilisateur",
                s3_desc: "En utilisant notre plateforme, vous acceptez de fournir des informations exactes et de maintenir la sécurité de votre compte. Vous êtes responsable de :",
                s3_i1: "Vérifier tous les documents de voyage et les exigences en matière de visa.",
                s3_i2: "S'assurer de l'exactitude des détails de la réservation avant le paiement.",
                s3_i3: "Respecter les conditions spécifiques de nos partenaires (Hôtels, Compagnies aériennes, Location de voitures).",
                s4_title: "4. Réservations et Paiements",
                s4_desc: "Just Travel agit en tant qu'intermédiaire entre les utilisateurs et les fournisseurs de voyages. Les paiements effectués via notre plateforme sont traités par des passerelles tierces sécurisées. Les politiques de remboursement et d'annulation sont dictées par le fournisseur de services sous-jacent.",
                s5_title: "5. Limitation de responsabilité",
                s5_desc: "Dans toute la mesure permise par la loi, Just Travel ne sera pas responsable des dommages indirects, accessoires, spéciaux, consécutifs ou punitifs résultant de votre utilisation du service ou de tout retard ou annulation de voyage.",
                s6_title: "6. Informations de contact",
                s6_desc: "Si vous avez des questions concernant ces conditions, veuillez nous contacter à :",
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