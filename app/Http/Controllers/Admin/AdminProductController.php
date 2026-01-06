<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategoryIcon;
use App\Models\NavbarCategory;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        $navbarCategories = NavbarCategory::with('subcategories')->get();
        $categoryIcons = CategoryIcon::all();

        return view('admin.products.create', compact('categories', 'navbarCategories', 'categoryIcons'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'price' => 'required|numeric',
            'brand' => 'nullable|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'navbar_category_id' => 'nullable|exists:navbar_categories,id',
            'subcategory_id' => 'nullable|exists:subcategories,id',
            'category_icon_id' => 'nullable|exists:category_icons,id',
            'image' => 'nullable|image|max:2048',
            'discount' => 'nullable|integer|min:0|max:100',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product = Product::create($data);

        // ذخیره مشخصات (attributes)
        if ($request->has('attributes')) {
            foreach ($request->input('attributes') as $attribute) {
                if (!empty($attribute['name']) && !empty($attribute['value'])) {
                    $product->attributes()->create([
                        'name' => $attribute['name'],
                        'value' => $attribute['value'],
                    ]);
                }
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'محصول ایجاد شد.');
    }


    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'price' => 'required|numeric',
            'brand' => 'nullable|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'navbar_category_id' => 'nullable|exists:navbar_categories,id',
            'subcategory_id' => 'nullable|exists:subcategories,id',
            'category_icon_id' => 'nullable|exists:category_icons,id',
            'image' => 'nullable|image|max:2048',
            'discount' => 'nullable|integer|min:0|max:100',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        // حذف مشخصات قبلی و ذخیره جدید
        $product->attributes()->delete();

        if ($request->has('attributes')) {
            foreach ($request->input('attributes') as $attribute) {
                if (!empty($attribute['name']) && !empty($attribute['value'])) {
                    $product->attributes()->create([
                        'name' => $attribute['name'],
                        'value' => $attribute['value'],
                    ]);
                }
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'محصول بروزرسانی شد.');
    }

    public function destroy(Product $product)
    {
        // حذف مشخصات محصول قبل از حذف خود محصول
        $product->attributes()->delete();
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'محصول حذف شد.');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        $navbarCategories = NavbarCategory::with('subcategories')->get();
        $categoryIcons = CategoryIcon::all();

        // اگر محصول دارای مشخصات (attributes) است، می‌توان ارسال کرد برای نمایش در فرم ویرایش
        $attributes = $product->attributes;

        return view('admin.products.edit', compact('product', 'categories', 'navbarCategories', 'categoryIcons', 'attributes'));
    }

}
