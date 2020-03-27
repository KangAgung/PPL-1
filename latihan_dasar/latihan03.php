<?php
    $host = "localhost";
    $database = "dbakademis";
    $user = "root";
    $password = "";
    $koneksi=mysqli_connect($host,$user,$password,$database);
    if(!$koneksi) {
        die("Error : ".mysql_error());
    }

    $sql = "SELECT * FROM mahasiswa";
    $res = mysqli_query($koneksi, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Latihan 03</title>
    <style>
        table {
            width: 50%;
            margin-top: 30px;
        }
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        th {
            background-color: black;
            color: whitesmoke;
        }

        td, th {
            padding: 10px;
        }

        td {
            text-align: center;
        }

        #t1 tr:nth-child(even) {
            background-color: #999;
        }

        #t1 tr:nth-child(odd){
            background-color: #eee;
        }
    </style>
</head>
<body>
    <!-- NIM Nama Umur <br> -->
    <?php
        while ($data = mysqli_fetch_array($res)) {
    ?>  
            <?php echo($data['nim']); ?>
            - <?php echo($data['nama']);?>
            - <?php echo($data['umur']) ?> <br>
    <?php
        }
    ?>
</body>
</html>