<?php
require_once '../../../conexion.php';


function traer_estado_recepcion($numRadicado) {
    // Crear la conexión a la base de datos
    $conn = Cconexion::conexionBD();

    // Consulta para obtener el radicado por número y estado 1
    $sql = "SELECT 
                er.numero_radicado,
                CONVERT(varchar, er.fecha_estado, 23) AS fecha_estado,
                er.descripcion,
                er.usuario,
                e.nombre_estado
            FROM 
                estado_radicado er
            JOIN 
                estados e ON e.id_estado = er.id_estado
            WHERE 
                er.numero_radicado = :numero_radicado
                AND er.id_estado = 1";  // Aquí se corrige la condición AND

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':numero_radicado', $numRadicado);
    $stmt->execute();
    
    return $stmt->fetch(PDO::FETCH_ASSOC); // Usar fetchAll para obtener todos los registros
}

//-------------------------------------traer estado otorgamiento-----------------------------
function traer_estado_otorgamiento($numRadicado) {
    // Crear la conexión a la base de datos
    $conn = Cconexion::conexionBD();

    // Consulta para obtener el radicado por número y estado 1
    $sql = "SELECT 
                er.numero_radicado,
               CONVERT(varchar, er.fecha_estado, 23) AS fecha_estado,
                er.descripcion,
                er.usuario,
                e.nombre_estado
            FROM 
                estado_radicado er
            JOIN 
                estados e ON e.id_estado = er.id_estado
            WHERE 
                er.numero_radicado = :numero_radicado
                AND er.id_estado = 2";  // Aquí se corrige la condición AND

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':numero_radicado', $numRadicado);
    $stmt->execute();
    
    return $stmt->fetch(PDO::FETCH_ASSOC); // Usar fetchAll para obtener todos los registros
}

//--------------------------------traer estado facturacion-------------------------------------------
function traer_estado_facturacion($numRadicado) {
    // Crear la conexión a la base de datos
    $conn = Cconexion::conexionBD();

    // Consulta para obtener el radicado por número y estado 1
    $sql = "SELECT 
                er.numero_radicado,
               CONVERT(varchar, er.fecha_estado, 23) AS fecha_estado,
                er.descripcion,
                er.usuario,
                e.nombre_estado
            FROM 
                estado_radicado er
            JOIN 
                estados e ON e.id_estado = er.id_estado
            WHERE 
                er.numero_radicado = :numero_radicado
                AND er.id_estado = 3";  // Aquí se corrige la condición AND

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':numero_radicado', $numRadicado);
    $stmt->execute();
    
    return $stmt->fetch(PDO::FETCH_ASSOC); // Usar fetchAll para obtener todos los registros
}
//--------------------------------traer estado revision juridica-------------------------------------------
function traer_estado_revision_juridica($numRadicado) {
    // Crear la conexión a la base de datos
    $conn = Cconexion::conexionBD();

    // Consulta para obtener el radicado por número y estado 1
    $sql = "SELECT 
                er.numero_radicado,
                CONVERT(varchar, er.fecha_estado, 23) AS fecha_estado,
                er.descripcion,
                er.usuario,
                e.nombre_estado
            FROM 
                estado_radicado er
            JOIN 
                estados e ON e.id_estado = er.id_estado
            WHERE 
                er.numero_radicado = :numero_radicado
                AND er.id_estado = 4";  // Aquí se corrige la condición AND

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':numero_radicado', $numRadicado);
    $stmt->execute();
    
    return $stmt->fetch(PDO::FETCH_ASSOC); // Usar fetchAll para obtener todos los registros
}
//--------------------------------traer estado facturacion-------------------------------------------
function traer_estado_autorizacion($numRadicado) {
    // Crear la conexión a la base de datos
    $conn = Cconexion::conexionBD();

    // Consulta para obtener el radicado por número y estado 1
    $sql = "SELECT 
                er.numero_radicado,
                CONVERT(varchar, er.fecha_estado, 23) AS fecha_estado,
                er.descripcion,
                er.usuario,
                e.nombre_estado
            FROM 
                estado_radicado er
            JOIN 
                estados e ON e.id_estado = er.id_estado
            WHERE 
                er.numero_radicado = :numero_radicado
                AND er.id_estado = 5";  // Aquí se corrige la condición AND

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':numero_radicado', $numRadicado);
    $stmt->execute();
    
    return $stmt->fetch(PDO::FETCH_ASSOC); // Usar fetchAll para obtener todos los registros
}
//--------------------------------traer estado Registro-------------------------------------------
function traer_estado_registro($numRadicado) {
    // Crear la conexión a la base de datos
    $conn = Cconexion::conexionBD();

    // Consulta para obtener el radicado por número y estado 1
    $sql = "SELECT 
                er.numero_radicado,
              CONVERT(varchar, er.fecha_estado, 23) AS fecha_estado,
                er.descripcion,
                er.usuario,
                e.nombre_estado
            FROM 
                estado_radicado er
            JOIN 
                estados e ON e.id_estado = er.id_estado
            WHERE 
                er.numero_radicado = :numero_radicado
                AND er.id_estado = 6";  // Aquí se corrige la condición AND

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':numero_radicado', $numRadicado);
    $stmt->execute();
    
    return $stmt->fetch(PDO::FETCH_ASSOC); // Usar fetchAll para obtener todos los registros
}
//--------------------------------traer estado sale Registro-------------------------------------------
function traer_estado_sale_registro($numRadicado) {
    // Crear la conexión a la base de datos
    $conn = Cconexion::conexionBD();

    // Consulta para obtener el radicado por número y estado 1
    $sql = "SELECT 
                er.numero_radicado,
              CONVERT(varchar, er.fecha_estado, 23) AS fecha_estado,
                er.descripcion,
                er.usuario,
                e.nombre_estado
            FROM 
                estado_radicado er
            JOIN 
                estados e ON e.id_estado = er.id_estado
            WHERE 
                er.numero_radicado = :numero_radicado
                AND er.id_estado = 7";  // Aquí se corrige la condición AND

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':numero_radicado', $numRadicado);
    $stmt->execute();
    
    return $stmt->fetch(PDO::FETCH_ASSOC); // Usar fetchAll para obtener todos los registros
}


?>





