@extends('layouts.app')

@section('title', $bar->title)

@section('content')
<div class="container mt-4">

    <!-- عنوان و breadcrumb -->
    <div class="d-flex justify-content-between align-items-center mb-2 flex-wrap">
        <div class="d-flex align-items-center mb-2">
            @if($bar->image)
                <img src="{{ asset('storage/' . $bar->image) }}" alt="{{ $bar->title }}"
                     style="height: 60px; border-radius: 8px;" class="me-3">
            @endif
            <h4 class="mb-0">{{ $bar->title }}</h4>
        </div>

        <!-- مرتب‌سازی -->
        <form method="GET" class="sort-buttons">
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
                جدیدترین
            </button>
            <button type="submit" name="sort" value="cheapest"
                    class="btn {{ request('sort') == 'cheapest' ? 'btn-primary' : 'btn-outline-primary' }}">
                ارزان‌ترین
            </button>
            <button type="submit" name="sort" value="expensive"
                    class="btn {{ request('sort') == 'expensive' ? 'btn-primary' : 'btn-outline-primary' }}">
                گران‌ترین
            </button>
        </form>
    </div>

    <!-- breadcrumb -->
    <div class="breadcrumb-nav mb-3">
        <a href="/" class="text-decoration-none">صفحه اصلی</a> <span>›</span>
        <span>نوارها</span> <span>›</span>
        <span>{{ $bar->title }}</span>
    </div>

    <div class="row">
        <!-- ستون فیلتر -->
        <div class="col-md-3">
            <form method="GET">
                <!-- فیلتر برند -->
                <div class="filter-box mb-3">
                    <div class="filter-title mb-2">فیلتر بر اساس برند</div>
                    @foreach($brands as $brand)
                        <div class="form-check">
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
                <div class="filter-box mb-3">
                    <div class="filter-title mb-2">فیلتر بر اساس قیمت</div>
                    <div class="mb-2">
                        <label class="form-label">حداقل قیمت:</label>
                        <input type="number" name="min_price" class="form-control"
                               value="{{ request('min_price') }}" placeholder="0">
                    </div>
                    <div class="mb-2">
                        <label class="form-label">
                            حداکثر قیمت (حداکثر: {{ number_format($maxPrice) }} تومان)
                        </label>
                        <input type="number" name="max_price" class="form-control"
                               value="{{ request('max_price') }}" placeholder="{{ $maxPrice }}">
                    </div>
                </div>

                <button type="submit" class="btn btn-success w-100">اعمال فیلتر</button>
            </form>
        </div>

        <!-- ستون محصولات -->
        <div class="col-md-9">
            @if($products->count())
                <div class="row">
                    @foreach($products as $product)
                        <div class="col-6 col-md-4 mb-4">
                            <a href="{{ route('products.show', $product->slug) }}" class="text-decoration-none text-dark">
                                <div class="card h-100 text-center border-0 shadow-sm">
                                    <img src="{{ asset('storage/' . $product->image) }}"
                                         class="card-img-top p-2" alt="{{ $product->title }}"
                                         style="height: 200px; object-fit: contain;">
                                    <div class="card-body p-2">
                                        <h6 class="card-title mb-2" style="font-size: 14px; min-height: 40px;">
                                            {{ $product->title }}
                                        </h6>

                                        @if($product->discount)
                                            <div class="text-danger fw-bold">
                                                {{ number_format($product->price_after_discount) }} تومان
                                            </div>
                                            <small class="text-muted text-decoration-line-through d-block">
                                                {{ number_format($product->price) }} تومان
                                            </small>
                                        @else
                                            <div class="fw-bold text-primary">
                                                {{ number_format($product->price) }} <span class="text-muted" style="font-size: 13px;">تومان</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>

                <div class="d-flex justify-content-center">
                    {{ $products->appends(request()->query())->links() }}
                </div>
            @else
                <p class="text-muted">محصولی با فیلترهای انتخاب‌شده یافت نشد.</p>
            @endif
        </div>
    </div>
</div>
@endsection
