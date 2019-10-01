<?php

$peticionAjax = true;

require_once '../core/config.php';

if(isset($_POST['nombres'])){
   require_once '../controllers/UsuarioController.php';

   $usuarioController = new UsuarioController();
   //var_dump($_POST);

   if(isset($_POST['nombres']) && isset($_POST['apellidos']) && isset($_POST['correo'])
   && isset($_POST['sexo']) && isset($_POST['clave']) && isset($_POST['conf-clave'])){
       //echo '<br>Dentro del if<br>';
       echo $usuarioController->insertShort();
       $peticionAjax = false;
   }
}else{
    //Seguridad en el sistema para que no entre a los archivos ajax
    session_start();
    session_destroy();

    echo '<script>
    window.location.href="'.BASE.'login";
    </script>';
}