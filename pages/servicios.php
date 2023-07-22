<?php
    include('header.php');
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
    #tabla, #fila ,#columna { height: 25px;  padding: 20px; font-weight: bold;  border: 1px solid black; border-collapse: collapse; text-align: center;}
</style>

<body>
    <div class="contenedor-general">
        <div>
            <div class="row">
                <div class="row mb-4 mt-2 d-flex justify-content-center">
                    <div class="col-2 text-end">
                        <img src="../img/paciente.svg" alt="imagen de tratemiento" width="40%">
                    </div>
                    <div class="col-6">
                        <h2 class="text-uppercase text-start fw-bold">Registro de servicios y tratamientos</h2>
                    </div>
                </div>
                <form action="listadoGeneralAlumnos.php" method="POST">
                    <div class="row">
                        <div class="d-grid gap-2 d-md-flex justify-content-md-start my-row">
                            <input autocomplete="off" type="text" class="form-control w-25" name="id" placeholder="Buscar">
                            <button type="submit" name="enviar" class="btn-buscar my-class1"><img src="../img/lupa.svg"></button>
                        </div>
                    </div>
                </form>
                <div class="col-12 d-flex justify-content-end">
                    <button type="button" class="btn-agregar my-class1 my-row" data-bs-toggle="modal" data-bs-target="#modalRegistrar"><img src="../img/aggw.svg">Agregar</button>
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
                                <th id="columna">Especialidad</th>
                                <th id="columna">Estado</th>
                                <th id="columna" colspan="2">Opciones</th>
                            </tr>
                        </thead>
                        <tbody id="tabla-body">
                            <tr>
                                <td>1</td>
                                <td>Caries</td>
                                <td>te lavan, pero uff</td>
                                <td>Limpieza</td>
                                <td>30min</td>
                                <td>L.800.00</td>
                                <td>General</td>
                                <td>Activo</td>
                                <td><a class="btn-editar" data-bs-toggle="modal" data-bs-target="#modalEditar"><img src="../img/edit.svg" alt="" width="20px" style="margin-bottom:2px;"></a></td>
                                <td><a class="btn-eliminar"><img src="../img/delete.svg" alt="" width="20px" style="margin-bottom:2px;"></a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>




<!-- Modal Registrar -->
<div class="modal fade" id="modalRegistrar" tabindex="-1" aria-labelledby="modalRegistrarLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="text-uppercase text-center fw-bold" id="modalRegistrarLabel"><img src="../img/paciente.svg" alt="Registro de tratamiento" width="10%">Registrar Servicio o Tratamiento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Aquí puedes colocar el formulario de registro del paciente -->
                <!-- Puedes utilizar HTML y PHP para construir el formulario -->
                <!-- Por ejemplo: -->
                <form action="procesar_registro.php" method="POST">

                    <label class="fw-bold" for="txt-name">Nombre:</label>
                    <input class="input1-m" type="text" name="txt-name" id="txt-name" required>
                    <br><br>

                    <label class="fw-bold" for="txt-descrip">Descripcion:</label>
                    <input class="input1-m" type="text" name="txt-descrip" id="txt-descrip" placeholder="escriba una descripción" required>
                    <br><br>

                    <label class="fw-bold" for="sel-type">Tipo:</label>
                    <select class="input1-m" name="sel-type" id="sel-type">
                        <option>Llenar</option>
                        <option>de</option>
                        <option>Base de datos</option>
                    </select>
                    <br><br>

                    <label class="fw-bold" for="txt-time">Duracion:</label>
                    <input class="input2-m" type="number" id="txt-time" name="txt-time" min="01" max="300" maxlength="3"
                        required> min
                    <br><br>

                    <label class="fw-bold" for="txt-cost">Costo:</label>
                    <input class="input1-m" type="text" name="txt-cost" id="txt-cost" pattern="[0-9]+" placeholder="0.00" required>
                    <br><br>

                    <label class="fw-bold" for="sel-Esp">Especialidad:</label>
                    <select class="input1-m" name="sel-Esp" id="sel-Esp">
                        <option>Llenar</option>
                        <option>de</option>
                        <option>Base de datos</option>
                    </select>
                    <br><br>

                    <div class="col-12 d-flex justify-content-end">
                        <button type="submit" class="btn-guardar my-class1 my-row"><img src="../img/salvar.svg">Guardar</button>
                        <button type="reset" class="btn-cancelar my-class1 my-row"><img src="../img/xw.svg">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Editar-->
<div class="modal fade" id="modalEditar" tabindex="-1" aria-labelledby="modalEditar" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="text-uppercase text-center fw-bold" id="modalEditarLabel"><img src="../img/paciente.svg" alt="actualizar tratamiento" width="10%">Actualizar tratamiento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Aquí puedes colocar el formulario de registro del paciente -->
                <!-- Puedes utilizar HTML y PHP para construir el formulario -->
                <!-- Por ejemplo: -->
                <form action="procesar_registro.php" method="POST">

                    <label class="fw-bold" for="txt-name">Nombre:</label>
                    <input class="input1-m" type="text" name="txt-name" id="txt-name" required>
                    <br><br>

                    <label class="fw-bold" for="txt-descrip">Descripcion:</label>
                    <input class="input1-m" type="text" name="txt-descrip" id="txt-descrip"
                        placeholder="escriba una descripción" required>
                    <br><br>

                    <label class="fw-bold" for="sel-type">Tipo:</label>
                    <select class="input1-m" name="sel-type" id="sel-type">
                        <option>Llenar</option>
                        <option>de</option>
                        <option>Base de datos</option>
                    </select>
                    <br><br>

                    <label class="fw-bold" for="txt-time">Duracion:</label>
                    <input class="input2-m" type="number" id="txt-time" name="txt-time" min="01" max="300" maxlength="3" pattern="[0-9]{3}" required> min
                    <br><br>

                    <label class="fw-bold" for="txt-cost">Costo:</label>
                    <input class="input1-m" type="text" name="txt-cost" id="txt-cost" placeholder="0.00" pattern="[0-9]{8}" required>
                    <br><br>

                    <label class="fw-bold" for="sel-Esp">Especialidad:</label>
                    <select class="input1-m" name="sel-Esp" id="sel-Esp">

                  <?php

                       /*  $sql = "SELECT * FROM tb_especialidades WHERE estado = 'Activo'";
                        $result = mysqli_query($conn, $sql);

                        if(mysqli_num_rows($result)){
                            while($row = mysqli_fetch_assoc($result)){
                                echo $option["especialidad"];
                                echo "<option>{$row[especialidad]}</option>"
                            }; 
                        }else{echo "No existen especialidades";}*/
                    ?>
                    </select>
                    <br><br>

                    <div class="col-12 d-flex justify-content-end">
                        <button type="submit" class="btn-guardar my-class1 my-row"><img src="../img/salvar.svg">Guardar</button>
                        <button type="reset" class="btn-cancelar my-class1 my-row"><img src="../img/xw.svg">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>

</html>