<?php

    $checkUrl = preg_match('/goldorak/', $_SERVER['REQUEST_URI']) || preg_match('/garageparrot/', $_SERVER['REQUEST_URI']);
    if($checkUrl){
        require_once('../../model/home.class.php');
        require_once('../../model/article.class.php');
        require_once('../../model/utilities.class.php');
    }else{
        require_once('../model/home.class.php');
        require_once('../model/article.class.php');
        require_once('../model/utilities.class.php');
    }
    

    use MyCv\Model\Home;
    use MyCv\Model\HomeArticle;
    use MyCv\Model\Utilities;

    $homes = new Home();
    $homeArticles = new HomeArticle();

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        
        resetDataConnectVarSession();
        resetOtherVarSession();
        
        $home_article_id = isset($_POST['home_article_id']) ? filterInput('home_article_id') : '';
        $btn_home_article_img = "btn_home_article_img_" . $home_article_id;
        $btn_delete_home_article = "btn_delete_home_article_" . $home_article_id;
        $btn_save_home_article = "btn_save_home_article_" . $home_article_id;

        if(Utilities::verifCsrf('csrf')){
            
            if(isset($_POST['btn_save_header'])){
                
                varHome($homes);
                $homes->updateHome(1);
                unset($_POST['btn_save_header']);

            }else if(isset($_POST['btn_new_home_article'])){
                
                varHomeArticle($homeArticles, 'new');
                $homeArticles->newArticle();
                unset($_POST['btn_new_home_article']);

            }else if(isset($_POST[$btn_save_home_article])){

                varHomeArticle($homeArticles, $home_article_id);                
                $homeArticles->updateArticle($home_article_id);
                unset($_POST['btn_save_home_article']);

            }else if(isset($_POST[$btn_delete_home_article])){
                
                $homeArticles->deleteArticle($home_article_id);
                unset($_POST[$btn_delete_home_article]);
                unset($_POST['btn_delete_home_article']);

            }else if(isset($_POST[$btn_home_article_img])){

                varHomeArticle($homeArticles, $home_article_id);

                if (uploadImg("newImgChapter1","text_home_article_img_" . $home_article_id,"file_home_article_img_" . $home_article_id,"./img/picture/")){

                    $arrayHomeArticle['homeArticleImg'] = $_SESSION['newImgChapter1'];
                    $homeArticles->setHomeArticleImg($_SESSION['newImgChapter1']);
                    $homeArticles->updateArticle($home_article_id);

                }else{

                    echo "<script>alert('Désolé, une erreur s\'est produite lors de l\'upload de l\'image.');</script>";

                }

                unset($_POST[$btn_home_article_img]);
            
            }

        }

    }
    
    $current_url = $_SERVER['REQUEST_URI'];
    settype($current_url, "string");
    
    $monParcours = "/mycv/";
    settype($monParcours, "string");

    $home = $homes->getHome(1);

    if(preg_match($monParcours, $current_url)){
        $home['home_title_page'] = "Mon parcours";
    }
    
    $homeArticle = $homeArticles->getArticleList(1, 'home_article_sort', 'ASC', 0, 20);

//----------------------------------------------------------------------------------------------------------------------
// FUNCTIONS
//----------------------------------------------------------------------------------------------------------------------

    function varHomeArticle($homeArticles, $home_article_id): array{

        $homeArticleTitle = isset($_POST["text_home_article_title_" . $home_article_id]) ? filterInput("text_home_article_title_" . $home_article_id) : '';
        $homeArticle = isset($_POST["textarea_home_article_" . $home_article_id]) ? filterInput("textarea_home_article_" . $home_article_id) : '';
        $homeArticleImg = isset($_POST["text_home_article_img_" . $home_article_id]) ? filterInput("text_home_article_img_" . $home_article_id) : '';
        $homeArticleImgYesOrNo = isset($_POST["home_article_img_yesOrNo_" . $home_article_id]) ? filterInput("home_article_img_yesOrNo_" . $home_article_id) : '';
        $homeArticleImgRightOrLeft = isset($_POST["home_article_img_rightOrLeft_" . $home_article_id]) ? filterInput("home_article_img_rightOrLeft_" . $home_article_id) : '';
        $homeArticleImgWidth = isset($_POST["home_article_img_width_" . $home_article_id]) ? filterInput("home_article_img_width_" . $home_article_id) : '';
        $homeArticleImgHeight = isset($_POST["home_article_img_height_" . $home_article_id]) ? filterInput("home_article_img_height_" . $home_article_id) : '';
        $homeArticleImgObjectFit = isset($_POST["home_article_img_objectFit_" . $home_article_id]) ? filterInput("home_article_img_objectFit_" . $home_article_id) : '';
        $homeArticleSort = isset($_POST["home_article_sort_" . $home_article_id]) ? filterInput("home_article_sort_" . $home_article_id) : '';

        $homeArticles->setHomeArticleTitle($homeArticleTitle);
        $homeArticles->setHomeArticle($homeArticle);
        $homeArticles->setHomeArticleImg($homeArticleImg);
        $homeArticles->setHomeArticleImgYesOrNo($homeArticleImgYesOrNo);
        $homeArticles->setHomeArticleImgRightOrLeft($homeArticleImgRightOrLeft);
        $homeArticles->setHomeArticleImgWidth($homeArticleImgWidth);
        $homeArticles->setHomeArticleImgHeight($homeArticleImgHeight);
        $homeArticles->setHomeArticleImgObjectFit($homeArticleImgObjectFit);
        $homeArticles->setHomeArticleSort($homeArticleSort);

        return array(
            'homeArticleTitle' => $homeArticleTitle,
            'homeArticle' => $homeArticle,
            'homeArticleImg' => $homeArticleImg,
            'homeArticleImgYesOrNo' => $homeArticleImgYesOrNo,
            'homeArticleImgRightOrLeft' => $homeArticleImgRightOrLeft,
            'homeArticleImgWidth' => $homeArticleImgWidth,
            'homeArticleImgHeight' => $homeArticleImgHeight,
            'homeArticleImgObjectFit' => $homeArticleImgObjectFit,
            'homeArticleSort' => $homeArticleSort
        );

    }

    function varHome($home): array{

        $homeTitle = isset($_POST['text_home_title']) ? filterInput('text_home_title') : '';
        $homeSubtitle = isset($_POST['text_home_subtitle']) ? filterInput('text_home_subtitle') : '';
        $homeTitlePage = isset($_POST['text_home_title_page']) ? filterInput('text_home_title_page') : '';

        $home->setHomeTitle($homeTitle);
        $home->setHomeSubtitle($homeSubtitle);
        $home->setHomeTitlePage($homeTitlePage);

        return array(
            'homeTitle' => $homeTitle,
            'homeSubtitle' => $homeSubtitle,
            'homeTitlePage' => $homeTitlePage
        );

    }

?>