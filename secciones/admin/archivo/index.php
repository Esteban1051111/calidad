<?php require_once '../../../peticiones/verificar_sesion.php'; ?>
<?php include('../../../templates/headeradmin.php'); ?>

<div class="d-flex justify-content-center align-items-center" style="height: 70vh;">
    <div class="card custom-margin mx-2" style="width: 18rem;">
        <a href="../../../secciones/admin/archivo/vigencias_poder/vigencia_rad.php" class="card-link">
            <img src="../../img/graficasp.jpg" class="card-img-top" alt="graficos">
            <div class="card-body text-center">
                <p class="card-text">Crear desde la radicación</p>
            </div>
        </a>
    </div>

    <div class="card custom-margin mx-2" style="width: 18rem;">
        <a href="../../secciones/admin/registro/" class="card-link">
            <img src="../../img/loginp.jpg" class="card-img-top" alt="graficos">
            <div class="card-body text-center">
                <p class="card-text">Crear con la escritura</p>
            </div>
        </a>
    </div>
</div>

<?php include('../../../templates/footeradmin.php'); ?>
