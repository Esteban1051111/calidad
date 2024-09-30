<?php include('../../../../templates/headeradmin.php') ?>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
<br />
<br />
<div class="container">
    <div class="card bg-dark custom-margin">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 style="font-size: 12px;" class="mb-0">ESCRITURAS DEL DÍA</h5>
                <input type="text" class="form-control" id="fechaSeleccionada" style="background-color: #b0dab9; width: 200px; font-size: 12px;" readonly>
            </div>
            <div class="card-body">
                <!-- Seleccionador de Fecha -->
                <div class="mb-3">
                    <div class="row">
                        <div class="col-md-3 mb-3 mb-md-0">
                            <input type="number" class="form-control" id="buscar_escritura" placeholder="Buscar Escritura..." style=" font-size: 12px;">
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-primary w-100" style=" font-size: 12px;">Buscar</button>
                        </div>
                    </div>
                </div>

                <!-- Tabla con los campos solicitados -->
                <div class="scroll-container table-responsive">
                    <table class="table table-bordered" style="font-size: 12px; white-space: nowrap;">
                        <thead class="thead-dark">
                            <tr>
                                <th style="min-width: 50px;">Pendiente</th>
                                <th style="min-width: 120px;"># Escritura</th>
                                <th style="min-width: 150px;">Radicado</th>
                                <th style="min-width: 250px;">NIR</th>
                                <th style="min-width: 150px;">Banco</th>
                                <th style="min-width: 150px;">Constructora</th>
                                <th style="min-width: 150px;">Departamento</th>
                                <th style="min-width: 150px;">Municipio</th>
                                <th style="min-width: 200px;">Observaciones</th>
                                <th style="min-width: 50px;">Pago Renta</th>
                                <th style="min-width: 50px;">Pago Registro</th>
                                <th style="min-width: 200px;"># Turno</th>
                                <th style="min-width: 50px;">Constancia de Inscripción</th>
                                <th style="min-width: 50px;">Nota Devolutiva</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <select class="form-control" id="pendiente" name="pendiente" style="font-size: 12px;">
                                        <option value="no" selected>No</option>
                                        <option value="si">Sí</option>
                                    </select>
                                </td>
                                <td><input type="number" class="form-control" id="escritura" name="escritura" style="font-size: 12px;"></td>
                                <td><input type="number" class="form-control" id="radicado" name="radicado" style="font-size: 12px;"></td>
                                <td><input type="number" class="form-control" id="nir" name="nir" style="font-size: 12px;"></td>
                                <td>
                                    <select class="form-control" id="banco" name="banco" style="font-size: 12px;">
                                        <option value="">Seleccione un Banco</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control" id="constructora" name="constructora" style="font-size: 12px;">
                                        <option value="">Seleccione una Constructora</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control" id="departamento" name="departamento" style="font-size: 12px;" onchange="cargarMunicipios()">
                                        <option value="">Seleccione un Departamento</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control" id="municipio" name="municipio" style="font-size: 12px;">
                                        <option value="">Seleccione un Municipio</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control" id="observaciones" name="observaciones" style="font-size: 12px;"></td>
                                <td>
                                    <select class="form-control" id="pago_renta" name="pago_renta" style="font-size: 12px;">
                                        <option value="si">Sí</option>
                                        <option value="no">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control" id="pago_registro" name="pago_registro" style="font-size: 12px;">
                                        <option value="si">Sí</option>
                                        <option value="no">No</option>
                                    </select>
                                </td>
                                <td><input type="number" class="form-control" id="turno" name="turno" style="font-size: 12px;"></td>
                                <td>
                                    <select class="form-control" id="constancia_inscripcion" name="constancia_inscripcion" style="font-size: 12px;">
                                        <option value="no">No</option>
                                        <option value="si">Sí</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control" id="nota_devolutiva" name="nota_devolutiva" style="font-size: 12px;">
                                        <option value="no">No</option>
                                        <option value="si">Sí</option>
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- Botones -->
                <div class="mt-4">
                    <button type="button" class="btn btn-secondary" onclick="cancelar()" style="font-size: 12px;">Cancelar</button>
                    <button type="button" class="btn btn-success" onclick="guardar()" style="font-size: 12px;">Guardar</button>
                    <button type="button" class="btn btn-primary" onclick="nuevaEscritura()" style="font-size: 12px;">Nueva Escritura</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card bg-dark custom-margin">
    <div class="card">
        <div class="card-header">
            <h5 style="font-size: 12px;" class="mb-0">ESCRITURAS PENDIENTES</h5>
        </div>
        <div class="card-body">
            <!-- Tabla para mostrar escrituras pendientes -->
            <div class="scroll-container table-responsive">
                <table class="table table-bordered" style="font-size: 12px; white-space: nowrap;">
                    <thead class="thead-dark">
                        <tr>
                            <th style="min-width: 50px;">Pendiente</th>
                            <th style="min-width: 120px;"># Escritura</th>
                            <th style="min-width: 150px;">Radicado</th>
                            <th style="min-width: 250px;">NIR</th>
                            <th style="min-width: 150px;">Banco</th>
                            <th style="min-width: 150px;">Constructora</th>
                            <th style="min-width: 150px;">Departamento</th>
                            <th style="min-width: 150px;">Municipio</th>
                            <th style="min-width: 200px;">Observaciones</th>
                            <th style="min-width: 50px;">Pago Renta</th>
                            <th style="min-width: 50px;">Pago Registro</th>
                            <th style="min-width: 200px;"># Turno</th>
                            <th style="min-width: 50px;">Constancia de Inscripción</th>
                            <th style="min-width: 50px;">Nota Devolutiva</th>
                            <th style="min-width: 100px;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="escriturasPendientesBody">
                        <!-- Filas se llenarán dinámicamente con JavaScript -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<div class="container">
    <a href="../../../../secciones/admin/radicacion_electronica/index.php" class="btn btn-primary btn-lg mb-4" style="font-size: 12px;">Atrás</a>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

