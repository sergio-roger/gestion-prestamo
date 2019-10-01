<?php

if($peticionAjax)
    require_once '../models/InteresModel.php';
else
    require_once 'models/InteresModel.php';

class InteresController{

    private $interesModel; 

    public function __construct()
    {
        $this->interesModel = new InteresModel();
    }

    public function all(){
        $datos = $this->interesModel->all();

        if($datos->rowCount() > 1){
            return $datos;
        }else{
            return false;
        }
    }
}