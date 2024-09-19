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

	class HomeArticle
	{
		private $homeArticleId;
		public function getHomeArticleId()
		{
			return $this->homeArticleId;
		}
		public function setHomeArticleId($new)
		{
			$this->homeArticleId = $new;
		}

		//-----------------------------------------------------------------------

		private $homeArticleTitle;
		public function getHomeArticleTitle()
		{
			return $this->homeArticleTitle;
		}
		public function setHomeArticleTitle($new)
		{
			$this->homeArticleTitle = $new;
		}

		//-----------------------------------------------------------------------

		private $homeArticle;
		public function getHomeArticle()
		{
			return $this->homeArticle;
		}
		public function setHomeArticle($new)
		{
			$this->homeArticle = $new;
		}

		//-----------------------------------------------------------------------

		private $homeArticleImg;
		public function getHomeArticleImg()
		{
			return $this->homeArticleImg;
		}
		public function setHomeArticleImg($new)
		{
			$this->homeArticleImg = $new;
		}

		//-----------------------------------------------------------------------

		private $homeArticleImgYesOrNo;
		public function getHomeArticleImgYesOrNo()
		{
			return $this->homeArticleImgYesOrNo;
		}
		public function setHomeArticleImgYesOrNo($new)
		{
			$this->homeArticleImgYesOrNo = $new;
		}

		//-----------------------------------------------------------------------

		private $homeArticleImgRightOrLeft;
		public function getHomeArticleImgRightOrLeft()
		{
			return $this->homeArticleImgRightOrLeft;
		}
		public function setHomeArticleImgRightOrLeft($new)
		{
			$this->homeArticleImgRightOrLeft = $new;
		}

		//-----------------------------------------------------------------------

		private $homeArticleImgWidth;
		public function getHomeArticleImgWidth()
		{
			return $this->homeArticleImgWidth;
		}
		public function setHomeArticleImgWidth($new)
		{
			$this->homeArticleImgWidth = $new;
		}

		//-----------------------------------------------------------------------

		private $homeArticleImgHeight;
		public function getHomeArticleImgHeight()
		{
			return $this->homeArticleImgHeight;
		}
		public function setHomeArticleImgHeight($new)
		{
			$this->homeArticleImgHeight = $new;
		}

		//-----------------------------------------------------------------------

		private $homeArticleImgObjectFit;
		public function getHomeArticleImgObjectFit()
		{
			return $this->homeArticleImgObjectFit;
		}
		public function setHomeArticleImgObjectFit($new)
		{
			$this->homeArticleImgObjectFit = $new;
		}

		//-----------------------------------------------------------------------

		private $homeArticleSort;
		public function getHomeArticleSort()
		{
			return $this->homeArticleSort;
		}
		public function setHomeArticleSort($new)
		{
			$this->homeArticleSort = $new;
		}


		//-----------------------------------------------------------------------

		private $homeArticleTable;
		public function getHomeArticleTable($homeArticleId)
		{
			require_once('../model/dbConnect.class.php');
			
			$myDbConnect = new dbConnect();
			$bdd = $myDbConnect->connectionDb();
            unset($myDbConnect);

			date_default_timezone_set($_SESSION['timeZone']);
			
			try
			{
				$stmt = $bdd->prepare("SELECT
											`home_article`.`home_article_id`,
											`home_article`.`home_article_title`,
											`home_article`.`home_article_subtitle`,
											`home_article`.`home_article`,
											`home_article`.`home_article_img`,
											`home_article`.`home_article_img_yesOrNo`,
											`home_article`.`home_article_img_rightOrLeft`,
											`home_article`.`home_article_img_width`,
											`home_article`.`home_article_img_height`,
											`home_article`.`home_article_img_objectFit`,
											`home_article`.`home_article_sort`
										FROM `home_article`
										WHERE `home_article`.`home_article_id` = :homeArticleId");

				$stmt->bindParam(':homeArticleId', $homeArticleId, PDO::PARAM_INT);
				$stmt->execute();

				$this->homeArticleTable = $stmt->fetch(PDO::FETCH_ASSOC);
				return $this->homeArticleTable;
			}
			catch (PDOException $e)
			{
				echo "Erreur de la requête :" . $e->getMessage();
			}

			$bdd = null;
		}


		//-----------------------------------------------------------------------

		private $homeArticleList;
		public function get($whereClause, $orderBy = 'home_article_sort', $ascOrDesc = 'ASC', $firstLine = 0, $linePerPage = 13)
		{
			require_once('../model/dbConnect.class.php');
			$myDbConnect = new dbConnect();
			$bdd = $myDbConnect->connectionDb();
            unset($myDbConnect);
			
			try
			{
				$stmt = $bdd->prepare("SELECT
											`home_article`.`home_article_id`,
											`home_article`.`home_article_title`,
											`home_article`.`home_article`,
											`home_article`.`home_article_img`,
											`home_article`.`home_article_img_yesOrNo`,
											`home_article`.`home_article_img_rightOrLeft`,
											`home_article`.`home_article_img_width`,
											`home_article`.`home_article_img_height`,
											`home_article`.`home_article_img_objectFit`,
											`home_article`.`home_article_sort`
										FROM `home_article`
										WHERE $whereClause
										ORDER BY $orderBy $ascOrDesc
										LIMIT :firstLine, :linePerPage");

				$stmt->bindParam(':firstLine', $firstLine, PDO::PARAM_INT);
				$stmt->bindParam(':linePerPage', $linePerPage, PDO::PARAM_INT);
				$stmt->execute();

				$this->homeArticleList = $stmt->fetchAll(PDO::FETCH_ASSOC);
				return $this->homeArticleList;
			}
			catch (PDOException $e)
			{
				echo "Erreur de la requête :" . $e->getMessage();
			}

			$bdd = null;
		}


		//-----------------------------------------------------------------------

		public function updateHomeArticle($homeArticleId)
		{
			require_once('../model/dbConnect.class.php');
			$myDbConnect = new dbConnect();
			$bdd = $myDbConnect->connectionDb();
            unset($myDbConnect);

			try{
				$stmt = $bdd->prepare("UPDATE `home_article`
										SET `home_article_title` = :homeArticleTitle,
											`home_article` = :homeArticle,
											`home_article_img` = :homeArticleImg,
											`home_article_img_yesOrNo` = :homeArticleImgYesOrNo,
											`home_article_img_rightOrLeft` = :homeArticleImgRightOrLeft,
											`home_article_img_width` = :homeArticleImgWidth,
											`home_article_img_height` = :homeArticleImgHeight,
											`home_article_img_objectFit` = :homeArticleImgObjectFit,
											`home_article_sort` = :homeArticleSort
											
										WHERE `home_article_id` = :homeArticleId");
				
				$stmt->bindParam(':homeArticleTitle', $this->homeArticleTitle, PDO::PARAM_STR);
				$stmt->bindParam(':homeArticle', $this->homeArticle, PDO::PARAM_STR);
				$stmt->bindParam(':homeArticleImg', $this->homeArticleImg, PDO::PARAM_STR);
				$stmt->bindParam(':homeArticleImgYesOrNo', $this->homeArticleImgYesOrNo, PDO::PARAM_STR);
				$stmt->bindParam(':homeArticleImgRightOrLeft', $this->homeArticleImgRightOrLeft, PDO::PARAM_STR);
				$stmt->bindParam(':homeArticleImgWidth', $this->homeArticleImgWidth, PDO::PARAM_STR);
				$stmt->bindParam(':homeArticleImgHeight', $this->homeArticleImgHeight, PDO::PARAM_STR);
				$stmt->bindParam(':homeArticleImgObjectFit', $this->homeArticleImgObjectFit, PDO::PARAM_STR);
				$stmt->bindParam(':homeArticleSort', $this->homeArticleSort, PDO::PARAM_STR);
				$stmt->bindParam(':homeArticleId', $homeArticleId, PDO::PARAM_INT);
				
				$stmt->execute();
				
			}
			catch (PDOException $e)
			{
				echo "Erreur de la requete :" . $e->GetMessage();
			}

			$bdd=null;
		}

		//-----------------------------------------------------------------------

		public function deleteHomeArticle($id): bool{
			require_once('../model/dbConnect.class.php');
			$myDbConnect = new dbConnect();
			$bdd = $myDbConnect->connectionDb();
            unset($myDbConnect);
			
			try
			{
				$stmt = $bdd->prepare('DELETE FROM home_article WHERE home_article_id = :id');
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

		public function newHomeArticle(): bool{

			require_once('../model/dbConnect.class.php');
			$myDbConnect = new dbConnect();
			$bdd = $myDbConnect->connectionDb();
            unset($myDbConnect);
	
			try
			{
				$stmt = $bdd->prepare("INSERT INTO `home_article` (`home_article_title`,
															`home_article`,
															`home_article_img`,
															`home_article_img_yesOrNo`,
															`home_article_img_rightOrLeft`,
															`home_article_img_width`,
															`home_article_img_height`,
															`home_article_img_objectFit`,
															`home_article_sort`) 
										VALUES (:homeArticleTitle,
												:homeArticle,
												:homeArticleImg,
												:homeArticleImgYesOrNo,
												:homeArticleImgRightOrLeft,
												:homeArticleImgWidth,
												:homeArticleImgHeight,
												:homeArticleImgObjectFit,
												:homeArticleSort)");
	
				$stmt->bindParam(':homeArticleTitle', $this->homeArticleTitle, PDO::PARAM_STR);
				$stmt->bindParam(':homeArticle', $this->homeArticle, PDO::PARAM_STR);
				$stmt->bindParam(':homeArticleImg', $this->homeArticleImg, PDO::PARAM_STR);
				$stmt->bindParam(':homeArticleImgYesOrNo', $this->homeArticleImgYesOrNo, PDO::PARAM_STR);
				$stmt->bindParam(':homeArticleImgRightOrLeft', $this->homeArticleImgRightOrLeft, PDO::PARAM_STR);
				$stmt->bindParam(':homeArticleImgWidth', $this->homeArticleImgWidth, PDO::PARAM_STR);
				$stmt->bindParam(':homeArticleImgHeight', $this->homeArticleImgHeight, PDO::PARAM_STR);
				$stmt->bindParam(':homeArticleImgObjectFit', $this->homeArticleImgObjectFit, PDO::PARAM_STR);
				$stmt->bindParam(':homeArticleSort', $this->homeArticleSort, PDO::PARAM_STR);
					
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