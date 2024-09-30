<?php 
include('../../../templates/headeradmin.php');
include('../../../peticiones/estadosController.php');
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['usuario'])) {
    header('Location: http://localhost/BotPlussFB/login.php');
    exit();
}

$usuario = $_SESSION['usuario']; 
$numradicado = isset($_GET['numRadicado']) ? $_GET['numRadicado'] : null;

// Imprimir el número de radicado para depuración
echo '<p>Número de Radicado: ' . htmlspecialchars($numradicado) . '</p>';

if ($numradicado) {
    $estado_recepcion = traer_estado_recepcion($numradicado);
    $estado_otorgamiento = traer_estado_otorgamiento($numradicado);
    $estado_facturacion = traer_estado_facturacion($numradicado); 
    $estado_revision = traer_estado_revision_juridica($numradicado);
    $estado_autorizacion = traer_estado_autorizacion($numradicado);
    $estado_registro = traer_estado_registro($numradicado);
    $estado_sale_registro = traer_estado_sale_registro($numradicado);
} else {
    $estado_recepcion = null;
    $estado_otorgamiento = null;
    $estado_facturacion = null;
    $estado_revision = null;
    $estado_autorizacion = null;
    $estado_registro = null;
    $estado_sale_registro = null;
}
?>

<div class="container mt-4">
    <table class="table table-bordered estado-table">
        <thead>
            <tr>
                <th scope="col">Estado</th>
                <th scope="col">Fecha estado</th>
                <th scope="col">Usuario</th>
                <th scope="col">Observaciones</th>
                <th scope="col">Actualizar Estado</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $estados = [
                'RECEPCION' => $estado_recepcion,
                'OTORGAMIENTO' => $estado_otorgamiento,
                'FACTURACION' => $estado_facturacion,
                'REVISION JURIDICA' => $estado_revision,
                'AUTORIZACION' => $estado_autorizacion,
                'REGISTRO' => $estado_registro,
                'SALE DE REGISTRO' => $estado_sale_registro,
            ];

            $estado_ids = [
                'RECEPCION' => 1,
                'OTORGAMIENTO' => 2,
                'FACTURACION' => 3,
                'REVISION JURIDICA' => 4,
                'AUTORIZACION' => 5,
                'REGISTRO' => 6,
                'SALE DE REGISTRO' => 7,
            ];

            foreach ($estados as $estado => $datos) {
                $id_estado = $estado_ids[$estado];
                echo '<tr>';
                echo '<td>' . htmlspecialchars($estado) . '</td>';
                echo '<td><input type="text" class="form-control" placeholder="fecha estado" value="' . htmlspecialchars($datos['fecha_estado'] ?? '') . '" readonly></td>';
                echo '<td><input type="text" class="form-control" placeholder="Usuario" value="' . htmlspecialchars($datos['usuario'] ?? '') . '" readonly></td>';
                echo '<td><input type="text" class="form-control observaciones" placeholder="Observaciones" value="' . htmlspecialchars($datos['descripcion'] ?? '') . '"></td>';
                echo '<td>';
                echo '<button type="button" class="btn btn-primary actualizar-estado" data-estado="' . htmlspecialchars($estado) . '" data-num-radicado="' . htmlspecialchars($numradicado) . '" data-usuario="' . htmlspecialchars($usuario) . '" data-id-estado="' . htmlspecialchars($id_estado) . '">Actualizar Estado</button>';
                echo '</td>';
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>

    <button class="btn btn-primary" onclick="history.back()">Atrás</button>

</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.actualizar-estado').forEach(button => {
        button.addEventListener('click', function() {
            let id_estado = this.getAttribute('data-id-estado');
            let numero_radicado = this.getAttribute('data-num-radicado');
            let usuario = this.getAttribute('data-usuario');
            
            // Obtener la fecha actual en formato YYYY-MM-DD
            let now = new Date();
            let year = now.getFullYear();
            let month = ('0' + (now.getMonth() + 1)).slice(-2); // Meses de 1 a 12
            let day = ('0' + now.getDate()).slice(-2); // Días de 1 a 31
            let fecha = `${year}-${month}-${day}`;
            
            let observaciones = this.closest('tr').querySelector('.observaciones').value;

            // Imprimir los valores para depuración
            console.log('ID Estado:', id_estado);
            console.log('Número de Radicado:', numero_radicado);
            console.log('Usuario:', usuario);
            console.log('Fecha:', fecha);
            console.log('Observaciones:', observaciones);

            let formData = new FormData();
            formData.append('id_estado', id_estado);
            formData.append('numero_radicado', numero_radicado);
            formData.append('usuario', usuario);
            formData.append('fecha', fecha);
            formData.append('observaciones', observaciones);

            fetch('../../../peticiones/actualizarestadocontroller.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                alert('Estado actualizado con éxito');
                location.reload();
                console.log(data);
            })
            .catch(error => console.error('Error:', error));
        });
    });
});
</script>

<script src="/docs/5.3/dist/js/bootstrap.bundle.min.js"></script>

<?php 
include('../../../templates/footeradmin.php'); 
?>

<style>
.container {
    max-width: 100%;
    margin: 0 auto;
    padding: 20px;
}

.estado-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

.estado-table th, .estado-table td {
    padding: 10px;
    text-align: left;
    border: 1px solid #ddd;
}

.estado-table th {
    background-color: #f8f9fa;
}

.estado-table td input {
    width: 100%;
    padding: 5px;
    box-sizing: border-box;
}

.estado-table td button {
    width: 100%;
}

.estado-table td input.observaciones {
    width: 100%;
    flex-grow: 2;
}
</style>
