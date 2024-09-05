<?php

use MyCv\Model\UserConnect;
use Goldorak\Model\UserConnect as GoldorakUserConnect  ;
use GarageParrot\Model\UserConnect as GarageParrotUserConnect  ;

if (isset($_POST['envoyer'])){

    $current_url = $_SERVER['REQUEST_URI'];
    $goldorak = '/goldorak/';
    $garageParrot = '/garageparrot/';

    if(preg_match($goldorak, $current_url)){
        
        require_once('../../goldorak/model/connexion.class.php');
        require_once('../../common/utilies.php');
        $MyUserConnect = new GoldorakUserConnect();

    }else if(preg_match($garageParrot, $current_url)){

        require_once('../../garageparrot/model/connexion.class.php');
        require_once('../../common/utilies.php');
        $MyUserConnect = new GarageParrotUserConnect();

    }else{

        require_once('../model/connexion.class.php');
        require_once('../common/utilies.php');
        $MyUserConnect = new UserConnect();

    }


    $emptyCell = false;
    $emptyEmail = false;
    $email = '';
    $pw = '';

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
    
    $hashedPassword = password_hash($pw, PASSWORD_DEFAULT);

    if (!$emptyCell) {

        try {
            
            $pwDb = ""; settype($pwDb, "string");
            $hashedPw = ""; settype($hashedPw, "string");
            $data = ""; settype($data, "array");

            $pwDb = $MyUserConnect->getPw($email); 
            
            if($pwDb){

                $hashedPw = $pwDb['password'];
                $data = password_verify($pw, $hashedPw) ? $MyUserConnect->queryConnect($email, $hashedPw) : false;

                if ($data) {

                    $_SESSION['typeConnect'] = $data['type'];
                    $_SESSION['pseudoConnect'] = $data['pseudo'];
                    $_SESSION['avatarConnect'] = $data['avatar'];
                    
                    if(preg_match($goldorak, $current_url)){
                        $_SESSION['subscriptionConnect'] = $data['subscription'];
                    }
                    $_SESSION['connexion'] = true;

                    $_SESSION['jwt'] = tokenJwt($_SESSION['pseudoConnect'], $_SESSION['SECRET_KEY']);


                    if(preg_match($goldorak, $current_url)){
                
                        routeToHomePageGoldorak();
                
                    }if(preg_match($garageParrot, $current_url)){
                
                        routeToHomePageGarageParrot();
                
                    }else{
                
                        routeToHomePage();
                
                    }

                } else {

                    $_SESSION['pseudoConnect'] = "Guest";
                    $_SESSION['typeConnect'] = "Guest";
                    $_SESSION['subscriptionConnect'] = "Vénusia";
                    $_SESSION['avatarConnect'] = 'black_person.svg';
                    $_SESSION['connexion'] = false;
                    $_SESSION['subscription'] = "Vénusia";

                    $_SESSION['message'] = "Le mot de passe est incorrecte!";

                }

            }else{

                $_SESSION['message'] = "L'identifiant que vous avez saisi n'existe pas!";

            }

            

        } catch (PDOException $e) {

            $_SESSION['message'] = "error in the query : " . $e->getMessage();

            $_SESSION['pseudoConnect'] = "Guest";
            $_SESSION['typeConnect'] = "Guest";
            $_SESSION['subscriptionConnect'] = "Vénusia";
            $_SESSION['avatarConnect'] = 'black_person.svg';
            $_SESSION['connexion'] = false;
            $_SESSION['subscription'] = "Vénusia";
        }

    } else {

        if ($emptyEmail) {

            $_SESSION['message'] = 'Le champ email est vide, veuillez saisir votre adresse email';

        } else {

            $_SESSION['message'] = 'Le champ mot de passe est vide, veuillez saisir votre mot de passe';

        }

        $_SESSION['pseudoConnect'] = "Guest";
        $_SESSION['typeConnect'] = "Guest";
        $_SESSION['subscriptionConnect'] = "Vénusia";
        $_SESSION['avatarConnect'] = 'black_person.svg';
        $_SESSION['connexion'] = false;
        $_SESSION['subscription'] = "Vénusia";

    }

}

?>

