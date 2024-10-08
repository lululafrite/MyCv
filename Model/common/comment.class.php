<?php
	//comment.class.php
	//author : Ludovic FOLLACO
	//checked to 2024-10-08_15:10
	namespace Model\Comment;

    require_once('../model/common/dbConnect.class.php');
	require_once('../model/common/utilities.class.php');

	use Model\DbConnect\DbConnect;
	use Model\Utilities\Utilities;
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
		public function setDate(string $new):void{
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

				$bdd = DbConnect::DbConnect(new DbConnect());
				
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
			
			$bdd = DbConnect::DbConnect(new DbConnect());
			
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

			$bdd = DbConnect::DbConnect(new DbConnect());

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
                        					VALUES (:date,
													:pseudo,
													:rating,
													:comment,
													(SELECT id_user FROM user WHERE `pseudo` = :pseudo2))");

					$stmt->bindParam(':date', $this->date, PDO::PARAM_STR);
					$stmt->bindParam(':pseudo', $this->pseudo, PDO::PARAM_STR);
					$stmt->bindParam(':rating', intval($this->rating), PDO::PARAM_INT);
					$stmt->bindParam(':comment', $this->comment, PDO::PARAM_STR);
					$stmt->bindParam(':pseudo2', $this->pseudo, PDO::PARAM_STR);
					//$stmt->bindParam(':publication', 0, PDO::PARAM_INT);

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
		private $updateComment = false;
		public function updateComment(int $id_comment):bool{

			$bdd = DbConnect::DbConnect(new DbConnect());

			try
			{
				$stmt = $bdd->prepare("UPDATE `comment`
										  SET `date_` = :date,
											  `pseudo` = :pseudo,
											  `rating` = :rating,
											  `comment` = :comment
										WHERE `id_comment` = :id_comment");

				$stmt->bindParam(':date', $this->date, PDO::PARAM_STR);
				$stmt->bindParam(':pseudo', $this->pseudo, PDO::PARAM_STR);
				$stmt->bindParam(':rating', $this->rating, PDO::PARAM_INT);
				$stmt->bindParam(':comment', $this->comment, PDO::PARAM_STR);
				$stmt->bindParam(':id_comment', $id_comment, PDO::PARAM_INT);

				$stmt->execute();

				$_SESSION['other']['error'] = false;
				$_SESSION['other']['message'] = 'The data is updated correctly!!!';

				$this->updateComment = true;

			}catch (PDOException $e){
				$_SESSION['other']['error'] = true;
				$_SESSION['other']['message'] = 'Error to query : ' . $e->getMessage();
			}

			$bdd=null;
			return $this->updateComment;
		}

		//-----------------------------------------------------------------------
		private $modereComment = false;
		public function modereComment(int $id_comment, string $publication):bool{

			$bdd = DbConnect::DbConnect(new DbConnect());

			try{
				$stmt = $bdd->prepare("UPDATE `comment`
										SET `publication` = :publication
										WHERE `id_comment` = :id_comment");

				$stmt->bindParam(':id_comment', $id_comment, PDO::PARAM_INT);
				$stmt->bindParam(':publication', $publication, PDO::PARAM_INT);

				$stmt->execute();

				$_SESSION['other']['error'] = false;
				$_SESSION['other']['message'] = "The comment is moderated!!!";

				$this->modereComment = true;
			}
			catch (PDOException $e){
				$_SESSION['other']['error'] = true;
				$_SESSION['other']['message'] = "The comment is not moderated!!!" . $e->GetMessage();
			}

			$bdd=null;
			return $this->modereComment;
		}

		//-----------------------------------------------------------------------
		private $deleteComment = false;
		public function deleteComment(int $id_comment):bool{

			$bdd = DbConnect::DbConnect(new DbConnect());

			try{
				$stmt = $bdd->prepare("SELECT `comment`.`id_comment`
										FROM  `comment`
										WHERE `comment`.`id_comment` = :id_comment");

				$stmt->bindParam(':id_comment', $id_comment, PDO::PARAM_INT);
				$stmt->execute();

				$result = $stmt->fetchColumn(); //(PDO::FETCH_COLUMN);

				if($result !== false){

					$deleteQuery = $bdd->prepare('DELETE FROM comment WHERE id_comment = :id_comment');

					$deleteQuery->bindParam(':id_comment', $id_comment, PDO::PARAM_INT);

					$deleteQuery->execute();

					$_SESSION['other']['error'] = false;
					$_SESSION['other']['message'] = "The comment is deleted!!!";

					$this->deleteComment = true;

				}else{
					$_SESSION['other']['error'] = false;
					$_SESSION['other']['message'] = "The comment is not existent!!!";
				}
			}catch(PDOException $e){
				$_SESSION['other']['error'] = true;
				$_SESSION['other']['message'] = "error query, the comment is not deleted!!!" . $e->GetMessage();
			}

			$bdd = null;
			return $this->deleteComment;
		}
	}
?>