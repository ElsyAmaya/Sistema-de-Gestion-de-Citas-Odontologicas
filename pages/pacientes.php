<?php

    include('header.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pacientes</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<style type="text/css">
    #tabla, #fila ,#columna { height: 25px;  padding: 20px; font-weight: bold;  border: 1px solid black; border-collapse: collapse; text-align: center;}
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
                        <h2 class="text-uppercase text-start fw-bold">Registros de Pacientes</h2>
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
                    <button type="button" id="btnAgregar" class="btn-agregar my-class1 my-row" data-bs-toggle="modal"
                        data-bs-target="#modalRegistrar">
                        <img src="../img/aggw.svg" alt="">Agregar
                    </button>


                </div>
                <div>
                    <table id="tabla">
                        <thead>
                            <tr id="fila">

                                <th id="columna">DNI</th>
                                <th id="columna">Primer Nombre</th>
                                <th id="columna">Segundo Nombre</th>
                                <th id="columna">Primer Apellido</th>
                                <th id="columna">Segundo Apellido</th>
                                <th id="columna">Fecha Nac.</th>
                                <th id="columna">Género</th>
                                <th id="columna">Ciudad</th>
                                <th id="columna">Sector</th>
                                <th id="columna">Calle</th>
                                <th id="columna"># Casa</th>
                                <th id="columna">Teléfono</th>
                                <th id="columna">Correo</th>
                                <th id="columna">Alergias</th>
                                <th id="columna">Estado</th>
                                <th id="columna" colspan="3">Opciones</th>
                            </tr>
                        </thead>
                        <tbody id="tabla-body">
                            <?php
    require_once '../crud/crud.php';
    $pacientes = obtenerRegistros('tb_pacientes');
    foreach ($pacientes as $paciente) {
        $id = $paciente['id_paciente'];
        $dni = $paciente['dni'];
        $p_nombre = $paciente['p_nombre'];
        $s_nombre = $paciente['s_nombre'];
        $p_apellido = $paciente['p_apellido'];
        $s_apellido = $paciente['s_apellido'];
        $fecha_nac = $paciente['fecha_nac'];
        $genero = $paciente['genero'];
        $ciudad = $paciente['id_ciudad']; // Cambia 'id_ciudad' por el nombre del campo que contiene el ID de la ciudad
        $sector = $paciente['sector'];
        $calle = $paciente['calle'];
        $num_casa = $paciente['num_casa'];
        $telefono = $paciente['telefono'];
        $correo = $paciente['correo'];
        $alergias = $paciente['alergias'];
        $estado = $paciente['estado'];
        ?>
                            <tr>
                                <td>
                                    <?php echo $dni; ?>
                                </td>
                                <td>
                                    <?php echo $p_nombre; ?>
                                </td>
                                <td>
                                    <?php echo $s_nombre; ?>
                                </td>
                                <td>
                                    <?php echo $p_apellido; ?>
                                </td>
                                <td>
                                    <?php echo $s_apellido; ?>
                                </td>
                                <td>
                                    <?php echo $fecha_nac; ?>
                                </td>
                                <td>
                                    <?php echo $genero; ?>
                                </td>
                                <td>
                                    <?php echo $ciudad; ?>
                                </td>
                                <td>
                                    <?php echo $sector; ?>
                                </td>
                                <td>
                                    <?php echo $calle; ?>
                                </td>
                                <td>
                                    <?php echo $num_casa; ?>
                                </td>
                                <td>
                                    <?php echo $telefono; ?>
                                </td>
                                <td>
                                    <?php echo $correo; ?>
                                </td>
                                <td>
                                    <?php echo $alergias; ?>
                                </td>
                                <td>
                                    <?php echo $estado; ?>
                                </td>
                                <td><a class="btn-historial"><img src="../img/record.svg" alt="" width="20px"
                                            style="margin-bottom:2px;"></a></td>
                                <td>
                                    <a class="btn-editar" data-bs-toggle="modal" data-bs-target="#modalRegistrar"
                                        data-paciente='<?php echo json_encode($paciente); ?>'
                                        data-id="<?php echo $id_paciente; ?>">
                                        <img src="../img/edit.svg" alt="" width="20px" style="margin-bottom:2px;">
                                    </a>
                                </td>
                                <td>
                                    <a class="btn-eliminar" data-id="<?php echo $id; ?>">
                                        <img src="../img/delete.svg" alt="" width="20px" style="margin-bottom:2px;">
                                    </a>
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
<form action="../crud/crud_pacientes.php" method="POST" id="formPaciente"></form>
<script>
    // Evento click para abrir el formulario modal para editar un paciente
    $(".btn-editar").click(function () {
        var paciente = $(this).data("paciente"); // Obtener los datos del paciente desde el atributo data-paciente
        // Cargar los datos del paciente en el formulario modal
        $("#id_paciente").val(paciente.id_paciente);
        $("#dni").val(paciente.dni);
        $("#firtname").val(paciente.p_nombre);
        $("#secondname").val(paciente.s_nombre);
        $("#firtlastname").val(paciente.p_apellido);
        $("#secondlastname").val(paciente.s_apellido);
        $("#txtfecha").val(paciente.fecha_nac);
        $("#genero").val(paciente.genero);
        $("#ciudad").val(paciente.id_ciudad);
        $("#sector").val(paciente.sector);
        $("#calle").val(paciente.calle);
        $("#numcasa").val(paciente.num_casa);
        $("#tel").val(paciente.telefono);
        $("#correo").val(paciente.correo);
        $("#alergia").val(paciente.alergias);

        // Cambiar el valor del campo oculto 'accion' a 'editar'
        $("#accion").val("editar");
        // Actualizar el título del modal a "Editar Paciente"
        $("#modalRegistrarLabel").text("Editar Paciente");
    });

    // Evento click para abrir el formulario modal para registrar un paciente
    $("#btnAgregar").click(function () {
        // Restaurar los campos del formulario (opcional)
        $("#id_paciente").val("");
        $("#dni").val("");
        $("#firtname").val("");
        $("#secondname").val("");
        $("#firtlastname").val("");
        $("#secondlastname").val("");
        $("#txtfecha").val("");
        $("#genero").val("");
        $("#ciudad").val("");
        $("#sector").val("");
        $("#calle").val("");
        $("#numcasa").val("");
        $("#tel").val("");
        $("#correo").val("");
        $("#alergia").val("");

        // Cambiar el valor del campo oculto 'accion' a 'insertar'
        $("#accion").val("insertar");
        // Actualizar el título del modal a "Registrar Paciente"
        $("#modalRegistrarLabel").text("Registrar Paciente");
    });
    $(".btn-eliminar").click(function () {
        var idPaciente = $(this).data("id");

        // Mostrar mensaje de confirmación
        var confirmarEliminar = confirm("¿Estás seguro de que deseas eliminar este paciente?");
        if (confirmarEliminar) {
            // Crear un objeto de datos que contiene la acción y el ID del paciente
            var data = {
                accion: 'eliminar',
                id_paciente: idPaciente
            };
            // Enviar la solicitud POST con los datos del paciente a crud_pacientes.php
            $.post("../crud/crud_pacientes.php", data, function (response) {
                // Manejar la respuesta del servidor (opcional)
                // Por ejemplo, redirigir a la página de pacientes después de eliminar con éxito
                window.location.href = '../pages/pacientes.php';
            }).fail(function (error) {
                // Manejar el error (opcional)
                console.error("Error al eliminar el paciente: ", error);
            });
        }
    });


</script>

</html>

<!-- Modal Registrar/Editar -->
<div class="modal fade" id="modalRegistrar" tabindex="-1" aria-labelledby="modalRegistrarLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <img src="../img/paciente.svg" alt="Estudiante" width="10%">
                <h5 class="text-uppercase text-center fw-bold" id="modalRegistrarLabel">Titulo del Modal</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Formulario de registro/edición -->
                <form action="../crud/crud_pacientes.php" method="POST">
                    <input type="text" name="id_paciente" id="id_paciente">
                    <label class="fw-bold" for="dni">DNI:</label>
                    <input class="input1-m" type="text" name="dni" id="dni">
                    <br><br>
                    <label class="fw-bold" for="name">Nombre completo:</label>
                    <input class="input2-m" type="text" name="firtname" id="firtname" placeholder="Primero">
                    <input class="input2-m" type="text" name="secondname" id="secondname" placeholder="Segundo">
                    <br><br>
                    <label class="fw-bold" for="lastname">Apellido completo:</label>
                    <input class="input2-m" type="text" name="firtlastname" id="firtlastname" placeholder="Primero">
                    <input class="input2-m" type="text" name="secondlastname" id="secondlastname" placeholder="Segundo">
                    <br><br>
                    <label class="fw-bold" for="fn">Fecha Nacimiento:</label>
                    <input class="input1-m" name="txtfecha" id="txtfecha" type="date" value="2022-01-01"
                        min="2022-09-30" max="2025-12-31" required />
                    <br><br>
                    <label class="fw-bold" for="genero">Género:</label>
                    <select class="input1-m" name="genero" id="genero">
                        <option VALUES="F">Femenino</option>
                        <option VALUES="M">Maculino</option>
                    </select>
                    <br><br>
                    <label class="fw-bold" for="ciudad">Ciudad:</label>
                    <select class="input1-m" name="ciudad" id="ciudad">
                        <?php
                        require_once '../crud/crud.php';
                        $ciudades = obtenerRegistros('tb_ciudades');
                        foreach ($ciudades as $ciudad) {
                            $id_ciudad = $ciudad['id_ciudad'];
                            $nombre_ciudad = $ciudad['nombre'];
                            echo "<option value=\"$id_ciudad\">$nombre_ciudad</option>";
                        }
                        ?>
                    </select>
                    <br><br>
                    <div class="form-group">
                        <label class="fw-bold" for="direc">Dirección:</label>
                        <input class="input1-m" type="text" name="sector" id="sector" placeholder="Sector">
                        <br>
                        <input class="input2-m" type="text" name="calle" id="calle" placeholder="Calle">
                        <input class="input2-m" type="text" name="numcasa" id="numcasa" placeholder="# Casa">
                    </div>
                    <br>
                    <label class="fw-bold" for="tel">Teléfono:</label>
                    <input class="input1-m" name="tel" id="tel" type="tel" pattern="\+\d{3}\d{4}\d{4}"
                        placeholder="+50400000000" size="50px" title="Formato +50400000000" required
                        list="codigopais" /><br>
                    <datalist id="codigopais">
                        <option label="Honduras" value="+504"></option>
                        <option label="El Salvador" value="+503"></option>
                    </datalist>
                    <br>
                    <label class="fw-bold" for="email">Correo:</label>
                    <input class="input1-m" type="email" id="correo" name="correo" placeholder="bob@example.com"
                        required>
                    <br><br>
                    <div class="form-group">
                        <label class="fw-bold" for="alergia">Alergias:</label>
                        <textarea id="alergia" name="alegia" rows="2" cols="20"></textarea>
                    </div>
                    <br>
                    <!-- Campo hidden para indicar la acción de inserción o edición -->
                    <input type="hidden" name="accion" value="insertar" id="accion">
                    <br>
                    <!-- Botones del formulario -->
                    <div class="col-12 d-flex justify-content-end">
                        <button type="submit" class="btn-guardar my-class1 my-row">
                            <img src="../img/salvar.svg" alt="">Guardar
                        </button>
                        <button type="reset" class="btn-cancelar my-class1 my-row">
                            <img src="../img/xw.svg" alt="">Cancelar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>