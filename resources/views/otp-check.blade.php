<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP - Check</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
    
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .main-container {
            background-color: #ffffff;
            padding: 30px 40px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
        }

        .form-head h2 {
            margin-bottom: 20px;
            text-align: center;
            color: #343a40;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            margin-bottom: 20px;
            font-size: 16px;
        }

        button[type="submit"] {
            width: 100%;
            background-color: #007bff;
            color: #ffffff;
            padding: 10px;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }

        .alert {
            max-width: 400px;
            margin: 20px auto;
        }
    </style>
</head>
<body>

   @if ($message = Session::get('success'))
    <div class="alert alert-success" role="alert">
        <strong>{{ $message }}</strong>
    </div>
    @elseif($message = Session::get('error'))
    <div class="alert alert-danger" role="alert">
        <strong>{{ $message }}</strong>
    </div>
   @endif

    <div class="main-container">
        <div class="form-head">
            <h2>Enter OTP</h2>
        </div>
        <form action="{{ route('otp-submit') }}" method="post">
            @csrf
            <label for="otp">OTP Number</label>
            <input type="text" name="otp" id="otp" required>
            <button type="submit">SUBMIT</button>
        </form>
    </div>

</body>
</html>
