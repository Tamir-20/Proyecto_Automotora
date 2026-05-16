<?php
$conexion = new mysqli("localhost", "root", "", "ignitus_db", 3306);

// Verificar si hay errores en la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Establecer codificación
$conexion->set_charset("utf8");
?>
