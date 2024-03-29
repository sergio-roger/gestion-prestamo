// $('.daterangepicker')
var monto = 0, interes = 0, plazo = 0; 
var total = 0, n_cuotas;
var arrayEstatus = [];
var span = ' <span>$</span>';
var BASE = 'http://localhost:8080/Webs/CrediExpress-Des/';

$(document).ready(function(){
  var hoy = obtenerFecha();

  __init__();
  
  function __init__(){
    procesos();
    peticionesAjax();
  }

  function procesos(){
    oculat_info_pie();
    startTime();
    validarNumeros();
    onlyNumbers();
    filtrarPrestamos();
    enviarMensajeConfirmacion();
    limparNuevaCuota();
  }
  
  function peticionesAjax(){
  
    let peticiones = {
      result: true,
      funciones: {
        _1datosUsuario: '1.- Cargar datos del Usuario',
        _2cargarClientes: '2.- Peticiones de cargar clientes',
        _3countClientes: '3.- Contar clientes',
        _4getMontos: '4.- Carga los montos',
        _5getIntereses: '5.- Carga los intereses',
        _6getPlazos: '6.- Carga de plazos',
        _7getEstatus: '7.- Carga de estatus',
        // _8listarPrestamos: '8.- listar prestamos',
        _9countPrestamos: '8.- Contar préstamos', 
        _13getTipoMovimientos: '9 getTipoMovimientos obtiene los tipos de movimientos',
        _10obtenerPrestamoCliente: '10.- obtener prestamo según id',
        _11comboPrestamosID: '11.- Obtiene todos los pestamos en un combo',
        _12getPrestamosLimit: '12 getPrestamosRecientes con un límite'
      }
    };

    datosUsuario();
    listarClientes();
    cargarClientes();
    countClientes();
    getMontos();
    getIntereses();
    getPlazos();
    getEstatus();
    getEstatusFiltro();
    // listaPrestamos();
    countPrestamo();
    getTipoMovimientos();
    obtenerPrestamoCliente();
    comboPrestamosID();
    getPrestamosRecientes();

    console.log(peticiones);
  }

  function datosUsuario(){
    //Esta función actualiza los datos del Usuario
    var idUsuario = $('#id-Usuario').attr('value');
    var ruta = 'ajax/DatosUsuarioAjax.php';
  
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
        
        if(usuario.usu_verificar == '' || usuario.usu_verificar == null || usuario.usu_verificar != 'S'){
          // let plantilla_verificar = ``;
          $('#verificar-usuario').removeClass('d-none');
        }

        datosPerfilForm(usuario);
      }
    });
  }
  
  function cargarClientes(){
    dataJson = {
      type:"all",
      method:"get",
      entidad:"clientes"
    };
  
    //dataJson = JSON.stringify(dataJson);
    let allClientes = new Ajax('ajax/DatosGeneraleAjax.php','GET', dataJson);
    
    allClientes.__ajax()
    .done(function(response){
      response = JSON.parse(response);
      //console.log(response);
      if(response.result){
        //console.log(response);
        var comboCliente = '<option value="0">Seleccione un cliente<option>'; 
        var tablaCliente;

        for(var i in response.clientes){
        //   console.log(response.clientes[i]);
          var nombres = response.clientes[i].cli_apellidos + ' ' + response.clientes[i].cli_nombres;
          comboCliente += `<option value="${response.clientes[i].id}"> ${nombres}</option>`;
        }
        //$('.prestamo-clientes').html(tablaCliente);
        $('.lista-clientes').html(comboCliente);
        //console.log(response);
  
      }
    });
  }

  function listarClientes(){
    $('#tb-clientes').DataTable({
      destroy:true,
      pageLength:10,
      responsive:true,
      processing:true,
      ajax:'ajax/TablaClientesAjax.php',
      language:{
              "sProcessing":     "Procesando...",
              "sLengthMenu":     "Mostrar _MENU_ registros",
              "sZeroRecords":    "No se encontraron resultados",
              "sEmptyTable":     "Ningún dato disponible en esta tabla",
              "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
              "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
              "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
              "sInfoPostFix":    "",
              "sSearch":         "Buscar:",
              "sUrl":            "",
              "sInfoThousands":  ",",
              "sLoadingRecords": "Cargando...",
              "oPaginate": {
                  "sFirst":    "Primero",
                  "sLast":     "Último",
                  "sNext":     "Siguiente",
                  "sPrevious": "Anterior"
              },
              "oAria": {
                  "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                  "sSortDescending": ": Activar para ordenar la columna de manera descendente"
              }
          }
    });
  }

  function countClientes() {
    var ruta = 'ajax/DatosGeneraleAjax.php';
  
    //Formato JSON
    var dataJson = {
      type:'count',
      method:'get',
      entidad: 'clientes',
      archivo: ruta
    };
  
    var contar = new Ajax('ajax/DatosGeneraleAjax.php','GET', dataJson);
  
    contar.__ajax()
    .done(function(response){
    //  console.log(response);
      response = JSON.parse(response);
        
      if(response.result){
        $('.total-clientes').html(response.total.cantidad);
        //console.log(response.total.cantidad)
      }
    });
  }

  function getMontos(){
    let ruta = 'ajax/LlenarCombosAjax.php';
  
    let dataJson = {
      type:'all',
      method:'get',
      entidad:'montos'
    };
  
    let  montos = new Ajax(ruta,'GET', dataJson);
  
    montos.__ajax()
    .done(function(response){
      response = JSON.parse(response);
      let option = '<option value="0">Seleccione una opcion</option> ';
  
      if(response.result){
        for (var i in response.montos)
          option += `<option value="${response.montos[i].id}">${response.montos[i].mon_cantidad}</option>`;
      }

      $('.comboMontos').html(option);

    });
  }
  
  function comboPrestamosID(){

    let ruta = 'ajax/PrestamoAjax.php'; 
    let prestamoJSON = {
      type:'all',
      method:'get',
      entidad:'prestamos'
    };

    let insertarPrestamo = new Ajax(ruta,'GET', prestamoJSON);
    
    insertarPrestamo.__ajax()
    .done(function(response){
      // //La strinjson convertir a formato JSON
      response = JSON.parse(response);
      
      if(response.result){
        // console.log(response);

        let option = '<option value="0">Seleccione una opción</option>';
        for(let i in response.prestamos){
            if(response.prestamos[i].est_id != 1){
              option += `<option value="${response.prestamos[i].id}">ID - ${response.prestamos[i].id}</option>`;
            }
        }
        $('.llenaComboPrestamoID').html(option);
      }
    });
  }

  function getIntereses(){
    let ruta = 'ajax/LlenarCombosAjax.php';
  
    let dataJson = {
      type:'all',
      method:'get',
      entidad:'intereses'
    };
  
    let  intereses = new Ajax(ruta,'GET', dataJson);
    
    intereses.__ajax()
    .done(function(response) {
      response = JSON.parse(response);
      var option = '<option value="0">Seleccione una opcion</option> ';
  
      if(response.result){
        for (var i in response.intereses)
          option += `<option value="${response.intereses[i].id}">${response.intereses[i].int_porcentaje}</option>`;
      }
      $('.comboIntereses').html(option);
    });
  }

  function getPlazos(){
    let ruta = 'ajax/LlenarCombosAjax.php';
  
    let dataJson = {
      type:'all',
      method:'get',
      entidad:'plazos',
      modo: 'dias'
    }
  
    let  plazos = new Ajax(ruta,'GET', dataJson);
    
    plazos.__ajax()
    .done(function(response) {
      
      response = JSON.parse(response);
      // console.log(response);
      var option = '<option value="0">Seleccione una opcion</option> ';
  
      if(response.result){
        for (var i in response.plazos)
          option += `<option value="${response.plazos[i].id}">${response.plazos[i].pla_duracion}</option>`;
      }
      $('.comboPlazos').html(option);
    });
  
  }
  
  function getEstatus(){
    let ruta = 'ajax/LlenarCombosAjax.php';
  
    let dataJson = {
      type:'all',
      method:'get',
      entidad:'estatus',
    }
  
    let  estatus = new Ajax(ruta,'GET', dataJson);
    
    estatus.__ajax()
    .done(function(response) {
      
      response = JSON.parse(response);
      // console.log(response);
      var option = '<option value="0">Seleccione una opcion</option> ';
  
      arrayEstatus = [];

      if(response.result){
        for (var i in response.estatus){
          arrayEstatus.push(response.estatus[i].id);
          option += `<option value="${response.estatus[i].id}">${response.estatus[i].est_detalle}</option>`;
        }

      }
  
      $('.comboEstatus').html(option);
    });
  }

  function getEstatusFiltro(){
    let ruta = 'ajax/LlenarCombosAjax.php';
  
    let dataJson = {
      type:'all',
      method:'get',
      entidad:'estatus',
    }
  
    let  estatus = new Ajax(ruta,'GET', dataJson);
    
    estatus.__ajax()
    .done(function(response) {
      
      response = JSON.parse(response);
      // console.log(response);
      var option = '<option value="0">Todos</option> ';
  
      if(response.result){
        for (var i in response.estatus)
          option += `<option value="${response.estatus[i].id}">${response.estatus[i].est_detalle}</option>`;
      }
  
      $('.comboEstatusFiltro').html(option);
    });
  }

  function countPrestamo(){
    dataJson = {
      type:"count",
      method:"get",
      entidad:"prestamo"
    };
  
    let countPrestamos = new Ajax('ajax/PrestamoAjax.php','GET', dataJson);
    countPrestamos.__ajax()
    .done(function(response){
      response = JSON.parse(response);
      // console.log(response);
      if(response.result){
        $('#totalPrestamos').html(response.total);
      }
    });
  }

  function getTipoMovimientos(){
    let ruta = 'ajax/TipoMovimientosAjax.php';
  
    let dataJson = {
      type:'all',
      method:'get',
      entidad:'tiposmovimientos',
    }
  
    let  estatus = new Ajax(ruta,'GET', dataJson);
    
    estatus.__ajax()
    .done(function(response) {
      
      response = JSON.parse(response);
      option = '';
      
      arrayEstatus = [];
      
      if(response.result){
        // console.log(response);
        for (let i in response.tipoMovimientos){
          let tm = response.tipoMovimientos[i];
          let color = tm.tm_operacion == '+' ? 'success' : 'danger'; 
          // console.log(tm);

          option += `<div class="callout callout-${color} p-05">
            <h5 class="d-flex justify-content-between">
                <b class="mr-2">${tm.tm_operacion}</b>${tm.tm_cuenta}
                <input type="radio" name="tipoMovimiento">
            </h5>
            <!-- <p>This is a green callout.</p> -->
          </div>`;
        }
      }
      $('#body-tipoMovimientos').html(option);
    });
  }

  $('[data-toggle="tooltip"]').tooltip();
  $('#txt-cuota').val('');
  $('#txt-fecha-registro').val(hoy);
  
  $('.question').click(function(){
    __sweetSimpe('Los campos con *','Los campos que tienen * son obligatorio llenarlos','info');
  });

  //Actualizando dinámicamente los widgets de la derecha
  $("#cmb-monto").change(function(){
     var op = $("#cmb-monto option:selected").val();
     var texto = $("#cmb-monto option:selected").text();
  
    // $('#capa').html(op);
    //  console.log("Opcion: " + op);
    if(op != "0"){
      $('#info-monto').html(texto + span);
      monto = parseInt(texto);
  
      calcularCuotasDiarias();
    }else{
      $('#info-monto').html('-');
      monto = 0;
    }
  });
  
  // Actualizando dinámicamente el interes
  $('#cmb-interes').change(function(){
    var op = $('#cmb-interes option:selected').val();
    var texto = $('#cmb-interes option:selected').text();
    var sup = '<sup style="font-size: 20px">%</sup>';
  
    if(op != "0"){
      $('#info-interes').html(texto + sup);
      interes = parseInt(texto);
      calcularCuotasDiarias();
  
    }else{
      $('#info-interes').html('-');
      interes = 0;
    }
  });

  $('#cmb-plazo').change(function(){
    var op = $('#cmb-plazo option:selected').val();
    var text = $('#cmb-plazo option:selected').text();
  
  
    if(op != "0"){
      $('#info-plazo').html(text);
      plazo = parseInt(text);
  
      calcularCuotasDiarias();
    }else{
      plazo = 0;
    }
  });
  
  $('#cmb-cuota-cliente').change(function(){
    var texto = $('#cmb-cuota-cliente option:selected').text();
    var op = $('#cmb-cuota-cliente option:selected').val();
  
    if(op != "0"){
      $('#info-cliente').html(texto);
    }else{
      $('#info-cliente').html('');
    }
  });
  
  $('#cmb-prestamo').change(function(){
    var op = $('#cmb-prestamo option:selected').val();
  
    if(op != "0"){
      $('#info-prestamo').html(op);
    }
  });

  $('#cmb-listar-prestamos-cuotas').change(function(){
    // let texto = $('#cmb-listar-prestamos-cuotas option:selected').text();
    let id = $('#cmb-listar-prestamos-cuotas option:selected').val();

    if(parseInt(id) == 0){
      subLimpiarCuotaDetallada();
    }else{
      getInfoPrestamo(id);
      tablaCuotasDetalladas(id);
    }
  });

  function subLimpiarCuotaDetallada(){
    $('#tabla-body-cuotas').html('<tr></tr>');
    $('#clv-cliente').html('');
    $('#clv-fechaInicio').html('');
    $('#clv-fechaFin').html('');
    $('#clv-monto').html('');
    $('#clv-interes').html('');
    $('#clv-estatus').html('');
    $('#clv-total').html('');
  }

  $('#cmb-listar-prestamos-cuotas-1').change(function(){
    // let texto = $('#cmb-listar-prestamos-cuotas option:selected').text();
    let id = $('#cmb-listar-prestamos-cuotas-1 option:selected').val();

    if(parseInt(id) == 0){
      limpiarNuevaCuotaDetallada();
    }else{
      getInfoPrestamoCompacto(id);
      cuadrosCuotasCompactadas(id);
    }
  });
  
  $('#txt-cuota-pago').bind('input', function(){
    var pago = $(this).val();
    var deudaInicial = $('#txt-deuda-inicial').val();
    var saldoActual = deudaInicial - pago;
    $('#txt-deuda-actual').val(saldoActual);
    $('#info-cuota-pagar').html('$ '+ pago);
    $('#info-saldo-restante').html('$' + saldoActual);
  
    // console.log(deudaInicial - pago);
  });
  
  $('#btn-limpiar').click(function(e){
    e.preventDefault();
    limpiarCampos();
  });
  
  $('.preventDefault').submit(function(e){
    e.preventDefault();
   // var respuesta = form.children('.RespuestaAjax');
  });

  $('#datos-cliente').click(function(e){
    e.preventDefault();
    // alert("Click en el boton");
  
    var alerta = __sweetAlert('¿ Estás seguro?', 'Los datos del cliente se guardarán', 'warning')
    .then((result)=>{
      if(result.value){
        var datos = $('#form-cliente').serialize();
        var cli_cedula = $('#cliente-cedula').val();
        var cli_nombres =$('#cliente-nombres').val();
        var cli_apellidos =$('#cliente-apellidos').val();
        var cli_correo = $('#cliente-correo').val();
        var cli_sexo = $('input:radio[name=cliente-sexo]:checked').val();
        var cli_edad = $('#cliente-edad').val();
        var cli_telefono = $('#cliente-telefono').val();
        var cli_lugar_cobro = $('#cliente-lugar-cobro').val();
        var cli_lugar_trabajo = $('#cliente-lugar-trabajo').val()
        var cli_fecha_registro = $('#txt-fecha-registro').val();
  
  
        var data = {
          type:'save',
          cliente:
            {
              cli_cedula:cli_cedula,
              cli_nombres: cli_nombres,
              cli_apellidos:cli_apellidos,
              cli_correo: cli_correo,
              cli_sexo:cli_sexo,
              cli_edad:cli_edad,
              cli_telefono:cli_telefono,
              cli_lugar_cobro:cli_lugar_cobro,
              cli_lugar_trabajo:cli_lugar_trabajo,
              cli_fecha_registro:cli_fecha_registro,
              cli_fecha_update:cli_fecha_registro,
              cli_estado:'A'
            }
        };
        // dataJson = JSON.stringify(data);
        //console.log(datos);
  
        if(validarFormCliente(data)){
          var ruta = 'ajax/ClienteDatosAjax.php';
  
          var guardar = new Ajax(ruta,'POST', data);
          guardar.__ajax(ruta, 'POST', dataJson)
          .done(function(response){
              //La strinjson convertir a formato JSON
              response = JSON.parse(response);
              
              if(response.result){
                $('#form-cliente')[0].reset();
                countClientes();
                alerta = __sweetSimpe('Buen trabajo', 'El cliente se ha guardado correctmente en el sistema', 'success');
                $('.error-datos').html(alerta);
              }
          });
          //__sweetSimpe('Bien echo','Los datos se guardaron en el sistema', 'success');
        }
      }
    });
    $('.preguntaAccion').html(alerta);
  });
  
  $('#form-cliente-editar').submit(function(e){
    e.preventDefault();
    // alert("Click en el boton");
  
    var alerta = __sweetAlert('¿ Estás seguro ?', 'Los datos del cliente se actualizarán', 'warning')
    .then((result)=>{
       if(result.value){
  
        // let datos = $('#form-cliente').serialize();
        let cli_id = $('#cliente-id').val();
        let cli_cedula = $('#cliente-cedula').val();
        let cli_nombres =$('#cliente-nombres').val();
        let cli_apellidos =$('#cliente-apellidos').val();
        let cli_correo = $('#cliente-correo').val();
        let cli_sexo = $('input:radio[name=cliente-sexo]:checked').val();
        let cli_edad = $('#cliente-edad').val();
        let cli_telefono = $('#cliente-telefono').val();
        let cli_lugar_cobro = $('#cliente-lugar-cobro').val();
        let cli_lugar_trabajo = $('#cliente-lugar-trabajo').val()
        // let cli_fecha_registro = $('#txt-fecha-registro').val();
  
        var data = {
          type:'update',
          id:cli_id, 
          cliente:
            {
              cli_cedula:cli_cedula,
              cli_nombres: cli_nombres,
              cli_apellidos:cli_apellidos,
              cli_correo: cli_correo,
              cli_sexo:cli_sexo,
              cli_edad:cli_edad,
              cli_telefono:cli_telefono,
              cli_lugar_cobro:cli_lugar_cobro,
              cli_lugar_trabajo:cli_lugar_trabajo,
              // cli_fecha_registro:cli_fecha_registro,
              // cli_fecha_update:cli_fecha_registro,
              cli_estado:'A'
            }
          };
        //  dataJson = JSON.stringify(data);
        // console.log(data);
  
        if(validarFormCliente(data)){
          var ruta = 'ajax/ClienteDatosAjax.php';
          console.log(data);
          // console.log(dataJson);
  
          var editar = new Ajax(ruta,'POST', data);
          editar.__ajax()
          .done(function(response){
            // //La strinjson convertir a formato JSON
            response = JSON.parse(response);
            // console.log(response);
            
            if(response.result){
              $('#form-cliente-editar')[0].reset();
              tablaClientes();           
  
              alerta = __sweetSimpe('Buen trabajo', 'El cliente se ha actualizado correctmente en el sistema', 'success');
              $('.error-datos').html(alerta);
            }
          });
    //       //__sweetSimpe('Bien echo','Los datos se guardaron en el sistema', 'success');
        }
       }
     });
     $('.preguntaAccion').html(alerta);
  });
  
  $('#btn-prestamo-limpiar').click(function(e){
    e.preventDefault();
    $('#form-nuevo-prestamo')[0].reset();
    $('#cmb-buscador').val(0);
    limpiarCampos();    
  });

  $('#form-nuevo-prestamo').submit(function(e){
    e.preventDefault();

    //Verificar si un cliente ya tiene un préstamo asignado
    let ruta = 'ajax/PrestamoAjax.php';
    let id_cliente = $('#cmb-buscador option:selected').val();

    let existePrestamo = {
      type: 'existeCliente',
      idCliente: id_cliente
    };

    let verificar = new Ajax(ruta,'GET', existePrestamo);

    verificar.__ajax()
    .done(function(response){
      response = JSON.parse(response);

      if(response.result){
        // console.log(response);

        // Si el cliente ya tiene un prestamo activo o pagando
        if(response.existe == true){
          let alerta = __sweetSimpe('Oopp ocurrio un problema', 'El cliente ya posee un préstamo activo, termine su pago para proceder nuevo préstamo', 'error');
          $('.error-datos').html(alerta);
        }else{
          guardarPrestamo();
        }
      }
    });
  });

  $('#form-nuevo-cuota').submit(function(e){
    e.preventDefault();
    let ruta = 'ajax/CuotaAjax.php';

    let id_usuario = $('#id-Usuario').attr('value');
    let fechaRegistro = $('#txt-fecha-registro').val();
    let horaRegistro = $('#txt-hora-registro').val();
    let id_cliente = $('#cmb-cuota-cliente option:selected').val();
    let id_prestamo = $('#cmb-prestamo-cuota option:selected').val();
    let fechaPago = $('#txt-fecha-pago').val();
    let valorPagar = $('#txt-cuota-pago').val();
    let id_estatus = $('#cmb-status-cuota option:selected').val();
    let saldoActual = $('#txt-deuda-inicial').val();
    let saldoRestante = $('#txt-deuda-actual').val();
    let observacion  = $('#txt-cuota-observacion').val()

    let cuotaJson = {
      type: 'insert',
      cuota:{
        usu_id: parseInt(id_usuario),
        cuo_fecha_registro: fechaRegistro,
        cuo_hora_registro: horaRegistro,
        cli_id: parseInt(id_cliente),
        pres_id: parseInt(id_prestamo),
        cuo_fecha_pago: fechaPago,
        cuo_valor_pago: valorPagar,
        est_id: parseInt(id_estatus),
        cuo_saldo_inicial: parseFloat(saldoActual),
        cuo_saldo_actual: parseFloat(saldoRestante),
        cuo_cuota_numero: 1,
        cuo_observacion: observacion,
        estado: 'A'
      }
    };

    let alerta = __sweetAlert('¿ Estás seguro ?', 'La cuota ingresada se registrará en el sistema', 'warning')
    .then((result) =>{
      if(result.value){
        
        if(validarFormNuevaCuota(cuotaJson)){
          console.log(cuotaJson);
          let insertarCuota = new Ajax(ruta,'POST', cuotaJson);
          insertarCuota.__ajax()
          .done(function(response){
            // //La strinjson convertir a formato JSON
            response = JSON.parse(response);
            
            if(response.result){
              // $('#form-nuevo-prestamo')[0].reset();
              console.log(response);
              cargarClientes();
              auxLimpiarCuota();
              // // console.log(response);
              
              if(response.prestamoTerminado){
                alerta = __sweetSimpe('Felicidades', 'El cliente ha terminado de pagar el préstamo', 'success');                
              }else{
                alerta = __sweetSimpe('Buen trabajo', 'La cuota se ha registro correctamente en el sistema', 'success');
             }
              
              $('.error-datos').html(alerta);
            }
          });

        }
      }
    });
  });

  $('#limpiar-cuota-detallada').click(function(){
    let id = $('#cmb-listar-prestamos-cuotas option:selected').val();

    if(parseInt(id) == 0){
    }else{
      subLimpiarCuotaDetallada();
    }
  });

  $('#limpiar-cuota-compactada').click(function(){
    // console.log('Limpiar box');
    limpiarNuevaCuotaDetallada();
  });

  $('#limpiar-detalle-cuota-compactada').click(function(){
    $('#dc-id').html('');
    $('#cd-valor-pago').html('');
    $('#cd-saldo-anterior').html('');
    $('#cd-saldo-restante').html('');
    $('#cd-estatus').html('');
    $('#cd-hora-registro').html('');
    $('#cd-fecha-registro').html('');
    $('#cd-actualizado').html('');
    $('#cd-numero-cuota').html('');
  });

  function guardarPrestamo(){
    let ruta = 'ajax/PrestamoAjax.php';
    let id_usuario = $('#id-Usuario').attr('value');            let id_cliente = $('#cmb-buscador option:selected').val();
    let id_monto = $('#cmb-monto option:selected').val();       let monto = $("#cmb-monto option:selected").text();
    let id_interes = $('#cmb-interes option:selected').val();   let id_plazo = $('#cmb-plazo option:selected').val();
    let id_estatus = $('#cmb-status option:selected').val();    let fecha_inicio = $('#prestamo-fecha-inicio').val();
    let fecha_fin = $('#prestamo-fecha-fin').val();             let cuota_diaria = $('#txt-cuota').val();
    let observacion = $('#txt-observacion').val();              let terminos = $('#prestamo-termino')[0].checked;
    let acepta = $('#prestamo-termino').val();  
    // alert(id_cliente);
   
    let prestamoJSON = {
      type: 'insert',
      prestamo: {
        id_usuario: id_usuario,
        id_cliente: id_cliente,
        id_monto: id_monto,
        id_interes: id_interes,
        id_plazo: id_plazo,
        id_estatus: id_estatus,
        monto:monto,
        total:total,
        fecha_inicio: fecha_inicio,
        fecha_fin: fecha_fin,
        cuota_diaria: cuota_diaria,
        observacion: observacion,
        terminos: terminos,
        acepta: acepta
      },
      result : 'true'
    };
    // console.log(prestamoJSON);

    let alerta = __sweetAlert('¿ Estás seguro ?', 'Los datos préstamo de guardarán', 'warning')
    .then((result) =>{
        if(result.value){      
  
          if(validarFormNuevoPrestamo(prestamoJSON)){
  
            let insertarPrestamo = new Ajax(ruta,'POST', prestamoJSON);
            insertarPrestamo.__ajax()
            .done(function(response){
              // //La strinjson convertir a formato JSON
              response = JSON.parse(response);
              // console.log(response);
              
              if(response.result){
                $('#form-nuevo-prestamo')[0].reset();
                limpiarCampos();
                // console.log(response);
              
                alerta = __sweetSimpe('Buen trabajo', 'El préstamo se ha registro correctamente en el sistema', 'success');
                $('.error-datos').html(alerta);
              }
            });
          }
        }else{
        //  alert("Has cancelado la opcion"); 
        }
    });
  }

  function limparNuevaCuota(){
    $('#btn-limpiar-cuota').click(function(e){
      e.preventDefault();
      cargarClientes();
      auxLimpiarCuota();
    });
  }
  
  function limpiarNuevaCuotaDetallada(){
    $('#compactada-cliente').html('');
    $('#compactada-monto').html('');
    $('#box-cuotasCompactadas').html('');
    $('#compactada-cantidad-cuotas').html('');
    $('#compactada-fecha-cuota').html('');
    $('#compactada-cantidad-cuota').html('');
    $('#compactada-restante').html('');
  }

});

