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
		public function getType($îdType)
		{
			include_once('../../controller/ConfigConnGP.php');
			$conn = connectDB();
            date_default_timezone_set($_SESSION['timeZone']);
			
			try
			{
			    $sql = $conn->query("SELECT
										`user_type`.`id_type`,
										`user_type`.`type`

									FROM `user_type`
									
									WHERE `user_type`.`id_type`=$îdType
								");

				$this->theType[] = $sql->fetch();
				return $this->theType;
			}
			catch (PDOException $e)
			{
				echo '<script>alert("Erreur de la requête : ' . $e->getMessage() . '");</script>';
			}

			$conn=null;
		}

		//-----------------------------------------------------------------------

		private $userTypeList;
		public function get($whereClause, $orderBy = 'type', $ascOrDesc = 'ASC', $firstLine = 0, $linePerPage = 13)
		{
			include_once('../../controller/ConfigConnGP.php');
			$conn = connectDB();
            date_default_timezone_set($_SESSION['timeZone']);
			
			try
			{
			    $sql = $conn->query("SELECT
										`user_type`.`id_type`,
										`user_type`.`type`
									FROM
										`user_type`
									WHERE $whereClause
									ORDER BY $orderBy $ascOrDesc
									LIMIT $firstLine, $linePerPage
								");

				while ($this->userTypeList[] = $sql->fetch());
				return $this->userTypeList;
			}
			catch (PDOException $e)
			{
				echo '<script>alert("Erreur de la requête : ' . $e->getMessage() . '");</script>';
			}

			$conn=null;
		}

		//-----------------------------------------------------------------------

		public function addUserType()
		{
			include_once('../../controller/ConfigConnGP.php');
			$conn = connectDB();
            date_default_timezone_set($_SESSION['timeZone']);

			try{
				$conn->exec("INSERT INTO `user_type`(`type`)
							VALUES('" . $this->type . "')");

				$sql = $conn->query("SELECT MAX(`id_type`) FROM `user_type`");
				$id_type = $sql->fetch();
				$this->id_type = intval($id_type['id_type']);

				echo '<script>alert("L\'enregistrement est effectué!");</script>';

			} catch (PDOException $e) {
				
				echo '<script>alert("Erreur de la requête : ' . $e->getMessage() . '");</script>';

			}

			$conn=null;
		}

		//-----------------------------------------------------------------------

		public function updateUserType($idType)
		{
			include_once('../../controller/ConfigConnGP.php');
			$conn = connectDB();
            date_default_timezone_set($_SESSION['timeZone']);

			try
			{
				$conn->exec("UPDATE `user_type` SET `name` = '" . $this->type . "'
							WHERE `id_type` = " . intval($idType) . "
							");
				
				echo '<script>alert("Les modifications sont enregistrées!");</script>';
			}
			catch (PDOException $e)
			{
				echo '<script>alert("Erreur de la requête : ' . $e->getMessage() . '");</script>';
			}

			$conn=null;
		}

		//-----------------------------------------------------------------------

		public function deleteUserType($id)
		{
			include_once('../../controller/ConfigConnGP.php');
			$conn = connectDB();
            date_default_timezone_set($_SESSION['timeZone']);

			try
			{
			    $conn->exec('DELETE FROM user_type WHERE id_type=' . $id);
				echo '<script>alert("Cet enregistrement est supprimé!");</script>';
			}
			catch (PDOException $e)
			{
				echo '<script>alert("Erreur de la requête : ' . $e->getMessage() . '");</script>';
			}

			$conn=null;
		}

        //__Ajouter user?___________________________________________
        
        public function getAddUserType()
        {
            if(is_null($_SESSION['addUserType']))
            {
                $_SESSION['addUserType']=false;
            }
            return $_SESSION['addUserType'];
        }
        public function setAddUserType($new)
        {
            $_SESSION['addUserType']=$new;
        }

	}
	
?>