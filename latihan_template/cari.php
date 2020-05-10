<?php
    $host = "localhost";
    $database = "dbakademis";
    $user = "root";
    $password = "";
    $koneksi=mysqli_connect($host,$user,$password,$database);
    if(!$koneksi) {
        die("Error : ".mysql_error());
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cari</title>
    <style >
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
        .hasil {
            text-align: inherit;
        }
        </style>
</head>
<body>
    <form action="template.php?content=cari.php" method="post">
        <label for="Cari">Cari &nbsp;:</label>
        <input type="text" id="cari" name="cari" value="">
        <input type="submit" value="Cari"><br><br>
    </form>

    <?php
         if(isset($_POST['cari'])){

            $cari = $_POST['cari'];
    ?>
        <div class="hasil">Hasil Pencarian : <?php echo($cari); ?></div><br>
    <?php
            $sql = "SELECT * FROM barang WHERE nama_barang LIKE'%$cari%'";
            $res = mysqli_query($koneksi, $sql);
        }else{
            $sql = "SELECT * from barang";
            $res = mysqli_query($koneksi, $sql);
        }
    ?>
    <table>
        <tr>
            <th>Kode</th>
            <th>Nama</th>
            <th>harga</th>
            <th>stok</th>
            <th>Aksi</th>
        </tr>
    
        
    <?php
        while ($data = mysqli_fetch_array($res)) {
    ?>        
        <tr>
            <td><?php echo($data['kode_barang']); ?></td>
            <td><?php echo($data['nama_barang']); ?></td>
            <td><?php echo($data['harga']); ?></td>
            <td><?php echo($data['stock']); ?></td>
            <td><a href="template.php?content=cart.php&data=<?php echo($data['kode_barang']); ?>">Tambah ke keranjang</a></td>
        </tr>
    <?php
        }
    ?>
    </table>
</body>
</html>