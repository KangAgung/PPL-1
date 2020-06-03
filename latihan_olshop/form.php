<?php
    require_once 'config/koneksi.php';

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
    
    if(isset($_SESSION['username']) && isset($_SESSION['uid'])){
        $id_customer = $_SESSION['uid'];
        $username = $_SESSION['username'];

        $sql = "SELECT * FROM customer WHERE id_customer = '$id_customer'";
        $res = mysqli_query($koneksi, $sql);
        $result = mysqli_fetch_array($res);

        $nama = $result['nama'];
        $no_hp = $result['nomor_hp'];
        $alamat = $result['alamat'];
        $kode_pos = $result['kode_pos'];

        $totalHarga = $_SESSION['harga'];
        $tgl_pembelian = date("Y-m-d H:i:s");
        $status = 0;

        $sql = "SELECT ongkir_per_kilo FROM ongkir WHERE kode_tujuan = '$kode_pos'";
        $res = mysqli_query($koneksi, $sql);
        $result = mysqli_fetch_array($res);
        $ongkir_per_kilo = $result['ongkir_per_kilo'];

        $ongkir = $beratTotal * $ongkir_per_kilo;
        
        foreach ($_SESSION['cart'] as $value) {  
          $id_barang = $value[0];
          $sql = "SELECT stok FROM barang WHERE id_barang = '$id_barang'";
          $res = mysqli_query($koneksi, $sql);
          $result = mysqli_fetch_array($res);
          $stok = $result['stok'] - $value[3];
          $sql = "UPDATE barang SET stok = '$stok' WHERE id_barang = '$id_barang'";
          $res = mysqli_query($koneksi, $sql);
        }

        $sql = "INSERT INTO penjualan VALUES (null,'$id_customer','$totalHarga','$tgl_pembelian','$status')";
        $res = mysqli_query($koneksi, $sql);
        $last_insert_id = mysqli_insert_id($koneksi);

        foreach ($_SESSION['cart'] as $value) { 
            $id_barang = $value[0]; 
            $kuantitas = $value[3];
            $harga_satuan = $value[2];
            $sql = "INSERT INTO jual VALUES (LAST_INSERT_ID(), '$id_barang', '$kuantitas', '$harga_satuan')";
            $res = mysqli_query($koneksi, $sql);
        }
        
?>
<div class="container">

<div class="row">

<div class="col-lg-12">

<div class="row my-4">
      <div class="col-12">
        <div class="alert alert-success py-3" role="alert">
          <div class="text-center">
          Terima kasih telah berbelanja disini. <a href="index.php?content=home.php">klik disini</a> untuk kembali belanja
          </div>
        </div>
      </div>
      <div class="col-lg-8">
        <div class="card">
          <div class="card-body">
            <h3 class="card-title">Detail Order :</h3>
            <div class="table-responsive px-3 py-3">
              <table class="table table-sm table-borderless">
                <tr>
                  <td>ID Penjualan</td>
                  <td>
                    <?php echo $last_insert_id; ?>
                  </td>
                </tr>
                <tr>
                  <td>Nama</td>
                  <td>
                    <?php echo $nama; ?>
                  </td>
                </tr>
                <tr>
                  <td>Nomor Telepon</td>
                  <td>
                    <?php echo $no_hp; ?>
                  </td>
                </tr>
                <tr>
                  <td>Alamat</td>
                  <td>
                    <?php echo $alamat; ?>
                  </td>
                </tr>
                <tr>
                  <td>Kode Pos</td>
                  <td>
                    <?php echo $kode_pos; ?>
                  </td>
                </tr>
                <tr>
                  <td>Tanggal Pembelian</td>
                  <td>
                    <?php echo $tgl_pembelian; ?>
                  </td>
                </tr>
                <tr>
                  <td>Status</td>
                  <td>
                    <?php
                      if ($status == 0) {
                          echo "Belum dibayar";
                      } else if ($status == 1) {
                          echo "Sudah dibayar";
                      } else {
                          echo "Sudah dikirim";
                      }
                    ?>
                  </td>
                </tr>
              </table>
            </div>
            <div class="card">
              <div class="card-body">
                  <div class="table-responsive">
                  <h5 class="card-title">Barang yang dibeli :</h5>
                    <table class="table table-striped text-center">
                      <thead class="thead-dark">
                        <tr>
                          <th>Kode Barang</th>
                          <th>Nama Barang</th>
                          <th>harga satuan</th>
                          <th>jumlah</th>
                          <th>Berat (Kg)</th>
                          <th>sub total</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                        if (isset($_SESSION['cart'])) {    
                          foreach ($_SESSION['cart'] as $value) {
                      ?>
                        <tr>
                          <td><?php echo $value[0]; ?></td>
                          <td><?php echo $value[1]; ?></td>
                          <td><?php echo $value[2]; ?></td>
                          <td><?php echo $value[3]; ?></td>
                          <td><?php echo $value[4]; ?></td>
                          <td><?php echo number_format($value[2]*$value[3],0,',','.'); ?></td>
                        </tr>
                      <?php
                          }
                        }
                      ?>
                        <tr>
                          <th colspan="5" class="text-right">Total Harga :</th>
                          <th><?php if(isset($_SESSION['harga'])){ echo number_format($_SESSION['harga'],0,',','.'); }?></th>
                        </tr>
                      </tbody>
                    </table>
                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="card">
          <div class="card-body">
            <div class="table-responsive">
              <h3 class="card-title">Rincian total harga</h3>
                <table class="table table-sm">
                  <tr>
                    <td>Harga Total</td>
                    <td>
                      <?php if(isset($_SESSION['harga'])){ echo number_format($_SESSION['harga'],0,',','.'); }?>
                    </td>
                  </tr>
                  <tr>
                    <td>Berat Total</td>
                    <td>
                      <?php echo $beratTotal;?>
                    </td>
                  </tr>
                  <tr>
                    <td>Ongkir per Kg</td>
                    <td>
                    <?php echo number_format($ongkir_per_kilo,0,',','.');?>
                    </td>
                  </tr>
                  <tr>
                    <td>Biaya Ongkir</td>
                    <td>
                      <?php echo number_format($ongkir,0,',','.');?>
                    </td>
                  </tr>
                  <tr>
                    <th>Total</th>
                    <th>
                      <?php if(isset($_SESSION['harga'])){ echo number_format($_SESSION['harga']+$ongkir,0,',','.'); }?>
                    </th>
                  </tr>
                </table>
            </div>
          </div>
        </div>
      </div>
</div>
<!-- /.row -->

</div>
<!-- /.col-lg-9 -->
<?php
        unset($_SESSION['cart']);
        unset($_SESSION['harga']);

    }
?>
