<?php
include(__DIR__ . '/../conexion.php'); // Ajusta esta ruta según la ubicación real de conexion.php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_usuario = $_POST['id_usuario'];

    // Obtener la conexión
    $conn = Cconexion::conexionBD();

    if ($conn) {
        $sql = "UPDATE usuarios SET activo = 1 WHERE id_usuario = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id_usuario]);

        // Redirigir de vuelta a la página de listado de usuarios
        header('Location: ../secciones/admin/registro/list_users/index.php');
        exit;
    } else {
        echo 'No se pudo conectar a la base de datos.';
    }
} else {
    echo 'Método de solicitud no permitido.';
}
?>

