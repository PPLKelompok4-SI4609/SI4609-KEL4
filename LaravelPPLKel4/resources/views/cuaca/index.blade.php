@extends('layouts.app')

@section('title', 'FloodRescue | Informasi Cuaca')

@section('content')
<style>
body {
    font-family: "Inter", sans-serif;
    background-color: #e0f7fa; /* Light blue background */
    color: #0d47a1; /* Dark blue text */
    margin: 0;
    padding: 0;
    line-height: 1.6;
    font-weight: 400;
    position: relative;
    min-height: 100vh;
}
/* Full viewport hero */
#hero {
    height: calc(100vh - 60px);
    position: relative;
    overflow: hidden;
}
#hero img.bg-image {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    opacity: 0.3;
    z-index: 0;
}
#hero .content {
    position: relative;
    z-index: 10;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    padding: 0 1rem;
    text-align: center;
}
.city-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.city-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.12);
    cursor: pointer;
}
.btn-blue {
    background-color: #2196f3; /* Blue */
    color: white;
}
.btn-blue:hover {
    background-color: #1976d2; /* Darker blue */
}
/* Search toggle button */
#search-toggle {
    position: absolute;
    top: 50%;
    right: 0;
    transform: translate(150%, -50%);
    background: transparent;
    border: none;
    color: #1e3a8a;
    font-size: 1.25rem;
    cursor: pointer;
    z-index: 25;
    padding: 0;
    display: flex;
    align-items: center;
    justify-content: center;
}
#search-toggle:focus {
    outline: 2px solid #2563eb;
    outline-offset: 2px;
}
/* Search form */
#search-form {
    display: flex;
    gap: 0.75rem;
}
#search-form input[type="text"] {
    flex-grow: 1;
    border-radius: 9999px;
    border: 1px solid #2563eb;
    padding: 0.75rem 1.25rem;
    font-size: 1rem;
    outline-offset: 2px;
    transition: box-shadow 0.2s ease;
    font-weight: 600;
    color: #0d47a1;
    background-color: white;
    caret-color: #2563eb;
}
#search-form input[type="text"]::placeholder {
    color: #93c5fd;
    font-weight: 500;
}
#search-form input[type="text"]:focus {
    outline: none;
    box-shadow: 0 0 0 3px #2563eb;
    background-color: white;
    color: #0d47a1;
}
#search-form button {
    background-color: #2563eb; /* blue-600 */
    color: white;
    font-weight: 600;
    padding: 0 1.25rem;
    border-radius: 9999px;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 1rem;
    transition: background-color 0.2s ease;
    border: none;
    cursor: pointer;
    user-select: none;
}
#search-form button:hover,
#search-form button:focus {
    background-color: #1e40af; /* blue-800 */
    outline: none;
}
/* Forecast & Flood Risk spacing */
#forecast-flood-container {
    max-width: 1120px;
    margin: 0 auto 3rem auto;
    padding: 0 1rem;
}
/* Tabs container */
.tabs {
    display: flex;
    justify-content: center;
    gap: 1.5rem;
    margin-bottom: 1.5rem;
    font-weight: 600;
    font-size: 1.125rem;
    color: #1e40af;
    border-bottom: 2px solid transparent;
    cursor: pointer;
}
.tabs button {
    background: none;
    border: none;
    padding-bottom: 0.25rem;
    color: #64748b; /* gray-500 */
    border-bottom: 2px solid transparent;
    transition: color 0.2s ease, border-color 0.2s ease;
}
.tabs button.active {
    color: #1e40af; /* blue-800 */
    border-color: #1e40af;
    cursor: default;
}
/* Forecast grids */
.forecast {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 1.5rem;
}
@media (min-width: 640px) {
    .forecast {
    grid-template-columns: repeat(3, minmax(0, 1fr));
    }
}
@media (min-width: 768px) {
    .forecast {
    grid-template-columns: repeat(6, minmax(0, 1fr));
    }
}
.forecast-day {
    background-color: white;
    border-radius: 1rem;
    padding: 1rem;
    text-align: center;
    box-shadow: 0 1px 3px rgb(0 0 0 / 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    font-weight: 600;
    color: #1e40af;
    cursor: default;
}
.forecast-day:hover {
    transform: translateY(-6px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.12);
    cursor: pointer;
}
.forecast-day h5 {
    font-weight: 600;
    font-size: 0.875rem;
    margin-bottom: 0.25rem;
    color: #1e40af;
}
.forecast-day p {
    font-weight: 400;
    font-size: 0.75rem;
    color: #64748b;
    margin-bottom: 0.25rem;
}
.forecast-day p.temp {
    font-weight: 700;
    font-size: 1.125rem;
    color: #1e40af;
    margin-bottom: 0.25rem;
}
/* Flood risk section */
#flood-risk {
    max-width: 480px;
    margin: 3rem auto 0 auto;
    padding: 1rem 1.5rem;
    border-radius: 1rem;
    text-align: center;
    font-weight: 600;
    color: #1e40af;
    position: relative;
    user-select: none;
}
#flood-risk h2 {
    font-size: 1.25rem;
    margin-bottom: 0.5rem;
    color: #1e40af;
    font-weight: 700;
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 0.5rem;
}
#flood-risk h2 i {
    font-size: 1.5rem;
}
#flood-risk p {
    font-weight: 400;
    font-size: 1rem;
    margin-bottom: 0.5rem;
    color: #334155; /* gray-700 */
}
#flood-risk p.important {
    font-weight: 600;
    font-size: 1.125rem;
    margin-top: 1rem;
    color: #1e40af;
}
/* Top Cities Section */
section#top-cities {
    max-width: 1120px;
    margin: 3rem auto 3rem auto;
    padding: 0 1rem;
}
section#top-cities h2 {
    font-weight: 600;
    font-size: 1.25rem;
    margin-bottom: 1.5rem;
    text-align: center;
    color: #1e40af;
}
section#top-cities .grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 1.5rem;
    max-width: 900px;
    margin: 0 auto;
}
@media (min-width: 640px) {
    section#top-cities .grid {
    grid-template-columns: repeat(3, minmax(0, 1fr));
    }
}
@media (min-width: 768px) {
    section#top-cities .grid {
    grid-template-columns: repeat(6, minmax(0, 1fr));
    }
}
section#top-cities a.city-card {
    background-color: white;
    border-radius: 1rem;
    box-shadow: 0 1px 3px rgb(0 0 0 / 0.1);
    padding: 1.5rem 1rem;
    text-align: center;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.75rem;
    color: #334155;
    font-weight: 600;
    text-decoration: none;
    transition: background-color 0.2s ease;
    font-size: 1rem;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    min-width: 0;
}
section#top-cities a.city-card:hover {
    background-color: #dbeafe; /* blue-100 */
    cursor: pointer;
}
section#top-cities a.city-card img {
    width: 56px;
    height: 38px;
    border-radius: 0.25rem;
    object-fit: cover;
    box-shadow: 0 1px 2px rgb(0 0 0 / 0.1);
}
/* Section separators */
.section-separator {
    max-width: 1120px;
    margin: 3rem auto 3rem auto;
    border-top: 1.5px solid #cbd5e1; /* gray-300 */
}
/* Search form */
#inline-search-form {
    max-width: 480px;
    margin: 2rem auto 3rem auto;
    display: flex;
    gap: 0.75rem;
    padding: 0 1rem;
}
#inline-search-form input[type="text"] {
    flex-grow: 1;
    border-radius: 9999px;
    border: 1px solid #2563eb;
    padding: 0.5rem 1rem;
    font-size: 1rem;
    outline-offset: 2px;
    transition: box-shadow 0.2s ease;
    font-weight: 600;
    color: #0d47a1;
    background-color: white;
    caret-color: #2563eb;
}
#inline-search-form input[type="text"]::placeholder {
    color: #93c5fd;
    font-weight: 500;
}
#inline-search-form input[type="text"]:focus {
    outline: none;
    box-shadow: 0 0 0 3px #2563eb;
    background-color: white;
    color: #0d47a1;
}
#inline-search-form button {
    background-color: #2563eb; /* blue-600 */
    color: white;
    font-weight: 600;
    padding: 0 1rem;
    border-radius: 9999px;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 1rem;
    transition: background-color 0.2s ease;
    border: none;
    cursor: pointer;
    user-select: none;
}
#inline-search-form button:hover,
#inline-search-form button:focus {
    background-color: #1e40af; /* blue-800 */
    outline: none;
}
@media (max-width: 480px) {
    #inline-search-form {
    max-width: 100%;
    margin: 1.5rem 1rem 2rem 1rem;
    }
}
</style>

