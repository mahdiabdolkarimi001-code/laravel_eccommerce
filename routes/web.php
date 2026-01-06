<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductSearchController;
use App\Http\Controllers\SubcategoryPublicController;
use App\Http\Controllers\CategoryIconController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\CustomProductBarPublicController;

// Admin Controllers
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\NavbarCategoryController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CategoryIconController as AdminCategoryIconController;
use App\Http\Controllers\Admin\CustomProductBarController;

/*
|--------------------------------------------------------------------------
| سایت عمومی
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('products.index');
    Route::get('/{slug}', [ProductController::class, 'show'])->name('products.show');
});

Route::get('/search', [ProductSearchController::class, 'search'])->name('products.search');

Route::get('/subcategory/{subcategory:slug}', [SubcategoryPublicController::class, 'show'])
    ->name('subcategory.products');

Route::get('/navbar-category/{id}', function ($id) {
    $navbarCategory = \App\Models\NavbarCategory::findOrFail($id);
    $categoryIds = \App\Models\Category::where('navbar_category_id', $id)->pluck('id');
    $products = \App\Models\Product::whereIn('category_id', $categoryIds)->get();
    $navbarCategories = \App\Models\NavbarCategory::all();
    return view('products.by-navbar-category', compact('navbarCategory', 'products', 'navbarCategories'));
})->name('navbar-category.products');

Route::get('/category-icons/{categoryIcon}/products', [CategoryIconController::class, 'showProducts'])
    ->name('category-icon.products');

Route::get('/offers', [OfferController::class, 'index'])->name('offers.index');

/*
|--------------------------------------------------------------------------
| احراز هویت کاربر
|--------------------------------------------------------------------------
*/

Route::prefix('auth')->name('auth.')->group(function () {
    Route::get('/', [AuthController::class, 'showAuthForm'])->name('form');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

/*
|--------------------------------------------------------------------------
| سبد خرید و سفارشات
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/{productId}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::delete('/cart/{cartId}', [CartController::class, 'remove'])->name('cart.remove');

    Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
});

/*
|--------------------------------------------------------------------------
| پرداخت
|--------------------------------------------------------------------------
*/

Route::prefix('payment/idpay')->name('payment.idpay.')->group(function () {
    Route::get('/{order}', [PaymentController::class, 'start'])->name('start');
    Route::post('/callback', [PaymentController::class, 'callback'])->name('callback');
});

/*
|--------------------------------------------------------------------------
| پنل مدیریت
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.submit');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

    Route::middleware(\App\Http\Middleware\AdminMiddleware::class)->group(function () {

        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        Route::resource('products', AdminProductController::class);
        Route::resource('users', UserController::class);
        Route::resource('navbar-categories', NavbarCategoryController::class);
        Route::resource('sliders', SliderController::class);
        Route::resource('categories', CategoryController::class);

        Route::prefix('category-icons')
            ->name('category_icons.')
            ->group(function () {

                Route::get('/', [AdminCategoryIconController::class, 'index'])->name('index');
                Route::get('/create', [AdminCategoryIconController::class, 'create'])->name('create');
                Route::post('/', [AdminCategoryIconController::class, 'store'])->name('store');

                Route::get('/{categoryIcon}/edit', [AdminCategoryIconController::class, 'edit'])
                    ->name('edit');

                Route::put('/{categoryIcon}', [AdminCategoryIconController::class, 'update'])
                    ->name('update');

                Route::delete('/{categoryIcon}', [AdminCategoryIconController::class, 'destroy'])
                    ->name('destroy');
            });

        Route::resource('custom-product-bars', CustomProductBarController::class);

        Route::get('/custom-bars/{bar}/products/select', [CustomProductBarController::class, 'selectProducts'])
            ->name('custom-bars.products.select');

        Route::post('/custom-bars/{bar}/products/attach', [CustomProductBarController::class, 'attachProducts'])
            ->name('custom-bars.products.attach');

        Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{order}', [AdminOrderController::class, 'show'])->name('orders.show');
    });
});

/*
|--------------------------------------------------------------------------
| 🔧 ALIAS ROUTES (بدون تغییر روت‌های اصلی)
|--------------------------------------------------------------------------
*/

Route::get('/admin/categories', [CategoryController::class, 'index'])
    ->name('categories.index');

Route::delete('/admin/categories/{category:slug}', [CategoryController::class, 'destroy'])
    ->name('categories.destroy');

/*
|--------------------------------------------------------------------------
| سایر روت‌ها
|--------------------------------------------------------------------------
*/

Route::get('/admin/navbar-categories/{id}/subcategories', function ($id) {
    $category = \App\Models\NavbarCategory::with('subcategories')->findOrFail($id);
    return response()->json($category->subcategories);
})->name('admin.navbar_categories.subcategories');

Route::redirect('/admin/category_icons', '/admin/category-icons')
    ->name('admin.redirect.category_icons.index');

Route::redirect('/admin/category_icons/create', '/admin/category-icons/create')
    ->name('admin.redirect.category_icons.create');

Route::get('/admin/category_icons/{id}/edit', function ($id) {
    return redirect("/admin/category-icons/{$id}/edit");
})->name('admin.redirect.category_icons.edit');

Route::get('/custom-bars/{slug}', [CustomProductBarPublicController::class, 'showProducts'])
    ->name('custom-bars.products.show');
