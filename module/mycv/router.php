<?php
    use Model\Utilities\Utilities;

    $page = isset($_GET['page']) ? Utilities::escapeInput($_GET['page']) : 'home';
    
    $_SESSION['token']['jwt']['tokenJwt'] = Utilities::tokenJwt($_SESSION['dataConnect']['pseudo'], $_SESSION['token']['jwt']['secretKey'], $_SESSION['token']['jwt']['delay']);
    
    if ($page === 'home'){

        require_once('view/mycv/home.php');

    }elseif($page === 'mycv'){

        require_once('view/mycv/myCv.php');

    }elseif($page === 'connexion'){

        require_once('view/common/connexion.php');

    }elseif($page === 'disconnect'){

        require_once('view/common/disconnect.php');

    }elseif ($page === 'userPwRequestNew'){
        
        //resetUserVarSession();
        require_once('view/common/userPwRequestNew.php');

    }elseif ($page === 'userPwResetNew'){
        
        //resetUserVarSession();
        require_once('view/common/userPwResetNew.php');

    }else {
        
        require_once('view/errorPage/unknownPage.php');
        
        /*resetDataConnectVarSession();
        require_once('errorPage/timeExpired.php');*/
    }

?>