<?php

require_once '../conexion.php';

// Verificar si la sesión no está activa antes de iniciarla nuevamente
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['usuario'])) {
    header('Location: http://localhost/BotPlussFB/login.php');
    exit();
}

$conn = Cconexion::conexionBD();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Función para actualizar el puntaje del digitador
    function actualizarPuntajeDigitador($conn, $digitadorId)
    {
        $sql = "UPDATE usuarios SET puntaje = puntaje + 1 WHERE id_usuario= ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$digitadorId]);
    }

    // Verificar si el número de radicado fue pasado por la URL
    if (isset($_POST['num_radicado'])) {
        $num_radicado = $_POST['num_radicado'];
        $num_radicado = $_POST['num_radicado'];
    } else {
        echo "Número de radicado no proporcionado.";
        exit();
    }

    // Obtén el ID del digitador del formulario
    $digitador_id = $_POST['digitador_id'];

    // Manejo de archivos cargados
    $uploadDirectory = 'C:\Users\Holli\OneDrive\Escritorio\ARCHIVOS_RADICADOS'; // Directorio donde se guardarán los archivos

    $files = $_FILES['documentos'];

    $uploadedFiles = []; // Array para almacenar las rutas de los archivos subidos
    $allowedTypes = [
        'image/jpeg',           // JPEG images
        'image/png',            // PNG images
        'image/gif',            // GIF images
        'image/webp',           // WEBP images
        'application/pdf',     // PDF documents
        'text/plain',          // Plain text files
        'text/csv',            // CSV files
        'application/zip',     // ZIP files
        'application/x-rar-compressed', // RAR files
        'application/msword',  // Microsoft Word documents (DOC)
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document', // Microsoft Word documents (DOCX)
        'application/vnd.ms-excel', // Microsoft Excel documents (XLS)
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', // Microsoft Excel documents (XLSX)
        'audio/mpeg',          // MP3 audio files
        'audio/wav',           // WAV audio files
        'video/mp4',           // MP4 video files
        'video/x-msvideo',     // AVI video files
        'video/x-matroska',    // MKV video files
    ];


    for ($i = 0; $i < count($files['name']); $i++) {
        $fileName = $files['name'][$i];
        $fileTmpName = $files['tmp_name'][$i];
        $fileSize = $files['size'][$i];
        $fileError = $files['error'][$i];
        $fileType = $files['type'][$i];

        // Generar el nuevo nombre del archivo con el número de radicado
        $fileNewName = $num_radicado . "-" . $fileName;
        $fileDestination = $uploadDirectory . $fileNewName;


        // Mover el archivo al directorio de destino
        if (move_uploaded_file($fileTmpName, $fileDestination)) {
            $query = "INSERT INTO archivos (num_radicado, nombre_archivo, ruta_archivo) VALUES (:num_radicado, :nombre_archivo, :ruta_archivo)";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':num_radicado', $num_radicado);
            $stmt->bindParam(':nombre_archivo', $fileNewName);
            $stmt->bindParam(':ruta_archivo', $fileDestination);
            $stmt->execute();

            echo "El archivo $fileName se ha cargado correctamente.<br>";
        } else {
            echo "Error al cargar el archivo $fileName.<br>";
        }
    }






    //-------------DATOS RADICACION EN LINEA----------------
    //$num_radicado = $_POST['num_radicado'];
    $acto_notarial = $_POST['acto_notarial'];
    $matriculas = $_POST['matriculas'];
    $proyecto = $_POST['proyecto'] ?? null;
    $observaciones = $_POST['observaciones'] ?? null;
    $usuario_radico = $_SESSION['usuario']; // Obtener el usuario de la sesión

    //-------------DATOS DEL PRIMER INTERVINIENTE----------------
    $nombres_p_interviniente = $_POST['NOMBRES_P_INTERVINIENTE'] ?? null;
    $apellidos_p_interviniente = $_POST['APELLIDOS_P_INTERVINIENTE'] ?? null;
    $tipo_p_interviniente = $_POST['TIPO_P_INTERVINIENTE'] ?? null;
    $num_identi_p_interviniente = $_POST['NUM_IDENTI_P_INTERVINIENTE'] ?? null;
    $telefono_p_interviniente = $_POST['TELEFONO_P_INTERVINIENTE'] ?? null;
    $actividad_economica_p_interviniente = $_POST['ACTIVIDAD_ECONOMICA_P_INTERVINIENTE'] ?? null;
    $direccion_p_interviniente = $_POST['DIRECCION_P_INTERVINIENTE'] ?? null;
    $correo_electronico_p_interviniente = $_POST['CORREO_ELECTRONICO_P_INTERVINIENTE'] ?? null;
    $tipo_interviniente = 'PRIMER INTERVINIENTE'; // Ajusta según sea necesario

    //-------------DATOS DEL PRIMER INTERVINIENTE APODERADO----------------
    $nombres_apoderado = $_POST['NOMBRES_P_INTERVINIENTE_APODERADO'] ?? null;
    $apellidos_apoderado = $_POST['APELLIDOS_P_INTERVINIENTE_APODERADO'] ?? null;
    $tipo_apoderado = $_POST['TIPO_P_INTERVINIENTE_APODERADO'] ?? null;
    $num_identi_apoderado = $_POST['NUM_IDENTI_P_INTERVINIENTE_APODERADO'] ?? null;
    $telefono_apoderado = $_POST['TELEFONO_P_INTERVINIENTE_APODERADO'] ?? null;
    $actividad_economica_apoderado = $_POST['ACTIVIDAD_ECONOMICA_P_INTERVINIENTE_APODERADO'] ?? null;
    $direccion_apoderado = $_POST['DIRECCION_P_INTERVINIENTE_APODERADO'] ?? null;
    $correo_electronico_apoderado = $_POST['CORREO_ELECTRONICO_P_INTERVINIENTE_APODERADO'] ?? null;

    //-------------DATOS DEL SEGUNDO INTERVINIENTE----------------
    $nombres_s_interviniente = $_POST['NOMBRES_S_INTERVINIENTE'] ?? null;
    $apellidos_s_interviniente = $_POST['APELLIDOS_S_INTERVINIENTE'] ?? null;
    $tipo_s_interviniente = $_POST['TIPO_S_INTERVINIENTE'] ?? null;
    $num_identi_s_interviniente = $_POST['NUM_IDENTI_S_INTERVINIENTE'] ?? null;
    $telefono_s_interviniente = $_POST['TELEFONO_S_INTERVINIENTE'] ?? null;
    $actividad_economica_s_interviniente = $_POST['ACTIVIDAD_ECONOMICA_S_INTERVINIENTE'] ?? null;
    $direccion_s_interviniente = $_POST['DIRECCION_S_INTERVINIENTE'] ?? null;
    $correo_electronico_s_interviniente = $_POST['CORREO_ELECTRONICO_S_INTERVINIENTE'] ?? null;
    $tipo_interviniente2 = 'SEGUNDO INTERVINIENTE';

    //-------------DATOS DEL SEGUNDO INTERVINIENTE APODERADO----------------
    $nombres_s_interviniente_apoderado = $_POST['NOMBRES_S_INTERVINIENTE_APODERADO'] ?? null;
    $apellidos_s_interviniente_apoderado = $_POST['APELLIDOS_S_INTERVINIENTE_APODERADO'] ?? null;
    $tipo_s_interviniente_apoderado = $_POST['TIPO_S_INTERVINIENTE_APODERADO'] ?? null;
    $num_identi_s_interviniente_apoderado = $_POST['NUM_IDENTI_S_INTERVINIENTE_APODERADO'] ?? null;
    $telefono_s_interviniente_apoderado = $_POST['TELEFONO_S_INTERVINIENTE_APODERADO'] ?? null;
    $actividad_economica_s_interviniente_apoderado = $_POST['ACTIVIDAD_ECONOMICA_S_INTERVINIENTE_APODERADO'] ?? null;
    $direccion_s_interviniente_apoderado = $_POST['DIRECCION_S_INTERVINIENTE_APODERADO'] ?? null;
    $correo_electronico_s_interviniente_apoderado = $_POST['CORREO_ELECTRONICO_S_INTERVINIENTE_APODERADO'] ?? null;

    //-------------DATOS DEL SEGUNDO INTERVINIENTE COMPRADOR 2----------------
    $nombres_s_interviniente_c2 = $_POST['NOMBRES_S_INTERVINIENTE_C2'] ?? null;
    $apellidos_s_interviniente_c2 = $_POST['APELLIDOS_S_INTERVINIENTE_C2'] ?? null;
    $tipo_s_interviniente_c2 = $_POST['TIPO_S_INTERVINIENTE_C2'] ?? null;
    $num_identi_s_interviniente_c2 = $_POST['NUM_IDENTI_S_INTERVINIENTE_C2'] ?? null;
    $telefono_s_interviniente_c2 = $_POST['TELEFONO_S_INTERVINIENTE_C2'] ?? null;
    $actividad_economica_s_interviniente_c2 = $_POST['ACTIVIDAD_ECONOMICA_S_INTERVINIENTE_C2'] ?? null;
    $direccion_s_interviniente_c2 = $_POST['DIRECCION_S_INTERVINIENTE_C2'] ?? null;
    $correo_electronico_s_interviniente_c2 = $_POST['CORREO_ELECTRONICO_S_INTERVINIENTE_C2'] ?? null;
    $tipo_interviniente_c2 = 'SEGUNDO INTERVINIENTE COMPRADOR 2';

    //-------------DATOS DEL SEGUNDO INTERVINIENTE COMPRADOR 2 APODERADO----------------
    $nombres_s_interviniente_apoderado_c2 = $_POST['NOMBRES_S_INTERVINIENTE_APODERADO_C2'] ?? null;
    $apellidos_s_interviniente_apoderado_c2 = $_POST['APELLIDOS_S_INTERVINIENTE_APODERADO_C2'] ?? null;
    $tipo_s_interviniente_apoderado_c2 = $_POST['TIPO_S_INTERVINIENTE_APODERADO_C2'] ?? null;
    $num_identi_s_interviniente_apoderado_c2 = $_POST['NUM_IDENTI_S_INTERVINIENTE_APODERADO_C2'] ?? null;
    $telefono_s_interviniente_apoderado_c2 = $_POST['TELEFONO_S_INTERVINIENTE_APODERADO_C2'] ?? null;
    $direccion_s_interviniente_apoderado_c2 = $_POST['DIRECCION_S_INTERVINIENTE_APODERADO_C2'] ?? null;
    $correo_electronico_s_interviniente_apoderado_c2 = $_POST['CORREO_ELECTRONICO_S_INTERVINIENTE_APODERADO_C2'] ?? null;


    //-------------DATOS DEL TERCER INTERVINIENTE----------------
    $nombres_t_interviniente = $_POST['NOMBRES_T_INTERVINIENTE'] ?? null;
    $apellidos_t_interviniente = $_POST['APELLIDOS_T_INTERVINIENTE'] ?? null;
    $tipo_t_interviniente = $_POST['TIPO_T_INTERVINIENTE'] ?? null;
    $num_identi_t_interviniente = $_POST['NUM_IDENTI_T_INTERVINIENTE'] ?? null;
    $telefono_t_interviniente = $_POST['TELEFONO_T_INTERVINIENTE'] ?? null;
    $direccion_t_interviniente = $_POST['DIRECCION_T_INTERVINIENTE'] ?? null;
    $correo_electronico_t_interviniente = $_POST['CORREO_ELECTRONICO_T_INTERVINIENTE'] ?? null;
    $tipo_interviniente3 = 'TERCER INTERVINIENTE';

    //-------------DATOS DEL TERCER INTERVINIENTE APODERADO----------------
    $nombres_t_interviniente_apoderado = $_POST['NOMBRES_T_INTERVINIENTE_APODERADO'] ?? null;
    $apellidos_t_interviniente_apoderado = $_POST['APELLIDOS_T_INTERVINIENTE_APODERADO'] ?? null;
    $tipo_t_interviniente_apoderado = $_POST['TIPO_T_INTERVINIENTE_APODERADO'] ?? null;
    $num_identi_t_interviniente_apoderado = $_POST['NUM_IDENTI_T_INTERVINIENTE_APODERADO'] ?? null;
    $telefono_t_interviniente_apoderado = $_POST['TELEFONO_T_INTERVINIENTE_APODERADO'] ?? null;
    $direccion_t_interviniente_apoderado = $_POST['DIRECCION_T_INTERVINIENTE_APODERADO'] ?? null;
    $correo_electronico_t_interviniente_apoderado = $_POST['CORREO_ELECTRONICO_T_INTERVINIENTE_APODERADO'] ?? null;


    // Variables para manejar los documentos
    //$uploadDirectory = 'C:\xampp\htdocs\BotPlussFB\ARCHIVOS_RADICADOS'; // Directorio donde se guardarán los archivos (ajústalo según tu estructura)
    //$files = $_FILES['documentos'];
    //$uploadedFiles = []; // Array para almacenar las rutas de los archivos subidos
    $matriculas = $_POST['matriculas'] ?? []; // Verifica si el array de matriculas está presente

    try {
        // Iniciar transacción
        $conn->beginTransaction();

        // Marcar el número de radicado como utilizado
        $updateQuery = "UPDATE ConsecutivoRadicado SET utilizado = 1 WHERE numero_radicado = ?";
        $updateStmt = $conn->prepare($updateQuery);
        $updateStmt->execute([$num_radicado]);

        //-------------INSERTAR DATOS RADICACION EN LINEA----------------
        $stmt_radicados = $conn->prepare("INSERT INTO radicados (NUM_RADICADO, ACTO_NOTARIAL, PROYECTO, OBSERVACIONES, USUARIO_RADICO, id_usuario ) VALUES (?, ?, ?,?, ?, ?)");
        $stmt_radicados->execute([$num_radicado, $acto_notarial, $proyecto, $observaciones, $usuario_radico, $digitador_id]);

        actualizarPuntajeDigitador($conn, $digitador_id);

        $stmt_folios = $conn->prepare("INSERT INTO folio_matricula (NUM_RADICADO, NUM_MATRICULA) VALUES (?, ?)");
        foreach ($matriculas as $num_matricula) {
            if (!empty($num_matricula)) { // Verifica que el número de matrícula no esté vacío
                $stmt_folios->execute([$num_radicado, $num_matricula]);
            }
        }


        //INSERTAR ESTADO RECEPCION//
        $fecha_estado = date('Y-m-d');
        $stmt_estado_radicado = $conn->prepare("INSERT INTO estado_radicado (id_estado, numero_radicado, fecha_estado, descripcion, usuario) VALUES (?, ?, ?, ?, ?)");
        $stmt_estado_radicado->execute(['1', $num_radicado, $fecha_estado, 'OK', $usuario_radico]);


        //-------------INSERTAR DATOS DEL PRIMER INTERVINIENTE----------------
        $stmt_intervinientes = $conn->prepare("INSERT INTO intervinientes (NUM_RADICADO, NOMBRES, APELLIDOS, TIPO, NUM_IDENTI, TELEFONO, ACTIVIDAD_ECONOMICA, DIRECCION, CORREO_ELECTRONICO, TIPO_INTERVINIENTE) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt_intervinientes->execute([$num_radicado, $nombres_p_interviniente, $apellidos_p_interviniente, $tipo_p_interviniente, $num_identi_p_interviniente, $telefono_p_interviniente, $actividad_economica_p_interviniente, $direccion_p_interviniente, $correo_electronico_p_interviniente, $tipo_interviniente]);

        // Obtener el ID del interviniente insertado
        $id_interviniente = $conn->lastInsertId();

        //----------------VERIFICAR SI HAY APODERADO EN PRIMER INTERVINIENTE APODERADO----------------------
        if (isset($_POST['HAS_APODERADO_P']) && $_POST['HAS_APODERADO_P'] == 'on') {
            // Datos del apoderado
            $stmt_apoderado = $conn->prepare("INSERT INTO apoderados (ID_INTERVINIENTE, NOMBRES, APELLIDOS, TIPO, NUM_IDENTI, TELEFONO, ACTIVIDAD_ECONOMICA, DIRECCION, CORREO_ELECTRONICO) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt_apoderado->execute([$id_interviniente, $nombres_apoderado, $apellidos_apoderado, $tipo_apoderado, $num_identi_apoderado, $telefono_apoderado, $actividad_economica_apoderado, $direccion_apoderado, $correo_electronico_apoderado]);
        }

        //-------------INSERTAR DATOS DEL SEGUNDO INTERVINIENTE----------------
        $stmt_intervinientes = $conn->prepare("INSERT INTO intervinientes (NUM_RADICADO, NOMBRES, APELLIDOS, TIPO, NUM_IDENTI, TELEFONO, ACTIVIDAD_ECONOMICA, DIRECCION, CORREO_ELECTRONICO, TIPO_INTERVINIENTE) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt_intervinientes->execute([$num_radicado, $nombres_s_interviniente, $apellidos_s_interviniente, $tipo_s_interviniente, $num_identi_s_interviniente, $telefono_s_interviniente, $actividad_economica_s_interviniente, $direccion_s_interviniente, $correo_electronico_s_interviniente, $tipo_interviniente2]);

        // Obtener el ID del interviniente insertado
        $id_interviniente2 = $conn->lastInsertId();

        //----------------VERIFICAR SI HAY APODERADO EN SEGUNDO INTERVINIENTE APODERADO----------------
        if (isset($_POST['HAS_APODERADO_S']) && $_POST['HAS_APODERADO_S'] == 'on') {
            // Datos del apoderado
            $stmt_apoderado = $conn->prepare("INSERT INTO apoderados (ID_INTERVINIENTE, NOMBRES, APELLIDOS, TIPO, NUM_IDENTI, TELEFONO, ACTIVIDAD_ECONOMICA, DIRECCION, CORREO_ELECTRONICO) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt_apoderado->execute([$id_interviniente2, $nombres_s_interviniente_apoderado, $apellidos_s_interviniente_apoderado, $tipo_s_interviniente_apoderado, $num_identi_s_interviniente_apoderado, $telefono_s_interviniente_apoderado, $actividad_economica_s_interviniente_apoderado, $direccion_s_interviniente_apoderado, $correo_electronico_s_interviniente_apoderado]);
        }

        //-------------INSERTAR DATOS DEL SEGUNDO INTERVINIENTE COMPRADOR 2----------------
        $stmt_interviniente_c2 = $conn->prepare("INSERT INTO intervinientes (NUM_RADICADO, NOMBRES, APELLIDOS, TIPO, NUM_IDENTI, TELEFONO, ACTIVIDAD_ECONOMICA, DIRECCION, CORREO_ELECTRONICO, TIPO_INTERVINIENTE) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt_interviniente_c2->execute([$num_radicado, $nombres_s_interviniente_c2, $apellidos_s_interviniente_c2, $tipo_s_interviniente_c2, $num_identi_s_interviniente_c2, $telefono_s_interviniente_c2, $actividad_economica_s_interviniente_c2, $direccion_s_interviniente_c2, $correo_electronico_s_interviniente_c2, $tipo_interviniente_c2]);

        // Obtener el ID del interviniente insertado
        $id_interviniente_c2 = $conn->lastInsertId();

        //----------------VERIFICAR SI HAY APODERADO EN SEGUNDO INTERVINIENTE COMPRADOR 2 APODERADO----------------
        if (isset($_POST['HAS_APODERADO_C2']) && $_POST['HAS_APODERADO_C2'] == 'on') {
            // Datos del apoderado
            $stmt_apoderado_c2 = $conn->prepare("INSERT INTO apoderados (ID_INTERVINIENTE, NOMBRES, APELLIDOS, TIPO, NUM_IDENTI, TELEFONO, DIRECCION, CORREO_ELECTRONICO) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt_apoderado_c2->execute([$id_interviniente_c2, $nombres_s_interviniente_apoderado_c2, $apellidos_s_interviniente_apoderado_c2, $tipo_s_interviniente_apoderado_c2, $num_identi_s_interviniente_apoderado_c2, $telefono_s_interviniente_apoderado_c2, $direccion_s_interviniente_apoderado_c2, $correo_electronico_s_interviniente_apoderado_c2]);
        }

        //-------------INSERTAR DATOS DEL TERCER INTERVINIENTE----------------
        $stmt_intervinientes = $conn->prepare("INSERT INTO intervinientes (NUM_RADICADO, NOMBRES, APELLIDOS, TIPO, NUM_IDENTI, TELEFONO, DIRECCION, CORREO_ELECTRONICO, TIPO_INTERVINIENTE) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt_intervinientes->execute([$num_radicado, $nombres_t_interviniente, $apellidos_t_interviniente, $tipo_t_interviniente, $num_identi_t_interviniente, $telefono_t_interviniente, $direccion_t_interviniente, $correo_electronico_t_interviniente, $tipo_interviniente3]);

        // Obtener el ID del interviniente insertado
        $id_interviniente3 = $conn->lastInsertId();

        //----------------VERIFICAR SI HAY APODERADO EN TERCER INTERVINIENTE APODERADO----------------
        if (isset($_POST['HAS_APODERADO_T']) && $_POST['HAS_APODERADO_T'] == 'on') {
            // Datos del apoderado
            $stmt_apoderado = $conn->prepare("INSERT INTO apoderados (ID_INTERVINIENTE, NOMBRES, APELLIDOS, TIPO, NUM_IDENTI, TELEFONO, DIRECCION, CORREO_ELECTRONICO) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt_apoderado->execute([$id_interviniente3, $nombres_t_interviniente_apoderado, $apellidos_t_interviniente_apoderado, $tipo_t_interviniente_apoderado, $num_identi_t_interviniente_apoderado, $telefono_t_interviniente_apoderado, $direccion_t_interviniente_apoderado, $correo_electronico_t_interviniente_apoderado]);
        }



        // Confirmar transacción
        $conn->commit();

        // Guardar mensaje de éxito en la sesión
        echo "<script>
                alert('Registros insertados correctamente.');
                window.location.href = 'http://localhost/BotPlussFB/secciones/admin/opciones_radicacion/';
              </script>";

        //exit(); // Asegúrate de terminar la ejecución después de la redirección
    } catch (PDOException $e) {
        // Revertir la transacción si ocurre algún error
        $conn->rollBack();
        echo "Error al guardar los datos: " . $e->getMessage();
    }
}
