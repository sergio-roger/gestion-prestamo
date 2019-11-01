<?php

$includeModel = ($peticionAjax) ? '../models/CuotaModel.php' : 'models/CuotaModel.php';
$archivoUrl = ($peticionAjax) ? '../core/url.php' : 'core/url.php';

include_once $includeModel;
include_once $archivoUrl;

class CuotaController{

    private $cuotaModel;
    private $url;

    public function __construct(){
        $this->url = new Url();
        $this->cuotaModel = new CuotaModel();
    }

    public function index($vista){
        
        $ruta = $this->url->getArrayUrl();
        $tipoVista = $this->url->splitCamelCase($ruta[3]);
        $this->renderizarVista($tipoVista['parte_2'], $vista);
    }

    private function renderizarVista($tipo, $vista){
        switch($tipo){

            case "Nueva":
                include $vista;
                break;

            case "Listar":
                include $vista;
                break;

            // case "Informacion":
            //     $idPrestamo = $this->url->getParametro();
            //     include $vista;
            //     break;
        }
    }

    public function insert(){
        $data = json_decode($_POST['data']);
        $cuota = $data->{'cuota'};
        $cuota = (array)$cuota;
        
        return $this->cuotaModel->insert($cuota);
    }

    public function getPrestamoPagado($id){
        $campo = $this->cuotaModel->getPrestamoPagado($id);
        return $campo;
    }
    
    public function getCuotasByPrestamo($idPrestamo){
        return $this->cuotaModel->getCuotasByPrestamo($idPrestamo);
     }
}