<main>
    <!-- Hero Section: Current Weather Fullscreen -->
    @php
    $condition = strtolower($currentWeatherData['weather'][0]['main'] ?? '');
    $gradients = [
    'clear' => 'linear-gradient(135deg, #81d4fa, #0288d1)',
    'clouds' => 'linear-gradient(135deg, #b0bec5, #546e7a)',
    'rain' => 'linear-gradient(135deg, #4fc3f7, #0288d1)',
    'drizzle' => 'linear-gradient(135deg, #80deea, #26c6da)',
    'thunderstorm' => 'linear-gradient(135deg, #4db6ac, #00796b)',
    'snow' => 'linear-gradient(135deg, #e1f5fe, #b3e5fc)',
    'mist' => 'linear-gradient(135deg, #cfd8dc, #90a4ae)',
    'fog' => 'linear-gradient(135deg, #cfd8dc, #90a4ae)',
    ];
    $bgGradient = $gradients[$condition] ?? $gradients['clear'];
    @endphp

    @if($currentWeatherData)
    <section id="hero" style="background: {{ $bgGradient }};">
        <img
            alt="Background sky with aurora borealis and pink clouds"
            class="bg-image"
            height="200"
            src="https://storage.googleapis.com/a1aa/image/33f9b79f-721b-46ea-1702-8b723e84f5b2.jpg"
            width="1440"
        />
        <div class="content text-white max-w-4xl mx-auto">
            <h1 class="font-extrabold text-5xl sm:text-7xl mb-4 drop-shadow-lg" style="font-weight:700;">
                {{ $city }}
            </h1>
            <p class="text-sm sm:text-base font-semibold mb-6 drop-shadow-md" style="font-weight:600;">
                {{ \Carbon\Carbon::now()->translatedFormat('l, d M') }} • Update As Of
                {{ \Carbon\Carbon::now()->format('h:i A') }}
            </p>
            <img
                alt="{{ $currentWeatherData['weather'][0]['description'] ?? 'weather icon' }}"
                class="mx-auto w-48 h-48 drop-shadow-xl"
                height="192"
                src="https://openweathermap.org/img/wn/{{ $currentWeatherData['weather'][0]['icon'] ?? '01d' }}@4x.png"
                title="{{ $currentWeatherData['weather'][0]['description'] ?? 'weather icon' }}"
                width="192"
            />
            <p class="text-5xl font-extrabold mt-4 drop-shadow-lg" style="font-weight:700;">
                {{ round($currentWeatherData['main']['temp'] ?? 0) }}
                <span class="text-4xl">°C</span>
            </p>
            <p class="text-xl font-semibold mt-2 drop-shadow-md" style="font-weight:600;">
                {{ ucfirst($currentWeatherData['weather'][0]['description'] ?? '') }}
            </p>
            <div
                class="mt-8 grid grid-cols-2 sm:grid-cols-4 gap-6 max-w-md mx-auto bg-white bg-opacity-20 rounded-xl p-6 shadow-lg text-sm sm:text-base font-semibold text-white drop-shadow-md"
                style="font-weight:600;">
                <div class="flex flex-col items-center">
                    <i aria-hidden="true" class="fas fa-wind text-xl mb-1"></i>
                    <span>Wind</span>
                    <span>{{ $currentWeatherData['wind']['speed'] ?? '-' }} m/s</span>
                </div>
                <div class="flex flex-col items-center">
                    <i aria-hidden="true" class="fas fa-tint text-xl mb-1"></i>
                    <span>Humidity</span>
                    <span>{{ $currentWeatherData['main']['humidity'] ?? '-' }}%</span>
                </div>
                <div class="flex flex-col items-center">
                    <i aria-hidden="true" class="fas fa-cloud-rain text-xl mb-1"></i>
                    <span>Rain</span>
                    <span>{{ $currentWeatherData['rain']['1h'] ?? ($currentWeatherData['rain']['3h'] ?? 0) }} mm</span>
                </div>
                <div class="flex flex-col items-center">
                    <i aria-hidden="true" class="fas fa-temperature-high text-xl mb-1"></i>
                    <span>Feels Like</span>
                    <span>{{ round($currentWeatherData['main']['feels_like'] ?? 0) }}°C</span>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- Search Form -->
    <form
        id="inline-search-form"
        action="/cuaca/"
        method="GET"
        role="search"
        aria-label="Search for a city"
    >
        <input
            type="text"
            name="city"
            placeholder="Search for a city..."
            aria-required="true"
            autocomplete="off"
            aria-label="Search for a city"
        />
        <button
            type="submit"
            aria-label="Search"
            title="Search"
        >
            <i class="fas fa-search" aria-hidden="true"></i>
        </button>
    </form>

    <!-- Separator -->
    <div aria-hidden="true" class="section-separator"></div>

    <!-- Forecast & Flood Risk Section -->
    <section aria-label="Forecast and Flood Risk" id="forecast-flood-container">
        @if($dailyForecasts && $weeklyForecasts)
            <div aria-label="Forecast Tabs" class="tabs" role="tablist">
                <button
                    aria-controls="daily"
                    aria-selected="true"
                    class="tab-button active"
                    id="btn-daily"
                    onclick="switchTab('daily')"
                    role="tab"
                    tabindex="0"
                    type="button"
                >
                    Daily
                </button>
                <button
                    aria-controls="weekly"
                    aria-selected="false"
                    class="tab-button"
                    id="btn-weekly"
                    onclick="switchTab('weekly')"
                    role="tab"
                    tabindex="-1"
                    type="button"
                >
                    Weekly
                </button>
            </div>

            <!-- Daily Forecast -->
            <div aria-labelledby="btn-daily" class="forecast-container" id="daily" role="tabpanel">
                <div class="forecast">
                    @foreach($dailyForecasts as $day)
                        <div class="forecast-day" tabindex="0">
                            <h5>{{ \Carbon\Carbon::parse($day['dt_txt'])->translatedFormat('l, d M') }}</h5>
                            <p>{{ \Carbon\Carbon::parse($day['dt_txt'])->format('h:i A') }}</p>
                            <img
                                alt="{{ $day['weather'][0]['description'] }}"
                                class="mx-auto mb-2 w-14 h-14"
                                height="60"
                                loading="lazy"
                                src="https://openweathermap.org/img/wn/{{ $day['weather'][0]['icon'] }}@2x.png"
                                title="{{ $day['weather'][0]['description'] }}"
                                width="60"
                            />
                            <p>{{ ucfirst($day['weather'][0]['description']) }}</p>
                            <p class="temp">{{ round($day['main']['temp']) }}°C</p>
                            <p>
                                Rain: {{ isset($day['rain']['3h']) ? $day['rain']['3h'] . ' mm' : 'No rain' }}
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Weekly Forecast -->
            <div aria-labelledby="btn-weekly" class="forecast-container hidden" id="weekly" role="tabpanel">
                <div class="forecast">
                    @foreach($weeklyForecasts as $week)
                        <div class="forecast-day" tabindex="0">
                            <h5>{{ $week['date'] }}</h5>
                            <img
                                alt="{{ $week['weather']['description'] }}"
                                class="mx-auto mb-2 w-14 h-14"
                                height="60"
                                loading="lazy"
                                src="https://openweathermap.org/img/wn/{{ $week['weather']['icon'] }}@2x.png"
                                title="{{ $week['weather']['description'] }}"
                                width="60"
                            />
                            <p>{{ ucfirst($week['weather']['description']) }}</p>
                            <p class="temp">{{ round($week['temp']) }}°C</p>
                            <p>Total Rainfall: {{ $week['rain'] }} mm</p>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Separator -->
            <div aria-hidden="true" class="section-separator"></div>

            <!-- Flood Risk Prediction -->
            @if(isset($floodRisk))
                <section aria-label="Flood Risk Prediction" id="flood-risk" role="region" class="@if($floodRisk === 'High') high @elseif($floodRisk === 'Medium') medium @else low @endif">
                    <h2>
                        Flood Risk Prediction
                        @if($floodRisk === 'High')
                            <i class="fas fa-exclamation-triangle text-red-600 ml-2" aria-hidden="true"></i>
                        @elseif($floodRisk === 'Medium')
                            <i class="fas fa-exclamation-circle text-orange-600 ml-2" aria-hidden="true"></i>
                        @else
                            <i class="fas fa-check-circle text-green-600 ml-2" aria-hidden="true"></i>
                        @endif
                    </h2>
                    <p>
                        Flood Risk in <strong>{{ $city }}</strong>: <span style="font-weight:700; color:#22c55e;">{{ $floodRisk }}</span>
                    </p>
                    <p>
                        Rainfall Level:
                        {{ $floodRisk === "High" ? "≥ 100mm" : ($floodRisk === "Medium" ? "50-99mm" : "< 50mm") }}
                    </p>
                    @if($floodRisk === "High")
                        <p class="important text-red-700">
                            <i class="fas fa-bell mr-2" aria-hidden="true"></i>
                            Prepare for potential flooding, stay updated with local authorities and warnings.
                        </p>
                    @elseif($floodRisk === "Medium")
                        <p class="important text-orange-600">
                            <i class="fas fa-exclamation-triangle mr-2" aria-hidden="true"></i>
                            Heavy rain expected, please stay alert for potential flooding.
                        </p>
                    @else
                        <p class="important text-green-600">
                            <i class="fas fa-check-circle mr-2" aria-hidden="true"></i>
                            Conditions are safe with no significant risk of flooding.
                        </p>
                    @endif
                </section>
            @endif
        @endif
    </section>

    <!-- Separator -->
    <div aria-hidden="true" class="section-separator"></div>

    <!-- Top Cities Section -->
    <section aria-label="Top Cities" id="top-cities">
        <h2>Top Cities</h2>
        <div class="grid" role="list">
            <a class="city-card" href="/cuaca/?city=New York" role="listitem" title="New York">
                <img alt="Flag of United States" height="38" loading="lazy" src="https://flagcdn.com/us.svg" width="56" />
                New York
            </a>
            <a class="city-card" href="/cuaca/?city=London" role="listitem" title="London">
                <img alt="Flag of United Kingdom" height="38" loading="lazy" src="https://flagcdn.com/gb.svg" width="56" />
                London
            </a>
            <a class="city-card" href="/cuaca/?city=Tokyo" role="listitem" title="Tokyo">
                <img alt="Flag of Japan" height="38" loading="lazy" src="https://flagcdn.com/jp.svg" width="56" />
                Tokyo
            </a>
            <a class="city-card" href="/cuaca/?city=Sydney" role="listitem" title="Sydney">
                <img alt="Flag of Australia" height="38" loading="lazy" src="https://flagcdn.com/au.svg" width="56" />
                Sydney
            </a>
            <a class="city-card" href="/cuaca/?city=Paris" role="listitem" title="Paris">
                <img alt="Flag of France" height="38" loading="lazy" src="https://flagcdn.com/fr.svg" width="56" />
                Paris
            </a>
            <a class="city-card" href="/cuaca/?city=Berlin" role="listitem" title="Berlin">
                <img alt="Flag of Germany" height="38" loading="lazy" src="https://flagcdn.com/de.svg" width="56" />
                Berlin
            </a>
            <a class="city-card" href="/cuaca/?city=Hanoi" role="listitem" title="Hanoi">
                <img alt="Flag of Vietnam" height="38" loading="lazy" src="https://flagcdn.com/vn.svg" width="56" />
                Hanoi
            </a>
            <a class="city-card" href="/cuaca/?city=Toronto" role="listitem" title="Toronto">
                <img alt="Flag of Canada" height="38" loading="lazy" src="https://flagcdn.com/ca.svg" width="56" />
                Toronto
            </a>
            <a class="city-card" href="/cuaca/?city=Dubai" role="listitem" title="Dubai">
                <img alt="Flag of United Arab Emirates" height="38" loading="lazy" src="https://flagcdn.com/ae.svg" width="56" />
                Dubai
            </a>
            <a class="city-card" href="/cuaca/?city=Singapore" role="listitem" title="Singapore">
                <img alt="Flag of Singapore" height="38" loading="lazy" src="https://flagcdn.com/sg.svg" width="56" />
                Singapore
            </a>
            <a class="city-card" href="/cuaca/?city=Barcelona" role="listitem" title="Barcelona">
                <img alt="Flag of Spain" height="38" loading="lazy" src="https://flagcdn.com/es.svg" width="56" />
                Barcelona
            </a>
            <a class="city-card" href="/cuaca/?city=Los Angeles" role="listitem" title="Los Angeles">
                <img alt="Flag of United States" height="38" loading="lazy" src="https://flagcdn.com/us.svg" width="56" />
                Los Angeles
            </a>
        </div>
    </section>
