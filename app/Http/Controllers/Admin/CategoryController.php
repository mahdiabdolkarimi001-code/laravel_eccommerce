<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\NavbarCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        // ارسال دسته‌بندی‌های نوار ناوبری برای نمایش در فرم
        $navbarCategories = NavbarCategory::all();
        return view('admin.categories.create', compact('navbarCategories'));
    }

    public function store(Request $request)
    {
        // اعتبارسنجی فیلدهای ارسالی
        $request->validate([
            'name' => 'required|string|max:255',
            'navbar_category_id' => 'nullable|exists:navbar_categories,id'
        ]);

        // ساخت دسته‌بندی
        Category::create([
            'name' => $request->name,
            'navbar_category_id' => $request->navbar_category_id
        ]);

        return redirect()->route('categories.index')->with('success', 'دسته‌بندی با موفقیت اضافه شد.');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return back()->with('success', 'دسته‌بندی حذف شد.');
    }
}
