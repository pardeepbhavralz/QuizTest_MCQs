<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
            transition: margin-left 0.3s ease;
        }

        .sidebar {
            width: 250px;
            background: linear-gradient(180deg, #1a2639 0%, #2c3e50 100%);
            color: white;
            height: 100vh;
            position: fixed;
            padding: 20px;
            overflow-y: auto;
            transition: transform 0.3s ease;
            z-index: 1000;
        }

        .sidebar.hidden {
            transform: translateX(-100%);
        }

        .sidebar-header {
            font-size: 1.6rem;
            font-weight: 600;
            margin-bottom: 20px;
            text-align: center;
            letter-spacing: 1px;
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
            padding: 12px;
            border-radius: 6px;
            transition: background-color 0.3s, color 0.3s;
        }

        .sidebar-nav a:hover, .sidebar-nav a.active {
            background-color: #3b82f6;
            color: white;
        }

        .sidebar-nav i {
            margin-right: 12px;
            font-size: 1.2rem;
        }

        .main-content {
            margin-left: 250px;
            padding: 30px;
            flex-grow: 1;
            transition: margin-left 0.3s ease;
        }

        .main-content.full-width {
            margin-left: 0;
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
            transition: color 0.3s;
        }

        .header nav a:hover {
            color: #3b82f6;
        }

        .hamburger {
            display: none;
            font-size: 1.5rem;
            background: none;
            border: none;
            color: #1a2639;
            cursor: pointer;
        }

        .userRankedList {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 1000px;
            margin: 0 auto;
        }

        .search-form {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .search-form input {
            flex-grow: 1;
            padding: 10px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 1rem;
            transition: border-color 0.3s;
        }

        .search-form input:focus {
            border-color: #3b82f6;
            outline: none;
        }

        .search-form button, .search-form a {
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s;
            text-decoration: none;
        }

        .search-form button {
            background-color: #3b82f6;
            color: white;
        }

        .search-form button:hover {
            background-color: #2563eb;
        }

        .search-form a {
            background-color: #e5e7eb;
            color: #1a2639;
            text-align: center;
        }

        .search-form a:hover {
            background-color: #d1d5db;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        thead {
            background: linear-gradient(90deg, #3b82f6, #60a5fa);
            color: white;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        th, td {
            padding: 14px 16px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        tbody tr:nth-child(even) {
            background-color: #f9fafb;
        }

        tbody tr:hover {
            background-color: #f1f5f9;
        }

        th {
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.9rem;
        }

        td {
            font-size: 0.95rem;
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
                width: 250px;
                position: fixed;
                transform: translateX(-100%);
            }
            .sidebar.active {
                transform: translateX(0);
            }
            .main-content {
                margin-left: 0;
            }
            .hamburger {
                display: block;
            }
        }
    </style>
</head>
<body>
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">Admin Dashboard</div>
        <ul class="sidebar-nav">
            <li><a href="{{ route('admin-dashboard') }}" class="active"><i class="fas fa-home"></i> Home</a></li>
            <li><a href="{{ route('admin-dashboard') }}"><i class="fas fa-list"></i> Categories</a></li>
            <li><a href="{{ route('listOfAllUser') }}"><i class="fas fa-users"></i> Top Candidates</a></li>
            @if(Session::get('email'))
            <li><a href="{{ route('logout') }}"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            @endif
        </ul>
    </aside>

    <main class="main-content" id="main-content">
        <header class="header">
            <button class="hamburger" aria-label="Toggle Sidebar" id="hamburger">
                <i class="fas fa-bars"></i>
            </button>
            <h1>Top Candidates</h1>
            <nav>
                <ul>
                    <li><a href="{{ route('admin-dashboard') }}">Dashboard</a></li>
                    <li><a href="{{ route('logout') }}">Logout</a></li>
                </ul>
            </nav>
        </header>

        <div class="userRankedList">
            <form method="GET" action="{{ route('listOfAllUser') }}" class="search-form">
                <input type="text" name="search" placeholder="Search by email or time" value="{{ request('search') }}">
                <button type="submit">Search</button>
                <a href="{{ route('listOfAllUser') }}">Reset</a>
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
                    @foreach ($allRankedbased as $index => $allRankedbased_data)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $allRankedbased_data->email }}</td>
                            <td>{{ $allRankedbased_data->timeTakenSec }} sec</td>
                            <td>{{ $allRankedbased_data->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            // Sidebar toggle for mobile
            $('#hamburger').on('click', function () {
                $('#sidebar').toggleClass('active');
                $('#main-content').toggleClass('full-width');
            });

            // Client-side search
            // const $input = $('<input>', {
            //     placeholder: 'Instant search by email or time...',
            //     css: {
            //         marginBottom: '15px',
            //         padding: '10px',
            //         width: '100%',
            //         border: '1px solid #d1d5db',
            //         borderRadius: '6px',
            //         fontSize: '1rem'
            //     }
            // });

            const $container = $('.userRankedList');
            $container.find('table').before($input);

            $input.on('keyup', function () {
                const filter = $(this).val().toLowerCase();
                $('tbody tr').each(function () {
                    const email = $(this).find('td').eq(1).text().toLowerCase();
                    const time = $(this).find('td').eq(2).text().toLowerCase();
                    $(this).toggle(email.includes(filter) || time.includes(filter));
                });
            });
        });
    </script>
</body>
</html>