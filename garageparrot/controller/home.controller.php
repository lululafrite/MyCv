<?php
    
    $checkUrl = preg_match('/goldorak/', $_SERVER['REQUEST_URI']) || preg_match('/garageparrot/', $_SERVER['REQUEST_URI']);
    if($checkUrl){
        require_once('../../model/utilities.class.php');
        require_once('../../garageparrot/model/home.class.php');
    }else{
        require_once('../model/utilities.class.php');
        require_once('../garageparrot/model/home.class.php');
    }
    
    use GarageParrot\Model\Home;
    use MyCv\Model\Utilities;

    $homes = new Home();

    // Vérification du token CSRF
    if($_SERVER['REQUEST_METHOD'] === 'POST'){ //(Utilities::verifCsrf('csrf') && $_SERVER['REQUEST_METHOD'] === 'POST'){

        if(isset($_POST['bt_home'])){
            
            $homes->setTitre1(isset($_POST['txt_home_titre1'])?filterInput('txt_home_titre1'):'');
            $homes->setIntro_chapter1(isset($_POST['txt_intro_chapter1'])?filterInput('txt_intro_chapter1'):'');
            $homes->setIntro_chapter2(isset($_POST['txt_intro_chapter2'])?filterInput('txt_intro_chapter2'):'');

            $homes->setTitre2(isset($_POST['txt_home_titre2'])?filterInput('txt_home_titre2'):'');

            $homes->setArticle1_titre(isset($_POST['txt_article1_titre'])?filterInput('txt_article1_titre'):'');
            $homes->setArticle1_chapter1(isset($_POST['txt_article1_chapter1'])?filterInput('txt_article1_chapter1'):'');

            $homes->setArticle1_titre2(isset($_POST['txt_article1_titre2'])?filterInput('txt_article1_titre2'):'');
            $homes->setArticle1_chapter2(isset($_POST['txt_article1_chapter2'])?filterInput('txt_article1_chapter2'):'');

            $homes->setArticle2_titre(isset($_POST['txt_article2_titre'])?filterInput('txt_article2_titre'):'');
            $homes->setArticle2_chapter1(isset($_POST['txt_article2_chapter1'])?filterInput('txt_article2_chapter1'):'');

            $homes->setArticle2_titre2(isset($_POST['txt_article2_titre2'])?filterInput('txt_article2_titre2'):'');
            $homes->setArticle2_chapter2(isset($_POST['txt_article2_chapter2'])?filterInput('txt_article2_chapter2'):'');

            $homes->updateHome(1);
            unset($_POST['bt_home']);

        }
    
    }

    $Home = $homes->get(1,'id_home','DESC','0','50');
?>