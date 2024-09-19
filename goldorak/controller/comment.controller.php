<?php

    use \Goldorak\Model\Comment;
    use \Firebase\JWT\JWT;

    require_once('../../common/utilies.php');
    require_once('../../goldorak/model/comment.class.php');
    
    $bt_save_comment = isset($_POST['bt_save_comment']) ? true : false;
    unset($_POST['bt_save_comment']);

    $bt_comment_delete = isset($_POST['bt_comment_delete']) ? true : false;
    unset($_POST['bt_comment_delete']);

    $bt_comment_validate = isset($_POST['bt_comment_validate']) ? true : false;
    unset($_POST['bt_comment_validate']);

    $bt_comment_refuse = isset($_POST['bt_comment_refuse']) ? true : false;
    unset($_POST['bt_comment_refuse']);

    if(!isset($comments)){
        $comments = new Comment();
    }

    $jwt1 = JWT::jsondecode($_SESSION['jwt']['tokenJwt']);
    $jwt2 = JWT::jsondecode(tokenJwt($_SESSION['dataConnect']['pseudo'], $_SESSION['jwt']['secretKey'], $_SESSION['jwt']['delay']));

    if($jwt2->{'delay'} - $jwt1->{'delay'} <= $_SESSION['jwt']['delay']){

        if($jwt1->{'pseudo'} === $jwt2->{'pseudo'} && $jwt1->{'key'} === $jwt2->{'key'}){

            if(verifCsrf('csrf') && $_SERVER['REQUEST_METHOD'] === 'POST'){
                
                $idComment = filterInput('txt_comment_id');

                if($bt_save_comment){

                    $bt_save_comment = false;

                    $pseudo_ = filterInput('txt_comment_pseudo');
                    $rating_ = filterInput('selectedRating');
                    $comment_ = filterInput('txt_comment_comment');
                    
                    if($comment_ != ""){

                        $comments->setDate_(date("Y-m-d"));
                        $comments->setPseudo($pseudo_);
                        $comments->setRating($rating_);
                        $comments->setComment($comment_);

                        $comments->addComment();

                    }else{

                        echo "<script>alert('Le champ commentaire ne peut pas être vide!!! Resaisissez votre commentaire et selectionnez une étoile de 1 à 5.');</script>";

                    }

                }else if($bt_comment_delete){
                    
                    $comments->deleteComment($idComment);

                }else if($bt_comment_validate){
                    
                    $comments->modereComment($idComment, 2);

                }else if($bt_comment_refuse){
                    
                    $comments->modereComment($idComment, 1);

                }

            }

        }

    }else if($_SESSION['dataConnect']['pseudo'] != 'Guest'){

        $_SESSION['dataConnect']['type'] = 'Guest';
        $_SESSION['dataConnect']['pseudo'] = 'Guest';
        $_SESSION['dataConnect']['avatar'] = 'avatar_membre_white.webp';
        $_SESSION['dataConnect']['subscription'] = 'Vénusia';
        $_SESSION['dataConnect']['connexion'] = false;
        
        timeExpired();

    }

    if($_SESSION['dataConnect']['type'] === 'Administrator'){

        $Comment = $comments->get(1,'date_','DESC','0','50');

    }else if($_SESSION['dataConnect']['type'] === 'User'){

        $Comment = $comments->get('`publication` = 0','date_','DESC','0','50');

    }else{

        $Comment = $comments->get('`publication` = 2','date_','DESC','0','50');

    }

?>