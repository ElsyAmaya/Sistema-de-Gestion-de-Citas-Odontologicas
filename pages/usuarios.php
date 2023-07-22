<?php

include('header.php');

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
                    <button type="button" class="btn-agregar my-class1 my-row" data-bs-toggle="modal"
                        data-bs-target="#modalRegistrar"><img src="../img/aggw.svg" alt="">Agregar</button>
                </div>
                <div>
                    <table id="tabla">
                        <thead>
                            <tr id="fila">
                                <th id="columna">Id</th>
                                <th id="columna">Nombre</th>
                                <th id="columna">Apellido</th>
                                <th id="columna">Usuario</th>
                                <th id="columna">Teléfono</th>
                                <th id="columna">Correo</th>
                                <th id="columna">Rol</th>
                                <th id="columna">Estado</th>
                                <th id="columna" colspan="3">Opciones</th>
                            </tr>
                        </thead>
                        <tbody id="tabla-body">
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><a class="btn-historial"><img src="../img/record.svg" alt="" width="20px"
                                            style="margin-bottom:2px;"></a></td>
                                <td><a class="btn-editar" data-bs-toggle="modal" data-bs-target="#modalEditar"><img
                                            src="../img/edit.svg" alt="" width="20px" style="margin-bottom:2px;"></a>
                                </td>
                                <td><a class="btn-eliminar"><img src="../img/delete.svg" alt="" width="20px"
                                            style="margin-bottom:2px;"></a></td>
                            </tr>
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
                        alt="Estudiante" width="10%">Registrar Usuarios</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Aquí puedes colocar el formulario de registro del paciente -->
                <!-- Puedes utilizar HTML y PHP para construir el formulario -->
                <!-- Por ejemplo: -->
                <form action="procesar_registro.php" method="POST">

                    <label class="fw-bold" for="dni">DNI:</label>
                    <input class="input1-m" type="text" name="dni" id="dni">
                    <br><br>
                    <label class="fw-bold" for="name">Nombre:</label>
                    <input class="input2-m" type="text" name="firtname" id="firtname" placeholder="Primero">
                    <br><br>
                    <label class="fw-bold" for="lastname">Apellido:</label>
                    <input class="input2-m" type="text" name="firtlastname" id="firtlastname" placeholder="Primero">
                    <br><br>
                    <label class="fw-bold" for="name">Usuario:</label>
                    <input class="input2-m" type="text" name="user" id="user" placeholder="usuario">
                    <br><br>
                    <label class="fw-bold" for="txtpassword">Contraseña</label>
                    <input class="imput2-m" name="txtpassword" id="txtpassword" type="password">
                    <br><br>
                    <label class="fw-bold" for="txtpassword">Confirmar Contraseña</label>
                    <input class="imput2-m" name="txtpassword" id="txtpassword" type="password">
                    <br><br>
                    <label class="fw-bold" for="tel">Teléfono:</label>
                    <input class="input1-m" name="tel" id="tel" type="tel" placeholder="+504-0000-0000" size="50px"
                        title="Formato +504-0000-0000" pattern="[+0-9]{4}-[0-9]{4}-[0-9]" required
                        list="codigopais" /><br>
                    <datalist id="codigopais">
                        <option label="Honduras" value="+504"></option>
                        <option label="El Salvador" value="+503"></option>
                    </datalist>
                    <br><br>
                    <label class="fw-bold" for="email">Correo:</label>
                    <input class="input1-m" type="email" id="correo" name="correo" placeholder="bob@example.com"
                        required>
                    <br><br>
                    <label class="fw-bold" for="rol">Rol:</label>
                    <select class="input1-m" name="rol" id="rol">
                        <option>Administrador</option>
                        <option>Secretaria</option>
                        <option>Usuario</option>
                    </select>
                    <br><br>
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