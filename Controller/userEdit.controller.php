<?php

    require_once('../model/user.class.php');
    require_once('../model/userForm.class.php');
    require_once('../model/type.class.php');
    require_once('../model/subscription.class.php');
    require_once('../model/utilities.class.php');

    use \User\Model\User;
    use \User\Model\UserForm;
    use \User\Model\Type As UserType;
    use \User\Model\Subscription;
    use MyCv\Model\Utilities;
    
    $MyUser = new User();
    $MyUserForm = new UserForm();
    
    $users = array("id_user" => 0);
    $MyTypes = array();
    $MySubscription = array();
    $btnUpdate = false; settype($btnUpdate, 'boolean');
    
    $urlImg = '../img/avatar/';
    if(preg_match('/goldorak/', $_SERVER['REQUEST_URI'])){

        $urlImg = '../img/goldorak/avatar/';

    }elseif(preg_match('/garageparrot/', $_SERVER['REQUEST_URI'])){
    
        $urlImg = '../img/garageparrot/avatar/';
    
    }

//***********************************************************************************************
// Echapper les variables $_POST
//***********************************************************************************************

    resetOtherVarSession();

    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        $MyUserForm->setBtnUserEdit(isset($_POST['btn_userEdit']) ? true : false); //Button in the table to edit a user (user.php)
        
        $MyUserForm->setBtnNavBarInsert(isset($_POST['btn_navBar_new']) ? true : false); //Button in the navigation bar to insert a new user
        $MyUserForm->setBtnMonCompte(isset($_POST['btn_monCompte']) ? true : false); //Button in the navigation bar

        $MyUserForm->setBtnInsert(isset($_POST['btn_userEdit_new']) ? true : false); //Button in the form to user (userEdit.php)
        $MyUserForm->setBtnDelete(isset($_POST['btn_userEdit_delete']) ? true : false); //Button in the form to user (userEdit.php)
        $MyUserForm->setBtnCancel(isset($_POST['btn_userEdit_cancel']) ? true : false); //Button in the form to user (userEdit.php)

        $MyUserForm->setBtnUpdate(isset($_POST['btn_userEdit_save']) ? true : false); //Button in the form to user (userEdit.php)
        $MyUserForm->setBtnUpdate1(isset($_POST['btn_userEdit_save_1']) ? true : false); //Button in the form to user (userEdit.php)
        $btnUpdate = $MyUserForm->getBtnUpdate1() ? true : $MyUserForm->getBtnUpdate();
        
        $MyUserForm->setBtnAvatar(isset($_POST['btn_avatar']) ? true : false); //Button in the form to suscribe a new user (adherer.php)

        $MyUserForm->setBtnVenusia(isset($_POST['btn_venusia']) ? true : false); //Button in the form to suscribe a new user (adherer.php)
        $MyUserForm->setBtnActarus(isset($_POST['btn_actarus']) ? true : false); //Button in the form to suscribe a new user (adherer.php)
        $MyUserForm->setBtnGoldorak(isset($_POST['btn_goldorak']) ? true : false); //Button in the form to suscribe a new user (adherer.php)
        
        $MyUserForm->setNewError(isset($_GET['newError']) ? filter_input('newError', INPUT_GET) : false);

        //Récupération des valeurs des inputs du formulaire
        $MyUser->setId(isset($_POST['txt_userEdit_id']) ? intval(Utilities::filterInput('txt_userEdit_id')) : 0); //input in the form to user (userEdit.php)
        $MyUser->setName(isset($_POST['txt_userEdit_name']) ? Utilities::filterInput('txt_userEdit_name') : ''); //input in the form to user (userEdit.php)
        $MyUser->setSurname(isset($_POST['txt_userEdit_surname']) ? Utilities::filterInput('txt_userEdit_surname') : ''); //input in the form to user (userEdit.php)
        $MyUser->setPseudo(isset($_POST['txt_userEdit_pseudo']) ? Utilities::filterInput('txt_userEdit_pseudo') : ''); //input in the form to user (userEdit.php)
        $MyUser->setEmail(isset($_POST['txt_userEdit_email']) ? Utilities::filterInput('txt_userEdit_email') : ''); //input in the form to user (userEdit.php)
        $MyUser->setPhone(isset($_POST['txt_userEdit_phone']) ? Utilities::filterInput('txt_userEdit_phone') : ''); //input in the form to user (userEdit.php)
        $MyUser->setType(isset($_POST['list_userEdit_type']) ? Utilities::filterInput('list_userEdit_type') : ''); //input in the form to user (userEdit.php)
        if(empty($MyUser->getType())){ $MyUser->setType('Member');}
        $MyUser->setAvatar(isset($_POST['txt_userEdit_avatar']) ? Utilities::filterInput('txt_userEdit_avatar') : 'avatar_membre_white.webp'); //input in the form to user (userEdit.php)
        $MyUser->setSubscription(isset($_POST['list_userEdit_subscription']) ? Utilities::filterInput('list_userEdit_subscription') : ''); //input in the form to user (userEdit.php)
        $MyUser->setPassword(isset($_POST['txt_userEdit_password']) ? Utilities::filterInput('txt_userEdit_password') : ''); //input in the form to user (userEdit.php)
    }

