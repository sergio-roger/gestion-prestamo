<?php

class HomeController{

    public function index($vista){
        include $vista;
    }
}