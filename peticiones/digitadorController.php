<?php
// Incluye el archivo de conexión a la base de datos
include(__DIR__ . '/../conexion.php');

function obtenerDigitadoresActivos() {
    // Obtener la conexión desde la clase Cconexion
    $pdo = Cconexion::conexionBD();

    if ($pdo === null) {
        return ['error' => 'Conexión a la base de datos no disponible.'];
    }

    // Consulta para obtener los usuarios digitadores activos y su puntaje
    $sql = "SELECT id_usuario, usuario, puntaje
            FROM usuarios
            WHERE activo = 1 AND tipo_usuario = 'digitador'
            ORDER BY CAST(puntaje AS INT) ASC";

    $stmt = $pdo->prepare($sql);

    if (!$stmt->execute()) {
        error_log("Error en la consulta SQL: " . implode(" ", $stmt->errorInfo()));
        return ['error' => 'Error en la consulta SQL'];
    }

    $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $usuarios;
}

$digitadores = obtenerDigitadoresActivos();
echo json_encode($digitadores);
?>
