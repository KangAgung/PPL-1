<!DOCTYPE html>
<html lang="id">
<head>
<title></title>
<style>
    table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            width: 100%;
        }
    
    #header {
        height: 100px;
        text-align:center;
    }

    #footer {
        height: 100px;
        text-align:center;
    }

    #content {
        height: 200px;
        text-align:center;
    }

    #navbar {
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
            <a href="template.php?content=<?php echo"display_dan_viewdetail.php"; ?>">Display Data</a> |
            <a href="template.php?content=<?php echo"forminput.html"; ?>">Tambah Data</a> |
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