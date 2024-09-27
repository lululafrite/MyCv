<?php 
    require_once('../controller/home.controller.php');
    require_once('../module/article.php');
?>

    <!-- start of data save message -->

    <div class="container d-flex justify-content-center">
        <div class="text-center text-black bg-warning px-5 rounded-5" name="messageInputEmpty" id="messageInputEmpty1"></div>
    </div>

    <!-- end of data save message -->

    <!-- Start of inserting articles -->

    <?php

        for($i=0; $i<count($homeArticle); $i++){

            if($homeArticle[$i]['home_article_img_rightOrLeft'] === 'right'){

                homeArticleImgRight($homeArticle, $i);

            }else if($homeArticle[$i]['home_article_img_rightOrLeft'] === 'left'){

                homeArticleImgLeft($homeArticle, $i);

            }

        }
        
        homeArticleUmpty($homeArticle);

    ?>

    <!-- End of article insertion -->

</form>

<script src="js/function.js"></script>
<script src="js/fetch.js"></script>
<script src="js/home.js"></script>
