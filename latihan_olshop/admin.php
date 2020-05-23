<?php 
    require_once "koneksi.php";

    if(isset($_GET['status'])){
        $id = $_GET['data'];
        $status = $_GET['status']+1;

        $sql = "UPDATE penjualan SET status = '$status' WHERE id_penjualan = '$id'";
        $res = mysqli_query($koneksi, $sql);

        $sql = "SELECT * FROM penjualan";
        $res = mysqli_query($koneksi, $sql);
    } else {
        $sql = "SELECT * FROM penjualan";
        $res = mysqli_query($koneksi, $sql);
    }
?>

    <table class="list-barang">
        <tr>
            <th>ID Penjualan</th>
            <th>Nama</th>
            <th>Telepon</th>
            <th>Alamat</th>
            <th>Kode Pos</th>
            <th>Pembayaran</th>
            <th>Tgl. Pembelian</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    
        
    <?php
        while ($data = mysqli_fetch_array($res)) {
    ?>        
        <tr>
            <td><?php echo($data['id_penjualan']); ?></td>
            <td><?php echo($data['nama']); ?></td>
            <td><?php echo($data['nomor_hp']); ?></td>
            <td><?php echo($data['alamat']); ?></td>
            <td><?php echo($data['kode_pos']); ?></td>
            <td><?php echo($data['harga_total']); ?></td>
            <td><?php echo($data['tgl_penjualan']); ?></td>
            <td>
                <?php
                    if ($data['status'] == 0) {
                        echo "Belum dibayar";
                    } else if ($data['status'] == 1) {
                        echo "Sudah dibayar";
                    } else {
                        echo "Sudah dikirim";
                    }
                     
                ?>
            </td>
            <td>
            <?php
                if ($data['status'] == 2) {
            ?>
                    Tidak ada Aksi
            <?php
                } else {
            ?>
                <a href="index.php?content=admin.php&data=<?php echo($data['id_penjualan']); ?>&status=<?php echo($data['status']); ?>">Update</a>
            <?php
                }  
            ?>
            </td>
        </tr>
    <?php
        }
    ?>
    </table>