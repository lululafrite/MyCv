<?php
    
    $checkUrl = preg_match('/goldorak/', $_SERVER['REQUEST_URI']) || preg_match('/garageparrot/', $_SERVER['REQUEST_URI']);
    if($checkUrl){
        require_once('../../model/utilities.class.php');
        require_once('../../garageparrot/model/comment.class.php');
    }else{
        require_once('../model/utilities.class.php');
        require_once('../garageparrot/model/comment.class.php');
    }

    use GarageParrot\Model\Comment;
    use MyCv\Model\Utilities;

    $comments = new Comment();

    // Vérification du token CSRF
    if($_SERVER['REQUEST_METHOD'] === 'POST'){ //(Utilities::verifCsrf('csrf') && $_SERVER['REQUEST_METHOD'] === 'POST'){

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

    $Comment = $comments->getCommentList(1,'date_','DESC','0','50');
?>