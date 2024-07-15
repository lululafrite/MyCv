<?php

    include_once '../common/utilies.php';

    $page = isset($_GET['page']) ? escapeInput($_GET['page']) : 'home';

    
    if ($page === 'home'){

        include_once('view/home.php');

    }elseif($page === 'mycv'){

        include_once 'view/myCv.php';

    }elseif($page === 'connexion'){

        include_once 'view/connexion.php';

    }elseif($page === 'disconnect'){

        include_once 'view/disconnect.php';

    }elseif ($page === 'accessPage'){
        
        include_once 'errorPage/accessPage.php';

    }elseif ($page === 'unknownPage'){

        include_once 'errorPage/unknownPage.php';

    }elseif($page === ''){

        include_once 'errorPage/unknownPage.php';

    }elseif(is_null($page)){
        
        include_once 'errorPage/unknownPage.php';

    }elseif(empty($page)){
        
        include_once 'errorPage/unknownPage.php';

    }else {
        
        include_once 'errorPage/unknownPage.php';

    }

?>