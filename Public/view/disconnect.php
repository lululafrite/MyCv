<?php
    
    $current_url = $_SERVER['REQUEST_URI'];
    $goldorak = '/goldorak/';
    $garageParrot = '/garageparrot/';

    if(preg_match($goldorak, $current_url) || preg_match($garageParrot, $current_url)){

        require("../../controller/disconnect.controller.php");

    }else{

        require("../controller/disconnect.controller.php");

    }
    
?>