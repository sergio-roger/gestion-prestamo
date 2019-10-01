// $('.daterangepicker')
var monto = 0, interes = 0, plazo = 0; 
var total = 0, n_cuotas;
var span = ' <span>$</span>';

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
  }

  function peticionesAjax(){

    let peticiones = {
      result: true,
      funciones: {
        _1datosUsuario: '0.- Cargar datos del Usuario',
        _2cargarClientes: '1.- Peticiones de cargar clientes',
        _3countClientes: '2.- Contar clientes',
        _4getMontos: '3.- Carga los montos',
        _5getIntereses: '4.- Carga los intereses'
      }
    };
    datosUsuario();
    listarClientes();
    cargarClientes();
    countClientes();
    getMontos();
    getIntereses();

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
    var allClientes = new Ajax('ajax/DatosGeneraleAjax.php','GET', dataJson);
    
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
      var option = '<option value="0">Seleccione una opcion</option> ';

      if(response.result){
        for (var i in response.montos)
          option += `<option value="${response.montos[i].id}">${response.montos[i].mon_cantidad}</option>`;
      }
      $('.comboMontos').html(option);
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

    if(op != "0"){
      $('#info-plazo').html(op);
      plazo = parseInt(op);

      calcularCuotasDiarias();
    }else{
      plazo = 0;
    }
  });

  $('#cmb-cliente').change(function(){
    var texto = $('#cmb-cliente option:selected').text();
    var op = $('#cmb-cliente option:selected').val();

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

});

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

         alerta = __sweetSimpe('Buen trabajo', 'El cliente se ha eliminado correctmente del sistema', 'success');
         $('.error-datos').html(alerta);
        }
        //console.log(response);
      });
    }
  });
  $('.preguntaAccion').html(alerta);
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
    var total = monto + (monto * (interes/100));
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
    $('#cmb-monto').val($('#cmb-monto > option:first').val());
    $('#cmb-interes').val($('#cmb-interes > option:first').val());
    $('#cmb-plazo').val($('#cmb-plazo > option:first').val());
    $('#cmb-status').val($('#cmb-status > option:first').val());
    $('#txt-cuota').val('');
    $('#txt-observacion').val('');
    $('#txt-cuota-pago').val('');

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
