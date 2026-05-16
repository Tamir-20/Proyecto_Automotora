<?php
include("../Comercial/session_check.php");
?>

<!DOCTYPE HTML>
<!--
	Future Imperfect by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Cascos - Ignitus</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body class="single is-preload">

		<!-- Wrapper -->
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
						<!-- Filtro -->
							<section class="filter">
								<header>
									<h3>Filtro de Catálogo</h3>
								</header>
								<select id="filter-select" class="filter-select">
									<option value="all">Todos</option>
									<option value="auto">Autos</option>
									<option value="moto">Motos</option>
									<option value="casco">Cascos</option>
								</select>
							</section>

						<!-- Lista de Cascos -->
							<section class="catalog">
								<header>
									<h2>Lista de Cascos</h2>
									<p>Descubre todos nuestros cascos disponibles.</p>
								</header>
								<div class="row gtr-uniform">
									<article class="col-4 col-6-medium col-12-small">
										<a href="#" class="image"><img src="https://th.bing.com/th/id/OIP.hImJ0z0CstMWFStlaXDdRQHaH6?w=182&h=195&c=7&r=0&o=7&cb=12&pid=1.7&rm=3" alt="Shoei GT-Air II" /></a>
										<h3>Shoei GT-Air II</h3>
										<p>Casco integral de alta gama con ventilación superior.</p>
										<ul class="actions">
											<li><a href="#" class="button">Más Información</a></li>
										</ul>
									</article>
									<article class="col-4 col-6-medium col-12-small">
										<a href="#" class="image"><img src="https://th.bing.com/th/id/OIP.uRTptBaCIrPZvqCc2uvMLgHaIp?w=182&h=213&c=7&r=0&o=7&cb=12&pid=1.7&rm=3" alt="Arai Corsair-X" /></a>
										<h3>Arai Corsair-X</h3>
										<p>Casco premium con protección avanzada y comodidad.</p>
										<ul class="actions">
											<li><a href="#" class="button">Más Información</a></li>
										</ul>
									</article>
									<article class="col-4 col-6-medium col-12-small">
										<a href="#" class="image"><img src="https://th.bing.com/th/id/OIP.senYRjEW0YR-XvSjDSt0WgAAAA?w=188&h=205&c=7&r=0&o=7&cb=12&pid=1.7&rm=3" alt="Shoei Multitec II" /></a>
										<h3>Shoei Multitec II</h3>
										<p>Casco modular versátil para diferentes condiciones.</p>
										<ul class="actions">
											<li><a href="#" class="button">Más Información</a></li>
										</ul>
									</article>
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
			<script>
				$(document).ready(function() {
					$('#filter-select').change(function() {
						var value = $(this).val();
						if (value === 'auto') {
							window.location.href = 'autos.html';
						} else if (value === 'moto') {
							window.location.href = 'motos.html';
						}
						else if (value === 'casco') {
							window.location.href = 'cascos.html';
						}
					});
				});
			</script>
	</body>
</html>
