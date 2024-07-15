<?php
    include('../../garageparrot/model/schedules.class.php');
    $scheldules_ = new Schedules();
    if(isset($_POST['bt_schedules'])){
        
        $scheldules_->setLundiMatin($_POST['txt_shedules_lundiMatin']);
        $scheldules_->setLundiAM($_POST['txt_shedules_lundiAM']);
        $scheldules_->setMardiMatin($_POST['txt_shedules_mardiMatin']);
        $scheldules_->setMardiAM($_POST['txt_shedules_mardiAM']);
        $scheldules_->setMercrediMatin($_POST['txt_shedules_mercrediMatin']);
        $scheldules_->setMercrediAM($_POST['txt_shedules_mercrediAM']);
        $scheldules_->setJeudiMatin($_POST['txt_shedules_jeudiMatin']);
        $scheldules_->setJeudiAM($_POST['txt_shedules_jeudiAM']);
        $scheldules_->setVendrediMatin($_POST['txt_shedules_vendrediMatin']);
        $scheldules_->setVendrediAM($_POST['txt_shedules_vendrediAM']);
        $scheldules_->setSamediMatin($_POST['txt_shedules_samediMatin']);
        $scheldules_->setSamediAM($_POST['txt_shedules_samediAM']);
        $scheldules_->setDimancheMatin($_POST['txt_shedules_dimancheMatin']);
        $scheldules_->setDimancheAM($_POST['txt_shedules_dimancheAM']);

        $scheldules_->updateSchedules(1);
    }
    $horaires = $scheldules_->get(1,'id_schedules','ASC','0','2');
?>