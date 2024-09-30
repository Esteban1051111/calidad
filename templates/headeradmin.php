<?php
// Incluye el archivo que verifica la sesión
// Incluye el archivo de configuración
include __DIR__ . '/../config.php';
include BASE_PATH . '/peticiones/verificar_sesion.php';

// Definir URL base automáticamente
$base_url = 'http://' . $_SERVER['HTTP_HOST'] . '/BotPlussFB/';


// Asigna el nombre de usuario de la sesión a una variable
$username = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : 'Invitado';

$url_base = "http://localhost/botplussFB/";
$url_baseimg = "http://localhost/botplussFB/img/N2T.png";

?>
<!doctype html>
<html lang="en">
    <head>
        <title>BotPluss</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

        <!-- Bootstrap CSS v5.3.2 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
        
        <style>
            .nav-link {
                color: black !important;
                transition: color 0.3s;
            }
            .nav-link:hover {
                color: #ee7203 !important;
            }
            .logo {
                max-height: 50px; /* Ajusta este tamaño según sea necesario */
                margin-right: 1rem;
            }
            .navbar {
                background-color: #0faedd;
            }
            .welcome-message {
                color: black;
                font-size: 18px;
                margin: auto;
            }

            .notification-bell {
                position: relative;
                display: inline-block;
            }
            .notification-bell .badge {
                position: absolute;
                top: -10px;
                right: -10px;
                background-color: red;
                color: white;
                border-radius: 50%;
                padding: 5px 10px;
                font-size: 12px;
            }
        </style>
    </head>

    <body>
    <div class="container_header">
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #a19e9e;">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="<?php echo $url_baseimg; ?>" alt="Logo" class="logo"/> 
            </a>
            <span class="welcome-message">Bienvenido, <?php echo htmlspecialchars($username); ?></span>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a href="<?php echo $base_url; ?>secciones/admin/index.php" class="nav-link">Inicio</a></li>
                    <li class="nav-item"><a href="<?php echo $base_url; ?>secciones/admin/opciones_radicacion/index.php" class="nav-link">Radicación</a></li>
                    <li class="nav-item"><a href="<?php echo $base_url; ?>secciones/admin/graficas/index.php" class="nav-link">Informes</a></li>                    
                    <li class="nav-item"><a href="<?php echo $base_url; ?>peticiones/cerrar_sesion.php" class="nav-link">Cerrar Sesión</a></li>
                    <li class="nav-item">
                        <div class="notification-bell" id="notificationBell">
                            <i class="bi bi-bell"></i>
                            <?php if (isset($_SESSION['notification'])) : ?>
                                <span class="notification-count" id="notificationCount">!</span>
                            <?php endif; ?>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>

<main class="container">

<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>


<script>
    $(document).ready(function() {
        // Muestra la notificación si hay algún mensaje en la sesión
        <?php if (isset($_SESSION['notification'])) : ?>
            alert("<?php echo addslashes($_SESSION['notification']); ?>");
            <?php unset($_SESSION['notification']); // Limpiar la notificación después de mostrar ?>
        <?php endif; ?>
    });
</script>