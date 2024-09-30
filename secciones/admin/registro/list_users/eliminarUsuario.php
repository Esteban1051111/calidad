<?php
require_once '../../conexion.php'; // Ajusta la ruta según sea necesario

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id = $_GET['id'];

    $conn = Cconexion::conexionBD();
    $stmt = $conn->prepare("DELETE FROM usuarios WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    header('Location: index.php');
}
?>
