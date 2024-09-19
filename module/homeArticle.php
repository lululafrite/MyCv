<?php function homeArticleImgRight($article, $i){ ?>

    <div class="container p-0 pb-5 px-2 m-0 m-sm-auto p-sm-auto">
        
        <?php if ($_SESSION['dataConnect']['type']==='Administrator'){ ?>
        <div class="border border-3 p-3">
        <?php } ?>

            <form method="post" id="formHome<?php echo $i; ?>" enctype="multipart/form-data">
                
                <!-- input hidden csrf -->
                <input
                    type="hidden"
                    name="csrfHome"
                    value="<?php echo $_SESSION['csrfHome'];?>"
                >

                <div class="row m-0 p-0">
                    
                    <div class="container d-flex border rounded-3 m-0 p-0">

                        <div class="w-100 d-flex justify-content-between align-items-start">

                            <div class="w-100 pt-3">

                                <!-- Insert Article right -->
                                <?php homeArticle($article, $i) ?>

                            </div>
                                
                        </div>

                        <!-- Start insert image right -->
                        <?php homeArticleImg($article, $i) ?>

                    </div>

                </div>
                
                <!-- Insert article settings right -->
                <?php homeArticleSettings($article, $i) ?>

            </form>

        <?php if ($_SESSION['dataConnect']['type']==='Administrator'){ ?>
        </div>
        <?php } ?>

    </div>

<?php } ?>

<?php function homeArticleImgLeft($article, $i){ ?>

    <div class="container p-0 pb-5 px-2 m-0 m-sm-auto p-sm-auto">
        
        <?php if ($_SESSION['dataConnect']['type']==='Administrator'){ ?>
        <div class="border border-3 p-3">
        <?php } ?>

            <form method="post" id="formHome<?php echo $i; ?>" enctype="multipart/form-data">

                <!-- input hidden csrf -->
                <input
                    type="hidden"
                    name="csrfHome"
                    value="<?php echo $_SESSION['csrfHome'];?>"
                >

                <div class="row m-0 p-0">

                    <div class="container d-flex border rounded-3 m-0 p-0">

                        <!-- Insert image left -->
                        <?php homeArticleImg($article, $i) ?>

                        <div class="w-100 pt-3">

                            <!-- Insert Article left -->
                            <?php homeArticle($article, $i) ?>

                        </div>

                    </div>

                </div>

                <!-- Insert article settings left -->
                <?php homeArticleSettings($article, $i) ?>

            </form>

        <?php if ($_SESSION['dataConnect']['type']==='Administrator'){ ?>
        </div>
        <?php } ?>
        
    </div>

<?php } ?>

