<?php
include(__DIR__ . '/../conexion.php'); // ruta Conexion con la base de datos

$conn = Cconexion::conexionBD(); // Obtén la conexión a la base de datos

if (isset($conn)) { // Verifica que la conexión se establezca correctamente
    // Consulta para obtener los nombres de los bancos
    $query = "SELECT id, nombre FROM bancos ORDER BY nombre ASC";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $bancos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($bancos);
} else {
    echo json_encode(["error" => "No se pudo conectar a la base de datos"]);
}
?>
