<?php
session_start();
require_once '../conexion.php'; // Ajusta la ruta según la ubicación real de BD.php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'];
    $pass = $_POST['contraseña'];

    // Obtener la conexión a la base de datos
    $conn = Cconexion::conexionBD();

    if ($conn) {
        // Preparar la consulta SQL para verificar el usuario
        $sql = "SELECT * FROM usuarios WHERE usuario = :usuario";
        $stmt = $conn->prepare($sql);

        // Enlazar los parámetros de manera segura
        $stmt->bindParam(':usuario', $usuario, PDO::PARAM_STR);

        // Ejecutar la consulta
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verificar si se obtuvo algún resultado
        if ($resultado && password_verify($pass, $resultado['pass'])) {
            // Contraseña correcta, iniciar sesión
            $_SESSION['usuario'] = $resultado['usuario'];
            $_SESSION['tipo_usuario'] = $resultado['tipo_usuario'];
            
            // Redireccionar según el tipo de usuario
            switch ($resultado['tipo_usuario']) {
                case 'administrador':
                    header('Location: ../secciones/admin/index.php');
                    exit();
                case 'notaria':
                    header('Location: ../secciones/notaria/index.php');
                    exit();
                case 'constructora':
                    header('Location: ../secciones/admin/index.php');
                    exit();
                    case 'digitador':
                        header('Location: ../secciones/constructora/index.php');
                        exit();
                default:
                    header('Location: ../login.php?message=Tipo de usuario no válido');
                    exit();
            }
        } else {
            // Contraseña incorrecta
            header('Location: ../login.php?message=Usuario o contraseña incorrectos');
            exit();
        }

        // Cerrar la conexión
        $conn = null;
    } else {
        header('Location: ../login.php?message=No se pudo conectar a la base de datos');
        exit();
    }
} else {
    // Redirigir al formulario de login si se accede directamente a este script
    header('Location: ../login.php');
    exit();
}
?>
