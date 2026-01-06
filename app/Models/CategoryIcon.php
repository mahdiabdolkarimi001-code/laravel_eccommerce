<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CategoryIcon extends Model
{
    protected $fillable = ['name', 'image', 'slug']; // اضافه کردن slug به fillable

    public function products()
    {
        return $this->hasMany(\App\Models\Product::class);
    }

    // برای اینکه Route Model Binding بر اساس slug کار کند
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($bar) {
            if (empty($bar->slug)) {
                $bar->slug = Str::slug($bar->name);
            }
        });

        static::updating(function ($bar) {
            // در صورت تمایل می‌توانید این قسمت را هم اضافه کنید تا هنگام آپدیت slug تغییر کند:
            $bar->slug = Str::slug($bar->name);
        });
    }
}
