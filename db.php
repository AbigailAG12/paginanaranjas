<?php
// db.php

// Datos de la conexión a la base de datos
$servername = "localhost";
$username = "abigail";
$password = "].pdT4G_s]wmOhLa";
$dbname = "proyect";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
