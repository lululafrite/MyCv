<?php include_once ("../controller/home.controller.php");?>

<header class="d-flex flex-column m-auto p-0">

    <div class="container-fluid m-0 p-0">
        <?php include_once('../module/navBar.php'); ?>
    </div>
    
    <div class="container-fluid text-center justify-item-center m-auto">

        <form method="post" id="formHome" enctype="multipart/form-data">
            
            <!-- input hidden csrf -->
            <input
                type="hidden"
                name="csrfHome"
                value="<?php echo $_SESSION['csrfHome'];?>"
            >

            <?php if ($_SESSION['typeConnect']!='Administrator'){ ?>

                <h1 class="text-light"><?php echo escapeInput($home[0]['home_title']); ?></h1>
                <h2 class="text-light"><?php echo escapeInput($home[0]['home_subtitle']); ?></h2>

            <?php }else if ($_SESSION['typeConnect']==='Administrator'){ ?>

                <h1>

                    <input
                        class="text-center"
                        type="text"
                        id="text_home_title"
                        name="text_home_title"
                        value="<?php echo escapeInput($home[0]['home_title']); ?>"
                    >

                </h1>
                <h2>

                    <input
                        class="text-center"
                        type="text"
                        id="text_home_subtitle"
                        name="text_home_subtitle"
                        value="<?php echo escapeInput($home[0]['home_subtitle']); ?>"
                    >

                </h2>

            <?php } ?>

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

        <!-- </form> -->

    </div>

</header>