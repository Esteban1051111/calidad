<?php
// Incluir el archivo de conexión a la base de datos
require_once '../conexion.php'; // Asegúrate de cambiar la ruta según corresponda

// Verificar si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $nombre_proyecto = isset($_POST['nombre_proyecto_constructora']) ? $_POST['nombre_proyecto_constructora'] : '';
    $descripcion_proyecto = isset($_POST['descripcion_nombre_proyecto']) ? $_POST['descripcion_nombre_proyecto'] : '';

    // Validar los datos (esto puede ampliarse según las necesidades)
    if (!empty($nombre_proyecto)) {
        try {
            // Conectar a la base de datos
            $conn = Cconexion::conexionBD(); // Corregido: usar $conn en lugar de $conexion

            // Preparar la consulta SQL para insertar el proyecto
            $sql = "INSERT INTO Proyectos (NOMBRE, DESCRIPCION) VALUES (:nombre_proyecto, :descripcion_proyecto)";
            $stmt = $conn->prepare($sql);

            // Ejecutar la consulta
            $stmt->bindParam(':nombre_proyecto', $nombre_proyecto);
            $stmt->bindParam(':descripcion_proyecto', $descripcion_proyecto);

            if ($stmt->execute()) {
                // Si todo está bien, enviar respuesta JavaScript
                echo "<script>
                        alert('Proyecto guardado con éxito.');
                        window.history.back();  // Mantenerse en la misma página
                      </script>";
            } else {
                // Error al guardar
                echo "<script>
                        alert('Error al guardar el proyecto.');
                        window.history.back(); 
                      </script>";
            }
        } catch (PDOException $e) {
            echo "<script>
                    alert('Error de conexión o consulta: " . $e->getMessage() . "');
                    window.history.back();
                  </script>";
        }
    } else {
        echo "<script>
                alert('El nombre del proyecto es obligatorio.');
                window.history.back();
              </script>";
    }
} else {
    echo "<script>
            alert('Método de solicitud no válido.');
            window.history.back();
          </script>";
}
?>
