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

        .categories-container {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 15px;
            max-height: 500px;
            overflow-y: auto;
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
    @if (Session::get('email'))
     <aside class="sidebar">
        <div class="sidebar-header">Admin Dashboard</div>
        <ul class="sidebar-nav">
            <li><a href="{{ route('admin-dashboard') }}" class="active"><i class="fas fa-home"></i> Home</a></li>
             <li><a href="{{ route('categories') }}"><i class="fas fa-folder-plus"></i> Add Categories</a></li>
            <li><a href="{{ route('listOfAllUser') }}"><i class="fas fa-users"></i> Top Candidates</a></li>
            <!-- @if(Session::get('email')) -->
            <li><a href="{{ route('logout') }}"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            <!-- @endif -->
        </ul>
    </aside>

    <div class="main-content">
        <div class="header">
            <h1>Quiz Management</h1>
        </div>

        @if($message = Session::get('success'))
            <div class="alert alert-success" role="alert" id="success-alert">
                <strong>{{ $message }}</strong>
            </div>
        @endif

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <h3>Categories</h3>
                    <div class="categories-container">
                        @foreach ($allCategoriesFetch as $index => $data)
                            <div class="category-item" data-id="{{ $data->id }}">
                                <span>{{ $index + 1 }}. {{ $data->name }}</span>
                                <form action="{{ route('delete-categories') }}" method="post" class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="id" value="{{ $data->id }}">
                                    <button type="button" class="delete-button" data-id="{{ $data->id }}">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="mcq-form-container" id="mcqFormContainer" style="display: none;">
                        <h2>Add MCQ Question</h2>
                        <form id="mcqForm" method="POST" action="{{ route('add-mcq') }}">
                            @csrf
                            <input type="hidden" name="category_id" id="categoryId">
                            <div class="form-group">
                                <label for="question">Question</label>
                                <textarea id="question" name="question" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="optionA">Option A</label>
                                <input type="text" id="optionA" name="optionA" required>
                            </div>
                            <div class="form-group">
                                <label for="optionB">Option B</label>
                                <input type="text" id="optionB" name="optionB" required>
                            </div>
                            <div class="form-group">
                                <label for="optionC">Option C</label>
                                <input type="text" id="optionC" name="optionC" required>
                            </div>
                            <div class="form-group">
                                <label for="optionD">Option D</label>
                                <input type="text" id="optionD" name="optionD" required>
                            </div>
                            <div class="form-group">
                                <label for="correctAnswer">Correct Answer</label>
                                <select id="correctAnswer" name="correctAnswer" required>
                                    <option value="">--Select--</option>
                                    <option value="optionA">Option A</option>
                                    <option value="optionB">Option B</option>
                                    <option value="optionC">Option C</option>
                                    <option value="optionD">Option D</option>
                                </select>
                            </div>
                            <button type="submit" class="submit-btn">Add Question</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            // Auto-hide success alert
            setTimeout(function () {
                $('#success-alert').fadeOut('slow');
            }, 2000);

            // Category selection
            $(document).on('click', '.category-item', function (e) {
                if ($(e.target).closest('.delete-button').length) return;
                var categoryId = $(this).data('id');
                $('#categoryId').val(categoryId);
                $('#mcqFormContainer').show();
                $('.category-item').removeClass('active');
                $(this).addClass('active');
            });

            // Delete category
            $(document).on('click', '.delete-button', function (e) {
                e.stopPropagation();
                var categoryId = $(this).data('id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3b82f6',
                    cancelButtonColor: '#ef4444',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('delete-categories') }}",
                            method: "POST",
                            data: {
                                id: categoryId,
                                _token: "{{ csrf_token() }}"
                            },
                            success: function (response) {
                                if (response.message === "Category_deleted_successfully") {
                                    Swal.fire({
                                        title: "Deleted!",
                                        text: "Category has been deleted.",
                                        icon: "success"
                                    }).then(() => {
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire({
                                        icon: "error",
                                        title: "Oops...",
                                        text: "Something went wrong!"
                                    });
                                }
                            },
                            error: function () {
                                Swal.fire({
                                    icon: "error",
                                    title: "Error",
                                    text: "Failed to delete category."
                                });
                            }
                        });
                    }
                });
            });

            // MCQ form submission
            $('#mcqForm').on('submit', function (e) {
                e.preventDefault();
                var formData = $(this).serialize();
                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: {
                        formData: formData,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function (response) {
                        if (response.success) {
                            Swal.fire({
                                title: "Success!",
                                text: "Question added successfully.",
                                icon: "success"
                            }).then(() => {
                                $('#mcqForm')[0].reset();
                                $('#mcqFormContainer').hide();
                            });
                        } else {
                            Swal.fire({
                                icon: "error",
                                title: "Oops...",
                                text: response.message || "Failed to add question."
                            });
                        }
                    },
                    error: function () {
                        Swal.fire({
                            icon: "error",
                            title: "Error",
                            text: "Failed to add question."
                        });
                    }
                });
            });
        });
    </script>
</body>
</html>