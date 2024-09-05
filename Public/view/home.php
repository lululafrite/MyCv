<?php 
    require_once('../controller/home.controller.php');
    require_once('../module/homeArticle.php');
?>

    <!-- start of data save message -->

    <div class="container d-flex justify-content-center">
        <div class="text-center text-black bg-warning px-5 rounded-5" name="messageInputEmpty" id="messageInputEmpty1"></div>
    </div>

    <!-- end of data save message -->

    <!-- Start of page title -->

    <div class="text-center">

        </br>

        <?php if ($_SESSION['typeConnect']!='Administrator'){ ?>
            
            <h2><?php echo escapeInput($home[0]['home_title_page']); ?></h2>

        <?php } ?>

        <?php if ($_SESSION['typeConnect']==='Administrator'){ ?>

            <h2>
                <input
                    class="text-center"
                    type="text"
                    name="text_home_title_page"
                    id="text_home_title_page"
                    value="<?php echo escapeInput($home[0]['home_title_page']); ?>"
                >
            </h2>

        <?php } ?>

        </br>

    </div>

    <!-- End of page title -->

    <!-- Start of inserting articles -->

    <?php

        for($i=0; $i<count($homeArticle); $i++){

            if($homeArticle[$i]['home_article_img_rightOrLeft'] === 'right'){

                homeArticleImgRight($homeArticle, $i);

            }else if($homeArticle[$i]['home_article_img_rightOrLeft'] === 'left'){

                homeArticleImgLeft($homeArticle, $i);

            }

        }

    ?>

    <!-- End of article insertion -->

    <?php if($_SESSION['typeConnect'] === 'Administrator'){ ?>

    <div class="container">

        <div class="row">

            <!-- Start button Save -->

            <div class="container d-flex justify-content-center mb-2">

                <input
                    class="btn btn-lg btn-success w-100"
                    type="button"
                    name="btn_home_save"
                    id="btn_home_save"
                    value="Enregistrer"
                >

            </div>

            <!-- End button Save -->

            <!-- start of data save message -->

            <div class="container d-flex justify-content-center mb-5">
                <div class="text-center text-black bg-warning px-5 rounded-5" id="message"></div>
            </div>
            
            <!-- end of data save message -->

        </div>

    </div>

    <?php } ?>

</form>

<script src="js/function.js"></script>
<script src="js/fetch.js"></script>
<script src="js/home.js"></script>
