<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(135deg, #6e8efb, #a777e3);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .wrapper {
            display: flex;
            max-width: 900px;
            width: 100%;
            background: white;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
            overflow: hidden;
        }

        .form-container {
            width: 55%;
            padding: 40px;
        }

        .image-container {
            width: 45%;
            background: url('https://images.unsplash.com/photo-1600585154340-be6161a56a0c') no-repeat center/cover;
            border-radius: 0 12px 12px 0;
        }

        h2 {
            text-align: center;
            font-size: 28px;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 30px;
        }

        label {
            font-size: 14px;
            font-weight: 500;
            color: #333;
            margin-bottom: 8px;
            display: block;
        }

        .form-row {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }

        .form-group {
            width: 100%;
        }

        .form-group.half-width {
            width: 50%;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        select,
        input[type="file"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        input:focus,
        select:focus {
            outline: none;
            border-color: #6e8efb;
            box-shadow: 0 0 5px rgba(110, 142, 251, 0.3);
        }

        .password-wrapper {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            font-size: 14px;
            color: #666;
        }

        button {
            width: 100%;
            padding: 14px;
            background: linear-gradient(90deg, #6e8efb, #a777e3);
            border: none;
            border-radius: 6px;
            color: white;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.3s;
        }

        button:hover {
            background: linear-gradient(90deg, #5a75e6, #8f5ed0);
        }

        .login-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #6e8efb;
            text-decoration: none;
            font-size: 14px;
        }

        .login-link:hover {
            text-decoration: underline;
        }

        .error {
            color: #e63946;
            font-size: 12px;
            margin-top: 5px;
            display: block;
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

            .image-container {
                height: 200px;
                border-radius: 12px 12px 0 0;
            }

            .form-row {
                flex-direction: column;
                gap: 15px;
            }

            .form-group.half-width {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="image-container"></div>
        <div class="form-container">
            <h2>Create Your Account</h2>
            <form action="{{ route('register-submit') }}" method="POST" id="registerForm" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" id="name" name="name" required aria-describedby="nameError">
                    <span class="error" id="nameError"></span>
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" required aria-describedby="emailError">
                    <span class="error" id="emailError"></span>
                </div>

                <div class="form-row">
                    <div class="form-group half-width">
                        <label for="password">Password</label>
                        <div class="password-wrapper">
                            <input type="password" id="password" name="password" required aria-describedby="passwordError">
                            <span class="toggle-password" onclick="togglePassword('password')">👁️</span>
                        </div>
                        <span class="error" id="passwordError"></span>
                    </div>
                    <div class="form-group half-width">
                        <label for="confirmPassword">Confirm Password</label>
                        <div class="password-wrapper">
                            <input type="password" id="confirmPassword" name="confirmPassword" required aria-describedby="confirmPasswordError">
                            <span class="toggle-password" onclick="togglePassword('confirmPassword')">👁️</span>
                        </div>
                        <span class="error" id="confirmPasswordError"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="text" id="phone" name="phone" required aria-describedby="phoneError">
                    <span class="error" id="phoneError"></span>
                </div>

                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" id="address" name="address" required aria-describedby="addressError">
                    <span class="error" id="addressError"></span>
                </div>

                <div class="form-group">
                    <label for="image">Profile Image</label>
                    <input type="file" id="image" name="image" accept="image/*" aria-describedby="imageError">
                    <span class="error" id="imageError"></span>
                </div>

                <div class="form-row">
                    <div class="form-group half-width">
                        <label for="country">Country</label>
                        <select name="country" id="country" required aria-describedby="countryError">
                            <option value="">Select Country</option>
                            <option value="USA">USA</option>
                            <option value="Canada">Canada</option>
                            <option value="India">India</option>
                        </select>
                        <span class="error" id="countryError"></span>
                    </div>
                    <div class="form-group half-width">
                        <label for="city">City</label>
                        <select name="city" id="city" required aria-describedby="cityError">
                            <option value="">Select City</option>
                            <option value="New York">New York</option>
                            <option value="Toronto">Toronto</option>
                            <option value="Delhi">Delhi</option>
                        </select>
                        <span class="error" id="cityError"></span>
                    </div>
                </div>

                <button type="submit">Register Now</button>
            </form>
            <a href="{{ route('admin-login') }}" class="login-link">Already have an account? Log in</a>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
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

            // Toggle password visibility
            window.togglePassword = function (id) {
                const input = document.getElementById(id);
                const icon = input.nextElementSibling;
                if (input.type === 'password') {
                    input.type = 'text';
                    icon.textContent = '🙈';
                } else {
                    input.type = 'password';
                    icon.textContent = '👁️';
                }
            };

            // Attach validation to events
            $('#name').on('input', validateName);
            $('#email').on('input', validateEmail);
            $('#password').on('input', validatePassword);
            $('#confirmPassword').on('input', validateConfirmPassword);
            $('#phone').on('input', validatePhone);
            $('#address').on('input', validateAddress);
            $('#country').on('change', validateCountry);
            $('#city').on('change', validateCity);

            // Form submission
            $('#registerForm').on('submit', function (e) {
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
                    this.submit();
                }
            });
        });
    </script>
</body>
</html>