function auxLimpiarCuota(){
  $('#form-nuevo-cuota')[0].reset();
  $('#cmb-prestamo-cuota').html('<option value="0">Elija el préstamo<option>');
  $('#id-prestamo-cuota').html('');
  $('#info-prestamo-inicial').html('-');
  $('#info-prestamo').html('-');
  $('#info-cuota-pagar').html('-');
  $('#info-saldo-restante').html('-');
  $('#info-cliente').html('-');

  $('#txt-fecha-registro').val(obtenerFecha());
}

function cargarInfoCliente(id){
  console.log("Id préstamo: " + id);
}

function tablaClientes(){
  var tb = $('#tb-clientes').DataTable({
        destroy:true,
        pageLength:10,
        responsive:true,
        processing:true,
        ajax:'ajax/TablaClientesAjax.php',
        language:{
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ningún dato disponible en esta tabla",
                "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            }
  });
  return tb;
}

function getInfoPrestamo(id){
  let ruta = 'ajax/PrestamoAjax.php';
  let dataJson = {
    type:"onePrestamo",
    method:"get",
    entidad:"prestamo",
    id: id,
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
      // console.log(response);
      let prestamo = response.prestamo;
      let fechaInicio = formateandoFecha(prestamo.pres_fecha_inicio);
      let fechafin = formateandoFecha(prestamo.pres_fecha_fin);

      $('#clv-cliente').html(prestamo.nombres);
      $('#clv-fechaInicio').html(fechaInicio);
      $('#clv-fechaFin').html(fechafin);
      $('#clv-monto').html('$ ' + prestamo.monto);
      $('#clv-interes').html(prestamo.interes + ' %');
      $('#clv-estatus').html(prestamo.det_estatus);
      $('#clv-total').html('$ ' + prestamo.pres_total);
    }
  })
  .fail(function(){
    console.log('error en ajax GET getInfoPrestamo');
  })
  .always(function(){
  });
 }

