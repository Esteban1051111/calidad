<?php
include(__DIR__ . '/../conexion.php'); // Ajusta esta ruta según la ubicación real de conexion.php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_usuario = $_POST['id_usuario'];
    $puntaje = $_POST['puntaje'];

    // Asegúrate de que $puntaje sea un número
    $puntaje = intval($puntaje);

    // Obtener la conexión
    $conn = Cconexion::conexionBD();

    if ($conn) {
        // Obtén el puntaje actual
        $sql = "SELECT puntaje FROM usuarios WHERE id_usuario = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id_usuario]);
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Verifica si el usuario existe
        if ($resultado) {
            // Asegúrate de que $puntajeActual sea un número
            $puntajeActual = intval($resultado['puntaje']);
            $nuevoPuntaje = $puntajeActual + $puntaje;

            // Actualiza el puntaje en la base de datos
            $sql = "UPDATE usuarios SET puntaje = ? WHERE id_usuario = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$nuevoPuntaje, $id_usuario]);

            // Redirige de vuelta a la página de listado de usuarios
            header('Location: ../secciones/admin/registro/list_users/index.php');
            exit;
        } else {
            echo 'Usuario no encontrado.';
        }
    } else {
        echo 'No se pudo conectar a la base de datos.';
    }
} else {
    echo 'Método de solicitud no permitido.';
}
?>
