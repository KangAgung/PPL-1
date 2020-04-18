<?php
$id = $_GET['id'];

$host = "localhost";
$database = "dbakademis";
$user = "root";
$password = "";
$koneksi=mysqli_connect($host,$user,$password,$database);
if(!$koneksi) {
    die("Error : ".mysql_error());
}

$sql = "SELECT * FROM obyekwisata WHERE id = $id ";
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
    </style>
</head>
<body>
    <div id="container">
        <form action="simpandb.php" method="POST">
            <fieldset style="width: 50%;">
            <input type="hidden" name="id" id="id" value="<?php echo $data['id']; ?>">
            <label for="nama">Nama :</label>
            <input type="text" id="nama" name="nama" value="<?php echo $data['nama']; ?>"><br><br>
            <label for="umur">Keterangan :</label>
            <textarea id="keterangan" name="keterangan"><?php echo $data['keterangan']; ?></textarea><br><br>
            <p style="text-align: right;"><input type="submit" value="Submit"></p>
            </fieldset>
    </div>
</body>
</html>