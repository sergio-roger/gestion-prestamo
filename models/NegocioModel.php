<?php

$includeModel = ($peticionAjax) ? '../core/Model.php' : 'core/Model.php';
include_once $includeModel;

class NegocioModel extends Model{

    private $tabla = 'tiposmovimientos ';

    public function __construct(){
        parent::__construct($this->tabla);
    }
    
    public function all(){
        $resultado =Model::all();;
        $lista = []; 

        while($row = $resultado->fetch(PDO::FETCH_ASSOC) ){
            $lista[] = $row;
        }

        return $lista; 
    }
}