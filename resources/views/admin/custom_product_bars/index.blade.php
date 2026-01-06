<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مدیریت نوارهای دلخواه</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        /* استایل‌های کلی و فونت */
        body {
            background-color: #f0f2f5; /* پس‌زمینه کلی: خاکستری ملایم */
            font-family: 'Vazirmatn', sans-serif;
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

        /* دکمه سایدبار */
        #toggle-btn {
            position: fixed;
            top: 15px;
            right: 60px;
            width: 30px;
            height: 30px;
            background-color: #28a745; /* استفاده از رنگ سبز برای دکمه اصلی کنترلی */
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

        /* کارت محتوای اصلی */
        .custom-card {
            background: #ffffff; /* پس‌زمینه سفید برای کارت‌ها */
            border-radius: 1rem;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08); /* سایه نرم */
            padding: 1.5rem;
            margin-bottom: 1rem; /* فاصله بین کارت‌ها */
        }

        .card-header-custom {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .card-header-custom h4 {
            margin-bottom: 0;
            font-weight: 700;
            color: #333;
        }
        
        .bar-image {
            border-radius: 0.4rem;
            box-shadow: 0 0 5px rgba(0,0,0,0.1);
            object-fit: cover;
            width: 80px;
            height: 80px;
        }
        
        /* تنظیم حاشیه برای محتوای اصلی به دلیل وجود سایدبار ثابت */
        .main-content {
            padding-right: 75px; /* فاصله اولیه از سایدبار بسته */
            transition: padding-right 0.3s ease;
        }
        
        #sidebar.open + .main-content {
            padding-right: 210px; /* فاصله در حالت باز بودن سایدبار */
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

    <div class="main-content"> 
        <div class="container py-5">
            <div class="card-header-custom">
                <h4 class="mb-0">مدیریت نوارهای دلخواه</h4>
                <a href="{{ route('admin.custom-product-bars.create') }}" class="btn btn-success">ایجاد نوار جدید</a>
            </div>

            <div id="bars-list">
                @forelse($bars as $bar)
                    <div class="custom-card">
                        <div class="row align-items-center">
                            
                            {{-- ستون تصویر (ریسپانسیو) --}}
                            <div class="col-12 col-md-4 col-lg-2 mb-3 mb-md-0 text-center text-md-right">
                                 @if($bar->image)
                                    <img src="{{ asset('storage/' . $bar->image) }}" class="bar-image mx-auto d-block" alt="تصویر نوار">
                                @else
                                    <div class="bar-image bg-light d-flex align-items-center justify-content-center mx-auto d-block" style="width: 80px; height: 80px; border-radius: 0.4rem;">
                                        <span class="text-muted small">بدون تصویر</span>
                                    </div>
                                @endif
                            </div>

                            {{-- ستون محتوا (ریسپانسیو) --}}
                            <div class="col-12 col-md-4 mb-3 mb-md-0">
                                <h5 class="mb-1">{{ $bar->title }}</h5>
                                <p class="text-muted mb-0 small">اسلاگ: <code>{{ $bar->slug }}</code></p>
                            </div>
                            
                            {{-- ستون عملیات (ریسپانسیو) --}}
                            <div class="col-12 col-md-4 text-center text-md-left">
                                <div class="d-flex gap-2 justify-content-center justify-content-md-start flex-wrap">
                                    <a href="{{ route('admin.custom-product-bars.edit', $bar) }}" class="btn btn-primary btn-sm">ویرایش</a>
                                    <a href="{{ route('admin.custom-bars.products.select', $bar->id) }}" class="btn btn-warning btn-sm">افزودن محصول</a>
                                    <form action="{{ route('admin.custom-product-bars.destroy', $bar) }}" method="POST" onsubmit="return confirm('آیا از حذف اطمینان دارید؟')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">حذف</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="custom-card text-center">
                        <p class="text-muted mb-0">نوار دلخواهی یافت نشد.</p>
                    </div>
                @endforelse
            </div>

            <div class="d-flex justify-content-center mt-4">
                {{ $bars->links() }}
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

        <script>
        const sidebar = document.getElementById("sidebar");
        const toggleBtn = document.getElementById("toggle-btn");
        const mainContent = document.querySelector(".main-content");

        function toggleSidebar() {
            sidebar.classList.toggle("open");
            
            // تنظیم padding محتوای اصلی برای جابجایی هنگام باز و بسته شدن
            if (sidebar.classList.contains("open")) {
                mainContent.style.paddingRight = '210px'; 
                toggleBtn.style.right = '200px';
            } else {
                mainContent.style.paddingRight = '75px'; 
                toggleBtn.style.right = '60px';
            }
        }
        
        // تنظیم موقعیت اولیه بر اساس کلاس 'open' در HTML
        document.addEventListener('DOMContentLoaded', function() {
            if (sidebar.classList.contains("open")) {
                mainContent.style.paddingRight = '210px';
                toggleBtn.style.right = '200px';
            }
        });
    </script>

</body>
</html>
