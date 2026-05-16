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
		<title>Autos - Ignitus</title>
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

						<!-- Lista de Autos -->
							<section class="catalog">
								<header>
									<h2>Lista de Autos</h2>
									<p>Descubre todos nuestros vehículos disponibles.</p>
								</header>
								<div class="row gtr-uniform">
									<article class="col-4 col-6-medium col-12-small">
										<a href="#" class="image"><img src="images/Chevrolet_Onix.png" alt="Chevrolet Onix" /></a>
										<h3>Chevrolet Onix</h3>
										<p>Un sedán compacto ideal para la ciudad, con excelente eficiencia de combustible y comodidad.</p>
										<ul class="actions">
											<li><a href="#" class="button">Más Información</a></li>
										</ul>
									</article>
									<article class="col-4 col-6-medium col-12-small">
										<a href="#" class="image"><img src="images/Hyundai_HB20.png" alt="Hyundai HB20" /></a>
										<h3>Hyundai HB20</h3>
										<p>El hatchback perfecto para familias, con diseño moderno y tecnología avanzada.</p>
										<ul class="actions">
											<li><a href="#" class="button">Más Información</a></li>
										</ul>
									</article>
									<article class="col-4 col-6-medium col-12-small">
										<a href="#" class="image"><img src="images/Renault Kwid.png" alt="Renault Kwid" /></a>
										<h3>Renault Kwid</h3>
										<p>Compacto y económico, ideal para desplazamientos urbanos con bajo consumo.</p>
										<ul class="actions">
											<li><a href="#" class="button">Más Información</a></li>
										</ul>
									</article>
									<article class="col-4 col-6-medium col-12-small">
										<a href="#" class="image"><img src="images/Toyota_Corolla.png" alt="Toyota Corolla" /></a>
										<h3>Toyota Corolla</h3>
										<p>Sedán confiable y duradero, con excelente reputación en seguridad y rendimiento.</p>
										<ul class="actions">
											<li><a href="#" class="button">Más Información</a></li>
										</ul>
									</article>
									<article class="col-4 col-6-medium col-12-small">
										<a href="#" class="image"><img src="images/Ford_Focus.png" alt="Ford Focus" /></a>
										<h3>Ford Focus</h3>
										<p>Hatchback deportivo con manejo ágil y opciones de motor eficientes.</p>
										<ul class="actions">
											<li><a href="#" class="button">Más Información</a></li>
										</ul>
									</article>
									<article class="col-4 col-6-medium col-12-small">
										<a href="#" class="image"><img src="images/Volkswagen Golf.png" alt="Volkswagen Golf" /></a>
										<h3>Volkswagen Golf</h3>
										<p>Ícono del segmento, con comodidad premium y tecnología de vanguardia.</p>
										<ul class="actions">
											<li><a href="#" class="button">Más Información</a></li>
										</ul>
									</article>
									<article class="col-4 col-6-medium col-12-small">
										<a href="#" class="image"><img src="images/Honda_Civic.png" alt="Honda Civic" /></a>
										<h3>Honda Civic</h3>
										<p>Sedán versátil con excelente economía de combustible y espacio interior.</p>
										<ul class="actions">
											<li><a href="#" class="button">Más Información</a></li>
										</ul>
									</article>
									<article class="col-4 col-6-medium col-12-small">
										<a href="#" class="image"><img src="images/Nissan_Sentra.png" alt="Nissan Sentra" /></a>
										<h3>Nissan Sentra</h3>
										<p>Confortable y espacioso, perfecto para viajes largos con familia.</p>
										<ul class="actions">
											<li><a href="#" class="button">Más Información</a></li>
										</ul>
									</article>
									<article class="col-4 col-6-medium col-12-small">
										<a href="#" class="image"><img src="images/Kia Rio.png" alt="Kia Rio" /></a>
										<h3>Kia Rio</h3>
										<p>Estilo moderno y características de seguridad avanzadas a un precio accesible.</p>
										<ul class="actions">
											<li><a href="#" class="button">Más Información</a></li>
										</ul>
									</article>
									<article class="col-4 col-6-medium col-12-small">
										<a href="#" class="image"><img src="images/Mazda 3.png" alt="Mazda 3" /></a>
										<h3>Mazda 3</h3>
										<p>Diseño elegante con un manejo excepcional y cabina premium.</p>
										<ul class="actions">
											<li><a href="#" class="button">Más Información</a></li>
										</ul>
									</article>
									<article class="col-4 col-6-medium col-12-small">
										<a href="#" class="image"><img src="images/Tesla Model 3.png" alt="Tesla Model 3" /></a>
										<h3>Tesla Model 3</h3>
										<p>Vehículo eléctrico con gran autonomía y tecnología avanzada.</p>
										<ul class="actions">
											<li><a href="#" class="button">Más Información</a></li>
										</ul>
									</article>
									<article class="col-4 col-6-medium col-12-small">
										<a href="#" class="image"><img src="images/BMW_3_Series.png" alt="BMW 3 Series" /></a>
										<h3>BMW 3 Series</h3>
										<p>Auto deportivo de lujo con excelente desempeño y confort.</p>
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
