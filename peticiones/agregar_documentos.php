<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['radicado_id'])) {
    $radicado_id = $_POST['radicado_id'];
    $uploadDir = 'C:\xampp\htdocs\BotPlussFB\Cargar_Archivos' . $radicado_id . '/'; // Ruta de la carpeta con el nombre del radicado

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);  // Crear la carpeta si no existe
    }

    $allowedTypes = [
        'image/jpeg', 'image/png', 'image/gif', 'image/webp', 
        'application/pdf', 'text/plain', 'text/csv', 
        'application/zip', 'application/x-rar-compressed',
        'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 
        'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 
        'audio/mpeg', 'audio/wav', 'video/mp4', 'video/x-msvideo', 'video/x-matroska'
    ];

    foreach ($_FILES['files']['tmp_name'] as $key => $tmp_name) {
        $fileType = $_FILES['files']['type'][$key];
        $fileName = basename($_FILES['files']['name'][$key]);

        if (in_array($fileType, $allowedTypes)) {
            $uploadFile = $uploadDir . $fileName;

            if (move_uploaded_file($tmp_name, $uploadFile)) {
                $response['success'] = true;
                $response['message'] = "Archivos subidos correctamente.";
            } else {
                $response['success'] = false;
                $response['message'] = "Error al subir los archivos.";
            }
        } else {
            $response['success'] = false;
            $response['message'] = "Tipo de archivo no permitido.";
        }
    }

    echo json_encode($response);
}
