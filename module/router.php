<?php

    require_once '../common/utilies.php';

    $page = isset($_GET['page']) ? escapeInput($_GET['page']) : 'home';
    
    $_SESSION['jwt']['tokenJwt'] = tokenJwt($_SESSION['dataConnect']['pseudo'], $_SESSION['jwt']['secretKey'], $_SESSION['jwt']['delay']);
    
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