<?php

    include_once('../../goldorak/model/user.class.php');
    include_once '../../common/utilies.php';

//***********************************************************************************************
// Echapper les variables
//***********************************************************************************************
    
    $nav_new_user = isset($_POST['nav_new_user']) ? true : false;
    $bt_userEdit_new = isset($_POST['bt_userEdit_new']) ? true : false;
    $bt_userEdit_delete = isset($_POST['bt_userEdit_delete']) ? true : false;
    $bt_userEdit_cancel = isset($_POST['bt_userEdit_cancel']) ? true : false;
    $bt_userEdit_save = isset($_POST['bt_userEdit_save']) ? true : false;
    $_SESSION['bt_userEdit_save'] = $bt_userEdit_save;

    $btn_monCompte = isset($_POST['btn_monCompte']) ? true : false;
    if(!$_SESSION['btn_monCompte']){
        $btn_monCompte ? $_SESSION['btn_monCompte'] = true : $_SESSION['btn_monCompte'] = false;
    }

    $btn_avatar = isset($_POST['btn_avatar']) ? true : false;
    $btn_venusia = isset($_POST['btn_venusia']) ? true : false;
    $btn_actarus = isset($_POST['btn_actarus']) ? true : false;
    $btn_goldorak = isset($_POST['btn_goldorak']) ? true : false;

    $newError = isset($_GET['newError']) ? filter_input('newError', INPUT_GET) : false;

