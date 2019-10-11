<?php

if($peticionAjax)
    require_once '../core/Model.php';
else
    require_once 'core/Model.php';

class InteresModel extends Model{

    private $tabla = 'intereses';

    public function __construct(){
        parent::__construct($this->tabla);
    }

    public function all(){
        return Model::all();
    }

    public function allByOrder($campo, $orden = 'ASC'){
        $sql = "SELECT * FROM $this->tabla WHERE estado = 'A' ORDER BY $campo $orden";
        $stmt = Model::ejecutarSQL($sql);
        return $stmt;
    }
}