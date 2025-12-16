<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Your Email Address</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #3b82f6;
        }
        .header h1 {
            color: #3b82f6;
            margin: 0;
            font-size: 24px;
        }
        .icon {
            font-size: 48px;
            color: #3b82f6;
            margin-bottom: 10px;
        }
        .button {
            display: inline-block;
            padding: 14px 28px;
            background-color: #3b82f6;
            color: #ffffff !important;
            text-decoration: none;
            border-radius: 6px;
            margin: 20px 0;
            font-weight: bold;
        }
        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
            text-align: center;
            color: #6b7280;
            font-size: 12px;
        }
        .info-box {
            background-color: #eff6ff;
            border-left: 4px solid #3b82f6;
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="icon">✉️</div>
            <h1>Verify Your Email Address</h1>
        </div>

        <p>Hello!</p>

        <p>Thank you for registering with <strong>Car Maintenance</strong>. Please click the button below to verify your email address:</p>

        <div style="text-align: center; margin: 30px 0;">
            <a href="{{ $verificationUrl }}" class="button">Verify Email Address</a>
        </div>

        <div class="info-box">
            <p style="margin: 0;"><strong>Having trouble?</strong> If the button doesn't work, copy and paste this link into your browser:</p>
            <p style="margin: 10px 0 0 0; word-break: break-all; color: #3b82f6;">{{ $verificationUrl }}</p>
        </div>

        <p>This verification link will expire in {{ config('auth.verification.expire', 60) }} minutes.</p>

        <p>If you did not create an account, no further action is required.</p>

        <div class="footer">
            <p>Thank you for choosing Car Maintenance!</p>
            <p style="margin-top: 15px; font-size: 11px;">
                This is an automated email. Please do not reply directly to this message.
            </p>
        </div>
    </div>
</body>
</html>
