<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Weather;
use Carbon\Carbon;

class WeatherController extends Controller
{
    public function index(Request $request)
    {
        $city = $request->input('city', 'Bandung');
        $apiKey = env('OPENWEATHERMAP_API_KEY');

        // Fetch current weather
        $currentWeather = Http::get("https://api.openweathermap.org/data/2.5/weather", [
            'q' => $city,
            'appid' => $apiKey,
            'units' => 'metric'
        ]);

        if ($currentWeather->failed()) {
            return redirect('/')->with('error', 'Kota tidak ditemukan atau data tidak tersedia.');
        }

        $weatherData = $currentWeather->json();

        // Fetch weather forecast
        $forecast = Http::get("https://api.openweathermap.org/data/2.5/forecast", [
            'q' => $city,
            'appid' => $apiKey,
            'units' => 'metric'
        ])->json();

        $floodRisk = $this->getFloodPrediction($forecast);

        // Daily Forecast: next 6 data points (3-hour intervals)
        $dailyForecasts = collect($forecast['list'])->take(6);

        // Weekly Forecast: group by date and average values
        $grouped = collect($forecast['list'])->groupBy(function ($item) {
            return Carbon::parse($item['dt_txt'])->format('Y-m-d');
        });

        $weeklyForecasts = $grouped->map(function ($items) {
            $avgTemp = $items->avg('main.temp');
            $weatherDesc = $items->first()['weather'][0];
            $rain = $items->sum(function ($entry) {
                return $entry['rain']['3h'] ?? 0;
            });
            return [
                'date' => Carbon::parse($items->first()['dt_txt'])->translatedFormat('l, d M'),
                'temp' => round($avgTemp, 1),
                'weather' => $weatherDesc,
                'rain' => $rain
            ];
        })->take(8);

        return view('index', [
            'currentWeatherData' => $weatherData,
            'dailyForecasts' => $dailyForecasts,
            'weeklyForecasts' => $weeklyForecasts,
            'city' => $city,
            'floodRisk' => $floodRisk
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

        // Adjust these thresholds as per your requirements
        if ($rainVolume >= 150) return 'High';  // High risk for rainfall > 150 mm
        if ($rainVolume >= 70) return 'Medium'; // Medium risk for rainfall between 70 mm and 150 mm
        return 'Low';  // Low risk for rainfall < 70 mm
    }
}
