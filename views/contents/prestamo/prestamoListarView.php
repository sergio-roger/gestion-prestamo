<div id="loader"></div>

<div id="seccion-listar-prestamos" class="d-none">

    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-12 col-md-4 mb-2">
                    <label for="">Filtrar por Estatus</label>
                    <select name="" id="filtrar-prestamo-estatus" class="form-control comboEstatusFiltro">
                        <option value="0">Todos</option>
                    </select>
                </div>

                <div class="col-12 col-md-4 d-flex align-items-end justify-content-center mb-2">
                    <a href="<?= BASE?>prestamoOcultos" class="btn bg-gray color-palette">
                        <span>Ver Lista de Ocultos</span>
                        <i class="fas fa-eye-slash ml-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row mt-3" id="listarTotalPrestamos">
        <!-- <div class="col-12 col-sm-6 col-md-4 col-xl-3 my-2">
            <div class="card card-success">
                <div class="card-header">
                <h3 class="card-title text-white">Préstamo #1</h3>

                <div class="card-tools">
                    <button type="button text-white" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                </div>
        
                </div>
            
                <div class="card-body">
                    <div class="box-cliente d-flex align-items-center justify-content-between">
                        <p class="mb-0">Cliente: </p>
                        <a href="<?php //echo BASE?>clienteInformacion/1"  id="p-1">Juan González</a>
                    </div>

                    <div class="box-monto d-flex align-items-center justify-content-between">
                        <p class="mb-0">Monto: </p>
                        <p class="mb-0">100 </p>
                    </div>

                    <div class="box-monto d-flex align-items-center justify-content-between">
                        <p class="mb-0">Interes: </p>
                        <p class="mb-0">20 % </p>
                    </div>

                    <div class="box-inicio-prestamo d-flex align-items-center justify-content-between">
                        <p class="mb-0">Fecha Inicio: </p>
                        <p class="mb-0">03/10/2019</p>
                    </div>

                    <div class="box-inicio-prestamo d-flex align-items-center justify-content-between">
                        <p class="mb-0">Fecha Fin: </p>
                        <p class="mb-0">03/11/2019</p>
                    </div>

                </div>
                <div class ="card-footer d-flex justify-content-center bg-gradient-success">
                    <a href="#" class="small-box-footer text-white">
                        Mas info
                        <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
        
            </div>
        </div> -->
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="editarPrestamoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-dark">
        <h5 class="modal-title" id="exampleModalLabel">Editar préstamo</h5>
        <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="#" id="form-prestamo-editar" method="POST">
            <div>
                <input type="hidden" id="id-editar-prestamo" class="form-control">
            </div>
            <div>
                <label for="">Observación: </label>
            </div>
            <div>
                <textarea class="form-control" name="" id="editar-observacion-prestamo"  rows="3"></textarea>
            </div>
            <div class="mt-3">
                <label for="">Estatus</label>
            </div>
            <div>
                <select name="" class="form-control comboEstatus" id="editar-estatus-prestamo">
                    <option value="0">Elija opcion</option>
                </select>
            </div>

            <div class="mt-3" id="btn-modal-actualizar">
                <button type="submit" class="btn btn-dark d-none" id="btn-cambios-prestamo">
                    <i class="fas fa-edit blanco ml-2"></i>  
                    Actualizar
                </button>
            </div>
        </form>
      </div>
      <div class="modal-footer">
          
        <button type="button" class="btn btn-danger" data-dismiss="modal">
            <i class="fas fa-times blanco ml-2"></i>
            Cerrar</button>
      </div>
    </div>
  </div>
</div>

<script>
    $(function(){

        var loader = $("#loader");
        _init();

        function _init(){
            loader.gSpinner();
            listaPrestamos(loader);
        }

        function listaPrestamos(preloader){
            dataJson = {
            type:"all",
            method:"get",
            entidad:"prestamo"
            };

            let allPrestamos = new Ajax('ajax/PrestamoAjax.php','GET', dataJson);
            
            allPrestamos.__ajax()
                .done(function(response){
                response = JSON.parse(response);
                var total = '';

                if(response.result){
                    for(let i in response.prestamos){
                    let bgColor = '';
                    let bgGradientColor = '';
                    let textColor = '';
                    let display = '';
                    
                    switch(response.prestamos[i].est_id){
                        case '1':   //Estatus 1 --> Prestamo iniciado
                            bgColor = 'card-success';
                            bgGradientColor = 'bg-gradient-success';
                            textColor = 'text-white';
                            display = ''
                        break;

                        case '2':   //Estatus 2 -> Pagando préstamo
                            bgColor = 'card-primary';
                            bgGradientColor = 'bg-gradient-primary';
                            textColor = 'text-white';
                            display = ''                       
                        break;

                        case '3':   //Estatus 3 -> Finalizado préstamo
                            bgColor = 'card-danger';
                            bgGradientColor = 'bg-gradient-danger';
                            textColor = 'text-white';
                            display = 'd-none'                           
                        break;
                    }

                    let valorPagar = parseInt(response.prestamos[i].monto * response.prestamos[i].interes/100) + parseInt(response.prestamos[i].monto);
                    let plantilla = `
                    <div class="col-12 col-sm-6 col-md-4 col-xl-3 my-2 estatus-${response.prestamos[i].est_id}" id="ep-${response.prestamos[i].id}">
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
                                    <a href="<?= BASE?>clienteInformacion/${response.prestamos[i].cli_id}"  >${response.prestamos[i].nombres}</a>
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
                                    <button class="btn btn-outline-dark" onclick="ocultarPrestamo(${response.prestamos[i].id})">
                                        <i class="fas fa-eye-slash"></i>
                                    </button>

                                    <button class="btn btn-outline-warning ${display}" data-toggle="modal" data-target="#editarPrestamoModal"
                                    onclick="visualizarPrestamo(${response.prestamos[i].id})">
                                     <i class="fas fa-edit"></i>
                                    </button>

                                    <button class="btn btn-outline-danger" onclick="deletePrestamo(${response.prestamos[i].id})">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                
                            </div>
                            <div class ="card-footer d-flex justify-content-center ${bgGradientColor}">
                                <a href="<?= BASE?>prestamoInformacion/${response.prestamos[i].id}" class="small-box-footer text-white">
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

                    $('#listarTotalPrestamos').html(total);
                }
            })
            .always(function(){
                $('#seccion-listar-prestamos').removeClass('d-none');
                preloader.gSpinner('hide');
            });
        }

        $('#form-prestamo-editar').submit(function(e){
            e.preventDefault();
            let observacion = $('#editar-observacion-prestamo').val();
            let estatus = $("#editar-estatus-prestamo option:selected").val();
            let id = $('#id-editar-prestamo').val();

            let alerta = __sweetAlert('¿ Estás seguro ?', 'Los datos del préstamo se actualizarán', 'warning')

            .then((result) => {
                if(result.value){
                // console.log("ID Estatus: " + estatus);
                let dataJson = {
                    type:'update',
                    id:id,
                    observacion: observacion,
                    id_estatus: estatus
                    };

                    let ruta = 'ajax/PrestamoAjax.php';

                    let editar = new Ajax(ruta,'PUT', dataJson);
                    editar.__ajax()
                    .done(function(response){
                    response = JSON.parse(response);

                    if(response.result){
                        console.log(response);
                        alerta = __sweetSimpe('Buen trabajo', 'El préstamo ha sido actualizado', 'success');
                        $('.error-datos').html(alerta);
                        listaPrestamos(loader)

                    }
                    });
                    // console.log(dataJson);
        }
        });
        });

    })
</script>