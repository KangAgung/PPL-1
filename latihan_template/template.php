<?php
    $host = "localhost";
    $database = "dbakademis";
    $user = "root";
    $password = "";
    $koneksi=mysqli_connect($host,$user,$password,$database);
    if(!$koneksi) {
        die("Error : ".mysql_error());
    }

    session_start();
    if(!empty($_POST["username"]) && !empty($_POST["password"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];
        // $password = md5($_POST["password"]); // using md5 hash

        $sql = "SELECT * FROM admin WHERE username LIKE'$username' AND password = '$password'";
        $res = mysqli_query($koneksi, $sql);
        if (mysqli_num_rows($res) == 0) {
            header("Location: login.php");
        }

        $_SESSION["username"] = $username;
    }

    if(!isset($_SESSION["username"])){
        session_destroy();
        header("location: login.php");
    }
?>

<!DOCTYPE html>
<html lang="id">
<head>
<title></title>
<style>
    table {
        border: 1px solid black;
        border-collapse: collapse;
        width: 100%;
    }
    
    #header, #footer {
        border: 1px solid black;
        border-collapse: collapse;
        width: 100%;
        height: 100px;
        text-align:center;
    }

    #content {
        border: 1px solid black;
        border-collapse: collapse;
        width: 100%;
        height: 200px;
        text-align:center;
    }

    #navbar {
        border: 1px solid black;
        border-collapse: collapse;
        width: 100%;
        height: 50px;
        text-align: left;
    }

    .logo {
        width: 100px;
        height:100px;
    }
</style>
</head>
<body>
    <table align="center">
        <tr id="header">
            <td><img src="../assets/polban.png" alt="logo" class="logo"><br> Header</td>
        </tr>
        <tr id="navbar">
        <td>
            <a href="template.php?content=<?php echo"home.php"; ?>">Home</a> | 
            <a href="template.php?content=<?php echo"berita.php"; ?>">Berita</a> |
            <a href="template.php?content=<?php echo"kontak.php"; ?>">Kontak</a> |
            <a href="template.php?content=<?php echo"display_dan_viewdetail.php"; ?>">Mahasiswa</a> |
            <a href="template.php?content=<?php echo"cari.php"; ?>">Barang</a> |
            <a href="template.php?content=forminput.html">Tambah Data Mahasiswa</a> |
            <a href="logout.php">Logout</a>
        </td>
        </tr>
        <tr id="content">
            <td>
                <?php
                    if(!isset($_GET['content'])) {
                        $content = "home.php";
                    } else {
                        $content = $_GET['content'];
                    }

                    include $content;
                ?>
            </td>
        </tr>
        <tr id="footer">
        <td>Footer</td>
        </tr>
    </table>
</body>
</html>