<?php
require_once '../../../peticiones/verificar_sesion.php';



?>
<?php include('../../../templates/headeradmin.php') ?>

<title>informes notaria</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>





<div class="container my-4">
    <h2 class="text-center">Gráfico por Proyecto o Radicado</h2>
    </br>
    </br>
    <!-- Formulario de Búsqueda -->
   <!-- Formulario de Búsqueda -->
<form id="searchForm" class="row g-3" method="POST" action="../../../peticiones/graficas/descargar_radicacion.php">
    <div class="col-md-3">
        <label for="startDate" class="form-label">Fecha Inicio</label>
        <input type="date" class="form-control" id="startDate" name="startDate" required>
    </div>
    <div class="col-md-3">
        <label for="endDate" class="form-label">Fecha Final</label>
        <input type="date" class="form-control" id="endDate" name="endDate" required>
    </div>
    <div class="col-md-3">
        <!-- Puedes agregar más filtros o dejarlo vacío -->
    </div>
    <div class="col-12">
        <button type="button" class="btn btn-primary" onclick="window.history.back();">Atrás</button>
        <button type="submit" class="btn btn-outline-primary">Radicación</button>
    </div>

   
    
    <!-- Título y Botones de Descarga -->
    <div class="row justify-content-center mt-4">
        <div class="col-12 text-center">
            <h3>Descarga el informe consultado</h3>
            <p>Para poder descargar el informe debe agregar un rango de fecha y proyecto</p>
        </div>
        <div class="col-12 text-center">
            <div class="btn-group" role="group" aria-label="Botones de descarga">
                <button type="submit" class="btn btn-outline-primary" name="action" value="radicacion">Radicación</button>
                <button type="submit" class="btn btn-outline-primary" name="action" value="digitacion">Digitación</button>
                <button type="submit" class="btn btn-outline-primary" name="action" value="facturacion">Facturación</button>
                <button type="submit" class="btn btn-outline-primary" name="action" value="informe4">Informe 4</button>
            </div>
        </div>
    </div>
</div>
</form>




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>





<?php include('../../../templates/footeradmin.php'); ?>