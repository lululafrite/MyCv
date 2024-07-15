<?php
    include_once '../../module/debug.php'; // Debugging add-ons: Comment before uploading

    session_start();
    include_once '../../vendor/autoload.php'; // add-on Vendor

    include_once '../../module/variable.php'; // Superglobal variables (mainly from SESSION)
    include_once '../../goldorak/module/head.php'; // Load the marker <head>
?>

<body class="bg-black p-0 m-0 text-light">

    <?php include_once '../../goldorak/module/header.php'; // Load the marker <header> ?>

    <main>
        <?php include_once('../../goldorak/module/router.php'); // loaded the page router ?>
    </main>

    <?php
        $current_url = $_SERVER['REQUEST_URI'];
        $timeExpired = '/timeExpired/';
        if(!preg_match($timeExpired, $current_url)){
    ?>

        <?php include_once '../../goldorak/module/footer.php';  // Load the marker <footer> ?>

        <?php include_once('../js/libraryJS.php'); ?>

    <?php } ?>

</body>

</html>