function getInfoPrestamoCompacto(idPrestamo){
let ruta = 'ajax/PrestamoAjax.php';
let dataJson = {
  type:"onePrestamo",
  method:"get",
  entidad:"prestamo",
  id: idPrestamo,
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
    let prestamo = response.prestamo;
    let restante = parseFloat(prestamo.pres_total) - parseFloat(prestamo.pres_pagado)
    // let fechaInicio = formateandoFecha(prestamo.pres_fecha_inicio);

    $('#compactada-cliente').html(prestamo.nombres);
    $('#compactada-monto').html(prestamo.monto);
    $('#compactada-restante').html(restante);
    
  }
})
.fail(function(){
  console.log('error en ajax GET getInfoPrestamoCompacto');
})
.always(function(){
});
}

function tablaCuotasDetalladas(idPrestamo){
  // console.log("Realizar petición ajax: "+ idPrestamo);
  let ruta = 'ajax/CuotaAjax.php';

  let cuotaJson = {
    type: 'getCuotasPrestamo',
    idPrestamo: idPrestamo
  };

  let getCuotasPrestamo = new Ajax(ruta,'GET', cuotaJson);
  getCuotasPrestamo.__ajax()
  .done(function(response){
    response = JSON.parse(response);
    
    if(response.result){
      // console.log(response);
      let tbody = '';

      for(let i in response.cuotas){
        tbody += `<tr> <td class="text-center">${parseInt(i) + parseInt(1)}</td>
            <td class="text-center">${response.cuotas[i].cuo_fecha_pago}</td>
            <td class="text-center">${response.cuotas[i].cuo_valor_pago}</td>
            <td class="text-center">${response.cuotas[i].cuo_saldo_inicial}</td>
            <td class="text-center">${response.cuotas[i].cuo_saldo_actual}</td>
        <tr>`;
      }
   
      $('#tabla-body-cuotas').html(tbody);
    }
  });
}

