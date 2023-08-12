<?php
include('header.php');
require_once '../crud/crud.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Obtener valores del formulario
    $nombrePaciente = isset($_POST['dni']) ? $_POST['dni'] : '';
    $estadoProgramadas = isset($_POST['prog']) ? true : false;
    $estadoAsistidas = isset($_POST['asist']) ? true : false;
    $estadoCanceladas = isset($_POST['canc']) ? true : false;
    $fechaInicial = isset($_POST['fInicial']) ? $_POST['fInicial'] : '';
    $fechaFinal = isset($_POST['fFinal']) ? $_POST['fFinal'] : '';

    $citas = obtenerCitasFiltradas($nombrePaciente, $estadoProgramadas, $estadoAsistidas, $estadoCanceladas, $fechaInicial, $fechaFinal);
} else {
    $citas = obtenerCitasConInformacion();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes</title>
</head>

<style type="text/css">
    #tabla,
    #fila,
    #columna {
        height: 25px;
        border: 1px solid black;
        border-collapse: collapse;
        text-align: center;
    }

    .btn-imprimir {
        display: flex;
        cursor: pointer;
        align-items: right;
        left: 20%;
        font-size: 13px;
        background-color: #e77d04;
        border-radius: 20px;
        border-color: white;
        padding: 10px;
        border: 10px 20px 20px 10px;
        margin: 10px;
        text-decoration: none;
        color: #ffffff;
        font-weight: bold;
    }
</style>

<body>

    <div class="contenedor-general">
        <div>
            <div class="row">
                <div class="row mb-4 mt-2 d-flex justify-content-center">
                    <div class="col-2 text-end">
                        <img src="../img/paciente.svg" alt="Estudiante" width="40%">
                    </div>
                    <div class="col-6">
                        <h2 class="text-uppercase text-start fw-bold">Reporte de citas</h2>
                    </div>
                </div>
                <form action="reportecita.php" method="POST">
                    <div class="row">
                        <div class="d-grid gap-2 d-md-flex justify-content-md-start my-row">
                            <input autocomplete="off" type="text" class="form-control w-25" name="dni" placeholder="Buscar">
                            <button type="submit" name="enviar" class="btn-buscar my-class1"><img src="../img/lupa.svg" alt=""></button>

                            <select name="filter1" id="sel-Filt1">
                                <option value="paciente" selected>Paciente</option>
                                <option value="especialista">Especialista</option>
                            </select>

                            <div>
                                <table>
                                    <tr >
                                        <td>Estado:</td>
                                        <td>
                                            <input type="checkbox" id="prog" name="prog" value="Programada" checked>Programadas
                                            <br>
                                            <input type="checkbox" id="asist" name="asist" value="Asistida" checked>Asistidas 
                                            <br>
                                            <input type="checkbox" id="canc" name="canc" value="Cancelada" checked>Canceladas
                                        </td>
                                    </tr>
                                </table>

                            </div>
                            <div >
                                <label for="fInicial">Fecha Inicial:</label> 
                                <input type="date" id="fInicial" name="fInicial"  title="A partir de fecha">
<br><br>
                                <label for="fFinal">Fecha Final:</label> 
                                <input type="date" id="fFinal" name="fFinal">
                            </div>
                            
                        </div>
                    </div>
                </form>

                <div>
                    <br>
                    <br>
                <table id="tabla">
    <thead>
        <tr>
            <th>Id</th>
            <th>Paciente</th>
            <th>Servicio</th>
            <th>Especialista</th>
            <th>Fecha</th>
            <th>Horario</th>
            <th>Descripción</th>
            <th>Estado</th>
        </tr>
    </thead>
    <tbody>
                    <?php foreach ($citas as $cita) { ?>
                        <tr>
                            <td><?php echo $cita['id_cita']; ?></td>
                            <td><?php echo $cita['Paciente']; ?></td>
                            <td><?php echo $cita['Servicio']; ?></td>
                            <td><?php echo $cita['Especialista']; ?></td>
                            <td><?php echo $cita['Fecha']; ?></td>
                            <td><?php echo $cita['Horario']; ?></td>
                            <td><?php echo $cita['descripcion']; ?></td>
                            <td><?php echo $cita['estado']; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
    </table>

                    <button class="btn-imprimir"> <img src="../img/print.svg" width="25px" height="auto" alt="Icono Imprimir">Imprimir</button>

    </div>

            </div>
        </div>
    </div>



</body>

</html>