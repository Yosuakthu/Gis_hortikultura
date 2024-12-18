<?php
    include_once('db_connect.php');
    include_once("layout/head.php");
    include_once("layout/nav.php");
    $l = query("SELECT * FROM lahan_pertanian")
?>
  <main class="main">
  <!-- Page Title -->
  <div class="page-title dark-background" data-aos="fade" style="background-image: url(assets/img/bg.jpg);">
      <div class="container position-relative">
        <h1>Data Tables</h1>
        <p>Esse dolorum voluptatum ullam est sint nemo et est ipsa porro placeat quibusdam quia assumenda numquam molestias.</p>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="index.php">Home</a></li>
            <li class="current">Data Tables</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

          </div><!-- End Service Item -->
          
<div class="container mt-4">
<table id="data" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Name Lokasi</th>
                <th>Kelurahan</th>
                <th>Luas Lahan</th>
                <th>Elevasi</th>
                <th>Latitude</th>
                <th>Longitude</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($l as $key) : ?>
            <tr>
                <td><?= $key["nama_lokasi"]; ?></td>
                <td><?= $key["kelurahan"]; ?></td>
                <td><?= $key["luas_lahan"]; ?></td>
                <td><?= $key["elevasi"]; ?></td>
                <td><?= $key["latitude"]; ?></td>
                <td><?= $key["longitude"]; ?></td>
            </tr>
            <?php endforeach ?>
    </table><br>
</div>

  </main>


  <?php
    include("layout/footer.php")
  ?>
  
