<?php
include("../Comercial/session_check.php");
include("../Comercial/config.php");

$cliente_id = $_SESSION['id_usuario'];
$vehiculos = $conexion->query("SELECT * FROM vehiculos WHERE id_cliente = $cliente_id");
$mensaje = isset($_GET['msg']) ? $_GET['msg'] : "";

$vehiculosArray = [];
if($vehiculos && $vehiculos->num_rows > 0){
    while($v = $vehiculos->fetch_assoc()){
        $vehiculosArray[] = [
            'vin' => $v['vin'],
            'marca' => $v['marca'],
            'modelo' => $v['modelo'],
            'año' => $v['año'],
            'placa' => $v['placa'],
            'potencia_motor' => $v['potencia_motor'],
            'tipo_combustible' => $v['tipo_combustible'],
            'transmision' => $v['transmision'],
            'color' => $v['color'],
            'kilometraje' => $v['kilometraje'],
            'garantia' => $v['garantia'],
            'imagen' => $v['imagen'] ?: 'default_car.png'
        ];
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Ignitus - Mis Vehículos</title>
<link rel="stylesheet" href="assets/css/main.css">
</head>
<body>
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

<?php if($mensaje): ?>
    <div class="mensaje-exito"><?= htmlspecialchars($mensaje) ?></div>
<?php endif; ?>

<div class="vehicle-wrapper">
    <div class="arrow-left" onclick="changeVehicle(-1)">‹</div>
    <div class="vehicle-box fade-element">
        <?php if(count($vehiculosArray) > 0): ?>
            <img id="vehicle-image" src="../uploads/<?= htmlspecialchars($vehiculosArray[0]['imagen']) ?>" alt="Vehículo">
            <h2 id="vehicle-name"><?= htmlspecialchars($vehiculosArray[0]['marca'].' '.$vehiculosArray[0]['modelo'].' '.$vehiculosArray[0]['año']) ?></h2>
            <ul id="vehicle-info">
                <li><strong>Marca:</strong> <?= htmlspecialchars($vehiculosArray[0]['marca']) ?></li>
                <li><strong>Modelo:</strong> <?= htmlspecialchars($vehiculosArray[0]['modelo']) ?></li>
                <li><strong>Año:</strong> <?= htmlspecialchars($vehiculosArray[0]['año']) ?></li>
                <li><strong>Matrícula / Placa:</strong> <?= htmlspecialchars($vehiculosArray[0]['placa']) ?></li>
                <li><strong>VIN:</strong> <?= htmlspecialchars($vehiculosArray[0]['vin']) ?></li>
                <li><strong>Potencia:</strong> <?= htmlspecialchars($vehiculosArray[0]['potencia_motor']) ?></li>
                <li><strong>Combustible:</strong> <?= htmlspecialchars($vehiculosArray[0]['tipo_combustible']) ?></li>
                <li><strong>Transmisión:</strong> <?= htmlspecialchars($vehiculosArray[0]['transmision']) ?></li>
                <li><strong>Color:</strong> <?= htmlspecialchars($vehiculosArray[0]['color']) ?></li>
                <li><strong>Kilometraje:</strong> <?= htmlspecialchars($vehiculosArray[0]['kilometraje']) ?> km</li>
                <li><strong>Garantía:</strong> <?= htmlspecialchars($vehiculosArray[0]['garantia']) ?></li>
            </ul>
        <?php else: ?>
            <p>No tienes vehículos registrados.</p>
        <?php endif; ?>
    </div>
    <div class="arrow-right" onclick="changeVehicle(1)">›</div>
</div>

<!-- Botones CRUD -->
<div id="manage-vehicles">
    <a href="vehiculo_add.php" class="button">Agregar Vehículo</a>
    <?php if(count($vehiculosArray) > 0): ?>
        <a id="edit-btn" href="vehiculo_edit.php?vin=<?= urlencode($vehiculosArray[0]['vin']) ?>" class="button">Editar Vehículo</a>
        <a id="delete-btn" href="vehiculo_delete.php?vin=<?= urlencode($vehiculosArray[0]['vin']) ?>" class="button" onclick="return confirm('¿Seguro que deseas borrar este vehículo?');">Borrar Vehículo</a>
    <?php endif; ?>
</div>


<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/browser.min.js"></script>
<script src="assets/js/breakpoints.min.js"></script>
<script src="assets/js/util.js"></script>
<script src="assets/js/main.js"></script>
<script>
let vehicles = <?= json_encode($vehiculosArray) ?>;
let currentVehicle = 0;

function changeVehicle(dir){
    if(vehicles.length === 0) return;
    currentVehicle = (currentVehicle + dir + vehicles.length) % vehicles.length;
    let v = vehicles[currentVehicle];

    document.getElementById('vehicle-image').src = '../uploads/' + v.imagen;
    document.getElementById('vehicle-name').innerText = v.marca + ' ' + v.modelo + ' ' + v.año;

    // Actualizar info del vehículo
    let info = `
        <li><strong>Marca:</strong> ${v.marca}</li>
        <li><strong>Modelo:</strong> ${v.modelo}</li>
        <li><strong>Año:</strong> ${v.año}</li>
        <li><strong>Matrícula / Placa:</strong> ${v.placa}</li>
        <li><strong>VIN:</strong> ${v.vin}</li>
        <li><strong>Potencia:</strong> ${v.potencia_motor}</li>
        <li><strong>Combustible:</strong> ${v.tipo_combustible}</li>
        <li><strong>Transmisión:</strong> ${v.transmision}</li>
        <li><strong>Color:</strong> ${v.color}</li>
        <li><strong>Kilometraje:</strong> ${v.kilometraje} km</li>
        <li><strong>Garantía:</strong> ${v.garantia}</li>
    `;
    document.getElementById('vehicle-info').innerHTML = info;

    // Actualizar botones CRUD
    document.getElementById('edit-btn').href = 'vehiculo_edit.php?vin=' + encodeURIComponent(v.vin);
    document.getElementById('delete-btn').href = 'vehiculo_delete.php?vin=' + encodeURIComponent(v.vin);
}
</script>

</body>
</html>
