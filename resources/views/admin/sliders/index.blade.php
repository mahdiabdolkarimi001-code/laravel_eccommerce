<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>مدیریت اسلایدرها</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- استفاده از فونت Vazirmatn و استایل‌های تم روشن -->
    <style>
        @import url('https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn/v1.2.1/dist/font-face.css');

        body {
            background-color: #f4f7f9; /* پس‌زمینه تم روشن */
            color: #333;
            font-family: 'Vazirmatn', sans-serif;
            min-height: 100vh;
            padding: 2rem;
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
            background-color: #007bff; /* رنگ آبی اصلی */
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
            transition: margin-right 0.3s ease;
            margin-right: 60px;
            max-width: 1200px;
            margin-left: auto;
            margin-bottom: 100px;
        }

        #sidebar.open ~ .content {
            margin-right: 200px;
        }

        h3 {
            text-align: center;
            margin-bottom: 2rem;
            font-weight: 700;
            color: #007bff; /* رنگ عنوان آبی */
            text-shadow: 0 0 8px rgba(0,123,255,0.1);
        }

        .btn-success {
            background-color: #28a745; /* رنگ سبز اصلی */
            border: none;
            font-weight: 600;
            box-shadow: 0 4px 10px rgba(40, 167, 69, 0.4);
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }

        .btn-success:hover {
            background-color: #1e7e34;
            box-shadow: 0 6px 14px rgba(30, 126, 52, 0.5);
        }

        .btn-primary {
            background-color: #0d6efd;
            border: none;
            font-weight: 600;
            box-shadow: 0 3px 8px rgba(13, 110, 253, 0.4);
            color: #fff;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
            margin-inline-end: 0.3rem;
        }

        .btn-primary:hover {
            background-color: #084ec9;
            box-shadow: 0 5px 14px rgba(8, 78, 201, 0.5);
        }

        .btn-danger {
            background-color: #dc3545;
            border: none;
            font-weight: 600;
            box-shadow: 0 3px 8px rgba(220, 53, 69, 0.4);
            color: #fff;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }

        .btn-danger:hover {
            background-color: #a71d2a;
            box-shadow: 0 5px 14px rgba(167, 29, 42, 0.5);
        }

        /* فرم حذف دکمه‌ها inline */
        form.d-inline {
            display: inline-block;
            margin: 0;
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
        <h3>لیست اسلایدرها</h3>
        <div class="d-flex justify-content-start mb-4">
            <a href="{{ route('admin.sliders.create') }}" class="btn btn-success" style="padding: 10px 20px;">افزودن اسلایدر</a>
        </div>

        <!-- کارت‌ها -->
        <div class="row">
            @foreach($sliders as $slider)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <img src="{{ asset('storage/' . $slider->image) }}" alt="تصویر اسلایدر" class="card-img-top" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $slider->title }}</h5>
                        <p class="card-text">
                            <a href="{{ $slider->link }}" target="_blank" class="text-decoration-none text-primary">
                                {{ $slider->link }}
                            </a>
                        </p>
                        <p class="card-text">
                            <span class="badge bg-{{ $slider->active ? 'success' : 'warning' }}" style="font-size: 0.85em;">
                                {{ $slider->active ? 'فعال' : 'غیرفعال' }}
                            </span>
                        </p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <a href="{{ route('admin.sliders.edit', $slider->id) }}" class="btn btn-sm btn-primary">ویرایش</a>
                                <form action="{{ route('admin.sliders.destroy', $slider->id) }}" method="POST" class="d-inline" onsubmit="return confirm('آیا مطمئن هستید که می‌خواهید حذف کنید؟')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">حذف</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @if(count($sliders) === 0)
            <div class="col-12">
                <div class="alert alert-warning text-center" role="alert">
                    هیچ اسلایدری یافت نشد.
                </div>
            </div>
            @endif
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // تابع جاوااسکریپت برای تغییر حالت سایدبار (مشابه کد قبلی)
        function toggleSidebar() {
            const sidebar = document.getElementById("sidebar");
            sidebar.classList.toggle("open");
            // اگر نیاز به تنظیم خودکار مارجین محتوا باشد، اینجا اضافه می‌شود
            const content = document.querySelector(".content");
            if (sidebar.classList.contains("open")) {
                content.style.marginRight = '200px';
            } else {
                content.style.marginRight = '60px';
            }
        }
        
        // اطمینان از اینکه سایدبار در حالت باز (open) با استایل اصلی لود شود
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('sidebar').classList.add('open');
            toggleSidebar(); // فراخوانی مجدد برای تنظیم margin اولیه در صورت نیاز
        });
    </script>
</body>

</html>
