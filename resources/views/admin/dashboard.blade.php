<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8" />
    <title>پنل مدیریت - تم روشن (ریسپانسیو)</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- فونت Vazirmatn برای خوانایی عالی در زبان فارسی -->
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@400;600;700;900&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #007bff;
            --secondary-bg: #f8f9fa;
            --text-color: #333;
            --card-bg: #ffffff;
            --border-color: #dee2e6;
            --shadow-light: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        body {
            margin: 0;
            font-family: 'Vazirmatn', sans-serif;
            background-color: var(--secondary-bg);
            color: var(--text-color);
            min-height: 100vh;
            overflow-x: hidden;
            transition: padding-right 0.3s ease;
        }

        /* سایدبار */
        #sidebar {
            background-color: #ffffff;
            width: 60px;
            height: 100vh;
            position: fixed;
            top: 0;
            right: 0;
            padding: 70px 0 20px 0;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
            overflow: hidden;
            transition: width 0.3s ease, padding 0.3s ease, transform 0.3s ease;
            display: flex;
            flex-direction: column;
            align-items: center;
            z-index: 1000;
            transform: translateX(0);
        }

        #sidebar.open {
            width: 220px;
            align-items: flex-start;
            padding-left: 20px;
        }

        #sidebar nav {
            width: 100%;
            display: flex;
            flex-direction: column;
            margin-top: 20px;
        }

        #sidebar a {
            color: #6c757d;
            padding: 15px 10px;
            text-decoration: none;
            font-weight: 600;
            font-size: 15px;
            border-bottom: 1px solid var(--border-color);
            white-space: nowrap;
            transition: background-color 0.25s ease, color 0.25s ease, text-indent 0.3s ease;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 12px;
        }

        #sidebar:not(.open) a {
            padding: 15px 0;
            justify-content: center;
            text-indent: -9999px;
        }

        #sidebar.open a {
            justify-content: flex-start;
            font-size: 16px;
            text-indent: 0;
            padding-left: 20px;
        }

        #sidebar a:hover {
            background-color: rgba(0, 123, 255, 0.1);
            color: var(--primary-color);
        }

        #sidebar a svg {
            flex-shrink: 0;
            width: 22px;
            height: 22px;
            stroke: currentColor;
            fill: none;
        }

        /* دکمه تاگل */
        #toggle-btn {
            position: fixed;
            top: 15px;
            right: 60px;
            width: 35px;
            height: 35px;
            background-color: var(--primary-color);
            border-radius: 6px 0 0 6px;
            border: none;
            color: white;
            font-weight: 900;
            cursor: pointer;
            transition: right 0.3s ease, background-color 0.3s ease;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1100;
            box-shadow: 0 3px 8px rgba(0, 123, 255, 0.4);
        }

        #sidebar.open ~ #toggle-btn {
            right: 220px;
        }

        /* محتوا */
        .content {
            padding: 40px;
            transition: margin-right 0.3s ease;
            margin-right: 60px;
            max-width: 1400px;
            margin-left: auto;
            margin-bottom: 50px;
        }

        #sidebar.open ~ .content {
            margin-right: 220px;
        }

        h1 {
            color: var(--text-color);
            margin-bottom: 40px;
            font-weight: 900;
            font-size: 36px;
            padding-bottom: 15px;
            border-bottom: 3px solid var(--primary-color);
        }

        h2 {
            color: var(--primary-color);
            font-weight: 700;
            font-size: 22px;
            margin-top: 40px;
            margin-bottom: 20px;
            border-bottom: 1px solid var(--border-color);
            padding-bottom: 8px;
        }

        /* کارت‌ها */
        .dashboard-cards {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            margin-bottom: 40px;
            justify-content: flex-start;
        }

        .dashboard-card {
            background: var(--card-bg);
            border-radius: 12px;
            padding: 25px;
            flex: 1 1 200px; 
            max-width: 300px;
            text-align: right;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: var(--shadow-light);
            border-right: 5px solid transparent;
            text-decoration: none;
            color: var(--text-color);
        }

        .dashboard-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(0, 123, 255, 0.15);
            border-right: 5px solid var(--primary-color);
            color: var(--primary-color);
        }

        .dashboard-card h2 {
            font-size: 38px;
            margin: 0 0 8px 0;
            color: var(--primary-color);
            font-weight: 900;
            letter-spacing: 0.5px;
            border: none;
        }

        .dashboard-card p {
            margin: 0;
            font-size: 17px;
            color: #777;
            font-weight: 600;
        }

        .dashboard-card[href$="logout"] {
             border-right-color: #dc3545;
        }
        .dashboard-card[href$="logout"]:hover {
            border-right-color: #dc3545;
            color: #dc3545;
            box-shadow: 0 8px 20px rgba(220, 53, 69, 0.15);
        }

        /* جدول */
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 15px;
        }

        thead tr {
            background-color: var(--primary-color);
            color: white;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }

        th {
            padding: 15px 12px;
            text-align: right;
            font-weight: 700;
            border-bottom: none;
        }

        tbody tr {
            background-color: var(--card-bg);
            border-bottom: 1px solid var(--border-color);
            transition: background-color 0.2s ease;
        }

        tbody tr:nth-child(even) {
            background-color: var(--secondary-bg);
        }

        tbody tr:hover {
            background-color: #fff0f0;
        }

        td {
            padding: 15px 12px;
            text-align: right;
            border-bottom: 1px solid var(--border-color);
        }

        .btn {
            padding: 8px 15px;
            border: none;
            border-radius: 6px;
            color: white;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            font-size: 14px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }

        .btn-delete {
            background-color: #dc3545;
        }

        .btn-delete:hover {
            background-color: #c82333;
            transform: translateY(-1px);
        }

        /* ریسپانسیو */
        @media (max-width: 991.98px) {
            #sidebar {
                width: 0;
                padding: 0;
                box-shadow: none;
                transform: translateX(100%);
            }

            #sidebar.open {
                width: 250px; 
                padding: 70px 20px 20px 20px;
                box-shadow: -5px 0 15px rgba(0,0,0,0.2);
                transform: translateX(0);
                overflow-y: auto;
            }

            #sidebar a {
                justify-content: flex-start;
                text-indent: 0;
                padding-left: 15px;
            }
            #sidebar:not(.open) a {
                justify-content: center;
            }

            #toggle-btn {
                right: 15px;
                border-radius: 6px;
            }

            #sidebar.open ~ #toggle-btn {
                right: 250px;
            }

            .content {
                margin-right: 0;
                padding: 20px;
            }

            h1 { font-size: 28px; }
            .dashboard-cards { flex-direction: column; }
            .dashboard-card { max-width: 100%; flex-basis: auto; }
            .dashboard-card h2 { font-size: 32px; }

            table, thead, tbody, th, td, tr { display: block; width: 100%; }
            thead tr { position: absolute; top: -9999px; left: -9999px; }

            tbody tr {
                border: 1px solid var(--border-color);
                margin-bottom: 15px;
                border-radius: 8px;
                overflow: hidden;
                box-shadow: var(--shadow-light);
                background-color: var(--card-bg) !important;
            }

            tbody tr:nth-child(even) {
                background-color: var(--card-bg) !important;
            }

            td {
                border: none;
                border-bottom: 1px solid rgba(0,0,0,0.05);
                position: relative;
                padding: 12px 20px 12px 10px;
                text-align: right;
            }

            td:last-child { border-bottom: none; }

            td::before {
                position: absolute;
                top: 12px;
                right: 10px;
                width: 45%;
                padding-right: 10px;
                white-space: nowrap;
                font-weight: 700;
                color: var(--primary-color);
            }

            td:nth-of-type(1)::before { content: "شناسه"; }
            td:nth-of-type(2)::before { content: "نام کاربری"; }
            td:nth-of-type(3)::before { content: "ایمیل"; }
            td:nth-of-type(4)::before { content: "تاریخ ثبت‌نام"; }
            td:nth-of-type(5)::before { content: "عملیات"; }

            td:not(:last-child) { padding-right: 130px; }
            td:last-child { padding: 12px 20px; }

            .btn-delete { width: 100%; margin-top: 5px; }
        }
    </style>
