<?php
    if(!empty($_POST["username"]) && !empty($_POST["password"])) {
        $username = $_POST["username"];
        $password = md5($_POST["password"]); // using md5 hash
  
        $sql = "SELECT * FROM customer WHERE username LIKE'$username' AND password = '$password'";
        $res = mysqli_query($koneksi, $sql);
        $data = mysqli_fetch_array($res);

        if (mysqli_num_rows($res) == 1) {
          $_SESSION['username'] = $data['username'];
          $_SESSION['uid'] = $data['id_customer'];            
        }
  

    }
?>

<script>
  location.replace('index.php');
</script>