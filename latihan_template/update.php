<?php
$nim = $_GET['nim'];

$host = "localhost";
$database = "dbakademis";
$user = "root";
$password = "";
$koneksi=mysqli_connect($host,$user,$password,$database);
if(!$koneksi) {
    die("Error : ".mysql_error());
}

$sql = "SELECT * FROM mahasiswa WHERE nim = $nim ";
$res = mysqli_query($koneksi, $sql);
$data = mysqli_fetch_array($res);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update Form</title>
    <style>
        #container {
            margin: 30px;
        }

        .fotomhs {
            width:200px;
            height:200px;
        }
    </style>
</head>
<body>
    <div id="container">
        <form action="updatedb.php" method="POST" enctype="multipart/form-data">
            <fieldset style="width: 25%;">
            <input type="hidden" name="nim" id="nim" value="<?php echo $data['nim']; ?>"><br>
            <label for="nama">Nama :</label>
            <input type="text" id="nama" name="nama" value="<?php echo $data['nama']; ?>"><br><br>
            <label for="umur">Umur :</label>
            <input type="text" id="umur" name="umur" value="<?php echo $data['umur']; ?>"><br><br>
            <label for="foto">Foto :</label>
            <input type="hidden" name="namafoto" id="namafoto" value="<?php echo $data['namafilefoto']; ?>">
            <img class="fotomhs"src="../assets/fotomahasiswa/<?php echo($data['namafilefoto']); ?>" alt="foto mahasiswa"><br>
            <input type="file" id="foto" name="namafilefoto" value=""><br><br>
            <p style="text-align: right;"><input type="submit" value="Submit"></p>
            </fieldset>
        </form>
        <a href="template.php?content=display_dan_viewdetail.php&nim=<?php echo($data['nim']); ?>">Cancel</a>
    </div>
</body>
</html>