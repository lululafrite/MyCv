<?php

    namespace MyCv\Model;
    
    use Firebase\JWT\JWT;
    use \PDO;
    use \PDOException;

    class Utilities {

        // Creating of JWT token
        public static function tokenJwt(string $pseudo, string $key, int $delay = 3600): string {
            $tokenJwt = [
                'pseudo' => $pseudo,
                'delay' => time() + $delay,
                'key' => $key
            ];

            return JWT::jsonEncode($tokenJwt);
        }

        // Create and verification of CSRF token
        public static function verifCsrf(string $varCsrf): bool {
            
            $value_Is = false; settype($value_Is, "boolean");

            if(isset($_POST[$varCsrf]) && $_POST[$varCsrf] === $_SESSION['token']['csrf']){
                $value_Is = true;
            }

            if(empty($_SESSION['token']['csrf'])){
                $_SESSION[$varCsrf] = generate32ByteKey();
            }
            return $value_Is;
        }

        // Generate key 32 bytes
        public static function generate32ByteKey(): string {
            return bin2hex(random_bytes(32));
        }

        // Escape Input
        public static function escapeInput($input): string {
            return htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
        }

        public static function filterInput($input, $method = INPUT_POST): string {
            return filter_input($method, $input, FILTER_DEFAULT);
        }

        // Upload image
        public static function uploadImg(string $session, string $post, string $file, string $directory = "./img/vehicle/") {
            $_SESSION[$session] = isset($_POST[$post]) ? self::escapeInput($_POST[$post]) : false;
            $fileError = isset($_FILES[$file]) ? $_FILES[$file]["error"] : UPLOAD_ERR_NO_FILE;

            if ($fileError == UPLOAD_ERR_OK) {
                $fileName = self::escapeInput($_FILES[$file]["name"]);
                $sourceFile = $_FILES[$file]["tmp_name"];
                $destinationFile = $directory . basename($fileName);
            
                if (move_uploaded_file($sourceFile, $destinationFile)) {
                    $_SESSION[$session] = $fileName;
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

        public static function checkValueInUrl(string $value): bool {
            $current_url = $_SERVER['REQUEST_URI'];
            $regEx = "/" . $value . "/";
            return preg_match($regEx, $current_url);
        }

        public static function checkAndReturnValueInUrl(): string {
            if (self::checkValueInUrl('goldorak')) {
                return "goldorak";
            } else if (self::checkValueInUrl('garageparrot')) {
                return "garageparrot";
            }
            return "MyCv";
        }

        public static function verifIfLocal(): bool {
            return isset($_SESSION['other']['local']) ? (bool)$_SESSION['other']['local'] : false;
        }

        // Road to page        
        private static function redirectToPage_(string $page):void{
            $baseUrl = self::verifIfLocal() ? "http://mycv" : "https://www.follaco.fr";
            $siteName = self::checkAndReturnValueInUrl();
            $url = '<script>window.location.href = "' . $baseUrl . ($siteName === 'MyCv' ? '' : '/' . $siteName) . '/index.php?page=' . $page . '";</script>';
            echo $url;
            die();
        }

        // Road to page        
        public static function redirectToPage(string $page):void{
            $baseUrl = self::verifIfLocal() ? "http://mycv" : "https://www.follaco.fr";
            $siteName = self::checkAndReturnValueInUrl();
            $url = '<script>window.location.href = "' . $baseUrl . ($siteName === 'MyCv' ? '' : '/' . $siteName) . '/index.php?page=' . $page . '";</script>';
            echo $url;
            die();
        }

        /*private static function redirectToPage(string $page, string $subdir = ""): void {
            $baseUrl = self::verifIfLocal() ? "http://mycv" : "https://www.follaco.fr";
            $subdir = $subdir ?: self::checkAndReturnValueInUrl();
            $url = $baseUrl . ($subdir === "MyCv" ? "" : "/$subdir") . "/index.php?page=$page";
            echo "<script>window.location.href = '$url';</script>";
            die();
        }*/

        		// Check if id is existing
		public static function checkData(string $table, string $columnId, int $id):bool{
			
			$bdd = dbConnect::dbConnect(new dbConnect());

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