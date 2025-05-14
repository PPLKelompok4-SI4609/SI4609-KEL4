<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('flood_zones', function (Blueprint $table) {
            // Menambahkan kolom untuk menyimpan data banjir
            $table->decimal('river_discharge', 10, 2)->nullable();  // Debit sungai (m³/s)
            $table->string('flood_risk_level')->nullable();         // Level risiko banjir (Low, Medium, High)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('flood_zones', function (Blueprint $table) {
            // Menghapus kolom jika migrasi dibatalkan
            $table->dropColumn(['river_discharge', 'flood_risk_level']);
        });
    }
};