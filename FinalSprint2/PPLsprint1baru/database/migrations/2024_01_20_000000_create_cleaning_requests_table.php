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
            $table->string('full_address');
            $table->string('contact_number');
            $table->enum('service_type', ['home_cleaning', 'office_cleaning', 'furniture_cleaning']);
            $table->dateTime('scheduled_datetime');
            $table->string('payment_method');
            $table->decimal('subtotal', 8, 2);
            $table->decimal('service_fee', 8, 2);
            $table->decimal('tax', 8, 2);
            $table->decimal('total', 8, 2);
            $table->integer('estimated_duration')->comment('Estimated duration in hours');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cleaning_requests');
    }
};