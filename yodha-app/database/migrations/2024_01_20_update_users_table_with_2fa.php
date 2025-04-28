<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone_number')->nullable();
            $table->boolean('two_factor_enabled')->default(true);
            $table->string('two_factor_code')->nullable();
            $table->timestamp('two_factor_expires_at')->nullable();
            $table->text('data_access_settings')->nullable();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'phone_number',
                'two_factor_enabled',
                'two_factor_code',
                'two_factor_expires_at',
                'data_access_settings'
            ]);
        });
    }
};