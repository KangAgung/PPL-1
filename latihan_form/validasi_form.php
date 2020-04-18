<?php
    $nim = $nama = $hp = $email = $gender = '';
    $nimErr = $namaErr = $hpErr = $emailErr= $genderErr = '';
    $nimDump = $namaDump = $hpDump = $emailDump = '';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["nim"])) {
            $nimErr = "Nim is required";
          } else if (!is_numeric($_POST["nim"])) {
            $nimDump = $_POST["nim"];
            $nimErr = "Nim hanya boleh berupa angka";
          } else {
            $nim = $_POST["nim"];
          }
    
        if (empty($_POST["nama"])) {
          $namaErr = "Nama is required";
        } else if (is_numeric($_POST["nama"])) {
            $namaDump = $_POST["nama"];
            $namaErr = "Nama hanya boleh berupa huruf";
        } else {
          $nama = $_POST["nama"];
        }
    
        if (empty($_POST["hp"])) {
            $hpErr = "Nomor HP is required";
          } else if (!is_numeric($_POST["nim"])) {
            $hpDump = $_POST["hp"];
            $hpErr = "Nomor HP harus berupa angka";
          } else {
            $hp = $_POST["hp"];
          }
        
        if (empty($_POST["email"])) {
          $emailErr = "Email is required";
        } else if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
            $emailDump = $_POST["email"];
        } else {
          $email = $_POST["email"];
        }
      
        if (empty($_POST["gender"])) {
          $genderErr = "Gender is required";
        } else {
          $gender = $_POST["gender"];
        }
      }

?>

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
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <div id="container">
    <span class="error">* Harap isi bidang ini</span><br>
        <form action="" method="POST">
            <fieldset style="width: 40%;">
            <label for="nim">NIM &nbsp;:</label>
            <input type="text" id="nim" name="nim" value="" >
            <span class="error">* <?php echo $nimErr ?></span><br><br>

            <label for="nama">Nama :</label>
            <input type="text" id="nama" name="nama" value="" >
            <span class="error">* <?php echo $namaErr ?></span><br><br>

            <label for="hp">HP :</label>
            <input type="tel" id="hp" name="hp" value="" >
            <span class="error">* <?php echo $hpErr ?></span><br><br>

            <label for="email">Email :</label>
            <input type="text" id="email" name="email" value="" >
            <span class="error">* <?php echo $emailErr ?></span><br><br>

            <label for="gender">Gender :</label>
            <input type="radio" id="male" name="gender" value="Pria" >
            <label for="male">Pria</label>
            <input type="radio" id="female" name="gender" value="Wanita">
            <label for="female">Wanita</label>
            <span class="error">* <?php echo $genderErr ?></span><br><br>

            <p style="text-align: right;"><input type="submit" value="Submit"></p>
            </fieldset>
    </div>
</body>
</html>

<?php
 
if (!empty($nim) && !empty($nama) && !empty($hp) && !empty($email) && !empty($gender)) {
    $host = "localhost";
    $database = "dbakademis";
    $user = "root";
    $password = "";
    $koneksi=mysqli_connect($host,$user,$password,$database);
    if(!$koneksi) {
        die("Error : ".mysql_error());
    }
    $sql = "INSERT INTO mhsw VALUES ('$nim','$nama','$hp','$email','$gender')";
    $res = mysqli_query($koneksi, $sql);

    if ($res) {
        echo "Data berhasil disimpan";
        echo "<br><br>";
    } else {
        echo "Data gagal disimpan";
        echo "<br><br>";
    }

    $nimDump = $_POST['nim'];
    $namaDump = $_POST['nama'];
    $hpDump = $_POST['hp'];
    $emailDump = $_POST['email'];

    echo "<h2>Hasil input:</h2>";
    echo $nimDump;
    echo "<br>";
    echo $namaDump;
    echo "<br>";
    echo $hpDump;
    echo "<br>";
    echo $emailDump;
    echo "<br>";
    echo $gender;
    echo "<br>";
}
    
    
?>