<?php
require_once '../conexion.php'; // Database connection setup

function obtenerProximoDigitador($conn) {
    if ($conn === null) {
        throw new Exception("Error: Conexión a la base de datos no establecida.");
    }

    // Select the digitador with the lowest score
    $stmt = $conn->prepare("SELECT id, puntaje FROM digitadores ORDER BY puntaje ASC LIMIT 1");
    $stmt->execute();
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($resultado) {
        return $resultado['id'];
    } else {
        throw new Exception("Error: No hay digitadores disponibles con puntaje.");
    }
}
?>