
<?php
require_once '../../../peticiones/verificar_sesion.php';
?>
<?php include('../../../templates/headeradmin.php') 
?>
<br />
<form action="http://localhost/BotPlussFB/peticiones/radicacioncontroller.php" method="post">
  <div class="card bg-dark custom-margin">
  <div class="card bg-light custom-margintwo">
    <div class="card-header">RADICACIÓN EN LÍNEA</div>
    <div class="card-body">
      <div class="table-responsive-sm">
        <div class="container">
          <div class="row">
            <div class="col">
              <label for="num_radicado" class="form-label">Número Radicado</label>
              <input type="text" class="form-control" id="num_radicado" name="num_radicado" placeholder="Ingrese un número">
            </div>
            <div class="col">
              <div class="mb-3">
                <label for="acto_notarial" class="form-label">Acto notarial</label>
                <select class="form-select" id="acto_notarial" name="acto_notarial">
                  <option selected>Seleccione...</option>
                  <option value="Venta">Venta</option>
                  <option value="Venta con Hipoteca">Venta con Hipoteca</option>
                  <option value="Hipoteca">Hipoteca</option>
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
                    <input type="text" class="form-control" name="matriculas[]" placeholder="Ingresar matrícula">
                    <button class="btn btn-outline-secondary" type="button" id="add-matricula">Agregar</button>
                  </div>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="mb-3">
                <label for="proyecto" class="form-label">Proyecto</label>
                <select class="form-select" id="proyecto" name="proyecto">
                  <option selected>Seleccione...</option>
                  <option value="casa de la loma">casa de la loma</option>
                  <option value="loma de las casas">loma de las casas</option>
                  <option value="las casas en la loma">las casas en la loma</option>
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

    // Agregar evento para eliminar el campo de matrícula
    inputGroup.querySelector('.remove-matricula').addEventListener('click', function() {
      container.removeChild(inputGroup);
    });
  });
</script>
<br/>



