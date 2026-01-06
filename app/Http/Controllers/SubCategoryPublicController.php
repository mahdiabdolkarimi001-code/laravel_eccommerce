<?php

namespace App\Http\Controllers;

use App\Models\Subcategory;
use App\Models\NavbarCategory;
use Illuminate\Http\Request;

class SubcategoryPublicController extends Controller
{
    public function show(Request $request, Subcategory $subcategory)
    {
        $query = $subcategory->products();

        // فیلتر برند
        if ($request->filled('brand')) {
            $brands = is_array($request->brand)
                ? $request->brand
                : [$request->brand];

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
        match ($request->sort) {
            'cheapest' => $query->orderBy('price', 'asc'),
            'expensive' => $query->orderBy('price', 'desc'),
            default => $query->latest(),
        };

        $products = $query
            ->paginate(12)
            ->appends($request->query());

        $brands = $subcategory->products()
            ->pluck('brand')
            ->unique()
            ->filter()
            ->values();

        $maxPrice = (int) $subcategory->products()->max('price');

        return view('subcategory.show', compact(
            'subcategory',
            'products',
            'brands',
            'maxPrice'
        ))->with([
            'navbarCategories' => NavbarCategory::with('subcategories')->get(),
        ]);
    }
}
