<?php

$peticionAjax = true;

require_once '../core/config.php';
require_once '../controllers/UsuarioController.php';
$usuarioController = new UsuarioController();

if(isset($_POST['nombres'])){

   //var_dump($_POST);

   if(isset($_POST['nombres']) && isset($_POST['apellidos']) && isset($_POST['correo'])
   && isset($_POST['sexo']) && isset($_POST['clave']) && isset($_POST['conf-clave'])){
       //echo '<br>Dentro del if<br>';
       echo $usuarioController->insertShort();
   }
}
elseif(isset($_GET['data'])){
    $data = json_decode($_GET['data']);
    $id = $data->{'id'};

    $response['result'] = $usuarioController->confirmarCorreo($id);
    // var_dump($data);
    echo json_encode($response);
}
else{
    //Seguridad en el sistema para que no entre a los archivos ajax
    session_start();
    session_destroy();

    echo '<script>
    window.location.href="'.BASE.'login";
    </script>';
}

$peticionAjax = false;
