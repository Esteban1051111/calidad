<?php
define('ROOT_PATH', __DIR__ . '/../../../');

// Incluir el archivo de verificación de sesión
require_once ROOT_PATH . 'peticiones/verificar_sesion.php';
?>
<?php include('../../../templates/headeradmin.php'); ?>
<br />
<link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">

<div class="container my-5">
    <div class="d-flex justify-content-center flex-wrap">
        <div class="card custom-margin mx-2" style="width: 18rem;">
            <a href="../../admin/radicacion_electronica/escritura_del_dia/index.php" class="card-link">
                <img src="../../../img/escrituradeldia.jpg" class="card-img-top" alt="graficos">
                <div class="card-body text-center">
                    <p class="card-text">Escrituras del Día</p>
                </div>
            </a>
        </div>
        <div class="card custom-margin mx-2" style="width: 18rem;">
            <a href="../../admin/radicacion_electronica/estado_de_las_escrituras/index.php" class="card-link">
                <img src="../../../img/estadoescrituras.jpg" class="card-img-top" alt="graficos">
                <div class="card-body text-center">
                    <p class="card-text">Estado de las Escrituras</p>
                </div>
            </a>
        </div>
        
    </div>  
    <div class="container">
        <a href="../../../secciones/admin/index.php" class="btn btn-primary btn-lg mb-4">Atrás</a>
</div>  
</div>




<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>

<script>
window.addEventListener("unload", function(event) {
    // Hacer una solicitud al servidor para cerrar la sesión
    fetch('cerrar_sesion.php', {
        method: 'POST'
        // Puedes incluir más opciones de la solicitud aquí si es necesario
    });
});
</script>

<style>
  .card {
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Añade una sombra a las tarjetas para mejor visualización */
    transition: transform 0.2s; /* Añade una transición para el efecto hover */
    overflow: hidden; /* Asegura que el contenido no se salga de la tarjeta */
  }

  .card:hover {
    transform: scale(1.05); /* Efecto de agrandamiento en hover */
  }

  .card img {
    width: 100%; /* Asegura que la imagen se ajuste al ancho de la tarjeta */
    height: auto; /* Mantiene la proporción de la imagen */
  }

  .card-link {
    text-decoration: none; /* Elimina el subrayado de los enlaces */
    color: inherit; /* Mantiene el color del texto de las tarjetas */
    display: block; /* Asegura que el enlace ocupe todo el espacio de la tarjeta */
  }

  .card-link:hover .card {
    transform: none; /* Evita que el efecto hover se aplique dos veces */
  }

  .card-link:hover {
    text-decoration: none; /* Asegura que no se subraye el texto al hacer hover */
  }

  .custom-margin {
    margin-top: 70px; /* Ajusta este valor según sea necesario */
    margin-bottom: 70px; /* Ajusta este valor según sea necesario */
  }

  @media (max-width: 768px) {
    .card {
      flex: 1 1 calc(50% - 1rem); /* En pantallas medianas, cada tarjeta ocupa la mitad del contenedor */
    }
  }

  @media (max-width: 480px) {
    .card {
      flex: 1 1 calc(100% - 1rem); /* En pantallas pequeñas, cada tarjeta ocupa el ancho completo del contenedor */
    }
  }
</style>

<?php include('../../../templates/footeradmin.php'); ?>
