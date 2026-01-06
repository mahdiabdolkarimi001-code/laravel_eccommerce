<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\NavbarCategory;
use App\Models\Slider;
use App\Models\CategoryIcon;
use App\Models\CustomProductBar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; // ← برای لاگ گرفتن اضافه شد

class HomeController extends Controller
{
    public function index()
    {
        $navbarCategories = NavbarCategory::all();

        $latestProducts = Product::latest()->take(8)->get();

        $sliders = Slider::where('active', true)->latest()->get();
        $categoryIcons = CategoryIcon::all();

        $discountedProducts = Product::whereNotNull('discount')
            ->where('discount', '>', 0)
            ->latest()
            ->take(10)
            ->get();

        // نوارهای سفارشی با محصولات
        $customBars = CustomProductBar::with('products')->get(); 

        // ========================
        // Debug / Logging
        // ========================

        if($customBars->count() > 0){
            Log::info('Custom Bars Count: ' . $customBars->count());
            foreach($customBars as $bar){
                Log::info('Custom Bar: ' . $bar->title, [
                    'id' => $bar->id,
                    'products_count' => $bar->products->count(),
                    'products' => $bar->products->map(function($p){
                        return [
                            'id' => $p->id,
                            'title' => $p->title,
                            'price' => $p->price,
                            'discount' => $p->discount,
                        ];
                    })->toArray()
                ]);
            }
        } else {
            Log::info('No Custom Bars found!');
        }

        return view('home', compact(
            'navbarCategories',
            'latestProducts',  
            'sliders',
            'categoryIcons',
            'discountedProducts',
            'customBars'
        ));
    }
}