</main>

<script>
// Toggle search box
const searchToggle = document.getElementById("search-toggle");
const searchBoxContainer = document.getElementById("search-box-container");

function toggleSearchBox() {
    const isVisible = !searchBoxContainer.hasAttribute("hidden");
    if (isVisible) {
    searchBoxContainer.setAttribute("hidden", "");
    searchToggle.setAttribute("aria-expanded", "false");
    } else {
    searchBoxContainer.removeAttribute("hidden");
    searchToggle.setAttribute("aria-expanded", "true");
    }
}

searchToggle.addEventListener("click", toggleSearchBox);
searchToggle.addEventListener("keydown", (e) => {
    if (e.key === "Enter" || e.key === " ") {
    e.preventDefault();
    toggleSearchBox();
    }
});

document.addEventListener("click", (e) => {
    if (
    !searchBoxContainer.contains(e.target) &&
    !searchToggle.contains(e.target)
    ) {
    if (!searchBoxContainer.hasAttribute("hidden")) {
        searchBoxContainer.setAttribute("hidden", "");
        searchToggle.setAttribute("aria-expanded", "false");
    }
    }
});
document.addEventListener("keydown", (e) => {
    if (e.key === "Escape" && !searchBoxContainer.hasAttribute("hidden")) {
    searchBoxContainer.setAttribute("hidden", "");
    searchToggle.setAttribute("aria-expanded", "false");
    searchToggle.focus();
    }
});

// Forecast tabs switching
function switchTab(tab) {
    document.querySelectorAll(".tab-button").forEach((btn) => {
    btn.classList.remove("active");
    btn.setAttribute("aria-selected", "false");
    btn.setAttribute("tabindex", "-1");
    });
    document.querySelectorAll(".forecast-container").forEach((f) => {
    if (tab === "daily") {
        document.getElementById("daily").classList.remove("hidden");
        document.getElementById("weekly").classList.add("hidden");
    } else {
        document.getElementById("weekly").classList.remove("hidden");
        document.getElementById("daily").classList.add("hidden");
    }
    });
    const activeBtn = tab === "daily" ? "btn-daily" : "btn-weekly";
    const btn = document.getElementById(activeBtn);
    btn.classList.add("active");
    btn.setAttribute("aria-selected", "true");
    btn.setAttribute("tabindex", "0");
    btn.focus();
}
</script>
@endsection