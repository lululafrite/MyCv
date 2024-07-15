<?php
    $DB_HOST = 'localhost';
    $DB_NAME = 'garage_parrot';
    $DB_USER = 'root';
    $DB_PASS = '';
    $BD_PORT = '3307';

    $bdd = null;

    try{

        $bdd = new PDO("mysql:host=$DB_HOST; dbname=$DB_NAME;charset=utf8mb4;port=$BD_PORT", $DB_USER, $DB_PASS);

    }catch(PDOException $e){
        
        echo "Erreur de connexion à la base de données :" . $e->getMessage() . "<br/>";
        die();

    }

    $sql = $bdd->prepare("SELECT `car`.`id_car`, `brand`.`name` AS `brand`, `model`.`name` AS `model`, `motorization`.`name` AS `motorisation`, `car`.`year`, `car`.`mileage`, `car`.`price`, `car`.`sold`, `car`.`description`, `car`.`image1`, `car`.`image2`, `car`.`image3`, `car`.`image4`, `car`.`image5`
                        FROM `car`
                        LEFT JOIN `brand` ON `car`.`id_brand` = `brand`.`id_brand` 
                        LEFT JOIN `model` ON `car`.`id_model` = `model`.`id_model` 
                        LEFT JOIN `motorization` ON `car`.`id_motorization` = `motorization`.`id_motorization`
                        WHERE 1
                        ORDER BY `price` ASC, `brand` ASC, `model` ASC, `motorisation` ASC, `mileage` ASC");

    $sql->execute();

    $cars = $sql->fetchAll(PDO::FETCH_ASSOC);

    header('Content-Type: application/json');

    echo json_encode($cars);
?>