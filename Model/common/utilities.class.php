<?php
    //utilities.class.php
    //author: Ludovic FOLLACO
    //checked to 2024-10-04_16:06
    namespace Model\Utilities;
    
    use \PDO;
    use \PDOException;
    use Model\DbConnect\DbConnect;
    use Firebase\JWT\JWT;

    class Utilities {

        // Creating of JWT token
        public static function tokenJwt(string $pseudo, string $key, int $delay = 3600):string{
            $tokenJwt = [
                'pseudo' => $pseudo,
                'delay' => time() + $delay,
                'key' => $key
            ];

            return JWT::jsonEncode($tokenJwt);
        }

        // Create and verification of CSRF token
        public static function ckeckCsrf():bool{

            if(isset($_POST['csrf']) && $_POST['csrf'] != $_SESSION['token']['csrf']){

                $_SESSION['other']['message'] = 'Error checking CSRF token!';
                return false;
            }
            $_SESSION['token']['csrf'] = bin2hex(random_bytes(32));
            return true;
        }

        // Escape Input
        public static function escapeInput($input):string{
            return htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
        }

        // Filter Input
        public static function filterInput($input, $method = INPUT_POST):string{
            return filter_input($method, $input, FILTER_DEFAULT);
        }

        // Upload image
        public static function uploadImg(string $session1, string $session2, string $post, string $file, string $directory){
            
            $_SESSION[$session1][$session2] = isset($_POST[$post]) ? self::escapeInput($_POST[$post]) : false;
            $fileError = isset($_FILES[$file]) ? $_FILES[$file]["error"] : UPLOAD_ERR_NO_FILE;

            if ($fileError == UPLOAD_ERR_OK) {
                $fileName = self::escapeInput($_FILES[$file]["name"]);
                $sourceFile = $_FILES[$file]["tmp_name"];
                $destinationFile = $directory . basename($fileName);
            
                if (move_uploaded_file($sourceFile, $destinationFile)) {
                    $_SESSION[$session1][$session2] = $fileName;
                    return true;
                } else {
                    echo("<script>alert('Erreur lors de l\'upload de l\'image');</script>");
                    return false;
                }
            } else {
                echo("<script>alert('Aucune image n\'a été sélectionnée ou une erreur s\'est produite.');</script>");
                return [
                    'state' => false,
                    'message' => "pas d'image selectionnée"
                ];
            }
        }

        // Check if value is in url
        public static function checkValueInUrl(string $value):bool{
            $current_url = $_SERVER['REQUEST_URI'];
            $regEx = '/' . preg_quote($value, '/') . '/';
            return preg_match($regEx, $current_url);
        }

        // Check and return value in url
        public static function checkAndReturnValueInUrl():string{
            if(self::checkValueInUrl('goldorak')){
                return "goldorak";
            }elseif(self::checkValueInUrl('garageparrot')){
                return "garageparrot";
            }
            return "index";
        }

        // Check if local server
        public static function checkIfLocal():bool{
            return isset($_SESSION['other']['local']) ? boolval($_SESSION['other']['local']) : false;
        }

        // Road to page        
        public static function redirectToPage(string $page):void{
            $baseUrl = self::checkIfLocal() ? "http://mycv" : "https://www.follaco.fr";
            $siteName = self::checkAndReturnValueInUrl();
            $url = '<script>window.location.href = "' . $baseUrl . ($siteName === 'MyCv' ? '' : '/' . $siteName) . '.php?page=' . $page . '";</script>';
            echo $url;
            die();
        }

        // Check if id is existing
		public static function checkData(string $table, string $columnId, int $id):bool{
			
			$bdd = DbConnect::DbConnect(new DbConnect());

			$stmt = $bdd->prepare("SELECT COUNT(*) FROM $table WHERE $columnId = :id");
			$stmt->bindParam(':id', $id, PDO::PARAM_INT);
			$stmt->execute();

			$result = $stmt->fetchColumn();
			if($result > 0){
				$bdd=null;
				return true;
			}else{
				$bdd=null;
				return false;
			}
		}
    }
?>