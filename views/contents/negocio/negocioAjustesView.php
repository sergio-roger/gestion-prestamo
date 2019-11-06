<div>
    <div class="row">
        <div class="col-12">
            <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">
                            <!-- <i class="fas fa-bullhorn"></i> -->
                            Agregar Motivo
                        </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-7">
                                <form action="#" method="POST" class="d-flex flex-column flex-md-row justify-content-between">
                                    <div class="mr-3">
                                        <button class="btn btn-info mb-3">
                                            Agregar
                                            <i class="ml-2 fas fa-plus"></i>
                                        </button>
                                    </div>
                                    <div class="w-100">
                                        <input type="text" name="txt-motivo" placeholder="Escriba su motivo" class="form-control">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-md-6">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">
                        <!-- <i class="fas fa-bullhorn"></i> -->
                        Tipo de Movimientos
                    </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body" id="body-tipoMovimientos">
                    <!-- <div class="callout callout-success p-05">
                        <h5 class="d-flex justify-content-between">
                            <b class="mr-2">+</b>Activos
                            <input type="radio" name="tipoMovimiento">
                        </h5>
                       
                    </div> -->
                    <!-- <div class="callout callout-danger p-05">
                        <h5 class="d-flex justify-content-between">
                            <b class="mr-2">-</b>Pasivos
                            <input type="radio" name="tipoMovimiento">
                        </h5>
                    </div>
                    <div class="callout callout-success p-05">
                        <h5 class="d-flex justify-content-between">
                            <b class="mr-2">+</b>Patrimonio
                            <input type="radio" name="tipoMovimiento">
                        </h5>
                    </div>
                    <div class="callout callout-danger p-05">
                        <h5 class="d-flex justify-content-between">
                            <b class="mr-2">-</b>Gastos
                            <input type="radio" name="tipoMovimiento">
                        </h5>
                    </div>
                    <div class="callout callout-success p-05">
                        <h5 class="d-flex justify-content-between">
                            <b class="mr-2">+</b>Ingresos
                            <input type="radio" name="tipoMovimiento">
                        </h5>
                    </div> -->
                </div>
            <!-- /.card-body -->
            </div>
        </div>

        <div class="col-12 col-md-6">
            

            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">
                        <!-- <i class="fas fa-bullhorn"></i> -->
                        Detalle del Movimiento
                    </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form action="#" method="POST">
                        <div >
                            <label>Motivo</label>
                            <select id="" class="form-control">
                                <option value="0">Seleccione una opción</option>
                            </select>
                        </div>

                        <div class="mt-2">
                            <label for="txt-valor">Valor</label>
                            <input type="text" class="form-control">
                        </div>

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-danger mt-3">Registrar ahora !</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
