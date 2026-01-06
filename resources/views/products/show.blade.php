<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->title }}</title>
    
    <!-- External CSS (Bootstrap RTL + FontAwesome) -->
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
            background-color: var(--bg-light);
            font-family: 'Tahoma', sans-serif;
            color: var(--text-dark);
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
        /* Product Detail */
        .product-detail-card {
            background-color: var(--card-bg);
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 8px 25px rgba(0,0,0,0.05);
            border: 1px solid var(--border-color);
        }
        .main-image-container {
            background-color: #f0f0f0;
            border-radius: 0.75rem;
            padding: 2rem;
            height: 350px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
        }
        .thumbnail-img {
            width: 65px;
            height: 65px;
            object-fit: cover;
            border-radius: 0.5rem;
            cursor: pointer;
            border: 2px solid transparent;
            transition: border 0.2s;
        }
        .thumbnail-img:hover, .thumbnail-img.active {
            border-color: var(--primary-color);
        }
        .product-title {
            font-size: 2rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 1rem;
        }
        .product-description {
            font-size: 1rem;
            line-height: 1.7;
            color: var(--secondary-color);
            margin-bottom: 1.5rem;
        }
        .price-box {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 0.75rem;
            padding: 1.5rem;
        }
        .discount-badge {
            background-color: #dc3545;
            color: white;
            padding: 5px 12px;
            border-radius: 0.5rem;
            display: inline-block;
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 10px;
        }
        .old-price {
            text-decoration: line-through;
            color: #888;
            font-size: 1rem;
        }
        .new-price {
            font-size: 1.8rem;
            font-weight: 800;
            color: var(--primary-color);
            margin: 10px 0;
        }
        .btn-add-to-cart {
            background-color: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
            width: 100%;
            padding: 12px;
            font-size: 1.05rem;
            font-weight: 600;
            transition: background-color 0.2s;
        }
        .btn-add-to-cart:hover {
            background-color: #0056b3;
        }

        /* Attributes */
        .attribute-item {
            background-color: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 0.5rem;
            padding: 12px 15px;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .attribute-name { font-weight: 500; color: var(--secondary-color); }
        .attribute-value { font-weight: 700; color: var(--text-dark); }
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

<!-- Main Content -->
<div class="container mt-4">
    <div class="row g-5">
        <!-- Right Column: Images & Attributes -->
        <div class="col-lg-5 order-lg-2 order-1">
            <div class="product-detail-card">
                <!-- Main Image -->
                <div class="main-image-container">
                    <img id="mainImage" src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->title }}" style="max-width:100%; max-height:100%; object-fit:contain; border-radius:0.5rem;">
                </div>
                <!-- Thumbnails -->
                @if($product->gallery && count($product->gallery))
                <div class="d-flex justify-content-center gap-2 mb-4">
                    <img src="{{ asset('storage/' . $product->image) }}" class="thumbnail-img active" onclick="changeMainImage(this)">
                    @foreach($product->gallery as $img)
                        <img src="{{ asset('storage/' . $img) }}" class="thumbnail-img" onclick="changeMainImage(this)">
                    @endforeach
                </div>
                @endif

                <!-- Attributes -->
                <h5 class="mt-4 mb-3" style="border-bottom:1px solid var(--border-color); padding-bottom:0.5rem;">مشخصات کلیدی</h5>
                <div class="attribute-list">
                    @foreach($product->attributes ?? [] as $attr)
                        <div class="attribute-item">
                            <span class="attribute-name">{{ $attr->name }}</span>
                            <span class="attribute-value">{{ $attr->value }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Left Column: Title, Price & Description -->
        <div class="col-lg-7 order-lg-1 order-2">
            <div class="product-detail-card h-100">
                <h1 class="product-title">{{ $product->title }}</h1>

                <!-- Price Box -->
                <div class="price-box mb-4">
                    @if($product->discount > 0)
                        <div class="discount-badge">تخفیف {{ $product->discount }}%</div>
                        <div class="old-price">{{ number_format($product->price) }} تومان</div>
                        <div class="new-price">{{ number_format($product->price * (100 - $product->discount)/100) }} تومان</div>
                    @else
                        <div class="new-price">{{ number_format($product->price) }} تومان</div>
                    @endif

                    <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mt-3">
                        @csrf
                        <button type="submit" class="btn btn-add-to-cart">
                            <i class="fa-solid fa-cart-shopping ms-2"></i>افزودن به سبد خرید
                        </button>
                    </form>
                </div>

                <!-- Description -->
                <h4 style="font-size:1.25rem; font-weight:600; margin-top:2rem;">توضیحات محصول</h4>
                <p class="product-description">{!! nl2br(e($product->description)) !!}</p>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function changeMainImage(thumbnail){
        document.getElementById('mainImage').src = thumbnail.src;
        document.querySelectorAll('.thumbnail-img').forEach(img => img.classList.remove('active'));
        thumbnail.classList.add('active');
    }
</script>
</body>
</html>
