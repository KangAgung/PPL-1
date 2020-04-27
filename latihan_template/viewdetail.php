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
    <title>Latihan 04</title>
    <style>
        #t1 {
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
            width: 30%
        }

        td, th {
            padding: 10px;
        }

        #t1 tr:nth-child(even) {
            background-color: #999;
        }

        #t1 tr:nth-child(odd){
            background-color: #eee;
        }

        .fotomhs {
            width:200px;
            height:200px;
        }
    </style>
</head>
<body>
<table id="t1" align="center">
        <tr>
            <th>NIM</th>
            <td><?php echo $data['nim']; ?></td>
        </tr>
        <tr>
            <th>Nama</th>
            <td><?php echo $data['nama']; ?></td>
        </tr>
        <tr>
            <th>Umur</th>
            <td><?php echo $data['umur']; ?></td>
        </tr>
        <tr>
            <th>Foto</th>
            <td><img class="fotomhs" src="../assets/fotomahasiswa/<?php echo $data['namafilefoto']; ?>" alt="foto mahasiswa"></td>
        </tr>
</table>
<a href="template.php?content=display_dan_viewdetail.php">Back</a> | 
<a href="template.php?content=update.php&nim=<?php echo($data['nim']); ?>">Update</a> | 
<a href="delete.php?nim=<?php echo($data['nim']) ?>">Delete</a>

</body>
</html>