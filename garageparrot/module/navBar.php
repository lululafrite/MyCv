<?php include_once('../../common/utilies.php'); ?>

<div class="d-flex justify-content-between bg-body-tertiary py-2">

    <div class="text-center my-auto">
        <a href="index.php?page=home">
            <img class="img-fluid px-2" src="img/logo/Logo_Garage_Parrot_250x70_Dark.png" alt="logo du garage parrot">
        </a>
    </div>

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
                            <img class="p-2 h-75" src="img/icon/house.svg" alt="icone du bouton s'identifier">
                            Accueil
                        </a>
                    </li>
                    <?php
                    if ($_SESSION['typeConnect'] === "Administrator")
                    {
                    ?>
                    <li class="nav-item dropdown custom-border-md-bottom">

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img class="p-2 h-75" src="img/icon/people.svg" alt="icone du bouton s'identifier">    
                                Profils
                            </a>
                            <ul class="dropdown-menu">
                                <li>    
                                    <a class="dropdown-item Nav_Span1" href="index.php?page=userBtn">
                                        <img class="p-2 h-75" src="img/icon/search.svg" alt="icone du bouton s'identifier">
                                        Profils
                                    </a>
                                </li>
                                <li>
                                    <form action="index.php?page=user_edit" method="post">

                                        <!-- input hidden csrf -->
                                        <input type="hidden" name="tokenCsrf" value="<?php echo $_SESSION['tokenCsrf'];?>">

                                        <button class="dropdown-item Nav_Span1" id="nav_new_user" name="nav_new_user" type="submit">
                                            <img class="p-2 h-75" src="img/icon/person-plus.svg" alt="icone du bouton s'identifier">
                                            Nouveau
                                        </button>

                                    </form>
                                </li>
                            </ul>
                        </li>
                    </li>
                    <?php
                    }
                    if ($_SESSION['typeConnect'] ==="Administrator" || $_SESSION['typeConnect'] === "User" || $_SESSION['typeConnect'] ==="Guest")
                    {
                    ?>
                    <li class="nav-item dropdown custom-border-md-bottom">

                        <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img class="p-2 h-75" src="img/icon/car-icon_71x75.png" alt="icone du bouton s'identifier">    
                            <span class="Nav_Span1">Nos véhicules<br><span class="Nav_Span2">d'occasions</span></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li>    
                                <a class="dropdown-item Nav_Span1" href="index.php?page=carBtn">
                                    <img class="p-2 h-75" src="img/icon/car-front.svg" alt="icone du bouton s'identifier">
                                    Nos occasions
                                </a>
                            </li>
                    <?php
                    }
                    if ($_SESSION['typeConnect'] ==="Administrator" || $_SESSION['typeConnect'] ==="User")
                    {
                    ?>
                            <form action="index.php?page=car_edit" method="post">

                                <!-- input hidden csrf -->
                                <input type="hidden" name="tokenCsrf" value="<?php echo $_SESSION['tokenCsrf'];?>">

                                <li>
                                    <button class="dropdown-item Nav_Span1" id="nav_new_car" name="nav_new_car" type="submit">
                                        <img class="p-2" src="img/icon/car-front-fill.svg" alt="icone du bouton s'identifier">
                                        Nouveau
                                    </button>
                                </li>

                            </form>
                    <?php
                    }
                    ?>
                            
                    </ul>

                    </li>

                    <li class="nav-item dropdown custom-border-md-bottom">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img class="p-2 h-75" src="img/icon/geo-alt.svg" alt="icone du bouton s'identifier">
                            <span class="Nav_Span1">Accéder<br><span class="Nav_Span2">sur notre site</span></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <iframe
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2630.24423898798!2d1.9261959762272913!3d48.75813197131868!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e6833bfca28e57%3A0x21655bf96adbbf29!2s1%20Rue%20Marie%20Curie%2C%2078310%20Maurepas!5e0!3m2!1sfr!2sfr!4v1706091603720!5m2!1sfr!2sfr"
                                    width="300"
                                    height="225"
                                    style="border:0;"
                                    allowfullscreen=""
                                    loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade"
                                >
                                </iframe>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item custom-border-md-bottom">
                        <a class="nav-link" aria-current="page" href="tel:0608818390">
                            <img class="p-2 h-75" src="img/icon/telephone.svg" alt="icone du bouton s'identifier">
                            <span class="Nav_Span1">Contact<br><span class="Nav_Span2">06.08.81.83.90</span></span>
                        </a>
                    </li>

                    <li class="nav-item dropdown custom-border-md-bottom">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <!-- <img class="p-2 h-75" src="img/icon/person.svg" alt="icone du menu s'identifier"> -->
                            <img class="p-2 h-75" src="img/avatar/<?php echo htmlspecialchars($_SESSION['avatarConnect'], ENT_QUOTES, 'UTF-8'); ?>" alt="icone du menu s'identifier">
                            <span class="Nav_Span1">Mon compte<br><span class="Nav_Span2"><?php if($_SESSION['pseudoConnect']!= 'Guest'){echo 'Hello ' . $_SESSION['pseudoConnect'] . ' !';}?></span></span>
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