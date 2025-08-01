<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
        /* Reset default browser styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Body styles with gradient background */
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #6e8efb, #a777e3);
            min-height: 100vh;
            display: grid;
            place-items: center;
            padding: 20px;
        }

        /* Login container with glassmorphism effect */
        .login-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 2.5rem;
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 420px;
            animation: fadeIn 0.5s ease-out;
        }

        /* Animation keyframes */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Heading styles */
        h2 {
            font-size: 1.8rem;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        /* Form group styles */
        .form-group {
            margin-bottom: 1.5rem;
            text-align: left;
        }

        /* Label styles */
        label {
            display: block;
            font-size: 0.875rem;
            font-weight: 500;
            color: #4a5568;
            margin-bottom: 0.5rem;
        }

        /* Input styles */
        input[type="email"], input[type="password"] {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            font-size: 0.875rem;
            background: #f7fafc;
            transition: all 0.2s ease;
        }

        /* Input focus and hover states */
        input[type="email"]:focus, input[type="password"]:focus {
            outline: none;
            border-color: #6e8efb;
            box-shadow: 0 0 0 3px rgba(110, 142, 251, 0.1);
            background: white;
        }

        /* Button styles */
        button {
            width: 100%;
            padding: 0.875rem;
            background: linear-gradient(to right, #6e8efb, #a777e3);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 0.5rem;
        }

        button:hover {
            background: linear-gradient(to right, #5a7af7, #9365d8);
            transform: translateY(-2px);
        }

        button:active {
            transform: translateY(0);
        }

        /* Register link styles */
        .register-link {
            display: block;
            text-align: center;
            margin-top: 1.5rem;
            color: #6e8efb;
            font-size: 0.875rem;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s ease;
        }

        .register-link:hover {
            color: #5a7af7;
            text-decoration: underline;
        }

        /* Responsive styles */
        @media (max-width: 480px) {
            .login-container {
                padding: 1.5rem;
                margin: 1rem;
            }

            h2 {
                font-size: 1.5rem;
            }

            button {
                padding: 0.75rem;
            }
        }

        /* Accessibility improvements */
        @media (prefers-reduced-motion: reduce) {
            * {
                animation: none !important;
                transition: none !important;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Admin Login</h2>
        <form action="{{ route('admin-submit') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required aria-describedby="emailHelp">
                <small id="emailHelp" class="sr-only">Enter your admin email address</small>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required aria-describedby="passwordHelp">
                <small id="passwordHelp" class="sr-only">Enter your password</small>
            </div>
            <button type="submit">Login</button>
        </form>
        <a href="{{ route('register') }}" class="register-link">Register Here</a>
    </div>
</body>
</html>