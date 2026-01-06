<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>{{ $bar->title }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <style>
        .card-title {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>
</head>
<body>

    <div class="container mt-5">
        <div class="d-flex align-items-center mb-4">
            @if($bar->image)
                <img src="{{ asset('storage/' . $bar->image) }}" alt="{{ $bar->title }}" style="height: 60px; border-radius: 8px;" class="me-3">
            @endif
            <h4 class="mb-0">{{ $bar->title }}</h4>
        </div>

        <div class="row">
            @forelse($products as $product)
                <div class="col-6 col-md-3 col-lg-2 mb-4">
                    <div class="card h-100 text-center border-0">
                        <a href="{{ route('products.show', $product->slug) }}">
                            <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top p-2" alt="{{ $product->title }}">
                        </a>
                        <div class="card-body p-2">
                            <h6 class="card-title text-truncate">{{ $product->title }}</h6>
                            @if($product->discount)
                                <div class="text-danger fw-bold">
                                    {{ number_format($product->price_after_discount) }} تومان
                                </div>
                                <small class="text-muted text-decoration-line-through d-block">
                                    {{ number_format($product->price) }} تومان
                                </small>
                            @else
                                <div class="fw-bold">{{ number_format($product->price) }} تومان</div>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-muted">محصولی در این نوار ثبت نشده است.</p>
            @endforelse
        </div>

        <div class="d-flex justify-content-center">
            {{ $products->links() }}
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
