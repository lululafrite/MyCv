<?php

	namespace GarageParrot\Model;

	require_once('../model/dbConnect.class.php');
	require_once('../model/utilities.class.php');

	use MyCv\Model\dbConnect;
	use MyCv\Model\Utilities;
	use \PDO;
	use \PDOException;

	class Brand
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

		private $brand;
		public function getBrand(int $id_brand): array{

			if(Utilities::checkData('brand','id_brand', $id_brand)){

				$bdd = dbConnect::dbConnect(new dbConnect());
			
				try{
					$sql = $bdd->prepare("SELECT
											`brand`.`id_brand`,
											`brand`.`name`

										FROM `brand`
										
										WHERE `brand`.`id_brand`=:id_brand
									");

					$sql->bindParam(':id_brand', $id_brand, PDO::PARAM_INT);
					$sql->execute();

					$bdd=null;

					$this->brand = $sql->fetch(PDO::FETCH_ASSOC);
					$this->brand['error'] = false;
					$this->brand['message'] = 'The query is executed correctly!!!';

					return $this->brand;
				}catch (PDOException $e){
					$bdd=null;

					$this->brand['error'] = true;
					$this->brand['message'] = 'Error to query : ' . $e->getMessage();
					
					return $this->brand;
				}
			}else{
				$bdd=null;

				$this->brand['error'] = true;
				$this->brand['message'] = 'To id is not existing!!!';
				
				return $this->brand;
			}
		}

		//-----------------------------------------------------------------------

		private $brandList;
		public function getBrandList(string $whereClause, string $orderBy = 'name', string $ascOrDesc = 'ASC', int $firstLine = 0, int $linePerPage = 13): array{
			
			$bdd = dbConnect::dbConnect(new dbConnect());
			
			try{
			    $stmt = $bdd->prepare("SELECT
										`brand`.`id_brand`,
										`brand`.`name`
									FROM
										`brand`

									WHERE $whereClause
									ORDER BY :orderBy :ascOrDesc
									LIMIT :firstLine, :linePerPage
								");

				$stmt->bindParam(':orderBy', $orderBy, PDO::PARAM_STR);
				$stmt->bindParam(':ascOrDesc', $ascOrDesc, PDO::PARAM_STR);
				$stmt->bindParam(':firstLine', $firstLine, PDO::PARAM_INT);
				$stmt->bindParam(':linePerPage', $linePerPage, PDO::PARAM_INT);

				$stmt->execute();

				$bdd=null;

				$this->brandList = $stmt->fetchAll(PDO::FETCH_ASSOC);
				$this->brandList['error'] = false;
				$this->brandList['message'] = 'The query is executed correctly!!!';
				
				return $this->brandList;

			}catch (PDOException $e){
				$bdd=null;

				$this->brandList['error'] = true;
				$this->brandList['message'] = 'Error to query : ' . $e->getMessage();

				return $this->brandList;
			}
		}

		//-----------------------------------------------------------------------
		private $insertBrand = array();
		public function insertBrand(): array{

			if(!Utilities::checkData('brand','name', $this->name)){

				$bdd = dbConnect::dbConnect(new dbConnect());

				try{
					$bdd->exec("INSERT INTO `brand`(`name`)
								VALUES('" . $this->name . "')");
		
					$stmt = $bdd->prepare("SELECT MAX(`id_brand`) AS id FROM `brand`");
					$stmt->execute();
					$this->insertBrand = $stmt->fetch(PDO::FETCH_ASSOC);

					$this->insertBrand['id_brand'] = intval($this->insertBrand['id']);
					$this->insertBrand['erreur'] = false;
					$this->insertBrand['message'] = "Brand is insert with success!!!";
	
					$bdd = null;
					return $this->insertBrand;

				} catch (PDOException $e) {

					$this->insertBrand['id_brand'] = 0;
					$this->insertBrand['erreur'] = true;
					$this->insertBrand['message'] = "Error to insert brand : " . $e->getMessage();
	
					$bdd = null;
					return $this->insertBrand;

				}

			}else{

				$this->insertBrand['id_brand'] = 0;
				$this->insertBrand['erreur'] = true;
				$this->insertBrand['message'] = "Ce nom existe déjà!!!";

				$bdd = null;
				return $this->insertBrand;
			}
		}

		//-----------------------------------------------------------------------
		private $updateBrand = array();
		public function updateBrand($id_brand): array{
			
			if(Utilities::checkData('brand','id_brand', $id_brand)){

				$bdd = dbConnect::dbConnect(new dbConnect());

				try{
					$stmt = $bdd->prepare('UPDATE `brand` SET `name` = :name WHERE `id_brand` = :id_brand');

					$stmt->bindParam(':name', $this->name, PDO::PARAM_STR);
					$stmt->bindParam(':id_brand', $id_brand, PDO::PARAM_INT);

					$stmt->execute();

					$bdd=null;
					
					$this->updateBrand['erreur'] = false;
					$this->updateBrand['message'] = "Brand is modifications with success!!!";

					return $this->updateBrand;

				}catch (PDOException $e){

					$bdd=null;
					
					$this->updateBrand['erreur'] = true;
					$this->updateBrand['message'] = "Error to update brand : " . $e->getMessage();

					return $this->updateBrand;
				}
			}else{
				
				$this->updateBrand['erreur'] = true;
				$this->updateBrand['message'] = "This brand is not existing!!!";

				return $this->updateBrand;
			}
		}

		//-----------------------------------------------------------------------
		private $deleteBrand = array();
		public function deleteBrand($id_brand):array{
			
			if(Utilities::checkData('brand','id_brand', $id_brand)){

				$bdd = dbConnect::dbConnect(new dbConnect());

				try{
					$stmt = $bdd->prepare('DELETE FROM brand WHERE id_brand = :id_brand');
					$stmt->bindParam(':id_brand', $id_brand, PDO::PARAM_INT);
					$stmt->execute();
					
					$bdd=null;

					$this->deleteBrand['erreur'] = false;
					$this->deleteBrand['message'] = "Brand is delete with success!!!";

					return $this->deleteBrand;

				}catch (PDOException $e){

					$bdd=null;
	
					$this->deleteBrand['erreur'] = true;
					$this->deleteBrand['message'] = "Error to delete brand : " . $e->getMessage();
	
					return $this->deleteBrand;
				}
			}else{

				$bdd=null;
				$this->deleteBrand['erreur'] = true;
				$this->deleteBrand['message'] = "This brand is not existing!!!";

				return $this->deleteBrand;
			}
		}

        //__Ajouter user?___________________________________________
        
        /*public function getAddBrand()
        {
            if(is_null($_SESSION['car']['addBrand']))
            {
                $_SESSION['car']['addBrand']=false;
            }
            return $_SESSION['car']['addBrand'];
        }
        public function setAddBrand($new)
        {
            $_SESSION['car']['addBrand']=$new;
        }*/

	}
	
?>