<!--------------------------DATOS PRIMER INTERVIENIENTE------------------------->
              <div class="card bg-light custom-margintwo">
                <div class="card-header">PRIMER INTERVINIENTE (VENDEDOR - COMPARECIENTE)</div>
                <div class="card-body">
                  <div class="table-responsive-sm">
                    <div class="container">
                      <div class="row">
                        <div class="col">
                          <div class="mb-3">
                            <label for="NOMBRES_P_INTERVINIENTE" class="form-label">Nombres</label>
                            <input type="text" class="form-control" name="NOMBRES_P_INTERVINIENTE" id="NOMBRES_P_INTERVINIENTE" aria-describedby="helpId" placeholder="Nombres..." required />
                          </div>
                        </div>
                        <div class="col">
                          <div class="mb-3">
                            <label for="APELLIDOS_P_INTERVINIENTE" class="form-label">Apellidos</label>
                            <input type="text" class="form-control" name="APELLIDOS_P_INTERVINIENTE" id="APELLIDOS_P_INTERVINIENTE" aria-describedby="helpId" placeholder="Apellidos..." required />
                          </div>
                        </div>
                        <div class="col">
                          <div class="mb-3">
                            <label for="TIPO_P_INTERVINIENTE" class="form-label">Tipo Identificación</label>
                            <select class="form-select form-select-lg" name="TIPO_P_INTERVINIENTE" id="TIPO_P_INTERVINIENTE" required>
                              <option value="" selected></option>
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
                            <label for="NUM_IDENTI_P_INTERVINIENTE" class="form-label">Número de Identificación</label>
                            <input type="number" class="form-control" name="NUM_IDENTI_P_INTERVINIENTE" id="NUM_IDENTI_P_INTERVINIENTE" placeholder="Ingrese un número" required>
                          </div>
                        </div>
                        <div class="col">
                          <div class="mb-3">
                            <label for="TELEFONO_P_INTERVINIENTE" class="form-label">Teléfono</label>
                            <input type="tel" class="form-control" name="TELEFONO_P_INTERVINIENTE" id="TELEFONO_P_INTERVINIENTE" placeholder="Ingresar teléfono" required>
                          </div>
                        </div>
                        <div class="col">
                          <div class="mb-3">
                            <label for="ACTIVIDAD_ECONOMICA_P_INTERVINIENTE" class="form-label">Actividad Económica</label>
                            <input type="text" class="form-control" name="ACTIVIDAD_ECONOMICA_P_INTERVINIENTE" id="ACTIVIDAD_ECONOMICA_P_INTERVINIENTE" aria-describedby="helpId" placeholder="Actividad Económica..." required />
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <div class="mb-3">
                            <label for="DIRECCION_P_INTERVINIENTE" class="form-label">Dirección</label>
                            <input type="text" class="form-control" name="DIRECCION_P_INTERVINIENTE" id="DIRECCION_P_INTERVINIENTE" aria-describedby="helpId" placeholder="Cra # && - 00..." required />
                          </div>
                        </div>
                        <div class="col">
                          <div class="mb-3">
                            <label for="CORREO_ELECTRONICO_P_INTERVINIENTE" class="form-label">Correo</label>
                            <input type="email" class="form-control" name="CORREO_ELECTRONICO_P_INTERVINIENTE" id="CORREO_ELECTRONICO_P_INTERVINIENTE" aria-describedby="emailHelpId" placeholder="abc@mail.com" required />
                          </div>
                        </div>
                      </div>
                      <div class="row">
  <div class="col">
    <div class="mb-3">
      <div class="form-check">
        <input class="form-check-input" type="checkbox" id="HAS_APODERADO_P" name="HAS_APODERADO_P">
        <label class="form-check-label" for="HAS_APODERADO_P"> Tiene Apoderado </label>
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
              <label for="NOMBRES_P_INTERVINIENTE_APODERADO" class="form-label">Nombres</label>
              <input type="text" class="form-control" name="NOMBRES_P_INTERVINIENTE_APODERADO" id="NOMBRES_P_INTERVINIENTE_APODERADO" placeholder="Nombres...">
            </div>
          </div>
          <div class="col">
            <div class="mb-3">
              <label for="APELLIDOS_P_INTERVINIENTE_APODERADO" class="form-label">Apellidos</label>
              <input type="text" class="form-control" name="APELLIDOS_P_INTERVINIENTE_APODERADO" id="APELLIDOS_P_INTERVINIENTE_APODERADO" placeholder="Apellidos...">
            </div>
          </div>
          <div class="col">
            <div class="mb-3">
              <label for="TIPO_P_INTERVINIENTE_APODERADO" class="form-label">Tipo Identificación</label>
              <select class="form-select form-select-lg" name="TIPO_P_INTERVINIENTE_APODERADO" id="TIPO_P_INTERVINIENTE_APODERADO">
                <option selected disabled>Seleccionar...</option>
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
              <label for="NUM_IDENTI_P_INTERVINIENTE_APODERADO" class="form-label">Número de Identificación</label>
              <input type="number" class="form-control" id="NUM_IDENTI_P_INTERVINIENTE_APODERADO" name="NUM_IDENTI_P_INTERVINIENTE_APODERADO" placeholder="Ingrese un número">
            </div>
          </div>
          <div class="col">
            <div class="mb-3">
              <label for="TELEFONO_P_INTERVINIENTE_APODERADO" class="form-label">Teléfono</label>
              <input type="tel" class="form-control" id="TELEFONO_P_INTERVINIENTE_APODERADO" name="TELEFONO_P_INTERVINIENTE_APODERADO" placeholder="Ingrese teléfono">
            </div>
          </div>
          <div class="col">
            <div class="mb-3">
              <label for="ACTIVIDAD_ECONOMICA_P_INTERVINIENTE_APODERADO" class="form-label">Actividad Económica</label>
              <input type="text" class="form-control" id="ACTIVIDAD_ECONOMICA_P_INTERVINIENTE_APODERADO" name="ACTIVIDAD_ECONOMICA_P_INTERVINIENTE_APODERADO" placeholder="Actividad Económica...">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <div class="mb-3">
              <label for="DIRECCION_P_INTERVINIENTE_APODERADO" class="form-label">Dirección</label>
              <input type="text" class="form-control" id="DIRECCION_P_INTERVINIENTE_APODERADO" name="DIRECCION_P_INTERVINIENTE_APODERADO" placeholder="Dirección...">
            </div>
          </div>
          <div class="col">
            <div class="mb-3">
              <label for="CORREO_ELECTRONICO_P_INTERVINIENTE_APODERADO" class="form-label">Correo Electrónico</label>
              <input type="email" class="form-control" id="CORREO_ELECTRONICO_P_INTERVINIENTE_APODERADO" name="CORREO_ELECTRONICO_P_INTERVINIENTE_APODERADO" placeholder="Correo Electrónico...">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<script>
  document.getElementById('HAS_APODERADO_P').addEventListener('change', function() {
    var apoderadoSection = document.getElementById('apoderadoSection');
    if (this.checked) {
      apoderadoSection.style.display = 'block';
    } else {
      apoderadoSection.style.display = 'none';
    }
  });
