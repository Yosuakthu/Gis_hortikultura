<?php
$servername = "localhost";
$username = "root";  // Ganti dengan username MySQL Anda
$password = "";      // Ganti dengan password MySQL Anda
$dbname = "webgis";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

function query($query){
    global $conn;
    $r = mysqli_query($conn,$query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($r)) {
        $rows[] = $row;
    }
    return $rows;
}

?>
