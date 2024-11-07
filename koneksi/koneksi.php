<?php
    // Info database
    $host = "localhost";
    $user = "root";
    $pass =  "";
    $db ="database_daftar";
    // Koneksi Ke database
    $koneksi = mysqli_connect($host,$user,$pass,$db);

    if(!$koneksi) {
        die("Koneksi dengan database gagal: ".mysql_connect_error());
    }

?>

