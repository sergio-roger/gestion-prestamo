<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="<?= BASE ?>index"><b><?= APLICACION ?></b></a>
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Registrarme como nuevo usuario</p>

      <form action="<?= BASE ?>ajax/UsuarioAjax.php" method="POST" class="formularioAjax" data-form="save" enctype="multipart/form-data">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Nombre" name="nombres">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Apellidos" name="apellidos">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email" name="correo">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
           <!-- radio -->
           <div class="form-group">
              <label>Elija Sexo</label>
              <div class="box-sex d-flex">
                <div class="custom-control custom-radio mr-4 ml-1">
                      <input class="custom-control-input" type="radio" id="masculino" name="sexo" value="M">
                      <label for="masculino" class="custom-control-label">Masculino</label>
                      <!-- <input class="custom-control-input" type="radio" id="femenino" name="sexo" checked value="F">
                      <label for="femenino" class="custom-control-label">Femenino</label> -->
                </div>
                <div class="custom-control custom-radio ml-5">
                      <input class="custom-control-input" type="radio" id="femenino" name="sexo" checked value="F">
                      <label for="femenino" class="custom-control-label">Femenino</label>
                </div>
              </div>
            </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Contraseña" name="clave">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Repetir contraseña" name="conf-clave">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Registrarme ya !</button>
          </div>
          <!-- /.col -->
          <div class="col-12 mt-3">
            <div class="icheck-primary">
              <input type="checkbox" id="agreeTerms" name="terms" value="agree">
              <label for="agreeTerms">
               Acepto términos y <a href="#">condiciones</a>
              </label>
            </div>
          </div>
        </div>

        <div class="RespuestaAjax"></div>
      </form>

      <!-- <div class="social-auth-links text-center">
        <p>- OR -</p>
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i>
          Sign up using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i>
          Sign up using Google+
        </a>
      </div> -->

      <a href="<?= BASE ?>login" class="text-center">Ya tengo una cuenta registrada!</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

