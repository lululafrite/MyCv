<?php

    $checkUrl = preg_match('/goldorak/', $_SERVER['REQUEST_URI']) || preg_match('/garageparrot/', $_SERVER['REQUEST_URI']);
    if($checkUrl){
        require_once('../../model/utilities.class.php');

    }else{
        require_once('../model/utilities.class.php');
    }

    use MyCv\Model\Utilities;

    $page = isset($_GET['page']) ? Utilities::escapeInput($_GET['page']) : 'home';
    
    $_SESSION['token']['jwt']['tokenJwt'] = Utilities::tokenJwt($_SESSION['dataConnect']['pseudo'], $_SESSION['token']['jwt']['secretKey'], $_SESSION['token']['jwt']['delay']);
    
    if ($page === 'home'){

        require_once('view/home.php');

    }elseif($page === 'mycv'){

        require_once 'view/myCv.php';

    }elseif($page === 'draganddrop'){

        require_once 'view/dragAndDrop.php';

    }elseif($page === 'connexion'){

        require_once 'view/connexion.php';

    }elseif($page === 'disconnect'){

        require_once 'view/disconnect.php';

    }elseif ($page === 'accessPage'){
        
        require_once 'errorPage/accessPage.php';

    }elseif ($page === 'unknownPage'){

        require_once 'errorPage/unknownPage.php';

    }elseif($page === ''){

        require_once 'errorPage/unknownPage.php';

    }elseif(is_null($page)){
        
        require_once 'errorPage/unknownPage.php';

    }elseif(empty($page)){
        
        require_once 'errorPage/unknownPage.php';

    }else {
        
        require_once 'errorPage/unknownPage.php';

    }

?>