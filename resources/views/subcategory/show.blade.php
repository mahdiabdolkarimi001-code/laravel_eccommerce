<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>محصولات زیرشاخه - @yield('title', 'کاتالوگ')</title>
    
    {{-- External CSS Links --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    
    <style>
        /* --- Custom Styling for Consistency (Adapted from previous design) --- */
        :root {
            --primary-color: #007bff; /* Professional Blue */
            --secondary-color: #6c757d;
            --bg-light: #f7f9fc; /* Very light, almost white background for content separation */
            --card-bg: #ffffff;
            --border-color: #e9ecef;
            --text-dark: #1a1a1a;
        }

        body {
            background-color: var(--bg-light) !important; 
            font-family: 'Tahoma', sans-serif; 
        }

        /* --- Navigation Bar Styling (New Integration) --- */
        .navbar-custom {
            background-color: var(--card-bg);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            border-bottom: 1px solid var(--border-color);
        }
        .navbar-brand-custom {
            font-weight: 900;
            color: var(--primary-color) !important;
            font-size: 1.5rem;
        }
        .search-form .input-group {
            max-width: 500px;
        }
        .search-form .form-control {
            border-top-right-radius: 0.5rem !important;
            border-bottom-right-radius: 0.5rem !important;
            border-top-left-radius: 0 !important;
            border-bottom-left-radius: 0 !important;
        }
        .search-form .btn-search {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            border-top-left-radius: 0.5rem !important;
            border-bottom-left-radius: 0.5rem !important;
            border-top-right-radius: 0 !important;
            border-bottom-right-radius: 0 !important;
            color: white;
        }
        .nav-link-custom {
            color: var(--text-dark);
            font-size: 0.95rem;
            transition: color 0.2s;
        }
        .nav-link-custom:hover {
            color: var(--primary-color);
        }

        /* --- Rest of the Page Styles --- */
        .container-fluid.mt-4 {
            padding-left: 1.5rem;
            padding-right: 1.5rem;
        }
        
        .sort-buttons {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 0.5rem;
        }
        .sort-buttons .btn {
            border-radius: 0.5rem;
            transition: all 0.2s ease;
            font-size: 0.9rem;
        }
        .sort-buttons .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        .sort-buttons .btn-outline-primary {
            border-color: #adb5bd;
            color: #495057;
        }
        .sort-buttons .btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        .breadcrumb-nav {
            font-size: 0.95rem;
            color: var(--secondary-color);
            margin-bottom: 1.5rem;
        }
        .breadcrumb-nav a {
            color: var(--primary-color);
            text-decoration: none;
        }
        .breadcrumb-nav span {
            margin: 0 0.3rem;
        }

        .filter-box {
            background-color: var(--card-bg);
            border-radius: 1rem;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.05);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }
        .filter-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid var(--primary-color);
            display: flex;
            align-items: center;
        }
        .filter-box .form-check-label {
            font-size: 0.95rem;
            cursor: pointer;
        }
        .filter-box .form-check-input:checked {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .product-card {
            background-color: var(--card-bg);
            border-radius: 1rem;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 1px solid var(--border-color);
            height: 100%;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04) !important;
        }
        .product-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.12) !important;
        }
        .card-body {
            padding: 1.25rem !important;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .card-title {
            font-size: 1.05rem !important;
            font-weight: 600 !important;
            line-height: 1.4;
            min-height: 48px;
            margin-bottom: 0.75rem !important;
        }
        .text-primary.fw-bold {
            font-size: 1.35rem !important;
            color: var(--primary-color) !important;
            font-weight: 700 !important;
        }
        
        @media (min-width: 768px) and (max-width: 991.98px) {
            .col-lg-4 {
                flex: 0 0 50%;
                max-width: 50%;
            }
        }
        
        .pagination .page-link {
            border-radius: 0.5rem !important;
            border-color: var(--border-color);
            color: var(--text-dark);
        }
        .pagination .page-item.active .page-link {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
    </style>
</head>
<body>

    <!-- نوار ناوبری (Navigation Bar) با قابلیت جستجو -->
    <nav class="navbar navbar-expand-lg navbar-light navbar-custom sticky-top">
        <div class="container-fluid">
            {{-- Brand/Logo --}}
            <a class="navbar-brand navbar-brand-custom" href="/placeholder-home-link">
                <i class="fa-solid fa-store ms-2"></i>فروشگاه من
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom" href="/placeholder-home-link">صفحه اصلی</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom" href="/placeholder-about-link">درباره ما</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom" href="/placeholder-contact-link">تماس با ما</a>
                    </li>
                </ul>
                
                {{-- Product Search Form (Integrated) --}}
                <form class="d-flex search-form mx-3 w-100 justify-content-center" method="GET" action="/placeholder-search-action">
                    {{-- Action and name attributes are placeholders --}}
                    <div class="input-group">
                        <input class="form-control" type="search" placeholder="جستجوی محصول..." aria-label="Search" name="q" style="border-right: none;">
                        <button class="btn btn-search" type="submit">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>
                </form>
                
                {{-- User Icons Placeholder (e.g., Cart, Profile) --}}
                <div class="d-flex align-items-center ms-3">
                    <a href="/placeholder-cart-link" class="btn btn-outline-secondary me-2 rounded-circle" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </a>
                    <a href="/placeholder-profile-link" class="btn btn-outline-secondary rounded-circle" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                        <i class="fa-solid fa-user"></i>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- محتوای اصلی صفحه -->
    <div class="container-fluid mt-4">
        <!-- عنوان و مرتب‌سازی -->
        <div class="d-flex justify-content-between align-items-center mb-2 flex-wrap">
            <h1 class="page-title" style="font-size: 2rem; font-weight: 700; color: var(--text-dark); margin-bottom: 0;">
                محصولات زیرشاخه: {{ $subcategory->name ?? 'نام زیرشاخه' }}
            </h1>

            <form method="GET" class="sort-buttons">
                {{-- Logic for sorting --}}
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

        <!-- Breadcrumb -->
        <div class="breadcrumb-nav mb-4">
            {{-- Route replaced with placeholder --}}
            <a href="/placeholder-home-link">صفحه اصلی</a> <span>›</span>
            <span>زیرشاخه‌ها</span> <span>›</span>
            <span>{{ $subcategory->name ?? 'نام زیرشاخه' }}</span>
        </div>

        <div class="row">
            <!-- ستون فیلتر (راست - 3/12) -->
            <div class="col-lg-3 col-md-12">
                <form method="GET">
                    {{-- Hidden fields for filtering --}}
                    <input type="hidden" name="category_id" value="{{ $subcategory->id ?? 'ID_PLACEHOLDER' }}">
                    @foreach(request()->except(['sort', 'page', 'min_price', 'max_price', 'brand']) as $key => $value)
                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                    @endforeach
                    
                    <!-- فیلتر برند -->
                    <div class="filter-box">
                        <div class="filter-title"><i class="fa-solid fa-boxes-stacked ms-2"></i> برندها</div>
                        @foreach($brands ?? ['Brand A', 'Brand B', 'Brand C'] as $brand)
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" name="brand[]"
                                       value="{{ $brand }}"
                                       id="brand_{{ $loop->index }}"
                                       {{ is_array(request('brand')) && in_array($brand, request('brand')) ? 'checked' : '' }}>
                                <label class="form-check-label" for="brand_{{ $loop->index }}">
                                    {{ $brand }}
                                </label>
                            </div>
                        @endforeach
                    </div>

                    <!-- فیلتر قیمت -->
                    <div class="filter-box">
                        <div class="filter-title"><i class="fa-solid fa-money-bill-wave ms-2"></i> محدوده قیمت</div>
                        <div class="mb-3">
                            <label class="form-label small" for="min_price_filter">حداقل قیمت (تومان):</label>
                            <input type="number" name="min_price" id="min_price_filter" class="form-control"
                                value="{{ request('min_price') }}" placeholder="0">
                        </div>
                        <div class="mb-4">
                            <label class="form-label small" for="max_price_filter">
                                حداکثر قیمت (حداکثر: {{ number_format($maxPrice ?? 99999999) }} تومان)
                            </label>
                            <input type="number" name="max_price" id="max_price_filter" class="form-control"
                                value="{{ request('max_price') }}" placeholder="{{ $maxPrice ?? '...' }}">
                        </div>
                    </div>

                    <button type="submit" class="apply-filter-btn btn w-100 py-2 fw-bold" style="background-color: #28a745; border-color: #28a745;">
                        <i class="fa-solid fa-filter ms-2"></i> اعمال فیلترها
                    </button>
                </form>
            </div>

            <!-- ستون محصولات (چپ - 9/12) -->
            <div class="col-lg-9 col-md-12">
                @if(($products->count ?? 0) > 0)
                    <div class="row g-4">
                        @foreach($products ?? [
                            (object)['slug' => 'product-1', 'title' => 'محصول نمونه اول با جزئیات زیاد', 'price' => 1500000, 'image' => 'placeholder/img1.jpg'],
                            (object)['slug' => 'product-2', 'title' => 'محصول نمونه دوم', 'price' => 2500000, 'image' => 'placeholder/img2.jpg'],
                            (object)['slug' => 'product-3', 'title' => 'محصول نمونه سوم (کوتاه)', 'price' => 950000, 'image' => 'placeholder/img3.jpg'],
                            (object)['slug' => 'product-4', 'title' => 'محصول نمونه چهارم با عنوان طولانی تر برای تست الینمنت', 'price' => 4200000, 'image' => 'placeholder/img4.jpg']
                        ] as $product)
                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                                <a href="/product/{{ $product->slug }}-placeholder" class="text-decoration-none text-dark">
                                    <div class="product-card shadow-sm">
                                        <!-- Image Area -->
                                        <div class="product-card-image-container" style="height: 220px; display: flex; align-items: center; justify-content: center; background-color: #fafafa; overflow: hidden;">
                                            @if($product->image)
                                                <img src="{{ asset('storage/' . $product->image) }}" 
                                                     alt="{{ $product->title }}"
                                                     style="max-height: 100%; max-width: 100%; object-fit: contain;">
                                            @else
                                                <i class="fa-solid fa-image fa-3x text-secondary"></i>
                                            @endif
                                        </div>
                                        
                                        <div class="card-body text-center">
                                            <!-- Title -->
                                            <h6 class="card-title" style="font-size: 1.05rem; font-weight: 600; line-height: 1.4; min-height: 48px; margin-bottom: 0.75rem;">
                                                {{ $product->title }}
                                            </h6>
                                            
                                            <!-- Price -->
                                            <div class="text-primary fw-bold mt-2">
                                                {{ number_format($product->price) }}
                                                <span class="text-muted" style="font-size: 0.9rem; font-weight: 500;">تومان</span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-5">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <li class="page-item disabled"><a class="page-link" href="#">قبلی</a></li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">بعدی</a></li>
                            </ul>
                        </nav>
                    </div>
                @else
                    <div class="alert alert-light text-center py-5 mt-4 rounded-4 shadow-sm border-0" style="background-color: var(--card-bg); border: 1px solid var(--border-color);">
                        <i class="fa-solid fa-ghost fa-3x text-secondary mb-3"></i>
                        <h5 class="fw-bold">محصولی یافت نشد</h5>
                        <p class="mb-0">تلاش کنید با فیلترها یا جستجوی دیگری محصول مورد نظر خود را پیدا کنید.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- JS Scripts Placeholder --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
