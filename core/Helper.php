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
}   