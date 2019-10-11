<?php

$peticionAjax = true;
include '../core/config.php';
include '../core/Helper.php';
include '../controllers/ClienteController.php';

$clienteController  = new ClienteController();
$datos = $clienteController->all();
$list = [];


while($row = $datos->fetch(PDO::FETCH_ASSOC)){

    $editar ='<div class="w-100 text-center">
    <button class="btn btn-warning tex-center" value=""
    data-toggle="modal" data-target="#modal-editar-cliente" onclick="visualizarDatos('.$row["id"].')">
    <i class="fas fa-user-edit blanco"></i></button>
    </div >';

    $eliminar = '<div class="w-100 text-center" id="e-'.$row["id"].'">
    <button class="btn btn-danger tex-center" onclick="deleteCliente('.$row["id"].')"><i class="fas fa-trash blanco"></i></button>
    </div >';

    $list[] = [
        "0" => '<div class="w-100 text-center">'.$row["id"].'</div>',
        "1" => '<a href="'.BASE.'clienteInformacion/'.$row["id"].'">'.$row["cli_nombres"].'</a>',
        "2" => '<a href="'.BASE.'clienteInformacion/'.$row["id"].'">'.$row["cli_apellidos"].'</a>',
        "3" => '<div class="w-100 text-center">'.$row["cli_edad"].'</div>',
        "4" => $row["cli_lugar_cobro"],
        "5" => $editar,
        "6" => $eliminar
    ];
}

$resultado = [
    "sEcho" => 1,
    "iTotalRecords" => count($list),
    "iTotalDisplayRecord" => count($list),
    "aaData" => $list
];

echo json_encode($resultado);
$peticionAjax = false;