<?php
require_once '../conexion.php';

$conn = Cconexion::conexionBD();

// Directorio donde se guardarán los archivos
$uploadDirectory = 'C:\xampp\htdocs\BotPlussFB\Cargar_Archivos'. DIRECTORY_SEPARATOR;  // Cambia esta ruta a donde deseas almacenar los archivos

// Tipos de archivos permitidos
$allowedTypes = [
    'image/jpeg',           // JPEG images
    'image/png',            // PNG images
    'image/gif',            // GIF images
    'image/webp',           // WEBP images
    'application/pdf',      // PDF documents
    'text/plain',           // Plain text files
    'text/csv',             // CSV files
    'application/zip',      // ZIP files
    'application/x-rar-compressed', // RAR files
    'application/msword',   // Microsoft Word documents (DOC)
    'application/vnd.openxmlformats-officedocument.wordprocessingml.document', // Microsoft Word documents (DOCX)
    'application/vnd.ms-excel', // Microsoft Excel documents (XLS)
    'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', // Microsoft Excel documents (XLSX)
    'audio/mpeg',           // MP3 audio files
    'audio/wav',            // WAV audio files
    'video/mp4',            // MP4 video files
    'video/x-msvideo',      // AVI video files
    'video/x-matroska',     // MKV video files
];

// Verificar si se han recibido archivos y un número de radicado
if (isset($_FILES['files']) && isset($_POST['radicado'])) {
    $radicado = $_POST['radicado'];

    $files = $_FILES['files'];
    $uploadedFiles = []; // Array para almacenar las rutas de los archivos subidos

    // Recorrer todos los archivos subidos
    for ($i = 0; $i < count($files['name']); $i++) {
        $fileName = $files['name'][$i];
        $fileTmpName = $files['tmp_name'][$i];
        $fileSize = $files['size'][$i];
        $fileError = $files['error'][$i];
        $fileType = $files['type'][$i];

        // Validar si ocurrió un error al subir el archivo
        if ($fileError === 0) {
            // Validar el tipo de archivo
            if (in_array($fileType, $allowedTypes)) {
                // Limitar el tamaño de archivo si es necesario (ejemplo: 10MB)
                if ($fileSize <= 10485760) {
                    // Generar el nuevo nombre del archivo con el número de radicado
                    $fileNewName = $radicado . "-" . uniqid() . "-" . basename($fileName);
                    $fileDestination = $uploadDirectory . $fileNewName;


                    // Mover el archivo al directorio de destino
                    if (move_uploaded_file($fileTmpName, $fileDestination)) {
                        // Insertar registro en la base de datos
                        $query = "INSERT INTO Archivos_Radicados (num_radicado, nombre_archivo, ruta_archivo) VALUES (:num_radicado, :nombre_archivo, :ruta_archivo)";
                        $stmt = $conn->prepare($query);
                        $stmt->bindParam(':num_radicado', $radicado);
                        $stmt->bindParam(':nombre_archivo', $fileNewName);
                        $stmt->bindParam(':ruta_archivo', $fileDestination);
                        $stmt->execute();

                        // Agregar el archivo subido al array de archivos subidos
                        $uploadedFiles[] = $fileNewName;
                    } else {
                        echo "Error al mover el archivo: " . $fileName;
                    }
                } else {
                    echo "El archivo " . $fileName . " excede el tamaño permitido de 10MB.";
                }
            } else {
                echo "Tipo de archivo no permitido: " . $fileName;
            }
        } else {
            echo "Hubo un error al subir el archivo: " . $fileName;
        }
    }

    // Si no hubo errores, mostrar los archivos subidos
    if (!empty($uploadedFiles)) {
        echo "Archivos subidos correctamente para el radicado " . $radicado . ":<br>";
        foreach ($uploadedFiles as $uploadedFile) {
            echo $uploadedFile . "<br>";
        }
    } else {
        echo "No se pudieron subir archivos para el radicado " . $radicado;
    }
} else {
    echo "No se han seleccionado archivos o radicado.";
}
?>
