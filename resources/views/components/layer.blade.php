
<div id="map">
    <div class="weather-info">
        <h3>Informasi Cuaca</h3>
        <ul>
          {{-- <li><span><strong>Lokasi:</strong></span> <span id="location">Loading...</span></li> --}}
          <li><span><strong>Suhu:</strong></span> <span id="temperature">Loading...</span></li>
          <li><span><strong>Kelembapan:</strong></span> <span id="humidity">Loading...</span></li>
          <li><span><strong>Angin:</strong></span> <span id="wind">Loading...</span></li>
          <li><span><strong>Deskripsi:</strong></span> <span id="description">Loading...</span></li>
        </ul>
      </div>

      <div id="sidebar2" class="sidebar2">
        <button id="closeSidebar">&times;</button>
        <h3>Detail Lokasi</h3>

        <p><strong>Nama:</strong> <span id="sidebar-nama"></span></p>
        <p><strong>No HP:</strong> <span id="sidebar-no_hp"></span></p>
        <p><strong>Nama Kebun:</strong> <span id="sidebar-nama_kebun"></span></p>
        <p><strong>Luas:</strong> <span id="sidebar-luas"></span> ha</p>
        <p><strong>Elevasi:</strong> <span id="sidebar-elevasi"></span> m</p>
        <p><strong>Kelompok Tani:</strong> <span id="sidebar-kelompok"></span></p>
        <p><strong>Ketua Kelompok:</strong> <span id="sidebar-leader"></span></p>
        <p><strong>No HP Ketua:</strong> <span id="sidebar-no_leader"></span></p>
        <p><strong>Alamat Ketua:</strong> <span id="sidebar-al_leader"></span></p>
        <p><strong>Komoditi:</strong> <span id="sidebar-komoditi"></span></p>
        <p><strong>Varietas:</strong> <span id="sidebar-varietas"></span></p>
        <p><strong>Jenis Tanaman:</strong> <span id="sidebar-tanaman"></span></p>
        <p><strong>Jumlah Bibit:</strong> <span id="sidebar-jumb_bibit"></span></p>
    </div>


</div>

<script src="{{ asset('assets/leaflet/js/qgis2web_expressions.js')}}"></script>
<script src="{{ asset('assets/leaflet/js/leaflet.rotatedMarker.js')}}"></script>
<script src="{{ asset('assets/leaflet/js/leaflet.pattern.js')}}"></script>
<script src="{{ asset('assets/leaflet/js/leaflet-hash.js')}}"></script>
  <script src="{{ asset('assets/leaflet/js/Autolinker.min.js')}}"></script>
  <script src="{{ asset('assets/leaflet/js/rbush.min.js')}}"></script>
  <script src="{{ asset('assets/leaflet/js/labelgun.min.js')}}"></script>
  <script src="{{ asset('assets/leaflet/js/labels.js')}}"></script>
