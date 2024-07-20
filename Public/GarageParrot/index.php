<?php
    
    require_once '../../module/debug.php';
    session_start();
    require '../../vendor/autoload.php';    
    require_once '../../module/variable.php';
    require_once '../../garageparrot/module/head.php';

?>

<body>

    <?php require_once '../../garageparrot/module/header.php'; ?>
    <?php require_once '../../garageparrot/module/main.php'; ?>
    <?php require_once '../../garageparrot/module/footer.php'; ?>

    <?php require_once('../js/libraryJS.php'); ?>

</body>

</html>