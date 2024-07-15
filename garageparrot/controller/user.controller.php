<?php
//---Load model user--------------------
    include('../../garageparrot/model/user.class.php');
//---Configure object User--
    $MyUser = new User();
    
//---Configure the database table--
    $_SESSION['theTable'] = "user";

//---------------------------------------------------------------
//---Dynamic script of the user page--------------------------
//---------------------------------------------------------------

    if (isset($_POST['btn-SearchUser'])){
        $_SESSION['laPage'] = 1;
        $_SESSION['firstLine'] = 0;
        $_SESSION['ligneParPage'] = 3;
        $_SESSION['nbOfPage'] = 1;
    }else if(isset($_POST['nbOfPage'])){
        $_SESSION['laPage'] = 1;
        $_SESSION['firstLine']=0;
    }

    // Initialiser les variables pour paramètrer la clause where afin d'executer la requete SELECT pour rechercher le ou les contacts
    $name_umpty = true;
    $pseudo_umpty = true;
    $userType_umpty = true;

    $whereClause = "";

    if(isset($_POST['Text_User_Nom']) && $_POST['Text_User_Nom'] != ''){
        $_SESSION['criteriaName'] = $_POST['Text_User_Nom'];
        $name_umpty = false;
    }else if(empty($_SESSION['criteriaName']) && $_SESSION['criteriaName'] === ''){
        //$name_umpty = true;
    }else{
        $name_umpty = false;
    }

    if(isset($_POST['Text_User_Pseudo']) && $_POST['Text_User_Pseudo'] != ''){
        $_SESSION['criteriaPseudo'] = $_POST['Text_User_Pseudo'];
        $pseudo_umpty = false;
    }else if(empty($_SESSION['criteriaPseudo']) && $_SESSION['criteriaPseudo'] === ''){
        //$pseudo_umpty = true;
    }else{
        $pseudo_umpty = false;
    }

    if(isset($_POST['Select_User_Type']) && $_POST['Select_User_Type'] != 'Selectionnez un type'){
        $_SESSION['criteriaType'] = $_POST['Select_User_Type'];
        $userType_umpty = false;
    }else if(!empty($_SESSION['criteriaType']) && $_SESSION['criteriaType'] === 'Selectionnez un type'){
        //$userType_umpty = true;
    }else{
        $userType_umpty = false;
    }

    if(isset($_POST['nbOfLine'])){

    }
    
    // Paramètrage de la clause WHERE pour executer la requete SELECT pour rechercher un ou plusieurs contacts
    if($name_umpty === true && $pseudo_umpty === true && $userType_umpty === true){
        
        $whereClause = 1;

    }else if($name_umpty === false && $pseudo_umpty === false && $userType_umpty === false){

        $whereClause = "`user`.`name` LIKE '%" . $_SESSION['criteriaName'] . "%' AND
                        `user`.`pseudo` LIKE '%" . $_SESSION['criteriaPseudo'] . "%' AND
                        `user`.`id_type` = (SELECT `user_type`.`id_type` FROM `user_type` WHERE `user_type`.`type`='" . $_SESSION['criteriaType'] . "')";

    }else if($name_umpty === true && $pseudo_umpty === false && $userType_umpty === false){

        $whereClause = "`user`.`pseudo` LIKE '%" . $_SESSION['criteriaPseudo'] . "%' AND
                        `user`.`id_type` = (SELECT `user_type`.`id_type` FROM `user_type` WHERE `user_type`.`type`='" . $_SESSION['criteriaType'] . "')";
        
    }else if($name_umpty === true && $pseudo_umpty === true && $userType_umpty === false){

        $whereClause = "`user`.`id_type` = (SELECT `user_type`.`id_type` FROM `user_type` WHERE `user_type`.`type`='" . $_SESSION['criteriaType'] . "')";
        
    }else if($name_umpty === true && $pseudo_umpty === false && $userType_umpty === true){

        $whereClause = "`user`.`pseudo` LIKE '%" . $_SESSION['criteriaPseudo'] . "%'";

    }else if($name_umpty === false && $pseudo_umpty === true && $userType_umpty === false){

        $whereClause = "`user`.`name` LIKE '%" . $_SESSION['criteriaName'] . "%' AND
                        `user`.`id_type` = (SELECT `user_type`.`id_type` FROM `user_type` WHERE `user_type`.`type`='" . $_SESSION['criteriaType'] . "')";
        
    }else if($name_umpty === false && $pseudo_umpty === true && $userType_umpty === true){

        $whereClause = "`user`.`name` LIKE '%" . $_SESSION['criteriaName'] . "%'";
        
    }else if($name_umpty === false && $pseudo_umpty === false && $userType_umpty === true){

        $whereClause = "`user`.`name` LIKE '%" . $_SESSION['criteriaName'] . "%' AND
                        `user`.`pseudo` LIKE '%" . $_SESSION['criteriaPseudo'] . "%'";

    }
    
    if($MyUser->getNewUser() === true){
        $_SESSION['newUser'] = false;
        $whereClause = 1;
        $MyUser->setNewUser(false);
    }
    
    $_SESSION['whereClause'] =  $whereClause;

    // Executer la requete SELECT pour rechercher les contacts en fonction de la clause WHERE
    if($_SESSION['errorFormUser']===false && $MyUser->getNewUser() === false ){
        
        include_once('../../garageparrot/controller/page.controller.php');
        $users = $MyUser->get($whereClause, 'name', 'ASC', $MyPage->getFirstLine(), $_SESSION['ligneParPage']);
    }

    if (isset($_POST['nbOfLine'])){
		
        $_POST['nbOfLine'] = null;

	}
?>