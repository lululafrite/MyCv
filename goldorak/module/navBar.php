<?php include_once '../../common/utilies.php'; ?>

<nav class="navbar navbar-expand-lg mx-auto mt-auto mb-3 ">

    <div class="container-fluid">

        <a class="navbar-brand text-light" href="#"></a>
        <button class="navbar-toggler bg-primary" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNavDropdown">

            <ul class="navbar-nav">
            
                <li class="nav-item d-flex justify-content-center align-items-center">
                    <a class="nav-link active text-light" aria-current="page" href="index.php?page=home">
                        <img class="p-0 px-2 mb-1" src="img/icon/house.svg" alt="icone événements">
                        Accueil
                    </a>
                </li>
                
                <li class="nav-item dropdown d-flex justify-content-center align-items-center">
                    <a class="nav-link dropdown-toggle text-light" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img class="p-0 px-2 mb-1" src="img/icon/calendar2-event.svg" alt="icone événements">
                        Evénements
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item text-light" href="index.php?page=events">
                                <img class="p-0 pe-2 mb-1" src="img/icon/calendar2-event.svg" alt="icone événements">  
                                Consulter
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item text-light" href="index.php?page=events#SalonDeParis2023">
                                <img class="p-0 pe-2 mb-1" src="img/icon/incognito.svg" alt="icone joystick du menu jeux">  
                                Manga Paris 2023
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item text-light" href="index.php?page=events#SalonJapanExpo2024">
                                <img class="p-0 pe-2 mb-1" src="img/icon/tencent-qq.svg" alt="icone joystick du menu jeux">  
                                Japan Expo 2024
                            </a>
                        </li>
                    </ul>
                </li>

            <?php if($_SESSION['typeConnect'] === 'Administrator' || $_SESSION['typeConnect'] === 'Member'){ ?>
                <li class="nav-item d-flex justify-content-center align-items-center">
                    <a class="nav-link active text-light" aria-current="page" href="index.php?page=media">
                        <img class="p-0 px-2 mb-1" src="img/icon/card-image.svg" alt="icone événements">
                        Médias
                    </a>
                </li>
            <?php } ?>
            
            <?php if($_SESSION['subscriptionConnect'] != 'Vénusia' && $_SESSION['typeConnect'] != 'User'){ ?>
                <li class="nav-item dropdown d-flex justify-content-center align-items-center">
                    <a class="nav-link dropdown-toggle text-light" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img class="p-0 px-2 mb-1" src="img/icon/joystick.svg" alt="icone joystick du menu jeux">  
                        Jeux
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item text-light" href="index.php?page=goldorakgo">
                                <img class="p-0 pe-2 mb-1" src="img/icon/crosshair2.svg" alt="icone du menu s'identifier">    
                                Goldorak Go
                            </a>
                        </li>
                    <?php if($_SESSION['subscriptionConnect'] === 'Goldorak' ){ ?>
                        <li>
                            <a class="dropdown-item text-light" href="index.php?page=commander">
                                <img class="p-0 pe-2 mb-1" src="img/icon/dice-6.svg" alt="icone du menu s'identifier">    
                                My Commander
                            </a>
                        </li>
                    <?php } ?>
                    </ul>
                </li>
            <?php } ?>
                
            <?php if($_SESSION['typeConnect'] === 'Administrator'){ ?>
                <li class="nav-item dropdown d-flex justify-content-center align-items-center">
                    <a class="nav-link dropdown-toggle text-light" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img class="px-2 mb-1" src="img/icon/people.svg" alt="icone du bouton s'identifier">    
                        Profils
                    </a>
                    <ul class="dropdown-menu">
                        <li>    
                            <a class="dropdown-item text-light" href="index.php?page=user">
                                <img class="pe-2 mb-1" src="img/icon/search.svg" alt="icone consulter les profils">
                                Consulter
                            </a>
                        </li>
                        <li>
                            <form action="index.php?page=userEdit" method="post">
                                <!-- <input class="dropdown-item text-light nav_new_user" type="button" name="nav_new_user" id="nav_new_user" value="Nouveau">  -->
                                <button class="dropdown-item text-light" id="nav_new_user" name="nav_new_user" type="submit">
                                    <img class="pe-2 mb-1" src="img/icon/person-plus.svg" alt="icone nouveau profil">
                                    Nouveau
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
            <?php } ?>
                
                <li class="nav-item dropdown custom-border-md-bottom d-flex justify-content-center align-items-center">
                    <a class="nav-link dropdown-toggle text-light" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img class="p-0 px-2 mb-1" alt="icone du menu s'identifier" style="width: 30px;" src=
                            "<?php
                                if($_SESSION['typeConnect'] != 'Guest'){
                                    echo "img/avatar/" . $_SESSION['avatarConnect']; 
                                }else{
                                    echo "img/icon/person.svg"; 
                                }
                            ?>">
                            <span class="Nav_Span1"><?php if($_SESSION['pseudoConnect']!= 'Guest'){echo 'Bonjour';}else{echo 'Se connecter';}?></span></br><span class="Nav_Span2 text-warning"><?php if($_SESSION['pseudoConnect']!= 'Guest'){echo $_SESSION['pseudoConnect'] . ' !';}else{echo "à votre compte";}?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <?php if($_SESSION['typeConnect'] === 'Guest'){ ?>
                        <li>
                            <a class="dropdown-item text-light" href="index.php?page=connexion">
                                <img class="p-0 m-0 pe-2" src="img/icon/box-arrow-in-left.svg" alt="icone du bouton connexion">    
                                Connexion
                            </a>
                        </li>
                        <?php } ?>
                        <?php if($_SESSION['typeConnect'] != 'Guest'){ ?>
                        <li>
                            <a class="dropdown-item text-light" href="index.php?page=disconnect">
                                <img class="p-0 m-0 pe-2" src="img/icon/box-arrow-right.svg" alt="icone du bouton déconnexion">    
                                Déconnexion
                            </a>
                        </li>
                        <?php } ?>
                    <?php if($_SESSION['typeConnect'] != 'Guest'){ ?>
                        <li>
                            <form action="index.php?page=userEdit" method="post">
                                <button class="dropdown-item text-light" type="submit" name="btn_monCompte">
                                    <img class="p-0 m-0 pe-2" src="img/icon/person-gear.svg" alt="icone du bouton mon compte">    
                                    Mon compte
                                </button>
                            </form>
                        </li>
                    <?php } ?>
                    
                    <?php if($_SESSION['typeConnect'] === 'Guest'){ ?>
                        <li>
                            <a class="dropdown-item text-light" href="index.php?page=adherer">
                                <img class="p-0 m-0 pe-2" src="img/icon/pencil-square.svg" alt="icone du bouton adhérer">    
                                Adhérer
                            </a>
                        </li>
                    <?php } ?>
                    </ul>
                </li>

            </ul>

        </div>

    </div>

</nav>