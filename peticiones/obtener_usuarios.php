<?php
include('../../../../conexion.php');

function obtenerUsuarios($termino = '') {

    $conn =Cconexion::conexionBD();

    
    if ($termino) {
        $sql = "SELECT id_usuario, nombres, apellidos, correo, celular, empresa, tipo_usuario, usuario, activo, puntaje 
                FROM usuarios 
                WHERE id_usuario LIKE ? OR 
                      nombres LIKE ? OR 
                      apellidos LIKE ? OR 
                      correo LIKE ? OR 
                      celular LIKE ? OR 
                      empresa LIKE ? OR 
                      tipo_usuario LIKE ? OR 
                      usuario LIKE ? OR
                      activo LIKE ? OR
                      puntaje LIKE ?";
                      
        $stmt = $conn->prepare($sql);
        $param = '%' . $termino . '%';
        $stmt->execute([$param, $param, $param, $param, $param, $param, $param, $param, $param, $param]);
    } else {
        $sql = "SELECT id_usuario, nombres, apellidos, correo, celular, empresa, tipo_usuario, usuario, activo, puntaje FROM usuarios";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
    }
    
    $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $usuarios;
}
?>

