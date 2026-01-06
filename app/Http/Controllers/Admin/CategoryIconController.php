<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoryIcon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryIconController extends Controller
{
    public function index()
    {
        $category_icons = CategoryIcon::all();
        return view('admin.category_icons.index', compact('category_icons'));
    }

    public function create()
    {
        return view('admin.category_icons.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'  => 'required|string|max:255',
            'image' => 'required|image|max:2048',
        ]);

        $data['slug']  = Str::slug($data['name']);
        $data['image'] = $request->file('image')->store('category_icons', 'public');

        CategoryIcon::create($data);

        return redirect()
            ->route('admin.category_icons.index')
            ->with('success', 'آیکن با موفقیت ایجاد شد.');
    }

    public function edit(CategoryIcon $categoryIcon)
    {
        return view('admin.category_icons.edit', compact('categoryIcon'));
    }

    public function update(Request $request, CategoryIcon $categoryIcon)
    {
        $data = $request->validate([
            'name'  => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
        ]);

        $data['slug'] = Str::slug($data['name']);

        if ($request->hasFile('image')) {

            // حذف عکس قبلی اگر وجود دارد
            if ($categoryIcon->image && Storage::disk('public')->exists($categoryIcon->image)) {
                Storage::disk('public')->delete($categoryIcon->image);
            }

            $data['image'] = $request->file('image')->store('category_icons', 'public');
        }

        $categoryIcon->update($data);

        return redirect()
            ->route('admin.category_icons.index')
            ->with('success', 'آیکن با موفقیت بروزرسانی شد.');
    }

    public function destroy(CategoryIcon $categoryIcon)
    {
        // حذف تصویر فقط در صورتی که وجود داشته باشد
        if ($categoryIcon->image && Storage::disk('public')->exists($categoryIcon->image)) {
            Storage::disk('public')->delete($categoryIcon->image);
        }

        // حذف رکورد دیتابیس
        $categoryIcon->delete();

        return redirect()
            ->back()
            ->with('success', 'آیکن با موفقیت حذف شد.');
    }
}
