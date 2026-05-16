<?php
include("../Comercial/session_check.php");
include("../Comercial/config.php"); // conexión a la base de datos

// Verificar que se pasó el VIN
if (!isset($_GET['vin']) || empty($_GET['vin'])) {
    die("Error: VIN de vehículo no proporcionado.");
}

$vin = $_GET['vin'];
$id_cliente = $_SESSION['id_usuario'];

// Primero verificamos que el vehículo realmente pertenece a este cliente
$check = $conexion->prepare("SELECT * FROM vehiculos WHERE vin = ? AND id_cliente = ?");
if (!$check) {
    die("Error en la preparación de la consulta: " . $conexion->error);
}
$check->bind_param("si", $vin, $id_cliente);
$check->execute();
$result = $check->get_result();

if ($result->num_rows === 0) {
    die("Error: No se encontró el vehículo o no pertenece a este cliente.");
}

// Si pertenece al cliente, eliminarlo
$stmt = $conexion->prepare("DELETE FROM vehiculos WHERE vin = ? AND id_cliente = ?");
if (!$stmt) {
    die("Error en la preparación de la consulta: " . $conexion->error);
}
$stmt->bind_param("si", $vin, $id_cliente);

if ($stmt->execute()) {
    header("Location: vehiculos.php?msg=Vehículo eliminado correctamente");
    exit();
} else {
    echo "Error al eliminar el vehículo: " . $stmt->error;
}

$stmt->close();
$conexion->close();
?>
