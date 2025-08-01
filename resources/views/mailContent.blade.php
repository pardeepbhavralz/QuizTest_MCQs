<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your OTP Code</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
        }
        .otp-code {
            font-size: 24px;
            font-weight: bold;
            background: #f0f0f0;
            padding: 10px 20px;
            display: inline-block;
            border-radius: 5px;
            margin-top: 10px;
        }
        .footer {
            font-size: 12px;
            color: #888;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Your One-Time Password (OTP)</h2>
        <p>Use the following OTP to complete your action:</p>
        <div class="otp-code">{{ $msg }}</div>
        <p>This OTP is valid for the next 10 minutes.</p>
        <p>If you did not request this code, please ignore this email.</p>
        <div class="footer">
            &copy; {{ date('Y') }} Your Company. All rights reserved.
        </div>
    </div>
</body>
</html>

