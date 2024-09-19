<?php include('../../controller/connexion.controller.php'); ?>

<div class="container">

    <div class="row">
        
        <div class="d-flex flex-column justify-content-center align-items-center">

            <form
                class="bg-dark bg-opacity-75 m-5 p-5 rounded-4"
                action="index.php?page=connexion"
                method="post"
            >
                
                <fieldset class="">
                    
                    <legend class="text-center fs-1 text-light mb-3" >Connexion</legend>

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

                    <div class="form-group mt-5 mb-3">

                        <input
                            class="btn btn-lg btn-primary fs-3"
                            type="submit"
                            name="envoyer"
                            id="envoyer"
                            value="Se connecter"
                        >

                    </div>

                </fieldset>

                <?php
                    if($_SESSION['message'] != ''){
                ?>
                    <div classe='text-center' style='color:red; text-align:center; margin:auto;'>
                        <?php echo htmlspecialchars_decode($_SESSION['message']); ?>
                    </div>
                <?php
                        $_SESSION['message'] = '';
                    }
                ?>

                <div><a href="index.php?page=connexion">Mot de passe oublié ?</a></div>

            </form>
            
        </div>

    </div>

</div>