<?php

if($peticionAjax){
    require_once '../models/ClienteModel.php';
}
else{
    require_once 'models/ClienteModel.php';
}

class ClienteController {
    private $clienteModel;

    public function __construct()
    {
        $this->clienteModel = new ClienteModel('clientes');
    }

    public function insert($datos){
        return $this->clienteModel->insert($datos);
    }

    public function update($id, $datos){
        $res =  $this->clienteModel->update($id, $datos);

        if($res) return true;
        else return false;
    }

    public function count(){
        //Obtiene objeto statement
        $res =  $this->clienteModel->count()->fetch();
        return $res;
    }

    public function delete($id){
        $respuesta = $this->clienteModel->delete($id); 
        
        if($respuesta)
            return true;
        else
            return false;
    }

    public function all(){
        $datos = $this->clienteModel->all();

        if($datos->rowCount() > 1){
            return $this->clienteModel->all();
        }else{
            return false;
        }
    }
    
    public function getCliente($id){
        // $id = $_POST['id'];
        $cliente = $this->clienteModel->getCliente($id);
        
        return $cliente;
    }
}