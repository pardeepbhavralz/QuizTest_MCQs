<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
        /* Reset some default browser styling */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Body styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Form container */
        .login-container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        /* Heading style */
        h2 {
            margin-bottom: 20px;
            color: #333;
            font-size: 24px;
        }

        /* Label styles */
        label {
            font-size: 14px;
            color: #555;
            text-align: left;
            display: block;
            margin-bottom: 6px;
        }

        /* Input styles */
        input[type="email"], input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        /* Input focus styles */
        input[type="email"]:focus, input[type="password"]:focus {
            border-color: #4CAF50;
            outline: none;
        }

        /* Button styles */
        button {
            width: 100%;
            padding: 12px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        button:hover {
            background-color: #45a049;
        }

        /* Responsive styles */
        @media (max-width: 480px) {
            .login-container {
                padding: 15px;
            }
        }
    </style>
</head>
<body>




    <div class="login-container">
        <h2>Admin Login</h2>
        <form action="{{ route('admin-submit') }}" method="post">
            @csrf
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Login</button>
        </form>
        <a href="{{ route('register') }}">Register Here</a>
    </div>
</body>
</html>
