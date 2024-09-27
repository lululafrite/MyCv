<?php
	namespace Goldorak\Model;

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
		public function setId(int $new):void{
			$this->id_home = $new;
		}

		//-----------------------------------------------------------------------

		private $titre1;
		public function getTitre1():string{
			return $this->titre1;
		}
		public function setTitre1(string $new):void{
			$this->titre1 = $new;
		}

		//-----------------------------------------------------------------------

		private $titre_chapter1;
		public function getTitre_chapter1():string{
			return $this->titre_chapter1;
		}
		public function setTitre_chapter1(string $new):void{
			$this->titre_chapter1 = $new;
		}

		//-----------------------------------------------------------------------

		private $chapter1;
		public function getChapter1():string{
			return $this->chapter1;
		}
		public function setChapter1(string $new):void{
			$this->chapter1 = $new;
		}

		//-----------------------------------------------------------------------

		private $img_chapter1;
		public function getImg_chapter1():string{
			return $this->img_chapter1;
		}
		public function setImg_chapter1(string $new):void{
			$this->img_chapter1 = $new;
		}

		//-----------------------------------------------------------------------

		private $titre_chapter2;
		public function getTitre_chapter2():string{
			return $this->titre_chapter2;
		}
		public function setTitre_chapter2(string $new):void{
			$this->titre_chapter2 = $new;
		}

		//-----------------------------------------------------------------------

		private $chapter2;
		public function getChapter2():string{
			return $this->chapter2;
		}
		public function setChapter2(string $new):void{
			$this->chapter2 = $new;
		}

		//-----------------------------------------------------------------------

		private $img_chapter2;
		public function getImg_chapter2():string{
			return $this->img_chapter2;
		}
		public function setImg_chapter2(string $new):void{
			$this->img_chapter2 = $new;
		}

		//-----------------------------------------------------------------------

		private $home = array();
		public function getHome(int $id_home):array{
	
			if(Utilities::checkData('home','id_home', $id_home)){

				$bdd = dbConnect::dbConnect(new dbConnect());
				
				try{
					$stmt = $bdd->prepare("SELECT
												`home`.`id_home`,
												`home`.`titre1`,
												`home`.`titre_chapter1`,
												`home`.`chapter1`,
												`home`.`img_chapter1`,
												`home`.`titre_chapter2`,
												`home`.`chapter2`,
												`home`.`img_chapter2`
											FROM `home`
											WHERE `home`.`id_home` = :id_home");

					$stmt->bindParam(':id_home', $id_home, PDO::PARAM_INT);
					$stmt->execute();

					$bdd=null;

					$this->home = $stmt->fetch(PDO::FETCH_ASSOC);
					$this->home['error'] = false;
					$this->home['message'] = 'The query is executed correctly!!!';

					return $this->home;

				}catch (PDOException $e){

					echo "Erreur de la requête :" . $e->getMessage();

					$bdd=null;

					$this->home['error'] = true;
					$this->home['message'] = 'Error to query : ' . $e->getMessage();
					
					return $this->home;
				}
			}else{
				$bdd=null;

				$this->home['error'] = true;
				$this->home['message'] = 'The id ' . $id_home . ' of the home table does not exist.';
				
				return $this->home;
			}
		}


		//-----------------------------------------------------------------------

		private $homeList;
		public function getHomeList(string $whereClause, string $orderBy = 'id_home', string $ascOrDesc = 'ASC', int $firstLine = 0, int $linePerPage = 13):array{

			$bdd = dbConnect::dbConnect(new dbConnect());
			
			try{
				$stmt = $bdd->prepare("SELECT
											`home`.`id_home`,
											`home`.`titre1`,
											`home`.`titre_chapter1`,
											`home`.`chapter1`,
											`home`.`img_chapter1`,
											`home`.`titre_chapter2`,
											`home`.`chapter2`,
											`home`.`img_chapter2`
										FROM `home`
										WHERE :whereClause
										ORDER BY :orderBy :ascOrDesc
										LIMIT :firstLine, :linePerPage");

				$stmt->bindParam(':whereClause', $whereClause, PDO::PARAM_STR);
				$stmt->bindParam(':orderBy', $orderBy, PDO::PARAM_STR);
				$stmt->bindParam(':ascOrDesc', $ascOrDesc, PDO::PARAM_STR);
				$stmt->bindParam(':firstLine', $firstLine, PDO::PARAM_INT);
				$stmt->bindParam(':linePerPage', $linePerPage, PDO::PARAM_INT);

				$stmt->execute();

				$bdd = null;

				$this->homeList = $stmt->fetchAll(PDO::FETCH_ASSOC);
				$this->homeList['error'] = false;
				$this->homeList['message'] = 'The query is executed correctly!!!';
				
				return $this->homeList;

			}catch (PDOException $e){

				$bdd = null;

				$this->homeList['error'] = true;
				$this->homeList['message'] = 'Error to query : ' . $e->getMessage();
				
				return $this->homeList;
			}
		}


		//-----------------------------------------------------------------------
		private $updateHome;
		public function updateHome(int $id_home):array{

			$bdd = dbConnect::dbConnect(new dbConnect());

			try{
				$stmt = $bdd->prepare("UPDATE `home`
										SET `titre1` = :titre1,
											`titre_chapter1` = :titre_chapter1,
											`chapter1` = :chapter1,
											`img_chapter1` = :img_chapter1,
											`titre_chapter2` = :titre_chapter2,
											`chapter2` = :chapter2,
											`img_chapter2` = :img_chapter2
											
										WHERE `id_home` = :id_home");
				
				$stmt->bindParam(':titre1', $this->titre1, PDO::PARAM_STR);
				$stmt->bindParam(':titre_chapter1', $this->titre_chapter1, PDO::PARAM_STR);
				$stmt->bindParam(':chapter1', $this->chapter1, PDO::PARAM_STR);
				$stmt->bindParam(':img_chapter1', $this->img_chapter1, PDO::PARAM_STR);
				$stmt->bindParam(':titre_chapter2', $this->titre_chapter2, PDO::PARAM_STR);
				$stmt->bindParam(':chapter2', $this->chapter2, PDO::PARAM_STR);
				$stmt->bindParam(':img_chapter2', $this->img_chapter2, PDO::PARAM_STR);
				$stmt->bindParam(':id_home', $id_home, PDO::PARAM_INT);

				$stmt->execute();

				$bdd=null;

				$this->updateHome['error'] = false;
				$this->updateHome['message'] = 'The query is executed correctly!!!';

				return $this->updateHome;
			}
			catch (PDOException $e)
			{
				echo "Erreur de la requete :" . $e->GetMessage();

				$bdd=null;

				$this->updateHome['error'] = true;
				$this->updateHome['message'] = 'Error to query : ' . $e->getMessage();

				return $this->updateHome;
			}
		}

		//-----------------------------------------------------------------------
		private $deleteHome;
		public function deleteHome(int $id_home):array{

			$bdd = dbConnect::dbConnect(new dbConnect());
			
			try
			{
				$stmt = $bdd->prepare('DELETE FROM home WHERE id_home = :id_home');
				$stmt->bindParam(':id_home', $id_home, PDO::PARAM_INT);
				$stmt->execute();

				$bdd = null;

				$this->deleteHome['error'] = false;
				$this->deleteHome['message'] = 'The data is deleted correctly!!!';

				return $this->deleteHome;
			}
			catch (PDOException $e)
			{
				$bdd = null;

				$this->deleteHome['error'] = true;
				$this->deleteHome['message'] = 'Error to query : ' . $e->getMessage();

				return $this->deleteHome;
			}
		}

		private $insertHome;
		public function insertHome():array{

			$bdd = dbConnect::dbConnect(new dbConnect());

			try{
				$stmt = $bdd->prepare("INSERT INTO `home` (`titre1`,
															`titre_chapter1`,
															`chapter1`,
															`img_chapter1`,
															`titre_chapter2`,
															`chapter2`,
															`img_chapter2`) 
										VALUES (:titre1,
												:titreChapter1,
												:chapter1,
												:imgChapter1,
												:titreChapter2,
												:chapter2,
												:imgChapter2)");
	
				$stmt->bindParam(':titre1', $this->titre1, PDO::PARAM_STR);
				$stmt->bindParam(':titreChapter1', $this->titre_chapter1, PDO::PARAM_STR);
				$stmt->bindParam(':chapter1', $this->chapter1, PDO::PARAM_STR);
				$stmt->bindParam(':imgChapter1', $this->img_chapter1, PDO::PARAM_STR);
				$stmt->bindParam(':titreChapter2', $this->titre_chapter2, PDO::PARAM_STR);
				$stmt->bindParam(':chapter2', $this->chapter2, PDO::PARAM_STR);
				$stmt->bindParam(':imgChapter2', $this->img_chapter2, PDO::PARAM_STR);
	
				$stmt->execute();

				$bdd = null;

				$this->insertHome['error'] = false;
				$this->insertHome['message'] = 'The data is inserted correctly!!!';

				return $this->insertHome;

			}catch (PDOException $e){
				$bdd = null;

				$this->insertHome['error'] = true;
				$this->insertHome['message'] = 'Error to query : ' . $e->getMessage();

				return $this->insertHome;
			}
		}
	}
	
?>