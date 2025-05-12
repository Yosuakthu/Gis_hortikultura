<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" sizes="64x64" href="../img/logo.png">
  <title>WebGis-Holtikultura-{{$titel}}</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('assets/css/adminlte.min.css')}}">
  <link rel="stylesheet" href="{{ asset('dtb/css/dataTables.dataTables.css')}}">

{{-- datatabels --}}

  <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">

  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css"
  integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ==" crossorigin="" />
  <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"
  integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ==" crossorigin=""></script>
<script src="{{ asset('assets/leaflet/js/leaflet.ajax.js')}}" ></script>
   <style type="text/CSS">
    #map{
      height: 858px;
    }

    .sidebar2 {
        position: fixed;
        right: -300px;
        top: 0;
        width: 300px;
        height: 100%;
        background: white;
        box-shadow: -2px 0px 5px rgba(0,0,0,0.3);
        padding: 15px;
        transition: right 0.3s;
        z-index: 1000;
    }
    .sidebar2.active {
        right: 0;
    }
    #closeSidebar {
        background: white ;
        color: rgb(5, 5, 5);
        border: none;
        padding: 5px 10px;
        font-size: 18px;
        cursor: pointer;
        position: absolute;
        top: 10px;
        right: 10px;
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
      background-color: rgba(255, 255, 255, 0.9);
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
      font-size: 18px;
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

   </style>


</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">


  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    {{-- <a href="index3.html" class="brand-link">
      <img src="{{ asset('assets/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a> --}}

<x-sidebar></x-sidebar>

  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
<x-header>{{$titel}}</x-header>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->

          {{$slot}}

      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

</div>
<!-- ./wrapper -->

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-annotation"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-colorschemes"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-zoom"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>

<!-- jQuery -->
<script src="{{ asset('assets/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets/js/adminlte.min.js')}}"></script>



<!-- jQuery Mapael -->
<script src="{{ asset('assets/plugins/jquery-mousewheel/jquery.mousewheel.js')}}"></script>
<script src="{{ asset('assets/plugins/raphael/raphael.min.js')}}"></script>
<script src="{{ asset('assets/plugins/jquery-mapael/jquery.mapael.min.js')}}"></script>
<script src="{{ asset('assets/plugins/jquery-mapael/maps/usa_states.min.js')}}"></script>
<script src="{{ asset('dtb/jss/dataTables.js')}}"></script>


<!-- DataTables -->
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>

<script>
    $(document).ready(function () {
        $('body').addClass('sidebar-collapse');
    });
</script>



</body>
</html>
