<?php
	//car.class.php
	//Author: Ludovic FOLLACO
	//checked to 2024-10-04_16:48
	namespace Model\Car;

    require_once('../model/common/dbConnect.class.php');

	use \PDO;
	use \PDOException;
    use Model\DbConnect\DbConnect;

	class Car
	{
		private $id_car;
		public function getId():int{
			return $this->id_car;
		}
		public function setId(int $new):void{
			$this->id_car = $new;
		}

		//-----------------------------------------------------------------------

		private $brand;
		public function getBrand():string{
			return $this->brand;
		}
		public function setBrand(string $new):void{
			$this->brand = $new;
		}

		//-----------------------------------------------------------------------

		private $model;
		public function getModel():string{
			return $this->model;
		}
		public function setModel(string $new):void{
			$this->model = $new;
		}

		//-----------------------------------------------------------------------

		private $motorization;
		public function getMotorization():string{
			return $this->motorization;
		}
		public function setMotorization(string $new):void{
			$this->motorization = $new;
		}

		//-----------------------------------------------------------------------

		private $year = 2000;
		public function getYear():int{
			return $this->year;
		}
		public function setYear(int $new):void{
			$this->year = $new;
		}

		//-----------------------------------------------------------------------

		private $mileage = 0;
		public function getMileage():int{
			return $this->mileage;
		}
		public function setMileage(int $new):void{
			$this->mileage = $new;
		}

		//-----------------------------------------------------------------------

		private $price = 0;
		public function getPrice():int{
			return $this->price;
		}
		public function setPrice(int $new):void{
			$this->price = $new;
		}

		//-----------------------------------------------------------------------

		private $sold;
		public function getSold():string{
			return $this->sold;
		}
		public function setSold(string $new):void{
			$this->sold = $new;
		}

		//-----------------------------------------------------------------------

		private $description;
		public function getDescription():string{
			return $this->description;
		}
		public function setDescription(string $new):void{
			$this->description = $new;
		}
		//-----------------------------------------------------------------------

		private $image1;
		public function getImage1():string{
			return $this->image1;
		}
		public function setImage1(string $new):void{
			$this->image1 = $new;
		}

		//-----------------------------------------------------------------------

		private $image2;
		public function getImage2():string{
			return $this->image2;
		}
		public function setImage2(string $new):void{
			$this->image2 = $new;
		}

		//-----------------------------------------------------------------------

		private $image3;
		public function getImage3():string{
			return $this->image3;
		}
		public function setImage3(string $new):void{
			$this->image3 = $new;
		}

		//-----------------------------------------------------------------------

		private $image4;
		public function getImage4():string{
			return $this->image4;
		}
		public function setImage4(string $new):void{
			$this->image4 = $new;
		}

		//-----------------------------------------------------------------------

		private $image5;
		public function getImage5():string{
			return $this->image5;
		}
		public function setImage5(string $new):void{
			$this->image5 = $new;
		}

		private $criteriaBrand;
		public function getCriteriaBrand():string{
			return $this->criteriaBrand;
		}
		public function setCriteriaBrand(string $new):void{
			$this->criteriaBrand = $new;
		}

		private $criteriaModel;
		public function getCriteriaModel():string{
			return $this->criteriaModel;
		}
		public function setCriteriaModel(string $new):void{
			$this->criteriaModel = $new;
		}

		private $criteriaMileage;
		public function getCriteriaMileage():int{
			return $this->criteriaMileage;
		}
		public function setCriteriaMileage(int $new):void{
			$this->criteriaMileage = $new;
		}

		private $criteriaPrice;
		public function getCriteriaPrice():int{
			return $this->criteriaPrice;
		}
		public function setCriteriaPrice(int $new):void{
			$this->criteriaPrice = $new;
		}

		//-----------------------------------------------------------------------

		private $newCar = false;
		public function getNewCar():bool{
			$_SESSION['car']['newCar'] = $this->newCar;
			return $this->newCar;
		}
		public function setNewCar(bool $new):void{
			$_SESSION['car']['newCar'] = $new;
			$this->newCar = $new;
		}

        //__Ajouter car?___________________________________________

        private $addCar = false;
        public function getAddCar():bool{
            $_SESSION['car']['addCar']=$this->addCar;
            return $this->addCar;
        }
        public function setAddCar(bool $new):void{
            $_SESSION['car']['addCar']=$new;
			$this->addCar = $new;
        }

		//-----------------------------------------------------------------------

		private $currentCar = array();
		public function getCurrentCar(int $id_car):array{
			
			$bdd = DbConnect::DbConnect(new DbConnect());

			try{
				$stmt = $bdd->prepare("SELECT
											`car`.`id_car`,
											`brand`.`name` AS `brand`,
											`model`.`name` AS `model`,
											`motorization`.`name` AS `motorization`,
											`car`.`year`,
											`car`.`mileage`,
											`car`.`price`,
											`car`.`description`,
											`car`.`sold`,
											`car`.`image1`,
											`car`.`image2`,
											`car`.`image3`,
											`car`.`image4`,
											`car`.`image5`
										
										FROM `car`

										LEFT JOIN `brand`
											ON `car`.`id_brand` = `brand`.`id_brand`
										LEFT JOIN `model`
											ON `car`.`id_model` = `model`.`id_model`
										LEFT JOIN `motorization`
											ON `car`.`id_motorization` = `motorization`.`id_motorization`
										WHERE `car`.`id_car` = :id_car");

				$stmt->bindParam(':id_car', $id_car, PDO::PARAM_INT);
				$stmt->execute();

				$this->currentCar = $stmt->fetch(PDO::FETCH_ASSOC);

				$_SESSION['other']['error'] = false;
				$_SESSION['other']['message'] = "The car with id " . $id_car . " is loaded with success!!!";

			}catch(PDOException $e){
				$_SESSION['other']['error'] = true;
				$_SESSION['other']['message'] = "Error to load car with id " . $id_car . " : " . $e->getMessage();
			}

			$bdd = null;
			return $this->currentCar;

		}

		//-----------------------------------------------------------------------

		private $carList = array();
		public function getCarList(string $whereClause, string $orderBy = 'price', string $ascOrDesc = 'ASC', int $firstLine = 0, int $linePerPage = 13):array{
			
			$bdd = DbConnect::DbConnect(new DbConnect());

			try{
			    $sql = $bdd->prepare("SELECT
										`car`.`id_car`,
										`brand`.`name` AS `brand`,
										`model`.`name` AS `model`,
										`motorization`.`name` AS `motorization`,
										`car`.`year`,
										`car`.`mileage`,
										`car`.`price`,
										`car`.`sold`,
										`car`.`description`,
										`car`.`image1`,
										`car`.`image2`,
										`car`.`image3`,
										`car`.`image4`,
										`car`.`image5`

									FROM `car`

									LEFT JOIN `brand`
										ON `car`.`id_brand` = `brand`.`id_brand`
									LEFT JOIN `model`
										ON `car`.`id_model` = `model`.`id_model`
									LEFT JOIN `motorization`
										ON `car`.`id_motorization` = `motorization`.`id_motorization`

									WHERE $whereClause
									ORDER BY :orderBy :ascOrDesc
									LIMIT :firstLine, :linePerPage");
				
				$sql->bindParam(':orderBy', $orderBy, PDO::PARAM_STR);
				$sql->bindParam(':ascOrDesc', $ascOrDesc, PDO::PARAM_STR);
				$sql->bindParam(':firstLine', $firstLine, PDO::PARAM_INT);
				$sql->bindParam(':linePerPage', $linePerPage, PDO::PARAM_INT);

				$sql->execute();
				
				$this->carList = $sql->fetchAll(PDO::FETCH_ASSOC);

				$_SESSION['other']['error'] = false;
				$_SESSION['other']['message'] = "The car list is loaded with success!!!";

			}catch (PDOException $e){
				$_SESSION['other']['error'] = true;
				$_SESSION['other']['message'] = "Error to load car list : " . $e->getMessage();
			}

			$bdd=null;
			return $this->carList;
		}

		//-----------------------------------------------------------------------
		
		private $insertCar = 0;
		public function insertCar():int{

			$bdd = DbConnect::DbConnect(new DbConnect());

			try{
				$stmt = $bdd->prepare("INSERT INTO `car` (`id_brand`,
															`id_model`,
															`id_motorization`,
															`year`, `mileage`,
															`price`,
															`sold`,
															`description`,
															`image1`,
															`image2`,
															`image3`,
															`image4`,
															`image5`)
										VALUES ((SELECT `id_brand` FROM `brand` WHERE `name` = :brand),
												(SELECT `id_model` FROM `model` WHERE `name` = :model),
												(SELECT `id_motorization` FROM `motorization` WHERE `name` = :motorization),
												:year_,
												:mileage,
												:price,
												:sold,
												:description,
												:image1,
												:image2,
												:image3,
												:image4,
												:image5)");

				$stmt->bindParam(':brand', $this->brand, PDO::PARAM_STR);
				$stmt->bindParam(':model', $this->model, PDO::PARAM_STR);
				$stmt->bindParam(':motorization', $this->motorization, PDO::PARAM_STR);
				
				$yearInt = intval($this->year);
				$stmt->bindParam(':year_', $yearInt, PDO::PARAM_INT);
				
				$mileageInt = intval($this->mileage);
				$stmt->bindParam(':mileage', $mileageInt, PDO::PARAM_INT);
				
				$priceInt = intval($this->price);
				$stmt->bindParam(':price', $priceInt, PDO::PARAM_INT);

				$stmt->bindParam(':sold', $this->sold, PDO::PARAM_STR);
				$stmt->bindParam(':description', $this->description, PDO::PARAM_STR);
				$stmt->bindParam(':image1', $this->image1, PDO::PARAM_STR);
				$stmt->bindParam(':image2', $this->image2, PDO::PARAM_STR);
				$stmt->bindParam(':image3', $this->image3, PDO::PARAM_STR);
				$stmt->bindParam(':image4', $this->image4, PDO::PARAM_STR);
				$stmt->bindParam(':image5', $this->image5, PDO::PARAM_STR);
				
				$stmt->execute();

				$stmt = $bdd->query("SELECT MAX(`id_car`) FROM `car`");

				$this->insertCar = intval($stmt->fetchColumn());

				$_SESSION['other']['error'] = false;
				$_SESSION['other']['message'] = "The car is inserted with success!!!";

			}catch(PDOException $e){
				$_SESSION['other']['error'] = true;
				$_SESSION['other']['message'] = "Error to insert car : " . $e->getMessage();
			}

			$bdd=null;
			return $this->insertCar;
		}

		//-----------------------------------------------------------------------

		private $updateCar = false;
		public function updateCar(int $id_car):bool{

			$bdd = DbConnect::DbConnect(new DbConnect());

			try{
				$stmt = $bdd->prepare("UPDATE `car`
										SET 
											`id_brand` = (SELECT `id_brand` FROM `brand` WHERE `name` = :brand),
											`id_model` = (SELECT `id_model` FROM `model` WHERE `name` = :model),
											`id_motorization` = (SELECT `id_motorization` FROM `motorization` WHERE `name` = :motorization),
											`year` = :year_,
											`mileage` = :mileage,
											`price` = :price,
											`sold` = :sold,
											`description` = :description_,
											`image1` = :image1,
											`image2` = :image2,
											`image3` = :image3,
											`image4` = :image4,
											`image5` = :image5
										WHERE `id_car` = :id_car");
				
				$stmt->bindParam(':brand', $this->brand, PDO::PARAM_STR);
				$stmt->bindParam(':model', $this->model, PDO::PARAM_STR);
				$stmt->bindParam(':motorization', $this->motorization, PDO::PARAM_STR);
				
				$yearInt = intval($this->year);
				$stmt->bindParam(':year_', $yearInt, PDO::PARAM_INT);
				
				$mileageInt = intval($this->mileage);
				$stmt->bindParam(':mileage', $mileageInt, PDO::PARAM_INT);
				
				$priceInt = intval($this->price);
				$stmt->bindParam(':price', $priceInt, PDO::PARAM_INT);

				$stmt->bindParam(':sold', $this->sold, PDO::PARAM_STR);
				$stmt->bindParam(':description_', $this->description, PDO::PARAM_STR);
				$stmt->bindParam(':image1', $this->image1, PDO::PARAM_STR);
				$stmt->bindParam(':image2', $this->image2, PDO::PARAM_STR);
				$stmt->bindParam(':image3', $this->image3, PDO::PARAM_STR);
				$stmt->bindParam(':image4', $this->image4, PDO::PARAM_STR);
				$stmt->bindParam(':image5', $this->image5, PDO::PARAM_STR);
				
				$stmt->bindParam(':id_car', $id_car, PDO::PARAM_INT);

				$stmt->execute();

				$_SESSION['other']['error'] = false;
				$_SESSION['other']['message'] = "The car with id " . $id_car . " is updated with success!!!";

				$this->updateCar = true;

			}catch(PDOException $e){
				$_SESSION['other']['error'] = true;
				$_SESSION['other']['message'] = "Error to update car with id " . $id_car . " : " . $e->getMessage();
			}

			$bdd = null;
			return $this->updateCar;
		}


		//-----------------------------------------------------------------------
		private $deleteCar = false;
		public function deleteCar(int $id_car):bool{
			
			if(self::checkIdCar($id_car)){

				$bdd = DbConnect::DbConnect(new DbConnect());

				try{
					$stmt = $bdd->prepare('DELETE FROM car WHERE id_car = :id_car');
					$stmt->bindParam(':id_car', $id_car, PDO::PARAM_INT);
					$stmt->execute();

					$_SESSION['other']['error'] = false;
					$_SESSION['other']['message'] = "The car with id " . $id_car . " is delete with success!!!";

					$this->deleteCar = true;

				}catch(PDOException $e){
					$_SESSION['other']['error'] = true;
					$_SESSION['other']['message'] = "Error to delete car : " . $e->getMessage();
				}

			}else{
				$_SESSION['other']['error'] = true;
				$_SESSION['other']['message'] = "The car with id " . $id_car . " is not existing!!!";
			}

			$bdd = null;
			return $this->deleteCar;
		}


		//-----------------------------------------------------------------------

		private $checkCar = 0;
		public function checkCar(string $brand, string $model, string $motorization, int $year, int $mileage, int $price):int{
			$bdd = DbConnect::DbConnect(new DbConnect());

			try{
				$stmt = $bdd->prepare("SELECT COUNT(*) AS `number`
										FROM `car`
										WHERE `id_brand` = (SELECT `id_brand` FROM `brand` WHERE `name` = :brand)
										AND `id_model` = (SELECT `id_model` FROM `model` WHERE `name` = :model)
										AND `id_motorization` = (SELECT `id_motorization` FROM `motorization` WHERE `name` = :motorization)
										AND `year` = :year_
										AND `mileage` = :mileage
										AND `price` = :price");

				$stmt->bindParam(':brand', $brand, PDO::PARAM_STR);
				$stmt->bindParam(':model', $model, PDO::PARAM_STR);
				$stmt->bindParam(':motorization', $motorization, PDO::PARAM_STR);

				$yearInt = intval($year);
				$stmt->bindParam(':year_', $yearInt, PDO::PARAM_INT);

				$mileageInt = intval($mileage);
				$stmt->bindParam(':mileage', $mileageInt, PDO::PARAM_INT);

				$priceInt = intval($price);
				$stmt->bindParam(':price', $priceInt, PDO::PARAM_INT);

				$stmt->execute();

				$this->checkCar = $stmt->fetchColumn();

				if($this->checkCar > 0){
					$_SESSION['other']['error'] = false;
					$_SESSION['other']['message'] = "This car is existent!!!";
				}else{
					$_SESSION['other']['error'] = false;
					$_SESSION['other']['message'] = "This car is not existent!!!";
				}

			}catch(PDOException $e){
				$_SESSION['other']['error'] = true;
				$_SESSION['other']['message'] = "Error to check car : " . $e->getMessage();
			}

			$bdd = null;
			return $this->checkCar;
		}

		private static $checkIdCar = false;
		public static function checkIdCar(int $id_car):bool{

			$bdd = DbConnect::DbConnect(new DbConnect());
			
			try{
				$stmt = $bdd->prepare("SELECT COUNT(*) FROM `car` WHERE `id_car` = :id_car");
				$stmt->bindParam(':id_car', $id_car, PDO::PARAM_STR);

				$stmt->execute();

				$result = $stmt->fetchColumn();

				if($result > 0){
					self::$checkIdCar = true;
					$_SESSION['other']['message'] = "This id_car is existent!!!";
				}else{
					$_SESSION['other']['message'] = "This id_car is not existent!!!";
				}

				$_SESSION['other']['error'] = false;

			}catch(PDOException $e){
				$_SESSION['other']['error'] = true;
				$_SESSION['other']['message'] = "Error to function checkIdCar() in car.class.php:" . $e->getMessage();
			}

			$bdd=null;
			return self::$checkIdCar;
		}

		//-----------------------------------------------------------------------
		
		private static  $checkNbOfProduct = 0;
		public static function checkNbOfProduct(string $whereClause):int{

			$bdd = DbConnect::DbConnect(new DbConnect());
			
			try{
				$stmt = $bdd->prepare("SELECT * FROM `car` WHERE $whereClause ");
				$stmt->execute();
				self::$checkNbOfProduct = $stmt->fetchColumn();

				$bdd=null;

				$_SESSION['other']['error'] = false;
				$_SESSION['other']['message'] = "The query is executed correctly!!!";

			}catch(PDOException $e){
				$bdd=null;
				$_SESSION['other']['error'] = true;
				$_SESSION['other']['message'] = "Error to function checkNbOfProduct() in user.class.php:" . $e->getMessage();
				return self::$checkNbOfProduct;
			}

			return self::$checkNbOfProduct;
		}

		private static $checkNbOfCar = 0;
		public static function getCheckNbOfCar(string $whereClause):int{
			
			$bdd = DbConnect::DbConnect(new DbConnect());

			try{
			    $sql = $bdd->prepare("SELECT
										`car`.`id_car`,
										`brand`.`name` AS `brand`,
										`model`.`name` AS `model`,
										`car`.`year`,
										`car`.`mileage`

									FROM `car`

									LEFT JOIN `brand`
										ON `car`.`id_brand` = `brand`.`id_brand`
									LEFT JOIN `model`
										ON `car`.`id_model` = `model`.`id_model`

									WHERE $whereClause");
				
				$sql->execute();
				
				$result = $sql->fetchAll(PDO::FETCH_ASSOC);

				self::$checkNbOfCar = count($result);

				$_SESSION['other']['error'] = false;
				$_SESSION['other']['message'] = "The car list is loaded with success!!!";

			}catch (PDOException $e){
				$_SESSION['other']['error'] = true;
				$_SESSION['other']['message'] = "Error to load car list : " . $e->getMessage();
			}

			$bdd=null;
			return self::$checkNbOfCar;
		}

	}
	
?>