</script>

<br/>

<!--------------------------DATOS SEGUNDO INTERVIENIENTE------------------------->
<div class="card bg-dark custom-margintwo">
  <div class="card bg-light custom-margintwo">
    <div class="card-header">SEGUNDO INTERVINIENTE(COMPRADOR)</div>
    <div class="card-body">
      <div class="table-responsive-sm">
        <div class="container">
          <div class="row">
            <div class="col">
              <div class="mb-3">
                <label for="NOMBRES_S_INTERVINIENTE" class="form-label">Nombres</label>
                <input type="text" class="form-control" name="NOMBRES_S_INTERVINIENTE" id="NOMBRES_S_INTERVINIENTE" aria-describedby="helpId" placeholder="Nombres..." />
              </div>
            </div>
            <div class="col">
              <div class="mb-3">
                <label for="APELLIDOS_S_INTERVINIENTE" class="form-label">Apellidos</label>
                <input type="text" class="form-control" name="APELLIDOS_S_INTERVINIENTE" id="apellidos_PI" aria-describedby="helpId" placeholder="Apellidos..." />
              </div>
            </div>
            <div class="col">
              <div class="mb-3">
                <label for="TIPO_S_INTERVINIENTE" class="form-label">Tipo Identificación</label>
                <select class="form-select form-select-lg" name="TIPO_S_INTERVINIENTE" id="TIPO_S_INTERVINIENTE">
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
                <label for="NUM_IDENTI_S_INTERVINIENTE" class="form-label">Número de Identificación</label>
                <input type="number" class="form-control" name="NUM_IDENTI_S_INTERVINIENTE" id="NUM_IDENTI_S_INTERVINIENTE" placeholder="Ingrese un número">
              </div>
            </div>
            <div class="col">
              <div class="mb-3">
                <label for="TELEFONO_S_INTERVINIENTE" class="form-label">Teléfono</label>
                <input type="tel" class="form-control" name="TELEFONO_S_INTERVINIENTE" id="TELEFONO_S_INTERVINIENTE" placeholder="Ingresar teléfono">
              </div>
            </div>
            <div class="col">
              <div class="mb-3">
                <label for="ACTIVIDAD_ECONOMICA_S_INTERVINIENTE" class="form-label">Actividad Economica</label>
                <input type="text" class="form-control" name="ACTIVIDAD_ECONOMICA_S_INTERVINIENTE" id="ACTIVIDAD_ECONOMICA_S_INTERVINIENTE" aria-describedby="helpId" placeholder="Actividad Economica..." />
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="mb-3">
                <label for="DIRECCION_S_INTERVINIENTE" class="form-label">Dirección</label>
                <input type="text" class="form-control" name="DIRECCION_S_INTERVINIENTE" id="DIRECCION_S_INTERVINIENTE" aria-describedby="helpId" placeholder="Cra # && - 00..." />
              </div>
            </div>
            <div class="col">
              <div class="mb-3">
                <label for="CORREO_ELECTRONICO_S_INTERVINIENTE" class="form-label">Correo</label>
                <input type="email" class="form-control" name="CORREO_ELECTRONICO_S_INTERVINIENTE" id="CORREO_ELECTRONICO_S_INTERVINIENTE" aria-describedby="emailHelpId" placeholder="abc@mail.com" />
              </div>
            </div>
          </div>
          <div class="row">
  <div class="col">
    <div class="mb-3">
      <div class="form-check">
        <input class="form-check-input" type="checkbox" id="HAS_APODERADO_S" name="HAS_APODERADO_S">
        <label class="form-check-label" for="HAS_APODERADO_P"> Tiene Apoderado </label>
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
              <label for="NOMBRES_S_INTERVINIENTE_APODERADO" class="form-label">Nombres</label>
              <input type="text" class="form-control" name="NOMBRES_S_INTERVINIENTE_APODERADO" id="NOMBRES_S_INTERVINIENTE_APODERADO" aria-describedby="helpId" placeholder="Nombres..." />
            </div>
          </div>
          <div class="col">
            <div class="mb-3">
              <label for="APELLIDOS_S_INTERVINIENTE_APODERADO" class="form-label">Apellidos</label>
              <input type="text" class="form-control" name="APELLIDOS_S_INTERVINIENTE_APODERADO" id="APELLIDOS_S_INTERVINIENTE_APODERADO" aria-describedby="helpId" placeholder="Apellidos..." />
            </div>
          </div>
          <div class="col">
            <div class="mb-3">
              <label for="TIPO_S_INTERVINIENTE_APODERADO" class="form-label">Tipo Identificación</label>
              <select class="form-select form-select-lg" name="TIPO_S_INTERVINIENTE_APODERADO" id="TIPO_S_INTERVINIENTE_APODERADO">
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
              <label for="NUM_IDENTI_S_INTERVINIENTE_APODERADO" class="form-label">Número de Identificación</label>
              <input type="number" class="form-control" name="NUM_IDENTI_S_INTERVINIENTE_APODERADO" id="NUM_IDENTI_S_INTERVINIENTE_APODERADO" placeholder="Ingrese un número">
            </div>
          </div>
          <div class="col">
            <div class="mb-3">
              <label for="TELEFONO_S_INTERVINIENTE_APODERADO" class="form-label">Teléfono</label>
              <input type="tel" class="form-control" name="TELEFONO_S_INTERVINIENTE_APODERADO"  id="TELEFONO_S_INTERVINIENTE_APODERADO" placeholder="Ingresar teléfono">
            </div>
          </div>
          <div class="col">
            <div class="mb-3">
              <label for="ACTIVIDAD_ECONOMICA_S_INTERVINIENTE_APODERADO" class="form-label">Actividad Economica</label>
              <input type="text" class="form-control" name="ACTIVIDAD_ECONOMICA_S_INTERVINIENTE_APODERADO" id="ACTIVIDAD_ECONOMICA_S_INTERVINIENTE_APODERADO" aria-describedby="helpId" placeholder="Actividad Economica..." />
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <div class="mb-3">
              <label for="DIRECCION_S_INTERVINIENTE_APODERADO" class="form-label">Dirección</label>
              <input type="text" class="form-control" name="DIRECCION_S_INTERVINIENTE_APODERADO" id="DIRECCION_S_INTERVINIENTE_APODERADO" aria-describedby="helpId" placeholder="Cra # && - 00..." />
            </div>
          </div>
                    <div class="col">
                      <div class="mb-3">
                        <label for="CORREO_ELECTRONICO_S_INTERVINIENTE_APODERADO" class="form-label">Correo</label>
                        <input type="email" class="form-control" name="CORREO_ELECTRONICO_S_INTERVINIENTE_APODERADO" id="CORREO_ELECTRONICO_S_INTERVINIENTE_APODERADO" aria-describedby="emailHelpId" placeholder="abc@mail.com" />
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
  document.getElementById('HAS_APODERADO_S').addEventListener('change', function() {
    var apoderadoSection1 = document.getElementById('apoderadoSection1');
    if (this.checked) {
      apoderadoSection1.style.display = 'block';
    } else {
      apoderadoSection1.style.display = 'none';
    }
  });
