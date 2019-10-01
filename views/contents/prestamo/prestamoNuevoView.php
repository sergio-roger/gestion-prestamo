<!-- Fila del formulario -->
 <div class="row">

  <!-- left column -->
  <div class="col-md-9">
    <!-- general form elements -->
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Registro de Préstamo</h3>
        <button id="btn-id-cliente" class="btn btn-dark d-none">Obtener valor del clientes</button>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form role="form">
        <div class="card-body">
          
          <div class="form-group">
            <label>Cliente</label>
            <select class="form-control select2 select2-hidden-accesible lista-clientes" style="width: 100%;"
              id="cmb-buscador"  data-select2-id="1" tabindex="-1" aria-hidden="true">
              <!-- <option selected="selected">Seleccione una opcion</option> -->
            </select>
          </div>

          <div class="row">
            <div class="col-12 col-sm-6">
                <div class="form-group">
                    <!-- select -->
                    <div class="form-group">
                      <label>Monto</label>
                      <select class="form-control comboMontos" id="cmb-monto">
                        <!-- <option value="0">Seleccione una opcion</option> -->
                      </select>
                    </div>
                  </div>
            </div>

            <div class="col-12 col-sm-6">
              <!-- select -->
              <div class="form-group">
                <label>Interes %</label>
                <select class="form-control comboIntereses" id="cmb-interes">
                  <!-- <option value="0" selected>Seleccione una opcion</option> -->
                </select>
              </div>
            </div>
          </div>

          <div class="row">
              <div class="col-12 col-sm-6">
                <div class="form-group">
                  <!-- select -->
                  <div class="form-group">
                    <label>Plazo en días</label>
                    <select class="form-control" id="cmb-plazo">
                      <option value="0" selected>Seleccione una opcion</option>
                      <option>30</option>
                      <option>40</option>
                      <option>50</option>
                      <option>60</option>
                    </select>
                  </div>
                  </div>
              </div>

              <div class="col-12 col-sm-6">
                <!-- select -->
                <div class="form-group">
                    <label>Estatus</label>
                    <select class="form-control" id="cmb-status">
                      <option value="0" selected>Seleccione una opcion</option>
                      <option>Inicio</option>
                      <option>Cancelando</option>
                      <option>Renovado</option>
                      <option>Finalizado</option>
                    </select>
                  </div>
              </div>
          </div>

          <div class="row">
            <div class="col-12 col-sm-6">
                <div class="form-group">
                    <label for="cliente">Fecha Inicio</label>
                    <div class="cliente-box d-flex">
                      <input type="date" class="form-control" id="cliente" placeholder="">
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-group">
                    <label for="cliente">Fecha Fin</label>
                    <div class="cliente-box d-flex">
                      <input type="date" class="form-control" id="cliente" placeholder="">
                    </div>
                </div>
            </div>
          </div>

          <div class="row">
            <div class="col-12 col-sm-6">
              <div class="form-group">
                <label for="cuotas">Cuotas diarias $</label>
                <div class="">
                  <input type="text" class="form-control" name="cuotas" id="txt-cuota" disabled>
                </div>
              </div>
            </div>
            
            <div class="col-12 col-sm-6">
              <div class="form-group">
                <label for="cuotas">Fecha registro</label>
                <div class="">
                  <input type="text" class="form-control" name="cuotas" disabled id="txt-fecha-registro">
                </div>
              </div>
            </div>

            <div class="col-12">
                <div class="form-group">
                    <label>Observación</label>
                    <div class="">
                      <textarea class="form-control" name="" id="txt-observacion" rows="3" placeholder="Alguna obsevación"></textarea>
                    </div>
                </div>
            </div>
          </div>

          <div class="form-check">
            <input type="checkbox" class="form-check-input" id="termino" value="S">
            <label class="form-check-label" for="termino" value="S">Acepta cancelar regularmente todas las cuotas</label>
          </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
          <button type="submit" class="btn btn-primary">Realizar préstamo</button>
          <button class="btn btn-dark" id="btn-limpiar">Limpiar campos</button>
        </div>
      </form>
    </div>
    <!-- /.card -->
  </div>

  <div class="col-md-3">
    <div class="row">
      <div class="col-12">
        <div class="info-box">
          <span class="info-box-icon bg-danger"><i class="fas fa-calculator"></i></span>

          <div class="info-box-content">
            <span class="info-box-number">Simulador</span>
            <span class="info-box-number">de préstamo</span>
          </div>
          <!-- /.info-box-content -->
        </div>
      </div>

      <div class="col-12">
          <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">
            <h3 id="info-monto">-</h3>

            <p>Total a prestar</p>
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
            <h3 id="info-interes">-<sup style="font-size: 20px">%</sup></h3>
            <p>Interes</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
        </div>
      </div>

      <!-- ./col -->
      <div class="col-12">
        <!-- small box -->
        <div class="small-box bg-warning">
          <div class="inner">
            <h3 id="info-plazo">-</h3>

            <p>Plazo en días</p>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
        </div>
      </div>
      
      <!-- ./col -->
      <div class="col-12">
        <!-- small box -->
        <div class="small-box bg-dark">
          <div class="inner">
            <h3 id="info-cuota">- </h3>

            <p>Cuota diria</p>
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
            <h3 id="info-total">-</h3>

            <p>Total a recibir</p>
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