<?php function homeArticleUmpty(){ ?>
    
    <?php if ($_SESSION['dataConnect']['type']==='Administrator'){?>

    <div class="container p-0 pb-5 px-2 m-0 m-sm-auto p-sm-auto">

        <div class="border border-3 p-3">

            <form method="post" id="formHome" enctype="multipart/form-data">
                
                <!-- input hidden csrf -->
                <input
                    type="hidden"
                    name="csrfHome"
                    value="<?php echo $_SESSION['csrfHome'];?>"
                >

                <div class="row m-0 p-0">
                    
                    <div class="container d-flex border rounded-3 m-0 p-0">

                        <div class="w-100 d-flex justify-content-between align-items-start">

                            <div class="w-100 pt-3">
                                
                                <!-- Start titre article -->

                                <h3 class="px-3">
                                    <input
                                        type="text"
                                        name="text_home_article_title_new"
                                        id="text_home_article_title_new"
                                        value="SAISISSEZ LE TITRE DE L'ARTICLE"
                                    >
                                </h3>

                                <!-- End titre article -->

                                <!-- Start article -->

                                <p class="px-3" style="text-align: justify; white-space: pre-line;">
                                    <textarea
                                        name="textarea_home_article_new"
                                        id="textarea_home_article_new"
                                        cols="1"
                                        rows="10"
                                    >Saisissez votre article...</textarea>
                                </p>

                                <!-- End Article -->

                            </div>
                                
                        </div>

                        <!-- Start insert image -->

                        <div class="d-none d-sm-block">
                            
                            <img
                                class="rounded-3"
                                id="home_article_img_new"
                                name="home_article_img_new"
                                src="img/picture/img_umpty300x600.jpg"
                                alt="image de l'article new"
                                style="width: 150px; height: auto; object-fit: cover;"
                            >

                        </div>

                    </div>

                </div>
                
                <!-- Insert article settings right -->

                <div class="container">

                    <div class="row">

                        <p class="fw-bold">IMAGE SETTINGS</p>
                        
                        <div class="container px-3 pb-0 pb-lg-3">

                            <div class="row">

                                <div class="col-12 col-lg-5 pb-3 pb-lg-0">

                                    <input
                                        class="form-control-lg bg-transparent m-0 p-0 border border-black"
                                        id="text_home_article_img_new"
                                        name="text_home_article_img_new"
                                        type="text"
                                        placeholder="Saisissez le nom de l'image"
                                        readonly
                                        style="font-size: 1.6rem;"
                                        oninput="validateInput('text_home_article_img','','labelMessageimg_chapter2','Saisissez le nom de l\'image (sans useractères spéciaux sauf - et _) aux formats *.png ou *.jpg ou *.webp. Sinon, téléchargez une image depuis votre disque local. ATTENTION!!! Dimmentions image au ratio de 200px sur 450px.')"
                                        value="img_umpty300x600.jpg"
                                    >

                                </div>

                                <div class="col-12 col-lg-4 d-flex align-items-center pb-3 pb-lg-0">
                                    
                                    <input
                                        class=""
                                        type="file"
                                        name="file_home_article_img_new"
                                        id="file_home_article_img_new"
                                        accept="image/jpeg, image/png, image/webp"
                                    >

                                </div>

                                <div class="col-12 col-lg-2 d-flex align-items-center pb-3 pb-lg-0">
                                    
                                    <input
                                        class="btn btn-lg btn-primary "
                                        type="submit"
                                        name="btn_home_article_img_new"
                                        id="btn_home_article_img_new"
                                        value="Upload image new"
                                        style="width: auto;"
                                    >

                                </div>

                            </div>

                        </div>
                    
                        <div class="d-flex text-start">
                                
                            <label
                                class="form-label fs-4"
                                for="home_article_img_yesOrNo_new"
                                style="width: 130px;"
                            >Show image :</label>
                            <input
                                class="d-flex text-start"
                                type="checkbox"
                                id="home_article_img_yesOrNo_new"
                                name="home_article_img_yesOrNo_new"
                                style="width: 20px; height: 20px;"
                                value="yes"
                                checked
                            >

                        </div>

                        <div class="d-flex flex-row align-items-center">

                            <label
                                class="form-label fs-4"
                                for="home_article_img_rightOrLeft_new"
                                style="width: 130px;"
                            >Right or left :</label>
                            <select
                                class="form-select"
                                id="home_article_img_rightOrLeft_new"
                                name="home_article_img_rightOrLeft_new"
                                style="width: 100px;"
                            >
                            <option value="right">right</option>
                            <option value="left">left</option>
                            </select>

                        </div>

                        <div class="d-flex flex-row align-items-center">

                            <label
                                class="form-label fs-4"
                                for="home_article_img_objectFit_new"
                                style="width: 130px;"
                            >Object-fit :</label>
                            <select
                                class="form-select"
                                id="home_article_img_objectFit_new"
                                name="home_article_img_objectFit_new"
                                style="width: 100px;"
                            >
                            <option value="cover">cover</option>
                            <option value="contain">contain</option>
                            <option value="fill">fill</option>
                            <option value="none">none</option>
                            <option value="scale-down">scale-down</option>
                            </select>

                        </div>

                        <div class="d-flex flex-row align-items-center">

                            <label
                                class="form-label fs-4"
                                for="home_article_img_width_new"
                                style="width: 130px;"
                            >Width :</label>
                            <input
                                class="form-control fs-5"
                                type="text"
                                id="home_article_img_width_new"
                                name="home_article_img_width_new"
                                style="width: 100px;"
                                value="150px"
                            >
                            
                        </div>

                        <div class="d-flex flex-row align-items-center pb-3">

                            <label
                                class="form-label fs-4"
                                for="home_article_img_height_new"
                                style="width: 130px;"
                            >Height :</label>
                            <input
                                class="form-control fs-5"
                                type="text"
                                id="home_article_img_height_new"
                                name="home_article_img_height_new"
                                style="width: 100px;"
                                value="auto"
                            >
                            
                        </div>
                        <hr>
                        <p class="fw-bold">OTHER SETTINGS</p>

                        <!-- Insert Article Id -->
                        <?php //homeArticleId($article, $i) ?>

                        <div class="d-flex flex-row align-items-center pb-3">

                            <label
                                class="form-label fs-4"
                                for="home_article_sort_new"
                                style="width: 130px;"
                            >Article number :</label>
                            <input
                                class="form-control fs-5"
                                type="text"
                                id="home_article_sort_new"
                                name="home_article_sort_new"
                                style="width: 100px;"
                                value="100"
                            >
                            
                        </div>
                        <hr>
                        <div class="d-flex justify-content-center pb-3">

                            <input
                                class="btn btn-lg btn-primary"
                                type="submit"
                                name="btn_new_home_article"
                                id="btn_new_home_article"
                                value="Save article new"
                                style="width: auto;"
                            >

                        </div>

                    </div>

                </div>

            </form>

        </div>

    </div>
    
    <?php } ?>

<?php } ?>

