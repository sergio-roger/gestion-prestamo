<?php

if($peticionAjax)
    require_once '../core/Model.php';
else
    require_once 'core/Model.php';

class MontoModel extends Model{

    private $tabla;

    public function __construct($tabla){
        $this->tabla = $tabla;
        parent::__construct($tabla);
    }

    public function all(){
        return Model::all();
    }

}