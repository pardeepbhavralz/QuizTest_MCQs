<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .wrapper {
            display: flex;
            max-width: 1200px;
            width: 100%;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        .form-container {
            width: 50%;
            padding: 40px;
        }

        .image-container {
            width: 50%;
            background-image: url('https://via.placeholder.com/600x500');
            /* Replace with your image URL */
            background-size: cover;
            background-position: center;
            border-radius: 8px 0 0 8px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        label {
            font-size: 14px;
            color: #333;
            margin-bottom: 6px;
            display: block;
        }

        .form-row {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }

        .form-row .half-width {
            width: 48%;
        }

        .form-row .half-widthh {
            width: 100%;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        select {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .radio-group {
            display: flex;
            gap: 15px;
            margin: 8px 0;
        }

        .radio-group input {
            margin-right: 5px;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #007BFF;
            border: none;
            color: white;
            font-size: 16px;
            cursor: pointer;
            border-radius: 4px;
        }

        button:hover {
            background-color: #0056b3;
        }

        .error {
            color: red;
            margin-left: 10px;
            font-size: 0.9em;
        }

        @media (max-width: 768px) {
            .wrapper {
                flex-direction: column;
                max-width: 100%;
            }

            .form-container,
            .image-container {
                width: 100%;
            }

            .form-row {
                flex-direction: column;
                align-items: flex-start;
            }

            .form-row .half-width {
                width: 100%;
            }


        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="image-container"></div>
        <div class="form-container">
            <h2>User Registration</h2>
            <form action="{{ route('register-submit') }}" method="POST" id="registerForm">
                @csrf
                <label for="name">Name</label>
                <input type="text" id="name" name="name">
                <span class="error" id="nameError"></span>

                <label for="email">Email</label>
                <input type="email" id="email" name="email">
                <span class="error" id="emailError"></span>

                <div class="form-row">
                    <div class="half-width">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password">
                        <span class="error" id="passwordError"></span>
                    </div>
                    <div class="half-width">
                        <label for="confirmPassword">Confirm Password</label>
                        <input type="password" id="confirmPassword" name="confirmPassword">
                        <span class="error" id="confirmPasswordError"></span>
                    </div>
                </div>

                <div class="form-row">
                    <div class="half-widthh">
                        <label for="phone">Phone</label>
                        <input type="text" id="phone" name="phone">
                        <span class="error" id="phoneError"></span>
                    </div>
                </div>

                <label for="address">Address</label>
                <input type="text" id="address" name="address">
                <span class="error" id="addressError"></span>

                <div class="form-row">
                    <div class="half-width">
                        <label for="country">Country</label>
                        <select name="country" id="country">
                            <option value="">Select Country</option>
                            <option value="USA">USA</option>
                            <option value="Canada">Canada</option>
                            <option value="India">India</option>
                        </select>
                        <span class="error" id="countryError"></span>
                    </div>
                    <div class="half-width">
                        <label for="city">City</label>
                        <select name="city" id="city">
                            <option value="">Select City</option>
                            <option value="New York">New York</option>
                            <option value="Toronto">Toronto</option>
                            <option value="Delhi">Delhi</option>
                        </select>
                        <span class="error" id="cityError"></span>
                    </div>
                </div>

                <button type="submit">Register</button>
                               
            </form>
        </div>
         <a href="{{ route('admin-login') }}"><button>LOGIN</button></a>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.19.5/jquery.validate.min.js"></script>


    <script>
        $(document).ready(function () {

            function validateName() {
                const name = $('#name').val().trim();
                if (name === '') {
                    $('#nameError').text('Name is required');
                    return false;
                } else {
                    $('#nameError').text('');
                    return true;
                }
            }

            function validateEmail() {
                const email = $('#email').val().trim();
                const emailPattern = /^\S+@\S+\.\S+$/;
                if (email === '' || !emailPattern.test(email)) {
                    $('#emailError').text('Valid email is required');
                    return false;
                } else {
                    $('#emailError').text('');
                    return true;
                }
            }

            function validatePassword() {
                const password = $('#password').val();
                if (password.length < 6) {
                    $('#passwordError').text('Password must be at least 6 characters');
                    return false;
                } else {
                    $('#passwordError').text('');
                    return true;
                }
            }

            function validateConfirmPassword() {
                const password = $('#password').val();
                const confirmPassword = $('#confirmPassword').val();
                if (confirmPassword !== password) {
                    $('#confirmPasswordError').text('Passwords do not match');
                    return false;
                } else {
                    $('#confirmPasswordError').text('');
                    return true;
                }
            }

            function validatePhone() {
                const phone = $('#phone').val().trim();
                const phonePattern = /^\d{10,15}$/;
                if (!phonePattern.test(phone)) {
                    $('#phoneError').text('Enter valid phone number (10–15 digits)');
                    return false;
                } else {
                    $('#phoneError').text('');
                    return true;
                }
            }

            function validateAddress() {
                const address = $('#address').val().trim();
                if (address === '') {
                    $('#addressError').text('Address is required');
                    return false;
                } else {
                    $('#addressError').text('');
                    return true;
                }
            }

            function validateCountry() {
                if ($('#country').val() === '') {
                    $('#countryError').text('Select a country');
                    return false;
                } else {
                    $('#countryError').text('');
                    return true;
                }
            }

            function validateCity() {
                if ($('#city').val() === '') {
                    $('#cityError').text('Select a city');
                    return false;
                } else {
                    $('#cityError').text('');
                    return true;
                }
            }

            // Attach validation to events
            $('#name').keyup(validateName);
            $('#email').keyup(validateEmail);
            $('#password').keyup(validatePassword);
            $('#confirmPassword').keyup(validateConfirmPassword);
            $('#phone').keyup(validatePhone);
            $('#address').keyup(validateAddress);
            $('#country').change(validateCountry);
            $('#city').change(validateCity);

            // Final form submission
            $('#registerForm').submit(function (e) {
                e.preventDefault();

                let isValid = true;

                if (!validateName()) isValid = false;
                if (!validateEmail()) isValid = false;
                if (!validatePassword()) isValid = false;
                if (!validateConfirmPassword()) isValid = false;
                if (!validatePhone()) isValid = false;
                if (!validateAddress()) isValid = false;
                if (!validateCountry()) isValid = false;
                if (!validateCity()) isValid = false;

                if (isValid) {
                    alert("Form submitted successfully!");
                    this.submit();
                }
            });
        });

    </script>
</body>

</html>