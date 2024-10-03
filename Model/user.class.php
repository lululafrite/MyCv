<?php

	namespace User\Model;

	require_once('../model/dbConnect.class.php');

	use MyCv\Model\dbConnect;
	use \PDO;
	use \PDOException;

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

		private $name = "";
		public function getName():string{
			return $this->name;
		}
		public function setName(string $new):void{
			$this->name = $new;
		}

		//-----------------------------------------------------------------------

		private $surname = "";
		public function getSurname():string{
			return $this->surname;
		}
		public function setSurname(string $new):void{
			$this->surname = $new;
		}

		//-----------------------------------------------------------------------

		private $pseudo = "";
		public function getPseudo():string{
			return $this->pseudo;
		}
		public function setPseudo(string $new):void{
			$this->pseudo = $new;
		}

		//-----------------------------------------------------------------------

		private $email = "";
		public function getEmail():string{
			return $this->email;
		}
		public function setEmail(string $new):void{
			$this->email = $new;
		}

		//-----------------------------------------------------------------------

		private $phone = "";
		public function getPhone():string{
			return $this->phone;
		}
		public function setPhone(string $new):void{
			$this->phone = $new;
		}

		//-----------------------------------------------------------------------

		private $password = "";
		public function getPassword():string{
			return $this->password;
		}
		public function setPassword(string $new):void{
			$this->password = $new;
		}

		//-----------------------------------------------------------------------

		private $avatar = "";
		public function getAvatar():string{
			return $this->avatar;
		}
		public function setAvatar(string $new):void{
			$this->avatar = $new;
		}

		//-----------------------------------------------------------------------

		private $subscription = "";
		public function getSubscription():string{
			return $this->subscription;
		}
		public function setSubscription(string $new):void{
			$this->subscription = $new;
		}

		//-----------------------------------------------------------------------

		private $type = "";
		public function getType():string{
			return $this->type;
		}
		public function setType(string $new):void{
			$this->type = $new;
		}

		//-----------------------------------------------------------------------

		private $pw = "";
		public function getPw():string{
			return $this->pw;
		}
		public function setPw(string $new):void{
			$this->pw = $new;
		}

		//-----------------------------------------------------------------------

		private $criteriaName = "";
		public function getCriteriaName():string{
			return $this->criteriaName;
		}
		public function setCriteriaName(string $new):void{
			$this->criteriaName = $new;
		}

		private $criteriaPseudo = "";
		public function getCriteriaPseudo():string{
			return $this->criteriaPseudo;
		}
		public function setCriteriaPseudo(string $new):void{
			$this->criteriaPseudo = $new;
		}

		private $criteriaType = "";
		public function getCriteriaType():string{
			return $this->criteriaType;
		}
		public function setCriteriaType(string $new):void{
			$this->criteriaType = $new;
		}

		//----------------------------- CRUD -----------------------------------

		private $currentUser = array();
		public function getCurrentUser(int $id_user):array{
	
			if(self::checkIdUser($id_user)){

				$bdd = dbConnect::dbConnect(new dbConnect());

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

					$stmt->bindParam(':idUser', $id_user, PDO::PARAM_INT);

					$stmt->execute();
					$bdd = null;

					$this->currentUser = $stmt->fetch(PDO::FETCH_ASSOC);
					$_SESSION['other']['error'] = false;
					$_SESSION['other']['message'] = "The user with id " . $id_user . " is existing in database!!!";
	
					return $this->currentUser;

				}catch(PDOException $e){

					$bdd=null;

					$_SESSION['other']['error'] = true;
					$_SESSION['other']['message'] = "Error to query : function getCurrentUser() :" . $e->GetMessage();

					return $this->currentUser;
				}
			}else{

				$bdd=null;

				$_SESSION['other']['error'] = true;
				$_SESSION['other']['message'] = "The user with id " . $id_user . " is not existing!!!";

				return $this->currentUser;
			}
		}

		//-----------------------------------------------------------------------

		private $userList = array();
		public function getUserList(string $whereClause, string $orderBy = 'name', string $ascOrDesc = 'ASC', int $firstLine = 0, int $linePerPage = 13):array{

			$bdd = dbConnect::dbConnect(new dbConnect());

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

										WHERE $whereClause 
										ORDER BY :orderBy :ascOrDesc 
										LIMIT :firstLine, :linePerPage");

				//$stmt->bindParam(':whereClause', $whereClause, PDO::PARAM_STR);
				$stmt->bindParam(':orderBy', $orderBy, PDO::PARAM_STR);
				$stmt->bindParam(':ascOrDesc', $ascOrDesc, PDO::PARAM_STR);
				$stmt->bindParam(':firstLine', $firstLine, PDO::PARAM_INT);
				$stmt->bindParam(':linePerPage', $linePerPage, PDO::PARAM_INT);

				$stmt->execute();

				$bdd=null;

				$this->userList = $stmt->fetchAll(PDO::FETCH_ASSOC);
				$_SESSION['other']['error'] = false;
				$_SESSION['other']['message'] = 'The query is executed correctly!!!';
				
				return $this->userList;

			}catch (PDOException $e){
				$bdd=null;

				$_SESSION['other']['error'] = true;
				$_SESSION['other']['message'] = 'Error to query : ' . $e->getMessage();

				return $this->userList;
			}
		}

		//-----------------------------------------------------------------------

		private $insertUser;
		public function insertUser():int{
		
			if(!self::checkEmail($this->email)){

				if(!self::checkPseudo($this->pseudo)){
					
					try{
						$hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);
						$bdd = dbConnect::dbConnect(new dbConnect());

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
														(SELECT `id_subscription` FROM `subscription` WHERE `subscription`=:subscription),
														(SELECT `id_type` FROM `user_type` WHERE `type`=:type),
														:pw)");
		
						$stmt->bindParam(':name', $this->name, PDO::PARAM_STR);
						$stmt->bindParam(':surname', $this->surname, PDO::PARAM_STR);
						$stmt->bindParam(':pseudo', $this->pseudo, PDO::PARAM_STR);
						$stmt->bindParam(':email', $this->email, PDO::PARAM_STR);
						$stmt->bindParam(':phone', $this->phone, PDO::PARAM_STR);
						$stmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
						$stmt->bindParam(':avatar', $this->avatar, PDO::PARAM_STR);
						$stmt->bindParam(':subscription', $this->subscription, PDO::PARAM_STR);
						$stmt->bindParam(':type', $this->type, PDO::PARAM_STR);
						$stmt->bindParam(':pw', $this->password, PDO::PARAM_STR);
		
						$stmt->execute();
		
						// Récupérer l'ID de l'utilisateur nouvellement inséré
						$stmt = $bdd->prepare("SELECT MAX(`id_user`) AS id_user FROM `user`");
						$stmt->execute();

						$this->insertUser = $stmt->fetchColumn();
						$this->insertUser = intval($this->insertUser);

						$_SESSION['other']['error'] = false;
						$_SESSION['other']['message'] = "The user is add with success!!!";
		
						$bdd = null;
						return $this->insertUser;
						
					}catch(PDOException $e){
						$_SESSION['other']['error'] = true;
						$_SESSION['other']['message'] = "Error to query!!! function insertUser() in user.class.php" . $e->getMessage();

						$bdd = null;
						return 0;
					}

				}else{
					$_SESSION['other']['error'] = true;
					$_SESSION['other']['message'] = "This pseudonyme is existent!!! function insertUser() in user.class.php";

					$bdd = null;
					return 0;
				}

			}else{
				$_SESSION['other']['error'] = true;
				$_SESSION['other']['message'] = "This email is existent!!! function insertUser() in user.class.php";

				$bdd = null;
				return 0;
			}
		}

		//-----------------------------------------------------------------------
		private $updateUser = false;
		public function updateUser(int $id_user):bool{
			
			if(self::checkIdUser($id_user)){

				$bdd = dbConnect::dbConnect(new dbConnect());
				
				try{
					$stmt = $bdd->prepare("UPDATE `user`
											SET `name` = :name,
												`surname` = :surname,
												`pseudo` = :pseudo,
												`email` = :email,
												`phone` = :phone,
												`avatar` = :avatar,
												`id_subscription` = (SELECT `id_subscription` FROM `subscription` WHERE `subscription`=:subscription),
												`id_type` = (SELECT `id_type` FROM `user_type` WHERE `type`=:type)

											WHERE `id_user` = :idUser");
					
					$stmt->bindParam(':name', $this->name, PDO::PARAM_STR);
					$stmt->bindParam(':surname', $this->surname, PDO::PARAM_STR);
					$stmt->bindParam(':pseudo', $this->pseudo, PDO::PARAM_STR);
					$stmt->bindParam(':email', $this->email, PDO::PARAM_STR);
					$stmt->bindParam(':phone', $this->phone, PDO::PARAM_STR);
					$stmt->bindParam(':avatar', $this->avatar, PDO::PARAM_STR);
					$stmt->bindParam(':subscription', $this->subscription, PDO::PARAM_STR);
					$stmt->bindParam(':type', $this->type, PDO::PARAM_STR);
					$stmt->bindParam(':idUser', $id_user, PDO::PARAM_INT);
					
					$stmt->execute();

					$bdd=null;
					
					$_SESSION['other']['error'] = false;
					$_SESSION['other']['message'] = "The user with id " . $id_user . " is update with success!!!";
					
					$this->updateUser = true;
					return $this->updateUser;

				}catch(PDOException $e){

					$bdd=null;
					
					$_SESSION['other']['error'] = false;
					$_SESSION['other']['message'] = "Error to query!!! function updateUser() in user.class.php :" . $e->GetMessage();

					return $this->updateUser;
				}
			}else{
				$bdd=null;

				$_SESSION['other']['error'] = true;
				$_SESSION['other']['message'] = "The user with id " . $id_user . " is not existing!!!";

				return $this->updateUser;
			}
		}

		//-----------------------------------------------------------------------

		private $deleteUser = false;
		public function deleteUser(int $id_user):bool{
			
			if(self::checkIdUser($id_user)){

				$bdd = dbConnect::dbConnect(new dbConnect());
			
				try{
					$stmt = $bdd->prepare('DELETE FROM user WHERE id_user = :id_user');
					$stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
					$stmt->execute();

					$_SESSION['other']['error'] = false;
					$_SESSION['other']['message'] = "The user with id " . $id_user . " is delete with success!!!";

					$this->deleteUser = true;

				}catch (PDOException $e){
					$_SESSION['other']['error'] = true;
					$_SESSION['other']['message'] = "Error to delete user : " . $e->getMessage();
				}

			}else{
				$_SESSION['other']['error'] = true;
				$_SESSION['other']['message'] = "The user with id " . $id_user . " is not existing!!!";
			}

			$bdd=null;
			return $this->deleteUser;
		}

		//-----------------------------------------------------------------------
		//----------------------------- CHECK VALUE -----------------------------
		//-----------------------------------------------------------------------
		
		private static $checkUserConnect = array();
        public static function checkUserConnect(string $email, string $pw):array{

			$bdd = dbConnect::dbConnect(new dbConnect());

            try{
                $stmt = $bdd->prepare("SELECT   `id_user`,
                                                `pseudo`,
                                                `avatar`,
                                                `password`,
                                                `user_type`.`type` AS `type`,
                                                `subscription`.`subscription` AS `subscription`

                                        FROM `user`

                                        LEFT JOIN `user_type`
                                            ON `user`.`id_type` = `user_type`.`id_type`

                                        LEFT JOIN `subscription`
                                            ON `user`.`id_subscription` = `subscription`.`id_subscription`

                                        WHERE `email` = :email AND `password` = :password");
            
                $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                $stmt->bindParam(':password', $pw, PDO::PARAM_STR);
            
                $stmt->execute();

                $bdd=null;

                self::$checkUserConnect = $stmt->fetch(PDO::FETCH_ASSOC);
                $_SESSION['other']['error'] = false;
                $_SESSION['other']['message'] = "Utilisateur trouvé";

                return self::$checkUserConnect;

            }catch(PDOException $e){
                $bdd=null;

                $_SESSION['other']['error'] = true;
                $_SESSION['other']['message'] = "Erreur de la requête : " . $e->getMessage();
                
                return self::$checkUserConnect;
            }
        }
		
		private static $checkIdUser;
		public static function checkIdUser(int $id_user):bool{

			$bdd = dbConnect::dbConnect(new dbConnect());
			
			try{
				$stmt = $bdd->prepare("SELECT COUNT(*) FROM `user` WHERE `id_user` = :id_user");
				$stmt->bindParam(':id_user', $id_user, PDO::PARAM_STR);

				$stmt->execute();

				$result = $stmt->fetchColumn();

				$bdd=null;

				if($result > 0){
					self::$checkIdUser = true;
					$_SESSION['other']['message'] = "This id_user is existent!!!";
				}else{
					self::$checkIdUser = false;
					$_SESSION['other']['message'] = "This id_user is not existent!!!";
				}

				$_SESSION['other']['error'] = false;
				return self::$checkIdUser;

			}catch(PDOException $e){
				$bdd=null;
				$_SESSION['other']['error'] = true;
				$_SESSION['other']['message'] = "Error to function checkIdUser() in user.class.php:" . $e->getMessage();
				return false;
			}
		}

		//-----------------------------------------------------------------------
		
		private static $checkPseudo;
		public static function checkPseudo(string $pseudo):bool{

			$bdd = dbConnect::dbConnect(new dbConnect());
			
			try{
				$stmt = $bdd->prepare("SELECT COUNT(*) FROM `user` WHERE `pseudo` = :pseudo");
				$stmt->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);

				$stmt->execute();

				$result = $stmt->fetchColumn();

				$bdd=null;

				if($result > 0){
					self::$checkPseudo = true;
					$_SESSION['other']['message'] = "This pseudo is existent!!!";
				}else{
					self::$checkPseudo = false;
					$_SESSION['other']['message'] = "This pseudo is not existent!!!";
				}

				$_SESSION['other']['error'] = false;
				return self::$checkPseudo;

			}catch(PDOException $e){
				$bdd=null;
				$_SESSION['other']['message'] = "Error to function checkPseudo() in user.class.php:" . $e->getMessage();
				return false;
			}
		}

		//-----------------------------------------------------------------------
		
		private static  $checkEmail;
		public static function checkEmail(string $email):bool{

			$bdd = dbConnect::dbConnect(new dbConnect());
			
			try{
				$stmt = $bdd->prepare("SELECT COUNT(*) FROM `user` WHERE `email` = :email");
				$stmt->bindParam(':email', $email, PDO::PARAM_STR);

				$stmt->execute();

				$result = $stmt->fetchColumn();

				$bdd=null;

				if($result > 0){
					self::$checkEmail = true;
					$_SESSION['other']['message'] = "This email is existent!!!";
				}else{
					self::$checkEmail = false;
					$_SESSION['other']['message'] = "This email is not existent!!!";
				}

				$_SESSION['other']['error'] = false;
				return self::$checkEmail;

			}catch(PDOException $e){
				$bdd=null;
				$_SESSION['other']['message'] = "Error to function checkEmail() in user.class.php:" . $e->getMessage();
				return false;
			}
		}

		//-----------------------------------------------------------------------
		
        private static $pwConnect = "";
        public static function checkPassword(string $email):string{

			$bdd = dbConnect::dbConnect(new dbConnect());

            try{
                $stmt = $bdd->prepare("SELECT `password`
                                        FROM `user`
                                        WHERE `email` = :email");
            
                $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            
                $stmt->execute();

                $bdd=null;

                self::$pwConnect = $stmt->fetchColumn();
                $_SESSION['other']['error'] = false;
                $_SESSION['other']['message'] = "Mot de passe trouvé";
                
                return self::$pwConnect;

            }catch (PDOException $e){
                $bdd=null;

                $_SESSION['other']['error'] = true;
                $_SESSION['other']['message'] = "Erreur de la requete : " . $e->getMessage();

                return self::$pwConnect;
            }
        }

		//-----------------------------------------------------------------------
		
		private static  $checkNbOfProduct = 0;
		public static function checkNbOfProduct(string $whereClause):int{

			$bdd = dbConnect::dbConnect(new dbConnect());
			
			try{
				$stmt = $bdd->prepare("SELECT COUNT(*) FROM `user` WHERE $whereClause ");
				$stmt->execute();
				self::$checkNbOfProduct = $stmt->fetchColumn();

				$bdd=null;

				$_SESSION['other']['error'] = false;
				$_SESSION['other']['message'] = "The query is executed correctly!!!";

			}catch(PDOException $e){
				$bdd=null;
				$_SESSION['other']['error'] = true;
				$_SESSION['other']['message'] = "Error to function checkNbOfProduct() in user.class.php:" . $e->getMessage();
				return self::$checkNbOfProduct;
			}

			return self::$checkNbOfProduct;
		}
	}
	
?>