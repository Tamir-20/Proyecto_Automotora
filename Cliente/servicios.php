<?php
session_start();

if (!isset($_SESSION['id_usuario'])) {
    die("Error: cliente no autenticado.");
}

include("../Comercial/config.php");

$id_cliente = $_SESSION['id_usuario'];
$mensaje = "";

$vehiculos = [];
$sql_vehiculos = "SELECT `vin`, `marca`, `modelo` FROM `vehiculos` WHERE `id_cliente` = ?";
$stmt = $conexion->prepare($sql_vehiculos);
$stmt->bind_param("i", $id_cliente);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $vehiculos[] = $row;
}
$stmt->close();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $vehiculo = trim($_POST["vehiculo"]);
    $servicio = trim($_POST["servicio"]);
    $fecha = trim($_POST["fecha"]);

    if ($vehiculo === "Otros") $vehiculo = trim($_POST["vehiculo_otro"]);
    if ($servicio === "Otros") $servicio = trim($_POST["servicio_otro"]);

    if ($vehiculo && $servicio && $fecha) {

        // Insertar en solicitudes_servicio
        $sql_insert = "INSERT INTO `solicitudes_servicio` (`id_cliente`, `vehiculo`, `servicio`, `fecha`) VALUES (?, ?, ?, ?)";
        $stmt = $conexion->prepare($sql_insert);
        if ($stmt) {
            $stmt->bind_param("isss", $id_cliente, $vehiculo, $servicio, $fecha);
            if ($stmt->execute()) {

                // Insertar automáticamente en reservas como pendiente
                $sql_reserva = "INSERT INTO `reservas` (`id_cliente`, `fecha_inicio`, `fecha_fin`, `servicio`, `estado`) VALUES (?, ?, ?, ?, 'Pendiente')";
                $stmt2 = $conexion->prepare($sql_reserva);
                if ($stmt2) {
                    // Asumimos que fecha_fin = fecha_inicio (puedes ajustarlo si quieres un rango)
                    $stmt2->bind_param("isss", $id_cliente, $fecha, $fecha, $servicio);
                    $stmt2->execute();
                    $stmt2->close();
                }

                $mensaje = "✅ Solicitud enviada correctamente y agregada a tus reservas.";
            } else {
                $mensaje = "❌ Error al guardar la solicitud: " . $stmt->error;
            }
            $stmt->close();
        } else {
            $mensaje = "❌ Error en la preparación de la consulta: " . $conexion->error;
        }
    } else {
        $mensaje = "⚠️ Debes completar todos los campos.";
    }
}
?>
<!DOCTYPE HTML>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <title>Ignitus | Solicitud de Servicios</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="assets/css/main.css" />
</head>
<body class="is-preload">

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


<div id="wrapper">
    <section id="main" class="wrapper">
        <div class="inner">
            <h1 class="major">Solicitar un Servicio</h1>

            <?php if ($mensaje): ?>
                <p class="mensaje <?php echo strpos($mensaje, '✅') !== false ? 'ok' : 'error'; ?>">
                    <?php echo $mensaje; ?>
                </p>
            <?php endif; ?>

            <form method="POST" class="formulario-servicio">
                <label for="vehiculo">Seleccionar Vehículo</label>
                <select name="vehiculo" id="vehiculo" required>
                    <option value="" disabled selected>Selecciona un vehículo</option>
                    <?php foreach ($vehiculos as $v): ?>
                        <option value="<?php echo htmlspecialchars($v['vin']); ?>">
                            <?php echo htmlspecialchars($v['marca'] . " " . $v['modelo']); ?>
                        </option>
                    <?php endforeach; ?>
                    <option value="Otros">Otros</option>
                </select>
                <input type="text" name="vehiculo_otro" id="vehiculo_otro" class="campo-oculto" placeholder="Ingresa los datos del vehículo" />

                <label for="servicio">Tipo de Servicio</label>
                <select name="servicio" id="servicio" required>
                    <option value="" disabled selected>Selecciona un servicio</option>
                    <option value="Cambio de aceite">Cambio de aceite</option>
                    <option value="Alineación y balanceo">Alineación y balanceo</option>
                    <option value="Revisión general">Revisión general</option>
                    <option value="Otros">Otros</option>
                </select>
                <input type="text" name="servicio_otro" id="servicio_otro" class="campo-oculto" placeholder="Describe el servicio solicitado" />

                <label for="fecha">Fecha Deseada</label>
                <input type="date" name="fecha" id="fecha" required>

                <button type="submit">Enviar Solicitud</button>
            </form>
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
<!-- Scripts -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/browser.min.js"></script>
<script src="assets/js/breakpoints.min.js"></script>
<script src="assets/js/util.js"></script>
<script src="assets/js/main.js"></script>
<script>
    const vehiculoSelect = document.getElementById("vehiculo");
    const vehiculoOtro = document.getElementById("vehiculo_otro");
    const servicioSelect = document.getElementById("servicio");
    const servicioOtro = document.getElementById("servicio_otro");

    vehiculoSelect.addEventListener("change", () => {
        vehiculoOtro.style.display = vehiculoSelect.value === "Otros" ? "block" : "none";
        vehiculoOtro.required = vehiculoSelect.value === "Otros";
    });

    servicioSelect.addEventListener("change", () => {
        servicioOtro.style.display = servicioSelect.value === "Otros" ? "block" : "none";
        servicioOtro.required = servicioSelect.value === "Otros";
    });
</script>

</body>
</html>
