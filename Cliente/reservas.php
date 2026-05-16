<?php
include("../Comercial/session_check.php");
include("../Comercial/config.php"); // Conexión DB

$cliente_id = $_SESSION['id_usuario'];

// Traer reservas del cliente
$stmt = $conexion->prepare("SELECT id_reserva, fecha_inicio, fecha_fin, servicio, estado FROM reservas WHERE id_cliente=? ORDER BY fecha_inicio ASC");
$stmt->bind_param("i", $cliente_id);
$stmt->execute();
$result = $stmt->get_result();

$reservas = [];
while($row = $result->fetch_assoc()){
    $reservas[] = $row;
}
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Ignitus - Reservas</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/main.min.css' rel='stylesheet' />
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
    <style>
        .reservations-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        #calendar {
            flex: 2;
            min-width: 300px;
        }
        #upcoming-reservations {
            flex: 1;
            min-width: 200px;
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
        }
        #upcoming-reservations ul {
            list-style: none;
            padding-left: 0;
        }
        #upcoming-reservations li {
            margin-bottom: 10px;
        }
    </style>
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


    <!-- Main -->
    <section id="main">
        <div class="reservations-container">
            <div id="calendar"></div>
            <div id="upcoming-reservations">
                <h3>Próximas Reservas</h3>
                <ul id="upcoming-list">
                    <?php foreach($reservas as $r): ?>
                        <li><?php echo date("d/m/Y", strtotime($r['fecha_inicio'])) . " - " . htmlspecialchars($r['servicio']) . " (" . $r['estado'] . ")"; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer id="footer" class="wrapper style1-alt">
        <div class="inner">
            <ul class="menu">
                <li>&copy; Ignitus. Todos los derechos reservados.</li>
                <li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth', // Solo vista de mes
        locale: 'es',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: '' // Se eliminan botones de vista semana/día
        },
        events: [
            <?php foreach($reservas as $r): ?>
            {
                title: '<?php echo addslashes($r['servicio']); ?>',
                start: '<?php echo $r['fecha_inicio']; ?>',
                end: '<?php echo $r['fecha_fin']; ?>',
                color: '<?php echo $r['estado'] == "Pendiente" ? "orange" : "green"; ?>'
            },
            <?php endforeach; ?>
        ]
    });
    calendar.render();
});
</script>


</body>
</html>
