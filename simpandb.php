<?php
    $host = "localhost";
    $database = "dbakademis";
    $user = "root";
    $password = "";
    $koneksi=mysqli_connect($host,$user,$password,$database);
    if(!$koneksi) {
        die("Error : ".mysql_error());
    }
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $umur = $_POST['umur'];
    $sql = "INSERT INTO mahasiswa VALUES ('$nim','$nama','$umur')";
    $res = mysqli_query($koneksi, $sql);

    if ($res) {
        header('location: latihan04.php');
        exit();
    } else {
        header('location: forminput.html');
        exit();
    }
    
?>