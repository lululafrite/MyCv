<?php
    require_once('../module/common/debug.php'); // Debugging add-ons: Comment before uploading

    session_start();
    require_once '../vendor/autoload.php'; // add-on Vendor

    require_once('../module/common/variable.php'); // Superglobal variables (mainly from SESSION)
    require_once '../module/goldorak/head.php'; // Load the marker <head>
?>

<body class="bg-black p-0 m-0 text-light">

    <?php require_once '../module/goldorak/header.php'; // Load the marker <header> ?>

    <main>
        <?php require_once('../module/goldorak/router.php'); // loaded the page router ?>
    </main>

    <?php
        $current_url = $_SERVER['REQUEST_URI'];
        $timeExpired = '/timeExpired/';
        if(!preg_match($timeExpired, $current_url)){
    ?>

        <?php require_once '../module/goldorak/footer.php';  // Load the marker <footer> ?>

        <?php require_once('./js/libraryJS.php'); ?>

    <?php } ?>

</body>

</html>