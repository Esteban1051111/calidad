<?php
$url_base = "" ?>
<?php include('../../../templates/headerconstructora.php') ?>
<br />
<div class="card bg-dark custom-margin">
  <div class="card bg-light custom-margintwo">
    <div class="card-header">RADICACIÓN EN LINEA</div>
    <div class="card-body">
      <div class="table-responsive-sm">
        <div class="container">
          <div class="row">
            <div class="col">
              <label for="inputNumero" class="form-label">Número Radicado</label>
              <input type="number" class="form-control" id="inputNumero" placeholder="Número radicado">
            </div>
            <div class="col">
              <div class="mb-3">
                <label for="selectOpcion" class="form-label">Seleccione una opción</label>
                <select class="form-select" id="selectOpcion">
                  <option selected>Seleccione...</option>
                  <option value="1">Venta</option>
                  <option value="2">Venta con Hipoteca</option>
                  <option value="3">Hipoteca</option>
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="mb-3">
                <label for="matriculas" class="form-label">Número de Matrícula</label>
                <div id="matricula-container">
                  <div class="input-group mb-3">
                    <input type="text" class="form-control" name="matriculas[]" placeholder="Ingresar matrícula" pattern="^\d{3}-\d{6}$" title="Formato: 100-202020">
                    <button class="btn btn-outline-secondary" type="button" id="add-matricula">Agregar</button>
                  </div>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="mb-3">
                <label for="selectOpcion" class="form-label">Proyecto</label>
                <select class="form-select" id="selectOpcion">
                  <option selected>Seleccione...</option>
                  <option value="1">casa de la loma</option>
                  <option value="2">loma de las casas</option>
                  <option value="3">las casas en la loma</option>
                </select>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  document.getElementById('add-matricula').addEventListener('click', function() {
    var container = document.getElementById('matricula-container');
    var inputGroup = document.createElement('div');
    inputGroup.className = 'input-group mb-3';
    inputGroup.innerHTML = `
      <input type="text" class="form-control" name="matriculas[]" placeholder="Ingresar matrícula" pattern="^\\d{3}-\\d{6}$" title="Formato: 100-202020">
      <button class="btn btn-outline-secondary remove-matricula" type="button">Eliminar</button>
    `;
    container.appendChild(inputGroup);

    inputGroup.querySelector('.remove-matricula').addEventListener('click', function() {
      container.removeChild(inputGroup);
    });
  });
</script>

<!--ESTE ESTA BIEN NO TOCAR-->

