<?php
require_once 'crud.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_especialista = $_POST['id_especialista'];

    $especialidades = obtenerEspecialidadesPorEspecialista($id_especialista);
    $especialidadesString = implode(",", $especialidades);

    echo $especialidadesString;
} else {
    echo "Método no válido.";
}
?>
