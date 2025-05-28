@extends('admin.layouts.app')

@section('title', 'FloodRescue | Kelola Peta Wilayah Banjir')

@section('content')
  {{-- Leaflet & Geocoder JS --}}
  <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
  <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>

  {{-- Leaflet & Custom CSS --}}
  <style>
    * {
      margin: 0; padding: 0; box-sizing: border-box;
    }

    h1 {
      font-weight: 700;
      font-size: 2.75rem;
      margin-bottom: 1rem;
      text-align: center;
      color: #0c4a6e;
      text-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }

    #map-container {
      position: relative;
      width: 100%;
      max-width: 1200px;
      height: 600px;
      margin: 0 auto;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 20px 40px rgba(2, 132, 199, 0.3);
      background: white;
    }

    #map {
      height: 100%;
      width: 100%;
    }

    .search-box {
      position: absolute;
      top: 15px;
      right: 15px;
      z-index: 1000;
      background: rgba(255, 255, 255, 0.95);
      border-radius: 9999px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.15);
      display: flex;
      align-items: center;
      padding: 6px 14px;
      width: 280px;
    }

    .search-box input {
      border: none;
      outline: none;
      font-size: 1rem;
      font-weight: 500;
      width: 100%;
      background: transparent;
      padding-right: 30px;
      font-family: 'Poppins', sans-serif;
    }

    .search-box button {
      background: transparent;
      border: none;
      cursor: pointer;
      color: #0284c7;
      font-size: 1.25rem;
      margin-left: 6px;
    }

    #legend {
      margin-top: 25px;
      background: white;
      max-width: 280px;
      width: 100%;
      border-radius: 12px;
      padding: 18px 24px;
      box-shadow: 0 10px 30px rgba(2, 132, 199, 0.15);
      font-size: 15px;
      color: #334155;
      font-weight: 600;
      user-select: none;
    }

    #legend div {
      display: flex;
      align-items: center;
      gap: 14px;
      margin-bottom: 14px;
    }

    .legend-color-box {
      width: 24px;
      height: 24px;
      border-radius: 6px;
      border: 1.5px solid #cbd5e1;
    }

    .high-risk { background-color: #dc2626; box-shadow: 0 0 8px #dc2626aa; }
    .medium-risk { background-color: #f97316; box-shadow: 0 0 8px #f97316aa; }
    .low-risk { background-color: #eab308; box-shadow: 0 0 8px #eab308aa; }

    .leaflet-popup-content-wrapper {
      border-radius: 12px !important;
      box-shadow: 0 8px 24px rgba(0,0,0,0.15) !important;
      font-family: 'Poppins', sans-serif;
      font-weight: 600;
      font-size: 16px;
      color: #0f172a;
      padding: 12px 18px !important;
    }

    .leaflet-popup-tip {
      background: #0284c7 !important;
    }

    @media (max-width: 640px) {
      #map-container { height: 450px; }
      .search-box {
        width: 90%;
        right: 5%;
        top: 10px;
        padding: 6px 12px;
      }
      #legend {
        max-width: 100%;
        font-size: 14px;
        padding: 14px 18px;
      }
    }
  </style>

  <h1>Peta Wilayah Banjir</h1>
  <div id="map-container">
    <div class="search-box" role="search" aria-label="Cari kota atau koordinat">
      <input id="searchInput" type="text" placeholder="Search city or lat,lng" aria-label="Search input" />
      <button id="searchBtn" aria-label="Search button">
        <svg xmlns="http://www.w3.org/2000/svg" stroke="#0284c7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search" viewBox="0 0 24 24" width="20" height="20">
          <circle cx="11" cy="11" r="7" />
          <line x1="21" y1="21" x2="16.65" y2="16.65" />
        </svg>
      </button>
    </div>
    <div id="map"></div>
  </div>

  <div id="legend" aria-label="Flood risk legend">
    <div><span class="legend-color-box high-risk"></span> High Risk (75%-100%)</div>
    <div><span class="legend-color-box medium-risk"></span> Medium Risk (50%-75%)</div>
    <div><span class="legend-color-box low-risk"></span> Low Risk (30%-50%)</div>
  </div>

  <script>
    document.addEventListener("DOMContentLoaded", () => {
      const floodZones = @json($floodZones);
      const initialLat = floodZones.length ? floodZones[0].latitude : -6.9175;
      const initialLng = floodZones.length ? floodZones[0].longitude : 107.6191;

      const map = L.map('map').setView([initialLat, initialLng], 7);

      // Basemap
      L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
        attribution: '&copy; OpenStreetMap, &copy; CARTO',
        maxZoom: 19
      }).addTo(map);

      // Force resize
      setTimeout(() => map.invalidateSize(), 500);

      const markers = [];

      // Add flood zone markers
      floodZones.forEach(zone => {
        let color = '#eab308';
        if (zone.riskLevel === 'High') color = '#dc2626';
        else if (zone.riskLevel === 'Medium') color = '#f97316';

        const marker = L.circleMarker([zone.latitude, zone.longitude], {
          color: '#334155',
          fillColor: color,
          fillOpacity: 0.85,
          radius: 9
        }).addTo(map).bindPopup(
          `<strong>${zone.city}</strong><br>` +
          `Risk Level: <span style="color:${color}">${zone.riskLevel}</span><br>` +
          `River Discharge: ${zone.riverDischarge}`
        );

        markers.push({ city: zone.city.toLowerCase(), marker, latlng: [zone.latitude, zone.longitude] });
      });

      const searchInput = document.getElementById('searchInput');
      const searchBtn = document.getElementById('searchBtn');

      function searchLocation() {
        const query = searchInput.value.trim().toLowerCase();
        if (!query) return;

        const found = markers.find(m => m.city === query);
        if (found) {
          map.setView(found.latlng, 12);
          found.marker.openPopup();
          return;
        }

        const coords = query.split(',').map(s => parseFloat(s.trim()));
        if (coords.length === 2 && !isNaN(coords[0]) && !isNaN(coords[1])) {
          map.setView(coords, 12);
          return;
        }

        if (typeof L.Control.Geocoder !== 'undefined') {
          const geocoder = L.Control.Geocoder.nominatim();
          geocoder.geocode(query, results => {
            if (results.length > 0) {
              const result = results[0];
              map.setView(result.center, 12);
              L.popup()
                .setLatLng(result.center)
                .setContent(`<strong>${result.name}</strong>`)
                .openOn(map);
            } else {
              alert('Lokasi tidak ditemukan.');
            }
          });
        } else {
          alert('Geocoder tidak tersedia.');
        }
      }

      searchBtn.addEventListener('click', searchLocation);
      searchInput.addEventListener('keydown', e => {
        if (e.key === 'Enter') {
          e.preventDefault();
          searchLocation();
        }
      });
    });
  </script>
@endsection