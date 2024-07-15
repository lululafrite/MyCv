<?php
//---Load model car--------------------
    include_once('../../common/utilies.php');
    include_once('../../garageparrot/model/car.class.php');
//---Configure object Car--
    $MyCar = new Car();
    
//---Configure the database table--
    $_SESSION['theTable'] = "car";

//---------------------------------------------------------------
//---Dynamic script of the car page--------------------------
//---------------------------------------------------------------
    
    if (isset($_POST['btn-SearchCar'])){
        $_SESSION['laPage'] = 1;
        $_SESSION['firstLine'] = 0;
        $_SESSION['ligneParPage'] = 3;
        $_SESSION['nbOfPage'] = 1;

        $_SESSION['criteriaBrand'] = isset($_POST['select_car_brand']) ? filterInput('select_car_brand') : '';
        unset($_POST['select_car_brand']);
        
        $_SESSION['criteriaModel'] = isset($_POST['select_car_model']) ? filterInput('select_car_model') : '';
        unset($_POST['select_car_model']);
        
        $_SESSION['criteriaMileage'] = isset($_POST['select_car_mileage']) ? filterInput('select_car_mileage') : '';
        
        unset($_POST['select_car_mileage']);
        
        $_SESSION['criteriaPrice'] = isset($_POST['select_car_price']) ? filterInput('select_car_price') : '';
        unset($_POST['select_car_price']);

    }else if(isset($_POST['nbOfPage'])){
        $_SESSION['laPage'] = 1;
        $_SESSION['firstLine']=0;
    }

    // Initialiser les variables pour paramètrer la clause where afin d'executer la requete SELECT pour rechercher le ou les contacts
    $brand_umpty = true;
    $model_umpty = true;
    $mileage_umpty = true;
    $price_umpty = true;

    $whereClause = 1;

    if(empty($_SESSION['criteriaBrand']) || $_SESSION['criteriaBrand'] === 'Selectionnez une marque'){
        $brand_umpty = true;
    }else{
        $brand_umpty = false;
    }

    if(empty($_SESSION['criteriaModel']) || $_SESSION['criteriaModel'] === 'Selectionnez un modele'){
        $model_umpty = true;
    }else{
        $model_umpty = false;
    }

    if(empty($_SESSION['criteriaMileage']) || $_SESSION['criteriaMileage'] === 'Selectionnez un kilometrage maxi'){
        $mileage_umpty = true;
    }else{
        $mileage_umpty = false;
    }

    if(empty($_SESSION['criteriaPrice']) || $_SESSION['criteriaPrice'] === 'Selectionnez un prix maxi'){
        $price_umpty = true;
    }else{
        $price_umpty = false;
    }

    // Paramètrage de la clause WHERE pour executer la requete SELECT pour rechercher un ou plusieurs contacts

    if($brand_umpty === true && $model_umpty === true && $mileage_umpty === true && $price_umpty === true){
        
        $whereClause = 1;

    }else if($brand_umpty === false && $model_umpty === false && $mileage_umpty === false && $price_umpty === false){

        $whereClause = "`car`.`id_brand` = (SELECT `brand`.`id_brand` FROM `brand` WHERE `brand`.`name`='" . $_SESSION['criteriaBrand'] . "') AND
                        `car`.`id_model` = (SELECT `model`.`id_model` FROM `model` WHERE `model`.`name`='" . $_SESSION['criteriaModel'] . "') AND
                        `car`.`mileage` <= '" . $_SESSION['criteriaMileage'] . "' AND
                        `car`.`price` <= '" . $_SESSION['criteriaPrice'] . "'";

    }else if($brand_umpty === false && $model_umpty === true && $mileage_umpty === true && $price_umpty === true){

        $whereClause = "`car`.`id_brand` = (SELECT `brand`.`id_brand` FROM `brand` WHERE `brand`.`name`='" . $_SESSION['criteriaBrand'] . "')";

    }else if($brand_umpty === false && $model_umpty === false && $mileage_umpty === true && $price_umpty === true){

        $whereClause = "`car`.`id_brand` = (SELECT `brand`.`id_brand` FROM `brand` WHERE `brand`.`name`='" . $_SESSION['criteriaBrand'] . "') AND
                        `car`.`id_model` = (SELECT `model`.`id_model` FROM `model` WHERE `model`.`name`='" . $_SESSION['criteriaModel'] . "')";

    }else if($brand_umpty === false && $model_umpty === false && $mileage_umpty === false && $price_umpty === true){

        $whereClause = "`car`.`id_brand` = (SELECT `brand`.`id_brand` FROM `brand` WHERE `brand`.`name`='" . $_SESSION['criteriaBrand'] . "') AND
                        `car`.`id_model` = (SELECT `model`.`id_model` FROM `model` WHERE `model`.`name`='" . $_SESSION['criteriaModel'] . "') AND
                        `car`.`mileage` <= '" . $_SESSION['criteriaMileage'] . "' ";

    }else if($brand_umpty === false && $model_umpty === true && $mileage_umpty === false && $price_umpty === false){

        $whereClause = "`car`.`id_brand` = (SELECT `brand`.`id_brand` FROM `brand` WHERE `brand`.`name`='" . $_SESSION['criteriaBrand'] . "') AND
                        `car`.`mileage` <= '" . $_SESSION['criteriaMileage'] . "' AND
                        `car`.`price` <= '" . $_SESSION['criteriaPrice'] . "'";

    }else if($brand_umpty === false && $model_umpty === true && $mileage_umpty === true && $price_umpty === false){

        $whereClause = "`car`.`id_brand` = (SELECT `brand`.`id_brand` FROM `brand` WHERE `brand`.`name`='" . $_SESSION['criteriaBrand'] . "') AND
                        `car`.`price` <= '" . $_SESSION['criteriaPrice'] . "'";

    }else if($brand_umpty === false && $model_umpty === false && $mileage_umpty === true && $price_umpty === false){

        $whereClause = "`car`.`id_brand` = (SELECT `brand`.`id_brand` FROM `brand` WHERE `brand`.`name`='" . $_SESSION['criteriaBrand'] . "') AND
                        `car`.`id_model` = (SELECT `model`.`id_model` FROM `model` WHERE `model`.`name`='" . $_SESSION['criteriaModel'] . "') AND
                        `car`.`price` <= '" . $_SESSION['criteriaPrice'] . "'";

    }else if($brand_umpty === true && $model_umpty === false && $mileage_umpty === false && $price_umpty === false){

        $whereClause = "`car`.`id_model` = (SELECT `model`.`id_model` FROM `model` WHERE `model`.`name`='" . $_SESSION['criteriaModel'] . "') AND
                        `car`.`mileage` <= '" . $_SESSION['criteriaMileage'] . "' AND
                        `car`.`price` <= '" . $_SESSION['criteriaPrice'] . "'";

    }else if($brand_umpty === true && $model_umpty === true && $mileage_umpty === false && $price_umpty === false){

        $whereClause = "`car`.`mileage` <= '" . $_SESSION['criteriaMileage'] . "' AND
                        `car`.`price` <= '" . $_SESSION['criteriaPrice'] . "'";

    }else if($brand_umpty === true && $model_umpty === true && $mileage_umpty === true && $price_umpty === false){

        $whereClause = "`car`.`price` <= '" . $_SESSION['criteriaPrice'] . "'";

    }else if($brand_umpty === false && $model_umpty === true && $mileage_umpty === false && $price_umpty === true){

        $whereClause = "`car`.`id_brand` = (SELECT `brand`.`id_brand` FROM `brand` WHERE `brand`.`name`='" . $_SESSION['criteriaBrand'] . "') AND
                        `car`.`mileage` <= '" . $_SESSION['criteriaMileage'] . "'";

    }else if($brand_umpty === true && $model_umpty === false && $mileage_umpty === false && $price_umpty === true){

        $whereClause = "`car`.`id_model` = (SELECT `model`.`id_model` FROM `model` WHERE `model`.`name`='" . $_SESSION['criteriaModel'] . "') AND
                        `car`.`mileage` <= '" . $_SESSION['criteriaMileage'] . "'";

    }else if($brand_umpty === true && $model_umpty === false && $mileage_umpty === true && $price_umpty === false){

        $whereClause = "`car`.`id_model` = (SELECT `model`.`id_model` FROM `model` WHERE `model`.`name`='" .  $_SESSION['criteriaModel'] . "') AND
                        `car`.`price` <= '" . $_SESSION['criteriaPrice'] . "'";

    }else if($brand_umpty === true && $model_umpty === false && $mileage_umpty === true && $price_umpty === false){

        $whereClause = "`car`.`id_model` = (SELECT `model`.`id_model` FROM `model` WHERE `model`.`name`='" . $_SESSION['criteriaModel'] . "')";

    }else if($brand_umpty === true && $model_umpty === true && $mileage_umpty === false && $price_umpty === true){

        $whereClause = "`car`.`mileage` <= '" . $_SESSION['criteriaMileage'] . "' ";

    }else if($brand_umpty === true && $model_umpty === false && $mileage_umpty === true && $price_umpty === true){

        $whereClause = "`car`.`id_model` = (SELECT `model`.`id_model` FROM `model` WHERE `model`.`name`='" . $_SESSION['criteriaModel'] . "')";

    }
    
    if($MyCar->getNewCar() === true){
        $_SESSION['newCars'] = false;
        $whereClause = 1;
        $MyCar->setNewCar(false);
    }

    $_SESSION['whereClause'] =  $whereClause;


    // Executer la requete SELECT pour rechercher les contacts en fonction de la clause WHERE
    if($_SESSION['errorFormCar']===false && $MyCar->getNewCar() === false ){
        
        include_once('../../garageparrot/controller/page.controller.php');
        // Vérification du token CSRF
        if(verifCsrf('tokenCsrf') && $_SERVER['REQUEST_METHOD'] === 'POST'){

            $Cars = $MyCar->get($whereClause, 'price', 'ASC', $MyPage->getFirstLine(), $_SESSION['ligneParPage']);
        
        }else{

            $Cars = $MyCar->get('1', 'price', 'ASC', $MyPage->getFirstLine(), $_SESSION['ligneParPage']);

        }
        
    }

    if (isset($_POST['nbOfLine'])){
		
        $_POST['nbOfLine'] = null;

	}
?>