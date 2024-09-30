<?php
include(__DIR__ . '/../conexion.php'); // Ajustar esta línea según la ubicación real de conexion.php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_usuario = $_POST['id_usuario'];
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $correo = $_POST['correo'];
    $celular = $_POST['celular'];
    $empresa = $_POST['empresa'];
    $tipo_usuario = $_POST['tipo_usuario'];
    $usuario = $_POST['usuario'];
    $activo = $_POST['activo'];
    //$puntaje = $_POST['puntaje'];

    $conn = Cconexion::conexionBD();

    $sql = "UPDATE usuarios SET nombres = ?, apellidos = ?, correo = ?, celular = ?, empresa = ?, tipo_usuario = ?, usuario = ?, activo = ? WHERE id_usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$nombres, $apellidos, $correo, $celular, $empresa, $tipo_usuario, $usuario, $activo, $id_usuario]);

    // Redirigir de vuelta a la página de listado de usuarios
    header('Location: ../secciones/admin/registro/list_users/index.php');
    exit;
}
?>



