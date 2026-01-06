<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    protected $fillable = ['name', 'slug', 'navbar_category_id'];

    // 🔑 Route Model Binding با slug
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function navbarCategory()
    {
        return $this->belongsTo(NavbarCategory::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
