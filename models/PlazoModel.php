<?php

$requiere = ($peticionAjax) ?  '../core/Model.php' : 'core/Model.php';
include $requiere;

// if($peticionAjax)
//     require_once '../core/Model.php';
// else
//     require_once 'core/Model.php';

class PlazoModel extends Model{

    private $tabla  = 'plazos'; 

    public function __construct(){
        parent::__construct($this->tabla);
    }

    public function getPlazo($periodo){
        $sql = "SELECT * FROM $this->tabla WHERE pla_periodo = '$periodo' AND estado = 'A'";
        $resultado = Model::ejecutarSQL($sql);

        if($resultado->rowCount() > 1){
            // return  $resultado->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        }else{
            return false;
        }
        // return $plazos;
    }
}