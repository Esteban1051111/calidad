<?php $url_base = "" ?>
<?php include('../../../templates/headeradmin.php'); ?>
<?php include('../../../peticiones/proyectouno.php'); ?>
<?php include('../../../peticiones/conscutivo_radicado_unidades.php'); ?>

<!-- Definir el número de registros por página -->
<?php
$registrosPorPagina = 7;

// Obtener el término de búsqueda desde la URL
$terminoBusqueda = isset($_GET['buscar']) ? $_GET['buscar'] : '';

// Obtener las unidades del proyecto 1 (modificado para que busque tanto por unidad como por folio matricula)
$unidades = obtenerUnidadesProyecto1($terminoBusqueda);

// Calcular la paginación
$totalUnidades = count($unidades);
$paginaActual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
$indiceInicio = ($paginaActual - 1) * $registrosPorPagina;
$unidadesPaginadas = array_slice($unidades, $indiceInicio, $registrosPorPagina);

// Calcular el número total de páginas
$totalPaginas = ceil($totalUnidades / $registrosPorPagina);
?>

<br />
<div class="card bg-dark custom-margin">
    <div class="card">
        <div class="card-header">LISTAR UNIDADES</div>
        <div class="card-body">
            <!-- Campo de búsqueda y botón de búsqueda -->
            <form method="GET" action="index.php">
                <div class="mb-3 d-flex align-items-center">
                    <input type="text" name="buscar" class="form-control me-2" id="buscarUnidad" placeholder="Buscar Unidad o Folio Matricula..." value="<?php echo htmlspecialchars($terminoBusqueda); ?>">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                </div>
            </form>
            <div class="table-responsive">
                <form method="POST" action="../../../peticiones/cargar_documentos_proyectouno.php" enctype="multipart/form-data">
                    <table class="table table-bordered table-striped table-hover">
                        <!-- Encabezados de la tabla -->
                        <thead>
                            <tr>
                                <th scope="col">Nombre Proyecto</th>
                                <th scope="col">Unidad</th>
                                <th scope="col">Folio Matricula</th>
                                <th scope="col">Subir Archivo</th>
                                <th scope="col">Radicado</th>
                                <th scope="col">Guardar</th>
                            </tr>
                        </thead>
                        <!-- Cuerpo de la tabla -->
                        <tbody>
                            <?php if (count($unidadesPaginadas) > 0) : ?>
                                <?php foreach ($unidadesPaginadas as $unidad) : ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($unidad['NOMBRE']); ?></td>
                                        <td><?php echo htmlspecialchars($unidad['unidad']); ?></td>
                                        <td><?php echo htmlspecialchars($unidad['folio_matricula']); ?></td>

                                        <!-- Campo para subir archivo para esta fila -->
                                        <td>
                                            <input type="file" id="files" class="form-control" name="files[<?php echo $unidad['folio_matricula']; ?>]">
                                        </td>
                                        

                                        <!-- Campo de radicado como select -->
                                        <td>
                                            <?php if ($_SESSION['tipo_usuario'] === 'constructora') : ?>
                                                <input type="number" class="form-control" name="radicado_<?php echo $unidad['unidad']; ?>" placeholder="No puedes ingresar radicado" disabled>
                                            <?php else : ?>
                                                <select class="form-control" name="radicado_<?php echo $unidad['unidad']; ?>">
                                                    <option value="">Seleccionar Radicado</option>
                                                    <?php foreach ($radicadosDisponibles as $radicado) : ?>
                                                        <option value="<?php echo $radicado['numero_radicado']; ?>">
                                                            <?php echo $radicado['numero_radicado']; ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            <?php endif; ?>
                                        </td>

                                        <!-- Enviar ID de la unidad (folio matricula) oculto -->
                                        <input type="hidden" name="folio_matricula" value="<?php echo htmlspecialchars($unidad['folio_matricula']); ?>">

                                        <!-- Botón para guardar los datos de esta fila -->
                                        <td>
                                            <button type="submit" class="btn btn-success" name="guardar_<?php echo $unidad['unidad']; ?>">Guardar</button>
                                        </td>

                                        
                                        <!-- Botón para guardar los datos de esta fila -->
                                        <td>
                                            <?php if ($_SESSION['tipo_usuario'] !== 'constructora') : ?>
                                                <!-- Mostrar el botón solo si el tipo de usuario no es Constructora -->
                                                <!--<button type="submit" class="btn btn-success" name="guardar_radicado_<?php echo $unidad['unidad']; ?>">Numerar</button>-->
                                                <button type="submit" class="btn btn-success" name="guardar_<?php echo $unidad['unidad']; ?>">Numerar</button>
                                            <?php endif; ?>
                                        </td>

                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="3" class="text-center">No se encontraron unidades.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </form>
            </div>




            <!-- Paginación -->
            <nav aria-label="Paginación">
                <ul class="pagination justify-content-center">
                    <?php if ($paginaActual > 1): ?>
                        <li class="page-item">
                            <a class="page-link" href="index.php?pagina=<?php echo $paginaActual - 1; ?>&buscar=<?php echo htmlspecialchars($terminoBusqueda); ?>" aria-label="Anterior">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
                        <li class="page-item <?php if ($i == $paginaActual) echo 'active'; ?>">
                            <a class="page-link" href="index.php?pagina=<?php echo $i; ?>&buscar=<?php echo htmlspecialchars($terminoBusqueda); ?>">
                                <?php echo $i; ?>
                            </a>
                        </li>
                    <?php endfor; ?>

                    <?php if ($paginaActual < $totalPaginas): ?>
                        <li class="page-item">
                            <a class="page-link" href="index.php?pagina=<?php echo $paginaActual + 1; ?>&buscar=<?php echo htmlspecialchars($terminoBusqueda); ?>" aria-label="Siguiente">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </div>
</div>



<br />
<a href="http://localhost/BotPlussFB/secciones/admin/opciones_radicacion" class="btn btn-primary btn-lg mb-4">Atrás</a>

<?php include('../../../templates/footeradmin.php'); ?>

<!-- Estilos personalizados -->
<style>
    .btn-primary {
        background-color: transparent;
        border: 2px solid black;
        color: black;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #ECECEC;
    }

    .btn-primary:active {
        background-color: #ECECEC;
    }

    .custom-margin {
        margin-top: 70px;
        margin-bottom: 70px;
    }

    .pagination .page-link {
        color: black;
    }

    .table th,
    .table td {
        text-align: center;
        vertical-align: middle;
    }

    @media (max-width: 768px) {

        .table th,
        .table td {
            font-size: 12px;
        }
    }

    .btn-info.ver-radicado {
        background-color: #d3d3d3;
        border: 2px solid #a9a9a9;
        color: black;
        transition: all 0.3s ease;
    }

    .btn-info.ver-radicado:hover,
    .btn-info.ver-radicado:active {
        background-color: #ececec;
    }

    .btn-warning.estado-radicado {
        background-color: #a9a9a9;
        border: 2px solid #808080;
        color: black;
        transition: all 0.3s ease;
    }

    .btn-warning.estado-radicado:hover,
    .btn-warning.estado-radicado:active {
        background-color: #ececec;
    }
</style>