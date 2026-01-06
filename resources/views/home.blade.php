<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>فروشگاه حرفه‌ای - صفحه اصلی</title>

    {{-- Bootstrap 5 CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Font Awesome for Icons (as used in your footer) --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    {{-- Owl Carousel CSS (Required for your product bars) --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

    {{-- Custom & Enhanced Styles --}}
    <style>
        /* --- 1. Global & Typography Setup --- */
        :root {
            --primary-color: #007bff; /* Brand Blue */
            --success-color: #28a745; /* Green for Price */
            --danger-color: #dc3545; /* Red for Discount/Badge */
            --dark-bg: #1a1a1a;
            --light-text: #f8f9fa;
            --card-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            --transition-fast: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        body {
            font-family: 'Vazirmatn', 'Tahoma', sans-serif; /* Assume Vazirmatn or similar modern font */
            background-color: #f7f9fc; /* Very light off-white background */
            color: #333;
        }

        .container, .container-fluid {
            max-width: 1400px; /* Slightly wider container for large screens */
        }

        /* --- 2. Product Card Styling (Refined) --- */
        .product-card {
            background-color: #ffffff;
            border-radius: 8px;
            height: 100%;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            box-shadow: var(--card-shadow);
            transition: var(--transition-fast);
            border: 1px solid #eeeeee;
        }

        .product-card:hover {
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            transform: translateY(-5px); /* Slightly more lift */
        }

        .product-card img {
            height: 200px;
            object-fit: cover;
            width: 100%;
            transition: transform 0.3s ease-in-out;
        }
        
        .product-card:hover img {
             transform: scale(1.03);
        }

        .product-card .p-2 {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between; /* Pushes price to bottom */
            padding: 10px !important;
        }

        .product-card h6 {
            min-height: 40px; /* Minimum height for title consistency */
            font-size: 0.95rem;
            font-weight: 600;
            margin-bottom: 5px;
        }

        /* Pricing Display */
        .price-container {
            padding-top: 10px;
            border-top: 1px dashed #e0e0e0;
            display: flex;
            flex-direction: column;
        }
        
        .current-price {
            color: var(--success-color);
            font-size: 1.25rem; /* Slightly larger */
            font-weight: 800;
            line-height: 1.2;
        }

        .old-price {
            color: #999;
            text-decoration: line-through;
            font-size: 0.85rem;
            display: block;
        }
        
        /* Discount Badge */
        .discount-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: var(--danger-color);
            color: white;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.8rem;
            font-weight: bold;
        }
        
        /* Owl Carousel Item Styling */
        .owl-carousel .item {
            padding: 10px;
        }


        /* --- 3. Main Slider Styling --- */
        .slider-img {
            height: 450px;
            object-fit: cover;
            border-radius: 10px;
            width: 100%;
        }
        .carousel-control-prev-icon, .carousel-control-next-icon {
             filter: brightness(0.5); /* Darker controls */
        }

        /* --- 4. Category Icons Grid --- */
        .category-icons-row > div {
            /* Base: 4 per row (25%) */
            flex: 1 1 calc(25% - 20px);
            max-width: calc(25% - 20px);
        }
        
        .category-icons-row img {
            width: 100px;
            height: 100px;
            border-radius: 15px;
            object-fit: cover;
            border: 3px solid transparent;
            transition: var(--transition-fast);
        }

        .category-icons-row > div:hover img {
            transform: scale(1.1) rotate(1deg); /* Subtle change */
            border-color: var(--primary-color);
            box-shadow: 0 5px 15px rgba(0, 123, 255, 0.2);
        }

        .category-icons-row p {
            margin-top: 10px;
            font-weight: 600;
            color: #555;
            font-size: 0.95rem;
        }
        /* Navbar */
        .navbar-custom {
            background-color: #ffffff;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            border-bottom: 1px solid #e9ecef;
        }

        .navbar-brand-custom {
            font-weight: 900;
            color: #007bff !important;
            font-size: 1.4rem;
        }

        .nav-link-custom {
            color: #1a1a1a;
            font-size: 0.95rem;
            transition: 0.2s;
        }

        .nav-link-custom:hover {
            color: #007bff;
        }

        /* Search */
        .search-form .input-group {
            max-width: 500px;
        }

        .search-form .form-control {
            border-radius: 0 0.5rem 0.5rem 0;
            border-right: none;
        }

        .search-form .btn-search {
            background-color: #007bff;
            border-color: #007bff;
            border-radius: 0.5rem 0 0 0.5rem;
            color: #fff;
        }

        /* Icons */
        .navbar-icon-btn {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
        }

        /* Responsive */
        @media (max-width: 991px) {
            .search-form {
                margin: 1rem 0;
            }
        }

        .subcategory-link {
            font-size: 13px;
            color: var(--primary-color);
            text-decoration: none;
            padding: 5px 10px; /* Increased padding */
            border-radius: 5px;
            transition: var(--transition-fast);
            margin: 3px 0; /* Added margin for spacing */
        }

        .subcategory-link:hover {
            background-color: var(--primary-color);
            color: #fff;
            transform: translateY(-1px);
        }

        /* --- 6. Discount Bar (Offers) --- */
        .discount-bar {
            background-color: var(--dark-bg);
            color: var(--light-text);
        }
        .discount-bar h5 {
            color: var(--light-text);
        }
        .discount-item {
            border: 1px solid #333;
            transition: var(--transition-fast);
        }
        .discount-item:hover {
            box-shadow: 0 0 15px rgba(255, 255, 255, 0.1);
            transform: translateY(-3px);
        }
        .discount-img {
            height: 150px;
            object-fit: cover;
        }
        .discount-price {
            color: var(--success-color);
            font-weight: 800;
            font-size: 1.1rem;
        }
        .discount-old-price {
            font-size: 0.8rem;
        }
        
        /* --- 7. Footer Styling (Modernized) --- */
        .footer {
            background-color: var(--dark-bg);
            color: var(--light-text);
        }
        .footer h6 {
            color: var(--danger-color); /* Footer titles in red accent */
        }
        .footer a {
            color: var(--light-text);
        }
        .footer a:hover {
            color: var(--danger-color);
        }
        .text-light-emphasis {
            color: #cccccc !important;
        }

        /* --- 8. Responsive Breakpoints (Adjusted for Better Flow) --- */

        /* Large/Tablet (Up to 992px) */
        @media (max-width: 992px) {
            /* Category Icons: 3 per row */
            .category-icons-row > div {
                flex: 1 1 calc(33.33% - 20px);
                max-width: calc(33.33% - 20px);
            }
            /* Mega Menu: Adjustments for smaller screens */
            .navbar-category-item strong { font-size: 13px; }
            .subcategory-link { font-size: 12px; }
            /* Product Cards in Carousels will adapt via JS */
        }

        /* Tablet/Mobile (Up to 768px) */
        @media (max-width: 768px) {
            /* Main Slider Height Reduction */
            .slider-img { height: 350px; }
            
            /* Category Icons: 2 per row */
            .category-icons-row > div {
                flex: 1 1 calc(50% - 15px);
                max-width: calc(50% - 15px);
            }
            
            /* Discount Bar: Display fewer items */
            .discount-card { flex: 0 0 45% !important; max-width: 45% !important; }
            .discount-slider .col-6 { padding-right: 5px; padding-left: 5px; }
        }

        /* Small Mobile (Up to 576px) */
        @media (max-width: 576px) {
            /* Main Slider Height Reduction */
            .slider-img { height: 250px; }
            
            /* Category Icons: Single column */
            .category-icons-row > div {
                flex: 1 1 100%;
                max-width: 100%;
            }
            
            /* Mega Menu: Stacked Items */
            .navbar-category-item {
                flex: 1 1 100%;
                margin-right: 0;
                margin-bottom: 10px;
            }
            .navbar-subcategories { justify-content: flex-start; }
            .subcategory-link { margin-right: 5px; margin-bottom: 5px; }
            
            /* Discount Bar: Single column scroll */
            .discount-card { flex: 0 0 60% !important; max-width: 60% !important; }
            .discount-slider .col-6 { padding-right: 5px; padding-left: 5px; }
        }
    </style>
</head>
<body class="antialiased">

<!-- Top Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom sticky-top">
    <div class="container-fluid">

        <!-- Logo -->
        <a class="navbar-brand fw-bold text-primary" href="/">فروشگاه</a>

        <!-- Toggle -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarContent" aria-controls="navbarContent"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Content -->
        <div class="collapse navbar-collapse" id="navbarContent">

            <!-- Search -->
            <form class="d-flex mx-lg-auto my-3 my-lg-0 w-100"
                  style="max-width:600px;"
                  method="GET"
                  action="{{ route('products.search') }}">

                <div class="input-group w-100">
                    <input
                        type="search"
                        name="query"
                        class="form-control"
                        placeholder="جستجوی محصولات..."
                        aria-label="Search">

                    <button class="btn btn-primary" type="submit">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>
            </form>

            <a href="/cart" class="btn btn-outline-secondary me-2 rounded-circle" style="width:40px;height:40px;display:flex;align-items:center;justify-content:center;">
                    <i class="fa-solid fa-cart-shopping"></i>
            </a>

            <!-- Auth -->
            <ul class="navbar-nav ms-lg-3 text-center">
                @auth
                    <li class="nav-item">
                        <form action="{{ route('auth.logout') }}" method="POST">
                            @csrf
                            <button type="submit"
                                    class="nav-link btn btn-link text-dark fw-bold p-0">
                                خروج
                            </button>
                        </form>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link text-dark fw-bold"
                           href="{{ route('auth.form') }}">
                            ورود / ثبت‌نام
                        </a>
                    </li>
                @endauth
            </ul>

        </div>
    </div>
</nav>

<!-- Navbar Categories Detailed Section (Mega Menu) 
@if(isset($navbarCategories) && $navbarCategories->count())
<div class="navbar-categories-bar">
    <div class="container d-flex flex-wrap align-items-start">

        @foreach($navbarCategories as $cat)
            <div class="navbar-category-item me-3 mb-2">
                <strong class="d-block mb-1">
                    {{ $cat->name }}
                </strong>

                @if($cat->subcategories && $cat->subcategories->count())
                    <div class="navbar-subcategories d-flex flex-wrap">

                        @foreach($cat->subcategories as $sub)
                            {{-- ارسال کل مدل Subcategory به Route --}}
                            <a href="{{ route('subcategory.products', ['subcategory' => $sub->id]) }}"
                               class="subcategory-link me-2 mb-1">
                                {{ $sub->name }}
                            </a>
                        @endforeach

                    </div>
                @endif

            </div>
        @endforeach

    </div>
</div>
@endif-->

{{-- Main Slider (Hero Section) --}}
@if(isset($sliders) && $sliders->count())
<div class="container mt-4">
    <div id="mainSlider" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach($sliders as $index => $slider)
                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                    <a href="{{ $slider->link ?? '#' }}">
                        <img
                            src="{{ asset('storage/' . $slider->image) }}"
                            class="d-block w-100 slider-img"
                            alt="{{ $slider->title }}"
                        >
                    </a>
                </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#mainSlider" data-bs-slide="prev">
            <span class="carousel-control-prev-icon bg-dark rounded-circle p-2 shadow-sm" aria-hidden="true"></span>
            <span class="visually-hidden">قبلی</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#mainSlider" data-bs-slide="next">
            <span class="carousel-control-next-icon bg-dark rounded-circle p-2 shadow-sm" aria-hidden="true"></span>
            <span class="visually-hidden">بعدی</span>
        </button>
    </div>
</div>
@endif

{{-- Category Icons Grid --}}
@if(isset($categoryIcons) && $categoryIcons->count())
    <div class="container mt-5">
        <div class="row text-center category-icons-row">
            @foreach($categoryIcons as $icon)
                <div class="col-6 col-md-3 col-lg-2 mb-4"> {{-- Adjusted columns for better 6-per-row on desktop if space allows --}}
                <a href="{{ route('category-icon.products', ['categoryIcon' => $icon->slug]) }}" class="text-decoration-none d-block">
                        <img src="{{ asset('storage/' . $icon->image) }}" class="img-fluid rounded" alt="{{ $icon->name }}">
                    <p class="mt-2">{{ $icon->name }}</p>
                </a>
                </div>
            @endforeach
        </div>
    </div>
@endif

<!-- Custom Product Bars (Owl Carousels) -->
@if(isset($customBars) && $customBars->count())
    <div class="container mt-5">
        @foreach($customBars as $bar)
            @if($bar->products && $bar->products->count())
                @php
                    $productsCount = $bar->products->count();
                @endphp
                {{-- نوار محصول --}}
                <div class="custom-product-bar mb-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="mb-0 fw-bold">{{ $bar->title }}</h4>
                    </div>
                    
                    {{-- اسلایدر Owl Carousel --}}
                    <div class="owl-carousel owl-theme" dir="rtl" data-products-count="{{ $productsCount }}">
                        @foreach($bar->products as $product)
                            <div class="item">
                                {{-- لینک اصلی محصول --}}
                                <a href="{{ route('products.show', $product->slug) }}" class="text-decoration-none h-100 d-block">
                                    <div class="product-card">
                                        
                                        {{-- ناحیه تصویر و تخفیف --}}
                                        <div style="position: relative;">
                                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->title }}" class="w-100">
                                            @if($product->discount)
                                                <div class="discount-badge">{{ $product->discount }}%</div>
                                            @endif
                                        </div>
                                        
                                        {{-- محتوای کارت --}}
                                        <div class="p-2">
                                            <h6 class="text-truncate text-dark mb-1">{{ $product->title }}</h6>
                                            
                                            <div class="price-container">
                                                @if($product->discount)
                                                    <span class="current-price">
                                                        {{ number_format($product->price_after_discount) }} ت
                                                    </span>
                                                    <span class="old-price">
                                                        {{ number_format($product->price) }} ت
                                                    </span>
                                                @else
                                                    <span class="current-price" style="color: #444444;">
                                                        {{ number_format($product->price) }} ت
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        @endforeach
    </div>
@endif

{{-- Discounted Products Bar (Full Width Emphasis) --}}
@if(isset($discountedProducts) && $discountedProducts->count())
<div class="container-fluid mt-5 px-0">
    <div class="py-4 discount-bar">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center mb-4 text-white">
                <h4 class="mb-0 fw-bold">آفرهای سایت</h4>
                <a href="{{ route('offers.index') }}" class="btn btn-outline-light btn-sm">مشاهده همه</a>
            </div>

            <div class="row overflow-hidden discount-slider g-3"> {{-- Added g-3 for gutter spacing --}}
                @foreach($discountedProducts->take(8) as $product)
                    <div class="col-6 col-sm-4 col-md-3 col-lg-2 discount-card"> {{-- More granular breakpoints --}}
                        <a href="{{ route('products.show', $product->slug) }}" class="text-decoration-none h-100">

                            <div class="discount-item bg-white text-dark rounded-4 overflow-hidden h-100 position-relative p-2">

                                <img
                                    src="{{ asset('storage/' . $product->image) }}"
                                    alt="{{ $product->title }}"
                                    class="w-100 rounded-3 discount-img"
                                >

                                @if($product->discount)
                                    <div class="discount-badge">
                                        {{ $product->discount }}%
                                    </div>
                                @endif

                                <div class="text-center mt-2">
                                    <div class="discount-price">
                                        {{ number_format($product->price_after_discount) }} ت
                                    </div>

                                    <small class="text-muted text-decoration-line-through discount-old-price">
                                        {{ number_format($product->price) }} ت
                                    </small>
                                </div>

                            </div>

                        </a>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
</div>
@endif

{{-- Latest Products (Simple Carousel) --}}
@if($latestProducts->count())
<div class="container mt-5 mb-5">
    <h4 class="text-dark mb-3 fw-bold">جدیدترین محصولات</h4>
    <div class="owl-carousel owl-theme" dir="rtl">
        @foreach($latestProducts as $product)
            <div class="item">
                <a href="{{ route('products.show', $product->slug) }}" class="text-decoration-none">
                    <div class="product-card">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->title }}" class="w-100">
                        @if($product->discount)
                            <div class="discount-badge">{{ $product->discount }}%</div>
                        @endif
                        <div class="p-2">
                            <h6 class="text-truncate text-dark mb-1">{{ $product->title }}</h6>
                            <div class="price-container">
                                @if($product->discount)
                                    <span class="current-price">
                                        {{ number_format($product->price_after_discount) }} ت
                                    </span>
                                    <small class="text-muted text-decoration-line-through d-block">
                                        {{ number_format($product->price) }} ت
                                    </small>
                                @else
                                    <span class="current-price" style="color: #444444;">
                                        {{ number_format($product->price) }} ت
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>
@endif

