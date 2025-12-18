<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Your Email - Just Travel</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Outfit', sans-serif;
            background-color: #f7f9fc;
            margin: 0;
            padding: 0;
            color: #2d3436;
        }

        .email-container {
            max-width: 600px;
            margin: 40px auto;
            background-color: #ffffff;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }

        .header {
            background: linear-gradient(135deg, #0984e3 0%, #00cec9 100%);
            padding: 40px;
            text-align: center;
        }

        .logo {
            color: white;
            font-size: 28px;
            font-weight: 800;
            text-decoration: none;
            letter-spacing: -1px;
        }

        .content {
            padding: 40px;
            text-align: center;
        }

        .icon-circle {
            width: 80px;
            height: 80px;
            background-color: #f0fdfc;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
        }

        .icon {
            font-size: 32px;
            color: #00cec9;
        }

        h1 {
            color: #2d3436;
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 15px;
        }

        p {
            color: #636e72;
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 30px;
        }

        .btn-verify {
            display: inline-block;
            background: linear-gradient(135deg, #0984e3 0%, #00cec9 100%);
            color: #ffffff;
            text-decoration: none;
            padding: 16px 32px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 16px;
            box-shadow: 0 10px 20px rgba(9, 132, 227, 0.3);
            transition: transform 0.2s;
        }

        .btn-verify:hover {
            transform: translateY(-2px);
        }

        .footer {
            background-color: #f7f9fc;
            padding: 20px;
            text-align: center;
            color: #b2bec3;
            font-size: 12px;
        }

        .footer a {
            color: #0984e3;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="header">
            <a href="{{ url('/') }}" class="logo">Just Travel.</a>
        </div>
        <div class="content">
            <div class="icon-circle">
                <!-- Simple Envelope Icon SVG -->
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4 7.00005L10.2 11.65C11.2667 12.45 12.7333 12.45 13.8 11.65L20 7" stroke="#00cec9"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    <rect x="3" y="5" width="18" height="14" rx="2" stroke="#00cec9" stroke-width="2"
                        stroke-linecap="round" />
                </svg>
            </div>
            <h1>Verify your email address</h1>
            <p>
                Welcome to Just Travel! We're excited to have you on board.
                Please click the button below to verify your email address and unlock your full AI-powered travel
                experience.
            </p>
            <a href="{{ $url }}" class="btn-verify">Verify Email</a>
            <p style="margin-top: 30px; font-size: 14px;">
                If you did not create an account, no further action is required.
            </p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} Just Travel Inc. All rights reserved.<br>
            <a href="{{ url('/privacy-policy') }}">Privacy Policy</a> | <a
                href="{{ url('/terms-and-conditions') }}">Terms of Service</a>
        </div>
    </div>
</body>

</html>