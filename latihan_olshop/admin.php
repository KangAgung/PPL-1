<?php 
    require_once "config/koneksi.php";

    if(isset($_GET['status'])){
        $id = $_GET['data'];
        $status = $_GET['status']+1;

        $sql = "UPDATE penjualan SET status = '$status' WHERE id_penjualan = '$id'";
        $res = mysqli_query($koneksi, $sql);

        $sql = "SELECT * FROM penjualan JOIN customer ON penjualan.id_customer = customer.id_customer";
        $res = mysqli_query($koneksi, $sql);
    } else {
        $sql = "SELECT * FROM penjualan JOIN customer ON penjualan.id_customer = customer.id_customer";
        $res = mysqli_query($koneksi, $sql);
    }

?>
<div class="container">

<div class="row">

<div class="col-lg-12">

<div class="row my-4 mx-2">

    <div class="table-responsive">
        <table class="table table-striped table-bordered table-sm text-center">
            <thead class="thead-dark">
                <tr>
                    <th>ID Penjualan</th>
                    <th>Nama</th>
                    <th>Telepon</th>
                    <th>Alamat</th>
                    <th>Kode Pos</th>
                    <th>Total Harga</th>
                    <th>Tgl. Pembelian</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        
            
        <?php
          while ($data = mysqli_fetch_array($res)) {

            if ($data['status'] == 0) {
        ?>
              <tr class="table-danger">
        <?php
            } elseif ($data['status'] == 1) {
        ?>
              <tr class="table-warning">
        <?php
            } else {
        ?>
              <tr class="table-success">
        <?php
            }
        ?>
                <td><?php echo($data['id_penjualan']); ?></td>
                <td><?php echo($data['nama']); ?></td>
                <td><?php echo($data['nomor_hp']); ?></td>
                <td><?php echo($data['alamat']); ?></td>
                <td><?php echo($data['kode_pos']); ?></td>
                <td>Rp. <?php echo(number_format($data['harga_total'],0,',','.')); ?></td>
                <td><?php echo($data['waktu_penjualan']); ?></td>
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
                  if ($data['status'] != 2) {
                ?>
                      <a class="btn btn-info btn-sm" href="index.php?content=admin.php&data=<?php echo($data['id_penjualan']); ?>&status=<?php echo($data['status']); ?>">
                          Update
                      </a>
                <?php
                  } 
                ?>
                  <a class="btn btn-primary btn-sm" href="index.php?content=view_detail.php&data=<?php echo($data['id_penjualan']); ?>">
                        Detail
                  </a>
                </td>
            </tr>
        <?php
            }
        ?>
        </table>
    </div>
    <div class="ml-auto">
        <a class="btn btn-info mr-3" href="index.php?content=import.php">
            <i class="fa fa-upload"></i>
            Import from Excel
        </a>
        <a class="btn btn-success mr-3" href="index.php?content=exportExcel.php">
            <i class="fa fa-download"></i>
            Export to Excel
        </a>
    </div>

</div>
<!-- /.row -->

</div>
<!-- /.col-lg-12 -->