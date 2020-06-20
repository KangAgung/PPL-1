<?php 
    require 'vendor/autoload.php';
    require 'config/koneksi.php';

    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
 
    $spreadsheet = new Spreadsheet();
 
    $spreadsheet->setActiveSheetIndex(0);
    $activeSheet = $spreadsheet->getActiveSheet();
 
    $activeSheet->setCellValue('A1', 'ID Penjualan');
    $activeSheet->setCellValue('B1', 'Nama Pembeli');
    $activeSheet->setCellValue('C1', 'Telepon');
    $activeSheet->setCellValue('D1', 'Alamat');
    $activeSheet->setCellValue('E1', 'Kode Pos');
    $activeSheet->setCellValue('F1', 'Total Harga');
    $activeSheet->setCellValue('G1', 'Tgl. Pembelian');
    $activeSheet->setCellValue('H1', 'Status');
 
    $sql = "SELECT * FROM penjualan JOIN customer ON penjualan.id_customer = customer.id_customer";
    $res = mysqli_query($koneksi, $sql);
 
    if($res->num_rows > 0) {
        $i = 2;
        while($row = $res->fetch_assoc()) {
          if ($row['status'] == 0) {
            $status = "Belum dibayar";
          } else if ($row['status'] == 1) {
            $status = "Sudah dibayar";
          } else {
            $status = "Sudah dikirim";
          }

          $harga = "Rp. ".number_format($row['harga_total'],0,',','.');

            $activeSheet->setCellValue('A'.$i , $row['id_penjualan']);
            $activeSheet->setCellValue('B'.$i , $row['nama']);
            $activeSheet->setCellValue('C'.$i , $row['nomor_hp']);
            $activeSheet->setCellValue('D'.$i , $row['alamat']);
            $activeSheet->setCellValue('E'.$i , $row['kode_pos']);
            $activeSheet->setCellValue('F'.$i , $harga);
            $activeSheet->setCellValue('G'.$i , $row['waktu_penjualan']);
            $activeSheet->setCellValue('H'.$i , $status);
            $i++;
        }
    }

    $styleHeader = [
      'font' => [
             'bold' => true,
         ],
         'alignment' => [
             'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
             'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
             'wrapText' => true,
         ],
    ];

    $styleArray = [
      'alignment' => [
          'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
          'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
          'wrapText' => true,
      ],
    ];
  
    $spreadsheet->getActiveSheet()->getStyle('A1:H1')->applyFromArray($styleHeader);
    $spreadsheet->getActiveSheet()->getStyle('A2:H'.$i.'')->applyFromArray($styleArray);
    
    $writer = new Xlsx($spreadsheet);

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header("Content-Transfer-Encoding: Binary");
    header('Content-disposition: attachment; filename="Data Penjualan.xlsx"');
    header('Cache-Control: max-age=0');
    $writer->save("php://output");
?>