function cuadrosCuotasCompactadas(idPrestamo){
  // console.log("Realizar petición ajax: "+ idPrestamo);
  let ruta = 'ajax/CuotaAjax.php';

  let cuotaJson = {
    type: 'getCuotasPrestamo',
    idPrestamo: idPrestamo
  };

  let getCuotasPrestamo = new Ajax(ruta,'GET', cuotaJson);
  getCuotasPrestamo.__ajax()
  .done(function(response){
    response = JSON.parse(response);
    
    if(response.result){
      // console.log(response);
      let ultimaCuota = response.cuotas[response.cuotas.length -1]
      let fechaCuota = formateandoFecha(ultimaCuota.cuo_fecha_registro);
      let bodyCompactada = '';
      for(let i in response.cuotas){
        n = parseInt(i) + parseInt(1);
        bodyCompactada += `<div class="col-2 d-flex flex-column justify-content-center mb-1 pb-2 boxCuotaCompactada" 
        onclick="getCuotabyId(${response.cuotas[i].id},${n} )">
        <span class="ml-1">${n}</span>
          <i class="fas fa-check-square fa-lg"></i>
        </div> `;
      }
   
      $('#box-cuotasCompactadas').html(bodyCompactada);
      $('#compactada-cantidad-cuotas').html(response.cuotas.length);
      $('#compactada-fecha-cuota').html(fechaCuota);
      $('#compactada-cantidad-cuota').html(ultimaCuota.cuo_valor_pago);
      // console.log(ultimaCuota);
    }
  });
}

