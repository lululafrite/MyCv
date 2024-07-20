<?php
    
    use MyCv\Model\Home;
    
    require_once('../common/utilies.php');
    require_once('../model/home.class.php');

    $btn_save_header = isset($_POST['btn_save_header']) ? true : false;
    unset($_POST['btn_save_header']);

    $btn_home_save = isset($_POST['btn_home_save']) ? true : false;
    unset($_POST['btn_home_save']);

    $btn_home_article1_img = isset($_POST['btn_home_article1_img']) ? true : false;
    unset($_POST['btn_home_article1_img']);

    $btn_home_article2_img = isset($_POST['btn_home_article2_img']) ? true : false;
    unset($_POST['btn_home_article2_img']);

    $homes = new Home();

    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        if(verifCsrf('csrfHome') || verifCsrf('csrfHeader')){
            
            if($btn_home_save || $btn_save_header){
                
                saveHome($homes,'');

            }else if($btn_home_article1_img || $btn_home_article2_img){
                
                $home = $homes->get(1,'home_id','DESC','0','10');

                $homes->setHomeTitle($home[0]['home_title']);
                $homes->setHomeSubtitle($home[0]['home_subtitle']);
        
                $homes->setHomeTitlePage($home[0]['home_title_page']);
        
                $homes->setHomeArticle1Title($home[0]['home_article1_title']);
                $homes->setHomeArticle1($home[0]['home_article1']);
                $homes->setHomeArticle1Img( $home[0]['home_article1_img']);
        
                $homes->setHomeArticle2Title($home[0]['home_article2_title']);
                $homes->setHomeArticle2($home[0]['home_article2']);
                $homes->setHomeArticle2Img($home[0]['home_article2_img']);

                if($btn_home_article1_img){

                    if (uploadImg('newImgChapter1','text_home_article1_img','file_home_article1_img','./img/picture/')){

                        $home[0]['home_article1_img'] = $_SESSION['newImgChapter1'];
                        $homes->setHomeArticle1Img($_SESSION['newImgChapter1']);
                        $homes->updateHome(1);

                    }else{

                        echo "<script>alert('Désolé, une erreur s\'est produite lors de l\'upload de l\'image.');</script>";

                    }

                }else if($btn_home_article2_img){

                    if (uploadImg('newImgChapter2','text_home_article2_img','file_home_article2_img','./img/picture/')){

                        $home[0]['home_article2_img'] = $_SESSION['newImgChapter2'];
                        $homes->setHomeArticle2Img($_SESSION['newImgChapter2']);
                        $homes->updateHome(1);

                    }else{

                        echo "<script>alert('Désolé, une erreur s\'est produite lors de l\'upload de l\'image.');</script>";

                    }

                }
            
            }

        }

    }

    if(
        /*($btn_home_article1_img || $btn_home_article2_img && (!$btn_save_header && !$btn_home_save))
        ||
        (!$btn_home_article1_img && !$btn_home_article2_img && !$btn_save_header && !$btn_home_save)*/
        /*($btn_save_header || $btn_home_save)
        ||*/
        (!$btn_home_article1_img && !$btn_home_article2_img && !$btn_save_header && !$btn_home_save)
    ){
        
        $home = $homes->get(1,'home_id','DESC','0','10');
 
    }

    if ($btn_home_save || $btn_save_header || $btn_home_article1_img || $btn_home_article2_img ){

        $btn_home_save = false;
        $btn_save_header = false;
        $btn_home_article1_img = false;
        $btn_home_article2_img = false;

    }

    function saveHome($object, $button = ''){

        $homeTitle = isset($_POST['text_home_title']) ? filterInput('text_home_title') : '';
        $homeSubtitle = isset($_POST['text_home_subtitle']) ? filterInput('text_home_subtitle') : '';

        $homeTitlePage = isset($_POST['text_home_title_page']) ? filterInput('text_home_title_page') : '';
        
        $homeArticle1Title = isset($_POST['text_home_article1_title']) ? filterInput('text_home_article1_title') : '';
        $homeArticle1 = isset($_POST['textarea_home_article1']) ? filterInput('textarea_home_article1') : '';
        
        if($button === 'btn_home_article1_img'){
            $homeArticle1Img = $_SESSION['newImgChapter1'];
        }else{
            $homeArticle1Img = isset($_POST['text_home_article1_img']) ? filterInput('text_home_article1_img') : '';
        }

        $homeArticle2Title = isset($_POST['text_home_article2_title']) ? filterInput('text_home_article2_title') : '';
        $homeArticle2 = isset($_POST['textarea_home_article2']) ? filterInput('textarea_home_article2') : '';
        
        if($button === 'btn_home_article2_img'){
            $homeArticle2Img = $_SESSION['newImgChapter2'];
        }else{
            $homeArticle2Img = isset($_POST['text_home_article2_img']) ? filterInput('text_home_article2_img') : '';
        }

        $object->setHomeTitle($homeTitle);
        $object->setHomeSubtitle($homeSubtitle);

        $object->setHomeTitlePage($homeTitlePage);

        $object->setHomeArticle1Title($homeArticle1Title);
        $object->setHomeArticle1($homeArticle1);
        $object->setHomeArticle1Img($homeArticle1Img);

        $object->setHomeArticle2Title($homeArticle2Title);
        $object->setHomeArticle2($homeArticle2);
        $object->setHomeArticle2Img($homeArticle2Img);

        $object->updateHome(1);
       
        if($button === 'btn_home_article1_img' || $button === 'btn_home_article2_img'){
            //routeToHomePage();
        }

    }

?>