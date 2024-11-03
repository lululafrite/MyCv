<!-- -------- FILE ASSET JAVASCRIPT FOR BOOTSTRAP (STANDARD AND POPPER) --------- -->

<?php
    $home = strpos($_SERVER['REQUEST_URI'], 'home') !== false;
?>

<script src="../js/assets/bootstrap.bundle.min.js"></script>

<?php if($home){ ?>

    <!--<script src="../js/assets/jquery-3.7.1.min.js"></script>
    <script src="../js/assets/jquery.fancybox.min.js"></script>-->
    <script src="../js/common/function.js"></script>
    <script src="../js/common/rating.js"></script>

<?php }