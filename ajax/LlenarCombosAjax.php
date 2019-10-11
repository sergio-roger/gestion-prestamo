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
        // $data['entidad'] = 'intereses';

        if($type == 'all'){
            $intereses = $interesController->all();

            while($row = $intereses->fetch(PDO::FETCH_ASSOC)){
                $data['intereses'][] = $row;
            }
        }
    }
    else if($entidad == 'plazos'){
        include '../controllers/PlazoController.php';
        $plazoController = new PlazoController();
        $periodo = $datos->{'modo'};

        if($type == 'all'){
            $plazos = $plazoController->getPlazo($periodo);

           while($row = $plazos->fetch(PDO::FETCH_ASSOC)){
                $data['plazos'][] = $row;
           }
        }
    }
    else if($entidad == 'estatus'){
        include '../controllers/EstatusController.php';
        $estatusController = new EstatusController();

        if($type = 'all'){
            $estatus = $estatusController->all();

            while($row = $estatus->fetch(PDO::FETCH_ASSOC)){
                $data['estatus'][] = $row;
            }
        }
    }

    $data = $helper->utf8ize($data);
}

$peticionAjax = false;
echo json_encode($data);