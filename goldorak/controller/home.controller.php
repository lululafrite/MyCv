<?php

    //include_once '../../common/utilies.php';
    include_once('../../goldorak/model/home.class.php');

 //   use \Firebase\JWT\JWT;

    $btn_home_save = isset($_POST['btn_home_save']) ? true : false;
    unset($_POST['btn_home_save']);

    $btn_img_chapter1 = isset($_POST['btn_img_chapter1']) ? true : false;
    unset($_POST['btn_img_chapter1']);

    $btn_img_chapter2 = isset($_POST['btn_img_chapter2']) ? true : false;
    unset($_POST['btn_img_chapter2']);
    
    if(!isset($homes)){
        $homes = new Home();
    }

/*    $jwt1 = JWT::jsondecode($_SESSION['jwt']);
    $jwt2 = JWT::jsondecode(tokenJwt($_SESSION['pseudoConnect'], $_SESSION['SECRET_KEY']));

    if($jwt2->{'delay'} - $jwt1->{'delay'} <= $_SESSION['delay']){
*/
        if(verifCsrf('csrfHome') && $_SERVER['REQUEST_METHOD'] === 'POST'){
            
            if($btn_home_save){
                $btn_home_save = false;
                saveHome($homes,'');
            }

            //***********************************************************************************************
            // traitement du téléchargement des images 
            //***********************************************************************************************

            if($btn_img_chapter1){

                $btn_img_chapter1 = false;

                if (uploadImg('newImgChapter1','txt_img_chapter1','file_img_chapter1','./img/picture/')){

                    $home[0]['img_chapter1'] = $_SESSION['newImgChapter1'];

                }else{

                    echo "<script>alert('Désolé, une erreur s\'est produite lors de l\'upload de l\'image.');</script>";

                }

            }

            if($btn_img_chapter2){

                if (uploadImg('newImgChapter2','txt_img_chapter2','file_img_chapter2','./img/picture/')){

                    $home[0]['img_chapter2'] = $_SESSION['newImgChapter2'];

                }else{

                    echo "<script>alert('Désolé, une erreur s\'est produite lors de l\'upload de l\'image.');</script>";

                }

            }

        }

    /*}else if($_SESSION['pseudoConnect'] != 'Guest'){

        $_SESSION['typeConnect'] = 'Guest';
        $_SESSION['pseudoConnect'] = 'Guest';
        $_SESSION['avatarConnect'] = 'avatar_membre_white.webp';
        $_SESSION['subscriptionConnect'] = 'Vénusia';
        $_SESSION['connexion'] = false;
        
        timeExpired();

    }*/

    $home = $homes->get(1,'id_home','DESC','0','10');

    function saveHome($object, $button = ''){

        $titre1 = isset($_POST['txt_titre1']) ? filterInput('txt_titre1') : '';
        
        $titre_chapter1 = isset($_POST['txt_titre_chapter1']) ? filterInput('txt_titre_chapter1') : '';
        $chapter1 = isset($_POST['txt_chapter1']) ? filterInput('txt_chapter1') : '';
        
        if($button === 'btn_img_chapter1'){
            $img_chapter1 = $_SESSION['newImgChapter1'];
        }else{
            $img_chapter1 = isset($_POST['txt_img_chapter1']) ? filterInput('txt_img_chapter1') : '';
        }

        $titre_chapter2 = isset($_POST['txt_titre_chapter2']) ? filterInput('txt_titre_chapter2') : '';
        $chapter2 = isset($_POST['txt_chapter2']) ? filterInput('txt_chapter2') : '';
        
        if($button === 'btn_img_chapter2'){
            $img_chapter2 = $_SESSION['newImgChapter2'];
        }else{
            $img_chapter2 = isset($_POST['txt_img_chapter2']) ? filterInput('txt_img_chapter2') : '';
        }

        $object->setTitre1($titre1);

        $object->setTitre_Chapter1($titre_chapter1);
        $object->setChapter1($chapter1);
        $object->setImg_chapter1($img_chapter1);

        $object->setTitre_Chapter2($titre_chapter2);
        $object->setChapter2($chapter2);
        $object->setImg_chapter2($img_chapter2);

        $object->updateHome(1);
        
        if($button === 'btn_img_chapter1' || $button === 'btn_img_chapter1'){
            routeToHomePage();
        }

    }

?>