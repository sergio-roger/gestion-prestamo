<?php

$includeModel = ($peticionAjax) ? '../models/PrestamoModel.php' : 'models/PrestamoModel.php';
$archivoUrl = ($peticionAjax) ? '../core/url.php' : 'core/url.php';

include_once $includeModel;
include_once $archivoUrl;

class PrestamoController{

    private $prestamoModel;
    private $url;

    public function __construct(){
        $this->url = new Url();
        $this->prestamoModel = new PrestamoModel();
    }

    public function index($vista){
        $ruta = $this->url->getArrayUrl();
        $tipoVista = $this->url->splitCamelCase($ruta[3]);
        $this->renderizarVista($tipoVista['parte_2'], $vista);
    }

    private function renderizarVista($tipo, $vista){
        switch($tipo){

            case "Nuevo":
                include $vista;
                break;

            case "Listar":
                include $vista;
                break;

            case  "Ocultos":
                include $vista;
                break;

            case "Informacion":
                $idPrestamo = $this->url->getParametro();
                include $vista;
                break;
            // case "Informacion":
            //     $idCliente = $this->url->getParametro();
            //     include $vista;
            //     break;
        }
    }

    public function insert(){
        $data = json_decode($_POST['data']);
        $prestamo = $data->{'prestamo'};
        $prestamo = (array)$prestamo;
        $prestamo = $this->cleanArray($prestamo);
        
        if(is_array($prestamo)){
            $result =  $this->prestamoModel->insert($prestamo);
        }else{
            $result = false;
        }
        return $result;
        // var_dump($prestamo);
    }

   public function cleanArray($data){

       if(is_array($data)){
            $data['id_usuario'] = $this->prestamoModel->cleanString($data['id_usuario']);
            $data['id_cliente'] = $this->prestamoModel->cleanString($data['id_cliente']);
            $data['id_monto'] = $this->prestamoModel->cleanString($data['id_monto']);
            $data['id_interes'] = $this->prestamoModel->cleanString($data['id_interes']);
            $data['id_plazo'] = $this->prestamoModel->cleanString($data['id_plazo']);
            $data['id_estatus'] = $this->prestamoModel->cleanString($data['id_estatus']);
            $data['fecha_inicio'] = $this->prestamoModel->cleanString($data['fecha_inicio']);
            $data['fecha_fin'] = $this->prestamoModel->cleanString($data['fecha_fin']);
            $data['cuota_diaria'] = $this->prestamoModel->cleanString($data['cuota_diaria']);
            $data['observacion'] = $this->prestamoModel->cleanString($data['observacion']);
            $data['terminos'] = $this->prestamoModel->cleanString($data['terminos']);
            $data['acepta'] = $this->prestamoModel->cleanString($data['acepta']);
       }

       return $data;
   }

   public function all(){
       return $this->prestamoModel->all();
   }

   public function getAllPersonalizado(){
       $stmt =  $this->prestamoModel->getAllPersonalizado();
       //    var_dump($stmt->fetch(PDO::FETCH_ASSOC));
       return $stmt;
   }

   public function getPrestamosOcultos(){
        $stmt = $this->prestamoModel->getPrestamosOcultos();
        return $stmt;
   }

   public function count(){
       return $this->prestamoModel->count();
   }
   
   public function delete($id){
    $respuesta = $this->prestamoModel->delete($id); 
    
    if($respuesta)  return true;
    else            return false;
    }

    public function hide($id){
        $respuesta = $this->prestamoModel->visible($id, 'O');

        if($respuesta) return true;
        else           return false;
    }

    public function show($id){
        $respuesta = $this->prestamoModel->visible($id, 'V');

        if($respuesta) return true;
        else           return false;
    }

    public function getPrestamo($id){
        $prestamo = $this->prestamoModel->getPrestamo($id);
        return $prestamo;
    }

    public function getPrestamoInfo($id){
        $prestamo = $this->prestamoModel->getPrestamoInfo($id);
        return $prestamo;
    }

    public function updateShort($datos){
        $respuesta = $this->prestamoModel->updateShort($datos);
        
        if($respuesta)  return true;
        else            return false;
    }
}