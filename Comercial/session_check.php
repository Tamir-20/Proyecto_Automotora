<?php
session_start();

// Evitar que el navegador almacene la página en caché
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// Si no hay usuario logueado, redirigir al login
if (!isset($_SESSION['id_usuario']) || !isset($_SESSION['rol'])) {
    header("Location: ../Comercial/login.php");
    exit;
}

// Validación por rol según el directorio actual
$ruta_actual = basename(dirname($_SERVER['PHP_SELF'])); // Detecta si estás en Cliente, Empleado o Admin

switch ($ruta_actual) {
    case 'Cliente':
        if ($_SESSION['rol'] !== 'cliente') {
            redirigirSegunRol($_SESSION['rol']);
        }
        break;

    case 'Empleado':
        if ($_SESSION['rol'] !== 'empleado' && $_SESSION['rol'] !== 'admin') {
            redirigirSegunRol($_SESSION['rol']);
        }
        break;

    case 'Admin':
        if ($_SESSION['rol'] !== 'admin') {
            redirigirSegunRol($_SESSION['rol']);
        }
        break;
}

// --- Función para redirigir según el rol ---
function redirigirSegunRol($rol)
{
    switch ($rol) {
        case 'cliente':
            header("Location: ../Cliente/index.php");
            break;
        case 'empleado':
            header("Location: ../Empleado/index.php");
            break;
        case 'admin':
            header("Location: ../Admin/index.php");
            break;
        default:
            header("Location: ../Comercial/login.php");
            break;
    }
    exit;
}
?>
