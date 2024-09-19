<?php
    
    $current_url = $_SERVER['REQUEST_URI'];
    $goldorak = '/goldorak/';
    $garageParrot = '/garageparrot/';
    $timeExpired = '/timeExpired/';

    if((preg_match($goldorak, $current_url) || preg_match($garageParrot, $current_url)) && !preg_match($timeExpired, $current_url)){
    
            require_once '../../common/utilies.php';
            require_once '../../module/variable.php';
    
    }else if(!preg_match($timeExpired, $current_url)){

            require_once '../common/utilies.php';
            require_once '../module/variable.php';
    }
    
    resetDataConnectVarSession();
    resetUserVarSession();

    $_SESSION['jwt']['tokenJwt'] = tokenJwt($_SESSION['dataConnect']['pseudo'], $_SESSION['jwt']['secretKey'], $_SESSION['jwt']['delay']);
    
    routeToHomePage();
    
?>
