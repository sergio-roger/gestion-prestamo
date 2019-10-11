<?php

$requiere = ($peticionAjax) ?  '../core/Model.php' : 'core/Model.php';
include $requiere;

class EstatusModel extends Model{

    private $tabla = 'estatus';

    public function __construct(){
        parent::__construct($this->tabla);
    }

    public function all(){
        return Model::all();
    }
}