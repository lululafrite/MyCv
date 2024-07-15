<div class="d-flex flex-column flex-sm-row">

    <div class="me-2">

    <?php if($_SESSION['typeConnect'] === 'Administrator'){ ?>
        <button type="submit" class="btn btn-lg btn-warning fs-4 mb-2 mb-md-0" id="bt_userEdit_cancel" name="bt_userEdit_cancel" style="width: 100px;" onclick="retour();">Retour</button>
    <?php } ?>
    
        <input class="btn btn-lg btn-success fs-4 mb-2 mb-md-0" type="button" name="bt_userEdit_save" id="bt_userEdit_save" style="width: 100px;" value="Enregistrer">
    
    </div>

<?php if($_SESSION['typeConnect'] != 'Administrator' && $_SESSION['typeConnect'] != 'Guest'){ ?>
    <div>

        <input class="btn btn-lg btn-danger fs-4 mb-2 mb-md-0" type="button" name="bt_userEdit_delete" id="bt_userEdit_delete" style="width: 100px;" value="Supprimer mon compte">
    
    </div>
<?php } ?>

<?php if($_SESSION['typeConnect'] === 'Administrator'){ ?>
    <div>

        <input class="btn btn-lg btn-info fs-4 mb-2 mb-md-0" type="button" name="bt_userEdit_new" id="bt_userEdit_new" style="width: 100px;" value="Nouveau">
        <input class="btn btn-lg btn-danger fs-4 mb-2 mb-md-0" type="button" name="bt_userEdit_delete" id="bt_userEdit_delete" style="width: 100px;" value="Supprimer">
    
    </div>
<?php } ?>

</div>