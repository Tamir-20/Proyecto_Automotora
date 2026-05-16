<?php
include("../Comercial/session_check.php");
include("../Comercial/config.php"); // Conexión a la DB

$cliente_id = $_SESSION['id_usuario'];

// Función para ejecutar consulta segura
function safeQuery($conexion, $sql) {
    $resultado = $conexion->query($sql);
    if (!$resultado) {
        die("Error en la consulta SQL: " . $conexion->error);
    }
    return $resultado;
}

// Vehículos del cliente
$vehiculos = safeQuery($conexion, "SELECT * FROM vehiculos WHERE id_cliente = $cliente_id");

// Reservas pendientes del cliente
$reservas = safeQuery($conexion, "
    SELECT *
    FROM reservas
    WHERE id_cliente = $cliente_id AND estado = 'Pendiente'
    ORDER BY fecha_inicio ASC
");

// Notificaciones del cliente
$notificaciones = safeQuery($conexion, "SELECT * FROM notificaciones WHERE id_cliente = $cliente_id ORDER BY fecha DESC");

// Promociones activas
$promociones = safeQuery($conexion, "SELECT * FROM promociones ORDER BY fecha_creacion DESC");
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Ignitus</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <style>
        /* ---- Carrusel de promociones ---- */
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

    <!-- Leftbar: Promociones -->
    <section id="leftbar">
        <h2>🔥 Promociones</h2>
        <div class="promotion-carousel">
            <div class="carousel-arrow left" onclick="changePromotion(-1)">‹</div>
            <div class="carousel-arrow right" onclick="changePromotion(1)">›</div>
            <div class="carousel-posts">
                <?php
                $index = 0;
                if ($promociones->num_rows > 0):
                    while ($p = $promociones->fetch_assoc()):
                        $index++;
                ?>
                    <article class="mini-post <?php echo $index === 1 ? 'active' : ''; ?>">
                        <header>
                            <h3><?php echo htmlspecialchars($p['titulo']); ?></h3>
                            <p><?php echo htmlspecialchars($p['descripcion']); ?></p>
                            <small>
                                Publicado el <?php echo date("d/m/Y", strtotime($p['fecha_creacion'])); ?>
                            </small>
                        </header>
                    </article>
                <?php
                    endwhile;
                else:
                    echo "<p>No hay promociones disponibles.</p>";
                endif;
                ?>
            </div>
            <div class="promotion-dots">
                <?php for ($i = 1; $i <= $index; $i++): ?>
                    <span class="dot <?php echo $i === 1 ? 'active' : ''; ?>" onclick="currentPromotion(<?php echo $i; ?>)"></span>
                <?php endfor; ?>
            </div>
        </div>
    </section>

    <!-- Main -->
    <div id="main">
        <section class="vehicle-section">
            <h2>Mis Vehículos</h2>
            <?php
            if ($vehiculos->num_rows > 0):
                while ($v = $vehiculos->fetch_assoc()):
            ?>
                <div class="vehicle-description">
                    <h3><?php echo htmlspecialchars($v['marca'] . " " . $v['modelo'] . " " . $v['año']); ?></h3>
                    <ul>
                        <li><strong>Matrícula:</strong> <?php echo htmlspecialchars($v['placa']); ?></li>
                        <li><strong>VIN:</strong> <?php echo htmlspecialchars($v['vin']); ?></li>
                        <li><strong>Kilometraje:</strong> <?php echo htmlspecialchars($v['kilometraje']); ?> km</li>
                        <li><strong>Garantía:</strong> <?php echo htmlspecialchars($v['garantia']); ?></li>
                    </ul>
                </div>
            <?php
                endwhile;
            else:
                echo "<p>No tienes vehículos registrados.</p>";
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
                    if ($notificaciones->num_rows > 0):
                        while ($n = $notificaciones->fetch_assoc()):
                            echo "<li>" . date("d/m/Y", strtotime($n['fecha'])) . " - " . htmlspecialchars($n['mensaje']) . "</li>";
                        endwhile;
                    else:
                        echo "<li>No hay notificaciones.</li>";
                    endif;
                    ?>
                </ul>
            </article>
            <article class="client-section" id="reservas">
                <h3>📅 Reservas Pendientes</h3>
                <ul>
                    <?php
                    if ($reservas->num_rows > 0):
                        while ($r = $reservas->fetch_assoc()):
                            echo "<li><strong>" . htmlspecialchars($r['servicio']) . ":</strong> "
                                 . date("d/m/Y", strtotime($r['fecha_inicio'])) 
                                 . " a " . date("d/m/Y", strtotime($r['fecha_fin']))
                                 . " (" . htmlspecialchars($r['estado']) . ")</li>";
                        endwhile;
                    else:
                        echo "<li>No hay reservas pendientes.</li>";
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
let currentPromotionIndex = 1;
const totalPromotions = document.querySelectorAll('.carousel-posts .mini-post').length;

function showPromotion(n) {
    const posts = document.querySelectorAll('.carousel-posts .mini-post');
    const dots = document.querySelectorAll('.promotion-dots .dot');

    posts.forEach(post => post.classList.remove('active'));
    dots.forEach(dot => dot.classList.remove('active'));

    currentPromotionIndex = (n + totalPromotions - 1) % totalPromotions + 1;
    posts[currentPromotionIndex - 1].classList.add('active');
    dots[currentPromotionIndex - 1].classList.add('active');
}

function changePromotion(direction) {
    showPromotion(currentPromotionIndex + direction);
}

function currentPromotion(index) {
    showPromotion(index);
}

setInterval(() => {
    changePromotion(1);
}, 5000);
</script>

</body>
</html>
