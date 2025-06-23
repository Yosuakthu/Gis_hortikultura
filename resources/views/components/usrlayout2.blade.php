<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>WebGis-Hortikultura</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="{{ asset('assets/main/img/logo-TI.png')}}" rel="icon">
  <link href="{{ asset('assets/main/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets/main/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{ asset('assets/main/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{ asset('assets/main/vendor/aos/aos.css')}}" rel="stylesheet">
  <link href="{{ asset('assets/main/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
  <link href="{{ asset('assets/main/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
  <link href="{{ asset('assets/main/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="{{ asset('assets/main/css/main.css')}}" rel="stylesheet">
  <link href="{{ asset('assets/main/css/dataTables.dataTables.css')}}" rel="stylesheet">




  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css"
  integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ==" crossorigin="" />
  <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"
  integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ==" crossorigin=""></script>
<script src="{{ asset('assets/leaflet/js/leaflet.ajax.js')}}" ></script>
<style type="text/CSS">
    #map{
      height: 958px;
    }

    .sidebar2 {
    position: fixed;
    top: 125px;
    bottom: 50px;
    right: -470px; /* disembunyikan default */
    width: 450px;
   background:  url('{{ asset('img/bgDL.jpg')}}');
  background-size: cover;
  background-position: center;
  border-radius: 10px;
  transition: right 0.3s ease;
  z-index: 1050;
  overflow-y: auto;
  margin-right: 4px;
}
    .sidebar2 h5 {
    font-size: 36px;
    font-weight: bold;
    margin: 20px 0px;
    }
     .sidebar2 dl dt {
    font-size: 18px;
    font-weight: bold;
    margin-bottom: 18px;
    }
      .sidebar2 dl dd {
    font-size: 16px;
    margin-bottom: 18px;
    }

      .sidebar2.active {
        right: 35px;
    }

  .sidebar2 .card {
  background-color: transparent;
  border: none;
  height: 100px;       /* Mengikuti lebar kontainer */
  padding: 0 3px;   /* Sedikit ruang kanan-kiri */
  box-sizing: border-box;
}

    .sidebar2 p {
    margin-bottom: 12px;
    font-size: 14px;
    color: #555;
}


 #close {
  background: transparent;
  color: #333;
  border: none;
  font-size: 24px;
  cursor: pointer;
  position: absolute;
  top: 10px;
  right: 15px;
  z-index: 1100;
  transition: color 0.2s;
}

#close:hover {
  color: #dc3545; /* merah saat hover */
}

.navbar-info li {
  display: flex;
  align-items: center;
  margin-bottom: 8px;
  font-size: 14px;
}

.legend-color {
  width: 20px;
  height: 20px;
  margin-right: 10px;
  border: 1px solid #ccc;
  border-radius: 3px;
}
.weather-info {
      position: absolute;
      bottom: 20px;
      left: 20px;
      background:  url('{{ asset('img/bgDL.jpg')}}');
       background-size: cover;
  background-position: center;
      padding: 15px;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      z-index: 1000;
      width: 250px;
      font-family: Arial, sans-serif;
    }

    .weather-info h3 {
      margin: 0;
      margin-bottom: 10px;
      font-size: 20px;
      font-weight: bold;
    }

    .weather-info ul {
      list-style: none;
      padding: 0;
      margin: 0;
    }

    .weather-info li {
      margin-bottom: 8px;
      font-size: 14px;
      display: flex;
      justify-content: space-between;
    }

    .weather-info li strong {
      font-weight: bold;
    }

    .marker-container {
    width: 30px;  /* Lebar ikon */
    height: 30px; /* Tinggi ikon */
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
    border-radius: 50%;
    border: 3px solid rgb(255, 167, 36)
}

  .legend {
  background: #fff;
  padding: 10px;
  border-radius: 5px;
  font-size: 14px;
  box-shadow: 0 0 8px rgba(0,0,0,0.1);
  color: #333;
}

.legend h4 {
  font-size: 18px;
  font-weight: bold;
}

.legend-color {
  display: inline-block;
  width: 18px;
  height: 18px;
  margin-right: 8px;
  vertical-align: middle;
  border: 1px solid #ccc;
}

#search-container {
  position: absolute;
  top: 143px;
  left: 13px;
  z-index: 1000;
  transition: width 0.3s ease;
  overflow: hidden;
  width: 40px;
  height: 40px;
  background: white;
  border-radius: 10px;
  display: flex;
  align-items: center;
  justify-content: center;
  box-shadow: 0 0 5px rgba(0,0,0,0.3);
}

