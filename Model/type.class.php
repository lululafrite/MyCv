<?php

	namespace User\Model;
	
    $current_url = $_SERVER['REQUEST_URI'];
    $goldorak = '/goldorak/';
    $garageParrot = '/garageparrot/';

    if(preg_match($goldorak, $current_url) || preg_match($garageParrot, $current_url)){

		require_once('../../model/dbConnect.class.php');

    }else{

		require_once('../model/dbConnect.class.php');

    }

	use \PDO;
	use \PDOException;
	use MyCv\Model\dbConnect;

	class Type
	{
		private $id_type;
		public function getId()
		{
			return $this->id_type;
		}
		public function setId($new)
		{
			$this->id_type = $new;
		}

		//-----------------------------------------------------------------------

		private $type;
		public function getName()
		{
			return $this->type;
		}
		public function setName($new)
		{
			$this->type = $new;
		}

		//-----------------------------------------------------------------------

		private $theType;
		public function getType($idType)
		{
			$myDbConnect = new dbConnect();
			$bdd = $myDbConnect->connectionDb();
			unset($myDbConnect);

			date_default_timezone_set($_SESSION['timeZone']);
			
			try
			{
				$stmt = $bdd->prepare("SELECT
										`user_type`.`id_type`,
										`user_type`.`type`
									FROM `user_type`
									WHERE `user_type`.`id_type` = :idType");
				$stmt->bindParam(':idType', $idType, PDO::PARAM_INT);
				$stmt->execute();

				$this->theType = $stmt->fetchAll();

				return $this->theType;
			}
			catch (PDOException $e)
			{
				echo "Erreur de la requete :" . $e->getMessage();
			}

			$bdd = null;
		}


		//-----------------------------------------------------------------------

		private $userTypeList;
		public function get($whereClause, $orderBy = 'type', $ascOrDesc = 'ASC', $firstLine = 0, $linePerPage = 13)
		{
			$myDbConnect = new dbConnect();
			$bdd = $myDbConnect->connectionDb();
			unset($myDbConnect);
			
			try
			{
				$sql = $bdd->prepare("SELECT
										`user_type`.`id_type`,
										`user_type`.`type`
									FROM
										`user_type`
									WHERE $whereClause
									ORDER BY $orderBy $ascOrDesc
									LIMIT :firstLine, :linePerPage");

				$sql->bindParam(':firstLine', $firstLine, PDO::PARAM_INT);
				$sql->bindParam(':linePerPage', $linePerPage, PDO::PARAM_INT);

				$sql->execute();

				$this->userTypeList = $sql->fetchAll();

				return $this->userTypeList;
			}
			catch (PDOException $e)
			{
				echo "Erreur de la requete :" . $e->getMessage();
			}

			$bdd = null;
		}

		//-----------------------------------------------------------------------

		public function addUserType()
		{
			$myDbConnect = new dbConnect();
			$bdd = $myDbConnect->connectionDb();
			unset($myDbConnect);

			try {
				$stmt = $bdd->prepare("INSERT INTO `user_type`(`type`) VALUES(:type)");
				$stmt->bindParam(':type', $this->type, PDO::PARAM_STR);
				$stmt->execute();

				$this->id_type = $bdd->lastInsertId();

				echo '<script>alert("L\'enregistrement est effectué!");</script>';

			} catch (PDOException $e) {
				echo "Erreur de la requête : " . $e->getMessage();
			}

			$bdd = null;
		}

		//-----------------------------------------------------------------------

		public function updateUserType($idType)
		{
			$myDbConnect = new dbConnect();
			$bdd = $myDbConnect->connectionDb();
			unset($myDbConnect);

			try
			{
				$stmt = $bdd->prepare("UPDATE `user_type` SET `name` = :name WHERE `id_type` = :idType");
				$stmt->bindParam(':name', $this->type, PDO::PARAM_STR);
				$stmt->bindParam(':idType', $idType, PDO::PARAM_INT);
				$stmt->execute();

				if ($stmt->rowCount() > 0) {
					echo '<script>alert("Les modifications sont enregistrées!");</script>';
				} else {
					echo '<script>alert("Aucune modification effectuée. L\'enregistrement avec l\'ID spécifié n\'existe peut-être pas.");</script>';
				}
			}
			catch (PDOException $e)
			{
				echo "Erreur de la requete :" . $e->getMessage();
			}

			$bdd = null;
		}

		//-----------------------------------------------------------------------

		public function deleteUserType($id)
		{
			$myDbConnect = new dbConnect();
			$bdd = $myDbConnect->connectionDb();
			unset($myDbConnect);

			try
			{
				$stmt = $bdd->prepare('DELETE FROM user_type WHERE id_type = :id');
				$stmt->bindParam(':id', $id, PDO::PARAM_INT);
				$stmt->execute();

				if ($stmt->rowCount() > 0) {
					echo '<script>alert("Cet enregistrement est supprimé!");</script>';
				} else {
					echo '<script>alert("L\'enregistrement avec l\'ID spécifié n\'existe pas!");</script>';
				}
			}
			catch (PDOException $e)
			{
				echo "Erreur de la requete :" . $e->getMessage();
			}

			$bdd = null;
		}

	}
	
?>