function getPrestamosRecientes(){
  let limite = 5; 
  let estatus = 2;

  let ruta = 'ajax/PrestamoAjax.php';

  let prestamoJson = {
    type: 'getRecientes',
    limite: limite,
    estatus: estatus
  };

  let getPrestamosRecientes = new Ajax(ruta,'GET', prestamoJson);
  getPrestamosRecientes.__ajax()
  .done(function(response){
    response = JSON.parse(response);
    
    if(response.result){
      // console.log(response);
      let prestamos = response.prestamos; 
      let boton = '';

      for(i in prestamos){
        boton += `<button class="btn btn-outline-primary w-100 mb-1" onclick="getCuotasCompactada(${prestamos[i].id})">ID-${prestamos[i].id}</button>`;
      }

      $('#btn-prestamos-recientes').html(boton);
    }
  });
}

function visualizarDatos(id){
  //console.log("Cargar ajax con id: " + id);
  let ruta = 'ajax/ClienteDatosAjax.php';
  let dataJson = {
    type:"one",
    method:"get",
    entidad:"clientes",
    id: id,
    archivo: ruta
  };

  let listar = new Ajax(ruta,'POST', dataJson);
  listar.__ajax()
  .done(function(response){
    response = JSON.parse(response);

    if(response.result){
      formularioEditarCliente(response.cliente);
      //console.log(response.cliente);
    }
  });
}

