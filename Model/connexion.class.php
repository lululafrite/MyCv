<?php

    namespace MyCv\Model;

//******************************************************************************** */

    $current_url = $_SERVER['REQUEST_URI'];
    $goldorak = '/goldorak/';
    $garageParrot = '/garageparrot/';

    if(preg_match($goldorak, $current_url) || preg_match($garageParrot, $current_url)){
        
        require_once('../../model/connexion.class.php');
        require_once('../../common/utilies.php');
        require_once('../../model/dbConnect.class.php');

    }else{

        require_once('../model/connexion.class.php');
        require_once('../common/utilies.php');
        require_once('../model/dbConnect.class.php');

    }
    
	use \PDO;
	use \PDOException;
	use MyCv\Model\dbConnect;

//************************* CLASS USERCONNECT ************************************ */

	class UserConnect
    {
        private $pwConnect = array();
        public function getCheckPw(string $email):array{

			$myDbConnect = new dbConnect();
			$bdd = $myDbConnect->connectionDb();
            unset($myDbConnect);

            date_default_timezone_set($_SESSION['timeZone']);

            try{
                $stmt = $bdd->prepare("SELECT `password`
                                        FROM `user`
                                        WHERE `email` = :email");
            
                $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            
                $stmt->execute();

                $bdd=null;

                $this->pwConnect = $stmt->fetch(PDO::FETCH_ASSOC);
                $this->pwConnect['error'] = false;
                $this->pwConnect['message'] = "Mot de passe trouvé";
                
                return $this->pwConnect;

            }catch (PDOException $e){
                $bdd=null;

                $this->pwConnect['error'] = true;
                $this->pwConnect['message'] = "Erreur de la requete : " . $e->getMessage();

                return $this->pwConnect;
            }
        }

        private $dataConnect = array();
        public function dataConnect($email, $pw):array{

			$myDbConnect = new dbConnect();
			$bdd = $myDbConnect->connectionDb();
            unset($myDbConnect);

            date_default_timezone_set($_SESSION['timeZone']);

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

                $this->dataConnect = $stmt->fetch(PDO::FETCH_ASSOC);
                $this->dataConnect['error'] = false;
                $this->dataConnect['message'] = "Utilisateur trouvé";

                return $this->dataConnect;

            }catch(PDOException $e){
                $bdd=null;

                $this->dataConnect['error'] = true;
                $this->dataConnect['message'] = "Erreur de la requête : " . $e->getMessage();
                
                return $this->dataConnect;
            }
        }
    }
?>