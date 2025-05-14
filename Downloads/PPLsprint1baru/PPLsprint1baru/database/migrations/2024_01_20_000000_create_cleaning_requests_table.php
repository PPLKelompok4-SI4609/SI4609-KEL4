<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('cleaning_requests', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('address_line1');
            $table->string('address_line2')->nullable();
            $table->string('city');
            $table->string('state');
            $table->string('zip_code');
            $table->string('card_name');
            $table->string('card_number');
            $table->string('expiry_date');
            $table->string('cvv');
            $table->decimal('subtotal', 8, 2);
            $table->decimal('service_fee', 8, 2);
            $table->decimal('tax', 8, 2);
            $table->decimal('total', 8, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cleaning_requests');
    }
};