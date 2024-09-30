<?php include('../../../templates/headerconstructora.php')?>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
<br/>
<br/>
<div class="container">
        <div class="card bg-dark custom-margin">
            <div class="card">
                <div class="card-header">LISTAR RADICADOS EN BORRADOR O POR PROYECTO</div>
                <div class="card-body">
                    <!-- Campo de búsqueda y botón de búsqueda -->
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-md-8 mb-3 mb-md-0">
                                <input type="number" class="form-control" id="buscarRadicado_borrador" placeholder="Buscar Radicado en Borrador..." style="background-color: #b0dab9;">
                            </div>
                            <div class="col-md-4">
                                <button type="button" class="btn btn-primary w-100" onclick="mostrarTabla('tablaRadicados')">Buscar Radicado</button>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-8 mb-3 mb-md-0">
                                <!-- Campo vacío para mantener el diseño -->
                            </div>
                            <div class="col-md-4">
                                <button type="button" class="btn btn-primary w-100" onclick="mostrarTabla('tablaRadicadosBorrador')">Listar Todos los Radicados en Borrador</button>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-8 mb-3 mb-md-0">
                                <select class="form-select" id="buscarProyecto" style="background-color: #b0dab9;">
                                    <option selected>Buscar por Proyecto...</option>
                                    <option value="proyecto1">Proyecto 1</option>
                                    <option value="proyecto2">Proyecto 2</option>
                                    <option value="proyecto3">Proyecto 3</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <button type="button" class="btn btn-primary w-100" onclick="mostrarTabla('tablaProyectos')">Listar Radicados por Proyecto</button>
                            </div>
                        </div>
                    </div>

                    <div id="tablaRadicados" class="table-responsive hidden">
                        <table class="table table-bordered table-white">
                            <!-- Encabezados de la tabla -->
                            <thead>
                                <tr>
                                    <th scope="col">Radicado</th>
                                    <th scope="col">Matriculas</th>
                                    <th scope="col">Nombre Primer</th>
                                    <th scope="col">Apellidos Primer</th>
                                    <th scope="col">Correo</th>
                                    <th scope="col">Celular</th>
                                    <th scope="col">Nombre Segunda</th>
                                    <th scope="col">Apellido Segundo</th>
                                    <th scope="col">Correo</th>
                                    <th scope="col">Teléfono</th>
                                    <th scope="col">Teléfono</th>
                                    <th scope="col">Teléfono</th>
                                    <th scope="col">Teléfono</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <!-- Cuerpo de la tabla -->
                            <tbody>
                                <tr>
                                    <td>Item</td>
                                    <td>Item</td>
                                    <td>Item</td>
                                    <td>Item</td>
                                    <td>Item</td>
                                    <td>Item</td>
                                    <td>Item</td>
                                    <td>Item</td>
                                    <td>Item</td>
                                    <td>Item</td>
                                    <td>Item</td>
                                    <td>Item</td>
                                    <td>Item</td>
                                    <td>
                                        <a name="" id="" class="btn btn-primary" href="#" role="button">Actualizar</a>
                                        <a name="" id="" class="btn btn-danger" href="#" role="button">Eliminar</a>
                                    </td>
                                </tr>
                                <!-- Otras filas de la tabla -->
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-end">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination">
                                    <li class="page-item"><a class="page-link text-dark" href="#">Previo</a></li>
                                    <li class="page-item"><a class="page-link text-dark" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link text-dark" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link text-dark" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link text-dark" href="#">Siguiente</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>

                    <div id="tablaRadicadosBorrador" class="table-responsive hidden">
                        <table class="table table-bordered table-white">
                            <!-- Encabezados de la tabla -->
                            <thead>
                                <tr>
                                    <th scope="col">Radicado</th>
                                    <th scope="col">Matriculas</th>
                                    <th scope="col">Nombre Primer</th>
                                    <th scope="col">Apellidos Primer</th>
                                    <th scope="col">Correo</th>
                                    <th scope="col">Celular</th>
                                    <th scope="col">Nombre Segunda</th>
                                    <th scope="col">Apellido Segundo</th>
                                    <th scope="col">Correo</th>
                                    <th scope="col">Teléfono</th>
                                    <th scope="col">Teléfono</th>
                                    <th scope="col">Teléfono</th>
                                    <th scope="col">Teléfono</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <!-- Cuerpo de la tabla -->
                            <tbody>
                                <tr>
                                    <td>Item 1</td>
                                    <td>Item 1</td>
                                    <td>Item 1</td>
                                    <td>Item 1</td>
                                    <td>Item 1</td>
                                    <td>Item 1</td>
                                    <td>Item 1</td>
                                    <td>Item 1</td>
                                    <td>Item 1</td>
                                    <td>Item 1</td>
                                    <td>Item 1</td>
                                    <td>Item 1</td>
                                    <td>Item 1</td>
                                    <td>
                                        <a name="" id="" class="btn btn-primary" href="#" role="button">Actualizar</a>
                                        <a name="" id="" class="btn btn-danger" href="#" role="button">Eliminar</a>
                                    </td>
                                </tr>
                                <!-- Otras filas de la tabla -->
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-end">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination">
                                    <li class="page-item"><a class="page-link text-dark" href="#">Previo</a></li>
                                    <li class="page-item"><a class="page-link text-dark" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link text-dark" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link text-dark" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link text-dark" href="#">Siguiente</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>

                    <div id="tablaProyectos" class="table-responsive hidden">
                        <table class="table table-bordered table-white">
                            <!-- Encabezados de la tabla -->
                            <thead>
                                <tr>
                                    <th scope="col">Proyecto</th>
                                    <th scope="col">Radicado</th>
                                    <th scope="col">Matriculas</th>
                                    <th scope="col">Nombre Primer</th>
                                    <th scope="col">Apellidos Primer</th>
                                    <th scope="col">Correo</th>
                                    <th scope="col">Celular</th>
                                    <th scope="col">Nombre Segunda</th>
                                    <th scope="col">Apellido Segundo</th>
                                    <th scope="col">Correo</th>
                                    <th scope="col">Teléfono</th>
                                    <th scope="col">Teléfono</th>
                                    <th scope="col">Teléfono</th>
                                    <th scope="col">Teléfono</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <!-- Cuerpo de la tabla -->
                            <tbody>
                                <tr>
                                    <td>Proyecto 1</td>
                                    <td>Item</td>
                                    <td>Item</td>
                                    <td>Item</td>
                                    <td>Item</td>
                                    <td>Item</td>
                                    <td>Item</td>
                                    <td>Item</td>
                                    <td>Item</td>
                                    <td>Item</td>
                                    <td>Item</td>
                                    <td>Item</td>
                                    <td>Item</td>
                                    <td>Item</td>
                                    <td>Item</td>
                                    <td>
                                        <a name="" id="" class="btn btn-primary" href="#" role="button">Actualizar</a>
                                        <a name="" id="" class="btn btn-danger" href="#" role="button">Eliminar</a>
                                    </td>
                                </tr>
                                <!-- Otras filas de la tabla -->
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-end">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination">
                                    <li class="page-item"><a class="page-link text-dark" href="#">Previo</a></li>
                                    <li class="page-item"><a class="page-link text-dark" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link text-dark" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link text-dark" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link text-dark" href="#">Siguiente</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <br/>  
    <div class="container">
        <a href="../opciones_radicacion/index.php" class="btn btn-primary btn-lg mb-4">Atrás</a>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        function mostrarTabla(id) {
            document.getElementById('tablaRadicados').classList.add('hidden');
            document.getElementById('tablaRadicadosBorrador').classList.add('hidden');
            document.getElementById('tablaProyectos').classList.add('hidden');
            document.getElementById(id).classList.remove('hidden');
        }
    </script>

<?php include('../../../templates/footerconstructora.php')?>

<style>
.custom-margin {
            margin-top: 70px; /* Ajusta este valor según sea necesario */
            margin-bottom: 70px; /* Ajusta este valor según sea necesario */
        }

        .pagination .page-link {
    color: black;
}
.hidden {
            display: none;
        }

</style>