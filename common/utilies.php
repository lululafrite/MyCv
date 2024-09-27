<?php

    // Creating of JWT token
    use Firebase\JWT\JWT;
    function tokenJwt(string $pseudo, string $key, int $delay = 3600):string{
        $tokenJwt = [
            'pseudo' => $pseudo,
            'delay' => time() + $delay,
            'key' => $key
        ];

        return JWT::jsonEncode($tokenJwt);
    }

    // Create and verification of CSRF token
    function verifCsrf(string $varCsrf):bool{
            
        $value_Is = false; settype($value_Is, "boolean");

        if(isset($_POST[$varCsrf]) && $_POST[$varCsrf] === $_SESSION['token']['csrf']){
            $value_Is = true;
        }

        if(empty($_SESSION['token']['csrf'])){
            $_SESSION[$varCsrf] = generate32ByteKey();
        }
        return $value_Is;
    }

    // Genered key 32 bytes
    function generate32ByteKey():string{

        $key = ""; settype($key, "string");
        $key = bin2hex(random_bytes(32));
        return $key;
    }

    //escape Input
    function escapeInput($input):string{
        return htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
    }

    function filterInput($input, $method = INPUT_POST):string{
        return filter_input($method, $input, FILTER_DEFAULT);
    }

    //upload image
    function uploadImg(string $session,string $post,string $file,string $directory = "./img/vehicle/"){
        
        $uploadDirectory = $directory; settype($uploadDirectory, "string");
        $result = ""; settype($result, "string");

        $_SESSION[$session] = isset($_POST[$post]) ? escapeInput($_POST[$post]) : false;

        $_SESSION[$session] = isset($_FILES[$file]) ? escapeInput($_FILES[$file]["error"]) : false;

        if ($_SESSION[$session] == UPLOAD_ERR_OK){

            $_SESSION[$session] = isset($_FILES[$file]) ? escapeInput($_FILES[$file]["name"]) : false;
            $sourceFile = isset($_FILES[$file]) ? escapeInput($_FILES[$file]["tmp_name"]) : false;
            $destinationFile = $uploadDirectory . basename($_SESSION[$session]);
            unset($_FILES[$file]);

        }else{

            echo("<script>alert('Aucune image n\'a été sélectionnée ou une erreur s\'est produite.');</script>");

            $message = "pas d'image selectionnée";
            $results = array();
            $results['state'] = false;
            $results['message'] = $message;
            return $results;
        }

        if(move_uploaded_file($sourceFile, $destinationFile)){
            
            $result = $_SESSION[$session];
            return true;

        }else{

            $result = "erreur lors de l'upload de l'image";
            echo("<script>alert('" . $result . "');</script>");
            return false;
        
        }

    }

    function checkValueInUrl(string $value):bool{

        $current_url = $_SERVER['REQUEST_URI'];
        $regEx = "/" . $value . "/";

        return preg_match($regEx, $current_url);
    }

    function checkAndReturnValueInUrl():string{

        $value = "MyCv"; settype($value, "string");

        if(checkValueInUrl('goldorak')){
            $value = "goldorak";
        }else if(checkValueInUrl('garageparrot')){
            $value = "garageparrot";
        }

        return $value;
    }

    function verifIfLocal():bool{

        $local = isset($_SESSION['other']['local']) ? $_SESSION['other']['local'] : false;
        settype($local, "boolean");

        return $local;
    }
    
    // Rerouted if the page is inaccessible for the current user
    function pageUnavailable():void{

        if(verifIfLocal()){

            if(checkAndReturnValueInUrl() === 'MyCv'){
                echo '<script>window.location.href = "http://mycv/index.php?page=error_page";</script>';
            }else{
                echo '<script>window.location.href = "http://mycv/' . checkAndReturnValueInUrl() . '/index.php?page=error_page";</script>';
            }
        }else{
            if(checkAndReturnValueInUrl() === 'MyCv'){
                echo '<script>window.location.href = "https://www.follaco.fr/index.php?page=error_page";</script>';
            }else{
                echo '<script>window.location.href = "https://www.follaco.fr/' . checkAndReturnValueInUrl() . '/index.php?page=error_page";</script>';
            }
        }
        die();
    }

    // Rerouted if page does not exist 
    function unknownPage():void{
        
        if(verifIfLocal()){

            if(checkAndReturnValueInUrl() === 'MyCv'){
                echo '<script>window.location.href = "http://mycv/index.php?page=unknownPage";</script>';
            }else{
                echo '<script>window.location.href = "http://mycv/' . checkAndReturnValueInUrl() . '/index.php?page=unknownPage";</script>';
            }
        }else{
            if(checkAndReturnValueInUrl() === 'MyCv'){
                echo '<script>window.location.href = "https://www.follaco.fr/index.php?page=unknownPage";</script>';
            }else{
                echo '<script>window.location.href = "https://www.follaco.fr/' . checkAndReturnValueInUrl() . '/index.php?page=unknownPage";</script>';
            }
        }
        die();
    }

    // Rerouted if page does not exist 
    function timeExpired():void{
        
        if(verifIfLocal()){

            if(checkAndReturnValueInUrl() === 'MyCv'){
                echo '<script>window.location.href = "http://mycv/index.php?page=timeExpired";</script>';
            }else{
                echo '<script>window.location.href = "http://mycv/' . checkAndReturnValueInUrl() . '/index.php?page=timeExpired";</script>';
            }
        }else{
            if(checkAndReturnValueInUrl() === 'MyCv'){
                echo '<script>window.location.href = "https://www.follaco.fr/index.php?page=timeExpired";</script>';
            }else{
                echo '<script>window.location.href = "https://www.follaco.fr/' . checkAndReturnValueInUrl() . '/index.php?page=timeExpired";</script>';
            }
        }
        die();
    }

    // Route to home page
    function roadToHomePage():void{

        if(verifIfLocal()){

            if(checkAndReturnValueInUrl() === 'MyCv'){
                echo '<script>window.location.href = "http://mycv/index.php?page=home";</script>';
            }else{
                echo '<script>window.location.href = "http://mycv/' . checkAndReturnValueInUrl() . '/index.php?page=home";</script>';
            }
        }else{
            if(checkAndReturnValueInUrl() === 'MyCv'){
                echo '<script>window.location.href = "https://www.follaco.fr/index.php?page=home";</script>';
            }else{
                echo '<script>window.location.href = "https://www.follaco.fr/' . checkAndReturnValueInUrl() . '/index.php?page=home";</script>';
            }
        }
        die();
    }

    // Route to user page
    function roadToUserPage():void{

        if(verifIfLocal()){

            if(checkAndReturnValueInUrl() === 'MyCv'){
                echo '<script>window.location.href = "http://mycv/index.php?page=user";</script>';
            }else{
                echo '<script>window.location.href = "http://mycv/' . checkAndReturnValueInUrl() . '/index.php?page=user";</script>';
            }
        }else{
            if(checkAndReturnValueInUrl() === 'MyCv'){
                echo '<script>window.location.href = "https://www.follaco.fr/index.php?page=user";</script>';
            }else{
                echo '<script>window.location.href = "https://www.follaco.fr/' . checkAndReturnValueInUrl() . '/index.php?page=user";</script>';
            }
        }
        die();
    }

    // Route to carEdit page
    function roadToCarEditPage():void{

        if(verifIfLocal()){
            echo '<script>window.location.href = "http://mycv/garageparrot/index.php?page=carEdit";</script>';
        }
        else{            
            echo '<script>window.location.href = "https://www.follaco.fr/garageparrot/index.php?page=carEdit";</script>';
        }
        die();
    }

    // Route to car page
    function roadToCarPage():void{

        if(verifIfLocal()){
            echo '<script>window.location.href = "http://mycv/garageparrot/index.php?page=car";</script>';
        }
        else{
            echo '<script>window.location.href = "https://www.follaco.fr/garageparrot/index.php?page=car";</script>';
        }
        die();
    }

    // Route to disconnect page
    function roadToDisconnectPage():void{

        if(verifIfLocal()){
            echo '<script>window.location.href = "http://mycv/index.php?page=disconnect";</script>';
        }else{
            echo '<script>window.location.href = "https://www.follaco.fr/index.php?page=disconnect";</script>';
        }
        die();
    }

    // Route to disconnect page
    function returnNewError():void{
        
        if(verifIfLocal()){

            if(checkAndReturnValueInUrl() === 'MyCv'){
                echo '<script>window.location.href = "http://mycv/index.php?page=userEdit&newError=true";</script>';
            }else{
                echo '<script>window.location.href = "http://mycv/' . checkAndReturnValueInUrl() . '/index.php?page=userEdit&newError=true";</script>';
            }
        }else{
            if(checkAndReturnValueInUrl() === 'MyCv'){
                echo '<script>window.location.href = "https://www.follaco.fr/index.php?page=userEdit&newError=true";</script>';
            }else{
                echo '<script>window.location.href = "https://www.follaco.fr/' . checkAndReturnValueInUrl() . '/index.php?page=userEdit&newError=true";</script>';
            }
        }
        die();
    }

?>