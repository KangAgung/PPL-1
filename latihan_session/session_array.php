<?php
    session_start();
    echo $_SESSION['barang'][1]."<br>";
    echo $_SESSION['barang'][2]."<br>";
    echo $_SESSION['barang'][3]."<br>";
    echo $_SESSION['barang'][4]."<br>";
    session_destroy();
?>