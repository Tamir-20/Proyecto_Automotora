<?php
session_start();

// Destruir todas las variables de sesión
session_unset();
session_destroy();

// Evitar que la página se guarde en caché
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// Redirigir al login
header("Location: login.php");
exit;
?>
