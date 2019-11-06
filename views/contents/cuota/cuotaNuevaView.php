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
    <form role="form" method="POST" id="form-nuevo-cuota" action="">
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
              <div class="row">
                <div class="col-12 d-flex justify-content-between">
                  <label >Préstamo</label>
                  <label id="id-prestamo-cuota" class="mr-2 text-danger"></label>
                </div>
              </div>
              <select class="form-control select2 select2-hidden-accesible" style="width: 100%;"
                id="cmb-prestamo-cuota"  data-select2-id="1" tabindex="-1" aria-hidden="true">
                <option value="0" selected>Elija el préstamo </option>
                <!-- <option>$100</option> -->
              </select>
            </div>

          </div>
        </div>

        <label class="text-info mt-4">Detalle Cuota</label>
        <hr class="mt-0">

        <div class="row">
          <!-- <div class="col-12 col-md-6">
            <div class="form-group">
              <label for="fecha-estimada">Fecha Estimada</label>
              <div class="">
                <input type="text" class="form-control" name="fecha-estimada" 
                disabled id="txt-fecha-estimada"val="20/09/2019">
              </div>
              </div>
          </div> -->

          <div class="col-12 col-md-6">
            <div class="form-group">
                <label for="fecha-pago">Fecha de Pago</label>
                <div class="">
                  <input type="date" class="form-control" name="fecha-pago" id="txt-fecha-pago">
                </div>
              </div>
          </div>    

          <div class="col-12 col-md-6">
              <div class="form-group">
                <label for="cuota">Valor cuota $</label>
                <div class="">
                  <input type="text" class="form-control" name="cuota" 
                  disabled id="txt-cuota-valor">
                </div>
                </div>
            </div>

            <div class="col-12 col-md-6">
              <div class="form-group">
                  <label for="cuota-pago">Valor a Pagar $</label>
                  <div class="">
                    <input type="number" class="form-control" name="cuota-pago" id="txt-cuota-pago"
                    placeholder="$5">
                  </div>
                </div>
            </div>
 
          <div class="col-12 col-sm-6">
             <!-- select -->
            <div class="form-group">
              <label>Estatus</label>
              <select class="form-control comboEstatus" id="cmb-status-cuota">
                <option value="0" selected>Seleccione una opcion</option>
              </select>
            </div>
          </div>
        </div>
        
        <label class="text-info mt-4">Detalle Saldos</label>
        <hr class="mt-0">
        <div class="row">              
          <div class="col-12 col-md-6">
              <div class="form-group">
                <label for="deuda-inicial">Deuda Actual $</label>
                <div class="">
                  <input type="number" class="form-control" name="deuda-inicial" 
                  disabled id="txt-deuda-inicial" value="0">
                </div>
                </div>
            </div>

            <div class="col-12 col-md-6">
              <div class="form-group">
                  <label for="deuda-actual">Saldo Restante $</label>
                  <div class="">
                    <input type="number" class="form-control" name="deuda-actual" id="txt-deuda-actual"
                    placeholder="$0" disabled>
                  </div>
                </div>
            </div>    
        </div>

        <label class="text-info mt-4">Información Adicional</label>
        <hr class="mt-0">
        <div class="row">              
          <div class="col-12">
              <div class="form-group">
                <label for="deuda-inicial">Observación</label>
                <div class="">
                  <!-- <input type="number" class="form-control" name="txt-cuota-observacion" 
                  disabled id="txt-cuota-observacion" value="0"> -->
                  <textarea rows="2" id="txt-cuota-observacion" class="form-control"> </textarea>
                </div>
                </div>
            </div> 
        </div>
      </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <button type="submit" class="btn btn-success">Registrar Cuota</button>
        <button class="btn btn-dark" id="btn-limpiar-cuota">Limpiar campos</button>
      </div>

      <div class="error-datos"></div>
    </form>
  </div>
  <!-- /.card -->
</div>

<!-- Card de Información -->

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
          <i class="fas fa-user fa-lg"></i>
        </div>
      </div>
    </div>

     <!-- ./col -->
     <div class="col-12">
      <!-- small box -->
      <div class="small-box bg-success">
        <div class="inner">
          <h3 id="info-prestamo-inicial">-</h3>
          <p>Deuda Inicial</p>
        </div>
        <div class="icon">
          <i class="fas fa-hand-holding-usd"></i>
        </div>
      </div>
    </div>

    <!-- ./col -->
    <div class="col-12">
      <!-- small box -->
      <div class="small-box bg-warning">
        <div class="inner">
          <h3 id="info-prestamo">-</h3>
          <p>Deuda Actual</p>
        </div>
        <div class="icon">
          <i class="fas fa-dollar-sign"></i>
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
          <i class="fas fa-money-check-alt"></i>
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
         <i class="fas fa-file-invoice-dollar"></i>
        </div>
      </div>
    </div>
    <!-- ./col -->
  </div>
</div>
</div>

<!-- /.row (main row) -->