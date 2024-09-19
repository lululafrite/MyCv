<?php

    require_once("../../goldorak/model/user.class.php");
    require_once("../../goldorak/model/userForm.class.php");
    require_once("../../common/utilies.php");
    
    use \Goldorak\Model\User;
    use \Goldorak\Model\UserForm;

    $MyUser = new User();
    $MyUserForm = new UserForm();

    $_SESSION['theTable'] = "user";

    if (isset($_POST['btn-SearchUser'])){
        
        $_SESSION['pagination']['thePage'] = 1;
        $_SESSION['pagination']['firstLine'] = 0;
        $_SESSION['pagination']['productPerPage'] = 3;
        $_SESSION['pagination']['nbOfPage'] = 1;

        $_SESSION['criteriaName'] = isset($_POST['Text_User_Nom']) ? escapeInput($_POST['Text_User_Nom']) : '';
        unset($_POST['Text_User_Nom']);

        $_SESSION['criteriaPseudo'] = isset($_POST['Text_User_Pseudo']) ? escapeInput($_POST['Text_User_Pseudo']) : '';
        unset($_POST['Text_User_Pseudo']);

        $_SESSION['criteriaType'] = isset($_POST['Select_User_Type']) ? escapeInput($_POST['Select_User_Type']) : 'Selectionnez un type';
        unset($_POST['Select_User_Type']);

    }else if(isset($_POST['nbOfPage'])){
        $_SESSION['pagination']['thePage'] = 1;
        $_SESSION['pagination']['firstLine']=0;
    }

    // Initialiser les variables pour paramètrer la clause where afin d'executer la requete SELECT pour rechercher le ou les contacts
    $name_umpty = true;
    $pseudo_umpty = true;
    $userType_umpty = true;

    if(!empty($_SESSION['criteriaName'])){
        $name_umpty = false;
    }else{
        $name_umpty = true;
    }

    if(!empty($_SESSION['criteriaPseudo'])){
        $pseudo_umpty = false;
    }else{
        $pseudo_umpty = true;
    }

    if(!empty($_SESSION['criteriaType']) && $_SESSION['criteriaType'] != 'Selectionnez un type'){
        $userType_umpty = false;
    }else{
        $userType_umpty = true;
    }
    
    // Paramètrage de la clause WHERE pour executer la requete SELECT pour rechercher un ou plusieurs contacts
    
    $whereClause = "";

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
    
    if($MyUserForm->getNewUser() === true){
        $_SESSION['newUser'] = false;
        $whereClause = 1;
        $MyUserForm->setNewUser(false);
    }
    
    $_SESSION['whereClause'] =  $whereClause;

    // Executer la requete SELECT pour rechercher les contacts en fonction de la clause WHERE
    if(!$_SESSION['errorFormUser'] && !$_SESSION['newUser']){
        
        require_once("../../goldorak/controller/page.controller.php");
        $users = $MyUser->get($whereClause, 'name', 'ASC', $MyPage->getFirstLine(), $_SESSION['pagination']['productPerPage']);
    }

    if (isset($_POST['nbOfLine'])){
		
        $_POST['nbOfLine'] = null;

	}
?>