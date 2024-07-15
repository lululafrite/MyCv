<?php
    include_once('../module/debug.php'); // Debugging add-ons: Comment before uploading

    session_start();
    include_once('../vendor/autoload.php'); // add-on Vendor

    include_once('../module/variable.php'); // Superglobal variables (mainly from SESSION)
    include_once('../module/head.php'); // Load the marker <head>
?>

<body class="bg-body-tertiary p-0 m-0">

    <?php include_once('../module/header.php'); // Load the marker <header> ?>

    <main class=" p-0 mx-0 my-5">
        <?php include_once('../module/router.php'); // loaded the page router ?>
    </main>

    <?php include_once('../module/footer.php');  // Load the marker <footer> ?>

    <?php include_once('./js/libraryJS.php'); ?>

</body>

</html>