<?php
    include('header.php');
    if ($_SESSION['rol'] === 'Recepcionista' || $_SESSION['rol'] === 'Especialista'){
        header("Location: main.php");
    }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Servicios y tratamientos</title>

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
                        <img src="../img/dentista.svg" alt="imagen de tratemiento" width="40%">
                    </div>
                    <div class="col-6">
                        <h2 class="text-uppercase text-start fw-bold">Registro de servicios y tratamientos</h2>
                    </div>
                </div>
                <form action="listadoGeneralAlumnos.php" method="POST">
                    <div class="row">
                        <div class="d-grid gap-2 d-md-flex justify-content-md-start my-row">
                            <input autocomplete="off" type="text" class="form-control w-25" name="id"
                                placeholder="Buscar">
                            <button type="submit" name="enviar" class="btn-buscar my-class1"><img
                                    src="../img/lupa.svg"></button>
                        </div>
                    </div>
                </form>
                    <!-- ....................................... -->
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
                                <th id="columna">Id</th>
                                <th id="columna">Nombre</th>
                                <th id="columna">Descripcion</th>
                                <th id="columna">Tipo</th>
                                <th id="columna">Duracion estimada</th>
                                <th id="columna">Costo</th>
                                <th id="columna">Id_Especialidad</th>
                                <th id="columna">Estado</th>
                                <th id="columna" colspan="2">Opciones</th>
                            </tr>
                        </thead>
                        <tbody id="tabla-body">
                            <?php
    require_once '../crud/crud.php';
    $servicios = obtenerRegistros('tb_servicios_tratamientos'); // Cambiar 'tb_pacientes' por 'tb_servicios'
    foreach ($servicios as $servicio) {
        $id = $servicio['id_srvtrat']; // Cambiar 'id_paciente' por 'id_servicio'
        $nombre = $servicio['nombre'];
        $descripcion = $servicio['descripcion'];
        $tipo = $servicio['tipo'];
        $duracion = $servicio['duracion'];
        $costo = $servicio['costo'];
        $especialidad = $servicio['id_especialidad'];
        $estado = $servicio['estado'];
        ?>
                            <tr>
                                <td>
                                    <?php echo $id; ?>
                                </td>
                                <td>
                                    <?php echo $nombre; ?>
                                </td>
                                <td>
                                    <?php echo $descripcion; ?>
                                </td>
                                <td>
                                    <?php echo $tipo; ?>
                                </td>
                                <td>
                                    <?php echo $duracion; ?>
                                </td>
                                <td>
                                    <?php echo $costo; ?>
                                </td>
                                <td>
                                    <?php echo $especialidad; ?>
                                </td>
                                <td>
                                    <?php echo $estado; ?>
                                </td>
                                <td>
                                    <a class="btn-editar" data-bs-toggle="modal" data-bs-target="#modalRegistrar"
                                        data-servicio='<?php echo json_encode($servicio); ?>'
                                        data-id="<?php echo $id_servicio; ?>">
                                        <img src="../img/edit.svg" alt="" width="20px" style="margin-bottom:2px;">
                                    </a>
                                </td>
                                <td>
                                    <a class="btn-eliminar" data-id="<?php echo $id; ?>">
                                        <img src="../img/delete.svg" alt="" width="20px" style="margin-bottom:2px;">
                                    </a>
                                </td>
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
    // Evento click para abrir el formulario modal para editar un servicio
    $(".btn-editar").click(function () {
        var servicio = $(this).data("servicio"); // Obtener los datos del servicio desde el atributo data-servicio
        // Cargar los datos del servicio en el formulario modal
        $("#id_servicio").val(servicio.id_srvtrat);
        $("#nombre").val(servicio.nombre);
        $("#descripcion").val(servicio.descripcion);
        $("#tipo").val(servicio.tipo);
        $("#duracion").val(servicio.duracion);
        $("#costo").val(servicio.costo);
        $("#especialidad").val(servicio.id_especialidad);
        $("#estado").val(servicio.estado);

        // Cambiar el valor del campo oculto 'accion' a 'editar'
        $("#accion").val("editar");
        // Actualizar el título del modal a "Editar Servicio"
        $("#modalRegistrarLabel").text("Editar Servicio o Tratamiento");
    });

    // Evento click para abrir el formulario modal para registrar un servicio
    $("#btnAgregar").click(function () {
        // Restaurar los campos del formulario (opcional)
        $("#id_servicio").val("");
        $("#nombre").val("");
        $("#descripcion").val("");
        $("#tipo").val("");
        $("#duracion").val("");
        $("#costo").val("");
        $("#especialidad").val("");
        $("#estado").val("");

        // Cambiar el valor del campo oculto 'accion' a 'insertar'
        $("#accion").val("insertar");
        // Actualizar el título del modal a "Registrar Servicio"
        $("#modalRegistrarLabel").text("Registrar Servicio o Tratamiento");
    });

    $(".btn-eliminar").click(function () {
        var idServicio = $(this).data("id");

        // Mostrar mensaje de confirmación
        var confirmarEliminar = confirm("¿Estás seguro de que deseas eliminar este servicio?");
        if (confirmarEliminar) {
            // Crear un objeto de datos que contiene la acción y el ID del servicio
            var data = {
                accion: 'eliminar',
                id_servicio: idServicio
            };
            // Enviar la solicitud POST con los datos del servicio a crud_servicios.php (ajusta la ruta según tu caso)
            $.post("../crud/crud_servicios.php", data, function (response) {
                // Manejar la respuesta del servidor (opcional)
                // Por ejemplo, recargar la página después de eliminar con éxito
                location.reload();
            }).fail(function (error) {
                // Manejar el error (opcional)
                console.error("Error al eliminar el servicio: ", error);
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

                <img src="../img/dentista.svg" alt="Estudiante" width="10%">
                <h5 class="text-uppercase text-center fw-bold" id="modalRegistrarLabel">Titulo del Modal</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../crud/crud_servicios.php" method="POST">
                    <!-- ....................................... -->
                    <input type="text" name="id_servicio" id="id_servicio">

                    <label class="fw-bold" for="nombre">Nombre:</label>
                    <input class="input1-m" type="text" name="nombre" id="nombre" required>
                    <br><br>
                    <div class="form-group">
                        <label class="fw-bold" for="descripcion">Descripcion:</label>
                        <textarea id="descripcion" name="descripcion" rows="2" cols="20"></textarea>
                    </div>
                    <br>

                    <label class="fw-bold" for="tipo">Tipo:</label>
                    <select class="input1-m" name="tipo" id="tipo">
                        <option value="Servicio">Servicio</option>
                        <option value="Tratamiento">Tratamiento</option>
                    </select>
                    <br><br>

                    <label class="fw-bold" for="duracion">Duracion:</label>
                    <input class="input2-m" type="number" id="duracion" name="duracion" min="1" max="60" maxlength="3"
                        required> min
                    <br><br>

                    <label class="fw-bold" for="costo">Costo:</label>
                    <input class="input1-m" type="text" name="costo" id="costo" pattern="[0-9]+(\.[0-9]{1,2})?"
                        placeholder="0.00" required> Lem.
                    <br><br>

                    <label class="fw-bold" for="especialidad">Especialidad:</label>
                    <select class="input1-m" name="especialidad" id="especialidad">
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
                    <!-- ....................................... -->
                    <!-- Campo hidden para indicar la acción de inserción o edición -->
                    <input type="text" name="accion" value="insertar" id="accion">
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