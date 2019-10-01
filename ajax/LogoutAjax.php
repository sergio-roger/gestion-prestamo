<?php

$peticionAjax = true;

require_once '../core/config.php';

if(isset($_GET['token'])){
    require_once '../controllers/UsuarioController.php';
    $usuarioController = new UsuarioController();

    echo $usuarioController->cerrarSesion();
   
}else{
    //Seguridad en el sistema para que no entre a los archivos ajax
    session_start();
    session_destroy();

    echo '<script>
    window.location.href="'.BASE.'login";
    </script>';
}