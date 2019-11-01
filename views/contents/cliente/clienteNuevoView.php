<div class="row">
    <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-info">
        <div class="inner">
        <h3 class="total-clientes"><i class="fas fa-spinner"></i></h3>

        <p>Total Clientes</p>
        </div>
        <div class="icon">
            <!-- <i class="ion ion-bag"></i> -->
            <i class="fas fa-user-plus"></i>
        </div>
        <a href="<?= BASE?>clienteListar" class="small-box-footer">Ver todos <i class="fas fa-arrow-circle-right"></i></a>
    </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-success">
        <div class="inner">
        <h3>3</h3>

        <p>Registrado esta semana</p>
        </div>
        <div class="icon">
        <i class="ion ion-stats-bars"></i>
        </div>
        <a href="#" class="small-box-footer">Ver gráfico <i class="fas fa-arrow-circle-right"></i></a>
    </div>
    </div>
</div>
<!-- /.row -->

<!-- Main row -->
<div class="row mt-3">
    <!-- Left col -->
    <section class="col-lg-12 connectedSortable">
    <!-- general form elements -->
    <!-- /.card -->
    <div class="card card-primary">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title order-0">Formulario de Registro</h3>
            <button class="btn btn-info order-3 question"><i class="fas fa-question"></i></button>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form role="form" class="preventDefault" action="" method="POST" id="form-cliente" accept-charset="utf-8"
            enctype="multipart/form-data">
            <div class="card-body">
                <div class="form-group">
                    <label for="cedula">* Cédula</label>
                    <input type="text" class="form-control only-numbers" id="cliente-cedula"
                     name="cliente-cedula" placeholder="Ingrese cédula" maxlength="10">
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
                    <div class="form-group d-flex">
                        <div class="custom-control custom-radio d-flex">
                            <input class="custom-control-input" type="radio" id="masculino" name="cliente-sexo" value="M">
                            <label for="masculino" class="custom-control-label">Masculino</label>
                        </div>
                        <div class="custom-control custom-radio" style="margin-left: 50px;">
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

                <div class="form-group d-none">
                    <label for="cliente-fecha-registro">Fecha Registro</label>
                    <input type="text" class="form-control" id="txt-fecha-registro"  name="cliente-fecha-registro" disabled="">
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary" id="datos-cliente">Registrar Ahora</button>
            </div>

            <div class="preguntaAccion"></div>
            <div class="error-datos"></div>
        </form>
    </div>
        <!-- /.card -->
    </section>
</div>
<!-- /.row (main row) -->