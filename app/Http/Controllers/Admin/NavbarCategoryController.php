<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NavbarCategory;
use Illuminate\Http\Request;

class NavbarCategoryController extends Controller
{
    public function index()
    {
        $navbarCategories = NavbarCategory::with('subcategories')->get();
        return view('admin.navbar_categories.index', compact('navbarCategories'));
    }

    public function create()
    {
        return view('admin.navbar_categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'subcategories' => 'nullable|array',
            'subcategories.*' => 'nullable|string|max:255',
        ]);

        $category = NavbarCategory::create([
            'name' => $request->name,
        ]);

        if ($request->filled('subcategories')) {
            $category->subcategories()->createMany(
                collect($request->subcategories)->filter()->map(fn($name) => ['name' => $name])->toArray()
            );
        }

        return redirect()->route('admin.navbar-categories.index')->with('success', 'دسته‌بندی اضافه شد.');
    }

    public function edit(NavbarCategory $navbarCategory)
    {
        return view('admin.navbar_categories.edit', compact('navbarCategory'));
    }

    public function update(Request $request, NavbarCategory $navbarCategory)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'subcategories' => 'nullable|array',
            'subcategories.*' => 'nullable|string|max:255',
        ]);

        $navbarCategory->update(['name' => $request->name]);

        // حذف زیرشاخه‌های قبلی و جایگزینی با جدیدها
        $navbarCategory->subcategories()->delete();
        if ($request->filled('subcategories')) {
            $navbarCategory->subcategories()->createMany(
                collect($request->subcategories)->filter()->map(fn($name) => ['name' => $name])->toArray()
            );
        }

        return redirect()->route('admin.navbar-categories.index')->with('success', 'دسته‌بندی ویرایش شد.');
    }

    public function destroy(NavbarCategory $navbarCategory)
    {
        $navbarCategory->delete();

        return redirect()->route('admin.navbar-categories.index')->with('success', 'دسته‌بندی حذف شد.');
    }

    public function show(NavbarCategory $navbarCategory)
    {
        // دریافت همه دسته‌ها برای منو با زیرشاخه‌ها
        $navbarCategories = NavbarCategory::with('subcategories')->get();
        dd($navbarCategories);  // فقط این خط بگذار تا مقدار navbarCategories را ببینی

        // کدهای بعدی فعلاً کامنت شده‌اند تا فقط مقدار navbarCategories بررسی شود
        /*
        // گرفتن آیدی زیرشاخه‌های دسته فعلی
        $subcategoryIds = $navbarCategory->subcategories->pluck('id')->toArray();

        // کوئری محصولات مرتبط با دسته یا زیرشاخه‌ها
        $products = \App\Models\Product::where(function ($query) use ($navbarCategory, $subcategoryIds) {
            $query->where('category_id', $navbarCategory->id);

            if (!empty($subcategoryIds)) {
                $query->orWhereIn('subcategory_id', $subcategoryIds);
            }
        })->latest()->get();

        return view('products.show', [
            'navbarCategories' => $navbarCategories,  // برای منو
            'category' => $navbarCategory,             // دسته فعلی برای عنوان و ... 
            'products' => $products,
        ]);
        */
    }


    public function getSubcategories($id)
    {
        $category = NavbarCategory::findOrFail($id);
        return response()->json($category->subcategories);
    }
}
