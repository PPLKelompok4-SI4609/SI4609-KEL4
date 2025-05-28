<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FloodZone;

class FloodZoneSeeder extends Seeder
{
    public function run()
    {
        FloodZone::create([
            'city' => 'Bandung',
            'latitude' => -6.914744,
            'longitude' => 107.609810,
            'riskLevel' => 'High',
            'riverDischarge' => '500 m³/s',
        ]);
    }
}

