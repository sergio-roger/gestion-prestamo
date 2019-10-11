<?php

if($peticionAjax){
    require_once '../models/ClienteModel.php';
    require_once '../core/url.php';
}
else{
    require_once 'models/ClienteModel.php';
    include_once 'core/url.php';
}

class ClienteController {
    private $clienteModel;
    private $url;

    public function __construct()
    {
        $this->url =  new Url();
        $this->clienteModel = new ClienteModel('clientes');
    }

    public function index($vista){
        $ruta = $this->url->getArrayUrl();
        $tipoVista = $this->url->splitCamelCase($ruta[3]);
        // var_dump($tipoVista);
        
        $this->renderizarVista($tipoVista['parte_2'], $vista);
        // include $vista;
    }

    private function renderizarVista($tipo, $vista){
        switch($tipo){

            case "Nuevo":
                include $vista;
                break;

            case "Listar":
                include $vista;
                break;

            case "Informacion":
                $idCliente = $this->url->getParametro();
                include $vista;
                break;
        }
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