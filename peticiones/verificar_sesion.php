<?php
// Verificar si la sesión no está activa antes de iniciarla nuevamente
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['usuario'])) {
   header('Location: http://localhost/BotPlussFB/login.php');
   exit();
}
?>
