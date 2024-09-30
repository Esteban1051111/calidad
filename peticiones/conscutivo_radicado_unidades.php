<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/BotPlussFB/conexion.php';

try {
    // Conectar a la base de datos usando PDO
    $conn = Cconexion::conexionBD();

    // Consultar para obtener todos los números de radicado no utilizados
    $query = "SELECT numero_radicado FROM consecutivoradicado WHERE utilizado = 0 ORDER BY numero_radicado ASC";
    $stmt = $conn->prepare($query);
    $stmt->execute();

    // Obtener todos los radicados disponibles
    $radicadosDisponibles = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}

// Cerrar la conexión
$conn = null;

