<?php

if($peticionAjax)
    require_once '../models/MontoModel.php';
else
    require_once 'models/MontoModel.php';

class MontoController
{
    private $montoModel; 

    public function __construct(){
        $this->montoModel = new MontoModel('montos');
    }

    public function all(){
        $datos = $this->montoModel->all();

        if($datos->rowCount() > 1){
            return $datos;
        }else{
            return false;
        }
    }
}