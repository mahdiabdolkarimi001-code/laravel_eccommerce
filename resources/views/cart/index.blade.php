<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>سبد خرید شما</title>

    <!-- Bootstrap 5 RTL -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet" />
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'IRANSans', sans-serif;
        }

        /* Navbar */
        .navbar {
            background-color: #fff;
            border-bottom: 1px solid #e9ecef;
            padding: 1rem 2rem;
        }

        .btn-text {
            background: none;
            border: none;
            font-size: 1.4rem;
            color: #dc3545;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .divider {
            height: 1px;
            background-color: #dee2e6;
            margin-bottom: 1.5rem;
        }

        /* Product Card */
        .product-card {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid #dee2e6;
            border-radius: 10px;
            padding: 1rem;
            background: #fff;
            transition: all 0.2s ease-in-out;
            margin-bottom: 1rem;
        }

        .product-card:hover {
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
        }

        .product-image {
            width: 110px;
            height: 110px;
            object-fit: cover;
            border-radius: 8px;
        }

        .product-details {
            flex: 1;
            margin-right: 1rem;
        }

        .product-name {
            font-weight: 600;
            font-size: 1rem;
        }

        .remove-btn {
            background-color: #fff;
            border: 1px solid #dee2e6;
            color: #6c757d;
            padding: 0.5rem 0.8rem;
            border-radius: 8px;
            transition: background-color 0.2s;
        }

        .remove-btn:hover {
            background-color: #f1f3f5;
        }

        .quantity {
            border: 1px solid #dc3545;
            color: #dc3545;
            padding: 0.5rem 0.8rem;
            border-radius: 8px;
            font-weight: 500;
            min-width: 55px;
            text-align: center;
        }

        .product-right {
            text-align: left;
            font-weight: bold;
            color: #dc3545;
            min-width: 100px;
        }

        /* Total Area */
        .summary-box {
            background-color: #fff;
            border-radius: 10px;
            border: 1px solid #dee2e6;
            padding: 1.5rem;
            margin-top: 1.5rem;
        }

        .summary-box .price-value {
            font-weight: bold;
            color: #000;
        }

        .btn-checkout {
            background-color: #dc3545;
            color: #fff;
            font-size: 1rem;
            padding: 0.8rem;
            border: none;
            width: 100%;
            border-radius: 10px;
            transition: background-color 0.2s ease;
        }

        .btn-checkout:hover {
            background-color: #c82333;
        }

        .footer {
            background-color: #1a1a1a;
            color: #f8f9fa;
            font-size: 0.95rem;
            }

            .footer h6 {
            font-size: 1rem;
            }

            .footer p, .footer li, .footer a {
            line-height: 1.7;
            }

            .footer a:hover {
            color: #dc3545 !important;
            transition: color 0.2s;
            }

            .footer hr {
            opacity: 0.2;
            }

            .footer img {
            border-radius: 6px;
            background: white;
            padding: 4px;
            }

            @media (max-width: 768px) {
            .footer {
                text-align: center;
            }
            .footer img {
                margin: 0 auto;
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .product-card {
                flex-direction: column;
                align-items: flex-start;
            }

            .product-right {
                align-self: flex-end;
                margin-top: 0.5rem;
            }

            .summary-box {
                width: 100%;
            }
        }
    </style>
</head>
<body>

    <nav class="navbar">
        <h5 class="m-0 fw-bold">فروشگاه من</h5>
    </nav>

    <div class="container my-4">

        <button class="btn-text">سبد خرید شما</button>
        <div class="divider"></div>

        @if($cartItems->count() > 0)
        @php $totalPrice = 0; @endphp

        @foreach($cartItems as $item)
        @php
            $product = $item->product;
            $unitPrice = $item->price;
            $itemTotal = $unitPrice * $item->quantity;
            $totalPrice += $itemTotal;
        @endphp

        <div class="product-card">
            <div class="product-left d-flex align-items-center">
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->title }}" class="product-image">
                <div class="product-details">
                    <div class="product-name">{{ $product->title }}</div>
                    <div class="d-flex align-items-center mt-2 gap-2">
                        <form action="{{ route('cart.remove', $item->id) }}" method="POST" onsubmit="return confirm('آیا از حذف این محصول مطمئن هستید؟')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="remove-btn">
                                <i class="fas fa-trash"></i> حذف
                            </button>
                        </form>
                        <div class="quantity">{{ $item->quantity }}</div>
                    </div>
                </div>
            </div>
            <div class="product-right">
                @if($product->discount > 0)
                    <del class="text-muted">{{ number_format($product->price) }} تومان</del><br>
                    {{ number_format($unitPrice) }} تومان
                @else
                    {{ number_format($unitPrice) }} تومان
                @endif
            </div>
        </div>

        @endforeach

        <div class="summary-box">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span>مجموع کل:</span>
                <span class="price-value">{{ number_format($totalPrice) }} تومان</span>
            </div>
            <hr>
            <a href="{{ route('orders.create') }}" class="btn-checkout">ادامه فرآیند خرید</a>
        </div>

        @else
        <div class="alert alert-info text-center fs-5 mt-4">
            سبد خرید شما خالی است.
        </div>
        <div class="text-center mt-3">
            <a href="{{ route('home') }}" class="btn btn-success btn-lg">بازگشت به فروشگاه</a>
        </div>
        @endif

    </div>

    <!-- ==================== Footer ==================== -->
        <footer class="footer mt-auto">
        <div class="container py-5">
            <div class="row text-center text-md-start gy-4">

            <!-- About -->
            <div class="col-md-3">
                <h6 class="fw-bold mb-3 text-danger">فروشگاه کامپیوترمارکت</h6>
                <p class="small text-light-emphasis">
                تخصصی‌ترین مرکز فروش لپ‌تاپ، لوازم جانبی، قطعات کامپیوتر و تجهیزات دیجیتال.
                ما با تضمین اصالت کالا، ارسال سریع و گارانتی معتبر کنار شما هستیم.
                </p>
            </div>

            <!-- Customer Services -->
            <div class="col-md-3">
                <h6 class="fw-bold mb-3 text-danger">خدمات مشتریان</h6>
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
                <h6 class="fw-bold mb-3 text-danger">تماس با ما</h6>
                <ul class="list-unstyled small text-light">
                <li><i class="fas fa-phone"></i> ۰۲۱‑۱۲۳۴۵۶۷۸</li>
                <li><i class="fas fa-envelope"></i> support@computermarket.ir</li>
                <li><i class="fas fa-map-marker-alt"></i> تهران، خیابان ولیعصر، پلاک ۲۱۴</li>
                </ul>

                <!-- Social links -->
                <div class="mt-3">
                <a href="#" class="text-light me-3"><i class="fab fa-instagram fa-lg"></i></a>
                <a href="#" class="text-light me-3"><i class="fab fa-telegram fa-lg"></i></a>
                <a href="#" class="text-light"><i class="fab fa-linkedin fa-lg"></i></a>
                </div>
            </div>

            <hr class="border-secondary my-4">

            <div class="text-center small text-light">
            &copy; 2026 فروشگاه کامپیوترمارکت – تمامی حقوق محفوظ است.
            </div>
        </div>
        </footer>
    </body>
</html>
