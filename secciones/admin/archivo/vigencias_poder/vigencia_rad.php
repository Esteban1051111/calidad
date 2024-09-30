<?php
require_once '../../../../peticiones/verificar_sesion.php';
include('../../../../templates/headeradmin.php');
?>

<div class="container">
        <h2 class="text-center mb-4">Generar Vigencia de Poder</h2>
        <div class="row">
            <!-- Sección del formulario a la izquierda -->
            <div class="col-md-6">
                <form action="exportar_vigencia_pdf.php" method="post" id="vigenciaForm">
                    <div class="form-section">
                        <h5>QUIÉN DA EL PODER</h5>
                        <div class="form-row">
                            <div class="form-group col-md-10">
                                <label for="otorgante">Nombre del Otorgante:</label>
                                <input type="text" class="form-control" id="otorgante" name="otorgante" oninput="updatePreview()" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-section">
                        <h5>QUIÉN LO RECIBE</h5>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="apoderado">Nombre del Apoderado:</label>
                                <input type="text" class="form-control" id="apoderado" name="apoderado" oninput="updatePreview()" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-section">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="fecha_otorgamiento">Fecha de Otorgamiento:</label>
                                <input type="date" class="form-control" id="fecha_otorgamiento" name="fecha_otorgamiento" oninput="updatePreview()" required>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="vigencia">Vigencia del Poder:</label>
                                <input type="text" class="form-control" id="vigencia" name="vigencia" placeholder="Ej. Indefinida, 1 año, etc." oninput="updatePreview()" required>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="notaria">Notaría:</label>
                                <input type="text" class="form-control" id="notaria" name="notaria" oninput="updatePreview()" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="observaciones">Observaciones:</label>
                                <textarea class="form-control" id="observaciones" name="observaciones" rows="4" oninput="updatePreview()"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="btn-container">
                        <button type="submit" class="btn btn-secondary">Exportar PDF</button>
                    </div>
                </form>
            </div>

            <!-- Sección de vista previa a la derecha -->
            <div class="col-md-6">
                <h3>Vista Previa del Certificado de Vigencia</h3>
                <div id="preview">
                    <p><strong>CERTIFICADO DE VIGENCIA NÚMERO 1873</strong></p>
                    <p>EL SUSCRITO NOTARIO .</p>
                    <p>CERTIFICA:</p>
                    <p>Que el Poder General, contenido en la escritura pública número <span id="previewVigencia">______</span>
                        del <span id="previewFecha">______</span>, otorgado en esta notaría, por medio del cual la señora
                        <span id="previewOtorgante">______</span> confirió poder general amplio y suficiente a la señora
                        <span id="previewApoderado">______</span>,
                        no aparece revocado en el protocolo de esta Notaría y, por lo tanto, se encuentra vigente hasta la fecha.</p>
                    <p><span id="previewObservaciones">______</span></p>
                    <p>Para constancia se firma en Manizales a los <span id="previewDia"><?php echo date("d"); ?></span> días del mes de <span id="previewMes"><?php echo date("F"); ?></span> de <span id="previewAno"><?php echo date("Y"); ?></span>, siendo las <span id="previewHora"><?php echo date("g:i a"); ?></span>.</p>
                    <p>FIRMA NOTARIO<br>Departamento </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        function updatePreview() {
            document.getElementById('previewOtorgante').innerText = document.getElementById('otorgante').value || '______';
            document.getElementById('previewApoderado').innerText = document.getElementById('apoderado').value || '______';
            document.getElementById('previewFecha').innerText = document.getElementById('fecha_otorgamiento').value || '______';
            document.getElementById('previewVigencia').innerText = document.getElementById('vigencia').value || '______';
            document.getElementById('previewObservaciones').innerText = document.getElementById('observaciones').value || '______';
        }
    </script>

    <!-- Optional JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<?php include('../../../../templates/footeradmin.php'); ?>
