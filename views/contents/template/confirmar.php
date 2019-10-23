
<body>
    <div class="container">
        <div class="row">
            <div class="col-12 mt-5 text-center">
                    
                <div>
                    <h1 class="text-info"><?= APLICACION ?></h1>    
                </div>
                <hr>
                <div id="div-msj" class="d-none">
                    <div class="alert alert-success" role="alert">
                        <strong class="mr-2">Bien echo!</strong> Tu correo ha sido verificado <a href="<?= BASE?>/home" class="alert-link ml-2">Ir  a la aplicación</a>.
                    </div>
                </div>

                <div class="mt-3 mb-5">
                    <img src="<?= BASE ?>assets/dist/img/img-correo.PNG" alt="">
                </div>
                
                <div class="mt-3 mb-4">
                    <button class="btn btn-danger" id="confirmar-correo">
                        <i class="fas fa-envelope mr-2"></i>
                        <span class="">Verificar correo</span>
                    </button>
                </div>
            </div>
        </div>
    <div>
<script>

    $(function(){
        _init();
       
        function _init(){
            confirmarCorreo();
            getID();
        }

        function getID(){
            let URLactual = $(location).attr('href');
            uri = URLactual.split('/');
            id = uri[uri.length - 1];

            // console.log(id);
            return id;
        }

        function confirmarCorreo(){
            $('#confirmar-correo').click(function(){
                let ruta ='../../../ajax/UsuarioAjax.php';
                let d = {confirmar:'S', id: getID()};

                $.ajax({
                    'url' : ruta,
                    'type': "GET",
                    'data': {data: JSON.stringify(d)}
                })
                .done(function(response){
                    response = JSON.parse(response);

                    if(response.result){

                        $('#div-msj').removeClass('d-none');
                        console.log(response);
                    }

                })
                .fail(function(){
                    console.log('Error');
                });
            });
        }
    });
</script>