<div class="card bg-dark custom-margintwo">
  <div class="card bg-light custom-margintwo">
    <div class="card-header">PRIMER INTERVINIENTE (VENDEDOR - COMPARECIENTE)</div>
    <div class="card-body">
      <div class="table-responsive-sm">
        <div class="container">
          <div class="row">
            <div class="col">
              <div class="mb-3">
                <label for="nombre" class="form-label">Nombres</label>
                <input type="text" class="form-control" name="nombre" id="nombre" aria-describedby="helpId" placeholder="Nombres..." />
              </div>
            </div>
            <div class="col">
              <div class="mb-3">
                <label for="apellidos_PI" class="form-label">Apellidos</label>
                <input type="text" class="form-control" name="apellidos_PI" id="apellidos_PI" aria-describedby="helpId" placeholder="Apellidos..." />
              </div>
            </div>
            <div class="col">
              <div class="mb-3">
                <label for="identificacion_PI" class="form-label">Tipo Identificación</label>
                <select class="form-select form-select-lg" name="" id="">
                  <option selected></option>
                  <option value="">CC</option>
                  <option value="">Nit</option>
                  <option value="">Cedula Extranjera</option>
                  <option value="">Tarjeta de Identidad</option>
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="mb-3">
                <label for="inputNumero" class="form-label">Número de Identificación</label>
                <input type="number" class="form-control" id="inputNumero" placeholder="Ingrese un número">
              </div>
            </div>
            <div class="col">
              <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="tel" class="form-control" id="telefono" placeholder="Ingresar teléfono">
              </div>
            </div>
            <div class="col">
              <div class="mb-3">
                <label for="actividad_economica" class="form-label">Actividad Economica</label>
                <input type="text" class="form-control" name="actividad_economica" id="actividad_economica" aria-describedby="helpId" placeholder="Actividad Economica..." />
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="mb-3">
                <label for="direccion" class="form-label">Dirección</label>
                <input type="text" class="form-control" name="direccion" id="direccion" aria-describedby="helpId" placeholder="Cra # && - 00..." />
              </div>
            </div>
            <div class="col">
              <div class="mb-3">
                <label for="email" class="form-label">Correo</label>
                <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelpId" placeholder="abc@mail.com" />
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="mb-3">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="checkApoderado" />
                  <label class="form-check-label" for="checkApoderado"> Tiene Apoderado </label>
                </div>
              </div>
            </div>
          </div>
          <div id="apoderadoSection" class="card bg-light custom-margintwo" style="display: none;">
            <div class="card-header">PRIMER INTERVINIENTE (APODERADO)</div>
            <div class="card-body">
              <div class="table-responsive-sm">
                <div class="container">
                  <div class="row">
                    <div class="col">
                      <div class="mb-3">
                        <label for="nombre_apoderado" class="form-label">Nombres</label>
                        <input type="text" class="form-control" name="nombre_apoderado" id="nombre_apoderado" aria-describedby="helpId" placeholder="Nombres..." />
                      </div>
                    </div>
                    <div class="col">
                      <div class="mb-3">
                        <label for="apellidos_apoderado" class="form-label">Apellidos</label>
                        <input type="text" class="form-control" name="apellidos_apoderado" id="apellidos_apoderado" aria-describedby="helpId" placeholder="Apellidos..." />
                      </div>
                    </div>
                    <div class="col">
                      <div class="mb-3">
                        <label for="identificacion_apoderado" class="form-label">Tipo Identificación</label>
                        <select class="form-select form-select-lg" name="identificacion_apoderado" id="identificacion_apoderado">
                          <option selected></option>
                          <option value="CC">CC</option>
                          <option value="Nit">Nit</option>
                          <option value="Cedula Extranjera">Cedula Extranjera</option>
                          <option value="Tarjeta de Identidad">Tarjeta de Identidad</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                      <div class="mb-3">
                        <label for="inputNumero" class="form-label">Número de Identificación</label>
                        <input type="number" class="form-control" id="inputNumero" placeholder="Ingrese un número">
                      </div>
                    </div>
                    <div class="col">
                      <div class="mb-3">
                        <label for="telefono_apoderado" class="form-label">Teléfono</label>
                        <input type="tel" class="form-control" id="telefono_apoderado" placeholder="Ingresar teléfono">
                      </div>
                    </div>
                    <div class="col">
                      <div class="mb-3">
                        <label for="actividad_economica" class="form-label">Actividad Economica</label>
                        <input type="text" class="form-control" name="actividad_economica" id="actividad_economica" aria-describedby="helpId" placeholder="Actividad Economica..." />
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                      <div class="mb-3">
                        <label for="direccion_apoderado" class="form-label">Dirección</label>
                        <input type="text" class="form-control" name="direccion_apoderado" id="direccion_apoderado" aria-describedby="helpId" placeholder="Cra # && - 00..." />
                      </div>
                    </div>
                    <div class="col">
                      <div class="mb-3">
                        <label for="email_apoderado" class="form-label">Correo</label>
                        <input type="email" class="form-control" name="email_apoderado" id="email_apoderado" aria-describedby="emailHelpId" placeholder="abc@mail.com" />
                      </div>
                    </div>
                  </div>                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  document.getElementById('checkApoderado').addEventListener('change', function() {
    var apoderadoSection = document.getElementById('apoderadoSection');
    if (this.checked) {
      apoderadoSection.style.display = 'block';
    } else {
      apoderadoSection.style.display = 'none';
    }
  });
</script>

<!--ESTE ESTA BIEN NO TOCAR-->
<!--segundo apoderado-->
<!--ESTE ESTA BIEN NO TOCAR-->


