<?php 
    require_once "koneksi.php";
?>

    <form action="index.php?content=home.php" method="post">
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
    <table class="list-barang">
        <tr>
            <th>Kode</th>
            <th>Nama Barang</th>
            <th>Gambar</th>
            <th>harga</th>
            <th>stok</th>
            <th>Aksi</th>
        </tr>
    
        
    <?php
        while ($data = mysqli_fetch_array($res)) {
    ?>        
        <tr>
            <td><?php echo($data['id_barang']); ?></td>
            <td><?php echo($data['nama_barang']); ?></td>
            <td><img class="foto-barang" src="../assets/barang/<?php echo($data['gambar_barang']); ?>" alt="barang"></td>
            <td><?php echo($data['harga']); ?></td>
            <td><?php echo($data['stok']); ?></td>
            <td><a href="index.php?content=cart.php&data=<?php echo($data['id_barang']); ?>&qty=1">Add to Cart</a></td>
        </tr>
    <?php
        }
    ?>
    </table>