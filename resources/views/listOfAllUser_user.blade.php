<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Add jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        /* Existing styles unchanged, adding table-specific styles */
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

        /* Table Styles */
        .userRankedList table {
            width: 100%;
            border-collapse: collapse;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .userRankedList th,
        .userRankedList td {
            padding: 12px 16px;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
        }

        .userRankedList th {
            background-color: #1e293b;
            color: #ffffff;
            font-weight: 600;
        }

        .userRankedList tr:nth-child(even) {
            background-color: #f9fafb;
        }

        .userRankedList tr:hover {
            background-color: #f1f5f9;
        }

        /* Form Styles */
        .userRankedList form {
            display: flex;
            gap: 12px;
            margin-bottom: 20px;
        }

        .userRankedList input[type="text"] {
            padding: 10px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 0.95rem;
            flex-grow: 1;
        }

        .userRankedList button,
        .userRankedList a {
            padding: 10px 16px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            cursor: pointer;
        }

        .userRankedList button {
            background-color: #3b82f6;
            color: #ffffff;
            border: none;
            transition: background-color 0.2s;
        }

        .userRankedList button:hover {
            background-color: #2563eb;
        }

        .userRankedList a {
            background-color: #e5e7eb;
            color: #1e293b;
            display: inline-block;
            transition: background-color 0.2s;
        }

        .userRankedList a:hover {
            background-color: #d1d5db;
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

            .userRankedList form {
                flex-direction: column;
            }

            .userRankedList input[type="text"],
            .userRankedList button,
            .userRankedList a {
                width: 100%;
                text-align: center;
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
                <li><a href="{{ route('dashboard') }}"><i class="fas fa-home"></i> Home</a></li>
                <li><a href="{{ route('quiz-withTimeout') }}"><i class="fas fa-question-circle"></i> Quiz with Mix-Technology Based</a></li>
                <li><a href="{{ route('listOfAllUser_user') }}"><i class="fas fa-list-ol"></i> List of candidate with top rank</a></li>
                @if(Session::get('email'))
                    <li><a href="{{ route('logout') }}"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                @endif
            </ul>
        </nav>
    </aside>
    <main class="main-content">
        <div class="userRankedList">
            <form method="GET" action="{{ route('listOfAllUser_user') }}">
                <input type="text" name="search" placeholder="Search by email or time" value="{{ request('search') }}">
                <button type="submit">Search</button>
                <a href="{{ route('listOfAllUser_user') }}">Reset</a>
            </form>

            <table>
                <thead>
                    <tr>
                        <th>Serial No.</th>
                        <th>Email</th>
                        <th>Time Taken</th>
                        <th>Time / Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($allRankedbased as $index => $rankedUser)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $rankedUser->email }}</td>
                            <td>{{ $rankedUser->timeTakenSec }} sec</td>
                            <td>{{ $rankedUser->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
    <script>
        // Sidebar toggle for mobile
        $(document).ready(function () {
            $('.toggle-sidebar').click(function () {
                $('.sidebar').toggleClass('active');
            });

            // Close sidebar when clicking a link (optional for better UX)
            $('.sidebar .nav-links a').click(function () {
                if ($(window).width() <= 768) {
                    $('.sidebar').removeClass('active');
                }
            });
        });
    </script>
</body>
</html>