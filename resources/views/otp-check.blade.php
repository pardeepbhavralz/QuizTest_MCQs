<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>OTP Verification</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

  <style>
    body {
      background-color: #f1f3f5;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      margin: 0;
    }

    .main-container {
      background-color: #fff;
      padding: 40px 30px;
      border-radius: 10px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 420px;
    }

    .form-head h2 {
      margin-bottom: 25px;
      font-weight: 600;
      text-align: center;
      color: #212529;
    }

    label {
      font-weight: 500;
      margin-bottom: 6px;
      color: #495057;
    }

    input[type="text"] {
      width: 100%;
      padding: 12px 14px;
      border: 1px solid #ced4da;
      border-radius: 5px;
      font-size: 16px;
      margin-bottom: 20px;
      transition: border-color 0.2s ease-in-out;
    }

    input[type="text"]:focus {
      border-color: #007bff;
      outline: none;
    }

    button[type="submit"] {
      width: 100%;
      background-color: #007bff;
      color: #fff;
      padding: 12px;
      font-size: 16px;
      font-weight: 500;
      border: none;
      border-radius: 5px;
      transition: background-color 0.3s ease;
    }

    button[type="submit"]:hover {
      background-color: #0056b3;
    }

    .alert {
      font-size: 14px;
      margin-bottom: 20px;
    }

    .form-group {
      margin-bottom: 20px;
    }
  </style>
</head>
<body>

  <div class="main-container">
    <div class="form-head">
      <h2>Verify Your OTP</h2>
    </div>

    @if ($message = Session::get('success'))
    <div class="alert alert-success" role="alert">
      <strong>{{ $message }}</strong>
    </div>
    @elseif($message = Session::get('error'))
    <div class="alert alert-danger" role="alert">
      <strong>{{ $message }}</strong>
    </div>
    @endif

    <form action="{{ route('otp-submit') }}" method="POST">
      @csrf
      <div class="form-group">
        <label for="otp">Enter OTP</label>
        <input type="text" id="otp" name="otp" placeholder="Enter the OTP" required>
      </div>
      <button type="submit">Submit</button>
    </form>
  </div>

</body>
</html>
