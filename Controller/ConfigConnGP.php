<?php

	function connectDB(): PDO{

		$local = $_SESSION['local'];
		settype($local, "boolean");
		
		$current_url = $_SERVER['REQUEST_URI'];
		settype($current_url, "string");

		$goldorak = "/goldorak/";
		settype($goldorak, "string");

		$garageParrot = "/garageparrot/";
		settype($garageParrot, "string");

		if(preg_match($goldorak, $current_url)){
			
			if($local){
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

		}else if(preg_match($garageParrot, $current_url)){
			
			if($local){
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

		}else{

			if($local){
				$DB_HOST = 'localhost';
				$DB_NAME = 'mycv';
				$DB_USER = 'root';
				$DB_PASS = '';
				$BD_PORT = '3307';
			}
			else{
				$DB_HOST = 'db5016299008.hosting-data.io';
				$DB_NAME = 'dbs13260004';
				$DB_USER = 'dbu510923';
				$DB_PASS = 'MarLud7772!';
				$BD_PORT = '3306';
			}

		}

		$connect = null;

		try
		{
			$connect = new PDO("mysql:host=$DB_HOST; dbname=$DB_NAME;charset=utf8mb4;port=$BD_PORT", $DB_USER, $DB_PASS);
			return $connect;
		}
		catch (PDOException $e)
		{
			echo "Erreur de connexion à la base de données :" . $e->getMessage() . "<br/>";
			die();
		}
		
	}

?>