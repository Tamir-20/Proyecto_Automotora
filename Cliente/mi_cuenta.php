<?php
session_start();
include("../Comercial/config.php");

if (!isset($_SESSION['id_usuario'])) {
    die("Error: cliente no autenticado.");
}

$cliente_id = $_SESSION['id_usuario'];
$mensaje = "";

// Cargar datos del cliente
$sql = "SELECT nombre, apellido, email FROM usuarios WHERE id_usuario = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $cliente_id);
$stmt->execute();
$result = $stmt->get_result();
$usuario = $result->fetch_assoc();
$stmt->close();

// Procesar formulario de actualización
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if ($nombre && $apellido && $email) {
        if ($password) {
            $hashed = password_hash($password, PASSWORD_DEFAULT);
            $sql_update = "UPDATE usuarios SET nombre=?, apellido=?, email=?, contraseña=? WHERE id_usuario=?";
            $stmt = $conexion->prepare($sql_update);
            $stmt->bind_param("ssssi", $nombre, $apellido, $email, $hashed, $cliente_id);
        } else {
            $sql_update = "UPDATE usuarios SET nombre=?, apellido=?, email=? WHERE id_usuario=?";
            $stmt = $conexion->prepare($sql_update);
            $stmt->bind_param("sssi", $nombre, $apellido, $email, $cliente_id);
        }

        if ($stmt->execute()) {
            $mensaje = "✅ Datos actualizados correctamente.";
            $usuario['nombre'] = $nombre;
            $usuario['apellido'] = $apellido;
            $usuario['email'] = $email;
        } else {
            $mensaje = "❌ Error al actualizar: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $mensaje = "⚠️ Completa todos los campos obligatorios.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ignitus | Mi Cuenta</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>

<div id="wrapper">

    <!-- Header -->
    <header id="header">
        <h1><a href="index.php">IGNITUS</a></h1>
        <nav class="links">
            <ul>
                <li><a href="servicios.php">Servicios</a></li>
                <li><a href="catalogo.php">Catálogo</a></li>
                <li><a href="vehiculos.php">Vehículos</a></li>
                <li><a href="reservas.php">Reservas</a></li>
                <li><a href="promociones.php">Promociones</a></li>
                <li><a href="contacto.php">Contacto</a></li>
            </ul>
        </nav>
        <nav class="main">
            <ul>
                <li class="notifications"><a class="fa-bell" href="notificaciones.php">Notificaciones</a></li>
                <li class="search">
                    <a class="fa-search" href="#search">Buscar</a>
                    <form id="search" method="get" action="#">
                        <input type="text" name="query" placeholder="Buscar" />
                    </form>
                </li>
                <li class="menu"><a class="fa-bars" href="#menu">Menu</a></li>
            </ul>
        </nav>
    </header>

    <!-- Menu -->
    <section id="menu">
        <section>
            <form class="search" method="get" action="#">
                <input type="text" name="query" placeholder="Buscar" />
            </form>
        </section>

        <section>
            <ul class="links">
                <li><a href="index.php"><h3>Inicio</h3><p>Resumen de tu cuenta e información de tu vehículo</p></a></li>
                <li><a href="vehiculos.php"><h3>Mis Vehículos</h3><p>Consulta los datos, historial y próximos mantenimientos</p></a></li>
                <li><a href="reservas.php"><h3>Reservas</h3><p>Revisa, edita o agenda tus próximos turnos</p></a></li>
                <li><a href="servicios.php"><h3>Servicios</h3><p>Contrata nuevos servicios o paquetes para tu auto</p></a></li>
                <li><a href="catalogo.php"><h3>Catálogo</h3><p>Accesorios, repuestos y ofertas exclusivas</p></a></li>
                <li><a href="promociones.php"><h3>Promociones</h3><p>Ofertas personalizadas para tu vehículo</p></a></li>
                <li><a href="notificaciones.php"><h3>Notificaciones</h3><p>Avisos de servicio, recordatorios y novedades</p></a></li>
                <li><a href="mi_cuenta.php"><h3>Mi Cuenta</h3><p>Editar datos, métodos de pago y preferencias</p></a></li>
            </ul>
        </section>

        <section>
            <ul class="actions stacked">
                <li><a href="../Comercial/logout.php" class="button large fit">CERRAR SESIÓN</a></li>
            </ul>
        </section>
    </section>


    <!-- Main -->
    <div id="main">
        <section class="wrapper">
            <div class="inner">
                <h1 class="major">Mi Cuenta</h1>

                <?php if($mensaje): ?>
                    <p class="<?= strpos($mensaje, '✅') !== false ? 'ok' : 'error'; ?>"><?= $mensaje ?></p>
                <?php endif; ?>

                <form method="POST" class="formulario-cuenta">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" value="<?= htmlspecialchars($usuario['nombre']); ?>" required>

                    <label for="apellido">Apellido</label>
                    <input type="text" name="apellido" id="apellido" value="<?= htmlspecialchars($usuario['apellido']); ?>" required>

                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" value="<?= htmlspecialchars($usuario['email']); ?>" required>

                    <label for="password">Nueva Contraseña (opcional)</label>
                    <input type="password" name="password" id="password" placeholder="Deja vacío si no quieres cambiarla">

                    <button type="submit">Guardar Cambios</button>
                </form>

                <ul class="actions stacked">
                    <li><a href="../Comercial/logout.php" class="button large fit">CERRAR SESIÓN</a></li>
                </ul>
            </div>
        </section>
    </div>

    <!-- Footer -->
    <footer id="footer" class="wrapper alt">
        <div class="inner">
            <ul class="menu">
                <li>&copy; Ignitus. Todos los derechos reservados.</li>
                <li>Diseñado por Bitcore</li>
            </ul>
        </div>
    </footer>

</div>
<!-- Scripts -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/browser.min.js"></script>
<script src="assets/js/breakpoints.min.js"></script>
<script src="assets/js/util.js"></script>
<script src="assets/js/main.js"></script>
</body>
</html>
