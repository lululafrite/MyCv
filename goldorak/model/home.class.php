<?php

	class Home
	{
		private $id_home;
		public function getId()
		{
			return $this->id_home;
		}
		public function setId($new)
		{
			$this->id_home = $new;
		}

		//-----------------------------------------------------------------------

		private $titre1;
		public function getTitre1()
		{
			return $this->titre1;
		}
		public function setTitre1($new)
		{
			$this->titre1 = $new;
		}

		//-----------------------------------------------------------------------

		private $titre_chapter1;
		public function getTitre_chapter1()
		{
			return $this->titre_chapter1;
		}
		public function setTitre_chapter1($new)
		{
			$this->titre_chapter1 = $new;
		}

		//-----------------------------------------------------------------------

		private $chapter1;
		public function getChapter1()
		{
			return $this->chapter1;
		}
		public function setChapter1($new)
		{
			$this->chapter1 = $new;
		}

		//-----------------------------------------------------------------------

		private $img_chapter1;
		public function getImg_chapter1()
		{
			return $this->img_chapter1;
		}
		public function setImg_chapter1($new)
		{
			$this->img_chapter1 = $new;
		}

		//-----------------------------------------------------------------------

		private $titre_chapter2;
		public function getTitre_chapter2()
		{
			return $this->titre_chapter2;
		}
		public function setTitre_chapter2($new)
		{
			$this->titre_chapter2 = $new;
		}

		//-----------------------------------------------------------------------

		private $chapter2;
		public function getChapter2()
		{
			return $this->chapter2;
		}
		public function setChapter2($new)
		{
			$this->chapter2 = $new;
		}

		//-----------------------------------------------------------------------

		private $img_chapter2;
		public function getImg_chapter2()
		{
			return $this->img_chapter2;
		}
		public function setImg_chapter2($new)
		{
			$this->img_chapter2 = $new;
		}

		//-----------------------------------------------------------------------

		private $theHome;
		public function getHome($idHome)
		{
			include_once('../../goldorak/model/dbConnect_.class.php');
			$dbConnect_ = new dbConnect_();
			$bdd = $dbConnect_->connectionDb();
            unset($dbConnect_);

			date_default_timezone_set($_SESSION['timeZone']);
			
			try
			{
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
										WHERE `home`.`id_home` = :idHome");
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
		public function get($whereClause, $orderBy = 'id_home', $ascOrDesc = 'ASC', $firstLine = 0, $linePerPage = 13)
		{
			include_once('../../goldorak/model/dbConnect_.class.php');
			//include_once('../model/dbConnect_.class.php');
			$dbConnect_ = new dbConnect_();
			$bdd = $dbConnect_->connectionDb();
            unset($dbConnect_);
			
			try
			{
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

		public function updateHome($idHome)
		{
			include_once('../../goldorak/model/dbConnect_.class.php');
			$dbConnect_ = new dbConnect();
			$bdd = $dbConnect_->connectionDb();
            unset($dbConnect_);

			try{
				$stmt = $bdd->prepare("UPDATE `home`
				SET `titre1` = ?,
					`titre_chapter1` = ?,
					`chapter1` = ?,
					`img_chapter1` = ?,
					`titre_chapter2` = ?,
					`chapter2` = ?,
					`img_chapter2` = ?
					
				WHERE `id_home` = ?");

				$stmt->execute([$this->titre1,
						$this->titre_chapter1,
						$this->chapter1,
						$this->img_chapter1,
						$this->titre_chapter2,
						$this->chapter2,
						$this->img_chapter2,
						$idHome]);
							
				echo '<script>alert("Les modifications sont enregistrées!");</script>';
			}
			catch (PDOException $e)
			{
				echo "Erreur de la requete :" . $e->GetMessage();
			}

			$bdd=null;
		}

		//-----------------------------------------------------------------------

		public function deleteHome($id)
		{
			include_once('../../goldorak/model/dbConnect_.class.php');
			$dbConnect_ = new dbConnect();
			$bdd = $dbConnect_->connectionDb();
            unset($dbConnect_);
			
			try
			{
				$stmt = $bdd->prepare('DELETE FROM home WHERE id_home = :id');
				$stmt->bindParam(':id', $id, PDO::PARAM_INT);
				$stmt->execute();

				echo '<script>alert("Cet enregistrement est supprimé!");</script>';
			}
			catch (PDOException $e)
			{
				echo "Erreur de la requete :" . $e->getMessage();
			}

			$bdd = null;
		}

		public function newHome()
		{
			include_once('../../goldorak/model/dbConnect_.class.php');
			$dbConnect_ = new dbConnect();
			$bdd = $dbConnect_->connectionDb();
            unset($dbConnect_);
	
			try
			{
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
				
				echo "Nouvel enregistrement créé avec succès.";
			}
			catch (PDOException $e)
			{
				echo "Erreur de la requête : " . $e->getMessage();
			}
	
			$bdd = null;
		}

	}
	
?>