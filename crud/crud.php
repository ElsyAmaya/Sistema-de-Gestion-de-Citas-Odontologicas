<?php
require_once 'db_config.php';

// Función para crear un nuevo registro
function crearRegistro($tabla, $datos) {
    global $conn;
    $columnas = implode(', ', array_keys($datos));
    $valores = "'" . implode("', '", array_values($datos)) . "'";
    $sql = "INSERT INTO $tabla ($columnas) VALUES ($valores)";
    return $conn->query($sql);
}

function actualizarRegistro($tabla, $columna_clave, $id, $datos) {
    global $conn;
    $valores = '';
    foreach ($datos as $columna => $valor) {
        $valores .= "$columna = '$valor', ";
    }
    $valores = rtrim($valores, ', ');
    $sql = "UPDATE $tabla SET $valores WHERE $columna_clave = '$id'";
    return $conn->query($sql);
}

// Función para actualizar el estado de un registro
function actualizarEstadoRegistro($tabla, $columna_clave, $id, $nuevo_estado) {
    global $conn;
    $sql = "UPDATE $tabla SET estado = '$nuevo_estado' WHERE $columna_clave = $id";
    if ($conn->query($sql)) {
        return $id; // Retornar el ID del registro actualizado
    } else {
        return false; // Retornar false si hubo un error en la actualización
    }
}

// Función para obtener todos los registros de una tabla
function obtenerRegistros($tabla) {
    global $conn;
    $sql = "SELECT * FROM $tabla";
    $result = $conn->query($sql);
    $registros = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $registros[] = $row;
        }
    }
    return $registros;
}

// Función para buscar por cualquier campo en una tabla específica
function buscarPorCampo($tabla, $campo, $valor) {
    global $conn;
    // Escapar el valor para evitar inyección de SQL
    $valor = mysqli_real_escape_string($conn, $valor);
    // Construir la consulta SQL
    $sql = "SELECT * FROM $tabla WHERE $campo = '$valor'";
    $result = $conn->query($sql);
    $registros = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $registros[] = $row;
        }
    }
    return $registros;
}

?>