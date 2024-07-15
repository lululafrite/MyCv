<?php
    include_once('../../common/utilies.php');
    include_once('../../garageparrot/model/comment.class.php');

    $comments = new Comment();

    // Vérification du token CSRF
    if(verifCsrf('tokenCsrf') && $_SERVER['REQUEST_METHOD'] === 'POST'){

        if(isset($_POST['bt_save_comment'])){
            
            $comments->setDate_(date("Y-m-d"));
            $comments->setPseudo(isset($_POST['txt_comment_pseudo']) ? filterInput('txt_comment_pseudo') : '');
            $comments->setRating(isset($_POST['selectedRating']) ? filterInput('selectedRating') : '');
            $comments->setComment(isset($_POST['txt_comment_comment']) ? filterInput('txt_comment_comment') : '');

            $comments->addComment();
            unset($_POST['bt_save_comment']);

        }else if(isset($_POST['bt_comment_delete'])){
            
            $comments->deleteComment(isset($_POST['txt_comment_id']) ? filterInput('txt_comment_id') : '');
            unset($_POST['bt_comment_delete']);

        }

    }

    $Comment = $comments->get(1,'date_','DESC','0','50');
?>