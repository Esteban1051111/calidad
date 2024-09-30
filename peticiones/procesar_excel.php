<?php
require_once '../conexion.php';
require_once '../vendor/autoload.php'; // Librería para leer Excel
date_default_timezone_set('America/Bogota');
session_start(); // Iniciar sesión para obtener el usuario

$conn = Cconexion::conexionBD();
// Desactiva la salida de errores para evitar que interfiera con JSON
ini_set('display_errors', 0);

if (isset($_FILES['file']['tmp_name'])) {
    $filePath = $_FILES['file']['tmp_name'];

    // Utilizar PhpSpreadsheet para leer el archivo Excel
    $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($filePath);
    $sheet = $spreadsheet->getActiveSheet();
    $data = $sheet->toArray();

    // Obtener el usuario que radicó desde la sesión
    $usuario_radico = $_SESSION['usuario'];

    // Guardar los números de radicado insertados
    $radicadosInsertados = [];

    // Directorio donde se guardarán los archivos
    //$uploadDirectory = 'C:\Users\Holli\OneDrive\Escritorio\ARCHIVOS_RADICADOS\\';


    // Recorrer cada fila del Excel
    foreach ($data as $index => $row) {
        if ($index == 0) {
            // Saltar la primera fila (que contiene los títulos)
            continue;
        }
        // Obtener un nuevo número de radicado
        $queryRadicado = "SELECT TOP 1 numero_radicado FROM consecutivoradicado WHERE utilizado = 0";
        $stmtRadicado = $conn->prepare($queryRadicado);
        $stmtRadicado->execute();
        $radicadoRow = $stmtRadicado->fetch(PDO::FETCH_ASSOC);

        if ($radicadoRow) {
            $numeroRadicado = $radicadoRow['numero_radicado'];

            // Marcar el radicado como utilizado
            $updateRadicado = "UPDATE consecutivoradicado SET utilizado = 1 WHERE numero_radicado = :numero_radicado";
            $stmtUpdateRadicado = $conn->prepare($updateRadicado);
            $stmtUpdateRadicado->bindParam(':numero_radicado', $numeroRadicado);
            $stmtUpdateRadicado->execute();



            // Insertar los datos en la tabla Radicados
            $queryRadicados = "INSERT INTO Radicados 
                (NUM_RADICADO, ACTO_NOTARIAL, NUM_MATRICULA, PROYECTO, OBSERVACIONES, USUARIO_RADICO) 
                VALUES 
                (:num_radicado, :acto_notarial, :num_matricula, :proyecto, :observaciones, :usuario_radico)";
            $stmtRadicados = $conn->prepare($queryRadicados);
            $stmtRadicados->bindParam(':num_radicado', $numeroRadicado);
            $stmtRadicados->bindParam(':acto_notarial', $row[0]); // ACTO_NOTARIAL
            $stmtRadicados->bindParam(':num_matricula', $row[1]); // NUM_MATRICULA
            $stmtRadicados->bindParam(':proyecto', $row[2]); // PROYECTO
            $stmtRadicados->bindParam(':observaciones', $row[3]); // OBSERVACIONES
            $stmtRadicados->bindParam(':usuario_radico', $usuario_radico); // Aquí podrías pasar el usuario que radicó
            $stmtRadicados->execute();

            $radicadosInsertados[] = $numeroRadicado;  // Guardar el radicado insertado


            // Insertar los datos en la tabla Intervinientes
            $queryInterviniente = "INSERT INTO Intervinientes 
                    (NOMBRES, APELLIDOS, TIPO, NUM_IDENTI, TELEFONO, ACTIVIDAD_ECONOMICA, DIRECCION, CORREO_ELECTRONICO, TIPO_INTERVINIENTE, ESTADO_CIVIL, NUM_RADICADO) 
                    VALUES 
                    ('LAS GALIAS', '', 'NIT', 10101010 , 3178049284, 'CONSTRUCTORA', 'ACA', 'galias@gmail.com', 'PRIMER INTERVINIENTE', '', :num_radicado)";
            $stmtInterviniente = $conn->prepare($queryInterviniente);
            //$stmtInterviniente->bindParam(':nombres', $row[5]); // I_NOMBRES
            //$stmtInterviniente->bindParam(':apellidos', $row[6]); // I_APELLIDOS
           // $stmtInterviniente->bindParam(':tipo', $row[7]); // I_TIPO
            //$stmtInterviniente->bindParam(':num_identidad', $row[8]); // I_NUM_IDENTI
            //$stmtInterviniente->bindParam(':telefono', $row[9]); // I_TELEFONO
           // $stmtInterviniente->bindParam(':actividad_economica', $row[10]); // I_ACTIVIDAD_ECONOMICA
           // $stmtInterviniente->bindParam(':direccion', $row[11]); // I_DIRECCION
           // $stmtInterviniente->bindParam(':correo_electronico', $row[12]); // I_CORREO_ELECTRONICO
            //$stmtInterviniente->bindParam(':tipo_interviniente', $row[13]); // I_TIPO_INTERVINIENTE
            //$stmtInterviniente->bindParam(':estado_civil', $row[14]); // I_ESTADO_CIVIL
            $stmtInterviniente->bindParam(':num_radicado', $numeroRadicado); // Asociar al número de radicado
            $stmtInterviniente->execute();

            // Insertar los datos en la tabla Intervinientes
            $queryInterviniente = "INSERT INTO Intervinientes 
                    (NOMBRES, APELLIDOS, TIPO, NUM_IDENTI, TELEFONO, ACTIVIDAD_ECONOMICA, DIRECCION, CORREO_ELECTRONICO, TIPO_INTERVINIENTE, ESTADO_CIVIL, NUM_RADICADO) 
                    VALUES 
                    (:nombres, :apellidos, :tipo, :num_identidad, :telefono, :actividad_economica, :direccion, :correo_electronico, 'SEGUNDO INTERVINIENTE', :estado_civil, :num_radicado)";
            $stmtInterviniente = $conn->prepare($queryInterviniente);
            $stmtInterviniente->bindParam(':nombres', $row[5]); // I_NOMBRES
            $stmtInterviniente->bindParam(':apellidos', $row[6]); // I_APELLIDOS
            $stmtInterviniente->bindParam(':tipo', $row[7]); // I_TIPO
            $stmtInterviniente->bindParam(':num_identidad', $row[8]); // I_NUM_IDENTI
            $stmtInterviniente->bindParam(':telefono', $row[9]); // I_TELEFONO
            $stmtInterviniente->bindParam(':actividad_economica', $row[10]); // I_ACTIVIDAD_ECONOMICA
            $stmtInterviniente->bindParam(':direccion', $row[11]); // I_DIRECCION
            $stmtInterviniente->bindParam(':correo_electronico', $row[12]); // I_CORREO_ELECTRONICO
            //$stmtInterviniente->bindParam(':tipo_interviniente', $row[13]); // I_TIPO_INTERVINIENTE
            $stmtInterviniente->bindParam(':estado_civil', $row[14]); // I_ESTADO_CIVIL
            $stmtInterviniente->bindParam(':num_radicado', $numeroRadicado); // Asociar al número de radicado
            $stmtInterviniente->execute();

            // Obtener el ID_INTERVINIENTE recién insertado
            $idInterviniente = $conn->lastInsertId();

            // Insertar los datos en la tabla Apoderados
            $queryApoderado = "INSERT INTO Apoderados 
                (ID_INTERVINIENTE, NOMBRES, APELLIDOS, TIPO, NUM_IDENTI, TELEFONO, ACTIVIDAD_ECONOMICA, DIRECCION, CORREO_ELECTRONICO, ESTADO_CIVIL) 
                VALUES 
                    (:id_interviniente, :nombres, :apellidos, :tipo, :num_identidad, :telefono, :actividad_economica, :direccion, :correo_electronico, :estado_civil)";
            $stmtApoderado = $conn->prepare($queryApoderado);
            $stmtApoderado->bindParam(':id_interviniente', $idInterviniente);
            $stmtApoderado->bindParam(':nombres', $row[15]); // A_NOMBRES
            $stmtApoderado->bindParam(':apellidos', $row[16]); // A_APELLIDOS
            $stmtApoderado->bindParam(':tipo', $row[17]); // A_TIPO
            $stmtApoderado->bindParam(':num_identidad', $row[18]); // A_NUM_IDENTI
            $stmtApoderado->bindParam(':telefono', $row[19]); // A_TELEFONO
            $stmtApoderado->bindParam(':actividad_economica', $row[20]); // A_ACTIVIDAD_ECONOMICA
            $stmtApoderado->bindParam(':direccion', $row[21]); // A_DIRECCION
            $stmtApoderado->bindParam(':correo_electronico', $row[22]); // A_CORREO_ELECTRONICO
            $stmtApoderado->bindParam(':estado_civil', $row[23]); // A_ESTADO_CIVIL
            $stmtApoderado->execute();

            // Insertar los datos en la tabla Folio_Matricula
            $queryFolioMatricula = "INSERT INTO Folio_Matricula 
                (NUM_RADICADO, NUM_MATRICULA, DESCRIPCION) 
                VALUES 
                (:num_radicado, :num_matricula, :descripcion)";
            $stmtFolioMatricula = $conn->prepare($queryFolioMatricula);
            $stmtFolioMatricula->bindParam(':num_radicado', $numeroRadicado); // NUM_RADICADO
            $stmtFolioMatricula->bindParam(':num_matricula', $row[1]); // NUM_MATRICULA (columna en Excel)
            $stmtFolioMatricula->bindParam(':descripcion', $row[2]); // DESCRIPCION, aquí puedes pasar las observaciones o cualquier descripción
            $stmtFolioMatricula->execute();


            //INSERTAR ESTADO RECEPCION//
            $fecha_estado = date('Y-m-d');
            $stmt_estado_radicado = $conn->prepare("INSERT INTO estado_radicado (id_estado, numero_radicado, fecha_estado, descripcion, usuario) VALUES (?, ?, ?, ?, ?)");
            $stmt_estado_radicado->execute(['1', $numeroRadicado, $fecha_estado, 'OK', $usuario_radico]);



            echo "Radicado con número " . $numeroRadicado . " insertado correctamente.<br>";
        } else {
            echo "No hay más números de radicado disponibles.";
        }
    }
}
