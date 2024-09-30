<?php
include(__DIR__ . '/../conexion.php'); // ruta Conexion con la base de datos

$conn = Cconexion::conexionBD(); // Obtén la conexión a la base de datos

if (isset($conn)) { // Verifica que la conexión se establezca correctamente
    // Consulta para obtener los nombres de las constructoras
    $query = "SELECT id, nombre FROM constructoras ORDER BY nombre ASC";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $constructoras = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($constructoras);
} else {
    echo json_encode(["error" => "No se pudo conectar a la base de datos"]);
}
?>
