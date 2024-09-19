<main>
    <?php
        //Routeur Garage PARROT
        require_once('../../common/utilies.php');

        if (isset($_POST['next']) || isset($_POST['previous'])){
            //require_once('../../garageparrot/controller/page.controller.php');
            require_once('../../controller/page.controller.php');
        }

        use \Firebase\JWT\JWT;
    
        $jwt1 = JWT::jsondecode($_SESSION['jwt']['tokenJwt']);
        $jwt2 = JWT::jsondecode(tokenJwt($_SESSION['dataConnect']['pseudo'], $_SESSION['jwt']['secretKey'], $_SESSION['jwt']['delay']));
    
        $page = isset($_GET['page']) ? escapeInput($_GET['page']) : 'home';
        
        if ($page === 'home'){

            resetVariableCar();
            resetVariableUser();
            resetVariablePage();
            $_SESSION['message'] = '';
            
            require_once 'view/home.php';

        }elseif ($page === 'connexion'){

            resetVariableCar();
            resetVariableUser();
            resetVariablePage();

            require_once '../view/connexion.php';

        }elseif ($page === 'disconnect'){

            resetVariableCar();
            resetVariableUser();
            resetVariablePage();
            $_SESSION['message'] = '';

            require_once '../view/disconnect.php';

        }elseif ($page === 'api'){

            require_once 'api/car.api.php';

        }elseif ($page === 'error_page'){

            resetVariableCar();
            resetVariableUser();
            resetVariablePage();
            $_SESSION['message'] = '';

            require_once 'error/error_access_page.php';

        }elseif ($page === 'error_unknown_page'){

            resetVariableCar();
            resetVariableUser();
            resetVariablePage();
            $_SESSION['message'] = '';

            require_once 'error/error_unknown_page.php';

        }elseif ($page === 'kanban'){

            resetVariableCar();
            resetVariableUser();
            resetVariablePage();
            $_SESSION['message'] = '';

            require_once 'view/kanban.php';

        }elseif ($page === 'mokup'){

            resetVariableCar();
            resetVariableUser();
            resetVariablePage();
            $_SESSION['message'] = '';

            require_once 'view/mokup.php';

        }elseif($page === 'car' || $page === 'carBtn' ){

            resetVariableUser();
            $_SESSION['message'] = '';

            if($_SESSION['dataConnect']['avatar'] === 'Administrator' || $_SESSION['dataConnect']['avatar'] === 'User'){
                
                include('../../garageparrot/module/searchCarAdmin.php');
                require_once 'view/car_admin.php';
                
                if($page === 'carBtn'){
                }

            }else{
                
                require_once 'view/car.php';

            }

        }else if($jwt2->{'delay'} - $jwt1->{'delay'} <= $_SESSION['jwt']['delay']){

            if($jwt2->{'key'} === $jwt1->{'key'}){

                if($jwt2->{'pseudo'} === $jwt1->{'pseudo'}){

                    $_SESSION['jwt']['tokenJwt'] = tokenJwt($_SESSION['dataConnect']['pseudo'], $_SESSION['jwt']['secretKey'], $_SESSION['jwt']['delay']);
                
                    if ($page === 'car_edit'){

                        resetVariableCar();
                        resetVariableUser();
                        resetVariablePage();
                        $_SESSION['message'] = '';

                        if($_SESSION['dataConnect']['avatar'] === 'Administrator' || $_SESSION['dataConnect']['avatar'] === 'User'){
                            
                            require_once 'view/car_edit.php';

                        }else{
                            
                            pageUnavailable();

                        }

                    }elseif ($page === 'user' || $page === 'userBtn'){

                        resetVariableCar();
                        $_SESSION['message'] = '';
                        
                        if($_SESSION['dataConnect']['avatar'] === 'Administrator'){

                            //require_once('../../garageparrot/module/searchUser.php');
                            require_once('../../module/searchUser.php');
                            require_once 'view/user.php';

                            if($page === 'userBtn'){
                            }
                        
                        }else{
                            
                            pageUnavailable();

                        }

                    }elseif ($page === 'user_edit'){

                        resetVariableCar();
                        resetVariableUser();
                        resetVariablePage();
                        $_SESSION['message'] = '';

                        if($_SESSION['dataConnect']['avatar'] === 'Administrator'){
                            
                            require_once 'view/user_edit.php';

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

            $dataConnect = array(); settype($dataConnect, 'array');
            $dataConnect['idUser'] = 0;
            $dataConnect['pseudo'] = 'Guest';
            $dataConnect['avatar'] = 'black_person.svg';
            $dataConnect['type'] = 'Guest';
            $dataConnect['subscription'] = 'Vénusia';
            $dataConnect['password'] = '';
            $dataConnect['error'] = false;
            $dataConnect['message'] = '';
            $dataConnect['connexion'] = false;
    
            $_SESSION['dataConnect'] = $dataConnect;
            
            timeExpired();
    
        }else {

            resetVariableCar();
            resetVariableUser();
            resetVariablePage();
            $_SESSION['message'] = '';

            //require_once 'error/error_unknown_page.php';

        }

        $_SESSION['pagination']['NextOrPrevious'] = false;

        
    ?>
</main>