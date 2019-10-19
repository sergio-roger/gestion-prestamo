<?php

class FileName{

    private $listaBlanca;
    private $carpetas;
    
    public function __construct()
    {
        $this->listaBlanca = [];
        $this->carpetas = [];

        $this->listaBlanca();
        $this->listaCarpetas();
    }

    //Agregar mas archivos
    private function listaBlanca(){
        $this->listaBlanca = [
            'clienteListar','clienteNuevo','cuotaNueva','prestamoNuevo','home','usuarioPerfil','prestamoListar',
            'clienteInformacion','clientePrueba','prestamoOcultos', 'prestamoInformacion'
        ];
    }
    
    //Agregar mas carpetas
    private function listaCarpetas(){
        $this->carpetas = [
            'cliente','cuota','prestamo','perfil'
        ];
    }

    public function getListaBlanca(){
        return $this->listaBlanca;
    }

    public function getCarpetas(){
        return $this->carpetas;
    }
}