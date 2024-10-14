<?php
	//dbConnect.class.php
	//author : Ludovic FOLLACO
	//checked to 2024-10-04_15:25
	namespace Model\DbConnect;

	use \PDO;
	use \PDOException;
	use Model\Utilities\Utilities;

	class DbConnect
	{
		private static function connectDb(): PDO{
			
			$local = Utilities::checkIfLocal();
			if($local){
				$DB_HOST = 'localhost';
				$DB_USER = 'root';
				$DB_PASS = '';
				$BD_PORT = '3307';
				
			}else{
				$DB_PASS = 'MarLud7772!';
				$BD_PORT = '3306';
			}

			$checkUser = Utilities::checkValueInUrl('user');
			$checkConnexion = Utilities::checkValueInUrl('connexion');
			$checkUrlGoldorak = Utilities::checkValueInUrl('goldorak');
			$checkUrlGarageParrot = Utilities::checkValueInUrl('garageparrot');
			$checkUrl = !$checkUrlGoldorak && !$checkUrlGarageParrot;
			
			if($checkUser || $checkUrl || $checkConnexion){

				if($local){
					$DB_NAME = 'mycv';
				}
				else{
					$DB_HOST = 'db5016299008.hosting-data.io';
					$DB_NAME = 'dbs13260004';
					$DB_USER = 'dbu510923';
				}

			}elseif($checkUrlGoldorak){
				
				if($local){
					$DB_NAME = 'goldorak';
				}
				else{
					$DB_HOST = 'db5015520267.hosting-data.io';
					$DB_NAME = 'dbs12677679';
					$DB_USER = 'dbu4075604';
				}

			}elseif($checkUrlGarageParrot){
				
				if($local){
					$DB_NAME = 'garage_parrot';
				}
				else{
					$DB_HOST = 'db5015199153.hosting-data.io';
					$DB_NAME = 'dbs12564096';
					$DB_USER = 'dbu1146568';
				}

			}

			$bdd = null;

			try{
				$bdd = new PDO("mysql:host=$DB_HOST; dbname=$DB_NAME;charset=utf8mb4;port=$BD_PORT", $DB_USER, $DB_PASS);
				$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
				return $bdd;

			}catch (PDOException $e){
				$_SESSION['other']['error'] = true;
				$_SESSION['other']['message'] = "Error to connexion in the database :" . $e->getMessage() . "<br>";
				return $bdd;
			}

		}

		public static function dbConnect(): PDO{

			$bdd = DbConnect::connectDb();
			date_default_timezone_set($_SESSION['other']['timeZone']);

			if($bdd){
				return $bdd;
			}else{
				return $bdd;
			}
		}

//**************************************************************************************************************************** */
//**************************************************** GARAGE PARROT *************************************************************** */
//**************************************************************************************************************************** */

		private static function connectDbGP():PDO{
			
			$local = Utilities::checkIfLocal();
				
				if($local){
					$DB_HOST = 'localhost';
					$DB_USER = 'root';
					$DB_PASS = '';
					$BD_PORT = '3307';
					$DB_NAME = 'garage_parrot';
				}
				else{
					$DB_HOST = 'db5015199153.hosting-data.io';
					$DB_NAME = 'dbs12564096';
					$DB_USER = 'dbu1146568';
					$DB_PASS = 'MarLud7772!';
					$BD_PORT = '3306';
				}

			$bdd = null;

			try{
				$bdd = new PDO("mysql:host=$DB_HOST; dbname=$DB_NAME;charset=utf8mb4;port=$BD_PORT", $DB_USER, $DB_PASS);
				$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
				return $bdd;

			}catch (PDOException $e){
				$_SESSION['other']['error'] = true;
				$_SESSION['other']['message'] = "Error to connexion in the database :" . $e->getMessage() . "<br>";
				return $bdd;
			}
		}

		public static function dbConnectGP(): PDO{

			$bdd = DbConnect::connectDbGP();
			date_default_timezone_set($_SESSION['other']['timeZone']);

			if($bdd){
				return $bdd;
			}else{
				return $bdd;
			}
		}

//**************************************************************************************************************************** */
//**************************************************** GOLDORAK *************************************************************** */
//**************************************************************************************************************************** */

		private static function connectDbGoldorak():PDO{
			
			$local = Utilities::checkIfLocal();
				
				if($local){
					$DB_HOST = 'localhost';
					$DB_USER = 'root';
					$DB_PASS = '';
					$BD_PORT = '3307';
					$DB_NAME = 'goldorak';
				}
				else{
					
					$DB_HOST = 'db5015520267.hosting-data.io';
					$DB_NAME = 'dbs12677679';
					$DB_USER = 'dbu4075604';
					$DB_PASS = 'MarLud7772!';
					$BD_PORT = '3306';
				}

			$bdd = null;

			try{
				$bdd = new PDO("mysql:host=$DB_HOST; dbname=$DB_NAME;charset=utf8mb4;port=$BD_PORT", $DB_USER, $DB_PASS);
				$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
				return $bdd;

			}catch (PDOException $e){
				$_SESSION['other']['error'] = true;
				$_SESSION['other']['message'] = "Error to connexion in the database :" . $e->getMessage() . "<br>";
				return $bdd;
			}
		}

		public static function dbConnectGoldorak(): PDO{

			$bdd = DbConnect::connectDbGoldorak();
			date_default_timezone_set($_SESSION['other']['timeZone']);

			if($bdd){
				return $bdd;
			}else{
				return $bdd;
			}
		}
	}
?>