</head>
<body>

<div id="sidebar">
    <nav>
        <a href="{{ url('admin/dashboard') }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
            <span>داشبورد</span>
        </a>
        <a href="{{ url('admin/products') }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 10a6 6 0 0 0-12 0c0 4.5-3 6.5-3 9h18s-3-4.5-3-9z"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
            <span>مدیریت محصولات</span>
        </a>
        <a href="{{ url('admin/users') }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
            <span>مدیریت کاربران</span>
        </a>
        <a href="{{ url('admin/orders') }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
            <span>مدیریت سفارشات</span>
        </a>
        <a href="{{ url('admin/categories') }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="8 10 12 6 16 10"/><line x1="12" y1="6" x2="12" y2="18"/></svg>
            <span>دسته‌بندی‌ها</span>
        </a>
    </nav>
</div>

<button id="toggle-btn" onclick="toggleSidebar()">☰</button>

<div class="content">
    <h1>داشبورد مدیریتی</h1>

    <div class="dashboard-cards">
        <a href="{{ url('admin/users') }}" class="dashboard-card">
            <h2>{{ $userCount }}</h2>
            <p>تعداد کاربران</p>
        </a>
        <a href="{{ url('admin/orders') }}" class="dashboard-card">
            <h2>{{ $orderCount }}</h2>
            <p>سفارشات جدید</p>
        </a>
        <a href="{{ url('admin/products') }}" class="dashboard-card">
            <h2>{{ $productCount }}</h2>
            <p>موجودی محصولات</p>
        </a>
        <a href="{{ route('admin.logout') }}" class="dashboard-card">
            <h2>—</h2>
            <p>خروج از سیستم</p>
        </a>
    </div>

    <section class="users-management">
        <h2>لیست کاربران فعال</h2>
        <table>
            <thead>
                <tr>
                    <th>شناسه</th>
                    <th>نام کاربری</th>
                    <th>ایمیل</th>
                    <th>تاریخ ثبت‌نام</th>
                    <th>عملیات</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at->format('Y/m/d') }}</td>
                        <td>
                            <form action="{{ url('admin/users/'.$user->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('آیا مطمئنید که می‌خواهید کاربر {{ $user->name }} را حذف کنید؟');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-delete">حذف</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </section>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('open');
        }
    </script>

</body>
</html>