<?php

function connectDB(){

	if($_SESSION['local']===true){
		$DB_HOST = 'localhost';
		$DB_NAME = 'goldorak';
		$DB_USER = 'root';
		$DB_PASS = '';
		$BD_PORT = '3307';
	}
	else{
		$DB_HOST = 'db5015520267.hosting-data.io';
		$DB_NAME = 'dbs12677679';
		$DB_USER = 'dbu4075604';
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