function visualizarPrestamo(id){

  let ruta =  'ajax/PrestamoAjax.php';
  let dataJson = {
    type: "one",
    method: "get",
    entidad: "prestamos",
    id: id,
    archivo: ruta
  }

  let listar = new Ajax(ruta, 'GET', dataJson);
  listar.__ajax()
  .done(function (response){
    response = JSON.parse(response);
   
    if(response.result){
      console.log(response);
      $('#editar-observacion-prestamo').val(response.prestamo.pres_observacion);
      $idOption = "#editar-estatus-prestamo option[value = '"+response.prestamo.est_id+"']";
      $($idOption).attr("selected",true);
      $('#id-editar-prestamo').val(response.prestamo.id);
    }
  });
}

function deleteCliente(id){
  var alerta = __sweetAlert('¿Estás seguro?','Los datos del cliente se eliminará del sistema','warning')
  .then((result)=>{
    if(result.value){
    var ruta = 'ajax/ClienteDatosAjax.php';
    
      //console.log('Eliminar cliente con id: ' + id);
      var dataJson = {
        type:'delete',
        method:'get',
        entidad:'clientes',
        id: id
      };
      // data = JSON.stringify(data);
      var eliminar = new Ajax(ruta,'POST', dataJson);

      eliminar.__ajax()
      .done(function(response){
        response = JSON.parse(response);

        if(response.result){
          var selector = "#e-" + response.value;
          var tr = $(selector).parent().parent();
          //console.log(tr);
          //tr.remove();
          tablaClientes();

         alerta = __sweetSimpe('Buen trabajo', 'El cliente se ha eliminado correctmente del sistema', 'success');
         $('.error-datos').html(alerta);
        }
        //console.log(response);
      });
    }
  });
  $('.preguntaAccion').html(alerta);
}

function deletePrestamo(id){
  let ruta = 'ajax/PrestamoAjax.php';
  let alerta = __sweetAlert('¿Estás seguro?','Los datos del cliente se eliminará del sistema','warning')
  .then((result) =>{
      if(result.value){
        // console.log("Click en eliminar préstamo");
        let dataJson = {
          type:'delete',
          method:'get',
          entidad:'clientes',
          id: id
        };

      let eliminar = new Ajax(ruta,'GET', dataJson);
      eliminar.__ajax()
        .done(function(response){
          response = JSON.parse(response);
          console.log(response);

          if(response.result){
            alerta = __sweetSimpe('Buen trabajo', 'El préstamo se ha eliminado correctmente del sistema', 'success');
            $('.error-datos').html(alerta);
          }

          $('#ep-'+ id).fadeOut(1200);
        });
      }
  });
  $('.preguntaAccion').html(alerta);
}

function getCuotasCompactada(id){
  // console.log('Peticion ajax para cuotas del préstamo: ' + id)
  getInfoPrestamoCompacto(id);
  cuadrosCuotasCompactadas(id);
}

function getCuotabyId(id, n){
  let ruta = 'ajax/CuotaAjax.php';

  let cuotaJson = {
    type: 'one',
    id: id
  };

  let getCuotasPrestamo = new Ajax(ruta,'GET', cuotaJson);
  getCuotasPrestamo.__ajax()
  .done(function(response){
    response = JSON.parse(response);
    
    if(response.result){
      // console.log(response);
      cuota = response.cuota;
      let fechaRegistro = formateandoFecha(cuota.cuo_fecha_registro);

      $('#dc-id').html(cuota.id);
      $('#cd-valor-pago').html('$ ' + cuota.cuo_valor_pago);
      $('#cd-saldo-anterior').html('$ ' + cuota.cuo_saldo_inicial);
      $('#cd-saldo-restante').html('$ ' + cuota.cuo_saldo_actual);
      $('#cd-estatus').html(cuota.estatus_des);
      $('#cd-hora-registro').html(cuota.cuo_hora_registro);
      $('#cd-fecha-registro').html(fechaRegistro);
      // $('#cd-actualizado').html(cuota.cuo_fecha_update);
      $('#cd-numero-cuota').html(n);
      $('#cd-observacion').html(cuota.cuo_observacion);
    }
  });
}

function filtrarPrestamos(){
  $("#filtrar-prestamo-estatus").change(function(){
    let option = $('#filtrar-prestamo-estatus option:selected').val();
    // alert($('select[id=ejemplo2]').val());
    // $('#valor2').val($(this).val());
    switch(option){

      case '0':   //Todos
          for(i = 0; i < arrayEstatus.length; i++){
            let id = '.estatus-' + arrayEstatus[i];
  
            $(id).fadeIn(800);
          }
        break;

      case '1':   //Inicio
        for(i = 0; i < arrayEstatus.length; i++){
          let id = '.estatus-' + arrayEstatus[i];

          if(arrayEstatus[i] != 1){
            $(id).fadeOut(600);
          }else{
            $(id).fadeIn(800);
          }
        }
        break;
      
      case '2':   //Pagando
          for(i = 0; i < arrayEstatus.length; i++){
            let id = '.estatus-' + arrayEstatus[i];
  
            if(arrayEstatus[i] != 2){
              $(id).fadeOut(600);
            }else{
              $(id).fadeIn(800);
            }
          }
          break;

      case '3':   //Finalizado
          for(i = 0; i < arrayEstatus.length; i++){
            let id = '.estatus-' + arrayEstatus[i];
  
            if(arrayEstatus[i] != 3){
              $(id).fadeOut(600);
            }else{
              $(id).fadeIn(800);
            }
          }
          break;
    }
  });

}

function ocultarPrestamo(id){
  let ruta = 'ajax/PrestamoAjax.php';

  // alert("El préstamo se ha ocultado");
  let dataJson = {
    type:'hide',
    method:'get',
    entidad:'clientes',
    id: id
  };

let ocultar = new Ajax(ruta,'GET', dataJson);
ocultar.__ajax()
  .done(function(response){
    response = JSON.parse(response);
    // console.log(response);

    if(response.result){
      alerta = __sweetSimpe('Buen trabajo', 'El préstamo se ha movido a lista de los Ocultos', 'success');
      $('.error-datos').html(alerta);
    }

    $('#ep-'+ id).fadeOut(1200);
  });
}

