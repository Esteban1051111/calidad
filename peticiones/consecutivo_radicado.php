<?php
require_once '../peticiones/verificar_sesion.php';
//require_once $_SERVER['DOCUMENT_ROOT'] . '/BotPlussFB/peticiones/verificar_sesion.php';
require_once '../conexion.php';
//require_once $_SERVER['DOCUMENT_ROOT'] . '/BotPlussFB/conexion.php';


// Conectar a la base de datos usando PDO

$conn =Cconexion::conexionBD();


try {
    
    // Consultar para obtener el próximo número de radicado disponible
    $query = "SELECT TOP 1 numero_radicado FROM consecutivoradicado WHERE utilizado = 0 ";

    $stmt = $conn->prepare($query);
    $stmt->execute();

    // Obtener el resultado directamente con fetch
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verificar si se encontró un número de radicado disponible
    if ($row) {
        $nuevoRadicadoNumero = $row['numero_radicado'];
    // Redirigir al usuario a la página de radicación con el nuevo número de radicado
        header("Location: ../secciones/admin/radicacion/index.php?radicado=$nuevoRadicadoNumero");
        exit();
    } else {
        echo "No hay números de radicado disponibles.";
    }
} catch (PDOException $e) {
    // Revertir la transacción en caso de error
    $conn->rollBack();
    echo "Error: " . $e->getMessage();
}

// Cerrar la conexión
$conn = null;
?>
