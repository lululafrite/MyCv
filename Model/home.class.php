<?php

	namespace MyCv\Model;
	use \PDO;
	use \PDOException;

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

		private $homeArticle1Title;
		public function getHomeArticle1Title()
		{
			return $this->homeArticle1Title;
		}
		public function setHomeArticle1Title($new)
		{
			$this->homeArticle1Title = $new;
		}

		//-----------------------------------------------------------------------

		private $homeArticle1;
		public function getHomeArticle1()
		{
			return $this->homeArticle1;
		}
		public function setHomeArticle1($new)
		{
			$this->homeArticle1 = $new;
		}

		//-----------------------------------------------------------------------

		private $homeArticle1Img;
		public function getHomeArticle1Img()
		{
			return $this->homeArticle1Img;
		}
		public function setHomeArticle1Img($new)
		{
			$this->homeArticle1Img = $new;
		}

		//-----------------------------------------------------------------------

		private $homeArticle2Title;
		public function getHomeArticle2Title()
		{
			return $this->homeArticle2Title;
		}
		public function setHomeArticle2Title($new)
		{
			$this->homeArticle2Title = $new;
		}

		//-----------------------------------------------------------------------

		private $homeArticle2;
		public function getHomeArticle2()
		{
			return $this->homeArticle2;
		}
		public function setHomeArticle2($new)
		{
			$this->homeArticle2 = $new;
		}

		//-----------------------------------------------------------------------

		private $homeArticle2Img;
		public function getHomeArticle2Img()
		{
			return $this->homeArticle2Img;
		}
		public function setHomeArticle2Img($new)
		{
			$this->homeArticle2Img = $new;
		}

		//-----------------------------------------------------------------------

		private $theHome;
		public function getHome($idHome)
		{
			require_once('../model/dbConnect.class.php');
			
			$dbConnect_ = new dbConnect();
			$bdd = $dbConnect_->connectionDb();
            unset($dbConnect_);

			date_default_timezone_set($_SESSION['timeZone']);
			
			try
			{
				$stmt = $bdd->prepare("SELECT
											`home`.`home_id`,
											`home`.`home_title`,
											`home`.`home_subtitle`,
											`home`.`home_title_page`,
											`home`.`home_article1_title`,
											`home`.`home_article1`,
											`home`.`home_article1_img`,
											`home`.`home_article2_title`,
											`home`.`home_article2`,
											`home`.`home_article2_img`
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
			require_once('../model/dbConnect.class.php');
			$dbConnect_ = new dbConnect();
			$bdd = $dbConnect_->connectionDb();
            unset($dbConnect_);
			
			try
			{
				$stmt = $bdd->prepare("SELECT
											`home`.`home_id`,
											`home`.`home_title`,
											`home`.`home_subtitle`,
											`home`.`home_title_page`,
											`home`.`home_article1_title`,
											`home`.`home_article1`,
											`home`.`home_article1_img`,
											`home`.`home_article2_title`,
											`home`.`home_article2`,
											`home`.`home_article2_img`
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

		public function updateHome($homeId)
		{
			require_once('../model/dbConnect.class.php');
			$dbConnect_ = new dbConnect();
			$bdd = $dbConnect_->connectionDb();
            unset($dbConnect_);

			try{
				$stmt = $bdd->prepare("UPDATE `home`
										SET `home_title` = :homeTitle,
											`home_subtitle` = :homeSubtitle,
											`home_title_page` = :homeTitlePage,
											`home_article1_title` = :homeArticle1Title,
											`home_article1` = :homeArticle1,
											`home_article1_img` = :homeArticle1Img,
											`home_article2_title` = :homeArticle2Title,
											`home_article2` = :homeArticle2,
											`home_article2_img` = :homeArticle2Img
											
										WHERE `home_id` = :homeId");
				
				$stmt->bindParam(':homeTitle', $this->homeTitle, PDO::PARAM_STR);
				$stmt->bindParam(':homeSubtitle', $this->homeSubtitle, PDO::PARAM_STR);
				$stmt->bindParam(':homeTitlePage', $this->homeTitlePage, PDO::PARAM_STR);
				$stmt->bindParam(':homeArticle1Title', $this->homeArticle1Title, PDO::PARAM_STR);
				$stmt->bindParam(':homeArticle1', $this->homeArticle1, PDO::PARAM_STR);
				$stmt->bindParam(':homeArticle1Img', $this->homeArticle1Img, PDO::PARAM_STR);
				$stmt->bindParam(':homeArticle2Title', $this->homeArticle2Title, PDO::PARAM_STR);
				$stmt->bindParam(':homeArticle2', $this->homeArticle2, PDO::PARAM_STR);
				$stmt->bindParam(':homeArticle2Img', $this->homeArticle2Img, PDO::PARAM_STR);
				$stmt->bindParam(':homeId', $homeId, PDO::PARAM_INT);
				
				$stmt->execute();
							
				//echo '<script>alert("Les modifications sont enregistrées!");</script>';
			}
			catch (PDOException $e)
			{
				echo "Erreur de la requete :" . $e->GetMessage();
			}

			$bdd=null;
		}

		//-----------------------------------------------------------------------

		public function deleteHome($id): bool{
			require_once('../model/dbConnect.class.php');
			$dbConnect_ = new dbConnect();
			$bdd = $dbConnect_->connectionDb();
            unset($dbConnect_);
			
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

		public function newHome(): bool{

			require_once('../model/dbConnect.class.php');
			$dbConnect_ = new dbConnect();
			$bdd = $dbConnect_->connectionDb();
            unset($dbConnect_);
	
			try
			{
				$stmt = $bdd->prepare("INSERT INTO `home` (`home_title`,
															`home_subtitle`,
															`home_title_page`,
															`home_article1_title`,
															`home_article1`,
															`home_article1_img`,
															`home_article2_title`,
															`home_article2`,
															`home_article2_img`) 
										VALUES (:home_title,
												:home_subtitle,
												:home_title_page,
												:home_article1_title,
												:home_article1,
												:home_article1_img,
												:home_article2_title,
												:home_article2,
												:home_article2_img)");
	
				$stmt->bindParam(':home_title', $this->homeTitle, PDO::PARAM_STR);
				$stmt->bindParam(':home_subtitle', $this->homeSubtitle, PDO::PARAM_STR);
				$stmt->bindParam(':home_title_page', $this->homeTitlePage, PDO::PARAM_STR);
				$stmt->bindParam(':home_article1_title', $this->homeArticle1Title, PDO::PARAM_STR);
				$stmt->bindParam(':home_article1', $this->homeArticle1, PDO::PARAM_STR);
				$stmt->bindParam(':home_article1_img', $this->homeArticle1Img, PDO::PARAM_STR);
				$stmt->bindParam(':home_article2_title', $this->homeArticle2Title, PDO::PARAM_STR);
				$stmt->bindParam(':homeArticle2', $this->homeArticle2, PDO::PARAM_STR);
				$stmt->bindParam(':home_article2_img', $this->homeArticle2Img, PDO::PARAM_STR);
	
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