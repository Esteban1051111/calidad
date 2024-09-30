<?php
require '../../conexion.php';
require '../../vendor/autoload.php'; // Asegúrate de que esto incluya la carga automática de PhpSpreadsheet

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Obtener las fechas desde el formulario enviado por POST
$startDate = isset($_POST['startDate']) ? $_POST['startDate'] : null;
$endDate = isset($_POST['endDate']) ? $_POST['endDate'] : null;
$action = isset($_POST['action']) ? $_POST['action'] : null;

// Validar que las fechas no sean nulas
if (!$startDate || !$endDate) {
    echo "<script>alert('Por favor ingrese un rango de fechas válido.'); window.history.back();</script>";
    exit();
}

// Comparar si la fecha final es menor que la fecha inicial
if ($endDate < $startDate) {
    echo "<script>alert('La fecha final no puede ser menor que la fecha inicial.'); window.history.back();</script>";
    exit();
}

// Realizar la consulta según el botón presionado
switch ($action) {
    case 'radicacion':
        $datos = informe_radicados($startDate, $endDate);
        break;
    case 'digitacion':
        $datos = informe_digitacion($startDate, $endDate);
        break;
    case 'facturacion':
        $datos = informe_radicados($startDate, $endDate);
        break;
    case 'informe4':
        $datos = informe_radicados($startDate, $endDate);
        break;
    default:
        echo "<script>alert('Consulta no válida.'); window.history.back();</script>";
        exit();
}

// Función para obtener los datos de la radicación según el rango de fechas
function informe_radicados($startDate, $endDate) {
    $conn = Cconexion::conexionBD();

    // Consulta SQL para obtener los radicados dentro del rango de fechas
    $sql = "
        SELECT 
            r.NUM_RADICADO,
            r.NUM_ESCRITURA,
            r.ACTO_NOTARIAL,
            r.PROYECTO,
            er.fecha_estado,
            er.descripcion,
            er.usuario,
            e.nombre_estado
        FROM Radicados r
        JOIN estado_radicado er ON er.numero_radicado = r.NUM_RADICADO
        JOIN estados e ON e.id_estado = er.id_estado
        WHERE e.nombre_estado = 'RECEPCION'
        AND er.fecha_estado BETWEEN :startDate AND :endDate
    ";

    // Preparar y ejecutar la consulta
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':startDate', $startDate);
    $stmt->bindParam(':endDate', $endDate);
    $stmt->execute();
    
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function informe_digitacion($startDate, $endDate) {
    $conn = Cconexion::conexionBD();

    // Consulta SQL con menos parámetros
    $sql = "
        SELECT 
            r.NUM_RADICADO,
            r.NUM_ESCRITURA,
            r.ACTO_NOTARIAL,
            r.PROYECTO,
            er.fecha_estado,
            er.descripcion,
            er.usuario,
            e.nombre_estado
        FROM Radicados r
        JOIN estado_radicado er ON er.numero_radicado = r.NUM_RADICADO
        JOIN estados e ON e.id_estado = er.id_estado
        WHERE e.nombre_estado = 'RECEPCION'
        AND er.fecha_estado BETWEEN :startDate AND :endDate
    ";

    // Preparar y ejecutar la consulta con solo dos parámetros
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':startDate', $startDate);
    $stmt->bindParam(':endDate', $endDate);
    $stmt->execute();
    
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Generar el archivo Excel con los datos obtenidos
if ($datos) {
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Agregar encabezados
    $sheet->setCellValue('A1', 'Número Radicado');
    $sheet->setCellValue('B1', 'Número Escritura');
    $sheet->setCellValue('C1', 'Acto Notarial');
    $sheet->setCellValue('D1', 'Proyecto');
    $sheet->setCellValue('E1', 'Fecha Estado');
    $sheet->setCellValue('F1', 'Descripción');
    $sheet->setCellValue('G1', 'Usuario');
    $sheet->setCellValue('H1', 'Nombre Estado');

    // Obtener los datos y rellenar las filas del Excel
    $row = 2;
    foreach ($datos as $radicado) {
        $sheet->setCellValue('A' . $row, $radicado['NUM_RADICADO']);
        $sheet->setCellValue('B' . $row, $radicado['NUM_ESCRITURA']);
        $sheet->setCellValue('C' . $row, $radicado['ACTO_NOTARIAL']);
        $sheet->setCellValue('D' . $row, $radicado['PROYECTO']);
        $sheet->setCellValue('E' . $row, $radicado['fecha_estado']);
        $sheet->setCellValue('F' . $row, $radicado['descripcion']);
        $sheet->setCellValue('G' . $row, $radicado['usuario']);
        $sheet->setCellValue('H' . $row, $radicado['nombre_estado']);
        $row++;
    }

    // Generar el archivo Excel
    $writer = new Xlsx($spreadsheet);

    // Establecer los encabezados para la descarga
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="Informe.xlsx"');
    header('Cache-Control: max-age=0');

    // Enviar el archivo al navegador
    $writer->save('php://output');
    exit();
} else {
    echo "<script>alert('No se encontraron datos para el rango de fechas seleccionado.'); window.history.back();</script>";
    exit();
}
?>
