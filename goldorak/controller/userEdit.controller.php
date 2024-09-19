<?php
    require_once('../../goldorak/model/user.class.php');
    require_once('../../goldorak/model/userForm.class.php');
    require_once('../../common/utilies.php');

    use \Goldorak\Model\User;
    use \Goldorak\Model\UserForm;
    use \Goldorak\Model\Type;
    use \Goldorak\Model\Subscription;
    
    $MyUser = new User();
    $MyUserForm = new UserForm();
    
    $users = array("id_user" => 0);
    $MyTypes = array();
    $MySubscription = array();
    $btnUpdate = false; settype($btnUpdate, 'boolean');

//***********************************************************************************************
// Echapper les variables $_POST
//***********************************************************************************************
    
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
        $MyUser->setId(isset($_POST['txt_userEdit_id']) ? intval(filterInput('txt_userEdit_id')) : 0); //input in the form to user (userEdit.php)
        $MyUser->setName(isset($_POST['txt_userEdit_name']) ? filterInput('txt_userEdit_name') : ''); //input in the form to user (userEdit.php)
        $MyUser->setSurname(isset($_POST['txt_userEdit_surname']) ? filterInput('txt_userEdit_surname') : ''); //input in the form to user (userEdit.php)
        $MyUser->setPseudo(isset($_POST['txt_userEdit_pseudo']) ? filterInput('txt_userEdit_pseudo') : ''); //input in the form to user (userEdit.php)
        $MyUser->setEmail(isset($_POST['txt_userEdit_email']) ? filterInput('txt_userEdit_email') : ''); //input in the form to user (userEdit.php)
        $MyUser->setPhone(isset($_POST['txt_userEdit_phone']) ? filterInput('txt_userEdit_phone') : ''); //input in the form to user (userEdit.php)
        $MyUser->setType(isset($_POST['list_userEdit_type']) ? filterInput('list_userEdit_type') : ''); //input in the form to user (userEdit.php)
        if(empty($MyUser->getType())){ $MyUser->setType('Member');}
        $MyUser->setAvatar(isset($_POST['txt_userEdit_avatar']) ? filterInput('txt_userEdit_avatar') : ''); //input in the form to user (userEdit.php)
        $MyUser->setSubscription(isset($_POST['list_userEdit_subscription']) ? filterInput('list_userEdit_subscription') : ''); //input in the form to user (userEdit.php)
        $MyUser->setPassword(isset($_POST['txt_userEdit_password']) ? filterInput('txt_userEdit_password') : ''); //input in the form to user (userEdit.php)
        
        $MyUserForm->setMessage(isset($_POST['txt_userEdit_message']) ? filterInput('txt_userEdit_message') : ''); //input in the form to user (userEdit.php)
    }

