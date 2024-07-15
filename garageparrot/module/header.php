<header class="container-fluid m-0 mb-5 p-0 pb-1" style="background-image: url('img/baniere/Black-Car-Wallpaper_1300x428.jpg'); background-size: cover; background-position: center; height: auto; width:auto ">

    <div class="container-fluid m-0 p-0">
        <?php include_once('../../garageparrot/module/navBar.php'); ?>
    </div>
    
    <div class="d-sm-flex justify-content-sm-between p-3">
        
        <div class="container-fluid text-center m-auto">
            <h1 class="text-light">GARAGE V.PARROT</h1>
            <h2 class="text-light">Des véhicules de qualité selectionnés par des experts</h2>
        </div>

    </div>
    
    <?php
        
        if (isset($_POST['next']) || isset($_POST['previous'])){
            include_once('../../garageparrot/controller/page.controller.php');
        }

    ?>

</header>


