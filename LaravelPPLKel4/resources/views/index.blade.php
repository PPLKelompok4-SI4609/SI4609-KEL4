<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>FloodRescue | Weather & Flood Forecast</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f4f8;
            color: #333;
            margin: 0;
            padding: 0;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            background: #ffffff;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .logo {
            font-weight: 700;
            font-size: 28px;
            color: #007BFF;
        }

        .search-bar input {
            padding: 10px;
            border-radius: 20px;
            border: 1px solid #ccc;
            margin-right: 10px;
            width: 200px;
        }

        .search-bar button {
            padding: 10px 15px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 10px;
            cursor: pointer;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: auto;
        }

        .current-weather {
            background: #eceff1;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            text-align: center;
            margin-top: 20px;
        }

        .tabs {
            display: flex;
            justify-content: center;
            margin-top: 30px;
        }

        .tab-button {
            padding: 10px 20px;
            margin: 0 10px;
            background: #ffffff;
            border: 1px solid #007BFF;
            border-radius: 10px;
            cursor: pointer;
            color: #007BFF;
            font-weight: 500;
            font-family: 'Poppins', sans-serif;
        }

        .tab-button.active {
            background: #007BFF;
            color: white;
        }

        .forecast-container {
            margin-top: 30px;
        }

        .forecast {
            display: none;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }

        .forecast.active {
            display: grid;
        }

        .forecast-day {
            background: #ffffff;
            padding: 20px;
            border-radius: 20px;
            text-align: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .icon {
            font-size: 40px;
            animation: float 2s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .flood-risk {
            font-weight: bold;
        }

        footer {
            text-align: center;
            padding: 20px;
            background: #ffffff;
            margin-top: 50px;
            color: #666;
        }
    </style>
</head>
<body>
<header>
    <div class="logo">FloodRescue</div>
    <form action="/" method="GET" class="search-bar">
        <input type="text" name="city" placeholder="Search for a city..." value="{{ $city ?? '' }}">
        <button type="submit">Search</button>
    </form>
</header>

<div class="container">
    @if (session('error'))
        <div style="color:red; text-align: center;">{{ session('error') }}</div>
    @endif

    @php
        $condition = strtolower($currentWeatherData['weather'][0]['main']);
        $gradients = [
            'clear' => 'linear-gradient(135deg, #56ccf2, #2f80ed)',
            'clouds' => 'linear-gradient(135deg, #bdc3c7, #2c3e50)',
            'rain' => 'linear-gradient(135deg, #4b6cb7, #182848)',
            'drizzle' => 'linear-gradient(135deg, #89f7fe, #66a6ff)',
            'thunderstorm' => 'linear-gradient(135deg, #3a6073, #16222a)',
            'snow' => 'linear-gradient(135deg, #e0eafc, #cfdef3)',
            'mist' => 'linear-gradient(135deg, #d7d2cc, #304352)',
            'fog' => 'linear-gradient(135deg, #d7d2cc, #304352)',
        ];
        $bgGradient = $gradients[$condition] ?? $gradients['clear'];
    @endphp

    @if($currentWeatherData)
    <div class="current-weather" style="
        background: {{ $bgGradient }};
        color: white;
        padding: 2rem;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        text-shadow: 1px 1px 3px rgba(0,0,0,0.4);">
        <h2>Current Weather in {{ $city }}</h2>
        <div style="display: flex; justify-content: center; align-items: center; margin: 20px 0;">
            <img src="https://openweathermap.org/img/wn/{{ $currentWeatherData['weather'][0]['icon'] }}@4x.png"
                alt="{{ $currentWeatherData['weather'][0]['description'] }}"
                title="{{ $currentWeatherData['weather'][0]['description'] }}"
                width="100"
                height="100"
                style="animation: float 2s ease-in-out infinite;">
        </div>
        <p><strong>{{ ucfirst($currentWeatherData['weather'][0]['description']) }}</strong></p>
        <p>Temperature: {{ $currentWeatherData['main']['temp'] }}°C</p>
        <p>Humidity: {{ $currentWeatherData['main']['humidity'] }}%</p>
        <p>Wind Speed: {{ $currentWeatherData['wind']['speed'] }} m/s</p>
    </div>
    @endif

    @if(isset($floodRisk))
        <div class="current-weather" style="margin-top: 20px;">
            <h2>Flood Risk Prediction</h2>
            <p>Flood Risk in {{ $city }}:
                <span class="flood-risk" style="color: {{ $floodRisk === 'High' ? 'red' : ($floodRisk === 'Medium' ? 'orange' : 'green') }};">
                    {{ $floodRisk }}
                </span>
                @if($floodRisk === 'High') 🚨
                @elseif($floodRisk === 'Medium') ⚠️
                @else ✅
                @endif
            </p>
            <p>Rainfall Level: {{ ($floodRisk === 'High') ? '≥ 100mm' : (($floodRisk === 'Medium') ? '50-99mm' : '< 50mm') }}</p>
        </div>
    @endif

    @if($dailyForecasts)
        <div class="tabs">
            <button class="tab-button active" onclick="switchTab('daily')">Daily</button>
            <button class="tab-button" onclick="switchTab('weekly')">Weekly</button>
        </div>

        <div class="forecast-container">
            <!-- Daily Forecast -->
            <div id="daily" class="forecast active">
                @foreach($dailyForecasts as $day)
                    <div class="forecast-day">
                        <h5>{{ \Carbon\Carbon::parse($day['dt_txt'])->translatedFormat('l, d M') }}</h5>
                        <img src="https://openweathermap.org/img/wn/{{ $day['weather'][0]['icon'] }}@2x.png" 
                            alt="{{ $day['weather'][0]['description'] }}" 
                            title="{{ $day['weather'][0]['description'] }}" 
                            width="60" height="60">
                        <p>{{ ucfirst($day['weather'][0]['description']) }}</p>
                        <p><strong>{{ $day['main']['temp'] }}°C</strong></p>
                        <p>Rain: {{ isset($day['rain']['3h']) ? $day['rain']['3h'] . ' mm' : 'No rain' }}</p>
                    </div>
                @endforeach
            </div>

            <!-- Weekly Forecast -->
            <div id="weekly" class="forecast">
                @foreach($weeklyForecasts as $week)
                    <div class="forecast-day">
                        <h5>{{ $week['date'] }}</h5>
                        <img src="https://openweathermap.org/img/wn/{{ $week['weather']['icon'] }}@2x.png" 
                            alt="{{ $week['weather']['description'] }}" 
                            title="{{ $week['weather']['description'] }}" 
                            width="60" height="60">
                        <p>{{ ucfirst($week['weather']['description']) }}</p>
                        <p><strong>{{ $week['temp'] }}°C</strong></p>
                        <p>Total Rainfall: {{ $week['rain'] }} mm</p>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

<footer>
    &copy; 2025 FloodRescue. All rights reserved.
</footer>

<script>
    function switchTab(tab) {
        document.querySelectorAll('.tab-button').forEach(btn => btn.classList.remove('active'));
        document.querySelectorAll('.forecast').forEach(f => f.classList.remove('active'));
        document.getElementById(tab).classList.add('active');
        document.querySelector(`.tab-button[onclick="switchTab('${tab}')"]`).classList.add('active');
    }
</script>
</body>
</html>
