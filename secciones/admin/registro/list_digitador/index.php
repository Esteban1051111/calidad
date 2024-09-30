<?php
require_once '../../../../peticiones/verificar_sesion.php';
?>
<?php
include('../../../../templates/headeradmin.php');
include('../../../../peticiones/obtener_usuarios.php');

// Definir el número de registros por página
$registrosPorPagina = 4;

// Obtener el término de búsqueda desde la URL
$terminoBusqueda = isset($_GET['buscar']) ? $_GET['buscar'] : '';

// Obtener el número de página actual
$paginaActual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;

// Obtener los usuarios para la página actual
$usuarios = obtenerUsuarios($terminoBusqueda);
$totalUsuarios = count($usuarios);
$indiceInicio = ($paginaActual - 1) * $registrosPorPagina;
$usuariosPaginados = array_slice($usuarios, $indiceInicio, $registrosPorPagina);

// Calcular el número total de páginas
$totalPaginas = ceil($totalUsuarios / $registrosPorPagina);
?>

<br />
<div class="card bg-dark custom-margin">
    <div class="card">
        <div class="card-header">LISTAR USUARIOS</div>
        <div class="card-body">
            <!-- Campo de búsqueda y botón de búsqueda -->
            <form method="GET" action="index.php">
                <div class="mb-3 d-flex align-items-center">
                    <input type="text" name="buscar" class="form-control me-2" id="buscarUsuario" placeholder="Buscar usuario" style="background-color: #b0dab9; width: 100%;" value="<?php echo htmlspecialchars($terminoBusqueda); ?>">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                </div>
            </form>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <!-- Encabezados de la tabla -->
                    <thead>
                        <tr>
                            <th scope="col" style="width: 2%;">ID</th>
                            <th scope="col" style="width: 10%;">Nombres</th>
                            <th scope="col" style="width: 10%;">Apellidos</th>
                            <th scope="col" style="width: 15%;">Correo</th>
                            <th scope="col" style="width: 10%;">Celular</th>
                            <th scope="col" style="width: 10%;">Empresa</th>
                            <th scope="col" style="width: 8%;">Tipo</th>
                            <th scope="col" style="width: 12%;">Usuario</th>
                            <th scope="col" style="width: 2%;">Activo</th>
                            <th scope="col" style="width: 3%;">Puntaje</th>

                        </tr>
                    </thead>
                    <!-- Cuerpo de la tabla -->
                    <tbody>
                        <?php if (count($usuariosPaginados) > 0) : ?>
                            <?php foreach ($usuariosPaginados as $usuario) : ?>
                                <tr>
                                    <form method="POST" action="../../../../peticiones/actualizar_usuario.php">
                                        <td>
                                            <idiv type="hidden" name="id_usuario" value="<?php echo htmlspecialchars($usuario['id_usuario'] ?? ''); ?>">
                                                <?php echo htmlspecialchars($usuario['id_usuario'] ?? ''); ?>
                                        </td>
                                        <td><input type="text" name="nombres" class="form-control" value="<?php echo htmlspecialchars($usuario['nombres'] ?? ''); ?>"></td>
                                        <td><input type="text" name="apellidos" class="form-control" value="<?php echo htmlspecialchars($usuario['apellidos'] ?? ''); ?>"></td>
                                        <td><input type="text" name="correo" class="form-control" value="<?php echo htmlspecialchars($usuario['correo'] ?? ''); ?>"></td>
                                        <td><input type="text" name="celular" class="form-control" value="<?php echo htmlspecialchars($usuario['celular'] ?? ''); ?>"></td>
                                        <td><input type="text" name="empresa" class="form-control" value="<?php echo htmlspecialchars($usuario['empresa'] ?? ''); ?>"></td>
                                        <td><input type="text" name="tipo_usuario" class="form-control" value="<?php echo htmlspecialchars($usuario['tipo_usuario'] ?? ''); ?>"></td>
                                        <td><input type="text" name="usuario" class="form-control" value="<?php echo htmlspecialchars($usuario['usuario'] ?? ''); ?>"></td>
                                        <td>
                                            <div class="form-control-static"><?php echo ($usuario['activo'] == 1) ? 'Sí' : 'No'; ?></div>
                                        </td>
                                        <td>
                                            <div class="form-control-static"><?php echo htmlspecialchars($usuario['puntaje'] ?? ''); ?></div>
                                        </td>
                                </tr>
                                <tr>
                                    <td><button type="submit" class="btn btn-primary">Actualizar</button></td>
                                    </form>
                                    <td>
                                        <form method="POST" action="../../../../peticiones/eliminar_usuario.php" onsubmit="return confirm('¿Está seguro que desea eliminar este usuario?');">
                                            <input type="hidden" name="id_usuario" value="<?php echo htmlspecialchars($usuario['id_usuario'] ?? ''); ?>">

                                            <button type="submit" class="btn btn-danger">Eliminar</button>
                                        </form>
                                    </td>
                                    <td>
                                        <!-- Botón para abrir el modal -->
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#puntajeModal" data-id="<?php echo htmlspecialchars($usuario['id_usuario'] ?? ''); ?>">Modificar Puntaje</button>
                                    </td>

                                    <!-- Botón para abrir el modal de desactivación -->
                                    <td>
                                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#desactivarModal" data-id="<?php echo htmlspecialchars($usuario['id_usuario'] ?? ''); ?>">Desactivar</button>
                                    </td>
                                    <td><button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#reactivarModal" data-id="<?php echo htmlspecialchars($usuario['id_usuario'] ?? ''); ?>">Reactivar</button></td>

                                    </td>
                                </tr>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="10" class="text-center">No se encontraron usuarios.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
                <div class="d-flex justify-content-end">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link text-dark" href="?pagina=<?php echo ($paginaActual > 1) ? ($paginaActual - 1) : 1; ?>&buscar=<?php echo htmlspecialchars($terminoBusqueda); ?>">Previo</a></li>
                            <?php for ($i = 1; $i <= $totalPaginas; $i++) : ?>
                                <li class="page-item <?php echo ($paginaActual == $i) ? 'active' : ''; ?>"><a class="page-link text-dark" href="?pagina=<?php echo $i; ?>&buscar=<?php echo htmlspecialchars($terminoBusqueda); ?>"><?php echo $i; ?></a></li>
                            <?php endfor; ?>
                            <li class="page-item"><a class="page-link text-dark" href="?pagina=<?php echo ($paginaActual < $totalPaginas) ? ($paginaActual + 1) : $totalPaginas; ?>&buscar=<?php echo htmlspecialchars($terminoBusqueda); ?>">Siguiente</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal para modificar puntaje-->

