<?php

$includeModel = ($peticionAjax) ? '../models/NegocioModel.php' : 'models/NegocioModel.php';
$archivoUrl = ($peticionAjax) ? '../core/url.php' : 'core/url.php';

include_once $includeModel;
include_once $archivoUrl;

class NegocioController{

    private $negocioModel;
    private $url;

    public function __construct(){
        $this->url = new Url();
        $this->negocioModel = new NegocioModel();
    }

    public function index($vista){
        $ruta = $this->url->getArrayUrl();
        $tipoVista = $this->url->splitCamelCase($ruta[3]);
        $this->renderizarVista($tipoVista['parte_2'], $vista);
    }

    private function renderizarVista($tipo, $vista){
        switch($tipo){

            case "Ajustes":
                include $vista;
                break;
        }
    }

    public function all(){
        return $this->negocioModel->all();
    }
}