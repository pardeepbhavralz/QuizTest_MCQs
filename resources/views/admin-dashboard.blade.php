<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            padding-bottom: 50px;
            color: #333;
        }

        .main-header {
            background-color: #333;
            color: white;
            padding: 20px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .nav-links {
            list-style: none;
            display: flex;
            gap: 25px;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            font-weight: 600;
            font-size: 1rem;
            transition: color 0.3s, text-decoration 0.3s;
        }

        .nav-links a:hover {
            color: #ffd700;
            text-decoration: underline;
        }

        .mainDiv {
            display: flex;
            width: 100%;
            flex-wrap: wrap; 
        }

        .left {
            width: 20%;
            padding: 10px;
            min-width: 200px; 
        }

        .right {
            width: 80%;
            padding: 20px;
            display: none;
        }

        .categoriesContainer {
            max-height: 400px;
            overflow-y: auto;
            border: 1px solid #ddd;
            padding: 10px;
            background: white;
            border-radius: 6px;
        }

        .categoryItem {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px;
            border-bottom: 1px solid #eee;
            position: relative;
            cursor: pointer;
        }

        .categoryItem:hover {
            background-color: #f4f4f4;
        }

        .categoryNumber,
        .categoryName {
            font-size: 16px;
        }

        .deleteButton {
            background: none;
            border: none;
            color: red;
            font-size: 18px;
            cursor: pointer;
            position: absolute;
            top: 5px;
            right: 5px;
        }

        .deleteButton:hover {
            color: darkred;
        }

        .alert {
            max-width: 600px;
            margin: 30px auto;
            padding: 15px 20px;
            border-radius: 8px;
            font-weight: 600;
            text-align: center;
        }

        textarea {
            padding: 12px 15px;
            font-size: 1rem;
            border: 2px solid #ddd;
            border-radius: 6px;
            width: 100%;
            transition: border-color 0.3s;
        }

        textarea:focus {
            border-color: #333;
            outline: none;
        }

        button {
            padding: 12px 20px;
            font-size: 1rem;
            background-color: #333;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #555;
        }

        @media (max-width: 768px) {
            .left, .right {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <header class="main-header">
        <h1><a href="{{ route('admin-dashboard') }}" style="color: white; text-decoration: none;">Quiz Questions</a></h1>
        <nav>
            <ul class="nav-links">
                <li><a href="{{ route('categories') }}">Add Categories</a></li>
                
                @if(Session::get('email'))
                    <li><a href="">Logout</a></li>
                @endif
            </ul>
        </nav>
    </header>

    @if($message = Session::get('success'))
        <div class="alert alert-success" role="alert" id="success-alert">
            <strong>{{ $message }}</strong>
        </div>
    @endif

    <div class="mainDiv">
        <div class="left">
            <div class="categoriesContainer">
                @foreach ($allCategoriesFetch as $index => $data)
                    <div class="categoryItem" data-id="{{ $data->id }}">
                        <span class="categoryNumber">{{ $index + 1 }}</span>
                        <span class="categoryName">{{ $data->name }}</span>
                        <form action="{{ route('delete-categories') }}" method="post" class="deleteForm">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="id" value="{{ $data->id }}">
                            <button type="button" class="deleteButton" data-id="{{ $data->id }}">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="right" id="rightDiv">
            <h2>Add MCQ Question</h2>
            <form id="mcqForm" method="POST" action="{{ route('add-mcq') }} " >
                @csrf
                <input type="hidden" name="category_id" id="categoryId">
                <label for="question">Question:</label><br>
                <textarea id="question" name="question" rows="3" required></textarea><br><br>

                <label for="optionA">Option A:</label><br>
                <input type="text" id="optionA" name="optionA" required><br><br>

                <label for="optionB">Option B:</label><br>
                <input type="text" id="optionB" name="optionB" required><br><br>

                <label for="optionC">Option C:</label><br>
                <input type="text" id="optionC" name="optionC" required><br><br>

                <label for="optionD">Option D:</label><br>
                <input type="text" id="optionD" name="optionD" required><br><br>

                <label for="correctAnswer">Correct Answer:</label><br>
                <select id="correctAnswer" name="correctAnswer" required>
                    <option value="">--Select--</option>
                    <option value="optionA" id="optA">Option A</option>
                    <option value="optionB">Option B</option>
                    <option value="optionC">Option C</option>
                    <option value="optionD">Option D</option>
                </select><br><br>

                <button type="submit">Add Question</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            // Auto-hide success alert after 2 seconds
            setTimeout(function () {
                $('#success-alert').fadeOut('slow');
            }, 2000);

            $(document).on('click', '.categoryItem', function (e) {
                if ($(e.target).closest('.deleteButton').length) {
                    return; 
                }
                var categoryId = $(this).data('id');
                $('#categoryId').val(categoryId); 
                $('#rightDiv').show();
            });

            // Delete category action
            $(document).on('click', '.deleteButton', function (e) {
                e.stopPropagation(); 
                var categoryId = $(this).data('id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
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
                                if (response.message = "Category_deleted_successfully") {
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
                            error: function (error) {
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
                    data:{
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
                            });
                        } else {
                            Swal.fire({
                                icon: "error",
                                title: "Oops...",
                                text: response.message || "Failed to add question."
                            });
                        }
                    },
                    error: function (error) {
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