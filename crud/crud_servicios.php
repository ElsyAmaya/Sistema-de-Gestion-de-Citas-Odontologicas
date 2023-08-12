<?php
require_once 'crud.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['accion'])) {
        $accion = $_POST['accion'];

        if ($accion == 'insertar') {
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
            $tipo = $_POST['tipo'];
            $duracion = $_POST['duracion'];
            $costo = $_POST['costo'];
            $especialidad = $_POST['especialidad'];
            $estado = 'Activo'; 
        
            $datos_servicio = array(
                'nombre' => $nombre,
                'descripcion' => $descripcion,
                'tipo' => $tipo,
                'duracion' => $duracion,
                'costo' => $costo,
                'id_especialidad' => $especialidad,
                'estado' => $estado,
            );
        
            if (crearRegistro('tb_servicios_tratamientos', $datos_servicio)) {
                header('Location: ../pages/servicios.php');
                exit;
            } else {
                echo "Error al insertar el servicio en la base de datos.";
            }
        } elseif ($accion == 'editar') {
            $id_servicio = $_POST['id_servicio'];
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
            $tipo = $_POST['tipo'];
            $duracion = $_POST['duracion'];
            $costo = $_POST['costo'];
            $especialidad = $_POST['especialidad'];
        
            $datos_actualizados = array(
                'nombre' => $nombre,
                'descripcion' => $descripcion,
                'tipo' => $tipo,
                'duracion' => $duracion,
                'costo' => $costo,
                'id_especialidad' => $especialidad,
                'estado' => 'Activo',
            );
        
            if (actualizarRegistro('tb_servicios_tratamientos', 'id_srvtrat', $id_servicio, $datos_actualizados)) {
                header('Location: ../pages/servicios.php');
                exit;
            } else {
                echo "Error al actualizar los datos del servicio en la base de datos.";
            }
        } elseif ($accion == 'eliminar') {
            $id_servicio = $_POST['id_servicio'];
        
            if (actualizarEstadoRegistro('tb_servicios_tratamientos', 'id_srvtrat', $id_servicio, 'Inactivo')) {
                header('Location: ../pages/servicios.php');
                exit;
            } else {
                echo "Error al eliminar el registro del servicio en la base de datos.";
            }
        }
    }
}
?>
