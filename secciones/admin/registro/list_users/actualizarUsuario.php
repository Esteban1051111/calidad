<?php
require_once '../../conexion.php'; // Ajusta la ruta según sea necesario

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id = $_GET['id'];

    $conn = Cconexion::conexionBD();
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nombres = $_POST['nombreCompleto'];
    $apellidos = $_POST['apellidoCompleto'];
    $usuario = $_POST['usuario'];
    $correo = $_POST['email'];
    $celular = $_POST['telefono'];
    $empresa = $_POST['empresa'] ?? null;
    $tipo_usuario = $_POST['tipoUsuario'];
    $activo = isset($_POST['activo']) ? 1 : 0;

    $conn = Cconexion::conexionBD();
    $stmt = $conn->prepare("UPDATE usuarios SET nombres = :nombres, apellidos = :apellidos, usuario = :usuario, correo = :correo, celular = :celular, empresa = :empresa, tipo_usuario = :tipo_usuario, activo = :activo WHERE id = :id");
    $stmt->bindParam(':nombres', $nombres);
    $stmt->bindParam(':apellidos', $apellidos);
    $stmt->bindParam(':usuario', $usuario);
    $stmt->bindParam(':correo', $correo);
    $stmt->bindParam(':celular', $celular);
    $stmt->bindParam(':empresa', $empresa);
    $stmt->bindParam(':tipo_usuario', $tipo_usuario);
    $stmt->bindParam(':activo', $activo);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    header('Location: index.php');
}
?>

<!-- Aquí va el formulario para actualizar el usuario, similar al de creación pero con los valores pre-cargados -->
