<?php

	class Model
	{

		private $id_model;
		public function getId()
		{
			return $this->id_model;
		}
		public function setId($new)
		{
			$this->id_model = $new;
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

		private $theModel;
		public function getmodel($idModel)
		{
			include_once('../../controller/ConfigConnGP.php');
			$conn = connectDB();
            date_default_timezone_set($_SESSION['timeZone']);
			
			try
			{
			    $sql = $conn->query("SELECT
										`model`.`id_model`,
										`model`.`name`

									FROM `model`
									
									WHERE `model`.`id_model`=$idModel
								");

				/*while ($this->theContact[] = $sql->fetch());*/
				$this->theModel[] = $sql->fetch();
				return $this->theModel;
			}
			catch (PDOException $e)
			{
				echo '<script>alert("Erreur de la requête : ' . $e->getMessage() . '");</script>';
			}

			$conn=null;
		}

		//-----------------------------------------------------------------------

		private $modelList;
		public function get($whereClause, $orderBy = 'name', $ascOrDesc = 'ASC', $firstLine = 0, $linePerPage = 13)
		{
			include_once('../../controller/ConfigConnGP.php');
			$conn = connectDB();
            date_default_timezone_set($_SESSION['timeZone']);
			
			try
			{
			    $sql = $conn->prepare("SELECT
										`model`.`id_model`,
										`model`.`name`,
										`model`.`id_brand`

										FROM `model`

										WHERE $whereClause
										ORDER BY $orderBy $ascOrDesc
										LIMIT :firstLine, :linePerPage
									");

				$sql->bindParam(':firstLine', $firstLine, PDO::PARAM_INT);
				$sql->bindParam(':linePerPage', $linePerPage, PDO::PARAM_INT);
				$sql->execute();
				
				$this->modelList = $sql->fetchAll(PDO::FETCH_ASSOC);
				return $this->modelList;

				/*while ($this->modelList[] = $sql->fetch());
				return $this->modelList;*/
			}
			catch (PDOException $e)
			{
				echo '<script>alert("Erreur de la requête : ' . $e->getMessage() . '");</script>';
			}

			$conn=null;
		}

		//-----------------------------------------------------------------------

		public function addModel()
		{
			include_once('../../controller/ConfigConnGP.php');
			$conn = connectDB();
            date_default_timezone_set($_SESSION['timeZone']);

			try{
				$conn->exec("INSERT INTO `model`(`name`)
							VALUES('" . $this->name . "')");

				$sql = $conn->query("SELECT MAX(`id_model`) FROM `model`");
				$id_model = $sql->fetch();
				$this->id_model = intval($id_model['id_model']);

				echo '<script>alert("L\'enregistrement est effectué!");</script>';

			} catch (PDOException $e) {
				
				echo "Erreur de la requête : " . $e->getMessage();

			}

			$conn=null;
		}

		//-----------------------------------------------------------------------

		public function updatemodel($idModel)
		{
			include_once('../../controller/ConfigConnGP.php');
			$conn = connectDB();
            date_default_timezone_set($_SESSION['timeZone']);

			try
			{
				$conn->exec("UPDATE `model` SET `name` = '" . $this->name . "'
							WHERE `id_model` = " . intval($idModel) . "
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

		public function deleteModel($id)
		{
			include_once('../../controller/ConfigConnGP.php');
			$conn = connectDB();
            date_default_timezone_set($_SESSION['timeZone']);

			try
			{
			    $conn->exec('DELETE FROM model WHERE id_model=' . $id);
				echo '<script>alert("Cet enregistrement est supprimé!");</script>';
			}
			catch (PDOException $e)
			{
				echo '<script>alert("Erreur de la requête : ' . $e->getMessage() . '");</script>';
			}

			$conn=null;
		}

        //__Ajouter user?___________________________________________
        
        public function getAddmodel()
        {
            if(is_null($_SESSION['addModel']))
            {
                $_SESSION['addModel']=false;
            }
            return $_SESSION['addModel'];
        }
        public function setAddmodel($new)
        {
            $_SESSION['addModel']=$new;
        }

	}
	
?>