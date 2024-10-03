<?php

	namespace GarageParrot\Model;

	require_once('../model/dbConnect.class.php');

	use \PDO;
	use \PDOException;
	use MyCv\Model\dbConnect;

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
			$bdd = dbConnect::dbConnect(new dbConnect());
			
			try
			{
			    $sql = $bdd->query("SELECT
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

			$bdd=null;
		}

		//-----------------------------------------------------------------------

		private $modelList;
		public function getModelList($whereClause, $orderBy = 'name', $ascOrDesc = 'ASC', $firstLine = 0, $linePerPage = 13)
		{
			$bdd = dbConnect::dbConnect(new dbConnect());
			
			try
			{
			    $sql = $bdd->prepare("SELECT
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

			$bdd=null;
		}

		//-----------------------------------------------------------------------

		public function addModel()
		{
			$bdd = dbConnect::dbConnect(new dbConnect());

			try{
				$bdd->exec("INSERT INTO `model`(`name`)
							VALUES('" . $this->name . "')");

				$sql = $bdd->query("SELECT MAX(`id_model`) FROM `model`");
				$id_model = $sql->fetch();
				$this->id_model = intval($id_model['id_model']);

				echo '<script>alert("L\'enregistrement est effectué!");</script>';

			} catch (PDOException $e) {
				
				echo "Erreur de la requête : " . $e->getMessage();

			}

			$bdd=null;
		}

		//-----------------------------------------------------------------------

		public function updatemodel($idModel)
		{
			$bdd = dbConnect::dbConnect(new dbConnect());

			try
			{
				$bdd->exec("UPDATE `model` SET `name` = '" . $this->name . "'
							WHERE `id_model` = " . intval($idModel) . "
							");
				
				echo '<script>alert("Les modifications sont enregistrées!");</script>';
			}
			catch (PDOException $e)
			{
				echo '<script>alert("Erreur de la requête : ' . $e->getMessage() . '");</script>';
			}

			$bdd=null;
		}

		//-----------------------------------------------------------------------

		public function deleteModel($id)
		{
			$bdd = dbConnect::dbConnect(new dbConnect());

			try
			{
			    $bdd->exec('DELETE FROM model WHERE id_model=' . $id);
				echo '<script>alert("Cet enregistrement est supprimé!");</script>';
			}
			catch (PDOException $e)
			{
				echo '<script>alert("Erreur de la requête : ' . $e->getMessage() . '");</script>';
			}

			$bdd=null;
		}

        //__Ajouter user?___________________________________________
        
        public function getAddmodel()
        {
            if(is_null($_SESSION['car']['addModel']))
            {
                $_SESSION['car']['addModel']=false;
            }
            return $_SESSION['car']['addModel'];
        }
        public function setAddmodel($new)
        {
            $_SESSION['car']['addModel']=$new;
        }

	}
	
?>