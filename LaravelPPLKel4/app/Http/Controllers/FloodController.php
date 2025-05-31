<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\FloodZone;
use Carbon\Carbon;

class FloodController extends Controller
{
    public function showFloodMap(Request $request)
    {
        $cities = [
            ['name' => 'Aceh', 'latitude' => 5.5474, 'longitude' => 95.3222],
            ['name' => 'Ambon', 'latitude' => -3.6936, 'longitude' => 128.1909],
            ['name' => 'Bali', 'latitude' => -8.4095, 'longitude' => 115.1889],
            ['name' => 'Bandung', 'latitude' => -6.9175, 'longitude' => 107.6191],
            ['name' => 'Banjarmasin', 'latitude' => -3.3191, 'longitude' => 114.5910],
            ['name' => 'Batam', 'latitude' => 1.0391, 'longitude' => 104.0601],
            ['name' => 'Bekasi', 'latitude' => -6.2343, 'longitude' => 106.9898],
            ['name' => 'Bogor', 'latitude' => -6.5953, 'longitude' => 106.7897],
            ['name' => 'Cirebon', 'latitude' => -6.7323, 'longitude' => 108.5500],
            ['name' => 'Denpasar', 'latitude' => -8.6500, 'longitude' => 115.2167],
            ['name' => 'Jakarta', 'latitude' => -6.2088, 'longitude' => 106.8456],
            ['name' => 'Jambi', 'latitude' => -1.6168, 'longitude' => 103.6176],
            ['name' => 'Jayapura', 'latitude' => -2.536, 'longitude' => 140.7183],
            ['name' => 'Kendari', 'latitude' => -3.9524, 'longitude' => 122.4998],
            ['name' => 'Kupang', 'latitude' => -10.1700, 'longitude' => 123.6000],
            ['name' => 'Madura', 'latitude' => -7.2192, 'longitude' => 113.9762],
            ['name' => 'Malang', 'latitude' => -7.9664, 'longitude' => 112.6326],
            ['name' => 'Makassar', 'latitude' => -5.1477, 'longitude' => 119.4328],
            ['name' => 'Manado', 'latitude' => 1.4936, 'longitude' => 124.8456],
            ['name' => 'Medan', 'latitude' => 3.5952, 'longitude' => 98.6722],
            ['name' => 'Mataram', 'latitude' => -8.5833, 'longitude' => 116.1167],
            ['name' => 'Palangka Raya', 'latitude' => -2.2083, 'longitude' => 113.9167],
            ['name' => 'Palembang', 'latitude' => -2.9776, 'longitude' => 104.7467],
            ['name' => 'Pekanbaru', 'latitude' => 0.5071, 'longitude' => 101.4455],
            ['name' => 'Pontianak', 'latitude' => -0.0261, 'longitude' => 109.3426],
            ['name' => 'Semarang', 'latitude' => -6.9665, 'longitude' => 110.4198],
            ['name' => 'Surabaya', 'latitude' => -7.2575, 'longitude' => 112.7521],
            ['name' => 'Surakarta', 'latitude' => -7.575, 'longitude' => 110.8231],
            ['name' => 'Tangerang', 'latitude' => -6.1731, 'longitude' => 106.6317],
            ['name' => 'Tarakan', 'latitude' => 3.3107, 'longitude' => 117.6063],
            ['name' => 'Yogyakarta', 'latitude' => -7.7956, 'longitude' => 110.3695],
        ];

        $floodZones = [];

        // If search query is provided, look for a specific city
        if ($request->has('search') && $request->input('search')) {
            $searchQuery = strtolower($request->input('search'));
            $cityFound = false;

            foreach ($cities as $city) {
                if (strtolower($city['name']) == $searchQuery) {
                    $cityFound = true;
                    $floodZone = FloodZone::where('name', $city['name'])->first();

                    if ($floodZone && $floodZone->updated_at > Carbon::now()->subDay()) {
                        // Use the data from the database
                        $floodZones[] = [
                            'city' => $city['name'],
                            'latitude' => $city['latitude'],
                            'longitude' => $city['longitude'],
                            'riskLevel' => $floodZone->flood_risk_level,
                            'riverDischarge' => $floodZone->river_discharge,
                        ];
                    } else {
                        // Fetch fresh data from the API
                        $response = Http::get('https://flood-api.open-meteo.com/v1/flood', [
                            'latitude' => $city['latitude'],
                            'longitude' => $city['longitude'],
                            'daily' => 'river_discharge',
                            'timezone' => 'Asia/Jakarta',
                        ]);

                        if ($response->successful()) {
                            $floodData = $response->json();
                            $riverDischarge = $floodData['daily']['river_discharge'][0];

                            // Determine flood risk level
                            $riskLevel = $this->getRiskLevel($riverDischarge);

                            // Save the data to the database
                            FloodZone::updateOrCreate(
                                ['name' => $city['name']],
                                [
                                    'latitude' => $city['latitude'],
                                    'longitude' => $city['longitude'],
                                    'river_discharge' => $riverDischarge,
                                    'flood_risk_level' => $riskLevel
                                ]
                            );

                            $floodZones[] = [
                                'city' => $city['name'],
                                'latitude' => $city['latitude'],
                                'longitude' => $city['longitude'],
                                'riskLevel' => $riskLevel,
                                'riverDischarge' => $riverDischarge,
                            ];
                        }
                    }
                }
            }

            if (!$cityFound) {
                return response()->json(['error' => 'City not found'], 404);
            }
        } else {
            // Load all cities when no search is performed
            foreach ($cities as $city) {
                $floodZone = FloodZone::where('name', $city['name'])->first();

                if ($floodZone && $floodZone->updated_at > Carbon::now()->subDay()) {
                    // Use the data from the database
                    $floodZones[] = [
                        'city' => $city['name'],
                        'latitude' => $city['latitude'],
                        'longitude' => $city['longitude'],
                        'riskLevel' => $floodZone->flood_risk_level,
                        'riverDischarge' => $floodZone->river_discharge,
                    ];
                } else {
                    // Fetch fresh data from the API
                    $response = Http::get('https://flood-api.open-meteo.com/v1/flood', [
                        'latitude' => $city['latitude'],
                        'longitude' => $city['longitude'],
                        'daily' => 'river_discharge',
                        'timezone' => 'Asia/Jakarta',
                    ]);

                    if ($response->successful()) {
                        $floodData = $response->json();
                        $riverDischarge = $floodData['daily']['river_discharge'][0];

                        // Determine flood risk level
                        $riskLevel = $this->getRiskLevel($riverDischarge);

                        // Save the data to the database
                        FloodZone::updateOrCreate(
                            ['name' => $city['name']],
                            [
                                'latitude' => $city['latitude'],
                                'longitude' => $city['longitude'],
                                'river_discharge' => $riverDischarge,
                                'flood_risk_level' => $riskLevel
                            ]
                        );

                        $floodZones[] = [
                            'city' => $city['name'],
                            'latitude' => $city['latitude'],
                            'longitude' => $city['longitude'],
                            'riskLevel' => $riskLevel,
                            'riverDischarge' => $riverDischarge,
                        ];
                    }
                }
            }
        }

        return view('/map.index', ['floodZones' => $floodZones]);
    }

    private function getRiskLevel($discharge)
    {
        if ($discharge > 50) {
            return 'High';
        } elseif ($discharge > 10) {
            return 'Medium';
        }
        return 'Low';
    }
}
