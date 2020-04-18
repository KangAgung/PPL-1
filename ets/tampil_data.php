<?php
    $host = "localhost";
    $database = "dbakademis";
    $user = "root";
    $password = "";
    $koneksi=mysqli_connect($host,$user,$password,$database);
    if(!$koneksi) {
        die("Error : ".mysql_error());
    }

    session_start();

    if(!isset($_SESSION["username"])){
        session_destroy();
        header("location: login.php");
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ETS</title>
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

        .fotoobyek {
            width:100px;
            height:100px;
        }
    </style>
</head>
<body>
    <table id="t1" align="center">
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>foto</th>
            <th>Keterangan</th>
            <th>Update</th>
        </tr>
    <?php
        $sql = "SELECT * FROM obyekwisata";
        $res = mysqli_query($koneksi, $sql);
        while ($data = mysqli_fetch_array($res)) {
    ?>        
        <tr>
            <td><?php echo($data['id']); ?></td>
            <td><?php echo($data['nama']); ?></td>
            <td><?php echo($data['keterangan']); ?></td>
            <td><img class="fotoobyek"src="../assets/obyekwisata/<?php echo($data['filegambar']); ?>" alt="foto obyek wisata"></td>
            <td>
                <a href="update.php?id=<?php echo($data['id']); ?>">Update</a>
            </td>
        </tr>
    <?php
        }
    ?>
    <a href="logout.php">Logout</a>
    </table>
</body>
</html>