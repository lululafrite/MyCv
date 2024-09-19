<?php

// VARIABLES MyCv

    // La variable $_SESSION['local'] mettre à false si online et à true si serveur local
    // Cette variable agit sur le controleur 'ConfigConnGP.php' pour les paramètres de connexion
    $_SESSION['local'] = true;

    if (!isset($_SESSION['dataConnect']['type'])) {

/********************************************************************** */
/********************** VARIABLES CONNEXION *************************** */
/********************************************************************** */
        
        $dataConnect = array(); settype($dataConnect, 'array');
        $dataConnect['idUser'] = 0;
        $dataConnect['pseudo'] = 'Guest';
        $dataConnect['avatar'] = 'black_person.svg';
        $dataConnect['type'] = 'Guest';
        $dataConnect['subscription'] = 'Vénusia';
        $dataConnect['password'] = '';
        $dataConnect['error'] = false;
        $dataConnect['message'] = '';
        $dataConnect['connexion'] = false;

        $_SESSION['dataConnect'] = $dataConnect;
        
/********************************************************************** */
/****************************** TOKEN JWT ***************************** */
/********************************************************************** */

        $current_url = $_SERVER['REQUEST_URI'];
        $goldorak = '/goldorak/';
        $garageParrot = '/garageparrot/';
        $timeExpired = '/timeExpired/';

        if(preg_match($goldorak, $current_url) && !preg_match($timeExpired, $current_url)){
        
                require_once '../../common/utilies.php';
        
        }else if(preg_match($garageParrot, $current_url) && !preg_match($timeExpired, $current_url)){
        
                require_once '../../common/utilies.php';
        
        }else if(!preg_match($timeExpired, $current_url)){

                require_once '../common/utilies.php';
        }
        
        //$_SESSION['secretKey'] = "93082d283829273c47737cd555841ce33af04a29c791c2424df8e0f74a6d3afb";

        $jwt = array(); settype($jwt, 'array');
        $jwt['secretKey'] = "93082d283829273c47737cd555841ce33af04a29c791c2424df8e0f74a6d3afb";
        $jwt['delay'] = 3600;
        $jwt['tokenJwt'] = tokenJwt($_SESSION['dataConnect']['pseudo'], $jwt['secretKey'], $jwt['delay']);
        
        $_SESSION['jwt'] = $jwt;
        
        //$_SESSION['jwt']['secretKey'] = "93082d283829273c47737cd555841ce33af04a29c791c2424df8e0f74a6d3afb";
        //$_SESSION['jwt']['tokenJwt'] = tokenJwt($_SESSION['dataConnect']['pseudo'], $_SESSION['jwt']['secretKey'], $_SESSION['jwt']['delay']);
        //$_SESSION['jwt']['delay'] = 3600; //delay for token JWT (1 hour before disconnection and return to the connection page)

        
        
/********************************************************************** */
/****************************** TOKEN CSRF **************************** */
/********************************************************************** */
        $_SESSION['csrfHome'] = "93082d283829273c47737cd555841ce33af04a29c791c2424df8e0f74a6d3afb";
        $_SESSION['csrfHeader'] = "93082d283829273c47737cd555841ce33af04a29c791c2424df8e0f74a6d3afb";
        $_SESSION['csrfUser'] = "93082d283829273c47737cd555841ce33af04a29c791c2424df8e0f74a6d3afb";
        $_SESSION['csrfComment'] = "93082d283829273c47737cd555841ce33af04a29c791c2424df8e0f74a6d3afb";
        $_SESSION['csrfPage'] = "93082d283829273c47737cd555841ce33af04a29c791c2424df8e0f74a6d3afb";

/********************************************************************** */
/******************* VARIABLES PAGINATION ***************************** */
/********************************************************************** */

        /*$_SESSION['pagination']['thePage'] = 1;
        $_SESSION['pagination']['firstLine'] = 0;
        $_SESSION['pagination']['productPerPage'] = 3;
        $_SESSION['pagination']['nbOfPage'] = 1;
        $_SESSION['pagination']['nbOfProduct'] = 1;
        $_SESSION['pagination']['NextOrPrevious'] = false;*/

        $pagegination = array(); settype($pagegination, 'array');
        $pagegination['thePage'] = 1;
        $pagegination['firstLine'] = 0;
        $pagegination['productPerPage'] = 3;
        $pagegination['nbOfPage'] = 1;
        $pagegination['nbOfProduct'] = 1;
        $pagegination['NextOrPrevious'] = false;
        
        $_SESSION['pagination'] = $pagegination;

        //$_SESSION['theTable'] = 'user'; // Si Golrorak ou MyCv
        //$_SESSION['theTable'] = 'car'; // Si Garage PARROT

/********************************************************************** */
/******************* VARIABLES CRITERIA SEARCH ************************ */
/********************************************************************** */
        
        $_SESSION['criteriaName'] = '';
        $_SESSION['criteriaPseudo'] = '';
        $_SESSION['criteriaType'] = 'Selectionnez un type';

        $_SESSION['whereClause'] = 1;

/********************************************************************** */
/************************* VARIABLES OTHER **************************** */
/********************************************************************** */

        $_SESSION['timeZone']="Europe/Paris";
        $_SESSION['message']="";
        
        $_SESSION['updateMoncompte'] = false;

/********************************************************************** */
/******************* VARIABLES USER *********************************** */
/********************************************************************** */





        $_SESSION['id_user'] = '';
        $_SESSION['name'] = '';
        $_SESSION['surname'] = '';
        $_SESSION['pseudo'] = 'Guest';
        $_SESSION['email'] = '';
        $_SESSION['phone'] = '## ## ## ## ##';
        $_SESSION['type'] = 'Guest';
        $_SESSION['avatar'] = 'black_person.svg';
        $_SESSION['subscription'] = 'Vénusia';
        $_SESSION['password'] =  '';

        $_SESSION['newUser'] = false;
        $_SESSION['addUser'] = false; // SI GARAGE PARROT
        $_SESSION['userType'] = '_'; // SI GARAGE PARROT
        $_SESSION['newMember'] = false; // SI GOLDORAK

        $_SESSION['errorFormUser'] = false;

        $_SESSION['uploadAvatar'] = '';
        $_SESSION['btn_monCompte'] = false;
        $_SESSION['bt_userEdit_save'] = false;

        /********************************************************************** */
        /******************* VARIABLES CARS *********************************** */
        /********************************************************************** */
                
                $_SESSION['addCar'] = false;
                $_SESSION['newCar'] = false;
                $_SESSION['errorFormCar'] = false;
                $_SESSION['carBrand'] = '_';
                $_SESSION['carModel'] = '_';
                $_SESSION['carMotorization'] = '_';
                $_SESSION['carSold'] = 'Oui';
                $_SESSION['uploadImage1'] = '_.png';
                $_SESSION['uploadImage2'] = '_.png';
                $_SESSION['uploadImage3'] = '_.png';
                $_SESSION['uploadImage4'] = '_.png';
                $_SESSION['uploadImage5'] = '_.png';
        
                //Variable critères de recherche car
                $_SESSION['criteriaBrand'] = 'Selectionnez une marque';
                $_SESSION['criteriaModel'] = 'Selectionnez un modele';
                $_SESSION['criteriaMileage'] = 'Selectionnez un kilometrage maxi';
                $_SESSION['criteriaPrice'] = 'Selectionnez un prix maxi';
        
                $_SESSION['addBrand'] = false;
                $_SESSION['addModel']=false;
                $_SESSION['addMotorization']=false;
        
    }
?>