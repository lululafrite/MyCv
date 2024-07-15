<?php

	class Brand
	{

		private $id_brand;
		public function getId()
		{
			return $this->id_brand;
		}
		public function setId($new)
		{
			$this->id_brand = $new;
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

		private $theBrand;
		public function getBrand($îdBrand)
		{
			include_once('../../controller/ConfigConnGP.php');
			$conn = connectDB();
            date_default_timezone_set($_SESSION['timeZone']);
			
			try
			{
			    $sql = $conn->query("SELECT
										`brand`.`id_brand`,
										`brand`.`name`

									FROM `brand`
									
									WHERE `brand`.`id_brand`=$îdBrand
								");

				/*while ($this->theContact[] = $sql->fetch());*/
				$this->theBrand[] = $sql->fetch();
				return $this->theBrand;
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
										`brand`.`id_brand`,
										`brand`.`name`
									FROM
										`brand`
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

		public function addBrand()
		{
			include_once('../../controller/ConfigConnGP.php');
			$conn = connectDB();
            date_default_timezone_set($_SESSION['timeZone']);

			try{
				$conn->exec("INSERT INTO `brand`(`name`)
							VALUES('" . $this->name . "')");

				$sql = $conn->query("SELECT MAX(`id_brand`) FROM `brand`");
				$id_brand = $sql->fetch();
				$this->id_brand = intval($id_brand['id_brand']);

				echo '<script>alert("L\'enregistrement est effectué!");</script>';

			} catch (PDOException $e) {
				
				echo "Erreur de la requête : " . $e->getMessage();

			}

			$conn=null;
		}

		//-----------------------------------------------------------------------

		public function updateBrand($idBrand)
		{
			include_once('../../controller/ConfigConnGP.php');
			$conn = connectDB();
            date_default_timezone_set($_SESSION['timeZone']);

			try
			{
				$conn->exec("UPDATE `brand` SET `name` = '" . $this->name . "'
							WHERE `id_brand` = " . intval($idBrand) . "
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

		public function deleteBrand($id)
		{
			include_once('../../controller/ConfigConnGP.php');
			$conn = connectDB();
            date_default_timezone_set($_SESSION['timeZone']);

			try
			{
			    $conn->exec('DELETE FROM brand WHERE id_brand=' . $id);
				echo '<script>alert("Cet enregistrement est supprimé!");</script>';
			}
			catch (PDOException $e)
			{
				echo '<script>alert("Erreur de la requête : ' . $e->getMessage() . '");</script>';
			}

			$conn=null;
		}

        //__Ajouter user?___________________________________________
        
        public function getAddBrand()
        {
            if(is_null($_SESSION['addBrand']))
            {
                $_SESSION['addBrand']=false;
            }
            return $_SESSION['addBrand'];
        }
        public function setAddBrand($new)
        {
            $_SESSION['addBrand']=$new;
        }

	}
	
?>