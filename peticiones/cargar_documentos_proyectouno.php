<?php
require_once '../conexion.php';
session_start(); // Asegúrate de iniciar la sesión

$conn = Cconexion::conexionBD();
//var_dump($_FILES);
// Directorio donde se guardarán los archivos
$uploadDirectory = 'C:\xampp\htdocs\BotPlussFB\Cargar_Archivos'. DIRECTORY_SEPARATOR;   // Cambia esta ruta a donde deseas almacenar los archivos

// Tipos de archivos permitidos
$allowedTypes = [
    'image/jpeg', 'image/png', 'image/gif', 'image/webp',
    'application/pdf', 'text/plain', 'text/csv', 'application/zip', 
    'application/x-rar-compressed', 'application/msword', 
    'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 
    'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
    'audio/mpeg', 'audio/wav', 'video/mp4', 'video/x-msvideo', 'video/x-matroska'
];




// Verificar si se han recibido archivos
if (isset($_FILES['files'])) {
    $files = $_FILES['files'];
    $uploadedFiles = [];
    $unidadesInsertadas = [];

    try {
        // Recorremos los archivos enviados
        foreach ($files['name'] as $folioMatricula => $fileName) {
            $fileTmpName = $_FILES['files']['tmp_name'][$folioMatricula];
            $fileSize = $_FILES['files']['size'][$folioMatricula];
            $fileError = $_FILES['files']['error'][$folioMatricula];
            $fileType = $_FILES['files']['type'][$folioMatricula];

            // Validar si no hay error y si el archivo tiene nombre y tamaño mayor que 0
            if ($fileError === 0 && !empty($fileName) && $fileSize > 0) {
                if (in_array($fileType, $allowedTypes)) {
                    if ($fileSize <= 10485760) { // Limitar a 10MB
                        // Generar el nombre del archivo con el folio de matrícula
                        $fileNewName = $folioMatricula . "-" . uniqid() . "-" . basename($fileName);
                        $fileDestination = $uploadDirectory . $fileNewName;

                        // Mover el archivo al directorio de destino
                        if (move_uploaded_file($fileTmpName, $fileDestination)) {
                            // Guardar el archivo en la base de datos
                            $query = "INSERT INTO Archivos_Radicados (folio_matricula, nombre_archivo, ruta_archivo, fecha_subida)
                                      VALUES (:folio_matricula, :nombre_archivo, :ruta_archivo, GETDATE())";
                            $stmt = $conn->prepare($query);
                            $stmt->bindParam(':folio_matricula', $folioMatricula);
                            $stmt->bindParam(':nombre_archivo', $fileNewName);
                            $stmt->bindParam(':ruta_archivo', $fileDestination);
                            $stmt->execute();

                            // Guardar el archivo subido en la lista
                            $uploadedFiles[] = $fileNewName;
                            $unidadesInsertadas[] = $folioMatricula;
                        // Guardar la notificación de la campanita
                        $_SESSION['bell_notification'] = "Nuevo archivo cargado: " . htmlspecialchars($fileNewName);
                    } else {
                        $_SESSION['notification'] = "Error al mover el archivo: " . htmlspecialchars($fileName);
                    }
                } else {
                    $_SESSION['notification'] = "El archivo " . htmlspecialchars($fileName) . " excede el tamaño permitido de 10MB.";
                }
            } else {
                $_SESSION['notification'] = "Tipo de archivo no permitido: " . htmlspecialchars($fileName);
            }
        }
    }

        // Enviar mensaje de éxito al usuario y mantener en la misma vista
        if (count($unidadesInsertadas) > 0) {
            echo "<script>
                    alert('Unidades cargadas exitosamente: " . implode(', ', $unidadesInsertadas) . "');
                    window.history.back();
                  </script>";
        } else {
            echo "<script>
                    alert('No se cargaron unidades. Asegúrese de que el archivo contiene datos válidos.');
                    window.history.back();
                  </script>";
        }
    } catch (Exception $e) {
        // Enviar mensaje de error en caso de excepción
        echo "<script>
                alert('Error al procesar el archivo: " . $e->getMessage() . "');
                window.history.back();
              </script>";
    }
} else {
    // Enviar mensaje si no se subió ningún archivo
    echo "<script>
            alert('No se ha subido ningún archivo o no se ha seleccionado un proyecto.');
            window.history.back();
          </script>";
}
?>