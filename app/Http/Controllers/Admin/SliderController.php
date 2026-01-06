<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::latest()->get();
        return view('admin.sliders.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.sliders.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png,gif,webp|max:10280',
            'link' => 'nullable|url',
            'active' => 'sometimes|in:0,1',
        ]);

        try {
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $imagePath = $request->file('image')->store('sliders', 'public');
            } else {
                throw new \Exception('The uploaded image is not valid.');
            }

            Slider::create([
                'title' => $request->title,
                'image' => $imagePath,
                'link' => $request->link,
                'active' => $request->active ?? 0,
            ]);

            return redirect()->route('admin.sliders.index')
                ->with('success', 'اسلایدر با موفقیت ایجاد شد.');

        } catch (\Exception $e) {
            Log::error('Slider store failed', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);

            return back()->withErrors(['image' => 'خطا در آپلود تصویر: ' . $e->getMessage()])
                         ->withInput();
        }
    }

    public function edit(Slider $slider)
    {
        return view('admin.sliders.edit', compact('slider'));
    }

    public function update(Request $request, Slider $slider)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:10280',
            'link' => 'nullable|url',
            'active' => 'sometimes|in:0,1',
        ]);

        try {
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                if ($slider->image) {
                    Storage::disk('public')->delete($slider->image);
                }
                $slider->image = $request->file('image')->store('sliders', 'public');
            }

            $slider->update([
                'title' => $request->title,
                'link' => $request->link,
                'active' => $request->active ?? 0,
                'image' => $slider->image ?? null,
            ]);

            return redirect()->route('admin.sliders.index')
                ->with('success', 'اسلایدر با موفقیت ویرایش شد.');

        } catch (\Exception $e) {
            Log::error('Slider update failed', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);

            return back()->withErrors(['image' => 'خطا در آپلود تصویر: ' . $e->getMessage()])
                         ->withInput();
        }
    }

    public function destroy(Slider $slider)
    {
        try {
            if ($slider->image) {
                Storage::disk('public')->delete($slider->image);
            }
            $slider->delete();

            return redirect()->route('admin.sliders.index')
                ->with('success', 'اسلایدر با موفقیت حذف شد.');
        } catch (\Exception $e) {
            Log::error('Slider delete failed', [
                'message' => $e->getMessage(),
            ]);

            return back()->withErrors(['error' => 'خطا در حذف اسلایدر: ' . $e->getMessage()]);
        }
    }
}
