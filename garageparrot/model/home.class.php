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

		private $intro_chapter1;
		public function getIntro_chapter1()
		{
			return $this->intro_chapter1;
		}
		public function setIntro_chapter1($new)
		{
			$this->intro_chapter1 = $new;
		}

		//-----------------------------------------------------------------------

		private $intro_chapter2;
		public function getIntro_chapter2()
		{
			return $this->intro_chapter2;
		}
		public function setIntro_chapter2($new)
		{
			$this->intro_chapter2 = $new;
		}

		//-----------------------------------------------------------------------

		private $titre2;
		public function getTitre2()
		{
			return $this->titre2;
		}
		public function setTitre2($new)
		{
			$this->titre2 = $new;
		}

		//-----------------------------------------------------------------------

		private $article1_titre;
		public function getArticle1_titre()
		{
			return $this->article1_titre;
		}
		public function setArticle1_titre($new)
		{
			$this->article1_titre = $new;
		}

		//-----------------------------------------------------------------------

		private $article1_chapter1;
		public function getArticle1_chapter1()
		{
			return $this->article1_chapter1;
		}
		public function setArticle1_chapter1($new)
		{
			$this->article1_chapter1 = $new;
		}

		//-----------------------------------------------------------------------

		private $article1_image1;
		public function getArticle1_image1()
		{
			return $this->article1_image1;
		}
		public function setArticle1_image1($new)
		{
			$this->article1_image1 = $new;
		}

		//-----------------------------------------------------------------------

		private $article1_titre2;
		public function getArticle1_titre2()
		{
			return $this->article1_titre2;
		}
		public function setArticle1_titre2($new)
		{
			$this->article1_titre2 = $new;
		}

		//-----------------------------------------------------------------------

		private $article1_chapter2;
		public function getArticle1_chapter2()
		{
			return $this->article1_chapter2;
		}
		public function setArticle1_chapter2($new)
		{
			$this->article1_chapter2 = $new;
		}

		//-----------------------------------------------------------------------

		private $article1_image2;
		public function getArticle1_image2()
		{
			return $this->article1_image2;
		}
		public function setArticle1_image2($new)
		{
			$this->article1_image2 = $new;
		}

		//-----------------------------------------------------------------------

		private $article2_titre;
		public function getArticle2_titre()
		{
			return $this->article2_titre;
		}
		public function setArticle2_titre($new)
		{
			$this->article2_titre = $new;
		}

		//-----------------------------------------------------------------------

		private $article2_chapter1;
		public function getArticle2_chapter1()
		{
			return $this->article2_chapter1;
		}
		public function setArticle2_chapter1($new)
		{
			$this->article2_chapter1 = $new;
		}

		//-----------------------------------------------------------------------

		private $article2_image1;
		public function getArticle2_image1()
		{
			return $this->article2_image1;
		}
		public function setArticle2_image1($new)
		{
			$this->article2_image1 = $new;
		}

		//-----------------------------------------------------------------------

		private $article2_titre2;
		public function getArticle2_titre2()
		{
			return $this->article2_titre2;
		}
		public function setArticle2_titre2($new)
		{
			$this->article2_titre2 = $new;
		}

		//-----------------------------------------------------------------------

		private $article2_chapter2;
		public function getArticle2_chapter2()
		{
			return $this->article2_chapter2;
		}
		public function setArticle2_chapter2($new)
		{
			$this->article2_chapter2 = $new;
		}

		//-----------------------------------------------------------------------

		private $article2_image2;
		public function getArticle2_image2()
		{
			return $this->article2_image2;
		}
		public function setArticle2_image2($new)
		{
			$this->article2_image2 = $new;
		}

		//-----------------------------------------------------------------------

		private $theHome;
		public function getHome($idHome)
		{
			include_once('../../controller/ConfigConnGP.php');
			$conn = connectDB();
            date_default_timezone_set($_SESSION['timeZone']);
			
			try
			{
			    $sql = $conn->prepare("SELECT
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

									WHERE `home`.`id_home`=:idHome
								");

				$sql->bindParam(':idHome', $idHome, PDO::PARAM_INT);
				$sql->execute();

				$this->theHome = $sql->fetch(PDO::FETCH_ASSOC);
				return $this->theHome;

			}
			catch (PDOException $e)
			{
				echo '<script>alert("Erreur de la requête : ' . $e->getMessage() . '");</script>';
			}

			$conn=null;
		}

		//-----------------------------------------------------------------------

		private $homeList;
		public function get($whereClause, $orderBy = 'id_home', $ascOrDesc = 'ASC', $firstLine = 0, $linePerPage = 13)
		{
			include_once('../../controller/ConfigConnGP.php');
			$conn = connectDB();
            date_default_timezone_set($_SESSION['timeZone']);
			
			try
			{
			    $sql = $conn->prepare("SELECT
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

									WHERE $whereClause
									ORDER BY $orderBy $ascOrDesc
									LIMIT :firstLine, :linePerPage
								");

				$sql->bindParam(':firstLine', $firstLine, PDO::PARAM_INT);
				$sql->bindParam(':linePerPage', $linePerPage, PDO::PARAM_INT);
				$sql->execute();

				$this->homeList = $sql->fetchAll(PDO::FETCH_ASSOC);
				return $this->homeList;

			}
			catch (PDOException $e)
			{
				echo '<script>alert("Erreur de la requête : ' . $e->getMessage() . '");</script>';
			}

			$conn=null;
		}

		//-----------------------------------------------------------------------

		public function updateHome($idHome)
		{
			include_once('../../controller/ConfigConnGP.php');
			$conn = connectDB();
            date_default_timezone_set($_SESSION['timeZone']);

			try{
				$sql = $conn->prepare("UPDATE `home`
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

				$sql->bindParam(':titre1', $this->titre1, PDO::PARAM_STR);
				$sql->bindParam(':intro_chapter1', $this->intro_chapter1, PDO::PARAM_STR);
				$sql->bindParam(':intro_chapter2', $this->intro_chapter2, PDO::PARAM_STR);
				$sql->bindParam(':titre2', $this->titre2, PDO::PARAM_STR);
				$sql->bindParam(':article1_titre', $this->article1_titre, PDO::PARAM_STR);
				$sql->bindParam(':article1_chapter1', $this->article1_chapter1, PDO::PARAM_STR);
				$sql->bindParam(':article1_titre2', $this->article1_titre2, PDO::PARAM_STR);
				$sql->bindParam(':article1_chapter2', $this->article1_chapter2, PDO::PARAM_STR);
				$sql->bindParam(':article2_titre', $this->article2_titre, PDO::PARAM_STR);
				$sql->bindParam(':article2_chapter1', $this->article2_chapter1, PDO::PARAM_STR);
				$sql->bindParam(':article2_titre2', $this->article2_titre2, PDO::PARAM_STR);
				$sql->bindParam(':article2_chapter2', $this->article2_chapter2, PDO::PARAM_STR);
				$sql->bindParam(':id_home', $idHome, PDO::PARAM_INT);

				$sql->execute();
								
				echo '<script>alert("Les modifications sont enregistrées!");</script>';

			}catch(PDOException $e){
				
				echo '<script>alert("Erreur de la requête : ' . $e->getMessage() . '");</script>';

			}

			$conn = null;
		}
		
		//-----------------------------------------------------------------------

		public function deleteHome($id)
		{
			include_once('../../controller/ConfigConnGP.php');
			$conn = connectDB();
            date_default_timezone_set($_SESSION['timeZone']);

			try
			{
			    $sql = $conn->prepare('DELETE FROM home WHERE id_home = :id');
				
				$sql->bindParam(':id', $id, PDO::PARAM_INT);
				$sql->execute();

				echo '<script>alert("Cet enregistrement est supprimé!");</script>';
			}
			catch (PDOException $e)
			{
				echo '<script>alert("Erreur de la requête : ' . $e->getMessage() . '");</script>';
			}

			$conn=null;

		}

	}
	
?>