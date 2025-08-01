<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background-color: #f4f6f9;
            color: #333;
            min-height: 100vh;
            display: flex;
        }

        .sidebar {
            width: 250px;
            background-color: #1a2639;
            color: white;
            height: 100vh;
            position: fixed;
            padding: 20px;
            overflow-y: auto;
        }

        .sidebar-header {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 20px;
            text-align: center;
        }

        .sidebar-nav {
            list-style: none;
        }

        .sidebar-nav li {
            margin-bottom: 10px;
        }

        .sidebar-nav a {
            color: #d1d5db;
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 10px;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
        }

        .sidebar-nav a:hover, .sidebar-nav a.active {
            background-color: #3b82f6;
            color: white;
        }

        .sidebar-nav i {
            margin-right: 10px;
        }

        .main-content {
            margin-left: 250px;
            padding: 30px;
            flex-grow: 1;
        }

        .header {
            background-color: white;
            padding: 15px 30px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 1.8rem;
            color: #1a2639;
        }

        .header nav ul {
            list-style: none;
            display: flex;
            gap: 20px;
        }

        .header nav a {
            color: #1a2639;
            text-decoration: none;
            font-weight: 500;
        }

        .header nav a:hover {
            color: #3b82f6;
        }

        .categories-container {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 15px;
            max-height: 500px;
            overflow-y: auto;
            margin-bottom: 30px;
        }

        .category-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            border-bottom: 1px solid #eee;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .category-item:hover {
            background-color: #f1f5f9;
        }

        .category-item:last-child {
            border-bottom: none;
        }

        .delete-button {
            background: none;
            border: none;
            color: #ef4444;
            cursor: pointer;
            transition: color 0.3s;
        }

        .delete-button:hover {
            color: #b91c1c;
        }

        .mcq-form-container {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 700px;
            margin: 0 auto;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: 600;
            margin-bottom: 5px;
            display: block;
        }

        .form-group input, .form-group textarea, .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #d1d5db;
            border-radius: 5px;
            font-size: 1rem;
            transition: border-color 0.3s;
        }

        .form-group input:focus, .form-group textarea:focus, .form-group select:focus {
            border-color: #3b82f6;
            outline: none;
        }

        .form-group textarea {
            resize: vertical;
            min-height: 100px;
        }

        .submit-btn {
            background-color: #3b82f6;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .submit-btn:hover {
            background-color: #2563eb;
        }

        .alert {
            max-width: 700px;
            margin: 20px auto;
            padding: 15px;
            border-radius: 5px;
            font-weight: 600;
            text-align: center;
        }

        @media (max-width: 992px) {
            .sidebar {
                width: 200px;
            }
            .main-content {
                margin-left: 200px;
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }
            .main-content {
                margin-left: 0;
                padding: 20px;
            }
        }
    </style>
</head>
<body>
   

    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-header">Admin Dashboard</div>
        <ul class="sidebar-nav">
            <li><a href="{{ route('admin-dashboard') }}" class="active"><i class="fas fa-home"></i> Home</a></li>
            <li><a href="{{ route('categories') }}"><i class="fas fa-list"></i> Categories</a></li>
            <li><a href="{{ route('listOfAllUser') }}"><i class="fas fa-users"></i> Top Candidates</a></li>
            <!-- @if(Session::get('email')) -->
            <li><a href="{{ route('logout') }}"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            <!-- @endif -->
        </ul>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
         <!-- Success Alert -->
    @if($message = Session::get('success'))
    <div class="alert alert-success" role="alert" id="success-alert">
        <strong>{{ $message }}</strong>
    </div>
    @endif
        <!-- Categories Section -->
        <section class="categories-container">
            <h2>Add Categories</h2>
            <form action="{{ route('categories-add') }}" method="post" class="form-group">
                @csrf
                <span class="error" id="categoriesError"></span>
                <label for="nameCategories">Category Name</label>
                <input type="text" name="name" id="nameCategories" class="form-control" required>
                <button type="submit" id="btnCayegoryAdded" class="submit-btn mt-3">Add Category</button>
            </form>

            <!-- Category List -->
            <!-- <h3 class="mt-4">Existing Categories</h3>
            <div id="category-list"> -->
                <!-- Categories will be populated dynamically -->
                <!-- <div class="category-item">
                    <span>Sample Category</span>
                    <button class="delete-button"><i class="fas fa-trash"></i></button>
                </div>
            </div> -->
        </section>

        <!-- MCQ Form Section -->
        <section class="mcq-form-container" style="display: none;">
            <h2>Add MCQ Question</h2>
            <form action="{{ route('add-mcq') }}" method="post" class="form-group">
                <!-- @csrf -->
                <div class="form-group">
                    <label for="category">Category</label>
                    <select name="category" id="category" required>
                        <option value="">Select Category</option>
                        <!-- Categories populated dynamically -->
                    </select>
                </div>
                <div class="form-group">
                    <label for="question">Question</label>
                    <textarea name="question" id="question" required></textarea>
                </div>
                <div class="form-group">
                    <label for="option1">Option 1</label>
                    <input type="text" name="option1" id="option1" required>
                </div>
                <div class="form-group">
                    <label for="option2">Option 2</label>
                    <input type="text" name="option2" id="option2" required>
                </div>
                <div class="form-group">
                    <label for="option3">Option 3</label>
                    <input type="text" name="option3" id="option3" required>
                </div>
                <div class="form-group">
                    <label for="option4">Option 4</label>
                    <input type="text" name="option4" id="option4" required>
                </div>
                <div class="form-group">
                    <label for="correct_option">Correct Option</label>
                    <select name="correct_option" id="correct_option" required>
                        <option value="1">Option 1</option>
                        <option value="2">Option 2</option>
                        <option value="3">Option 3</option>
                        <option value="4">Option 4</option>
                    </select>
                </div>
                <button type="submit" class="submit-btn">Add Question</button>
            </form>
        </section>
    </main>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            // Fade out success alert
            setTimeout(function () {
                $('#success-alert').fadeOut('slow');
            }, 2000);

            // Check if category exists
            $('#nameCategories').keyup(function () {
                var searchValue = $('#nameCategories').val();

                $.ajax({
                    url: "{{ route('search-categories') }}",
                    method: "POST",
                    data: {
                        searchValue: searchValue,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function (response) {
                        if (response.status === 1) {
                            $('#btnCayegoryAdded').hide();
                            $('#categoriesError').text('This Category is already stored or added');
                        } else {
                            $('#btnCayegoryAdded').show();
                            $('#categoriesError').text('');
                        }
                    },
                    error: function (error) {
                        console.error('Error:', error);
                    }
                });
            });
        });
    </script>
</body>
</html>