<?php

$includeModel = ($peticionAjax) ? '../core/Model.php' : 'core/Model.php';

include_once $includeModel;

class CuotaModel extends Model{

    private $tabla;

    public function __construct(){
        $this->tabla = 'cuotas';
    }

    public function insert($cuota){
        if(is_array($cuota)){
            // Datos limpiados
            $cuota = $this->cleanArray($cuota);
            $cuota['cuo_fecha_registro'] = date('Y-m-d');
            
            $sql = "
                INSERT INTO `cuotas`(`pres_id`, `cli_id`, `usu_id`, `est_id`, `cuo_cuota_numero`, `cuo_fecha_pago`, `cuo_valor_pago`, `cuo_saldo_inicial`, `cuo_saldo_actual`, `cuo_fecha_registro`, `cuo_hora_registro`, `estado`) 
                VALUES (:pres_id, :cli_id, :usu_id, :est_id, :cuo_cuota_numero, :cuo_fecha_pago, :cuo_valor_pago, :cuo_saldo_inicial, :cuo_saldo_actual, :cuo_fecha_registro, :cuo_hora_registro, :estado)";

            $stmt = Model::Conectar()->prepare($sql);
            // $stmt->bindParam(':id_usuario', $prestamo['id_usuario']);
            foreach($cuota as $posicion=>$valor)
                $stmt->bindParam(':'.$posicion, $cuota[$posicion]);
            
            $exec = $stmt->execute();
            return $exec;

        }else{
            return false;
        }
    }

    public function getPrestamoPagado($id, $tabla = 'prestamos'){
        //Obteniendo el campo pres_pagado del prestamo
        $campo = 'pres_pagado';
        $stmt = Model::byCampo($id, $campo, $tabla);
        $stmt = $stmt->fetch(PDO::FETCH_ASSOC);
        return $stmt[$campo];
    }

    protected function cleanArray($data){
        if(is_array($data)){
            // $data['cli_id'] = $this->cuotaModel->cleanArray($data['cli_id']);
            foreach($data as $posicion=>$valor){
                $data[$posicion] = Model::cleanString($valor);
            }
        }
        return $data;
    }

    public function all(){
        // return Model::all();
    }

    public function getCuotasByPrestamo($idPresamo){
        $sql = "SELECT * FROM cuotas where estado = 'A' AND pres_id = $idPresamo";
        $stmt = Model::ejecutarSQL($sql);

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $list[] = $row;
        }

        return $list;
    }
}