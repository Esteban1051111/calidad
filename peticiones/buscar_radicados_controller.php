<?php
require_once '../../../conexion.php';

function obtenerRadicados($termino = '') {
    // Crear la conexión a la base de datos
    $conn = Cconexion::conexionBD();

    // Consulta base
    $sql = "SELECT 
                r.NUM_RADICADO,
                r.ACTO_NOTARIAL,
                r.NUM_MATRICULA,
                r.PROYECTO,
                r.OBSERVACIONES,
                r.USUARIO_RADICO,
                i.ID_INTERVINIENTE,
                i.NOMBRES AS INTERVINIENTE_NOMBRES,
                i.APELLIDOS AS INTERVINIENTE_APELLIDOS,
                i.TIPO AS INTERVINIENTE_TIPO,
                i.NUM_IDENTI AS INTERVINIENTE_NUM_IDENTI,
                i.TELEFONO AS INTERVINIENTE_TELEFONO,
                i.ACTIVIDAD_ECONOMICA AS INTERVINIENTE_ACTIVIDAD_ECONOMICA,
                i.DIRECCION AS INTERVINIENTE_DIRECCION,
                i.CORREO_ELECTRONICO AS INTERVINIENTE_CORREO_ELECTRONICO,
                i.TIPO_INTERVINIENTE,
                a.ID_APODERADO,
                a.NOMBRES AS APODERADO_NOMBRES,
                a.APELLIDOS AS APODERADO_APELLIDOS,
                a.TIPO AS APODERADO_TIPO,
                a.NUM_IDENTI AS APODERADO_NUM_IDENTI,
                a.TELEFONO AS APODERADO_TELEFONO,
                a.ACTIVIDAD_ECONOMICA AS APODERADO_ACTIVIDAD_ECONOMICA,
                a.DIRECCION AS APODERADO_DIRECCION,
                a.CORREO_ELECTRONICO AS APODERADO_CORREO_ELECTRONICO,
                p.ID_PROYECTO,
                p.NOMBRE AS PROYECTO_NOMBRE,
                p.DESCRIPCION AS PROYECTO_DESCRIPCION,
                f.ID_FOLIO,
                f.NUM_MATRICULA AS FOLIO_NUM_MATRICULA,
                f.DESCRIPCION AS FOLIO_DESCRIPCION
            FROM 
                Radicados r
            LEFT JOIN 
                Intervinientes i ON r.NUM_RADICADO = i.NUM_RADICADO
            LEFT JOIN 
                Apoderados a ON i.ID_INTERVINIENTE = a.ID_INTERVINIENTE
            LEFT JOIN
                Proyectos p ON r.ID_PROYECTO = p.ID_PROYECTO
            LEFT JOIN
                Folio_Matricula f ON r.NUM_RADICADO = f.NUM_RADICADO
            WHERE 
                i.TIPO_INTERVINIENTE = 'SEGUNDO INTERVINIENTE'";

    if ($termino) {
        // Primero, busca coincidencias exactas en el número de radicado
        $sqlExact = $sql . " AND r.NUM_RADICADO = ?";
        $stmt = $conn->prepare($sqlExact);
        $stmt->execute([$termino]);
        $radicados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Si no hay coincidencias exactas, buscar en otros campos
        if (count($radicados) === 0) {
            $sql .= " AND (r.NUM_RADICADO LIKE ? OR 
                        r.ACTO_NOTARIAL LIKE ? OR 
                        r.NUM_MATRICULA LIKE ? OR 
                        r.PROYECTO LIKE ? OR 
                        r.USUARIO_RADICO LIKE ? OR 
                        i.NOMBRES LIKE ? OR 
                        i.APELLIDOS LIKE ? OR 
                        i.NUM_IDENTI LIKE ? OR 
                        a.NOMBRES LIKE ? OR 
                        a.APELLIDOS LIKE ? OR 
                        a.NUM_IDENTI LIKE ? OR 
                        p.NOMBRE LIKE ? OR 
                        p.DESCRIPCION LIKE ? OR 
                        f.NUM_MATRICULA LIKE ?)";
            $stmt = $conn->prepare($sql);
            $param = '%' . $termino . '%';
            $params = array_fill(0, 14, $param); // Se llenan 14 parámetros
            $stmt->execute($params);
            $radicados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    } else {
        // Consulta para obtener todos los registros si no hay término de búsqueda
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $radicados = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    return $radicados;
}
function obtenerRadicadoPorNumero($numRadicado) {
    // Crear la conexión a la base de datos
    $conn = Cconexion::conexionBD();

    // Consulta para obtener el radicado por número
    $sql = "SELECT 
                r.NUM_RADICADO,
                r.ACTO_NOTARIAL,
                r.NUM_ESCRITURA,
                r.NUM_MATRICULA,
                r.PROYECTO,
                r.OBSERVACIONES,
                r.USUARIO_RADICO,
                i.NOMBRES AS INTERVINIENTE_NOMBRES,
                i.APELLIDOS AS INTERVINIENTE_APELLIDOS,
                i.TIPO AS INTERVINIENTE_TIPO,
                i.NUM_IDENTI AS INTERVINIENTE_NUM_IDENTI,
                i.TELEFONO AS INTERVINIENTE_TELEFONO,
                i.ACTIVIDAD_ECONOMICA AS INTERVINIENTE_ACTIVIDAD_ECONOMICA,
                i.DIRECCION AS INTERVINIENTE_DIRECCION,
                i.CORREO_ELECTRONICO AS INTERVINIENTE_CORREO_ELECTRONICO,
                i.TIPO_INTERVINIENTE,
                a.NOMBRES AS APODERADO_NOMBRES,
                a.APELLIDOS AS APODERADO_APELLIDOS,
                a.TIPO AS APODERADO_TIPO,
                a.NUM_IDENTI AS APODERADO_NUM_IDENTI,
                a.TELEFONO AS APODERADO_TELEFONO,
                a.ACTIVIDAD_ECONOMICA AS APODERADO_ACTIVIDAD_ECONOMICA,
                a.DIRECCION AS APODERADO_DIRECCION,
                a.CORREO_ELECTRONICO AS APODERADO_CORREO_ELECTRONICO,
                p.NOMBRE AS PROYECTO_NOMBRE,
                p.DESCRIPCION AS PROYECTO_DESCRIPCION,
                f.NUM_MATRICULA AS FOLIO_NUM_MATRICULA
            FROM 
                Radicados r
            LEFT JOIN 
                Intervinientes i ON r.NUM_RADICADO = i.NUM_RADICADO
            LEFT JOIN 
                Apoderados a ON i.ID_INTERVINIENTE = a.ID_INTERVINIENTE
            LEFT JOIN
                Proyectos p ON r.ID_PROYECTO = p.ID_PROYECTO
            LEFT JOIN
                Folio_Matricula f ON r.NUM_RADICADO = f.NUM_RADICADO
            WHERE 
                r.NUM_RADICADO = ?";

    $stmt = $conn->prepare($sql);
    $stmt->execute([$numRadicado]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC); // Usar fetchAll para obtener todos los registros
}
function actualizarRadicado($datos) {
    // Crear la conexión a la base de datos
    $conn = Cconexion::conexionBD();

    try {
        // Iniciar una transacción
        $conn->beginTransaction();

        // Actualizar la información del radicado
        $sqlRadicado = "UPDATE Radicados SET 
                            NUM_MATRICULA = ?, 
                            PROYECTO = ?, 
                            OBSERVACIONES = ?
                        WHERE NUM_RADICADO = ?";
        $stmtRadicado = $conn->prepare($sqlRadicado);
        $stmtRadicado->execute([
            $datos['NUM_MATRICULA'],
            $datos['PROYECTO'],
            $datos['OBSERVACIONES'],
            $datos['numRadicado']
        ]);

        // Actualizar la información de los intervinientes
        for ($i = 0; $i < count($datos['intervinientes']); $i++) {
            $sqlInterviniente = "UPDATE Intervinientes SET 
                                    NOMBRES = ?, 
                                    APELLIDOS = ?, 
                                    TIPO = ?, 
                                    NUM_IDENTI = ?, 
                                    TELEFONO = ?, 
                                    ACTIVIDAD_ECONOMICA = ?, 
                                    DIRECCION = ?, 
                                    CORREO_ELECTRONICO = ?
                                WHERE NUM_RADICADO = ? AND TIPO_INTERVINIENTE = ?";
            $stmtInterviniente = $conn->prepare($sqlInterviniente);
            $stmtInterviniente->execute([
                $datos['intervinientes'][$i]['NOMBRES'],
                $datos['intervinientes'][$i]['APELLIDOS'],
                $datos['intervinientes'][$i]['TIPO'],
                $datos['intervinientes'][$i]['NUM_IDENTI'],
                $datos['intervinientes'][$i]['TELEFONO'],
                $datos['intervinientes'][$i]['ACTIVIDAD_ECONOMICA'],
                $datos['intervinientes'][$i]['DIRECCION'],
                $datos['intervinientes'][$i]['CORREO_ELECTRONICO'],
                $datos['numRadicado'],
                $datos['intervinientes'][$i]['TIPO_INTERVINIENTE']
            ]);

            // Actualizar la información de los apoderados
            $sqlApoderado = "UPDATE Apoderados SET 
                                NOMBRES = ?, 
                                APELLIDOS = ?, 
                                TIPO = ?, 
                                NUM_IDENTI = ?, 
                                TELEFONO = ?, 
                                ACTIVIDAD_ECONOMICA = ?, 
                                DIRECCION = ?, 
                                CORREO_ELECTRONICO = ?
                            WHERE ID_INTERVINIENTE = ?";
            $stmtApoderado = $conn->prepare($sqlApoderado);
            $stmtApoderado->execute([
                $datos['intervinientes'][$i]['APODERADO_NOMBRES'],
                $datos['intervinientes'][$i]['APODERADO_APELLIDOS'],
                $datos['intervinientes'][$i]['APODERADO_TIPO'],
                $datos['intervinientes'][$i]['APODERADO_NUM_IDENTI'],
                $datos['intervinientes'][$i]['APODERADO_TELEFONO'],
                $datos['intervinientes'][$i]['APODERADO_ACTIVIDAD_ECONOMICA'],
                $datos['intervinientes'][$i]['APODERADO_DIRECCION'],
                $datos['intervinientes'][$i]['APODERADO_CORREO_ELECTRONICO'],
                $datos['intervinientes'][$i]['ID_INTERVINIENTE']
            ]);
        }

        // Confirmar la transacción
        $conn->commit();
        return true;
    } catch (Exception $e) {
        // Revertir la transacción en caso de error
        $conn->rollBack();
        return false;
    }
}



?>
