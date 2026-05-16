<?php
include("../Comercial/session_check.php");
include("../Comercial/config.php"); // conexión a la base de datos

// Verificar que se pasó el VIN
if (!isset($_GET['vin']) || empty($_GET['vin'])) {
    die("Error: VIN de vehículo no proporcionado.");
}

$vin = $_GET['vin'];
$id_cliente = $_SESSION['id_usuario'];

// Obtener datos del vehículo actual
$query = $conexion->prepare("SELECT * FROM vehiculos WHERE vin = ? AND id_cliente = ?");
if (!$query) {
    die("Error en la preparación de la consulta: " . $conexion->error);
}
$query->bind_param("si", $vin, $id_cliente);
$query->execute();
$result = $query->get_result();

if ($result->num_rows === 0) {
    die("Error: No se encontró el vehículo o no pertenece a este cliente.");
}

$vehiculo = $result->fetch_assoc();
$mensaje = "";

// Si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $año = $_POST['año'];
    $placa = $_POST['placa'];
    $potencia_motor = $_POST['potencia_motor'];
    $tipo_combustible = $_POST['tipo_combustible'];
    $transmision = $_POST['transmision'];
    $color = $_POST['color'];
    $kilometraje = $_POST['kilometraje'];
    $garantia = $_POST['garantia'];

    // Manejar imagen
    $imagen_nombre = $vehiculo['imagen']; // mantener imagen actual si no se sube otra
    if(isset($_FILES['imagen']) && $_FILES['imagen']['error'] === 0){
        $ext = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
        $imagen_nombre = $vin . '.' . $ext;

        // Crear la carpeta uploads si no existe
        $upload_dir = "../uploads/";
        if(!is_dir($upload_dir)){
            mkdir($upload_dir, 0777, true);
        }

        if(!move_uploaded_file($_FILES['imagen']['tmp_name'], $upload_dir . $imagen_nombre)){
            $mensaje = "❌ Error al subir la imagen";
        }
    }

    // Actualizar datos del vehículo
    $stmt = $conexion->prepare("UPDATE vehiculos SET marca = ?, modelo = ?, año = ?, placa = ?, potencia_motor = ?, tipo_combustible = ?, transmision = ?, color = ?, kilometraje = ?, garantia = ?, imagen = ? WHERE vin = ? AND id_cliente = ?");
    if (!$stmt) {
        die("Error en la preparación de la consulta: " . $conexion->error);
    }

    $stmt->bind_param("ssisssssssssi", $marca, $modelo, $año, $placa, $potencia_motor, $tipo_combustible, $transmision, $color, $kilometraje, $garantia, $imagen_nombre, $vin, $id_cliente);

    if ($stmt->execute()) {
        header("Location: vehiculos.php?msg=Vehículo actualizado correctamente");
        exit();
    } else {
        $mensaje = "❌ Error al actualizar el vehículo: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Editar Vehículo - Ignitus</title>
    <meta charset="utf-8" />
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
        <section>
            <h2>Editar Vehículo</h2>

            <?php if($mensaje): ?>
                <p class="<?= strpos($mensaje, '✅') !== false ? 'ok' : 'error'; ?>"><?= $mensaje ?></p>
            <?php endif; ?>

            <form method="post" enctype="multipart/form-data">
                <label>Marca:</label>
                <input type="text" name="marca" value="<?php echo htmlspecialchars($vehiculo['marca']); ?>" required>

                <label>Modelo:</label>
                <input type="text" name="modelo" value="<?php echo htmlspecialchars($vehiculo['modelo']); ?>" required>

                <label>Año:</label>
                <input type="number" name="año" value="<?php echo htmlspecialchars($vehiculo['año']); ?>" required>

                <label>Placa:</label>
                <input type="text" name="placa" value="<?php echo htmlspecialchars($vehiculo['placa']); ?>" required>

                <label>Potencia del motor:</label>
                <input type="text" name="potencia_motor" value="<?php echo htmlspecialchars($vehiculo['potencia_motor']); ?>">

                <label>Tipo de combustible:</label>
                <input type="text" name="tipo_combustible" value="<?php echo htmlspecialchars($vehiculo['tipo_combustible']); ?>">

                <label>Transmisión:</label>
                <input type="text" name="transmision" value="<?php echo htmlspecialchars($vehiculo['transmision']); ?>">

                <label>Color:</label>
                <input type="text" name="color" value="<?php echo htmlspecialchars($vehiculo['color']); ?>">

                <label>Kilometraje:</label>
                <input type="number" name="kilometraje" value="<?php echo htmlspecialchars($vehiculo['kilometraje']); ?>">

                <label>Garantía:</label>
                <input type="text" name="garantia" value="<?php echo htmlspecialchars($vehiculo['garantia']); ?>">

                <label>Imagen del vehículo:</label>
                <input type="file" name="imagen" accept="image/*">
                <?php if($vehiculo['imagen']): ?>
                    <p>Imagen actual: <img src="../uploads/<?= htmlspecialchars($vehiculo['imagen']); ?>" width="100"></p>
                <?php endif; ?>

                <br>
                <button type="submit" class="button">Guardar Cambios</button>
                <a href="vehiculos.php" class="button">Cancelar</a>
            </form>
        </section>
    </div>

</div>
</body>
</html>
