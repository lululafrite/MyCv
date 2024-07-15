<main>
    <?php
        //Routeur Garage PARROT
        include_once('../../common/utilies.php');

        if (isset($_POST['next']) || isset($_POST['previous'])){
            include_once('../../garageparrot/controller/page.controller.php');
        }

        use \Firebase\JWT\JWT;
    
        $jwt1 = JWT::jsondecode($_SESSION['jwt']);
        $jwt2 = JWT::jsondecode(tokenJwt($_SESSION['pseudoConnect'], $_SESSION['SECRET_KEY']));
    
        $page = isset($_GET['page']) ? escapeInput($_GET['page']) : 'home';
        
        if ($page === 'home'){

            resetVariableCar();
            resetVariableUser();
            resetVariablePage();
            $_SESSION['message'] = '';
            
            include_once 'view/home.php';

        }elseif ($page === 'connexion'){

            resetVariableCar();
            resetVariableUser();
            resetVariablePage();

            include_once '../view/connexion.php';

        }elseif ($page === 'disconnect'){

            resetVariableCar();
            resetVariableUser();
            resetVariablePage();
            $_SESSION['message'] = '';

            include_once 'view/disconnect.php';

        }elseif ($page === 'api'){

            include_once 'view/car.api.php';

        }elseif ($page === 'error_page'){

            resetVariableCar();
            resetVariableUser();
            resetVariablePage();
            $_SESSION['message'] = '';

            include_once 'error/error_access_page.php';

        }elseif ($page === 'error_unknown_page'){

            resetVariableCar();
            resetVariableUser();
            resetVariablePage();
            $_SESSION['message'] = '';

            include_once 'error/error_unknown_page.php';

        }elseif ($page === 'kanban'){

            resetVariableCar();
            resetVariableUser();
            resetVariablePage();
            $_SESSION['message'] = '';

            include_once 'view/kanban.php';

        }elseif ($page === 'mokup'){

            resetVariableCar();
            resetVariableUser();
            resetVariablePage();
            $_SESSION['message'] = '';

            include_once 'view/mokup.php';

        }elseif($page === 'car' || $page === 'carBtn' ){

            resetVariableUser();
            $_SESSION['message'] = '';

            if($_SESSION['typeConnect'] === 'Administrator' || $_SESSION['typeConnect'] === 'User'){
                
                include('../../garageparrot/module/searchCarAdmin.php');
                include_once 'view/car_admin.php';
                
                if($page === 'carBtn'){
                }

            }else{
                
                include_once 'view/car.php';

            }

        }else if($jwt2->{'delay'} - $jwt1->{'delay'} <= $_SESSION['delay']){

            if($jwt2->{'key'} === $jwt1->{'key'}){

                if($jwt2->{'user_pseudo'} === $jwt1->{'user_pseudo'}){
                
                    if ($page === 'car_edit'){

                        resetVariableCar();
                        resetVariableUser();
                        resetVariablePage();
                        $_SESSION['message'] = '';

                        if($_SESSION['typeConnect'] === 'Administrator' || $_SESSION['typeConnect'] === 'User'){
                            
                            include_once 'view/car_edit.php';

                        }else{
                            
                            pageUnavailable();

                        }

                    }elseif ($page === 'user' || $page === 'userBtn'){

                        resetVariableCar();
                        $_SESSION['message'] = '';
                        
                        if($_SESSION['typeConnect'] === 'Administrator'){

                            include_once('../../garageparrot/module/searchUser.php');
                            include_once 'view/user.php';

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

                        if($_SESSION['typeConnect'] === 'Administrator'){
                            
                            include_once 'view/user_edit.php';

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

            resetVariableCar();
            resetVariableUser();
            resetVariablePage();
            $_SESSION['message'] = '';

            //include_once 'error/error_unknown_page.php';

        }

        $_SESSION['NextOrPrevious'] = false;

        
    ?>
</main>