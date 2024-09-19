<?php

    use MyCv\model\UserConnect;

    if(isset($_POST['envoyer'])){

        $current_url = $_SERVER['REQUEST_URI'];
        $goldorak = '/goldorak/';
        $garageParrot = '/garageparrot/';

        if(preg_match($goldorak, $current_url) || preg_match($garageParrot, $current_url)){
            
            require_once('../../model/connexion.class.php');
            require_once('../../common/utilies.php');

        }else{
            require_once('../model/connexion.class.php');
            require_once('../common/utilies.php');
        }

        $MyUserConnect = new UserConnect();

        $emptyCell = false; settype($emptyCell, "boolean");
        $emptyEmail = false; settype($emptyEmail, "boolean");
        $email = ''; settype($email, "string");
        $pw = ''; settype($pw, "string");
        $data = array(); settype($data, "array");

        if (isset($_POST["email"]) && empty($_POST["email"])) {
            
            $emptyCell = true;
            $emptyEmail = true;

        }else{
            $email = escapeInput($_POST["email"]);
        }

        if (isset($_POST["password"]) && empty($_POST["password"])) {

            $emptyCell = true;

        }else{
            $pw = escapeInput($_POST["password"]);
        }
        
        //$hashedPassword = password_hash($pw, PASSWORD_DEFAULT);

        if(!$emptyCell){

            $pwDb = ""; settype($pwDb, "string");
            $hashedPw = ""; settype($hashedPw, "string");

            $pwDb = $MyUserConnect->getCheckPw($email); settype($pwDb, "array");
            
            if(!$pwDb['error']){

                $hashedPw = $pwDb['password'];
                $data = password_verify($pw, $hashedPw) ? $MyUserConnect->dataConnect($email, $hashedPw) : false;

                if(!$data['error']){

                    $data['connexion'] = true;
                    $_SESSION['dataConnect'] = $data;

                    $_SESSION['jwt']['tokenJwt'] = tokenJwt($_SESSION['dataConnect']['pseudo'], $_SESSION['jwt']['secretKey'], $_SESSION['jwt']['delay']);
                
                    routeToHomePage();

                }else{

                    $data['id_User'] = 0;
                    $data['pseudo'] = "Guest";
                    $data['avatar'] = 'black_person.svg';
                    $data['type'] = "Guest";
                    $data['subscription'] = "Vénusia";
                    $data['message'] = $data['message'];
                    $data['connexion'] = false;

                    $_SESSION['dataConnect'] = $data;
                }

            }else{
                $_SESSION['message'] = $pwDb['message'];
            }

        }else{

            if($emptyEmail){

                $_SESSION['message'] = 'Le champ email est vide, veuillez saisir votre adresse email';

            }else{
                $_SESSION['message'] = 'Le champ mot de passe est vide, veuillez saisir votre mot de passe';
            }
            
            $data['id_user'] = 0;
            $data['pseudo'] = "Guest";
            $data['avatar'] = 'black_person.svg';
            $data['type'] = "Guest";
            $data['subscription'] = "Vénusia";
            $data['message'] = $data['message'];
            $data['connexion'] = false;

            $_SESSION['dataConnect'] = $data;

        }
    }
?>