#search-container:hover {
  width: 200px;
  border-radius: 8px;
  padding: 5px 10px;
  justify-content: start;
}

#search-container input {
  width: 100%;
  border: none;
  outline: none;
  display: none;
}

#search-container:hover input {
  display: block;
  margin-left: 8px;
}

#search-icon {
  font-size: 18px;
  color: #555;
  cursor: pointer;
}


   </style>
</head>
<body class="index-page">

    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center">

          <a href="index.html" class="logo d-flex align-items-center me-auto">
            <!-- Uncomment the line below if you also wish to use an image logo -->
            <!-- <img src="assets/img/logo.png" alt=""> -->
            <h1 class="sitename">GIS Tanaman Hortikultura</h1>
          </a>

          <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="/" class="active">Home</a></li>
                <li><a href="/about">About</a></li>
                <li><a href="/peta">Maps</a></li>
                <li><a href="admin/login">Login</a></li>
             </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>


        </div>
      </header>

  <main class="main">

    {{$slot}}

  </main>

 <!-- Scroll Top -->
 <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Preloader -->
<div id="preloader"></div>

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{ asset('assets/main/plugins/jquery/jquery-3.7.1.js')}}"></script>
<script src="{{ asset('assets/main/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap -->
<script src="{{ asset('assets/main/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('assets/main/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="{{ asset('dist/js/demo.js')}}"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="{{ asset('assets/main/plugins/jquery-mousewheel/jquery.mousewheel.js')}}"></script>
<script src="{{ asset('assets/main/plugins/raphael/raphael.min.js')}}"></script>
<script src="{{ asset('assets/main/plugins/jquery-mapael/jquery.mapael.min.js')}}"></script>
<script src="{{ asset('assets/main/plugins/jquery-mapael/maps/usa_states.min.js')}}"></script>

<!-- PAGE SCRIPTS -->
<script src="{{ asset('dist/js/pages/dashboard2.js')}}"></script>

<!-- Vendor JS Files -->
<script src="{{ asset('assets/main/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{ asset('assets/main/vendor/php-email-form/validate.js')}}"></script>
<script src="{{ asset('assets/main/vendor/aos/aos.js')}}"></script>
<script src="{{ asset('assets/main/vendor/purecounter/purecounter_vanilla.js')}}"></script>
<script src="{{ asset('assets/main/vendor/glightbox/js/glightbox.min.js')}}"></script>
<script src="{{ asset('assets/main/vendor/swiper/swiper-bundle.min.js')}}"></script>

<!-- Main JS File -->
<script src="{{ asset('assets/main/js/main.js')}}"></script>
<script src="{{ asset('assets/main/js/dataTables.js')}}"></script>
<script>
  $(document).ready(function() {
    $('#data').DataTable( )
} );
</script>

</body>

<!-- Footer Section -->
<footer class="bg-dark text-light py-4 mt-5">
  <div class="container">
    <div class="row justify-content-between align-items-start">
      <!-- Info Kiri -->
      <div class="col-md-4 mb-3">
        <p class="mb-1">Pemerintah Kabupaten Kepulauan Sangihe</p>
        <h5 class="mb-3 text-primary">Dinas Pertanian</h5>
      </div>

      <!-- Kontak Tengah -->
      <div class="col-md-4 mb-3">
        <p><i class="bi bi-geo-alt-fill text-info me-2"></i>Jln. Jend. Sudirman No. 72 Tahuna - Sulawesi Utara</p>
        <p><i class="bi bi-telephone-fill text-info me-2"></i>0432 - 21658</p>
        <p><i class="bi bi-envelope-fill text-info me-2"></i>distan@sangihekab.go.id</p>
      </div>

      <!-- Sosial Media Kanan -->
      <div class="col-md-4 text-md-end">
        <a href="#" class="btn btn-primary me-2"><i class="bi bi-facebook"></i></a>
        <a href="#" class="btn btn-danger me-2"><i class="bi bi-instagram"></i></a>
        <a href="#" class="btn btn-danger"><i class="bi bi-youtube"></i></a>
      </div>
    </div>

    <hr class="my-3" style="border-color: #777;">

    <div class="text-center">
      <small>Hak Cipta &copy; 2025 </small>
    </div>
  </div>
</footer>


</html>
