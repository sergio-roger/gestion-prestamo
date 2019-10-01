
<!-- Modal para Agregar Cliente -->
<div class="modal fade" id="agregarCliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header bg-dark">
            <h5 class="modal-title" id="exampleModalCenterTitle">Agregar Cliente</h5>
            <button type="button" class="close bg-danger" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>

      <div class="modal-body">

      <form action="#">
        <div class="row">
            <div class="col-4 my-2">
              <label for="cedula">* Cédula</label>
            </div>
            <div class="col-6 my-2">
              <input type="text" class="form-control only-numbers input-sm ml-5" id="cliente-cedula"
                      name="cliente-cedula" placeholder="Ingrese cédula" maxlength="10">
            </div>
        </div>

        <div class="row">
            <div class="col-4 my-2">
              <label for="cedula">* Nombres</label>
            </div>
            <div class="col-6 my-2">
              <input type="text" class="form-control input-sm ml-5" id="cliente-cedula"
                      name="cliente-cedula" placeholder="Ingrese nombres" maxlength="50">
            </div>
        </div>

        <div class="row">
            <div class="col-4 my-2">
              <label for="cedula">* Apellidos</label>
            </div>
            <div class="col-6 my-2">
              <input type="text" class="form-control input-sm ml-5" id="cliente-cedula"
                      name="cliente-cedula" placeholder="Ingrese apellidos" maxlength="50">
            </div>
        </div>

        <div class="row">
          <div class="col-4 my-2">
            <label for="cedula">* Edad</label>
          </div>
          <div class="col-6 my-2">
            <input type="number" class="form-control input-sm ml-5 only-numbers" id="cliente-cedula"
                    name="cliente-cedula" placeholder="Ingresa edad" maxlength="2">
          </div>
        </div>

        <div class="row">
           <div class="col-4 my-2">
              <label for="cedula">* Sexo</label>
              <div class="form-group d-flex">
                  <div class="custom-control custom-radio d-flex">
                      <input class="custom-control-input" type="radio" id="masculino" name="cliente-sexo" value="M">
                      <label for="masculino" class="custom-control-label">Masculino</label>
                  </div>
                  <div class="custom-control custom-radio" style="margin-left: 50px;">
                      <input class="custom-control-input" type="radio" id="femenino" name="cliente-sexo" checked value="F">
                      <label for="femenino" class="custom-control-label">Femenino</label>
                  </div>
              </div>
          </div>
        </div>

        <div class="row">
            <div class="col-4 my-2">
              <label for="cedula">* Lugar de Cobro</label>
            </div>
  
            <div class="col-6 my-2">
                <div class="row">
                    <div class="col-12">
                        <textarea class="form-control input-sm ml-5"
                                 placeholder="Ingrese lugar de cobro" maxlength="255">
                        </textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-success" data-dismiss="modal">Guardar Cliente</button>
        </div>
        
      </form>  

    </div>
  </div>
</div>