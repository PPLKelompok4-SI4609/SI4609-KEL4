<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>FloodRescue</title>
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet" />
  <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
  <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
  <style>
    /* Base */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #e0f2fe 0%, #bae6fd 100%);
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 30px 15px 50px;
      color: #1e293b;
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
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 20px 40px rgba(2, 132, 199, 0.3);
      background: white;
    }
    #map {
      height: 100%;
      width: 100%;
    }
    /* Search box */
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
      transition: box-shadow 0.3s ease;
    }
    .search-box:focus-within {
      box-shadow: 0 6px 20px rgba(0,0,0,0.25);
    }
    .search-box input {
      border: none;
      outline: none;
      font-size: 1rem;
      font-weight: 500;
      color: #0f172a;
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
      padding: 0;
      margin-left: 6px;
      transition: color 0.2s ease;
    }
    .search-box button:hover {
      color: #0369a1;
    }
    /* Legend styling */
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
    #legend div:last-child {
      margin-bottom: 0;
    }
    .legend-color-box {
      width: 24px;
      height: 24px;
      border-radius: 6px;
      border: 1.5px solid #cbd5e1;
      flex-shrink: 0;
    }
    /* Colors */
    .high-risk {
      background-color: #dc2626; /* red-600 */
      box-shadow: 0 0 8px #dc2626aa;
    }
    .medium-risk {
      background-color: #f97316; /* orange-500 */
      box-shadow: 0 0 8px #f97316aa;
    }
    .low-risk {
      background-color: #eab308; /* yellow-500 */
      box-shadow: 0 0 8px #eab308aa;
    }
    /* Leaflet popup */
    .leaflet-popup-content-wrapper {
      border-radius: 12px !important;
      box-shadow: 0 8px 24px rgba(0,0,0,0.15) !important;
      font-family: 'Poppins', sans-serif;
      font-weight: 600;
      font-size: 16px;
      color: #0f172a;
      line-height: 1.3;
      padding: 12px 18px !important;
    }
    .leaflet-popup-content {
      margin: 0 !important;
    }
    .leaflet-popup-tip {
      background: #0284c7 !important;
    }
    @media (max-width: 640px) {
      #map-container {
        height: 450px;
      }
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
</head>
<body>
  <h1>Flood Risk Map</h1>
  <div id="map-container">
    <div class="search-box" role="search" aria-label="Search for city or coordinates">
      <input id="searchInput" type="text" placeholder="Search city or lat,lng" aria-label="Search city or coordinates" autocomplete="off" />
      <button id="searchBtn" aria-label="Search">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="#0284c7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search" viewBox="0 0 24 24" width="20" height="20"><circle cx="11" cy="11" r="7"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
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
    // Initialize map centered on first flood zone or fallback coords
    const floodZones = @json($floodZones);
    const initialLat = floodZones.length ? floodZones[0].latitude : -2.5;
    const initialLng = floodZones.length ? floodZones[0].longitude : 118.0;

    const map = L.map('map', { zoomControl: true }).setView([initialLat, initialLng], 5);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    // Store markers for search
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

      const marker = L.circleMarker([city.latitude, city.longitude], {
        color: '#334155',
        weight: 1.8,
        fillColor: color,
        fillOpacity: 0.85,
        radius: 9,
        riseOnHover: true,
        className: 'cursor-pointer'
      }).addTo(map).bindPopup(
        `<strong>${city.city}</strong><br>` +
        `Risk Level: <span style="color:${color}; font-weight:700;">${city.riskLevel}</span><br>` +
        `River Discharge: ${city.riverDischarge}`
      );

      markers.push({ city: city.city.toLowerCase(), marker, latlng: [city.latitude, city.longitude] });
    });

    // Search functionality
    const searchInput = document.getElementById('searchInput');
    const searchBtn = document.getElementById('searchBtn');

    function searchLocation() {
      const query = searchInput.value.trim().toLowerCase();
      if (!query) return;

      // Try to find city by exact name match
      const found = markers.find(m => m.city === query);

      if (found) {
        map.setView(found.latlng, 12, { animate: true });
        found.marker.openPopup();
        return;
      }

      // Try to parse coordinates (lat,lng)
      const coords = query.split(',').map(s => s.trim());
      if (coords.length === 2) {
        const lat = parseFloat(coords[0]);
        const lng = parseFloat(coords[1]);
        if (!isNaN(lat) && !isNaN(lng) && lat >= -90 && lat <= 90 && lng >= -180 && lng <= 180) {
          map.setView([lat, lng], 12, { animate: true });
          return;
        }
      }

      // Leaflet Control Geocoder
      if (typeof L.Control.Geocoder !== 'undefined') {
        const geocoder = L.Control.Geocoder.nominatim();
        geocoder.geocode(query, results => {
          if (results.length > 0) {
            const result = results[0];
            map.setView(result.center, 12, { animate: true });
            L.popup()
              .setLatLng(result.center)
              .setContent(`<strong>${result.name}</strong>`)
              .openOn(map);
          } else {
            alert('Location not found. Please try another search term.');
          }
        });
      } else {
        alert('Location not found. Please try another search term.');
      }
    }

    searchBtn.addEventListener('click', searchLocation);
    searchInput.addEventListener('keydown', e => {
      if (e.key === 'Enter') {
        e.preventDefault();
        searchLocation();
      }
    });
  </script>
</body>
</html>