<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // لیست کاربران
    public function index()
    {
        // فقط کاربران غیر ادمین رو نمایش می‌ده
        $users = User::where('is_admin', false)->paginate(10);
        
        return view('admin.users.index', compact('users'));
    }

    // ذخیره کاربر جدید
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
        ]);

        return redirect()->route('admin.users.index')->with('success', 'کاربر جدید با موفقیت اضافه شد');
    }

    // نمایش فرم ویرایش کاربر
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    // بروزرسانی اطلاعات کاربر
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:8|confirmed',
        ]);

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'] ? bcrypt($validated['password']) : $user->password,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'اطلاعات کاربر با موفقیت بروزرسانی شد');
    }

    // حذف کاربر
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'کاربر با موفقیت حذف شد');
    }
}