//***********************************************************************************************
// Déclaration et paramètrage des variables
//***********************************************************************************************

    if($MyUserForm->getBtnVenusia()){
        
        $_SESSION['subscription'] = 'Vénusia';
        $MyUser->setSubscription('Vénusia');

        $_SESSION['newMember'] = true;
        $MyUserForm->setNewMember(true);

        $MyUserForm->setBtnInsert(true);

    }else if($MyUserForm->getBtnActarus()){
        
        $_SESSION['subscription'] = 'Actarus';
        $MyUser->setSubscription('Actarus');

        $_SESSION['newMember'] = true;
        $MyUserForm->setNewMember(true);

        $MyUserForm->setBtnInsert(true);

    }else if($MyUserForm->getBtnGoldorak()){
        
        $_SESSION['subscription'] = 'Goldorak';
        $MyUser->setSubscription('Goldorak');

        $_SESSION['newMember'] = true;
        $MyUserForm->setNewMember(true);

        $MyUserForm->setBtnInsert(true);
    }

    //***********************************************************************************************
    // traitement CRUD
    //***********************************************************************************************
        
    if($MyUserForm->getBtnUserEdit()){

        $users = $MyUser->getCurrentUser($MyUser->getId());
        $users['message'] = "";

        $MyType = myType();
        $MySubscription = mySubscription();

        return;

    }else if($btnUpdate){

        if(verifCsrf('csrfUser')){
            
            if($MyUser->getId() === 0){
                //$_SESSION['dataConnect']['type'] != 'Guest'
                if(empty($MyUser->getType())){
                    $MyUser->setType('member');
                }
                $newUser = $MyUser->insertUser();

                if(!$newUser['erreur']){

                    $MyUser->setId($newUser['id_user']);
                    $MyUserForm->setMessage($newUser['message']);

                    $users = initTabUser($users, $MyUser, $MyUserForm);
                    $users['message'] = $MyUserForm->getMessage();
                    
                    $MyType = myType();
                    $MySubscription = mySubscription();

                    if($_SESSION['newMember']){

                        $_SESSION['newMember'] = false;
                        $MyUserForm->setNewMember(false);
    
                        $_SESSION['dataConnect']['type'] = 'Member';
                        $_SESSION['dataConnect']['pseudo'] = $MyUser->getPseudo();
                        $_SESSION['dataConnect']['avatar'] = $MyUser->getAvatar();
                        $_SESSION['dataConnect']['subscription'] = $MyUser->getSubscription();
                        $_SESSION['dataConnect']['connexion'] = true;
    
                        routeToHomePage();
    
                    }
                    
                    return;

                }else{

                    $users = initTabUser($users, $MyUser, $MyUserForm);

                    $MyUserForm->setMessage($newUser['message']);
                    $users['message'] = $MyUserForm->getMessage();
                    
                    $MyType = myType();
                    $MySubscription = mySubscription();

                    return;
                }

            }else{
                /*if($_SESSION['updateMoncompte']){
                    $MyUser->setType("member");
                }*/
                $updateUser = $MyUser->updateUser($MyUser->getId());
                $users = initTabUser($users, $MyUser, $MyUserForm);

                $MyUserForm->setMessage($updateUser['message']);
                $users['message'] = $MyUserForm->getMessage();
                
                $MyType = myType();
                $MySubscription = mySubscription();

                if ($_SESSION['updateMoncompte']){

                    $_SESSION['dataConnect']['pseudo'] = $MyUser->getPseudo();
                    $_SESSION['dataConnect']['avatar'] = $MyUser->getAvatar();
                    $_SESSION['dataConnect']['subscription'] = $MyUser->getSubscription();
                    $_SESSION['updateMoncompte'] = false;
                }

                return;
            }
        }

    }else if($MyUserForm->getBtnMonCompte()){ //Button in the navigation bar
        
        $MyUser->setId($_SESSION['dataConnect']['id_user']);

        $users = $MyUser->getCurrentUser($MyUser->getId());
        
        $MyUserForm->setMessage($users['message']);
        $users['message'] = $MyUserForm->getMessage();

        $MyType = myType();
        $MySubscription = mySubscription();

        $_SESSION['updateMoncompte'] = true;

        return;

    }else if($MyUserForm->getBtnInsert() || $MyUserForm->getBtnNavBarInsert()){
        
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

    }else if($MyUserForm->getBtnDelete()){

        $deleteUser = $MyUser->deleteUser($MyUser->getId());
        
        if (!$deleteUser['erreur']){
                
            resetUserVar($MyUser, $MyUserForm);
            $users = initTabUser($users, $MyUser, $MyUserForm);
            $users['message'] = $deleteUser['message'];

            if($_SESSION['dataConnect']['type'] === 'Member'){

                $_SESSION['connexion'] = false;

            }
            routeAfterDelete();

        }else{
            
            $users = initTabUser($users, $MyUser, $MyUserForm);
            $users['message'] = $deleteUser['message'];
            
            $MyType = myType();
            $MySubscription = mySubscription();

            return;
        }

    }else if($MyUserForm->getBtnCancel()){
        
        routeToUserPage();

    }else if($MyUserForm->getBtnAvatar()){

        if (uploadImg('uploadAvatar','txt_userEdit_avatar','fileAvatar','./img/avatar/')){
            
            if($MyUserForm->getBtnMonCompte()){
                $_SESSION['dataConnect']['avatar'] = $_SESSION['uploadAvatar'];
            }

            $MyUser->setAvatar($_SESSION['uploadAvatar']);
            $_SESSION['dataConnect']['avatar'] = $_SESSION['uploadAvatar'];
            
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

    if($MyUserForm->getNewError() && !$_SESSION['errorFormUser']){

        $users = initTabUser($users, $MyUser, $MyUserForm);
        $users['message'] = "Veuillez remplir tous les champs du formulaire.";

        $MyType = myType();
        $MySubscription = mySubscription();

        $MyUserForm->setNewError(false);
        return;
    }

    /*$users = $MyUser->get($MyUser->getId());
    $MyType = myType();
    $MySubscription = mySubscription();*/

    //Fonction traitement de la BD pour récupérer les données destinées à l'input liste type
    function myType():array{
        
        require_once('../../goldorak/model/type.class.php');
        $Types = new Type();
        $myType = array();

        $myType = $Types->get(1,'type', 'ASC', 0, 50);
        unset($Types);

        return $myType;
    }

    //Fonction de traitement de la BD pour récupérer les données destinées à l'input liste subscription
    function mySubscription():array{

        require_once('../../goldorak/model/subscription.class.php');
        $Subscriptions = new Subscription();
        $mySubscription = array();

        $mySubscription = $Subscriptions->get(1,'subscription', 'ASC', 0, 50);
        unset($Subscriptions);

        return $mySubscription;
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
        $users['message'] = $MyUserForm->getMessage();

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
        
        $MyUserForm->setMessage('');
    }
?>