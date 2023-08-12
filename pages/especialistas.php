<?php

    include('header.php');

    if ($_SESSION['rol'] === 'Recepcionista'){
        header("Location: main.php");
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Especialistas</title>
</head>
<style type="text/css">
    #tabla,
    #fila,
    #columna {
        height: 25px;
        padding: 10px;
        font-weight: bold;
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
                        <img src="../img/medico.svg" alt="Estudiante" width="40%">
                    </div>
                    <div class="col-6">
                        <h2 class="text-uppercase text-start fw-bold">Registros de Especialistas</h2>
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

                <div class="scroll_tabla">
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
                                <th id="columna">Id_Ciudad</th>
                                <th id="columna">Sector</th>
                                <th id="columna">Calle</th>
                                <th id="columna"># Casa</th>
                                <th id="columna">Teléfono</th>
                                <th id="columna">Correo</th>
                                <th id="columna">Estado</th>
                                <th id="columna" colspan="3">Opciones</th>
                            </tr>
                        </thead>
                        <tbody id="tabla-body">
                            <?php
        require_once '../crud/crud.php';
        $especialistas = obtenerRegistros('tb_especialistas');
        foreach ($especialistas as $especialista) {
            $id = $especialista['id_especialista'];
            $dni = $especialista['dni'];
            $p_nombre = $especialista['p_nombre'];
            $s_nombre = $especialista['s_nombre'];
            $p_apellido = $especialista['p_apellido'];
            $s_apellido = $especialista['s_apellido'];
            $fecha_nac = $especialista['fecha_nac'];
            $genero = $especialista['genero'];
            $ciudad = $especialista['id_ciudad'];
            $sector = $especialista['sector'];
            $calle = $especialista['calle'];
            $num_casa = $especialista['num_casa'];
            $telefono = $especialista['telefono'];
            $correo = $especialista['correo'];
            $estado = $especialista['estado'];
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
                                    <?php echo $estado; ?>
                                </td>
                                <td>
                                    <a class="btn-editar" data-bs-toggle="modal" data-bs-target="#modalRegistrar"
                                        data-especialista='<?php echo json_encode($especialista); ?>'
                                        data-id="<?php echo $id_especialista; ?>">
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
<script>
    $(document).ready(function () {
        $(".btn-editar").click(function () {
            var especialista = $(this).data("especialista");
            // Cargar los datos del especialista en el formulario modal
            $("#id_especialista").val(especialista.id_especialista);
            $("#dni").val(especialista.dni);
            $("#firtname").val(especialista.p_nombre);
            $("#secondname").val(especialista.s_nombre);
            $("#firtlastname").val(especialista.p_apellido);
            $("#secondlastname").val(especialista.s_apellido);
            $("#txtfecha").val(especialista.fecha_nac);
            $("#genero").val(especialista.genero);
            $("#ciudad").val(especialista.id_ciudad);
            $("#sector").val(especialista.sector);
            $("#calle").val(especialista.calle);
            $("#numcasa").val(especialista.num_casa);
            $("#tel").val(especialista.telefono);
            $("#correo").val(especialista.correo);

            $("#accion-especialista").val("editar");
            $("#modalRegistrarEspecialistaLabel").text("Editar Especialista");
        });

        $("#btnAgregar").click(function () {
            $("form")[0].reset();
            $("#accion-especialista").val("insertar");
            $("#modalRegistrarEspecialistaLabel").text("Registrar Especialista");
        });

        $(".btn-eliminar").click(function () {
            var idEspecialista = $(this).data("id");

            // Mostrar mensaje de confirmación
            var confirmarEliminar = confirm("¿Estás seguro de que deseas eliminar este especialista?");
            if (confirmarEliminar) {
                // Crear un objeto de datos que contiene la acción y el ID del especialista
                var data = {
                    accion: 'eliminar',
                    id_especialista: idEspecialista
                };
                // Enviar la solicitud POST con los datos del especialista a la URL correspondiente
                $.post("ruta_hacia_archivo_php.php", data, function (response) {
                    // Manejar la respuesta del servidor (opcional)
                    // Por ejemplo, redirigir a la página de especialistas después de eliminar con éxito
                    window.location.href = 'ruta_hacia_pagina_especialistas.php';
                }).fail(function (error) {
                    // Manejar el error (opcional)
                    console.error("Error al eliminar el especialista: ", error);
                });
            }
        });
    });
</script>

</html>

<!-- Modal Registrar/Editar -->
<div class="modal fade" id="modalRegistrar" tabindex="-1" aria-labelledby="modalRegistrarLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <img src="../img/medico.svg" alt="Estudiante" width="10%">
                <h5 class="text-uppercase text-center fw-bold" id="modalRegistrarLabel">Titulo del Modal</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Aquí puedes colocar el formulario de registro del paciente -->
                <!-- Puedes utilizar HTML y PHP para construir el formulario -->
                <!-- Por ejemplo: -->
                <form action="../crud/crud_especialistas.php" method="POST">

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
                    <input class="input1-m" name="txtfecha" id="txtfecha" type="date" min="1913-12-31" max=""
                        required />
                    <br><br>
                    <label class="fw-bold" for="genero">Género:</label>
                    <select class="input1-m" name="genero" id="genero">
                        <option value="F">Femenino</option>
                        <option value="M">Masculino</option>
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
                        <label class="fw-bold" for="alergia">Especialidades:</label>
                        <select id="ms" name="especialidades[]" multiple="multiple">
                            <?php
                        require_once '../crud/crud.php';
                        $especialidades = obtenerRegistros('tb_especialidad');
                        foreach ($especialidades as $especialidad) {
                            $id_especialidad = $especialidad['id_especialidad'];
                            $nombre_especialidad = $especialidad['nombre'];
                            echo "<option value=\"$id_especialidad\">$nombre_especialidad</option>";
                        }
                        ?>
                        </select>
                    </div>
                    <br>
                    <label class="fw-bold" for="ciudad">Usuario:</label>
                    <select class="input1-m" name="ciudad" id="ciudad">
                        <?php
                        require_once '../crud/crud.php';
                        $usuarios = buscarPorCampoUsu('tb_usuarios','estado','Disponible','rol','Especialista');
                        foreach ($usuarios as $usuario) {
                            $id_usuario = $usuario['id_usuario'];
                            $nombre_usuario = $usuario['usuario'];
                            echo "<option value=\"$id_usuario\">$nombre_usuario</option>";
                        }
                        ?>
                    </select>
                    <br><br>
                    <!-- Campo hidden para indicar la acción de inserción o edición -->
                    <input type="text" name="accion" value="insertar" id="accion">
                    <br>

                    <div class="col-12 d-flex justify-content-end">
                        <button type="submit" class="btn-guardar my-class1 my-row"><img src="../img/salvar.svg"
                                alt="">Guardar</button>
                        <button type="reset" class="btn-cancelar my-class1 my-row"><img src="../img/xw.svg"
                                alt="">Cancelar</button>
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
    document.getElementById("txtfecha").setAttribute("max", maxDate);
</script>