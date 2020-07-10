<?php
    require_once 'config/koneksi.php';

    if(isset($_GET['status']) && isset($_GET['data'])){
      $id = $_GET['data'];
      $status = $_GET['status']+1;

      $sql = "UPDATE penjualan SET status = '$status' WHERE id_penjualan = '$id'";
      $res = mysqli_query($koneksi, $sql);
    }

    $id = $_GET['data'];

    $sql = "SELECT * FROM penjualan JOIN customer ON penjualan.id_customer = customer.id_customer WHERE id_penjualan = $id";
    $res = mysqli_query($koneksi, $sql);
    $data = mysqli_fetch_array($res);
?>
<div class="container">

<div class="row">

<div class="col-lg-12">

<div class="row my-4">

  <div class="table-responsive my-3">
    <table class="table table-striped table-bordered text-center">
      <thead class="thead-dark">
        <tr>
          <th>ID Penjualan</th>
          <th>Nama</th>
          <th>Telepon</th>
          <th>Alamat</th>
          <th>Kode Pos</th>
          <th>Pembayaran</th>
          <th>Tgl. Pembelian</th>
          <th>Status</th>
        </tr>
      </thead>

      <tbody>
        <?php
            $status = $data['status'];
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
          </tr>
      </tbody>
    </table>
  </div>
<?php
    $sql = "SELECT jual.id_barang, nama_barang, kuantitas, harga_beli FROM jual JOIN barang ON barang.id_barang = jual.id_barang WHERE id_penjualan = $id";
    $res = mysqli_query($koneksi, $sql);
?>
  <div class="table-responsive">
    <h3>Detail Penjualan :</h3>
    <table class="table table-striped table-bordered text-center">
      <thead class="thead-dark">
        <tr>
          <th>ID Barang</th>
          <th>Nama Barang</th>
          <th>Kuantitas</th>
          <th>Harga Jual</th>
        </tr>
      </thead>
      <tbody>
      <?php
        while ($data = mysqli_fetch_array($res)) {
      ?>
        <tr>
          <td><?php echo $data['id_barang']; ?></td>
          <td><?php echo $data['nama_barang']; ?></td>
          <td><?php echo $data['kuantitas']; ?></td>
          <td>Rp. <?php echo number_format($data['harga_beli'],0,',','.') ?></td>
        </tr>
      <?php
        }
      ?>
      </tbody>
    </table>
  </div>
  <a class="btn btn-secondary" href="index.php?content=admin.php">
    <i class="fa fa-arrow-left"></i>
    Kembali
  </a>
  <?php
    if ($status != 2) {
  ?>
  <a class="btn btn-info ml-auto" href="index.php?content=view_detail.php&data=<?php echo($id); ?>&status=<?php echo($status); ?>">
    <!-- <i class="fa fa-arrow-left"></i> -->
    Update
  </a>
  <?php
    }
  ?>
</div>
<!-- /.row -->

</div>
<!-- /.col-lg-12 -->