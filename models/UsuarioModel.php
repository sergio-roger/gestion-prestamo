<?php

if($peticionAjax){
    require_once '../core/Model.php';
   // echo '<br>Archivo model importado <br>';
}
else{
    require_once 'core/Model.php';
}

class UsuarioModel extends Model
{
    private $tabla;   

    public function __construct($tabla = 'usuarios')
    {
        $this->tabla = $tabla;
        parent::__construct($tabla);
    }

    public function insertShort($datos){

        $sql = 'INSERT INTO '.$this->tabla.' (`rol_id`, `usu_nombres`, `usu_apellidos`, `usu_correo`, `usu_sexo`,`usu_foto`,`usu_clave`, `estado`)
        VALUES(:rol,:nombres,:apellidos,:correo,:sexo,:foto,:clave,:estado)';

        $stmt = Model::Conectar()->prepare($sql);
        
        $stmt->bindParam (':rol',$datos['rol']);
        $stmt->bindParam (':nombres',$datos['nombres']);
        $stmt->bindParam (':apellidos', $datos['apellidos']);
        $stmt->bindParam (':correo', $datos['correo']);
        $stmt->bindParam (':sexo', $datos['sexo']);
        $stmt->bindParam (':foto', $datos['foto']);
        $stmt->bindParam (':clave', $datos['clave']);
        $stmt->bindParam (':estado', $datos['estado']);

        $exec = $stmt->execute();
        return $exec;
    }

    public function getUsuario($id){
        //This one devuelve una clase statment
        $res= $this->one($id);

        if($res->rowCount() == 1){
            $usuario = $res->fetch(PDO::FETCH_ASSOC);
        }else{
            $usuario = false;
        }
        return $usuario;
    }

    public function cleanString($cadena){
        $cadena = Model::cleanString($cadena);
        return $cadena;
    }

    public function sweetAlert($datos){
        $alerta = Model::sweetAlert($datos);
        return $alerta;
    }

    public function ejecutarSQL($consulta){
        $datos = Model::ejecutarSQL($consulta);
        return $datos;
    }

    public function encryption($string){
        $encriptado = Model::encryption($string);
        return $encriptado;
    }

    public function descryption($string){
        $desencriptado = Model::descryption($string);
        return $desencriptado;
    }

    public function login($datos){
        $sql = 'SELECT * FROM '.$this->tabla.' WHERE usu_correo=:correo AND usu_clave=:clave AND estado="A"';
        $stmt = Model::Conectar()->prepare($sql);

        $stmt->bindParam (':correo',$datos['correo']);
        $stmt->bindParam (':clave',$datos['clave']);

        $stmt->execute();
        return $stmt;
    }

    public function cerrarSesion($datos){
        if($datos['usuario'] != '' && $datos['token_sesion'] == $datos['token_boton']){
            session_unset();
            session_destroy();
            $respuesta = true;
        }else{
            $respuesta = false;
        }
        return $respuesta;
    }
}


