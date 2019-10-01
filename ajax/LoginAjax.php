<?php

$peticionAjax = true;

require_once '../core/config.php';

if(isset($_POST['correo']) && isset($_POST['clave'])){
    require_once '../controllers/UsuarioController.php';

    $usuarioController = new UsuarioController();
    echo $usuarioController->login(); 
    //  var_dump($usuario->login());
}

$peticionAjax = false;