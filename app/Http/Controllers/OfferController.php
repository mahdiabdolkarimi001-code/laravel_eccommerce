<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::whereNotNull('discount')
                        ->where('discount', '>', 0);

        switch ($request->sort) {
            case 'amount':
                // مرتب‌سازی بر اساس قیمت نهایی بعد از تخفیف (از گران‌ترین به ارزان‌ترین)
                $query->orderByRaw('(price * (1 - discount / 100)) DESC');
                break;

            case 'percent':
                // مرتب‌سازی بر اساس بیشترین درصد تخفیف
                $query->orderBy('discount', 'desc');
                break;

            default:
                $query->latest();
        }

        $discountedProducts = $query->paginate(20);

        return view('offers.index', compact('discountedProducts'));
    }
}
