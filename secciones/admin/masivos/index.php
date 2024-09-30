<?php $url_base = "" ?>
<?php include('../../../templates/headeradmin.php') ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<div class="container mt-5">
    <h1 class="mb-4">Subir Excel para radicación Masiva</h1>
    
    <!-- Formulario para subir el archivo Excel -->
    <form id="uploadForm" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="file" class="form-label">Proyecto Masivo</label>
            <input type="file" name="file" id="file" class="form-control" accept=".xls,.xlsx" required>
        </div>

        <!-- Botón para ejecutar la acción de guardar -->
        <button type="submit" class="btn btn-primary">Subir y Procesar</button>
        <button type="button" class="btn btn-secondary" onclick="window.history.back();">Atrás</button>
    </form>

    <!-- Sección para mostrar los resultados -->
    <div id="result" class="mt-4"></div>

    <!-- Formulario para cargar archivos después del procesamiento del Excel -->
    <div id="fileUploadSection" class="mt-4" style="display: none;">
        <h2>Cargar Archivos para Radicados</h2>
        <form id="fileUploadForm" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="radicados" class="form-label">Seleccionar Radicados</label>
                <div id="radicadoList">
                    <!-- Opciones se llenarán dinámicamente con los radicados -->
                </div>
            </div>
            <div class="mb-3">
                <label for="files" class="form-label">Cargar Archivos</label>
                <input type="file" name="files[]" id="files" class="form-control" multiple required>
            </div>
            <button type="submit" class="btn btn-primary">Subir Archivos</button>
            <button type="button" id="autoProcess" class="btn btn-success">Procesar Automáticamente</button>
        </form>
    </div>
</div>

<script>
$(document).ready(function() {
    // Enviar el formulario para procesar el Excel
    $('#uploadForm').on('submit', function(e) {
        e.preventDefault();
        
        var formData = new FormData(this);

        $.ajax({
            url: '../../../peticiones/procesar_excel.php',  // Cambia el archivo a donde se procesará la lógica
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                $('#result').html(response);  // Mostrar respuesta del servidor

                // Si hay radicados insertados, mostrar el formulario de carga de archivos
                if (response.includes("Radicado")) {
                    $('#fileUploadSection').show();

                    // Llenar la lista de checkboxes con los radicados insertados
                    var radicados = response.match(/Radicado con número (\d+)/g);
                    $('#radicadoList').empty();
                    radicados.forEach(function(radicado) {
                        var radicadoNumber = radicado.match(/\d+/)[0];
                        $('#radicadoList').append('<div><input type="checkbox" name="radicado[]" value="' + radicadoNumber + '"> ' + radicadoNumber + '</div>');
                    });
                }
            }
        });
    });

    // Subir archivos para el radicado seleccionado
    $('#fileUploadForm').on('submit', function(e) {
        e.preventDefault();
        
        var formData = new FormData(this);

        $.ajax({
            url: '../../../peticiones/cargar_archivos.php',  // Archivo PHP para procesar la carga de archivos
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                alert(response);  // Mostrar mensaje de éxito o error
            }
        });
    });

    // Procesar archivos automáticamente para los radicados seleccionados
    $('#autoProcess').on('click', function() {
        var radicados = $('input[name="radicado[]"]:checked').map(function() {
            return $(this).val();
        }).get();

        if (radicados.length === 0) {
            alert('Por favor seleccione al menos un radicado.');
            return;
        }

        var formData = new FormData($('#fileUploadForm')[0]);

        // Procesar cada radicado seleccionado
        radicados.forEach(function(radicado) {
            formData.append('radicado', radicado);

            $.ajax({
                url: '../../../peticiones/cargar_archivos.php',  // Archivo PHP para procesar la carga de archivos
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log('Archivos subidos para radicado ' + radicado + ': ' + response);
                }
            });
        });

        alert('Todos los archivos han sido subidos automáticamente.');
    });
});
</script>

<?php include('../../../templates/footeradmin.php'); ?>
