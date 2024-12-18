<?php
    include_once("layout/head.php");
    include_once("layout/nav.php");
?>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" 
  integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ==" crossorigin="" />
  <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js" 
  integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ==" crossorigin=""></script>
    
  <script src="leaflet.ajax.js" ></script>
    <style type="text/CSS">
      #map{
        height: 630px;
      }
      
    </style>
    



    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  </head>
  <body class="index-page">
  <header id="header" class="header d-flex align-items-center fixed-top">
      <div class="container-fluid container-xl position-relative d-flex align-items-center">

        <a href="index.html" class="logo d-flex align-items-center me-auto">
          <!-- Uncomment the line below if you also wish to use an image logo -->
          <!-- <img src="assets/img/logo.png" alt=""> -->
          <h1 class="sitename">GIS Tanaman Holtikultura</h1>
        </a>

        <nav id="navmenu" class="navmenu">
          <ul>
            <li><a href="index.php" class="active">Home<br></a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="table.php">Data Tables</a></li>
            <li><a href="maps.php.">Maps</a></li>
            <li><a href="contact.html">Login</a></li>
          </ul>
          <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

      </div>
  </header>


    <main class="main">

  
    <script src="_peta/js/qgis2web_expressions.js"></script>
          <script src="_peta/js/L.Control.Locate.min.js"></script>
          <script src="_peta/js/leaflet.rotatedMarker.js"></script>
          <script src="_peta/js/leaflet.pattern.js"></script>
          <script src="_peta/js/leaflet-hash.js"></script>
            <script src="_peta/js/Autolinker.min.js"></script>
            <script src="_peta/js/rbush.min.js"></script>
            <script src="_peta/js/labelgun.min.js"></script>
            <script src="_peta/js/labels.js"></script>
            <script src="_peta/js/leaflet-control-geocoder.Geocoder.js"></script>

            <div id="map"></div> 
      <script type="text/javascript">

  var peta1 = L.tileLayer('http://{s}.google.com/vt?lyrs=m&x={x}&y={y}&z={z}',{
  maxZoom: 20,
  subdomains:['mt0','mt1','mt2','mt3']
  });


  var peta2 = L.tileLayer('http://{s}.google.com/vt?lyrs=s,h&x={x}&y={y}&z={z}',{
  maxZoom: 20,
  subdomains:['mt0','mt1','mt2','mt3']
  });


  var peta3 = L.tileLayer('http://{s}.google.com/vt?lyrs=p&x={x}&y={y}&z={z}',{
  maxZoom: 20,
  subdomains:['mt0','mt1','mt2','mt3']
  });

    
    var peta5 = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      maxZoom: 19,
      attribution: '© OpenStreetMap'
  });


    

      var maps = L.map('map',{
        center:[3.6434244,125.4630049,13.29],
        zoom:13,
        layers :[peta2]
      });

      var baseMaps = {
      "Peta Citra": peta2,
      "Peta dasar 1": peta1,
      "Peta dasar 2": peta3,
      "Peta dasar 3": peta5
  };

  var layerControl = L.control.layers(baseMaps, null, { position: 'bottomright' }).addTo(maps);


  </script>

    </main>


    <?php
    include_once("layout/footer.php")
    ?>