<div class="modal fade" id="puntajeModal" tabindex="-1" aria-labelledby="puntajeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="puntajeModalLabel">Modificar Puntaje</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="puntajeForm" method="POST" action="../../../../peticiones/modificar_puntaje.php">
                    <input type="hidden" name="id_usuario" id="id_usuario_puntaje">
                    <div class="mb-3">
                        <label for="puntaje" class="form-label">Puntaje</label>
                        <input type="number" class="form-control" name="puntaje" id="puntaje" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" form="puntajeForm" class="btn btn-primary">Guardar Puntaje</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal para desactivar usuario -->
<div class="modal fade" id="desactivarModal" tabindex="-1" aria-labelledby="desactivarModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="desactivarModalLabel">Desactivar Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="desactivarForm" method="POST" action="../../../../peticiones/desactivar_usuario.php">
                    <input type="hidden" name="id_usuario" id="id_usuario_desactivar">
                    <p>¿Está seguro de que desea desactivar este usuario?</p>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" form="desactivarForm" class="btn btn-warning">Desactivar</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="reactivarModal" tabindex="-1" aria-labelledby="reactivarModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reactivarModalLabel">Reactivar Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="reactivarForm" method="POST" action="../../../../peticiones/reactivar_usuario.php">
                    <input type="hidden" name="id_usuario" id="id_usuario_reactivar">
                    <p>¿Está seguro de que desea reactivar este usuario?</p>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" form="reactivarForm" class="btn btn-success">Reactivar</button>
            </div>
        </div>
    </div>
</div>


<br />
<a href="../../../../secciones/admin/registro/index.php" class="btn btn-primary btn-lg mb-4">Atrás</a>

<?php include('../../../../templates/footeradmin.php') ?>

<style>
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

    /* Estilo personalizado para el botón de modificar puntaje */
    .btn-info.btn-sm {
        font-size: 0.8rem;
        /* Tamaño de la fuente más pequeño */
        padding: 0.25rem 0.5rem;
        /* Espaciado interno más pequeño */
    }
</style>
<!-- Script para desactivar usuario -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var desactivarModal = document.getElementById('desactivarModal');
        desactivarModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            var id_usuario = button.getAttribute('data-id');
            var inputIdUsuario = desactivarModal.querySelector('#id_usuario_desactivar');
            inputIdUsuario.value = id_usuario;
        });
    });
</script>
<!-- Script para reactivar usuario -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var reactivarModal = document.getElementById('reactivarModal');
        reactivarModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            var id_usuario = button.getAttribute('data-id');
            var inputIdUsuario = reactivarModal.querySelector('#id_usuario_reactivar');
            inputIdUsuario.value = id_usuario;
        });
    });
</script>
<!-- Script de modificar puntaje -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var puntajeModal = document.getElementById('puntajeModal');
        puntajeModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            var id_usuario = button.getAttribute('data-id');
            var inputIdUsuario = puntajeModal.querySelector('#id_usuario_puntaje');
            inputIdUsuario.value = id_usuario;
        });
    });
</script>