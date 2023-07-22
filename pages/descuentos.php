<?php

include('header.php');

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
    #tabla, #fila ,#columna { height: 25px;  padding: 20px; font-weight: bold;  border: 1px solid black; border-collapse: collapse; text-align: center;}
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
                    <button type="button" class="btn-agregar my-class1 my-row" data-bs-toggle="modal"
                        data-bs-target="#modalRegistrar"><img src="../img/aggw.svg" alt="">Agregar</button>
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
                            <tr>
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
                <h5 class="text-uppercase text-center fw-bold" id="modalRegistrarLabel"><img src="../img/descuento.svg"
                        alt="Estudiante" width="10%">Registrar Descuento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Aquí puedes colocar el formulario de registro del paciente -->
                <!-- Puedes utilizar HTML y PHP para construir el formulario -->
                <!-- Por ejemplo: -->
                <form action="procesar_registro.php" method="POST">

                    <label class="fw-bold" for="rol">Servicio o Tratamiento:</label>
                    <select class="input1-m" name="rol" id="rol">
                        <option>Limpieza Dental</option>
                        <option>Extracción</option>
                        <option>Prótesis</option>
                    </select>
                    <br><br>
                    <Label for="txtnumero2">Descuento &</Label>
                    <input name="txnumero2" id="txtnumero2" type="number" min="1" max="100" />
                    <br><br>
                    <Label for="txtfecha">Fecha Inicial</Label>
                    <input name="txtfecha" id="txtfecha" type="date" value="2022-01-01" min="2022-09-30"
                        max="2025-12-31" required />
                    <br><br>

                    <Label for="txtfecha">Fecha Final</Label>
                    <input name="txtfecha" id="txtfecha" type="date" value="2022-01-01" min="2022-09-30"
                        max="2025-12-31" required />
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