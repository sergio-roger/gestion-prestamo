<?php

class Helper {

    public static function redireccionar($vista){
        return header('Location: '.BASE.$vista);
    }

    public function utf8ize($d){
        if (is_array($d) || is_object($d))
            foreach ($d as &$v) 
                $v = $this->utf8ize($v);
        else
            return utf8_encode($d);
        return $d;
    }

    public function splitCamelCase($ruta){
        
        preg_match_all('/((?:^|[A-Z])[a-z]+)/',$ruta, $this->matches);
         //var_dump($this->matches);
         $part1 = $this->matches[0];
            
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