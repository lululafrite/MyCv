<?php

	class Motorization
	{

		private $id_motorization;
		public function getId()
		{
			return $this->id_motorization;
		}
		public function setId($new)
		{
			$this->id_motorization = $new;
		}

		//-----------------------------------------------------------------------

		private $name;
		public function getName()
		{
			return $this->name;
		}
		public function setName($new)
		{
			$this->name = $new;
		}

		//-----------------------------------------------------------------------

		private $theMotorization;
		public function getmotorization($idMotorization)
		{
			include_once('../../controller/ConfigConnGP.php');
			$conn = connectDB();
            date_default_timezone_set($_SESSION['timeZone']);
			
			try
			{
			    $sql = $conn->query("SELECT
										`motorization`.`id_motorization`,
										`motorization`.`name`

									FROM `motorization`
									
									WHERE `motorization`.`id_motorization`=$idMotorization
								");

				/*while ($this->theContact[] = $sql->fetch());*/
				$this->theMotorization[] = $sql->fetch();
				return $this->theMotorization;
			}
			catch (PDOException $e)
			{
				echo '<script>alert("Erreur de la requête : ' . $e->getMessage() . '");</script>';
			}

			$conn=null;
		}

		//-----------------------------------------------------------------------

		private $motorizationList;
		public function get($whereClause, $orderBy = 'name', $ascOrDesc = 'ASC', $firstLine = 0, $linePerPage = 13)
		{
			include_once('../../controller/ConfigConnGP.php');
			$conn = connectDB();
            date_default_timezone_set($_SESSION['timeZone']);
			
			try
			{
			    $sql = $conn->query("SELECT
										`motorization`.`id_motorization`,
										`motorization`.`name`
									FROM
										`motorization`
									WHERE $whereClause
									ORDER BY $orderBy $ascOrDesc
									LIMIT $firstLine, $linePerPage
								");

				while ($this->motorizationList[] = $sql->fetch());
				return $this->motorizationList;
			}
			catch (PDOException $e)
			{
				echo '<script>alert("Erreur de la requête : ' . $e->getMessage() . '");</script>';
			}

			$conn=null;
		}

		//-----------------------------------------------------------------------

		public function addMotorization()
		{
			include_once('../../controller/ConfigConnGP.php');
			$conn = connectDB();
            date_default_timezone_set($_SESSION['timeZone']);

			try{
				$conn->exec("INSERT INTO `motorization`(`name`)
							VALUES('" . $this->name . "')");

				$sql = $conn->query("SELECT MAX(`id_motorization`) FROM `motorization`");
				$id_motorization = $sql->fetch();
				$this->id_motorization = intval($id_motorization['id_motorization']);

				echo '<script>alert("L\'enregistrement est effectué!");</script>';

			} catch (PDOException $e) {
				
				echo "Erreur de la requête : " . $e->getMessage();

			}

			$conn=null;
		}

		//-----------------------------------------------------------------------

		public function updatemotorization($idMotorization)
		{
			include_once('../../controller/ConfigConnGP.php');
			$conn = connectDB();
            date_default_timezone_set($_SESSION['timeZone']);

			try
			{
				$conn->exec("UPDATE `motorization` SET `name` = '" . $this->name . "'
							WHERE `id_motorization` = " . intval($idMotorization) . "
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

		public function deleteMotorization($id)
		{
			include_once('../../controller/ConfigConnGP.php');
			$conn = connectDB();
            date_default_timezone_set($_SESSION['timeZone']);

			try
			{
			    $conn->exec('DELETE FROM motorization WHERE id_motorization=' . $id);
				echo '<script>alert("Cet enregistrement est supprimé!");</script>';
			}
			catch (PDOException $e)
			{
				echo '<script>alert("Erreur de la requête : ' . $e->getMessage() . '");</script>';
			}

			$conn=null;
		}

        //__Ajouter user?___________________________________________
        
        public function getAddmotorization()
        {
            if(is_null($_SESSION['addMotorization']))
            {
                $_SESSION['addMotorization']=false;
            }
            return $_SESSION['addMotorization'];
        }
        public function setAddmotorization($new)
        {
            $_SESSION['addMotorization']=$new;
        }

	}
	
?>