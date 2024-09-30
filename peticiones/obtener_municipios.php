<?php
include(__DIR__ . '/../conexion.php'); // ruta Conexion con la base de datos

$conn = Cconexion::conexionBD(); // Obtén la conexión a la base de datos

if (isset($conn) && isset($_POST['departamento_id'])) { // Verifica que la conexión se establezca correctamente
    $departamento_id = $_POST['departamento_id'];

    // Consulta para obtener los municipios del departamento seleccionado
    $query = "SELECT id, nombre FROM municipios WHERE departamento_id = :departamento_id ORDER BY nombre ASC";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':departamento_id', $departamento_id, PDO::PARAM_INT);
    $stmt->execute();
    $municipios = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($municipios);
} else {
    echo json_encode(["error" => "No se pudo conectar a la base de datos"]);
}
?>
