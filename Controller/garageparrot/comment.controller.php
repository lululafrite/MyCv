<?php
    
    require_once('../model/utilities.class.php');
    require_once('../model/garageparrot/comment.class.php');

    use GarageParrot\Model\Comment;
    use MyCv\Model\Utilities;

    $comments = new Comment();

    // Vérification du token CSRF
    if($_SERVER['REQUEST_METHOD'] === 'POST'){ //(Utilities::verifCsrf('csrf') && $_SERVER['REQUEST_METHOD'] === 'POST'){

        if(isset($_POST['bt_save_comment'])){
            
            $comments->setDate_(date("Y-m-d"));
            $comments->setPseudo(isset($_POST['txt_comment_pseudo']) ? Utilities::filterInput('txt_comment_pseudo') : '');
            $comments->setRating(isset($_POST['selectedRating']) ? Utilities::filterInput('selectedRating') : '');
            $comments->setComment(isset($_POST['txt_comment_comment']) ? Utilities::filterInput('txt_comment_comment') : '');

            $comments->addComment();
            unset($_POST['bt_save_comment']);

        }elseif(isset($_POST['bt_comment_delete'])){
            
            $comments->deleteComment(isset($_POST['txt_comment_id']) ? Utilities::filterInput('txt_comment_id') : '');
            unset($_POST['bt_comment_delete']);
        }

    }

    $Comment = $comments->getCommentList(1,'date_','DESC','0','50');
?>