<?php

//***********************************************************************************************
// Daclaration de variables
//***********************************************************************************************

    include_once('../../garageparrot/model/user.class.php');
    
    $_SESSION['theTable'] = 'user';

    $MyUser = new User();
    
    $Users = array();
    $user = array(
        "id_user" => ''
    );
    $Users[0] = $user;

//***********************************************************************************************
// traitement du CRUD
//***********************************************************************************************

    if(isset($_POST['bt_userEdit_save']) && $_SESSION['errorFormUser'] === false){
        
        //Récupération des valeurs des input du formulaire
        $MyUser->setName(strtoupper($_POST["txt_userEdit_name"]));
        $MyUser->setSurname(ucfirst(strtolower($_POST["txt_userEdit_surname"])));
        $MyUser->setPseudo($_POST["txt_userEdit_pseudo"]);
        $MyUser->setEmail($_POST["txt_userEdit_email"]);
        $MyUser->setPhone($_POST["txt_userEdit_phone"]);
        $MyUser->setType($_POST["list_userEdit_type"]);
        $MyUser->setPassword($_POST["txt_userEdit_password"]);

        
        if($_SESSION['newUser'] === true){
            // $req est la valeur retournée par la requete permettent de vérifier si l'utilisateur n'est pas déjà existant en BD. 1 = exitant, 0 = non existant
            $req = $MyUser->verifUser($MyUser->getEmail());
            
            if($req === 0){
                
                $MyUser->setId($MyUser->addUser()); // Requete qui ajoute l'utilisateur
                $_SESSION['newUser'] = false;
				echo '<script>alert("L\'enregistrement est effectué!");</script>';

            }else{
                
                echo '<script>alert("Cet utilisateur existe déjà en base de donnée.;</script>';
            
            }

        }else{

            $MyUser->updateUser($_POST["txt_userEdit_id"]);

        }

    }else if(isset($_POST['nav_new_user']) || isset($_POST['bt_userEdit_new'])){
        
        if ($_SESSION['errorFormUser'] === false){
            // Vide le tableau pour que les input du formulaire soient vides après avoir cliqué sur le bouton nouveau
            $user = array(
                "id_user" => '',
                "name" => '',
                "surname" => '',
                "pseudo" => '',
                "email" => '',
                "phone" => '',
                "type" => '',
                "password" => ''
            );
            $Users[0] = $user;

            $_SESSION['newUser'] = true;
            
        }

    }else if(isset($_POST['bt_userEdit_delete'])){
        // requete qui supprime le véhicule
        $MyUser->deleteUser($_POST["txt_userEdit_id"]);

    }else if(isset($_POST['bt_userEdit_cancel'])){
        
        $_SESSION['newUserr'] = false;
        
        if($_SESSION['local']===true){

            echo '<script>window.location.href = "http://follaco/garageparrot/index.php?page=user";</script>';
        
        }
        else{
            
            echo '<script>window.location.href = "https://www.follaco.fr/index.php?page=user";</script>';
        
        }
        exit();

    }

    if($_SESSION['errorFormUser']===false){

        if(!$_SESSION['newUser']){
            // Traitement de récupération de l'id de l'utilisateur en fonction des conditions
            if(isset($_POST['txt_userEdit_id']) && !empty($_POST['txt_userEdit_id'])){
                
                $MyUser->setId($_POST['txt_userEdit_id']);

            }else if($Users[0]['id_user'] != ''){

                $MyUser->setId($Users[0]['id_user']);

            }
            // Requete SELECT permettant de récupérer les données de l'utilisateur en fonction de l'id traité ci-dessus
            $Users = $MyUser->getUser($MyUser->getId());
        }
        
        //Traiment de la BD pour récupérer les données destinées à l'input liste type
        include('../../garageparrot/model/type.class.php');
        $Types = new Type();
        $MyType = $Types->get(1,'type', 'ASC', 0, 50);
        unset($Types);

    }

?>