</script>




<br>
<!--------------------------DATOS SEGUNDO  INTERVIENIENTE DOS------------------------->

<div class="card bg-dark custom-margintwo">
  <div class="card bg-light custom-margintwo">
    <div class="card-header">SEGUNDO INTERVINIENTE (COMPRADOR DOS)</div>
    <div class="card-body">
      <div class="table-responsive-sm">
        <div class="container">
          <div class="row">
            <div class="col">
              <div class="mb-3">
                <label for="NOMBRES_S_INTERVINIENTE_C2" class="form-label">Nombres</label>
                <input type="text" class="form-control" name="NOMBRES_S_INTERVINIENTE_C2" id="NOMBRES_S_INTERVINIENTE_C2" aria-describedby="helpId" placeholder="Nombres..." />
              </div>
            </div>
            <div class="col">
              <div class="mb-3">
                <label for="APELLIDOS_S_INTERVINIENTE_C2" class="form-label">Apellidos</label>
                <input type="text" class="form-control" name="APELLIDOS_S_INTERVINIENTE_C2" id="APELLIDOS_S_INTERVINIENTE_C2" aria-describedby="helpId" placeholder="Apellidos..." />
              </div>
            </div>
            <div class="col">
              <div class="mb-3">
                <label for="TIPO_S_INTERVINIENTE_C2" class="form-label">Tipo Identificación</label>
                <select class="form-select form-select-lg" name="TIPO_S_INTERVINIENTE_C2" id="TIPO_S_INTERVINIENTE_C2">
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
                <label for="NUM_IDENTI_S_INTERVINIENTE_C2" class="form-label">Número de Identificación</label>
                <input type="number" class="form-control" name="NUM_IDENTI_S_INTERVINIENTE_C2" id="NUM_IDENTI_S_INTERVINIENTE_C2" placeholder="Ingrese un número">
              </div>
            </div>
            <div class="col">
              <div class="mb-3">
                <label for="TELEFONO_S_INTERVINIENTE_C2" class="form-label">Teléfono</label>
                <input type="tel" class="form-control" name="TELEFONO_S_INTERVINIENTE_C2" id="TELEFONO_S_INTERVINIENTE_C2" placeholder="Ingresar teléfono">
              </div>
            </div>
          </div>
          <div class="col">
            <div class="mb-3">
              <label for="ACTIVIDAD_ECONOMICA_S_INTERVINIENTE_C2" class="form-label">Actividad Economica</label>
              <input type="text" class="form-control" name="ACTIVIDAD_ECONOMICA_S_INTERVINIENTE_C2" id="ACTIVIDAD_ECONOMICA_S_INTERVINIENTE_C2" aria-describedby="helpId" placeholder="Actividad Economica..." />
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="mb-3">
                <label for="DIRECCION_S_INTERVINIENTE_C2" class="form-label">Dirección</label>
                <input type="text" class="form-control" name="DIRECCION_S_INTERVINIENTE_C2" id="DIRECCION_S_INTERVINIENTE_C2" aria-describedby="helpId" placeholder="Cra # && - 00..." />
              </div>
            </div>
            <div class="col">
              <div class="mb-3">
                <label for="CORREO_ELECTRONICO_S_INTERVINIENTE_C2" class="form-label">Correo</label>
                <input type="email" class="form-control" name="CORREO_ELECTRONICO_S_INTERVINIENTE_C2" id="CORREO_ELECTRONICO_S_INTERVINIENTE_C2" aria-describedby="emailHelpId" placeholder="abc@mail.com" />
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="mb-3">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="HAS_APODERADO_C2" id="HAS_APODERADO_C2" />
                  <label class="form-check-label" for="HAS_APODERADO_C2"> Tiene Apoderado </label>
                </div>
              </div>
            </div>
          </div>
          <div id="apoderadoSection2" class="card bg-light custom-margintwo" style="display: none;">
            <div class="card-header">APODERADO - SEGUNDO INTERVINIENTE (COMPRADOR DOS)</div>
            <div class="card-body">
              <div class="table-responsive-sm">
                <div class="container">
                  <div class="row">
                    <div class="col">
                      <div class="mb-3">
                        <label for="NOMBRES_S_INTERVINIENTE_APODERADO_C2" class="form-label">Nombres</label>
                        <input type="text" class="form-control" name="NOMBRES_S_INTERVINIENTE_APODERADO_C2" id="NOMBRES_S_INTERVINIENTE_APODERADO_C2" aria-describedby="helpId" placeholder="Nombres..." />
                      </div>
                    </div>
                    <div class="col">
                      <div class="mb-3">
                        <label for="APELLIDOS_S_INTERVINIENTE_APODERADO_C2" class="form-label">Apellidos</label>
                        <input type="text" class="form-control" name="APELLIDOS_S_INTERVINIENTE_APODERADO_C2" id="APELLIDOS_S_INTERVINIENTE_APODERADO_C2" aria-describedby="helpId" placeholder="Apellidos..." />
                      </div>
                    </div>
                    <div class="col">
                      <div class="mb-3">
                        <label for="TIPO_S_INTERVINIENTE_APODERADO_C2" class="form-label">Tipo Identificación</label>
                        <select class="form-select form-select-lg" name="TIPO_S_INTERVINIENTE_APODERADO_C2" id="TIPO_S_INTERVINIENTE_APODERADO_C2">
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
                        <label for="NUM_IDENTI_S_INTERVINIENTE_APODERADO_C2" class="form-label">Número de Identificación</label>
                        <input type="number" class="form-control" name="NUM_IDENTI_S_INTERVINIENTE_APODERADO_C2" id="NUM_IDENTI_S_INTERVINIENTE_APODERADO_C2" placeholder="Ingrese un número">
                      </div>
                    </div>
                    <div class="col">
                      <div class="mb-3">
                        <label for="TELEFONO_S_INTERVINIENTE_APODERADO_C2" class="form-label">Teléfono</label>
                        <input type="tel" class="form-control" name="TELEFONO_S_INTERVINIENTE_APODERADO_C2" id="TELEFONO_S_INTERVINIENTE_APODERADO_C2" placeholder="Ingresar teléfono">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                      <div class="mb-3">
                        <label for="DIRECCION_S_INTERVINIENTE_APODERADO_C2" class="form-label">Dirección</label>
                        <input type="text" class="form-control" name="DIRECCION_S_INTERVINIENTE_APODERADO_C2" id="DIRECCION_S_INTERVINIENTE_APODERADO_C2" aria-describedby="helpId" placeholder="Cra # && - 00..." />
                      </div>
                    </div>
                    <div class="col">
                      <div class="mb-3">
                        <label for="CORREO_ELECTRONICO_S_INTERVINIENTE_APODERADO_C2" class="form-label">Correo</label>
                        <input type="email" class="form-control" name="CORREO_ELECTRONICO_S_INTERVINIENTE_APODERADO_C2" id="CORREO_ELECTRONICO_S_INTERVINIENTE_APODERADO_C2" aria-describedby="emailHelpId" placeholder="abc@mail.com" />
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
  document.getElementById('HAS_APODERADO_C2').addEventListener('change', function() {
    var apoderadoSection2 = document.getElementById('apoderadoSection2');
    if (this.checked) {
      apoderadoSection2.style.display = 'block';
    } else {
      apoderadoSection2.style.display = 'none';
    }
  });
