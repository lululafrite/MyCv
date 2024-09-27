<?php
    //Routeur Goldorak
    $checkUrl = preg_match('/goldorak/', $_SERVER['REQUEST_URI']) || preg_match('/garageparrot/', $_SERVER['REQUEST_URI']);
    if($checkUrl){
        require_once('../../model/utilities.class.php');
        require_once('../../controller/page.controller.php');
    }else{
        require_once('../model/utilities.class.php');
        require_once('../controller/page.controller.php');
    }
    
    use \Firebase\JWT\JWT;
    use MyCv\Model\Utilities;
    
    $jwt1 = JWT::jsondecode($_SESSION['token']['jwt']['tokenJwt']);
    $jwt2 = JWT::jsondecode(Utilities::tokenJwt($_SESSION['dataConnect']['pseudo'], $_SESSION['token']['jwt']['secretKey'], $_SESSION['token']['jwt']['delay']));

    $page = isset($_GET['page']) ? Utilities::escapeInput($_GET['page']) : 'home';
    
    if ($page === 'home'){

        resetUserVarSession();
        require_once('view/home.php');

    }elseif($page === 'events'){
        
        resetUserVarSession();
        require_once 'view/events.php';

    }elseif ($page === 'adherer'){
        
        resetUserVarSession();
        require_once 'view/adherer.php';

    }elseif ($page === 'connexion'){
        
        resetUserVarSession();
        require_once '../view/connexion.php';

    }elseif ($page === 'disconnect'){
        
        resetUserVarSession();

        if($_SESSION['dataConnect']['type'] != "Guest"){
            require_once '../view/disconnect.php';
        }else{
            pageUnavailable();
        }

    }elseif ($page === 'accessPage'){
        
        resetUserVarSession();
        require_once 'errorPage/accessPage.php';

    }elseif ($page === 'unknownPage'){
        
        resetUserVarSession();
        require_once 'errorPage/unknownPage.php';

    }elseif ($page === 'timeExpired'){
        
        resetUserVarSession();
        require_once 'errorPage/timeExpired.php';

    }elseif($page === ''){
        
        resetUserVarSession();
        require_once 'errorPage/unknownPage.php';

    }elseif(is_null($page)){
        
        resetUserVarSession();
        require_once 'errorPage/unknownPage.php';

    }elseif(empty($page)){
        
        resetUserVarSession();
        require_once 'errorPage/unknownPage.php';

    }
    
    if($jwt2->{'delay'} - $jwt1->{'delay'} < $_SESSION['token']['jwt']['delay']){

        if($jwt2->{'key'} === $jwt1->{'key'}){

            if($jwt2->{'pseudo'} === $jwt1->{'pseudo'}){

                $_SESSION['token']['jwt']['tokenJwt'] = Utilities::tokenJwt($_SESSION['dataConnect']['pseudo'], $_SESSION['token']['jwt']['secretKey'], $_SESSION['token']['jwt']['delay']);

                if ($page === 'user'){
        
                    //resetUserVarSession();

                    if($_SESSION['dataConnect']['type'] === "Administrator"){

                        require_once '../view/user.php';

                    }else{

                        pageUnavailable();

                    }

                }elseif ($page === 'userEdit'){

                    require_once('../view/userEdit.php'); //'../view/userEdit.php';

                }elseif($page === 'media'){
        
                    resetUserVarSession();

                    if($_SESSION['dataConnect']['type'] != "Guest"){

                        require_once 'view/media.php';

                    }else{

                        pageUnavailable();

                    }

                }elseif ($page === 'commander'){
        
                    resetUserVarSession();

                    if($_SESSION['dataConnect']['subscription'] === "Goldorak" ){

                        require_once 'view/commander.php';

                    }else{

                        pageUnavailable();

                    }

                }elseif ($page === 'goldorakgo'){
        
                    resetUserVarSession();

                    if($_SESSION['dataConnect']['subscription'] != "Vénusia" ){

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

    }else if($_SESSION['dataConnect']['pseudo'] != 'Guest'){

        /*$_SESSION['dataConnect']['type'] = 'Guest';
        $_SESSION['dataConnect']['pseudo'] = 'Guest';
        $_SESSION['dataConnect']['avatar'] = 'black_person.svg';
        $_SESSION['dataConnect']['subscription'] = 'Vénusia';
        $_SESSION['dataConnect']['connexion'] = false;*/
        resetDataConnectVarSession();
        timeExpired();

    }else{
        
        //resetUserVarSession();
        
        //require_once 'errorPage/unknownPage.php';
        //timeExpired();
    }

?>