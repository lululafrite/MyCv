<?php

	namespace GarageParrot\Model;
	
	$checkUrl = preg_match('/goldorak/', $_SERVER['REQUEST_URI']) || preg_match('/garageparrot/', $_SERVER['REQUEST_URI']);
	if($checkUrl){
		require_once('../../model/dbConnect.class.php');
		require_once('../../model/utilities.class.php');
    }else{
		require_once('../model/dbConnect.class.php');
		require_once('../model/utilities.class.php');
    }

	use MyCv\Model\dbConnect;
	use MyCv\Model\Utilities;
	use \PDO;
	use \PDOException;

	class Home
	{
		private $id_home;
		public function getId():int{
			return $this->id_home;
		}
		public function setId($new):void{
			$this->id_home = $new;
		}

		//-----------------------------------------------------------------------

		private $titre1;
		public function getTitre1():string{
			return $this->titre1;
		}
		public function setTitre1($new):void{
			$this->titre1 = $new;
		}

		//-----------------------------------------------------------------------

		private $intro_chapter1;
		public function getIntro_chapter1():string{
			return $this->intro_chapter1;
		}
		public function setIntro_chapter1($new):void{
			$this->intro_chapter1 = $new;
		}

		//-----------------------------------------------------------------------

		private $intro_chapter2;
		public function getIntro_chapter2():string{
			return $this->intro_chapter2;
		}
		public function setIntro_chapter2($new):void{
			$this->intro_chapter2 = $new;
		}

		//-----------------------------------------------------------------------

		private $titre2;
		public function getTitre2():string{
			return $this->titre2;
		}
		public function setTitre2($new):void{
			$this->titre2 = $new;
		}

		//-----------------------------------------------------------------------

		private $article1_titre;
		public function getArticle1_titre():string{
			return $this->article1_titre;
		}
		public function setArticle1_titre($new):void{
			$this->article1_titre = $new;
		}

		//-----------------------------------------------------------------------

		private $article1_chapter1;
		public function getArticle1_chapter1():string{
			return $this->article1_chapter1;
		}
		public function setArticle1_chapter1($new):void{
			$this->article1_chapter1 = $new;
		}

		//-----------------------------------------------------------------------

		private $article1_image1;
		public function getArticle1_image1():string{
			return $this->article1_image1;
		}
		public function setArticle1_image1($new):void{
			$this->article1_image1 = $new;
		}

		//-----------------------------------------------------------------------

		private $article1_titre2;
		public function getArticle1_titre2():string{
			return $this->article1_titre2;
		}
		public function setArticle1_titre2($new):void{
			$this->article1_titre2 = $new;
		}

		//-----------------------------------------------------------------------

		private $article1_chapter2;
		public function getArticle1_chapter2():string{
			return $this->article1_chapter2;
		}
		public function setArticle1_chapter2($new):void{
			$this->article1_chapter2 = $new;
		}

		//-----------------------------------------------------------------------

		private $article1_image2;
		public function getArticle1_image2():string{
			return $this->article1_image2;
		}
		public function setArticle1_image2($new):void{
			$this->article1_image2 = $new;
		}

		//-----------------------------------------------------------------------

		private $article2_titre;
		public function getArticle2_titre():string{
			return $this->article2_titre;
		}
		public function setArticle2_titre($new):void{
			$this->article2_titre = $new;
		}

		//-----------------------------------------------------------------------

		private $article2_chapter1;
		public function getArticle2_chapter1():string{
			return $this->article2_chapter1;
		}
		public function setArticle2_chapter1($new):void{
			$this->article2_chapter1 = $new;
		}

		//-----------------------------------------------------------------------

		private $article2_image1;
		public function getArticle2_image1():string{
			return $this->article2_image1;
		}
		public function setArticle2_image1($new):void{
			$this->article2_image1 = $new;
		}

		//-----------------------------------------------------------------------

		private $article2_titre2;
		public function getArticle2_titre2():string{
			return $this->article2_titre2;
		}
		public function setArticle2_titre2($new):void{
			$this->article2_titre2 = $new;
		}

		//-----------------------------------------------------------------------

		private $article2_chapter2;
		public function getArticle2_chapter2():string{
			return $this->article2_chapter2;
		}
		public function setArticle2_chapter2($new):void{
			$this->article2_chapter2 = $new;
		}

		//-----------------------------------------------------------------------

		private $article2_image2;
		public function getArticle2_image2():string{
			return $this->article2_image2;
		}
		public function setArticle2_image2($new):void{
			$this->article2_image2 = $new;
		}

		//-----------------------------------------------------------------------

		private $theHome;
		public function getHome(int $id_home):array{

			if(Utilities::checkData('home','id_home', $id_home)){
				
				$bdd = dbConnect::dbConnect(new dbConnect());

				try{
					$sql = $bdd->prepare("SELECT
											`home`.`id_home`,
											`home`.`titre1`,
											`home`.`intro_chapter1`,
											`home`.`intro_chapter2`,
											`home`.`titre2`,
											`home`.`article1_titre`,
											`home`.`article1_chapter1`,
											`home`.`article1_image1`,
											`home`.`article1_titre2`,
											`home`.`article1_chapter2`,
											`home`.`article1_image2`,
											`home`.`article2_titre`,
											`home`.`article2_chapter1`,
											`home`.`article2_image1`,
											`home`.`article2_titre2`,
											`home`.`article2_chapter2`,
											`home`.`article2_image2`

										FROM `home`

										WHERE `home`.`id_home`=:id_home
									");

					$sql->bindParam(':id_home', $id_home, PDO::PARAM_INT);
					$sql->execute();

					$bdd=null;

					$this->theHome = $sql->fetch(PDO::FETCH_ASSOC);
					$this->theHome['error'] = false;
					$this->theHome['message'] = 'The query is executed correctly!!!';
					
					return $this->theHome;

				}catch (PDOException $e){
					$bdd=null;

					$this->theHome['error'] = true;
					$this->theHome['message'] = 'Error to query : ' . $e->getMessage();
					
					return $this->theHome;
				}
			}else{
				$bdd=null;

				$this->theHome['error'] = true;
				$this->theHome['message'] = 'To id is not existing!!!';
				
				return $this->theHome;
			}
		}

		//-----------------------------------------------------------------------

		private $homeList;
		public function get(string $whereClause, string $orderBy = 'id_home', string $ascOrDesc = 'ASC', int $firstLine = 0, int $linePerPage = 13):array{
				
			$bdd = dbConnect::dbConnect(new dbConnect());
			
			try{
			    $stmt = $bdd->prepare("SELECT
										`home`.`id_home`,
										`home`.`titre1`,
										`home`.`intro_chapter1`,
										`home`.`intro_chapter2`,
										`home`.`titre2`,
										`home`.`article1_titre`,
										`home`.`article1_chapter1`,
										`home`.`article1_image1`,
										`home`.`article1_titre2`,
										`home`.`article1_chapter2`,
										`home`.`article1_image2`,
										`home`.`article2_titre`,
										`home`.`article2_chapter1`,
										`home`.`article2_image1`,
										`home`.`article2_titre2`,
										`home`.`article2_chapter2`,
										`home`.`article2_image2`

									FROM `home`

									WHERE :whereClause
									ORDER BY :orderBy :ascOrDesc
									LIMIT :firstLine, :linePerPage
								");

				$stmt->bindParam(':whereClause', $whereClause, PDO::PARAM_STR);
				$stmt->bindParam(':orderBy', $orderBy, PDO::PARAM_STR);
				$stmt->bindParam(':ascOrDesc', $ascOrDesc, PDO::PARAM_STR);
				$stmt->bindParam(':firstLine', $firstLine, PDO::PARAM_INT);
				$stmt->bindParam(':linePerPage', $linePerPage, PDO::PARAM_INT);

				$stmt->execute();

				$bdd=null;

				$this->homeList = $stmt->fetchAll(PDO::FETCH_ASSOC);
				$this->homeList['error'] = false;
				$this->homeList['message'] = 'The query is executed correctly!!!';

				return $this->homeList;

			}catch (PDOException $e){
				$bdd=null;

				$this->homeList['error'] = true;
				$this->homeList['message'] = 'Error to query : ' . $e->getMessage();

				return $this->homeList;
			}
		}

		//-----------------------------------------------------------------------

		private $updateHome;
		public function updateHome(int $id_home):array{

			if(Utilities::checkData('home','id_home', $id_home)){
				
				$bdd = dbConnect::dbConnect(new dbConnect());
				try{
					$stmt = $bdd->prepare("UPDATE `home`
											SET `titre1` = :titre1,
												`intro_chapter1` = :intro_chapter1,
												`intro_chapter2` = :intro_chapter2,
												`titre2` = :titre2,
												`article1_titre` = :article1_titre,
												`article1_chapter1` = :article1_chapter1,
												`article1_titre2` = :article1_titre2,
												`article1_chapter2` = :article1_chapter2,
												`article2_titre` = :article2_titre,
												`article2_chapter1` = :article2_chapter1,
												`article2_titre2` = :article2_titre2,
												`article2_chapter2` = :article2_chapter2
											WHERE `id_home` = :id_home"
										);

					$stmt->bindParam(':titre1', $this->titre1, PDO::PARAM_STR);
					$stmt->bindParam(':intro_chapter1', $this->intro_chapter1, PDO::PARAM_STR);
					$stmt->bindParam(':intro_chapter2', $this->intro_chapter2, PDO::PARAM_STR);
					$stmt->bindParam(':titre2', $this->titre2, PDO::PARAM_STR);
					$stmt->bindParam(':article1_titre', $this->article1_titre, PDO::PARAM_STR);
					$stmt->bindParam(':article1_chapter1', $this->article1_chapter1, PDO::PARAM_STR);
					$stmt->bindParam(':article1_titre2', $this->article1_titre2, PDO::PARAM_STR);
					$stmt->bindParam(':article1_chapter2', $this->article1_chapter2, PDO::PARAM_STR);
					$stmt->bindParam(':article2_titre', $this->article2_titre, PDO::PARAM_STR);
					$stmt->bindParam(':article2_chapter1', $this->article2_chapter1, PDO::PARAM_STR);
					$stmt->bindParam(':article2_titre2', $this->article2_titre2, PDO::PARAM_STR);
					$stmt->bindParam(':article2_chapter2', $this->article2_chapter2, PDO::PARAM_STR);
					$stmt->bindParam(':id_home', $id_home, PDO::PARAM_INT);

					$stmt->execute();

					$bdd=null;

					$this->updateHome['error'] = false;
					$this->updateHome['message'] = 'The modifications is correctly executed!!!';

					return $this->updateHome;

				}catch(PDOException $e){
					$bdd=null;

					$this->updateHome['error'] = true;
					$this->updateHome['message'] = 'Error to query : ' . $e->getMessage();

					return $this->updateHome;
				}
			}else{
				$bdd=null;

				$this->updateHome['error'] = true;
				$this->updateHome['message'] = 'to id is not existing!!!';

				return $this->updateHome;
			}
		}
		
		//-----------------------------------------------------------------------
		private $deleteHome;
		public function deleteHome(int $id_home):array{

			if(Utilities::checkData('home','id_home', $id_home)){
				
				$bdd = dbConnect::dbConnect(new dbConnect());

				try
				{
					$sql = $bdd->prepare('DELETE FROM home WHERE id_home = :id_home');
					
					$sql->bindParam(':id_home', $id_home, PDO::PARAM_INT);
					$sql->execute();

					$bdd=null;

					$this->deleteHome['error'] = false;
					$this->deleteHome['message'] = 'Data is delete!!!';

					return $this->deleteHome;

				}catch (PDOException $e){
					$bdd=null;

					$this->deleteHome['error'] = true;
					$this->deleteHome['message'] = 'Error to query : ' . $e->getMessage();

					return $this->deleteHome;
				}
			}else{
				$bdd=null;

				$this->deleteHome['error'] = true;
				$this->deleteHome['message'] = 'to id is not existing!!!';

				return $this->deleteHome;
			}
		}
	}
?>