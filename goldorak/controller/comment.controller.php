<?php
    
    $checkUrl = preg_match('/goldorak/', $_SERVER['REQUEST_URI']) || preg_match('/garageparrot/', $_SERVER['REQUEST_URI']);
    if($checkUrl){
        require_once('../../model/utilities.class.php');
        require_once('../../goldorak/model/comment.class.php');
    }else{
        require_once('../model/utilities.class.php');
        require_once('../goldorak/model/comment.class.php');
    }

    use \Goldorak\Model\Comment;
    use MyCv\Model\Utilities;
    use \Firebase\JWT\JWT;
    
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

    $jwt1 = JWT::jsondecode($_SESSION['token']['jwt']['tokenJwt']);
    $jwt2 = JWT::jsondecode(Utilities::tokenJwt($_SESSION['dataConnect']['pseudo'], $_SESSION['token']['jwt']['secretKey'], $_SESSION['token']['jwt']['delay']));

    if($jwt2->{'delay'} - $jwt1->{'delay'} <= $_SESSION['token']['jwt']['delay']){

        if($jwt1->{'pseudo'} === $jwt2->{'pseudo'} && $jwt1->{'key'} === $jwt2->{'key'}){

            if(Utilities::verifCsrf('csrf') && $_SERVER['REQUEST_METHOD'] === 'POST'){
                
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

                        $comments->insertComment();

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

        Utilities::redirectToPage('timeExpired');
    }

    if($_SESSION['dataConnect']['type'] === 'Administrator'){

        $Comment = $comments->getCommentList(1,'date_','DESC', 0, 50);

    }else if($_SESSION['dataConnect']['type'] === 'User'){

        $Comment = $comments->getCommentList('`publication` = 0','date_','DESC',0,50);

    }else{

        $Comment = $comments->getCommentList("`comment`.`publication` = 2",'date_','DESC',0,50);

    }

?>