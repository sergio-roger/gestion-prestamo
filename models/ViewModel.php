<?php

require_once 'core/fileName.php';

class ViewModel
{
    private $respuesta; 

    public function __construct(){
    }

    public function view($vista){
        $fileName = new FileName();
        $listaBlanca = $fileName->getListaBlanca();
        $carpetas = $fileName->getCarpetas();

        if(in_array($vista, $listaBlanca)){
            $file = 'views/contents';
            $existe = false; 

            if($vista == 'home'){
                $file = 'Views/contents/home.php';
                $this->respuesta = $file;
            }else
            {
                foreach ($carpetas as $carpeta){
                    $file = 'views/contents/'.$carpeta.'/'.$vista;
                    //echo $file.'View.php <br>';
    
                    if(is_file($file.'View.php')){
                        $this->respuesta = $file.'View.php';
                        $existe = true;
                        break;
                    }
                }   
                //die('Termino recorrer todas las carpetas');
                if(!$existe)
                    $this->respuesta = 'login';
            }    

        }elseif($vista == 'login'){
            $this->respuesta = 'login';
        }elseif($vista == 'register'){
            $this->respuesta = 'register';
        }elseif($vista == 'index'){
            $this->respuesta = 'login';
        }elseif($vista == 'confirmar'){
            $this->respuesta = 'confirmar';
        }
        else{
            $this->respuesta = '404';
        }
        $contenido = $this->respuesta;
        return $contenido;
    }

}