<?php include('../../../../templates/footeradmin.php') ?>

<style>
    .custom-margin {
        margin-top: 70px;
        margin-bottom: 70px;
    }

    .scroll-container {
        overflow-x: auto;
    }

    .pagination .page-link {
        color: black;
    }

    .hidden {
        display: none;
    }
</style>

<script>
    $(document).ready(function() {
         // Obtener la fecha actual en formato local (YYYY-MM-DD)
         function getLocalDate() {
            var today = new Date();
            var day = today.getDate().toString().padStart(2, '0');
            var month = (today.getMonth() + 1).toString().padStart(2, '0'); // Los meses en JS son 0-indexados
            var year = today.getFullYear();
            return year + '-' + month + '-' + day;
        }

        // Cargar la fecha actual en el campo correspondiente
        $('#fechaSeleccionada').val(getLocalDate());

        // Cargar departamentos y otras opciones
        cargarDepartamentos();
        cargarConstructora();
        cargarBancos();
    });

    function cargarDepartamentos() {
        $.ajax({
            url: '../../../../peticiones/obtener_departamento.php',
            type: 'GET',
            success: function(response) {
                var departamentos = JSON.parse(response);
                var departamentoSelect = $('#departamento');
                departamentos.forEach(function(departamento) {
                    departamentoSelect.append(new Option(departamento.nombre, departamento.id));
                });
            }
        });
    }

    function cargarMunicipios() {
        var departamento_id = $('#departamento').val();
        if(departamento_id) {
            $.ajax({
                url: '../../../../peticiones/obtener_municipios.php',
                type: 'POST',
                data: {departamento_id: departamento_id},
                success: function(response) {
                    var municipios = JSON.parse(response);
                    var municipioSelect = $('#municipio');
                    municipioSelect.empty();
                    municipioSelect.append(new Option('Seleccione un Municipio', ''));
                    municipios.forEach(function(municipio) {
                        municipioSelect.append(new Option(municipio.nombre, municipio.id));
                    });
                }
            });
        }
    }

    function cargarConstructora() {
        $.ajax({
            url: '../../../../peticiones/obtener_constructora.php',
            type: 'GET',
            success: function(data) {
                var constructoras = JSON.parse(data);
                constructoras.forEach(function(constructora) {
                    $('#constructora').append(new Option(constructora.nombre, constructora.id));
                });
            }
        });
    }

    function cargarBancos() {
        $.ajax({
            url: '../../../../peticiones/obtener_bancos.php',
            type: 'GET',
            success: function(data) {
                var bancos = JSON.parse(data);
                bancos.forEach(function(banco) {
                    $('#banco').append(new Option(banco.nombre, banco.id));
                });
            }
        });
    }

    function cancelar() {
        limpiarFormulario();
    }

    function guardar() {
        // Capturar datos del formulario
        var fechaSeleccionada = $('#fechaSeleccionada').val();
        var pendiente = $('#pendiente').val();
        var escritura = $('#escritura').val();
        var radicado = $('#radicado').val();
        var nir = $('#nir').val();
        var turno = $('#turno').val();
        var banco = $('#banco').val();
        var constructora = $('#constructora').val();
        var departamento = $('#departamento').val();
        var municipio = $('#municipio').val();
        var observaciones = $('#observaciones').val();
        var pago_renta = $('#pago_renta').val();
        var pago_registro = $('#pago_registro').val();
        var constancia_inscripcion = $('#constancia_inscripcion').val();
        var nota_devolutiva = $('#nota_devolutiva').val();

        console.log({
            fechaSeleccionada: fechaSeleccionada,
            pendiente: pendiente,
            escritura: escritura,
            radicado: radicado,
            nir: nir,
            turno: turno,
            banco: banco,
            constructora: constructora,
            departamento: departamento,
            municipio: municipio,
            observaciones: observaciones,
            pago_renta: pago_renta,
            pago_registro: pago_registro,
            constancia_inscripcion: constancia_inscripcion,
            nota_devolutiva: nota_devolutiva
        });

        $.ajax({
            url: '../../../../peticiones/guardar_escritura_dia.php',
            type: 'POST',
            data: {
                fechaSeleccionada: fechaSeleccionada,
                pendiente: pendiente,
                escritura: escritura,
                radicado: radicado,
                nir: nir,
                turno: turno,
                banco: banco,
                constructora: constructora,
                departamento: departamento,
                municipio: municipio,
                observaciones: observaciones,
                pago_renta: pago_renta,
                pago_registro: pago_registro,
                constancia_inscripcion: constancia_inscripcion,
                nota_devolutiva: nota_devolutiva
            },
            success: function(response) {
                console.log("Respuesta del servidor: " + response);
                if (response.includes("Error")) {
                    alert("Error: " + response);
                    limpiarFormulario(); 
                } else {
                    alert(response);
                    limpiarFormulario(); 
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log("Error en la solicitud AJAX: " + textStatus, errorThrown);
            }
        });
    }
     
    function limpiarFormulario() {
        $('#pendiente').val('no');
        $('#escritura').val('');
        $('#radicado').val('');
        $('#nir').val('');
        $('#banco').val('');
        $('#constructora').val('');
        $('#departamento').val('');
        $('#municipio').val('');
        $('#observaciones').val('');
        $('#pago_renta').val('si');
        $('#pago_registro').val('si');
        $('#turno').val('');
        $('#constancia_inscripcion').val('no');
        $('#nota_devolutiva').val('no');
    }// Llamada a la función que limpia el formulario


    function nuevaEscritura() {
        
        limpiarFormulario(); // Llamada a la función que limpia el formulario
    }


    $(document).ready(function() {
    cargarEscriturasPendientes();
});

function cargarEscriturasPendientes() {
    $.ajax({
        url: '../../../../peticiones/obtener_escrituras_pendientes.php',
        type: 'GET',
        success: function(response) {
            var escrituras = JSON.parse(response);
            var tbody = $('#escriturasPendientesBody');
            tbody.empty();
            escrituras.forEach(function(escritura) {
                tbody.append(`
                    <tr>
                        <td>
                            <select class="form-control" style="font-size: 12px;" onchange="actualizarPendiente(${escritura.id_escritura}, this.value)">
                                <option value="si" ${escritura.pendiente === '1' ? 'selected' : ''}>Sí</option>
                                <option value="no" ${escritura.pendiente === '0' ? 'selected' : ''}>No</option>
                            </select>
                        </td>
                        <td>${escritura.escritura}</td>
                        <td>${escritura.radicado}</td>
                        <td>${escritura.nir}</td>
                        <td>${escritura.banco}</td>
                        <td>${escritura.constructora}</td>
                        <td>${escritura.departamento}</td>
                        <td>${escritura.municipio}</td>
                        <td>${escritura.observaciones}</td>
                        <td>${escritura.pago_renta}</td>
                        <td>${escritura.pago_registro}</td>
                        <td>${escritura.turno}</td>
                        <td>${escritura.constancia_inscripcion}</td>
                        <td>${escritura.nota_devolutiva}</td>
                        <td>
                            <button class="btn btn-warning btn-sm" onclick="editarEscritura(${escritura.id_escritura})" style="font-size: 12px;">Editar</button>
                        </td>
                    </tr>
                `);
            });
        }
    });
}

function actualizarPendiente(idEscritura, estado) {
    $.ajax({
        url: '../../../../peticiones/actualizar_estado_pendiente.php',
        type: 'POST',
        data: {
            id_escritura: idEscritura,
            pendiente: estado
        },
        success: function(response) {
            alert('Estado actualizado correctamente.');
        }
    });
}

</script>