<script type="text/javascript">

    var googleTerrain = L.tileLayer('http://{s}.google.com/vt?lyrs=p&x={x}&y={y}&z={z}',{
maxZoom: 20,
subdomains:['mt0','mt1','mt2','mt3']
});


    var peta3 = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        });

      var  googleHybrid = L.tileLayer('http://{s}.google.com/vt?lyrs=s,h&x={x}&y={y}&z={z}',{
maxZoom: 20,
subdomains:['mt0','mt1','mt2','mt3']
});

        var googleStreets = L.tileLayer('http://{s}.google.com/vt?lyrs=m&x={x}&y={y}&z={z}',{
maxZoom: 20,
subdomains:['mt0','mt1','mt2','mt3']
});


        var maps = L.map('map',{
          center:[3.64506,125.4326562],
          zoom:12.5,
          layers :[googleHybrid]
        });

        var baseMaps = {
        "Peta Hybrid": googleHybrid,
        "Peta Streets": googleStreets,
        "Peta Terrain": googleTerrain


    };

    var layerControl = L.control.layers(baseMaps, null, { position: "topleft" }).addTo(maps);




        // Load GeoJSON data
        fetch('/admin/getgeojson')
    .then(response => response.json())
    .then(data => {
        var geojsonLayer = L.geoJSON(data, {
            pointToLayer: function (feature, latlng) {
                var jenisTanaman = feature.properties.tanaman
                    ? feature.properties.tanaman.trim().toLowerCase()
                    : "default";
            console.log(jenisTanaman);

                // Tentukan URL gambar berdasarkan jenis tanaman
                var iconUrl = "";
                if (jenisTanaman === "tomat") {
                    iconUrl = "../img/Tomato.png";  // Sesuaikan dengan lokasi gambar
                } else if (jenisTanaman === "cabe") {
                    iconUrl = "../img/cabe.png";
                } else if (jenisTanaman === "ketimun") {
                    iconUrl = "../img/timun.jpg";
                } else if (jenisTanaman === "terong") {
                    iconUrl = "../img/terong.jpg";
                } else if (jenisTanaman === "buncis") {
                    iconUrl = "../img/buncis.jpg";
                } else if (jenisTanaman === "caisin") {
                    iconUrl = "../img/caisin.jpg";
                } else {
                    iconUrl = "../img/logo.png"; // Gambar default jika tidak ditemukan
                }

                // Buat custom divIcon untuk menampilkan gambar di dalam marker
                var customIcon = L.divIcon({
                    className: "custom-marker",
                    html: `<div class="marker-container" style="background-image: url('${iconUrl}');"></div>`,
                    iconSize: [40, 40],
                    iconAnchor: [20, 40],
                    popupAnchor: [0, -40]
                });

                return L.marker(latlng, { icon: customIcon });
            },
            onEachFeature: function (feature, layer) {
                layer.on('click', function () {
                    // Tampilkan sidebar saat marker diklik
                    document.getElementById("sidebar2").classList.add("active");

                    // Isi data sidebar dari marker yang diklik
                    document.getElementById("sidebar-nama").textContent = feature.properties.Nama || "Tidak Ada";
                    document.getElementById("sidebar-no_hp").textContent = feature.properties.no_hp || "Tidak Ada";
                    document.getElementById("sidebar-nama_kebun").textContent = feature.properties.lokasi|| "Tidak Ada";
                    document.getElementById("sidebar-luas").textContent = feature.properties.luas || "Tidak Ada";
                    document.getElementById("sidebar-elevasi").textContent = feature.properties.elevasi || "Tidak Ada";
                    document.getElementById("sidebar-kelompok").textContent = feature.properties.kelompok || "Tidak Ada";
                    document.getElementById("sidebar-leader").textContent = feature.properties.leader || "Tidak Ada";
                    document.getElementById("sidebar-no_leader").textContent = feature.properties.no_leader || "Tidak Ada";
                    document.getElementById("sidebar-al_leader").textContent = feature.properties.al_leader || "Tidak Ada";
                    document.getElementById("sidebar-komoditi").textContent = feature.properties.komoditi || "Tidak Ada";
                    document.getElementById("sidebar-varietas").textContent = feature.properties.varietas || "Tidak Ada";
                    document.getElementById("sidebar-tanaman").textContent = feature.properties.tanaman || "Tidak Ada";
                    document.getElementById("sidebar-jumb_bibit").textContent = feature.properties.jumb_bibit || "Tidak Ada";
                });
            }
        }).addTo(maps);
          // Sesuaikan tampilan peta agar mencakup semua data
        var bounds = geojsonLayer.getBounds();
        if (bounds.isValid()) {
            maps.fitBounds(bounds);
        } else {
            console.warn("GeoJSON tidak memiliki fitur dengan koordinat yang valid.");
        }
    })
    .catch(error => console.error('Error loading GeoJSON:', error));


   // Fungsi untuk menutup sidebar
            document.getElementById("closeSidebar").addEventListener("click", function () {
                document.getElementById("sidebar2").classList.remove("active");
            });

     // Fungsi untuk mengambil data cuaca
     async function fetchWeather(lat, lon) {
  try {
    const apiKey = 'e9ac85b92a87dac020fe642ca7984888';
    const url = `https://api.openweathermap.org/data/2.5/weather?lat=${lat}&lon=${lon}&units=metric&lang=id&appid=${apiKey}`;
    console.log('Fetching weather data from URL:', url);

    const response = await fetch(url);
    console.log('Response status:', response.status);

    if (!response.ok) {
      throw new Error(`HTTP Error: ${response.status} - ${response.statusText}`);
    }

    const data = await response.json();
    console.log('Weather data received:', data);

    // Update DOM elements
    // document.getElementById('location').textContent = data.name || 'Tidak diketahui';
    document.getElementById('temperature').textContent = `${data.main.temp}°C`;
    document.getElementById('humidity').textContent = `${data.main.humidity}%`;
    document.getElementById('wind').textContent = `${data.wind.speed} m/s`;
    document.getElementById('description').textContent = data.weather[0].description || 'Tidak tersedia';
  } catch (error) {
    console.error('Error while fetching weather data:', error);
    document.getElementById('location').textContent = 'Error';
    document.getElementById('temperature').textContent = 'Error';
    document.getElementById('humidity').textContent = 'Error';
    document.getElementById('wind').textContent = 'Error';
    document.getElementById('description').textContent = 'Error';
  }
}



  // Ambil lokasi pusat peta dan tampilkan cuaca
  maps.on('moveend', function () {
    const center = maps.getCenter();
    console.log('Map center moved to:', center.lat, center.lng);
    fetchWeather(center.lat, center.lng);
  });

  maps.on('click', function(e) {
  const lat = e.latlng.lat;
  const lon = e.latlng.lng;
  console.log('Map clicked at:', lat, lon);
  fetchWeather(lat, lon);  // Menampilkan cuaca berdasarkan lokasi yang diklik
});

  // Panggilan awal
  fetchWeather(3.64506,125.4326562);

    </script>
