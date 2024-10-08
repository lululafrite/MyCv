<?php
	//subscription.class.php
	//author : Ludovic FOLLACO
	//checked to 2024-10-04_15:54
	namespace Model\User;

    require_once('../model/common/dbConnect.class.php');

	use PDO;
	use \PDOException;
	use Model\DbConnect\DbConnect;

	class Subscription
	{
		private $id_subscription;
		public function getIdSubscription():int{
			return $this->id_subscription;
		}
		public function setIdSubscription(int $new):void{
			$this->id_subscription = $new;
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

		private $theSubscription = array();
		public function getTheSubscription(int $id_subscription):array{

			$bdd = DbConnect::DbConnect(new DbConnect());
			
			try{
			    $stmt = $bdd->prepare("SELECT `subscription`.`id_subscription`,
											  `subscription`.`subscription`
										FROM `subscription`
										WHERE `subscription`.`id_subscription` = :id_subscription");

				$stmt->bindParam(':id_subscription', $id_subscription, PDO::PARAM_INT);
				$stmt->execute();

				$this->theSubscription = $stmt->fetch(PDO::FETCH_ASSOC);

				$_SESSION['other']['error'] = false;
				$_SESSION['other']['message'] = "Subscription is found!!!";

			}catch (PDOException $e){
				$_SESSION['other']['error'] = true;
				$_SESSION['other']['message'] = "Subscription is not found!!!" . $e->GetMessage();
			}

			$bdd=null;
			return $this->theSubscription;
		}

		//-----------------------------------------------------------------------

		private $subscriptionList = array();
		public function getSubscriptionList(string $whereClause, string $orderBy = 'subscription', string $ascOrDesc = 'ASC', int $firstLine = 0, int $linePerPage = 50):array{

			$bdd = DbConnect::DbConnect(new DbConnect());
			
			try{
			    $stmt = $bdd->prepare("SELECT `subscription`.`id_subscription`,
											  `subscription`.`subscription`
										FROM`subscription`
										WHERE $whereClause
										ORDER BY :orderBy :ascOrDesc
										LIMIT :firstLine, :linePerPage");

				$stmt->bindParam(':orderBy', $orderBy, PDO::PARAM_STR);
				$stmt->bindParam(':ascOrDesc', $ascOrDesc, PDO::PARAM_STR);
				$stmt->bindParam(':firstLine', $firstLine, PDO::PARAM_INT);
				$stmt->bindParam(':linePerPage', $linePerPage, PDO::PARAM_INT);

				$stmt->execute();

				$this->subscriptionList = $stmt->fetchall(PDO::FETCH_ASSOC);

				$_SESSION['other']['error'] = false;
				$_SESSION['other']['message'] = "Subscription list is found!!!";

			}catch (PDOException $e){
				$_SESSION['other']['error'] = true;
				$_SESSION['other']['message'] = "Subscription list is not found!!!" . $e->GetMessage();
			}

			$bdd=null;
			return $this->subscriptionList;
		}

		//-----------------------------------------------------------------------
		private $insertSubscription = 0;
		public function insertSubscription():int{
			
			$bdd = DbConnect::DbConnect(new DbConnect());

			try{
				$stmt = $bdd->prepare('INSERT INTO `subscription`(`subscription`) VALUES (:subscription)');
				$stmt->bindParam(':subscription', $this->subscription, PDO::PARAM_STR);
				$stmt->execute();

				$stmt = $bdd->prepare('SELECT MAX(`id_subscription`) FROM `subscription`');
				$stmt->execute();

				$this->insertSubscription = intval($stmt->fetchColumn());

				$_SESSION['other']['error'] = false;
				$_SESSION['other']['message'] = "Subscription is inserted!!!";

			}catch(PDOException $e){
				$_SESSION['other']['error'] = true;
				$_SESSION['other']['message'] = "Subscription is not inserted!!!" . $e->GetMessage();
			}

			$bdd=null;
			return $this->insertSubscription;
		}

		//-----------------------------------------------------------------------

		private $updateSubscription = false;
		public function updateUserSubscription(int $id_subscription):bool{

			$bdd = DbConnect::DbConnect(new DbConnect());

			try{
				$stmt = $bdd->prepare('UPDATE `subscription`
										SET `subscription` = :subscription
										WHERE `id_subscription` = :id_subscription');

				$stmt->bindParam(':subscription', $this->subscription, PDO::PARAM_STR);
				$stmt->bindParam(':id_subscription', $id_subscription, PDO::PARAM_INT);

				$stmt->execute();

				$_SESSION['other']['error'] = false;
				$_SESSION['other']['message'] = "Subscription is updated!!!";

				$this->updateSubscription = true;
			
			}catch (PDOException $e){
				$_SESSION['other']['error'] = true;
				$_SESSION['other']['message'] = "Subscription is not updated!!!" . $e->GetMessage();
			}

			$bdd=null;
			return $this->updateSubscription;
		}

		//-----------------------------------------------------------------------
		private $deleteSubscription = false;
		public function deleteUsersubscription(int $id_subscription):bool{
			
			$bdd = DbConnect::DbConnect(new DbConnect());

			try{
			    $stmt = $bdd->prepare('DELETE FROM subscription WHERE id_subscription = :id_subscription');
				$stmt->bindParam(':id_subscription', $id_subscription, PDO::PARAM_INT);
				$stmt->execute();

				$_SESSION['other']['error'] = false;
				$_SESSION['other']['message'] = "This subscription is deleted!";

				$this->deleteSubscription = true;
			
			}catch (PDOException $e){
				$_SESSION['other']['error'] = true;
				$_SESSION['other']['message'] = "This subscription is not deleted!" . $e->GetMessage();
			}

			$bdd=null;
			return $this->deleteSubscription;
		}
	}
?>