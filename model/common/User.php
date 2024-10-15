<?php
	//user.class.php
	//author : Ludovic FOLLACO
	//checked to 2024-10-04_15:22
	namespace Model\User;

	use \PDO;
	use \PDOException;
	use Model\DbConnect\DbConnect;

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

		private $token = "";
		public function getToken():string{
			return $this->token;
		}
		public function setToken(string $new):void{
			$this->token = $new;
		}

		//-----------------------------------------------------------------------

		private $timer_token = 0;
		public function getTimerToken():int{
			return $this->timer_token;
		}
		public function setTimerToken(int $new):void{
			$this->timer_token = $new;
		}

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

				$bdd = DbConnect::DbConnect(new DbConnect());

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

					$this->currentUser = $stmt->fetch(PDO::FETCH_ASSOC);
					
					$_SESSION['other']['error'] = false;
					$_SESSION['other']['message'] = "The user with id " . $id_user . " is existing in database!!!";
	
				}catch(PDOException $e){
					$_SESSION['other']['error'] = true;
					$_SESSION['other']['message'] = "Error to query : function getCurrentUser() :" . $e->GetMessage();
				}
			}else{
				$_SESSION['other']['error'] = true;
				$_SESSION['other']['message'] = "The user with id " . $id_user . " is not existing!!!";
			}
			
			$bdd = null;
			return $this->currentUser;
		}

		//-----------------------------------------------------------------------

		private $userList = array();
		public function getUserList(string $whereClause, string $orderBy = 'name', string $ascOrDesc = 'ASC', int $firstLine = 0, int $linePerPage = 13):array{
			
			$bdd = DbConnect::DbConnect(new DbConnect());

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

				$this->userList = $stmt->fetchAll(PDO::FETCH_ASSOC);

				$_SESSION['other']['error'] = false;
				$_SESSION['other']['message'] = 'The query is executed correctly!!!';

			}catch (PDOException $e){
				$_SESSION['other']['error'] = true;
				$_SESSION['other']['message'] = 'Error to query : ' . $e->getMessage();
			}

			$bdd=null;
			return $this->userList;
		}

		//-----------------------------------------------------------------------

		private $insertUser = 0;
		public function insertUser():int{

			$token = bin2hex(random_bytes(32));
			$timerToken = date('U');

			$emailExist = false;
			$pseudoExist = false;

			for($i=0; $i<3; $i++){
				
				if ($i === 0){

					if(!self::checkEmail($this->email, 'mycv')){

						if(!self::checkPseudo($this->pseudo, 'mycv')){
							$bdd = DbConnect::dbConnect(new DbConnect());
						}else{
							$pseudoExist = true;
						}

					}else{
						$emailExist = true;
					}

				}elseif ($i === 1){

					if(!self::checkEmail($this->email, 'goldorak')){

						if(!self::checkPseudo($this->pseudo, 'goldorak')){
							$bdd = DbConnect::dbConnectGoldorak(new DbConnect());
						}else{
							$pseudoExist = true;
						}

					}else{
						$emailExist = true;
					}

				}elseif ($i === 2){

					if(!self::checkEmail($this->email, 'garage_parrot')){

						if(!self::checkPseudo($this->pseudo, 'garage_parrot')){
							$bdd = DbConnect::dbConnectGP(new DbConnect());
						}else{
							$pseudoExist = true;
						}

					}else{
						$emailExist = true;
					}
				}

				if(!$emailExist){

					if(!$pseudoExist){
						
						try{
							$hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);

							$stmt = $bdd->prepare("INSERT INTO `user`(`name`,
																		`surname`,
																		`pseudo`,
																		`email`,
																		`phone`,
																		`password`,
																		`avatar`,
																		`id_subscription`,
																		`id_type`,
																		`token`,
																		`timer_token`,
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
															:token,
															:timer_token,
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
							$stmt->bindParam(':token', $token, PDO::PARAM_STR);
							$stmt->bindParam(':timer_token', $timerToken, PDO::PARAM_INT);
							$stmt->bindParam(':pw', $this->password, PDO::PARAM_STR);
			
							$stmt->execute();
			
							// Récupérer l'ID de l'utilisateur nouvellement inséré
							$stmt = $bdd->prepare("SELECT MAX(`id_user`) AS id_user FROM `user`");
							$stmt->execute();

							$this->insertUser = intval($stmt->fetchColumn());

							$_SESSION['other']['error'] = false;
							$_SESSION['other']['message'] = "The user is add with success!!!";
							
						}catch(PDOException $e){
							$_SESSION['other']['error'] = true;
							$_SESSION['other']['message'] = "Error to query!!! function insertUser() in user.class.php" . $e->getMessage() . '<br>';
						}

					}else{
						$_SESSION['other']['error'] = true;
						$_SESSION['other']['message'] = "This pseudonyme is existent!!! function insertUser() in user.class.php";
					}

				}else{
					$_SESSION['other']['error'] = true;
					$_SESSION['other']['message'] = "This email is existent!!! function insertUser() in user.class.php";
				}
				
				$emailExist = false;
				$pseudoExist = false;
			}
		
			$bdd = null;
			return $this->insertUser;
		}

		//-----------------------------------------------------------------------
		private $updateUser = false;
		public function updateUser(int $id_user):bool{
			
			$idUserExist = false;

			for($i=0; $i<3; $i++){
				
				if ($i === 0){

					if(self::checkIdUser($id_user, 'mycv')){
						$bdd = DbConnect::dbConnect(new DbConnect());
						$idUserExist = true;
					}

				}elseif ($i === 1){

					if(self::checkIdUser($id_user, 'goldorak')){
						$bdd = DbConnect::dbConnectGoldorak(new DbConnect());
						$idUserExist = true;
					}

				}elseif ($i === 2){
					if(self::checkIdUser($id_user, 'garage_parrot')){
						$bdd = DbConnect::dbConnectGP(new DbConnect());
						$idUserExist = true;
					}
				}
			
				if($idUserExist){
					
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
						
						$_SESSION['other']['error'] = false;
						$_SESSION['other']['message'] = "The user with id " . $id_user . " is update with success!!!";
						
						$this->updateUser = true;

					}catch(PDOException $e){
						$_SESSION['other']['error'] = false;
						$_SESSION['other']['message'] = "Error to query!!! function updateUser() in user.class.php :" . $e->GetMessage();
					}
				}else{
					$_SESSION['other']['error'] = true;
					$_SESSION['other']['message'] = "The user with id " . $id_user . " is not existing!!!";
				}
				$idUserExist = false;
			}

			$bdd=null;
			return $this->updateUser;
		}

		//-----------------------------------------------------------------------

		private $deleteUser = false;
		public function deleteUser(int $id_user):bool{
			
			$idUserExist = false;

			for($i=0; $i<3; $i++){
				
				if ($i === 0){

					if(self::checkIdUser($id_user, 'mycv')){
						$bdd = DbConnect::dbConnect(new DbConnect());
						$idUserExist = true;
					}else{
						$_SESSION['other']['error'] = true;
						$_SESSION['other']['message'] = "The user with id " . $id_user . " is not existing!!!";
					}

				}elseif ($i === 1){

					if(self::checkIdUser($id_user, 'goldorak')){
						$bdd = DbConnect::dbConnectGoldorak(new DbConnect());
						$idUserExist = true;
					}else{
						$_SESSION['other']['error'] = true;
						$_SESSION['other']['message'] = "The user with id " . $id_user . " is not existing!!!";
					}

				}elseif ($i === 2){
					if(self::checkIdUser($id_user, 'garage_parrot')){
						$bdd = DbConnect::dbConnectGP(new DbConnect());
						$idUserExist = true;
					}else{
						$_SESSION['other']['error'] = true;
						$_SESSION['other']['message'] = "The user with id " . $id_user . " is not existing!!!";
					}
				}
			
				if($idUserExist){
			
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
				}

			}

			$bdd=null;
			return $this->deleteUser;
		}

		//-----------------------------------------------------------------------
		//----------------------------- CHECK VALUE -----------------------------
		//-----------------------------------------------------------------------
		
		private static $checkUserConnect = array();
        public static function checkUserConnect(string $email, string $pw):array{

			$bdd = DbConnect::DbConnect(new DbConnect());

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

                self::$checkUserConnect = $stmt->fetch(PDO::FETCH_ASSOC);

                $_SESSION['other']['error'] = false;
                $_SESSION['other']['message'] = "Utilisateur trouvé";

            }catch(PDOException $e){
                $_SESSION['other']['error'] = true;
                $_SESSION['other']['message'] = "Erreur de la requête : " . $e->getMessage();
            }

			$bdd=null;
			return self::$checkUserConnect;
        }
		
		private static $checkIdUser = false;
		public static function checkIdUser(int $id_user, string $bd = 'mycv'):bool{
			
			if($bd === 'goldorak'){
				$bdd = DbConnect::dbConnectGoldorak(new DbConnect());
			}elseif($bd === 'garage_parrot'){
				$bdd = DbConnect::DbConnectGP(new DbConnect());
			}else{
				$bdd = DbConnect::DbConnect(new DbConnect());
			}
			
			try{
				$stmt = $bdd->prepare("SELECT COUNT(*) FROM `user` WHERE `id_user` = :id_user");
				$stmt->bindParam(':id_user', $id_user, PDO::PARAM_STR);

				$stmt->execute();

				$result = $stmt->fetchColumn();

				if($result > 0){
					self::$checkIdUser = true;
					$_SESSION['other']['message'] = "This id_user is existent!!!";
				}else{
					$_SESSION['other']['message'] = "This id_user is not existent!!!";
				}

				$_SESSION['other']['error'] = false;

			}catch(PDOException $e){
				$_SESSION['other']['error'] = true;
				$_SESSION['other']['message'] = "Error to function checkIdUser() in user.class.php:" . $e->getMessage();
			}

			$bdd=null;
			return self::$checkIdUser;
		}

		//-----------------------------------------------------------------------
		
		private static $checkPseudo = false;
		public static function checkPseudo(string $pseudo, string $bd = 'mycv'):bool{
			
			if($bd === 'goldorak'){
				$bdd = DbConnect::dbConnectGoldorak(new DbConnect());
			}elseif($bd === 'garage_parrot'){
				$bdd = DbConnect::DbConnectGP(new DbConnect());
			}else{
				$bdd = DbConnect::DbConnect(new DbConnect());
			}
			
			try{
				$stmt = $bdd->prepare("SELECT COUNT(*) FROM `user` WHERE `pseudo` = :pseudo");
				$stmt->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);

				$stmt->execute();

				$result = $stmt->fetchColumn();

				if($result > 0){
					self::$checkPseudo = true;
					$_SESSION['other']['message'] = "This pseudo is existent!!!";
				}else{
					$_SESSION['other']['message'] = "This pseudo is not existent!!!";
				}

				$_SESSION['other']['error'] = false;

			}catch(PDOException $e){
				$_SESSION['other']['error'] = true;
				$_SESSION['other']['message'] = "Error to function checkPseudo() in user.class.php:" . $e->getMessage();
			}

			$bdd=null;
			return self::$checkPseudo;
		}

		//-----------------------------------------------------------------------
		
		private static $checkEmail = false;
		public static function checkEmail(string $email, string $bd = 'mycv'):bool{
			
			if($bd === 'goldorak'){
				$bdd = DbConnect::dbConnectGoldorak(new DbConnect());
			}elseif($bd === 'garage_parrot'){
				$bdd = DbConnect::DbConnectGP(new DbConnect());
			}else{
				$bdd = DbConnect::DbConnect(new DbConnect());
			}
			
			try{
				$stmt = $bdd->prepare("SELECT COUNT(*) FROM `user` WHERE `email` = :email");
				$stmt->bindParam(':email', $email, PDO::PARAM_STR);

				$stmt->execute();

				$result = $stmt->fetchColumn();

				if($result > 0){
					self::$checkEmail = true;
					$_SESSION['other']['message'] = "This email is existent!!!";
				}else{
					$_SESSION['other']['message'] = "This email is not existent!!!";
				}

				$_SESSION['other']['error'] = false;

			}catch(PDOException $e){
				$_SESSION['other']['message'] = "Error to function checkEmail() in user.class.php:" . $e->getMessage();
			}

			$bdd=null;
			return self::$checkEmail;
		}

		//-----------------------------------------------------------------------
		
        private static $pwConnect = "";
        public static function checkPassword(string $email):string{

			$bdd = DbConnect::DbConnect(new DbConnect());

            try{
                $stmt = $bdd->prepare("SELECT `password`
                                        FROM `user`
                                        WHERE `email` = :email");
            
                $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            
                $stmt->execute();

                self::$pwConnect = $stmt->fetchColumn();

                $_SESSION['other']['error'] = false;
                $_SESSION['other']['message'] = "Mot de passe trouvé";

            }catch (PDOException $e){
                $_SESSION['other']['error'] = true;
                $_SESSION['other']['message'] = "Erreur de la requete : " . $e->getMessage();
            }

			$bdd=null;
			return self::$pwConnect;
        }

		//-----------------------------------------------------------------------
		
		private static  $checkNbOfProduct = 0;
		public static function checkNbOfProduct(string $whereClause):int{

			$bdd = DbConnect::DbConnect(new DbConnect());
			
			try{
				$stmt = $bdd->prepare("SELECT COUNT(*) FROM `user` WHERE $whereClause ");
				$stmt->execute();
				
				self::$checkNbOfProduct = $stmt->fetchColumn();

				$_SESSION['other']['error'] = false;
				$_SESSION['other']['message'] = "The query is executed correctly!!!";

			}catch(PDOException $e){
				$_SESSION['other']['error'] = true;
				$_SESSION['other']['message'] = "Error to function checkNbOfProduct() in user.class.php:" . $e->getMessage();
			}

			$bdd=null;
			return self::$checkNbOfProduct;
		}
	}
?>