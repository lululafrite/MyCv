<?php

	namespace Model\Mycv;

    require_once('../model/common/dbConnect.class.php');

	use \PDO;
	use \PDOException;
	use Model\DbConnect\DbConnect;

	class Home
	{
		private $homeId;
		public function getHomeId():int{
			return $this->homeId;
		}
		public function setHomeId(int $new):void{
			$this->homeId = $new;
		}

		//-----------------------------------------------------------------------

		private $homeTitle;
		public function getHomeTitle():string{
			return $this->homeTitle;
		}
		public function setHomeTitle(string $new):void{
			$this->homeTitle = $new;
		}

		//-----------------------------------------------------------------------

		private $homeSubtitle;
		public function getHomeSubtitle():string{
			return $this->homeSubtitle;
		}
		public function setHomeSubtitle($new):void{
			$this->homeSubtitle = $new;
		}

		//-----------------------------------------------------------------------

		private $homeTitlePage;
		public function getHomeTitlePage():string{
			return $this->homeTitlePage;
		}
		public function setHomeTitlePage(string $new):void{
			$this->homeTitlePage = $new;
		}

		//-----------------------------------------------------------------------

		private $getHome;
		public function getHome(int $home_id):array{

			$bdd = DbConnect::DbConnect(new DbConnect());
			
			try{
				$stmt = $bdd->prepare('SELECT `home`.`home_id`,
											  `home`.`home_title`,
											  `home`.`home_subtitle`,
											  `home`.`home_title_page`
										FROM  `home`
										WHERE `home`.`home_id` = :home_id');

				$stmt->bindParam(':home_id', $home_id, PDO::PARAM_INT);

				$stmt->execute();

				$this->getHome = $stmt->fetch(PDO::FETCH_ASSOC);

				$_SESSION['other']['error'] = false;
				$_SESSION['other']['message'] = "Home is existent";

			}catch (PDOException $e){
				$_SESSION['other']['error'] = true;
				$_SESSION['other']['message'] = "Error to requête :" . $e->getMessage();
			}

			$bdd = null;
			return $this->getHome;
		}

		//-----------------------------------------------------------------------

		private $homeList;
		public function getHomeList(string $whereClause, string $orderBy = 'home_id', string $ascOrDesc = 'ASC', int $firstLine = 0, int $linePerPage = 13):array{

			$bdd = DbConnect::DbConnect(new DbConnect());
			
			try{
				$stmt = $bdd->prepare("SELECT
											`home`.`home_id`,
											`home`.`home_title`,
											`home`.`home_subtitle`,
											`home`.`home_title_page`

										FROM `home`

										WHERE $whereClause
										ORDER BY :orderBy :ascOrDesc
										LIMIT :firstLine, :linePerPage");

				$stmt->bindParam(':orderBy', $orderBy, PDO::PARAM_STR);
				$stmt->bindParam(':ascOrDesc', $ascOrDesc, PDO::PARAM_STR);
				$stmt->bindParam(':firstLine', $firstLine, PDO::PARAM_INT);
				$stmt->bindParam(':linePerPage', $linePerPage, PDO::PARAM_INT);

				$stmt->execute();

				$this->homeList = $stmt->fetchAll(PDO::FETCH_ASSOC);

				$_SESSION['other']['error'] = false;
				$_SESSION['other']['message'] = "Home list is existent";

			}catch (PDOException $e){
				$_SESSION['other']['error'] = true;
				$_SESSION['other']['message'] = "Error to requête :" . $e->getMessage();
			}

			$bdd = null;
			return $this->homeList;
		}

		//-----------------------------------------------------------------------
		private $updateHome = false;
		public function updateHome(int $home_id):bool{

			$bdd = DbConnect::DbConnect(new DbConnect());

			try{
				$stmt = $bdd->prepare("UPDATE `home`
										SET `home_title` = :homeTitle,
											`home_subtitle` = :homeSubtitle,
											`home_title_page` = :homeTitlePage
											
										WHERE `home_id` = :home_id");
				
				$stmt->bindParam(':homeTitle', $this->homeTitle, PDO::PARAM_STR);
				$stmt->bindParam(':homeSubtitle', $this->homeSubtitle, PDO::PARAM_STR);
				$stmt->bindParam(':homeTitlePage', $this->homeTitlePage, PDO::PARAM_STR);
				$stmt->bindParam(':home_id', $home_id, PDO::PARAM_INT);
				
				$stmt->execute();

				$_SESSION['other']['error'] = false;
				$_SESSION['other']['message'] = "Home is updated";

				$this->updateHome = true;

			}catch (PDOException $e){
				$_SESSION['other']['error'] = false;
				$_SESSION['other']['message'] = "Error to requête :" . $e->getMessage();
			}

			$bdd = null;
			return $this->updateHome;
		}

		//-----------------------------------------------------------------------
		private $deleteHome = false;
		public function deleteHome(int $home_id):bool{

			$bdd = DbConnect::DbConnect(new DbConnect());
			
			try{
				$stmt = $bdd->prepare('DELETE FROM home WHERE home_id = :home_id');

				$stmt->bindParam(':home_id', $home_id, PDO::PARAM_INT);

				$stmt->execute();

				$_SESSION['other']['error'] = false;
				$_SESSION['other']['message'] = "Home is deleted";

				$this->deleteHome = true;

			}catch(PDOException $e){
				$_SESSION['other']['error'] = true;
				$_SESSION['other']['message'] = "Erreur de la requete :" . $e->getMessage();
			}

			$bdd = null;
			return $this->deleteHome;
		}

		//-----------------------------------------------------------------------
		
		private $insertHome = false;
		public function insertHome():bool{

			$bdd = DbConnect::DbConnect(new DbConnect());
	
			try{
				$stmt = $bdd->prepare("INSERT INTO `home` (`home_title`,
															`home_subtitle`,
															`home_title_page`) 
										VALUES (:home_title,
												:home_subtitle,
												:home_title_page)");
	
				$stmt->bindParam(':home_title', $this->homeTitle, PDO::PARAM_STR);
				$stmt->bindParam(':home_subtitle', $this->homeSubtitle, PDO::PARAM_STR);
				$stmt->bindParam(':home_title_page', $this->homeTitlePage, PDO::PARAM_STR);
	
				$stmt->execute();

				$_SESSION['other']['error'] = false;
				$_SESSION['other']['message'] = "Home is inserted";

				$this->insertHome = true;

			}catch (PDOException $e){
				$_SESSION['other']['error'] = true;
				$_SESSION['other']['message'] = "Erro to query : " . $e->getMessage();
			}

			$bdd = null;
			return $this->insertHome;
		}
	}
?>