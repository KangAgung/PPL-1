<?php
    $host = "localhost";
    $database = "dbakademis";
    $user = "root";
    $password = "";
    $koneksi=mysqli_connect($host,$user,$password,$database);
    if(!$koneksi) {
        die("Error : ".mysql_error());
    }

    if (isset($_GET['empty']) && $_GET['empty'] == true) {
        unset($_SESSION['cart']);
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

        .barang{
            text-align: left;
        }
        </style>
</head>
<body>
    <div class="barang">
        <a href="template.php?content=cari.php">Tambah barang ke keranjang</a>
    </div><br>

    <table>
        <?php
            if (isset($_GET['data'])) {
                $data = $_GET['data'];

                if (empty($_SESSION['cart'])) {
                    $i = 1;
                } else {
                    $i = sizeof($_SESSION['cart'])+1;
                }
                
    
                $sql = "SELECT * FROM barang WHERE kode_barang = $data ";
                $res = mysqli_query($koneksi, $sql);
    
                $result = mysqli_fetch_array($res);
                $_SESSION['cart'][$i] = array($result['kode_barang'],$result['nama_barang'],$result['harga'],1);
                
            }

            if (!empty($_SESSION['cart'])) {
        ?>
        <tr>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>harga</th>
            <th>jumlah</th>
            <th>sub total</th>
        </tr>
        
        <?php for ($i=1; $i <= sizeof($_SESSION['cart']); $i++) {  ?>
            <tr>
            <td><?php echo $_SESSION['cart'][$i][0]; ?></td>
            <td><?php echo $_SESSION['cart'][$i][1]; ?></td>
            <td><?php echo $_SESSION['cart'][$i][2]; ?></td>
            <td><?php echo $_SESSION['cart'][$i][3]; ?></td>
            <td><?php echo $_SESSION['cart'][$i][2]*$_SESSION['cart'][$i][3]; ?></td>
            </tr>
        <?php
            }
        ?>
        

        <tr>
            <th colspan="3">Total :</th>
            <td><?php echo sizeof($_SESSION['cart']); ?></td>
            <td>
            <?php 
                $totalHarga = 0;
                foreach ($_SESSION['cart'] as $value) {
                    $totalHarga = $totalHarga + $value[2];
                }
                echo $totalHarga;
            ?>
            </td>
        </tr>
    </table>
        <div class="barang">
            <a href="template.php?content=cart.php&empty=true">kosongkan keranjang</a>
        </div>
        <?php
            } else { 
        ?>
            Keranjang Kosong
    </table>
        <?php
            }
        ?>
</body>
</html>