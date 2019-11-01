
<div id="seccion-listar-cuotas">
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-edit"></i>
                Información de las cuotas
            </h3>
        </div>

        <div class="card-body">
            <div class="card-body">
                <!-- <h4>Custom Content Below</h4> -->
                <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="custom-content-below-home-tab" data-toggle="pill" 
                        href="#custom-content-below-home" role="tab" aria-controls="custom-content-below-home" aria-selected="true">Compactada</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-content-below-profile-tab" data-toggle="pill" 
                        href="#custom-content-below-profile" role="tab" aria-controls="custom-content-below-profile" aria-selected="false">Detallada</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-content-below-messages-tab" data-toggle="pill" 
                        href="#custom-content-below-messages" role="tab" aria-controls="custom-content-below-messages" aria-selected="false">Messages</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-content-below-settings-tab" data-toggle="pill" 
                        href="#custom-content-below-settings" role="tab" aria-controls="custom-content-below-settings" aria-selected="false">Settings</a>
                    </li>
                </ul>
                <div class="tab-content" id="custom-content-below-tabContent">
                    <div class="tab-pane fade show active" id="custom-content-below-home" role="tabpanel" aria-labelledby="custom-content-below-home-tab">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin malesuada lacus ullamcorper dui molestie, sit amet congue quam finibus. Etiam ultricies nunc non magna feugiat commodo. Etiam odio magna, mollis auctor felis vitae, ullamcorper ornare ligula. Proin pellentesque tincidunt nisi, vitae ullamcorper felis aliquam id. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Proin id orci eu lectus blandit suscipit. Phasellus porta, ante et varius ornare, sem enim sollicitudin eros, at commodo leo est vitae lacus. Etiam ut porta sem. Proin porttitor porta nisl, id tempor risus rhoncus quis. In in quam a nibh cursus pulvinar non consequat neque. Mauris lacus elit, condimentum ac condimentum at, semper vitae lectus. Cras lacinia erat eget sapien porta consectetur. 
                    </div>
                    <div class="tab-pane fade" id="custom-content-below-profile" role="tabpanel" aria-labelledby="custom-content-below-profile-tab">
                        <div class="card card-dark mt-3">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Información Inicial
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-md-6 d-flex justify-content-between">
                                        <b>Cliente: </b>
                                        <span class="mr-3" id="clv-cliente"></span>
                                    </div>
                                    <div class="col-12 col-md-6 d-flex justify-content-between">
                                        <div class="mr-2">
                                            <b>ID</b>
                                        </div>
                                        <div class="w-100">
                                            <select name="" class="form-control llenaComboPrestamoID" id="cmb-listar-prestamos-cuotas">
                                                <option value="0">Seleccione préstamo</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 d-flex justify-content-between mt-2">
                                        <div >
                                            <b>Fecha Inicio:</b>
                                        </div>
                                        <div>
                                            <span class="mr-3" id="clv-fechaInicio"></span>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6 d-flex justify-content-between mt-2">
                                        <div>
                                            <b>Fecha Fin:</b>
                                        </div>
                                        <div>
                                            <span class="mr-3" id="clv-fechaFin"></span>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6 d-flex justify-content-between mt-2">
                                        <div>
                                            <b>Monto:</b>
                                        </div>
                                        <div>
                                            <span class="mr-3" id="clv-monto"></span>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6 d-flex justify-content-between mt-2">
                                        <div>
                                            <b>Interes:</b>
                                        </div>
                                        <div>
                                            <span class="mr-3" id="clv-interes"></span>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6 d-flex justify-content-between mt-2">
                                        <div>
                                            <b>Estatus:</b>
                                        </div>
                                        <div>
                                            <span class="mr-3" id="clv-estatus"></span>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6 d-flex justify-content-between mt-2">
                                        <div>
                                            <b>Total:</b>
                                        </div>
                                        <div>
                                            <span class="mr-3" id="clv-total"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div id="accordion">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h4 class="card-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                            Información de las Cuotas
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseOne" class="panel-collapse collapse in">
                                    <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-bordered w-100" id="tb-cuotas" style="background:#fff;">
                                            <thead>
                                                <tr class="">
                                                    <!-- <th class=""></th>4 -->
                                                    <th scope="col" class="text-center">N #</th>
                                                    <th scope="col" class="text-center">Fecha Pago</th>
                                                    <th scope="col" class="text-center">Valor Pagado</th>
                                                    <th scope="col" class="text-center">Saldo Actual</th>
                                                    <th scope="col" class="text-center">Saldo Restante</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tabla-body-cuotas" class="table-striped">
                                                <tr></tr>
                                            </tbody>
                                            <tfoot>
                                                <th scope="col" class="text-center">N #</th>
                                                <th scope="col" class="text-center">Fecha Pago</th>
                                                <th scope="col" class="text-center">Valor Pagado</th>
                                                <th scope="col" class="text-center">Saldo Actual</th>
                                                <th scope="col" class="text-center">Saldo Restante</th>
                                            </tfoot>
                                        </table>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="custom-content-below-messages" role="tabpanel" aria-labelledby="custom-content-below-messages-tab">
                        Morbi turpis dolor, vulputate vitae felis non, tincidunt congue mauris. Phasellus volutpat augue id mi placerat mollis. Vivamus faucibus eu massa eget condimentum. Fusce nec hendrerit sem, ac tristique nulla. Integer vestibulum orci odio. Cras nec augue ipsum. Suspendisse ut velit condimentum, mattis urna a, malesuada nunc. Curabitur eleifend facilisis velit finibus tristique. Nam vulputate, eros non luctus efficitur, ipsum odio volutpat massa, sit amet sollicitudin est libero sed ipsum. Nulla lacinia, ex vitae gravida fermentum, lectus ipsum gravida arcu, id fermentum metus arcu vel metus. Curabitur eget sem eu risus tincidunt eleifend ac ornare magna. 
                    </div>
                    <div class="tab-pane fade" id="custom-content-below-settings" role="tabpanel" aria-labelledby="custom-content-below-settings-tab">
                        Pellentesque vestibulum commodo nibh nec blandit. Maecenas neque magna, iaculis tempus turpis ac, ornare sodales tellus. Mauris eget blandit dolor. Quisque tincidunt venenatis vulputate. Morbi euismod molestie tristique. Vestibulum consectetur dolor a vestibulum pharetra. Donec interdum placerat urna nec pharetra. Etiam eget dapibus orci, eget aliquet urna. Nunc at consequat diam. Nunc et felis ut nisl commodo dignissim. In hac habitasse platea dictumst. Praesent imperdiet accumsan ex sit amet facilisis. 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>