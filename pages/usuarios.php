<?php

include('header.php');
if ($_SESSION['rol'] === 'Recepcionista' || $_SESSION['rol'] === 'Especilista'){
    header("Location: main.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuarios</title>
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
                        <img src="../img/usuario.svg" alt="Estudiante" width="30%">
                    </div>
                    <div class="col-6">
                        <h2 class="text-uppercase text-start fw-bold">Registro de Usuarios</h2>
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
            <th id="columna">Usuario</th>
            <th id="columna">Rol</th>
            <th id="columna">Estado</th>
            <th id="columna" colspan="3">Opciones</th>
        </tr>
    </thead>
    <tbody id="tabla-body">
        <?php
        require_once '../crud/crud.php';
        $usuarios = obtenerRegistros('tb_usuarios'); // Replace 'tb_usuarios' with the appropriate table name
        foreach ($usuarios as $usuario) {
            $id= $usuario['id_usuario'];
            $usuarioName = $usuario['usuario'];
            $rol = $usuario['rol'];
            $estado = $usuario['estado'];
        ?>
        <tr>
            <td><?php echo $id; ?></td>
            <td><?php echo $usuarioName; ?></td>
            <td><?php echo $rol; ?></td>
            <td><?php echo $estado; ?></td>
            <td>
                                    <a class="btn-refresh" data-bs-toggle="modal" data-bs-target="#modalRefresh"
                                        data-usuario='<?php echo json_encode($usuario); ?>'
                                        data-id="<?php echo $id_usuario; ?>">
                                        <img src="../img/refresh.svg" alt="" width="20px" style="margin-bottom:2px;">
                                    </a>
                                </td>
            <td>
                                    <a class="btn-editar" data-bs-toggle="modal" data-bs-target="#modalRegistrar"
                                        data-usuario='<?php echo json_encode($usuario); ?>'
                                        data-id="<?php echo $id_usuario; ?>">
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
    // Evento click para abrir el formulario modal para editar un usuario
    $(".btn-editar").click(function () {
        var usuario = $(this).data("usuario"); // Obtener los datos del usuario desde el atributo data-usuario

        // Cargar los datos del usuario en el formulario modal
        $("#id_usuario").val(usuario.id_usuario); // Change to appropriate field name
        $("#user").val(usuario.usuario);
        $("#txtpassword").val(usuario.password);
        $("#confirmPassword").val(usuario.password);
        $("#rol").val(usuario.rol); // Populate the role field
        $("#estado").val(usuario.estado);
            // Ocultar la opción "Especialista" si el rol es "Administrador" o "Recepcionista"
    if (usuario.rol === "Administrador" || usuario.rol === "Recepcionista") {
        $("#rol option[value='Especialista']").hide();
    } else {
        $("#rol option[value='Especialista']").show();
    }
    $("#txtpassword").attr("disabled", true);
    $("#confirmPassword").attr("disabled", true);
    $("#confirmPassword").val(usuario.password);
        // Cambiar el valor del campo oculto 'accion' a 'editar'
    $("#accion").val("editar");
        // Actualizar el título del modal a "Editar Usuario"
    $("#modalRegistrarLabel").text("Editar Usuario");
    });
//...............................................................
     // Evento click para abrir el formulario modal para editar un usuario
    $(".btn-refresh").click(function () {
        var usuario = $(this).data("usuario"); // Obtener los datos del usuario desde el atributo data-usuario
        // Cargar los datos del usuario en el formulario modal
    $("#id_Usuario").val(usuario.id_usuario); // Change to appropriate field name
    $("#txtPassword").val("");
    $("#ConfirmPassword").val("");
        // Cambiar el valor del campo oculto 'accion' a 'editar'
    $("#accion").val("refresh");
        // Actualizar el título del modal a "Editar Usuario"
    $("#ModalRegistrarLabel").text("Cambio de Contraseña");
    });

    // Evento click para abrir el formulario modal para registrar un usuario
    $("#btnAgregar").click(function () {
        // Restaurar los campos del formulario (opcional)
        $("#id_usuario").val(""); // Change to appropriate field name
        $("#user").val("");
        $("#txtpassword").val("");
        $("#confirmPassword").val("");
        $("#rol").val("");
        $("#estado").val("");
    
        // Cambiar el valor del campo oculto 'accion' a 'insertar'
        $("#accion").val("insertar");
        // Actualizar el título del modal a "Registrar Usuario"
        $("#modalRegistrarLabel").text("Registrar Usuario");
        $("#txtpassword").attr("disabled", false);
        $("#confirmPassword").attr("disabled", false);
        $("#rol option[value='Especialista']").show();
    });

    $(".btn-eliminar").click(function () {
        var idUsuarios = $(this).data("id");

        // Mostrar mensaje de confirmación
        var confirmarEliminar = confirm("¿Estás seguro de que deseas eliminar este usuario?");
        if (confirmarEliminar) {
            // Crear un objeto de datos que contiene la acción y el ID del servicio
            var data = {
                accion: 'eliminar',
                id_usuario: idUsuarios
            };
            // Enviar la solicitud POST con los datos del servicio a crud_servicios.php (ajusta la ruta según tu caso)
            $.post("../crud/crud_usuarios.php", data, function (response) {
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

                <img src="../img/usuario.svg" alt="Estudiante" width="10%">
                <h5 class="text-uppercase text-center fw-bold" id="modalRegistrarLabel">Titulo del Modal</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../crud/crud_usuarios.php" method="POST">
                <input type="hidden" name="id_usuario" id="id_usuario">
                <label class="fw-bold" for="user">Usuario:</label>
                    <input class="input1-m" type="text" name="user" id="user" required>
                    <br><br>
                    <label class="fw-bold" for="txtpassword">Contraseña:</label>
                    <input class="input1-m" name="txtpassword" id="txtpassword" type="password" required>
                    <br><br>
                    <label class="fw-bold" for="confirmPassword">Confirmar Contraseña:</label>
                    <input class="input1-m" name="confirmPassword" id="confirmPassword" type="password" required>
                    <br><br>
                    <label class="fw-bold" for="rol">Rol:</label>
                    
                    <select class="input1-m" name="rol" id="rol" required>
                        <option value="Administrador">Administrador</option>
                        <option value="Recepcionista">Recepcionista</option>
                        <option value="Especialista">Especialista</option>
                    </select>
                    <br><br>
                    <input type="hidden" name="accion" value="insertar" id="accion">
                    <br>
                    <input type="hidden" name="estado"  id="estado">
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

<!-- Modal -->
<div class="modal fade" id="modalRefresh" tabindex="-1" aria-labelledby="ModalRegistrarLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <img src="../img/usuario.svg" alt="Estudiante" width="10%">
                <h5 class="text-uppercase text-center fw-bold" id="ModalRegistrarLabel">Titulo del Modal</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../crud/crud_usuarios.php" method="POST">
                    <input type="hidden" name="id_Usuario" id="id_Usuario">
              
                    <label class="fw-bold" for="txtPassword">Contraseña:</label>
                    <input class="input1-m" name="txtPassword" id="txtPassword" type="password" required>
                    <br><br>
                    <label class="fw-bold" for="ConfirmPassword">Confirmar Contraseña:</label>
                    <input class="input1-m" name="ConfirmPassword" id="ConfirmPassword" type="password" required>
                    <br><br>
                    <input type="hidden" name="accion" value="refresh" id="accion">
                    <br>
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
