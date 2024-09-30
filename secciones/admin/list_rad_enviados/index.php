<?php 
include('../../../templates/headeradmin.php'); 
include('../../../peticiones/buscar_radicados_controller.php'); 

// Definir el número de registros por página
$registrosPorPagina = 4;

// Obtener el término de búsqueda desde la URL
$terminoBusqueda = isset($_GET['buscar']) ? $_GET['buscar'] : '';

// Obtener el número de página actual
$paginaActual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;

// Obtener los radicados para la página actual
$radicados = obtenerRadicados($terminoBusqueda);
$totalRadicados = count($radicados);
$indiceInicio = ($paginaActual - 1) * $registrosPorPagina;
$radicadosPaginados = array_slice($radicados, $indiceInicio, $registrosPorPagina);

// Calcular el número total de páginas
$totalPaginas = ceil($totalRadicados / $registrosPorPagina);
?>

<br />
<div class="card bg-dark custom-margin">
    <div class="card">
        <div class="card-header">LISTAR RADICADOS</div>
        <div class="card-body">
            <!-- Campo de búsqueda y botón de búsqueda -->
            <form method="GET" action="index.php">
                <div class="mb-3 d-flex align-items-center">
                    <input type="text" name="buscar" class="form-control me-2" id="buscarRadicado" placeholder="Buscar radicado"  value="<?php echo htmlspecialchars($terminoBusqueda); ?>">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                </div>
            </form>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <!-- Encabezados de la tabla -->
                    <thead>
                        <tr>
                            <th scope="col">Número de Radicado</th>
                            <th scope="col">Acto Notarial</th>
                            <th scope="col">Usuario Radicó</th>
                            <th scope="col">Nombre Interviniente</th>
                            <th scope="col">Apellido Interviniente</th>
                            <th scope="col">Tipo Interviniente</th>
                            <th scope="col">Número Identidad Interviniente</th>
                            <th scope="col">Teléfono Interviniente</th>
                            <th scope="col">Número Folio de Matrícula</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <!-- Cuerpo de la tabla -->
                    <tbody>
                        <?php if (count($radicadosPaginados) > 0) : ?>
                            <?php foreach ($radicadosPaginados as $radicado) : ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($radicado['NUM_RADICADO']); ?></td>
                                    <td><?php echo htmlspecialchars($radicado['ACTO_NOTARIAL']); ?></td>
                                    <td><?php echo htmlspecialchars($radicado['USUARIO_RADICO']); ?></td>
                                    <td><?php echo htmlspecialchars($radicado['INTERVINIENTE_NOMBRES']); ?></td>
                                    <td><?php echo htmlspecialchars($radicado['INTERVINIENTE_APELLIDOS']); ?></td>
                                    <td><?php echo htmlspecialchars($radicado['INTERVINIENTE_TIPO']); ?></td>
                                    <td><?php echo htmlspecialchars($radicado['INTERVINIENTE_NUM_IDENTI']); ?></td>
                                    <td><?php echo htmlspecialchars($radicado['INTERVINIENTE_TELEFONO']); ?></td>
                                    <td><?php echo htmlspecialchars($radicado['FOLIO_NUM_MATRICULA']); ?></td>
                                    <td>
                                        <button class="btn btn-info ver-radicado" data-bs-toggle="modal" data-bs-target="#detalleRadicadoModal" data-num-radicado="<?php echo htmlspecialchars($radicado['NUM_RADICADO']); ?>">Ver</button>
                                        <button class="btn btn-warning estado-radicado" data-bs-toggle="modal" data-bs-target="#estadoRadicadoModal" data-num-radicado="<?php echo htmlspecialchars($radicado['NUM_RADICADO']); ?>">Estado</button>
                                    </td>   
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="11" class="text-center">No se encontraron radicados.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
             
                <!-- Modal para mostrar detalles del radicado -->
                <!-- Modal -->
                <div class="modal fade" id="detalleRadicadoModal" tabindex="-1" aria-labelledby="detalleRadicadoModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-custom">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="detalleRadicadoModalLabel">Informacion del Radicado</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body" id="detalleRadicadoContent">
                                <!-- El contenido se cargará aquí dinámicamente -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal para mostrar el estado del radicado -->
                <!-- Modal -->
                <div class="modal fade" id="estadoRadicadoModal" tabindex="-1" aria-labelledby="estadoRadicadoModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-custom">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="estadoRadicadoModalLabel">Estado del Radicado </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body" id="estadoRadicadoContent">

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Estilo CSS -->
                <style>
                    .modal-custom {
                        max-width: 80%; /* Ajusta el porcentaje según tus necesidades */
                    }
                </style>

