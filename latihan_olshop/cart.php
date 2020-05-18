<?php
    require_once "koneksi.php";

    if (isset($_GET['empty']) && $_GET['empty'] == true) {
        unset($_SESSION['cart']);
        unset($_SESSION['harga']);
    }
?>

    <div class="barang">
        <a href="index.php?content=home.php">Tambah barang ke keranjang</a>
    </div><br>

    <table class="list-barang">
        <?php
            if (isset($_GET['data'])) {
                $data = $_GET['data'];
                $qty = $_GET['qty'];                
    
                $sql = "SELECT * FROM barang WHERE id_barang = $data ";
                $res = mysqli_query($koneksi, $sql);
    
                $result = mysqli_fetch_array($res);
                if (empty($_SESSION['cart'][$result['id_barang']])) {
                    $_SESSION['cart'][$result['id_barang']] = array($result['id_barang'],$result['nama_barang'],$result['harga'],$qty,$result['berat']);
                } else {
                    $_SESSION['cart'][$result['id_barang']][3] += $qty;
                }
                
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
        
        <?php foreach ($_SESSION['cart'] as $value) {  ?>
            <tr>
            <td><?php echo $value[0]; ?></td>
            <td><?php echo $value[1]; ?></td>
            <td><?php echo $value[2]; ?></td>
            <td><?php echo $value[3]; ?></td>
            <td><?php echo $value[2]*$value[3]; ?></td>
            </tr>
        <?php
            }
        ?>
        

        <tr>
            <th colspan="3">Total :</th>
            <td>
                <?php
                    $quantity = 0;
                    foreach ($_SESSION['cart'] as $value) {
                        $quantity = $quantity + $value[3];
                    }
                    echo $quantity;
                 ?>
            </td>
            <td>
            <?php 
                $totalHarga = 0;
                foreach ($_SESSION['cart'] as $value) {
                    $totalHarga = $totalHarga + $value[2]*$value[3];
                }
                $_SESSION['harga'] = $totalHarga;
                echo $totalHarga;
            ?>
            </td>
        </tr>
    </table>
        <div class="barang">
            <a href="index.php?content=cart.php&empty=true">kosongkan keranjang</a>
        </div>
            <div class="alt-barang">
                <a href="index.php?content=form.php">Beli</a>
            </div>
        <?php
            } else { 
        ?>
            Keranjang Kosong
    </table>
        <?php
            }
        ?>