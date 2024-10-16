<?php
    //page.class.php
	//author : Ludovic FOLLACO
    //checked to 2024-10-04_15:49
    namespace Model\Page;

    use \PDO;
	use \PDOException;
	use Model\DbConnect\DbConnect;
    use function PHPUnit\Framework\isNull;

	class Page
    {
        // __Nombre de ligne__________________________________________

        private $nbOfProduct = 1;
        public function getNbOfProduct():int{
            return $this->nbOfProduct;
        }
        public function setNbOfProduct(int $new):void{
            $this->nbOfProduct = $new;
        }
        
        // __Première ligne de la page active__________________________________________
        
        private $firstLine = 0;
        public function getFirstProduct():int{
            return $this->firstLine;
        }
        public function setFirstProduct(int $new):void{
            $this->firstLine = $new;
        }
        
        // __Nombre de ligne par page__________________________________________
        
        private $nbProductPerPage = 3;
        public function getProductPerPage():int{
            return $this->nbProductPerPage;
        }
        public function setProductPerPage(int $new):void{
            $this->nbProductPerPage = $new;
        }
        
        // __La page active__________________________________________

        private $thePage = 1;
        public function getThePage():int{
            return $this->thePage;
        }
        public function setThePage(int $new):void{
            $this->thePage = $new;
        }
        
        // __Nombre de page__________________________________________

        private $nbOfPage = 1;
        public function getNbOfPage():int{
            return $this->nbOfPage;
        }
        public function setNbOfPage(int $new):void{
            $this->nbOfPage = $new;
        }

        // __Page suivante ou précédente__________________________________________

        private $nextOrPrevious = 1;
		public function getNextOrPrevious():bool{
			return $this->nextOrPrevious;
		}
		public function setNextOrPrevious(bool $new):void{
            $this->nextOrPrevious = $new;
		}

        // __Nombre de produit__________________________________________

        private static $checkNumberOfProduct = 0;
		public static function checkNumberOfProduct(string $table , string $whereClause = null):int{
			
            $bdd = DbConnect::DbConnect(new DbConnect());

			try{
                if(isNull($whereClause)){
                    
                    $stmt = $bdd->prepare('SELECT count(*) FROM ' . $table);
                    $stmt->execute();
                    self::$checkNumberOfProduct = $stmt->fetchColumn();

                }else{
                    $stmt = $bdd->prepare('SELECT count(*) FROM ' . $table . ' WHERE ' . $whereClause);
                    $stmt->execute();
                    self::$checkNumberOfProduct = $stmt->fetchColumn();
                }

                $_SESSION['other']['error'] = false;
                $_SESSION['other']['message'] = "Nombre de produit trouvé";

			}catch (PDOException $e){
                $_SESSION['other']['error'] = true;
                $_SESSION['other']['message'] = "Erreur de la requete : " . $e->getMessage();
			}

			$bdd=null;
            return self::$checkNumberOfProduct;
		}

        //-----------------------------------------------------------------------------------
        
        public static function FctNbPage(int $productPerPage, object $MyPage, string $table):void{
    
            $MyPage->setNbOfProduct(self::checkNumberOfProduct($table));
    
            $totalLigne = $MyPage->getNbOfProduct();
            
            if ($totalLigne < $productPerPage){
                $nbOfPage = 1;
                $MyPage->setThePage(1);            
            }else{
                $nbOfPage = ceil($totalLigne / $productPerPage);
                if ($nbOfPage < $MyPage->getThePage()){
                    $MyPage->setThePage(1);
                }
            }
            $MyPage->setNbOfPage($nbOfPage);
        }
    }
?>