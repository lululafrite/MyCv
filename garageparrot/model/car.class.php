<?php
	namespace GarageParrot\Model;

	require_once('../../model/dbConnect.class.php');

	use \PDO;
	use \PDOException;
	use MyCv\Model\dbConnect;

	class Car
	{
		private $id_car;
		public function getId()
		{
			return $this->id_car;
		}
		public function setId($new)
		{
			$this->id_car = $new;
		}

		//-----------------------------------------------------------------------

		private $brand;
		public function getBrand()
		{
			return $this->brand;
		}
		public function setBrand($new)
		{
			$this->brand = $new;
		}

		//-----------------------------------------------------------------------

		private $model;
		public function getModel()
		{
			return $this->model;
		}
		public function setModel($new)
		{
			$this->model = $new;
		}

		//-----------------------------------------------------------------------

		private $motorization;
		public function getMotorization()
		{
			return $this->motorization;
		}
		public function setMotorization($new)
		{
			$this->motorization = $new;
		}

		//-----------------------------------------------------------------------

		private $year;
		public function getYear()
		{
			return $this->year;
		}
		public function setYear($new)
		{
			$this->year = $new;
		}

		//-----------------------------------------------------------------------

		private $mileage;
		public function getMileage()
		{
			return $this->mileage;
		}
		public function setMileage($new)
		{
			$this->mileage = $new;
		}

		//-----------------------------------------------------------------------

		private $price;
		public function getPrice()
		{
			return $this->price;
		}
		public function setPrice($new)
		{
			$this->price = $new;
		}

		//-----------------------------------------------------------------------

		private $sold;
		public function getSold()
		{
			return $this->sold;
		}
		public function setSold($new)
		{
			$this->sold = $new;
		}

		//-----------------------------------------------------------------------

		private $description;
		public function getDescription()
		{
			return $this->description;
		}
		public function setDescription($new)
		{
			$this->description = $new;
		}
		//-----------------------------------------------------------------------

		private $image1;
		public function getImage1()
		{
			return $this->image1;
		}
		public function setImage1($new)
		{
			$this->image1 = $new;
		}

		//-----------------------------------------------------------------------

		private $image2;
		public function getImage2()
		{
			return $this->image2;
		}
		public function setImage2($new)
		{
			$this->image2 = $new;
		}

		//-----------------------------------------------------------------------

		private $image3;
		public function getImage3()
		{
			return $this->image3;
		}
		public function setImage3($new)
		{
			$this->image3 = $new;
		}

		//-----------------------------------------------------------------------

		private $image4;
		public function getImage4()
		{
			return $this->image4;
		}
		public function setImage4($new)
		{
			$this->image4 = $new;
		}

		//-----------------------------------------------------------------------

		private $image5;
		public function getImage5()
		{
			return $this->image5;
		}
		public function setImage5($new)
		{
			$this->image5 = $new;
		}

		//-----------------------------------------------------------------------

		private $newCar;
		public function getNewCar()
		{
			if(empty($_SESSION['car']['newCar'])){
				$_SESSION['car']['newCar'] = false;
				$this->newCar = false;
			}
			return $_SESSION['car']['newCar'];
		}
		public function setNewCar($new)
		{
			$_SESSION['car']['newCar'] = $new;
			$this->newCar = $new;
		}

		//-----------------------------------------------------------------------

		private $currentCar;
		public function getCurrentCar(int $id_car)
		{
			$bdd = dbConnect::dbConnect(new dbConnect());

			try {
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

				$this->currentCar = $stmt->fetchAll(PDO::FETCH_ASSOC);
				return $this->currentCar;

			}catch(PDOException $e){

				echo '<script>alert("Erreur de la requête : ' . $e->getMessage() . '");</script>';

			}

			$bdd = null;

		}

		//-----------------------------------------------------------------------

		private $carList;
		public function get($whereClause, $orderBy = 'price', $ascOrDesc = 'ASC', $firstLine = 0, $linePerPage = 13)
		{
			$bdd = dbConnect::dbConnect(new dbConnect());

			try
			{
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
									ORDER BY `$orderBy` $ascOrDesc
									LIMIT :firstLine, :linePerPage
								");
				
				$sql->bindParam(':firstLine', $firstLine, PDO::PARAM_INT);
				$sql->bindParam(':linePerPage', $linePerPage, PDO::PARAM_INT);
				$sql->execute();
				

				$this->carList = $sql->fetchAll(PDO::FETCH_ASSOC);
				return $this->carList;
			}
			catch (PDOException $e)
			{
				echo '<script>alert("Erreur de la requête : ' . $e->getMessage() . '");</script>';
			}

			$bdd=null;
		}

		//-----------------------------------------------------------------------

		public function InsertCar()
		{
			$bdd = dbConnect::dbConnect(new dbConnect());

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
												:description_,
												:image1,
												:image2,
												:image3,
												:image4,
												:image5)");

				// Liaison des valeurs
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
				
				$stmt->execute();

				$stmt = $bdd->query("SELECT MAX(`id_car`) FROM `car`");
				$maxId = $stmt->fetchColumn();
				$this->id_car = intval($maxId);
				return $this->id_car;

			}catch(PDOException $e){
				
				echo '<script>alert("Erreur de la requête : ' . $e->getMessage() . '");</script>';

			}

			$bdd=null;
		}

		//-----------------------------------------------------------------------

		public function updateCar($idCar)
		{
			$bdd = dbConnect::dbConnect(new dbConnect());

			try {
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
										WHERE `id_car` = :idCar");
				
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
				
				$idCar = intval($idCar);
				$stmt->bindParam(':idCar', $idCar, PDO::PARAM_INT);

				$stmt->execute();

				echo '<script>alert("Les modifications sont enregistrées!");</script>';

			} catch (PDOException $e) {

				echo '<script>alert("Erreur de la requête : ' . $e->getMessage() . '");</script>';

			}

			$bdd = null;

		}


		//-----------------------------------------------------------------------
		private $deleteCar = false;
		public function deleteCar(int $id_car):bool{
			
			if(self::checkIdCar($id_car)){

				$bdd = dbConnect::dbConnect(new dbConnect());

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
		private $carExist;
		public function verifCar($brand, $model, $motorization, $year, $mileage, $price)
		{
			$bdd = dbConnect::dbConnect(new dbConnect());

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

				//$this->carExist = $stmt->fetch(PDO::FETCH_ASSOC);
				//return $this->carExist['number'];

				$count = $stmt->fetchColumn();
				return $count > 0;

			}catch(PDOException $e){

				echo '<script>alert("Erreur de la requête : ' . $e->getMessage() . '");</script>';

			}

			$bdd = null;
		}

        //__Ajouter car?___________________________________________
        
        public function getAddCar()
        {
            if(is_null($_SESSION['car']['addCar']))
            {
                $_SESSION['car']['addCar']=false;
            }
            return $_SESSION['car']['addCar'];
        }
        public function setAddCar($new)
        {
            $_SESSION['car']['addCar']=$new;
        }

		private static $checkIdCar;
		public static function checkIdCar(int $id_car):bool{

			$bdd = dbConnect::dbConnect(new dbConnect());
			
			try{
				$stmt = $bdd->prepare("SELECT COUNT(*) FROM `car` WHERE `id_car` = :id_car");
				$stmt->bindParam(':id_car', $id_car, PDO::PARAM_STR);

				$stmt->execute();

				$result = $stmt->fetchColumn();

				$bdd=null;

				if($result > 0){
					self::$checkIdCar = true;
					$_SESSION['other']['message'] = "This id_car is existent!!!";
				}else{
					self::$checkIdCar = false;
					$_SESSION['other']['message'] = "This id_car is not existent!!!";
				}

				$_SESSION['other']['error'] = false;
				return self::$checkIdCar;

			}catch(PDOException $e){
				$bdd=null;
				$_SESSION['other']['error'] = true;
				$_SESSION['other']['message'] = "Error to function checkIdCar() in car.class.php:" . $e->getMessage();
				return false;
			}
		}

	}
	
?>