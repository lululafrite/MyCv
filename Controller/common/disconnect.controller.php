<?php
    
    require_once('../model/common/utilities.class.php');
    require_once('../module/common/variable.php');

    use Model\Utilities\Utilities;

    resetDataConnectVarSession();
    resetUserVarSession();

    $_SESSION['token']['jwt']['tokenJwt'] = Utilities::tokenJwt($_SESSION['dataConnect']['pseudo'], $_SESSION['token']['jwt']['secretKey'], $_SESSION['token']['jwt']['delay']);
    
    Utilities::redirectToPage("home");
    
?>
