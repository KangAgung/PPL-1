<?php
    
    if(!isset($_GET['content'])) {
        $content = "home.php";
    } else {
        $content = $_GET['content'];
    }

    require_once 'config/koneksi.php';
    include 'includes/head.php';
    include 'includes/navbar.php';
    if ($content == "home.php") {
        include 'includes/sidebar.php';
    }
    
?>

<?php
    include $content;
?>
<?php
    include 'includes/footer.php';
?>