<?php function homeArticleId($article, $i){ 
    $id = escapeInput($article[$i]['home_article_id']);
    if ($_SESSION['dataConnect']['type']==='Administrator'){?>

        <div class="d-flex flex-row align-items-center ps-3 pb-3">

            <label
                class="form-label fs-4"
                for="home_article_id"
                style="width: 130px;"
            >Article ID :</label>
            <input
                class="form-control fs-5"
                type="text"
                id="home_article_id"
                name="home_article_id"
                style="width: 100px;"
                value="<?php echo $id; ?>"
            >

        </div>

    <?php } ?>

<?php } ?>

<?php function homeArticle($article, $i){ ?>

    <!-- Start titre article -->
    <?php if ($_SESSION['dataConnect']['type']!='Administrator'){ ?>

        <h3 class="px-3">
            <?php echo escapeInput($article[$i]['home_article_title']); ?>
        </h3>

    <?php } ?>

    <?php if ($_SESSION['dataConnect']['type']==='Administrator'){ 
            $id = escapeInput($article[$i]['home_article_id']);
    ?>
        
        <h3 class="px-3">
            <input
                type="text"
                name="text_home_article_title_<?php echo $id; ?>"
                id="text_home_article_title_<?php echo $id; ?>"
                value="<?php echo escapeInput($article[$i]['home_article_title']); ?>"
            >
        </h3>

    <?php } ?>
    <!-- End titre article -->

    <!-- Start article -->
    <?php if ($_SESSION['dataConnect']['type']!='Administrator'){ ?>

        <p class="px-3" style="text-align: justify; white-space: pre-line;">
            <?php echo escapeInput($article[$i]['home_article']); ?>
        </p>
    
    <?php } ?>
    
    <?php if ($_SESSION['dataConnect']['type']==='Administrator'){ 
            $id = escapeInput($article[$i]['home_article_id']);
    ?>
        
        <p class="px-3" style="text-align: justify; white-space: pre-line;">
            <textarea
                name="textarea_home_article_<?php echo $id; ?>"
                id="textarea_home_article_<?php echo $id; ?>"
                cols="1"
                rows="10"
            ><?php echo escapeInput($article[$i]['home_article']); ?></textarea>
        </p>

    <?php } ?>
    <!-- End Article -->

<?php } ?>

