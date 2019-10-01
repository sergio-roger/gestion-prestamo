<?php
require_once 'models/ViewModel.php';

class ViewController{

    private $viewModel;
    private $direccion; 

    public function __construct(){
        $this->viewModel = new ViewModel();
    }

    public function view(){
        if(isset($_GET['view'])){
            $ruta = explode('/',$_GET['view']);
            $view = $ruta[0];
            $respuesta = $this->viewModel->view($view);
        }else{
            $respuesta = 'login';
        }
        return $respuesta;
    }

    public function getDireccion(){
        if(isset($_GET['view'])){
            $ruta = explode('/',$_GET['view']);
            $this->direccion = $ruta[0];
            return $this->direccion;
        }else{
            return null;
        }
    }
}