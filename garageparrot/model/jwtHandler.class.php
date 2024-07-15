<?php
    include_once('../../garageparrot/common/.env');

    use Firebase\JWT\JWT;
    use Firebase\JWT\Key;

    class JWTHandler {
        
        private $secretKey;

        public function __construct() {
            $this->secretKey = $_ENV['JWT_SECRET'];
        }

        public function generateToken($payload) {
            $issuedAt = time();
            $expirationTime = $issuedAt + 3600; // jwt valid for 1 hour from the issued time
            $payload['iat'] = $issuedAt;
            $payload['exp'] = $expirationTime;

            return JWT::encode($payload, $this->secretKey, 'HS256');
        }

        public function validateToken($token) {
            try {
                $decoded = JWT::decode($token, new Key($this->secretKey, 'HS256'));
                return (array) $decoded;
            } catch (PDOException $e) {
                return false;
            }
        }
    }

?>

<?php

    // Exemple d'utilisation
/*
    $jwtHandler = new JWTHandler();
    $token = $jwtHandler->generateToken(['user_id' => 123]);
    echo "Token: " . $token . "\n";

    $decoded = $jwtHandler->validateToken($token);
    if ($decoded) {
        echo "Token is valid. Payload: " . json_encode($decoded) . "\n";
    } else {
        echo "Token is invalid.\n";
    }
*/

?>
