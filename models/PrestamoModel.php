<?php

$includeModel = ($peticionAjax) ? '../core/Model.php' : 'core/Model.php';
include_once $includeModel;

class PrestamoModel extends Model{

    private $tabla = 'prestamos';

    public function __construct(){
        parent::__construct($this->tabla);
    }

    public function insert($prestamo){
        $fechaRegistro = date('Y-m-d');
        $pagado = 0;    $visible = 'V';
        $estado = 'A';

        if(is_array($prestamo)){
            $sql = "
            INSERT INTO `prestamos`(`usu_id`, `cli_id`, `int_id`, `mon_id`, `pla_id`, `est_id`, `pres_fecha_inicio`, `pres_fecha_fin`, `pres_fecha_registro`, `pres_fecha_update`, `pres_observacion`, `pres_cuota`,`pres_pagado`,`pres_total`, `pres_terminos`,`pres_visible`, `estado`)
            VALUES (:id_usuario, :id_cliente, :id_interes, :id_monto, :id_plazo, :id_estatus, :fecha_inicio, :fecha_fin, :fecha_registro, :fecha_update, :observacion, :cuota, :pagado, :total, :terminos, :visible, :estado)
            ";

            $stmt = Model::Conectar()->prepare($sql);

            $stmt->bindParam(':id_usuario', $prestamo['id_usuario']);
            $stmt->bindParam(':id_cliente', $prestamo['id_cliente']);
            $stmt->bindParam(':id_interes', $prestamo['id_interes']);
            $stmt->bindParam(':id_monto', $prestamo['id_monto']);
            $stmt->bindParam(':id_plazo', $prestamo['id_plazo']);
            $stmt->bindParam(':id_estatus', $prestamo['id_estatus']);
            $stmt->bindParam(':fecha_inicio', $prestamo['fecha_inicio']);
            $stmt->bindParam(':fecha_fin', $prestamo['fecha_fin']);
            $stmt->bindParam(':fecha_registro', $fechaRegistro);
            $stmt->bindParam(':fecha_update', $fechaRegistro);
            $stmt->bindParam(':observacion', $prestamo['observacion']);
            $stmt->bindParam(':cuota', $prestamo['cuota_diaria']);
            $stmt->bindParam(':pagado', $pagado);
            $stmt->bindParam(':total',$prestamo['total']);
            $stmt->bindParam(':terminos', $prestamo['acepta']);
            $stmt->bindParam(':visible', $visible);
            $stmt->bindParam(':estado', $estado);

            $exec = $stmt->execute();
            return $exec;
            // var_dump($exec);
        }
        return false;
    }

    public function cleanString($string){
        return parent::cleanString($string);
    }

    public function all(){
        return Model::all();
    }

    public function getAllPersonalizado(){
        $sql = "CALL `sp_getPrestamos`();";
       
        $stmt = Model::Conectar()->query($sql);
        // $stmt->execute();
        return $stmt;
    }

    public function updateShort($datos){

        if(is_array($datos)){
            $datos['observacion'] = $this->cleanString($datos['observacion']);
            $datos['id_estatus'] = $this->cleanString($datos['id_estatus']);
            $datos['id'] = $this->cleanString($datos['id']);

            $sql = 'UPDATE `prestamos` SET `pres_observacion` = "'.$datos['observacion'].'", `est_id` = '.$datos['id_estatus'].' WHERE id = '.$datos['id'].' AND estado = "A"';
            $stmt = Model::ejecutarSQL($sql);
            // var_dump($stmt);
            return true;

        }else{
            return null;
        }
    }

    public function getPrestamosOcultos(){
        $sql = "CALL `sp_getPrestamosHide`();";
        $stmt = Model::ejecutarSQL($sql);
        return $stmt;
    }

    public function getPrestamoByCliente($idCliente){
        $sql = "CALL sp_getPrestamoCliente($idCliente)";
        $stmt = Model::ejecutarSQL($sql);

        if($stmt->rowCount() >= 1){
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }else{
            return false;
        }
    }

    public function UpdatePagado($id, $valor){
        $sql ="UPDATE prestamos SET pres_pagado = $valor WHERE id = $id";
        $stmt = Model::ejecutarSQL($sql);
        return true;
    }

    public function updateEstatus($id, $valor){
        $sql ="UPDATE prestamos SET est_id = $valor WHERE id = $id";
        $stmt = Model::ejecutarSQL($sql);
        return true;
    }

    public function count(){
        return Model::count();
    }

    public function delete($id){
        return Model::delete($id);
    }

    public function visible($id, $visibilidad = 'O'){
        $sql = "UPDATE $this->tabla SET pres_visible = '$visibilidad' WHERE id = $id";
        $stmt = Model::ejecutarSQL($sql);
        return $stmt;
    }

    public function getPrestamo($id){
        $res = $this->one($id);

        if($res->rowCount() == 1){
            $prestamo = $res->fetch(PDO::FETCH_ASSOC);
        }else{
            $prestamo = false;
        }
        return $prestamo;
    }

    public function getPrestamoInfo($id){
        $sql = " CALL `getPrestamo`($id);";
        $stmt = Model::ejecutarSQL($sql);
        return $stmt;
    }

    
}