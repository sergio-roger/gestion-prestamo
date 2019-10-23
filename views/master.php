<?php

  include_once 'layouts/header.php';
  include_once 'controllers/ViewController.php';
  include_once 'controllers/DireccionController.php';
  include_once 'controllers/BarraDireccionController.php';
  include_once 'core/Helper.php';

  $peticionAjax = false;

  $helper = new Helper();
  $vista = new ViewController();
  $vw = $vista->view();
  $direccion =  $vista->getDireccion();

  session_start(['name' => 'CE']);  
  
  if($vw == 'login' || $vw == '404' || $vw == 'register' || $vw == 'confirmar'){
    
    if($vw == 'login'){
      include_once 'views/contents/template/login.php';            //Aki va el include de login
      include_once 'views/contents/template/scriptTemplate.php';  
    }
    elseif($vw == 'register'){
      include_once 'views/contents/template/register.php';        
      include_once 'views/contents/template/scriptTemplate.php';    
    }
    elseif($vw == 'confirmar'){
      include_once 'views/contents/template/confirmar.php';        
      include_once 'views/contents/template/scriptTemplate.php';    
    }
    elseif($vw == '404')
      include_once 'views/contents/template/404.php';    //Aki va el include de 404
  }
  else
  {    
    include_once 'controllers/UsuarioController.php';
    $usuarioController = new UsuarioController();

    if(!isset($_SESSION['token']) || !isset($_SESSION['usuario']) ){
      $usuarioController->forzarCierrreSession();
    }

    echo '
    <script>
      window.onload = function(){
        $("#title").append(" | Dashoboard");
      }
    </script>
    ';

    include_once 'layouts/navbar.php';    //Barra supeior
    include_once 'layouts/sidebar.php';   //Barra lateral o menu de opciones
    
    //Inicio dinámico
    // echo '<div class="Aki empieza la barra de direccion"></div>';

    $barraDireccion = new BarraDireccionController($direccion);
    $barraDireccion->index();             //Barra de dirección 
   
    $controllerPrincipal = $vista->getClase($direccion);   //Obtener la clase del respectivo controlador

    //Llamar al respectivo controlador y ejecutar el método index()
    include_once 'controllers/'.$controllerPrincipal.'.php';
    // $in = 'controllers/'.$controllerPrincipal.'.php';
    $instancia = new $controllerPrincipal();
    $instancia->index($vw);

    // include $vw;  //$vw es la direccion del include de la vista
    //Fin dinámico
    //
    include_once 'layouts/footer.php';  //Footer
  }

