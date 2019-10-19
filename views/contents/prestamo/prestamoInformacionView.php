<div id="loader"></div>

<div class="preloader-loading d-none">
  <div class="row">
    <div class="col-12 mb-4">
        <a href="<?= BASE?>prestamoListar" class="btn bg-teal color-palette">
          <i class="fas fa-arrow-left"></i>
        </a>
        <!-- <a href="<?php // BASE?>clienteNuevo" class="btn bg-maroon color-palette ml-2">
        <i class="fas fa-user-plus"></i>
        </a>
        <a href="<?php // BASE?>clienteListar" class="btn bg-maroon color-palette ml-2">
          <i class="fas fa-users"></i>
        </a> -->
        <a href="<?= BASE?>prestamoNuevo" class="btn bg-purple color-palette ml-4">
          <i class="fas fa-hand-holding-usd"></i>
        </a>
    </div>
  </div>
  <div class="row">
      <div class="col-12 col-md-5">
          <div class="card">
              <div class="card-header">
              <h3 class="card-title">
                  <i class="fas fa-info-circle"></i>
                  Información Detallada
              </h3>
              </div>
              <div class="card-body">
              <dl class="dl-horizontal">
                  <div class="d-flex justify-content-between">
                      <strong>Id</strong>
                      <em><?= $idPrestamo?></em>
                  </div>
                  <div class="d-flex justify-content-between">
                      <strong>Cliente</strong>
                      <em id="card-info-prestamo-cliente">Pepe Solorzano</em>
                  </div>
                  <div class="d-flex justify-content-between">
                      <strong>Monto</strong>
                      <em id="card-info-prestamo-monto">$ 300</em>
                  </div> <div class="d-flex justify-content-between">
                      <strong>Interés</strong>
                      <em id="card-info-prestamon-interes">20 %</em>
                  </div>
              
                  <div class="d-flex justify-content-between">
                      <strong>Plazo</strong>
                      <em id="card-info-prestamo-plazo">30 días</em>
                  </div>
                  <div class="d-flex justify-content-between">
                      <strong>Estatus</strong>
                      <em id="card-info-prestamo-estatus">Pagando</em>
                  </div>
                  <div class="d-flex justify-content-between">
                      <strong>Cuota Diaria</strong>
                      <em id="card-info-prestamo-cuota">$ 2</em>
                  </div>
                  <div class="d-flex justify-content-between">
                      <strong>Fecha Inicio</strong>
                  <em id="card-info-prestamo-fecha-inicio">20/10/2019</em>
                  </div>
                  <div class="d-flex justify-content-between">
                      <strong>Fecha Fin</strong>
                      <em id="card-info-prestamo-fecha-fin">20/11/2019</em>
                  </div>

                  <div class="d-flex justify-content-between">
                      <strong>Términos Aceptados</strong>
                      <em id="card-info-prestamo-termino">Sí</em>
                  </div>

                  <div class="d-flex justify-content-between">
                      <strong>Visibilidad</strong>
                      <em id="card-info-prestamo-visible">Visible</em>
                  </div>

                  <div class="d-flex justify-content-between">
                      <strong class="mr-4">Observación</strong>
                  </div>
                  <div class="d-flex justify-content-between mt-2">
                      <em id="card-info-prestamo-observacion" class="text-justify">Hola Soy una observación</em>
                  </div>
                  
                  <hr>

                  <div class="mt-4">
                    <h6 class="text-danger">
                      <strong>Información de Adicional</strong>
                    </h6>
                    <div class="d-flex justify-content-between">
                      <strong>Fecha de Registro</strong>
                      <em id="card-info-cliente-registro">2019/08/12</em>
                    </div>
                    <div class="d-flex justify-content-between">
                      <strong>Última actualización</strong>
                      <em id="card-info-cliente-update">2019/08/12</em>
                    </div>
                  </div>
              </dl>
              </div>
          </div>
      </div>

      <div class="col-12 col-md-7">
          <div class="col-12">
              <div class="card">
                  <div class="card-header">
                      <h3 class="card-title">
                          <i class="fas fa-info-circle"></i>
                          Acerca del Monto
                      </h3>
                  </div>
                  <div class="card-body">
                      <dl class="dl-horizontal" style="margin-bottom: 0rem !important;">
                          <div class="row">
                              <div class="col-12 col-md-4">
                                  <div class="info-box">
                                      <span class="info-box-icon bg-info">
                                            <i class="fas fa-hand-holding-usd"></i>
                                      </span>
                                      <div class="info-box-content">
                                          <span class="info-box-text">
                                              Deuda Inicial
                                          </span>
                                          <span class="info-box-number" id="prestamo-deuda-inicial">
                                              $60
                                          </span>
                                      </div>
                                  </div>
                              </div>

                              <div class="col-12 col-md-4">
                                  <div class="info-box">
                                      <span class="info-box-icon bg-olive color-palette">
                                          <i class="fas fa-dollar-sign"></i>
                                      </span>
                                      <div class="info-box-content">
                                          <span class="info-box-text">
                                              Valor Pagado
                                          </span>
                                          <span class="info-box-number" id="prestamo-deuda-pagado">
                                              $ 40
                                          </span>
                                      </div>
                                  </div>
                              </div>
                              
                              <div class="col-12 col-md-4">
                                  <div class="info-box">
                                      <span class="info-box-icon bg-maroon color-palette">
                                          <i class="fas fa-dollar-sign"></i>
                                      </span>
                                      <div class="info-box-content">
                                          <span class="info-box-text">
                                              Deuda Actual
                                          </span>
                                          <span class="info-box-number" id="prestamo-deuda-actual">
                                            $20
                                          </span>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </dl>
                  </div>
              </div>
          </div>

          <div class="col-12">
              <!-- DONUT CHART -->
              <div class="card card-danger">
                <div class="card-header">
                  <h3 class="card-title">Deuda</h3>

                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <canvas id="doneMonto" style="height:230px; min-height:230px">
                  </canvas>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
          </div>
      </div>
  </div>
