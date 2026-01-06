<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->unsignedBigInteger('navbar_category_id')->nullable()->after('id');
            $table->foreign('navbar_category_id')->references('id')->on('navbar_categories')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropForeign(['navbar_category_id']);
            $table->dropColumn('navbar_category_id');
        });
    }
};
