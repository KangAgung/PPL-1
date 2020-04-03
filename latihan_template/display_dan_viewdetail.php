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
            width:100px;
            height:100px;
        }
    </style>
</head>
<body>
    <table id="t1" align="center">
        <tr>
            <th>NIM</th>
            <th>Nama</th>
            <th>Umur</th>
            <th>foto</th>
            <th>Detail</th>
            <th>Delete</th>
        </tr>
    <?php
        while ($data = mysqli_fetch_array($res)) {
    ?>        
        <tr>
            <td><?php echo($data['nim']); ?></td>
            <td><?php echo($data['nama']); ?></td>
            <td><?php echo($data['umur']); ?></td>
            <td><img class="fotomhs"src="../assets/fotomahasiswa/<?php echo($data['namafilefoto']); ?>" alt="foto mahasiswa"></td>
            <td>
                <a href="template.php?content=viewdetail.php&nim=<?php echo($data['nim']); ?>&nama=<?php echo($data['nama']); ?>&umur=<?php echo($data['umur']); ?>&namafilefoto=<?php echo($data['namafilefoto']); ?>">Detail</a>
            </td>
            <td>
                <a href="delete.php?nim=<?php echo($data['nim']) ?>">Delete</a>
            </td>
        </tr>
    <?php
        }
    ?>
    </table>
</body>
</html>