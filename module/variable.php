<?php

// VARIABLES MyCv

    // La variable $_SESSION['local'] mettre à false si online et à true si serveur local
    // Cette variable agit sur le controleur 'ConfigConnGP.php' pour les paramètres de connexion
    $_SESSION['local'] = true;

    if (!isset($_SESSION['typeConnect'])) {

/********************************************************************** */
/******************* VARIABLES CONNEXION *************************** */
/********************************************************************** */
        
        $_SESSION['connexion'] = false;
        $_SESSION['typeConnect']= 'Guest';
        $_SESSION['pseudoConnect']= 'Guest';
        $_SESSION['avatarConnect']= 'black_person.svg';
        $_SESSION['subscriptionConnect'] = 'Vénusia';
        
        // Token JWT
        $_SESSION['SECRET_KEY'] = "93082d283829273c47737cd555841ce33af04a29c791c2424df8e0f74a6d3afb";
        include_once('../../MyCv/common/utilies.php');
        $_SESSION['jwt'] = tokenJwt($_SESSION['pseudoConnect'], $_SESSION['SECRET_KEY']);
        $_SESSION['delay'] = 30; //delay for token JWT (1 hour before disconnection and return to the connection page)
        
        // Token CSRF
        $_SESSION['csrfHome'] = "93082d283829273c47737cd555841ce33af04a29c791c2424df8e0f74a6d3afb";
        $_SESSION['csrfHeader'] = "93082d283829273c47737cd555841ce33af04a29c791c2424df8e0f74a6d3afb";
        $_SESSION['csrfUser'] = "93082d283829273c47737cd555841ce33af04a29c791c2424df8e0f74a6d3afb";
        $_SESSION['csrfComment'] = "93082d283829273c47737cd555841ce33af04a29c791c2424df8e0f74a6d3afb";

/********************************************************************** */
/******************* VARIABLES PAGINATION ***************************** */
/********************************************************************** */

        $_SESSION['laPage'] = 1;
        $_SESSION['firstLine'] = 0;
        $_SESSION['ligneParPage'] = 3;
        $_SESSION['nbOfPage'] = 1;
        $_SESSION['nbOfProduct'] = 1;
        $_SESSION['NextOrPrevious'] = false;

        $_SESSION['theTable'] = 'user'; // Si Golrorak ou MyCv
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
        $_SESSION['avatarConnect'] = 'black_person.svg';
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