<?php

$peticionAjax = true;

include_once '../core/config.php';
include_once '../core/Helper.php';
include_once '../controllers/CuotaController.php';
include_once '../controllers/PrestamoController.php';

$response = [];
$method = $_SERVER['REQUEST_METHOD']; 
$helper = new Helper();
$prestamoController = new PrestamoController();
$cuotaController = new CuotaController();


switch($method){
    case 'POST':
        if(isset($_POST['data'])){    
            $data = json_decode($_POST['data']);
            $tipo =  $data->{'type'};

            switch($tipo){
                case 'insert':
                    //  1.- Insertar Cuota
                    $response['result'] =  $cuotaController->insert();
                    $response['msj'] = 'Cuota insertada con éxito';
                    
                    // 2.- Obtener Total Pagado del préstamo
                    $cuota = $data->{'cuota'};
                    $cuota = (array)$cuota;
                    $presPagadoActual = (float)$cuotaController->getPrestamoPagado($cuota['pres_id']);

                    // 3.- Suma lo que tiene pagado en prestamo mas la cuota actual
                    $presPagado = (float) $cuota['cuo_valor_pago'] + $presPagadoActual;
                    $response['pagado'] = $presPagado; 

                    //4.- Actualizar el campo pres_pagado del Préstamo
                    $response['estadoPagado'] = $prestamoController->updatePagado($cuota['pres_id'], $presPagado);

                    //5.- Actualizar el estado si es inicial a Pagando 
                    $objPrestamo = $prestamoController->getPrestamo($cuota['pres_id']);
                    if((int)$objPrestamo['est_id'] == 1){
                        $response['estadoEstatus'] = $prestamoController->updateEstatus($cuota['pres_id'], 2);
                    }

                    //6.-Actualizar el estado de prestamo a Pagado cuando cuo_saldo_actual
                    if((float)$cuota['cuo_saldo_actual'] > 0){
                        $response['prestamoTerminado'] = false;
                    }elseif((float)$cuota['cuo_saldo_actual'] == 0){
                        $response['prestamoTerminado'] = true;
                        $prestamoController->updateEstatus($cuota['pres_id'], 3);
                    }

                    // var_dump($prestamo);
                    break;
           
                }

        }else{
            $response['result'] = 'false';
        }
        break;
    
    case 'GET':
        if(isset($_GET['data'])){
            $data = json_decode($_GET['data']);
            $tipo = $data->{'type'};
            $idPrestamo = $data->{'idPrestamo'};
            
            switch($tipo){
                case 'getCuotasPrestamo':
                    $response['cuotas'] = $cuotaController->getCuotasByPrestamo($idPrestamo);
                    $response['result'] = true;
                    break;
            }
        }
        break;
    
}

$peticionAjax = false;
echo json_encode($response);