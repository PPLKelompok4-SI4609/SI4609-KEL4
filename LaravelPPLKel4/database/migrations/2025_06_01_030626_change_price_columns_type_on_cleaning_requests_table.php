<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('cleaning_requests', function (Blueprint $table) {
            $table->decimal('subtotal', 15, 2)->change();
            $table->decimal('service_fee', 15, 2)->change();
            $table->decimal('tax', 15, 2)->change();
            $table->decimal('total', 15, 2)->change();
        });
    }

    public function down()
    {
        Schema::table('cleaning_requests', function (Blueprint $table) {
            $table->integer('subtotal')->change();
            $table->integer('service_fee')->change();
            $table->integer('tax')->change();
            $table->integer('total')->change();
        });
    }
};
