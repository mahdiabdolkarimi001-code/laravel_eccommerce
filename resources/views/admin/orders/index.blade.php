<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>مدیریت سفارشات</title>

    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@400;600;700;900&display=swap" rel="stylesheet">

    <style>
/* ===================== */
/* === CSS نسخه اول === */
/* ===================== */

:root {
    --bg-color: #f3f5f7;
    --card-bg: #ffffff;
    --shadow-light: 6px 6px 12px #c6c9cc, -6px -6px 12px #ffffff;
    --shadow-inset: inset 3px 3px 6px #d0d3d6, inset -3px -3px 6px #ffffff;
    --primary-color: #007bff;
    --text-color: #333;
    --border-color: #e9ecef;
}

body {
    margin: 0;
    background-color: var(--bg-color);
    font-family: 'Vazirmatn', sans-serif;
    color: var(--text-color);
    direction: rtl;
    min-height: 100vh;
    padding-right: 60px;
    transition: padding-right 0.3s ease;
    overflow-x: hidden;
}

/* === Sidebar === */
    #sidebar {
      background-color: #ffffff;
      width: 60px;
      height: 100vh;
      position: fixed;
      top: 0;
      right: 0;
      padding: 60px 0;
      box-shadow: -2px 0 12px rgba(0,0,0,0.08);
      overflow: hidden;
      transition: width 0.3s ease;
      display: flex;
      flex-direction: column;
      align-items: center;
      z-index: 1000;
    }

    #sidebar.open {
      width: 200px;
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
      color: #555;
      padding: 14px 12px;
      text-decoration: none;
      font-weight: 600;
      font-size: 14px;
      border-bottom: 1px solid #eee;
      display: flex;
      align-items: center;
      gap: 12px;
      white-space: nowrap;
      transition: 0.25s ease;
    }

    #sidebar:not(.open) a {
      justify-content: center;
      text-indent: -9999px;
    }

    #sidebar a:hover {
      background-color: #eaf4ff;
      color: #007bff;
    }

    #sidebar svg {
      width: 20px;
      height: 20px;
      fill: currentColor;
      flex-shrink: 0;
    }
/* --- Toggle --- */
#toggle-btn {
    position: fixed;
    top: 15px;
    right: 60px;
    width: 35px;
    height: 35px;
    background: var(--primary-color);
    border-radius: 6px 0 0 6px;
    border: none;
    color: #fff;
    font-weight: 900;
    cursor: pointer;
    z-index: 1100;
}

/* --- Content --- */
.content {
    padding: 40px;
    margin-right: 60px;
    transition: margin-right 0.3s ease;
    max-width: 1400px;
    margin-left: auto;
}

#sidebar.open ~ .content {
    margin-right: 220px;
}

.data-container {
    background: var(--card-bg);
    border-radius: 15px;
    padding: 25px;
    box-shadow: var(--shadow-light);
}

/* --- Table --- */
table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
}

thead th {
    padding: 18px;
    border-bottom: 2px solid var(--border-color);
    text-align: center;
}

tbody td {
    padding: 16px;
    border-bottom: 1px solid var(--border-color);
    text-align: center;
}

tbody tr:nth-child(odd) { background: #fbfcfe; }
tbody tr:nth-child(even) { background: #f7f9fb; }

.btn {
    padding: 8px 18px;
    border-radius: 8px;
    background: #e9ecef;
    color: var(--primary-color);
    text-decoration: none;
    font-weight: 600;
}

/* ================================================= */
/* === موبایل ریسپانسیو (Breakpoint: 992px) === */
/* ================================================= */

@media (max-width: 992px) {

    body {
        padding-right: 0;
    }

    .content {
        padding: 20px 15px;
        margin-right: 0;
    }

    #sidebar.open ~ .content {
        margin-right: 0;
    }

    /* --- Sidebar Mobile Popup --- */
    #sidebar {
        width: 220px;
        transform: translateX(220px);
        box-shadow: 4px 0 20px rgba(0,0,0,0.2);
        display: none;
    }

    #sidebar.open {
        transform: translateX(0);
        display: flex;
    }

    #sidebar nav a {
        justify-content: flex-start;
        padding-left: 20px;
        text-indent: 0;
    }

    /* --- Toggle Button --- */
    #toggle-btn {
        right: 15px;
        border-radius: 6px;
    }

    h1 {
        font-size: 26px;
    }

    .data-container {
        padding: 15px;
    }

    /* --- Table to Card --- */
    table, thead, tbody, th, td, tr {
        display: block;
        width: 100%;
    }

    thead {
        display: none;
    }

    tbody tr {
        margin-bottom: 15px;
        border: 1px solid var(--border-color);
        border-radius: 12px;
        box-shadow: var(--shadow-light);
        background-color: var(--card-bg) !important;
        padding: 15px;
    }

    tbody tr:hover {
        background-color: var(--card-bg) !important;
    }

    tbody td {
        text-align: right;
        padding: 8px 0;
        border-bottom: 1px dashed #eee;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-direction: row-reverse;
    }

    tbody td:before {
        content: attr(data-label);
        font-weight: 700;
        color: #6c757d;
        margin-left: 10px;
        flex-grow: 1;
        text-align: right;
    }

    tbody td:last-child {
        border-bottom: none;
        padding-top: 15px;
    }

    .btn {
        padding: 8px 15px;
    }
}
    </style>
