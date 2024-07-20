<?php require_once ("../controller/home.controller.php");?>

<div class="container-fluid m-0 p-0 fixed-top">
        <?php require_once('../module/navBar.php'); ?>
</div>

<header class="d-flex justify-content-center align-items-center">
    
    <form class="" method="post" id="formHome" enctype="multipart/form-data">
        
        <!-- input hidden csrf -->
        <input
            type="hidden"
            name="csrfHome"
            value="<?php echo $_SESSION['csrfHome'];?>"
        >

        <div id="carouselExampleCaptions" class="carousel slide carousel-fade" data-bs-ride="carousel">

            <div class="carousel-inner">

                <div class="carousel-item active" data-bs-interval="10000">

                    <img src="img/banner/jpg/productivite_1920x400.jpg" class="d-block w-100" alt="...">
                    
                    <div class="carousel-caption d-flex justify-content-center align-items-center">

                        <div class="divHeader text-white text-center p-0 px-3 pt-2">

                            <?php if ($_SESSION['typeConnect']!='Administrator'){ ?>

                                <h2 class="titleHeader"><?php echo escapeInput($home[0]['home_title']); ?></h2>
                                <p class="subTitleHeader"><?php echo escapeInput($home[0]['home_subtitle']); ?></p>

                            <?php }else if ($_SESSION['typeConnect']==='Administrator'){ ?>

                                <h2>

                                    <input
                                        class="h1Header"
                                        type="text"
                                        id="text_home_title"
                                        name="text_home_title"
                                        value="<?php echo escapeInput($home[0]['home_title']); ?>"
                                    >

                                </h2>

                                <p>

                                    <input
                                        class="h2Header"
                                        type="text"
                                        id="text_home_subtitle"
                                        name="text_home_subtitle"
                                        value="<?php echo escapeInput($home[0]['home_subtitle']); ?>"
                                    >

                                </p>
                                
                            <?php } ?>
                            
                        </div>
                        
                    </div>

                </div>

                <div class="carousel-item">

                    <img src="img/banner/jpg/connectivite_1920x400.jpg" class="d-block w-100" alt="...">

                    <div class="carousel-caption d-flex justify-content-center">

                        <div class="divHeader text-white text-center p-0 px-3 pt-3">

                            <h2 class="titleHeader">Développement, Connectivité, Performance</h2>
                            <p class="subTitleHeader">Accédez à une productivité sans égale</p>

                        </div>
                    
                    </div>

                </div>

                <div class="carousel-item">

                    <img src="img/banner/jpg/agil_1920x400.jpg" class="d-block w-100" alt="...">

                    <div class="carousel-caption d-flex justify-content-center">

                        <div class="divHeader text-white text-center p-0 px-3 pt-3">

                            <h2 class="titleHeader">Gestion de projet</h2>
                            <p class="subTitleHeader">Spécifications, Budget, Organisation, Qualité et Résultats</p>

                        </div>

                    </div>

                </div>

            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>

            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>

        </div>

        <?php if($_SESSION['typeConnect'] === 'Administrator'){ ?>

            <div class="container d-flex justify-content-center mt-5">

                <div class="row">

                    <!-- Start button Save -->

                    <div class="container d-flex justify-content-center mb-2">

                        <input
                            class="btn btn-lg btn-success w-100"
                            type="button"
                            name="btn_save_header"
                            id="btn_save_header"
                            value="Enregistrer"
                        >

                    </div>

                    <!-- End button Save -->

                </div>

            </div>

        <?php } ?>

</header>