<?php
    require_once('../module/debug.php'); // Debugging add-ons: Comment before uploading

    session_start();
    require_once('../vendor/autoload.php'); // add-on Vendor

    require_once('../module/variable.php'); // Superglobal variables (mainly from SESSION)
    require_once('../module/head.php'); // Load the marker <head>
?>

<body class="bg-body-tertiary p-0 m-0">

    <?php require_once('../module/header.php'); // Load the marker <header> ?>

    <main class=" p-0 mx-0 my-0">
        <?php require_once('../module/router.php'); // loaded the page router ?>
    </main>

    <?php require_once('../module/footer.php');  // Load the marker <footer> ?>

    <?php require_once('./js/libraryJS.php'); ?>

</body>

</html>