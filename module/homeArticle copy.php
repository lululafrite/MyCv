<?php function homeChapterImgRight($home){ ?>
    
    <div class="row m-2">

        <div class="d-flex flex-column flex-lg-row align-items-stretch m-0 p-0">
            
            <!-- <div class="col-12 col-lg-8 overflow-auto border rounded-3 m-0 p-3 me-3" style="max-height: 400px"> -->
            <div class="col-12 overflow-auto border rounded-3 m-0 p-3 me-3" style="max-height: 400px">

                <div class="d-flex justify-content-between align-items-start">

                    <div class="">

                        <!-- Start Titre chapter1 -->

                        <?php if ($_SESSION['typeConnect']!='Administrator'){ ?>

                            <h3><?php echo escapeInput($home[0]['home_article1_title']); ?></h3>

                        <?php } ?>

                        <?php if ($_SESSION['typeConnect']==='Administrator'){ ?>

                            <h3>

                                <input
                                    type="text"
                                    id="text_home_article1_title"
                                    name="text_home_article1_title"
                                    value="<?php echo escapeInput($home[0]['home_article1_title']); ?>"
                                >

                            </h3>

                        <?php } ?>

                        <!-- End Titre chapter1 -->

                        <!-- Start Chapter 1 -->

                        <?php if ($_SESSION['typeConnect']!='Administrator'){ ?>

                            <p class="p-0" style="text-align: justify; white-space: pre-line;">
                                <?php echo escapeInput($home[0]['home_article1']); ?>
                            </p>

                        <?php } ?>

                        <?php if ($_SESSION['typeConnect']==='Administrator'){ ?>
                            
                            <p class="p-0" style="text-align: justify; white-space: pre-line;">
                                <textarea
                                    name="textarea_home_article1"
                                    id="textarea_home_article1"
                                    cols="1"
                                    rows="12"
                                ><?php echo escapeInput($home[0]['home_article1']); ?></textarea>
                            </p>

                        <!-- End Chapter 1 -->
                            
                        <!-- Start input end botton upload image chapter1 -->

                            <div class="container">  

                                <div class="row">

                                    <div class="container m-0 p-0">

                                        <div class="row">

                                            <div class="col-12 col-lg-5 pb-3 pb-lg-0">

                                                <input
                                                    class="form-control-lg bg-transparent m-0 p-0 border border-black"
                                                    id="text_home_article1_img"
                                                    name="text_home_article1_img"
                                                    type="text"
                                                    placeholder="Saisissez le nom de l'image"
                                                    readonly
                                                    style="font-size: 1.6rem;"
                                                    oninput="validateInput('text_home_article1_img','','labelMessageimg_chapter1','Saisissez le nom de l\'image (sans useractères spéciaux sauf - et _) aux formats *.png ou *.jpg ou *.webp. Sinon, téléchargez une image depuis votre disque local. ATTENTION!!! Dimmentions image au ratio de 200px sur 450px.')"
                                                    value="<?php echo isset($_SESSION['newImgChapter1']) ? escapeInput($_SESSION['newImgChapter1']) : escapeInput($home[0]['home_article1_img']);?>"
                                                >

                                            </div>

                                            <div class="col-12 col-lg-5 d-flex align-items-center pb-3 pb-lg-0">
                                                
                                                <input
                                                    class=""
                                                    type="file"
                                                    name="file_home_article1_img"
                                                    id="file_home_article1_img"
                                                    accept="image/jpeg, image/png, image/webp"
                                                >

                                            </div>

                                            <div class="col-12 col-lg-2 d-flex align-items-center pb-3 pb-lg-0">
                                                
                                                <input
                                                    class="btn btn-lg btn-primary "
                                                    type="submit"
                                                    name="btn_home_article1_img"
                                                    id="btn_home_article1_img"
                                                    value="Charger image"
                                                    style="width: auto;"
                                                >

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        <!-- End input end botton upload image chapter1 -->

                        <?php } ?>

                    </div>

                    <!-- Start image Chapter 1 -->

                    <div class="d-none d-sm-block">

                        <img
                            class="ms-3"
                            id="home_article1_img"
                            name="home_article1_img"
                            src="img/picture/<?php echo isset($_SESSION['newImgChapter1']) ? escapeInput($_SESSION['newImgChapter1']) : escapeInput($home[0]['home_article1_img']);?>"
                            alt="Image article 1"
                            style="width:150px; height: auto; object-fit: cover;"
                        >

                    </div>

                <!-- End image Chapter 1 -->

                </div>

            </div>

        </div>

    </div>


<?php } ?>

