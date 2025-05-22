<x-layout>

    <x-slot:titel>{{$titel}}</x-slot:titel>
    <div class="card">
        <div class="card-body">
    <h3>Selamat Datang {{optional($user)->name}}</h3>

</div>
</div>

     <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-globe"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Website User</span>
                <span class="info-box-number">
                  <a href="/">Lihat Halaman</a>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-leaf"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Jenis Tanaman</span>
                <span class="info-box-number">6</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-seedling"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Data Tanaman</span>
                <span class="info-box-number">{{ $totalTanaman }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Pengguna</span>
                <span class="info-box-number">{{ $totaluser }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

    <!-- Small boxes (Stat box) -->
    <div class="row">
  <div class="col-md-4 col-6">
    <div class="small-box bg-info">
      <div class="inner">
        <h3> {{ $cabe }} </h3>
        <p>Data Lokasi Tanaman Cabe</p>
      </div>
      <div class="icon">
        <i class="ion ion-person-add"></i>
      </div>
    </div>
  </div>

  <div class="col-md-4 col-6">
    <div class="small-box bg-info">
      <div class="inner">
        <h3> {{ $tomat }} </h3>
        <p>Data Lokasi Tanaman Tomat</p>
      </div>
      <div class="icon">
        <i class="ion ion-pie-graph"></i>
      </div>
    </div>
  </div>
   <div class="col-md-4 col-6">
    <div class="small-box bg-info">
      <div class="inner">
        <h3> {{ $terong }} </h3>
        <p>Data Lokasi Tanaman Terong</p>
      </div>
      <div class="icon">
        <i class="ion ion-bag"></i>
      </div>
    </div>
  </div>

  <div class="col-md-4 col-6">
    <div class="small-box bg-info">
      <div class="inner">
        <h3> {{ $ketimun }} </h3>
        <p>Data Lokasi Tanaman Ketimun</p>
      </div>
      <div class="icon">
        <i class="ion ion-stats-bars"></i>
      </div>
    </div>
  </div>
   <div class="col-md-4 col-6">
    <div class="small-box bg-info">
      <div class="inner">
        <h3> {{ $buncis }} </h3>
        <p>Data Lokasi Tanaman Buncis</p>
      </div>
      <div class="icon">
        <i class="ion ion-bag"></i>
      </div>
    </div>
  </div>

  <div class="col-md-4 col-6">
    <div class="small-box bg-info">
      <div class="inner">
        <h3> {{ $caisin }} </h3>
        <p>Data Lokasi Tanaman Caisin</p>
      </div>
      <div class="icon">
        <i class="ion ion-stats-bars"></i>
      </div>
    </div>
  </div>
</div>

    <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-chart-pie mr-1"></i>
                  Grafik Tanaman
                </h3>
                <div class="card-tools">
                  <ul class="nav nav-pills ml-auto">
                    <li class="nav-item">
                      <a class="nav-link active" href="#revenue-chart" data-toggle="tab">Area</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#sales-chart" data-toggle="tab">Donut</a>
                    </li>
                  </ul>
                </div>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content p-0">
                  <!-- Morris chart - Sales -->
                  <div class="chart tab-pane active" id="revenue-chart"
                       style="position: relative; height: 300px;">
                      <canvas id="revenue-chart-canvas" height="300" style="height: 300px;"></canvas>
                   </div>
                  <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
                    <canvas id="sales-chart-canvas" height="300" style="height: 300px;"></canvas>
                  </div>
                </div>
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->

            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

            <script>
    const data = @json($jenisTanaman);

    const labels = data.map(item => item.tanaman);
    const counts = data.map(item => item.total);

    // Area Chart
    const ctxArea = document.getElementById('revenue-chart-canvas').getContext('2d');
    new Chart(ctxArea, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Jumlah Tanaman',
                data: counts,
                fill: true,
                backgroundColor: 'rgba(60,141,188,0.2)',
                borderColor: 'rgba(60,141,188,1)',
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });

    // Donut Chart
    const ctxDonut = document.getElementById('sales-chart-canvas').getContext('2d');
    new Chart(ctxDonut, {
        type: 'doughnut',
        data: {
            labels: labels,
            datasets: [{
                label: 'Jumlah',
                data: counts,
                backgroundColor: [
                    '#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'
                ]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });
</script>

</x-layout>