<?php function homeArticleButtonImg($article, $i){ ?>

    <?php if ($_SESSION['dataConnect']['type']==='Administrator'){ 
            $id = escapeInput($article[$i]['home_article_id']);
    ?>
        
        <div class="container px-3 pb-0 pb-lg-3">

            <div class="row">

                <div class="col-12 col-lg-5 pb-3 pb-lg-0">

                    <input
                        class="form-control-lg bg-transparent m-0 p-0 border border-black"
                        id="text_home_article_img_<?php echo $id; ?>"
                        name="text_home_article_img_<?php echo $id; ?>"
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
                        name="file_home_article_img_<?php echo $id; ?>"
                        id="file_home_article_img_<?php echo $id; ?>"
                        accept="image/jpeg, image/png, image/webp"
                    >

                </div>

                <div class="col-12 col-lg-2 d-flex align-items-center pb-3 pb-lg-0">
                    
                    <input
                        class="btn btn-lg btn-primary "
                        type="submit"
                        name="btn_home_article_img_<?php echo $id; ?>"
                        id="btn_home_article_img_<?php echo $id; ?>"
                        value="Upload image <?php echo $id; ?>"
                        style="width: auto;"
                    >

                </div>

            </div>

        </div>

    <?php } ?>

<?php } ?>

<?php function homeArticleImg($article, $i){ ?>

    <?php if ($article[$i]['home_article_img_yesOrNo'] === "yes"){ 
            $id = escapeInput($article[$i]['home_article_id']);
    ?>

        <div class="d-none d-sm-block">
            
            <img
                class="rounded-3"
                id="home_article_img_<?php echo $id; ?>"
                name="home_article_img_<?php echo $id; ?>"
                src="img/picture/<?php echo escapeInput($article[$i]['home_article_img']);?>"
                alt="image de l'article <?php echo $id; ?>"
                style="width: <?php echo escapeInput($article[$i]['home_article_img_width']);?>; height: <?php echo escapeInput($article[$i]['home_article_img_height']);?>; object-fit: <?php echo escapeInput($article[$i]['home_article_img_objectFit']);?>;"
            >

        </div>

    <?php } ?>

<?php } ?>


