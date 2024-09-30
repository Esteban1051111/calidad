<?php
include(__DIR__ . '/../conexion.php'); // Ajustar esta línea según la ubicación real de conexion.php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_usuario = $_POST['id_usuario'];

    $conn = Cconexion::conexionBD();

    $sql = "DELETE FROM usuarios WHERE id_usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id_usuario]);

    // Redirigir de vuelta a la página de listado de usuarios
    header('Location: ../secciones/admin/registro/list_users/index.php');
    exit;
}
?>

