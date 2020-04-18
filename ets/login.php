<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form</title>
    <style>
        #container {
            margin: 30px;
        }
    </style>
</head>
<body>
    <div id="container">
        <form action="login.php" method="POST">
            <fieldset style="width: 25%;">
            <label for="usernane">id &nbsp;:</label>
            <input type="text" id="id" name="id" value=""><br><br>
            <label for="usernane">username &nbsp;:</label>
            <input type="text" id="username" name="username" value=""><br><br>
            <label for="password">password :</label>
            <input type="password" id="password" name="password" value=""><br><br>
            <p style="text-align: right;"><input type="submit" name="submit" value="Submit"></p>
            </fieldset>
    </div>
</body>
</html>

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
        $id = $_POST['id'];

        $sql = "SELECT * FROM pegawai WHERE id_pegawai = $id AND username LIKE'$username' AND password = '$password'";
        $res = mysqli_query($koneksi, $sql);
        if (mysqli_num_rows($res) == 1) {
            $_SESSION["username"] = $username;
            header("Location: tampil_data.php");
        } else {
            echo "ID Pegawai atau Username atau Password salah";
        }
    }
?>