<?php
    //Routeur Goldorak
    require_once('../model/utilities.class.php');
    require_once('../controller/page.controller.php');
    
    use \Firebase\JWT\JWT;
    use MyCv\Model\Utilities;
    
    $jwt1 = JWT::jsondecode($_SESSION['token']['jwt']['tokenJwt']);
    $jwt2 = JWT::jsondecode(Utilities::tokenJwt($_SESSION['dataConnect']['pseudo'], $_SESSION['token']['jwt']['secretKey'], $_SESSION['token']['jwt']['delay']));

    $page = isset($_GET['page']) ? Utilities::escapeInput($_GET['page']) : 'home';
    
    if ($page === 'home'){

        //resetUserVarSession();
        require_once('view/goldorak/home.php');

    }elseif($page === 'events'){
        
        //resetUserVarSession();
        require_once 'view/goldorak/events.php';

    }elseif ($page === 'adherer'){
        
        //resetUserVarSession();
        require_once 'view/goldorak/adherer.php';

    }elseif ($page === 'connexion'){
        
        //resetUserVarSession();
        require_once('view/connexion.php');

    }elseif ($page === 'disconnect'){
        
        //resetUserVarSession();

        if($_SESSION['dataConnect']['type'] != "Guest"){
            require_once 'view/disconnect.php';
        }else{
            require_once 'view/errorPage/accessPage.php';
        }

    }elseif ($page === 'accessPage'){
        
        //resetUserVarSession();
        require_once 'view/errorPage/accessPage.php';

    }elseif ($page === 'unknownPage'){
        
        //resetUserVarSession();
        require_once 'view/errorPage/unknownPage.php';

    }elseif ($page === 'timeExpired'){
        
        //resetUserVarSession();
        require_once 'view/errorPage/timeExpired.php';

    }else if($jwt2->{'delay'} - $jwt1->{'delay'} < $_SESSION['token']['jwt']['delay']){

        if($jwt2->{'key'} === $jwt1->{'key'}){

            if($jwt2->{'pseudo'} === $jwt1->{'pseudo'}){

                $_SESSION['token']['jwt']['tokenJwt'] = Utilities::tokenJwt($_SESSION['dataConnect']['pseudo'], $_SESSION['token']['jwt']['secretKey'], $_SESSION['token']['jwt']['delay']);

                if ($page === 'user'){

                    resetCarVarSession();
                    $_SESSION['other']['message'] = '';
                    
                    if($_SESSION['dataConnect']['type'] === 'Administrator'){

                        require_once('view/user.php');
                    
                    }else{
                        require_once('view/errorPage/accessPage.php');
                    }

                }elseif ($page === 'userEdit'){
        
                    resetCarVarSession();            
                    resetPageVarSession();

                    $_SESSION['other']['message'] = '';

                    if($_SESSION['dataConnect']['type'] === 'Administrator'){
                        
                        require_once('view/userEdit.php');

                    }else{
                        require_once('view/errorPage/accessPage.php');
                    }

                }elseif($page === 'media'){
        
                    //resetUserVarSession();

                    if($_SESSION['dataConnect']['type'] != "Guest"){

                        require_once 'view/goldorak/media.php';

                    }else{

                        require_once('view/errorPage/accessPage.php');

                    }

                }elseif ($page === 'commander'){
        
                    //resetUserVarSession();

                    if($_SESSION['dataConnect']['subscription'] === "Goldorak" ){

                        require_once 'view/goldorak/commander.php';

                    }else{

                        require_once('view/errorPage/accessPage.php');

                    }

                }elseif ($page === 'goldorakgo'){
        
                    //resetUserVarSession();

                    if($_SESSION['dataConnect']['subscription'] != "Vénusia" ){

                        require_once 'view/goldorak/goldorakgo.php';

                    }else{

                        require_once('view/errorPage/accessPage.php');

                    }

                }else{

                    //resetUserVarSession();
                    resetCarVarSession();
                    resetPageVarSession();

                    $_SESSION['other']['message'] = '';

                    require_once('view/errorPage/unknownPage.php');

                    /*resetDataConnectVarSession();
                    require_once('view/errorPage/timeExpired.php');*/
                }

            }else{

                echo("<script>alert('Le Pseudo JWT n'est pas correcte')</script>");
                
            }

        }else{

            echo("<script>alert('Le token JWT n'est pas correcte')</script>");
            
        }

    }elseif($_SESSION['dataConnect']['pseudo'] != 'Guest'){

        resetUserVarSession();
        resetCarVarSession();
        resetPageVarSession();

        resetDataConnectVarSession();

        require_once('view/errorPage/timeExpired.php');
    }

?>