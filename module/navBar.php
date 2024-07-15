<?php include_once('../common/utilies.php'); ?>

<div class="d-flex justify-content-center bg-body-tertiary py-2">

    <nav class="navbar navbar-expand-lg bg-body-tertiary p-0 m-0">

        <div class="d-flex flex-column align-items-center">

            <a class="navbar-brand text-light" href="#"></a>
            <button
                class="navbar-toggler bg-corps-tertiaire mb-2"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown"
                aria-expanded="false"
                aria-label="Toggle navigation"
            >
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNavDropdown">

                <ul class="navbar-nav">
                
                    <li class="nav-item custom-border-md-bottom">
                        <a class="nav-link" aria-current="page" href="index.php?page=home">
                            <img class="p-2 h-75" src="img/icon/black_house.svg" alt="icone du bouton s'identifier">
                            Accueil
                        </a>
                    </li>
                    
                    <li class="nav-item custom-border-md-bottom">
                        
                        <a class="nav-link" aria-current="page" href="index.php?page=mycv">
                            <img class="p-2 h-75" src="img/icon/black_calendar2-event.svg" alt="icone du bouton pacours professionnel">    
                            <span class="Nav_Span1">Parcours<br><span class="Nav_Span2">professionnel</span></span>
                        </a>

                    </li>

                    <li class="nav-item dropdown custom-border-md-bottom">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img class="p-2 h-75" src="img/icon/columns_black.svg" alt="icone du menu my apps">
                            <span class="Nav_Span1">My apps<br><span class="Nav_Span2">Testez moi!<?php //if($_SESSION['pseudoConnect']!= 'Guest'){echo 'Hello ' . $_SESSION['pseudoConnect'] . ' !';}?></span></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item Nav_Span1" href="goldorak/index.php?page=home">
                                    <img class="p-2" src="goldorak/img/avatar/avatar_goldorak_01.webp" alt="icone du bouton goldorak" style="width:30px;">    
                                    Goldorak
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item Nav_Span1" href="garageparrot/index.php?page=home">
                                    <img class="p-2" src="GarageParrot\img\icon\garage_black_75x75.png" alt="icone du bouton garage parrot" style="width:30px;">    
                                    Garage Parrot
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item custom-border-md-bottom">
                        <a class="nav-link" aria-current="page" href="tel:0608818390">
                            <img class="p-2 h-75" src="img/icon/black_telephone.svg" alt="icone du bouton s'identifier">
                            <span class="Nav_Span1">Contact<br><span class="Nav_Span2">06.08.81.83.90</span></span>
                        </a>
                    </li>
                    
                    <li class="nav-item dropdown custom-border-md-bottom">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <!-- <img class="p-2 h-75" src="img/icon/<?php //echo $_SESSION['avatarConnect']; ?>" alt="icone du menu s'identifier"> -->
                            <img class="p-2 h-75" src="img/avatar/<?php echo htmlspecialchars($_SESSION['avatarConnect'], ENT_QUOTES, 'UTF-8'); ?>" alt="icone du menu s'identifier">

                            <span class="Nav_Span1">Mon compte<br><span class="Nav_Span2"><?php if($_SESSION['pseudoConnect'] != 'Guest'){echo 'Hello ' . $_SESSION['pseudoConnect'] . ' !';}else{echo 'Hello Guest !';} ?></span></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item Nav_Span1" href="index.php?page=connexion">
                                    <img class="p-2" src="img/icon/login_25x25.png" alt="icone du bouton s'identifier">    
                                    S'identifier
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item Nav_Span1" href="index.php?page=disconnect">
                                    <img class="p-2" src="img/icon/logout_25x25.png" alt="icone du bouton s'identifier">    
                                    Déconnexion
                                </a>
                            </li>
                        </ul>
                    </li>

                </ul>

            </div>

        </div>

    </nav>

</div>