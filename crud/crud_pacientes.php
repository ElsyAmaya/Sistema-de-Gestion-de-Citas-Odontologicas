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
            $ciudad = $_POST['ciudad']; // Obtener el valor de la ciudad desde el formulario
            $sector = $_POST['sector']; // Obtener el valor del sector desde el formulario
            $calle = $_POST['calle']; // Obtener el valor de la calle desde el formulario
            $numcasa = $_POST['numcasa']; // Obtener el valor del número de casa desde el formulario
            $telefono = $_POST['tel'];
            $correo = $_POST['correo'];
            $alergias = $_POST['alegia'];
            $estado = 'Activo'; // Puedes establecer un valor predeterminado para el estado
        
            // Crear un arreglo con los datos del paciente
            $datos_paciente = array(
                'dni' => $dni,
                'p_nombre' => $p_nombre,
                's_nombre' => $s_nombre,
                'p_apellido' => $p_apellido,
                's_apellido' => $s_apellido,
                'fecha_nac' => $fecha_nac,
                'genero' => $genero,
                'id_ciudad' => $ciudad, // Agregar el valor de la ciudad al arreglo
                'sector' => $sector, // Agregar el valor del sector al arreglo
                'calle' => $calle, // Agregar el valor de la calle al arreglo
                'num_casa' => $numcasa, // Agregar el valor del número de casa al arreglo
                'telefono' => $telefono,
                'correo' => $correo,
                'alergias' => $alergias,
                'estado' => $estado,
            );
        
            // Insertar el registro en la tabla 'tb_pacientes'
            if (crearRegistro('tb_pacientes', $datos_paciente)) {
                // Si la inserción fue exitosa, redirige al formulario de pacientes o muestra un mensaje de éxito
                header('Location: ../pages/pacientes.php'); // Cambiar 'pacientes.php' por el nombre de tu formulario
                exit;
            } else {
                // Si hubo un error en la inserción, muestra un mensaje de error
                echo "Error al insertar el paciente en la base de datos.";
            }
        } elseif ($accion == 'editar') {
            // Obtener el ID del paciente desde el formulario
            $id_paciente = $_POST['id_paciente'];
        
            // Obtener los datos del formulario y realizar la actualización
            $dni = $_POST['dni'];
            $p_nombre = $_POST['firtname'];
            $s_nombre = $_POST['secondname'];
            $p_apellido = $_POST['firtlastname'];
            $s_apellido = $_POST['secondlastname'];
            $fecha_nac = $_POST['txtfecha'];
            $genero = $_POST['genero'];
            $ciudad = $_POST['ciudad']; // Obtener el valor de la ciudad desde el formulario
            $sector = $_POST['sector']; // Obtener el valor del sector desde el formulario
            $calle = $_POST['calle']; // Obtener el valor de la calle desde el formulario
            $numcasa = $_POST['numcasa']; // Obtener el valor del número de casa desde el formulario
            $telefono = $_POST['tel'];
            $correo = $_POST['correo'];
            $alergias = $_POST['alegia'];
        
            // Crear un arreglo con los datos actualizados del paciente
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
                'alergias' => $alergias,
                'estado' => 'Activo', // Puedes mantener este valor como 'Activo'
            );
        
            // Actualizar el registro en la tabla 'tb_pacientes'
            if (actualizarRegistro('tb_pacientes', 'id_paciente', $id_paciente, $datos_actualizados)) {
                // Si la actualización fue exitosa, redirige al formulario de pacientes o muestra un mensaje de éxito
                header('Location: ../pages/pacientes.php'); // Cambiar 'pacientes.php' por el nombre de tu formulario
                exit;
            } else {
                // Si hubo un error en la actualización, muestra un mensaje de error
                echo "Error al actualizar los datos del paciente en la base de datos.";
            }
        }elseif ($accion == 'eliminar') {
            // Obtener el ID del paciente desde el formulario
            $id_paciente = $_POST['id_paciente'];
        
            // Eliminar el registro (cambiar estado a "Inactivo")
            if (actualizarEstadoRegistro('tb_pacientes', 'id_paciente', $id_paciente, 'Inactivo')) {
                // Si la eliminación fue exitosa, redirige al formulario de pacientes o muestra un mensaje de éxito
                header('Location: ../pages/pacientes.php'); // Cambiar 'pacientes.php' por el nombre de tu formulario
                exit;
            } else {
                // Si hubo un error en la eliminación, muestra un mensaje de error
                echo "Error al eliminar el registro del paciente en la base de datos.";
            }
        }
        // Puedes agregar condiciones para otras acciones CRUD si es necesario
    }
}
?>