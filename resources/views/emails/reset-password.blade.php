<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <style>
        /* Base styles */
        body {
            background-color: #f3f4f6;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            -webkit-text-size-adjust: none;
            width: 100% !important;
        }
        
        /* Container */
        .email-wrapper {
            background-color: #f3f4f6;
            padding: 24px;
            width: 100%;
        }
        
        .email-content {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            margin: 0 auto;
            max-width: 500px;
            padding: 32px;
        }

        /* Typography */
        h1 {
            color: #1f2937;
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 24px;
            margin-top: 0;
            text-align: center;
        }
        
        p {
            color: #4b5563;
            font-size: 16px;
            margin-bottom: 24px;
        }

        /* Button */
        .action-button {
            background-color: #2563eb;
            border-radius: 6px;
            color: #ffffff;
            display: inline-block;
            font-weight: 600;
            padding: 12px 24px;
            text-decoration: none;
            text-align: center;
        }
        
        .button-container {
            text-align: center;
            margin: 32px 0;
        }

        /* Footer */
        .footer {
            color: #9ca3af;
            font-size: 12px;
            margin-top: 32px;
            text-align: center;
        }
        
        .footer a {
            color: #6b7280;
            text-decoration: underline;
        }
        
        .break-all {
            word-break: break-all;
        }
    </style>
</head>
<body>
    <div class="email-wrapper">
        <div class="email-content">
            <!-- Header/Logo Area -->
            <div style="text-align: center; margin-bottom: 24px;">
                <span style="font-size: 20px; font-weight: bold; color: #2563eb;">Gelo Starter</span>
            </div>

            <h1>Reset Your Password</h1>
            
            <p>Hello!</p>
            
            <p>You are receiving this email because we received a password reset request for your account.</p>
            
            <div class="button-container">
                <a href="{{ $url }}" class="action-button">Reset Password</a>
            </div>

            <p>This password reset link will expire in 60 minutes.</p>

            <p>If you did not request a password reset, no further action is required.</p>
            
            <div class="footer">
                <p>If you're having trouble clicking the "Reset Password" button, copy and paste the URL below into your web browser:</p>
                <p class="break-all"><a href="{{ $url }}">{{ $url }}</a></p>
                <p>&copy; {{ date('Y') }} Gelo Starter. All rights reserved.</p>
            </div>
        </div>
    </div>
</body>
</html>
