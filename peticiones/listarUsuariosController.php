<?php
require_once '../../conexion.php'; // Ajusta la ruta según sea necesario

function listarUsuarios($search = '') {
    try {
        $conn = Cconexion::conexionBD();

        if ($search) {
            $sql = "SELECT * FROM usuarios WHERE nombres LIKE :search OR apellidos LIKE :search OR usuario LIKE :search OR correo LIKE :search";
            $stmt = $conn->prepare($sql);
            $search = "%$search%";
            $stmt->bindParam(':search', $search);
        } else {
            $sql = "SELECT * FROM usuarios";
            $stmt = $conn->prepare($sql);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $search = $_POST['buscarUsuario'] ?? '';
    $usuarios = listarUsuarios($search);
    echo json_encode($usuarios);
}
?>
