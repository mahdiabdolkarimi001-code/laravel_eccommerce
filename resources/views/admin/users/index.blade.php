<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>مدیریت کاربران - تم روشن آبی</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@400;600;700;900&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-color: #f3f5f7;
            --card-bg: #ffffff;
            --shadow-light: 4px 4px 8px #d0d3d6, -4px -4px 8px #ffffff;
            --shadow-inset: inset 2px 2px 5px #d0d3d6, inset -2px -2px 5px #ffffff;
            --primary-color: #007bff;
            --text-color: #343a40;
            --border-color: #e9ecef;
        }

        body {
            margin: 0;
            font-family: 'Vazirmatn', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-color);
            padding-right: 60px;
            transition: padding-right 0.3s ease;
            min-height: 100vh;
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
        }

        .data-container {
            background: var(--card-bg);
            border-radius: 15px;
            padding: 30px;
            box-shadow: var(--shadow-light);
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: separate; 
            border-spacing: 0;
            font-size: 15px;
        }

        thead th {
            background-color: var(--card-bg);
            color: #6c757d;
            font-weight: 700;
            padding: 18px 12px;
            box-shadow: var(--shadow-inset);
            border-bottom: none;
        }

        tbody td {
            padding: 16px 12px;
            text-align: center;
            border-bottom: 1px solid var(--border-color);
        }

        tbody tr {
            box-shadow: 0 2px 4px rgba(0,0,0,0.05); 
            margin-bottom: 10px;
            border-radius: 10px;
            background-color: var(--card-bg);
        }

        tbody tr:hover {
            background-color: #fcfcfc;
        }

        tbody tr:nth-child(odd) {
            background-color: #fcfdff;
        }

        tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        .btn {
            padding: 8px 15px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.25s ease;
            color: var(--text-color);
            box-shadow: 2px 2px 4px #c0c4c7, -2px -2px 4px #ffffff;
        }

        .btn:active {
            box-shadow: inset 2px 2px 4px #c0c4c7, inset -2px -2px 4px #ffffff;
            transform: scale(0.98);
        }

        .btn-edit {
            background-color: #e9ecef;
            color: var(--primary-color);
            margin-left: 8px;
        }

        .btn-edit:hover {
            background-color: #d0d3d6;
        }

        .btn-delete {
            background-color: #e9ecef;
            color: #dc3545;
        }

        .btn-delete:hover {
            background-color: #d0d3d6;
        }

        .success-message {
            background-color: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 25px;
            box-shadow: var(--shadow-light);
            text-align: center;
            border: 1px solid #c3e6cb;
        }

        /* ---------------------------------------------------- */
/* استایل‌های ریسپانسیو بهبود یافته (Mobile Optimization) */
/* ---------------------------------------------------- */
@media (max-width: 768px) {
    
    /* سایدبار در موبایل باید ثابت شود و دکمه تاگل موقعیت خود را تنظیم کند (این بخش از JS مدیریت می‌شود) */
    
    .content {
        margin-right: 20px; /* فضای کمتری از سمت راست در حالت بسیار کوچک */
        padding: 15px;
    }

    .data-container {
        padding: 10px; /* کمی فضای داخلی کمتر */
    }

    /* تبدیل کامل جدول به کارت */
    .data-container table {
        border: none;
        width: 100%;
    }

    .data-container thead {
        display: none;
    }
    
    .data-container tr {
        display: block;
        margin-bottom: 25px; /* فاصله بیشتر بین کارت‌ها */
        padding: 20px;
        box-shadow: var(--shadow-light); /* استفاده از سایه نئومورفیک اصلی */
        border-radius: 15px; /* گردی بیشتر */
        border: none;
    }

    .data-container td {
        display: flex;
        justify-content: space-between;
        align-items: center;
        text-align: right;
        padding: 10px 0;
        border-bottom: 1px dotted var(--color-text-secondary);
    }
    
    .data-container tr td:last-child {
        border-bottom: none;
    }

    /* استایل برچسب (Label) */
    .data-container td::before {
        content: attr(data-label);
        font-weight: 700;
        color: var(--color-text-primary);
        /* عرض ثابت برای برچسب */
        min-width: 120px; 
        text-align: right;
        margin-left: 10px;
    }
    
    /* تنظیم نهایی برای ستون عملیات */
    .data-container td[data-label="عملیات"] {
        display: block;
        text-align: center;
        padding-top: 20px;
        border-bottom: none;
    }
    
    /* استایل دکمه‌ها در حالت عملیات موبایل */
    .data-container td[data-label="عملیات"] .btn {
        display: block; /* هر دکمه در خط خودش */
        width: 90%;
        margin: 8px auto;
        padding: 10px 15px;
    }
}

/* اعمال تغییرات سایدبار و دکمه تاگل برای 992px تا 768px */
@media (min-width: 769px) and (max-width: 991.98px) {
    /* اگر می‌خواهید در این بازه (تبلت‌ها) رفتار متفاوتی داشته باشد، اینجا اضافه کنید. 
       در غیر این صورت، منطق دسکتاپ (بخش اول) اعمال می‌شود. */
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
    <h1>لیست کاربران</h1>

    @if(session('success'))
        <div class="success-message">{{ session('success') }}</div>
    @endif

    <div class="data-container">
        <table>
            <thead>
                <tr>
                    <th>نام</th>
                    <th>ایمیل</th>
                    <th>عملیات</th>
                </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td data-label="نام">{{ $user->name }}</td>
                    <td data-label="ایمیل">{{ $user->email }}</td>
                    <td data-label="عملیات">
                        <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-edit">✏️ ویرایش</a>
                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" style="display:inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-delete" onclick="return confirm('آیا مطمئن هستید؟')">🗑️ حذف</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div style="margin-top: 25px;">
        {{ $users->links() }}
    </div>
</div>

<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('open');
        const content = document.querySelector(".content");
        const toggleBtn = document.getElementById("toggle-btn");
        
        if (sidebar.classList.contains('open')) {
            content.style.marginRight = '220px';
            toggleBtn.style.right = '220px';
        } else {
            content.style.marginRight = window.innerWidth <= 768 ? '0' : '60px';
            toggleBtn.style.right = window.innerWidth <= 768 ? '15px' : '60px';
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        const sidebar = document.getElementById("sidebar");
        const content = document.querySelector(".content");
        const toggleBtn = document.getElementById("toggle-btn");
        if (sidebar.classList.contains('open')) {
            content.style.marginRight = '220px';
            toggleBtn.style.right = '220px';
        } else {
            content.style.marginRight = window.innerWidth <= 768 ? '0' : '60px';
            toggleBtn.style.right = window.innerWidth <= 768 ? '15px' : '60px';
        }
    });
</script>

</body>
</html>
