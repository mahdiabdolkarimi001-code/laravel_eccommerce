<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CustomProductBar extends Model
{
    protected $fillable = ['title', 'slug', 'image'];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($bar) {
            $bar->slug = Str::slug($bar->title);
        });
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}

