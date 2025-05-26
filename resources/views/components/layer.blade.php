
<div id="map">
    <div class="weather-info">
        <h3>Informasi Cuaca</h3>
        <ul>
          {{-- <li><span><strong>Lokasi:</strong></span> <span id="location">Loading...</span></li> --}}
          <li><span><i class="fas fa-temperature-high"></i><strong> Suhu:</strong></span> <span id="temperature">Loading...</span></li>
          <li><span><i class="fas fa-tint"></i><strong> Kelembapan:</strong></span> <span id="humidity">Loading...</span></li>
          <li><span><i class="fas fa-wind"></i><strong> Angin:</strong></span> <span id="wind">Loading...</span></li>
          <li><span><i class="fas fa-cloud-sun"></i><strong> Deskripsi:</strong></span> <span id="description">Loading...</span></li>
        </ul>

         <div class="legend mt-3">
    <h4><i class="fas fa-palette"></i> Warna Tanaman</h4>
    <ul style="list-style: none; padding-left: 0;">
      <li><span class="legend-color" style="background-color: #ff0000;"></span> Cabe</li>
    <li><span class="legend-color" style="background-color: #fa8072;"></span> Tomat</li>
    <li><span class="legend-color" style="background-color: #02873c;"></span> Ketimun</li>
    <li><span class="legend-color" style="background-color: #610378;"></span> Terong</li>
    <li><span class="legend-color" style="background-color: #089f4a;"></span> Buncis</li>
    <li><span class="legend-color" style="background-color: #1dfc7f;"></span> Caisin</li>
    <li><span class="legend-color" style="background-color: #3388ff;"></span> Lainnya</li>
    </ul>
  </div>
      </div>

     <div id="sidebar2" class="sidebar2 shadow">
  <button id="close">&times;</button>

  <div class="card p-4">
    <h5><i class="fas fa-map-marker-alt me-2"></i> Detail Lokasi</h5>

    <dl class="row">
      <dt class="col-sm-5">Nama:</dt>
      <dd class="col-sm-7" id="sidebar-nama"></dd>

      <dt class="col-sm-5">No HP:</dt>
      <dd class="col-sm-7" id="sidebar-no_hp"></dd>

      <dt class="col-sm-5">Nama Kebun:</dt>
      <dd class="col-sm-7" id="sidebar-nama_kebun"></dd>

      <dt class="col-sm-5">Luas:</dt>
      <dd class="col-sm-7"><span id="sidebar-luas"></span> ha</dd>

      <dt class="col-sm-5">Elevasi:</dt>
      <dd class="col-sm-7"><span id="sidebar-elevasi"></span> m</dd>

      <dt class="col-sm-5">Kelompok Tani:</dt>
      <dd class="col-sm-7" id="sidebar-kelompok"></dd>

      <dt class="col-sm-5">Ketua Kelompok:</dt>
      <dd class="col-sm-7" id="sidebar-leader"></dd>

      <dt class="col-sm-5">No HP Ketua:</dt>
      <dd class="col-sm-7" id="sidebar-no_leader"></dd>

      <dt class="col-sm-5">Alamat Ketua:</dt>
      <dd class="col-sm-7" id="sidebar-al_leader"></dd>

      <dt class="col-sm-5">Komoditi:</dt>
      <dd class="col-sm-7" id="sidebar-komoditi"></dd>

      <dt class="col-sm-5">Varietas:</dt>
      <dd class="col-sm-7" id="sidebar-varietas"></dd>

      <dt class="col-sm-5">Jenis Tanaman:</dt>
      <dd class="col-sm-7" id="sidebar-tanaman"></dd>

      <dt class="col-sm-5">Jumlah Bibit:</dt>
      <dd class="col-sm-7" id="sidebar-jumb_bibit"></dd>

     <dt class="col-sm-5">Gambar:</dt>
<dd class="col-sm-7" id="sidebar-images" class="d-flex flex-wrap gap-1"></dd>

    </dl>
  </div>


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


let geojsonLayer;  // Variabel global untuk layer GeoJSON

