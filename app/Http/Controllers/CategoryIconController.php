<?php

namespace App\Http\Controllers;

use App\Models\CategoryIcon;
use Illuminate\Http\Request;

class CategoryIconController extends Controller
{
    public function showProducts(Request $request, CategoryIcon $categoryIcon)
    {
        // استخراج پارامتر مرتب‌سازی
        $sort = $request->query('sort', 'latest');

        // ساخت query اولیه محصولات مرتبط با این categoryIcon
        $query = $categoryIcon->products();

        // فیلتر برند (در صورت وجود)
        if ($request->filled('brand')) {
            $brandsSelected = is_array($request->brand) ? $request->brand : [$request->brand];
            $query->whereIn('brand', $brandsSelected);
        }

        // فیلتر قیمت
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // مرتب‌سازی
        switch ($sort) {
            case 'cheapest':
                $query->orderBy('price', 'asc');
                break;
            case 'expensive':
                $query->orderBy('price', 'desc');
                break;
            case 'latest':
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        // واکشی محصولات
        $products = $query->paginate(12)->withQueryString();

        // برندهای منحصربه‌فرد برای فیلتر برند
        $brands = $categoryIcon->products()
            ->pluck('brand')
            ->unique()
            ->filter()
            ->values();

        // بیشینه قیمت تمام محصولات این دسته‌بندی
        $maxPrice = (int) $categoryIcon->products()->max('price');

        // بازگشت به ویو
        return view('category_icons.products', [
            'categoryIcon' => $categoryIcon,
            'products' => $products,
            'sort' => $sort,
            'brands' => $brands,
            'maxProductPrice' => $maxPrice, // برای placeholder
            'maxPrice' => $maxPrice,        // برای هماهنگی کامل با ویو
        ]);
    }
}