<div class="card bg-dark custom-margintwo">
  <div class="card bg-light custom-margintwo">
    <div class="card-header">SEGUNDO INTERVINIENTE(COMPRADOR)</div>
    <div class="card-body">
      <div class="table-responsive-sm">
        <div class="container">
          <div class="row">
            <div class="col">
              <div class="mb-3">
                <label for="nombre" class="form-label">Nombres</label>
                <input type="text" class="form-control" name="nombre" id="nombre" aria-describedby="helpId" placeholder="Nombres..." />
              </div>
            </div>
            <div class="col">
              <div class="mb-3">
                <label for="apellidos_PI" class="form-label">Apellidos</label>
                <input type="text" class="form-control" name="apellidos_PI" id="apellidos_PI" aria-describedby="helpId" placeholder="Apellidos..." />
              </div>
            </div>
            <div class="col">
              <div class="mb-3">
                <label for="identificacion_PI" class="form-label">Tipo Identificación</label>
                <select class="form-select form-select-lg" name="" id="">
                  <option selected></option>
                  <option value="">CC</option>
                  <option value="">Nit</option>
                  <option value="">Cedula Extranjera</option>
                  <option value="">Tarjeta de Identidad</option>
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="mb-3">
                <label for="inputNumero" class="form-label">Número de Identificación</label>
                <input type="number" class="form-control" id="inputNumero" placeholder="Ingrese un número">
              </div>
            </div>
            <div class="col">
              <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="tel" class="form-control" id="telefono" placeholder="Ingresar teléfono">
              </div>
            </div>
            <div class="col">
              <div class="mb-3">
                <label for="actividad_economica" class="form-label">Actividad Economica</label>
                <input type="text" class="form-control" name="actividad_economica" id="actividad_economica" aria-describedby="helpId" placeholder="Actividad Economica..." />
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="mb-3">
                <label for="direccion" class="form-label">Dirección</label>
                <input type="text" class="form-control" name="direccion" id="direccion" aria-describedby="helpId" placeholder="Cra # && - 00..." />
              </div>
            </div>
            <div class="col">
              <div class="mb-3">
                <label for="email" class="form-label">Correo</label>
                <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelpId" placeholder="abc@mail.com" />
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="mb-3">
                <div class="form-check ">
                  <input class="form-check-input" type="checkbox" id="checkApoderado1" />
                  <label class="form-check-label" for="checkApoderado1"> Tiene Apoderado </label>
                </div>
              </div>
            </div>
          </div>
          <div id="apoderadoSection1" class="card bg-light custom-margintwo" style="display: none;">
            <div class="card-header">APODERADO - SEGUNDO INTERVINIENTE(COMPRADOR)</div>
            <div class="card-body">
              <div class="table-responsive-sm">
                <div class="container">
                  <div class="row">
                    <div class="col">
                      <div class="mb-3">
                        <label for="nombre_apoderado1" class="form-label">Nombres</label>
                        <input type="text" class="form-control" name="nombre_apoderado1" id="nombre_apoderado1" aria-describedby="helpId" placeholder="Nombres..." />
                      </div>
                    </div>
                    <div class="col">
                      <div class="mb-3">
                        <label for="apellidos_apoderado1" class="form-label">Apellidos</label>
                        <input type="text" class="form-control" name="apellidos_apoderado1" id="apellidos_apoderado1" aria-describedby="helpId" placeholder="Apellidos..." />
                      </div>
                    </div>
                    <div class="col">
                      <div class="mb-3">
                        <label for="identificacion_apoderado1" class="form-label">Tipo Identificación</label>
                        <select class="form-select form-select-lg" name="identificacion_apoderado1" id="identificacion_apoderado1">
                          <option selected></option>
                          <option value="CC">CC</option>
                          <option value="Nit">Nit</option>
                          <option value="Cedula Extranjera">Cedula Extranjera</option>
                          <option value="Tarjeta de Identidad">Tarjeta de Identidad</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                      <div class="mb-3">
                        <label for="inputNumero" class="form-label">Número de Identificación</label>
                        <input type="number" class="form-control" id="inputNumero" placeholder="Ingrese un número">
                      </div>
                    </div>
                    <div class="col">
                      <div class="mb-3">
                        <label for="telefono_apoderado1" class="form-label">Teléfono</label>
                        <input type="tel" class="form-control" id="telefono_apoderado1" placeholder="Ingresar teléfono">
                      </div>
                    </div>
                    <div class="col">
                      <div class="mb-3">
                        <label for="actividad_economica" class="form-label">Actividad Economica</label>
                        <input type="text" class="form-control" name="actividad_economica" id="actividad_economica" aria-describedby="helpId" placeholder="Actividad Economica..." />
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                      <div class="mb-3">
                        <label for="direccion_apoderado1" class="form-label">Dirección</label>
                        <input type="text" class="form-control" name="direccion_apoderado1" id="direccion_apoderado1" aria-describedby="helpId" placeholder="Cra # && - 00..." />
                      </div>
                    </div>
                    <div class="col">
                      <div class="mb-3">
                        <label for="email_apoderado1" class="form-label">Correo</label>
                        <input type="email" class="form-control" name="email_apoderado1" id="email_apoderado1" aria-describedby="emailHelpId" placeholder="abc@mail.com" />
                      </div>
                    </div>
                  </div>
                  <br />
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('checkApoderado1').addEventListener('change', function() {
      var apoderadoSection1 = document.getElementById('apoderadoSection1');
      if (this.checked) {
        apoderadoSection1.style.display = 'block';
      } else {
        apoderadoSection1.style.display = 'none';
      }
    });
  });
