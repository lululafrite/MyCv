<?php

    $checkUrl = preg_match('/goldorak/', $_SERVER['REQUEST_URI']) || preg_match('/garageparrot/', $_SERVER['REQUEST_URI']);
    if($checkUrl){
        require_once('../../garageparrot/model/car.class.php');
        require_once('../../model/utilities.class.php');

    }else{
        require_once('../garageparrot/model/car.class.php');
        require_once('../model/utilities.class.php');
    }


    use GarageParrot\Model\Car;
    use MyCv\Model\Utilities;

    $MyCar = new Car();
    
    $_SESSION['theTable'] = "car";

//---------------------------------------------------------------
//---Dynamic script of the car page--------------------------
//---------------------------------------------------------------
    
    if (isset($_POST['btn-SearchCar'])){
        $_SESSION['pagination']['thePage'] = 1;
        $_SESSION['pagination']['firstProduct'] = 0;
        $_SESSION['pagination']['productPerPage'] = 3;
        $_SESSION['pagination']['nbOfPage'] = 1;

        $_SESSION['car']['criteriaBrand'] = isset($_POST['select_car_brand']) ? filterInput('select_car_brand') : '';
        unset($_POST['select_car_brand']);
        
        $_SESSION['car']['criteriaModel'] = isset($_POST['select_car_model']) ? filterInput('select_car_model') : '';
        unset($_POST['select_car_model']);
        
        $_SESSION['car']['criteriaMileage'] = isset($_POST['select_car_mileage']) ? filterInput('select_car_mileage') : '';
        
        unset($_POST['select_car_mileage']);
        
        $_SESSION['car']['criteriaPrice'] = isset($_POST['select_car_price']) ? filterInput('select_car_price') : '';
        unset($_POST['select_car_price']);

    }else if(isset($_POST['nbOfPage'])){
        $_SESSION['pagination']['thePage'] = 1;
        $_SESSION['pagination']['firstProduct']=0;
    }

    // Initialiser les variables pour paramètrer la clause where afin d'executer la requete SELECT pour rechercher le ou les contacts
    $brand_umpty = true;
    $model_umpty = true;
    $mileage_umpty = true;
    $price_umpty = true;

    $whereClause = 1;

    if(empty($_SESSION['car']['criteriaBrand']) || $_SESSION['car']['criteriaBrand'] === 'Selectionnez une marque'){
        $brand_umpty = true;
    }else{
        $brand_umpty = false;
    }

    if(empty($_SESSION['car']['criteriaModel']) || $_SESSION['car']['criteriaModel'] === 'Selectionnez un modele'){
        $model_umpty = true;
    }else{
        $model_umpty = false;
    }

    if(empty($_SESSION['car']['criteriaMileage']) || $_SESSION['car']['criteriaMileage'] === 'Selectionnez un kilometrage maxi'){
        $mileage_umpty = true;
    }else{
        $mileage_umpty = false;
    }

    if(empty($_SESSION['car']['criteriaPrice']) || $_SESSION['car']['criteriaPrice'] === 'Selectionnez un prix maxi'){
        $price_umpty = true;
    }else{
        $price_umpty = false;
    }

    // Paramètrage de la clause WHERE pour executer la requete SELECT pour rechercher un ou plusieurs contacts

    if($brand_umpty === true && $model_umpty === true && $mileage_umpty === true && $price_umpty === true){
        
        $whereClause = 1;

    }else if($brand_umpty === false && $model_umpty === false && $mileage_umpty === false && $price_umpty === false){

        $whereClause = "`car`.`id_brand` = (SELECT `brand`.`id_brand` FROM `brand` WHERE `brand`.`name`='" . $_SESSION['car']['criteriaBrand'] . "') AND
                        `car`.`id_model` = (SELECT `model`.`id_model` FROM `model` WHERE `model`.`name`='" . $_SESSION['car']['criteriaModel'] . "') AND
                        `car`.`mileage` <= '" . $_SESSION['car']['criteriaMileage'] . "' AND
                        `car`.`price` <= '" . $_SESSION['car']['criteriaPrice'] . "'";

    }else if($brand_umpty === false && $model_umpty === true && $mileage_umpty === true && $price_umpty === true){

        $whereClause = "`car`.`id_brand` = (SELECT `brand`.`id_brand` FROM `brand` WHERE `brand`.`name`='" . $_SESSION['car']['criteriaBrand'] . "')";

    }else if($brand_umpty === false && $model_umpty === false && $mileage_umpty === true && $price_umpty === true){

        $whereClause = "`car`.`id_brand` = (SELECT `brand`.`id_brand` FROM `brand` WHERE `brand`.`name`='" . $_SESSION['car']['criteriaBrand'] . "') AND
                        `car`.`id_model` = (SELECT `model`.`id_model` FROM `model` WHERE `model`.`name`='" . $_SESSION['car']['criteriaModel'] . "')";

    }else if($brand_umpty === false && $model_umpty === false && $mileage_umpty === false && $price_umpty === true){

        $whereClause = "`car`.`id_brand` = (SELECT `brand`.`id_brand` FROM `brand` WHERE `brand`.`name`='" . $_SESSION['car']['criteriaBrand'] . "') AND
                        `car`.`id_model` = (SELECT `model`.`id_model` FROM `model` WHERE `model`.`name`='" . $_SESSION['car']['criteriaModel'] . "') AND
                        `car`.`mileage` <= '" . $_SESSION['car']['criteriaMileage'] . "' ";

    }else if($brand_umpty === false && $model_umpty === true && $mileage_umpty === false && $price_umpty === false){

        $whereClause = "`car`.`id_brand` = (SELECT `brand`.`id_brand` FROM `brand` WHERE `brand`.`name`='" . $_SESSION['car']['criteriaBrand'] . "') AND
                        `car`.`mileage` <= '" . $_SESSION['car']['criteriaMileage'] . "' AND
                        `car`.`price` <= '" . $_SESSION['car']['criteriaPrice'] . "'";

    }else if($brand_umpty === false && $model_umpty === true && $mileage_umpty === true && $price_umpty === false){

        $whereClause = "`car`.`id_brand` = (SELECT `brand`.`id_brand` FROM `brand` WHERE `brand`.`name`='" . $_SESSION['car']['criteriaBrand'] . "') AND
                        `car`.`price` <= '" . $_SESSION['car']['criteriaPrice'] . "'";

    }else if($brand_umpty === false && $model_umpty === false && $mileage_umpty === true && $price_umpty === false){

        $whereClause = "`car`.`id_brand` = (SELECT `brand`.`id_brand` FROM `brand` WHERE `brand`.`name`='" . $_SESSION['car']['criteriaBrand'] . "') AND
                        `car`.`id_model` = (SELECT `model`.`id_model` FROM `model` WHERE `model`.`name`='" . $_SESSION['car']['criteriaModel'] . "') AND
                        `car`.`price` <= '" . $_SESSION['car']['criteriaPrice'] . "'";

    }else if($brand_umpty === true && $model_umpty === false && $mileage_umpty === false && $price_umpty === false){

        $whereClause = "`car`.`id_model` = (SELECT `model`.`id_model` FROM `model` WHERE `model`.`name`='" . $_SESSION['car']['criteriaModel'] . "') AND
                        `car`.`mileage` <= '" . $_SESSION['car']['criteriaMileage'] . "' AND
                        `car`.`price` <= '" . $_SESSION['car']['criteriaPrice'] . "'";

    }else if($brand_umpty === true && $model_umpty === true && $mileage_umpty === false && $price_umpty === false){

        $whereClause = "`car`.`mileage` <= '" . $_SESSION['car']['criteriaMileage'] . "' AND
                        `car`.`price` <= '" . $_SESSION['car']['criteriaPrice'] . "'";

    }else if($brand_umpty === true && $model_umpty === true && $mileage_umpty === true && $price_umpty === false){

        $whereClause = "`car`.`price` <= '" . $_SESSION['car']['criteriaPrice'] . "'";

    }else if($brand_umpty === false && $model_umpty === true && $mileage_umpty === false && $price_umpty === true){

        $whereClause = "`car`.`id_brand` = (SELECT `brand`.`id_brand` FROM `brand` WHERE `brand`.`name`='" . $_SESSION['car']['criteriaBrand'] . "') AND
                        `car`.`mileage` <= '" . $_SESSION['car']['criteriaMileage'] . "'";

    }else if($brand_umpty === true && $model_umpty === false && $mileage_umpty === false && $price_umpty === true){

        $whereClause = "`car`.`id_model` = (SELECT `model`.`id_model` FROM `model` WHERE `model`.`name`='" . $_SESSION['car']['criteriaModel'] . "') AND
                        `car`.`mileage` <= '" . $_SESSION['car']['criteriaMileage'] . "'";

    }else if($brand_umpty === true && $model_umpty === false && $mileage_umpty === true && $price_umpty === false){

        $whereClause = "`car`.`id_model` = (SELECT `model`.`id_model` FROM `model` WHERE `model`.`name`='" .  $_SESSION['car']['criteriaModel'] . "') AND
                        `car`.`price` <= '" . $_SESSION['car']['criteriaPrice'] . "'";

    }else if($brand_umpty === true && $model_umpty === false && $mileage_umpty === true && $price_umpty === false){

        $whereClause = "`car`.`id_model` = (SELECT `model`.`id_model` FROM `model` WHERE `model`.`name`='" . $_SESSION['car']['criteriaModel'] . "')";

    }else if($brand_umpty === true && $model_umpty === true && $mileage_umpty === false && $price_umpty === true){

        $whereClause = "`car`.`mileage` <= '" . $_SESSION['car']['criteriaMileage'] . "' ";

    }else if($brand_umpty === true && $model_umpty === false && $mileage_umpty === true && $price_umpty === true){

        $whereClause = "`car`.`id_model` = (SELECT `model`.`id_model` FROM `model` WHERE `model`.`name`='" . $_SESSION['car']['criteriaModel'] . "')";

    }
    
    if($MyCar->getNewCar() === true){
        $_SESSION['car']['newCar'] = false;
        $whereClause = 1;
        $MyCar->setNewCar(false);
    }

    $_SESSION['other']['whereClause'] =  $whereClause;


    // Executer la requete SELECT pour rechercher les contacts en fonction de la clause WHERE
    if($_SESSION['other']['errorForm']===false && $MyCar->getNewCar() === false ){
        
        require_once('../../controller/page.controller.php');
        // Vérification du token CSRF
        if(Utilities::verifCsrf('csrf') && $_SERVER['REQUEST_METHOD'] === 'POST'){

            $Cars = $MyCar->get($whereClause, 'price', 'ASC', $MyPage->getFirstProduct(), $_SESSION['pagination']['productPerPage']);
        
        }else{

            $Cars = $MyCar->get('1', 'price', 'ASC', $MyPage->getFirstProduct(), $_SESSION['pagination']['productPerPage']);

        }
        
    }

    if (isset($_POST['nbOfLine'])){
		
        $_POST['nbOfLine'] = null;

	}
?>