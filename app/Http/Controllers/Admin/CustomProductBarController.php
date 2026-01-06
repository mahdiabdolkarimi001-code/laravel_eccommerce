<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CustomProductBar;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CustomProductBarController extends Controller
{
    public function index()
    {
        $bars = CustomProductBar::latest()->paginate(10);
        return view('admin.custom_product_bars.index', compact('bars'));
    }

    public function create()
    {
        return view('admin.custom_product_bars.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
        ]);

        $data['slug'] = Str::slug($data['title']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('custom_bars', 'public');
        }

        CustomProductBar::create($data);

        return redirect()->route('admin.custom-product-bars.index')->with('success', 'نوار دلخواه ایجاد شد.');
    }

    public function edit(CustomProductBar $customProductBar)
    {
        return view('admin.custom_product_bars.edit', compact('customProductBar'));
    }

    public function update(Request $request, CustomProductBar $customProductBar)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
        ]);

        $data['slug'] = Str::slug($data['title']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('custom_bars', 'public');
        }

        $customProductBar->update($data);

        return redirect()->route('admin.custom-product-bars.index')->with('success', 'نوار بروزرسانی شد.');
    }

    public function destroy(CustomProductBar $customProductBar)
    {
        $customProductBar->delete();
        return back()->with('success', 'نوار حذف شد.');
    }

    // ------------------------------
    // 🚀 متدهای افزودن محصول به نوار
    // ------------------------------

    public function selectProducts(Request $request, CustomProductBar $bar)
    {
        $search = $request->input('search');

        $products = Product::when($search, function ($query, $search) {
            return $query->where('title', 'like', "%{$search}%");
        })->paginate(12);

        return view('admin.custom-bars.select-products', compact('bar', 'products', 'search'));
    }

    public function attachProducts(Request $request, CustomProductBar $bar)
    {
        $request->validate([
            'product_ids' => 'required|array',
            'product_ids.*' => 'exists:products,id',
        ]);

        $bar->products()->syncWithoutDetaching($request->product_ids);

        return redirect()->route('admin.custom-bars.products.select', $bar)
            ->with('success', 'محصولات با موفقیت به نوار اضافه شدند.');
    }
}
