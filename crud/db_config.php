<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bd_prodent";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}
?>