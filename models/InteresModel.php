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
}