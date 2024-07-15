<?php
    
    include_once '../../module/debug.php';
    session_start();
    require '../../vendor/autoload.php';    
    include_once '../../module/variable.php';
    include_once '../../garageparrot/module/head.php';

?>

<body>

    <?php include_once '../../garageparrot/module/header.php'; ?>
    <?php include_once '../../garageparrot/module/main.php'; ?>
    <?php include_once '../../garageparrot/module/footer.php'; ?>

    <?php include_once('../js/libraryJS.php'); ?>

</body>

</html>