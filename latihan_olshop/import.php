<?php 
    require_once "config/koneksi.php";
    require 'vendor/autoload.php';
 
    use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

    if (isset($_POST["import"])) {
      
      $allowedFileType = [
        'application/octet-stream',
        'application/excel',
        'application/vnd.msexcel',
        'application/vnd.ms-excel',
        'text/xls',
        'text/xlsx',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
      ];

      if (isset($_FILES['importFile']['name']) && in_array($_FILES['importFile']['type'], $allowedFileType)) {
        
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();

        $spreadsheet = $reader->load($_FILES['importFile']['tmp_name']);
        $sheetData = $spreadsheet->getActiveSheet()->toArray();

        for($i = 1;$i < count($sheetData);$i++) {

          $nama = $sheetData[$i]['1'];
          $harga = $sheetData[$i]['2'];
          $stok = $sheetData[$i]['3'];
          $berat = $sheetData[$i]['4'];

          $sql = "INSERT into barang(nama_barang,harga,stok,berat) values ('$nama','$harga','$stok','$berat')";
          $res = mysqli_query($koneksi,$sql);
        }
      }
    }

    $sql = "SELECT * from barang";
    $res = mysqli_query($koneksi, $sql);

?>
<div class="container">

<div class="row">

<div class="col-lg-12">

<div class="row my-4 mx-2">

    <div class="table-responsive">
        <table class="table table-striped table-bordered table-sm text-center">
            <thead class="thead-dark">
                <tr>
                    <th>ID Barang</th>
                    <th>Nama Barang</th>
                    <th>Harga</th>
                    <th>Stok barang</th>
                    <th>Berat barang</th>
                </tr>
            </thead>
        
            
        <?php
          while ($data = mysqli_fetch_array($res)) {
        ?>
              <tr>
                <td><?php echo($data['id_barang']); ?></td>
                <td><?php echo($data['nama_barang']); ?></td>
                <td><?php echo($data['harga']); ?></td>
                <td><?php echo($data['stok']); ?></td>
                <td><?php echo($data['berat']); ?></td>
                <!-- <td>
                  <a class="btn btn-primary btn-sm" href="index.php?content=view_detail.php&data=">
                      Detail
                  </a>
                </td> -->
            </tr>
        <?php
            }
        ?>
        </table>
    </div>
    <div class="">
      <form action="index.php?content=import.php" enctype="multipart/form-data" method="post">
        <div class="form-row">
          <div class="col">
            <div class="custom-file">
              <label class="custom-file-label" for="importFile">Choose File</label>
              <input class="custom-file-input" type="file" name="importFile" required>
            </div>
          </div>
          <div class="col">
            <input class="btn btn-info" type="submit" name="import" value="Import">
          </div>
        </div>
      </form>
    </div>

</div>
<!-- /.row -->

</div>
<!-- /.col-lg-12 -->