<?php
    session_start();
    if(!empty($_POST["username"] && !empty($_POST["password"]))) {
        $_SESSION["username"] = $_POST["username"];
        $_SESSION["password"] = $_POST["password"];
    }

    if(!isset($_SESSION["username"])){
        session_destroy();
        header("location: login_tanpa_database.php");
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
</style>
</head>
<body>
    <table align="center">
        <tr id="header">
            <td>Header</td>
        </tr>
        <tr id="navbar">
        <td>
            <a href="template.php?content=<?php echo"home.php"; ?>">Home</a> | 
            <a href="template.php?content=<?php echo"berita.php"; ?>">Berita</a> |
            <a href="template.php?content=<?php echo"kontak.php"; ?>">Kontak</a> |
            <a href="template.php?content=<?php echo"cari.php"; ?>">Barang</a> |
            <a href="logout.php">Logout</a>
            <!-- <a href="template.php?content= echo"forminput.html"; ">Tambah Data</a> | -->
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