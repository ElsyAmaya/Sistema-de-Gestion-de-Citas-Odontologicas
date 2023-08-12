<?php
require_once 'crud.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['accion'])) {
        $accion = $_POST['accion'];

        if ($accion == 'insertar') {
            $dni = $_POST['dni'];
            $p_nombre = $_POST['firtname'];
            $s_nombre = $_POST['secondname'];
            $p_apellido = $_POST['firtlastname'];
            $s_apellido = $_POST['secondlastname'];
            $fecha_nac = $_POST['txtfecha'];
            $genero = $_POST['genero'];
            $ciudad = $_POST['ciudad'];
            $sector = $_POST['sector'];
            $calle = $_POST['calle'];
            $numcasa = $_POST['numcasa'];
            $telefono = $_POST['tel'];
            $correo = $_POST['correo'];
            $usu = $_POST['usu'];
            $estado = 'Activo';

            // Crear un arreglo con los datos del especialista
            $datos_especialista = array(
                'dni' => $dni,
                'p_nombre' => $p_nombre,
                's_nombre' => $s_nombre,
                'p_apellido' => $p_apellido,
                's_apellido' => $s_apellido,
                'fecha_nac' => $fecha_nac,
                'genero' => $genero,
                'id_ciudad' => $ciudad,
                'sector' => $sector,
                'calle' => $calle,
                'num_casa' => $numcasa,
                'telefono' => $telefono,
                'correo' => $correo,
                'id_usuario' => $usu,
                'estado' => $estado,
            );
           

            // Insertar el registro en la tabla 'tb_especialistas'
            if (crearRegistro('tb_especialistas', $datos_especialista)) {
                $datos_actualizados = array();
                // Check if 'usu' field is not empty
               if (!empty($usu)) {
               $datos_actualizados['estado'] = 'Activo';
               actualizarRegistro('tb_usuarios', 'id_usuario', $usu, $datos_actualizados);
               }
                $id_especialista = $conn->insert_id; // Get the last inserted ID

                // Save specialties in the 'tb_especialistas_especialidades' table
                if ($id_especialista && guardarEspecialidadesEspecialista($id_especialista, $_POST['especialidades'])) {
                    // Redirect or show success message
                    header('Location: ../pages/especialistas.php');
                    exit;
                } else {
                    // Handle error in specialty insertion
                    echo "Error al guardar las especialidades del especialista.";
                }
              
            } else {
                // Si hubo un error en la inserción, muestra un mensaje de error
                echo "Error al insertar el especialista en la base de datos.";
            }
        }elseif ($accion == 'editar') {
            $id_especialista = $_POST['id_especialista'];
        
            // Obtener los datos del formulario y realizar la actualización
            $dni = $_POST['dni'];
            $p_nombre = $_POST['firtname'];
            $s_nombre = $_POST['secondname'];
            $p_apellido = $_POST['firtlastname'];
            $s_apellido = $_POST['secondlastname'];
            $fecha_nac = $_POST['txtfecha'];
            $genero = $_POST['genero'];
            $ciudad = $_POST['ciudad'];
            $sector = $_POST['sector'];
            $calle = $_POST['calle'];
            $numcasa = $_POST['numcasa'];
            $telefono = $_POST['tel'];
            $correo = $_POST['correo'];
            
        
            // Crear un arreglo con los datos actualizados del especialista
            $datos_actualizados = array(
                'dni' => $dni,
                'p_nombre' => $p_nombre,
                's_nombre' => $s_nombre,
                'p_apellido' => $p_apellido,
                's_apellido' => $s_apellido,
                'fecha_nac' => $fecha_nac,
                'genero' => $genero,
                'id_ciudad' => $ciudad,
                'sector' => $sector,
                'calle' => $calle,
                'num_casa' => $numcasa,
                'telefono' => $telefono,
                'correo' => $correo,
                'estado' => 'Activo',
            );
        
            // Actualizar el registro en la tabla 'tb_especialistas'
            if (actualizarRegistro('tb_especialistas', 'id_especialista', $id_especialista, $datos_actualizados)) {

                // Actualizar especialidades en la tabla 'tb_especialistas_especialidades'
                if (guardarEspecialidadesEspecialista($id_especialista, $_POST['especialidades'])) {
                    header('Location: ../pages/especialistas.php');
                    exit;
                } else {
                    echo "Error al guardar las especialidades del especialista.";
                }
            } else {
                echo "Error al actualizar el especialista en la base de datos.";
            }
        }elseif ($accion == 'eliminar') {
            $id_especialista = $_POST['id_especialista'];
        
            // Cambiar el estado del especialista a "Inactivo"
            if (actualizarEstadoRegistro('tb_especialistas', 'id_especialista', $id_especialista, 'Inactivo')) {
                header('Location: ../pages/especialistas.php');
                exit;
            } else {
                echo "Error al eliminar el registro del especialista en la base de datos.";
            }
        }
    }
}
?>