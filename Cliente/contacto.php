<?php
session_start();
include("../Comercial/config.php");

if (!isset($_SESSION['id_usuario'])) {
    die("Error: cliente no autenticado.");
}

$cliente_id = $_SESSION['id_usuario'];
$mensaje = "";

// Procesar formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre']);
    $email = trim($_POST['email']);
    $contenido = trim($_POST['mensaje']);

    if ($nombre && $email && $contenido) {
        $sql = "INSERT INTO contactos (id_cliente, nombre, email, mensaje) VALUES (?, ?, ?, ?)";
        $stmt = $conexion->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("isss", $cliente_id, $nombre, $email, $contenido);
            if ($stmt->execute()) {
                $mensaje = "✅ Mensaje enviado correctamente.";
            } else {
                $mensaje = "❌ Error al enviar el mensaje: " . $stmt->error;
            }
            $stmt->close();
        } else {
            $mensaje = "❌ Error en la consulta: " . $conexion->error;
        }
    } else {
        $mensaje = "⚠️ Completa todos los campos.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ignitus | Contacto</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="assets/css/main.css" />
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
                <h1 class="major">Contáctanos</h1>

                <?php if($mensaje): ?>
                    <p class="<?= strpos($mensaje, '✅') !== false ? 'ok' : 'error'; ?>"><?= $mensaje ?></p>
                <?php endif; ?>

                <form method="POST" class="formulario-contacto">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" required>

                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" required>

                    <label for="mensaje">Mensaje</label>
                    <textarea name="mensaje" id="mensaje" rows="5" required></textarea>

                    <button type="submit">Enviar Mensaje</button>
                </form>

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
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/browser.min.js"></script>
<script src="assets/js/breakpoints.min.js"></script>
<script src="assets/js/util.js"></script>
<script src="assets/js/main.js"></script>


</body>
</html>
