 <!-- /.row -->
 <div class="row">

<!-- left column -->
<div class="col-md-9">
  <!-- general form elements -->
  <div class="card card-success">
    <div class="card-header">
      <h3 class="card-title">Registro de Cuota</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form role="form">
      <div class="card-body">
         
        <label class="text-info">Información</label>
        <hr class="mt-0">
        <div class="row">
          <div class="col-12 col-md-6">
            <div class="form-group">
                <label for="cuotas">Fecha de registro</label>
                <div class="">
                  <input type="text" class="form-control" name="cuotas" disabled id="txt-fecha-registro">
                </div>
              </div>
          </div>

          <div class="col-12 col-md-6">
            <div class="form-group">
                <label for="cuotas">Hora de registro</label>
                <div class="">
                  <input type="text" class="form-control" name="cuotas" disabled id="txt-hora-registro">
                </div>
              </div>
          </div>
        </div>
        
        <div class="row">
          <!-- Cliente  -->
          <div class="col-12 col-sm-6">
            <div class="form-group">
                <label>Cliente</label>
                <select class="form-control select2 select2-hidden-accesible lista-clientes" style="width: 100%;"
                  id="cmb-cuota-cliente"  data-select2-id="1" tabindex="-1" aria-hidden="true">
                </select>
            </div>  
          </div>

          <!-- Préstamo -->
          <div class="col-12 col-sm-6">
            <div class="form-group">
              <label>Préstamo</label>
              <select class="form-control select2 select2-hidden-accesible" style="width: 100%;"
                id="cmb-prestamo"  data-select2-id="1" tabindex="-1" aria-hidden="true">
                <option value="0" selected>Elija el préstamo </option>
                <option>$100</option>
              </select>
            </div>

          </div>
        </div>

        <label class="text-info mt-4">Detalle Cuota</label>
        <hr class="mt-0">

        <div class="row">
          <div class="col-12 col-md-6">
            <div class="form-group">
              <label for="fecha-estimada">Fecha Estimada</label>
              <div class="">
                <input type="text" class="form-control" name="fecha-estimada" 
                disabled id="txt-fecha-estimada"val="20/09/2019">
              </div>
              </div>
          </div>

          <div class="col-12 col-md-6">
            <div class="form-group">
                <label for="fecha-pago">Fecha de Pago</label>
                <div class="">
                  <input type="date" class="form-control" name="fecha-pago" id="txt-fecha-pago">
                </div>
              </div>
          </div>    
        </div>

        <div class="row">
          <div class="col-12 col-md-6">
              <div class="form-group">
                <label for="cuota">Valor cuota</label>
                <div class="">
                  <input type="text" class="form-control" name="cuota" 
                  disabled id="txt-cuota-valor" placeholder="$4">
                </div>
                </div>
            </div>

            <div class="col-12 col-md-6">
              <div class="form-group">
                  <label for="cuota-pago">Valor a Pagar</label>
                  <div class="">
                    <input type="number" class="form-control" name="cuota-pago" id="txt-cuota-pago"
                    placeholder="$5">
                  </div>
                </div>
            </div>
        </div>

        <div class="row">
          <div class="col-12 col-sm-6">
             <!-- select -->
            <div class="form-group">
              <label>Estatus</label>
              <select class="form-control" id="cmb-interes">
                <option value="0" selected>Seleccione una opcion</option>
                <option>Pagado</option>
                <option>Abonado</option>
              </select>
            </div>
          </div>
        </div>
        
        <label class="text-info mt-4">Detalle Saldos</label>
        <hr class="mt-0">
        <div class="row">              
          <div class="col-12 col-md-6">
              <div class="form-group">
                <label for="deuda-inicial">Deuda Inicial</label>
                <div class="">
                  <input type="number" class="form-control" name="deuda-inicial" 
                  disabled id="txt-deuda-inicial" value="100">
                </div>
                </div>
            </div>

            <div class="col-12 col-md-6">
              <div class="form-group">
                  <label for="deuda-actual">Saldo Actual</label>
                  <div class="">
                    <input type="number" class="form-control" name="deuda-actual" id="txt-deuda-actual"
                    placeholder="$5" disabled>
                  </div>
                </div>
            </div>    
        </div>
      </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <button type="submit" class="btn btn-success">Registrar Cuota</button>
        <button class="btn btn-dark" id="btn-limpiar">Limpiar campos</button>
      </div>
    </form>
  </div>
  <!-- /.card -->
</div>

<div class="col-md-3">
  <div class="row">
    <div class="col-12">
        <!-- small box -->
      <div class="small-box bg-info">
        <div class="inner">
          <h6 id="info-cliente" class="font-weight-bold">-</h6>

          <p>Cliente</p>
        </div>
        <div class="icon">
          <i class="ion ion-bag"></i>
        </div>
      </div>
    </div>

    <!-- ./col -->
    <div class="col-12">
      <!-- small box -->
      <div class="small-box bg-success">
        <div class="inner">
          <h3 id="info-prestamo">-</h3>
          <p>Préstamo Inicial</p>
        </div>
        <div class="icon">
          <i class="ion ion-stats-bars"></i>
        </div>
      </div>
    </div>
    
     <!-- ./col -->
     <div class="col-12">
      <!-- small box -->
      <div class="small-box bg-dark">
        <div class="inner">
          <h3 id="info-cuota-pagar">- </h3>

          <p>Valor a pagar</p>
        </div>
        <div class="icon">
          <i class="ion ion-pie-graph"></i>
        </div>
      </div>
    </div>

    <!-- ./col -->
    <div class="col-12">
      <!-- small box -->
      <div class="small-box bg-danger">
        <div class="inner">
          <h3 id="info-saldo-restante">-</h3>

          <p>Saldo Restante</p>
        </div>
        <div class="icon">
          <i class="ion ion-pie-graph"></i>
        </div>
      </div>
    </div>
    <!-- ./col -->
  </div>
</div>
</div>

<!-- /.row (main row) -->