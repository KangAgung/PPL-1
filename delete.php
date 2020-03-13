<?php
    $host = "localhost";
    $database = "dbakademis";
    $user = "root";
    $password = "";
    $koneksi=mysqli_connect($host,$user,$password,$database);
    if(!$koneksi) {
        die("Error : ".mysql_error());
    }

    $nim = $_GET['nim'];
    $sql = "DELETE FROM mahasiswa WHERE nim = $nim";
    $res = mysqli_query($koneksi, $sql);
    ?>

    <!DOCTYPE html>
    <html lang="id">
    <head>
    <title><?php if ($res) {
            echo ("Berhasil!");
        } else {
            echo("Gagal!");
        } ?>
    </title>
    </head>
    <body>
<?php
    if($res) {
        echo ("<script type='text/javascript'>window.alert('Berhasil menghapus !');
                location.replace('display_dan_viewdetail.php');
            </script>");
    } else {
        echo ("<script type='text/javascript'>window.alert('Gagal menghapus !');
                location.replace('display_dan_viewdetail.php');
            </script>");
    }
?>
    </body>
    </html>