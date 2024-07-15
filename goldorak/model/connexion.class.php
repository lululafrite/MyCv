<?php
	class UserConnect
    {
        private $dataConnect;
        public function getPw($email){

			include_once('../../controller/ConfigConnGP.php');
			$conn = connectDB();
            date_default_timezone_set($_SESSION['timeZone']);

            try {
                    $stmt = $conn->prepare("SELECT `password`
                                            FROM `user`
                                            WHERE `email` = :email");
                
                    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                
                    $stmt->execute();

                    $this->dataConnect = $stmt->fetch();
                    return $this->dataConnect;

            } catch (PDOException $e) {
                
                echo "Error in the query: " . $e->getMessage();
                $MyUserConnect->SetConnexion(false);

            }

        }
        public function queryConnect($email,$pw){

			include_once('../../controller/ConfigConnGP.php');
			$conn = connectDB();
            date_default_timezone_set($_SESSION['timeZone']);

            try {
                    $stmt = $conn->prepare("SELECT `pseudo`,
                                                    `avatar`,
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

                    $this->dataConnect = $stmt->fetch();
                    return $this->dataConnect;

                } catch (PDOException $e) {
                    
                    echo "Error in the query: " . $e->getMessage();
                    $MyUserConnect->SetConnexion(false);

                }
        }
    }
?>