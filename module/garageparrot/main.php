<?php
    
    require_once('../model/common/utilities.class.php');
    
    use \Firebase\JWT\JWT;
    use MyCv\Model\Utilities;

    $jwt1 = JWT::jsondecode($_SESSION['token']['jwt']['tokenJwt']);
    $jwt2 = JWT::jsondecode(Utilities::tokenJwt($_SESSION['dataConnect']['pseudo'], $_SESSION['token']['jwt']['secretKey'], $_SESSION['token']['jwt']['delay']));

    $page = isset($_GET['page']) ? Utilities::escapeInput($_GET['page']) : 'home';
    
    if ($page === 'home'){

        //resetUserVarSession();
        resetCarVarSession();
        resetPageVarSession();

        $_SESSION['other']['message'] = '';
        
        require_once 'view/garageparrot/home.php';

    }elseif ($page === 'connexion'){
        
        resetUserVarSession();
        resetCarVarSession();
        resetPageVarSession();

        $_SESSION['other']['message'] = '';

        require_once 'view/common/connexion.php';

    }elseif ($page === 'disconnect'){
        
        resetUserVarSession();
        resetCarVarSession();
        resetPageVarSession();

        $_SESSION['other']['message'] = '';

        require_once 'view/common/disconnect.php';

    }elseif ($page === 'api'){

        require_once '../api/garageparrot/car.api.php';

    }elseif ($page === 'accessPage'){
        
        resetUserVarSession();
        resetCarVarSession();
        resetPageVarSession();

        $_SESSION['other']['message'] = '';

        require_once('view/errorPage/accessPage.php');

    }elseif ($page === 'unknownPage'){
        
        resetUserVarSession();
        resetCarVarSession();
        resetPageVarSession();

        $_SESSION['other']['message'] = '';

        require_once('view/errorPage/unknownPage.php');

    }elseif ($page === 'kanban'){
        
        resetUserVarSession();
        resetCarVarSession();
        resetPageVarSession();

        $_SESSION['other']['message'] = '';

        require_once 'view/garageparrot/kanban.php';

    }elseif ($page === 'mokup'){
        
        resetUserVarSession();
        resetCarVarSession();
        resetPageVarSession();

        $_SESSION['other']['message'] = '';

        require_once 'view/garageparrot/mokup.php';

    }elseif($page === 'car'){
        
        //resetUserVarSession();

        $_SESSION['other']['message'] = '';

        if($_SESSION['dataConnect']['type'] === 'Administrator' || $_SESSION['dataConnect']['type'] === 'User'){
            
            require_once('view/garageparrot/car_admin.php');

        }else{
            require_once('view/garageparrot/car.php');
        }

    }elseif($jwt2->{'delay'} - $jwt1->{'delay'} <= $_SESSION['token']['jwt']['delay']){

        if($jwt2->{'key'} === $jwt1->{'key'}){

            if($jwt2->{'pseudo'} === $jwt1->{'pseudo'}){

                $_SESSION['token']['jwt']['tokenJwt'] = Utilities::tokenJwt($_SESSION['dataConnect']['pseudo'], $_SESSION['token']['jwt']['secretKey'], $_SESSION['token']['jwt']['delay']);
            
                if ($page === 'carEdit'){

                    resetPageVarSession();

                    $_SESSION['other']['message'] = '';

                    if($_SESSION['dataConnect']['type'] === 'Administrator' || $_SESSION['dataConnect']['type'] === 'User'){
                        
                        require_once('view/garageparrot/car_edit.php');

                    }else{
                        require_once('view/errorPage/accessPage.php');
                    }
                }elseif ($page === 'user'){

                    resetCarVarSession();
                    $_SESSION['other']['message'] = '';
                    
                    if($_SESSION['dataConnect']['type'] === 'Administrator'){

                        require_once('view/common/user.php');
                    
                    }else{
                        require_once('view/errorPage/accessPage.php');
                    }
                }elseif ($page === 'userEdit'){
        
                    resetCarVarSession();            
                    resetPageVarSession();

                    $_SESSION['other']['message'] = '';

                    if($_SESSION['dataConnect']['type'] === 'Administrator'){
                        
                        require_once('view/common/userEdit.php');

                    }else{
                        require_once('view/errorPage/accessPage.php');
                    }
                }else{

                    resetUserVarSession();
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