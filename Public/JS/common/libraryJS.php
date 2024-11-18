<!-- -------- FILE ASSET JAVASCRIPT FOR BOOTSTRAP (STANDARD AND POPPER) --------- -->

<?php
    $home = strpos($_SERVER['REQUEST_URI'], 'home') !== false;
    $car = strpos($_SERVER['REQUEST_URI'], 'car') !== false;
    $mycv = strpos($_SERVER['REQUEST_URI'], 'page=mycv') !== false;
?>

<script src="../js/assets/bootstrap.bundle.min.js"></script>

<?php if($home){ ?>

    <script src="../js/common/function.js"></script>
    <script src="../js/common/rating.js"></script>

<?php }else if($car || $mycv){ ?>
    
    <script src="../js/assets/jquery-3.7.1.min.js"></script>
    <script src="../js/assets/jquery.fancybox.min.js"></script>

<?php } ?>

<script src="../js/common/rgpd.js"></script>