<?php function homeArticleSettings($article, $i){ ?>

    <?php if ($_SESSION['dataConnect']['type']==='Administrator'){ 
            $id = escapeInput($article[$i]['home_article_id']);
    ?>
        <div class="container">

            <div class="row">
            <hr>
            <p class="fw-bold">IMAGE SETTINGS</p>

                <?php homeArticleButtonImg($article, $i) ?>
            
                <div class="d-flex text-start">
                        
                        <label
                            class="form-label fs-4"
                            for="home_article_img_yesOrNo_<?php echo $id; ?>"
                            style="width: 130px;"
                        >Show image :</label>
                        <input
                            class="d-flex text-start"
                            type="checkbox"
                            id="home_article_img_yesOrNo_<?php echo $id; ?>"
                            name="home_article_img_yesOrNo_<?php echo $id; ?>"
                            style="width: 20px; height: 20px;"
                            value="yes"
                            <?php if (escapeInput($article[$i]['home_article_img_yesOrNo']) === 'yes'){ echo 'checked'; } ?>
                        >
                </div>

                <div class="d-flex flex-row align-items-center">

                    <label
                        class="form-label fs-4"
                        for="home_article_img_rightOrLeft_<?php echo $id; ?>"
                        style="width: 130px;"
                    >Right or left :</label>
                    <select
                        class="form-select"
                        id="home_article_img_rightOrLeft_<?php echo $id; ?>"
                        name="home_article_img_rightOrLeft_<?php echo $id; ?>"
                        style="width: 100px;"
                    >
                    <option value="<?php echo escapeInput($article[$i]['home_article_img_rightOrLeft']); ?>"><?php echo escapeInput($article[$i]['home_article_img_rightOrLeft']); ?></option>
                    <option value="right">right</option>
                    <option value="left">left</option>
                    </select>

                </div>

                <div class="d-flex flex-row align-items-center">

                    <label
                        class="form-label fs-4"
                        for="home_article_img_objectFit_<?php echo $id; ?>"
                        style="width: 130px;"
                    >Object-fit :</label>
                    <select
                        class="form-select"
                        id="home_article_img_objectFit_<?php echo $id; ?>"
                        name="home_article_img_objectFit_<?php echo $id; ?>"
                        style="width: 100px;"
                    >
                    <option value="<?php echo escapeInput($article[$i]['home_article_img_objectFit']); ?>"><?php echo escapeInput($article[$i]['home_article_img_objectFit']); ?></option>
                    <option value="cover">cover</option>
                    <option value="contain">contain</option>
                    <option value="fill">fill</option>
                    <option value="none">none</option>
                    <option value="scale-down">scale-down</option>
                    </select>

                </div>

                <div class="d-flex flex-row align-items-center">

                    <label
                        class="form-label fs-4"
                        for="home_article_img_width_<?php echo $id; ?>"
                        style="width: 130px;"
                    >Width :</label>
                    <input
                        class="form-control fs-5"
                        type="text"
                        id="home_article_img_width_<?php echo $id; ?>"
                        name="home_article_img_width_<?php echo $id; ?>"
                        style="width: 100px;"
                        value="<?php echo escapeInput($article[$i]['home_article_img_width']); ?>"
                    >
                    
                </div>

                <div class="d-flex flex-row align-items-center pb-3">

                    <label
                        class="form-label fs-4"
                        for="home_article_img_height_<?php echo $id; ?>"
                        style="width: 130px;"
                    >Height :</label>
                    <input
                        class="form-control fs-5"
                        type="text"
                        id="home_article_img_height_<?php echo $id; ?>"
                        name="home_article_img_height_<?php echo $id; ?>"
                        style="width: 100px;"
                        value="<?php echo escapeInput($article[$i]['home_article_img_height']); ?>"
                    >
                    
                </div>
                <hr>
                <p class="fw-bold">OTHER SETTINGS</p>

                <!-- Insert Article Id right -->
                <?php homeArticleId($article, $i) ?>

                <div class="d-flex flex-row align-items-center pb-3">

                    <label
                        class="form-label fs-4"
                        for="home_article_sort_<?php echo $id; ?>"
                        style="width: 130px;"
                    >Article number :</label>
                    <input
                        class="form-control fs-5"
                        type="text"
                        id="home_article_sort_<?php echo $id; ?>"
                        name="home_article_sort_<?php echo $id; ?>"
                        style="width: 100px;"
                        value="<?php echo escapeInput($article[$i]['home_article_sort']); ?>"
                    >
                    
                </div>
                <hr>
                <div class="d-flex flex-column flex-md-row justify-content-center pb-3">
                    <div class="d-flex justify-content-center p-0 pb-2 pe-md-3">
                        <input
                            class="btn btn-lg btn-primary"
                            type="submit"
                            name="btn_save_home_article_<?php echo $id; ?>"
                            id="btn_save_home_article_<?php echo $id; ?>"
                            value="Save article <?php echo $id; ?>"
                            style="width: 150px;"
                        >
                    </div>

                    <div class="d-flex justify-content-center p-0 pb-2">
                        <input
                            class="btn btn-lg btn-danger"
                            type="submit"
                            name="btn_delete_home_article_<?php echo $id; ?>"
                            id="btn_delete_home_article_<?php echo $id; ?>"
                            value="Delete article <?php echo $id; ?>"
                            style="width: 150px;"
                        >
                    </div>

                </div>
            </div>

        </div>

    <?php } ?>

<?php } ?>