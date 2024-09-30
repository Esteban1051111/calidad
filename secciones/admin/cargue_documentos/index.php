<?php $url_base = "" ?>
<?php include('../../../templates/headeradmin.php') ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<div class="container mt-5">
    <h1 class="mb-4">Buscar Folio Matricula y Agregar Documentos</h1>

    <!-- Formulario para ingresar el número de radicado -->
    <form id="searchFolioForm">
        <div class="mb-3">
            <label for="folio_matricula" class="form-label">Folio de Matrícula</label>
            <input type="text" id="folio_matricula" name="folio_matricula" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Buscar Folio</button>
    </form>


    <!-- Formulario para agregar más documentos -->
    <div id="fileUploadSection" class="mt-4" style="display: none;">
        <h2>Agregar Documentos</h2>
        <form id="fileUploadForm" enctype="multipart/form-data">
            <input type="hidden" id="folio_matricula" name="folio_matricula"> <!-- Campo oculto para almacenar el folio de matrícula -->
            <div class="mb-3">
                <label for="files" class="form-label">Cargar Archivos</label>
                <input type="file" name="files[]" id="files" class="form-control" multiple required>
            </div>
            <button type="submit" class="btn btn-primary">Subir Archivos</button>
        </form>
    </div>


    <!-- Sección para mostrar resultados -->
    <div id="result" class="mt-4"></div>
</div>

<script>
    $('#searchFolioForm').on('submit', function(e) {
        e.preventDefault();

        var folio = $('#folio_matricula').val();

        $.ajax({
            url: '../../../peticiones/buscar_fol_cargue_doc.php', // Archivo PHP para buscar el folio en la base de datos
            type: 'POST',
            data: {
                folio_matricula: folio
            },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    $('#fileUploadSection').show(); // Mostrar la sección para subir archivos
                    $('#radicado_id').val(response.radicado); // Almacenar el ID del radicado en el formulario de subida
                    $('#result').html('<div class="alert alert-success">Folio encontrado. Puedes agregar más documentos.</div>');
                    // Mostrar archivos cargados
                    var archivosHTML = '<h3>Archivos Cargados:</h3><ul>';
                    response.archivos.forEach(function(archivo) {
                        archivosHTML += '<li><a href="' + archivo.ruta_archivo + '" target="_blank">' + archivo.nombre_archivo + '</a></li>';
                    });
                    archivosHTML += '</ul>';
                    $('#result').append(archivosHTML); // Mostrar la lista de archivos cargados
                } else {
                    $('#result').html('<div class="alert alert-danger">Folio no encontrado.</div>');
                    $('#fileUploadSection').hide();
                }
            }
        });


        // Enviar el formulario para subir archivos
        $('#fileUploadForm').on('submit', function(e) {
            e.preventDefault();

            var formData = new FormData(this);

            $.ajax({
                url: '../../../peticiones/agregar_documentos.php', // Archivo PHP para procesar la carga de documentos
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(response) {
                    alert(response.message);
                    if (response.success) {
                        $('#files').val(''); // Limpiar el input de archivos tras la subida
                    }
                }
            });
        });
    });
</script>

<?php include('../../../templates/footeradmin.php'); ?>