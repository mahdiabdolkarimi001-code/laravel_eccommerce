<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('navbar_categories', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->unsignedBigInteger('parent_id')->nullable(); // برای مگا منو
        $table->timestamps();

        $table->foreign('parent_id')->references('id')->on('navbar_categories')->onDelete('cascade');
    });

    }
    public function down(): void
    {
        Schema::dropIfExists('navbar_categories');
    }
};
