<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::table('orders', function ($table) {
        $table->string('status')->default('pending');
        $table->decimal('total', 15, 2)->default(0);
    });
}

public function down()
{
    Schema::table('orders', function ($table) {
        $table->dropColumn(['status', 'total']);
    });
}

};
