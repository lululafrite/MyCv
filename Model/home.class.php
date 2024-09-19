<?php

	namespace MyCv\Model;
	
    $current_url = $_SERVER['REQUEST_URI'];
    $goldorak = '/goldorak/';
    $garageParrot = '/garageparrot/';

    if(preg_match($goldorak, $current_url) || preg_match($garageParrot, $current_url)){

		require_once('../../model/dbConnect.class.php');

    }else{

		require_once('../model/dbConnect.class.php');

    }

	use \PDO;
	use \PDOException;
	use MyCv\Model\dbConnect;

	class Home
	{
		private $homeId;
		public function getHomeId()
		{
			return $this->homeId;
		}
		public function setHomeId($new)
		{
			$this->homeId = $new;
		}

		//-----------------------------------------------------------------------

		private $homeTitle;
		public function getHomeTitle()
		{
			return $this->homeTitle;
		}
		public function setHomeTitle($new)
		{
			$this->homeTitle = $new;
		}

		//-----------------------------------------------------------------------

		private $homeSubtitle;
		public function getHomeSubtitle()
		{
			return $this->homeSubtitle;
		}
		public function setHomeSubtitle($new)
		{
			$this->homeSubtitle = $new;
		}

		//-----------------------------------------------------------------------

		private $homeTitlePage;
		public function getHomeTitlePage()
		{
			return $this->homeTitlePage;
		}
		public function setHomeTitlePage($new)
		{
			$this->homeTitlePage = $new;
		}

		//-----------------------------------------------------------------------

		private $theHome;
		public function getHome($idHome){
						
			$myDbConnect = new dbConnect();
			$bdd = $myDbConnect->connectionDb();
            unset($myDbConnect);

			date_default_timezone_set($_SESSION['timeZone']);
			
			try
			{
				$stmt = $bdd->prepare("SELECT
											`home`.`home_id`,
											`home`.`home_title`,
											`home`.`home_subtitle`,
											`home`.`home_title_page`
										FROM `home`
										WHERE `home`.`home_id` = :idHome");
				$stmt->bindParam(':idHome', $idHome, PDO::PARAM_INT);
				$stmt->execute();

				$this->theHome = $stmt->fetch(PDO::FETCH_ASSOC);
				return $this->theHome;
			}
			catch (PDOException $e)
			{
				echo "Erreur de la requête :" . $e->getMessage();
			}

			$bdd = null;
		}

		//-----------------------------------------------------------------------

		private $homeList;
		public function get($whereClause, $orderBy = 'home_id', $ascOrDesc = 'ASC', $firstLine = 0, $linePerPage = 13)
		{
			$myDbConnect = new dbConnect();
			$bdd = $myDbConnect->connectionDb();
            unset($myDbConnect);
			
			try
			{
				$stmt = $bdd->prepare("SELECT
											`home`.`home_id`,
											`home`.`home_title`,
											`home`.`home_subtitle`,
											`home`.`home_title_page`
										FROM `home`
										WHERE $whereClause
										ORDER BY $orderBy $ascOrDesc
										LIMIT :firstLine, :linePerPage");
				$stmt->bindParam(':firstLine', $firstLine, PDO::PARAM_INT);
				$stmt->bindParam(':linePerPage', $linePerPage, PDO::PARAM_INT);
				$stmt->execute();

				$this->homeList = $stmt->fetchAll(PDO::FETCH_ASSOC);
				return $this->homeList;
			}
			catch (PDOException $e)
			{
				echo "Erreur de la requête :" . $e->getMessage();
			}

			$bdd = null;
		}

		//-----------------------------------------------------------------------

		public function updateHome($homeId){

			$myDbConnect = new dbConnect();
			$bdd = $myDbConnect->connectionDb();
            unset($myDbConnect);

			try{
				$stmt = $bdd->prepare("UPDATE `home`
										SET `home_title` = :homeTitle,
											`home_subtitle` = :homeSubtitle,
											`home_title_page` = :homeTitlePage
											
										WHERE `home_id` = :homeId");
				
				$stmt->bindParam(':homeTitle', $this->homeTitle, PDO::PARAM_STR);
				$stmt->bindParam(':homeSubtitle', $this->homeSubtitle, PDO::PARAM_STR);
				$stmt->bindParam(':homeTitlePage', $this->homeTitlePage, PDO::PARAM_STR);
				$stmt->bindParam(':homeId', $homeId, PDO::PARAM_INT);
				
				$stmt->execute();
							
			}
			catch (PDOException $e)
			{
				echo "Erreur de la requete :" . $e->GetMessage();
			}

			$bdd=null;
		}

		//-----------------------------------------------------------------------

		public function deleteHome($id): bool{

			$myDbConnect = new dbConnect();
			$bdd = $myDbConnect->connectionDb();
            unset($myDbConnect);
			
			try
			{
				$stmt = $bdd->prepare('DELETE FROM home WHERE home_id = :id');
				$stmt->bindParam(':id', $id, PDO::PARAM_INT);
				$stmt->execute();
				$bdd = null;
				return true;
			}
			catch (PDOException $e)
			{
				$bdd = null;
				echo "Erreur de la requete :" . $e->getMessage();
				return false;
			}

		}

		//-----------------------------------------------------------------------

		public function newHome(): bool{

			$myDbConnect = new dbConnect();
			$bdd = $myDbConnect->connectionDb();
            unset($myDbConnect);
	
			try
			{
				$stmt = $bdd->prepare("INSERT INTO `home` (`home_title`,
															`home_subtitle`,
															`home_title_page`,
															`home_article1_title`) 
										VALUES (:home_title,
												:home_subtitle,
												:home_title_page,
												:home_article1_title)");
	
				$stmt->bindParam(':home_title', $this->homeTitle, PDO::PARAM_STR);
				$stmt->bindParam(':home_subtitle', $this->homeSubtitle, PDO::PARAM_STR);
				$stmt->bindParam(':home_title_page', $this->homeTitlePage, PDO::PARAM_STR);
	
				$stmt->execute();
				$bdd = null;
				return true;
			}
			catch (PDOException $e)
			{
				$bdd = null;
				echo "Erreur de la requête : " . $e->getMessage();
				return false;
			}
		}

	}
	
?>