<?php

$includeModel = ($peticionAjax) ? '../models/PlazoModel.php' : 'models/PlazoModel.php';
include $includeModel;

class PlazoController{

    private $plazoModel; 

    public function __construct(){
        $this->plazoModel = new PlazoModel();    
    }

    public function getPlazo($periodo){
        $resultado = $this->plazoModel->getPlazo($periodo);
        return  $resultado;
    }
}