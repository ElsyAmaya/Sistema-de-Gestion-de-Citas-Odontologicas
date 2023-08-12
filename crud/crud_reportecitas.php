<?php
require_once 'crud.php';

// Obtener valores del formulario
$dniPaciente = $_POST['dni']; // El nombre del paciente ingresado
$estadoProgramadas = isset($_POST['prog']) ? true : false; // Si el checkbox de programadas está marcado
$estadoAsistidas = isset($_POST['asist']) ? true : false; // Si el checkbox de asistidas está marcado
$estadoCanceladas = isset($_POST['canc']) ? true : false; // Si el checkbox de canceladas está marcado
$fechaInicial = $_POST['fInicial']; // Fecha inicial seleccionada
$fechaFinal = $_POST['fFinal']; // Fecha final seleccionada

// Llama a la función para obtener las citas con información y aplicar los filtros
$citas = obtenerCitasFiltradas($dniPaciente, $estadoProgramadas, $estadoAsistidas, $estadoCanceladas, $fechaInicial, $fechaFinal);
?>