//***********************************************************************************************
// Daclaration et paramètrage des variables
//***********************************************************************************************

    if($nav_new_user){

        $_SESSION['newUser'] = true;

    }else if ($bt_userEdit_new){

        $_SESSION['newUser'] = true;

    }else if($btn_venusia){
        
        $_SESSION['subscription'] = 'Vénusia';
        $_SESSION['newMember'] = true;
        $_SESSION['newUser'] = true;

    }else if($btn_actarus){
        
        $_SESSION['subscription'] = 'Actarus';
        $_SESSION['newMember'] = true;
        $_SESSION['newUser'] = true;

    }else if($btn_goldorak){
        
        $_SESSION['subscription'] = 'Goldorak';
        $_SESSION['newMember'] = true;
        $_SESSION['newUser'] = true;

    }
    
    $_SESSION['theTable'] = 'user';
    
    $changeAvatar = false;
    
    $MyUser = new User();
    $MyUser->setNewUser($_SESSION['newUser']);

    $user = array(
        "id_user" => ''
    );
    $users = array();
    $users[0] = $user;

    //***********************************************************************************************
    // traitement CRUD
    //***********************************************************************************************

    //Récupération des valeurs des input du formulaire

    $_SESSION['id_user'] = isset($_POST['txt_userEdit_id']) ? filterInput('txt_userEdit_id') : '';
    $_SESSION['name'] = isset($_POST['txt_userEdit_name']) ? filterInput('txt_userEdit_name') : '';
    $_SESSION['surname'] = isset($_POST['txt_userEdit_surname']) ? filterInput('txt_userEdit_surname') : '';
    $_SESSION['pseudo'] = isset($_POST['txt_userEdit_pseudo']) ? filterInput('txt_userEdit_pseudo') : '';
    $_SESSION['email'] = isset($_POST['txt_userEdit_email']) ? filterInput('txt_userEdit_email') : '';
    $_SESSION['phone'] = isset($_POST['txt_userEdit_phone']) ? filterInput('txt_userEdit_phone') : '';
    $_SESSION['type'] = isset($_POST['list_userEdit_type']) ? filterInput('list_userEdit_type') : '';
    $_SESSION['avatarConnect'] = isset($_POST['txt_userEdit_avatar']) ? filterInput('txt_userEdit_avatar') : '';
    $_SESSION['subscription'] = isset($_POST['list_userEdit_subscription']) ? filterInput('list_userEdit_subscription') : '';
    $_SESSION['password'] = isset($_POST['txt_userEdit_password']) ? filterInput('txt_userEdit_password') : '';

    if(empty($_SESSION['csrfUSer'])){ verifCsrf('csrfUSer'); }

    if($bt_userEdit_save && !$_SESSION['errorFormUser']){

        if(verifCsrf('csrfUSer') && $_SERVER['REQUEST_METHOD'] === 'POST'){

            $MyUser->setName(strtoupper($_SESSION['name']));
            $MyUser->setSurname(ucfirst(strtolower($_SESSION['surname'])));
            //$MyUser->setPseudo(preg_replace('/[^a-zA-Z0-9_#]/', '', $_SESSION['pseudo']));
            $MyUser->setPseudo($_SESSION['pseudo']);
            $MyUser->setEmail($_SESSION['email']);
            $MyUser->setPhone($_SESSION['phone']);

            if($_SESSION['typeConnect'] ==='Administrator'){

                $MyUser->setType($_SESSION['type']);

            }else{

                $MyUser->setType('Member');

            }

            $MyUser->setAvatar($_SESSION['avatarConnect']);
            $MyUser->setSubscription($_SESSION['subscription']);
            $MyUser->setPassword($_SESSION['password']);
            
            if($_SESSION['newUser']){
                    
                $MyUser->setId($MyUser->addUser());
                $_SESSION['newUser'] = false;
                $MyUser->setNewUser(false);

                if($_SESSION['newMember']){

                    $_SESSION['newMember'] = false;
                    $_SESSION['typeConnect'] = 'Member';
                    $_SESSION['pseudoConnect'] = $_SESSION['pseudo'];
                    $_SESSION['avatarConnect'] = $_SESSION['avatarConnect'];
                    $_SESSION['subscriptionConnect'] = $_SESSION['subscription'];
                    $_SESSION['connexion'] = true;

                    routeToHomePage();

                }else{

                    echo '<script>alert("L\'enregistrement est effectué!");</script>';

                }

            }else{

                $MyUser->updateUser($_SESSION['id_user']);

                if ($_SESSION['updateMoncompte']){

                    $_SESSION['pseudoConnect'] = $_SESSION['pseudo'];
                    $_SESSION['avatarConnect'] = $_SESSION['avatarConnect'];
                    $_SESSION['subscriptionConnect'] = $_SESSION['subscription'];

                }

            }

        }

    }else if($bt_userEdit_cancel){
        
        $_SESSION['newUser'] = false;
        
        routeToUserPage();

    }else if($_SESSION['newUser'] && !$_SESSION['errorFormUser']){
        
        $_SESSION['subscription'] = !empty($_SESSION['subscription']) ? $_SESSION['subscription'] : 'Vénusia';

        if($nav_new_user){
            $user = array(
                "id_user" => '',
                "name" => '',
                "surname" => '',
                "pseudo" => '',
                "email" => '',
                "phone" => '',
                "type" => 'Member',
                "avatar" => 'avatar_membre_white.webp',
                "subscription" => $_SESSION['subscription'],
                "password" => '',
                "message" => ''
            );
            $users[0] = $user;
        }
        
        if(!$btn_avatar && !$nav_new_user){

            exit();

        }

    }else if($bt_userEdit_delete){
        
        $_SESSION['id_user'] = isset($_POST['txt_userEdit_id']) ? filterInput('txt_userEdit_id') : '';
        
        if ($MyUser->deleteUser($_SESSION['id_user'])){

            if($_SESSION['typeConnect'] === 'Member'){

                $_SESSION['id_user'] = '';
                $_SESSION['name'] = '';
                $_SESSION['surname'] = '';
                $_SESSION['pseudo'] = 'Guest';
                $_SESSION['email'] = '';
                $_SESSION['phone'] = '## ## ## ## ##';
                $_SESSION['type'] = 'Guest';
                $_SESSION['avatarConnect'] = 'avatar_membre_white.webp';
                $_SESSION['subscription'] = 'Vénusia';
                $_SESSION['password'] =  '';
                $_SESSION['message'] =  '';
                $_SESSION['connexion'] = false;

            }
            
            routeAfterDelete();

        }else{

            $_SESSION['message'] = 'Il y a une erreur, cet enregistrement n\'a pas pu être supprimé de la base de données!';

        }

    }else if($newError && !$_SESSION['errorFormUser']){

        $user = array(

            "id_user" => $_SESSION['id_user'],
            "name" => $_SESSION['name'],
            "surname" => $_SESSION['surname'],
            "pseudo" => $_SESSION['pseudo'],
            "email" => $_SESSION['email'],
            "phone" => $_SESSION['phone'],
            "type" => $_SESSION['type'],
            "avatar" => $_SESSION['avatarConnect'],
            "subscription" => $_SESSION['subscription'],
            "password" => $_SESSION['password'],
            "message" => $_SESSION['message']

        );

        $users[0] = $user;

        $_SESSION['newUser'] = true;
        $newError = false;

    }

    if($_SESSION['errorFormUser'] === false){

        if(!$_SESSION['newUser']){
            
            if($btn_monCompte){

                $users = $MyUser->get('`pseudo` = \'' . $_SESSION['pseudoConnect'] . '\'');
                $_SESSION['updateMoncompte'] = true;

            }else{

                $_SESSION['id_user'] = isset($_POST['txt_userEdit_id']) ? filterInput('txt_userEdit_id') : '';
                if(!empty($_SESSION['id_user'])){
                    
                    $MyUser->setId($_SESSION['id_user']);

                }else if($users[0]['id_user'] != ''){

                    $MyUser->setId($users[0]['id_user']);

                }
                // Requete SELECT permettant de récupérer les données de l'utilisateur en fonction de l'id traité ci-dessus
                $users = $MyUser->get('`id_user` = \'' . $MyUser->getId() . '\'');
                $users[0]['message'] = $_SESSION['message'];

            }

        }

    }

    //***********************************************************************************************
    // traitement du téléchargement des images 
    //***********************************************************************************************
    
    if($btn_avatar){

        if (uploadImg('uploadAvatar','txt_userEdit_avatar','fileAvatar','./img/avatar/')){
            
            if($_SESSION['btn_monCompte']){
                $_SESSION['avatarConnect'] = $_SESSION['uploadAvatar'];
            }

            $users[0]['avatar'] = ($_SESSION['uploadAvatar']);
            $_SESSION['avatarConnect'] = $_SESSION['uploadAvatar'];

            if($_SESSION['newUser']){

                $users[0]['name'] = $_SESSION['name'];
                $users[0]['surname'] = $_SESSION['surname'];
                $users[0]['pseudo'] = $_SESSION['pseudo'];
                $users[0]['email'] = $_SESSION['email'];
                $users[0]['phone'] = $_SESSION['phone'];
                $users[0]['type'] = $_SESSION['type'];
                $users[0]['subscription'] = $_SESSION['subscription'];
                $users[0]['password'] = $_SESSION['password'];
                $users[0]['message'] = $_SESSION['message'];

            }

        }else{

            echo "<script>alert('Désolé, une erreur s\'est produite lors de l\'upload de l\'image.');</script>";

        }

    }
    
    if($btn_avatar || !$bt_userEdit_new){

        //Traiment de la BD pour récupérer les données destinées à l'input liste type
        include('../../goldorak/model/type.class.php');
        $Types = new Type();
        $MyType = $Types->get(1,'type', 'ASC', 0, 50);
        unset($Types);

        //Traiment de la BD pour récupérer les données destinées à l'input liste subscription
        include('../../goldorak/model/subscription.class.php');
        $Subscriptions = new Subscription();
        $MySubscription = $Subscriptions->get(1,'subscription', 'ASC', 0, 50);
        unset($Subscriptions);

    }

?>