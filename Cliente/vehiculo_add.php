<?php
include("../Comercial/session_check.php");
include("../Comercial/config.php"); // Conexión a la DB

$cliente_id = $_SESSION['id_usuario'];
$mensaje = "";

// Verificar si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $marca = $_POST['marca'] ?? '';
    $modelo = $_POST['modelo'] ?? '';
    $anio = $_POST['anio'] ?? '';
    $placa = $_POST['placa'] ?? '';
    $vin = $_POST['vin'] ?? '';
    $potencia_motor = $_POST['potencia_motor'] ?? '';
    $tipo_combustible = $_POST['tipo_combustible'] ?? '';
    $transmision = $_POST['transmision'] ?? '';
    $color = $_POST['color'] ?? '';
    $kilometraje = $_POST['kilometraje'] ?? '';
    $garantia = $_POST['garantia'] ?? '';

    // Manejo de imagen
    $imagen = '';
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $ruta_destino = 'images/';
        if (!is_dir($ruta_destino)) {
            mkdir($ruta_destino, 0777, true);
        }
        $imagen = time() . "_" . basename($_FILES['imagen']['name']);
        move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta_destino . $imagen);
    }

    // Preparar y ejecutar INSERT
    $stmt = $conexion->prepare("INSERT INTO vehiculos 
        (id_cliente, marca, modelo, `año`, placa, vin, potencia_motor, tipo_combustible, transmision, color, kilometraje, garantia, imagen)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    if(!$stmt) {
        die("Error en la preparación de la consulta: " . $conexion->error);
    }

    // i = int, s = string
    $stmt->bind_param(
        "ississssssiss",
        $cliente_id,
        $marca,
        $modelo,
        $anio,
        $placa,
        $vin,
        $potencia_motor,
        $tipo_combustible,
        $transmision,
        $color,
        $kilometraje,
        $garantia,
        $imagen
    );

    if ($stmt->execute()) {
        $mensaje = "Vehículo agregado correctamente.";
    } else {
        $mensaje = "Error al agregar vehículo: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Agregar Vehículo - Ignitus</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="assets/css/main.css" />
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
    <section class="form-section">
        <h2>Agregar Nuevo Vehículo</h2>
        <?php if($mensaje) echo "<p>$mensaje</p>"; ?>
        <form method="post" enctype="multipart/form-data">
            <label>Marca:</label>
            <input type="text" name="marca" required>
            <label>Modelo:</label>
            <input type="text" name="modelo" required>
            <label>Año:</label>
            <input type="number" name="anio" required>
            <label>Placa:</label>
            <input type="text" name="placa" required>
            <label>VIN:</label>
            <input type="text" name="vin" required>
            <label>Potencia del motor:</label>
            <input type="text" name="potencia_motor">
            <label>Tipo de combustible:</label>
            <input type="text" name="tipo_combustible">
            <label>Transmisión:</label>
            <input type="text" name="transmision">
            <label>Color:</label>
            <input type="text" name="color">
            <label>Kilometraje:</label>
            <input type="number" name="kilometraje">
            <label>Garantía:</label>
            <input type="text" name="garantia">
            <label>Imagen del vehículo:</label>
            <input type="file" name="imagen" accept="image/*">
            <br><br>
            <button type="submit">Agregar Vehículo</button>
        </form>
    </section>
</div>

<footer id="footer">
    <div class="inner">
        <ul class="menu">
            <li>&copy; Ignitus. Todos los derechos reservados.</li>
        </ul>
    </div>
</footer>

</div>
</body>
</html>
