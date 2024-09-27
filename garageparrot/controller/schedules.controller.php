<?php

    include('../../garageparrot/model/schedules.class.php');
    
    use GarageParrot\Model\Schedules;

    $scheldule = new Schedules();
    
    if(isset($_POST['bt_schedules'])){
        
        $scheldule->setLundiMatin($_POST['txt_shedules_lundiMatin']);
        $scheldule->setLundiAM($_POST['txt_shedules_lundiAM']);
        $scheldule->setMardiMatin($_POST['txt_shedules_mardiMatin']);
        $scheldule->setMardiAM($_POST['txt_shedules_mardiAM']);
        $scheldule->setMercrediMatin($_POST['txt_shedules_mercrediMatin']);
        $scheldule->setMercrediAM($_POST['txt_shedules_mercrediAM']);
        $scheldule->setJeudiMatin($_POST['txt_shedules_jeudiMatin']);
        $scheldule->setJeudiAM($_POST['txt_shedules_jeudiAM']);
        $scheldule->setVendrediMatin($_POST['txt_shedules_vendrediMatin']);
        $scheldule->setVendrediAM($_POST['txt_shedules_vendrediAM']);
        $scheldule->setSamediMatin($_POST['txt_shedules_samediMatin']);
        $scheldule->setSamediAM($_POST['txt_shedules_samediAM']);
        $scheldule->setDimancheMatin($_POST['txt_shedules_dimancheMatin']);
        $scheldule->setDimancheAM($_POST['txt_shedules_dimancheAM']);

        $scheldule->updateSchedules(1);
    }
    $horaires = $scheldule->getSchedule(1);
?>