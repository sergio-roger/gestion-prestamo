<?php
    include_once 'core/config.php';
    include_once 'controllers/MasterController.php';

    //Incluir la vista master.php
    $master = new MasterController();
    $master->index();
