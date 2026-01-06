<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->get();
        return view('products.index', compact('products'));
    }

    public function show($slug)
    {
        // بارگذاری محصول با مشخصات آن
        $product = Product::where('slug', $slug)
            ->with('attributes') // ← اینجا اصلاح شد
            ->firstOrFail();
            
        $finalPrice = $product->price_after_discount;

        return view('products.show', compact('product'));
    }
}
