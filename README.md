# Site web pour le GARAGE V.PARROT

Tous les documents sont disponibles dans Dossier_Technique/

******** MANUEL D'INSTALLATION ONLINE ET LOCAL ********

Le manuel ci-dessous d'écrit uniquement les étapes principales à respecter pour travailler en local ou en online
Pour l'utilisation du site, référez-vous au manuel d'utilisation : manuel_utilisation_Garage_PARROT.pdf

POUR TRAVAILLER EN LOCAL
1) Installez WAMPSERVER avec php 8.2 et mariadb 10.11.5
    - Assurez-vous que la base de données mariadb soit accéssible sur le port 3307
    - Configurez le fichier php.ini en utilisant le modèle tuto/php. Cette configuration est importante pour le téléchargement des images et pour activer xdebug.
    - Utiliser l'extension PDO
2) Clonez le projet avec GIT dans le dossier wwww de wampserver 
3) Pour VS CODE, installez les extentions suivantes :
    - Composer
    - Mysql Autocomplete
    - php debug
    - php extension pack
    - php intelephense
    - symfony for VSCode
4) Configurez le fichier launch.json de VS Code
    - Référez-vous au fichier tuto/launch.txt
5) Base de données (mariadb)
    - Concervez votre utilisateur 'root' sans mot de passe avec tous les privilèges
    - Créer le schéma nommé 'garage_parrot'
    - Importer le fichier garage_parrot.sql dans votre schéma
6) Agir sur le fichier public/index.php
    Tout en haut du fichier public/index.php :
    - Décommentez error_reporting(E_ALL);
    - Décommentez ini_set('display_errors', 'On');
    - Décommentez xdebug_break();
    - Passez la variable $_SESSION['local'] à true. Exemple : $_SESSION['local']=true; Cette variable agit sur le controleur 'ConfigConnGP.php' pour les paramètres de connexion (true pour local et false pour online).

PS : il y a 3 types de profil : Le visiteur (Guest), l'employé (User) et l'administrateur (Administrator). L'utilisateur et l'administrateur doivent se connecter avec un identifiant et un mot de passe. L'utilisateur posséde des privilèges de création et de suppression que le visiteur ne posséde pas et l'administrateur a les mêmes privilèges que l'utilisateur avec en plus, la possibilité de créer des nouveaux profils pouvant-être : employé ou administrateur.
Il existe un employé (User) par défaut dans la BD | ID : user@gmail.com | PW : User123/
Il existe un administrateur (Administrator) par défaut dans la BD | ID : admin@gmail.com | PW : Admin123/


POUR TRAVAILLER ONLINE
1) Agir sur le fichier public/index.php
    Tout en haut du fichier public/index.php :
    - Commentez //error_reporting(E_ALL);
    - Commentez //ini_set('display_errors', 'On');
    - Commentez //xdebug_break();
    - Passez la variable $_SESSION['local'] à false. Exemple : $_SESSION['local']=false; Cette variable agit sur le controleur 'ConfigConnGP.php' pour les paramètres de connexion (true pour local et false pour online).
2) Utilisateur de la Base de données
    - Produire un utilisateur possédant tous les privilèges avec un nom d'utilisateur différent de root et un mot de passe sécurisé.
3) Uploadez le projet sur le serveur online
    - Avec filezilla, updoadez les dossiers et fichier disponible dans github
    https://github.com/lululafrite/GarageParrot.git
    git clone https://github.com/lululafrite/GarageParrot.git

PS : il y a 3 types d'utilisateurs : Le visiteur, L'utilisateur (doit de connecter avec un identifiant et un mot de passe. Il posséde des privilèges de création et de suppression que le visiteur ne posséde pas) et l'administrateur (identique à l'utilisateur avec les provilèges sur la création de nouveaux utilisateurs pouvant-être : utilisateur ou administrateur).
Il existe déjà un utilisateur (User) par défaut dans la BD | ID : user@gmail.com PW : User123/*-
Il existe déjà un administrateur (Administrator) par défaut dans la BD | ID : admin@gmail.com PW : Admin123/*-