<?php

    $checkUrl = preg_match('/goldorak/', $_SERVER['REQUEST_URI']) || preg_match('/garageparrot/', $_SERVER['REQUEST_URI']);
    if($checkUrl){
        require_once('../../model/utilities.class.php');
        require_once('../../model/user.class.php');
    }else{
        require_once('../model/utilities.class.php');
        require_once('../model/user.class.php');
    }

    use MyCv\Model\Utilities;
    use User\Model\User;

    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        if(isset($_POST['envoyer'])){

            resetDataConnectVarSession();
            resetOtherVarSession();

            $email = ''; settype($email, "string");
            $pw = ''; settype($pw, "string");
            $hashedPw = ''; settype($hashedPw, "string");
            $data = array(); settype($data, "array");

            if (isset($_POST["email"]) && empty($_POST["email"])) {
                
                $_SESSION['other']['error'] = true;
                $_SESSION['other']['message'] = 'The Cell [email] is umpty!!!';
                return;

            }else{

                $email = Utilities::escapeInput($_POST["email"]);

                if(!User::checkEmail($email)){
                    $_SESSION['other']['error'] = true;
                    $_SESSION['other']['message'] = 'This email is not existing!!!';
                    return;
                }
            }

            if (isset($_POST["password"]) && empty($_POST["password"])) {

                $_SESSION['other']['error'] = true;
                $_SESSION['other']['message'] = 'The Cell [mot de passe] is umpty!!!';
                return;

            }else{

                $pw = Utilities::escapeInput($_POST["password"]);
                $hashedPw = User::checkPassword($email);

                if(!password_verify($pw, $hashedPw)){
                    $_SESSION['other']['error'] = true;
                    $_SESSION['other']['message'] = 'This password is not correctly!!!';
                    return;
                }
            }
            
            $data = User::checkUserConnect($email, $hashedPw);

            $_SESSION['dataConnect'] = $data;
            $_SESSION['dataConnect']['connexion'] = true;

            $_SESSION['token']['jwt']['tokenJwt'] = Utilities::tokenJwt($_SESSION['dataConnect']['pseudo'], $_SESSION['token']['jwt']['secretKey'], $_SESSION['token']['jwt']['delay']);
            
            Utilities::redirectToPage('home');
        }
    }
?>

