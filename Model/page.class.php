<?php

    namespace MyCv\Model;

    $current_url = $_SERVER['REQUEST_URI'];
    $goldorak = '/goldorak/';
    $garageParrot = '/garageparrot/';

    if(preg_match($goldorak, $current_url) || preg_match($garageParrot, $current_url)){
        require_once('../../model/dbConnect.class.php');

    }else{
        require_once('../model/dbConnect.class.php');
    }

    use \PDO;
    use \PDOException;

	class Page
    {        
        // __Nombre de ligne__________________________________________

        public function getNbOfLine()
        {
            if(is_null($_SESSION['nbOfLine']))
            {
                $_SESSION['nbOfLine']=1;
            }
            return $_SESSION['nbOfLine'];
        }
        public function setNbOfLine($new)
        {
            $_SESSION['nbOfLine']=$new;
        }
        
        // __Première ligne de la page active__________________________________________
        
        public function getFirstLine()
        {
            if(is_null($_SESSION['pagination']['firstLine']))
            {
                $_SESSION['pagination']['firstLine']=0;
            }
            return $_SESSION['pagination']['firstLine'];
        }
        public function setFirstLine($newFirstLine)
        {
            $_SESSION['pagination']['firstLine']=$newFirstLine;
            if ($_SESSION['pagination']['firstLine'] < 0){
                $_SESSION['pagination']['firstLine'] = 0;
            }
        }
        
        // __Nombre de ligne par page__________________________________________
        
        private $nbLinePerPage;
        public function getNbDeLigneParPage()
        {
            if (is_null($_SESSION['pagination']['productPerPage']))
            {
                $_SESSION['pagination']['productPerPage']=2;
                $this->nbLinePerPage =2;
            }
            return $this->nbLinePerPage;
        }
        public function setNbDeLigneParPage($new)
        {
            $this->nbLinePerPage=$new;
            $_SESSION['pagination']['productPerPage']=$new;
        }
        
        // __La page active__________________________________________
        
        public function getLaPage()
        {
            if (is_null($_SESSION['pagination']['thePage'])) {
                $_SESSION['pagination']['thePage'] = 1;
            }
            return $_SESSION['pagination']['thePage'];
        }
        public function setLaPage($new)
        {
            $_SESSION['pagination']['thePage'] = $new; //$this->thePage;
            if ($_SESSION['pagination']['thePage'] <= 0){
                $_SESSION['pagination']['thePage'] = 1;
            }
        }
        
        public function getnbOfPage()
        {
            if(is_null($_SESSION['pagination']['nbOfPage']))
            {
                $_SESSION['pagination']['nbOfPage']=1;
            }
            return $_SESSION['pagination']['nbOfPage'];
        }
        public function SetnbOfPage($nbOfPage)
        {
            if ($nbOfPage===0){
                $nbOfPage=1;
            }
            $_SESSION['pagination']['nbOfPage']=$nbOfPage;
        }

        private $countLine;
		public function getCountLine()
		{
			$this->countLine;
			return $this->countLine;
		}
		public function setCountLine($theTable)
		{
			$myDbConnect = new dbConnect();
			$bdd = $myDbConnect->connectionDb();
            unset($myDbConnect);

			try
			{
                if(empty($_SESSION['whereClause'])){
                    $this->countLine = $bdd->query('SELECT count(*) FROM ' . $theTable)->fetchColumn();
                }else{
                    $this->countLine = $bdd->query("SELECT count(*) FROM `" . $theTable . "` WHERE " . $_SESSION['whereClause'])->fetchColumn();
                }
			}
			catch (PDOException $e)
			{
				echo "Erreur de la requete :" . $e->GetMessage();
			}

			$bdd=null;
		}
    }

?>