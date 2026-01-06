<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::create('carts', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');  // ارتباط با جدول users
        $table->foreignId('product_id')->constrained()->onDelete('cascade');  // ارتباط با جدول محصولات
        $table->integer('quantity')->default(1);  // تعداد محصول
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('carts');
}

};
