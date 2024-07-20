<?php
    //Routeur Goldorak
    require_once '../../common/utilies.php'; // Fonctions communes
    
    use \Firebase\JWT\JWT;
    
    $jwt1 = JWT::jsondecode($_SESSION['jwt']);
    $jwt2 = JWT::jsondecode(tokenJwt($_SESSION['pseudoConnect'], $_SESSION['SECRET_KEY']));

    $page = isset($_GET['page']) ? escapeInput($_GET['page']) : 'home';
    
    if ($page === 'home'){

        resetVariableGoldorak();
        //require_once('./public/goldorak/view/home.php');
        require_once('view/home.php');

    }elseif($page === 'events'){
        
        resetVariableGoldorak();
        require_once 'view/events.php';

    }elseif ($page === 'adherer'){
        
        resetVariableGoldorak();
        require_once 'view/adherer.php';

    }elseif ($page === 'connexion'){
        
        resetVariableGoldorak();
        require_once '../view/connexion.php';

    }elseif ($page === 'disconnect'){
        
        resetVariableGoldorak();

        if($_SESSION['typeConnect'] != "Guest"){
            require_once 'view/disconnect.php';
        }else{
            pageUnavailable();
        }

    }elseif ($page === 'accessPage'){
        
        resetVariableGoldorak();
        require_once 'errorPage/accessPage.php';

    }elseif ($page === 'unknownPage'){
        
        resetVariableGoldorak();
        require_once 'errorPage/unknownPage.php';

    }elseif ($page === 'timeExpired'){
        
        resetVariableGoldorak();
        require_once 'errorPage/timeExpired.php';

    }elseif($page === ''){
        
        resetVariableGoldorak();
        require_once 'errorPage/unknownPage.php';

    }elseif(is_null($page)){
        
        resetVariableGoldorak();
        require_once 'errorPage/unknownPage.php';

    }elseif(empty($page)){
        
        resetVariableGoldorak();
        require_once 'errorPage/unknownPage.php';

    }
    
    if($jwt2->{'delay'} - $jwt1->{'delay'} <= $_SESSION['delay']){

        if($jwt2->{'key'} === $jwt1->{'key'}){

            if($jwt2->{'user_pseudo'} === $jwt1->{'user_pseudo'}){

                if ($page === 'user'){
        
                    resetVariableGoldorak();

                    if($_SESSION['typeConnect'] === "Administrator"){

                        require_once 'view/user.php';

                    }else{

                        pageUnavailable();

                    }

                }elseif ($page === 'userEdit'){

                    $_SESSION['updateMoncompte'] = false;
                    //$_SESSION['btn_monCompte'] = false;
                    //$_SESSION['newUser'] = false;
                    require_once 'view/userEdit.php';

                }elseif($page === 'media'){
        
                    resetVariableGoldorak();

                    if($_SESSION['typeConnect'] != "Guest"){

                        require_once 'view/media.php';

                    }else{

                        pageUnavailable();

                    }

                }elseif ($page === 'commander'){
        
                    resetVariableGoldorak();

                    if($_SESSION['subscriptionConnect'] === "Goldorak" ){

                        require_once 'view/commander.php';

                    }else{

                        pageUnavailable();

                    }

                }elseif ($page === 'goldorakgo'){
        
                    resetVariableGoldorak();

                    if($_SESSION['subscriptionConnect'] != "Vénusia" ){

                        require_once 'view/goldorakgo.php';

                    }else{

                        pageUnavailable();

                    }

                }
            }else{

                echo("<script>alert('Le Pseudo JWT n'est pas correcte')</script>");
                
            }

        }else{

            echo("<script>alert('Le token JWT n'est pas correcte')</script>");
            
        }

    }else if($_SESSION['pseudoConnect'] != 'Guest'){

        $_SESSION['typeConnect'] = 'Guest';
        $_SESSION['pseudoConnect'] = 'Guest';
        $_SESSION['avatarConnect'] = 'black_person.svg';
        $_SESSION['subscriptionConnect'] = 'Vénusia';
        $_SESSION['connexion'] = false;
        
        timeExpired();

    }else {
        
        resetVariableGoldorak();
        
        //require_once 'errorPage/unknownPage.php';
        //timeExpired();
    }

?>