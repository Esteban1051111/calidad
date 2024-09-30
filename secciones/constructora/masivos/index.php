<?php
$url_base=""?>
<?php include('../../../templates/headerconstructora.php')?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<div class="container mt-5">
    <h1 class="mb-4">Subir y Leer Excel</h1>
    <form id="uploadForm" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="file" class="form-label">Proyecto Masivo</label>
            <input type="file" name="file" id="file" class="form-control" accept=".xls,.xlsx" required>
        </div>
        <button type="submit" class="btn btn-primary">Subir y Procesar</button>
    </form>
    <div id="result" class="mt-4"></div>
</div>

<script>
$(document).ready(function() {
    $('#uploadForm').on('submit', function(e) {
        e.preventDefault();
        
        var formData = new FormData(this);

        $.ajax({
            url: '../../../peticiones/upload.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                $('#result').html(response);
            }
        });
    });
});
</script>





<?php include('../../../templates/footerconstructora.php')?>