<?php function homeChapterImgLeft($home){ ?>

    <div class="row m-2">

        <div class="d-flex border rounded-3 m-0 p-0 px-3 my-5">

            <!-- Start image Chapter 2 -->

            <div class="d-none d-md-block pt-3 pe-3 mb-3">
                
                <img
                    class="ms-3"
                    id="home_article2_img"
                    name="home_article2_img"
                    src="img/picture/<?php echo isset($_SESSION['newImgChapter2']) ? escapeInput($_SESSION['newImgChapter2']) : escapeInput($home[0]['home_article2_img']);?>"
                    alt="image de l'article 2"
                >

            </div>

            <!-- End image Chapter 2 -->

            <div class="w-100 pt-3">

            <!-- Start Titre Chapter 2 -->

                <?php if ($_SESSION['typeConnect']!='Administrator'){ ?>

                    <h3><?php echo escapeInput($home[0]['home_article2_title']); ?></h3>

                <?php } ?>

                <?php if ($_SESSION['typeConnect']==='Administrator'){ ?>
                    
                    <h3>

                        <input
                            type="text"
                            name="text_home_article2_title"
                            id="text_home_article2_title"
                            value="<?php echo escapeInput($home[0]['home_article2_title']); ?>"
                        >

                    </h3>

                <?php } ?>

            <!-- End Titre Chapter 2 -->

            <!-- Début Chapter 2 -->

                <?php if ($_SESSION['typeConnect']!='Administrator'){ ?>

                    <p class="p-0" style="text-align: justify; white-space: pre-line;">
                        <?php echo escapeInput($home[0]['home_article2']); ?>
                    </p>
                
                <?php } ?>
                    
                    

                <?php if ($_SESSION['typeConnect']==='Administrator'){ ?>
                    
                    <p class="p-0" style="text-align: justify; white-space: pre-line;">

                        <textarea
                            name="textarea_home_article2"
                            id="textarea_home_article2"
                            cols="1"
                            rows="10"
                        ><?php echo escapeInput($home[0]['home_article2']); ?></textarea>

                    </p>

            <!-- End Chapter 2 -->
            <form method="post" id="formImg2" enctype="multipart/form-data">
                <!-- Start input end botton upload image chapter2 -->
                
                    <input
                        type="hidden"
                        name="csrfHome"
                        value="<?php echo $_SESSION['csrfHome'];?>"
                    >
                
                    <div class="container">

                        <div class="row">

                            <div class="container m-0 p-0">

                                <div class="row">
                                    
                                    <!--<form action="" method="post"> -->

                                        <div class="col-12 col-lg-5 pb-3 pb-lg-0">

                                            <input
                                                class="form-control-lg bg-transparent m-0 p-0 border border-black"
                                                id="text_home_article2_img"
                                                name="text_home_article2_img"
                                                type="text"
                                                placeholder="Saisissez le nom de l'image"
                                                readonly
                                                style="font-size: 1.6rem;"
                                                oninput="validateInput('text_home_article2_img','','labelMessageimg_chapter2','Saisissez le nom de l\'image (sans useractères spéciaux sauf - et _) aux formats *.png ou *.jpg ou *.webp. Sinon, téléchargez une image depuis votre disque local. ATTENTION!!! Dimmentions image au ratio de 200px sur 450px.')"
                                                value="<?php echo isset($_SESSION['newImgChapter2']) ? escapeInput($_SESSION['newImgChapter2']) : escapeInput($home[0]['home_article2_img']);?>"
                                            >

                                        </div>

                                        <div class="col-12 col-lg-5 d-flex align-items-center pb-3 pb-lg-0">
                                            
                                            <input
                                                class=""
                                                type="file"
                                                name="file_home_article2_img"
                                                id="file_home_article2_img"
                                                accept="image/jpeg, image/png, image/webp"
                                            >

                                        </div>

                                        <div class="col-12 col-lg-2 d-flex align-items-center pb-3 pb-lg-0">
                                            
                                            <input
                                                class="btn btn-lg btn-primary "
                                                type="submit"
                                                name="btn_home_article2_img"
                                                id="btn_home_article2_img"
                                                value="Charger image"
                                                style="width: auto;"
                                            >

                                        </div>

                                    <!-- </form> -->

                                </div>

                            </div>

                        </div>

                    </div>

                <?php } ?>

            </div>

        </div>

    </div>

<?php } ?>