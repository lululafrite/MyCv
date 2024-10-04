<?php
    require_once('../module/common/debug.php'); // Debugging add-ons: Comment before uploading
    session_start();
    require_once('../vendor/autoload.php'); // add-on Vendor
    require_once('../module/common/variable.php'); // Superglobal variables (mainly from SESSION)
    require_once('../module/garageparrot/head.php'); // Load the marker <head>
?>
<body>
    <?php require_once('../module/garageparrot/header.php'); // Load the marker <header> ?>
<main>
    <?php require_once('../module/garageparrot/main.php'); // loaded the page router ?>
</main>
    <?php
        if(!preg_match('/timeExpired/', $_SERVER['REQUEST_URI'])){
            require_once('../module/garageparrot/footer.php');  // Load the marker <footer>
            require_once('./js/common/libraryJS.php');
        }
    ?>
</body>
</html>