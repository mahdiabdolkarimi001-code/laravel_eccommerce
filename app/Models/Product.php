<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    protected $fillable = [
        'title',
        'description',
        'price',
        'image',
        'gallery', // اضافه شده
        'category_id',
        'navbar_category_id',
        'subcategory_id',
        'category_icon_id',
        'discount',
        'brand',
        'slug',
    ];

    // تبدیل خودکار فیلدهای خاص به نوع موردنظر
    protected $casts = [
        'gallery' => 'array', // فیلد گالری به صورت آرایه (JSON) ذخیره می‌شود
    ];

    // تولید خودکار slug یکتا
    protected static function booted()
    {
        static::creating(function ($product) {
            if (empty($product->slug)) {
                $slug = Str::slug($product->title);
                $originalSlug = $slug;
                $count = 1;

                while (Product::where('slug', $slug)->exists()) {
                    $slug = $originalSlug . '-' . $count++;
                }

                $product->slug = $slug;
            }
        });
    }

    // ارتباط‌ها
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function navbarCategory()
    {
        return $this->belongsTo(NavbarCategory::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class, 'subcategory_id');
    }

    public function categoryIcon()
    {
        return $this->belongsTo(CategoryIcon::class, 'category_icon_id');
    }

    public function customProductBars()
    {
        return $this->belongsToMany(CustomProductBar::class, 'custom_product_bar_product');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // قیمت پس از تخفیف
    public function getPriceAfterDiscountAttribute()
    {
        if ($this->discount) {
            return round($this->price - ($this->price * $this->discount / 100));
        }

        return $this->price;
    }
    
    public function attributes()
    {
        return $this->hasMany(ProductAttribute::class);
    }

    // درصد تخفیف
    public function getDiscountPercentAttribute()
    {
        if ($this->discount > 0 && $this->price > 0) {
            return round(($this->discount / $this->price) * 100);
        }
        return 0;
    }

}
