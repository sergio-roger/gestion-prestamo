<div class="row">
    <div class="col-md-3">
        <!-- Profile Image -->
        <!-- About Me Box -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Acerca de mí</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body box-profile">
                <div class="text-center">
                    <!-- Imagen de 128 x 128 -->
                    <img class="profile-user-img img-fluid img-circle"
                        src="<?= BASE ?>assets/dist/img/<?= $_SESSION['usuario']['usu_foto']?>"
                        alt="User profile picture">
                </div>

                <h3 class="profile-username text-center usuario-name">
                    Usuario defualt
                </h3>
                <p class="text-muted text-center usuario-cargo"></p>
                <a href="#" class="btn btn-primary btn-block"><b>Actualizar Foto</b></a>
            </div>

            <div class="card-body">
                <strong><i class="fas fa-user-alt mr-1"></i> Usuario</strong>

                <p class="text-muted usuario-usuario">admin </p>

                <hr>
                <strong> <i class="fas fa-envelope mr-1"></i> Correo</strong>
                <p class="text-muted usuario-correo"> </p>
                <hr>

                <strong><i class="fas fa-venus-mars mr-1"></i> Sexo</strong>
                    <p class="text-muted usuario-sexo"></p>
                <hr>

                <strong><i class="fas fa-map-marker-alt mr-1"></i> Dirección</strong>
                <p class="text-muted usuario-direccion"></p>

                <hr>
                <strong><i class="fas fa-mobile-alt mr-1"></i></i> Telefono</strong>
                <p class="text-muted usuario-telefono"></p>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>

    <!-- /.col -->  
    <div class="col-md-9">
        <div class="card">
            <div class="card-header p-2">
            <ul class="nav nav-pills">
                <!-- <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Activity</a></li> -->
                <li class="nav-item"><a class="nav-link active" href="#timeline" data-toggle="tab">Timeline</a></li>
                <li class="nav-item"><a class="nav-link" href="#datos" data-toggle="tab">Mis Datos</a></li>
                <li class="nav-item"><a class="nav-link" href="#sesion" data-toggle="tab">Inicio de Sesión</a></li>
            </ul>
            </div><!-- /.card-header -->
            <div class="card-body">
            <div class="tab-content">

            
                <!-- /.tab-pane -->
                <div class="active tab-pane" id="timeline">
                <!-- The timeline -->
                <div class="timeline timeline-inverse">
                    <!-- timeline time label -->
                    <div class="time-label">
                    <span class="bg-danger">
                        10 Feb. 2014
                    </span>
                    </div>
                    <!-- /.timeline-label -->
                    <!-- timeline item -->
                    <div>
                    <i class="fas fa-envelope bg-primary"></i>

                    <div class="timeline-item">
                        <span class="time"><i class="far fa-clock"></i> 12:05</span>

                        <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

                        <div class="timeline-body">
                        Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                        weebly ning heekya handango imeem plugg dopplr jibjab, movity
                        jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                        quora plaxo ideeli hulu weebly balihoo...
                        </div>
                        <div class="timeline-footer">
                        <a href="#" class="btn btn-primary btn-sm">Read more</a>
                        <a href="#" class="btn btn-danger btn-sm">Delete</a>
                        </div>
                    </div>
                    </div>
                    <!-- END timeline item -->
                    <!-- timeline item -->
                    <div>
                    <i class="fas fa-user bg-info"></i>

                    <div class="timeline-item">
                        <span class="time"><i class="far fa-clock"></i> 5 mins ago</span>

                        <h3 class="timeline-header border-0"><a href="#">Sarah Young</a> accepted your friend request
                        </h3>
                    </div>
                    </div>
                    <!-- END timeline item -->
                    <!-- timeline item -->
                    <div>
                    <i class="fas fa-comments bg-warning"></i>

                    <div class="timeline-item">
                        <span class="time"><i class="far fa-clock"></i> 27 mins ago</span>

                        <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>

                        <div class="timeline-body">
                        Take me to your leader!
                        Switzerland is small and neutral!
                        We are more like Germany, ambitious and misunderstood!
                        </div>
                        <div class="timeline-footer">
                        <a href="#" class="btn btn-warning btn-flat btn-sm">View comment</a>
                        </div>
                    </div>
                    </div>
                    <!-- END timeline item -->
                    <!-- timeline time label -->
                    <div class="time-label">
                    <span class="bg-success">
                        3 Jan. 2014
                    </span>
                    </div>
                    <!-- /.timeline-label -->
                    <!-- timeline item -->
                    <div>
                    <i class="fas fa-camera bg-purple"></i>

                    <div class="timeline-item">
                        <span class="time"><i class="far fa-clock"></i> 2 days ago</span>

                        <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>

                        <div class="timeline-body">
                        <img src="http://placehold.it/150x100" alt="...">
                        <img src="http://placehold.it/150x100" alt="...">
                        <img src="http://placehold.it/150x100" alt="...">
                        <img src="http://placehold.it/150x100" alt="...">
                        </div>
                    </div>
                    </div>
                    <!-- END timeline item -->
                    <div>
                    <i class="far fa-clock bg-gray"></i>
                    </div>
                </div>
                </div>
                <!-- /.tab-pane -->

                <div class="tab-pane" id="datos">
                    <form class="form-horizontal">
                        <div class="form-group">
                        <label for="nombres" class="col-sm-4 control-label">Nombres</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="perfil-nombres" placeholder="Ingrese nombres">
                        </div>
                        </div>
                        <div class="form-group">
                             <label for="apellidos" class="col-sm-4 control-label">Apellidos</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="perfil-apellidos" placeholder="Ingrese apellidos">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="correo" class="col-sm-4 control-label">Correo</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="perfil-correo" placeholder="Ingrese correo">
                            </div>
                        </div>
                        

                        <div class="form-group">
                            <label for="direccion" class="col-sm-4 control-label">Direccion</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="perfil-direccion" placeholder="Ingrese direccion"></textarea>
                            </div>
                        </div>

                        <label for="sexo" class="col-sm-4 control-label">Sexo</label>
                        <div class="form-group d-flex">
                            <!-- <div class="col-sm-10">
                                <input type="checkbox" id="masculino" name="sexo" value="M">
                            </div> -->
                            <div class="custom-control custom-radio mr-4 ml-1 " id="perfil-sm">
                                <input class="custom-control-input" type="radio" id="masculino" name="sexo" value="M">
                                <label for="masculino" class="custom-control-label">Masculino</label>
                                <!-- <input class="custom-control-input" type="radio" id="femenino" name="sexo" checked value="F">
                                <label for="femenino" class="custom-control-label">Femenino</label> -->
                            </div>
                            <div class="custom-control custom-radio ml-5" id="perfil-sf">
                                <input class="custom-control-input" type="radio" id="femenino" name="sexo" checked value="F">
                                <label for="femenino" class="custom-control-label">Femenino</label>
                             </div>
                        </div>

                        <div class="form-group">
                            <label for="cargo" class="col-sm-4 control-label">Cargo</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="perfil-cargo" placeholder="Ingrese cargo">                           
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="usuario" class="col-sm-4 control-label">Usuario</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="perfil-usuario" placeholder="Ingrese usuario">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="telefono" class="col-sm-4 control-label">Telefono</label>
                            <div class="col-sm-10">
                                <input type="tel" class="form-control" id="perfil-telefono" placeholder="Ingrese telefono">
                            </div>
                        </div>

                        <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-danger">Actualizar datos</button>
                        </div>
                        </div>
                    </form>
                </div>

                <div class="tab-pane" id="sesion">
                    <form class="form-horizontal">
                        <div class="form-group">
                        <label for="inputName" class="col-sm-6 control-label">Contraseña anterior</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="claveAnterior" placeholder="">
                        </div>
                        </div>
                        <div class="form-group">
                        <label for="inputEmail" class="col-sm-6 control-label">Nueva contraseña</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nuevaClave" placeholder="">
                        </div>
                        </div>
                        <div class="form-group">
                        <label for="inputName2" class="col-sm-6 control-label">Confirmar Nueva contraseña</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nuevaClaveConfir" placeholder="">
                        </div>
                        </div>
    
                        <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-danger">Submit</button>
                        </div>
                        </div>
                    </form>
                </div>
                <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
            </div><!-- /.card-body -->
        </div>
        <!-- /.nav-tabs-custom -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->