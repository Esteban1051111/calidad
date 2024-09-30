<?php
require_once '../conexion.php';

// Conexión a la base de datos
$conexion = new Cconexion();
$pdo = $conexion->conexionBD();

$sql = "SELECT * FROM escrituras_pendientes WHERE pendiente = 'si'";
$stmt = $pdo->query($sql);
$escrituras = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($escrituras);
?>
