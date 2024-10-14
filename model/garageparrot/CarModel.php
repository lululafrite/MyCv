<?php
	//home.class.php
	//Author: Ludovic FOLLACO
	//checked to 2024-10-08_16:04
	namespace Model\CarModel;

	use \PDO;
	use \PDOException;
    use Model\DbConnect\DbConnect;

	class CarModel
	{
		private $id_model;
		public function getId():int{
			return $this->id_model;
		}
		public function setId(int $new):void{
			$this->id_model = $new;
		}

		//-----------------------------------------------------------------------

		private $name;
		public function getName():string{
			return $this->name;
		}
		public function setName(string $new):void{
			$this->name = $new;
		}

		//-----------------------------------------------------------------------
        private $addModel = false;
        public function getAddModel():bool{
            return $this->addModel;
        }
        public function setAddModel(bool $new):void{
            $this->addModel = $new;
        }

		//-----------------------------------------------------------------------

		private $currentModel = array();
		public function getCurrentModel(int $id_model):array{
			$bdd = DbConnect::DbConnect(new DbConnect());
			
			try{
			    $stmt = $bdd->prepare("SELECT `model`.`id_model`,
											  `model`.`name`
										 FROM `model`
										WHERE `model`.`id_model`=:id_model");

				$stmt->bindParam(':id_model', $id_model, PDO::PARAM_INT);
				$stmt->execute();

				$this->currentModel = $stmt->fetch(PDO::FETCH_ASSOC);

				$_SESSION['other']['error'] = false;
				$_SESSION['other']['message'] = "The model is found!!!";

			}catch(PDOException $e){
				$_SESSION['other']['error'] = true;
				$_SESSION['other']['message'] = "The model is not found!!!" . $e->GetMessage() . "<br>";
			}

			$bdd=null;
			return $this->currentModel;
		}

		//-----------------------------------------------------------------------

		private $modelList = array();
		public function getModelList($whereClause, $orderBy = 'name', $ascOrDesc = 'ASC', $firstLine = 0, $linePerPage = 13):array{
			
			$bdd = DbConnect::DbConnect(new DbConnect());
			
			try{
			    $stmt = $bdd->prepare("SELECT `model`.`id_model`,
											  `model`.`name`,
											  `model`.`id_brand`
										 FROM `model`
										WHERE $whereClause
									 ORDER BY :orderBy :ascOrDesc
										LIMIT :firstLine, :linePerPage");

				$stmt->bindParam(':orderBy', $orderBy, PDO::PARAM_STR);
				$stmt->bindParam(':ascOrDesc', $ascOrDesc, PDO::PARAM_STR);
				$stmt->bindParam(':firstLine', $firstLine, PDO::PARAM_INT);
				$stmt->bindParam(':linePerPage', $linePerPage, PDO::PARAM_INT);

				$stmt->execute();
				
				$this->modelList = $stmt->fetchAll(PDO::FETCH_ASSOC);

				$_SESSION['other']['error'] = false;
				$_SESSION['other']['message'] = "The query is executed correctly!!!";

			}catch(PDOException $e){
				$_SESSION['other']['error'] = true;
				$_SESSION['other']['message'] = "Error to query : " . $e->getMessage() . "<br>";
			}

			$bdd=null;
			return $this->modelList;
		}

		//-----------------------------------------------------------------------

		private $insertModel = 0;
		public function insertModel():int{

			$bdd = DbConnect::DbConnect(new DbConnect());

			try{
				$stmt = $bdd->prepare('SELECT COUNT(*) FROM `model` WHERE `name` = :name');
				$stmt->bindParam(':name', $this->getName(), PDO::PARAM_STR);
				$stmt->execute();

				$result = $stmt->fetchColumn();
				//The model is existing if $result > 0 
				if($result > 0){

					$stmt = $bdd->prepare("SELECT `id_model` FROM `model` WHERE `name` = :name");
					$stmt->bindParam(':name', $this->name, PDO::PARAM_STR);
					$stmt->execute();

					$this->insertModel = intval($stmt->fetchColumn());

					$_SESSION['other']['error'] = false;
					$_SESSION['other']['message'] = "The model is existing!!!";

				}else{
					$stmt = $bdd->prepare("INSERT INTO `model`(`name`) VALUES ('" . $this->name . "')");
					$stmt->execute();

					$stmt = $bdd->prepare("SELECT MAX(`id_model`) FROM `model`");
					$stmt->execute();

					$this->insertModel = intval($stmt->fetchColumn());

					$_SESSION['other']['error'] = false;
					$_SESSION['other']['message'] = "The model is inserted!!!";
				}

			}catch(PDOException $e){
				$_SESSION['other']['error'] = true;
				$_SESSION['other']['message'] = "The model is not inserted!!!" . $e->GetMessage() . "<br>";
			}

			$bdd=null;
			return $this->insertModel;
		}

		//-----------------------------------------------------------------------

		private $updateModel = false;
		public function updatemodel(int $id_model)
		{
			$bdd = DbConnect::DbConnect(new DbConnect());

			try{
				$stmt = $bdd->prepare('SELECT COUNT(*) FROM `model` WHERE `id_model` = :id_model');
				$stmt->bindParam(':id_model', $id_model, PDO::PARAM_INT);
				$stmt->execute();

				$result = $stmt->fetchColumn();
				//The model is existing if $result > 0
				if($result > 0){

					$stmt = $bdd->prepare('UPDATE `model`
											SET `name` = :name
											WHERE `id_model` = :id_model');
					
					$stmt->bindParam(':name', $this->name, PDO::PARAM_STR);
					$stmt->bindParam(':id_model', $id_model, PDO::PARAM_INT);

					$stmt->execute();

					$_SESSION['other']['error'] = false;
					$_SESSION['other']['message'] = "The model is updated!!!";
								
					$this->updateModel = true;

				}else{
					$_SESSION['other']['error'] = false;
					$_SESSION['other']['message'] = "The model is not existing!!!";
				}
			
			}catch(PDOException $e){
				$_SESSION['other']['error'] = true;
				$_SESSION['other']['message'] = "The model is not updated!!!" . $e->GetMessage() . "<br>";
			}

			$bdd=null;
			return $this->updateModel;
		}

		//-----------------------------------------------------------------------

		private $deleteModel = false;
		public function deleteModel(int $id_model):bool{

			$bdd = DbConnect::DbConnect(new DbConnect());

			try{
				$stmt = $bdd->prepare('SELECT COUNT(*) FROM `model` WHERE `id_model` = :id_model');
				$stmt->bindParam(':id_model', $id_model, PDO::PARAM_INT);
				$stmt->execute();

				$result = $stmt->fetchColumn();

				if($result > 0){

					$stmt = $bdd->prepare('SELECT COUNT(*) FROM `car` WHERE `id_model` = :id_model');
					$stmt->bindParam(':id_model', $id_model, PDO::PARAM_INT);
					$stmt->execute();

					$result = $stmt->fetchColumn();

					if($result > 0){

						$_SESSION['other']['error'] = false;
						$_SESSION['other']['message'] = "The model is not deleted because it is used by a car!!!";
						
					}else{

						$stmt = $bdd->prepare('DELETE FROM model WHERE id_model= :id_model');
						$stmt->bindParam(':id_model', $id_model, PDO::PARAM_INT);
						$stmt->execute();

						$_SESSION['other']['error'] = false;
						$_SESSION['other']['message'] = "The model is deleted!!!";

						$this->deleteModel = true;
					}

				}else{
					$_SESSION['other']['error'] = false;
					$_SESSION['other']['message'] = "The model is not existing!!!";
				}

			}catch (PDOException $e){
				$_SESSION['other']['error'] = true;
				$_SESSION['other']['message'] = "error query : " . $e->GetMessage() . "<br>";
			}

			$bdd=null;
			return $this->deleteModel;
		}
	}	
?>