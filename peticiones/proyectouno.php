<?php
// Incluye el archivo de conexión a la base de datos
include(__DIR__ . '/../conexion.php');
require_once 'verificar_sesion.php';

function obtenerUnidadesProyecto1($terminoBusqueda = '') {
    // Establecemos la conexión usando la clase Cconexion
    $conexion = (new Cconexion())->conexionBD(); 
    $unidades = [];

    try {
        // Construir la consulta SQL
        $sql = "SELECT u.id, u.unidad, u.folio_matricula, p.NOMBRE 
                FROM Unidades u 
                JOIN Proyectos p ON u.proyecto_id = p.ID_PROYECTO
                WHERE p.ID_PROYECTO = 25";

        // Agregar filtro de búsqueda si hay un término de búsqueda
        if (!empty($terminoBusqueda)) {
            $sql .= " AND (u.unidad LIKE ? OR u.folio_matricula LIKE ?)";
        }

        // Preparamos la consulta
        $stmt = $conexion->prepare($sql);

        // Si hay un término de búsqueda, vinculamos los parámetros con comodines
        if (!empty($terminoBusqueda)) {
            $param = '%' . $terminoBusqueda . '%';
            $stmt->execute([$param, $param]);
        } else {
            $stmt->execute();
        }

        // Obtenemos los resultados
        $unidades = $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        // Manejamos el error de la base de datos
        echo "Error: " . $e->getMessage();
    }

    // Retornamos los resultados
    return $unidades;
}
?>

