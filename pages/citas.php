<?php

    include('header.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Citas</title>
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
                        <h2 class="text-uppercase text-start fw-bold">Registros de Citas</h2>
                    </div>
                </div>
                <form action="listadoGeneralAlumnos.php" method="POST">
                    <div class="row">
                        <div class="d-grid gap-2 d-md-flex justify-content-md-start my-row">
                            <input autocomplete="off" type="text" class="form-control w-25" name="id"
                                placeholder="Buscar">
                            <button type="submit" name="enviar" class="btn-buscar my-class1"><img src="../img/lupa.svg"
                                    alt=""></button>
                        </div>
                    </div>
                </form>
                <div class="col-12 d-flex justify-content-end">
                    <button type="button" class="btn-agregar my-class1 my-row" data-bs-toggle="modal"
                        data-bs-target="#modalRegistrar"><img src="../img/aggw.svg" alt="">Agregar</button>
                </div>
                <div>
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
            <th>Opciones</th>
        </tr>
    </thead>
    <tbody>
        <?php
        require_once '../crud/crud.php';
        $citas = obtenerCitasConInformacion(); // Llama a la función para obtener las citas con información

        foreach ($citas as $cita) {
            $id_cita = $cita['id_cita'];
            $paciente = $cita['Paciente'];
            $servicio = $cita['Servicio'];
            $especialista = $cita['Especialista'];
            $fecha = $cita['Fecha'];
            $horario = $cita['Horario'];
            $descripcion = $cita['descripcion'];
            $estado = $cita['estado'];
        ?>
            <tr>
                <td><?php echo $id_cita; ?></td>
                <td><?php echo $paciente; ?></td>
                <td><?php echo $servicio; ?></td>
                <td><?php echo $especialista; ?></td>
                <td><?php echo $fecha; ?></td>
                <td><?php echo $horario; ?></td>
                <td><?php echo $descripcion; ?></td>
                <td><?php echo $estado; ?></td>
                <td>
                    <a class="btn-editar" data-bs-toggle="modal" data-bs-target="#modalEditar"><img src="../img/edit.svg" alt="" width="20px" style="margin-bottom:2px;"></a>
                    <a class="btn-eliminar" data-bs-toggle="modal" data-bs-target="#modalCancelar"><img src="../img/delete.svg" alt="" width="20px" style="margin-bottom:2px;"></a>
                </td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>


                </div>

            </div>
        </div>
    </div>
</body>

</html>

<!-- Modal Registrar -->
<div class="modal fade" id="modalRegistrar" tabindex="-1" aria-labelledby="modalRegistrarLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="text-uppercase text-center fw-bold" id="modalRegistrarLabel"><img src="../img/paciente.svg"
                        alt="Estudiante" width="10%">Registrar Cita</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Aquí puedes colocar el formulario de registro del paciente -->
                <!-- Puedes utilizar HTML y PHP para construir el formulario -->
                <!-- Por ejemplo: -->
                <form action="procesar_registro.php" method="POST">
                    <label class="fw-bold" for="Paciente">Paciente:</label>
                    <select class="input1-m" name="Paciente" id="Paciente">
                    <?php
                        require_once '../crud/crud.php';
                        $pacientes = obtenerRegistros('tb_pacientes');
                        foreach ($pacientes as $paciente) {
                            $id_paciente = $paciente['id_pacientes'];
                            $nombre_paciente= $paciente['p_nombre'];
                            $apellido_paciente= $paciente['p_apellido'];
                            echo "<option value=\"$id_paciente\">$nombre_paciente-$apellido_paciente</option>";
                        }
                        ?>
                    </select>
                    <br><br>
                    <label class="fw-bold" for="Servicio_o_tratamiento">Servicio o tratamiento:</label>
                    <select class="input1-m" name="Servicio_o_tratamiento" id="Servicio_o_tratamiento">
                    <?php
                        require_once '../crud/crud.php';
                        $especialidades = obtenerRegistros('tb_especialidad');
                        foreach ($especialidades as $especialidad) {
                            $id_especialidad = $especialidad['id_especialidad'];
                            $nombre_especialidad= $especialidad['nombre'];
                            echo "<option value=\"$id_especialidad\">$nombre_especialidad</option>";
                        }
                        ?>
                    </select>
                    <br><br>
                    <label class="fw-bold" for="Especialista">Especialista:</label>
                    <select class="input1-m" name="Especialista" id="Especialista">
                    <?php
                        require_once '../crud/crud.php';
                        $especialistas = obtenerRegistros('tb_especialistas');
                        foreach ($especialistas as $especialista) {
                            $id_especialista = $especialista['id_especialidad'];
                            $nombre_especialista= $especialista['p_nombre'];
                            $apellido_especialista= $especialista['p_apellido'];
                            echo "<option value=\"$id_especialista\">$nombre_especialista- $apellido_especialista</option>";
                        }
                        ?>
                    </select>
                    <br><br>
                    <label class="fw-bold" for="fecha">Fecha:</label>
                    <input class="input1-m" name="txtfecha" id="txtfecha" type="date" value="2022-01-01"
                        min="" max="2090-12-31" required />
                    <br><br>
                    <label class="fw-bold" for="horario">Horario:</label>
                    <select class="input1-m" name="horario" id="horario">
                    <?php
                        require_once '../crud/crud.php';
                        $horarios = obtenerRegistros('tb_horarios');
                        foreach ($horarios as $horario) {
                            $id_horario = $horario['id_horario'];
                            $ini_horario= $horario['hora_ini'];
                            $fin_horario= $horario['hora_fin'];
                            echo "<option value=\"$id_horario\">$ini_horario-$fin_horario</option>";
                        }
                        ?>
                    </select>
                    <br>
                    <br>
                       <div class="col-12 d-flex justify-content-end">
                        <button type="submit" class="btn-guardar my-class1 my-row"><img src="../img/salvar.svg" alt="">Guardar</button>
                        <button type="reset" class="btn-cancelar my-class1 my-row"><img src="../img/xw.svg" alt="">Cancelar</button>
                    </div>
                     </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal Cancelar Cita -->
<div class="modal fade" id="modalCancelar" tabindex="-1" aria-labelledby="modalCancelarLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="text-uppercase text-center fw-bold" id="modalCancelarLabel"><img src="../img/paciente.svg"
                        alt="Estudiante" width="10%">Cancelar Cita</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Aquí puedes colocar el formulario de registro del paciente -->
                <!-- Puedes utilizar HTML y PHP para construir el formulario -->
                <!-- Por ejemplo: -->
                <form action="procesar_registro.php" method="POST">
                    <div class="form-group">
                        <label class="fw-bold" for="descrip">Descripcion:</label>
                        <textarea id="mensaje" name="Descripcion" rows="2" cols="20"></textarea>
                    </div>
                    <br>
                       <div class="col-12 d-flex justify-content-end">
                        <button type="submit" class="btn-guardar my-class1 my-row"><img src="../img/salvar.svg" alt="">Guardar</button>
                        <button type="reset" class="btn-cancelar my-class1 my-row"><img src="../img/xw.svg" alt="">Cancelar</button>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    const today = new Date();
    const yyyy = today.getFullYear();
    const mm = String(today.getMonth() + 1).padStart(2, '0');
    const dd = String(today.getDate()).padStart(2, '0');
    const maxDate = `${yyyy}-${mm}-${dd}`;
    document.getElementById("txtfecha").setAttribute("min", maxDate);
</script>
