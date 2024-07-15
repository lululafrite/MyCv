<?php

	class User
	{
		private $id_user;
		public function getId()
		{
			return $this->id_user;
		}
		public function setId($new)
		{
			$this->id_user = $new;
		}

		//-----------------------------------------------------------------------

		private $name;
		public function getName()
		{
			return $this->name;
		}
		public function setName($new)
		{
			$this->name = $new;
		}

		//-----------------------------------------------------------------------

		private $surname;
		public function getSurname()
		{
			return $this->surname;
		}
		public function setSurname($new)
		{
			$this->surname = $new;
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

		private $email;
		public function getEmail()
		{
			return $this->email;
		}
		public function setEmail($new)
		{
			$this->email = $new;
		}

		//-----------------------------------------------------------------------

		private $phone;
		public function getPhone()
		{
			return $this->phone;
		}
		public function setPhone($new)
		{
			$this->phone = $new;
		}

		//-----------------------------------------------------------------------

		private $password;
		public function getPassword()
		{
			return $this->password;
		}
		public function setPassword($new)
		{
			$this->password = $new;
		}

		//-----------------------------------------------------------------------

		private $avatar;
		public function getAvatar()
		{
			return $this->avatar;
		}
		public function setAvatar($new)
		{
			$this->avatar = $new;
		}

		//-----------------------------------------------------------------------

		private $subscription;
		public function getSubscription()
		{
			return $this->subscription;
		}
		public function setSubscription($new)
		{
			$this->subscription = $new;
		}
	
		private function getSubscriptionId() {

			include_once('../../goldorak/model/dbConnect_.class.php');
			$dbConnect_ = new dbConnect_();
			$bdd = $dbConnect_->connectionDb();
            unset($dbConnect_);
			
			$stmt = $bdd->prepare("SELECT `id_subscription` FROM `subscription` WHERE `subscription` = ?");
			$stmt->execute([$this->subscription]);
			$result = $stmt->fetch();
			return $result['id_subscription'];

		}

		//-----------------------------------------------------------------------

		private $type;
		public function getType()
		{
			return $this->type;
		}
		public function setType($new)
		{
			$this->type = $new;
		}
	
		private function getUserTypeId() {

			include_once('../../goldorak/model/dbConnect_.class.php');
			$dbConnect_ = new dbConnect_();
			$bdd = $dbConnect_->connectionDb();
            unset($dbConnect_);

			$stmt = $bdd->prepare("SELECT `id_type` FROM `user_type` WHERE `type` = ?");
			$stmt->execute([$this->type]);
			$result = $stmt->fetch();
			return $result['id_type'];

		}

		//-----------------------------------------------------------------------

		private $newUser;
		public function getNewUser()
		{
			return $this->newUser;
		}
		public function setNewUser($new)
		{
			$this->newUser = $new;
		}

		//-----------------------------------------------------------------------

		private $listPseudo;
		public function getPseudoUser()
		{
			include_once('../../goldorak/model/dbConnect_.class.php');
			$dbConnect_ = new dbConnect_();
			$bdd = $dbConnect_->connectionDb();
            unset($dbConnect_);

			try {
				// Utilisation d'une requête préparée pour améliorer la sécurité même si aucun paramètre n'est utilisé ici
				$stmt = $bdd->prepare("SELECT `pseudo` FROM `user` ORDER BY `pseudo` ASC");

				// Exécutez la requête
				$stmt->execute();

				$this->listPseudo = [];
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
					$this->listPseudo[] = $row['pseudo'];
				}

				return $this->listPseudo;
			} catch (Exception $e) {
				echo "Erreur de la requete : function getPseudoUser() :" . $e->getMessage();
			}

			$bdd = null;
		}

		//-----------------------------------------------------------------------

		private $theUser;
		public function getUser($idUser)
		{
			include_once('../../goldorak/model/dbConnect_.class.php');
			$dbConnect_ = new dbConnect_();
			$bdd = $dbConnect_->connectionDb();
            unset($dbConnect_);

			date_default_timezone_set($_SESSION['timeZone']);

			try
			{
				$stmt = $bdd->prepare("SELECT
										`user`.`id_user`,
										`user`.`name`,
										`user`.`surname`,
										`user`.`pseudo`,
										`user`.`email`,
										`user`.`phone`,
										`user`.`password`,
										`user`.`avatar`,
										`subscription`.`subscription` AS 'subscription',
										`user_type`.`type` AS `type`

									FROM `user`

									LEFT JOIN `subscription`
										ON `user`.`id_subscription` = `subscription`.`id_subscription`

									LEFT JOIN `user_type`
										ON `user`.`id_type` = `user_type`.`id_type`

									WHERE `user`.`id_user` = :idUser");

				$stmt->bindParam(':idUser', $idUser, PDO::PARAM_INT);

				$stmt->execute();

				$this->theUser = $stmt->fetch(PDO::FETCH_ASSOC);

				return $this->theUser;

			} catch (Exception $e) {

				echo "Erreur de la requete : function getUser(\$idUser) :" . $e->GetMessage();

			}

			$bdd = null;
		}

		//-----------------------------------------------------------------------

		private $userList;
		public function get($whereClause, $orderBy = 'name', $ascOrDesc = 'ASC', $firstLine = 0, $linePerPage = 13)
		{
			include_once('../../goldorak/model/dbConnect_.class.php');
			$dbConnect_ = new dbConnect_();
			$bdd = $dbConnect_->connectionDb();
            unset($dbConnect_);

			try
			{

				$sqlString = "SELECT
								`user`.`id_user`,
								`user`.`name`,
								`user`.`surname`,
								`user`.`pseudo`,
								`user`.`email`,
								`user`.`phone`,
								`user`.`password`,
								`user`.`avatar`,
								`subscription`.`subscription` AS 'subscription',
								`user_type`.`type` AS `type`

							FROM `user`

							LEFT JOIN `subscription`
								ON `user`.`id_subscription` = `subscription`.`id_subscription`

							LEFT JOIN `user_type`
								ON `user`.`id_type` = `user_type`.`id_type`

							WHERE " . $whereClause . " 
							ORDER BY " . $orderBy . " " . $ascOrDesc . " 
							LIMIT :firstLine, :linePerPage";

				$stmt = $bdd->prepare($sqlString);

				// Lier les paramètres pour LIMIT
				$stmt->bindParam(':firstLine', $firstLine, PDO::PARAM_INT);
				$stmt->bindParam(':linePerPage', $linePerPage, PDO::PARAM_INT);

				$stmt->execute();

				$this->userList = [];
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
					$this->userList[] = $row;
				}

				return $this->userList;

			} catch (Exception $e) {

				echo "Erreur de la requete : function get(\$whereClause, \$orderBy = 'name', \$ascOrDesc = 'ASC', \$firstLine = 0, \$linePerPage = 13) : " . $e->GetMessage();

			}

			$bdd = null;
		}

		//-----------------------------------------------------------------------

		public function addUser(){

			include_once('../../goldorak/model/dbConnect_.class.php');
			$dbConnect_ = new dbConnect_();
			$bdd = $dbConnect_->connectionDb();
			unset($dbConnect_);
		
			try{
		
				// Vérifier si l'email existe déjà
				$stmt = $bdd->prepare("SELECT COUNT(*) FROM `user` WHERE `email` = :email");
				$stmt->bindParam(':email', $this->email, PDO::PARAM_STR);
				$stmt->execute();
				$result = $stmt->fetchColumn();
		
				if($result === 0){

					// L'email n'existe pas, vérifier si le pseudonyme existe déjà
					$stmt = $bdd->prepare("SELECT COUNT(*) FROM `user` WHERE `pseudo` = :pseudo");
					$stmt->bindParam(':pseudo', $this->pseudo, PDO::PARAM_STR);
					$stmt->execute();
					$result = $stmt->fetchColumn();
		
					if($result === 0){

						// Le pseudonyme n'existe pas, insérer un nouvel utilisateur
						$stmt = $bdd->prepare("INSERT INTO `user`(`name`,
																	`surname`,
																	`pseudo`,
																	`email`,
																	`phone`,
																	`password`,
																	`avatar`,
																	`id_subscription`,
																	`id_type`)
												VALUES(:name,
														:surname,
														:pseudo,
														:email,
														:phone,
														:password,
														:avatar,
														:id_subscription,
														:id_type)");
		
						$stmt->bindParam(':name', $this->name, PDO::PARAM_STR);
						$stmt->bindParam(':surname', $this->surname, PDO::PARAM_STR);
						$stmt->bindParam(':pseudo', $this->pseudo, PDO::PARAM_STR);
						$stmt->bindParam(':email', $this->email, PDO::PARAM_STR);
						$stmt->bindParam(':phone', $this->phone, PDO::PARAM_STR);
						$stmt->bindParam(':password', $this->password, PDO::PARAM_STR);
						$stmt->bindParam(':avatar', $this->avatar, PDO::PARAM_STR);
						$stmt->bindParam(':id_subscription', $this->getSubscriptionId(), PDO::PARAM_INT);
						$stmt->bindParam(':id_type', $this->getUserTypeId(), PDO::PARAM_INT);
		
						$stmt->execute();
		
						// Récupérer l'ID de l'utilisateur nouvellement inséré
						$stmt = $bdd->prepare("SELECT MAX(`id_user`) AS max_id FROM `user`");
						$stmt->execute();
						$id_user_ = $stmt->fetch(PDO::FETCH_ASSOC);
						$this->id_user = intval($id_user_['max_id']);
		
						return $this->id_user;

					}else{

						// Le pseudonyme existe déjà
						$_SESSION['message'] = 'Ce pseudonyme est existant! Saisissez un autre pseudonyme';
						return false;

					}

				}else{

					// L'email existe déjà
					$_SESSION['message'] = 'Ce courriel est existant! Saisissez un autre courriel';
					include_once '../../common/utilies.php';
					returnNewError();
					return false;

				}

			}catch(PDOException $e){

				$_SESSION['message'] = "Erreur lors de l'ajout de l'utilisateur : " . $e->getMessage();
				return false;

			}finally{

				// Fermer la connexion
				$bdd = null;

			}

		}
		

		//-----------------------------------------------------------------------

		public function updateUser($idUser){

			include_once('../../goldorak/model/dbConnect_.class.php');
			$dbConnect_ = new dbConnect_();
			$bdd = $dbConnect_->connectionDb();
            unset($dbConnect_);

			try
			{
				$stmt = $bdd->prepare("UPDATE `user` SET
										`name` = :name,
										`surname` = :surname,
										`pseudo` = :pseudo,
										`email` = :email,
										`phone` = :phone,
										`password` = :password,
										`avatar` = :avatar,
										`id_subscription` = (SELECT `id_subscription` FROM `subscription` WHERE `subscription` = :subscription),
										`id_type` = (SELECT `id_type` FROM `user_type` WHERE `type` = :type)
									WHERE `id_user` = :id_user");

				$stmt->bindParam(':name', $this->name, PDO::PARAM_STR);
				$stmt->bindParam(':surname', $this->surname, PDO::PARAM_STR);
				$stmt->bindParam(':pseudo', $this->pseudo, PDO::PARAM_STR);
				$stmt->bindParam(':email', $this->email, PDO::PARAM_STR);
				$stmt->bindParam(':phone', $this->phone, PDO::PARAM_STR);
				$stmt->bindParam(':password', $this->password, PDO::PARAM_STR);
				$stmt->bindParam(':avatar', $this->avatar, PDO::PARAM_STR);
				$stmt->bindParam(':subscription', $this->subscription, PDO::PARAM_STR);
				$stmt->bindParam(':type', $this->type, PDO::PARAM_STR);
				$stmt->bindParam(':id_user', $idUser, PDO::PARAM_INT);

				$stmt->execute();
				
				$_SESSION['message'] = "Les modifications sont enregistrées!";
			}
			catch (Exception $e)
			{
				$_SESSION['message'] = "Erreur de la requete  : function updateUser(\$idUser) :" . $e->GetMessage();
			}

			$bdd=null;
		}


		//-----------------------------------------------------------------------

		public function deleteUser($id)
		{

			include_once('../../goldorak/model/dbConnect_.class.php');
			$dbConnect_ = new dbConnect_();
			$bdd = $dbConnect_->connectionDb();
            unset($dbConnect_);

			$stmt = $bdd->prepare("SELECT COUNT(*) FROM `user` WHERE `id_user` = :id_user");
			$stmt->bindParam(':id_user', $id, PDO::PARAM_INT);
			$stmt->execute();
			$resultat = $stmt->fetchColumn();

			if($resultat > 0){

				try
				{
					$stmt = $bdd->prepare('DELETE FROM user WHERE id_user = :id_user');
					$stmt->bindParam(':id_user', $id, PDO::PARAM_INT);
					$stmt->execute();
					$bdd=null;
					return true;
				}
				catch (Exception $e)
				{
					echo "Erreur de la requete :" . $e->GetMessage();
					$bdd=null;
					return false;
				}

			}else{

				$bdd=null;
				return false;

			}

		}
		
		private $userExist;
		public function verifUser($email)
		{
			include_once('../../goldorak/model/dbConnect_.class.php');
			$dbConnect_ = new dbConnect();
			$bdd = $dbConnect_->connectionDb();
            unset($dbConnect_);

			try
			{

				$stmt = $bdd->prepare("SELECT COUNT(*) AS `number`
									FROM `user`
									WHERE `email` = :email");

				$stmt->bindParam(':email', $email);

				$stmt->execute();

				$this->userExist = $stmt->fetch(PDO::FETCH_ASSOC);

				return $this->userExist['number'];

			}
			catch (Exception $e)
			{

				echo "Erreur de la requete : function verifUser(\$email) :" . $e->GetMessage();

			}

			$bdd = null;
		}

	}
	
?>