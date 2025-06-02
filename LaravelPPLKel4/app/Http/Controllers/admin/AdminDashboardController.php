<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use App\Models\LaporanBanjir;
use App\Models\Article;
use App\Models\CleaningRequest;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $apiKey = env('OPENWEATHERMAP_API_KEY');
        $cities = ['Jakarta', 'Surabaya', 'Medan', 'Bandung', 'Makassar'];

        $cityWeatherData = [];

        foreach ($cities as $city) {
            $currentWeather = Http::get("https://api.openweathermap.org/data/2.5/weather", [
                'q' => $city,
                'appid' => $apiKey,
                'units' => 'metric'
            ])->json();

            $forecast = Http::get("https://api.openweathermap.org/data/2.5/forecast", [
                'q' => $city,
                'appid' => $apiKey,
                'units' => 'metric'
            ])->json();

            $floodRisk = $this->getFloodPrediction($forecast);

            $cityWeatherData[$city] = [
                'currentWeather' => $currentWeather,
                'floodRisk' => $floodRisk
            ];
        }

        return view('admin.dashboard', [
            'userCount' => User::where('role', 'user')->count(),
            'reportCount' => LaporanBanjir::count(),
            'statusCounts' => LaporanBanjir::select('status', DB::raw('count(*) as total'))
                                ->groupBy('status')
                                ->pluck('total', 'status')
                                ->toArray(),
            'articleCount' => Article::count(),
            'cleaningCount' => CleaningRequest::count(),
            'cityWeatherData' => $cityWeatherData,
        ]);
    }

    private function getFloodPrediction($forecast)
    {
        $rainVolume = 0;
        foreach ($forecast['list'] as $entry) {
            if (isset($entry['rain']['3h'])) {
                $rainVolume += $entry['rain']['3h'];
            }
        }

        if ($rainVolume >= 150) return 'High';
        if ($rainVolume >= 70) return 'Medium';
        return 'Low';
    }
}