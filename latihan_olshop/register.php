<?php
    require_once 'config/koneksi.php';

    if (isset($_POST['nama']) && $_POST['alamat'] && $_POST['kode_pos']) {
      if ($_POST['password'] == $_POST['c_password']) {
        $nama = $_POST['nama'];
        $no_hp = $_POST['no_hp'];
        $alamat = $_POST['alamat'];
        $kode_pos = $_POST['kode_pos'];
        $username = $_POST['username'];
        $password = md5($_POST["password"]); // using md5 hash
  
        $sql = "INSERT INTO customer VALUES (null,'$nama','$no_hp','$alamat','$kode_pos','$username','$password')";
        $res = mysqli_query($koneksi, $sql);

        $_SESSION['username'] = $username;
        $_SESSION['uid'] = mysqli_insert_id($koneksi); 
      }
      
    }
?>

<script>
  location.replace('index.php');
</script>