<?php

include '../core/config.php';
include '../core/Helper.php';

$peticionAjax = true;
$data = [];

if(isset($_GET['data'])){

    $helper = new Helper();
    $datos = json_decode($_GET['data']);
    $type = $datos->{'type'};
    $entidad = $datos->{'entidad'};
   
    $data['result'] = 'true';
    
    //Ejecutar peticiones para los clientes
    if($entidad == 'montos'){
        include '../controllers/MontoController.php';
        $montoController = new MontoController();
        $data['entidad'] = 'montos';
        //echo json_encode($dataMonto);

        if($type == 'all'){
            $montos = $montoController->all();

            while($row = $montos->fetch(PDO::FETCH_ASSOC)){
                $data['montos'][] = $row;
            }
        } 
    }
    else if($entidad == 'intereses'){
        include '../controllers/InteresController.php';
        $interesController= new InteresController();
        $data['entidad'] = 'intereses';

        if($type == 'all'){
            $intereses = $interesController->all();

            while($row = $intereses->fetch(PDO::FETCH_ASSOC)){
                $data['intereses'][] = $row;
            }
        }
    }
    
    $data = $helper->utf8ize($data);
}

echo json_encode($data);
$peticionAjax = false;