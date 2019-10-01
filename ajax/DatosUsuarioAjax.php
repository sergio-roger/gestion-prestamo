<?php

include '../core/config.php';

$peticionAjax = true;

if(isset($_POST['id'])){
    include_once '../controllers/UsuarioController.php';
    $usuarioController = new UsuarioController();

    $data = [];
    $usuario =  $usuarioController->getUsuario();
    //$nombre = $usuario->usu_nombres;
    if($usuario){
        $data['result'] = true;
        $data['data'] = $usuario;
    }
    else{
        $data['result'] = false;
    }
    //var_dump($data);
    //echo json_encode($data);
}else{
    $data['result'] = false;
    $data['msj'] = 'Ha fallado la solicitud';
    header('Location:'.BASE.'login');

    //echo 'Debe retornar una respuesta vacia';
}
$peticionAjax = false;
echo json_encode($data);