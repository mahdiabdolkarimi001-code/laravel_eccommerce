<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>محصولات</title>
    <style>
        .product { border: 1px solid #ccc; margin: 10px; padding: 10px; width: 300px; display: inline-block; vertical-align: top; }
        .product img { max-width: 100%; height: auto; }
    </style>
</head>
<body>
    <h1>لیست محصولات</h1>

    @foreach($products as $product)
        <div class="product">
            <h3>{{ $product->title }}</h3>
            @if($product->image)
                <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->title }}">
            @endif
            <p>{{ $product->description }}</p>
            <strong>قیمت: {{ number_format($product->price) }} تومان</strong>
        </div>
    @endforeach
</body>
</html>
