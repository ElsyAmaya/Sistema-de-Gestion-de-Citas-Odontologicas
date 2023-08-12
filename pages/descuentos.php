<?php

include('header.php');
if ($_SESSION['rol'] === 'Recepcionista' || $_SESSION['rol'] === 'Especialista'){
    header("Location: main.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Descuentos</title>
</head>
<style type="text/css">
    #tabla, #fila ,#columna { height: 25px;  padding: 10px; font-weight: bold;  border: 1px solid black; border-collapse: collapse; text-align: center;}
</style>
<body>

    <div class="contenedor-general">
        <div>
            <div class="row">
                <div class="row mb-4 mt-2 d-flex justify-content-center">
                    <div class="col-2 text-end">
                        <img src="../img/descuento.svg" alt="Estudiante" width="40%">
                    </div>
                    <div class="col-6">
                        <h2 class="text-uppercase text-start fw-bold">Registro de Descuentos</h2>
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
            <th id="columna">Id</th>
            <th id="columna">Servicios</th>
            <th id="columna">Descuento %</th>
            <th id="columna">Fecha Inicial</th>
            <th id="columna">Fecha Final</th>
            <th id="columna">Estado</th>
            <th id="columna" colspan="3">Opciones</th>
        </tr>
    </thead>
    <tbody id="tabla-body">
        <?php
        require_once '../crud/crud.php';
        $descuentos = obtenerRegistros('tb_descuentos'); // Cambiar 'tb_servicios_tratamientos' por 'tb_descuentos'
        foreach ($descuentos as $descuento) {
            $id = $descuento['id_descuento'];
            $servicio = $descuento['id_srvtrat']; // Cambiar 'id_especialidad' por 'id_srvtrat'
            $descuentoPorcentaje = $descuento['descuento'];
            $fechaInicial = $descuento['fecha_ini'];
            $fechaFinal = $descuento['fecha_fin'];
            $estado = $descuento['estado'];
            ?>
            <tr>
                <td><?php echo $id; ?></td>
                <td><?php echo $servicio; ?></td>
                <td><?php echo $descuentoPorcentaje; ?></td>
                <td><?php echo $fechaInicial; ?></td>
                <td><?php echo $fechaFinal; ?></td>
                <td><?php echo $estado; ?></td>
                <td>
                                    <a class="btn-editar" data-bs-toggle="modal" data-bs-target="#modalRegistrar"
                                        data-descuento='<?php echo json_encode($descuento); ?>'
                                        data-id="<?php echo $id_descuento; ?>">
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
    // Evento click para abrir el formulario modal para editar un descuento
    $(".btn-editar").click(function () {
        var descuento = $(this).data("descuento"); // Obtener los datos del descuento desde el atributo data-descuento
        // Cargar los datos del descuento en el formulario modal
        $("#id_descuento").val(descuento.id_descuento);
        $("#servicio").val(descuento.id_srvtrat); // Cambiar el valor del select según corresponda
        $("#txtnumero2").val(descuento.descuento);
        $("#txtfechaInicial").val(descuento.fecha_ini);
        $("#txtfechaFinal").val(descuento.fecha_fin);
        $("#estado").val(descuento.estado);

        // Cambiar el valor del campo oculto 'accion' a 'editar'
        $("#accion").val("editar");
        // Actualizar el título del modal a "Editar Descuento"
        $("#modalRegistrarLabel").text("Editar Descuento");
    });

    // Evento click para abrir el formulario modal para registrar un descuento
    $("#btnAgregar").click(function () {
        // Restaurar los campos del formulario (opcional)
        $("#id_descuento").val("");
        $("#servicio").val("");
        $("#txtnumero2").val("");
        $("#txtfechaInicial").val("");
        $("#txtfechaFinal").val("");
        $("#estado").val("");

        // Cambiar el valor del campo oculto 'accion' a 'insertar'
        $("#accion").val("insertar");
        // Actualizar el título del modal a "Registrar Descuento"
        $("#modalRegistrarLabel").text("Registrar Descuento");
    });

    $(".btn-eliminar").click(function () {
        var idDescuento = $(this).data("id");

        // Mostrar mensaje de confirmación
        var confirmarEliminar = confirm("¿Estás seguro de que deseas eliminar este descuento?");
        if (confirmarEliminar) {
            // Crear un objeto de datos que contiene la acción y el ID del descuento
            var data = {
                accion: 'eliminar',
                id_descuento: idDescuento
            };
            // Enviar la solicitud POST con los datos del descuento a tu archivo de manejo de CRUD
            $.post("ruta_a_tu_archivo_crud.php", data, function (response) {
                // Manejar la respuesta del servidor (opcional)
                // Por ejemplo, recargar la página después de eliminar con éxito
                location.reload();
            }).fail(function (error) {
                // Manejar el error (opcional)
                console.error("Error al eliminar el descuento: ", error);
            });
        }
    });
</script>

</html>

<div class="modal fade" id="modalRegistrar" tabindex="-1" aria-labelledby="modalRegistrarLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <img src="../img/descuento.svg" alt="Estudiante" width="10%">
                <h5 class="text-uppercase text-center fw-bold" id="modalRegistrarLabel">Titulo del Modal</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="procesar_registro.php" method="POST">
                <input type="text" name="id_descuento" id="id_descuento">
                    <label class="fw-bold" for="servicio">Servicio o Tratamiento:</label>
                    <select class="input1-m" name="servicio" id="servicio">
                    <?php
                        require_once '../crud/crud.php';
                        $srvtrm = obtenerRegistros('tb_servicios_tratamientos');
                        foreach ($srvtrm  as $servicios) {
                            $id_servicios = $servicios['id_srvtrat'];
                            $nombre_servicios= $servicios['nombre'];
                            echo "<option value=\"$id_servicios\">$nombre_servicios</option>";
                        }
                        ?>
                    </select>
                    <br><br>
                    <Label for="txtnumero2">Descuento &</Label>
                    <input name="txnumero2" id="txtnumero2" type="number" min="1" max="100" />
                    <br><br>
                    <Label for="txtfechaInicial">Fecha Inicial</Label>
                    <input name="txtfechaInicial" id="txtfechaInicial" type="datetime-local" value="2022-01-01" min="2022-09-30"
                        max="2025-12-31" required />
                    <br><br>

                    <Label for="txtfechaFinal">Fecha Final</Label>
                    <input name="txtfechaFinal" id="txtfechaFinal" type="datetime-local" value="2022-01-01" min="2022-09-30"
                        max="2025-12-31" required />
                    <br>
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