<?php

// VARIABLES MyCv

    // La variable $_SESSION['local'] mettre à false si online et à true si serveur local
    // Cette variable agit sur le controleur 'ConfigConnGP.php' pour les paramètres de connexion
    $_SESSION['local'] = true;

    if (!isset($_SESSION['dataConnect']['type']) || empty($_SESSION['dataConnect']['type'])) {

/********************************************************************** */
/********************** VARIABLES CONNEXION *************************** */
/********************************************************************** */

        resetDataConnectVarSession();
        
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

        $_SESSION['jwt']['secretKey'] = "93082d283829273c47737cd555841ce33af04a29c791c2424df8e0f74a6d3afb";
        $_SESSION['jwt']['delay'] = 3600;
        $_SESSION['jwt']['tokenJwt'] = tokenJwt($_SESSION['dataConnect']['pseudo'], $_SESSION['jwt']['secretKey'], $_SESSION['jwt']['delay']);

        /*$jwt = array(); settype($jwt, 'array');
        $jwt['secretKey'] = "93082d283829273c47737cd555841ce33af04a29c791c2424df8e0f74a6d3afb";
        $jwt['delay'] = 3600;
        $jwt['tokenJwt'] = tokenJwt($_SESSION['dataConnect']['pseudo'], $jwt['secretKey'], $jwt['delay']);
        $_SESSION['jwt'] = $jwt;*/
        
        //$_SESSION['jwt']['secretKey'] = "93082d283829273c47737cd555841ce33af04a29c791c2424df8e0f74a6d3afb";
        //$_SESSION['jwt']['delay'] = 3600; //delay for token JWT (1 hour before disconnection and return to the connection page)
        //$_SESSION['jwt']['tokenJwt'] = tokenJwt($_SESSION['dataConnect']['pseudo'], $_SESSION['jwt']['secretKey'], $_SESSION['jwt']['delay']);

/********************************************************************** */
/****************************** TOKEN CSRF **************************** */
/********************************************************************** */

        $_SESSION['csrf'] = "93082d283829273c47737cd555841ce33af04a29c791c2424df8e0f74a6d3afb";

/********************************************************************** */
/******************* VARIABLES PAGINATION ***************************** */
/********************************************************************** */

        /*$pagegination = array(); settype($pagegination, 'array');
        $pagegination['thePage'] = 1;
        $pagegination['firstLine'] = 0;
        $pagegination['productPerPage'] = 3;
        $pagegination['nbOfPage'] = 1;
        $pagegination['nbOfProduct'] = 1;
        $pagegination['NextOrPrevious'] = false;
        
        $_SESSION['pagination'] = $pagegination;*/

        $_SESSION['pagination']['thePage'] = 1;
        $_SESSION['pagination']['firstLine'] = 0;
        $_SESSION['pagination']['productPerPage'] = 3;
        $_SESSION['pagination']['nbOfPage'] = 1;
        $_SESSION['pagination']['nbOfProduct'] = 1;
        $_SESSION['pagination']['NextOrPrevious'] = false;


        //$_SESSION['theTable'] = 'user'; // Si Golrorak ou MyCv
        //$_SESSION['theTable'] = 'car'; // Si Garage PARROT

/********************************************************************** */
/******************* VARIABLES CRITERIA SEARCH ************************ */
/********************************************************************** */
        


/********************************************************************** */
/************************* VARIABLES OTHER **************************** */
/********************************************************************** */

        $_SESSION['timeZone']="Europe/Paris";
        $_SESSION['message']="";

        $_SESSION['errorForm'] = false;
        /*$_SESSION['errorFormUser'] = false;
        $_SESSION['errorFormCar'] = false;
        $_SESSION['errorFormComment'] = false;*/
                
        $_SESSION['updateMoncompte'] = false;
        $_SESSION['btn_monCompte'] = false;
        $_SESSION['bt_userEdit_save'] = false;

/********************************************************************** */
/******************* VARIABLES USER *********************************** */
/********************************************************************** */
        
        resetUserVarSession();

/********************************************************************** */
/************************** VARIABLES CARS **************************** */
/********************************************************************** */
        
        $_SESSION['addCar'] = false;
        $_SESSION['newCar'] = false;
        $_SESSION['carBrand'] = '_';
        $_SESSION['carModel'] = '_';
        $_SESSION['carMotorization'] = '_';
        $_SESSION['carSold'] = 'Oui';
        
        $_SESSION['uploadAvatar'] = '';
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

/********************************************************************** */
/********************** Functions reset variables ********************* */
/********************************************************************** */

    function resetDataConnectVarSession(){

        $_SESSION['dataConnect']['idUser'] = 0;
        $_SESSION['dataConnect']['pseudo'] = 'Guest';
        $_SESSION['dataConnect']['avatar'] = 'black_person.svg';
        $_SESSION['dataConnect']['type'] = 'Guest';
        $_SESSION['dataConnect']['subscription'] = 'Vénusia';
        $_SESSION['dataConnect']['password'] = '';
        $_SESSION['dataConnect']['error'] = false;
        $_SESSION['dataConnect']['message'] = '';
        $_SESSION['dataConnect']['connexion'] = false;
    }

    function resetUserVarSession(){

        $_SESSION['user']['criteriaName'] = '';
        $_SESSION['user']['criteriaPseudo'] = '';
        $_SESSION['user']['criteriaType'] = 'Selectionnez un type';

        $_SESSION['user']['subscription'] = 'Vénusia';

        $_SESSION['user']['newUser'] = false;
        $_SESSION['user']['addUser'] = false;
        $_SESSION['user']['newMember'] = false;

        $_SESSION['whereClause'] = 1;
        
        /*$_SESSION['criteriaName'] = '';
        $_SESSION['criteriaPseudo'] = '';
        $_SESSION['criteriaType'] = 'Selectionnez un type';

        $_SESSION['subscription'] = 'Vénusia';

        $_SESSION['newUser'] = false;
        $_SESSION['addUser'] = false;
        $_SESSION['newMember'] = false;*/
    }
?>