<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>مدیریت آیکن‌های دسته‌بندی</title>

    <!-- Bootstrap 5 RTL CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet" />

    <!-- فونت فارسی (Vazirmatn) -->
    <link href="https://cdn.jsdelivr.net/gh/rastikerdar/vazir-font@v30.1.0/dist/font-face.css" rel="stylesheet" />

    <!-- آیکون‌های Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Vazir', Tahoma, sans-serif;
            background-color: #f4f7f9;
            padding: 40px 20px;
            min-height: 100vh;
            color: #333;
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

        #toggle-btn {
            position: fixed;
            top: 15px;
            right: 60px;
            width: 30px;
            height: 30px;
            background-color: #0d6efd;
            border-radius: 4px 0 0 4px;
            border: none;
            color: white;
            font-weight: bold;
            cursor: pointer;
            transition: right 0.3s ease;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1100;
        }

        #sidebar.open ~ #toggle-btn {
            right: 200px;
        }

        .content {
            padding: 40px;
            transition: margin-right 0.3s ease;
            margin-right: 60px;
            max-width: 1400px;
            margin-left: auto;
            margin-bottom: 100px;
        }

        #sidebar.open ~ .content {
            margin-right: 200px;
        }

        h4 {
            font-weight: 800;
            font-size: 2.2rem;
            color: #343a40;
            margin-bottom: 35px;
        }

        .btn-add {
            background: linear-gradient(45deg, #007bff, #0a58ca);
            color: white;
            font-weight: 700;
            padding: 10px 25px;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(13, 110, 253, 0.5);
            transition: all 0.4s ease;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            border: none;
            text-decoration: none;
            font-size: 1rem;
        }

        .btn-add:hover {
            background: linear-gradient(45deg, #0a58ca, #007bff);
            box-shadow: 0 6px 20px rgba(13, 110, 253, 0.7);
            color: white;
        }

        .card-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 30px;
        }

        .category-card {
            background: #ffffff;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            overflow: hidden;
            border-top: 6px solid #ffc107;
            border-right: 1px solid #f0f0f0;
        }

        .category-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
        }

        .card-body-content {
            padding: 30px;
            text-align: center;
        }

        .icon-preview-lg {
            width: 90px;
            height: 90px;
            margin: 0 auto 20px auto;
            background-color: #f8f9fa;
            border-radius: 15px;
            display: flex;
            justify-content: center;
            align-items: center;
            border: 1px solid #eee;
        }

        .icon-preview-lg img {
            max-width: 60px;
            max-height: 60px;
            filter: drop-shadow(2px 2px 3px rgba(0,0,0,0.1));
        }

        .card-title-custom {
            font-weight: 800;
            font-size: 1.35rem;
            margin-bottom: 15px;
            color: #212529;
        }

        .card-footer-actions {
            border-top: 1px solid #f0f0f0;
            padding: 15px;
            background-color: #ffffff;
            display: flex;
            justify-content: space-around;
        }

        .btn-text-action {
            font-weight: 600;
            border-radius: 6px;
            padding: 8px 15px;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 5px;
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

    <!-- دکمه باز/بسته کردن -->
    <button id="toggle-btn" onclick="toggleSidebar()">☰</button>

    <div class="content">
        <h4>مدیریت آیکن‌های دسته‌بندی</h4>
        <a href="{{ route('admin.category_icons.create') }}" class="btn btn-add mb-5">
            <i class="bi bi-plus-lg"></i> افزودن آیکن جدید
        </a>

        <div class="card-container">
            @foreach($category_icons as $icon)
                <div class="category-card">
                    <div class="card-body-content">
                        <div class="icon-preview-lg">
                            <img src="{{ asset('storage/' . $icon->image) }}" alt="{{ $icon->name }}" />
                        </div>
                        <h5 class="card-title-custom">{{ $icon->name }}</h5>
                    </div>
                    <div class="card-footer-actions">
                        <a href="{{ route('admin.category_icons.edit', $icon->slug) }}" class="btn btn-outline-primary btn-text-action" title="ویرایش">
                            <i class="bi bi-pencil-square"></i>
                            <span>ویرایش</span>
                        </a>

                        <form action="{{ route('admin.category_icons.destroy', $icon->slug) }}" method="POST" onsubmit="return confirm('آیا مطمئن هستید که می‌خواهید آیکن «{{ $icon->name }}» را حذف کنید؟')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-text-action" title="حذف">
                                <i class="bi bi-trash"></i>
                                <span>حذف</span>
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach

            @if($category_icons->isEmpty())
                <div class="col-12 text-center p-5 bg-white rounded shadow-sm" style="border-radius: 15px; border: 1px solid #ddd;">
                    <i class="bi bi-info-circle" style="font-size: 2.5rem; color: #6c757d;"></i>
                    <p class="mt-3 mb-0 text-muted" style="font-size: 1.1rem;">هیچ آیکنی ثبت نشده است. لطفاً با زدن دکمه آبی رنگ، اولین آیکن را اضافه کنید.</p>
                </div>
            @endif
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function toggleSidebar() {
        const sidebar = document.getElementById("sidebar");
        sidebar.classList.toggle("open");

        const content = document.querySelector(".content");
        if (sidebar.classList.contains("open")) {
            content.style.marginRight = "200px";
            document.getElementById("toggle-btn").style.right = "200px";
        } else {
            content.style.marginRight = "60px";
            document.getElementById("toggle-btn").style.right = "60px";
        }

        const navLinks = sidebar.querySelectorAll('a');
        navLinks.forEach(link => {
            if (link.href.includes('category_icons')) {
                link.classList.add('active');
            }
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.getElementById('sidebar');
        const toggleBtn = document.getElementById('toggle-btn');

        if (sidebar.classList.contains('open')) {
            toggleBtn.style.right = '60px';
        } else {
            toggleBtn.style.right = '60px';
        }

        sidebar.querySelectorAll('a').forEach(link => {
            if (link.href.includes('category_icons')) {
                link.classList.add('active');
            }
        });
    });
</script>

</body>
</html>
