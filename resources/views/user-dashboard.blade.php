<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Reset and Base Styles */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: #f8fafc;
            min-height: 100vh;
            display: flex;
            line-height: 1.6;
            color: #1f2937;
        }

        /* Sidebar Styles */
        .sidebar {
            width: 260px;
            background-color: #1e293b;
            color: #ffffff;
            padding: 24px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            overflow-y: auto;
            transition: transform 0.3s ease-in-out;
            box-shadow: 2px 0 8px rgba(0, 0, 0, 0.1);
        }

        .sidebar h2 {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 2rem;
            letter-spacing: 0.5px;
        }

        .sidebar .nav-links {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .sidebar .nav-links a {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #e2e8f0;
            text-decoration: none;
            font-weight: 500;
            padding: 12px 16px;
            border-radius: 8px;
            transition: background-color 0.2s, color 0.2s;
        }

        .sidebar .nav-links a:hover {
            background-color: #334155;
            color: #ffffff;
        }

        .sidebar .nav-links a i {
            font-size: 1.1rem;
        }

        /* Main Content */
        .main-content {
            margin-left: 260px;
            padding: 32px;
            flex-grow: 1;
            background-color: #f8fafc;
            min-height: 100vh;
        }

        .main-header {
            background-color: #ffffff;
            padding: 20px 32px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            border-radius: 12px;
            margin-bottom: 32px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .main-header h1 {
            font-size: 1.75rem;
            font-weight: 600;
            margin: 0;
        }

        .main-header h1 a {
            color: #1e293b;
            text-decoration: none;
            transition: color 0.2s;
        }

        .main-header h1 a:hover {
            color: #3b82f6;
        }

        /* Category Cards */
        .category-card {
            background-color: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 1px solid #e5e7eb;
        }

        .category-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
        }

        .category-card .card-body {
            padding: 24px;
            text-align: center;
        }

        .category-card .card-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 12px;
        }

        .category-card .card-text {
            color: #6b7280;
            font-size: 0.95rem;
            line-height: 1.5;
        }

        /* Alerts */
        .alert {
            border-radius: 8px;
            padding: 16px;
            margin-bottom: 24px;
            font-weight: 500;
        }

        /* Profile Modal */
        .modal-content {
            border-radius: 12px;
            border: none;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
        }

        .modal-header {
            border-bottom: 1px solid #e5e7eb;
            padding: 16px 24px;
        }

        .modal-body {
            padding: 24px;
        }

        .modal-body label {
            font-weight: 500;
            color: #1e293b;
            margin-bottom: 8px;
            display: block;
        }

        .modal-body input {
            width: 100%;
            padding: 10px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 0.95rem;
            margin-bottom: 16px;
            background-color: #f9fafb;
        }

        .modal-body input[readonly] {
            background-color: #e5e7eb;
            cursor: not-allowed;
        }

        #togglePassword {
            background: none;
            border: none;
            cursor: pointer;
            padding: 8px;
            position: absolute;
            right: 24px;
            top: 50%;
            transform: translateY(-50%);
        }

        .changePassword {
            color: #3b82f6;
            text-decoration: none;
            font-weight: 500;
        }

        .changePassword:hover {
            color: #2563eb;
        }

        .modal-footer {
            border-top: 1px solid #e5e7eb;
            padding: 16px 24px;
        }

        /* Dropdown */
        .dropdown-toggle {
            background-color: #1e293b;
            border-color: #1e293b;
            border-radius: 8px;
            padding: 10px 16px;
            font-weight: 500;
        }

        .dropdown-menu {
            background-color: #ffffff;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 8px 0;
        }

        .dropdown-item {
            padding: 8px 16px;
            font-weight: 500;
            color: #1e293b;
        }

        .dropdown-item:hover {
            background-color: #f1f5f9;
            color: #2563eb;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-260px);
                width: 220px;
                z-index: 1000;
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
                padding: 24px;
            }

            .toggle-sidebar {
                display: block;
                position: fixed;
                top: 16px;
                left: 16px;
                z-index: 1001;
                background-color: #1e293b;
                color: #ffffff;
                border: none;
                padding: 12px;
                border-radius: 8px;
                font-size: 1.1rem;
                cursor: pointer;
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            }

            .main-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 16px;
            }

            .category-card .card-body {
                padding: 20px;
            }

            .modal-dialog {
                margin: 16px;
            }
        }

        @media (min-width: 769px) {
            .toggle-sidebar {
                display: none;
            }
        }

        /* Chart Modal */
        .chart-modal .modal-dialog {
            max-width: 600px;
        }

        .chart-modal .modal-content {
            padding: 16px;
        }

        .chart-modal .modal-body {
            height: 400px;
            padding: 24px;
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
                <li><a href="{{ route('quiz-withTimeout') }}">Quiz with Mix-Technology Based</a></li>
                <li><a href="{{ route('listOfAllUser_user') }}">List of candidate with top rank</a></li>
                @if(Session::get('email'))
                    <li><a href="{{ route('logout') }}">Logout</a></li>
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

        @foreach ($dataFromSessionEmail as $dataFromSessionEmail_data)
        @endforeach

        <header class="main-header">
            <div class="profileDiv" style="float: right;">
                <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#staticBackdropOne">
                    <i class="fas fa-user" style="color: black;"></i>

                    <img src="{{ url('storage/' . $dataFromSessionEmail_data->profileImage) }}" alt="Profile Image"
                        height="50px" width="50px" style="border-radius:50%;">
                </button>

            </div>

            <!-- Modal -->
            <div class="modal fade" id="staticBackdropOne" data-bs-backdrop="static" data-bs-keyboard="false"
                tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Profile</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('change-password') }}" method="post">
                                @csrf
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" value="{{ $dataFromSessionEmail_data->name }}"
                                    readonly><br>

                                <label for="email">Email</label>
                                <input type="text" name="email" id="email"
                                    value="{{ $dataFromSessionEmail_data->email }}" readonly><br>

                                <label for="phone">Phone</label>
                                <input type="text" name="phone" id="phone"
                                    value="{{ $dataFromSessionEmail_data->phone }}" readonly><br>

                                <label for="password">Password</label>
                                <input type="password" name="password" id="password"
                                    value="{{ $dataFromSessionEmail_data->password }}" readonly>


                                <button type="button" id="togglePassword">
                                    <i class="fa fa-eye" id="eyeIcon"></i>
                                </button>

                                <a href="#" class="changePassword">Change password</a>
                                <div class="passwordChange" id="passwordChange" style="display: none;">
                                    <label for="newPassword">New Password</label>
                                    <input type="password" name="newPassword" id="newPassword">
                                </div>

                                <button type="submit" name="submit">Change</button>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <h1><a href="">Quiz Questions</a></h1>
            <div class="activityDiv">
                @if(count($resultsByDate) > 0)
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" id="chartDropdown"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Select Date for Chart
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="chartDropdown">
                            @foreach ($resultsByDate as $data)
                                <li>
                                    <a class="dropdown-item open-chart-modal" href="#" data-date="{{ $data->date }}">
                                        {{ $data->date }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @else
                    <p>No chart data available.</p>
                @endif
            </div>
        </header>

        <!-- Chart Modals -->
        @foreach ($resultsByDate as $data)
            <div class="modal fade chart-modal" id="modal-{{ $data->date }}" tabindex="-1" role="dialog"
                aria-labelledby="modalLabel-{{ $data->date }}">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalLabel-{{ $data->date }}">Chart for {{ $data->date }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" style="height: 400px;">
                            <canvas id="chart-{{ $data->date }}"></canvas>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="container">
            <div class="row">
                @foreach ($allCategories as $dataAllCategories)
                    <div class="col-md-4 col-sm-6 mb-4">
                        <a href="{{ route('mcq-paper', ['id' => $dataAllCategories->id]) }}" style="text-decoration: none;">
                            <div class="card category-card">
                                <div class="card-body" data-id="{{ $dataAllCategories->id }}">
                                    <h5 class="card-title">{{ $dataAllCategories->name }}</h5>
                                    <p class="card-text">{{ $dataAllCategories->description ?? 'Explore this category' }}
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function () {
            setTimeout(function () {
                $('#success-alert').fadeOut('slow');
            }, 2000);

            // Toggle sidebar
            $('.toggle-sidebar').click(function () {
                $('.sidebar').toggleClass('active');
            });

            $('.category-card .card-body').click(function () {
                var divId = $(this).data('id');
            });

            // Chart data from PHP
            const chartData = @json($resultsByDate);
            const charts = {};

            $('.open-chart-modal').on('click', function () {
                const date = $(this).data('date');
                const modalId = `#modal-${date}`;
                $(modalId).modal('show');
            });

            // Initialize chart when modal is shown
            $('.chart-modal').on('shown.bs.modal', function () {
                const modalId = $(this).attr('id');
                const date = modalId.replace('modal-', '');
                const canvasId = `chart-${date}`;
                const ctx = document.getElementById(canvasId).getContext('2d');

                const dataForDate = chartData.find(item => item.date === date);
                if (!dataForDate) return;

                // Destroy old chart if exists
                if (charts[date]) {
                    charts[date].destroy();
                }

                // Create new chart
                charts[date] = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['Correct Answers', 'Time Taken (sec)'],
                        datasets: [{
                            label: `Stats for ${date}`,
                            data: [dataForDate.totalCorrectAns, dataForDate.total_time],
                            backgroundColor: ['#36A2EB', '#FFCE56'],
                            borderColor: ['#36A2EB', '#FFCE56'],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Value'
                                }
                            },
                            x: {
                                title: {
                                    display: true,
                                    text: 'Metrics'
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                display: true,
                                position: 'top'
                            }
                        }
                    }
                });
            });

            // Clean up charts when modal is hidden
            $('.chart-modal').on('hidden.bs.modal', function () {
                const modalId = $(this).attr('id');
                const date = modalId.replace('modal-', '');
                if (charts[date]) {
                    charts[date].destroy();
                    delete charts[date];
                }
            });

            // profile btn
            $('#profileBtn').click(function () {
                $('.modal').css('display', 'block');
            });

            $('.changePassword').click(function (e) {
                e.preventDefault();
                $('#passwordChange').toggle();
            });
            $('#togglePassword').on('click', function () {
                const passwordField = $('#password');
                const eyeIcon = $('#eyeIcon');

                const type = passwordField.attr('type') === 'password' ? 'text' : 'password';
                passwordField.attr('type', type);

                // Toggle eye / eye-slash icon
                eyeIcon.toggleClass('fa-eye fa-eye-slash');
            });

        });
    </script>
</body>

</html>