//***********************************************************************************************
// Déclaration et paramètrage des variables
//***********************************************************************************************

    if($MyUserForm->getBtnVenusia()){
        
        $_SESSION['dataConnect']['subscription'] = 'Vénusia';
        $MyUser->setSubscription('Vénusia');

        $_SESSION['user']['newMember'] = true;
        $MyUserForm->setNewMember(true);

        $MyUserForm->setBtnInsert(true);

    }elseif($MyUserForm->getBtnActarus()){
        
        $_SESSION['dataConnect']['subscription'] = 'Actarus';
        $MyUser->setSubscription('Actarus');

        $_SESSION['user']['newMember'] = true;
        $MyUserForm->setNewMember(true);

        $MyUserForm->setBtnInsert(true);

    }elseif($MyUserForm->getBtnGoldorak()){
        
        $_SESSION['dataConnect']['subscription'] = 'Goldorak';
        $MyUser->setSubscription('Goldorak');

        $_SESSION['user']['newMember'] = true;
        $MyUserForm->setNewMember(true);

        $MyUserForm->setBtnInsert(true);
    }

    //***********************************************************************************************
    // CRUD
    //***********************************************************************************************
        
    if($MyUserForm->getBtnUserEdit()){

        $users = $MyUser->getCurrentUser($MyUser->getId());
        $users['message'] = "";

        $MyType = myType();
        $MySubscription = mySubscription();

        return;

    }elseif($btnUpdate){
        
        if(!Utilities::ckeckCsrf()){
            
            $users = initTabUser($users, $MyUser, $MyUserForm);
            die($_SESSION['other']['message']);

        }else{

            if($MyUser->getId() === 0){

                if(empty($MyUser->getType())){
                    $MyUser->setType('member');
                }
                $newUser = $MyUser->insertUser();

                if(!$_SESSION['other']['error']){

                    $MyUser->setId($newUser);

                    $users = initTabUser($users, $MyUser, $MyUserForm);
                    $users['message'] = $_SESSION['other']['message'];
                    
                    $MyType = myType();
                    $MySubscription = mySubscription();

                    if($_SESSION['user']['newMember']){

                        $_SESSION['user']['newMember'] = false;
                        $MyUserForm->setNewMember(false);

                        $_SESSION['dataConnect']['id_user'] = $MyUser->getId();
                        $_SESSION['dataConnect']['pseudo'] = $MyUser->getPseudo();
                        $_SESSION['dataConnect']['avatar'] = $MyUser->getAvatar();
                        $_SESSION['dataConnect']['type'] = 'Member';
                        $_SESSION['dataConnect']['subscription'] = $MyUser->getSubscription();
                        $_SESSION['dataConnect']['password'] = '';
                        $_SESSION['dataConnect']['error'] = false;
                        $_SESSION['dataConnect']['connexion'] = true;

                        $_SESSION['token']['jwt']['tokenJwt'] = Utilities::tokenJwt($_SESSION['dataConnect']['pseudo'], $_SESSION['token']['jwt']['secretKey'], $_SESSION['token']['jwt']['delay']);
                        Utilities::redirectToPage('home');
                    }
                    
                    return;

                }else{

                    $users = initTabUser($users, $MyUser, $MyUserForm);
                    
                    $MyType = myType();
                    $MySubscription = mySubscription();

                    return;
                }

            }else{

                $updateUser = $MyUser->updateUser($MyUser->getId());
                $users = initTabUser($users, $MyUser, $MyUserForm);

                $users['message'] = $_SESSION['other']['message'];
                
                $MyType = myType();
                $MySubscription = mySubscription();

                if ($_SESSION['user']['updateMonCompte']){

                    $_SESSION['dataConnect']['id_user'] = $MyUser->getId();
                    $_SESSION['dataConnect']['pseudo'] = $MyUser->getPseudo();
                    $_SESSION['dataConnect']['avatar'] = $MyUser->getAvatar();
                    $_SESSION['dataConnect']['type'] = 'Member';
                    $_SESSION['dataConnect']['subscription'] = $MyUser->getSubscription();
                    $_SESSION['dataConnect']['password'] = '';
                    $_SESSION['dataConnect']['error'] = false;
                    $_SESSION['dataConnect']['connexion'] = true;

                    $_SESSION['user']['updateMonCompte'] = false;
                }

                return;
            }
        }

    }elseif($MyUserForm->getBtnMonCompte()){ //Button in the navigation bar
        
        $MyUser->setId($_SESSION['dataConnect']['id_user']);

        $users = $MyUser->getCurrentUser($MyUser->getId());
        
        $users['message'] = $_SESSION['other']['message'];

        $MyType = myType();
        $MySubscription = mySubscription();

        $_SESSION['user']['updateMonCompte'] = true;

        return;

    }elseif($MyUserForm->getBtnInsert() || $MyUserForm->getBtnNavBarInsert()){
        
        $subscription = 'Vénusia'; settype($subscription, 'string');
        if(empty($MyUser->getSubscription())){
            $subscription = 'Vénusia';
        }else{
            $subscription = $MyUser->getSubscription();
        }

        resetUserVar($MyUser, $MyUserForm);
        $users = initTabUser($users, $MyUser, $MyUserForm);
        $users['subscription'] = $subscription;
        
        $MyType = myType();
        $MySubscription = mySubscription();
        
        return;

    }elseif($MyUserForm->getBtnDelete()){
        
        if(!Utilities::ckeckCsrf()){
            
            $users = initTabUser($users, $MyUser, $MyUserForm);
            die($_SESSION['other']['message']);

        }else{

            $deleteUser = $MyUser->deleteUser($MyUser->getId());
            
            if (!$_SESSION['other']['error']){
                    
                resetUserVar($MyUser, $MyUserForm);
                $users = initTabUser($users, $MyUser, $MyUserForm);
                $users['message'] = $_SESSION['other']['message'];

                if($_SESSION['dataConnect']['type'] === 'Member'){

                    resetDataConnectVarSession();

                }

                $_SESSION['token']['jwt']['tokenJwt'] = Utilities::tokenJwt($_SESSION['dataConnect']['pseudo'], $_SESSION['token']['jwt']['secretKey'], $_SESSION['token']['jwt']['delay']);
                
                if($_SESSION['dataConnect']['type'] === 'Administrator'){
                    Utilities::redirectToPage('user');
                }else{
                    Utilities::redirectToPage('home');
                }

            }else{
                
                $users = initTabUser($users, $MyUser, $MyUserForm);
                $users['message'] = $_SESSION['other']['message'];
                
                $MyType = myType();
                $MySubscription = mySubscription();

                return;
            }

        }

    }elseif($MyUserForm->getBtnCancel()){
        
        Utilities::redirectToPage('user');

    }elseif($MyUserForm->getBtnAvatar()){

        if (Utilities::uploadImg('user', 'uploadAvatar','txt_userEdit_avatar','fileAvatar', $urlImg)){
            
            if($MyUserForm->getBtnMonCompte()){
                $_SESSION['dataConnect']['avatar'] = $_SESSION['user']['uploadAvatar'];
            }

            $MyUser->setAvatar($_SESSION['user']['uploadAvatar']);
            
            $users = initTabUser($users, $MyUser, $MyUserForm);
            $users['message'] = "L'image a été téléchargée avec succès.";
        
            $MyType = myType();
            $MySubscription = mySubscription();

            return;

        }else{

            $users = initTabUser($users, $MyUser, $MyUserForm);
            $users['message'] = "Une erreur s'est produite lors de l'upload de l'image.";
        
            $MyType = myType();
            $MySubscription = mySubscription();

            return;
        }
    }

    if($MyUserForm->getNewError() && !$_SESSION['other']['errorForm']){

        $users = initTabUser($users, $MyUser, $MyUserForm);
        $users['message'] = "Veuillez remplir tous les champs du formulaire.";

        $MyType = myType();
        $MySubscription = mySubscription();

        $MyUserForm->setNewError(false);

        return;
    }

    //Fonction traitement de la BD pour récupérer les données destinées à l'input liste type
    function myType():array{
        
        $Types = new UserType();
        $myType = array();

        $myType = $Types->getTypeList(1,'type', 'ASC', 0, 50);
        unset($Types);

        return $myType;
    }

    //Fonction de traitement de la BD pour récupérer les données destinées à l'input liste subscription
    function mySubscription():array{

        $Subscriptions = new Subscription();
        $MySubscription = array();

        $MySubscription = $Subscriptions->getSubscriptionList(1,'subscription', 'ASC', 0, 50);
        unset($Subscriptions);

        return $MySubscription;
    }

    //Fonction d'initialisation du tableau des données de l'utilisateur
    function initTabUser(array $users, object $MyUser, object $MyUserForm):array{
        
        $users['id_user'] = $MyUser->getId();
        $users['name'] = $MyUser->getName();
        $users['surname'] = $MyUser->getSurname();
        $users['pseudo'] = $MyUser->getPseudo();
        $users['email'] = $MyUser->getEmail();
        $users['phone'] = $MyUser->getPhone();
        $users['type'] = $MyUser->getType();
        $users['avatar'] = $MyUser->getAvatar();
        $users['subscription'] = $MyUser->getSubscription();
        $users['password'] = $MyUser->getPassword();
        $users['message'] = "";

        return $users;
    }

    //Fonction de réinitialisation des variables de l'utilisateur
    function resetUserVar(object $MyUser, object $MyUserForm):void{
        
        $MyUser->setId(0);
        $MyUser->setName('');
        $MyUser->setSurname('');
        $MyUser->setPseudo('');
        $MyUser->setEmail('');
        $MyUser->setPhone('## ## ## ## ##');
        $MyUser->setType('Member');
        $MyUser->setAvatar('avatar_membre_white.webp');
        $MyUser->setSubscription('Vénusia');
        $MyUser->setPassword('');
    }
?>