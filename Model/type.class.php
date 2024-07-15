<?php

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
			include_once('../model/dbConnect.class.php');
			$dbConnect_ = new dbConnect();
			$bdd = $dbConnect_->connectionDb();
			unset($dbConnect_);

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
			catch (Exception $e)
			{
				echo "Erreur de la requete :" . $e->getMessage();
			}

			$bdd = null;
		}


		//-----------------------------------------------------------------------

		private $userTypeList;
		public function get($whereClause, $orderBy = 'type', $ascOrDesc = 'ASC', $firstLine = 0, $linePerPage = 13)
		{
			include_once('../model/dbConnect.class.php');
			$dbConnect_ = new dbConnect();
			$bdd = $dbConnect_->connectionDb();
			unset($dbConnect_);
			
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
			catch (Exception $e)
			{
				echo "Erreur de la requete :" . $e->getMessage();
			}

			$bdd = null;
		}

		//-----------------------------------------------------------------------

		public function addUserType()
		{
			include_once('../model/dbConnect.class.php');
			$dbConnect_ = new dbConnect();
			$bdd = $dbConnect_->connectionDb();
			unset($dbConnect_);

			try {
				$stmt = $bdd->prepare("INSERT INTO `user_type`(`type`) VALUES(:type)");
				$stmt->bindParam(':type', $this->type, PDO::PARAM_STR);
				$stmt->execute();

				$this->id_type = $bdd->lastInsertId();

				echo '<script>alert("L\'enregistrement est effectué!");</script>';

			} catch (Exception $e) {
				echo "Erreur de la requête : " . $e->getMessage();
			}

			$bdd = null;
		}

		//-----------------------------------------------------------------------

		public function updateUserType($idType)
		{
			include_once('../model/dbConnect.class.php');
			$dbConnect_ = new dbConnect();
			$bdd = $dbConnect_->connectionDb();
			unset($dbConnect_);

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
			catch (Exception $e)
			{
				echo "Erreur de la requete :" . $e->getMessage();
			}

			$bdd = null;
		}

		//-----------------------------------------------------------------------

		public function deleteUserType($id)
		{
			include_once('../model/dbConnect.class.php');
			$dbConnect_ = new dbConnect();
			$bdd = $dbConnect_->connectionDb();
			unset($dbConnect_);

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
			catch (Exception $e)
			{
				echo "Erreur de la requete :" . $e->getMessage();
			}

			$bdd = null;
		}

	}
	
?>