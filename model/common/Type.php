<?php
	//type.class.php
	//author : Ludovic FOLLACO
	//2024-10-04_16:00
	namespace Model\Type;

	use \PDO;
	use \PDOException;
	use Model\DbConnect\DbConnect;

	class Type
	{
		private $id_type;
		public function getId():int{
			return $this->id_type;
		}
		public function setId(int $new):void{
			$this->id_type = $new;
		}

		//-----------------------------------------------------------------------

		private $type;
		public function getName():string{
			return $this->type;
		}
		public function setName(string $new):void{
			$this->type = $new;
		}

		//-----------------------------------------------------------------------

		private $theType = array();
		public function getType(int $id_type):array{

			$bdd = DbConnect::DbConnect(new DbConnect());
			
			try{
				$stmt = $bdd->prepare("SELECT `user_type`.`id_type`,
											  `user_type`.`type`
										FROM  `user_type`
										WHERE `user_type`.`id_type` = :id_type");
				
				$stmt->bindParam(':id_type', $id_type, PDO::PARAM_INT);
				$stmt->execute();

				$this->theType = $stmt->fetchAll(PDO::FETCH_ASSOC);

				$_SESSION['other']['error'] = false;
				$_SESSION['other']['message'] = "The type is found!!!";

			}catch(PDOException $e){
				$_SESSION['other']['error'] = true;
				$_SESSION['other']['message'] = "The type is not found!!!" . $e->GetMessage();
			}

			$bdd = null;
			return $this->theType;
		}


		//-----------------------------------------------------------------------

		private $typeList = array();
		public function getTypeList(string $whereClause, string $orderBy = 'type', string $ascOrDesc = 'ASC', int $firstLine = 0, int $linePerPage = 13):array{

			$bdd = DbConnect::DbConnect(new DbConnect());
			
			try{
				$sql = $bdd->prepare("SELECT `user_type`.`id_type`,
											 `user_type`.`type`
										FROM `user_type`
										WHERE $whereClause
									 ORDER BY :orderBy :ascOrDesc
										LIMIT :firstLine, :linePerPage");

				$sql->bindParam(':orderBy', $orderBy, PDO::PARAM_STR);
				$sql->bindParam(':ascOrDesc', $ascOrDesc, PDO::PARAM_STR);
				$sql->bindParam(':firstLine', $firstLine, PDO::PARAM_INT);
				$sql->bindParam(':linePerPage', $linePerPage, PDO::PARAM_INT);

				$sql->execute();

				$this->typeList = $sql->fetchAll(PDO::FETCH_ASSOC);

				$_SESSION['other']['error'] = false;
				$_SESSION['other']['message'] = "Type list is found!!!";

			}catch(PDOException $e){
				$_SESSION['other']['error'] = true;
				$_SESSION['other']['message'] = "Type list is not found!!!" . $e->GetMessage();
			}

			$bdd = null;
			return $this->typeList;
		}

		//-----------------------------------------------------------------------
		
		private $insertType = 0;
		public function InsertType():int{

			$bdd = DbConnect::DbConnect(new DbConnect());

			try{
				$stmt = $bdd->prepare("INSERT INTO `user_type`(`type`) VALUES(:type)");
				$stmt->bindParam(':type', $this->type, PDO::PARAM_STR);
				$stmt->execute();

				$this->insertType = $bdd->lastInsertId();

				$_SESSION['other']['error'] = false;
				$_SESSION['other']['message'] = "The type is inserted!!!";

			}catch(PDOException $e){
				$_SESSION['other']['error'] = true;
				$_SESSION['other']['message'] = "The type is not inserted!!!" . $e->GetMessage();
			}

			$bdd = null;
			return $this->insertType;
		}

		//-----------------------------------------------------------------------
		private $updateType = false;
		public function updateUserType(int $id_type):bool{

			$bdd = DbConnect::DbConnect(new DbConnect());

			try{
				$stmt = $bdd->prepare("UPDATE `user_type` SET `name` = :name WHERE `id_type` = :id_type");
				
				$stmt->bindParam(':name', $this->type, PDO::PARAM_STR);
				$stmt->bindParam(':id_type', $id_type, PDO::PARAM_INT);
				
				$stmt->execute();

				$_SESSION['other']['error'] = false;
				$_SESSION['other']['message'] = "The type is updated!!!";

				$this->updateType = true;

			}catch(PDOException $e){
				$_SESSION['other']['error'] = true;
				$_SESSION['other']['message'] = "The type is not updated!!!" . $e->GetMessage();
			}

			$bdd = null;
			return $this->updateType;
		}

		//-----------------------------------------------------------------------
		private $deleteType = false;
		public function deleteUserType(int $id_type):bool{

			$bdd = DbConnect::DbConnect(new DbConnect());

			try{
				$stmt = $bdd->prepare('DELETE FROM user_type WHERE id_type = :id_type');

				$stmt->bindParam(':id_type', $id_type, PDO::PARAM_INT);

				$stmt->execute();

				$_SESSION['other']['error'] = false;
				$_SESSION['other']['message'] = "The type is deleted!!!";

				$this->deleteType = true;

			}catch (PDOException $e){
				$_SESSION['other']['error'] = true;
				$_SESSION['other']['message'] = "The type is not deleted!!!" . $e->GetMessage();
			}

			$bdd = null;
			return $this->deleteType;
		}
	}
?>