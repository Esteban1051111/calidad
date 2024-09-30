<?php
require '../vendor/autoload.php'; // Asegúrate de que esta ruta sea correcta

use PhpOffice\PhpSpreadsheet\IOFactory;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $fileTmpPath = $_FILES['file']['tmp_name'];
    $spreadsheet = IOFactory::load($fileTmpPath);
    $sheet = $spreadsheet->getActiveSheet();
    $data = $sheet->toArray();

    $output = '<div class="container mt-5">
        <h1 class="mb-4">Datos del Excel</h1>';

    foreach ($data as $index => $row) {
        if ($index === 0) continue; // Omitir la fila de encabezados

        $output .= '<div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">Fila ' . ($index + 1) . '</h5>';

        $output .= '<div class="row">';
        foreach ($row as $key => $cell) {
            $output .= '<div class="col"><p class="card-text"><strong>' . htmlspecialchars($data[0][$key]) . ':</strong> ' . htmlspecialchars($cell) . '</p></div>';
        }
        $output .= '</div>'; // Cierre del row

        $output .= '<a href="#" class="btn btn-primary">Actualizar</a>
                <a href="#" class="btn btn-danger">Eliminar</a>
            </div>
        </div>';
    }

    $output .= '</div>';

    echo $output;
}
?>