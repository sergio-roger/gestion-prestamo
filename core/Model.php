<?php

if($peticionAjax){
    //echo '<br> Antes de importar <br>';
    require_once '../core/parametersDB.php';
    //echo '<br> Después de importar <br>';
}
else{
    require_once 'core/parametersDB.php';
}

class Model{

    private $tabla; 

    public function __construct($tabla)
    {
        $this->tabla = $tabla;    
    }

    protected function Conectar(){
        $enlace = new PDO(SGBD, USER, PASS);
        return $enlace;
    }

    protected function ejecutarSQL($consulta){
        $query = $this->Conectar()->prepare($consulta);
        $query->execute();
        return $query; 
    }

    protected function delete($id){
        $sql = "UPDATE $this->tabla SET estado = 'I' where id = $id ";
        $stmt = $this->Conectar()->prepare($sql);
        $stmt->execute();
        return $stmt;
    }

    protected function one($id, $estado = 'A'){
        $sql = "SELECT * FROM $this->tabla WHERE id = $id AND estado = '$estado'";
        $stmt = $this->Conectar()->prepare($sql);
        $stmt->execute();
        return $stmt;
    }

    protected function all(){
        //ORDER BY cli_apellidos ASC
        $sql = "SELECT * FROM $this->tabla WHERE estado = 'A'";
        $stmt = $this->Conectar()->prepare($sql);
        $respuesta = $stmt->execute();
        
        if($respuesta){
            return $stmt;
        }else{
            return false;
        }
    }

    protected function count(){
        $sql = "SELECT COUNT(*) as cantidad FROM $this->tabla WHERE estado = 'A'";
        $stmt = $this->Conectar()->prepare($sql);
        $stmt->execute();
        return $stmt;
    }

    public function encryption($string){
        $ouput = False; 
        $key = hash('sha256', SECRET_KEY);
        $iv = substr(hash('sha256', SECRET_IV),0,16);
        $ouput = openssl_encrypt($string, METHOD, $key, 0 , $iv);
        $ouput = base64_encode($ouput);
        return $ouput;
    }

    public function descryption($string){
        $key = hash('sha256', SECRET_KEY);
        $iv = substr(hash('sha256', SECRET_IV), 0, 16);
        $ouput = openssl_decrypt(base64_decode($string), METHOD, $key, 0, $iv);
        return $ouput;
    }

    protected function generarCodigoAleatorio($letra, $longitud, $numero){
        for($i = 0; $i <= $longitud; $i++){
            $num = rand(0,9);
            $letra.=$num;
        }
        return $letra.$numero;
    }

    protected function cleanString($cadena){
        $cadena = trim($cadena);
        $cadena = stripslashes($cadena);
        $cadena = str_ireplace('<script>','', $cadena);
        $cadena = str_ireplace('</script>','', $cadena);
        $cadena = str_ireplace('<script src','', $cadena);
        $cadena = str_ireplace('<script type>','', $cadena);
        $cadena = str_ireplace('SELECT * FROM','', $cadena);
        $cadena = str_ireplace('select * from','', $cadena);
        $cadena = str_ireplace('DELETE FROM','', $cadena);
        $cadena = str_ireplace('delete from','', $cadena);
        $cadena = str_ireplace('INSERT INTO','', $cadena);
        $cadena = str_ireplace('insert into','', $cadena);
        $cadena = str_ireplace('--','', $cadena);
        $cadena = str_ireplace('^','', $cadena);
        $cadena = str_ireplace('[','', $cadena);
        $cadena = str_ireplace(']','', $cadena);
        $cadena = str_ireplace('==','', $cadena);
        $cadena = str_ireplace('{','', $cadena);
        $cadena = str_ireplace('}','', $cadena);
        $cadena = str_ireplace(';','', $cadena);
        return $cadena;
    }

    //Ejecutar el plugin de javascript sweetAlert
    protected function sweetAlert($datos){
        if(is_array($datos)){
            if($datos['alert'] == 'simple'){
                $alerta = "
                    <script>
                    Swal.fire(
                        '".$datos['tittle']."',
                        '".$datos['text']."',
                        '".$datos['type']."'
                      )
                    </script>
                ";
            }else if($datos['alert'] == 'recargar'){
                $alerta = "
                <script>
                Swal.fire({
                    title: '".$datos['tittle']."',
                    text: '".$datos['text']."',
                    type: '".$datos['type']."',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Aceptar'
                  }).then((result) => {
                    location.reload();
                  })
                </script>
            ";
            }elseif($datos['alert'] == 'limpiar'){
                $alerta = "
                <script>
                Swal.fire({
                    title: '".$datos['tittle']."',
                    text: '".$datos['text']."',
                    type: '".$datos['type']."',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Aceptar'
                  }).then((result) => {
                    $('.formularioAjax')[0].reset();
                  })
                </script>
            ";
            }elseif($datos['alert'] == 'eliminar'){
                $alerta = "
                <script>
                Swal.fire({
                    title: '".$datos['tittle']."',
                    text: '".$datos['text']."',
                    type: '".$datos['type']."',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, bórralo'
                  }).then((result) => {
                    if (result.value) {
                      Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                      )
                    }
                </script>
                ";
            }
            return $alerta;
        }
    }
    
}