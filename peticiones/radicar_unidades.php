<?php
// Incluir el archivo de conexión a la base de datos
require_once '../conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar si se ha hecho clic en el botón 'Numerar'
    if (isset($_POST['numerar'])) {
        // Obtener los datos enviados por el formulario
        $unidad = $_POST['numerar'];
        $numero_radicado = isset($_POST['radicado_' . $unidad]) ? $_POST['radicado_' . $unidad] : '';
        $numero_matricula = isset($_POST['folio_matricula']) ? $_POST['folio_matricula'] : '';
        $proyecto = isset($_POST['nombre_proyecto']) ? $_POST['nombre_proyecto'] : '';
        $id_proyecto = isset($_POST['id_proyecto']) ? $_POST['id_proyecto'] : '';

        // Validar que todos los datos necesarios estén presentes
        if (!empty($numero_radicado) && !empty($numero_matricula) && !empty($proyecto) && !empty($id_proyecto)) {
            try {
                // Conectar a la base de datos
                $conn = Cconexion::conexionBD();

                // Preparar la consulta SQL para insertar los datos en la tabla Radicados
                $sql = "INSERT INTO Radicados (NUM_RADICADO, NUM_MATRICULA, PROYECTO, ID_PROYECTO) 
                        VALUES (:numero_radicado, :numero_matricula, :proyecto, :id_proyecto)";
                $stmt = $conn->prepare($sql);

                // Vincular los parámetros con los valores
                $stmt->bindParam(':numero_radicado', $numero_radicado);
                $stmt->bindParam(':numero_matricula', $numero_matricula);
                $stmt->bindParam(':proyecto', $proyecto);
                $stmt->bindParam(':id_proyecto', $id_proyecto);

                // Ejecutar la consulta
                if ($stmt->execute()) {
                    // Actualizar el estado del número de radicado en la tabla consecutivoradicado
                    $sqlUpdate = "UPDATE consecutivoradicado SET utilizado = 1 WHERE numero_radicado = :numero_radicado";
                    $stmtUpdate = $conn->prepare($sqlUpdate);
                    $stmtUpdate->bindParam(':numero_radicado', $numero_radicado);
                    $stmtUpdate->execute();

                    echo "<script>
                            alert('Radicado guardado con éxito.');
                            window.history.back();
                          </script>";
                } else {
                    echo "<script>
                            alert('Error al guardar el radicado.');
                            window.history.back();
                          </script>";
                }
            } catch (PDOException $e) {
                echo "<script>
                        alert('Error en la consulta: " . $e->getMessage() . "');
                        window.history.back();
                      </script>";
            }
        } else {
            echo "<script>
                    alert('Faltan datos necesarios para guardar el radicado.');
                    window.history.back();
                  </script>";
        }
    }
}
?>
