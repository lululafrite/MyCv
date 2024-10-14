<?php

    use Model\Comment\Comment;
    use Model\Utilities\Utilities;
    use \Firebase\JWT\JWT;

    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        $bt_save_comment = isset($_POST['bt_save_comment']) ? true : false;
        unset($_POST['bt_save_comment']);

        $bt_comment_delete = isset($_POST['bt_comment_delete']) ? true : false;
        unset($_POST['bt_comment_delete']);

        $bt_comment_validate = isset($_POST['bt_comment_validate']) ? true : false;
        unset($_POST['bt_comment_validate']);

        $bt_comment_refuse = isset($_POST['bt_comment_refuse']) ? true : false;
        unset($_POST['bt_comment_refuse']);
    }

    if(!isset($comments)){
        $comments = new Comment();
    }

    $jwt1 = JWT::jsondecode($_SESSION['token']['jwt']['tokenJwt']);
    $jwt2 = JWT::jsondecode(Utilities::tokenJwt($_SESSION['dataConnect']['pseudo'], $_SESSION['token']['jwt']['secretKey'], $_SESSION['token']['jwt']['delay']));

    if($jwt2->{'delay'} - $jwt1->{'delay'} <= $_SESSION['token']['jwt']['delay']){

        if($jwt1->{'pseudo'} === $jwt2->{'pseudo'} && $jwt1->{'key'} === $jwt2->{'key'}){

            if(!Utilities::ckeckCsrf()){
                
                $idComment = Utilities::filterInput('txt_comment_id');

                if($bt_save_comment){

                    $bt_save_comment = false;

                    $pseudo_ = Utilities::filterInput('txt_comment_pseudo');
                    $rating_ = Utilities::filterInput('selectedRating');
                    $comment_ = Utilities::filterInput('txt_comment_comment');
                    
                    if($comment_ != ""){

                        $comments->setDate(date("Y-m-d"));
                        $comments->setPseudo($pseudo_);
                        $comments->setRating($rating_);
                        $comments->setComment($comment_);

                        $comments->insertComment();

                    }else{

                        echo "<script>alert('Le champ commentaire ne peut pas être vide!!! Resaisissez votre commentaire et selectionnez une étoile de 1 à 5.');</script>";

                    }

                }elseif($bt_comment_delete){
                    
                    $comments->deleteComment($idComment);

                }elseif($bt_comment_validate){
                    
                    $comments->modereComment($idComment, 2);

                }elseif($bt_comment_refuse){
                    
                    $comments->modereComment($idComment, 1);

                }

            }

        }

    }elseif($_SESSION['dataConnect']['pseudo'] != 'Guest'){

        $_SESSION['dataConnect']['type'] = 'Guest';
        $_SESSION['dataConnect']['pseudo'] = 'Guest';
        $_SESSION['dataConnect']['avatar'] = 'avatar_membre_white.webp';
        $_SESSION['dataConnect']['subscription'] = 'Vénusia';
        $_SESSION['dataConnect']['connexion'] = false;

        Utilities::redirectToPage('timeExpired');
    }

    if($_SESSION['dataConnect']['type'] === 'Administrator'){

        $Comment = $comments->getCommentList(1,'date_','DESC', 0, 50);

    }elseif($_SESSION['dataConnect']['type'] === 'User'){

        $Comment = $comments->getCommentList('`publication` = 0','date_','DESC',0,50);

    }else{

        $Comment = $comments->getCommentList("`comment`.`publication` = 2",'date_','DESC',0,50);

    }

?>