<?php
    $host = "localhost";
    $database = "dbakademis";
    $user = "root";
    $password = "";
    $koneksi=mysqli_connect($host,$user,$password,$database);
    if(!$koneksi) {
        die("Error : ".mysql_error());
    }

    $base_url = "../assets/fotomahasiswa/";
    $nim = $_GET['nim'];
    $sql = "SELECT namafilefoto FROM mahasiswa WHERE nim = ?";
    $stmt = mysqli_prepare($koneksi,$sql);
    mysqli_stmt_bind_param($stmt,"s",$nim);
    $res = mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $data = mysqli_fetch_array($result);
    if ($res) {
        unlink($base_url.$data['namafilefoto']);
    }
    mysqli_stmt_close($stmt);

    $sql = "DELETE FROM mahasiswa WHERE nim = ?";
    $stmt = mysqli_prepare($koneksi,$sql);
    mysqli_stmt_bind_param($stmt,"s",$nim);
    $res = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: template.php?content=display_dan_viewdetail.php");
    exit();
?>