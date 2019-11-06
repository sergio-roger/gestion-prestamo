<?php

$peticionAjax = true;

include_once '../core/config.php';
include_once '../core/Helper.php';
include_once '../controllers/NegocioController.php';

$response = [];
$method = $_SERVER['REQUEST_METHOD']; 
$helper = new Helper();
$tipoMovimiento = new NegocioController();

switch($method){
    case 'POST':
        break;
    
    case 'GET':
        if(isset($_GET['data'])){
            $data = json_decode($_GET['data']);
            $tipo = $data->{'type'};
            
            switch($tipo){
                case 'all':
                    $response['tipoMovimientos'] = $tipoMovimiento->all();
                    $response['result'] = true;
                    break;
                
                case 'one':
                    // $id = $data->{'id'};
                    // $response['result'] = true;
                    // $response['cuota'] = $cuotaController->getCuota($id);
                    break;
            }
        }
        break;
}

$peticionAjax = false;
echo json_encode($response);