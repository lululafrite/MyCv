<!--<main> -->
    <?php

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
            resetCarVarSession();
            
            resetPageVarSession();
            $_SESSION['other']['message'] = '';
            
            require_once 'view/home.php';

        }elseif ($page === 'connexion'){
            
            resetUserVarSession();
            resetCarVarSession();
            
            resetPageVarSession();

            require_once '../view/connexion.php';

        }elseif ($page === 'disconnect'){
            
            resetUserVarSession();
            resetCarVarSession();
            
            resetPageVarSession();
            $_SESSION['other']['message'] = '';

            require_once '../view/disconnect.php';

        }elseif ($page === 'api'){

            require_once 'api/car.api.php';

        }elseif ($page === 'error_page'){
            
            resetUserVarSession();
            resetCarVarSession();
            
            resetPageVarSession();
            $_SESSION['other']['message'] = '';

            require_once 'error/error_access_page.php';

        }elseif ($page === 'error_unknown_page'){
            
            resetUserVarSession();
            resetCarVarSession();
            
            resetPageVarSession();
            $_SESSION['other']['message'] = '';

            require_once 'error/error_unknown_page.php';

        }elseif ($page === 'kanban'){
            
            resetUserVarSession();
            resetCarVarSession();
            
            resetPageVarSession();
            $_SESSION['other']['message'] = '';

            require_once 'view/kanban.php';

        }elseif ($page === 'mokup'){
            
            resetUserVarSession();
            resetCarVarSession();
            
            resetPageVarSession();
            $_SESSION['other']['message'] = '';

            require_once 'view/mokup.php';

        }elseif($page === 'car'){ //|| $page === 'carBtn' ){
            
            resetUserVarSession();

            $_SESSION['other']['message'] = '';

            if($_SESSION['dataConnect']['type'] === 'Administrator' || $_SESSION['dataConnect']['type'] === 'User'){
                
                require_once('view/car_admin.php');
                
                if($page === 'car'){
                }

            }else{
                
                require_once 'view/car.php';

            }

        }else if($jwt2->{'delay'} - $jwt1->{'delay'} <= $_SESSION['token']['jwt']['delay']){

            if($jwt2->{'key'} === $jwt1->{'key'}){

                if($jwt2->{'pseudo'} === $jwt1->{'pseudo'}){

                    $_SESSION['token']['jwt']['tokenJwt'] = Utilities::tokenJwt($_SESSION['dataConnect']['pseudo'], $_SESSION['token']['jwt']['secretKey'], $_SESSION['token']['jwt']['delay']);
                
                    if ($page === 'carEdit'){
            
                        resetUserVarSession();
                        resetCarVarSession();
                        
                        resetPageVarSession();
                        $_SESSION['other']['message'] = '';

                        if($_SESSION['dataConnect']['type'] === 'Administrator' || $_SESSION['dataConnect']['type'] === 'User'){
                            
                            require_once 'view/carEdit.php';

                        }else{
                            
                            pageUnavailable();

                        }

                    }elseif ($page === 'user'){ // || $page === 'userBtn'){

                        resetCarVarSession();
                        $_SESSION['other']['message'] = '';
                        
                        if($_SESSION['dataConnect']['type'] === 'Administrator'){

                            //require_once('../../module/searchUser.php');
                            require_once('../view/user.php');

                            if($page === 'userBtn'){
                            }
                        
                        }else{
                            
                            pageUnavailable();

                        }

                    }elseif ($page === 'userEdit'){
            
                        resetUserVarSession();
                        resetCarVarSession();
                        
                        resetPageVarSession();
                        $_SESSION['other']['message'] = '';

                        if($_SESSION['dataConnect']['type'] === 'Administrator'){
                            
                            require_once('../view/userEdit.php');

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

            resetDataConnectVarSession();
            timeExpired();
    
        }else {
            
            resetUserVarSession();
            resetCarVarSession();

            resetPageVarSession();
            $_SESSION['other']['message'] = '';

            //require_once 'error/error_unknown_page.php';

        }

        $_SESSION['pagination']['NextOrPrevious'] = false;

        
    ?>
<!--</main> -->