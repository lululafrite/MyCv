<?php
    
    $current_url = $_SERVER['REQUEST_URI'];
    $goldorak = '/goldorak/';
    $garageParrot = '/garageparrot/';
    $timeExpired = '/timeExpired/';

    if((preg_match($goldorak, $current_url) || preg_match($garageParrot, $current_url)) && !preg_match($timeExpired, $current_url)){
    
            require_once('../../model/utilities.class.php');
            require_once '../../module/variable.php';
    
    }else if(!preg_match($timeExpired, $current_url)){

            require_once('../model/utilities.class.php');
            require_once '../module/variable.php';
    }

    use MyCv\Model\Utilities;

    resetDataConnectVarSession();
    resetUserVarSession();

    $_SESSION['token']['jwt']['tokenJwt'] = Utilities::tokenJwt($_SESSION['dataConnect']['pseudo'], $_SESSION['token']['jwt']['secretKey'], $_SESSION['token']['jwt']['delay']);
    
    Utilities::redirectToPage("home");
    
?>