// Fungsi untuk load dan render GeoJSON ke peta
function loadGeoJSON(data) {
    // Hapus layer lama jika ada
    if (geojsonLayer) {
        maps.removeLayer(geojsonLayer);
    }

    geojsonLayer = L.geoJSON(data, {
        style: function(feature) {
        // Styling untuk polygon dan multipolygon
        if (feature.geometry.type === "Polygon" || feature.geometry.type === "MultiPolygon") {
            var jenisTanaman = feature.properties.tanaman
                ? feature.properties.tanaman.trim().toLowerCase()
                : "default";

            var warna = "#3388ff"; //
            if (jenisTanaman === "cabe") {
                warna = "#ff0000";
            } else if (jenisTanaman === "tomat") {
                warna = "#fa8072";
            }else if (jenisTanaman === "ketimun") {
                warna = "#02873c";
            }else if (jenisTanaman === "terong") {
                warna = "#610378";
            } else if (jenisTanaman === "buncis") {
                warna = "#089f4a";
            } else if (jenisTanaman === "caisin") {
                warna = "#1dfc7f";
            }

            return {
                color: warna,      // warna garis tepi (opsional, bisa disesuaikan)
                fillColor: warna,      // warna isi polygon
                weight: 2,
                fillOpacity: 0.4
            };
        }
        return {};
    },
        pointToLayer: function(feature, latlng) {
            // Ambil jenis tanaman (lowercase dan trim)
            var jenisTanaman = feature.properties.tanaman
                ? feature.properties.tanaman.trim().toLowerCase()
                : "default";

            // Tentukan icon berdasarkan jenis tanaman
            var iconUrl = "";
            if (jenisTanaman === "tomat") {
                iconUrl = "../img/Tomato.png";
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
                iconUrl = "../img/logo.png";
            }

            // Custom icon dengan gambar
            var customIcon = L.divIcon({
                className: "custom-marker",
                html: `<div class="marker-container" style="background-image: url('${iconUrl}'); width: 40px; height: 40px;"></div>`,
                iconSize: [40, 40],
                iconAnchor: [20, 40],
                popupAnchor: [0, -40]
            });

            return L.marker(latlng, { icon: customIcon });
        },
        onEachFeature: function(feature, layer) {
            // Event klik marker / polygon
            layer.on('click', function () {
                // Tampilkan sidebar
                document.getElementById("sidebar2").classList.add("active");
                document.getElementById("sidebar-nama").textContent = feature.properties.Nama || feature.properties.nama || "Tidak Ada";
                document.getElementById("sidebar-no_hp").textContent = feature.properties.no_hp || "Tidak Ada";
                document.getElementById("sidebar-nama_kebun").textContent = feature.properties.lokasi || "Tidak Ada";
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

                // Ambil container gambar
                const imgContainer = document.getElementById("sidebar-images");
                imgContainer.innerHTML = ''; // Clear gambar lama

                // Ambil gambar berdasarkan nama & tanaman dari server
                const nama = feature.properties.Nama || feature.properties.nama;
                const tanaman = feature.properties.tanaman;

                if (nama && tanaman) {
                    fetch(`/admin/geodata/images-by-name-plant/${encodeURIComponent(nama)}/${encodeURIComponent(tanaman)}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.images && data.images.length > 0) {
                                data.images.forEach(img => {
                                    const imgElem = document.createElement('img');
                                    imgElem.src = `/storage/images/${img}`;
                                    imgElem.className = 'img-thumbnail me-1';
                                    imgElem.style.width = '80px';
                                    imgContainer.appendChild(imgElem);
                                });
                            } else {
                                imgContainer.textContent = 'Tidak ada gambar';
                            }
                        })
                        .catch(() => {
                            imgContainer.textContent = 'Gagal memuat gambar';
                        });
                } else {
                    imgContainer.textContent = 'Tidak ada nama atau jenis tanaman';
                }
            });
        }
    }).addTo(maps);

    // Zoom peta supaya mencakup semua feature
    var bounds = geojsonLayer.getBounds();
    if (bounds.isValid()) {
        maps.fitBounds(bounds);
    } else {
        console.warn("GeoJSON tidak memiliki fitur dengan koordinat yang valid.");
    }
}

// Load data GeoJSON dari backend dan render ke peta
fetch('/admin/getgeojson?_t=' + new Date().getTime())
    .then(response => response.json())
    .then(data => {
        console.log("Data yang diambil:", data);
        loadGeoJSON(data);
    })
    .catch(error => console.error('Error loading GeoJSON:', error));


        let imagesContainer = document.getElementById('sidebar-images');
imagesContainer.innerHTML = '';




   // Fungsi untuk menutup sidebar
            document.getElementById("close").addEventListener("click", function () {
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
