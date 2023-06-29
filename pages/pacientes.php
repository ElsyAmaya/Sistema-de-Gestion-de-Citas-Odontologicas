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

    <div  class="contenedor-general">
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
                    <input autocomplete="off" type="text" class="form-control w-25" name="id" placeholder="Buscar">
                    <button type="submit" name="enviar" class="btn-buscar my-class1"><img src="../img/lupa.svg" alt=""></button>
                   </div>
                </div>
            </form>
            <div>
            <table id="tabla">
    <thead>
        <tr id="fila">
            <th id="columna">Id</th>
            <th id="columna">Primer Nombre</th>
            <th id="columna">Segundo Nombre</th>
            <th id="columna">Primer Apellido</th>
            <th id="columna">Segundo Apellido</th>
            <th id="columna">Fecha Nac.</th>
            <th id="columna">Género</th>
            <th id="columna">Dirección</th>
            <th id="columna">Teléfono</th>
            <th id="columna">Correo</th>
            <th id="columna">Alergias</th>
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
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td><a class="btn-historial"><img src="../img/record.svg" alt="" width="20px" style="margin-bottom:2px;"></a></td>
            <td><a class="btn-editar"><img src="../img/edit.svg" alt="" width="20px" style="margin-bottom:2px;"></a></td>
            <td><a class="btn-eliminar"><img src="../img/delete.svg" alt=""  width="20px" style="margin-bottom:2px;"></a></td>
        </tr>
    </tbody>
</table>

        </div>
        
    </div>
    </div>
    </div>
</body>

</html>
