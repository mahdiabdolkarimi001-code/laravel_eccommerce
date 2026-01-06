<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\NavbarCategory;

class ProductSearchController extends Controller
{
    public function search(Request $request)
    {
        $queryText = $request->input('query');

        $query = Product::where('title', 'LIKE', "%{$queryText}%")
                        ->orWhere('description', 'LIKE', "%{$queryText}%");

        // فیلتر برند
        if ($request->filled('brand')) {
            $brands = is_array($request->brand) ? $request->brand : [$request->brand];
            $query->whereIn('brand', $brands);
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

        // برندها برای فیلتر
        $brands = Product::where('title', 'LIKE', "%{$queryText}%")
                         ->orWhere('description', 'LIKE', "%{$queryText}%")
                         ->pluck('brand')->unique()->filter()->values();

        // حداکثر قیمت
        $maxPrice = Product::where('title', 'LIKE', "%{$queryText}%")
                           ->orWhere('description', 'LIKE', "%{$queryText}%")
                           ->max('price');

        return view('products.search-results', [
            'products' => $products,
            'query' => $queryText,
            'brands' => $brands,
            'maxPrice' => $maxPrice,
            'navbarCategories' => NavbarCategory::with('subcategories')->get(), // اگر در ویو استفاده کنی
        ]);
    }
}