</div>

<script>

  $(function(){

    _init();
  
    function _init(){
      var loader = $("#loader");
      loader.gSpinner();
      // getInfoCliente(loader);
      
      datosUsuario();
      getInfoPrestamo(loader);  
      // graficaMonto();
    }

    function datosUsuario(){
        //Esta función actualiza los datos del Usuario
        var idUsuario = $('#id-Usuario').attr('value');
        var ruta = '../ajax/DatosUsuarioAjax.php';
      
        $.ajax({
          'method': 'POST',
          'url':    ruta,
          'data':   {'id': idUsuario}
        })
        .done(function(response){
          response = JSON.parse(response);
          // console.log(response);
    
          if(response.result){
            var usuario = response.data;
            var name  = usuario.usu_nombres + ' ' + usuario.usu_apellidos
            //alert("Usuario existe");
            $('.usuario-name').html(name);
            $('.usuario-correo').html(usuario.usu_correo);
            $('.usuario-direccion').html(usuario.usu_direccion);
            $('.usuario-usuario').html(usuario.usu_usuario);
            $('.usuario-telefono').html(usuario.usu_telefono);
            $('.usuario-cargo').html(usuario.usu_cargo);
      
            if(usuario.usu_sexo == 'M')
              $('.usuario-sexo').html('Masculino');
            else
              $('.usuario-sexo').html('Femenino');
      
            datosPerfilForm(usuario);
          }
        });
    }

   function graficaMonto(x,y){
      //-------------
      //- DONUT CHART -
      //-------------
      // Get context with jQuery - using jQuery's .get() method.
      var donutChartCanvas = $('#doneMonto').get(0).getContext('2d');
      var donutData  = {
        labels: [
          'Valor Pagado', 
          'Deuda Actual'
        ],
        datasets: [{
            data: [x,y],
            backgroundColor : ['#3d9970','#d81b60'],
          }
        ]
      }

      var donutOptions = {
        maintainAspectRatio : false,
        responsive : true,
      }
      //Create pie or douhnut chart
      // You can switch between pie and douhnut using the method below.
      var donutChart = new Chart(donutChartCanvas, {
        type: 'doughnut',
        data: donutData,
        options: donutOptions      
      });
   }

   function getInfoPrestamo(preloader){
    let ruta = '../ajax/PrestamoAjax.php';
        let dataJson = {
          type:"onePrestamo",
          method:"get",
          entidad:"prestamo",
          id: '<?= $idPrestamo?>',
          archivo: ruta
        };

        $.ajax({
          'method':'GET',
          'url': ruta,
          'data': { 'data': JSON.stringify(dataJson)}
        })
        .done(function(response){
          response = JSON.parse(response);

          if(response.result){
            rellenarInfoPrestamo(response.prestamo);
            // console.log(response);
          }
        })
        .fail(function(){
          console.log('error en ajax POST cliente');
        })
        .always(function(){
          // $loader.gSpinner('hide');
          preloader.gSpinner('hide');
          $('.preloader-loading').removeClass('d-none');
          // console.log('Petición ajax completa');
        });
   }

   function rellenarInfoPrestamo(prestamo){
    $('#card-info-prestamo-cliente').html(prestamo.nombres);
    $('#card-info-prestamo-monto').html('$ ' + prestamo.monto);
    $('#card-info-prestamon-interes').html(prestamo.interes + ' %');
    let plazo = prestamo.plazoDuracion + ' '+ prestamo.plazoPeriodo;
    $('#card-info-prestamo-plazo').html(plazo);
    $('#card-info-prestamo-estatus').html(prestamo.det_estatus);
    $('#card-info-prestamo-cuota').html('$ ' + prestamo.pres_cuota);
    $('#card-info-prestamo-fecha-inicio').html(prestamo.fecha_inicio);
    $('#card-info-prestamo-fecha-fin').html(prestamo.fecha_fin);
    $('#card-info-prestamo-termino').html(prestamo.pres_termino);
    visible = prestamo.pres_visible  == 'V' ? 'Visible' : 'Oculto';
    $('#card-info-prestamo-visible').html(visible);
    $('#card-info-prestamo-observacion').html(prestamo.pres_observacion);
    $('#card-info-cliente-registro').html(prestamo.pres_fecha_registro);
    $('#card-info-cliente-update').html(prestamo.pres_fecha_update);

    //Calculos para los widgets de deudas y el grafico
    let porcentaje = 100.00;
    let diferencia = parseFloat(prestamo.pres_total) - parseFloat(prestamo.pres_pagado);
    let xPagado = (porcentaje * parseFloat(prestamo.pres_pagado))/parseFloat(prestamo.pres_total);

    xPagado = formatear(xPagado);

    let yActual = porcentaje - xPagado ;
    // console.log(xPagado);
    // console.log(yActual);

    $('#prestamo-deuda-inicial').html('$ ' + prestamo.pres_total);
    $('#prestamo-deuda-pagado').html('$ ' + prestamo.pres_pagado);
    $('#prestamo-deuda-actual').html('$ ' + diferencia);

    graficaMonto(xPagado, yActual);
   }

   function formatear(numero){
      numero = numero.toString();  
     
      n = numero.indexOf('.') >= 1 ?  trunc(parseFloat(numero), 2) : parseFloat(numero);
      return n;
   }

   function trunc (x, posiciones = 0) {
      var s = x.toString()
      var l = s.length
      var decimalLength = s.indexOf('.') + 1
      var numStr = s.substr(0, decimalLength + posiciones)
      return Number(numStr)
    }


  });

</script>