<?php
require_once '../conexion.php';

$conn = Cconexion::conexionBD();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $folio_matricula = $_POST['folio_matricula'];  // Cambiar a folio_matricula

    // Depuración: verifica que el valor del folio de matrícula se esté enviando correctamente
    if (empty($folio_matricula)) {
        echo json_encode(['success' => false, 'message' => 'Folio de matrícula no proporcionado.']);
        exit;
    }

    // Consulta para verificar si existe el folio y obtener los archivos relacionados
    $query = "SELECT id, nombre_archivo, ruta_archivo FROM Archivos_Radicados WHERE folio_matricula = :folio_matricula";    
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':folio_matricula', $folio_matricula);

    // Ejecuta la consulta
    if ($stmt->execute()) {
        $archivos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($stmt->rowCount() > 0) {
            // El folio fue encontrado, retornar los archivos
            echo json_encode(['success' => true, 'radicado' => $folio_matricula, 'archivos' => $archivos]);
        } else {
            // El folio no existe en la base de datos
            echo json_encode(['success' => false, 'message' => 'Folio de matrícula no encontrado en la base de datos.']);
        }
    } else {
        // Error al ejecutar la consulta
        echo json_encode(['success' => false, 'message' => 'Error en la consulta a la base de datos.']);
    }
}