function mostrarPrestamo(id){
  let ruta = 'ajax/PrestamoAjax.php';

  // alert("El préstamo se ha ocultado");
  let dataJson = {
    type:'show',
    method:'get',
    entidad:'clientes',
    id: id
  };

  let ocultar = new Ajax(ruta,'GET', dataJson);
  ocultar.__ajax()
    .done(function(response){
      response = JSON.parse(response);
      // console.log(response);

      if(response.result){
        alerta = __sweetSimpe('Buen trabajo', 'El préstamo se ha movido a lista de Todos los préstamos', 'success');
        $('.error-datos').html(alerta);
      }

      $('#ep-'+ id).fadeOut(1200);
    });
}

//Funciones para las cuotas
function obtenerPrestamoCliente(){
    $('#cmb-cuota-cliente').change(function(){
      let  idCliente = $('#cmb-cuota-cliente option:selected').val();

      dataJson = {
        type:"byClient",
        method:"get",
        entidad:"prestamos",
        idCliente: idCliente
      };
    
      //dataJson = JSON.stringify(dataJson);
      let allClientes = new Ajax('ajax/PrestamoAjax.php','GET', dataJson);
      
      allClientes.__ajax()
      .done(function(response){
        response = JSON.parse(response);
        let comboPrestamo;

        if(response.result){
          prestamo = response.prestamo;
          let id_prest, valorCuota, deudaInicio, pTotal;

          if(prestamo){
            id_prest = 'ID - ' + prestamo.id;
            valorCuota = prestamo.pres_cuota;
            pTotal = '$ ' + prestamo.pres_total;
            // Calculo de la deuda vigente o actual
            deudaInicio = parseFloat(prestamo.pres_total) - parseFloat(prestamo.pres_pagado); 
            comboPrestamo += `<option value="${prestamo.id}"> ${prestamo.monto}</option>`;
          }else{
            comboPrestamo = '<option value="0">No tiene préstamo<option>';
            id_prest = '';
            valorCuota = '';
            deudaInicio = '';
            pTotal = '';
          }
          
          //$('.prestamo-clientes').html(tablaCliente);
          $('#txt-cuota-valor').val(valorCuota);
          $('#txt-deuda-inicial').val(deudaInicio);

          $('#info-prestamo').html('$ ' + deudaInicio);
          $('#info-prestamo-inicial').html(pTotal);
          $('#id-prestamo-cuota').html(id_prest);
          $('#cmb-prestamo-cuota').html(comboPrestamo);

          console.log(response);
        }
      });
    });
}

function enviarMensajeConfirmacion(){
  $('#enviar-confirmacion').click(function(e){
    e.preventDefault();
    // let correo = $('#perfil-correo').val();
    let id = $('#id-Usuario').attr("value");

    let dataJson = {
      type:'mensaje',
      method:'post',
      entidad:'usuario',
      id: id
    };

    let ruta = 'ajax/ConfirmarCorreo.php';
  
    var confirmar = new Ajax(ruta,'POST', dataJson);
    confirmar.__ajax(ruta, 'POST', dataJson)
    .done(function(response){
        // console.log(response);
        response = JSON.parse(response);
        
        if(response.result){
          alerta = __sweetSimpe('Correo de verificación', 'El correo de verificación ha sido enviado !', 'success');
        }else{
          alerta = __sweetSimpe('Error', 'Ha ocurrido un error !', 'error');          
        }
        $('.error-datos').html(alerta);
    });

  });

}

//Sweet Alert
function __sweetAlert(title, text, type){
 var sweet = Swal.fire({
    title: title,
    text: text,
    type: type,
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Sí, estoy seguro!'
  })
  return sweet;
}

//Sweet simple
function __sweetSimpe(title, text, type){
  var sweet = Swal.fire({
    title: title,
    text: text,
    type: type
  });
  return sweet;
}

// Formulario de registrar nuevo cliente
function validarFormCliente(data){

  var alerta;

  if(data.cliente.cli_cedula == ''){
    alerta = __sweetSimpe('Ups falta cédula', 'Necesita proporcionar la cédula del cliente para continuar', 'error');
    $('.error-datos').html(alerta);
    return false;
  }else if(data.cliente.cli_nombres == ''){
    alerta = __sweetSimpe('Ups falta nombre', 'Necesita proporcionar el nombre del cliente para continuar', 'error');
    $('.error-datos').html(alerta);
    return false;
  }
  else if(data.cliente.cli_apellidos == ''){
    alerta = __sweetSimpe('Ups falta apellido', 'Necesita proporcionar el apellido del cliente para continuar', 'error');
    $('.error-datos').html(alerta);
    return false;
  }else if(data.cliente.cli_edad == ''){
    alerta = __sweetSimpe('Ups falta edad', 'Necesita proporcionar la edad del cliente para continuar', 'error');
    $('.error-datos').html(alerta);
    return false;
  }else if(data.cliente.cli_lugar_cobro == ''){
    alerta = __sweetSimpe('Ups falta lugar de cobro', 'Necesita proporcionar un lugar de cobro del cliente para continuar', 'error');
    $('.error-datos').html(alerta);
    return false;
  }

   return  true; 
}

//Validacion del form para nuevo Préstamo
function validarFormNuevoPrestamo(data){
  var alerta;

  if(data.prestamo.id_cliente == '' || data.prestamo.id_cliente <= 0){
    alerta = __sweetSimpe('Ups falta cliente', 'Necesitas seleccionar un cliente para continuar','error');
    $('.error-datos').html(alerta);
    return false;
  }
  else if(data.prestamo.id_monto == '' || data.prestamo.id_monto <= 0){
    alerta = __sweetSimpe('Ups falta monto', 'Necesitas seleccionar un monto para continuar','error');
    $('.error-datos').html(alerta);
    return false;
  }
  else if(data.prestamo.id_interes == '' || data.prestamo.id_interes <= 0){
    alerta = __sweetSimpe('Ups falta el interes', 'Necesitas seleccionar un interes al monto para continuar','error');
    $('.error-datos').html(alerta);
    return false;
  }
  else if(data.prestamo.id_plazo == '' || data.prestamo.id_plazo <= 0){
    alerta = __sweetSimpe('Ups falta el plazo', 'Necesitas seleccionar un plazo de pago para continuar','error');
    $('.error-datos').html(alerta);
    return false;
  }
  else if(data.prestamo.id_estatus == '' ||  data.prestamo.id_estatus <= 0){
    alerta = __sweetSimpe('Ups falta el estatus', 'Necesitas seleccionar un estatus para continuar','error');
    $('.error-datos').html(alerta);
    return false;
  }
  else if(data.prestamo.fecha_inicio == ''){
    alerta = __sweetSimpe('Ups falta fecha de inicio', 'Necesitas ingresar una fecha de inicio','error');
    $('.error-datos').html(alerta);
    return false;
  }
  else if(data.prestamo.fecha_fin == ''){
    alerta = __sweetSimpe('Ups falta fecha de finalización', 'Necesitas ingresar una fecha de fin del préstamo','error');
    $('.error-datos').html(alerta);
    return false;
  }
  else if(!data.prestamo.terminos){
    alerta = __sweetSimpe('Ups debe aceptar los términos', 'El cliente debe comprometerse a pagar el total prestado más interes acordado','error');
    $('.error-datos').html(alerta);
    return false;
  }
  return true;
}

