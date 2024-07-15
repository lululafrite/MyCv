<?php

    include_once('../common/utilies.php');
    include_once('../model/home.class.php');

 //   use \Firebase\JWT\JWT;

    $btn_save_header = isset($_POST['btn_save_header']) ? true : false;
    unset($_POST['btn_save_header']);

    $btn_home_save = isset($_POST['btn_home_save']) ? true : false;
    unset($_POST['btn_home_save']);

    $btn_home_article1_img = isset($_POST['btn_home_article1_img']) ? true : false;
    unset($_POST['btn_home_article1_img']);

    $btn_home_article2_img = isset($_POST['btn_home_article2_img']) ? true : false;
    unset($_POST['btn_home_article2_img']);

    
    if(!isset($homes)){
        $homes = new Home();
    }

/*    $jwt1 = JWT::jsondecode($_SESSION['jwt']);
    $jwt2 = JWT::jsondecode(tokenJwt($_SESSION['pseudoConnect'], $_SESSION['SECRET_KEY']));

    if($jwt2->{'delay'} - $jwt1->{'delay'} <= $_SESSION['delay']){
*/
    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        if(verifCsrf('csrfHome') || verifCsrf('csrfHeader')){
            
            if($btn_home_save || $btn_save_header){
                
                saveHome($homes,'');

            }

            //***********************************************************************************************
            // traitement du téléchargement des images 
            //***********************************************************************************************

            if($btn_home_article1_img){

                //$btn_home_article1_img = false;

                if (uploadImg('newImgChapter1','text_home_article1_img','file_home_article1_img','./img/picture/')){

                    $home[0]['home_article1_img'] = $_SESSION['newImgChapter1'];
                    //saveHome($homes,'');

                }else{

                    echo "<script>alert('Désolé, une erreur s\'est produite lors de l\'upload de l\'image.');</script>";

                }

            }

            if($btn_home_article2_img){

                //$btn_home_article2_img = false;

                if (uploadImg('newImgChapter2','text_home_article2_img','file_home_article2_img','./img/picture/')){

                    $home[0]['home_article2_img'] = $_SESSION['newImgChapter2'];
                    //saveHome($homes,'');

                }else{

                    echo "<script>alert('Désolé, une erreur s\'est produite lors de l\'upload de l\'image.');</script>";

                }

            }

        }

    }

    if(
        ($btn_home_article1_img || $btn_home_article2_img && (!$btn_save_header && !$btn_home_save))
        ||
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