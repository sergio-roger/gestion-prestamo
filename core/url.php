<?php 

class Url{

    private $direccion;
    private $parametros;
    private $uri;
    private $arrayUrl;
    
    public function __construct(){
        $this->uri = $_SERVER['REQUEST_URI'];    
    }

    public function getDireccion(){
        if(isset($_GET['view'])){
            $ruta = explode('/',$_GET['view']);
            $this->direccion = $ruta[0];
            $this->parametros = $ruta[1];
            // return $this->direccion;
        }else{
            $this->direccion = null;
            $this->parametros = null;
        }
    }

    private function partirUrl(){
        $partido = explode('/', $this->uri);
        return $partido;
    }

    public function getArrayUrl(){
        $this->arrayUrl = $this->partirUrl();
        return $this->arrayUrl;
    }

    public function getParametro(){
        
        return $this->parametros = $this->partirUrl()[4];
    }

    public function getUri(){
        return $this->uri;
    }

    public function splitCamelCase($ruta){
        
        preg_match_all('/((?:^|[A-Z])[a-z]+)/',$ruta, $matches);
         //var_dump($this->matches);
         $part1 = $matches[0];
            
        if(!isset($part1[1])){
            $part1[1] = '';
        }
        
         $partes = [
             'parte_1' => $part1[0],
             'parte_2' => $part1[1]
         ];
         return $partes;
    }
}