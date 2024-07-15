<?php

    use Firebase\JWT\JWT;

    // Creating of JWT token

    function tokenJwt ($pseudo, $key){
            
        $payload = array(

            "user_pseudo" => $pseudo,
            "delay" => time() + 30,
            "key" => $key

        );

        $value = JWT::jsonEncode($payload);

        return $value;

    }

    // Create and verification of CSRF token
    function verifCsrf($varCsrf) {
            
        $value_Is = false;

        if(isset($_POST[$varCsrf]) && $_POST[$varCsrf] === $_SESSION[$varCsrf]){
            
            $value_Is = true;

        }

        if(empty($_SESSION[$varCsrf])){

            $_SESSION[$varCsrf] = generate32ByteKey();

        }

        return $value_Is;
    }

    // Genered key 32 bytes
    function generate32ByteKey(){

        $key = bin2hex(random_bytes(32));
        return $key;
        
    }

    //escape Input
    function escapeInput($input){
        return htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
    }

    function filterInput($input, $method = INPUT_POST){
        return filter_input($method, $input, FILTER_DEFAULT);
    }

    //upload image
    function uploadImg($session,$post,$file,$directory = './img/vehicle/'){
        
        $uploadDirectory = $directory;

        $_SESSION[$session] = isset($_POST[$post]) ? escapeInput($_POST[$post]) : false;

        $_SESSION[$session] = isset($_FILES[$file]) ? escapeInput($_FILES[$file]["error"]) : false;

        if ($_SESSION[$session] == UPLOAD_ERR_OK){

            $_SESSION[$session] = isset($_FILES[$file]) ? escapeInput($_FILES[$file]["name"]) : false;
            $sourceFile = isset($_FILES[$file]) ? escapeInput($_FILES[$file]["tmp_name"]) : false;
            $destinationFile = $uploadDirectory . basename($_SESSION[$session]);
            unset($_FILES[$file]);

        }else{

            echo "<script>alert('Aucune image n\'a été sélectionnée ou une erreur s_'est produite.');</script>";
            return false;
            
        }

        if(move_uploaded_file($sourceFile, $destinationFile)){
            
            return true;

        }else{

            return false;
        
        }

    }

    // Rerouted if the page is inaccessible for the current user
    function pageUnavailable(){
            
        if($_SESSION['local']){

            echo '<script>window.location.href = "http://mycv/index.php?page=error_page";</script>';
        
        }else{

            echo '<script>window.location.href = "https://www.follaco.fr/index.php?page=error_page";</script>';

        }
        exit();
        
    }

    // Rerouted if page does not exist 
    function unknownPage(){
            
        if($_SESSION['local']){
            
            echo '<script>window.location.href = "http://mycv/index.php?page=unknownPage";</script>';
        
        }
        else{
            
            echo '<script>window.location.href = "https://www.follaco.fr/index.php?page=unknownPage";</script>';
        
        }
        exit();
        
    }

    // Rerouted if page does not exist 
    function timeExpired(){

        $current_url = $_SERVER['REQUEST_URI'];
        $goldorak = '/goldorak/';
        $garageParrot = '/garageparrot/';
    
        if(preg_match($goldorak, $current_url)){
            
            if($_SESSION['local']){

                echo '<script>window.location.href = "http://mycv/goldorak/index.php?page=timeExpired";</script>';
            
            }
            else{

                echo '<script>window.location.href = "https://www.follaco.fr/goldorak/index.php?page=timeExpired";</script>';
            
            }

        }else if(preg_match($garageParrot, $current_url)){
            
            if($_SESSION['local']){

                echo '<script>window.location.href = "http://mycv/garageparrot/index.php?page=timeExpired";</script>';
        
            }
            else{

                echo '<script>window.location.href = "https://www.follaco.fr/garageparrot/index.php?page=timeExpired";</script>';
            
            }

        }else{
            
            if($_SESSION['local']){

                echo '<script>window.location.href = "http://mycv/index.php?page=timeExpired";</script>';
        
            }
            else{

                echo '<script>window.location.href = "https://www.follaco.fr/index.php?page=timeExpired";</script>';
            
            }

        }

        exit();
        
    }

    // Route to home page
    function routeToHomePage(){
            
        if($_SESSION['local']){
            
            echo '<script>window.location.href = "http://mycv/index.php?page=home";</script>';
        

        }else{

            echo '<script>window.location.href = "https://www.follaco.fr/index.php?page=home";</script>';

        }
        exit();
    }

    // Route to home page
    function routeToHomePageGarageParrot(){
            
        if($_SESSION['local']){
            
            echo '<script>window.location.href = "http://mycv/garageparrot/index.php?page=home";</script>';
        

        }else{

            echo '<script>window.location.href = "https://www.follaco.fr/garageparrot/index.php?page=home";</script>';

        }
        exit();
    }

    // Route to home page
    function routeToHomePageGoldorak(){
            
        if($_SESSION['local']){
            
            echo '<script>window.location.href = "http://mycv/goldorak/index.php?page=home";</script>';
        

        }else{

            echo '<script>window.location.href = "https://www.follaco.fr/goldorak/index.php?page=home";</script>';

        }
        //exit();
    }

    // Route to user page
    function routeToUserPage(){
        if($_SESSION['local']){

            echo '<script>window.location.href = "http://mycv/index.php?page=user";</script>';
        
        }
        else{
            
            echo '<script>window.location.href = "https://www.follaco.fr/index.php?page=user";</script>';
        
        }
        exit();
    }

    // Route to carEdit page
    function routeToCarEditPage(){
        if($_SESSION['local']){

            echo '<script>window.location.href = "http://mycv/index.php?page=carEdit";</script>';
        
        }
        else{
            
            echo '<script>window.location.href = "https://www.follaco.fr/index.php?page=carEdit";</script>';
        
        }
        exit();
    }

    // Route to car page
    function routeToCarPage(){
        if($_SESSION['local']){

            echo '<script>window.location.href = "http://mycv/index.php?page=car";</script>';
        
        }
        else{
            
            echo '<script>window.location.href = "https://www.follaco.fr/index.php?page=car";</script>';
        
        }
        exit();
    }

    // Route to disconnect page
    function routeToConnexionPage(){
        if($_SESSION['local']){

            echo '<script>window.location.href = "http://mycv/index.php?page=connexion";</script>';
        
        }
        else{
            
            echo '<script>window.location.href = "https://www.follaco.fr/index.php?page=connexion";</script>';
        
        }
        exit();
    }

    // Route to disconnect page
    function routeToDisconnectPage(){
        if($_SESSION['local']){

            echo '<script>window.location.href = "http://mycv/index.php?page=disconnect";</script>';
        
        }
        else{
            
            echo '<script>window.location.href = "https://www.follaco.fr/index.php?page=disconnect";</script>';
        
        }
        exit();
    }

    // Route to disconnect page
    function returnNewError(){
        if($_SESSION['local']){

            echo '<script>window.location.href = "http://mycv/index.php?page=user_edit&newError=true";</script>';

        }else{

            echo '<script>window.location.href = "https://www.follaco.fr/index.php?page=user_edit&newError=true";</script>';

        }
        exit();
    }

    // Route after delete
    function routeAfterDelete(){

        if($_SESSION['typeConnect'] === 'Administrator'){

            routeToUserPage();

        }else{

            routeToDisconnectPage();
            
        }
    }

    function resetVariableCar(){

        $_SESSION['criteriaBrand'] = 'Selectionnez une marque';
        $_SESSION['criteriaModel'] = 'Selectionnez un modele';
        $_SESSION['criteriaMileage'] = 'Selectionnez un kilometrage maxi';
        $_SESSION['criteriaPrice'] = 'Selectionnez un prix maxi';

        $_SESSION['newCars'] = false;
        $_SESSION['whereClause'] =  '1';

        $_SESSION['errorFormCar'] = false;

    }

    function resetVariableUser(){

        $_SESSION['whereClause'] =  '1';

        $_SESSION['criteriaName'] = '';
        $_SESSION['criteriaPseudo'] = '';
        $_SESSION['criteriaType'] = 'Selectionnez un type';

        $_SESSION['newUser'] = false;

        $_SESSION['errorFormUser'] = false;

    }

    function resetVariablePage(){

        $_SESSION['laPage'] = 1;
        $_SESSION['firstLine'] = 0;
        $_SESSION['ligneParPage'] = 3;
        $_SESSION['nbOfPage'] = 1;

        
    }

    function resetVariableGoldorak(){

        $_SESSION['updateMoncompte'] = false;
        $_SESSION['newUser'] = false;
        $_SESSION['btn_monCompte'] = false;
        
    }

?>