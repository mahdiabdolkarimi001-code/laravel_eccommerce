<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>جزئیات سفارش - شماره {{ $order->id }}</title>
    <!-- استفاده از Bootstrap 5.3.3 RTL -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet" integrity="sha384-2Gv9Vn0wVz3Lw0zL4G0l9JvX8q+PzJ5kXp7Z3N5u4z3M5/wBv/j4/3g5j3/4g3f4" crossorigin="anonymous">
    
    <!-- استایل‌های سفارشی برای بهبود ظاهر ادمین - حالت روشن (Light Mode) -->
    <style>
        body {
            background-color: #f8f9fa; /* پس‌زمینه روشن و خنثی شبیه به محیط ادمین */
            color: #212529; /* متن تیره */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .container {
            margin-top: 2rem;
            margin-bottom: 2rem;
        }

        h1 {
            color: #343a40; /* عنوان اصلی تیره و قوی */
            margin-bottom: 2rem; /* افزایش فاصله زیر عنوان اصلی */
        }

        .order-summary-card {
            border: none;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075); /* سایه سبک */
            border-radius: 0.5rem;
        }
        
        .card-header {
            background-color: #e9ecef; /* سربرگ کارت کمی تیره‌تر */
            border-bottom: 1px solid #dee2e6;
        }

        .list-group-item {
            border-color: #dee2e6;
            padding-top: 0.9rem; /* افزایش پدینگ بالا و پایین در لیست آیتم‌ها */
            padding-bottom: 0.9rem; 
        }

        .table thead {
            background-color: #dee2e6; /* سربرگ جدول */
            color: #343a40;
        }

        /* استایل‌های وضعیت پرداخت بهبود یافته */
        .paid-status {
            color: #198754;
            font-weight: bold;
            padding: 0.3rem 0.6rem;
            border-radius: 0.25rem;
            background-color: #d1e7dd;
        }

        .unpaid-status {
            color: #dc3545;
            font-weight: bold;
            padding: 0.3rem 0.6rem;
            border-radius: 0.25rem;
            background-color: #f8d7da;
        }

        /* تنظیمات ریسپانسیو برای حاشیه در موبایل */
        @media (max-width: 768px) {
            .container {
                padding-right: 1rem;
                padding-left: 1rem;
            }
        }
    </style>
</head>

<body>

<div class="container">
    <h1 class="mb-4">جزئیات سفارش شماره {{ $order->id }}</h1>

    <!-- بخش اطلاعات کلی سفارش (فاصله عمودی بیشتر با mb-5) -->
    <div class="card order-summary-card mb-5">
        <div class="card-header">
            <h5 class="mb-0">اطلاعات اصلی سفارش</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-4 mb-md-0"> <!-- افزایش فاصله عمودی بین دو ستون در موبایل با mb-4 -->
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>شناسه سفارش:</strong>
                            <span class="badge bg-secondary rounded-pill">{{ $order->id }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>مبلغ کل:</strong>
                            <span>{{ number_format($order->total) }} تومان</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>روش پرداخت:</strong>
                            <span>{{ $order->gateway }}</span>
                        </li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>وضعیت پرداخت:</strong>
                            @if($order->is_paid)
                                <span class="paid-status">پرداخت شده</span>
                            @else
                                <span class="unpaid-status">در انتظار پرداخت</span>
                            @endif
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>نام کاربر:</strong>
                            <span>{{ $order->user->name }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>ایمیل:</strong>
                            <span>{{ $order->user->email }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- بخش اطلاعات آدرس (فاصله عمودی بیشتر با mb-5) -->
    <div class="card order-summary-card mb-5">
        <div class="card-header">
            <h5 class="mb-0">اطلاعات ارسال</h5>
        </div>
        <div class="card-body">
            <p><strong>آدرس:</strong> {{ $order->user->address }}</p>
            <p class="mb-0"><strong>کد پستی:</strong> {{ $order->user->postal_code }}</p>
            @if($order->user->phone)
            <p class="mt-3"><strong>تلفن تماس:</strong> {{ $order->user->phone }}</p> <!-- افزایش فاصله زیر کد پستی -->
            @endif
        </div>
    </div>

    <!-- بخش محصولات خریداری‌شده -->
    <h2 class="mb-4">محصولات خریداری‌شده:</h2> <!-- افزایش فاصله زیر عنوان محصولات -->
    <div class="table-responsive">
        <table class="table table-hover table-striped align-middle">
            <thead>
                <tr>
                    <th scope="col">ردیف</th>
                    <th scope="col">نام محصول</th>
                    <th scope="col" class="text-center">قیمت واحد</th>
                    <th scope="col" class="text-center">تعداد</th>
                    <th scope="col" class="text-center">مجموع قیمت</th>
                </tr>
            </thead>
            <tbody>
                @php $i = 1; @endphp
                @foreach($order->items as $item)
                <tr>
                    <th scope="row">{{ $i++ }}</th>
                    <td>{{ $item->product->title }}</td>
                    <td class="text-center">{{ number_format($item->price) }} تومان</td>
                    <td class="text-center">{{ $item->quantity }}</td>
                    <td class="text-center"><strong>{{ number_format($item->price * $item->quantity) }} تومان</strong></td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" class="text-start fw-bold">مجموع نهایی:</td>
                    <td class="text-center fw-bold text-primary">{{ number_format($order->total) }} تومان</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<!-- استفاده از JavaScript Bootstrap 5 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NN5Sr+6MXd5BYl0SX51+LeYlNz2a2Qh2+6f/y3h5o3J5k8P3x" crossorigin="anonymous"></script>
</body>

</html>
