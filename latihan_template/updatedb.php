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

    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $umur = $_POST['umur'];
    $namafilefoto = $_POST['namafoto'];
    if (isset($_FILES['namafilefoto']) && $_FILES['namafilefoto']['size'] > 0) {
        $filefoto = $_FILES['namafilefoto']['name'];
        $namafilefoto = preg_replace('/[^A-Za-z0-9.\-\_]/', '', date("Y-m-d_H-i-s").'_'.$filefoto);
        $file_tmp = $_FILES['namafilefoto']['tmp_name'];
        move_uploaded_file($file_tmp, '../assets/fotomahasiswa/'.$namafilefoto);
        $sql = "SELECT namafilefoto FROM mahasiswa WHERE nim = $nim";
        $res = mysqli_query($koneksi, $sql);
        if ($res) {
            $data = mysqli_fetch_array($res);
            unlink($base_url.$data['namafilefoto']);
        }
    }
    $sql = "UPDATE mahasiswa SET nama = '$nama',umur = '$umur', namafilefoto = '$namafilefoto' WHERE nim = '$nim'";
    $res = mysqli_query($koneksi, $sql);

    header("location: template.php?content=display_dan_viewdetail.php");
    exit();
    
?>