<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>محصولات دارای تخفیف</title>

    <!-- Bootstrap RTL + FontAwesome -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        :root {
            --primary-color: #007bff;
            --secondary-color: #6c757d;
            --bg-light: #f7f9fc;
            --card-bg: #ffffff;
            --border-color: #e9ecef;
            --text-dark: #1a1a1a;
        }

        body {
            background-color: var(--bg-light) !important;
            font-family: 'Tahoma', sans-serif;
        }

        /* Navbar */
        .navbar-custom { background-color: var(--card-bg); box-shadow: 0 2px 10px rgba(0,0,0,0.08); border-bottom: 1px solid var(--border-color);}
        .navbar-brand-custom { font-weight:900; color: var(--primary-color) !important; font-size:1.5rem; }
        .nav-link-custom { color: var(--text-dark); font-size:0.95rem; transition:0.2s; }
        .nav-link-custom:hover { color: var(--primary-color); }

        /* Search */
        .search-form .input-group { max-width:500px; }
        .search-form .form-control { border-radius:0 0.5rem 0.5rem 0 !important; border-right: none; }
        .search-form .btn-search { background-color: var(--primary-color); border-color: var(--primary-color); border-radius:0.5rem 0 0 0.5rem !important; color:white; }

        .sort-buttons {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 0.5rem;
            justify-content: flex-start;
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
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
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

        .product-card {
            background-color: var(--card-bg);
            border-radius: 1rem;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 1px solid var(--border-color);
            height: 100%;
            box-shadow: 0 4px 12px rgba(0,0,0,0.04) !important;
        }
        .product-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.12) !important;
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

        .discount-badge {
            background-color: #dc3545;
            font-size: 0.85rem;
            padding: 5px 10px;
            border-radius: 0 0 10px 0;
            color: white;
            font-weight: 600;
        }
        .price-after-discount {
            font-size: 1.35rem !important;
            color: var(--primary-color) !important;
            font-weight: 700 !important;
        }
        .price-original {
            text-decoration: line-through;
            font-size: 0.9rem;
            color: var(--secondary-color);
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light navbar-custom sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand navbar-brand-custom" href="{{ route('home') }}">
            <i class="fa-solid fa-store ms-2"></i>فروشگاه من
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link nav-link-custom" href="{{ route('home') }}">صفحه اصلی</a></li>
            </ul>
            <form class="d-flex search-form mx-3 w-100 justify-content-center" method="GET" action="{{ route('products.search') }}">
                <div class="input-group">
                    <input class="form-control" type="search" placeholder="جستجوی محصول..." name="q">
                    <button class="btn btn-search" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>
            </form>
            <div class="d-flex align-items-center ms-3">
                <a href="/cart" class="btn btn-outline-secondary me-2 rounded-circle" style="width:40px;height:40px;display:flex;align-items:center;justify-content:center;">
                    <i class="fa-solid fa-cart-shopping"></i>
                </a>
            </div>
        </div>
    </div>
</nav>

<div class="container-fluid mt-4">
    <div class="d-flex justify-content-between align-items-center mb-2 flex-wrap">
        <h1 class="page-title" style="font-size:2rem;font-weight:700;color:var(--text-dark);margin-bottom:0;">
            محصولات دارای تخفیف ویژه
        </h1>

        <form method="GET" class="sort-buttons">
            @foreach(request()->except('sort','page') as $key => $value)
                @if(is_array($value))
                    @foreach($value as $v)
                        <input type="hidden" name="{{ $key }}[]" value="{{ $v }}">
                    @endforeach
                @else
                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                @endif
            @endforeach

            <button type="submit" name="sort" value="percent" class="btn {{ request('sort')=='percent'?'btn-primary':'btn-outline-primary' }}">
                <i class="fa-solid fa-percent ms-1"></i> بیشترین درصد
            </button>
            <button type="submit" name="sort" value="amount" class="btn {{ request('sort')=='amount'?'btn-primary':'btn-outline-primary' }}">
                <i class="fa-solid fa-sack-dollar ms-1"></i> بیشترین مبلغ
            </button>
        </form>
    </div>

    <div class="breadcrumb-nav mb-4">
        <a href="{{ url('/') }}">صفحه اصلی</a> <span>›</span> <span>تخفیف‌ها</span>
    </div>

    <div class="row">
        <div class="col-lg-3 col-md-12">
            <div class="filter-box p-4 rounded-lg shadow-sm mb-4" style="background-color: var(--card-bg); border: 1px solid var(--border-color);">
                <div class="filter-title" style="border-bottom-color: var(--primary-color);">
                    <i class="fa-solid fa-tags ms-2"></i> فیلترها
                </div>
                <p class="text-muted small">در این صفحه، فیلترهای اصلی بر اساس تخفیف اعمال می‌شوند.</p>
                <div class="mt-4">
                    <label class="form-label small d-block mb-2" style="color: var(--text-dark);">محدوده قیمت (تخفیف خورده)</label>
                    <input type="range" class="form-range" min="100000" max="10000000" step="100000" id="priceRange">
                    <div class="d-flex justify-content-between text-xs mt-1" style="color: var(--secondary-color);">
                        <span>100K</span>
                        <span>10M+</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-9 col-md-12">
            @if($discountedProducts->count())
                <div class="row g-4">
                    @foreach($discountedProducts as $product)
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                            <a href="{{ route('products.show', $product->slug) }}" class="text-decoration-none text-dark">
                                <div class="product-card h-100 text-center position-relative">
                                    @if($product->discount)
                                        <span class="discount-badge position-absolute top-0 start-0 m-2 z-1">{{ $product->discount }}٪</span>
                                    @endif
                                    <div class="product-card-image-container" style="height:220px;display:flex;align-items:center;justify-content:center;background-color:#fafafa;overflow:hidden;">
                                        @if($product->image)
                                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->title }}" style="max-height:100%;max-width:100%;object-fit:contain;">
                                        @else
                                            <i class="fa-solid fa-image fa-3x text-secondary"></i>
                                        @endif
                                    </div>
                                    <div class="card-body p-3">
                                        <h6 class="card-title" style="min-height:48px;margin-bottom:0.75rem;">{{ $product->title }}</h6>
                                        <div class="d-flex flex-column align-items-center">
                                            <div class="price-after-discount">
                                                {{ number_format($product->price_after_discount ?? $product->price_original) }} <span class="text-muted" style="font-size:1rem;font-weight:500;">تومان</span>
                                            </div>
                                            @if($product->price_original && $product->price_original != $product->price_after_discount)
                                                <div class="price-original">{{ number_format($product->price_original) }} تومان</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>

                <div class="d-flex justify-content-center mt-5">
                    {{ $discountedProducts->links() }}
                </div>
            @else
                <div class="alert alert-light text-center py-5 mt-4 rounded-4 shadow-sm border-0" style="background-color: var(--card-bg); border:1px solid var(--border-color);">
                    <i class="fa-solid fa-percent fa-3x text-secondary mb-3"></i>
                    <h5 class="fw-bold">هیچ محصولی با تخفیف یافت نشد</h5>
                    <p class="mb-0">برگردید و محصولات دیگر را بررسی کنید.</p>
                </div>
            @endif
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
