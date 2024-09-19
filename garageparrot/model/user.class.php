<?php

	namespace GarageParrot\Model;

	require_once('../../model/dbConnect.class.php');

	use \PDO;
	use \PDOException;
	use MyCv\Model\dbConnect;

	class User
	{
		private $id_user = 0;
		public function getId():int{
			return $this->id_user;
		}
		public function setId(int $new):void{
			$this->id_user = $new;
		}

		//-----------------------------------------------------------------------

		private $name;
		public function getName():string{
			return $this->name;
		}
		public function setName(string $new):void{
			$this->name = $new;
		}

		//-----------------------------------------------------------------------

		private $surname;
		public function getSurname():string{
			return $this->surname;
		}
		public function setSurname(string $new):void{
			$this->surname = $new;
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

		private $email;
		public function getEmail():string{
			return $this->email;
		}
		public function setEmail(string $new):void{
			$this->email = $new;
		}

		//-----------------------------------------------------------------------

		private $phone;
		public function getPhone():string{
			return $this->phone;
		}
		public function setPhone(string $new):void{
			$this->phone = $new;
		}

		//-----------------------------------------------------------------------

		private $password;
		public function getPassword():string{
			return $this->password;
		}
		public function setPassword(string $new):void{
			$this->password = $new;
		}

		//-----------------------------------------------------------------------

		private $avatar;
		public function getAvatar():string{
			return $this->avatar;
		}
		public function setAvatar(string $new):void{
			$this->avatar = $new;
		}

		//-----------------------------------------------------------------------

		private $subscription;
		public function getSubscription():string{
			return $this->subscription;
		}
		public function setSubscription(string $new):void{
			$this->subscription = $new;
		}

		//-----------------------------------------------------------------------
		
		private $idSubscription;
		public function getSubscriptionId():int{

			$myDbConnect = new dbConnect();
			$bdd = $myDbConnect->connectionDb();
            unset($myDbConnect);

            date_default_timezone_set($_SESSION['timeZone']);
			
			try{
				$stmt = $bdd->prepare("SELECT `id_subscription` FROM `subscription` WHERE `subscription` = :subscription");
				$stmt->bindParam(':subscription', $this->subscription, PDO::PARAM_STR);

				$stmt->execute();

				$this->idSubscription = $stmt->fetch(PDO::FETCH_ASSOC);

				$bdd=null;
				return $this->idSubscription['id_subscription'];

			}catch(PDOException $e){
				$bdd=null;
				echo "Erreur de la requete : function getSubscriptionId() :" . $e->getMessage();
				return 0;
			}
		}

		//-----------------------------------------------------------------------
		
		private $type;
		public function getType():string{
			return $this->type;
		}
		public function setType(string $new):void{
			$this->type = $new;
		}

		//-----------------------------------------------------------------------

		private $idUserType;
		public function getUserTypeId():int{

			$myDbConnect = new dbConnect();
			$bdd = $myDbConnect->connectionDb();
            unset($myDbConnect);

			try{
				$stmt = $bdd->prepare("SELECT `id_type` FROM `user_type` WHERE `type` = :idUserType");
				$stmt->bindParam(':idUserType', $this->type, PDO::PARAM_STR);

				$stmt->execute();

				$this->idUserType =  $stmt->fetch(PDO::FETCH_ASSOC);
				$bdd=null;
				return $this->idUserType['id_type'];
				
			}catch(PDOException $e){
				$bdd=null;
				echo "Erreur de la requete : function getUserTypeId() :" . $e->getMessage();
				return 0;
			}
		}

		//-----------------------------------------------------------------------

		private $pw;
		public function getPw():string{
			return $this->pw;
		}
		public function setPw(string $new):void{
			$this->pw = $new;
		}

		//-----------------------------------------------------------------------

		private $newUser = false;
		public function getNewUser():bool{
			return $this->newUser;
		}
		public function setNewUser(bool $new):void{
			$this->newUser = $new;
		}

		//-----------------------------------------------------------------------

		private $addUser;
        public function getAddUser():bool{
            if(is_null($_SESSION['addUser']))
            {
                $_SESSION['addUser']=false;
				$this->addUser = false;
            }
            return $this->addUser;
        }
        public function setAddUser(bool $new):void{
            $_SESSION['addUser']=$new;
			$this->addUser = $new;
        }

		//-----------------------------------------------------------------------
        
		private $listPseudo;
		public function getPseudoUser():array{

			$myDbConnect = new dbConnect();
			$bdd = $myDbConnect->connectionDb();
            unset($myDbConnect);

			try{

				$stmt = $bdd->prepare("SELECT `pseudo` FROM `user` ORDER BY `pseudo` ASC");

				$stmt->execute();

				$this->listPseudo = $stmt->fetch(PDO::FETCH_ASSOC);

				$bdd = null;
				return $this->listPseudo['pseudo'];

			}catch(PDOException $e){
				$bdd = null;
				echo "Erreur de la requete : function getPseudoUser() :" . $e->getMessage();
				return false;
			}

		}

		//-----------------------------------------------------------------------

		private $currentUser = array();
		public function getCurrentUser($idUser):array{

			$myDbConnect = new dbConnect();
			$bdd = $myDbConnect->connectionDb();
            unset($myDbConnect);

			date_default_timezone_set($_SESSION['timeZone']);

			try{
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

				$this->currentUser[] = $stmt->fetch(PDO::FETCH_ASSOC);
				$bdd=null;
				return $this->currentUser[0];

			}catch(PDOException $e){
				$bdd=null;
				echo "Erreur de la requete : function getCurrentUser(\$idUser) :" . $e->GetMessage();
				return $this->currentUser[0];
			}
		}

		//-----------------------------------------------------------------------

		private $userList;
		public function get($whereClause, $orderBy = 'name', $ascOrDesc = 'ASC', $firstLine = 0, $linePerPage = 13):array{

			$myDbConnect = new dbConnect();
			$bdd = $myDbConnect->connectionDb();
            unset($myDbConnect);

            date_default_timezone_set($_SESSION['timeZone']);

			try{
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

										LEFT JOIN `subscription` ON `user`.`id_subscription` = `subscription`.`id_subscription`
										LEFT JOIN `user_type` ON `user`.`id_type` = `user_type`.`id_type`

										WHERE :whereClause 
										ORDER BY :orderBy :ascOrDesc 
										LIMIT :firstLine, :linePerPage");

				$stmt->bindParam(':whereClause', $whereClause, PDO::PARAM_STR);
				$stmt->bindParam(':orderBy', $orderBy, PDO::PARAM_STR);
				$stmt->bindParam(':ascOrDesc', $ascOrDesc, PDO::PARAM_STR);
				$stmt->bindParam(':firstLine', $firstLine, PDO::PARAM_INT);
				$stmt->bindParam(':linePerPage', $linePerPage, PDO::PARAM_INT);

				$stmt->execute();

				$this->userList = $stmt->fetchAll(PDO::FETCH_ASSOC);

				$bdd = null;
				return $this->userList;

			}catch (PDOException $e){
				$bdd = null;
				echo "Erreur de la requete : function get() dans user.class.php : " . $e->GetMessage();
				return false;
			}
		}

		//-----------------------------------------------------------------------

		private $idUser;
		public function addUser():int{

			$myDbConnect = new dbConnect();
			$bdd = $myDbConnect->connectionDb();
            unset($myDbConnect);
		
			try{
		
				// Vérifier si l'email existe déjà
				$stmt = $bdd->prepare("SELECT COUNT(*) FROM `user` WHERE `email` = :email");
				$stmt->bindParam(':email', $this->email, PDO::PARAM_STR);
				$stmt->execute();
				$result = $stmt->fetchColumn();
		
				if($result === 0){

					// L'email n'existe pas, vérifier si le pseudonyme est existant
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
																	`id_type`,
																	`pw`)
												VALUES(:name,
														:surname,
														:pseudo,
														:email,
														:phone,
														:password,
														:avatar,
														(SELECT `id_subscription` FROM `user_subscription` WHERE `subscription`=:subscription),
														(SELECT `id_type` FROM `user_type` WHERE `type`=:type),
														:pw)");
		
						$stmt->bindParam(':name', $this->name, PDO::PARAM_STR);
						$stmt->bindParam(':surname', $this->surname, PDO::PARAM_STR);
						$stmt->bindParam(':pseudo', $this->pseudo, PDO::PARAM_STR);
						$stmt->bindParam(':email', $this->email, PDO::PARAM_STR);
						$stmt->bindParam(':phone', $this->phone, PDO::PARAM_STR);
						$stmt->bindParam(':password', $this->password, PDO::PARAM_STR);
						$stmt->bindParam(':avatar', $this->avatar, PDO::PARAM_STR);
						$stmt->bindParam(':subscription', $this->subscription, PDO::PARAM_STR);
						$stmt->bindParam(':type', $this->type, PDO::PARAM_STR);
						$stmt->bindParam(':pw', $this->password, PDO::PARAM_STR);
		
						$stmt->execute();
		
						// Récupérer l'ID de l'utilisateur nouvellement inséré
						$stmt = $bdd->prepare("SELECT MAX(`id_user`) AS id FROM `user`");
						$stmt->execute();
						$this->idUser = $stmt->fetch(PDO::FETCH_ASSOC);
		
						$bdd = null;
						return intval($this->idUser['id']);

					}else{

						// Le pseudonyme existe déjà
						//$_SESSION['message'] = 'Ce pseudonyme est existant! Saisissez un autre pseudonyme';
						echo("Ce pseudonyme est existant!!! fonction addUser() dans user.class.php ");
						$bdd = null;
						return false;

					}

				}else{

					//$_SESSION['message'] = 'Ce courriel est existant! Saisissez un autre courriel';
					//require_once '../../common/utilies.php';
					//returnNewError();
					echo("Ce courriel est existant!!! fonction addUser() dans user.class.php ");
					$bdd = null;
					return false;

				}

			}catch(PDOException $e){
				$bdd = null;
				echo("Erreur de la requête!!! fonction addUser() dans user.class.php " . $e->getMessage());
				return false;
			}
		}

		//-----------------------------------------------------------------------

		public function updateUser($idUser):bool{

			$myDbConnect = new dbConnect();
			$bdd = $myDbConnect->connectionDb();
            unset($myDbConnect);

            date_default_timezone_set($_SESSION['timeZone']);
			
			try{
				$stmt = $bdd->prepare("UPDATE `user`
										SET `name` = :name,
											`surname` = :surname,
											`pseudo` = :pseudo,
											`email` = :email,
											`phone` = :phone,
											`password` = :password,
											`avatar` = :avatar,
											`id_subscription` = (SELECT `id_subscription` FROM `user_subscription` WHERE `subscription`=:subscription),
											`id_type` = (SELECT `id_type` FROM `user_type` WHERE `type`=:type,
											`pw` = :password)

										WHERE `id_user` = :idUser");
				
				$stmt->bindParam(':name', $this->name, PDO::PARAM_STR);
				$stmt->bindParam(':surname', $this->surname, PDO::PARAM_STR);
				$stmt->bindParam(':pseudo', $this->pseudo, PDO::PARAM_STR);
				$stmt->bindParam(':email', $this->email, PDO::PARAM_STR);
				$stmt->bindParam(':phone', $this->phone, PDO::PARAM_STR);
				$stmt->bindParam(':password', $this->password, PDO::PARAM_STR);
				$stmt->bindParam(':avatar', $this->avatar, PDO::PARAM_STR);
				$stmt->bindParam(':subscription', $this->subscription, PDO::PARAM_STR);
				$stmt->bindParam(':type', $this->type, PDO::PARAM_STR);
				$stmt->bindParam(':pw', $this->password, PDO::PARAM_STR);
				$stmt->bindParam(':idUser', $idUser, PDO::PARAM_INT);
				
				$stmt->execute();

				$bdd=null;
				return true;

			}catch (PDOException $e){
				echo "Erreur de la requete dans la fonction updateUser() dans user.class.php :" . $e->GetMessage();
				$bdd=null;
				return false;
			}
		}

		//-----------------------------------------------------------------------

		public function deleteUser($id):bool{
			
			$myDbConnect = new dbConnect();
			$bdd = $myDbConnect->connectionDb();
            unset($myDbConnect);

			$stmt = $bdd->prepare("SELECT COUNT(*) FROM `user` WHERE `id_user` = :id_user");
			$stmt->bindParam(':id_user', $id, PDO::PARAM_INT);
			$stmt->execute();
			$resultat = $stmt->fetchColumn();

			if($resultat > 0){

				try{
					$stmt = $bdd->prepare('DELETE FROM user WHERE id_user = :id_user');
					$stmt->bindParam(':id_user', $id, PDO::PARAM_INT);
					$stmt->execute();
					
					$bdd=null;
					return true;

				}catch (PDOException $e){
					echo "Erreur de la requete!!! fonction deleteUser() dans user.class.php :" . $e->GetMessage();
					$bdd=null;
					return false;
				}

			}else{
				$bdd=null;
				return false;
			}
		}
		
		private $verifUser;
		public function verifUser($email):int{

			$myDbConnect = new dbConnect();
			$bdd = $myDbConnect->connectionDb();
            unset($myDbConnect);

            date_default_timezone_set($_SESSION['timeZone']);
			
			try{
			    $stmt = $bdd->prepare("SELECT COUNT(*) AS `number`
										FROM `user`
										WHERE `email` = :email");

				$stmt->bindParam(':email', $email, PDO::PARAM_STR);

				$stmt->execute();

				$this->verifUser = $stmt->fetch(PDO::FETCH_ASSOC);

				$bdd=null;
				return $this->verifUser['number'];

			}catch (PDOException $e){
				$bdd=null;
				echo "Erreur de la requete : function verifUser(\$email) :" . $e->GetMessage();
				return false;
			}
		}

	}
	
?>