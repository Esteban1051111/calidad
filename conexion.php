<?php
class Cconexion {
    public static function conexionBD() {
        $host = "localhost";
        $dbname = "BotplussBD";
        $usuario = "adminnot";
        $contraseña = "12345";
        $puerto = "1433";

        try {
            $conn = new PDO("sqlsrv:Server=$host,$puerto;Database=$dbname", $usuario, $contraseña);
           
        } catch (PDOException $exp) {
            echo "No se pudo conectar: " . $exp->getMessage();
        }
        return $conn;
    }
}


?>