function validarFormNuevaCuota(data){
  let alerta;
  let cuota = data.cuota;
  
  if(cuota.cli_id == '' || cuota.cli_id <= 0){
    alerta = __sweetSimpe('Ups falta cliente', 'Necesitas seleccionar un cliente para continuar','error');
    $('.error-datos').html(alerta);
    return false;
  }
  else if(cuota.pres_id == '' || cuota.pres_id <= 0){
    alerta = __sweetSimpe('Ups falta el préstamo', 'Necesitas seleccionar un préstamo del cliente para continuar','error');
    $('.error-datos').html(alerta);
    return false;
  }
  else if(cuota.cuo_fecha_pago == ''){
    alerta = __sweetSimpe('Ups falta fecha', 'Necesitas ingresar una fecha de pago para la cuota','error');
    $('.error-datos').html(alerta);
    return false;
  }
  else if(cuota.cuo_valor_pago == '' || cuota.cuo_valor_pago <= 0){
    alerta = __sweetSimpe('Ups falta valor a pagar', 'Necesitas ingresar una cantidad en valor a pagar','error');
    $('.error-datos').html(alerta);
    return false;
  }
  else if(cuota.est_id == '' || cuota.est_id <= 0){
    alerta = __sweetSimpe('Ups falta el estatus', 'Necesitas seleccionar el estatus de la cuota','error');
    $('.error-datos').html(alerta);
    return false;
  }
  else if(cuota.cuo_saldo_actual < 0 ){
    alerta = __sweetSimpe('Ups cantidad excedida', 'El valor de la cuota no puede exceder la deuda actual','error');
    $('.error-datos').html(alerta);
    return false;
  }

  return true;
}

//===============================================
function datosPerfilForm(usuario){
  $('#perfil-nombres').val(usuario.usu_nombres);
  $('#perfil-apellidos').val(usuario.usu_apellidos);  
  $('#perfil-correo').val(usuario.usu_correo);
  $('#perfil-direccion').val(usuario.usu_direccion);
  $('#perfil-cargo').val(usuario.usu_cargo);
  $('#perfil-usuario').val(usuario.usu_usuario);
  $('#perfil-telefono').val(usuario.usu_telefono);

  var sexo = document.getElementsByName('sexo');
  
  if(usuario.usu_sexo == 'F'){
    if(sexo[0] != undefined){ //Sexo[0] => Masculino
      sexo[0].checked = false;
    }

    if(sexo[1] != undefined){
      sexo[1].checked = true; //Sexo[1] => femenino
    }

  }else{
    //sexo[0].checked = true;
    if(sexo[0] != undefined){
      sexo[0].checked = true;
    }

    if(sexo[1] != undefined){
      sexo[1].checked = false;
    }
  }
}

function formularioEditarCliente(cliente){
  $('#cliente-cedula').val(cliente.cli_cedula);
  $('#cliente-id').val(cliente.id);
  $('#cliente-nombres').val(cliente.cli_nombres);
  $('#cliente-apellidos').val(cliente.cli_apellidos);
  $('#cliente-correo').val(cliente.cli_correo);

  if(cliente.cli_sexo == 'M'){
    $('#masculino').attr('checked',true);
  }else{
    $('#femenino').attr('checked',true);    
  }

  $('#cliente-edad').val(cliente.cli_edad);
  $('#cliente-telefono').val(cliente.cli_telefono);
  $('#cliente-lugar-cobro').val(cliente.cli_lugar_cobro);
  $('#cliente-lugar-trabajo').val(cliente.cli_lugar_trabajo);
}

function oculat_info_pie() {
  $(".daterangepicker").addClass("d-none");
}

function calcularCuotasDiarias(){
  if(plazo != 0 && monto != 0 && interes != 0){
    // alert("Calcular cuota diaria");
    total = monto + (monto * (interes/100));
    n_cuotas = total/plazo;

    $('#txt-cuota').val(n_cuotas);
    $('#info-cuota').html(n_cuotas + span);
    $('#info-total').html(total + span);

  }
}

function obtenerFecha(){
  var today = new Date();
  var dd = today.getDate();
  var mm = today.getMonth()+1; //January is 0!

  var yyyy = today.getFullYear();
  if(dd<10){
      dd='0'+dd;
  } 
  if(mm<10){
      mm='0'+mm;
  } 
  var today = dd+'/'+mm+'/'+yyyy;
  return today;
}

function getTime(){
  var today = new Date();
  var h = today.getHours();
  var m = today.getMinutes();
  var s = today.getSeconds();

  console.log(h + ":" + m + ":" + s);
}

function startTime(){
  var today = new Date();
  var h = today.getHours();
  var m = today.getMinutes();
  var s = today.getSeconds();

  m = actualizarHora(m);    s = actualizarHora(s);
  //console.log(h + ":" + m + ":" + s);
  $('#txt-hora-registro').val(h + ":" + m + ":" + s);

  setTimeout(function(){
    startTime();
  }
    ,1000);
}

function actualizarHora(i) {
  if (i<10){
    i = "0" + i
  };    // Añadir el cero en números menores de 10
  return i;
}

function limpiarCampos(){

    $('#info-monto').html('-');
    $('#info-interes').html('-');
    $('#info-plazo').html('-');
    $('#info-cuota').html('-');
    $('#info-total').html('-');
    $('#info-cliente').html('-');
    $('#info-prestamo').html('-');
    
    $('#info-cuota-pagar').html('-');
    $('#info-saldo-restante').html('-');
}

function validarNumeros(){
  $('#txt-cuota-pago').on('input', function () { 
    this.value = this.value.replace(/[^0-9]/g,'');
  });
}

function onlyNumbers(){
  $('.only-numbers').on('input', function () { 
    this.value = this.value.replace(/[^0-9]/g,'');
  });
}

function formateandoFecha(fecha){
  let array = fecha.split('-');
  let formato = array[2] + '/' + array[1] + '/' + array[0];
  return formato;
}
