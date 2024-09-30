<?php
require_once '../../peticiones/verificar_sesion.php';

?>
<?php include('../../templates/headeradmin.php'); ?>
<br />
<link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
<div class="container my-5">
    <div class="d-flex flex-row flex-nowrap overflow-auto">
        <div class="card custom-margin mx-2" style="width: 18rem;">
            <a href="../../secciones/admin/opciones_radicacion/" class="card-link">
                <img src="../../img/escribiendo.jpg" class="card-img-top" alt="graficos">
                <div class="card-body text-center">
                    <p class="card-text">Radicación</p>
                </div>
            </a>
        </div>
        <!--
        <div class="card custom-margin mx-2" style="width: 18rem;">
            <a href="../../secciones/admin/radicacion_electronica/index.php" class="card-link">
                <img src="../../img/radicacioneP.jpg" class="card-img-top" alt="graficos">
                <div class="card-body text-center">
                    <p class="card-text">REL</p>
                </div>
            </a>
        </div>
-->
        <div class="card custom-margin mx-2" style="width: 18rem;">
            <a href="../../secciones/admin/graficas/index.php" class="card-link">
                <img src="../../img/graficasp.jpg" class="card-img-top" alt="graficos">
                <div class="card-body text-center">
                    <p class="card-text">Informes</p>
                </div>
            </a>
        </div>
        
        <div class="card custom-margin mx-2" style="width: 18rem;">
            <a href="../../secciones/admin/registro/" class="card-link">
                <img src="../../img/loginp.jpg" class="card-img-top" alt="graficos">
                <div class="card-body text-center">
                    <p class="card-text">Usuarios</p>
                </div>
            </a>
        </div>
        <div class="card custom-margin mx-2" style="width: 18rem;">
            <a href="../../secciones/admin/list_rad_enviados/index.php" class="card-link">
                <img src="../../img/buscarp.jpg" class="card-img-top" alt="graficos">
                <div class="card-body text-center">
                    <p class="card-text">Estado Escrituras</p>
                </div>
            </a>
        </div>

        <!--
        <div class="card custom-margin mx-2" style="width: 18rem;">
            <a href="../../secciones/admin/archivo/" class="card-link">
                <img src="../../img/vigencias.jpg" class="card-img-top" alt="graficos">
                <div class="card-body text-center">
                    <p class="card-text">archivo</p>
                </div>
            </a>
        </div>-->
        
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>

<script>window.addEventListener("unload", function(event) {
    // Hacer una solicitud al servidor para cerrar la sesión
    fetch('cerrar_sesion.php', {
        method: 'POST'
        // Puedes incluir más opciones de la solicitud aquí si es necesario
    });
});
</script>



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
  }

  .card {
    flex: 1 1 calc(33.333% - 1rem);
    /* Ajusta el ancho de las tarjetas para que ocupen un tercio del contenedor menos el gap */
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
    /* Elimina el subrayado de los enlaces */
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
<?php include('../../templates/footeradmin.php'); ?>