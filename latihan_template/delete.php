<?php
    $host = "localhost";
    $database = "dbakademis";
    $user = "root";
    $password = "";
    $koneksi=mysqli_connect($host,$user,$password,$database);
    if(!$koneksi) {
        die("Error : ".mysql_error());
    }

    $nim = $_GET['nim'];
    $sql = "DELETE FROM mahasiswa WHERE nim = $nim";
    $res = mysqli_query($koneksi, $sql);

    header("location: template.php?content=display_dan_viewdetail.php")
?>