<div id="loader"></div>

<div class="row preloader-loading d-none">
  <!-- <h1>Id: <?php //$idCliente?></h1> -->
  <div class="col-12 mb-4">
      <a href="<?= BASE?>prestamoListar" class="btn bg-teal color-palette">
        <i class="fas fa-arrow-left"></i>
      </a>
      <a href="<?= BASE?>clienteNuevo" class="btn bg-maroon color-palette ml-2">
      <i class="fas fa-user-plus"></i>
      </a>
      <a href="<?= BASE?>clienteListar" class="btn bg-maroon color-palette ml-2">
        <i class="fas fa-users"></i>
      </a>
      <a href="<?= BASE?>prestamoNuevo" class="btn bg-purple color-palette ml-4">
        <i class="fas fa-hand-holding-usd"></i>
      </a>
  </div>

  <div class="col-12 col-md-6">
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
               <em><?= $idCliente?></em>
             </div>
             <div class="d-flex justify-content-between">
               <strong>Cédula</strong>
               <em id="card-info-cliente-cedula">099999992222</em>
             </div>
             <div class="d-flex justify-content-between">
               <strong>Nombres</strong>
               <em id="card-info-cliente-nombres">Sergio Roger</em>
             </div> <div class="d-flex justify-content-between">
               <strong>Apellidos</strong>
               <em id="card-info-cliente-apellidos">Floreano Tomalá</em>
             </div>
             <div class="d-flex justify-content-between">
               <strong>Correo</strong>
               <em id="card-info-cliente-correo">sergio@live.com</em>
             </div> <div class="d-flex justify-content-between">
               <strong>Sexo</strong>
               <em id="card-info-cliente-sexo">M</em>
             </div>
             <div class="d-flex justify-content-between">
               <strong>Edad</strong>
               <em id="card-info-cliente-edad">23</em>
             </div>
             <div class="d-flex justify-content-between">
               <strong>Teléono</strong>
               <em id="card-info-cliente-telefono">0238434234</em>
             </div>
             <div class="d-flex justify-content-between">
               <strong>Lugar Cobro</strong>
               <em id="card-info-cliente-lugar-cobro">La Libertad</em>
             </div>
             <div class="d-flex justify-content-between">
               <strong>Lugar de Trabajo</strong>
               <em id="card-info-cliente-lugar-trabajo">La Libertad</em>
             </div>
             <hr>
             <h6 class="text-danger">
               <strong>Información de Adicional</strong></h6>
             <div class="d-flex justify-content-between">
               <strong>Fecha de Registro</strong>
               <em id="card-info-cliente-registro">2019/08/12</em>
             </div>
             <div class="d-flex justify-content-between">
               <strong>Última actualización</strong>
               <em id="card-info-cliente-update">2019/08/12</em>
             </div>
          </dl>
        </div>
      </div>
  </div>
</div>


<script> 

$(function(){
    _init();

    function _init(){

        datosUsuario();     
        var loader = $("#loader");
        loader.gSpinner();
        getInfoCliente(loader);
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

      function getInfoCliente(preloader){

        let ruta = '../ajax/ClienteDatosAjax.php';
        let dataJson = {
          type:"one",
          method:"get",
          entidad:"clientes",
          id: '<?= $idCliente?>',
          archivo: ruta
        };

        $.ajax({
          'method':'POST',
          'url': ruta,
          'data': { 'data': JSON.stringify(dataJson)}
        })
        .done(function(response) {
          response = JSON.parse(response);
          // console.log(response);
          if(response.result){

            let cedula = (!response.cliente) ? $('#card-info-cliente-cedula').html(''): $('#card-info-cliente-cedula').html(response.cliente.cli_cedula);
            let nombre = (!response.cliente) ? $('#card-info-cliente-nombres').html('') :$('#card-info-cliente-nombres').html(response.cliente.cli_nombres);
            let apellido = (!response.cliente) ? $('#card-info-cliente-apellidos').html('') : $('#card-info-cliente-apellidos').html(response.cliente.cli_apellidos);
            let correo = (!response.cliente) ? $('#card-info-cliente-correo').html('') : $('#card-info-cliente-correo').html(response.cliente.cli_correo);
            let sexo = (!response.cliente) ? $('#card-info-cliente-sexo').html(''):$('#card-info-cliente-sexo').html(response.cliente.cli_sexo);
            let edad = (!response.cliente) ? $('#card-info-cliente-edad').html('') :$('#card-info-cliente-edad').html(response.cliente.cli_edad + '  años');
            let tel = (!response.cliente) ? $('#card-info-cliente-telefono').html(''): $('#card-info-cliente-telefono').html(response.cliente.cli_telefono);
            let cobro = (!response.cliente) ? $('#card-info-cliente-lugar-cobro').html('') : $('#card-info-cliente-lugar-cobro').html(response.cliente.cli_lugar_cobro);
            let trab = (!response.cliente) ? $('#card-info-cliente-lugar-trabajo').html('') : $('#card-info-cliente-lugar-trabajo').html(response.cliente.cli_lugar_trabajo);
            let ing = (!response.cliente) ? $('#card-info-cliente-registro').html('') : $('#card-info-cliente-registro').html(response.cliente.cli_fecha_ingreso);
            let upd = (!response.cliente) ? $('#card-info-cliente-update').html('') : $('#card-info-cliente-update').html(response.cliente.cli_lugar_update);
          }
        })
        .fail(function(){
          console.log('error en ajax POST cliente');

        })
        .always(function(){
          // $loader.gSpinner('hide');
          preloader.gSpinner('hide');
          $('.preloader-loading').removeClass('d-none');
          console.log('Petición ajax completa');
          // alert('Petición terminada');
        });
      }

});

</script>