</script>
<!--ESTE ESTA BIEN NO TOCAR-->

<!--tecer apoderado-->

<div class="card bg-dark custom-margintwo">
  <div class="card bg-light custom-margintwo">
    <div class="card-header">SEGUNDO INTERVINIENTE(COMPRADOR DOS)</div>
    <div class="card-body">
      <div class="table-responsive-sm">
        <div class="container">
          <div class="row">
            <div class="col">
              <div class="mb-3">
                <label for="nombre" class="form-label">Nombres</label>
                <input type="text" class="form-control" name="nombre" id="nombre" aria-describedby="helpId" placeholder="Nombres..." />
              </div>
            </div>
            <div class="col">
              <div class="mb-3">
                <label for="apellidos_PI" class="form-label">Apellidos</label>
                <input type="text" class="form-control" name="apellidos_PI" id="apellidos_PI" aria-describedby="helpId" placeholder="Apellidos..." />
              </div>
            </div>
            <div class="col">
              <div class="mb-3">
                <label for="identificacion_PI" class="form-label">Tipo Identificación</label>
                <select class="form-select form-select-lg" name="" id="">
                  <option selected></option>
                  <option value="">CC</option>
                  <option value="">Nit</option>
                  <option value="">Cedula Extranjera</option>
                  <option value="">Tarjeta de Identidad</option>
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="mb-3">
                <label for="inputNumero" class="form-label">Número de Identificación</label>
                <input type="number" class="form-control" id="inputNumero" placeholder="Ingrese un número">
              </div>
            </div>
            <div class="col">
              <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="tel" class="form-control" id="telefono" placeholder="Ingresar teléfono">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="mb-3">
                <label for="direccion" class="form-label">Dirección</label>
                <input type="text" class="form-control" name="direccion" id="direccion" aria-describedby="helpId" placeholder="Cra # && - 00..." />
              </div>
            </div>
            <div class="col">
              <div class="mb-3">
                <label for="email" class="form-label">Correo</label>
                <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelpId" placeholder="abc@mail.com" />
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="mb-3">
                <div class="form-check ">
                  <input class="form-check-input" type="checkbox" id="checkApoderado2" />
                  <label class="form-check-label" for="checkApoderado2"> Tiene Apoderado </label>
                </div>
              </div>
            </div>
          </div>
          <div id="apoderadoSection2" class="card bg-light custom-margintwo" style="display: none;">
            <div class="card-header">APODERADO - SEGUNDO INTERVINIENTE(COMPRADOR DOS)</div>
            <div class="card-body">
              <div class="table-responsive-sm">
                <div class="container">
                  <div class="row">
                    <div class="col">
                      <div class="mb-3">
                        <label for="nombre_apoderado" class="form-label">Nombres</label>
                        <input type="text" class="form-control" name="nombre_apoderado" id="nombre_apoderado" aria-describedby="helpId" placeholder="Nombres..." />
                      </div>
                    </div>
                    <div class="col">
                      <div class="mb-3">
                        <label for="apellidos_apoderado" class="form-label">Apellidos</label>
                        <input type="text" class="form-control" name="apellidos_apoderado" id="apellidos_apoderado" aria-describedby="helpId" placeholder="Apellidos..." />
                      </div>
                    </div>
                    <div class="col">
                      <div class="mb-3">
                        <label for="identificacion_apoderado" class="form-label">Tipo Identificación</label>
                        <select class="form-select form-select-lg" name="identificacion_apoderado" id="identificacion_apoderado">
                          <option selected></option>
                          <option value="CC">CC</option>
                          <option value="Nit">Nit</option>
                          <option value="Cedula Extranjera">Cedula Extranjera</option>
                          <option value="Tarjeta de Identidad">Tarjeta de Identidad</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                      <div class="mb-3">
                        <label for="inputNumero" class="form-label">Número de Identificación</label>
                        <input type="number" class="form-control" id="inputNumero" placeholder="Ingrese un número">
                      </div>
                    </div>
                    <div class="col">
                      <div class="mb-3">
                        <label for="telefono_apoderado" class="form-label">Teléfono</label>
                        <input type="tel" class="form-control" id="telefono_apoderado" placeholder="Ingresar teléfono">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                      <div class="mb-3">
                        <label for="direccion_apoderado" class="form-label">Dirección</label>
                        <input type="text" class="form-control" name="direccion_apoderado" id="direccion_apoderado" aria-describedby="helpId" placeholder="Cra # && - 00..." />
                      </div>
                    </div>
                    <div class="col">
                      <div class="mb-3">
                        <label for="email_apoderado" class="form-label">Correo</label>
                        <input type="email" class="form-control" name="email_apoderado" id="email_apoderado" aria-describedby="emailHelpId" placeholder="abc@mail.com" />
                      </div>
                    </div>
                  </div>                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  document.getElementById('checkApoderado2').addEventListener('change', function() {
    var apoderadoSection2 = document.getElementById('apoderadoSection2');
    if (this.checked) {
      apoderadoSection2.style.display = 'block';
    } else {
      apoderadoSection2.style.display = 'none';
    }
  });
