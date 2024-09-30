<?php
include('../../../peticiones/Cconexion.php');

function actualizarRadicado($data) {
    $conn = Cconexion::conexionBD();

    if ($conn) {
        try {
            // Actualizar los datos del radicado
            $sqlRadicado = "UPDATE radicados 
                            SET ACTO_NOTARIAL = :acto_notarial, 
                                NUM_MATRICULA = :num_matricula, 
                                PROYECTO = :proyecto, 
                                OBSERVACIONES = :observaciones, 
                                USUARIO_RADICO = :usuario_radico 
                            WHERE NUM_RADICADO = :num_radicado";
            $stmtRadicado = $conn->prepare($sqlRadicado);

            // Asignar los valores a los parámetros
            $stmtRadicado->bindParam(':acto_notarial', $data['acto_notarial']);
            $stmtRadicado->bindParam(':num_matricula', $data['num_matricula']);
            $stmtRadicado->bindParam(':proyecto', $data['proyecto']);
            $stmtRadicado->bindParam(':observaciones', $data['observaciones']);
            $stmtRadicado->bindParam(':usuario_radico', $data['usuario_radico']);
            $stmtRadicado->bindParam(':num_radicado', $data['num_radicado']);

            // Ejecutar la consulta de actualización del radicado
            $stmtRadicado->execute();

            // Actualizar los datos de los intervinientes
            foreach ($data['intervinientes'] as $index => $interviniente) {
                $sqlInterviniente = "UPDATE intervinientes 
                                     SET INTERVINIENTE_NOMBRES = :nombres, 
                                         INTERVINIENTE_APELLIDOS = :apellidos, 
                                         INTERVINIENTE_TIPO = :tipo, 
                                         INTERVINIENTE_NUM_IDENTI = :num_identidad, 
                                         INTERVINIENTE_TELEFONO = :telefono, 
                                         INTERVINIENTE_ACTIVIDAD_ECONOMICA = :actividad_economica, 
                                         INTERVINIENTE_DIRECCION = :direccion, 
                                         INTERVINIENTE_CORREO_ELECTRONICO = :correo_electronico 
                                     WHERE NUM_RADICADO = :num_radicado AND INTERVINIENTE_ID = :interviniente_id";
                $stmtInterviniente = $conn->prepare($sqlInterviniente);

                // Asignar los valores a los parámetros
                $stmtInterviniente->bindParam(':nombres', $interviniente['nombres']);
                $stmtInterviniente->bindParam(':apellidos', $interviniente['apellidos']);
                $stmtInterviniente->bindParam(':tipo', $interviniente['tipo']);
                $stmtInterviniente->bindParam(':num_identidad', $interviniente['num_identidad']);
                $stmtInterviniente->bindParam(':telefono', $interviniente['telefono']);
                $stmtInterviniente->bindParam(':actividad_economica', $interviniente['actividad_economica']);
                $stmtInterviniente->bindParam(':direccion', $interviniente['direccion']);
                $stmtInterviniente->bindParam(':correo_electronico', $interviniente['correo_electronico']);
                $stmtInterviniente->bindParam(':num_radicado', $data['num_radicado']);
                $stmtInterviniente->bindParam(':interviniente_id', $index);

                // Ejecutar la consulta de actualización del interviniente
                $stmtInterviniente->execute();
            }

            echo "Actualización exitosa.";
        } catch (PDOException $e) {
            echo "Error al actualizar: " . $e->getMessage();
        }
    } else {
        echo "Error en la conexión.";
    }
}

// Verificar si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recoger datos del formulario
    $data = [
        'num_radicado' => $_POST['num_radicado'],
        'acto_notarial' => $_POST['acto_notarial'],
        'num_matricula' => $_POST['num_matricula'],
        'proyecto' => $_POST['proyecto'],
        'observaciones' => $_POST['observaciones'],
        'usuario_radico' => $_POST['usuario_radico'],
        'intervinientes' => [
            0 => [
                'nombres' => $_POST['interviniente0_nombres'],
                'apellidos' => $_POST['interviniente0_apellidos'],
                'tipo' => $_POST['interviniente0_tipo'],
                'num_identidad' => $_POST['interviniente0_num_identidad'],
                'telefono' => $_POST['interviniente0_telefono'],
                'actividad_economica' => $_POST['interviniente0_actividad_economica'],
                'direccion' => $_POST['interviniente0_direccion'],
                'correo_electronico' => $_POST['interviniente0_correo_electronico']
            ],
            1 => [
                'nombres' => $_POST['interviniente1_nombres'],
                'apellidos' => $_POST['interviniente1_apellidos'],
                'tipo' => $_POST['interviniente1_tipo'],
                'num_identidad' => $_POST['interviniente1_num_identidad'],
                'telefono' => $_POST['interviniente1_telefono'],
                'actividad_economica' => $_POST['interviniente1_actividad_economica'],
                'direccion' => $_POST['interviniente1_direccion'],
                'correo_electronico' => $_POST['interviniente1_correo_electronico']
            ],
            2 => [
                'nombres' => $_POST['interviniente2_nombres'],
                'apellidos' => $_POST['interviniente2_apellidos'],
                'tipo' => $_POST['interviniente2_tipo'],
                'num_identidad' => $_POST['interviniente2_num_identidad'],
                'telefono' => $_POST['interviniente2_telefono'],
                'actividad_economica' => $_POST['interviniente2_actividad_economica'],
                'direccion' => $_POST['interviniente2_direccion'],
                'correo_electronico' => $_POST['interviniente2_correo_electronico']
            ],
            3 => [
                'nombres' => $_POST['interviniente3_nombres'],
                'apellidos' => $_POST['interviniente3_apellidos'],
                'tipo' => $_POST['interviniente3_tipo'],
                'num_identidad' => $_POST['interviniente3_num_identidad'],
                'telefono' => $_POST['interviniente3_telefono'],
                'actividad_economica' => $_POST['interviniente3_actividad_economica'],
                'direccion' => $_POST['interviniente3_direccion'],
                'correo_electronico' => $_POST['interviniente3_correo_electronico']
            ]
        ]
    ];

    // Llamar a la función para actualizar el radicado
    actualizarRadicado($data);
}
?>
