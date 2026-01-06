<?php

namespace App\Http\Controllers;

use App\Models\CustomProductBar;
use Illuminate\Http\Request;
use App\Models\NavbarCategory;

class CustomProductBarPublicController extends Controller
{
    public function showProducts(Request $request, $slug)
    {
        $bar = CustomProductBar::where('slug', $slug)->firstOrFail();

        $query = $bar->products();

        // فیلتر برند
        if ($request->filled('brand')) {
            $brandsFilter = is_array($request->brand) ? $request->brand : [$request->brand];
            $query->whereIn('brand', $brandsFilter);
        }

        // فیلتر قیمت
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // مرتب‌سازی
        switch ($request->sort) {
            case 'cheapest':
                $query->orderBy('price', 'asc');
                break;
            case 'expensive':
                $query->orderBy('price', 'desc');
                break;
            default:
                $query->latest();
        }

        // واکشی محصولات
        $products = $query->paginate(12)->appends($request->query());

        // لیست برندهای موجود بین محصولات این نوار
        $brands = $bar->products()->pluck('brand')->unique()->filter()->values();

        // بیشترین قیمت بین محصولات این نوار
        $maxPrice = (int) $bar->products()->max('price');

        // نمایش ویو
        return view('custom_bars.products', [
            'bar' => $bar,
            'products' => $products,
            'brands' => $brands,
            'maxPrice' => $maxPrice,
            'navbarCategories' => NavbarCategory::with('subcategories')->get(),
        ]);
    }
}
