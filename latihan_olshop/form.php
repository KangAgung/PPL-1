<?php
    require_once 'koneksi.php';

    $beratTotal = $ongkir = 0;
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as  $value) {
            $beratTotal = $beratTotal + $value[3]*$value[4];
        }
    }

    $dec = floor($beratTotal);
    $fraction = $beratTotal - $dec;
    if ($fraction <= 0.3 ) {
        $beratTotal = floor($beratTotal);
        if ($beratTotal == 0) {
            $beratTotal = 1;
        }
    } else {
        $beratTotal = ceil($beratTotal);
    }
    
    if(isset($_POST['nama'])){
        $nama = $_POST['nama'];
        $no_hp = $_POST['no_hp'];
        $alamat = $_POST['alamat'];
        $kode_pos = $_POST['kode_pos'];
        $totalHarga = $_SESSION['harga'];
        $tgl_pembelian = date("Y-m-d H:i:s");

        $sql = "SELECT ongkir_per_kilo FROM ongkir WHERE kode_tujuan = '$kode_pos'";
        $res = mysqli_query($koneksi, $sql);
        $result = mysqli_fetch_array($res);
        $ongkir_per_kilo = $result['ongkir_per_kilo'];

        $ongkir = $beratTotal * $ongkir_per_kilo;

        $sql = "INSERT INTO penjualan VALUES (null,'$nama','$no_hp','$alamat','$kode_pos','$totalHarga','$tgl_pembelian')";
        $res = mysqli_query($koneksi, $sql);

        foreach ($_SESSION['cart'] as $value) { 
            $id_barang = $value[0]; 
            $kuantitas = $value[3];
            $harga_satuan = $value[2];
            $sql = "INSERT INTO jual VALUES (LAST_INSERT_ID(), '$id_barang', '$kuantitas', '$harga_satuan')";
            $res = mysqli_query($koneksi, $sql);
        }

        foreach ($_SESSION['cart'] as $value) {  
            $id_barang = $value[0];
            $sql = "SELECT stok FROM barang WHERE id_barang = '$id_barang'";
            $res = mysqli_query($koneksi, $sql);
            $result = mysqli_fetch_array($res);
            $stok = $result['stok'] - $value[3];
            $sql = "UPDATE barang SET stok = '$stok' WHERE id_barang = '$id_barang'";
            $res = mysqli_query($koneksi, $sql);
        }
        
?>
<div class="container">
        <fieldset>
        <legend><h3>Detail Pembayaran :</h3></legend>
            <label for="Harga">Harga :</label>
            <input type="text" id="harga" name="harga" value="<?php if(isset($_SESSION['harga'])){ echo $_SESSION['harga']; }?>" disabled><br><br>
            <label for="Berat Barang">Total Berat Barang :</label>
            <input type="text" id="berat_barang" name="berat_barang" value="<?php echo $beratTotal;?>" disabled><br><br>
            <label for="Ongkir per kilo">Ongkir per Kilo :</label>
            <input type="text" id="ongkir_per_kilo" name="ongkir_per_kilo" value="<?php echo $ongkir_per_kilo;?>" disabled><br><br>
            <hr>
            <label for="Ongkir">Ongkir :</label>
            <input type="text" id="ongkir" name="ongkir" value="<?php echo $ongkir;?>" disabled><br><br>
            <hr>
            <label for="Total Harga">Total Harga :</label>
            <input type="text" id="total_harga" name="total_harga" value="<?php if(isset($_SESSION['harga'])){ echo $_SESSION['harga']+$ongkir; }?>" disabled><br><br><br>
        </fieldset>
    Terima kasih telah berbelanja disini.<br>
    barang akan segera dikirim.<br><br>
    <a href="index.php?content=home.php">Kembali berbelanja</a>
</div>

<?php
        unset($_SESSION['cart']);
        unset($_SESSION['harga']);

    } else {
?>

<div class="container">
    <form action="index.php?content=form.php" method="post">
        <fieldset style="width: 30%;">
        <legend><h3>Form Pembelian :</h3></legend>
            <label for="nama">Nama :</label>
            <input type="text" id="nama" name="nama" value="" required><br><br>

            <label for="hp">No. HP :</label>
            <input type="text" id="hp" name="no_hp" value="" required><br><br>

            <label for="alamat">Alamat :</label>
            <input type="text" id="alamat" name="alamat" value="" required><br><br>

            <?php
                $sql = "SELECT kode_tujuan FROM ongkir";
                $res = mysqli_query($koneksi, $sql);
                $result = mysqli_fetch_all($res);
            ?>
            
            <label for="kode pos">Kode Pos :</label>
            <select id="kode_pos" name="kode_pos">
            <?php
                foreach ($result as $value) {
            ?>
                    <option value="<?php echo $value[0];?>"><?php echo $value[0]; ?></option>
            <?php
                }
            ?>
            </select><br><br>

            <span style="text-align: right;"><input type="submit" value="Submit"></span>
            <hr>
        <legend><h4>Barang Belanjaan :</h4></legend>
            <?php
            if (isset($_SESSION['cart'])) {    
                foreach ($_SESSION['cart'] as $value) {
            ?>
                    <label for="Nama Barang">Nama Barang :</label>
                    <input type="text" id="nama_barang" name="nama_barang" value="<?php echo $value[1];?>" disabled><br><br>
                    <label for="Banyak Barang">Banyak Barang :</label>
                    <input type="text" id="banyak_barang" name="banyak_barang" value="<?php echo $value[3];?>" disabled><br><br>
            <?php
                }
            }
            ?>
            <label for="Banyak Barang">Total Berat Barang :</label>
            <input type="text" id="banyak_barang" name="banyak_barang" value="<?php echo $beratTotal;?>" disabled><br><br>
        <hr>
            <label for="Harga">Harga :</label>
            <input type="text" id="harga" name="harga" value="<?php if(isset($_SESSION['harga'])){ echo $_SESSION['harga']; }?>" disabled><br><br>

        </fieldset>
    </form>
</div>

<?php
    }
?>
