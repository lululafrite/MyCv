<?php
    
    $current_url = $_SERVER['REQUEST_URI'];
    $goldorak = '/goldorak/';
    $garageParrot = '/garageparrot/';

    if(preg_match($goldorak, $current_url) || preg_match($garageParrot, $current_url)){

        include('../../controller/connexion.controller.php');

    }else{

        include('../controller/connexion.controller.php');

    }
    
?>

<div class="container">

    <div class="row">
        
        <div class="d-flex flex-column justify-content-center align-items-center">

            <form
                action="index.php?page=connexion"
                method="post"
            >
                
                <fieldset class="bg-dark bg-opacity-75 rounded-4 p-5">
                    
                    <legend class="text-center text-light mb-3" >Connexion</legend>

                    <div class="form-group mb-3">

                        <label class="text-light w-100" for="email">email</label>

                        <input
                            class=""
                            type="email"
                            id="email"
                            name="email"
                            placeholder="Saisissez votre email"
                        >

                    </div>

                    <div class="form-group mb-3">

                        <label class="text-light w-100" for="password">mot de passe</label>

                        <input
                            class=""
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Saisissez votre mot de passe"
                        >

                    </div>

                    <div class="form-group my-5">

                        <input
                            class="btn btn-lg btn-primary"
                            type="submit"
                            name="envoyer"
                            id="envoyer"
                            value="Se connecter"
                        >

                    </div>

                </fieldset>

                <div style='color:red;'>
                    <p class=" text-center fs-2 pt-3"> <?php echo htmlspecialchars_decode($_SESSION['other']['message']); ?> </p>
                </div>

                <div class="d-flex justify-content-center pb-5"><a href="index.php?page=connexion">Mot de passe oublié ?</a></div>

            </form>

        </div>

    </div>

</div>