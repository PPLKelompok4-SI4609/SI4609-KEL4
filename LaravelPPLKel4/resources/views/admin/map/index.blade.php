@extends('admin.layouts.app')

@section('title', 'FloodRescue | Kelola Peta Wilayah Banjir')

@section('content')
<!-- Leaflet CSS -->
<link href="https://unpkg.com/leaflet/dist/leaflet.css" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet"/>

<style>
  /* Custom Styles */
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }

  #map-container {
    height: 85vh;
    position: relative;
    font-family: 'Poppins', sans-serif;
    background-color: #f9fafb;
    border-radius: 12px;
  }

  #map {
    width: 100%;
    height: 100%;
    border-radius: 12px;
    box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
    position: relative;
    z-index: 0;
  }

  /* Search Box */
  #search-container {
    position: absolute;
    top: 1.5rem;
    right: 1.5rem;
    z-index: 1000;
  }

  #searchWrapper {
    width: 48px;
    height: 48px;
    background: white;
    border-radius: 9999px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
  }

  #searchWrapper.expanded {
    width: 224px;
    box-shadow: 0 6px 18px rgba(0, 0, 0, 0.15);
  }

  #searchToggle {
    width: 48px;
    height: 48px;
    background: transparent;
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #4B5563;
  }

  #searchForm {
    position: relative;
    width: 0;
    opacity: 0;
    pointer-events: none;
    transition: width 0.3s ease, opacity 0.3s ease;
  }

  #searchWrapper.expanded #searchForm {
    width: 14rem;
    opacity: 1;
    pointer-events: auto;
  }

  #searchInput {
    width: 100%;
    padding-left: 1rem;
    padding-right: 1rem;
    height: 48px;
    border-radius: 9999px;
    background-color: white;
    font-size: 1rem;
    font-weight: 500;
    color: #333333;
    border: none; 
    outline: none;
    transition: background-color 0.2s ease;
  }

  /* Legend */
  #legend {
    background-color: #ffffff;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    border-radius: 12px;
    padding: 1rem;
    width: 220px;
    z-index: 10;
    color: #333333;
  }

  .legend-color-box {
    width: 16px;
    height: 16px;
    border-radius: 0.25rem;
    transition: transform 0.2s ease-in-out;
  }

  .legend-color-box:hover {
    transform: scale(1.1); /* Zoom Effect */
  }

  .high-risk {
    background: linear-gradient(135deg, #dc2626, #b91c1c);
  }

  .medium-risk {
    background: linear-gradient(135deg, #f97316, #c2410c);
  }

  .low-risk {
    background: linear-gradient(135deg, #eab308, #a16207);
  }

  /* Visual Enhancements */
  .text-gray-500 {
    color: #4B5563;
  }

  .font-semibold {
    font-weight: 600;
  }
</style>

<h1 class="font-extrabold text-4xl mb-4 text-center text-blue-600 drop-shadow-sm">
  Peta Wilayah Banjir
</h1>
<div class="relative w-full h-screen" id="map-container" style="font-family: 'Poppins', sans-serif;">
  <!-- Map -->
  <div class="w-full h-full rounded-xl shadow-lg" id="map"></div>
  <!-- Legend -->
  <div class="absolute bottom-6 left-6 bg-white rounded-xl p-6 shadow-lg max-w-xs w-64 z-20 select-none text-gray-700" id="legend">
    <h3 class="font-semibold text-xl mb-4 text-blue-900">Flood Risk Levels</h3>
    <div class="flex items-center gap-4 mb-2 cursor-pointer group" tabindex="0" role="button" aria-label="High flood risk level">
      <span class="legend-color-box high-risk flex items-center justify-center transition-transform duration-200 group-hover:scale-105">
        <svg class="w-5 h-5 animate-pulse" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
          <path d="M12 2L15 8l6 1-4.5 4.5L18 21l-6-3-6 3 1.5-7.5L3 9l6-1 3-7z"/>
        </svg>
      </span>
      <div>
        <div class="font-semibold">High (75%-100%)</div>
        <div class="text-sm text-gray-500 mt-0.5">Severe flood risk, immediate action needed.</div>
      </div>
    </div>
    <div class="flex items-center gap-4 mb-2 cursor-pointer group" tabindex="0" role="button" aria-label="Medium flood risk level">
      <span class="legend-color-box medium-risk flex items-center justify-center transition-transform duration-200 group-hover:scale-105">
        <svg class="w-5 h-5 animate-pulse" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
          <circle cx="12" cy="12" r="6"/>
          <path d="M12 6v6l4 2"/>
        </svg>
      </span>
      <div>
        <div class="font-semibold">Medium (50%-75%)</div>
        <div class="text-sm text-gray-500 mt-0.5">Moderate flood risk, stay alert.</div>
      </div>
    </div>
    <div class="flex items-center gap-4 mb-4 cursor-pointer group" tabindex="0" role="button" aria-label="Low flood risk level">
      <span class="legend-color-box low-risk flex items-center justify-center transition-transform duration-200 group-hover:scale-105">
        <svg class="w-5 h-5 animate-pulse" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
          <path d="M4 12h16M4 16h10"/>
        </svg>
      </span>
      <div>
        <div class="font-semibold">Low (30%-50%)</div>
        <div class="text-sm text-gray-500 mt-0.5">Low flood risk, monitor updates.</div>
      </div>
    </div>
    <hr class="border-gray-300 mb-4"/>
    <div class="flex items-center gap-3 text-gray-600 font-normal" aria-label="River Discharge Indicator updated daily">
      <img alt="River Discharge Icon" class="w-6 h-6 rounded transition-transform duration-300 hover:scale-110" src="https://storage.googleapis.com/a1aa/image/6e4a8606-1005-41e9-93de-0e5d2de6e605.jpg" />
      <div class="text-sm">River Discharge Indicator (updated daily) <span class="text-xs text-gray-400">(m³/s)</span></div>
    </div>
  </div>

  <!-- Search Box -->
  <div class="absolute top-6 right-6 z-30" id="search-container">
    <div id="searchWrapper" class="relative flex items-center bg-white rounded-full shadow-md cursor-pointer w-12 h-12 transition-all duration-300 ease-in-out overflow-hidden">
      <form id="searchForm" class="flex items-center bg-white rounded-full pl-12 pr-2 h-12 w-0 opacity-0 pointer-events-none transition-all duration-300 ease-in-out" role="search" autocomplete="off" onsubmit="return false;">
        <input id="searchInput" name="search" type="text" placeholder="Search city" aria-label="Search city" class="w-full h-10 bg-transparent text-gray-900 placeholder-gray-400 font-poppins text-sm font-medium focus:outline-none" />
      </form>
      <button aria-label="Toggle search input" id="searchToggle" class="flex items-center justify-center w-12 h-12 text-gray-900 focus:outline-none bg-transparent border-none z-20 absolute left-0 top-0">
        <svg class="feather feather-search w-5 h-5 mx-auto my-auto" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <circle cx="11" cy="11" r="7"></circle>
          <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
        </svg>
      </button>
    </div>
  </div>
</div>

<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>

<script>
  document.addEventListener('DOMContentLoaded', function () {
      const floodZones = @json($floodZones) || [];

      const indonesiaBounds = [
          [-11.0, 94.0],  // Southwest corner (Southern Sumatra)
          [6.5, 141.0]    // Northeast corner (Papua)
      ];

      const map = L.map('map', { zoomControl: true }).fitBounds(indonesiaBounds);

      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
          attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
          maxZoom: 18,
      }).addTo(map);

      setTimeout(() => {
          map.invalidateSize();
      }, 200);

      const markers = [];

      floodZones.forEach(city => {
          let color;
          if (city.riskLevel === 'High') {
              color = '#dc2626';
          } else if (city.riskLevel === 'Medium') {
              color = '#f97316';
          } else {
              color = '#eab308';
          }

          const svgIcon = L.divIcon({
              className: '',
              html: `
                  <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg" style="filter: drop-shadow(0 0 10px ${color});">
                      <circle cx="18" cy="18" r="14" stroke="#334155" stroke-width="2" fill="${color}" fill-opacity="0.85"/>
                      <circle cx="18" cy="18" r="8" fill="white" fill-opacity="0.3"/>
                      <circle cx="18" cy="18" r="14" stroke="${color}" stroke-width="2" fill="none">
                          <animate attributeName="r" values="14;20;14" dur="2.5s" repeatCount="indefinite" />
                          <animate attributeName="opacity" values="1;0;1" dur="2.5s" repeatCount="indefinite" />
                      </circle>
                  </svg>
              `,
              iconSize: [36, 36],
              iconAnchor: [18, 18],
              popupAnchor: [0, -18],
          });

          const marker = L.marker([city.latitude, city.longitude], { icon: svgIcon, riseOnHover: true, keyboard: true })
              .addTo(map)
              .bindPopup(
                  `<strong class="font-semibold text-lg">${city.city}</strong><br>` +
                  `Risk Level: <span style="color:${color}; font-weight:700;">${city.riskLevel}</span><br>` +
                  `River Discharge: <span style="font-weight:600;">${city.riverDischarge} m³/s</span>`
              );

          markers.push({ city: city.city.toLowerCase(), marker, latlng: [city.latitude, city.longitude] });
      });

      const searchWrapper = document.getElementById('searchWrapper');
      const searchToggle = document.getElementById('searchToggle');
      const searchForm = document.getElementById('searchForm');
      const searchInput = document.getElementById('searchInput');

      searchToggle.addEventListener('click', () => {
          if (!searchWrapper.classList.contains('expanded')) {
              searchWrapper.classList.add('expanded');
              searchInput.focus();
          }
      });

      function searchLocation() {
          const query = searchInput.value.trim().toLowerCase();
          if (!query) {
              // Reset map to default view
              map.setView([ -6.2088, 106.8456 ], 5, { animate: true });  // Default to Jakarta coordinates
              return;
          }

          const found = markers.find(m => m.city === query);

          if (found) {
              map.setView(found.latlng, 12, { animate: true });
              found.marker.openPopup();
          } else {
              alert('City not found. Please try another search term.');
          }
      }

      searchForm.addEventListener('submit', e => {
          e.preventDefault();
          searchLocation();
      });

      searchInput.addEventListener('keydown', e => {
          if (e.key === 'Enter') {
              e.preventDefault();
              searchLocation();
          }
      });

      document.addEventListener('click', (e) => {
          if (!searchWrapper.contains(e.target)) {
              if (searchWrapper.classList.contains('expanded')) {
                  searchWrapper.classList.remove('expanded');
                  searchInput.value = '';
              }
          }
      });

      document.addEventListener('keydown', (e) => {
          if (e.key === 'Escape') {
              if (searchWrapper.classList.contains('expanded')) {
                  searchWrapper.classList.remove('expanded');
                  searchInput.value = '';
              }
          }
      });
  });
</script>
@endsection