<?php function homeArticleImgRight($article, $i){ ?>

<div class="container p-0 pb-5 px-2 m-0 m-sm-auto p-sm-auto">

    <div class="row m-0 p-0">
        
        <div class="container d-flex border rounded-3 m-0 p-0">

            <div class="w-100 d-flex justify-content-between align-items-start">

                <div class="w-100 pt-3">

                    <!-- Start Titre chapter1 -->

                    <?php if ($_SESSION['typeConnect']!='Administrator'){ ?>

                        <h3 class="px-3"><?php echo escapeInput($article[$i]['home_article_title']); ?></h3>

                    <?php } ?>

                    <?php if ($_SESSION['typeConnect']==='Administrator'){ ?>

                        <h3 class="px-3">

                            <input
                                type="text"
                                id="text_home_article_title"
                                name="text_home_article_title"
                                value="<?php echo escapeInput($article[$i]['home_article_title']); ?>"
                            >

                        </h3>

                    <?php } ?>

                    <!-- End Titre chapter1 -->

                    <!-- Start Article 1 -->

                    <?php if ($_SESSION['typeConnect']!='Administrator'){ ?>

                        <p class="px-3" style="text-align: justify; white-space: pre-line;">
                            <?php echo escapeInput($article[$i]['home_article']); ?>
                        </p>

                    <?php } ?>

                    <?php if ($_SESSION['typeConnect']==='Administrator'){ ?>
                        
                        <p class="px-3" style="text-align: justify; white-space: pre-line;">
                            <textarea
                                name="textarea_home_article_<?php echo $i;?>"
                                id="textarea_home_article_<?php echo $i;?>"
                                col="1"
                                rows="10"
                            ><?php echo escapeInput($article[$i]['home_article']); ?></textarea>
                        </p>

                    <!-- End Article 1 -->
                        
                    <!-- Start input end button upload image chapter1 -->
                    <div class="container">  

                        <div class="row">

                            <div class="col-12 col-lg-5 pb-3 pb-lg-0">

                                <input
                                    class="form-control-lg bg-transparent m-0 p-0 border border-black text_home_article_img_<?php echo $i;?>"
                                    id="text_home_article_img_<?php echo $i;?>"
                                    name="text_home_article_img_<?php echo $i;?>"
                                    type="text"
                                    placeholder="Saisissez le nom de l'image"
                                    readonly
                                    style="font-size: 1.6rem;"
                                    oninput="validateInput('text_home_article_img<?php echo $i;?>','','labelMessageimg_chapter<?php echo $i;?>','Saisissez le nom de l\'image (sans useractères spéciaux sauf - et _) aux formats *.png ou *.jpg ou *.webp. Sinon, téléchargez une image depuis votre disque local. ATTENTION!!! Dimmentions image au ratio de 200px sur 450px.')"
                                    value="<?php echo escapeInput($article[$i]['home_article_img']);?>"
                                >

                            </div>

                            <div class="col-12 col-lg-4 d-flex align-items-center pb-3 pb-lg-0">
                                
                                <input
                                    class=""
                                    type="file"
                                    name="file_home_article_img_<?php echo $i;?>"
                                    id="file_home_article_img_<?php echo $i;?>"
                                    accept="image/jpeg, image/png, image/webp"
                                >

                            </div>

                            <div class="col-12 col-lg-2 d-flex align-items-center pb-3 pb-lg-0">
                                
                                <input
                                    class="btn btn-lg btn-primary "
                                    type="submit"
                                    name="btn_home_article_img_<?php echo $i;?>"
                                    id="btn_home_article_img_<?php echo $i;?>"
                                    value="Charger image <?php echo $i;?>"
                                    style="width: auto;"
                                >

                            </div>

                        </div>

                    </div>

                    <!-- End input end botton upload image chapter1 -->

                    <?php } ?>

                </div>
                    
            </div>

            <!-- Start insert image right -->

            <?php if ($article[$i]['home_article_img'] != ""){?>
            
                <div class="d-none d-sm-block ">

                    <img
                        class="roundedImgRight"
                        id="home_article_img_<?php echo $i;?>"
                        name="home_article_img_<?php echo $i;?>"
                        src="img/picture/<?php echo escapeInput($article[$i]['home_article_img']);?>"
                        alt="image de l'article <?php echo $i;?>"
                        style="width: <?php echo escapeInput($article[$i]['home_article_img_width']);?>; height: <?php echo escapeInput($article[$i]['home_article_img_height']);?>; object-fit: <?php echo escapeInput($article[$i]['home_article_img_objectFit']);?>;"
                    >

                </div>

            <?php } ?>

            <!-- End insert image right -->

        </div>

    </div>

</div>

<?php } ?>

