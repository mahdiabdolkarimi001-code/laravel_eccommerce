<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>افزودن محصول به نوار</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap RTL -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">

    <style>
        /* 1. تغییر رنگ پس‌زمینه به خاکستری بسیار ملایم */
        body {
            background-color: #f8f9fa; /* Light Gray/Off-White Background */
            font-family: 'Vazirmatn', sans-serif;
        }

        .main-card {
            border-radius: 1rem;
            /* سایه ملایم‌تر برای فرم اصلی */
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }

        .product-card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            border: 1px solid #e9ecef; /* اضافه کردن حاشیه نازک */
        }

        .product-card:hover {
            transform: translateY(-3px); /* حرکت کمی به سمت بالا */
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1); /* سایه در حالت هاور */
        }

        .form-check-input {
            cursor: pointer;
        }

        .search-box input {
            border-radius: 0.5rem 0 0 0.5rem;
        }

        .search-box button {
            border-radius: 0 0.5rem 0.5rem 0;
        }

        .truncate {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .submit-btn {
            font-weight: bold;
            font-size: 1.1rem;
            padding: 0.75rem 1.5rem;
            transition: background-color 0.2s;
        }
        
        .submit-btn:hover {
            background-color: #1e7e34; /* سبز تیره‌تر در هاور */
        }

        .product-image {
            object-fit: cover;
            border-radius: 0.375rem;
        }
        
        /* تنظیم فاصله بندی برای هدر */
        .header-title {
            border-bottom: 2px solid #dee2e6;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<div class="container py-5">
    <!-- اعمال کلاس main-card برای زیبایی بیشتر -->
    <div class="card p-4 mb-4 main-card bg-white">
        <h4 class="mb-4 text-center header-title">
            افزودن محصول به نوار: <span class="text-primary">{{ $bar->title }}</span>
        </h4>

        <!-- Search -->
        <form method="GET" class="mb-4">
            <div class="input-group search-box">
                <input type="text" name="search" class="form-control" placeholder="جستجو محصول..." value="{{ $search }}">
                <button class="btn btn-outline-primary" type="submit">جستجو</button>
            </div>
        </form>

        <!-- Products -->
        <form method="POST" action="{{ route('admin.custom-bars.products.attach', $bar) }}">
            @csrf
            <div class="row">
                @forelse($products as $product)
                    <div class="col-md-4 col-lg-3 mb-4">
                        <div class="card product-card h-100 p-3 d-flex flex-row align-items-center gap-3">
                            <!-- تغییر ظاهر چک‌باکس (کوچک‌تر یا در کنار هم) -->
                            <input type="checkbox" name="product_ids[]" value="{{ $product->id }}" class="form-check-input mt-0 flex-shrink-0">
                            <img src="{{ asset('storage/' . $product->image) }}" width="50" height="50" class="product-image flex-shrink-0" alt="{{ $product->title }}">
                            <span class="truncate w-100 text-dark" title="{{ $product->title }}">{{ $product->title }}</span>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center text-muted p-4">
                        محصولی یافت نشد.
                    </div>
                @endforelse
            </div>

            <div class="d-grid mt-4">
                <button class="btn btn-success submit-btn">افزودن محصولات</button>
            </div>
        </form>

        <div class="mt-4 text-center">
            {{ $products->withQueryString()->links() }}
        </div>
    </div>
</div>
<!-- اطمینان از اینکه بوت‌استرپ JS هم بارگذاری می‌شود (اختیاری اما خوب است) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
