<?php 
    require_once "config/koneksi.php";
?>

<div class="col-lg-9">

<div class="row my-4">

<?php
    if(isset($_GET['cari'])){
        $cari = $_GET['cari'];
        $sql = "SELECT * FROM barang WHERE nama_barang LIKE'%$cari%'";
        $res = mysqli_query($koneksi, $sql);
?>
  <div class="col-md-12 mb-4">Hasil Pencarian : <?php echo($cari); ?></div>
<?php
        if (mysqli_affected_rows($koneksi) == 0) {
?>
  <div class="col-md-12 mb-4">Hasil Pencarian <?php echo($cari); ?> Tidak dapat ditemukan</div>
<?php
        }
    } else {
        $sql = "SELECT * from barang";
        $res = mysqli_query($koneksi, $sql);
    }

    while ($data = mysqli_fetch_array($res)) {
?>
  <div class="col-lg-4 col-md-6 mb-4">
    <div class="card h-100">
      <a href="../assets/barang/<?php echo($data['gambar_barang']); ?>" data-fancybox >
          <img class="card-img-top" src="../assets/barang/<?php echo($data['gambar_barang']); ?>" alt="<?php echo($data['nama_barang']); ?>">
      </a>
      <div class="card-body">
        <h4 class="card-title">
          <a href="#"><?php echo($data['nama_barang']); ?></a>
        </h4>
        <h5>Rp. <?php echo(number_format($data['harga'],0,',','.')); ?></h5>
        <p class="card-text">
            Stok tersisa : <?php echo($data['stok']); ?> <br>
            Berat satuan : <?php echo($data['berat']); ?> Kg
        </p>
      </div>
      <div class="card-footer">
        <div class="text-muted">
          <form action="index.php?content=cart.php" method="post" class="form-inline">
            <div class="form-group">
              <label for="quantity">Quantity : </label>
              <input type="hidden" name="id" value="<?php echo($data['id_barang']); ?>">
              <input type="number" class="form-control mx-sm-1" name="qty" value="1" min="1" max="<?php echo($data['stok']); ?>">
            </div>
        </div>
      </div>
      <?php
        if (isset($_SESSION['username'])) {
      ?>
      <button class="btn btn-info" type="submit"><i class="fa fa-plus"></i> Add to Cart</button>
      <?php
        } else {
      ?>
      <button class="btn btn-info" type="button" data-toggle="modal" data-target="#loginModal"><i class="fa fa-plus"></i> Add to Cart</button>
      <?php
        }
      ?>
      </form>
    </div>
  </div>
<?php
    }
?>

</div>
<!-- /.row -->

</div>
<!-- /.col-lg-9 -->
