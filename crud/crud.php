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
function buscarPorCampoUsu($tabla, $campo, $estado, $campo2, $rol) {
    global $conn;
    // Escapar el valor para evitar inyección de SQL
     // Escapar los valores para evitar inyección de SQL
     $estado = mysqli_real_escape_string($conn, $estado);
     $rol = mysqli_real_escape_string($conn, $rol);
    // Construir la consulta SQL
    $sql = "SELECT * FROM $tabla WHERE $campo = '$estado'AND $campo2 = '$rol'";
    $result = $conn->query($sql);
    $registros = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $registros[] = $row;
        }
    }
    return $registros;
}

function guardarEspecialidadesEspecialista($id_especialista, $especialidades) {
    global $conn;
    
    foreach ($especialidades as $id_especialidad) {
        $sql = "INSERT INTO tb_especialistas_especialidades (id_especialista, id_especialidad) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $id_especialista, $id_especialidad);
        $stmt->execute();
    }
    
    return true; // O manejar algún control de error si es necesario
}

function obtenerCitasConInformacion() {
    global $conn;
    
    $sql = "SELECT c.id_cita, CONCAT(p.dni,' - ',p.p_nombre,' - ', p.s_apellido) AS Paciente, st.nombre AS Servicio, CONCAT(e.p_nombre,' - ', e.p_apellido) AS Especialista, c.Fecha, CONCAT(h.hora_ini,' - ', h.hora_fin) AS Horario, c.descripcion, c.estado
            FROM tb_citas c
            INNER JOIN tb_pacientes p ON c.id_paciente= p.id_paciente
            INNER JOIN tb_servicios_tratamientos st ON c.id_srvtrat = st.id_srvtrat
            INNER JOIN tb_especialistas e ON c.id_especialista = e.id_especialista
            INNER JOIN tb_horarios h ON c.id_horario = h.id_horario";
            
    $result = $conn->query($sql);
    $registros = array();
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $registros[] = $row;
        }
    }
    
    return $registros;
}

function obtenerEspecialidadesPorEspecialista($id_especialista) {
    global $conn;

    $sql = "SELECT id_especialidad FROM tb_especialistas_especialidades WHERE id_especialista = $id_especialista";
    $result = $conn->query($sql);
    
    $especialidades = array();
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $especialidades[] = $row['id_especialidad'];
        }
    }

    return $especialidades;
}
function obtenerCitasFiltradas($dniPaciente, $estadoProgramadas, $estadoAsistidas, $estadoCanceladas, $fechaInicial, $fechaFinal) {
    $citas = obtenerCitasConInformacion(); // Obtener todas las citas
    
    // Aplicar filtros
    $citasFiltradas = array_filter($citas, function ($cita) use ($dniPaciente, $estadoProgramadas, $estadoAsistidas, $estadoCanceladas, $fechaInicial, $fechaFinal) {
        $cumpleFiltro = true;

        // Filtrar por nombre de paciente
        if ($dniPaciente && strpos($cita['Paciente'], $dniPaciente) === false) {
            $cumpleFiltro = false;
        }

        // Filtrar por estados
        if ((!$estadoProgramadas && $cita['estado'] === 'Programada') ||
            (!$estadoAsistidas && $cita['estado'] === 'Asistida') ||
            (!$estadoCanceladas && $cita['estado'] === 'Cancelada')) {
            $cumpleFiltro = false;
        }

        // Filtrar por rango de fechas
        if ($fechaInicial && $cita['Fecha'] < $fechaInicial) {
            $cumpleFiltro = false;
        }
        if ($fechaFinal && $cita['Fecha'] > $fechaFinal) {
            $cumpleFiltro = false;
        }

        return $cumpleFiltro;
    });

    return $citasFiltradas;
}



?>