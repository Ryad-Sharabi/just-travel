<div id="cookieConsentBanner" class="cookie-consent-banner" style="display: none;">
    <div class="cookie-consent-content">
        <div class="cookie-consent-text">
            <i class="fa-solid fa-cookie-bite"></i>
            <div>
                <strong data-t="cookie_title">We use cookies</strong>
                <p data-t="cookie_message">We use cookies to enhance your experience, analyze site usage, and assist in our marketing efforts. By clicking "Accept", you consent to our use of cookies.</p>
            </div>
        </div>
        <div class="cookie-consent-buttons">
            <button id="cookieAccept" class="btn-cookie-accept" data-t="cookie_accept">Accept</button>
            <button id="cookieDecline" class="btn-cookie-decline" data-t="cookie_decline">Decline</button>
        </div>
    </div>
</div>

<style>
    .cookie-consent-banner {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        background: var(--bg-card, #ffffff);
        border-top: 1px solid var(--border-color, rgba(0, 0, 0, 0.05));
        box-shadow: 0 -4px 20px rgba(0, 0, 0, 0.1);
        z-index: 10000;
        padding: 1.5rem 2rem;
        animation: slideUp 0.3s ease-out;
    }

    [data-theme="dark"] .cookie-consent-banner {
        background: var(--bg-card, #1e293b);
        border-top-color: var(--border-color, rgba(255, 255, 255, 0.1));
    }

    @keyframes slideUp {
        from {
            transform: translateY(100%);
        }
        to {
            transform: translateY(0);
        }
    }

    .cookie-consent-content {
        max-width: 1200px;
        margin: 0 auto;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 2rem;
    }

    .cookie-consent-text {
        display: flex;
        align-items: flex-start;
        gap: 1rem;
        flex: 1;
    }

    .cookie-consent-text i {
        font-size: 2rem;
        color: var(--primary, #00cec9);
        margin-top: 0.25rem;
    }

    .cookie-consent-text strong {
        display: block;
        font-size: 1.1rem;
        color: var(--text-main, #2d3436);
        margin-bottom: 0.5rem;
    }

    .cookie-consent-text p {
        margin: 0;
        color: var(--text-muted, #636e72);
        font-size: 0.95rem;
        line-height: 1.5;
    }

    .cookie-consent-buttons {
        display: flex;
        gap: 1rem;
        flex-shrink: 0;
    }

    .btn-cookie-accept,
    .btn-cookie-decline {
        padding: 12px 24px;
        border-radius: 50px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        border: none;
        font-size: 0.95rem;
    }

    .btn-cookie-accept {
        background: linear-gradient(135deg, #0984e3 0%, #00cec9 100%);
        color: white;
        box-shadow: 0 4px 15px rgba(9, 132, 227, 0.4);
    }

    .btn-cookie-accept:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(9, 132, 227, 0.6);
    }

    .btn-cookie-decline {
        background: transparent;
        color: var(--text-main, #2d3436);
        border: 2px solid var(--border-color, rgba(0, 0, 0, 0.1));
    }

    .btn-cookie-decline:hover {
        background: var(--bg-page, #f7f9fc);
        border-color: var(--text-muted, #636e72);
    }

    [data-theme="dark"] .btn-cookie-decline {
        color: var(--text-main, #f1f5f9);
        border-color: var(--border-color, rgba(255, 255, 255, 0.1));
    }

    [data-theme="dark"] .btn-cookie-decline:hover {
        background: var(--bg-page, #0f172a);
    }

    @media (max-width: 768px) {
        .cookie-consent-banner {
            padding: 1rem;
        }

        .cookie-consent-content {
            flex-direction: column;
            gap: 1rem;
        }

        .cookie-consent-buttons {
            width: 100%;
        }

        .btn-cookie-accept,
        .btn-cookie-decline {
            flex: 1;
        }
    }
</style>

<script>
    (function() {
        // Check if consent has been given
        function getCookie(name) {
            const value = `; ${document.cookie}`;
            const parts = value.split(`; ${name}=`);
            if (parts.length === 2) return parts.pop().split(';').shift();
            return null;
        }

        function setCookie(name, value, days) {
            const date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            const expires = `expires=${date.toUTCString()}`;
            document.cookie = `${name}=${value};${expires};path=/;SameSite=Lax`;
        }

        const consent = getCookie('cookie_consent');
        const banner = document.getElementById('cookieConsentBanner');

        // Show banner if no consent has been given
        if (!consent && banner) {
            banner.style.display = 'block';

            // Accept button
            document.getElementById('cookieAccept')?.addEventListener('click', function() {
                setCookie('cookie_consent', 'accepted', 365);
                banner.style.display = 'none';
                
                // Load Clarity after acceptance
                loadClarity();
            });

            // Decline button
            document.getElementById('cookieDecline')?.addEventListener('click', function() {
                setCookie('cookie_consent', 'declined', 365);
                banner.style.display = 'none';
            });
        }

        // Load Clarity if consent was previously given
        if (consent === 'accepted') {
            loadClarity();
        }

        function loadClarity() {
            // Check if Clarity is already loaded
            if (window.clarity) {
                return;
            }

            // Load Clarity script
            (function (c, l, a, r, i, t, y) {
                c[a] = c[a] || function () { (c[a].q = c[a].q || []).push(arguments) };
                t = l.createElement(r); 
                t.async = 1; 
                t.src = "https://www.clarity.ms/tag/" + i;
                y = l.getElementsByTagName(r)[0];
                if (y && y.parentNode) {
                    y.parentNode.insertBefore(t, y);
                } else {
                    // Fallback: append to head if no script tag found
                    (l.head || l.getElementsByTagName("head")[0]).appendChild(t);
                }
            })(window, document, "clarity", "script", "umwarpwoaf");
        }

        // Add translations for cookie banner
        const cookieTranslations = {
            en: {
                cookie_title: "We use cookies",
                cookie_message: "We use cookies to enhance your experience, analyze site usage, and assist in our marketing efforts. By clicking \"Accept\", you consent to our use of cookies.",
                cookie_accept: "Accept",
                cookie_decline: "Decline"
            },
            ar: {
                cookie_title: "نستخدم ملفات تعريف الارتباط",
                cookie_message: "نستخدم ملفات تعريف الارتباط لتحسين تجربتك وتحليل استخدام الموقع والمساعدة في جهودنا التسويقية. بالنقر فوق \"قبول\"، فإنك توافق على استخدامنا لملفات تعريف الارتباط.",
                cookie_accept: "قبول",
                cookie_decline: "رفض"
            },
            ru: {
                cookie_title: "Мы используем cookies",
                cookie_message: "Мы используем cookies для улучшения вашего опыта, анализа использования сайта и помощи в наших маркетинговых усилиях. Нажимая \"Принять\", вы соглашаетесь на использование cookies.",
                cookie_accept: "Принять",
                cookie_decline: "Отклонить"
            },
            zh: {
                cookie_title: "我们使用 Cookie",
                cookie_message: "我们使用 cookie 来增强您的体验、分析网站使用情况并协助我们的营销工作。点击\"接受\"即表示您同意我们使用 cookie。",
                cookie_accept: "接受",
                cookie_decline: "拒绝"
            },
            fr: {
                cookie_title: "Nous utilisons des cookies",
                cookie_message: "Nous utilisons des cookies pour améliorer votre expérience, analyser l'utilisation du site et aider nos efforts marketing. En cliquant sur \"Accepter\", vous consentez à notre utilisation des cookies.",
                cookie_accept: "Accepter",
                cookie_decline: "Refuser"
            }
        };

        // Apply translations
        function applyCookieTranslations(lang) {
            const translations = cookieTranslations[lang] || cookieTranslations.en;
            const elements = banner?.querySelectorAll('[data-t]');
            if (elements) {
                elements.forEach(el => {
                    const key = el.getAttribute('data-t');
                    if (translations[key]) {
                        el.textContent = translations[key];
                    }
                });
            }
        }

        // Get saved language or default to English
        const savedLang = localStorage.getItem('lang') || 'en';
        applyCookieTranslations(savedLang);

        // Listen for language changes by observing localStorage
        const originalSetItem = localStorage.setItem;
        localStorage.setItem = function(key, value) {
            originalSetItem.apply(this, arguments);
            if (key === 'lang') {
                applyCookieTranslations(value);
            }
        };

        // Also check periodically for language changes (fallback)
        let lastLang = savedLang;
        setInterval(function() {
            const currentLang = localStorage.getItem('lang') || 'en';
            if (currentLang !== lastLang) {
                lastLang = currentLang;
                applyCookieTranslations(currentLang);
            }
        }, 500);
    })();
</script>

