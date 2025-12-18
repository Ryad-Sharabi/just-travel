<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Browse - Just Travel</title>
    @include('partials.clarity')
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <!-- FontAwesome for Icons -->
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
            --border-color: rgba(0, 206, 201, 0.15);
            --card-shadow: 0 10px 40px rgba(0, 0, 0, 0.4);
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
            display: flex;
            min-height: 100vh;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        /* Sidebar: Desktop vertical, Mobile horizontal */
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
            transition: var(--transition);
            border-right: 1px solid var(--border-color);
        }

        .brand-logo {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            margin-bottom: 3rem;
            object-fit: cover;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
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
            position: relative;
        }

        .nav-item:hover,
        .nav-item.active {
            color: #ffffff;
            background: var(--gradient-hero);
            box-shadow: 0 8px 25px rgba(0, 206, 201, 0.4);
            transform: translateY(-2px);
        }

        [data-theme="dark"] .nav-item.active {
            box-shadow: 0 0 20px rgba(0, 206, 201, 0.3);
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            padding: 2rem 3rem;
            transition: var(--transition);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2.5rem;
        }

        .page-title {
            font-size: 2rem;
            font-weight: 800;
            color: var(--text-main);
            letter-spacing: -1px;
        }

        .header-actions {
            flex-grow: 1;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 15px;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .user-info {
            text-align: right;
        }

        .btn-modal-close-action {
            width: 100%;
            padding: 12px;
            background: #f1f2f6;
            color: #636e72;
            border: none;
            border-radius: 50px;
            font-weight: 700;
            cursor: pointer;
            margin-top: 1.5rem;
            transition: var(--transition);
        }

        .btn-modal-close-action:hover {
            background: var(--light);
            color: var(--text-main);
            transform: translateY(-2px);
        }

        .user-greeting {
            font-size: 0.85rem;
            color: var(--text-muted);
        }

        .logout-btn {
            background: linear-gradient(135deg, #ff7675 0%, #d63031 100%);
            border: none;
            color: white;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
            box-shadow: 0 4px 10px rgba(214, 48, 49, 0.3);
        }

        .logout-btn:hover {
            transform: translateY(-2px) rotate(90deg);
            box-shadow: 0 8px 20px rgba(214, 48, 49, 0.5);
        }

        .theme-toggle-btn,
        .lang-toggle-btn {
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
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
            position: relative;
        }

        .lang-toggle-btn:hover,
        .theme-toggle-btn:hover {
            background: var(--gradient-hero);
            color: white;
            border-color: transparent;
            transform: scale(1.1);
            box-shadow: 0 8px 25px rgba(0, 206, 201, 0.4);
        }

        /* Language Dropdown Styles (from Homepage) */
        .lang-dropdown {
            position: absolute;
            top: 100%;
            margin-top: 10px;
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
        }

        .lang-option:hover {
            background: rgba(0, 206, 201, 0.1);
            color: var(--primary);
            transform: translateX(5px);
        }

        [data-theme="dark"] .lang-dropdown {
            background: rgba(30, 41, 59, 0.8);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.4);
        }

        /* Grid */
        .grid-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 2rem;
            animation: fadeIn 0.6s ease-out;
        }

        .card {
            background: var(--bg-card);
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.02);
            transition: var(--transition);
            border: 1px solid var(--border-color);
            display: flex;
            flex-direction: column;
            position: relative;
        }

        [data-theme="dark"] .card {
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 50px rgba(0, 206, 201, 0.1);
        }

        .card-map {
            height: 180px;
            background: var(--bg-page);
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Attractive Abstract Map Pattern */
        .card-map::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: radial-gradient(var(--primary) 1px, transparent 1px);
            background-size: 20px 20px;
            opacity: 0.1;
        }

        .map-marker-visual {
            font-size: 2.5rem;
            color: var(--secondary);
            background: var(--bg-card);
            width: 70px;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            z-index: 10;
        }

        .card-body {
            padding: 1.5rem;
            flex-grow: 1;
        }

        .card-header-row {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 0.5rem;
        }

        .airport-code {
            background: var(--light);
            padding: 6px 12px;
            border-radius: 12px;
            font-weight: 800;
            font-size: 0.85rem;
            color: var(--secondary);
            letter-spacing: 0.5px;
        }

        .airport-name {
            font-size: 1.3rem;
            font-weight: 800;
            color: var(--text-main);
            margin-bottom: 0.4rem;
            line-height: 1.2;
        }

        .airport-country {
            font-size: 0.95rem;
            color: var(--text-muted);
            display: flex;
            align-items: center;
            gap: 6px;
            font-weight: 500;
        }

        /* Controls */
        .card-controls {
            padding: 1.2rem;
            background: var(--bg-card);
            border-top: 1px solid var(--border-color);
            display: flex;
            justify-content: space-around;
            gap: 10px;
        }

        .btn-ctrl {
            border: none;
            background: transparent;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 6px;
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--text-muted);
            padding: 5px;
        }

        .btn-ctrl i {
            font-size: 1.2rem;
            transition: var(--transition);
            padding: 10px;
            border-radius: 50%;
            background: var(--bg-page);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        }

        .btn-ctrl:hover i {
            transform: translateY(-3px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
        }

        .btn-ctrl:hover {
            color: var(--secondary);
        }

        .btn-book i {
            color: #ffffff;
            background: var(--gradient-hero);
        }

        .btn-book:hover i {
            box-shadow: 0 8px 20px rgba(9, 132, 227, 0.4);
        }


        /* Responsive Design */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: 70px;
                bottom: 0;
                top: auto;
                flex-direction: row;
                justify-content: space-around;
                padding: 0;
                border-top: 1px solid #eee;
            }

            .brand-logo {
                display: none;
            }

            /* Hide logo in bottom nav */
            .nav-item {
                margin-bottom: 0;
                box-shadow: none;
                width: auto;
                height: auto;
                padding: 10px;
                background: transparent !important;
                color: #b2bec3;
            }

            .nav-item.active {
                color: var(--secondary) !important;
                transform: none;
                box-shadow: none;
            }

            .nav-item.active::after {
                display: none;
            }

            .main-content {
                margin-left: 0;
                margin-bottom: 80px;
                padding: 1.5rem;
            }

            .header {
                flex-direction: column;
                align-items: stretch;
                gap: 15px;
            }

            .header-actions {
                width: 100%;
                flex-direction: column-reverse;
                gap: 15px;
            }

            .search-container {
                width: 100%;
                max-width: none;
                margin-right: 0;
            }

            .user-profile {
                width: 100%;
                justify-content: flex-end;
            }

            .user-info {
                text-align: left;
                margin-right: auto;
                /* Push user info to the left if needed, or keep alignment */
                margin-left: 10px;
            }
        }

        /* Improved Modals */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(8px);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .modal-overlay.active {
            display: flex;
            opacity: 1;
        }

        .modal {
            background: var(--bg-card);
            border-radius: 24px;
            padding: 2.5rem;
            width: 90%;
            max-width: 550px;
            transform: scale(0.9) translateY(20px);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.2);
        }

        .modal-overlay.active .modal {
            transform: scale(1) translateY(0);
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            border-bottom: 1px solid var(--border-color);
            padding-bottom: 1rem;
        }

        .modal-title {
            font-size: 1.8rem;
            font-weight: 800;
            color: var(--dark);
            background: var(--gradient-hero);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .close-modal {
            background: var(--bg-page);
            width: 36px;
            height: 36px;
            border-radius: 50%;
            border: none;
            font-size: 1.2rem;
            cursor: pointer;
            color: var(--text-main);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
        }

        .close-modal:hover {
            background: var(--light);
            transform: rotate(90deg);
            color: var(--primary);
        }

        .details-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .detail-item {
            background: var(--bg-page);
            padding: 1rem;
            border-radius: 16px;
            border: 1px solid var(--border-color);
        }

        .detail-label {
            display: block;
            font-size: 0.85rem;
            color: var(--text-muted);
            margin-bottom: 5px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .detail-value {}

        .star-rating input {
            display: none;
        }

        .star-rating label {
            font-size: 2rem;
            color: #dfe6e9;
            cursor: pointer;
            transition: color 0.2s ease, transform 0.1s;
        }

        .star-rating input:checked~label,
        .star-rating label:hover,
        .star-rating label:hover~label {
            color: #fdcb6e;
            transform: scale(1.1);
        }

        .feedback-textarea {
            width: 100%;
            background: var(--bg-page);
            border: 2px solid var(--border-color);
            padding: 15px;
            border-radius: 16px;
            font-size: 1rem;
            min-height: 120px;
            resize: vertical;
            outline: none;
            transition: border-color 0.3s;
        }

        .feedback-textarea:focus {
            border-color: var(--secondary);
            background: var(--bg-card);
        }

        .feedback-helper {
            font-size: 0.85rem;
            color: #b2bec3;
            margin-top: 5px;
            text-align: right;
        }

        .btn-feedback-submit {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #0984e3 0%, #00cec9 100%);
            color: white;
            border: none;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: 800;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            box-shadow: 0 10px 20px rgba(0, 206, 201, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-top: 1rem;
            letter-spacing: 0.5px;
        }

        .btn-feedback-submit:hover {
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 15px 30px rgba(0, 206, 201, 0.4);
            filter: brightness(1.1);
        }

        .btn-feedback-submit:active {
            transform: translateY(1px);
        }

        /* Identity Field Styles */
        .identity-row {
            display: flex;
            gap: 15px;
            margin-bottom: 1.5rem;
        }

        .identity-item {
            flex: 1;
            background: var(--bg-page);
            border: 1px solid var(--border-color);
            padding: 10px 15px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            gap: 12px;
            transition: var(--transition);
        }

        .identity-item:hover {
            border-color: var(--primary);
            background: var(--bg-input);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .id-icon {
            width: 38px;
            height: 38px;
            background: var(--bg-card);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--secondary);
            font-size: 1.1rem;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        }

        .id-content {
            display: flex;
            flex-direction: column;
        }

        .id-label {
            font-size: 0.7rem;
            text-transform: uppercase;
            color: var(--text-muted);
            font-weight: 800;
            letter-spacing: 0.5px;
            margin-bottom: 2px;
        }

        .id-value {
            font-size: 0.95rem;
            font-weight: 700;
            color: var(--text-main);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 130px;
        }

        /* Flight Item Styling for Modal */
        .flight-list {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            max-height: 400px;
            overflow-y: auto;
        }

        .flight-item {
            background: var(--bg-page);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            padding: 1.2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: var(--transition);
        }

        .flight-item:hover {
            border-color: var(--primary);
            background: var(--bg-input);
            box-shadow: 0 8px 25px rgba(0, 206, 201, 0.15);
        }

        .flight-info {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .flight-route {
            font-weight: 700;
            color: var(--text-main);
            font-size: 1.1rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .flight-meta {
            font-size: 0.85rem;
            color: var(--text-muted);
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .flight-price {
            font-weight: 800;
            color: var(--secondary);
            font-size: 1.25rem;
        }

        .loading-spinner {
            text-align: center;
            padding: 2rem;
            color: var(--primary);
            font-size: 1.5rem;
        }

        @keyframes fadeIn {
            from {
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Search Bar */
        .search-container {
            position: relative;
            margin-right: 2rem;
            flex-grow: 1;
            max-width: 400px;
        }

        .search-input {
            width: 100%;
            padding: 12px 20px 12px 45px;
            background: var(--bg-sidebar);
            border: 2px solid transparent;
            border-radius: 15px;
            font-size: 0.95rem;
            outline: none;
            transition: var(--transition);
            color: var(--text-main);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.02);
        }

        .search-input:focus {
            border-color: var(--secondary);
            box-shadow: 0 8px 20px rgba(9, 132, 227, 0.15);
        }

        .search-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #b2bec3;
            transition: var(--transition);
        }

        .search-input:focus+.search-icon {
            color: var(--secondary);
        }

        /* AI Chat Styles */
        .chat-container {
            background: var(--bg-card);
            border-radius: 24px;
            box-shadow: var(--card-shadow);
            display: flex;
            flex-direction: column;
            height: calc(100vh - 180px);
            overflow: hidden;
            position: relative;
            border: 1px solid var(--border-color);
        }

        .chat-messages {
            flex: 1;
            padding: 2rem;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
            background: var(--bg-page);
        }

        .chat-message {
            max-width: 80%;
            padding: 1.2rem 1.5rem;
            border-radius: 20px;
            font-size: 1rem;
            line-height: 1.6;
            position: relative;
            animation: fadeInUp 0.4s ease-out;
        }

        .chat-message.ai {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-bottom-left-radius: 5px;
            color: var(--text-main);
            align-self: flex-start;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }

        .chat-message.user {
            background: var(--gradient-hero);
            color: white;
            border-bottom-right-radius: 5px;
            align-self: flex-end;
            box-shadow: 0 8px 20px rgba(9, 132, 227, 0.2);
        }

        .chat-input-area {
            padding: 1.5rem;
            background: var(--bg-card);
            border-top: 1px solid var(--border-color);
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .chat-input {
            flex: 1;
            padding: 15px 25px;
            background: var(--bg-page);
            border: 2px solid var(--border-color);
            border-radius: 50px;
            font-size: 1rem;
            outline: none;
            transition: var(--transition);
            color: var(--text-main);
        }

        .chat-input:focus {
            border-color: var(--secondary);
            box-shadow: 0 5px 15px rgba(9, 132, 227, 0.1);
        }

        .btn-send {
            width: 55px;
            height: 55px;
            border-radius: 50%;
            background: var(--dark);
            color: white;
            border: none;
            cursor: pointer;
            font-size: 1.2rem;
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-send:hover {
            transform: scale(1.1);
            background: var(--secondary);
        }

        .typing-indicator {
            padding: 10px 20px;
            background: var(--bg-card);
            border-radius: 20px;
            border: 1px solid var(--border-color);
            align-self: flex-start;
            display: none;
            align-items: center;
            gap: 5px;
            margin-bottom: 1rem;
            margin-left: 2rem;
        }

        .dot {
            width: 8px;
            height: 8px;
            background: var(--primary);
            opacity: 0.6;
            border-radius: 50%;
            animation: bounce 1.4s infinite ease-in-out both;
        }

        .dot:nth-child(1) {
            animation-delay: -0.32s;
        }

        .dot:nth-child(2) {
            animation-delay: -0.16s;
        }

        @keyframes bounce {

            0%,
            80%,
            100% {
                transform: scale(0);
            }

            40% {
                transform: scale(1);
            }
        }

        .chat-message.ai h3 {
            font-size: 1.2rem;
            color: var(--secondary);
            margin-bottom: 0.5rem;
            margin-top: 1rem;
        }

        .chat-message.ai ul {
            margin-left: 1.5rem;
            margin-bottom: 1rem;
        }

        .chat-message.ai p {
            margin-bottom: 0.8rem;
        }

        .chat-message.ai strong {
            color: var(--secondary);
            font-weight: 700;
        }

        /* Weather Options */
        .weather-options {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-top: 10px;
            margin-left: 1.5rem;
            margin-bottom: 1rem;
            animation: fadeInUp 0.5s ease-out;
        }

        .weather-btn {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            padding: 10px 20px;
            border-radius: 50px;
            cursor: pointer;
            font-size: 0.95rem;
            color: var(--text-main);
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        }

        .weather-btn:hover {
            border-color: var(--secondary);
            color: var(--secondary);
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(9, 132, 227, 0.1);
        }

        .chat-input-area.hidden {
            display: none;
        }

        /* Generation & Result Styles */
        .generating-view {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 2rem;
            animation: fadeIn 0.5s;
        }

        .generating-icon {
            font-size: 4rem;
            color: var(--primary);
            margin-bottom: 1.5rem;
            animation: spin 3s infinite linear;
        }

        @keyframes spin {
            100% {
                transform: rotate(360deg);
            }
        }

        .trip-plan-container {
            flex: 1;
            padding: 3rem;
            overflow-y: auto;
            background: var(--bg-page);
            animation: fadeInUp 0.8s ease-out;
        }

        .trip-header {
            text-align: center;
            margin-bottom: 3rem;
            padding-bottom: 1.5rem;
            border-bottom: 2px solid var(--border-color);
        }

        .trip-title {
            font-size: 2.5rem;
            background: var(--gradient-hero);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 1rem;
        }

        .trip-content {
            font-size: 1.1rem;
            line-height: 1.8;
            color: var(--text-main);
            max-width: 800px;
            margin: 0 auto;
        }

        .trip-content h2 {
            color: var(--text-main);
            margin-top: 2.5rem;
            border-bottom: 1px solid var(--border-color);
            padding-bottom: 10px;
        }

        .trip-content h3 {
            color: var(--secondary);
            margin-top: 2rem;
        }

        .trip-subtitle {
            color: var(--text-muted);
            font-size: 1.1rem;
        }

        [dir="rtl"] .header-actions {
            justify-content: flex-end;
        }
    </style>
</head>

<body>

    <!-- Feedback Modal -->
    <div class="modal-overlay" id="feedbackModal">
        <div class="modal">
            <div class="modal-header">
                <h3 class="modal-title" data-t="feedback_title">Your Feedback</h3>
                <button class="close-modal" onclick="closeModal('feedbackModal')">&times;</button>
            </div>
            <form action="{{ route('feedback.store') }}" method="POST">
                @csrf
                <input type="hidden" name="item_type" value="airport">
                <input type="hidden" name="item_name" id="feedbackItemName">

                <p style="color: #636e72; margin-bottom: 1.5rem; font-size: 0.95rem;">
                    <span data-t="feedback_share_experience">Sharing your experience for</span> <strong
                        id="feedbackTargetName" style="color: var(--secondary);"></strong> <span
                        data-t="feedback_helps_us_improve">helps us improve.</span>
                </p>

                @if(Auth::guard('flutter_web')->check())
                    <div class="identity-row">
                        <div class="identity-item">
                            <div class="id-icon"><i class="fa-regular fa-user"></i></div>
                            <div class="id-content">
                                <span class="id-label" data-t="label_posting_as">Posting as</span>
                                <span class="id-value"
                                    title="{{ Auth::guard('flutter_web')->user()->first_name }} {{ Auth::guard('flutter_web')->user()->last_name }}">{{ Auth::guard('flutter_web')->user()->first_name }}
                                    {{ Auth::guard('flutter_web')->user()->last_name }}</span>
                            </div>
                        </div>
                        <div class="identity-item">
                            <div class="id-icon"><i class="fa-regular fa-envelope"></i></div>
                            <div class="id-content">
                                <span class="id-label" data-t="label_verified_email">Verified Email</span>
                                <span class="id-value"
                                    title="{{ Auth::guard('flutter_web')->user()->email }}">{{ Auth::guard('flutter_web')->user()->email }}</span>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="form-group-modal">
                    <label class="form-label" style="font-size:1.1rem;" data-t="label_experience_question">How was your
                        experience?</label>
                    <div class="star-rating">
                        <input type="radio" name="rating" id="star5" value="5"><label for="star5" title="Excellent"><i
                                class="fa-solid fa-star"></i></label>
                        <input type="radio" name="rating" id="star4" value="4"><label for="star4" title="Good"><i
                                class="fa-solid fa-star"></i></label>
                        <input type="radio" name="rating" id="star3" value="3"><label for="star3" title="Average"><i
                                class="fa-solid fa-star"></i></label>
                        <input type="radio" name="rating" id="star2" value="2"><label for="star2" title="Poor"><i
                                class="fa-solid fa-star"></i></label>
                        <input type="radio" name="rating" id="star1" value="1"><label for="star1" title="Terrible"><i
                                class="fa-solid fa-star"></i></label>
                    </div>
                </div>

                <div class="form-group-modal">
                    <label class="form-label" data-t="label_tell_us_more">Tell us more</label>
                    <textarea name="feedback" class="feedback-textarea"
                        placeholder="What did you like? What can we do better?" data-t="feedback_placeholder"
                        required></textarea>
                    <div class="feedback-helper"><i class="fa-solid fa-shield-halved"></i> <span
                            data-t="feedback_confidential">Your feedback is confidential</span>
                    </div>
                </div>

                <button type="submit" class="btn-feedback-submit" data-t="btn_submit_review">
                    Submit Review <i class="fa-solid fa-paper-plane"></i>
                </button>
            </form>
        </div>
    </div>

    <!-- Details Modal -->
    <div class="modal-overlay" id="detailsModal">
        <div class="modal" style="max-width: 700px;">
            <div class="modal-header">
                <h3 class="modal-title" id="detailsTitle">Airport Flights</h3>
                <button class="close-modal" onclick="closeModal('detailsModal')">&times;</button>
            </div>
            <div id="detailsContent">
                <!-- Dynamically filled JS -->
            </div>
            <button class="btn-modal-close-action" onclick="closeModal('detailsModal')"
                data-t="btn_close">Close</button>
        </div>
    </div>





    <!-- Sidebar -->
    <aside class="sidebar">
        <a href="{{ url('/') }}">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="brand-logo">
        </a>

        <a href="{{ route('home') }}" class="nav-item {{ $activeTab === 'airports' ? 'active' : '' }}" title="Airports"
            data-t="sidebar_airports">
            <i class="fa-solid fa-plane"></i>
        </a>
        <a href="{{ route('hotels') }}" class="nav-item {{ $activeTab === 'hotels' ? 'active' : '' }}" title="Hotels"
            data-t="sidebar_hotels">
            <i class="fa-solid fa-hotel"></i>
        </a>
        <a href="{{ route('cars') }}" class="nav-item {{ $activeTab === 'cars' ? 'active' : '' }}" title="Cars"
            data-t="sidebar_cars">
            <i class="fa-solid fa-car"></i>
        </a>
        <a href="{{ route('ai.chat') }}" class="nav-item {{ $activeTab === 'ai' ? 'active' : '' }}" title="AI Assistant"
            data-t="sidebar_ai_assistant">
            <i class="fa-solid fa-wand-magic-sparkles"></i>
        </a>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Header -->
        <header class="header">
            <div>
                <h1 class="page-title" data-t="page_title">
                    @if($activeTab === 'ai') Just Mine Travel AI
                    @else Browse {{ ucfirst($activeTab) }}
                    @endif
                </h1>
                <p style="color: #b2bec3;">
                    @if($activeTab === 'airports') <span data-t="find_destination_gateway">Find your next destination
                        gateway</span>
                    @elseif($activeTab === 'hotels') <span data-t="find_perfect_stay">Find your next perfect stay</span>
                    @elseif($activeTab === 'cars') <span data-t="find_perfect_ride">Find your perfect ride</span>
                    @endif
                </p>
            </div>

            <div class="header-actions">
                <div class="search-container">
                    <input type="text" id="searchInput" class="search-input" placeholder="Search {{ $activeTab }}..."
                        data-t="search_placeholder">
                    <i class="fa-solid fa-search search-icon"></i>
                </div>

                <div class="user-profile">
                    <div style="position: relative; margin-right: 15px;">
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
                    <button id="themeToggle" class="theme-toggle-btn" title="Toggle Dark/Light Mode">
                        <i class="fa-solid fa-moon"></i>
                    </button>
                    @if(Auth::guard('flutter_web')->check())
                        <div class="user-info">
                            <div class="user-name">{{ Auth::guard('flutter_web')->user()->first_name }}</div>
                            <div class="user-greeting" data-t="welcome_back">Welcome back</div>
                        </div>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="logout-btn" title="Logout">
                                <i class="fa-solid fa-power-off"></i>
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}"
                            style="text-decoration: none; display: flex; align-items: center; gap: 10px; background: white; padding: 10px 20px; border-radius: 50px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); color: var(--dark); font-weight: 700; transition: var(--transition);">
                            <i class="fa-solid fa-user-circle" style="color: var(--secondary); font-size: 1.2rem;"></i>
                            <span data-t="btn_login">Login</span>
                        </a>
                    @endif
                </div>
            </div>
        </header>

        @if(session('success'))
            <div
                style="background: #e6fffa; color: #00b894; padding: 15px; border-radius: 12px; margin-bottom: 2rem; border: 1px solid #b2f5ea; display: flex; align-items: center; gap: 10px;">
                <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
            </div>
        @endif

        @if($activeTab === 'ai')
            <div class="chat-container" id="chatContainer">
                <div class="chat-messages" id="chatMessages">
                    <div class="chat-message ai">
                        <i class="fa-solid fa-wand-magic-sparkles" style="color: var(--secondary); margin-right: 8px;"></i>
                        <strong><span data-t="ai_greeting">Hello! I'm Just Mine Travel AI.</span></strong><br>
                        <span data-t="ai_intro_part1">I can help you plan your perfect trip from start to finish. Let's
                            build your dream itinerary together!</span>
                        <br><br>
                        <span data-t="ai_intro_part2">To begin, please tell me:</span>
                        <strong>1. <span data-t="ai_q1">What is your preferred weather?</span></strong>
                    </div>
                </div>

                <!-- Weather Options (Shown Initially) -->
                <div id="weatherOptions" class="weather-options">
                    <button class="weather-btn" onclick="handleOption('Sunny')"><i class="fa-solid fa-sun"
                            style="color:#f1c40f;"></i> Sunny</button>
                    <button class="weather-btn" onclick="handleOption('Cold/Snowy')"><i class="fa-solid fa-snowflake"
                            style="color:#3498db;"></i> Cold/Snowy</button>
                    <button class="weather-btn" onclick="handleOption('Rainy')"><i class="fa-solid fa-cloud-rain"
                            style="color:#7f8c8d;"></i> Rainy</button>
                    <button class="weather-btn" onclick="handleOption('Cloudy')"><i class="fa-solid fa-cloud"
                            style="color:#bdc3c7;"></i> Cloudy</button>
                    <button class="weather-btn" onclick="handleOption('Moderate')"><i class="fa-solid fa-cloud-sun"
                            style="color:#e67e22;"></i> Moderate</button>
                </div>

                <!-- Typing Indicator -->
                <div class="typing-indicator" id="typingIndicator">
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                </div>

                <!-- Input Area (Hidden initially due to options) -->
                <div class="chat-input-area hidden" id="chatInputArea">
                    <input type="text" id="chatInput" class="chat-input" placeholder="Type your answer here..."
                        onkeypress="handleEnter(event)">
                    <button class="btn-send" onclick="sendMessage()">
                        <i class="fa-solid fa-paper-plane"></i>
                    </button>
                </div>
            </div>

            <script>
                let currentStep = 0;
                // Questions are now handled dynamically via the dictionary keys (ai_q1 ... ai_q11)

                let answers = [];
                const chatContainer = document.getElementById('chatContainer');
                const chatMessages = document.getElementById('chatMessages');
                const typingIndicator = document.getElementById('typingIndicator');
                const chatInputArea = document.getElementById('chatInputArea');
                const weatherOptions = document.getElementById('weatherOptions');

                function handleEnter(e) {
                    if (e.key === 'Enter') sendMessage();
                }

                function handleOption(value) {
                    // Logic handles both initial weather buttons and dynamic destination buttons
                    // If it was weather options, hide the container
                    if (currentStep === 0) {
                        weatherOptions.style.display = 'none';
                    }

                    // If it was a destination suggestion button (which we insert dynamically)
                    // We need to remove the suggestion buttons after clicking one to prevent re-clicking
                    const suggestionContainer = document.getElementById('suggestionOptions');
                    if (suggestionContainer) {
                        suggestionContainer.style.display = 'none';
                    }

                    addMessage(value, 'user');
                    processAnswer(value);
                }

                async function sendMessage() {
                    const input = document.getElementById('chatInput');
                    const text = input.value.trim();
                    if (!text) return;

                    // Hide suggestions if user types manually
                    const suggestionContainer = document.getElementById('suggestionOptions');
                    if (suggestionContainer) {
                        suggestionContainer.style.display = 'none';
                    }

                    addMessage(text, 'user');
                    input.value = '';

                    processAnswer(text);
                }

                async function processAnswer(text) {
                    answers[currentStep] = text;

                    // If Step 0 (Weather) done, fetch suggestions for Step 1
                    if (currentStep === 0) {
                        currentStep++;

                        showTyping();

                        // Fetch suggestions based on weather
                        try {
                            const response = await fetch('/api/suggest-destinations', {
                                method: 'POST',
                                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                                body: JSON.stringify({ weather: answers[0] })
                            });
                            const data = await response.json();
                            hideTyping();

                            const langForMsg = localStorage.getItem('lang') || 'en';
                            let weatherVal = answers[0];
                            // Try to translate weather back if it was sent in English but we are in Arabic, or vice versa? 
                            // Actually answers are stored as text. Better to just display as is for now or map it.

                            let aiMsg = dictionary[langForMsg]['ai_msg_weather_choice_start'] + " " + answers[0] + " " + dictionary[langForMsg]['ai_msg_weather_choice_end'];
                            addMessage(aiMsg, 'ai');

                            if (data.destinations && data.destinations.length > 0) {
                                // Create buttons container
                                const optionsDiv = document.createElement('div');
                                optionsDiv.className = 'weather-options'; // Reuse style
                                optionsDiv.id = 'suggestionOptions';

                                data.destinations.forEach(city => {
                                    const btn = document.createElement('button');
                                    btn.className = 'weather-btn';
                                    // Use a generic icon or map marker
                                    btn.innerHTML = `<i class="fa-solid fa-location-dot" style="color:var(--primary);"></i> ${city}`;
                                    btn.onclick = () => handleOption(city);
                                    optionsDiv.appendChild(btn);
                                });
                                chatMessages.appendChild(optionsDiv);
                                chatMessages.scrollTop = chatMessages.scrollHeight;
                            }

                            // Show standard input for fallback
                            chatInputArea.classList.remove('hidden');

                        } catch (e) {
                            hideTyping();
                            const langForFail = localStorage.getItem('lang') || 'en';
                            addMessage(dictionary[langForFail]['ai_msg_suggestion_fail'], 'ai');
                            chatInputArea.classList.remove('hidden');
                        }
                        return;
                    }

                    currentStep++;

                    if (currentStep < 11) { // 11 is total questions count
                        askNextQuestion();
                    } else {
                        // FINAL STEP: Transform Page
                        chatInputArea.style.display = 'none'; // Lock input
                        const suggestionContainer = document.getElementById('suggestionOptions');
                        if (suggestionContainer) suggestionContainer.style.display = 'none';

                        const langForQ = localStorage.getItem('lang') || 'en';
                        chatContainer.innerHTML = `
                                                            <div class="generating-view">
                                                                <div class="generating-icon"><i class="fa-solid fa-plane-departure"></i></div>
                                                                <h2 style="margin-bottom:10px; color:var(--text-main);">${dictionary[langForQ]['generating_title']}</h2>
                                                                <p style="color:var(--text-muted);">${dictionary[langForQ]['generating_subtitle']}</p>
                                                            </div>
                                                        `;

                        try {
                            const response = await fetch('/api/chat/just-mine', {
                                method: 'POST',
                                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                                body: JSON.stringify({ answers: answers })
                            });

                            const data = await response.json();

                            if (!response.ok) {
                                throw new Error(data.error || 'Failed to generate');
                            }

                            chatContainer.innerHTML = `
                                                                                                                                                    <div class="trip-plan-container">
                                                                                                                                                        <div class="trip-header">
                                                                                                                                                            <h1 class="trip-title">${dictionary[langForQ]['ai_itinerary_title_start']} ${answers[1]} ${dictionary[langForQ]['ai_itinerary_title_end'] || ''}</h1>
                                                                                                                            <p class="trip-subtitle">${dictionary[langForQ]['ai_itinerary_subtitle_start']} ${answers[0]} ${dictionary[langForQ]['ai_itinerary_subtitle_mid']} ${answers[7]} ${dictionary[langForQ]['ai_itinerary_subtitle_end']}</p>
                                                                                                                            <button onclick="location.reload()" class="btn-feedback-submit" style="width:auto; display:inline-flex; margin-top:20px; padding:10px 25px;">
                                                                                                                                <i class="fa-solid fa-plus"></i> ${dictionary[langForQ]['ai_btn_new_trip']}
                                                                                                                            </button>
                                                                                                                                                        </div>
                                                                                                                                                        <div class="trip-content">
                                                                                                                                                            ${formatMarkdown(data.reply)}
                                                                                                                                                        </div>
                                                                                                                                                    </div>
                                                                                                                                                `;

                        } catch (e) {
                            chatContainer.innerHTML = `
                                                                                                                                                    <div class="generating-view">
                                                                                                                                                        <i class="fa-solid fa-triangle-exclamation" style="font-size:3rem; color:#d63031; margin-bottom:1rem;"></i>
                                                                                                                                                        <h3>Something went wrong.</h3>
                                                                                                                                                        <p style="color:#636e72; margin-top:10px;">${e.message}</p>
                                                                                                                                                        <button onclick="location.reload()" class="btn-submit" style="width:auto; margin-top:1.5rem;">Try Again</button>
                                                                                                                                                    </div>
                                                                                                                                                `;
                            console.error(e);
                        }
                    }
                }

                function askNextQuestion() {
                    showTyping();
                    setTimeout(() => {
                        hideTyping();
                        const langForQ = localStorage.getItem('lang') || 'en';
                        const questionKey = 'ai_q' + (currentStep + 1);
                        let questionText = "Next question...";

                        if (dictionary[langForQ] && dictionary[langForQ][questionKey]) {
                            questionText = dictionary[langForQ][questionKey];
                        }

                        const msg = `<strong>${currentStep + 1}. ${questionText}</strong>`;
                        addMessage(msg, 'ai');
                    }, 600);
                }

                function addMessage(html, type) {
                    const div = document.createElement('div');
                    div.className = `chat-message ${type}`;
                    div.innerHTML = html;
                    chatMessages.appendChild(div);
                    chatMessages.scrollTop = chatMessages.scrollHeight;
                }

                function showTyping() {
                    typingIndicator.style.display = 'flex';
                    chatMessages.scrollTop = chatMessages.scrollHeight;
                }

                function hideTyping() {
                    typingIndicator.style.display = 'none';
                }

                function formatMarkdown(text) {
                    if (!text) return '';
                    return text
                        .replace(/^### (.*$)/gim, '<h3>$1</h3>')
                        .replace(/^## (.*$)/gim, '<h2>$1</h2>')
                        .replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>')
                        .replace(/\n\n/g, '<br><br>')
                        .replace(/\n/g, '<br>')
                        .replace(/- /g, '<span style="color:var(--secondary); margin-right:5px;">&bull;</span> ');
                }
            </script>
        @else
            <!-- Grid -->
            <div class="grid-container">
                @forelse($items as $item)
                    <div class="card">
                        @php
                            $mapQuery = ($item->latitude && $item->longitude) ? $item->latitude . ',' . $item->longitude : ($item->city ?? '') . ' ' . $item->name;
                        @endphp
                        <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($mapQuery) }}" target="_blank"
                            class="card-map" title="View on Map">
                            <div class="map-marker-visual">
                                @if($activeTab === 'hotels')
                                    <i class="fa-solid fa-hotel" style="font-size: 2rem;"></i>
                                @elseif($activeTab === 'cars')
                                    <i class="fa-solid fa-car" style="font-size: 2rem;"></i>
                                @else
                                    <i class="fa-solid fa-location-dot"></i>
                                @endif
                            </div>
                        </a>
                        <div class="card-body">
                            <div class="card-header-row">
                                <h3 class="airport-name">{{ $item->name }}</h3>
                                @if($activeTab === 'airports')
                                    <span class="airport-code">{{ $item->iata_code }}</span>
                                @endif
                            </div>
                            <div class="airport-country">
                                <i class="fa-solid fa-earth-americas"></i>
                                @if($activeTab === 'hotels' || $activeTab === 'cars')
                                    {{ $item->city }}
                                @else
                                    {{ $item->country_name }}
                                @endif
                            </div>
                            @if(($activeTab === 'hotels' || $activeTab === 'cars') && $item->price)
                                <div style="font-size: 0.95rem; color: var(--secondary); margin-top: 5px; font-weight: 700;">
                                    <i class="fa-solid fa-tag"></i> ${{ number_format($item->price, 2) }}
                                    @if($activeTab === 'cars') <span style="font-size:0.8em; color:#b2bec3; font-weight:400;"
                                    data-t="per_day">/day</span> @endif
                                </div>
                            @endif
                        </div>
                        <div class="card-controls">
                            @if($activeTab === 'airports')
                                <button class="btn-ctrl btn-details"
                                    onclick="openDetails('{{ addslashes($item->name) }}', '{{ $item->iata_code }}', '{{ addslashes($item->country_name) }}')">
                                    <i class="fa-solid fa-circle-info"></i> <span data-t="btn_details">Details</span>
                                </button>
                            @endif

                            @if($activeTab === 'hotels')
                                <a href="{{ route('hotels.book') }}" class="btn-ctrl btn-book" style="text-decoration: none;">
                                    <i class="fa-solid fa-ticket"></i> <span data-t="btn_book_room">Book Room</span>
                                </a>
                            @elseif($activeTab === 'airports')
                                <a href="{{ route('flights.book') }}" class="btn-ctrl btn-book" style="text-decoration: none;">
                                    <i class="fa-solid fa-ticket"></i> <span data-t="btn_book_flight">Book Flight</span>
                                </a>
                            @elseif($activeTab === 'cars')
                                <a href="{{ route('cars.book') }}" class="btn-ctrl btn-book" style="text-decoration: none;">
                                    <i class="fa-solid fa-ticket"></i> <span data-t="btn_rent_car">Rent Car</span>
                                </a>
                            @else
                                <button class="btn-ctrl btn-book">
                                    <i class="fa-solid fa-ticket"></i>
                                    <span data-t="btn_book_flight">Book Flight</span>
                                </button>
                            @endif

                            <button class="btn-ctrl btn-feedback"
                                onclick="handleFeedbackClick('{{ addslashes($item->name) }}')">
                                <i class="fa-regular fa-comment-dots"></i> <span data-t="btn_feedback">Feedback</span>
                            </button>
                        </div>
                    </div>
                @empty
                    <div style="grid-column: 1/-1; text-align: center; padding: 4rem; color: #b2bec3;">
                        @php
                            $emptyIcon = 'fa-plane-slash';
                            if ($activeTab === 'hotels')
                                $emptyIcon = 'fa-hotel';
                            if ($activeTab === 'cars')
                                $emptyIcon = 'fa-car';
                        @endphp
                        <i class="fa-solid {{ $emptyIcon }}" style="font-size: 3rem; margin-bottom: 1rem;"></i>
                        <p data-t="text_no_results">No {{ $activeTab }} found. Please check back later.</p>
                    </div>
                @endforelse
            </div>
        @endif
    </main>

    <!-- Update Feedback Form User Access -->
    <script>
        // Update values dynamically if needed, but for now PHP blade renders them.
    </script>

    <!-- JS Logic -->
    <script>
        const isUserLoggedIn = {{ Auth::guard('flutter_web')->check() ? 'true' : 'false' }};

        function handleFeedbackClick(airportName) {
            if (!isUserLoggedIn) {
                window.location.href = "{{ route('login') }}";
            } else {
                openFeedback(airportName);
            }
        }
    </script>
    <!-- Real-time Search Logic -->
    <script>
        const searchInput = document.getElementById('searchInput');
        const cards = document.querySelectorAll('.card');

        searchInput.addEventListener('input', function (e) {
            const query = e.target.value.toLowerCase().trim();

            cards.forEach(card => {
                const name = card.querySelector('.airport-name')?.innerText.toLowerCase() || '';
                const code = card.querySelector('.airport-code')?.innerText.toLowerCase() || '';
                const country = card.querySelector('.airport-country')?.innerText.toLowerCase() || '';

                // Construct searchable content
                const searchable = `${name} ${code} ${country}`;

                if (searchable.includes(query)) {
                    card.style.display = 'flex';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    </script>
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

        const dictionary = {
            en: {
                page_title: "@if($activeTab === 'ai') Just Mine Travel AI @else Browse {{ ucfirst($activeTab) }} @endif",
                greeting: "Welcome back,",
                btn_logout: 'Logout <i class="fa-solid fa-right-from-bracket"></i>',
                search_placeholder: "Search {{ $activeTab }}...",
                tab_airports: "Airports",
                tab_hotels: "Hotels",
                tab_cars: "Cars",
                tab_ai: "AI Assistant",
                // Merged Content
                page_title_ai: "Just Mine Travel AI",
                page_title_browse: "Browse",
                find_destination_gateway: "Find your next destination gateway",
                find_perfect_stay: "Find your next perfect stay",
                find_perfect_ride: "Find your perfect ride",
                welcome_back: "Welcome back",
                btn_login: "Login",
                ai_greeting: "Hello! I'm Just Mine Travel AI.",
                ai_intro_part1: "I can help you plan your perfect trip from start to finish. Let's build your dream itinerary together!",
                ai_intro_part2: "To begin, please tell me:",
                ai_intro_q1: "1. What is your preferred weather for this trip?",
                sunny: "Sunny",
                cold_snowy: "Cold/Snowy",
                rainy: "Rainy",
                cloudy: "Cloudy",
                moderate: "Moderate",
                typing_placeholder: "Type your answer here...",
                generating_title: "Designing Your Dream Trip...",
                generating_subtitle: "Our AI is finding the best flights, hotels, and experiences for you.",
                feedback_title: "Your Feedback",
                feedback_share_experience: "Sharing your experience for",
                feedback_helps_us_improve: "helps us improve.",
                posting_as: "Posting as",
                verified_email: "Verified Email",
                feedback_experience_question: "How was your experience?",
                rating_excellent: "Excellent",
                rating_good: "Good",
                rating_average: "Average",
                rating_poor: "Poor",
                rating_terrible: "Terrible",
                feedback_tell_us_more: "Tell us more",
                feedback_placeholder: "What did you like? What can we do better?",
                feedback_confidential: "Your feedback is confidential",
                btn_submit_review: "Submit Review",
                btn_close: "Close",
                flights_from: "Flights from",
                loading_flights: "Loading flights...",
                no_flights_found: "No scheduled flights found from this airport.",
                failed_to_load_flights: "Failed to load flights. Please try again later.",
                flight_duration_hours: "h",
                btn_details: "Details",
                btn_book_flight: "Book Flight",
                btn_book_room: "Book Room",
                btn_rent_car: "Rent Car",
                btn_feedback: "Feedback",
                label_posting_as: "Posting as",
                label_verified_email: "Verified Email",
                label_experience_question: "How was your experience?",
                label_tell_us_more: "Tell us more",
                label_tell_us_more: "Tell us more",
                text_no_results: "No {{ $activeTab }} found. Please check back later.",
                per_day: "/day",
                ai_q1: "What is your preferred weather?",
                ai_q2: "Which destination would you like to visit?",
                ai_q3: "What is your approximate budget?",
                ai_q4: "Departure city?",
                ai_q5: "Preferred type of accommodation?",
                ai_q6: "Preferred means of transportation during the trip?",
                ai_q7: "Any preferred type of food or cuisine?",
                ai_q8: "Duration of the trip (e.g., 5 days)?",
                ai_q9: "What is your main purpose for this trip?",
                ai_q10: "How many people are traveling with you?",
                ai_q11: "Should we recommend the cheapest flight or a specific airline?",
                ai_msg_weather_choice_start: "Great choice! Based on",
                ai_msg_weather_choice_end: "weather, here are some top destinations:",
                ai_msg_suggestion_fail: "I couldn't load specific suggestions, but where would you like to go?",
                ai_itinerary_title_start: "Your",
                ai_itinerary_title_end: "Itinerary",
                ai_itinerary_subtitle_start: "Customized for",
                ai_itinerary_subtitle_mid: " weather |",
                ai_itinerary_subtitle_end: " trip",
                ai_btn_new_trip: "New Trip"
            },
            ru: {
                page_title: "@if($activeTab === 'ai') Just Mine Travel AI @else Просмотр {{ ucfirst($activeTab) }} @endif",
                greeting: "С возвращением,",
                btn_logout: 'Выйти <i class="fa-solid fa-right-from-bracket"></i>',
                search_placeholder: "Поиск {{ $activeTab }}...",
                tab_airports: "Аэропорты",
                tab_hotels: "Отели",
                tab_cars: "Авто",
                tab_ai: "AI Ассистент",
                page_title_ai: "Just Mine Travel AI",
                page_title_browse: "Просмотр",
                find_destination_gateway: "Найдите свои следующие ворота в мир",
                find_perfect_stay: "Найдите идеальное место для проживания",
                find_perfect_ride: "Найдите свой идеальный автомобиль",
                welcome_back: "С возвращением",
                btn_login: "Войти",
                ai_greeting: "Привет! Я Just Mine Travel AI.",
                ai_intro_part1: "Я помогу спланировать ваше идеальное путешествие от начала до конца. Давайте создадим маршрут вашей мечты вместе!",
                ai_intro_part2: "Для начала скажите мне:",
                ai_intro_q1: "Какую погоду вы предпочитаете?",
                sunny: "Солнечно",
                cold_snowy: "Холодно/Снег",
                rainy: "Дождь",
                cloudy: "Облачно",
                moderate: "Умеренно",
                typing_placeholder: "Введите ответ...",
                generating_title: "Создаем путешествие мечты...",
                generating_subtitle: "Наш ИИ ищет лучшие рейсы, отели и впечатления для вас.",
                feedback_title: "Ваш отзыв",
                feedback_share_experience: "Поделитесь впечатлением о",
                feedback_helps_us_improve: "помогает нам стать лучше.",
                posting_as: "От имени",
                verified_email: "Подтвержденный Email",
                feedback_experience_question: "Как всё прошло?",
                rating_excellent: "Отлично",
                rating_good: "Хорошо",
                rating_average: "Средне",
                rating_poor: "Плохо",
                rating_terrible: "Ужасно",
                feedback_tell_us_more: "Расскажите подробнее",
                feedback_placeholder: "Что понравилось? Что можно улучшить?",
                feedback_confidential: "Ваш отзыв конфиденциален",
                btn_submit_review: "Отправить отзыв",
                btn_close: "Закрыть",
                flights_from: "Рейсы из",
                loading_flights: "Загрузка рейсов...",
                no_flights_found: "Рейсы не найдены.",
                failed_to_load_flights: "Ошибка загрузки рейсов.",
                flight_duration_hours: "ч",
                btn_details: "Детали",
                btn_book_flight: "Забронировать",
                btn_book_room: "Забронировать",
                btn_rent_car: "Арендовать",
                btn_feedback: "Отзыв",
                label_posting_as: "От имени",
                label_verified_email: "Email",
                label_experience_question: "Как всё прошло?",
                label_tell_us_more: "Расскажите",
                text_no_results: "Ничего не найдено.",
                per_day: "/день",
                ai_q1: "Какую погоду вы предпочитаете?",
                ai_q2: "У вас есть предпочтительный континент?",
                ai_q3: "Какой у вас бюджет?",
                ai_q4: "Город вылета?",
                ai_q5: "Какое жилье предпочитаете?",
                ai_q6: "Предпочтительный транспорт?",
                ai_q7: "Предпочтения в еде?",
                ai_q8: "Длительность (дней)?",
                ai_q9: "Цель поездки?",
                ai_q10: "Сколько человек?",
                ai_q11: "Дешевле или авиакомпания?",
                ai_msg_weather_choice_start: "Хороший выбор!",
                ai_msg_weather_choice_end: "погода звучит отлично.",
                ai_msg_continent_choice: "Записано.",
                ai_msg_interest_choice_start: "Звучит весело!",
                ai_msg_interest_choice_end: "путешествие будет незабываемым.",
                ai_msg_flight_choice: "Понял.",
                ai_msg_budget_choice_start: "Отлично.",
                ai_msg_budget_choice_end: "бюджет.",
                ai_msg_duration_choice: "Дней:",
                ai_msg_travelers_choice: "Путешественники:",
                ai_msg_accommodation_choice: "Жилье:",
                ai_msg_visa_choice: "Виза:",
                ai_msg_activities_choice: "Экскурсии:",
                ai_msg_special_req_choice: "Особые:",
                ai_itinerary_title_start: "Маршрут в",
                ai_itinerary_title_end: "",
                ai_itinerary_subtitle_start: "Специально для погоды",
                ai_itinerary_subtitle_mid: "|",
                ai_itinerary_subtitle_end: "путешествие",
                ai_btn_new_trip: "Новое путешествие",
                ai_msg_suggestion_fail: "Не удалось загрузить рекомендации, куда бы вы хотели поехать?"
            },
            ar: {
                page_title: "@if($activeTab === 'ai') جسـت مـاين للذكاء الاصطناعي @else تصفح {{ $activeTab === 'airports' ? 'المطارات' : ($activeTab === 'hotels' ? 'الفنادق' : 'السيارات') }} @endif",
                greeting: "مرحباً بك مجدداً،",
                btn_logout: 'تسجيل الخروج <i class="fa-solid fa-right-from-bracket"></i>',
                search_placeholder: "البحث في {{ $activeTab === 'airports' ? 'المطارات' : ($activeTab === 'hotels' ? 'الفنادق' : 'السيارات') }}...",
                tab_airports: "المطارات",
                tab_hotels: "الفنادق",
                tab_cars: "السيارات",
                tab_ai: "مساعد الذكاء الاصطناعي",
                // Merged Content
                page_title_ai: "الذكاء الاصطناعي للسفر الخاص بي",
                page_title_browse: "تصفح",
                find_destination_gateway: "ابحث عن وجهتك القادمة",
                find_perfect_stay: "ابحث عن إقامتك المثالية التالية",
                find_perfect_ride: "ابحث عن رحلتك المثالية",
                welcome_back: "أهلاً بك مرة أخرى",
                btn_login: "تسجيل الدخول",
                ai_greeting: "مرحباً! أنا الذكاء الاصطناعي للسفر الخاص بي.",
                ai_intro_part1: "يمكنني مساعدتك في تخطيط رحلتك المثالية من البداية إلى النهاية. دعنا نبني خط سير رحلتك الأحلام معاً!",
                ai_intro_part2: "للبدء، من فضلك أخبرني:",
                ai_intro_q1: "1. ما هو الطقس المفضل لديك لهذه الرحلة؟",
                sunny: "مشمس",
                cold_snowy: "بارد/ثلجي",
                rainy: "ممطر",
                cloudy: "غائم",
                moderate: "معتدل",
                typing_placeholder: "اكتب إجابتك هنا...",
                generating_title: "نصمم رحلة أحلامك...",
                generating_subtitle: "يبحث الذكاء الاصطناعي لدينا عن أفضل الرحلات الجوية والفنادق والتجارب لك.",
                feedback_title: "ملاحظاتك",
                feedback_share_experience: "مشاركة تجربتك لـ",
                feedback_helps_us_improve: "تساعدنا على التحسين.",
                posting_as: "تنشر باسم",
                verified_email: "بريد إلكتروني موثق",
                feedback_experience_question: "كيف كانت تجربتك؟",
                rating_excellent: "ممتاز",
                rating_good: "جيد",
                rating_average: "متوسط",
                rating_poor: "ضعيف",
                rating_terrible: "سيء جداً",
                feedback_tell_us_more: "أخبرنا المزيد",
                feedback_placeholder: "ماذا أعجبك؟ ماذا يمكننا أن نفعل بشكل أفضل؟",
                feedback_confidential: "ملاحظاتك سرية",
                btn_submit_review: "إرسال المراجعة",
                btn_close: "إغلاق",
                flights_from: "رحلات من",
                loading_flights: "جاري تحميل الرحلات...",
                no_flights_found: "لم يتم العثور على رحلات مجدولة من هذا المطار.",
                failed_to_load_flights: "فشل تحميل الرحلات. يرجى المحاولة مرة أخرى لاحقاً.",
                per_day: "/يوم",
                ai_q1: "ما هو الطقس المفضل لديك؟",
                ai_q2: "أي وجهة ترغب في زيارتها؟",
                ai_q3: "ما هي ميزانيتك التقريبية؟",
                ai_q4: "مدينة المغادرة؟",
                ai_q5: "نوع الإقامة المفضل؟",
                ai_q6: "وسيلة النقل المفضلة أثناء الرحلة؟",
                ai_q7: "أي نوع مفضل من الطعام أو المطبخ؟",
                ai_q8: "مدة الرحلة (مثلاً: 5 أيام)؟",
                ai_q9: "ما هو الغرض الرئيسي من هذه الرحلة؟",
                ai_q10: "كم عدد المسافرين معك؟",
                ai_q11: "هل نوصي بأرخص رحلة أم بخطوط طيران محددة؟",
                ai_msg_weather_choice_start: "اختيار رائع! بناءً على الطقس",
                ai_msg_weather_choice_end: "، إليك بعض الوجهات المميزة:",
                ai_msg_suggestion_fail: "لم أتمكن من تحميل اقتراحات محددة، لكن إلى أين ترغب في الذهاب؟",
                ai_itinerary_title_start: "مسار رحلتك إلى",
                ai_itinerary_title_end: "",
                ai_itinerary_subtitle_start: "مخصص للطقس",
                ai_itinerary_subtitle_mid: "|",
                ai_itinerary_subtitle_end: "رحلة",
                ai_btn_new_trip: "رحلة جديدة",
                flight_duration_hours: "س",
                btn_details: "تفاصيل",
                btn_book_flight: "حجز رحلة",
                btn_book_room: "حجز غرفة",
                btn_rent_car: "استئجار سيارة",
                btn_feedback: "ملاحظات",
                label_posting_as: "النشر باسم",
                label_verified_email: "البريد الإلكتروني الموثق",
                label_experience_question: "كيف كانت تجربتك؟",
                label_tell_us_more: "أخبرنا المزيد",
                text_no_results: "لم يتم العثور على {{ $activeTab === 'airports' ? 'رحلات' : ($activeTab === 'hotels' ? 'فنادق' : 'سيارات') }}. يرجى التحقق مرة أخرى لاحقاً.",
                per_day: "/يوم"
            },
            zh: {
                page_title: "@if($activeTab === 'ai') Just Mine Travel AI @else 浏览 {{ ucfirst($activeTab) }} @endif",
                greeting: "欢迎回来，",
                btn_logout: '注销 <i class="fa-solid fa-right-from-bracket"></i>',
                search_placeholder: "搜索 {{ $activeTab === 'airports' ? '机场' : ($activeTab === 'hotels' ? '酒店' : '汽车') }}...",
                tab_airports: "机场",
                tab_hotels: "酒店",
                tab_cars: "汽车",
                tab_ai: "AI 助手",
                page_title_ai: "Just Mine Travel AI",
                page_title_browse: "浏览",
                find_destination_gateway: "寻找您的下一个目的地",
                find_perfect_stay: "寻找您的下一个完美住宿",
                find_perfect_ride: "寻找您的完美座驾",
                welcome_back: "欢迎回来",
                btn_login: "登录",
                ai_greeting: "你好！我是 Just Mine Travel AI。",
                ai_intro_part1: "我可以帮助您从头到尾通过 AI 计划您的完美旅行。让我们一起构建您梦想中的行程！",
                ai_intro_part2: "首先，请告诉我：",
                ai_intro_q1: "1. 您这次旅行喜欢什么样的天气？",
                sunny: "晴朗",
                cold_snowy: "寒冷/下雪",
                rainy: "下雨",
                cloudy: "多云",
                moderate: "温和",
                typing_placeholder: "在此输入您的答案...",
                generating_title: "正在设计您的梦想之旅...",
                generating_subtitle: "我们的 AI 正在为您寻找最佳航班、酒店和体验。",
                feedback_title: "您的反馈",
                feedback_share_experience: "分享您的体验",
                feedback_helps_us_improve: "帮助我们改进。",
                posting_as: "发布身份",
                verified_email: "已验证邮箱",
                feedback_experience_question: "您的体验如何？",
                rating_excellent: "优秀",
                rating_good: "良好",
                rating_average: "一般",
                rating_poor: "差",
                rating_terrible: "极差",
                feedback_tell_us_more: "告诉我们更多",
                feedback_placeholder: "您喜欢什么？我们哪里可以做得更好？",
                feedback_confidential: "您的反馈是保密的",
                btn_submit_review: "提交评论",
                btn_close: "关闭",
                flights_from: "航班出发地",
                loading_flights: "正在加载航班...",
                no_flights_found: "未找到该机场的定期航班。",
                failed_to_load_flights: "加载航班失败。请稍后再试。",
                flight_duration_hours: "小时",
                btn_details: "详情",
                btn_book_flight: "预订航班",
                btn_book_room: "预订房间",
                btn_rent_car: "租车",
                btn_feedback: "反馈",
                label_posting_as: "发布身份",
                label_verified_email: "已验证邮箱",
                label_experience_question: "您的体验如何？",
                label_tell_us_more: "告诉我们更多",
                text_no_results: "未找到 {{ $activeTab === 'airports' ? '机场' : ($activeTab === 'hotels' ? '酒店' : '汽车') }}。请稍后再试。",
                per_day: "/天",
                ai_q1: "您喜欢什么样的天气？",
                ai_q2: "您想去哪个目的地？",
                ai_q3: "您的预算大约是多少？",
                ai_q4: "出发城市？",
                ai_q5: "喜欢的住宿类型？",
                ai_q6: "旅行期间首选的交通工具？",
                ai_q7: "有喜欢的食物或菜系吗？",
                ai_q8: "旅行时长（例如：5天）？",
                ai_q9: "这次旅行的主要目的是什么？",
                ai_q10: "有多少人与您同行？",
                ai_q11: "我们应该推荐最便宜的航班还是特定的航空公司？",
                ai_msg_weather_choice_start: "不错的选择！基于",
                ai_msg_weather_choice_end: "天气，这里有一些热门目的地：",
                ai_msg_suggestion_fail: "我无法加载具体的建议，但您想去哪里？",
                ai_msg_continent_choice: "已记录。",
                ai_msg_interest_choice_start: "听起来很有趣！",
                ai_msg_interest_choice_end: "旅行将会很难忘。",
                ai_msg_flight_choice: "明白了。",
                ai_msg_budget_choice_start: "太好了。",
                ai_msg_budget_choice_end: "预算。",
                ai_msg_duration_choice: "天数：",
                ai_msg_travelers_choice: "旅客：",
                ai_msg_accommodation_choice: "住宿：",
                ai_msg_visa_choice: "签证：",
                ai_msg_activities_choice: "活动：",
                ai_msg_special_req_choice: "特殊要求：",
                ai_itinerary_title_start: "您的",
                ai_itinerary_title_end: "行程",
                ai_itinerary_subtitle_start: "专为",
                ai_itinerary_subtitle_mid: "天气定制 |",
                ai_itinerary_subtitle_end: "之旅",
                ai_btn_new_trip: "新旅程"
            },
            fr: {
                page_title: "@if($activeTab === 'ai') Just Mine Travel IA @else Parcourir {{ $activeTab === 'airports' ? 'les Aéroports' : ($activeTab === 'hotels' ? 'les Hôtels' : 'les Voitures') }} @endif",
                greeting: "Bon retour,",
                btn_logout: 'Déconnexion <i class="fa-solid fa-right-from-bracket"></i>',
                search_placeholder: "Rechercher {{ $activeTab === 'airports' ? 'des aéroports' : ($activeTab === 'hotels' ? 'des hôtels' : 'des voitures') }}...",
                tab_airports: "Aéroports",
                tab_hotels: "Hôtels",
                tab_cars: "Voitures",
                tab_ai: "Assistant IA",
                page_title_ai: "Just Mine Travel IA",
                page_title_browse: "Parcourir",
                find_destination_gateway: "Trouvez votre prochaine porte d'entrée",
                find_perfect_stay: "Trouvez votre prochain séjour parfait",
                find_perfect_ride: "Trouvez votre trajet parfait",
                welcome_back: "Bon retour",
                btn_login: "Connexion",
                ai_greeting: "Bonjour ! Je suis Just Mine Travel IA.",
                ai_intro_part1: "Je peux vous aider à planifier votre voyage parfait du début à la fin. Construisons ensemble l'itinéraire de vos rêves !",
                ai_intro_part2: "Pour commencer, dites-moi :",
                ai_intro_q1: "1. Quel temps préférez-vous pour ce voyage ?",
                sunny: "Ensoleillé",
                cold_snowy: "Froid/Neigeux",
                rainy: "Pluvieux",
                cloudy: "Nuageux",
                moderate: "Modéré",
                typing_placeholder: "Tapez votre réponse ici...",
                generating_title: "Conception de votre voyage de rêve...",
                generating_subtitle: "Notre IA recherche les meilleurs vols, hôtels et expériences pour vous.",
                feedback_title: "Vos commentaires",
                feedback_share_experience: "Partager votre expérience pour",
                feedback_helps_us_improve: "nous aide à nous améliorer.",
                posting_as: "Publié en tant que",
                verified_email: "Email vérifié",
                feedback_experience_question: "Comment s'est passée votre expérience ?",
                rating_excellent: "Excellent",
                rating_good: "Bon",
                rating_average: "Moyen",
                rating_poor: "Mauvais",
                rating_terrible: "Terrible",
                feedback_tell_us_more: "Dites-nous en plus",
                feedback_placeholder: "Qu'avez-vous aimé ? Que pouvons-nous améliorer ?",
                feedback_confidential: "Vos commentaires sont confidentiels",
                btn_submit_review: "Soumettre l'avis",
                btn_close: "Fermer",
                flights_from: "Vols de",
                loading_flights: "Chargement des vols...",
                no_flights_found: "Aucun vol prévu trouvé depuis cet aéroport.",
                failed_to_load_flights: "Échec du chargement des vols. Veuillez réessayer plus tard.",
                flight_duration_hours: "h",
                btn_details: "Détails",
                btn_book_flight: "Réserver vol",
                btn_book_room: "Réserver chambre",
                btn_rent_car: "Louer voiture",
                btn_feedback: "Avis",
                label_posting_as: "Publié en tant que",
                label_verified_email: "Email vérifié",
                label_experience_question: "Comment s'est passée votre expérience ?",
                label_tell_us_more: "Dites-nous en plus",
                text_no_results: "Aucun(e) {{ $activeTab }} trouvé(e). Veuillez vérifier plus tard.",
                per_day: "/jour",
                ai_q1: "Quel temps préférez-vous ?",
                ai_q2: "Quelle destination souhaitez-vous visiter ?",
                ai_q3: "Quel est votre budget approximatif ?",
                ai_q4: "Ville de départ ?",
                ai_q5: "Type d'hébergement préféré ?",
                ai_q6: "Moyen de transport préféré pendant le voyage ?",
                ai_q7: "Type de nourriture ou cuisine préférée ?",
                ai_q8: "Durée du voyage (ex: 5 jours) ?",
                ai_q9: "Quel est le but principal de ce voyage ?",
                ai_q10: "Combien de personnes voyagent avec vous ?",
                ai_q11: "Devons-nous recommander le vol le moins cher ou une compagnie spécifique ?",
                ai_msg_weather_choice_start: "Excellent choix ! Basé sur",
                ai_msg_weather_choice_end: "la météo, voici quelques destinations phares :",
                ai_msg_suggestion_fail: "Je n'ai pas pu charger de suggestions spécifiques, mais où aimeriez-vous aller ?",
                ai_msg_continent_choice: "Noté.",
                ai_msg_interest_choice_start: "Ça a l'air amusant !",
                ai_msg_interest_choice_end: "le voyage sera inoubliable.",
                ai_msg_flight_choice: "Compris.",
                ai_msg_budget_choice_start: "Parfait.",
                ai_msg_budget_choice_end: "budget.",
                ai_msg_duration_choice: "Jours :",
                ai_msg_travelers_choice: "Voyageurs :",
                ai_msg_accommodation_choice: "Hébergement :",
                ai_msg_visa_choice: "Visa :",
                ai_msg_activities_choice: "Activités :",
                ai_msg_special_req_choice: "Spécial :",
                ai_itinerary_title_start: "Votre",
                ai_itinerary_title_end: "Itinéraire",
                ai_itinerary_subtitle_start: "Personnalisé pour",
                ai_itinerary_subtitle_mid: "météo |",
                ai_itinerary_subtitle_end: "voyage",
                ai_btn_new_trip: "Nouveau voyage"
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

            // Apply generic dictionary replacements
            if (dictionary[lang]) {
                document.querySelectorAll('[data-t]').forEach(el => {
                    const key = el.getAttribute('data-t');
                    if (dictionary[lang][key]) {
                        el.innerHTML = dictionary[lang][key];
                    }
                });

                // Update Search Placeholder
                const searchInp = document.getElementById('searchInput');
                if (searchInp && dictionary[lang].search_placeholder) {
                    searchInp.placeholder = dictionary[lang].search_placeholder;
                }

                // Update specific Feedback placeholder
                const feedbackPlaceholder = document.querySelector('.feedback-textarea');
                if (feedbackPlaceholder && dictionary[lang]['feedback_placeholder']) {
                    feedbackPlaceholder.placeholder = dictionary[lang]['feedback_placeholder'];
                }

                // AI Chat Greeting and Intro
                const aiGreetingElement = document.querySelector('.chat-message.ai strong');
                if (aiGreetingElement && dictionary[lang]['ai_greeting']) {
                    aiGreetingElement.innerText = dictionary[lang]['ai_greeting'];
                }

                // Weather button translations (preserves logic from previous block)
                document.querySelectorAll('#weatherOptions .weather-btn').forEach(btn => {
                    const originalText = btn.getAttribute('onclick').match(/'([^']+)'/)[1];
                    let translatedText = originalText;
                    if (originalText === 'Sunny' && dictionary[lang]['sunny']) translatedText = dictionary[lang]['sunny'];
                    else if (originalText === 'Cold/Snowy' && dictionary[lang]['cold_snowy']) translatedText = dictionary[lang]['cold_snowy'];
                    else if (originalText === 'Rainy' && dictionary[lang]['rainy']) translatedText = dictionary[lang]['rainy'];
                    else if (originalText === 'Cloudy' && dictionary[lang]['cloudy']) translatedText = dictionary[lang]['cloudy'];
                    else if (originalText === 'Moderate' && dictionary[lang]['moderate']) translatedText = dictionary[lang]['moderate'];

                    const icon = btn.querySelector('i');
                    btn.innerHTML = '';
                    if (icon) btn.appendChild(icon);
                    btn.innerHTML += ` ${translatedText}`;
                });

                // Chat Input Placeholder
                const chatInput = document.getElementById('chatInput');
                if (chatInput && dictionary[lang]['typing_placeholder']) {
                    chatInput.placeholder = dictionary[lang]['typing_placeholder'];
                }

                // Generating View Texts
                const generatingTitle = document.querySelector('.generating-view h2');
                if (generatingTitle && dictionary[lang]['generating_title']) {
                    generatingTitle.innerText = dictionary[lang]['generating_title'];
                }
                const generatingSubtitle = document.querySelector('.generating-view p');
                if (generatingSubtitle && dictionary[lang]['generating_subtitle']) {
                    generatingSubtitle.innerText = dictionary[lang]['generating_subtitle'];
                }
            }
        }

        // Initialize language
        const savedLang = localStorage.getItem('lang') || 'en';
        applyLang(savedLang);

        // Global functions using the dictionary
        function openFeedback(name) {
            document.getElementById('feedbackItemName').value = name;
            document.getElementById('feedbackTargetName').innerText = name;
            document.getElementById('feedbackModal').classList.add('active');
        }

        async function openDetails(name, code, country) {
            const currentLang = localStorage.getItem('lang') || 'en';
            document.getElementById('detailsTitle').innerText = `${dictionary[currentLang]['flights_from']} ${name}`;
            const contentDiv = document.getElementById('detailsContent');

            contentDiv.innerHTML = `<div class="loading-spinner"><i class="fa-solid fa-circle-notch fa-spin"></i> ${dictionary[currentLang]['loading_flights']}</div>`;
            document.getElementById('detailsModal').classList.add('active');

            try {
                const response = await fetch(`/api/flights?origin=${code}`);
                const flights = await response.json();

                if (flights.length > 0) {
                    let flightsHtml = '<div class="flight-list">';
                    flights.forEach(f => {
                        flightsHtml += `
                            <div class="flight-item">
                                <div class="flight-info">
                                    <div class="flight-route">
                                        ${f.origin_code} <i class="fa-solid fa-arrow-right" style="color: #b2bec3; font-size: 0.8em;"></i> ${f.destination_code}
                                    </div>
                                    <div class="flight-meta">
                                        <span><i class="fa-solid fa-plane"></i> ${f.airline}</span>
                                        <span><i class="fa-regular fa-clock"></i> ${f.duration}${dictionary[currentLang]['flight_duration_hours']}</span>
                                        <span><i class="fa-regular fa-calendar"></i> ${f.departure_date}</span>
                                    </div>
                                </div>
                                <div class="flight-price">$${f.price}</div>
                            </div>
                        `;
                    });
                    flightsHtml += '</div>';
                    contentDiv.innerHTML = flightsHtml;
                } else {
                    contentDiv.innerHTML = `
                        <div style="text-align: center; padding: 2rem; color: #b2bec3;">
                            <i class="fa-solid fa-plane-slash" style="font-size: 2rem; margin-bottom: 1rem;"></i>
                            <p>${dictionary[currentLang]['no_flights_found']}</p>
                        </div>
                    `;
                }

            } catch (error) {
                contentDiv.innerHTML = `<div style="color: #d63031; text-align: center;">${dictionary[currentLang]['failed_to_load_flights']}</div>`;
                console.error(error);
            }
        }

        function closeModal(id) {
            document.getElementById(id).classList.remove('active');
        }

        // Event Listeners Initialization
        document.addEventListener('DOMContentLoaded', () => {
            const savedLang = localStorage.getItem('lang') || 'en';
            applyLang(savedLang);

            // Language Dropdown Logic
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

            // Modal outside click
            window.onclick = function (event) {
                if (event.target.classList.contains('modal-overlay')) {
                    event.target.classList.remove('active');
                }
            }

            // Theme Toggle
            const savedTheme = localStorage.getItem('theme') || 'light';
            document.documentElement.setAttribute('data-theme', savedTheme);
            if (themeToggle) {
                themeToggle.innerHTML = savedTheme === 'dark' ? sunIcon : moonIcon;
                themeToggle.addEventListener('click', () => {
                    playClickSound();
                    const currentTheme = document.documentElement.getAttribute('data-theme');
                    const newTheme = currentTheme === 'light' ? 'dark' : 'light';
                    document.documentElement.setAttribute('data-theme', newTheme);
                    localStorage.setItem('theme', newTheme);
                    themeToggle.innerHTML = newTheme === 'dark' ? sunIcon : moonIcon;
                    themeToggle.classList.add('pulse');
                    setTimeout(() => themeToggle.classList.remove('pulse'), 500);
                });
            }
        });
    </script>
</body>

</html>