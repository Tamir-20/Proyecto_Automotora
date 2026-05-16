<?php
include("../Comercial/session_check.php");
include("../Comercial/config.php");

// Traer promociones activas
$query = "SELECT * FROM promociones WHERE activo = 1 ORDER BY fecha_creacion ASC";
$result = $conexion->query($query);

// Convertir resultados a array
$promociones = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $promociones[] = $row;
    }
}

// Dividir promociones en slides de 3
$slides = array_chunk($promociones, 3);
?>
<!DOCTYPE HTML>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <title>Ignitus | Promociones</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <link rel="stylesheet" href="assets/css/promociones.css" />
</head>
<body class="is-preload">

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


    <div id="main">
        <section id="promotions" class="promotions-section">
            <div class="inner">
                <header class="major">
                    <h2>Promociones Especiales</h2>
                </header>

                <?php if (!empty($slides)): ?>
                    <div class="promotions-carousel">
                        <div class="carousel-container">
                            <?php foreach ($slides as $i => $slide): ?>
                                <div class="slide <?= $i === 0 ? 'active' : '' ?>">
                                    <div class="promotion-grid">
                                        <?php foreach ($slide as $promo): ?>
                                            <div class="promotion <?= htmlspecialchars($promo['tipo']) ?>">
                                                <div class="image">
                                                    <img src="<?= htmlspecialchars($promo['imagen']) ?>" alt="<?= htmlspecialchars($promo['titulo']) ?>" />
                                                </div>
                                                <div class="content">
                                                    <h3><?= htmlspecialchars($promo['titulo']) ?></h3>
                                                    <p><?= htmlspecialchars($promo['descripcion']) ?></p>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <div class="promotion-dots">
                            <?php foreach ($slides as $i => $slide): ?>
                                <span class="dot <?= $i === 0 ? 'active' : '' ?>" data-slide="<?= $i ?>"></span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php else: ?>
                    <p>No hay promociones disponibles.</p>
                <?php endif; ?>
            </div>
        </section>
    </div>

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
<script src="assets/js/main.js"></script>
<script src="assets/js/promociones.js"></script>
</body>
</html>
