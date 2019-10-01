<?php

class BarraDireccionController{

    private $matches;
    private $word1 = '', $word2 = '';

    public function __construct($ruta = 'home'){
        //$ruta = strtolower ( $ruta);
        $this->ruta = $ruta;  

        if($ruta == 'home'){
            $this->word2 = 'Tablero';
            $this->word1 = '';
        }
        else{
            $this->splitCamelCase($ruta);
        }
    }

    public function index(){
        $variables = [
            'word1' => $this->word1,
            'word2' => $this->word2
        ];

        return include 'views/layouts/barraDireccion.php';
    }

    private function splitCamelCase($ruta){
        
        preg_match_all('/((?:^|[A-Z])[a-z]+)/',$ruta, $this->matches);
         //var_dump($this->matches);
         $part1 = $this->matches[0];

         $this->word1 = $part1[0];
         $this->word2 =  $part1[1];
    } 
}