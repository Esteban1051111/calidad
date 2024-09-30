<?php
require_once '../conexion.php';
require_once '../vendor/autoload.php'; // Librería para leer Excel
session_start(); // Iniciar sesión para obtener el usuario

$conn = Cconexion::conexionBD();
ini_set('display_errors', 0); // Desactiva la salida de errores para evitar que interfiera con JSON

if (isset($_FILES['file']['tmp_name']) && isset($_POST['proyecto_id'])) {
    $filePath = $_FILES['file']['tmp_name'];
    $proyecto_id = $_POST['proyecto_id']; // Obtenemos el ID del proyecto seleccionado

    try {
        // Utilizar PhpSpreadsheet para leer el archivo Excel
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($filePath);
        $sheet = $spreadsheet->getActiveSheet();
        $data = $sheet->toArray();

        // Guardar las unidades insertadas
        $unidadesInsertadas = [];

        // Recorrer cada fila del Excel
        foreach ($data as $index => $row) {
            if ($index == 0) {
                // Saltar la primera fila (que contiene los títulos)
                continue;
            }

            // Validar que los campos no estén vacíos
            if (!empty($row[0]) && !empty($row[1])) {
                // Insertar los datos en la tabla Unidades, asignando el proyecto seleccionado
                $queryUnidades = "INSERT INTO Unidades (proyecto_id, unidad, folio_matricula) VALUES (:proyecto_id, :unidad, :folio_matricula)";
                $stmtUnidades = $conn->prepare($queryUnidades);
                $stmtUnidades->bindParam(':proyecto_id', $proyecto_id);
                $stmtUnidades->bindParam(':unidad', $row[0]); // Ahora es 'unidad'
                $stmtUnidades->bindParam(':folio_matricula', $row[1]);

                // Ejecutar la consulta
                if ($stmtUnidades->execute()) {
                    $unidadesInsertadas[] = $row[0]; // Guardar la unidad insertada
                }
            }
        }

        // Enviar mensaje de éxito al usuario y mantener en la misma vista
        if (count($unidadesInsertadas) > 0) {
            echo "<script>
                    alert('Unidades cargadas exitosamente: " . implode(', ', $unidadesInsertadas) . "');
                    window.history.back();
                  </script>";
        } else {
            echo "<script>
                    alert('No se cargaron unidades. Asegúrese de que el archivo contiene datos válidos.');
                    window.history.back();
                  </script>";
        }
    } catch (Exception $e) {
        // Enviar mensaje de error en caso de excepción
        echo "<script>
                alert('Error al procesar el archivo: " . $e->getMessage() . "');
                window.history.back();
              </script>";
    }
} else {
    // Enviar mensaje si no se subió ningún archivo o proyecto
    echo "<script>
            alert('No se ha subido ningún archivo o no se ha seleccionado un proyecto.');
            window.history.back();
          </script>";
}
?>