</script>
<br/>
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
                <label for="NOMBRES_T_INTERVINIENTE" class="form-label">Nombres</label>
                <input type="text" class="form-control" name="NOMBRES_T_INTERVINIENTE" id="NOMBRES_T_INTERVINIENTE" aria-describedby="helpId" placeholder="Nombres..." />
              </div>
            </div>
            <div class="col">
              <div class="mb-3">
                <label for="APELLIDOS_T_INTERVINIENTE" class="form-label">Apellidos</label>
                <input type="text" class="form-control" name="APELLIDOS_T_INTERVINIENTE" id="APELLIDOS_T_INTERVINIENTE" aria-describedby="helpId" placeholder="Apellidos..." />
              </div>
            </div>
            <div class="col">
              <div class="mb-3">
                <label for="TIPO_T_INTERVINIENTE" class="form-label">Tipo Identificación</label>
                <select class="form-select form-select-lg" name="TIPO_T_INTERVINIENTE" id="TIPO_T_INTERVINIENTE">
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
                <label for="NUM_IDENTI_T_INTERVINIENTE" class="form-label">Número de Identificación</label>
                <input type="number" class="form-control" name="NUM_IDENTI_T_INTERVINIENTE" id="NUM_IDENTI_T_INTERVINIENTE" placeholder="Ingrese un número">
              </div>
            </div>
            <div class="col">
              <div class="mb-3">
                <label for="TELEFONO_T_INTERVINIENTE" class="form-label">Teléfono</label>
                <input type="tel" class="form-control" name="TELEFONO_T_INTERVINIENTE" id="TELEFONO_T_INTERVINIENTE" placeholder="Ingresar teléfono">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="mb-3">
                <label for="DIRECCION_T_INTERVINIENTE" class="form-label">Dirección</label>
                <input type="text" class="form-control" name="DIRECCION_T_INTERVINIENTE" id="DIRECCION_T_INTERVINIENTE" aria-describedby="helpId" placeholder="Cra # && - 00..." />
              </div>
            </div>
            <div class="col">
              <div class="mb-3">
                <label for="CORREO_ELECTRONICO_T_INTERVINIENTE" class="form-label">Correo</label>
                <input type="email" class="form-control" name="CORREO_ELECTRONICO_T_INTERVINIENTE" id="CORREO_ELECTRONICO_T_INTERVINIENTE" aria-describedby="emailHelpId" placeholder="abc@mail.com" />
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="mb-3">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="HAS_APODERADO_T" id="HAS_APODERADO_T" />
                  <label class="form-check-label" for="HAS_APODERADO_T"> Tiene Apoderado </label>
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
                        <label for="NOMBRES_T_INTERVINIENTE_APODERADO" class="form-label">Nombres</label>
                        <input type="text" class="form-control" name="NOMBRES_T_INTERVINIENTE_APODERADO" id="NOMBRES_T_INTERVINIENTE_APODERADO" aria-describedby="helpId" placeholder="Nombres..." />
                      </div>
                    </div>
                    <div class="col">
                      <div class="mb-3">
                        <label for="APELLIDOS_T_INTERVINIENTE_APODERADO" class="form-label">Apellidos</label>
                        <input type="text" class="form-control" name="APELLIDOS_T_INTERVINIENTE_APODERADO" id="APELLIDOS_T_INTERVINIENTE_APODERADO" aria-describedby="helpId" placeholder="Apellidos..." />
                      </div>
                    </div>
                    <div class="col">
                      <div class="mb-3">
                        <label for="TIPO_T_INTERVINIENTE_APODERADO" class="form-label">Tipo Identificación</label>
                        <select class="form-select form-select-lg" name="TIPO_T_INTERVINIENTE_APODERADO" id="TIPO_T_INTERVINIENTE_APODERADO">
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
                        <label for="NUM_IDENTI_T_INTERVINIENTE_APODERADO" class="form-label">Número de Identificación</label>
                        <input type="number" class="form-control" name="NUM_IDENTI_T_INTERVINIENTE_APODERADO" id="NUM_IDENTI_T_INTERVINIENTE_APODERADO" placeholder="Ingrese un número">
                      </div>
                    </div>
                    <div class="col">
                      <div class="mb-3">
                        <label for="TELEFONO_T_INTERVINIENTE_APODERADO" class="form-label">Teléfono</label>
                        <input type="tel" class="form-control" name="TELEFONO_T_INTERVINIENTE_APODERADO" id="TELEFONO_T_INTERVINIENTE_APODERADO" placeholder="Ingresar teléfono">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                      <div class="mb-3">
                        <label for="DIRECCION_T_INTERVINIENTE_APODERADO" class="form-label">Dirección</label>
                        <input type="text" class="form-control" name="DIRECCION_T_INTERVINIENTE_APODERADO" id="DIRECCION_T_INTERVINIENTE_APODERADO" aria-describedby="helpId" placeholder="Cra # && - 00..." />
                      </div>
                    </div>
                    <div class="col">
                      <div class="mb-3">
                        <label for="CORREO_ELECTRONICO_T_INTERVINIENTE_APODERADO" class="form-label">Correo</label>
                        <input type="email" class="form-control" name="CORREO_ELECTRONICO_T_INTERVINIENTE_APODERADO" id="CORREO_ELECTRONICO_T_INTERVINIENTE_APODERADO" aria-describedby="emailHelpId" placeholder="abc@mail.com" />
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
  document.getElementById('HAS_APODERADO_T').addEventListener('change', function() {
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
      <form action="upload.php" method="post" enctype="multipart/form-data">
        <div class="table-responsive-sm">
          <div class="container">
            <div class="row">
              <div class="col">
                <div class="mb-3">
                  <label for="OBSERVACIONES" class="form-label">Observaciones</label>
                  <textarea class="form-control" name="OBSERVACIONES" id="OBSERVACIONES" rows="3"></textarea>
                </div>
              </div>
            </div>
            <br />
            <div class="row">
              <div class="col">
                <div class="mb-3">
                  <label for="documentos" class="form-label">Cargar documentos</label>
                  <input type="file" class="form-control" name="documentos[]" id="documentos" multiple>
                </div>
              </div>
            </div>
            <br />
            <div class="row">
              <div class="col">
                <button type="submit" class="btn btn-primary btn-lg">Radicar</button>
                <button type="button" class="btn btn-primary btn-lg">Guardar como borrador</button>
                <a href="../../../secciones/admin/index.php" class="btn btn-primary btn-lg">Atrás</a>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>



<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0/js/bootstrap.bundle.min.js"></script>
</form>
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

<?php include('../../../templates/footeradmin.php') ?>