<script>
document.addEventListener('DOMContentLoaded', (event) => {
    const detalleModal = document.getElementById('detalleRadicadoModal');
    const estadoModal = document.getElementById('estadoRadicadoModal');

    detalleModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget; // Botón que activó el modal
        const numRadicado = button.getAttribute('data-num-radicado');
        const contentDiv = document.getElementById('detalleRadicadoContent');

        // Realiza una solicitud AJAX para cargar el contenido
        fetch(`../../../secciones/admin/list_rad_enviados/buscar_radicados.php?numRadicado=${encodeURIComponent(numRadicado)}`)
            .then(response => response.text())
            .then(data => {
                contentDiv.innerHTML = data;
            })
            .catch(error => {
                console.error('Error al cargar el contenido:', error);
                contentDiv.innerHTML = '<p>Error al cargar el contenido.</p>';
            });
    });

    estadoModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget; // Botón que activó el modal
        const numRadicado = button.getAttribute('data-num-radicado');
        const contentDiv = document.getElementById('estadoRadicadoContent');

        // Realiza una redirección a estadoscontroller.php con el número de radicado como parámetro
        window.location.href = `../../../secciones/admin/list_rad_enviados/estados.php?numRadicado=${encodeURIComponent(numRadicado)}`;
    });

    detalleModal.addEventListener('hide.bs.modal', function (event) {
        const contentDiv = document.getElementById('detalleRadicadoContent');
        contentDiv.innerHTML = ''; // Limpiar el contenido al cerrar el modal
    });

    estadoModal.addEventListener('hide.bs.modal', function (event) {
        const contentDiv = document.getElementById('estadoRadicadoContent');
        contentDiv.innerHTML = ''; // Limpiar el contenido al cerrar el modal
    });
});
</script>
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


                <br />
                <a href="http://localhost/BotPlussFB/secciones/admin/opciones_radicacion" class="btn btn-primary btn-lg mb-4">Atrás</a>
                
                <?php 
                include('../../../templates/footeradmin.php'); 
                ?>

                        <style>
                                        .btn-primary {
                            background-color: transparent; /* Fondo transparente */
                            border: 2px solid black; /* Línea de contorno negro */
                            color: black; /* Color del texto negro */
                            transition: all 0.3s ease; /* Suaviza las transiciones */
                        }

                        .btn-primary:hover {
                            background-color: #ECECEC; /* Fondo #ECECEC al pasar el mouse */
                        }

                        .btn-primary:active {
                            background-color: #ECECEC; /* Fondo #ECECEC al hacer clic */
                        }


                    .custom-margin {
                        margin-top: 70px;
                        margin-bottom: 70px;
                    }
                    
                    .pagination .page-link {
                        color: black;
                    }

                    .table th, .table td {
                        text-align: center;
                        vertical-align: middle;
                    }

                    @media (max-width: 768px) {
                        .table th, .table td {
                            font-size: 12px;
                        }
                    }
                                            /* Botón "Ver" con tono de gris más claro */
                        .btn-info.ver-radicado {
                            background-color: #d3d3d3; /* Gris claro */
                            border: 2px solid #a9a9a9; /* Contorno gris oscuro */
                            color: black; /* Texto en negro */
                            transition: all 0.3s ease;
                        }

                        .btn-info.ver-radicado:hover,
                        .btn-info.ver-radicado:active {
                            background-color: #ececec; /* Fondo #ECECEC al pasar el mouse o hacer clic */
                        }

                        /* Botón "Estado" con tono de gris más oscuro */
                        .btn-warning.estado-radicado {
                            background-color: #a9a9a9; /* Gris oscuro */
                            border: 2px solid #808080; /* Contorno gris más oscuro */
                            color: black; /* Texto en negro */
                            transition: all 0.3s ease;
                        }

                        .btn-warning.estado-radicado:hover,
                        .btn-warning.estado-radicado:active {
                            background-color: #ececec; /* Fondo #ECECEC al pasar el mouse o hacer clic */
                        }

                </style>

                
