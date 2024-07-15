<?php

	class Page
    {
        
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
            if(is_null($_SESSION['firstLine']))
            {
                $_SESSION['firstLine']=0;
            }
            return $_SESSION['firstLine'];
        }
        public function setFirstLine($newFirstLine)
        {
            $_SESSION['firstLine']=$newFirstLine;
            if ($_SESSION['firstLine'] < 0){
                $_SESSION['firstLine'] = 0;
            }
        }
        
        // __Nombre de ligne par page__________________________________________
        
        private $nbLinePerPage;
        public function getNbDeLigneParPage()
        {
            if (is_null($_SESSION['ligneParPage']))
            {
                $_SESSION['ligneParPage']=2;
                $this->nbLinePerPage =2;
            }
            return $this->nbLinePerPage;
        }
        public function setNbDeLigneParPage($new)
        {
            $this->nbLinePerPage=$new;
            $_SESSION['ligneParPage']=$new;
        }
        
        // __La page active__________________________________________
        
        public function getLaPage()
        {
            if (is_null($_SESSION['laPage'])) {
                $_SESSION['laPage'] = 1;
            }
            return $_SESSION['laPage'];
        }
        public function setLaPage($new)
        {
            $_SESSION['laPage'] = $new; //$this->thePage;
            if ($_SESSION['laPage'] <= 0){
                $_SESSION['laPage'] = 1;
            }
        }
        
        public function getnbOfPage()
        {
            if(is_null($_SESSION['nbOfPage']))
            {
                $_SESSION['nbOfPage']=1;
            }
            return $_SESSION['nbOfPage'];
        }
        public function SetnbOfPage($nbOfPage)
        {
            if ($nbOfPage===0){
                $nbOfPage=1;
            }
            $_SESSION['nbOfPage']=$nbOfPage;
        }

        private $countLine;
		public function getCountLine()
		{
			$this->countLine;
			return $this->countLine;
		}
		public function setCountLine($theTable)
		{
			include_once('../../controller/ConfigConnGP.php');
			$conn = connectDB();
            date_default_timezone_set($_SESSION['timeZone']);

			try
			{
                if(empty($_SESSION['whereClause'])){
                    $this->countLine = $conn->query('SELECT count(*) FROM ' . $theTable)->fetchColumn();
                }else{
                    $this->countLine = $conn->query("SELECT count(*) FROM `" . $theTable . "` WHERE " . $_SESSION['whereClause'])->fetchColumn();
                }
			}
			catch (PDOException $e)
			{
				echo '<script>alert("Erreur de la requête : ' . $e->getMessage() . '");</script>';
			}

			$conn=null;
		}
    }

?>