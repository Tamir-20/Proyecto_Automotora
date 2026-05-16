<?php
include("../Comercial/session_check.php");
include("../Comercial/config.php"); // Conexión a la DB

$empleado_id = $_SESSION['id_usuario'];

// Función segura para consultas
function safeQuery($conexion, $sql, $params = [], $types = "") {
    if (empty($params)) {
        $resultado = $conexion->query($sql);
        return $resultado ? $resultado : [];
    } else {
        $stmt = $conexion->prepare($sql);
        if ($stmt && !empty($params)) {
            $stmt->bind_param($types, ...$params);
            $stmt->execute();
            return $stmt->get_result();
        }
        return [];
    }
}

// Vehículos asignados al empleado
$vehiculos = safeQuery($conexion, "
    SELECT v.*, c.nombre AS cliente_nombre
    FROM vehiculos v
    JOIN clientes c ON v.id_cliente = c.id_cliente
");

// Reservas asignadas al empleado (Pendiente o En Proceso)
$reservas = safeQuery($conexion, "
    SELECT r.*, v.marca, v.modelo, c.nombre AS cliente_nombre
    FROM reservas r
    JOIN vehiculos v ON r.id_vehiculo = v.id_vehiculo
    JOIN clientes c ON v.id_cliente = c.id_cliente
    WHERE r.id_empleado = ? AND r.estado IN ('Pendiente','En Proceso')
    ORDER BY r.fecha_inicio ASC
", [$empleado_id], "i");

// Notificaciones del empleado
$notificaciones = safeQuery($conexion, "
    SELECT * FROM notificaciones_empleado WHERE id_empleado = ? ORDER BY fecha DESC
", [$empleado_id], "i");
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Ignitus - Empleado</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <style>
        /* ---- Carrusel de servicios ---- */
        .promotion-carousel {
            position: relative;
            background: transparent;
            border-radius: 15px;
            padding: 0 15px 15px 15px;
        }
        .carousel-posts .mini-post {
            display: none;
            transition: opacity 0.5s ease-in-out;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            padding: 15px;
        }
        .carousel-posts .mini-post.active {
            display: block;
        }
        .carousel-arrow {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            font-size: 2rem;
            cursor: pointer;
            user-select: none;
            color: #333;
            padding: 5px;
        }
        .carousel-arrow.left { left: 10px; }
        .carousel-arrow.right { right: 10px; }
        .promotion-dots {
            text-align: center;
            margin-top: 10px;
        }
        .promotion-dots .dot {
            height: 12px;
            width: 12px;
            margin: 0 4px;
            display: inline-block;
            background-color: transparent;
            border: 2px solid #ccc;
            border-radius: 50%;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .promotion-dots .dot.active {
            background-color: #ff6b35;
            border-color: #ff6b35;
            box-shadow: 0 0 8px rgba(255, 107, 53, 0.6);
        }
    </style>
</head>
<body class="is-preload">

<div id="wrapper">

    <!-- Header -->
    <header id="header">
        <h1><a href="index.php">IGNITUS - Empleado</a></h1>
        <nav class="links">
            <ul>
                <li><a href="vehiculos.php">Vehículos</a></li>
                <li><a href="reservas.php">Reservas</a></li>
                <li><a href="servicios.php">Servicios</a></li>
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
                <li><a href="index.php"><h3>Inicio</h3><p>Resumen de tareas y reservas asignadas</p></a></li>
                <li><a href="vehiculos.php"><h3>Vehículos Asignados</h3><p>Consulta y gestiona vehículos de los clientes</p></a></li>
                <li><a href="reservas.php"><h3>Reservas</h3><p>Ver y gestionar reservas asignadas</p></a></li>
                <li><a href="servicios.php"><h3>Servicios</h3><p>Agregar o actualizar servicios</p></a></li>
                <li><a href="notificaciones.php"><h3>Notificaciones</h3><p>Avisos internos y novedades</p></a></li>
            </ul>
        </section>

        <section>
            <ul class="actions stacked">
                <li><a href="../Comercial/logout.php" class="button large fit">CERRAR SESIÓN</a></li>
            </ul>
        </section>
    </section>

    <!-- Leftbar: Servicios en curso -->
    <section id="leftbar">
        <h2>⚙️ Servicios en Curso</h2>
        <div class="promotion-carousel">
            <div class="carousel-arrow left" onclick="changeService(-1)">‹</div>
            <div class="carousel-arrow right" onclick="changeService(1)">›</div>
            <div class="carousel-posts">
                <?php
                $index = 0;
                if (!empty($reservas) && $reservas->num_rows > 0):
                    while ($s = $reservas->fetch_assoc()):
                        $index++;

                        // ✅ Manejar fechas nulas o vacías
                        $fechaInicio = !empty($s['fecha_inicio']) ? date("d/m/Y H:i", strtotime($s['fecha_inicio'])) : "Sin definir";
                        $fechaFin = !empty($s['fecha_fin']) ? date("d/m/Y H:i", strtotime($s['fecha_fin'])) : "Sin definir";
                ?>
                    <article class="mini-post <?php echo $index === 1 ? 'active' : ''; ?>">
                        <header>
                            <h3><?php echo htmlspecialchars($s['servicio']); ?></h3>
                            <p>
                                Cliente: <?php echo htmlspecialchars($s['cliente_nombre']); ?><br>
                                Vehículo: <?php echo htmlspecialchars($s['marca'] . " " . $s['modelo']); ?><br>
                                Fecha: <?php echo $fechaInicio; ?> - <?php echo $fechaFin; ?><br>
                                Estado: <strong><?php echo htmlspecialchars($s['estado']); ?></strong>
                            </p>
                        </header>
                    </article>
                <?php
                    endwhile;
                else:
                    echo "<p>No hay servicios en curso.</p>";
                endif;
                ?>
            </div>
            <div class="promotion-dots">
                <?php for ($i = 1; $i <= $index; $i++): ?>
                    <span class="dot <?php echo $i === 1 ? 'active' : ''; ?>" onclick="currentService(<?php echo $i; ?>)"></span>
                <?php endfor; ?>
            </div>
        </div>
    </section>

    <!-- Main -->
    <div id="main">
        <section class="vehicle-section">
            <h2>Vehículos Asignados</h2>
            <?php
            if (!empty($vehiculos) && $vehiculos->num_rows > 0):
                while ($v = $vehiculos->fetch_assoc()):
            ?>
                <div class="vehicle-description">
                    <h3><?php echo htmlspecialchars($v['marca'] . " " . $v['modelo'] . " " . $v['año']); ?></h3>
                    <ul>
                        <li><strong>Cliente:</strong> <?php echo htmlspecialchars($v['cliente_nombre']); ?></li>
                        <li><strong>Placa:</strong> <?php echo htmlspecialchars($v['placa']); ?></li>
                        <li><strong>VIN:</strong> <?php echo htmlspecialchars($v['vin']); ?></li>
                        <li><strong>Kilometraje:</strong> <?php echo htmlspecialchars($v['kilometraje']); ?> km</li>
                        <li><strong>Garantía:</strong> <?php echo htmlspecialchars($v['garantia']); ?></li>
                    </ul>
                </div>
            <?php
                endwhile;
            else:
                echo "<p>No hay vehículos asignados.</p>";
            endif;
            ?>
        </section>
    </div>

    <!-- Rightbar -->
    <section id="rightbar">
        <section class="client-panel">
            <article class="client-section" id="notificaciones">
                <h3>🔔 Notificaciones</h3>
                <ul>
                    <?php
                    if (!empty($notificaciones) && $notificaciones->num_rows > 0):
                        while ($n = $notificaciones->fetch_assoc()):
                            echo "<li>" . date("d/m/Y", strtotime($n['fecha'])) . " - " . htmlspecialchars($n['mensaje']) . "</li>";
                        endwhile;
                    else:
                        echo "<li>No hay notificaciones.</li>";
                    endif;
                    ?>
                </ul>
            </article>
        </section>
    </section>
</div>

<footer id="footer" class="wrapper style1-alt">
    <div class="inner">
        <ul class="menu">
            <li>&copy; Ignitus. Todos los derechos reservados.</li>
            <li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
        </ul>
    </div>
</footer>

<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/browser.min.js"></script>
<script src="assets/js/breakpoints.min.js"></script>
<script src="assets/js/util.js"></script>
<script src="assets/js/main.js"></script>

<script>
let currentServiceIndex = 1;
const totalServices = document.querySelectorAll('.carousel-posts .mini-post').length;

function showService(n) {
    const posts = document.querySelectorAll('.carousel-posts .mini-post');
    const dots = document.querySelectorAll('.promotion-dots .dot');
    if (posts.length === 0) return;

    posts.forEach(p => p.classList.remove('active'));
    dots.forEach(d => d.classList.remove('active'));

    currentServiceIndex = (n + totalServices - 1) % totalServices + 1;

    posts[currentServiceIndex - 1].classList.add('active');
    dots[currentServiceIndex - 1].classList.add('active');
}

function changeService(dir) { showService(currentServiceIndex + dir); }
function currentService(i) { showService(i); }

setInterval(() => { changeService(1); }, 5000);
</script>

</body>
</html>
