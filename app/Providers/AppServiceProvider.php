<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Models\CategoryIcon;

class RouteServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // حتما parent::boot() را صدا بزن
        parent::boot();

        // اینجا bind کردن slug به مدل CategoryIcon
        Route::bind('slug', function ($value) {
            return CategoryIcon::where('slug', $value)->firstOrFail();
        });
    }

    // بقیه کدها (مثل map() و ... )
}
