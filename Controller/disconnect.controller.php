<?php
    
    $data = array(); settype($data, 'array');
    $data['id_user'] = 0;
    $data['pseudo'] = "Guest";
    $data['avatar'] = 'black_person.svg';
    $data['type'] = "Guest";
    $data['subscription'] = "Vénusia";
    $data['message'] = "";
    $data['connexion'] = false;

    $_SESSION['dataConnect'] = $data;
    
    //require_once '../common/utilies.php';

    $_SESSION['jwt']['tokenJwt'] = tokenJwt($_SESSION['dataConnect']['pseudo'], $_SESSION['jwt']['secretKey'], $_SESSION['jwt']['delay']);
    
    $current_url = $_SERVER['REQUEST_URI'];
    $goldorak = '/goldorak/';
    $garageParrot = '/garageparrot/';
    $timeExpired = '/timeExpired/';

    if(preg_match($goldorak, $current_url) && !preg_match($timeExpired, $current_url)){

        require_once '../../common/utilies.php';
        routeToHomePageGoldorak();

    }else if(preg_match($garageParrot, $current_url) && !preg_match($timeExpired, $current_url)){

        require_once '../../common/utilies.php';
        routeToHomePageGarageParrot();

    }else if(!preg_match($timeExpired, $current_url)){

        require_once '../common/utilies.php';
        routeToHomePage();

    }
    
?>