{{-- Footer --}}
<footer class="footer mt-auto">
    <div class="container py-5">
        <div class="row text-center text-md-start gy-4">

            <!-- About -->
            <div class="col-md-3">
                <h6 class="fw-bold mb-3">فروشگاه کامپیوترمارکت</h6>
                <p class="small text-light-emphasis">
                تخصصی‌ترین مرکز فروش لپ‌تاپ، لوازم جانبی، قطعات کامپیوتر و تجهیزات دیجیتال.
                ما با تضمین اصالت کالا، ارسال سریع و گارانتی معتبر کنار شما هستیم.
                </p>
            </div>

            <!-- Customer Services -->
            <div class="col-md-3">
                <h6 class="fw-bold mb-3">خدمات مشتریان</h6>
                <ul class="list-unstyled small">
                <li><a href="#" class="text-light text-decoration-none">راهنمای خرید</a></li>
                <li><a href="#" class="text-light text-decoration-none">سیاست بازگشت کالا</a></li>
                <li><a href="#" class="text-light text-decoration-none">روش‌های ارسال</a></li>
                <li><a href="#" class="text-light text-decoration-none">پرسش‌های متداول</a></li>
                <li><a href="#" class="text-light text-decoration-none">پیگیری سفارش</a></li>
                </ul>
            </div>

            <!-- Contact -->
            <div class="col-md-3">
                <h6 class="fw-bold mb-3">تماس با ما</h6>
                <ul class="list-unstyled small text-light">
                <li><i class="fas fa-phone me-2"></i> ۰۲۱‑۱۲۳۴۵۶۷۸</li>
                <li><i class="fas fa-envelope me-2"></i> support@computermarket.ir</li>
                <li><i class="fas fa-map-marker-alt me-2"></i> تهران، خیابان ولیعصر، پلاک ۲۱۴</li>
                </ul>

                <!-- Social links -->
                <div class="mt-3">
                <a href="#" class="text-light me-3"><i class="fab fa-instagram fa-lg"></i></a>
                <a href="#" class="text-light me-3"><i class="fab fa-telegram fa-lg"></i></a>
                <a href="#" class="text-light"><i class="fab fa-linkedin fa-lg"></i></a>
                </div>
            </div>
        </div>
        <hr class="border-secondary my-4">
        <div class="text-center small text-light-emphasis">
        &copy; 2026 فروشگاه کامپیوترمارکت – تمامی حقوق محفوظ است.
        </div>
    </div>
</footer>

{{-- JS Section (Requires jQuery, Bootstrap JS, Owl Carousel JS) --}}
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

<script>
$(document).ready(function(){
    // 1. Initialize all Owl Carousels
    $('.owl-carousel').each(function(){
        let $this = $(this);
        let count = $this.data('products-count') || $this.find('.item').length;
        
        $this.owlCarousel({
            rtl: true,
            loop: count > 1, // Loop only if there is more than one item
            margin: 15, // Slightly more margin between items
            nav: count > 1,
            dots: count > 1,
            responsive:{
                0:{ items: Math.min(2, count) },
                576:{ items: Math.min(3, count) },
                768:{ items: Math.min(4, count) },
                992:{ items: Math.min(5, count) },
                1200:{ items: Math.min(6, count) }
            }
        });
    });
});
</script>
</body>
</html>