</script>

<!--ESTE ESTA BIEN NO TOCAR-->
<!--TERCER INTERVINIENTE-->

<div class="card bg-dark custom-margintwo">
  <div class="card bg-light custom-margintwo">
    <div class="card-header">TERCER INTERVINIENTE(ACREEDOR EN CASO DE TENERLO)</div>
    <div class="card-body">
      <div class="table-responsive-sm">
        <div class="container">
          <div class="row">
            <div class="col">
              <div class="mb-3">
                <label for="nombre" class="form-label">Nombres</label>
                <input type="text" class="form-control" name="nombre" id="nombre" aria-describedby="helpId" placeholder="Nombres..." />
              </div>
            </div>
            <div class="col">
              <div class="mb-3">
                <label for="apellidos_PI" class="form-label">Apellidos</label>
                <input type="text" class="form-control" name="apellidos_PI" id="apellidos_PI" aria-describedby="helpId" placeholder="Apellidos..." />
              </div>
            </div>
            <div class="col">
              <div class="mb-3">
                <label for="identificacion_PI" class="form-label">Tipo Identificación</label>
                <select class="form-select form-select-lg" name="" id="">
                  <option selected></option>
                  <option value="">CC</option>
                  <option value="">Nit</option>
                  <option value="">Cedula Extranjera</option>
                  <option value="">Tarjeta de Identidad</option>
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="mb-3">
                <label for="inputNumero" class="form-label">Número de Identificación</label>
                <input type="number" class="form-control" id="inputNumero" placeholder="Ingrese un número">
              </div>
            </div>
            <div class="col">
              <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="tel" class="form-control" id="telefono" placeholder="Ingresar teléfono">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="mb-3">
                <label for="direccion" class="form-label">Dirección</label>
                <input type="text" class="form-control" name="direccion" id="direccion" aria-describedby="helpId" placeholder="Cra # && - 00..." />
              </div>
            </div>
            <div class="col">
              <div class="mb-3">
                <label for="email" class="form-label">Correo</label>
                <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelpId" placeholder="abc@mail.com" />
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="mb-3">
                <div class="form-check ">
                  <input class="form-check-input" type="checkbox" id="checkApoderado3" />
                  <label class="form-check-label" for="checkApoderado3"> Tiene Apoderado </label>
                </div>
              </div>
            </div>
          </div>
          <div id="apoderadoSection3" class="card bg-light custom-margintwo" style="display: none;">
            <div class="card-header">APODERADO - TERCER INTERVINIENTE</div>
            <div class="card-body">
              <div class="table-responsive-sm">
                <div class="container">
                  <div class="row">
                    <div class="col">
                      <div class="mb-3">
                        <label for="nombre_apoderado" class="form-label">Nombres</label>
                        <input type="text" class="form-control" name="nombre_apoderado" id="nombre_apoderado" aria-describedby="helpId" placeholder="Nombres..." />
                      </div>
                    </div>
                    <div class="col">
                      <div class="mb-3">
                        <label for="apellidos_apoderado" class="form-label">Apellidos</label>
                        <input type="text" class="form-control" name="apellidos_apoderado" id="apellidos_apoderado" aria-describedby="helpId" placeholder="Apellidos..." />
                      </div>
                    </div>
                    <div class="col">
                      <div class="mb-3">
                        <label for="identificacion_apoderado" class="form-label">Tipo Identificación</label>
                        <select class="form-select form-select-lg" name="identificacion_apoderado" id="identificacion_apoderado">
                          <option selected></option>
                          <option value="CC">CC</option>
                          <option value="Nit">Nit</option>
                          <option value="Cedula Extranjera">Cedula Extranjera</option>
                          <option value="Tarjeta de Identidad">Tarjeta de Identidad</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                      <div class="mb-3">
                        <label for="inputNumero" class="form-label">Número de Identificación</label>
                        <input type="number" class="form-control" id="inputNumero" placeholder="Ingrese un número">
                      </div>
                    </div>
                    <div class="col">
                      <div class="mb-3">
                        <label for="telefono_apoderado" class="form-label">Teléfono</label>
                        <input type="tel" class="form-control" id="telefono_apoderado" placeholder="Ingresar teléfono">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                      <div class="mb-3">
                        <label for="direccion_apoderado" class="form-label">Dirección</label>
                        <input type="text" class="form-control" name="direccion_apoderado" id="direccion_apoderado" aria-describedby="helpId" placeholder="Cra # && - 00..." />
                      </div>
                    </div>
                    <div class="col">
                      <div class="mb-3">
                        <label for="email_apoderado" class="form-label">Correo</label>
                        <input type="email" class="form-control" name="email_apoderado" id="email_apoderado" aria-describedby="emailHelpId" placeholder="abc@mail.com" />
                      </div>
                    </div>
                  </div>                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  document.getElementById('checkApoderado3').addEventListener('change', function() {
    var apoderadoSection3 = document.getElementById('apoderadoSection3');
    if (this.checked) {
      apoderadoSection3.style.display = 'block';
    } else {
      apoderadoSection3.style.display = 'none';
    }
  });
