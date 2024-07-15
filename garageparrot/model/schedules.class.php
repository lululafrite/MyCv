<?php

	class Schedules
	{

		private $id_schedules;
		public function getId()
		{
			return $this->id_schedules;
		}
		public function setId($new)
		{
			$this->id_schedules = $new;
		}

		//-----------------------------------------------------------------------

		private $lundiMatin;
		public function getLundiMatin()
		{
			return $this->lundiMatin;
		}
		public function setLundiMatin($new)
		{
			$this->lundiMatin = $new;
		}

		//-----------------------------------------------------------------------

		private $lundiAM;
		public function getLundiAM()
		{
			return $this->lundiAM;
		}
		public function setLundiAM($new)
		{
			$this->lundiAM = $new;
		}

		//-----------------------------------------------------------------------

		private $mardiMatin;
		public function getMardiMatin()
		{
			return $this->mardiMatin;
		}
		public function setMardiMatin($new)
		{
			$this->mardiMatin = $new;
		}

		//-----------------------------------------------------------------------

		private $mardiAM;
		public function getMardiAM()
		{
			return $this->mardiAM;
		}
		public function setMardiAM($new)
		{
			$this->mardiAM = $new;
		}

		//-----------------------------------------------------------------------

		private $mercrediMatin;
		public function getMercrediMatin()
		{
			return $this->mercrediMatin;
		}
		public function setMercrediMatin($new)
		{
			$this->mercrediMatin = $new;
		}

		//-----------------------------------------------------------------------

		private $mercrediAM;
		public function getMercrediAM()
		{
			return $this->mercrediAM;
		}
		public function setMercrediAM($new)
		{
			$this->mercrediAM = $new;
		}

		//-----------------------------------------------------------------------

		private $jeudiMatin;
		public function getJeudiMatin()
		{
			return $this->jeudiMatin;
		}
		public function setJeudiMatin($new)
		{
			$this->jeudiMatin = $new;
		}

		//-----------------------------------------------------------------------

		private $jeudiAM;
		public function getJeudiAM()
		{
			return $this->jeudiAM;
		}
		public function setJeudiAM($new)
		{
			$this->jeudiAM = $new;
		}

		//-----------------------------------------------------------------------

		private $vendrediMatin;
		public function getVendrediMatin()
		{
			return $this->vendrediMatin;
		}
		public function setVendrediMatin($new)
		{
			$this->vendrediMatin = $new;
		}

		//-----------------------------------------------------------------------

		private $vendrediAM;
		public function getVendrediAM()
		{
			return $this->vendrediAM;
		}
		public function setVendrediAM($new)
		{
			$this->vendrediAM = $new;
		}

		//-----------------------------------------------------------------------

		private $samediMatin;
		public function getSamediMatin()
		{
			return $this->samediMatin;
		}
		public function setSamediMatin($new)
		{
			$this->samediMatin = $new;
		}

		//-----------------------------------------------------------------------

		private $samediAM;
		public function getSamediAM()
		{
			return $this->samediAM;
		}
		public function setSamediAM($new)
		{
			$this->samediAM = $new;
		}

		//-----------------------------------------------------------------------

		private $dimancheMatin;
		public function getDimancheMatin()
		{
			return $this->dimancheMatin;
		}
		public function setDimancheMatin($new)
		{
			$this->dimancheMatin = $new;
		}

		//-----------------------------------------------------------------------

		private $dimancheAM;
		public function getDimancheAM()
		{
			return $this->dimancheAM;
		}
		public function setDimancheAM($new)
		{
			$this->dimancheAM = $new;
		}

		//-----------------------------------------------------------------------

		private $theSchedules;
		public function getSchedules($îdSchedules)
		{
			include_once('../../controller/ConfigConnGP.php');
			$conn = connectDB();
            date_default_timezone_set($_SESSION['timeZone']);
			
			try
			{
			    $sql = $conn->query("SELECT
										`schedules`.`id_schedules`,
										`schedules`.`lundiMatin`,
										`schedules`.`lundiAM`,
										`schedules`.`mardiMatin`,
										`schedules`.`mardiAM`,
										`schedules`.`mercrediMatin`,
										`schedules`.`mercrediAM`,
										`schedules`.`jeudiMatin`,
										`schedules`.`jeudiAM`,
										`schedules`.`vendrediMatin`,
										`schedules`.`vendrediAM`,
										`schedules`.`samediMatin`,
										`schedules`.`samediAM`,
										`schedules`.`dimancheMatin`,
										`schedules`.`dimancheAM`

									FROM `schedules`
									
									WHERE `schedules`.`id_schedules`=$îdSchedules
								");

				/*while ($this->theContact[] = $sql->fetch());*/
				$this->theSchedules[] = $sql->fetch();
				return $this->theSchedules;
			}
			catch (PDOException $e)
			{
				echo '<script>alert("Erreur de la requête : ' . $e->getMessage() . '");</script>';
			}

			$conn=null;
		}

		//-----------------------------------------------------------------------

		private $brandList;
		public function get($whereClause, $orderBy = 'name', $ascOrDesc = 'ASC', $firstLine = 0, $linePerPage = 13)
		{
			include_once('../../controller/ConfigConnGP.php');
			$conn = connectDB();
            date_default_timezone_set($_SESSION['timeZone']);
			
			try
			{
			    $sql = $conn->query("SELECT
										`schedules`.`id_schedules`,
										`schedules`.`lundiMatin`,
										`schedules`.`lundiAM`,
										`schedules`.`mardiMatin`,
										`schedules`.`mardiAM`,
										`schedules`.`mercrediMatin`,
										`schedules`.`mercrediAM`,
										`schedules`.`jeudiMatin`,
										`schedules`.`jeudiAM`,
										`schedules`.`vendrediMatin`,
										`schedules`.`vendrediAM`,
										`schedules`.`samediMatin`,
										`schedules`.`samediAM`,
										`schedules`.`dimancheMatin`,
										`schedules`.`dimancheAM`

									FROM `schedules`

									WHERE $whereClause
									ORDER BY $orderBy $ascOrDesc
									LIMIT $firstLine, $linePerPage
								");

				while ($this->brandList[] = $sql->fetch());
				return $this->brandList;
			}
			catch (PDOException $e)
			{
				echo '<script>alert("Erreur de la requête : ' . $e->getMessage() . '");</script>';
			}

			$conn=null;
		}

		//-----------------------------------------------------------------------

		public function addSchedules()
		{
			include_once('../../controller/ConfigConnGP.php');
			$conn = connectDB();
            date_default_timezone_set($_SESSION['timeZone']);

			try{
				$conn->exec("INSERT INTO `schedules`(`id_schedules`,`lundiMatin`,`lundiAM`,`mardiMatin`,`mardiAM`,
													`mercrediMatin`,`mercrediAM`,`jeudiMatin`,`jeudiAM`,
													`vendrediMatin`,`vendrediAM`, `samediMatin`,`samediAM`,
													`dimancheMatin`,`dimancheAM`)
							VALUES(
									'" . $this->lundiMatin . "',
									'" . $this->lundiAM . "',
									'" . $this->mardiMatin . "',
									'" . $this->mardiAM . "',
									'" . $this->mercrediMatin . "',
									'" . $this->mercrediAM . "',
									'" . $this->jeudiMatin . "',
									'" . $this->jeudiAM . "',
									'" . $this->vendrediMatin . "',
									'" . $this->vendrediAM . "',
									'" . $this->samediMatin . "',
									'" . $this->samediAM . "',
									'" . $this->dimancheMatin . "',
									'" . $this->dimancheAM . "'
								)
							");

				$sql = $conn->query("SELECT MAX(`id_schedules`) FROM `schedules`");
				$id_schedule = $sql->fetch();
				$this->id_schedules = intval($id_schedule['id_schedules']);

				echo '<script>alert("L\'enregistrement est effectué!");</script>';

			} catch (PDOException $e) {
				
				echo "Erreur de la requête : " . $e->getMessage();

			}

			$conn=null;
		}

		//-----------------------------------------------------------------------

		public function updateSchedules()
		{
			include_once('../../controller/ConfigConnGP.php');
			$conn = connectDB();
            date_default_timezone_set($_SESSION['timeZone']);

			try
			{
				$conn->exec("UPDATE `schedules`
							SET `lundiMatin` =  '" . $this->lundiMatin . "',
								`lundiAM` =  '" . $this->lundiAM . "',
								`mardiMatin` =  '" . $this->mardiMatin . "',
								`mardiAM` =  '" . $this->mardiAM . "',
								`mercrediMatin` =  '" . $this->mercrediMatin . "',
								`mercrediAM` =  '" . $this->mercrediAM . "',
								`jeudiMatin` =  '" . $this->jeudiMatin . "',
								`jeudiAM` =  '" . $this->jeudiAM . "',
								`vendrediMatin` =  '" . $this->vendrediMatin . "',
								`vendrediAM` =  '" . $this->vendrediAM . "',
								`samediMatin` =  '" . $this->samediMatin . "',
								`samediAM` =  '" . $this->samediAM . "',
								`dimancheMatin` =  '" . $this->dimancheMatin . "',
								`dimancheAM` =  '" . $this->dimancheAM . "'

								WHERE `id_schedules` = '1'
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

		public function deleteSchedules($id)
		{
			include_once('../../controller/ConfigConnGP.php');
			$conn = connectDB();
            date_default_timezone_set($_SESSION['timeZone']);

			try
			{
			    $conn->exec('DELETE FROM schedules WHERE id_schedules=' . $id);
				echo '<script>alert("Cet enregistrement est supprimé!");</script>';
			}
			catch (PDOException $e)
			{
				echo '<script>alert("Erreur de la requête : ' . $e->getMessage() . '");</script>';
			}

			$conn=null;
		}

        //__Ajouter user?___________________________________________
        
        public function getAddSchedules()
        {
            if(is_null($_SESSION['addSchedules']))
            {
                $_SESSION['addSchedules']=false;
            }
            return $_SESSION['addSchedules'];
        }
        public function setAddSchedules($new)
        {
            $_SESSION['addSchedules']=$new;
        }

	}
	
?>