</head>
<body>

<!-- Sidebar -->
<div id="sidebar" class="open">
  <nav>

    <a href="{{ url('admin/dashboard') }}">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
        <path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8v-10h-8v10zm0-18v6h8V3h-8z"/>
      </svg>
      <span>داشبورد</span>
    </a>

    <a href="{{ url('admin/products/create') }}">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
        <path d="M19 11h-6V5h-2v6H5v2h6v6h2v-6h6v-2z"/>
      </svg>
      <span>افزودن محصول</span>
    </a>

    <a href="{{ url('admin/users') }}">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
        <path d="M16 11c1.66 0 3-1.34 3-3s-1.34-3-3-3-3 1.34-3 3 1.34 3 3 3zm-8 0c1.66 0 3-1.34 3-3S9.66 5 8 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.67 0-8 1.34-8 4v3h16v-3c0-2.66-5.33-4-8-4z"/>
      </svg>
      <span>مدیریت کاربران</span>
    </a>

    <a href="{{ url('admin/orders') }}">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
        <path d="M20 8h-3V6a2 2 0 0 0-2-2H9a2 2 0 0 0-2 2v2H4a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-8a2 2 0 0 0-2-2z"/>
      </svg>
      <span>مدیریت سفارشات</span>
    </a>

    <a href="{{ url('admin/categories') }}">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
        <path d="M4 6h16v2H4V6zm0 5h16v2H4v-2zm0 5h16v2H4v-2z"/>
      </svg>
      <span>مدیریت دسته‌بندی‌ها</span>
    </a>

    <a href="{{ url('admin/sliders') }}">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
        <rect x="2" y="5" width="6" height="14"/>
        <rect x="9" y="3" width="6" height="18"/>
        <rect x="16" y="7" width="6" height="10"/>
      </svg>
      <span>مدیریت اسلایدر</span>
    </a>

    <a href="{{ url('admin/category_icons') }}">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
        <path d="M10 4H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2h-8l-2-2z"/>
      </svg>
      <span>مدیریت آیکن داشبورد</span>
    </a>

    <a href="{{ url('admin/custom-product-bars') }}">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
        <path d="M7 4h-2l-1 2H1v2h1l3.6 7.59-1.35 2.45A1 1 0 0 0 5 20h14v-2H6.42a.25.25 0 0 1-.24-.17l.03-.06L7.1 15h7.45a1 1 0 0 0 .92-.61l3.58-8.59A1 1 0 0 0 18 4H7z"/>
      </svg>
      <span>نوار محصولات</span>
    </a>

  </nav>
</div>

<button id="toggle-btn" onclick="toggleSidebar()">☰</button>

<div class="content">
    <h1>مدیریت سفارشات</h1>

    <div class="data-container">
        <table>
            <thead>
            <tr>
                <th>شماره</th>
                <th>نام</th>
                <th>تلفن</th>
                <th>درگاه</th>
                <th>تاریخ</th>
                <th>مبلغ</th>
                <th>وضعیت</th>
                <th>عملیات</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
                <tr>
                    <td data-label="شماره سفارش">#{{ $order->id }}</td>
                    <td data-label="نام">{{ $order->first_name }} {{ $order->last_name }}</td>
                    <td data-label="تلفن">{{ $order->phone }}</td>
                    <td data-label="درگاه">{{ $order->gateway }}</td>
                    <td data-label="تاریخ">{{ $order->created_at->format('Y/m/d') }}</td>
                    <td data-label="مبلغ">{{ number_format($order->total) }} ت</td>
                    <td data-label="وضعیت">
                        @if($order->status === 'paid')
                            <span style="color:#28a745;font-weight:bold">پرداخت شده</span>
                        @elseif($order->status === 'pending')
                            <span style="color:#ffc107;font-weight:bold">در حال پردازش</span>
                        @else
                            <span style="color:#dc3545;font-weight:bold">لغو شده</span>
                        @endif
                    </td>
                    <td data-label="عملیات">
                        <a href="{{ route('admin.orders.show',$order->id) }}" class="btn">مشاهده</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
function toggleSidebar() {
    document.getElementById('sidebar').classList.toggle('open');
}
</script>

</body>
</html>
