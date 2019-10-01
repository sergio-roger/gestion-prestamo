$(function(){
  //console.log("JQuery cargado");

  $('#enviar').click(function(e){
    e.preventDefault();

    var correo = $('#correo').val();
    var clave = $('#clave').val();
    var ruta = "correo="+correo+"&clave="+clave;

    if(correo == ''){
      Swal.fire(
        'Ups ocurrió un error',
        'Debe ingresar un correo para continuar',
        'error'
      )
    }else if(clave == ''){
      Swal.fire(
        'Ups ocurrió un error',
        'Debe ingresar un clave para continuar',
        'error'
      )
    }else{

      $.ajax({
        url: 'ajax/LoginAjax.php',
        type: 'POST',
        data: ruta
      })
      .done(function(response){
        //console.log("success");
        $('.RespuestaAjax').html(response);
      })
      .fail(function(){
        //e.prevenDefault();
        console.log("Ocurrio un error al Iniciar sesion");
      })
      .always(function(){
        //console.log("complete");
      });
    }
  });
})
