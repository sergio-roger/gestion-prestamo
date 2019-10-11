<div id="loader"></div>

<div id="seccion-listar-prestamos-ocultos" class="d-none">
    <div class="row">
        <div class="col-12">
            <!-- <h3>Hola</h3> -->
        </div>
    </div>

    <div class="row mt-3" id="listarPrestamosOcultos">
    </div>
</div>

<script>
    $(function(){

        _init();

        function _init(){
            var loader = $("#loader");
            loader.gSpinner();
            listaPrestamos(loader);
        }

        function listaPrestamos(preloader){
            dataJson = {
            type:"allHide",
            method:"get",
            entidad:"prestamo"
            };

            let allPrestamos = new Ajax('ajax/PrestamoAjax.php','GET', dataJson);
            
            allPrestamos.__ajax()
                .done(function(response){
                    // console.log(response);
                response = JSON.parse(response);
                var total = '';

                if(response.result){
                    for(let i in response.prestamos){
                    let bgColor = '';
                    let bgGradientColor = '';
                    let textColor = '';

                    switch(response.prestamos[i].est_id){
                        case '1':   //Estatus 1 --> Prestamo iniciado
                            bgColor = 'card-success';
                            bgGradientColor = 'bg-gradient-success';
                            textColor = 'text-white';
                        break;
                        case '2':   //Estatus 2 -> Pagando préstamo
                            bgColor = 'card-primary';
                            bgGradientColor = 'bg-gradient-primary';
                            textColor = 'text-white';
                        break;
                        case '3':   //Estatus 3 -> Finalizado préstamo
                            bgColor = 'card-danger';
                            bgGradientColor = 'bg-gradient-danger';
                            textColor = 'text-white';
                        break;
                    }

                    let valorPagar = parseInt(response.prestamos[i].monto * response.prestamos[i].interes/100) + parseInt(response.prestamos[i].monto);
                    let plantilla = `
                    <div class="col-12 col-sm-6 col-md-4 col-xl-3 my-2" id="ep-${response.prestamos[i].id}">
                        <div class="card ${bgColor} scale-card">
                            <div class="card-header">
                            <h3 class="card-title text-white">Préstamo - ID # ${response.prestamos[i].id}</h3>
                
                            <div class="card-tools">
                                <button type="button ${textColor}" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="box-cliente d-flex align-items-center justify-content-between">
                                    <p class="mb-0">Cliente: </p>
                                    <a href="${BASE}clienteInformacion/${response.prestamos[i].cli_id}"  >${response.prestamos[i].nombres}</a>
                                </div>
                
                                <div class="box-monto d-flex align-items-center justify-content-between">
                                    <p class="mb-0">Monto: </p>
                                    <p class="mb-0">${response.prestamos[i].monto}</p>
                                </div>
                
                                <div class="box-monto d-flex align-items-center justify-content-between">
                                    <p class="mb-0">Interes: </p>
                                    <p class="mb-0">${response.prestamos[i].interes} % </p>
                                </div>

                                <div class="box-monto d-flex align-items-center justify-content-between">
                                    <p class="mb-0">Cuota diaria: </p>
                                    <p class="mb-0">$ ${response.prestamos[i].pres_cuota} </p>
                                </div>

                                <div class="box-inicio-prestamo d-flex align-items-center justify-content-between">
                                    <p class="mb-0">Fecha Inicio: </p>
                                    <p class="mb-0">${response.prestamos[i].pres_fecha_inicio}</p>
                                </div>
                
                                <div class="box-inicio-prestamo d-flex align-items-center justify-content-between">
                                    <p class="mb-0">Fecha Fin: </p>
                                    <p class="mb-0">${response.prestamos[i].pres_fecha_fin}</p>
                                </div>

                                <div class="box-inicio-prestamo d-flex align-items-center justify-content-between">
                                    <p class="mb-0">Valor a pagar:</p>
                                    <p class="mb-0">$ ${valorPagar}</p>
                                </div>

                                <div class="d-flex justify-content-around mt-3">
                                    <button class="btn btn-outline-dark" onclick="mostrarPrestamo(${response.prestamos[i].id})">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                
                            </div>
                            <div class ="card-footer d-flex justify-content-center ${bgGradientColor}">
                                <a href="#" class="small-box-footer text-white">
                                    Mas info
                                    <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>  
                    `;
                    total = total + plantilla;
                    // console.log(response.prestamos[i]);
                    }
                    $('#listarPrestamosOcultos').html(total);
                }
            })
            .always(function(){
                $('#seccion-listar-prestamos-ocultos').removeClass('d-none');
                preloader.gSpinner('hide');
            });
        }
    })
</script>