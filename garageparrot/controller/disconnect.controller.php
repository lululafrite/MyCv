<?php
    
    $_SESSION['pseudoConnect'] = "Guest";
    $_SESSION['typeConnect'] = "Guest";
    $_SESSION['subscriptionConnect'] = "Vénusia";
    $_SESSION['avatarConnect'] = 'black_person.svg';
    $_SESSION['connexion'] = false;
    
    include_once '../../common/utilies.php';

    $_SESSION['jwt'] = tokenJwt($_SESSION['pseudoConnect'], $_SESSION['SECRET_KEY']);
    
    $current_url = $_SERVER['REQUEST_URI'];
    $goldorak = '/goldorak/';
    $garageParrot = '/garageparrot/';
    $timeExpired = '/timeExpired/';

    if(preg_match($goldorak, $current_url) && !preg_match($timeExpired, $current_url)){

        routeToHomePageGoldorak();

    }else if(preg_match($garageParrot, $current_url) && !preg_match($timeExpired, $current_url)){

        routeToHomePageGarageParrot();

    }else if(!preg_match($timeExpired, $current_url)){

        routeToHomePage();

    }
    
?>
