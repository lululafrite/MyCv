<!--
<?php
    /*
    require_once("../../module/debug.php");
    session_start();
    require("../../vendor/autoload.php");    
    require_once("../../module/variable.php");
    require_once("../../garageparrot/module/head.php");
    */
?>

<body>

    <?php //require_once("../../garageparrot/module/header.php"); ?>
    <?php //require_once("../../garageparrot/module/main.php"); ?>
    <?php //require_once("../../garageparrot/module/footer.php"); ?>

    <?php //require_once("../js/libraryJS.php"); ?>

</body>

</html>
-->

<?php
    require_once '../../module/debug.php'; // Debugging add-ons: Comment before uploading

    session_start();
    require_once '../../vendor/autoload.php'; // add-on Vendor

    require_once '../../module/variable.php'; // Superglobal variables (mainly from SESSION)
    require_once '../../garageparrot/module/head.php'; // Load the marker <head>
    
?>


<body>

    <?php require_once '../../garageparrot/module/header.php'; // Load the marker <header> ?>

    <main>
        <?php require_once('../../garageparrot/module/main.php'); // loaded the page router ?>
    </main>

    <?php
        $current_url = $_SERVER['REQUEST_URI'];
        $timeExpired = '/timeExpired/';
        if(!preg_match($timeExpired, $current_url)){
    ?>

        <?php require_once '../../garageparrot/module/footer.php';  // Load the marker <footer> ?>

        <?php require_once('../js/libraryJS.php'); ?>

    <?php } ?>

</body>

</html>