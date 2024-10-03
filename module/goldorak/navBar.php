<nav class="navbar navbar-expand-lg mx-auto mt-auto mb-3 ">

    <div class="container-fluid">

        <a class="navbar-brand text-light" href="#"></a>
        <button class="navbar-toggler bg-primary" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNavDropdown">

            <ul class="navbar-nav">
            
                <li class="nav-item d-flex justify-content-center align-items-center">
                    <a class="nav-link active text-light" aria-current="page" href="goldorak.php?page=home">
                        <img class="p-0 px-2 mb-1" src="../img/goldorak/icon/house.svg" alt="icone événements">
                        Accueil
                    </a>
                </li>
                
                <li class="nav-item dropdown d-flex justify-content-center align-items-center">
                    <a class="nav-link dropdown-toggle text-light" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img class="p-0 px-2 mb-1" src="../img/goldorak/icon/calendar2-event.svg" alt="icone événements">
                        Evénements
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item text-light" href="goldorak.php?page=events">
                                <img class="p-0 pe-2 mb-1" src="../img/goldorak/icon/calendar2-event.svg" alt="icone événements">  
                                Consulter
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item text-light" href="goldorak.php?page=events#SalonDeParis2023">
                                <img class="p-0 pe-2 mb-1" src="../img/goldorak/icon/incognito.svg" alt="icone joystick du menu jeux">  
                                Manga Paris 2023
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item text-light" href="goldorak.php?page=events#SalonJapanExpo2024">
                                <img class="p-0 pe-2 mb-1" src="../img/goldorak/icon/tencent-qq.svg" alt="icone joystick du menu jeux">  
                                Japan Expo 2024
                            </a>
                        </li>
                    </ul>
                </li>

            <?php if($_SESSION['dataConnect']['type'] === 'Administrator' || $_SESSION['dataConnect']['type'] === 'Member'){ ?>
                <li class="nav-item d-flex justify-content-center align-items-center">
                    <a class="nav-link active text-light" aria-current="page" href="goldorak.php?page=media">
                        <img class="p-0 px-2 mb-1" src="../img/goldorak/icon/card-image.svg" alt="icone événements">
                        Médias
                    </a>
                </li>
            <?php } ?>
            
            <?php if($_SESSION['dataConnect']['subscription'] != 'Vénusia' && $_SESSION['dataConnect']['type'] != 'User' && $_SESSION['dataConnect']['type'] != 'Guest'){ ?>
                <li class="nav-item dropdown d-flex justify-content-center align-items-center">
                    <a class="nav-link dropdown-toggle text-light" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img class="p-0 px-2 mb-1" src="../img/goldorak/icon/joystick.svg" alt="icone joystick du menu jeux">  
                        Jeux
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item text-light" href="goldorak.php?page=goldorakgo">
                                <img class="p-0 pe-2 mb-1" src="../img/goldorak/icon/crosshair2.svg" alt="icone du menu s'identifier">    
                                Goldorak Go
                            </a>
                        </li>
                    <?php if($_SESSION['dataConnect']['subscription'] === 'Goldorak' ){ ?>
                        <li>
                            <a class="dropdown-item text-light" href="goldorak.php?page=commander">
                                <img class="p-0 pe-2 mb-1" src="../img/goldorak/icon/dice-6.svg" alt="icone du menu s'identifier">    
                                My Commander
                            </a>
                        </li>
                    <?php } ?>
                    </ul>
                </li>
            <?php } ?>
                
            <?php if($_SESSION['dataConnect']['type'] === 'Administrator'){ ?>
                <li class="nav-item dropdown d-flex justify-content-center align-items-center">
                    <a class="nav-link dropdown-toggle text-light" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img class="px-2 mb-1" src="../img/goldorak/icon/people.svg" alt="icone du bouton s'identifier">    
                        Profils
                    </a>
                    <ul class="dropdown-menu">
                        <li>    
                            <a class="dropdown-item text-light" href="goldorak.php?page=user">
                                <img class="pe-2 mb-1" src="../img/goldorak/icon/search.svg" alt="icone consulter les profils">
                                Consulter
                            </a>
                        </li>
                        <li>
                            <form action="goldorak.php?page=userEdit" method="post">
                                <button class="dropdown-item text-light" id="btn_navBar_new" name="btn_navBar_new" type="submit">
                                    <img class="pe-2 mb-1" src="../img/goldorak/icon/person-plus.svg" alt="icone nouveau profil">
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
                                if($_SESSION['dataConnect']['type'] != 'Guest'){
                                    echo "../img/goldorak/avatar/" . $_SESSION['dataConnect']['avatar']; 
                                }else{
                                    echo "../img/goldorak/icon/person.svg"; 
                                }
                            ?>">
                            <span class="Nav_Span1"><?php if($_SESSION['dataConnect']['pseudo']!= 'Guest'){echo 'Bonjour';}else{echo 'Se connecter';}?></span></br><span class="Nav_Span2 text-warning"><?php if($_SESSION['dataConnect']['pseudo']!= 'Guest'){echo $_SESSION['dataConnect']['pseudo'] . ' !';}else{echo "à votre compte";}?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <?php if($_SESSION['dataConnect']['type'] === 'Guest'){ ?>
                        <li>
                            <a class="dropdown-item text-light" href="goldorak.php?page=connexion">
                                <img class="p-0 m-0 pe-2" src="../img/goldorak/icon/box-arrow-in-left.svg" alt="icone du bouton connexion">    
                                Connexion
                            </a>
                        </li>
                        <?php } ?>
                        <?php if($_SESSION['dataConnect']['type'] != 'Guest'){ ?>
                        <li>
                            <a class="dropdown-item text-light" href="goldorak.php?page=disconnect">
                                <img class="p-0 m-0 pe-2" src="../img/goldorak/icon/box-arrow-right.svg" alt="icone du bouton déconnexion">    
                                Déconnexion
                            </a>
                        </li>
                        <?php } ?>
                    <?php if($_SESSION['dataConnect']['type'] != 'Guest'){ ?>
                        <li>
                            <form action="goldorak.php?page=userEdit" method="post">
                                <button class="dropdown-item text-light" type="submit" name="btn_monCompte">
                                    <img class="p-0 m-0 pe-2" src="../img/goldorak/icon/person-gear.svg" alt="icone du bouton mon compte">    
                                    Mon compte
                                </button>
                            </form>
                        </li>
                    <?php } ?>
                    
                    <?php if($_SESSION['dataConnect']['type'] === 'Guest'){ ?>
                        <li>
                            <a class="dropdown-item text-light" href="goldorak.php?page=adherer">
                                <img class="p-0 m-0 pe-2" src="../img/goldorak/icon/pencil-square.svg" alt="icone du bouton adhérer">    
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