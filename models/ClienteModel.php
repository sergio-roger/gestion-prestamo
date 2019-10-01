<?php

if($peticionAjax){
    require_once '../core/Model.php';
}
else{
    require_once 'core/Model.php';
}

class ClienteModel extends Model{

    private $tabla;

    public function __construct($tabla){
        $this->tabla = $tabla;
        parent::__construct($tabla);
    }

    public function insert($datos)
    {
        if(is_array($datos)){
            $fechaActual = date('Y-m-d');

            $sql = 'INSERT INTO '.$this->tabla.
            '(`cli_cedula`, `cli_nombres`, `cli_apellidos`,`cli_correo`, `cli_sexo`, `cli_edad`, `cli_telefono`, `cli_lugar_trabajo`, `cli_lugar_cobro`, `cli_fecha_ingreso`, `cli_fecha_update`, `estado`)
            VALUES(:cedula, :nombres, :apellidos, :correo, :sexo, :edad, :telefono, :lugar_trabajo, :lugar_cobro, :fecha_registro, :fecha_update, :estado)';

            $stmt = Model::Conectar()->prepare($sql);
            
            $stmt->bindParam (':cedula',$datos['cli_cedula']);
            $stmt->bindParam (':nombres',$datos['cli_nombres']);
            $stmt->bindParam (':apellidos', $datos['cli_apellidos']);
            $stmt->bindParam(':correo', $datos['cli_correo']);
            $stmt->bindParam (':sexo', $datos['cli_sexo']); 
            $stmt->bindParam (':edad', $datos['cli_edad']);         //Bien
            $stmt->bindParam (':telefono', $datos['cli_telefono']);
            $stmt->bindParam (':lugar_trabajo', $datos['cli_lugar_trabajo']);
            $stmt->bindParam (':lugar_cobro', $datos['cli_lugar_cobro']);
            $stmt->bindParam (':fecha_registro', $fechaActual);
            $stmt->bindParam (':fecha_update', $fechaActual);
            $stmt->bindParam (':estado', $datos['cli_estado']);
    
            $exec = $stmt->execute();
            return $exec;
        
        }
    }

    public function update($id, $datos){
        $fechaActual = date('Y-m-d H:i:s');

        $sql = 'UPDATE '  .$this->tabla .' SET `cli_nombres`= :nombres,`cli_apellidos`= :apellidos, `cli_correo`=:correo,`cli_sexo`=:sexo, `cli_edad`=:edad,`cli_telefono`=:telefono,`cli_lugar_trabajo`=:lugar_trabajo, `cli_lugar_cobro`= :lugar_trabajo,`cli_fecha_update`= :fecha_update WHERE id = :cli_id';

        $stmt = Model::Conectar()->prepare($sql);
            
        $stmt->bindParam (':nombres',$datos['cli_nombres']);
        $stmt->bindParam (':apellidos', $datos['cli_apellidos']);
        $stmt->bindParam(':correo', $datos['cli_correo']);
        $stmt->bindParam (':sexo', $datos['cli_sexo']); 
        $stmt->bindParam (':edad', $datos['cli_edad']);         //Bien
        $stmt->bindParam (':telefono', $datos['cli_telefono']);
        $stmt->bindParam (':lugar_trabajo', $datos['cli_lugar_trabajo']);
        $stmt->bindParam (':lugar_cobro', $datos['cli_lugar_cobro']);
        $stmt->bindParam (':fecha_update', $fechaActual);
        $stmt->bindParam(':cli_id', $id);

        $exec = $stmt->execute();
        return $stmt;
    }

    public function delete($id){
        return Model::delete($id);
    }

    public function all(){
        return Model::all();
    }

    public function count(){
        return Model::count();
    }

    public function getCliente($id){
        $res = $this->one($id);

        if($res->rowCount() == 1){
            $cliente = $res->fetch(PDO::FETCH_ASSOC);
        }else{
            $cliente = false;
        }
        return $cliente;
    }
}