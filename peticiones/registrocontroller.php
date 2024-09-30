<?php
require_once '../conexion.php'; // Ajusta la ruta según la ubicación real de conexion.php

function isUsernameUnique($conn, $usuario) {
    $sql = "SELECT COUNT(*) FROM usuarios WHERE usuario = :usuario";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':usuario', $usuario);
    $stmt->execute();
    return $stmt->fetchColumn() == 0;
}

function isPasswordSecure($password) {
    // Verificar si la contraseña cumple con los requisitos de seguridad
    return preg_match('/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $password);
}

try {
    // Obtener la conexión a la base de datos
    $conn = Cconexion::conexionBD();

    // Obtener los datos del formulario
    $nombres = $_POST['nombreCompleto'];
    $apellidos = $_POST['apellidoCompleto'];
    $correo = $_POST['email'];
    //$confirmCorreo = $_POST['confirmEmail'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    $celular = $_POST['telefono'];
    $empresa = $_POST['empresa'] ?? null;
    $tipo_usuario = $_POST['tipoUsuario'];
    $usuario = $_POST['usuario'];
    $activo = $_POST['activo']? 1 : 0;

    // Verificar que las contraseñas coincidan
    if ($password !== $confirmPassword) {
        echo '<script>alert("Las contraseñas no coinciden. Por favor, inténtalo de nuevo."); window.history.back();</script>';
        exit();
    }    
    

    // Validar el nombre de usuario
    if (!isUsernameUnique($conn, $usuario)) {
        echo '<script>alert("El nombre de usuario ya está en uso. Por favor, elige otro."); window.history.back();</script>';
        exit();
    }

    // Validar la seguridad de la contraseña
    if (!isPasswordSecure($password)) {
        echo '<script>alert("La contraseña debe tener al menos 8 caracteres, incluyendo una letra, un número y un carácter especial."); window.history.back();</script>';
        exit();
    }

    // Hashear la contraseña
    $pass = password_hash($password, PASSWORD_DEFAULT);

    // Preparar la consulta SQL
    $sql = "INSERT INTO usuarios (nombres, apellidos, correo, pass, celular, empresa, tipo_usuario, usuario, activo) 
            VALUES (:nombres, :apellidos, :correo, :pass, :celular, :empresa, :tipo_usuario, :usuario, :activo)";
    $stmt = $conn->prepare($sql);

    // Asignar los valores a los parámetros de la consulta
    $stmt->bindParam(':nombres', $nombres);
    $stmt->bindParam(':apellidos', $apellidos);
    $stmt->bindParam(':correo', $correo);
    $stmt->bindParam(':pass', $pass);
    $stmt->bindParam(':celular', $celular);
    $stmt->bindParam(':empresa', $empresa);
    $stmt->bindParam(':tipo_usuario', $tipo_usuario);
    $stmt->bindParam(':usuario', $usuario);
    $stmt->bindParam(':activo', $activo);

    // Ejecutar la consulta
    $stmt->execute();

    // Redirigir a la página de éxito o mostrar un mensaje de éxito
    echo '<script>alert("Usuario registrado con éxito."); window.location.href="../secciones/admin/registro/index.php";</script>';

} catch (PDOException $e) {
    // Manejar errores de conexión y ejecución
    echo 'Error: ' . $e->getMessage();
}
?>
