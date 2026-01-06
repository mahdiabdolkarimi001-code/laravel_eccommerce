<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    protected $fillable = ['product_id', 'name', 'value', ]; // ← فیلدهایی که اجازه پر شدن دارند

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