<?php function homeArticleImgLeft($article, $i){ ?>

<div class="container p-0 pb-5 px-2 m-0 m-sm-auto p-sm-auto">

    <div class="row m-0 p-0">

        <div class="container d-flex border rounded-3 m-0 p-0">

            <!-- Start insert image left -->
            
            <?php if ($article[$i]['home_article_img'] != ""){?>

                <div class="d-none d-sm-block">
                    
                    <img
                        class="roundedImgLeft"
                        id="home_article_img_<?php echo $i;?>"
                        name="home_article_img_<?php echo $i;?>"
                        src="img/picture/<?php echo escapeInput($article[$i]['home_article_img']);?>"
                        alt="image de l'article <?php echo $i;?>"
                        style="width: <?php echo escapeInput($article[$i]['home_article_img_width']);?>; height: <?php echo escapeInput($article[$i]['home_article_img_height']);?>; object-fit: <?php echo escapeInput($article[$i]['home_article_img_objectFit']);?>;"
                    >

                </div>
            
            <?php } ?>

            <!-- End insert image left -->

            <div class="w-100 pt-3">

                <!-- Start titre article left -->

                <?php if ($_SESSION['typeConnect']!='Administrator'){ ?>

                    <h3 class="px-3">

                        <?php echo escapeInput($article[$i]['home_article_title']); ?>

                    </h3>

                <?php } ?>

                <?php if ($_SESSION['typeConnect']==='Administrator'){ ?>
                    
                    <h3 class="px-3">

                        <input
                            type="text"
                            name="text_home_article_title_<?php echo $i;?>"
                            id="text_home_article_title_<?php echo $i;?>"
                            value="<?php echo escapeInput($article[$i]['home_article_title']); ?>"
                        >

                    </h3>

                <?php } ?>

                <!-- End titre article left -->

                <!-- Start article left -->

                <?php if ($_SESSION['typeConnect']!='Administrator'){ ?>

                    <p class="px-3" style="text-align: justify; white-space: pre-line;">
                        <?php echo escapeInput($article[$i]['home_article']); ?>
                    </p>
                
                <?php } ?>
                    
                    

                <?php if ($_SESSION['typeConnect']==='Administrator'){ ?>
                    
                    <p class="px-3" style="text-align: justify; white-space: pre-line;">

                        <textarea
                            name="textarea_home_article_<?php echo $i;?>"
                            id="textarea_home_article_<?php echo $i;?>"
                            cols="1"
                            rows="10"
                        ><?php echo escapeInput($article[$i]['home_article']); ?></textarea>

                    </p>

                    <!-- End Article left -->
            
                    <!-- Start input end button upload image left -->
            
                    <div class="container px-3 pb-0 pb-lg-3">

                        <div class="row">

                            <div class="col-12 col-lg-5 pb-3 pb-lg-0">

                                <input
                                    class="form-control-lg bg-transparent m-0 p-0 border border-black"
                                    id="text_home_article_img_<?php echo $i;?>"
                                    name="text_home_article_img_<?php echo $i;?>"
                                    type="text"
                                    placeholder="Saisissez le nom de l'image"
                                    readonly
                                    style="font-size: 1.6rem;"
                                    oninput="validateInput('text_home_article_img','','labelMessageimg_chapter2','Saisissez le nom de l\'image (sans useractères spéciaux sauf - et _) aux formats *.png ou *.jpg ou *.webp. Sinon, téléchargez une image depuis votre disque local. ATTENTION!!! Dimmentions image au ratio de 200px sur 450px.')"
                                    value="<?php echo escapeInput($article[$i]['home_article_img']);?>"
                                >

                            </div>

                            <div class="col-12 col-lg-4 d-flex align-items-center pb-3 pb-lg-0">
                                
                                <input
                                    class=""
                                    type="file"
                                    name="file_home_article_img_<?php echo $i;?>"
                                    id="file_home_article_img_<?php echo $i;?>"
                                    accept="image/jpeg, image/png, image/webp"
                                >

                            </div>

                            <div class="col-12 col-lg-2 d-flex align-items-center pb-3 pb-lg-0">
                                
                                <input
                                    class="btn btn-lg btn-primary "
                                    type="submit"
                                    name="btn_home_article_img_<?php echo $i;?>"
                                    id="btn_home_article_img_<?php echo $i;?>"
                                    value="Charger image <?php echo $i;?>"
                                    style="width: auto;"
                                >

                            </div>

                        </div>

                    </div>

                <?php } ?>

            </div>

        </div>

    </div>
    
</div>

<?php } ?>