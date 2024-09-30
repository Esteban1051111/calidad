<?php
// Incluir el archivo de conexión a la base de datos
// require_once '../peticiones/verificar_sesion.php';
require_once realpath(dirname(__FILE__) . '/../conexion.php');

function obtenerActosNotariales() {
    try {
        // Obtener la conexión
        $pdo = Cconexion::conexionBD();
        if ($pdo) {
          //  echo "Conexión a la base de datos establecida.<br>";
        } else {
            echo "No se pudo establecer la conexión a la base de datos.<br>";
        }
        
        // Preparar la consulta
        $stmt = $pdo->prepare('SELECT nombre FROM actos_notariales ORDER BY nombre ASC' );
        // Ejecutar la consulta
        $stmt->execute();
        // Obtener todos los resultados
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
        return [];
    }
}
?>