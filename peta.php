<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Peta Lokasi Wisata</title>
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
  <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
  <style>
    #map { height: 500px; }
  </style>
</head>
<body>
  <h2 class="text-center">Peta Lokasi Wisata</h2>
  <div id="map"></div>

  <script>
    // Buat peta, posisi awal Indonesia
    var map = L.map('map').setView([-2.5489, 118.0149], 5);

    // Tambahkan layer OpenStreetMap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    // Ambil data wisata dari PHP (JSON)
    fetch('get_wisata.php')
      .then(response => response.json())
      .then(data => {
        data.forEach(w => {
          if (w.latitude && w.longitude) {
            L.marker([w.latitude, w.longitude])
              .addTo(map)
              .bindPopup("<b>" + w.nama_tempat + "</b>");
          }
        });
      });
  </script>
</body>
</html>
