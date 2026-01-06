<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>محصولات زیرشاخه {{ $categoryIcon->name }}</title>

    {{-- Bootstrap RTL + FontAwesome --}}
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
        body { background-color: var(--bg-light); font-family: 'Tahoma', sans-serif; }

        /* Navbar */
        .navbar-custom { background-color: var(--card-bg); box-shadow: 0 2px 10px rgba(0,0,0,0.08); border-bottom: 1px solid var(--border-color);}
        .navbar-brand-custom { font-weight:900; color: var(--primary-color) !important; font-size:1.5rem; }
        .nav-link-custom { color: var(--text-dark); font-size:0.95rem; transition:0.2s; }
        .nav-link-custom:hover { color: var(--primary-color); }

        /* Search */
        .search-form .input-group { max-width:500px; }
        .search-form .form-control { border-radius:0 0.5rem 0.5rem 0 !important; border-right: none; }
        .search-form .btn-search { background-color: var(--primary-color); border-color: var(--primary-color); border-radius:0.5rem 0 0 0.5rem !important; color:white; }

        /* Filters */
        .filter-box { padding:1.25rem; background-color: var(--card-bg); border-radius:0.75rem; margin-bottom:1.5rem; border:1px solid var(--border-color); box-shadow:0 4px 12px rgba(0,0,0,0.05);}
        .filter-title { font-weight:600; padding-bottom:0.5rem; margin-bottom:1rem; color: var(--text-dark); border-bottom:2px solid var(--primary-color); display:inline-block; font-size:1.1rem; }
        .form-check-label { cursor:pointer; }

        /* Sort buttons */
        .sort-buttons .btn { border-radius:0.5rem; font-size:0.9rem; transition:all 0.2s; }
        .sort-buttons .btn-primary { background-color: var(--primary-color); border-color: var(--primary-color); }
        .sort-buttons .btn-outline-primary { border-color:#adb5bd; color:#495057; }
        .sort-buttons .btn:hover { transform:translateY(-1px); box-shadow:0 2px 6px rgba(0,0,0,0.1); }

        /* Breadcrumb */
        .breadcrumb-nav { font-size:0.95rem; color: var(--secondary-color); margin-bottom:1.5rem; }
        .breadcrumb-nav a { color: var(--primary-color); text-decoration:none; }
        .breadcrumb-nav span { margin:0 0.3rem; }

        /* Product cards */
        .product-card { background-color: var(--card-bg); border-radius:1rem; overflow:hidden; transition:0.3s; border:1px solid var(--border-color); height:100%; box-shadow:0 4px 12px rgba(0,0,0,0.04);}
        .product-card:hover { transform:translateY(-8px); box-shadow:0 15px 30px rgba(0,0,0,0.12); }
        .product-image { width:100%; height:200px; object-fit:contain; background-color:#f0f0f0; }
        .product-title { font-size:14px; min-height:40px; color: var(--text-dark); font-weight:500; }
        .product-price { font-size:1.15rem; color: var(--primary-color); font-weight:700; }
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

<!-- Main Container -->
<div class="container mt-4">
    <!-- Title + Sort -->
    <div class="d-flex justify-content-between align-items-center mb-2 flex-wrap">
        <h4 class="mb-2">{{ $categoryIcon->name }}</h4>
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
            <button type="submit" name="sort" value="newest" class="btn {{ request('sort')=='newest'||!request('sort')?'btn-primary':'btn-outline-primary' }}">جدیدترین</button>
            <button type="submit" name="sort" value="cheapest" class="btn {{ request('sort')=='cheapest'?'btn-primary':'btn-outline-primary' }}">ارزان‌ترین</button>
            <button type="submit" name="sort" value="expensive" class="btn {{ request('sort')=='expensive'?'btn-primary':'btn-outline-primary' }}">گران‌ترین</button>
        </form>
    </div>

    <!-- Breadcrumb -->
    <div class="breadcrumb-nav mb-3">
        <a href="{{ route('home') }}">صفحه اصلی</a> <span>›</span>
        <span>زیرشاخه‌ها</span> <span>›</span>
        <span>{{ $categoryIcon->name }}</span>
    </div>

    <div class="row">
        <!-- Filters Right -->
        <div class="col-md-3">
            <form method="GET">
                <div class="filter-box">
                    <div class="filter-title">فیلتر بر اساس برند</div>
                    @foreach($brands as $brand)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="brand[]" value="{{ $brand }}" id="brand_{{ $loop->index }}" {{ is_array(request('brand')) && in_array($brand, request('brand')) ? 'checked':'' }}>
                            <label class="form-check-label" for="brand_{{ $loop->index }}">{{ $brand }}</label>
                        </div>
                    @endforeach
                </div>
                <div class="filter-box mb-4">
                    <div class="filter-title fw-bold mb-2">فیلتر بر اساس قیمت</div>
                    <div class="mb-2">
                        <label class="form-label">حداقل قیمت:</label>
                        <input type="number" name="min_price" class="form-control" value="{{ request('min_price') }}" placeholder="0">
                    </div>
                    <div class="mb-2">
                        <label class="form-label">حداکثر قیمت (حداکثر: {{ number_format($maxPrice) }} تومان)</label>
                        <input type="number" name="max_price" class="form-control" value="{{ request('max_price') }}" placeholder="{{ $maxPrice }}">
                    </div>
                </div>
                <button type="submit" class="btn w-100" style="background-color: var(--primary-color); color:white; border-color: var(--primary-color);">اعمال فیلتر</button>
            </form>
        </div>

        <!-- Products Left -->
        <div class="col-md-9">
            @if($products->count())
                <div class="row g-4">
                    @foreach($products as $product)
                        <div class="col-6 col-sm-4 col-lg-3">
                            <a href="{{ route('products.show',$product->slug) }}" class="text-decoration-none text-dark">
                                <div class="product-card text-center p-2 h-100">
                                    @if($product->image)
                                        <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->title }}" class="product-image mb-2">
                                    @endif
                                    <div class="product-title">{{ $product->title }}</div>
                                    @if($product->discount)
                                        <div class="product-price text-warning mt-2">{{ number_format($product->price_after_discount) }} تومان</div>
                                        <small class="text-muted text-decoration-line-through d-block">{{ number_format($product->price) }} تومان</small>
                                    @else
                                        <div class="product-price text-warning mt-2">{{ number_format($product->price) }} تومان</div>
                                    @endif
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $products->appends(request()->query())->links('pagination::bootstrap-5') }}
                </div>
            @else
                <p class="text-muted">محصولی برای این دسته‌بندی یافت نشد.</p>
            @endif
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
