<?php
require_once '../conexion.php';

$c = new Cconexion();
$conexion = $c->conexionBD();

// Verificar si se reciben datos
if (!isset($_POST['pendiente'])) {
    die('Error: No se han enviado datos.');
}

// Recibe los datos del formulario
$pendiente = $_POST['pendiente'];  // Puede ser 'si' o 'no'
$escritura = $_POST['escritura'];
$radicado = $_POST['radicado'];
$nir = $_POST['nir'];
$turno = $_POST['turno'];
$banco = $_POST['banco'];
$constructora = $_POST['constructora'];
$departamento = $_POST['departamento'];
$municipio = $_POST['municipio'];
$observaciones = $_POST['observaciones'];
$pago_renta = $_POST['pago_renta'];  // Puede ser 'si' o 'no'
$pago_registro = $_POST['pago_registro'];  // Puede ser 'si' o 'no'
$constancia_inscripcion = $_POST['constancia_inscripcion'];  // Puede ser 'si' o 'no'
$nota_devolutiva = $_POST['nota_devolutiva'];  // Puede ser 'si' o 'no'

// Convertir los valores de BIT a 0 o 1
$pendiente = ($pendiente === 'si') ? 1 : 0;
$pago_renta = ($pago_renta === 'si') ? 1 : 0;
$pago_registro = ($pago_registro === 'si') ? 1 : 0;
$constancia_inscripcion = ($constancia_inscripcion === 'si') ? 1 : 0;
$nota_devolutiva = ($nota_devolutiva === 'si') ? 1 : 0;

// Convertir los valores de las claves foráneas a enteros
$banco = (int) $banco;
$constructora = (int) $constructora;
$departamento = (int) $departamento;
$municipio = (int) $municipio;

// Verificar existencia de claves foráneas
function checkForeignKey($conexion, $table, $id) {
    $stmt = $conexion->prepare("SELECT COUNT(*) FROM $table WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetchColumn() > 0;
}

// Comprobar existencia de claves foráneas
$tables = [
    'bancos' => $banco,
    'constructoras' => $constructora,
    'departamentos' => $departamento,
    'municipios' => $municipio
];

foreach ($tables as $table => $id) {
    if (!checkForeignKey($conexion, $table, $id)) {
        die("Error: ID de $table no existe.");
    }
}

// Preparar la consulta SQL
$sql = "INSERT INTO escrituras_del_dia (pendiente, escritura, radicado, nir, turno, banco_id, constructora_id, departamento_id, municipio_id, observaciones, pago_renta, pago_registro, constancia_inscripcion, nota_devolutiva)
        VALUES (:pendiente, :escritura, :radicado, :nir, :turno, :banco, :constructora, :departamento, :municipio, :observaciones, :pago_renta, :pago_registro, :constancia_inscripcion, :nota_devolutiva)";

try {
    // Verificar si la conexión está activa
    if (!$conexion) {
        die("Error: No se pudo conectar a la base de datos.");
    }

    // Preparar y ejecutar la consulta
    $stmt = $conexion->prepare($sql);
    if ($stmt->execute([
        ':pendiente' => $pendiente,
        ':escritura' => $escritura,
        ':radicado' => $radicado,
        ':nir' => $nir,
        ':turno' => $turno,
        ':banco' => $banco,
        ':constructora' => $constructora,
        ':departamento' => $departamento,
        ':municipio' => $municipio,
        ':observaciones' => $observaciones,
        ':pago_renta' => $pago_renta,
        ':pago_registro' => $pago_registro,
        ':constancia_inscripcion' => $constancia_inscripcion,
        ':nota_devolutiva' => $nota_devolutiva
    ])) {
        echo "Escritura guardada exitosamente.";
    } else {
        $errorInfo = $stmt->errorInfo();
        echo "Error en la ejecución de la consulta SQL: " . $errorInfo[2];
    }
} catch (PDOException $e) {
    // Manejo de errores
    error_log("Error al guardar la escritura: " . $e->getMessage(), 0);
    echo "Error al guardar la escritura: " . $e->getMessage();
}
?>
