<!DOCTYPE html>
<html lang="en" style="margin: 0; padding: 0">
<head>
    <meta charset="UTF-8">
    <title>Verify Your Email</title>
</head>
<body style="margin: 0; padding: 0; font-family: 'Segoe UI', sans-serif; background-color: #f4f4f4;">
    <div style="max-width: 600px; margin: 40px auto; background-color: white; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); overflow: hidden;">
        <div style="background-color: #3f51b5; color: white; padding: 25px 30px; text-align: center;">
            <h2 style="margin: 0; font-size: 26px;">Just Travel</h2>
            <p style="margin: 0; font-size: 16px;">Confirm your email to continue</p>
        </div>

        <div style="padding: 30px;">
            <p style="font-size: 16px; color: #333;">Hello {{ $user->first_name }},</p>

            <p style="font-size: 15px; color: #555;">
                Thank you for registering with <strong>Just Travel</strong>! <br>
                Please verify your email address to activate your account.
            </p>

            <div style="text-align: center; margin: 30px 0;">
                <a href="{{ $verificationUrl }}" style="
                    background-color: #3f51b5;
                    color: white;
                    padding: 12px 25px;
                    text-decoration: none;
                    border-radius: 8px;
                    font-size: 16px;
                    display: inline-block;
                    box-shadow: 0 2px 5px rgba(0,0,0,0.2);
                ">Verify Email</a>
            </div>

            <p style="font-size: 14px; color: #999; text-align: center;">
                If you didn’t create this account, you can safely ignore this email.
            </p>
        </div>

        <div style="background-color: #e8eaf6; padding: 15px 30px; text-align: center; font-size: 13px; color: #666;">
            &copy; {{ date('Y') }} Just Travel. All rights reserved.
        </div>
    </div>
</body>
</html>
