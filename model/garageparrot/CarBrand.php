<?php
	//brand.class.php
	//Author: Ludovic FOLLACO
	//checked to 2024-10-04_16:31
	namespace Model\CarBrand;

	use \PDO;
	use \PDOException;
    use Model\DbConnect\DbConnect;
	use Model\Utilities\Utilities;

	class CarBrand
	{
		private $id_brand;
		public function getId(): int{
			return $this->id_brand;
		}
		public function setId($new): void{
			$this->id_brand = $new;
		}

		//-----------------------------------------------------------------------

		private $name;
		public function getName(): string{
			return $this->name;
		}
		public function setName($new): void{
			$this->name = $new;
		}

		//-----------------------------------------------------------------------

        private $addBrand = false;
        public function getAddBrand():bool{
            return $this->addBrand;
        }
        public function setAddBrand(bool $new):void{
            $this->addBrand = $new;
        }

		//-----------------------------------------------------------------------

		private $currentBrand = array();
		public function getCurrentBrand(int $id_brand):array{

			if(Utilities::checkData('brand','id_brand', $id_brand)){

				$bdd = DbConnect::DbConnect(new DbConnect());
			
				try{
					$sql = $bdd->prepare("SELECT `brand`.`id_brand`,
												 `brand`.`name`
										    FROM `brand`
										   WHERE `brand`.`id_brand`=:id_brand");

					$sql->bindParam(':id_brand', $id_brand, PDO::PARAM_INT);

					$sql->execute();

					$this->currentBrand = $sql->fetch(PDO::FETCH_ASSOC);

					$_SESSION['other']['error'] = false;
					$_SESSION['other']['message'] = 'The query is executed correctly!!!';

				}catch (PDOException $e){
					$_SESSION['other']['error'] = true;
					$_SESSION['other']['message'] = 'Error to query : ' . $e->getMessage() . '<br>';
				}
			}else{
				$_SESSION['other']['error'] = true;
				$_SESSION['other']['message'] = 'To id is not existing!!!';
			}

			$bdd=null;
			return $this->currentBrand;
		}

		//-----------------------------------------------------------------------

		private $brandList = array();
		public function getBrandList(string $whereClause, string $orderBy = 'name', string $ascOrDesc = 'ASC', int $firstLine = 0, int $linePerPage = 13): array{
			
			$bdd = DbConnect::DbConnect(new DbConnect());
			
			try{
			    $stmt = $bdd->prepare("SELECT `brand`.`id_brand`,
											  `brand`.`name`
										 FROM `brand`
										WHERE $whereClause
									 ORDER BY :orderBy :ascOrDesc
										LIMIT :firstLine, :linePerPage");

				$stmt->bindParam(':orderBy', $orderBy, PDO::PARAM_STR);
				$stmt->bindParam(':ascOrDesc', $ascOrDesc, PDO::PARAM_STR);
				$stmt->bindParam(':firstLine', $firstLine, PDO::PARAM_INT);
				$stmt->bindParam(':linePerPage', $linePerPage, PDO::PARAM_INT);

				$stmt->execute();

				$this->brandList = $stmt->fetchAll(PDO::FETCH_ASSOC);

				$_SESSION['other']['error'] = false;
				$_SESSION['other']['message'] = 'The query is executed correctly!!!';

			}catch (PDOException $e){
				$_SESSION['other']['error'] = true;
				$_SESSION['other']['message'] = 'Error to query : ' . $e->getMessage() . '<br>';
			}

			$bdd=null;
			return $this->brandList;
		}

		//-----------------------------------------------------------------------

		private $insertBrand = 0;
		public function insertBrand():int{

			try{
				if(!Utilities::checkData('brand','name', $this->name)){

					$bdd = DbConnect::DbConnect(new DbConnect());
					$stmt = $bdd->prepare('INSERT INTO `brand`(`name`) VALUES(:name)');
					$stmt->bindParam(':name', $this->name, PDO::PARAM_STR);
					$stmt->execute();
		
					$stmt = $bdd->prepare('SELECT MAX(`id_brand`) FROM `brand`');
					$stmt->execute();
					
					$this->insertBrand = intval($stmt->fetchColumn());
					
					$_SESSION['other']['error'] = false;
					$_SESSION['other']['message'] = "Brand is insert with success!!!";

				}else{
					
					$bdd = DbConnect::DbConnect(new DbConnect());

					$stmt = $bdd->prepare('SELECT `id_brand` FROM `brand` WHERE `name` = :name');
					$stmt->bindParam(':name', $this->name, PDO::PARAM_STR);
					$stmt->execute();

					$this->insertBrand = intval($stmt->fetchColumn());

					$_SESSION['other']['error'] = false;
					$_SESSION['other']['message'] = "This brand is existing!!!";
				}

			}catch (PDOException $e){
				$_SESSION['other']['error'] = true;
				$_SESSION['other']['message'] = 'Error to insert brand : ' . $e->getMessage() . '<br>';
			}

			$bdd = null;
			return $this->insertBrand;
		}

		//-----------------------------------------------------------------------

		private $updateBrand = false;
		public function updateBrand(int $id_brand):bool{
			
			if(Utilities::checkData('brand','id_brand', $id_brand)){

				$bdd = DbConnect::DbConnect(new DbConnect());

				try{
					$stmt = $bdd->prepare('UPDATE `brand` SET `name` = :name WHERE `id_brand` = :id_brand');

					$stmt->bindParam(':name', $this->name, PDO::PARAM_STR);
					$stmt->bindParam(':id_brand', $id_brand, PDO::PARAM_INT);

					$stmt->execute();

					$this->updateBrand = true;
					
					$_SESSION['other']['error'] = false;
					$_SESSION['other']['message'] = "Brand is modifications with success!!!";

				}catch (PDOException $e){
					$_SESSION['other']['error'] = true;
					$_SESSION['other']['message'] = 'Error to update brand : ' . $e->getMessage() . '<br>';
				}

			}else{
				$_SESSION['other']['error'] = false;
				$_SESSION['other']['message'] = "This brand is not existing!!!";
			}

			$bdd=null;
			return $this->updateBrand;
		}

		//-----------------------------------------------------------------------

		private $deleteBrand = false;
		public function deleteBrand(int $id_brand):bool{
			
			if(Utilities::checkData('brand','id_brand', $id_brand)){

				$bdd = DbConnect::DbConnect(new DbConnect());

				try{
					$stmt = $bdd->prepare('SELECT COUNT(*) FROM car WHERE id_brand = :id_brand');
					$stmt->bindParam(':id_brand', $id_brand, PDO::PARAM_INT);
					$stmt->execute();

					$result = $stmt->fetchColumn();

					if($result > 0){

						$_SESSION['other']['error'] = false;
						$_SESSION['other']['message'] = "This brand is used by a car!!!";

					}else{

						$stmt = $bdd->prepare('DELETE FROM brand WHERE id_brand = :id_brand');
						$stmt->bindParam(':id_brand', $id_brand, PDO::PARAM_INT);
						$stmt->execute();

						$_SESSION['other']['error'] = false;
						$_SESSION['other']['message'] = "Brand is delete with success!!!";

						$this->deleteBrand = true;
					}

				}catch(PDOException $e){
					$_SESSION['other']['error'] = true;
					$_SESSION['other']['message'] = 'Error query to delete brand : ' . $e->getMessage() . '<br>';
				}
			}else{
				$_SESSION['other']['error'] = true;
				$_SESSION['other']['message'] = "This brand is not existing!!!";
			}

			$bdd=null;
			return $this->deleteBrand;
		}
	}	
?>