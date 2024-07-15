<?php

	class Subscription
	{
		private $id_subscription;
		public function getIdSubscription()
		{
			return $this->id_subscription;
		}
		public function setIdSubscription($new)
		{
			$this->id_subscription = $new;
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

		//-----------------------------------------------------------------------

		private $theSubscription;
		public function getSubscription_($îdSubscription)
		{
			include_once('../../goldorak/model/dbConnect.class.php');
			$dbConnect_ = new dbConnect_();
			$bdd = $dbConnect_->connectionDb();
            unset($dbConnect_);

            date_default_timezone_set($_SESSION['timeZone']);
			
			try
			{
			    $sql = $bdd->query("SELECT
										`subscription`.`id_subscription`,
										`subscription`.`subscription`

									FROM `subscription`
									
									WHERE `subscription`.`id_subscription`=$îdSubscription
								");

				$this->theSubscription[] = $sql->fetch();
				return $this->theSubscription;
			}
			catch (Exception $e)
			{
				echo "Erreur de la requete :" . $e->GetMessage();
			}

			$bdd=null;
		}

		//-----------------------------------------------------------------------

		private $userSubscriptionList;
		public function get($whereClause, $orderBy = 'subscription', $ascOrDesc = 'ASC', $firstLine = 0, $linePerPage = 13)
		{
			include_once('../../goldorak/model/dbConnect_.class.php');
			$dbConnect_ = new dbConnect_();
			$bdd = $dbConnect_->connectionDb();
            unset($dbConnect_);
			
			try
			{
			    $sql = $bdd->query("SELECT
										`subscription`.`id_subscription`,
										`subscription`.`subscription`
									FROM
										`subscription`
									WHERE $whereClause
									ORDER BY $orderBy $ascOrDesc
									LIMIT $firstLine, $linePerPage
								");

				while ($this->userSubscriptionList[] = $sql->fetch());
				return $this->userSubscriptionList;
			}
			catch (Exception $e)
			{
				echo "Erreur de la requete :" . $e->GetMessage();
			}

			$bdd=null;
		}

		//-----------------------------------------------------------------------

		public function addUserSubscription()
		{
			include_once('../../goldorak/model/dbConnect_.class.php');
			$dbConnect_ = new dbConnect_();
			$bdd = $dbConnect_->connectionDb();
            unset($dbConnect_);

			try{
				$bdd->exec("INSERT INTO `subscription`(`subscription`)
							VALUES('" . $this->subscription . "')");

				$sql = $bdd->query("SELECT MAX(`id_subscription`) FROM `subscription`");
				$id_subscription = $sql->fetch();
				$this->id_subscription = intval($id_subscription['id_subscription']);

				echo '<script>alert("L\'enregistrement est effectué!");</script>';

			} catch (Exception $e) {
				
				echo "Erreur de la requête : " . $e->getMessage();

			}

			$bdd=null;
		}

		//-----------------------------------------------------------------------

		public function updateUserSubscription($idSubscription)
		{
			include_once('../../goldorak/model/dbConnect_.class.php');
			$dbConnect_ = new dbConnect_();
			$bdd = $dbConnect_->connectionDb();
            unset($dbConnect_);

			try
			{
				$bdd->exec("UPDATE `subscription` SET `subscription` = '" . $this->subscription . "'
							WHERE `id_subscription` = " . intval($idSubscription) . "
							");
				
				echo '<script>alert("Les modifications sont enregistrées!");</script>';
			}
			catch (Exception $e)
			{
				echo "Erreur de la requete :" . $e->GetMessage();
			}

			$bdd=null;
		}

		//-----------------------------------------------------------------------

		public function deleteUsersubscription($id)
		{
			include_once('../../goldorak/model/dbConnect_.class.php');
			$dbConnect_ = new dbConnect_();
			$bdd = $dbConnect_->connectionDb();
            unset($dbConnect_);

			try
			{
			    $bdd->exec('DELETE FROM subscription WHERE id_subscription=' . $id);
				echo '<script>alert("Cet enregistrement est supprimé!");</script>';
			}
			catch (Exception $e)
			{
				echo "Erreur de la requete :" . $e->GetMessage();
			}

			$bdd=null;
		}

	}
	
?>