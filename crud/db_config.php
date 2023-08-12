<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_prodentii";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}
?>