</script>



<div class="card bg-dark custom-margin">
  <div class="card bg-light">
    <div class="card-header">DATOS FINALES</div>
    <div class="card-body">
      <div class="table-responsive-sm">
        <div class="container">
          <div class="row">
            <div class="col">
              <div class="mb-3">
                <div class="mb-3">
                  <label for="" class="form-label">Observaciones</label>
                  <textarea class="form-control" name="" id="" rows="3"></textarea>
                </div>
              </div>
            </div>
          </div>
          <br />
          <div class="row">
            <div class="col">
              <button type="button" class="btn btn-primary btn-lg">Radicar</button>
              <button type="button" class="btn btn-primary btn-lg">Guardar como borrador</button>
              <a href="../../../secciones/constructora/index.php" class="btn btn-primary btn-lg">Atrás</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0/js/bootstrap.bundle.min.js"></script>
</br>
</br>
<style>
  .custom-margin {
    margin-top: 15px;
    margin-bottom: 0px;
  }

  .custom-margintwo {
    margin-top: 2px;
    margin-bottom: 0px;
  }

  .form-check-input {
    width: 20px;
    height: 20px;
    background-color: white;
    border: 2px solid #007bff;
    /* Borde azul */
  }

  .form-check-input:checked {
    background-color: #007bff;
    /* Fondo azul al estar marcado */
    border-color: #007bff;
    /* Borde azul al estar marcado */
  }

  .form-check-label {
    color: black;
    /* Color de texto negro */
    font-weight: bold;
  }
</style>

<?php include('../../../templates/footerconstructora.php') ?>