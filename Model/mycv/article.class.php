<?php

	namespace MyCv\Model;

    require_once('../model/common/dbConnect.class.php');

	use \PDO;
	use \PDOException;
	use Model\DbConnect\DbConnect;

	class HomeArticle
	{
		private $homeArticleId;
		public function getHomeArticleId():int{
			return $this->homeArticleId;
		}
		public function setHomeArticleId(int $new):void{
			$this->homeArticleId = $new;
		}

		//-----------------------------------------------------------------------

		private $homeArticleTitle;
		public function getHomeArticleTitle():string{
			return $this->homeArticleTitle;
		}
		public function setHomeArticleTitle(string $new):void{
			$this->homeArticleTitle = $new;
		}

		//-----------------------------------------------------------------------

		private $homeArticle;
		public function getHomeArticle():string{
			return $this->homeArticle;
		}
		public function setHomeArticle(string $new):void{
			$this->homeArticle = $new;
		}

		//-----------------------------------------------------------------------

		private $homeArticleImg;
		public function getHomeArticleImg():string{
			return $this->homeArticleImg;
		}
		public function setHomeArticleImg(string $new):void{
			$this->homeArticleImg = $new;
		}

		//-----------------------------------------------------------------------

		private $homeArticleImgYesOrNo;
		public function getHomeArticleImgYesOrNo():string{
			return $this->homeArticleImgYesOrNo;
		}
		public function setHomeArticleImgYesOrNo(string $new):void{
			$this->homeArticleImgYesOrNo = $new;
		}

		//-----------------------------------------------------------------------

		private $homeArticleImgRightOrLeft;
		public function getHomeArticleImgRightOrLeft():string{
			return $this->homeArticleImgRightOrLeft;
		}
		public function setHomeArticleImgRightOrLeft(string $new):void{
			$this->homeArticleImgRightOrLeft = $new;
		}

		//-----------------------------------------------------------------------

		private $homeArticleImgWidth;
		public function getHomeArticleImgWidth():string{
			return $this->homeArticleImgWidth;
		}
		public function setHomeArticleImgWidth(string $new):void{
			$this->homeArticleImgWidth = $new;
		}

		//-----------------------------------------------------------------------

		private $homeArticleImgHeight;
		public function getHomeArticleImgHeight():string{
			return $this->homeArticleImgHeight;
		}
		public function setHomeArticleImgHeight(string $new):void{
			$this->homeArticleImgHeight = $new;
		}

		//-----------------------------------------------------------------------

		private $homeArticleImgObjectFit;
		public function getHomeArticleImgObjectFit():string{
			return $this->homeArticleImgObjectFit;
		}
		public function setHomeArticleImgObjectFit(string $new):void{
			$this->homeArticleImgObjectFit = $new;
		}

		//-----------------------------------------------------------------------

		private $homeArticleSort;
		public function getHomeArticleSort():string{
			return $this->homeArticleSort;
		}
		public function setHomeArticleSort(string $new):void{
			$this->homeArticleSort = $new;
		}

		//-----------------------------------------------------------------------

		private $article;
		public function getArticle(int $home_article_id):array{

			$bdd = DbConnect::DbConnect(new DbConnect());
			
			try{
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
										WHERE `home_article`.`home_article_id` = :home_article_id");

				$stmt->bindParam(':home_article_id', $home_article_id, PDO::PARAM_INT);

				$stmt->execute();

				$this->article = $stmt->fetch(PDO::FETCH_ASSOC);

				$_SESSION['other']['error'] = false;
				$_SESSION['other']['message'] = 'Home Article list is found';
			
			}catch (PDOException $e){

				$_SESSION['other']['error'] = true;
				$_SESSION['other']['message'] = 'Error to query :' . $e->getMessage();
				$this->article = false;
			}

			$bdd = null;
			return $this->article;
		}

		//-----------------------------------------------------------------------

		private $articleList;
		public function getArticleList(string $whereClause, string $orderBy = 'home_article_sort', string $ascOrDesc = 'ASC', int $firstLine = 0, int $linePerPage = 13):array{

			$bdd = DbConnect::DbConnect(new DbConnect());
			
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
										ORDER BY :orderBy :ascOrDesc
										LIMIT :firstLine, :linePerPage");

				$stmt->bindParam(':orderBy', $orderBy, PDO::PARAM_STR);
				$stmt->bindParam(':ascOrDesc', $ascOrDesc, PDO::PARAM_STR);
				$stmt->bindParam(':firstLine', $firstLine, PDO::PARAM_INT);
				$stmt->bindParam(':linePerPage', $linePerPage, PDO::PARAM_INT);

				$stmt->execute();

				$this->articleList = $stmt->fetchAll(PDO::FETCH_ASSOC);

				$_SESSION['other']['error'] = false;
				$_SESSION['other']['message'] = 'Home Article list is found';

			}catch (PDOException $e){
				$_SESSION['other']['error'] = true;
				$_SESSION['other']['message'] = 'Error to query :' . $e->getMessage();
				$this->articleList = false;
			}

			$bdd = null;
			return $this->articleList;
		}

		//-----------------------------------------------------------------------

		private $updateArticle = false;
		public function updateArticle(int $home_article_id):bool{

			$bdd = DbConnect::DbConnect(new DbConnect());

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
											
										WHERE `home_article_id` = :home_article_id");
				
				$stmt->bindParam(':homeArticleTitle', $this->homeArticleTitle, PDO::PARAM_STR);
				$stmt->bindParam(':homeArticle', $this->homeArticle, PDO::PARAM_STR);
				$stmt->bindParam(':homeArticleImg', $this->homeArticleImg, PDO::PARAM_STR);
				$stmt->bindParam(':homeArticleImgYesOrNo', $this->homeArticleImgYesOrNo, PDO::PARAM_STR);
				$stmt->bindParam(':homeArticleImgRightOrLeft', $this->homeArticleImgRightOrLeft, PDO::PARAM_STR);
				$stmt->bindParam(':homeArticleImgWidth', $this->homeArticleImgWidth, PDO::PARAM_STR);
				$stmt->bindParam(':homeArticleImgHeight', $this->homeArticleImgHeight, PDO::PARAM_STR);
				$stmt->bindParam(':homeArticleImgObjectFit', $this->homeArticleImgObjectFit, PDO::PARAM_STR);
				$stmt->bindParam(':homeArticleSort', $this->homeArticleSort, PDO::PARAM_STR);
				$stmt->bindParam(':home_article_id', $home_article_id, PDO::PARAM_INT);
				
				$stmt->execute();

				$_SESSION['other']['error'] = false;
				$_SESSION['other']['message'] = "Home Article is updated";

				$this->updateArticle = true;
				
			}catch (PDOException $e){
				$_SESSION['other']['error'] = true;
				$_SESSION['other']['message'] = "Error to query :" . $e->getMessage();
			}

			$bdd = null;
			return $this->updateArticle;
		}

		//-----------------------------------------------------------------------

		private $deleteArticle = false;
		public function deleteArticle(int $home_article_id): bool{

			$bdd = DbConnect::DbConnect(new DbConnect());
			
			try
			{
				$stmt = $bdd->prepare('DELETE FROM home_article WHERE home_article_id = :home_article_id');
				$stmt->bindParam(':home_article_id', $home_article_id, PDO::PARAM_INT);

				$stmt->execute();

				$_SESSION['other']['error'] = false;
				$_SESSION['other']['message'] = "Home Article is deleted";

				$this->deleteArticle = true;

			}catch (PDOException $e){
				$_SESSION['other']['error'] = true;
				$_SESSION['other']['message'] = "Error to query : " . $e->getMessage();
			}
				
			$bdd = null;
			return $this->deleteArticle;
		}

		//-----------------------------------------------------------------------
		private $newArticle = false;
		public function newArticle():bool{

			$bdd = DbConnect::DbConnect(new DbConnect());
	
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

				$_SESSION['other']['error'] = false;
				$_SESSION['other']['message'] = "Home Article is inserted";

				$this->newArticle = true;

			}catch (PDOException $e){
				$_SESSION['other']['error'] = true;
				$_SESSION['other']['message'] = "Error to query : " . $e->getMessage();
			}

			$bdd = null;
			return $this->newArticle;
		}
	}
?>