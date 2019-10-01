<?php

include '../core/config.php';

$peticionAjax = true;
$data = [];

if(isset($_GET['data'])){

    $datos = json_decode($_GET['data']);
    $type = $datos->{'type'};
    $entidad = $datos->{'entidad'};
    
    //Ejecutar peticiones para los clientes
    if($entidad == 'clientes'){
        include '../controllers/ClienteController.php';
        $clienteController = new ClienteController();

        if($type == 'count'){
            $data['total'] = $clienteController->count();
        }
        else if($type == 'all'){
            //$data['consulta'] = $datos;
            $clientes = $clienteController->all();

            while($row = $clientes->fetch(PDO::FETCH_ASSOC)){
                $data['clientes'][] = $row;
            }
        }
        
        $data['result'] = true;
        echo json_encode($data);

    }
}
else{
    $data['result'] = false;
    echo json_encode($data);
}

$peticionAjax = false;