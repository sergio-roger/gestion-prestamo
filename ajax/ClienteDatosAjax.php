<?php

include '../core/config.php';

$peticionAjax = true;
$data = [];

if(isset($_POST['data'])){
    include '../controllers/ClienteController.php';
    $clienteController = new ClienteController();

    $datos = json_decode($_POST['data']);
    $type = $datos->{'type'};
    
    if($type == 'save'){
        $cliente = (array)$datos->{'cliente'};
        $respuesta = $clienteController->insert($cliente);
        //$data['result'] = true;
        //var_dump($cliente);
        $data['result'] = $respuesta; 
    }
    else if($type == 'update'){
        $id = $datos->{'id'};
        $cliente = (array)$datos->{'cliente'};
        $respuesta = $clienteController->update($id, $cliente);
        $data['result'] = $respuesta;
    }
    else if($type == 'delete'){
        $id = $datos->{'id'};
        $respuesta = $clienteController->delete($id);
        $data['result'] = 'true'; 
        $data['text'] = 'Cliente eliminado';
        $data['value']= $id;
    }
    elseif($type == 'one'){
        $id = $datos->{'id'};
        $cliente = $clienteController->getCliente($id);

        $data['result'] = 'true';
        $data['cliente'] = $cliente;
    }

    $data['msj'] = 'Datos procesados';
    echo json_encode($data);
    //echo 'Debe guardar datos';
}
else if(!isset($_POST['data'])){
    $data['result'] = false; 
    $data['msj'] = 'No esta definido el parametro post';
    echo json_encode($data);
}
else
{
    $data['result'] = false;
    $data['msj'] = 'Ha fallado la solicitud';
    header('Location:'.BASE.'login');

    //echo 'Debe retornar una respuesta vacia';
}
$peticionAjax = false;