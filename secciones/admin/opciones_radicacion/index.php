<?php
require_once '../../../peticiones/verificar_sesion.php';
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

if (isset($_SESSION['success_message'])) {
  echo "<div class='alert alert-success'>{$_SESSION['success_message']}</div>";
  unset($_SESSION['success_message']); // Eliminar el mensaje de la sesión
}
?>
<?php include('../../../templates/headeradmin.php') ?>

<br />
<div class="container my-5">  
<div class="d-flex flex-row flex-nowrap overflow-auto">
  <div class="card custom-margin mx-2" style="width: 15rem;">
    <a href="../../../peticiones/consecutivo_radicado.php" class="card-link">
      <img src="../../../img/nuevoradicadop.jpg" class="card-img-top" alt="graficos">
      <div class="card-body text-center">
        <p class="card-text">Nuevo Radicado</p>
      </div>
    </a>
  </div>
  <div class="card custom-margin mx-2" style="width: 15rem;">
    <a href="../../../secciones/admin/masivos/index.php" class="card-link">
      <img src="../../../img/masivosp.jpg" class="card-img-top" alt="graficos">
      <div class="card-body text-center">
        <p class="card-text">Carga Masiva</p>
      </div>
    </a>
  </div>
  <div class="card custom-margin mx-2" style="width: 15rem;">
    <a href="../cargue_documentos/index.php" class="card-link">
      <img src="../../../img/consultarradicadosp.jpg" class="card-img-top" alt="graficos">
      <div class="card-body text-center">
        <p class="card-text">Cargue Documentos</p>
      </div>
    </a>
  </div>
  <div class="card custom-margin mx-2" style="width: 15rem;">
    <a href="../list_rad_enviados/index.php" class="card-link">
      <img src="../../../img/consultarradicadosp.jpg" class="card-img-top" alt="graficos">
      <div class="card-body text-center">
        <p class="card-text">Consultar Radicados</p>
      </div>
    </a>
  </div>
  <div class="card custom-margin mx-2" style="width: 15rem;">
    <a href="../proyectos_constructora/index.php" class="card-link">
      <img src="../../../img/consultarradicadosp.jpg" class="card-img-top" alt="graficos">
      <div class="card-body text-center">
        <p class="card-text">Proyectos</p>
      </div>
    </a>
  </div>


</div>
<div class="container">
  <a href="../../../secciones/admin/index.php" class="btn btn-primary btn-lg mb-4">Atrás</a>
</div>
</div>
<style>
  .card-container {
    display: flex;
    flex-wrap: wrap;
    /* Permite que las tarjetas se envuelvan a la siguiente línea si no caben */
    justify-content: center;
    /* Centra las tarjetas horizontalmente */
    gap: 1rem;
    /* Espacio entre las tarjetas */
    padding: 1rem;
    /* Espacio alrededor del contenedor de tarjetas */
    overflow-x: auto;
  }

  .card {
    flex: 1 1 calc(33.333% - 1rem);
    /* Ajusta el ancho de las tarjetas para que ocupen un tercio del contenedor menos el gap */
    width: 15rem; /* Ajustar el ancho fijo de las tarjetas */
    max-width: 18rem;
    /* Ancho máximo de cada tarjeta */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    /* Añade una sombra a las tarjetas para mejor visualización */
    transition: transform 0.2s;
    /* Añade una transición para el efecto hover */
    overflow: hidden;
    /* Asegura que el contenido no se salga de la tarjeta */
  }

  .card:hover {
    transform: scale(1.05);
    /* Efecto de agrandamiento en hover */
  }

  .card img {
    width: 100%;
    /* Asegura que la imagen se ajuste al ancho de la tarjeta */
    height: auto;
    /* Mantiene la proporción de la imagen */
  }

  .card-link {
    text-decoration: none;
    /* Elimina la subrayado de los enlaces */
    color: inherit;
    /* Mantiene el color del texto de las tarjetas */
    display: block;
    /* Asegura que el enlace ocupe todo el espacio de la tarjeta */
  }

  .card-link:hover .card {
    transform: none;
    /* Evita que el efecto hover se aplique dos veces */
  }

  .card-link:hover {
    text-decoration: none;
    /* Asegura que no se subraye el texto al hacer hover */
  }

  @media (max-width: 768px) {
    .card {
      flex: 1 1 calc(50% - 1rem);
      /* En pantallas medianas, cada tarjeta ocupa la mitad del contenedor */
    }
  }

  @media (max-width: 480px) {
    .card {
      flex: 1 1 calc(100% - 1rem);
      /* En pantallas pequeñas, cada tarjeta ocupa el ancho completo del contenedor */
    }
  }

  .custom-margin {
    margin-top: 70px;
    /* Ajusta este valor según sea necesario */
    margin-bottom: 70px;
    /* Ajusta este valor según sea necesario */
  }
</style>


<?php include('../../../templates/footeradmin.php'); ?>