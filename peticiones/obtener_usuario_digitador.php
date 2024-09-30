<?php
// Incluye el archivo de conexión a la base de datos
include(__DIR__ . '/../conexion.php');

function obtenerDigitadorActivoConMenorPuntaje() {
    // Obtener la conexión desde la clase Cconexion
    $pdo = Cconexion::conexionBD();

    if ($pdo === null) {
        return ['error' => 'Conexión a la base de datos no disponible.'];
    }

    // Convertir el texto a entero para la ordenación
    $sql = "SELECT TOP 1 id_usuario, usuario
            FROM usuarios
            WHERE activo = 1 AND tipo_usuario = 'digitador'
            ORDER BY CAST(puntaje AS INT) ASC";

    $stmt = $pdo->prepare($sql);

    if (!$stmt->execute()) {
        error_log("Error en la consulta SQL: " . implode(" ", $stmt->errorInfo()));
        return ['error' => 'Error en la consulta SQL'];
    }

    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    return $usuario;
}

$digitador = obtenerDigitadorActivoConMenorPuntaje();
echo json_encode($digitador);
?>

