
<script>
    //window.onload = function(){
        $(document).ready(function(){
            $('#tabla-clientes').DataTable();
            
            $('#btn-logout').click(function(e){
            e.preventDefault();
            
            var token = $(this).attr('href');
            var ruta = 'token='+token;

            Swal.fire({
            title: '¿ Estás seguro?',
            text: "La sesión actual se cerrará!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'No, seguir akí',
            confirmButtonText: 'Sí, cerrar ahora !'
            })
            .then((result) => {
                if (result.value) {
                   // console.log("click en si, cerrar ahora");
                   
                    $.ajax({
                        url: '<?= BASE?>ajax/logoutAjax.php',
                        type: 'GET',
                        data: ruta
                        })
                    .done(function(response){
                    //console.log("success");
                        if(response){
                            window.location.href = '<?= BASE?>'
                        }else{
                            Swal.fire(
                                'Ocurrió un error',
                                'No se pudo cerrar la sesión',
                                'error'
                            );
                        }
                    })
                    .fail(function(){
                        console.log("error");
                    })
                    .always(function(){
                    //console.log("complete");
                    });
                    }
                });
            });
        });
    //}
</script>

