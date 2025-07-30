<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
        crossorigin="anonymous"></script>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', Arial, sans-serif;
            background-color: #f4f6f9;
            min-height: 100vh;
            display: flex;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            background-color: #2c3e50;
            color: white;
            padding: 20px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            overflow-y: auto;
            transition: transform 0.3s ease;
        }

        .sidebar h2 {
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .sidebar .nav-links {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .sidebar .nav-links a {
            color: #ecf0f1;
            text-decoration: none;
            font-weight: 500;
            padding: 10px;
            border-radius: 5px;
            transition: background-color 0.2s;
        }

        .sidebar .nav-links a:hover {
            background-color: #34495e;
        }

        /* Main Content */
        .main-content {
            margin-left: 250px;
            padding: 30px;
            flex-grow: 1;
        }

        .main-header {
            background-color: #ffffff;
            padding: 15px 30px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
            border-radius: 8px;
        }

        .main-header h1 {
            font-size: 1.8rem;
            margin: 0;
        }

        .main-header h1 a {
            color: #2c3e50;
            text-decoration: none;
        }

        /* Cards */
        .category-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: none;
            border-radius: 10px;
            overflow: hidden;
            background-color: #ffffff;
        }

        .category-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }

        .category-card .card-body {
            padding: 20px;
            text-align: center;
        }

        .category-card .card-title {
            font-size: 1.25rem;
            color: #2c3e50;
            margin-bottom: 10px;
        }

        .category-card .card-text {
            color: #6c757d;
            font-size: 0.9rem;
        }

        /* Alerts */
        .alert {
            border-radius: 8px;
            margin-bottom: 20px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-250px);
                width: 200px;
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .toggle-sidebar {
                display: block;
                position: fixed;
                top: 15px;
                left: 15px;
                z-index: 1000;
                background-color: #2c3e50;
                color: white;
                border: none;
                padding: 10px;
                border-radius: 5px;
            }
        }

        @media (min-width: 769px) {
            .toggle-sidebar {
                display: none;
            }
        }
    </style>
</head>

<body>
    <button class="toggle-sidebar">☰ Menu</button>

    <aside class="sidebar">
        <h2>Quiz Dashboard</h2>
        <nav>
            <ul class="nav-links">
                <li><a href="">Home</a></li>
                <li><a href="{{ route('showAll-categories') }}">Categories</a></li>
                <li><a href="#">Quiz</a></li>
                @if(Session::get('email'))
                    <li><a href="#">Logout</a></li>
                @endif
            </ul>
        </nav>
    </aside>

    <div class="main-content">
        @if($message = Session::get('success'))
            <div class="alert alert-success" role="alert" id="success-alert">
                <strong>{{ $message }}</strong>
            </div>
        @endif

        <header class="main-header">
            <h1><a href="{{ route('admin-dashboard') }}">Quiz Questions</a></h1>
        </header>

        <div class="container">
            <div class="row">
                @foreach ($allCategories as $dataAllCategories)
                    <div class="col-md-4 col-sm-6 mb-4">
                        <a href="{{ route('mcq-paper', ['id' => $dataAllCategories->id]) }}" style="text-decoration: none;">
                            <div class="card category-card">
                                <div class="card-body" data-id="{{ $dataAllCategories->id }}">
                                    <h5 class="card-title">{{ $dataAllCategories->name }}</h5>
                                    <p class="card-text">{{ $dataAllCategories->description ?? 'Explore this category' }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
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

            // Toggle sidebar on mobile
            $('.toggle-sidebar').click(function () {
                $('.sidebar').toggleClass('active');
            });

            // Category click handler
            $('.category-card .card-body').click(function () {
                var divId = $(this).data('id');
                // Add your click handling logic here
            });
        });
    </script>
</body>

</html>