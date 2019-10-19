<?php
$peticionAjax = true;

include_once '../core/config.php';
include_once '../core/Helper.php';
include_once '../controllers/PrestamoController.php';

$response = [];
$method = $_SERVER['REQUEST_METHOD']; 
$helper = new Helper();
$prestamoController = new PrestamoController();

if($method == 'POST'){
    if(isset($_POST['data'])){
    
        $data = json_decode($_POST['data']);
    
        // Realizar la insercción del nuevo préstamo
        if($data->{'type'} == 'insert'){
            $response['result'] = 'true';
            $response['estado'] =  $prestamoController->insert();
            $response['msj'] = 'Prestamo insertado con éxito';
            // var_dump($prestamo);
        }  
    }
}
elseif($method == 'GET'){
    // echo '<h1>Hola</h1>';
    $response['result'] = 'true';

    if(isset($_GET['data'])){
        $data = json_decode($_GET['data']);

        if($data->{'type'} == 'all'){
            $prestamos = $prestamoController->getAllPersonalizado();

            while($row = $prestamos->fetch(PDO::FETCH_ASSOC)){
                $response['prestamos'][] = $row;
            }
            // $response['prestamos'] = $prestamos;
        }
        elseif($data->{'type'} == 'allHide'){
            $prestamos = $prestamoController->getPrestamosOcultos();

            while($row = $prestamos->fetch(PDO::FETCH_ASSOC)){
                $response['prestamos'][] = $row;
            }
        }
        elseif($data->{'type'} == 'count'){
            $total = $prestamoController->count()->fetch(PDO::FETCH_ASSOC);
            $response['total'] = $total['cantidad'];
        }
        else if($data->{'type'} == 'delete'){
            $id = $data->{'id'};
            $respuesta = $prestamoController->delete($id);
            $response['text'] = 'Cliente eliminado';
            // $response['value']= $id;
        }
        elseif($data->{'type'} == 'hide'){
            $id = $data->{'id'};
            $respuesta = $prestamoController->hide($id);
            $response['text'] = 'Préstamo Oculto';
            $response['result'] = $respuesta;
        }
        elseif($data->{'type'} == 'show'){
            $id = $data->{'id'};
            $respuesta = $prestamoController->show($id);
            $response['text'] = 'Préstamo Oculto';
            $response['result'] = $respuesta;
        }
        elseif($data->{'type'} == 'one'){
            $id = $data->{'id'};
            $prestamo = $prestamoController->getPrestamo($id);
            $response['prestamo'] = $prestamo;
        }
        elseif($data->{'type'} == 'onePrestamo'){
            $id = $data->{'id'};
            $prestamo = $prestamoController->getPrestamoInfo($id);
            $response['prestamo'] = $prestamo->fetch(PDO::FETCH_ASSOC);
            // $response['text'] = 'Llamar al procedimiento almacenado';
        }
    }
}
elseif($method == 'PUT'){
    $response['result'] = 'true';
    $data = '';

    parse_str(file_get_contents("php://input"), $data);  //Así se recoge peticiones PUT
    $data = json_decode($data['data'], true);
    // var_dump($data);

    if(is_array($data)){
        if($data['type'] == 'update'){
           $update = [
               'observacion' => $data['observacion'],
               'id_estatus' => $data['id_estatus'],
               'id' => $data['id']
           ];
           
           //Función para actualizar los datos del préstamo
           $response['estado'] = $prestamoController->updateShort($update);
        } 
    }
}

// $response['prestamos'] = $helper->utf8ize($response['prestamos']);
$peticionAjax = false;
echo json_encode($response);