<?php
    require_once "config/koneksi.php";

    if (isset($_GET['empty']) && $_GET['empty'] == true) {
        unset($_SESSION['cart']);
        unset($_SESSION['harga']);
    }

    if (isset($_GET['aksi']) && $_GET['aksi'] == "del") {
        unset($_SESSION['cart'][$_GET['id']]);
    }

    if (isset($_GET['aksi']) && $_GET['aksi'] == "plus") {
      if ($_SESSION['cart'][$_GET['id']][3] < $_SESSION['cart'][$_GET['id']][5]) {
        $_SESSION['cart'][$_GET['id']][3] += 1;
      }
    }

    if (isset($_GET['aksi']) && $_GET['aksi'] == "min") {
      if ($_SESSION['cart'][$_GET['id']][3] > 1) {
        $_SESSION['cart'][$_GET['id']][3] -= 1;
      }
    }
?>
<div class="container">

<div class="row">
  
<div class="col-lg-12">

<div class="row my-4">

<?php
    if (isset($_POST['id']) && isset($_SESSION['username'])) {
        $data = $_POST['id'];
        $qty = $_POST['qty'];

        $sql = "SELECT * FROM barang WHERE id_barang = $data ";
        $res = mysqli_query($koneksi, $sql);
    
        $result = mysqli_fetch_array($res);
        if (empty($_SESSION['cart'][$result['id_barang']])) {
            $_SESSION['cart'][$result['id_barang']] = array($result['id_barang'],$result['nama_barang'],$result['harga'],$qty,$result['berat'],$result['stok']);
        } else {
            $_SESSION['cart'][$result['id_barang']][3] += $qty;
        }
                
    }

    if (!empty($_SESSION['cart'])) {
?>
    <div class="col-12">
      <div class="alert alert-info py-3" role="alert">
        <div class="text-center">
          <a href="index.php?content=home.php">klik disini</a> untuk kembali belanja
        </div>
      </div>
      <div class="table-responsive">
        <table class="table table-striped table-bordered text-center">
          <thead class="thead-dark">
            <tr>
              <th>Kode Barang</th>
              <th>Nama Barang</th>
              <th>harga/unit</th>
              <th>jumlah</th>
              <th>Berat (Kg)</th>
              <th>sub total</th>
              <th>Aksi</th>
            </tr>
          </thead>
    
          <tbody>
            <?php foreach ($_SESSION['cart'] as $value) {  ?>
              <tr>
                <td><?php echo $value[0]; ?></td>
                <td><?php echo $value[1]; ?></td>
                <td>Rp. <?php echo number_format($value[2],0,',','.'); ?></td>
                <td><?php echo $value[3]; ?></td>
                <td><?php echo $value[4]; ?></td>
                <td>Rp. <?php echo number_format($value[2]*$value[3],0,',','.'); ?></td>
                <td>
                  <a href="index.php?content=cart.php&aksi=plus&id=<?php echo $value[0]; ?>" class="btn btn-info">
                      <i class="fa fa-plus"></i>
                  </a>
                  <a href="index.php?content=cart.php&aksi=min&id=<?php echo $value[0]; ?>" class="btn btn-info">
                      <i class="fa fa-minus"></i>
                  </a>
                    <a href="index.php?content=cart.php&aksi=del&id=<?php echo $value[0]; ?>" class="btn btn-danger">
                      <i class="fa fa-trash-alt"></i>
                    </a>
                </td>
              </tr>
            <?php
                }
            ?>
              <tr>
                <th class="table-dark" colspan="3">Total :</th>
                <td>
                    <?php
                        $quantity = 0;
                        $beratTot = 0;
                        $totalHarga = 0;
                        foreach ($_SESSION['cart'] as $value) {
                            $quantity = $quantity + $value[3];
                            $beratTot = $beratTot + $value[3]*$value[4];
                            $totalHarga = $totalHarga + $value[2]*$value[3];
                        }
                        echo $quantity;
                     ?>
                </td>
                <td>
                    <?php
                        echo $beratTot;
                     ?>
                </td>
                <td><b>Rp. 
                <?php
                    $_SESSION['harga'] = $totalHarga;
                    echo number_format($totalHarga,0,',','.');
                ?></b>
                </td>
                <td>
                    <a href="index.php?content=cart.php&empty=true" class="btn btn-danger">
                      Hapus
                    </a>
                <?php
                  if (isset($_SESSION['username'])) {
                ?>
                    <a href="index.php?content=form.php" class="btn btn-success">
                      Beli
                    </a>
                <?php
                  } else {
                ?>
                    <a href="#login" data-toggle="modal" data-target="#loginModal" class="btn btn-success">
                      Beli
                    </a>
                <?php
                  }
                ?>
                </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
<?php
    } else { 
?>
      <div class="col-12">
        <div class="alert alert-info py-3" role="alert">
          <div class="text-center">
            Keranjang Kosong
          </div>
        </div>
      </div>
<?php
    }
?>

</div>
<!-- /.row -->

</div>
<!-- /.col-lg-12 -->
