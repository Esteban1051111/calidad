<?php
//require_once '../../../peticiones/verificar_sesion.php';
?>

<?php include('../../../templates/headeradmin.php'); ?>
<br/>
<div class="card bg-dark custom-margin">
    <div class="card bg-light">
        <div class="card-header">CREAR USUARIO</div>
        <div class="card-body">
            <div class="table-responsive-sm">
                <div class="container">
                    <?php if (isset($_GET['message'])): ?>
                        <div class="alert alert-info">
                            <?= htmlspecialchars($_GET['message']) ?>
                        </div>
                    <?php endif; ?>
                    <form action="http://localhost/BotPlussFB/peticiones/registrocontroller.php" method="POST">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="nombreCompleto" class="form-label">Nombre Completo</label>
                                    <input type="text" class="form-control" name="nombreCompleto" id="nombreCompleto" aria-describedby="helpId" placeholder="Nombre Completo..." required />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="apellidoCompleto" class="form-label">Apellidos Completos</label>
                                    <input type="text" class="form-control" name="apellidoCompleto" id="apellidoCompleto" aria-describedby="helpId" placeholder="Apellidos Completos..." required />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="usuario" class="form-label">Usuario</label>
                                    <input type="text" class="form-control" name="usuario" id="usuario" aria-describedby="helpId" placeholder="Nombre de Usuario..." required />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Correo</label>
                                    <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelpId" placeholder="abc@mail.com" required />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="password" class="form-label">Contraseña</label>
                                    <input type="password" class="form-control" name="password" id="password" placeholder="Ingresar Password" required />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="confirmPassword" class="form-label">Confirmar Contraseña</label>
                                    <input type="password" class="form-control" name="confirmPassword" id="confirmPassword" placeholder="Confirma Password" required />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="telefono" class="form-label">Teléfono</label>
                                    <input type="tel" class="form-control" name="telefono" id="telefono" placeholder="Ingresar teléfono" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="empresa" class="form-label">Empresa</label>
                                    <input type="text" class="form-control" name="empresa" id="empresa" aria-describedby="helpId" placeholder="Empresa..." />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="exampleFormControlSelect1" class="form-label">Tipo de usuario</label>
                                    <select class="form-select" name="tipoUsuario" id="exampleFormControlSelect1" required>
                                        <option value="administrador">Administrador</option>
                                        <option value="archivo">Archivo</option>
                                        <option value="constructora">Constructora</option>
                                        <option value="digitador">Digitador</option>
                                        <option value="orip">ORIP</option>
                                        <option value="radicador">Radicador</option>                                   
                                        
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="activo" class="form-label">Activo</label>
                                    <input type="hidden" name="activo" value="0">
                                    <input type="checkbox" class="form-check-input" name="activo" id="activo" value="1">
                                </div>                                
                            </div>
                        </div>

                        <br/>

                        <div class="row">
                            <div class="col">
                                <button type="submit" class="btn btn-primary btn-lg">Crear Usuario</button>
                                <a href="../../../secciones/admin/registro/list_users/index.php" class="btn btn-primary btn-lg">Buscar usuario</a>                                  
                                <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#digitadorModal">Usuario Digitador</button>
                                <a href="../../../secciones/admin/index.php" class="btn btn-primary btn-lg ">Atrás</a>
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- modal de digitador-->


<!-- Modal -->
<div class="modal fade" id="digitadorModal" tabindex="-1" aria-labelledby="digitadorModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="digitadorModalLabel">Información de Usuarios Digitadores</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nombre de Usuario</th>
                            <th>Puntaje</th>
                        </tr>
                    </thead>
                    <tbody id="tablaDigitadores">
                        <!-- Los datos se cargarán aquí dinámicamente -->
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var digitadorButton = document.querySelector('[data-bs-target="#digitadorModal"]');

    digitadorButton.addEventListener('click', function () {
        // Aquí debes hacer una petición para obtener los datos del usuario digitador
        // Por ejemplo, usando fetch o AJAX para obtener los datos desde el servidor

        fetch('http://localhost/BotPlussFB/peticiones/digitadorcontroller.php')
            .then(response => response.json())
            .then(data => {
                // Limpiar la tabla antes de agregar los nuevos datos
                var tablaDigitadores = document.getElementById('tablaDigitadores');
                tablaDigitadores.innerHTML = '';

                // Verificar si data contiene múltiples usuarios o un solo usuario
                if (Array.isArray(data)) {
                    data.forEach(function(usuario) {
                        var row = `<tr>
                            <td>${usuario.usuario}</td>
                            <td>${usuario.puntaje}</td>
                        </tr>`;
                        tablaDigitadores.innerHTML += row;
                    });
                } else {
                    var row = `<tr>
                        <td>${data.usuario}</td>
                        <td>${data.puntaje}</td>
                    </tr>`;
                    tablaDigitadores.innerHTML += row;
                }
            })
            .catch(error => {
                console.error('Error al obtener los datos del usuario digitador:', error);
            });
    });
});
</script>




<style>
.custom-margin {
  margin-top: 20px; 
  margin-bottom: 70px; 
}

.pagination .page-link {
  color: black;
}

.form-check-input {
    /* Ajusta el tamaño del checkbox si es necesario */
    width: 20px;
    height: 20px;
    accent-color: #007bff; /* Cambia el color del checkbox (también funciona en navegadores modernos) */
}

.form-check-input:checked {
    background-color: #007bff; /* Color cuando está marcado */
    border-color: #007bff; /* Color del borde cuando está marcado */
}

/* Para navegadores que no soportan `accent-color`, puedes usar pseudo-elementos */
.form-check-input {
    position: relative;
    appearance: none;
    background-color: #fff;
    border: 2px solid #007bff;
    border-radius: 4px;
    width: 20px;
    height: 20px;
    cursor: pointer;
}

.form-check-input:checked::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 12px;
    height: 12px;
    background-color: #007bff; /* Color del checkmark */
    border-radius: 2px;
}

</style>

<?php include('../../../templates/footeradmin.php'); ?>