<?php

	namespace GarageParrot\Model;

    require_once('../model/common/dbConnect.class.php');

	use \PDO;
	use \PDOException;
	use MyCv\Model\dbConnect;

	class Comment
	{

		private $id;
		public function getId()
		{
			return $this->id;
		}
		public function setId($new)
		{
			$this->id = $new;
		}

		//-----------------------------------------------------------------------

		private $date_;
		public function getDate_()
		{
			return $this->date_;
		}
		public function setDate_($new)
		{
			$this->date_ = $new;
		}

		//-----------------------------------------------------------------------

		private $pseudo;
		public function getPseudo()
		{
			return $this->pseudo;
		}
		public function setPseudo($new)
		{
			$this->pseudo = $new;
		}

		//-----------------------------------------------------------------------

		private $rating;
		public function getRating()
		{
			return $this->rating;
		}
		public function setRating($new)
		{
			$this->rating = $new;
		}

		//-----------------------------------------------------------------------

		private $comment;
		public function getComment()
		{
			return $this->comment;
		}
		public function setComment($new)
		{
			$this->comment = $new;
		}

		//-----------------------------------------------------------------------

		private $theComment;
		public function getComments($îdComment)
		{
			$bdd = dbConnect::dbConnect(new dbConnect());
			
			try
			{
			    $sql = $bdd->query("SELECT
										`comment`.`id_comment`,
										`comment`.`date_`,
										`comment`.`pseudo`,
										`comment`.`rating`,
										`comment`.`comment`

									FROM `comment`
									
									WHERE `comment`.`id_comment`=$îdComment
								");

				/*while ($this->theContact[] = $sql->fetch());*/
				$this->theComment[] = $sql->fetch();
				return $this->theComment;
			}
			catch (PDOException $e){
				
				echo '<script>alert("' . $e->getMessage() . '");</script>';

			}

			$bdd=null;
		}

		//-----------------------------------------------------------------------

		private $CommentList;
		public function getCommentList($whereClause, $orderBy = 'date_', $ascOrDesc = 'ASC', $firstLine = 0, $linePerPage = 30)
		{
			$bdd = dbConnect::dbConnect(new dbConnect());
			
			try
			{
				$stmt = $bdd->prepare("SELECT
											`comment`.`id_comment`,
											`comment`.`date_`,
											`comment`.`pseudo`,
											`comment`.`rating`,
											`comment`.`comment`
										
										FROM `comment`

										WHERE $whereClause
										ORDER BY $orderBy $ascOrDesc
										LIMIT :firstLine, :linePerPage");

				$stmt->bindParam(':firstLine', $firstLine, PDO::PARAM_INT);
				$stmt->bindParam(':linePerPage', $linePerPage, PDO::PARAM_INT);

				$stmt->execute();

				$this->CommentList = $stmt->fetchAll(PDO::FETCH_ASSOC);
				return $this->CommentList;

			}
			catch (PDOException $e){
				
				echo '<script>alert("' . $e->getMessage() . '");</script>';

			}

			$bdd=null;
		}

		//-----------------------------------------------------------------------
		
		public function addComment()
		{
			$bdd = dbConnect::dbConnect(new dbConnect());

			try{
				// Requête préparée
				$sql = $bdd->prepare("SELECT `comment`.`id_comment`
										FROM  `comment`
										WHERE `comment`.`date_` = :date_
										AND `comment`.`pseudo` = :pseudo
										AND `comment`.`rating` = :rating
										AND `comment`.`comment` = :comment");

				// Liaison des valeurs
				$sql->bindParam(':date_', $this->date_);
				$sql->bindParam(':pseudo', $this->pseudo);
				$sql->bindParam(':rating', $this->rating);
				$sql->bindParam(':comment', $this->comment);

				// Exécution de la requête
				$sql->execute();

				// Récupération du résultat
				$result = $sql->fetch(PDO::FETCH_ASSOC);

				if (!$result) {

					$sql = $bdd->prepare("INSERT INTO `comment` (`date_`, `pseudo`, `rating`, `comment`)
											VALUES (:date_, :pseudo, :rating, :comment)");
											
					// Liaison des valeurs
					$sql->bindParam(':date_', $this->date_);
					$sql->bindParam(':pseudo', $this->pseudo);
					$sql->bindParam(':rating', $this->rating);
					$sql->bindParam(':comment', $this->comment);

					// Exécution de la requête
					$sql->execute();
					
					$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$sql = $bdd->query("SELECT MAX(`id_comment`) AS idMax FROM `comment`");
					$result = $sql->fetch(PDO::FETCH_ASSOC);
					$this->id = $result['idMax'];

					echo '<script>alert("L\'enregistrement est effectué!");</script>';
				}

			}catch (PDOException $e){
				
				echo '<script>alert("' . $e->getMessage() . '");</script>';

			}

			$bdd=null;
		}

		//-----------------------------------------------------------------------

		public function updateComment($id)
		{
			$bdd = dbConnect::dbConnect(new dbConnect());

			try
			{
				// Requête préparée
				$sql = $bdd->prepare("UPDATE `comment`
											SET `date_` = :date_,
												`pseudo` = :pseudo,
												`rating` = :rating,
												`comment` = :comment
											WHERE `id_comment` = :id"
										);

				// Liaison des valeurs
				$sql->bindParam(':date_', $this->date_);
				$sql->bindParam(':pseudo', $this->pseudo);
				$sql->bindParam(':rating', $this->rating);
				$sql->bindParam(':comment', $this->comment);
				$sql->bindParam(':id', $id);

				// Exécution de la requête
				$sql->execute();
				
				echo '<script>alert("Les modifications sont enregistrées!");</script>';
			}
			catch (PDOException $e){
				
				echo '<script>alert("' . $e->getMessage() . '");</script>';

			}

			$bdd=null;
		}

		//-----------------------------------------------------------------------
		
		public function deleteComment($id)
		{
			$bdd = dbConnect::dbConnect(new dbConnect());

			try {
				// Requête préparée pour la sélection
				$sql = $bdd->prepare("SELECT `comment`.`id_comment`
										FROM  `comment`
										WHERE `comment`.`id_comment` = :id");

				// Liaison de la valeur
				$sql->bindParam(':id', $id);

				// Exécution de la requête
				$sql->execute();

				// Récupération du résultat
				$result = $sql->fetch(PDO::FETCH_ASSOC);

				// Vérification si l'ID existe
				if ($result) {
					// Requête préparée pour la suppression
					$sql = $bdd->prepare('DELETE FROM comment WHERE id_comment = :id_comment');

					// Liaison de la valeur
					$sql->bindParam(':id_comment', $id);

					// Exécution de la requête de suppression
					$sql->execute();

					echo '<script>alert("Cet enregistrement est supprimé!");</script>';
				} else {
					// L'ID n'existe pas, gestion de l'erreur si nécessaire
					echo '<script>alert("L\'enregistrement avec cet ID n\'existe pas!");</script>';
				}
			} catch (PDOException $e) {
				
				echo '<script>alert("' . $e->getMessage() . '");</script>';

			}

			$bdd = null;
		}

        //__Ajouter user?___________________________________________
        
        public function getAddComment()
        {
            if(is_null($_SESSION['addComment']))
            {
                $_SESSION['addComment']=false;
            }
            return $_SESSION['addComment'];
        }
        public function setAddSchedules($new)
        {
            $_SESSION['addComment']=$new;
        }

	}
	
?>