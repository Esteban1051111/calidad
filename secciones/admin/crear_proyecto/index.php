<?php
// Definir una constante para la ruta raíz del proyecto
define('ROOT_PATH', __DIR__ . '/../../../');

// Incluir el archivo de verificación de sesión
require_once ROOT_PATH . 'peticiones/verificar_sesion.php';

require_once ROOT_PATH . 'peticiones/actos_notariales.php';
$actosNotariales = obtenerActosNotariales();

if (empty($actosNotariales)) {
    echo 'No se obtuvieron actos notariales.';
} else {
    //echo 'Actos notariales obtenidos correctamente.';
    // var_dump($actosNotariales); // Para verificar el contenido obtenido
}

$nuevoRadicadoNumero = '';
if (isset($_GET['radicado'])) {
    $nuevoRadicadoNumero = htmlspecialchars($_GET['radicado']);
}

?>

<?php include('../../../templates/headeradmin.php') ?>
<br />
<br />
<a href="../../../secciones/admin/proyectos_constructora/index.php" class="btn btn-primary btn-lg">Atrás</a>
<br>
<br>

<!-- Pestañas para separar los formularios -->
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active" id="proyecto-tab" data-bs-toggle="tab" data-bs-target="#proyecto" type="button" role="tab" aria-controls="proyecto" aria-selected="true">Crear Proyecto</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="excel-tab" data-bs-toggle="tab" data-bs-target="#excel" type="button" role="tab" aria-controls="excel" aria-selected="false">Cargar desde Excel</button>
  </li>
</ul>

<div class="tab-content" id="myTabContent">
  
  <!-- Pestaña de creación de proyecto -->
  <div class="tab-pane fade show active" id="proyecto" role="tabpanel" aria-labelledby="proyecto-tab">
    <form action="../../../peticiones/crear_proyecto.php" method="post" enctype="multipart/form-data">
      <div class="card bg-dark custom-margin">
        <div class="card bg-light custom-margintwo">
          <div class="card-header">CREACIÓN PROYECTO</div>
          <div class="card-body">
            <div class="table-responsive-sm">
              <div class="container">
                <div class="row">
                  <div class="col">
                    <div class="mb-3">
                      <label for="nombre_proyecto_constructora" class="form-label">Nombre del proyecto</label>
                      <input type="text" class="form-control" name="nombre_proyecto_constructora" id="nombre_proyecto_constructora" placeholder="Ingresar Nombre Nuevo Proyecto..." required />
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                    <div class="mb-3">
                      <label for="descripcion_nombre_proyecto" class="form-label">Descripción</label>
                      <input type="text" class="form-control" name="descripcion_nombre_proyecto" id="descripcion_nombre_proyecto" placeholder="Ingresar Descripción del Proyecto..." />
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <br>
      <button type="submit" class="btn btn-primary">Guardar Proyecto</button>
    </form>
  </div>

  
  
  
  <!-- Pestaña de carga masiva desde Excel -->
  <div class="tab-pane fade" id="excel" role="tabpanel" aria-labelledby="excel-tab">
    <div class="card bg-light custom-margintwo">
      <form action="../../../peticiones/procesar_excel_proyectos.php" method="post" enctype="multipart/form-data">
        <div class="mb-3">
          <label for="file" class="form-label">Cargar Archivo Excel</label>
          <br>
          <input type="file" name="file" id="file" class="form-control" accept=".xls,.xlsx" required>
        </div>

        <div class="mb-3">
          <label for="proyecto_id_excel" class="form-label">Seleccionar Proyecto</label>
          <select name="proyecto_id" id="proyecto_id_excel" class="form-select" required>
            <option value="">Cargando proyectos...</option>
          </select>
        </div>

        <button type="submit" class="btn btn-primary">Subir y Procesar</button>
      </form>
      <!-- Contenedor para el mensaje de éxito/error -->
    <div id="message" style="display: none;" class="alert alert-success"></div>

      <!-- Script para cargar los proyectos desde el archivo obtener_proyectos.php -->
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <script>
        $(document).ready(function() {
          $.ajax({
              url: '../../../peticiones/obtener_proyectos.php',
              method: 'GET',
              success: function(response) {
                  $('#proyecto_id_excel').html(response);
              },
              error: function() {
                  alert('Error al cargar los proyectos');
              }
          });
        });
      </script>
    </div>
  </div>
</div>
                        
<br>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>


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