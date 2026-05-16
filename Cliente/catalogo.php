<?php
include("../Comercial/session_check.php");
include("../Comercial/config.php");

// --- Obtener categoría seleccionada ---
$categoria = isset($_GET['categoria']) ? $_GET['categoria'] : 'all';

// --- Consulta dinámica ---
$sql = "SELECT * FROM promociones WHERE activo = 1"; // solo promociones activas
if ($categoria !== 'all') {
    $sql .= " AND tipo = '" . $conexion->real_escape_string($categoria) . "'";
}

// --- Función para ejecutar consultas seguras ---
function safeQuery($conexion, $sql) {
    $resultado = $conexion->query($sql);
    if (!$resultado) {
        die("Error en la consulta SQL: " . $conexion->error);
    }
    return $resultado;
}

// --- Ejecutar consulta ---
$resultado = safeQuery($conexion, $sql);
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Catálogo | Ignitus</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="assets/css/main.css" />
</head>
<body class="single is-preload">

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

    <!-- Contenido principal -->
    <div id="main">

        <!-- Filtro -->
        <section class="filter">
            <header>
                <h3>Filtro de Catálogo</h3>
            </header>
            <form method="get" action="catalogo.php">
                <select name="categoria" class="filter-select" onchange="this.form.submit()">
                    <option value="all" <?= $categoria === 'all' ? 'selected' : '' ?>>Todos</option>
                    <option value="small" <?= $categoria === 'small' ? 'selected' : '' ?>>Small</option>
                    <option value="large" <?= $categoria === 'large' ? 'selected' : '' ?>>Large</option>
                </select>
            </form>
        </section>

        <!-- Catálogo dinámico -->
        <section class="catalog">
            <header>
                <h2>Catálogo de Promociones</h2>
                <p>Descubre nuestras promociones disponibles.</p>
            </header>
            <div class="row gtr-uniform">
                <?php if ($resultado && $resultado->num_rows > 0): ?>
                    <?php while ($p = $resultado->fetch_assoc()): ?>
                        <article class="col-4 col-6-medium col-12-small item <?= htmlspecialchars($p['tipo']) ?>">
                            <a href="#" class="image"><img src="images/<?= htmlspecialchars($p['imagen']) ?>" alt="<?= htmlspecialchars($p['titulo']) ?>" /></a>
                            <h3><?= htmlspecialchars($p['titulo']) ?></h3>
                            <p><?= htmlspecialchars($p['descripcion']) ?></p>
                        </article>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p style="text-align:center; width:100%;">No hay promociones disponibles en esta categoría.</p>
                <?php endif; ?>
            </div>
        </section>

    </div>
</div>

<!-- Scripts -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/browser.min.js"></script>
<script src="assets/js/breakpoints.min.js"></script>
<script src="assets/js/util.js"></script>
<script src="assets/js/main.js"></script>
</body>
</html>
