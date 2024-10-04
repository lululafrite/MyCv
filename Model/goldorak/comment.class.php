<?php
	namespace Goldorak\Model;

    require_once('../model/common/dbConnect.class.php');
	require_once('../model/common/utilities.class.php');

	use MyCv\Model\dbConnect;
	use MyCv\Model\Utilities;
	use \PDO;
	use \PDOException;

	class Comment
	{
		private $id;
		public function getId():int{
			return $this->id;
		}
		public function setId(int $new):void{
			$this->id = $new;
		}

		//-----------------------------------------------------------------------

		private $date;
		public function getDate():string{
			return $this->date;
		}
		public function setDate_(string $new):void{
			$this->date = $new;
		}

		//-----------------------------------------------------------------------

		private $pseudo;
		public function getPseudo():string{
			return $this->pseudo;
		}
		public function setPseudo(string $new):void{
			$this->pseudo = $new;
		}

		//-----------------------------------------------------------------------

		private $rating;
		public function getRating():int{
			return $this->rating;
		}
		public function setRating(int $new):void{
			$this->rating = $new;
		}

		//-----------------------------------------------------------------------

		private $comment;
		public function getComment():string{
			return $this->comment;
		}
		public function setComment(string $new):void{
			$this->comment = $new;
		}

		//-----------------------------------------------------------------------

		private $id_member;
		public function getIdMember():int{
			return $this->id_member;
		}
		public function setIdMember(int $new):void{
			$this->id_member = $new;
		}

		//-----------------------------------------------------------------------

		private $comments;
		public function getComments(int $id_comment):array{
	
			if(Utilities::checkData('comment','id_comment', $id_comment)){

				$bdd = dbConnect::dbConnect(new dbConnect());
				
				try{
					$stmt = $bdd->prepare("SELECT
												`comment`.`id_comment`,
												`comment`.`date_`,
												`user`.`pseudo` AS `pseudo`,
												`comment`.`rating`,
												`comment`.`comment`,
												`user`.`avatar` AS `avatar`,
												`comment`.`publication`,
												`comment`.`id_member`
											
											FROM `comment`

											LEFT JOIN `user`
												ON `user`.`id_user` = `comment`.`id_member`
											LEFT JOIN `user` AS `userAvatar`
												ON `userAvatar`.`id_user` = `comment`.`id_member`
											
											WHERE `comment`.`id_comment` = :id_comment");

					$stmt->bindParam(':id_comment', $id_comment, PDO::PARAM_INT);

					$stmt->execute();

					$bdd=null;

					$this->comments = $stmt->fetch(PDO::FETCH_ASSOC);
					$_SESSION['other']['error'] = false;
					$_SESSION['other']['message'] = 'The query is executed correctly!!!';

					return $this->comments;

				}
				catch (PDOException $e)
				{
					$bdd=null;

					$_SESSION['other']['error'] = true;
					$_SESSION['other']['message'] = 'Error to query : ' . $e->getMessage();

					return $this->comments;
				}
			}else{
				$bdd=null;

				$_SESSION['other']['error'] = true;
				$_SESSION['other']['message'] = 'The ID is not existent!!!';

				return $this->comments;
			}
		}

		//-----------------------------------------------------------------------

		private $commentList;
		public function getCommentList(string $whereClause, string $orderBy = 'date_', string $ascOrDesc = 'ASC', int $firstLine = 0, int $linePerPage = 50):array{
			
			$bdd = dbConnect::dbConnect(new dbConnect());
			
			try{
				$stmt = $bdd->prepare("SELECT 
											`comment`.`id_comment`,
											`comment`.`date_`,
											`user`.`pseudo` AS `pseudo`,
											`comment`.`rating`,
											`comment`.`comment`,
											`user`.`avatar` AS `avatar`,
											`comment`.`publication`,
											`comment`.`id_member`
										FROM `comment`
										
										LEFT JOIN `user`
											ON `user`.`id_user` = `comment`.`id_member`
										LEFT JOIN `user` AS `userAvatar`
											ON `userAvatar`.`id_user` = `comment`.`id_member`
										
										WHERE $whereClause
										ORDER BY :orderBy :ascOrDesc
										LIMIT :firstLine, :linePerPage");

				$stmt->bindParam(':orderBy', $orderBy, PDO::PARAM_STR);
				$stmt->bindParam(':ascOrDesc', $ascOrDesc, PDO::PARAM_STR);
				$stmt->bindParam(':firstLine', $firstLine, PDO::PARAM_INT);
				$stmt->bindParam(':linePerPage', $linePerPage, PDO::PARAM_INT);

				$stmt->execute();

				$bdd=null;
				
				$this->commentList = $stmt->fetchAll(PDO::FETCH_ASSOC);
				$_SESSION['other']['error'] = false;
				$_SESSION['other']['message'] = 'The query is executed correctly!!!';

				return $this->commentList;
			}
			catch (PDOException $e)
			{
				$bdd=null;
				
				$_SESSION['other']['error'] = true;
				$_SESSION['other']['message'] = 'Error to query : ' . $e->getMessage();

				return $this->commentList;
			}
		}

		//-----------------------------------------------------------------------
		private $insertComment;
		public function insertComment():array{

			$bdd = dbConnect::dbConnect(new dbConnect());

			try{
				$stmt = $bdd->prepare("SELECT `comment`.`id_comment`
										FROM  `comment`
										WHERE `comment`.`date_` = :date
										AND `comment`.`pseudo` = :pseudo
										AND `comment`.`rating` = :rating
										AND `comment`.`comment` = :comment"
										);

				$stmt->bindParam(':date', $this->date);
				$stmt->bindParam(':pseudo', $this->pseudo);
				$stmt->bindParam(':rating', $this->rating);
				$stmt->bindParam(':comment', $this->comment);

				$stmt->execute();

				$this->insertComment = $stmt->fetch(PDO::FETCH_ASSOC);

				if (!$this->insertComment) {

					$stmt = $bdd->prepare("INSERT INTO `comment` (`date_`,
																	`pseudo`,
																	`rating`,
																	`comment`,
																	`id_member`)
                        					VALUES (:date_,
													:pseudo,
													:rating,
													:comment,
													(SELECT id_user FROM user WHERE `pseudo` = :pseudo))");

					$stmt->bindParam(':date', $this->date);
					$stmt->bindParam(':pseudo', $this->pseudo);
					$stmt->bindParam(':rating', $this->rating);
					$stmt->bindParam(':comment', $this->comment);

					$stmt->execute();

					$stmt = $bdd->prepare("SELECT MAX(`id_comment`) AS id_comment FROM `comment`");

					$stmt->execute();
					
					$bdd=null;

					$this->insertComment = $stmt->fetch(PDO::FETCH_ASSOC);

					$_SESSION['other']['error'] = false;
					$_SESSION['other']['message'] = 'The data is inserted correctly!!!';

					return $this->insertComment;
				}

			}catch (PDOException $e){
				$bdd=null;

				$this->insertComment['id_comment'] = 0;
				$_SESSION['other']['error'] = true;
				$_SESSION['other']['message'] = 'Error to query : ' . $e->getMessage();

				return $this->insertComment;
			}
		}

		//-----------------------------------------------------------------------

		public function updateComment(int $idComment)
		{

			$bdd = dbConnect::dbConnect(new dbConnect());

			try
			{
				// Requête préparée
				$query = $bdd->prepare("UPDATE `comment`
				SET `date_` = :date_,
					`pseudo` = :pseudo,
					`rating` = :rating,
					`comment` = :comment
				WHERE `id_comment` = :idComment");

				// Liaison des valeurs
				$query->bindParam(':date_', $this->date);
				$query->bindParam(':pseudo', $this->pseudo);
				$query->bindParam(':rating', $this->rating);
				$query->bindParam(':comment', $this->comment);
				$query->bindParam(':idComment', $idComment);

				// Exécution de la requête
				$query->execute();
				
				echo '<script>alert("Les modifications sont enregistrées!");</script>';
			}
			catch (PDOException $e)
			{
				echo "Erreur de la requete :" . $e->GetMessage();
			}

			$bdd=null;
		}

		//-----------------------------------------------------------------------

		public function modereComment(int $idComment, string $publication)
		{

			$bdd = dbConnect::dbConnect(new dbConnect());

			try
			{
				// Requête préparée
				$query = $bdd->prepare("UPDATE `comment`
										SET `publication` = :publication
										WHERE `id_comment` = :idComment"
									);

				// Liaison des valeurs
				$query->bindParam(':idComment', $idComment);
				$query->bindParam(':publication', $publication);

				// Exécution de la requête
				$query->execute();
				
				echo '<script>alert("Les modifications sont enregistrées!");</script>';
			}
			catch (PDOException $e)
			{
				echo "Erreur de la requete :" . $e->GetMessage();
			}

			$bdd=null;
		}

		//-----------------------------------------------------------------------
		
		public function deleteComment(int $id)
		{

			$bdd = dbConnect::dbConnect(new dbConnect());

			try {
				// Requête préparée pour la sélection
				$query = $bdd->prepare("SELECT `comment`.`id_comment`
										FROM  `comment`
										WHERE `comment`.`id_comment` = :id");

				// Liaison de la valeur
				$query->bindParam(':id', $id);

				// Exécution de la requête
				$query->execute();

				// Récupération du résultat
				$id_comment = $query->fetch(PDO::FETCH_COLUMN);

				// Vérification si l'ID existe
				if ($id_comment !== false) {
					// Requête préparée pour la suppression
					$deleteQuery = $bdd->prepare('DELETE FROM comment WHERE id_comment = :id_comment');

					// Liaison de la valeur
					$deleteQuery->bindParam(':id_comment', $id_comment);

					// Exécution de la requête de suppression
					$deleteQuery->execute();

					echo '<script>alert("Cet enregistrement est supprimé!");</script>';
				} else {
					// L'ID n'existe pas, gestion de l'erreur si nécessaire
					echo '<script>alert("L\'enregistrement avec cet ID n\'existe pas!");</script>';
				}
			} catch (PDOException $e) {
				echo "Erreur de la requête : " . $e->getMessage();
			}

			$bdd = null;
		}

	}
	
?>