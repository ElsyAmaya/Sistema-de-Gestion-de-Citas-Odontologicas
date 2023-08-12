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
                'estado' => $estado,
            );

            // Insertar el registro en la tabla 'tb_especialistas'
            if (crearRegistro('tb_especialistas', $datos_especialista)) {
                $id_especialista = $conn->insert_id; // Obtén el último ID insertado

                // Guardar especialidades en la tabla 'tb_especialistas_especialidades'
                if ($id_especialista && guardarEspecialidadesEspecialista($id_especialista, $_POST['especialidades'])) {
                    // Redirige o muestra mensaje de éxito
                    header('Location: ../pages/especialistas.php');
                    exit;
                } else {
                    // Maneja el error en la inserción de especialidades
                    echo "Error al guardar las especialidades del especialista.";
                }
            } else {
                // Si hubo un error en la inserción, muestra un mensaje de error
                echo "Error al insertar el especialista en la base de datos.";
            }
        }
    }
}
?>