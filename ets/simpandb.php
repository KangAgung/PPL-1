<?php
    $host = "localhost";
    $database = "dbakademis";
    $user = "root";
    $password = "";
    $koneksi=mysqli_connect($host,$user,$password,$database);
    if(!$koneksi) {
        die("Error : ".mysql_error());
    }
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $keterangan = $_POST['keterangan'];
    $sql = "UPDATE obyekwisata SET nama = '$nama',keterangan= '$keterangan' WHERE id = '$id'";
    $res = mysqli_query($koneksi, $sql);

    if ($res) {
        header('location: tampil_data.php');
        exit();
    } else {
        header('location: tampil_data.php');
        exit();
    }
    
?>