<?php

function connectDB(){

	if($_SESSION['local']===true){
		$DB_HOST = 'localhost';
		$DB_NAME = 'garage_parrot';
		$DB_USER = 'root';
		$DB_PASS = '';
		$BD_PORT = '3307';
	}
	else{
		$DB_HOST = 'db5015199153.hosting-data.io';
		$DB_NAME = 'dbs12564096';
		$DB_USER = 'dbu1146568';
		$DB_PASS = 'MarLud7772!';
		$BD_PORT = '3306';
	}
	$bdd = null;

	try
	{
		$bdd = new PDO("mysql:host=$DB_HOST; dbname=$DB_NAME;charset=utf8mb4;port=$BD_PORT", $DB_USER, $DB_PASS);
		return $bdd;
		//$bdd->exec("set names utf8");
	}
	catch (PDOException $e)
	{
		echo "Erreur de connexion à la base de données :" . $e->getMessage() . "<br/>";
		die();
	}
	
}

?>