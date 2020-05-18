<?php 
    require_once 'koneksi.php'
?>

<!DOCTYPE html>
<html lang="id">
<head>
<title>Online Shop</title>
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

    table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
    }

    th {
        background-color: #263238;
        color: #eee;
    }

    td, th {
        padding: 10px 20px;
    }

    .list-barang tr:nth-child(even) {
        background-color: #546E7A;
    }

    .list-barang tr:nth-child(odd){
        background-color: #757575;
    }

    .logo {
        width: 100px;
        height:100px;
    }

    .barang{
        text-align: left;
    }

    .alt-barang{
        text-align: right;
    }

    .hasil {
        text-align: inherit;
    }

    .foto-barang {
        width:100px;
        height:100px;
    }
    .container {
        padding-right: 15px;
        padding-left: 15px;
        margin-right: auto;
        margin-left: auto;
    }
</style>
</head>
<body>
    <table>
        <tr id="header">
            <td><img src="../assets/polban.png" alt="logo" class="logo"><br> Header</td>
        </tr>
        <tr id="navbar">
        <td>
            <a href="index.php?content=<?php echo"home.php"; ?>">Home</a> |
            <a href="index.php?content=<?php echo"cart.php"; ?>">Cart</a> 
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