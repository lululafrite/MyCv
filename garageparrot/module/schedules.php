<?php
    include('../../garageparrot/controller/schedules.controller.php');
?>

<table class="table table-dark table-bordered fs-4">
    <thead>
        <tr>
            <td colspan="3" class="text-center fs-4">Horaires d'ouverture</td>
        </tr>
        <tr>
            <th class="text-center fs-4">Jour</th>
            <th class="text-center fs-4">Matin</th>
            <th class="text-center fs-4">Après-midi</th>
        </tr>
    <thead>
    <tbody>
        <form action="../" method="post">
            <tr class="table-active">
                <td class="fs-4" style="text-align: right;">Lundi</td>
                <td class="text-center">
                    <input class="form-control fs-4 <?php if($_SESSION['typeConnect'] != 'Administrator'){echo 'bg-transparent text-light';} ?> text-center border border-0" id="txt_shedules_lundiMatin" name="txt_shedules_lundiMatin" type="text" <?php if($_SESSION['typeConnect'] != 'Administrator'){echo 'readonly';} ?> value="<?php echo $horaires[0]['lundiMatin']; ?>">
                </td>    
                <td class="text-center">
                    <input class="form-control fs-4 <?php if($_SESSION['typeConnect'] != 'Administrator'){echo 'bg-transparent text-light';} ?> text-center border border-0" id="txt_shedules_lundiAM" name="txt_shedules_lundiAM" type="text" <?php if($_SESSION['typeConnect'] != 'Administrator'){echo 'readonly';} ?> value="<?php echo $horaires[0]['lundiAM']; ?>">
                </td>
            </tr>
            <tr class="table-active">
                <td class="fs-4" style="text-align: right;">Mardi</td>
                <td class="text-center">
                    <input class="form-control fs-4 <?php if($_SESSION['typeConnect'] != 'Administrator'){echo 'bg-transparent text-light';} ?> text-center border border-0" id="txt_shedules_mardiMatin" name="txt_shedules_mardiMatin" type="text" <?php if($_SESSION['typeConnect'] != 'Administrator'){echo 'readonly';} ?> value="<?php echo $horaires[0]['mardiMatin']; ?>">
                </td>    
                <td class="text-center">
                    <input class="form-control fs-4 <?php if($_SESSION['typeConnect'] != 'Administrator'){echo 'bg-transparent text-light';} ?> text-center border border-0" id="txt_shedules_mardiAM" name="txt_shedules_mardiAM" type="text" <?php if($_SESSION['typeConnect'] != 'Administrator'){echo 'readonly';} ?> value="<?php echo $horaires[0]['mardiAM']; ?>">
                </td>
            </tr>
            <tr class="table-active">
                <td class="fs-4" style="text-align: right;">Mercredi</td>
                <td class="text-center fs-4">
                    <input class="form-control fs-4 <?php if($_SESSION['typeConnect'] != 'Administrator'){echo 'bg-transparent text-light';} ?> text-center border border-0" id="txt_shedules_mercrediMatin" name="txt_shedules_mercrediMatin" type="text" <?php if($_SESSION['typeConnect'] != 'Administrator'){echo 'readonly';} ?> value="<?php echo $horaires[0]['mercrediMatin']; ?>">
                </td>    
                <td class="text-center fs-4">
                    <input class="form-control fs-4 <?php if($_SESSION['typeConnect'] != 'Administrator'){echo 'bg-transparent text-light';} ?> text-center border border-0" id="txt_shedules_mercrediAM" name="txt_shedules_mercrediAM" type="text" <?php if($_SESSION['typeConnect'] != 'Administrator'){echo 'readonly';} ?> value="<?php echo $horaires[0]['mercrediAM']; ?>">
                </td>
            </tr>
            <tr class="table-active">
                <td class="fs-4" style="text-align: right;">Jeudi</td>
                <td class="text-center">
                    <input class="form-control fs-4 <?php if($_SESSION['typeConnect'] != 'Administrator'){echo 'bg-transparent text-light';} ?> text-center border border-0" id="txt_shedules_jeudiMatin" name="txt_shedules_jeudiMatin" type="text" <?php if($_SESSION['typeConnect'] != 'Administrator'){echo 'readonly';} ?> value="<?php echo $horaires[0]['jeudiMatin']; ?>">
                </td>    
                <td class="text-center">
                    <input class="form-control fs-4 <?php if($_SESSION['typeConnect'] != 'Administrator'){echo 'bg-transparent text-light';} ?> text-center border border-0" id="txt_shedules_jeudiAM" name="txt_shedules_jeudiAM" type="text" <?php if($_SESSION['typeConnect'] != 'Administrator'){echo 'readonly';} ?> value="<?php echo $horaires[0]['jeudiAM']; ?>">
                </td>
            </tr>
            <tr class="table-active">
                <td class="fs-4" style="text-align: right;">Vendredi</td>
                <td class="text-center">
                    <input class="form-control fs-4 <?php if($_SESSION['typeConnect'] != 'Administrator'){echo 'bg-transparent text-light';} ?> text-center border border-0" id="txt_shedules_vendrediMatin" name="txt_shedules_vendrediMatin" type="text" <?php if($_SESSION['typeConnect'] != 'Administrator'){echo 'readonly';} ?> value="<?php echo $horaires[0]['vendrediMatin']; ?>">
                </td>    
                <td class="text-center">
                    <input class="form-control fs-4 <?php if($_SESSION['typeConnect'] != 'Administrator'){echo 'bg-transparent text-light';} ?> text-center border border-0" id="txt_shedules_vendrediAM" name="txt_shedules_vendrediAM" type="text" <?php if($_SESSION['typeConnect'] != 'Administrator'){echo 'readonly';} ?> value="<?php echo $horaires[0]['vendrediAM']; ?>">
                </td>
            </tr>
            <tr class="table-active">
                <td class="fs-4" style="text-align: right;">Samedi</td>
                <td class="text-center">
                    <input class="form-control fs-4 <?php if($_SESSION['typeConnect'] != 'Administrator'){echo 'bg-transparent text-light';} ?> text-center border border-0" id="txt_shedules_samediMatin" name="txt_shedules_samediMatin" type="text" <?php if($_SESSION['typeConnect'] != 'Administrator'){echo 'readonly';} ?> value="<?php echo $horaires[0]['samediMatin']; ?>">
                </td>    
                <td class="text-center">
                    <input class="form-control fs-4 <?php if($_SESSION['typeConnect'] != 'Administrator'){echo 'bg-transparent text-light';} ?> text-center border border-0" id="txt_shedules_samediAM" name="txt_shedules_samediAM" type="text" <?php if($_SESSION['typeConnect'] != 'Administrator'){echo 'readonly';} ?> value="<?php echo $horaires[0]['samediAM']; ?>">
                </td>
            </tr>
            <tr class="table-active">
                <td class="fs-4" style="text-align: right;">Dimanche</td>
                <td class="text-center">
                    <input class="form-control fs-4 <?php if($_SESSION['typeConnect'] != 'Administrator'){echo 'bg-transparent text-light';} ?> text-center border border-0" id="txt_shedules_dimancheMatin" name="txt_shedules_dimancheMatin" type="text" <?php if($_SESSION['typeConnect'] != 'Administrator'){echo 'readonly';} ?> value="<?php echo $horaires[0]['dimancheMatin']; ?>">
                </td>    
                <td class="text-center">
                    <input class="form-control fs-4 <?php if($_SESSION['typeConnect'] != 'Administrator'){echo 'bg-transparent text-light';} ?> text-center border border-0" id="txt_shedules_dimancheAM" name="txt_shedules_dimancheAM" type="text" <?php if($_SESSION['typeConnect'] != 'Administrator'){echo 'readonly';} ?> value="<?php echo $horaires[0]['dimancheAM']; ?>">
                </td>
            </tr>
            <?php
            if($_SESSION['typeConnect'] === 'Administrator'){
            ?>
                <tr class="table-active">
                    <td colspan="3" class="text-center">
                        <button class="btn btn-lg btn-primary fs-4" type="submit" id="bt_schedules" name="bt_schedules">Enregistrer</button>
                    </td>
                </tr>
            <?php
            }
            ?>
        </form>
    </tbody>
</table>
