<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <?php
    if(isset($_SESSION)){
      $dasbhoard = ' | Dashboard';
    }else{
      $dasbhoard = '';
    }
  ?>
  <title id="title"><?= APLICACION?> <?= $dasbhoard?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= BASE?>assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="<?= BASE ?>assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?= BASE?>assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">

  <!-- DataTables -->
  <link rel="stylesheet" href="<?= BASE?>assets/plugins/datatables/css/bootstrap.css">
  <link rel="stylesheet" href="<?= BASE?>assets/plugins/datatables/css/dataTables.bootstrap4.min">
  
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= BASE?>assets/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?= BASE?>assets/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?= BASE?>assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Estilos personlizados -->
  <link rel="stylesheet" href="<?= BASE?>assets/dist/css/style.css">
</head>

