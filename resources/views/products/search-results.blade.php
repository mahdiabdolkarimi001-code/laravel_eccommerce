<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نتایج جستجو - {{ $query }}</title>

    <!-- Bootstrap 5 (RTL) - Used for basic grid and utility classes -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    <!-- Custom Styling for Premium UX/UI -->
    <style>
        :root {
            --primary-color: #007bff; /* Professional Blue */
            --secondary-color: #6c757d;
            --bg-light: #f7f9fc; /* Very light, almost white background for content separation */
            --card-bg: #ffffff;
            --border-color: #e9ecef;
            --text-dark: #1a1a1a;
        }

        body {
            background-color: var(--bg-light);
            font-family: 'Tahoma', 'Vazirmatn', sans-serif;
            color: var(--text-dark);
            /* Added padding-top to account for the fixed Navbar height */
            padding-top: 4.5rem; 
        }

        /* --- Navbar Styling --- */
        .navbar {
            background-color: var(--card-bg);
            border-bottom: 1px solid var(--border-color);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.07);
        }
        .navbar-brand {
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--primary-color) !important;
        }
        .nav-link {
            color: #495057 !important;
            font-weight: 500;
            transition: color 0.2s;
        }
        .nav-link:hover {
            color: var(--primary-color) !important;
        }
        .navbar-nav .nav-link {
            padding-right: 1rem; /* Spacing for RTL menus */
        }

        /* --- Global Components --- */
        .page-title {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 1.5rem;
        }

        /* --- Sorting Bar --- */
        .sort-bar {
            background-color: var(--card-bg);
            border-radius: 0.75rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
            padding: 0.75rem 1.5rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: flex-start; /* Keep sort on the right in RTL */
        }
        .sort-label {
            font-weight: 600;
            color: var(--secondary-color);
            margin-left: 1rem;
        }
        .sort-bar .btn {
            border-radius: 0.5rem;
            margin-left: 0.5rem;
            transition: all 0.2s ease;
            font-size: 0.9rem;
        }
        .sort-bar .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        .sort-bar .btn-outline-primary {
            border-color: #adb5bd;
            color: #495057;
        }
        .sort-bar .btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        /* --- Filter Sidebar (RTL Right) --- */
        .filter-sidebar {
            position: sticky;
            top: 5.5rem; /* Adjusted to sit below the fixed Navbar */
            padding: 1.5rem;
            background-color: var(--card-bg);
            border-radius: 1rem;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.05);
            height: fit-content;
        }
        .filter-group-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid var(--primary-color);
            display: flex;
            align-items: center;
        }
        .form-check-label {
            font-size: 0.95rem;
            cursor: pointer;
        }
        .filter-sidebar .form-check-input:checked {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        /* Price Range Styling */
        .price-input-group .form-control {
            border-radius: 0.5rem;
            font-size: 0.9rem;
        }
        .price-input-group label {
            font-weight: 500;
            margin-bottom: 0.3rem;
        }
        .apply-filter-btn {
            border-radius: 0.5rem;
            background-color: #28a745; /* Success green for action */
            border-color: #28a745;
            transition: background-color 0.2s;
        }
        .apply-filter-btn:hover {
            background-color: #218838;
        }

        /* --- Product Card --- */
        .product-card {
            background-color: var(--card-bg);
            border-radius: 1rem;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 1px solid var(--border-color);
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        .product-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.12);
        }
        .product-card-image-container {
            height: 220px; /* Fixed height for image area */
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #fafafa;
            overflow: hidden;
        }
        .product-card img {
            max-height: 100%;
            max-width: 100%;
            object-fit: contain;
        }
        .card-body-content {
            padding: 1.25rem;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }
        .product-title {
            font-size: 1.05rem;
            font-weight: 600;
            line-height: 1.4;
            min-height: 48px; /* Ensures titles of different lengths align cards */
            margin-bottom: 0.5rem;
        }
        .product-price {
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }
        .product-price .currency {
            font-size: 1rem;
            font-weight: 500;
            color: var(--secondary-color);
        }

        /* --- Pagination --- */
        .pagination .page-link {
            border-radius: 0.5rem !important;
            border-color: var(--border-color);
            color: var(--text-dark);
        }
        .pagination .page-item.active .page-link {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        /* --- Responsive Adjustments --- */
        @media (max-width: 991.98px) {
            /* On tablets/small desktops, filters move above the products */
            .filter-sidebar {
                position: static; /* Remove stickiness */
                margin-bottom: 1.5rem;
                padding: 1.2rem;
            }
            .sort-bar {
                flex-direction: column;
                align-items: flex-start;
            }
            .sort-bar .sort-label {
                margin-left: 0;
                margin-bottom: 0.5rem;
            }
            .sort-bar .btn {
                margin-left: 0.3rem;
            }
        }
        @media (max-width: 575.98px) {
            .product-card:hover {
                transform: none; /* Disable hover lift on small screens for stability */
                box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
            }
        }
    </style>
</head>
<body>

    <!-- TOP NAVIGATION BAR (Updated for static links) -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container-fluid px-4">
            <!-- Brand Name -->
            <a class="navbar-brand" href="#">
                <i class="fa-solid fa-microchip ms-2"></i>
                تکنوآرا
            </a>
            
            <!-- Search Bar (Centered on desktop) -->
            <div class="flex-grow-1 mx-4 d-none d-lg-block">
                <form method="GET" action="/search-results-placeholder" class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="جستجوی محصول، برند یا دسته‌بندی..." value="{{ $query }}">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </form>
            </div>

            <!-- Toggler & Icons -->
            <div class="d-flex align-items-center">
                <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="d-flex align-items-center me-3">
                    <!-- User Icon -->
                    <a href="/profile-placeholder" class="nav-link me-2 d-none d-md-inline-block" title="حساب کاربری">
                        <i class="fa-solid fa-user fa-lg"></i>
                    </a>
                    <!-- Cart Icon -->
                    <a href="/cart-placeholder" class="nav-link position-relative me-2" title="سبد خرید">
                        <i class="fa-solid fa-cart-shopping fa-lg"></i>
                        <!-- Placeholder for cart count (Backend Syntax) -->
                        <span class="position-absolute top-0 start-0 translate-middle badge rounded-pill bg-danger">
                            {{-- @if($cartItemsCount > 0) {{ $cartItemsCount }} @else 0 @endif --}}
                            0 
                        </span>
                    </a>
                </div>
            </div>

            <!-- Collapsed Menu Items (Visible on small screens) -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav w-100 justify-content-end">
                    <li class="nav-item">
                        <a class="nav-link" href="/">صفحه اصلی</a>
                    </li>
                    <!-- Category Links (Example structure) -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownCategories" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            دسته‌بندی‌ها
                        </a>
                        <ul class="dropdown-menu dropdown-menu-start" aria-labelledby="navbarDropdownCategories">
                            <li><a class="dropdown-item" href="/category/laptops">لپ تاپ</a></li>
                            <li><a class="dropdown-item" href="/category/mobiles">گوشی هوشمند</a></li>
                            <li><a class="dropdown-item" href="/category/accessories">لوازم جانبی</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/contact-placeholder">تماس با ما</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content Area -->
    <div class="container-fluid px-4">

        <!-- Header and Title -->
        <h1 class="page-title">نتایج جستجو</h1>
        <p class="text-muted mb-3">شما در حال مشاهده نتایج برای: <strong class="text-dark">"{{ $query }}"</strong></p>

        <!-- Sorting/Control Bar -->
        <div class="sort-bar">
            <span class="sort-label">مرتب‌سازی بر اساس:</span>
            <form method="GET" class="d-flex flex-wrap">
                <!-- Hidden inputs for all current queries except sort/page -->
                @foreach(request()->except('sort', 'page') as $key => $value)
                    @if(is_array($value))
                        @foreach($value as $v)
                            <input type="hidden" name="{{ $key }}[]" value="{{ $v }}">
                        @endforeach
                    @else
                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                    @endif
                @endforeach

                <button type="submit" name="sort" value="newest"
                    class="btn {{ request('sort') == 'newest' || !request('sort') ? 'btn-primary' : 'btn-outline-primary' }}">
                    <i class="fa-solid fa-clock-rotate-left ms-1"></i> جدیدترین
                </button>

                <button type="submit" name="sort" value="cheapest"
                    class="btn {{ request('sort') == 'cheapest' ? 'btn-primary' : 'btn-outline-primary' }}">
                    <i class="fa-solid fa-arrow-down-up-across-line ms-1"></i> ارزان‌ترین
                </button>

                <button type="submit" name="sort" value="expensive"
                    class="btn {{ request('sort') == 'expensive' ? 'btn-primary' : 'btn-outline-primary' }}">
                    <i class="fa-solid fa-arrow-up-down-left-right ms-1"></i> گران‌ترین
                </button>
            </form>
        </div>


        <div class="row">
            <!-- Filter Sidebar (Column 3/12 on Large Screens - RTL: Right) -->
            <div class="col-lg-3 col-md-12">
                <form method="GET" action="/filter-placeholder">
                    <div class="filter-sidebar">
                        <input type="hidden" name="q" value="{{ $query }}">
                        
                        <!-- Brand Filter -->
                        <div class="mb-4">
                            <div class="filter-group-title"><i class="fa-solid fa-boxes-stacked ms-2"></i> برندها</div>
                            @foreach($brands as $brand)
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" name="brand[]" value="{{ $brand }}"
                                        id="brand_{{ $loop->index }}"
                                        {{ is_array(request('brand')) && in_array($brand, request('brand')) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="brand_{{ $loop->index }}">
                                        {{ $brand }}
                                    </label>
                                </div>
                            @endforeach
                        </div>

                        <hr class="my-4">

                        <!-- Price Filter -->
                        <div>
                            <div class="filter-group-title"><i class="fa-solid fa-money-bill-wave ms-2"></i> محدوده قیمت</div>
                            <div class="price-input-group mb-3">
                                <label class="form-label small" for="max_price_filter">حداکثر قیمت (تومان):</label>
                                <input type="number" name="max_price" id="max_price_filter" class="form-control"
                                    value="{{ request('max_price') }}" placeholder="{{ number_format($maxPrice) }}">
                            </div>
                            <div class="price-input-group mb-4">
                                <label class="form-label small" for="min_price_filter">حداقل قیمت (تومان):</label>
                                <input type="number" name="min_price" id="min_price_filter" class="form-control"
                                    value="{{ request('min_price') }}" placeholder="0">
                            </div>
                        </div>

                        <button type="submit" class="apply-filter-btn btn w-100 py-2 fw-bold">
                            <i class="fa-solid fa-filter ms-2"></i> اعمال فیلترها
                        </button>
                    </div>
                </form>
            </div>

            <!-- Products Grid (Column 9/12 on Large Screens - RTL: Left) -->
            <div class="col-lg-9 col-md-12">
                @if($products->count())
                    <div class="row g-4"> <!-- g-4 for better gutter spacing -->
                        @foreach($products as $product)
                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                                <div class="product-card shadow-sm">
                                    <!-- Image Area -->
                                    <div class="product-card-image-container">
                                        <!-- *** Backend Logic Kept Intact *** -->
                                        @if($product->image)
                                            <img src="{{ asset('storage/' . $product->image) }}" 
                                                 alt="{{ $product->title }}">
                                        @else
                                            <i class="fa-solid fa-image fa-3x text-secondary"></i>
                                        @endif
                                    </div>
                                    
                                    <div class="card-body-content">
                                        <!-- Title -->
                                        <h6 class="product-title text-truncate mb-2">{{ $product->title }}</h6>
                                        
                                        <!-- Price -->
                                        <div class="product-price mt-auto">
                                            {{ number_format($product->price) }}
                                            <span class="currency">تومان</span>
                                        </div>

                                        <!-- CTA -->
                                        <a href="/product/{{ $product->slug }}-placeholder" 
                                           class="btn btn-primary w-100 py-2 fw-bold">
                                            <i class="fa-solid fa-arrow-left-long ms-2"></i> مشاهده جزئیات
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-5">
                        <!-- *** Backend Logic Kept Intact *** -->
                        {{ $products->appends(request()->query())->links() }}
                    </div>
                @else
                    <div class="alert alert-light text-center py-5 mt-4 rounded-4 shadow-sm border-0">
                        <i class="fa-solid fa-ghost fa-3x text-secondary mb-3"></i>
                        <h5 class="fw-bold">محصولی یافت نشد</h5>
                        <p class="mb-0">تلاش کنید با فیلترها یا جستجوی دیگری محصول مورد نظر خود را پیدا کنید.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
