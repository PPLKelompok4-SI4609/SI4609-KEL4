<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FloodZone extends Model
{
    use HasFactory;

    protected $table = 'flood_zones';

    protected $fillable = [
        'name',
        'latitude',
        'longitude',
        'river_discharge', // Kolom untuk menyimpan debit sungai
        'flood_risk_level', // Kolom untuk menyimpan level risiko banjir
    ];

    protected $casts = [
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
    ];
}
