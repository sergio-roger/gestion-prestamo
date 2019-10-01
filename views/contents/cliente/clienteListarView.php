<div class="row cuadro-blanco mb-4 py-3 d-flex justify-content-between">
    <div class="col-12 col-md-6">
        <a href="<?= BASE?>clienteNuevo" class="btn btn-primary col-12 col-md-3 blanco">Agregar <i class="fas fa-plus ml-2 blanco"></i></a>
        <button class="btn btn-success col-12 col-md-3 d-none" id="btn-refresh-cliente">Refresecar 
        <i class="fas fa-redo-alt ml-2 blanco"></i></button>

    </div>

    <div class="col-12 col-md-4 margin-a d-none">
        <form action="#" class="d-flex justify-content-start justify-content-md-end">
            <input type="text" class="form-control" value="" placeholder="Buscar cliente">
            <button class="btn btn-dark ml-4 mr-2">
                <i class="fas fa-search blanco ml-2"></i>
            </button>
        </form>
    </div>
</div>

<!-- <div class="row"> -->
    <!-- <div class="col-md-12 p-1 table-responsive"> -->
        <table class="table table-hover table-condensed table-bordered table-striped" id="tb-clientes" style="background:#fff;">
            <thead>
                <tr>
                    <th scope="col" class="text-center"># ID</th>
                    <th scope="col">Nombres</th>
                    <th scope="col">Apellidos</th>
                    <th scope="col" class="text-center">Edad</th>
                    <th scope="col">Lugar de Cobro</th>
                    <th scope="col" class="text-center">Editar</th>
                    <th scope="col" class="text-center">Eliminar</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <!-- <th scope="row" class="text-center">1</th>
                    <td><a href="#">Mark</a></td>
                    <td><a href="#">Otto</a></td>
                    <td><a href="#">23</a></td>
                    <td><a href="#">La libertad</a></td>
                    <td class="text-center">
                        <button class="btn btn-warning" data-toggle="modal" data-target="#modal-editar-cliente">
                            <i class="fas fa-user-edit blanco"></i>
                        </button>
                    </td> -->
                    <td COLSPAN="7" class="text-center">Cargando  <i class="fas fa-spinner"></i></td>
                    <!-- <td class="text-center">
                        <button class="btn btn-danger"><i class="fas fa-trash blanco"></i></button>
                    </td> -->
                </tr>
            </tbody>

            <tfoot>
                <th scope="col" class="text-center"># ID</th>
                <th scope="col">Nombres</th>
                <th scope="col">Apellidos</th>
                <th scope="col" class="text-center">Edad</th>
                <th scope="col">Lugar de Cobro</th>
                <th scope="col" class="text-center">Editar</th>
                <th scope="col" class="text-center">Eliminar</th>
            </tfoot>
        </table>
    <!-- </div> -->
<!-- </div> -->

<div id="modalAgregarCliente"></div>

<div>
    <!-- Modal para Editar Cliente -->
    <div class="modal fade" id="modal-editar-cliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="modal-title" id="exampleModalCenterTitle">Editar Cliente</h5>
                <button type="button" class="close bg-danger" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form role="form" class="preventDefault" action="" method="POST" id="form-cliente-editar"
                    enctype="multipart/form-data">
                    <div class="card-body">

                    <div class="form-group d-none">
                        <label for="cliente-id">ID</label>
                        <input type="hidden" class="form-control only-numbers" id="cliente-id"
                        name="cliente-cedula" placeholder="id" maxlength="10" disabled>
                    </div>

                        <div class="form-group">
                            <label for="cedula">* Cédula</label>
                            <input type="text" class="form-control only-numbers" id="cliente-cedula"
                            name="cliente-cedula" placeholder="Ingrese cédula" maxlength="10" disabled>
                        </div>

                        <div class="row">
                            <div class="form-group col-12 col-md-6">
                                <label for="nombres">* Nombres</label>
                                <input type="text" class="form-control" id="cliente-nombres" name="cliente-nombres" placeholder="Ingrese nombres">
                            </div>
                            <div class="form-group col-12 col-md-6">
                                <label for="apellidos">* Apellidos</label>
                                <input type="text" class="form-control" id="cliente-apellidos" name="cliente-apellidos" placeholder="Ingrese apellidos">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email">Correo electrónico</label>
                            <input type="email" class="form-control" id="cliente-correo" name="cliente-correo" placeholder="Ingrese correo">
                        </div>
                        <div class="col-sm-6">
                            <!-- radio -->
                            <label>* Elija Sexo</label>
                            <div class="form-group d-flex ">
                                <div class="custom-control custom-radio d-flex flex-sm-column box-sexo">
                                    <input class="custom-control-input" type="radio" id="masculino" name="cliente-sexo" value="M">
                                    <label for="masculino" class="custom-control-label">Masculino</label>
                                </div>
                                <div class="custom-control custom-radio radio-femenino" style="margin-left: 25px;">
                                    <input class="custom-control-input" type="radio" id="femenino" name="cliente-sexo" checked value="F">
                                    <label for="femenino" class="custom-control-label">Femenino</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6 col-12">
                                <label for="cliente-edad">* Edad</label>
                                <input type="number" class="form-control only-numbers" id="cliente-edad" name="cliente-edad" placeholder="Ingrese edad">
                            </div>
                            
                            <div class="form-group col-md-6 col-12">
                                <label for="cliente-telefono">Teléfono</label>
                                <input type="tel" class="form-control only-numbers" id="cliente-telefono" name="cliente-telefono" placeholder="Ingrese telefono">
                            </div>
                        </div>
                            
                        <div class="form-group">
                            <label for="direccion" class="col-sm-4 control-label">* Lugar de Cobro</label>
                            <textarea class="form-control" id="cliente-lugar-cobro" placeholder="Ingrese lugar de cobro"
                            maxlength="255"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="direccion" class="col-sm-4 control-label">Lugar de Trabajo</label>
                            <textarea class="form-control" id="cliente-lugar-trabajo" placeholder="Ingrese lugar de trabajo"
                            maxlength="255"></textarea>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="">
                        <button type="submit" class="btn btn-dark ml-4" >
                            <i class="fas fa-edit blanco ml-2"></i>
                            <span>Actualizar</span>
                        </button>
                    </div>

                    <div class="preguntaAccion"></div>
                    <div class="error-datos"></div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal" id="editar-datos-cliente">
                    <i class="fas fa-times blanco mr-2"></i>    
                    <span>Cerrar</span>
                </button>
                <!-- <button type="button" class="btn btn-primary">Guardar Cambios</button> -->
            </div>
            </div>
        </div>
    </div>
</div>
