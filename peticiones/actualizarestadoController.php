<?php
require_once('../conexion.php');
date_default_timezone_set('America/Bogota'); // Establece la zona horaria adecuada


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_estado = $_POST['id_estado'];
    $numero_radicado = $_POST['numero_radicado'];  // Cambiado de 'num_radicado' a 'numero_radicado'
    $usuario = $_POST['usuario'];
    $fecha = $_POST['fecha'];
    $observaciones = $_POST['observaciones'];

    try {
        $conexion = Cconexion::conexionBD();
        
        // Imprimir los parámetros para depuración
        echo "id_estado: $id_estado<br>";
        echo "numero_radicado: $numero_radicado<br>";
        echo "usuario: $usuario<br>";
        echo "fecha: $fecha<br>";
        echo "observaciones: $observaciones<br>";

        // Verificar si el estado existe
        $checkQuery = "SELECT COUNT(*) FROM estado_radicado WHERE id_estado = :id_estado AND numero_radicado = :numero_radicado";
        $stmt = $conexion->prepare($checkQuery);
        $stmt->bindParam(':id_estado', $id_estado);
        $stmt->bindParam(':numero_radicado', $numero_radicado);
        $stmt->execute();
        $exists = $stmt->fetchColumn();

        if ($exists) {
            // Estado existe, realizar actualización
            $query = "UPDATE estado_radicado SET fecha_estado = :fecha, usuario = :usuario, descripcion = :observaciones WHERE id_estado = :id_estado AND numero_radicado = :numero_radicado";
            $stmt = $conexion->prepare($query);
        } else {
            // Estado no existe, realizar inserción
            $query = "INSERT INTO estado_radicado (id_estado, numero_radicado, fecha_estado, usuario, descripcion) VALUES (:id_estado, :numero_radicado, :fecha, :usuario, :observaciones)";
            $stmt = $conexion->prepare($query);
        }

        // Bind parameters
        $stmt->bindParam(':fecha', $fecha);
        $stmt->bindParam(':usuario', $usuario);
        $stmt->bindParam(':observaciones', $observaciones);
        $stmt->bindParam(':numero_radicado', $numero_radicado);  // Cambiado de 'num_radicado' a 'numero_radicado'
        $stmt->bindParam(':id_estado', $id_estado);

        // Mostrar la consulta con los valores (solo para depuración)
        $debug_query = str_replace(
            [':fecha', ':usuario', ':observaciones', ':numero_radicado', ':id_estado'],
            [$fecha, $usuario, $observaciones, $numero_radicado, $id_estado],
            $query
        );
        echo "Consulta de depuración: $debug_query<br>";

        // Ejecutar consulta
        if ($stmt->execute()) {
            echo $exists ? "Estado actualizado con éxito" : "Estado insertado con éxito";
        } else {
            echo "Error al actualizar o insertar el estado.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
