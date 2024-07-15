<?php
    include('../../garageparrot/controller/comment.controller.php');
?>

<div class="col-12 bg-dark d-flex justify-content-center text-light mx-auto mb-3 rounded-3">
    <h2 class="px-0 py-3 m-0">Votre avis nous intéresse</h2>
</div>

<div class="container d-flex justify-content-center">

    <div class="row">

        <div class="col-12 col-lg-5 mx-0 px-0 mb-md-3">

            <table class="table table-dark table-bordered p-0 m-0">

                <thead>

                    <tr>

                        <td colspan="2" class="text-center">
                            Commentez votre expérience
                        </td>

                    </tr>

                </thead>

                <form action="" method="post">
                    
                    <!-- input hidden csrf -->
                    <input type="hidden" name="tokenCsrf" value="<?php echo $_SESSION['tokenCsrf'];?>">

                    <tbody>

                        <tr class="table-active">

                            <td class="text-end">
                                <label class="form-label" for="comment_name">Pseudo</label>
                            </td>

                            <td>
                                <input
                                    class="form-control fs-4"
                                    type="text"
                                    id="txt_comment_pseudo"
                                    name="txt_comment_pseudo"
                                    placeholder="Saisissez votre pseudonyme"
                                >
                            </td>

                        </tr>

                        <tr class="table-active">

                            <td class="text-end">
                                <label class="form-label" for="comment_description">Description</label>
                            </td>

                            <td>
                                <textarea
                                    class="form-control fs-4"
                                    name="txt_comment_comment"
                                    id="txt_comment_comment"
                                    rows="3"
                                    placeholder="Saisissez votre commentaire"
                                ></textarea>
                            </td>

                        </tr>

                        <tr class="table-active">

                            <td colspan="2">

                                <div class="container mt-5 text-center">

                                    <span>Cliquez sur une étoile pour évaluer votre expérience</span>

                                    <div class="rating" onclick="handleRating(event)">

                                        <i class="fas fa-star" data-rating="1"></i>
                                        <i class="fas fa-star" data-rating="2"></i>
                                        <i class="fas fa-star" data-rating="3"></i>
                                        <i class="fas fa-star" data-rating="4"></i>
                                        <i class="fas fa-star" data-rating="5"></i>
                                    
                                    </div>

                                    <div class="d-flex justify-content-center align-items-center">

                                        <label class="me-3" for="selectedRating">Votre note : </label>
                                        
                                        <input
                                            class="bg-transparent text-light"
                                            type="text" id="selectedRating"
                                            name="selectedRating"
                                            style="text-align: left; width:15px;"
                                            readonly
                                            value="1"
                                        >
                                        
                                        <label class="me-3" for="selectedRating">/ 5</label>

                                    </div>

                                </div>

                            </td>

                        </tr>

                        <tr>

                            <td class="text-center" colspan="2">
                                
                                <button
                                    class="btn btn btn-primary fs-4"
                                    type="submit"
                                    id="bt_save_comment"
                                    name="bt_save_comment"
                                >Envoyer</button>

                            </td>

                        </tr>
                        
                    </tbody>

                </form>

            </table>

        </div>

        <div class="col-12 col-lg-5 ms-auto me-0 px-0 pt-3 pt-sm-0">

            <div class="col-12 bg-dark d-flex justify-content-center text-light py-3 mx-0 px-0 rounded-3">
                Commentaires de nos clients
            </div>

            <div class="overflow-auto p-0 m-0" style="max-height: 280px;">

                <div class="container">

                    <div class="row">

                    <?php
                     for($i=0;$i != count($Comment);$i++){ 
                    ?>
                        <div class="col-12 px-0">

                            <div class="card">

                                <form action="" method="post">
                                    
                                <!-- input hidden csrf -->
                                <input type="hidden" name="tokenCsrf" value="<?php echo $_SESSION['tokenCsrf'];?>">

                                    <div class="card-header fs-4">

                                        <div class="d-flex justify-content-between">

                                            <div class="d-none">
                                                
                                                <input
                                                    type="text"
                                                    id="txt_comment_id"
                                                    name="txt_comment_id"
                                                    readonly
                                                    value="<?php echo escapeInput($Comment[$i]['id_comment']); ?>"
                                                >

                                            </div>

                                            <input
                                                type="text"
                                                readonly
                                                value="<?php echo escapeInput($Comment[$i]['pseudo']); ?>"
                                            >

                                            <input
                                                type="text"
                                                style="text-align: center;"
                                                readonly
                                                value="Date : <?php echo escapeInput($Comment[$i]['date_']); ?>"
                                            >

                                            <input
                                                type="text"
                                                style="text-align: right;"
                                                readonly
                                                value=" note : <?php echo escapeInput($Comment[$i]['rating']); ?>/5"
                                            >
                                        
                                        </div>

                                    </div>

                                    <div class="card-body">

                                        <blockquote class="blockquote mb-0 fs-4">

                                            <textarea
                                                readonly
                                                rows="2"
                                            ><?php echo escapeInput($Comment[$i]['comment']); ?></textarea>
                                        
                                        </blockquote>

                                    </div>

                                    <?php
                                    if($_SESSION['typeConnect'] != 'Guest'){
                                    ?>

                                        <div class="card-footer">

                                            <button
                                                class="btn btn-lg btn-primary"
                                                type="submit"
                                                id="bt_comment_delete"
                                                name="bt_comment_delete"
                                            >Supprimer</button>
                                        
                                        </div>

                                    <?php
                                    }
                                    ?>

                                </form>

                            </div>

                        </div>

                    <?php
                     }
                    ?>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<script>

    function handleRating(event){
      
        if (event.target.tagName === 'I'){
            // Récupérer la valeur de data-rating
            var ratingValue = event.target.getAttribute('data-rating');

            // Mettre à jour la valeur du champ de texte
            document.getElementById('selectedRating').value = ratingValue;

            // Réinitialiser les classes "active" pour toutes les étoiles
            var stars = document.querySelectorAll('.rating i');

            stars.forEach(function(star){

                star.classList.remove('active');

            });

            // Ajouter la classe "active" pour les étoiles jusqu'à la note sélectionnée
            for (var i = 0; i < ratingValue; i++){

                stars[i].classList.add('active');

            }

        }

    }

  </script>