<?php
require_once '../conexion.php';

$conn = Cconexion::conexionBD();

try {
    $sql = "SELECT ID_PROYECTO, NOMBRE FROM Proyectos";
    $stmt = $conn->query($sql);

    $options = '';
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $options .= '<option value="' . $row['ID_PROYECTO'] . '">' . $row['NOMBRE'] . '</option>';
    }

    // Retornar el HTML de las opciones
    echo $options;
} catch (Exception $e) {
    echo 'Error al obtener proyectos: ' . $e->getMessage();
}
