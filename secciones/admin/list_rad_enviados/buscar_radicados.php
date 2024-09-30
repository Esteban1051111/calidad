<?php
include('../../../peticiones/buscar_radicados_controller.php'); 

if (isset($_GET['numRadicado'])) {
    $numRadicado = $_GET['numRadicado'];

    // Obtener los detalles del radicado
    $radicados = obtenerRadicadoPorNumero($numRadicado);

    if ($radicados) {
        // Asignar los nombres a los intervinientes
        $intervinientes = [
            "PRIMER INTERVINIENTE" => 0,
            "SEGUNDO INTERVINIENTE" => 1,
            "SEGUNDO INTERVINIENTE COMPRADOR 2" => 2,
            "TERCER INTERVINIENTE" => 3
        ];

        echo '<style>
                .nav-link {
                    color: #000 !important; /* Cambia el color del texto a negro */
                    font-weight: bold !important; /* Hace el texto en negrita */
                }
                .nav-link.active {
                    color: #000 !important; /* Cambia el color del texto activo a negro */
                }
              </style>';

        echo '<form method="post" action="actualizar_radicado.php" class="container mt-4">';
        echo '<input type="hidden" name="numRadicado" value="' . htmlspecialchars($numRadicado) . '">';
        echo '<div class="card">';
        echo '<div class="card-header">';
        echo '<ul class="nav nav-tabs" id="myTab" role="tablist">';

        // Generar tabs para cada interviniente y el detalle del radicado
        echo '<li class="nav-item" role="presentation">
                <a class="nav-link active" id="detalle-tab" data-bs-toggle="tab" href="#detalle" role="tab" aria-controls="detalle" aria-selected="true">DETALLE DEL RADICADO</a>
              </li>';
        foreach ($intervinientes as $nombre => $index) {
            echo '<li class="nav-item" role="presentation">
                    <a class="nav-link" id="interviniente' . $index . '-tab" data-bs-toggle="tab" href="#interviniente' . $index . '" role="tab" aria-controls="interviniente' . $index . '" aria-selected="false">' . $nombre . '</a>
                  </li>';
        }

        echo '</ul>';
        echo '</div>';
        echo '<div class="card-body">';
        echo '<div class="tab-content" id="myTabContent">';

        // Contenido para el detalle del radicado
        echo '<div class="tab-pane fade show active" id="detalle" role="tabpanel" aria-labelledby="detalle-tab">';
        echo '<div class="row mb-3 border-bottom pb-2">';
        echo '<label class="col-sm-3 col-form-label">Número de Radicado</label>';
        echo '<div class="col-sm-9">';
        echo '<input type="text" class="form-control" value="' . htmlspecialchars($radicados[0]['NUM_RADICADO']) . '" readonly>';
        echo '</div>';
        echo '</div>';
        echo '<div class="row mb-3 border-bottom pb-2">';
        echo '<label class="col-sm-3 col-form-label">Acto Notarial</label>';
        echo '<div class="col-sm-9">';
        echo '<input type="text" class="form-control" value="' . htmlspecialchars($radicados[0]['ACTO_NOTARIAL']) . '"readonly >';
        echo '</div>';
        echo '</div>';
        echo '<div class="row mb-3 border-bottom pb-2">';
        echo '<label class="col-sm-3 col-form-label">Número de Matrícula</label>';
        echo '<div class="col-sm-9">';
        echo '<input type="text" class="form-control" value="' . htmlspecialchars($radicados[0]['FOLIO_NUM_MATRICULA']) . '" >';
        echo '</div>';
        echo '</div>';
        echo '<div class="row mb-3 border-bottom pb-2">';
        echo '<label class="col-sm-3 col-form-label">Proyecto</label>';
        echo '<div class="col-sm-9">';
        echo '<input type="text" class="form-control" value="' . htmlspecialchars($radicados[0]['PROYECTO']) . '" >';
        echo '</div>';
        echo '</div>';
        echo '<div class="row mb-3 border-bottom pb-2">';
        echo '<label class="col-sm-3 col-form-label">Observaciones</label>';
        echo '<div class="col-sm-9">';
        echo '<input type="text" class="form-control" value="' . htmlspecialchars($radicados[0]['OBSERVACIONES']) . '" >';
        echo '</div>';
        echo '</div>';
        echo '<div class="row mb-3 border-bottom pb-2">';
        echo '<label class="col-sm-3 col-form-label">Usuario Radicó</label>';
        echo '<div class="col-sm-9">';
        echo '<input type="text" class="form-control" value="' . htmlspecialchars($radicados[0]['USUARIO_RADICO']) . '" readonly>';
        echo '</div>';
        echo '</div>';
        echo '</div>'; 
        

        // Contenido para los intervinientes
        foreach ($intervinientes as $nombre => $index) {
            echo '<div class="tab-pane fade" id="interviniente' . $index . '" role="tabpanel" aria-labelledby="interviniente' . $index . '-tab">';
            if (isset($radicados[$index])) {
                echo '<div class="row mb-3 border-bottom pb-2">';
                echo '<label class="col-sm-3 col-form-label">Nombre</label>';
                echo '<div class="col-sm-9">';
                echo '<input type="text" class="form-control" name="interviniente' . $index . '_nombres" value="' . htmlspecialchars($radicados[$index]['INTERVINIENTE_NOMBRES']) . '">';
                echo '</div>';
                echo '</div>';
                echo '<div class="row mb-3 border-bottom pb-2">';
                echo '<label class="col-sm-3 col-form-label">Apellidos</label>';
                echo '<div class="col-sm-9">';
                echo '<input type="text" class="form-control" name="interviniente' . $index . '_apellidos" value="' . htmlspecialchars($radicados[$index]['INTERVINIENTE_APELLIDOS']) . '">';
                echo '</div>';
                echo '</div>';
                echo '<div class="row mb-3 border-bottom pb-2">';
                echo '<label class="col-sm-3 col-form-label">Tipo</label>';
                echo '<div class="col-sm-9">';
                echo '<input type="text" class="form-control" name="interviniente' . $index . '_tipo" value="' . htmlspecialchars($radicados[$index]['INTERVINIENTE_TIPO']) . '">';
                echo '</div>';
                echo '</div>';
                echo '<div class="row mb-3 border-bottom pb-2">';
                echo '<label class="col-sm-3 col-form-label">Número de Identidad</label>';
                echo '<div class="col-sm-9">';
                echo '<input type="text" class="form-control" name="interviniente' . $index . '_num_identidad" value="' . htmlspecialchars($radicados[$index]['INTERVINIENTE_NUM_IDENTI']) . '">';
                echo '</div>';
                echo '</div>';
                echo '<div class="row mb-3 border-bottom pb-2">';
                echo '<label class="col-sm-3 col-form-label">Teléfono</label>';
                echo '<div class="col-sm-9">';
                echo '<input type="text" class="form-control" name="interviniente' . $index . '_telefono" value="' . htmlspecialchars($radicados[$index]['INTERVINIENTE_TELEFONO']) . '">';
                echo '</div>';
                echo '</div>';
                echo '<div class="row mb-3 border-bottom pb-2">';
                echo '<label class="col-sm-3 col-form-label">Actividad Económica</label>';
                echo '<div class="col-sm-9">';
                echo '<input type="text" class="form-control" name="interviniente' . $index . '_actividad_economica" value="' . htmlspecialchars($radicados[$index]['INTERVINIENTE_ACTIVIDAD_ECONOMICA']) . '">';
                echo '</div>';
                echo '</div>';
                echo '<div class="row mb-3 border-bottom pb-2">';
                echo '<label class="col-sm-3 col-form-label">Dirección</label>';
                echo '<div class="col-sm-9">';
                echo '<input type="text" class="form-control" name="interviniente' . $index . '_direccion" value="' . htmlspecialchars($radicados[$index]['INTERVINIENTE_DIRECCION']) . '">';
                echo '</div>';
                echo '</div>';
                echo '<div class="row mb-3 border-bottom pb-2">';
                echo '<label class="col-sm-3 col-form-label">Correo Electrónico</label>';
                echo '<div class="col-sm-9">';
                echo '<input type="text" class="form-control" name="interviniente' . $index . '_correo_electronico" value="' . htmlspecialchars($radicados[$index]['INTERVINIENTE_CORREO_ELECTRONICO']) . '">';
                echo '</div>';
                echo '</div>';
                //apoderados
                 
                echo '<h2 style="color: #4CAF50; font-family: Arial, sans-serif; font-size: 24px; font-weight: bold; text-align: center; margin-bottom: 20px;">APODERADO</h2>';
                echo '<div class="row mb-3 border-bottom pb-2">';
                echo '<label class="col-sm-3 col-form-label">Nombres apoderado</label>';
                echo '<div class="col-sm-9">';
                echo '<input type="text" class="form-control" name="interviniente' . $index . '_APODERADO_NOMBRES" value="' . htmlspecialchars($radicados[$index]['APODERADO_NOMBRES']) . '">';
                echo '</div>';
                echo '</div>';
                
                echo '<div class="row mb-3 border-bottom pb-2">';
                echo '<label class="col-sm-3 col-form-label">Apellidos apoderado</label>';
                echo '<div class="col-sm-9">';
                echo '<input type="text" class="form-control" name="interviniente' . $index . '_APODERADO_APELLIDOS" value="' . htmlspecialchars($radicados[$index]['APODERADO_APELLIDOS']) . '">';
                echo '</div>';
                echo '</div>';
                
                echo '<div class="row mb-3 border-bottom pb-2">';
                echo '<label class="col-sm-3 col-form-label">Tipo de documento apoderado</label>';
                echo '<div class="col-sm-9">';
                echo '<input type="text" class="form-control" name="interviniente' . $index . '_APODERADO_TIPO" value="' . htmlspecialchars($radicados[$index]['APODERADO_TIPO']) . '">';
                echo '</div>';
                echo '</div>';
                
                echo '<div class="row mb-3 border-bottom pb-2">';
                echo '<label class="col-sm-3 col-form-label">Número de identificación apoderado</label>';
                echo '<div class="col-sm-9">';
                echo '<input type="text" class="form-control" name="interviniente' . $index . '_APODERADO_NUM_IDENTI" value="' . htmlspecialchars($radicados[$index]['APODERADO_NUM_IDENTI']) . '">';
                echo '</div>';
                echo '</div>';
                
                echo '<div class="row mb-3 border-bottom pb-2">';
                echo '<label class="col-sm-3 col-form-label">Teléfono apoderado</label>';
                echo '<div class="col-sm-9">';
                echo '<input type="text" class="form-control" name="interviniente' . $index . '_APODERADO_TELEFONO" value="' . htmlspecialchars($radicados[$index]['APODERADO_TELEFONO']) . '">';
                echo '</div>';
                echo '</div>';
                
                echo '<div class="row mb-3 border-bottom pb-2">';
                echo '<label class="col-sm-3 col-form-label">Actividad económica apoderado</label>';
                echo '<div class="col-sm-9">';
                echo '<input type="text" class="form-control" name="interviniente' . $index . '_APODERADO_ACTIVIDAD_ECONOMICA" value="' . htmlspecialchars($radicados[$index]['APODERADO_ACTIVIDAD_ECONOMICA']) . '">';
                echo '</div>';
                echo '</div>';
                
                echo '<div class="row mb-3 border-bottom pb-2">';
                echo '<label class="col-sm-3 col-form-label">Dirección apoderado</label>';
                echo '<div class="col-sm-9">';
                echo '<input type="text" class="form-control" name="interviniente' . $index . '_APODERADO_DIRECCION" value="' . htmlspecialchars($radicados[$index]['APODERADO_DIRECCION']) . '">';
                echo '</div>';
                echo '</div>';
                
                echo '<div class="row mb-3 border-bottom pb-2">';
                echo '<label class="col-sm-3 col-form-label">Correo electrónico apoderado</label>';
                echo '<div class="col-sm-9">';
                echo '<input type="text" class="form-control" name="interviniente' . $index . '_APODERADO_CORREO_ELECTRONICO" value="' . htmlspecialchars($radicados[$index]['APODERADO_CORREO_ELECTRONICO']) . '">';
                echo '</div>';
                echo '</div>';
                
            } else {
                echo '<p>No se encontraron datos para este interviniente.</p>';
            }
            echo '</div>'; // Cierra tab-pane
        }

        echo '</div>'; // Cierra tab-content
        echo '<div class="card-footer">';
        echo '<button type="submit" class="btn btn-primary">Actualizar</button>';
        echo '</div>'; // Cierra card-footer
        echo '</div>'; // Cierra card
        echo '</form>';
        
    } else {
        echo '<div class="alert alert-danger" role="alert">Número de radicado no proporcionado.</div>';
    }
} else {
    echo '<div class="alert alert-danger" role="alert">Número de radicado no proporcionado.</div>';
}
?>
