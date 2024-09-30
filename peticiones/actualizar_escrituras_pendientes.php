<?php
// Configuración de la base de datos
include(__DIR__ . '/../conexion.php');

// Conexión a la base de datos
$conexion = new Cconexion();
$pdo = $conexion->conexionBD();

$id_escritura = $_POST['id_escritura'];
$pendiente = $_POST['pendiente'];

$sql = "UPDATE escrituras_pendientes SET pendiente = :pendiente WHERE id_escritura = :id_escritura";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':pendiente', $pendiente);
$stmt->bindParam(':id_escritura', $id_escritura);

if ($stmt->execute()) {
    echo 'Actualización exitosa';
} else {
    echo 'Error al actualizar';
}
?>
