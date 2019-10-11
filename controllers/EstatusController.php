<?php

$include = ($peticionAjax) ? '../models/EstatusModel.php' : 'models/EstatusModel.php';
include $include;

class EstatusController{

    private $estatuModel; 

    public function __construct(){
        $this->estatuModel = new EstatusModel();
    }

    public function all(){
        $datos = $this->estatuModel->all();

        if($datos->rowCount() >= 1){
            return $datos;
        }else{
            return false;
        }
    }
}