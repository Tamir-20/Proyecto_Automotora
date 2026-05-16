
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
		<title>Motos - Ignitus</title>
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

						<!-- Lista de Motos -->
							<section class="catalog">
								<header>
									<h2>Lista de Motos</h2>
									<p>Descubre todas nuestras motocicletas disponibles.</p>
								</header>
								<div class="row gtr-uniform">
									<article class="col-4 col-6-medium col-12-small">
										<a href="#" class="image"><img src="https://th.bing.com/th/id/OIP.oJDSK3ZQ4W0d2MZm2jJfnwHaEp?w=279&h=180&c=7&r=0&o=7&cb=12&pid=1.7&rm=3" alt="Honda CB600" /></a>
										<h3>Honda CB600</h3>
										<p>Motocicleta versátil ideal para ciudad y carretera.</p>
										<ul class="actions">
											<li><a href="#" class="button">Más Información</a></li>
										</ul>
									</article>
									<article class="col-4 col-6-medium col-12-small">
										<a href="#" class="image"><img src="data:image/webp;base64,UklGRpgqAABXRUJQVlA4IIwqAADQhQCdASrVALQAPpk6lkgloyIhMhsbELATCWUcAA7jDefaYP9zY/J6Stvd5jfNx9MX+W84DrYP2A4HG0vOFf5j8mfM/9B+w/2/mnYe+wbUU79/6XmN+yPi3+0f0/oI+292fAH9dP+p6b35fmn/GeoD/kfQ3/yeHN+Q/7PsA/z7+8/+H/Oe7b/kf/j/beiH9h/23/z/2XwE/rp/3/8b7bP//9y37hf+j3Pf2P/+igX/o3eFMOvQ7HLVDvG5YleX7qMv6jW9ahJQyjQ/0WB4e9+pY+Vzf/TU5U6kLo2LRPQrX/cdKzr/p7D6bHhfrhbQvx8Xnoc9a30eKmL4hcHx4xUZEx4J9S0wsVOxTXlRK1Hl2s6XEt/G32HOo9sypBBOYohHjWbt+LY9wiVe+CV+ME8CFoJaQJUYedvIJ9uRjc5fuezL492ky2rIvT300Pd4pgf9Upo0qW6OFodMeNrNSLdmTAvM4uxTBigCbPlQaYn3GdBVQJN1toR2ZG+90XeT+EIkaxHy6znB0nSTKT0JQaUh5sksgDgphwb92/Qv43FGxS+EWAN6gL7+/KMlbCeVoRYujMnbthMwKnptbzIHsf/mPznvgB0PYdFs4TgVgnJJfyc0SlhxnapnoYETvYN+DfeFGZlc3tNNG8aiuH5RrCpN/IEtfCWePYLFXRmzbV5GQcn1HM0ma8l6FP2LHU5eW3lgEW0fP/e6X+qLcFgnpCaXEsJpcQnBlcFjUFVQYlPJINlTopt4tvj+3UapLns5ArHG510IQdq5R1QDjNwPpG3DccJAfAQ/hXEgh/4YmfU6G0PS3/QP5mU65t13tUemFN8qVRR2ZTW9+LEU0Fv18EKNjYPGBefNGxb5QVI59nRMmML3RHdOluJxy+s1gXeSh47KmFVJ1aYs6ie83/xMyzqvO6FUxI9YUdneJKVS3Nrr34sK96yvGtzPr8K9Z3YfkZdnEo6JEQQyGid/JVTajsZ7SP9l2x4YcHKP3DnXTvG07ZMJGZXv+oijgfMJeBrot2f+hj+ZVpILVPNuIJvOG3FezQHSSAT2rxyG/O2NLUTQet2xXQaceznGlAc0FcU03Wc9KnHYLd0BhYyE+F5MeBWbtmnRksMBTo8dxoJ/YJkDnHwbB5eRr/p6eJ9kqYW05OVzwy39yCZeOML6jsIOkJ7PIQ6rJoBdgbgDI2B0u9p5cF3L6InkbHS290yEhesgYfAERB3NvJR/oST1PNWfPM8mrcLC+s3O8m2MeCyIKTx8kJuUUO1fffPPoP6KiRvtOThUvcUdGttc9oXizW1lJv194UrT6FovKC80JZEiOr0+bb8AKkH9ustQRl9q41DLvfMsDTlOMA6nXxZRsG++31I8Id4uaz7Shae9sns8ws+u+vpx9dcDuKBXQPnyECDusPIDHAeqIm0YnlzgYhU6AZEqjbJC0GtOAAD+/moW8FdYAeRo5RUGNFIJR7EZUgfLFmQ6TNQLTGW6S254YuUJ3M7modof2yZwv9eTdheA0zWGVLr2Sm6cs6a1Ky1GXY7vOqipZEvLojMBzeYnwo+YhhCtxgHm16Dh00t7bwQjUcJGnY+ObjU8y4iwM+H+MhBB5ns7uTqh5QJ2pvp8gQ+7Fv9GT7J8z88e7NyBoGXdJDauNdSV/gAdJPp+TSTWZkAAmvmnt5wGunmP3fG35CDQx5X9+CWc9jtYDtUU93P3WNhNnG+QAaeDDnKaDznExSUGsmRIuuznSRv3UId/jPLuEk89pmFM79RHwjKZ66/PqXLM07iowmVRgFOugMzT+t9thAVB8ulKNOPg+hzLhGy5ufApmazVG18dHXNDYX8UClK5Krw2dyEnr2aWlOVT46XpickDFoJVD0ffHsz6ljGbkCMfhL2ihyjxsIaHSqQc1YGLMGX5fGR/01IGQKNRI86hFsYsqcD2/swyEwYjQRxTO7EaZaxVlDvtVRt6qbsQwnoJF82G28uEbV9bxg7RJ9NnNoId/StCpmwP+wLUcSDH501KGBMfuiz4NMoMZrt2/Xbufdn5fvJ9g04fQR7TKOmx1IsWD8u2F2O744hXzTzzEr2/gzZQWS/X3fIEPsPrBoOSrVOzfhKuYWVc/JVYn1LTP3xYkDoykX8Alm3zqQjJV8IVvAoLNgdjsdEs9XXglgKy9ofp0esJcMGpvO/p778JdJ29EX68FnaAFgKUCbYpu0kel7z4yMmRsi4pE+j/usOzbJqzTluA+NRu+YnEQ+sDF7f/8BELRiTPJd6lcZBemNI6F/35ocz+PrtfMEs/vkmyhJcJSH9xKCrAyE7c7nD1/bWQTQekfTI40oZcITUVyKJzT4NNjdVXi9j3oYlZ3xJ1XLs6uPO8iUvf0Di/6EBNmeo2qlJ7XUzKy9Ku+CUpmvRxo9UXukytFzV2Pw3hJID/GT7MUpi7IEjClskoYklKMUWUrF+0J3PxXoRS58r5BuV00yIDm5tydPOounb5jEo1EWKmvGgi4xk9Mbw3kawuamUdkVoRjS7HWAfF0kwacM/IDQ3n8w4kusaIiXYy6XNLAAFstgB5spLuZFj3VNToosvCNe3y/DKyRyyzYShrwPBZEYFI0ZeMtrbap9e3oJnQiWU8+GppM6HSDHs2vkFT3AmqsJQoI7qLOrap1N86mok9e7mPyrYS8BM3i97KgCtu9tUgr2984JlUHAuhESEriFAlOyxF/4tZatqdJTNCbWrhthhUY51E01AIofSs13X6e90TQP4C9iz2PCKHZlY4Fg/J0aS10rUflVJUUR3EOm7HB2N7NiqML5nLjmhdFMs1rOSFpnkh2VyaXnwILNRCHhB8eD7OGz4GxYhDUiT9JAT5ra2oLx8fJRhytaNBwOxX4INa5h7u7EvNkvgnGuhdL7gR9HMpHErX3S2GKIHTZbovfolY+Luc8p7Dfso3BI2XNN8kfqoHW65TFZksrI/o62KUZmzGuStQcEplY2zeEcyhFUbsUs1OiUj3VHc49lu60TMO1wazazGnv22wjLrmW3oJH3pi0nzH14arwjiutC5etpBmpCV4nfpwdsO32ivhYE7wztY1oT4txbouqba69L0H4v7Sq3JRSNsyu2p0veU4VUzOVQnaIBS4ZIiYU7XVl+UNhmMo2NTIsY3eAo/EzqioCA1QbMN4wy0h1evXgIkZmxWCb/tPrklmpdJRQr8pz8o2HBuyLolMUaZVbQO51PnM4lpaPqyR6Z+y9YU9PtLrfDy1L837bHVkN0Sa5pibGXh6J0r+ulZmM6ATY6xuoKTGISbtgJ6GX5Pv4oNQWgSms5S1B4YHYf/yvkG1NVDKV4Xm31PqU0ohuKC9EvSOSeGQTAdU+MP+Ph5mYaDKovC03bbdJUb/j2zSmSMiTN8P5Nw7Voce3MydigkaOCHiYvegqKdZHqr0fkNhCfhAnO01/n5s9q6EyoUuoQ7Rk6obAMfSMeuMe5TDoo6FMvrbDxaxjZA5Q/Qcvu56u9a+xdyqbiRl9LNbtnpORoTbYK5XnB1Nr/pkQRe8+JBY1I0mmyyzcFRnnjsL/svnRvhIRJfD5/rEJje+lVQjnWZboBGYPlHzfg1LiOTOz6UGxiVqm3+EThCvxsXzWF5j0MbJ1zpRZ2Giz/SCnW500/S8QkDHVKQmnUVmggOMFLPrPrG1x7fKugf8h5Y7iSsDJieFZMPYvMd8pOPLaZA0IiQfXRLo0vrT8PL6z2SLh7yieLxHPD57udYBGduY2Y4KsZ48A9Gx+oDQtxkY73D+TCrea4zWCUJrI0TKoH98mOaXe7QxFvlTVXdK9gFVrBL4kPzHZX+vLEYINCyBrvkK4wVbwelisVe7s/60S0g7kmcYQYpSW5hzLo1hpOvbSoBfPOdsi1kRUw2PQ/JOSB6Yfu5oCv0lDOrkm/kFxw8m1+O/Zb7cvjp10UIUP0RCTlnOKfN+o4DniAAWwsFYeWXe4NjTaiZphNVqqvcSNl44d1W7607QZKu4Dcnwre3NphGOL9m/xojsk8onsvoT3W5XpNrVh0HM+JsgR+xjwf8Xr2rvjQUhRnxQH+WsVmBe2IUOJwtCApR1gFXSm4h9TVF1eVyrULziGs8ZJs75r205jeMyzKP086JZArdrUK66WpTSlCRumrgC9TybUH2RriCP37pfKCqG2lEN7i85fw0ta0aGT4c28ILzkAfP1AklhSzhhVVCBTes6Mj99d7oHZGH0Se2wwSVrIh4AIedpJCL9UJPvQ/jMGnf4TzSP8YXrZaHJ63fo8uD4immM9PxJHuehcxrY/ql4uGiRrl2EqBjQbIDTeYVrcnjTpO9c1+qdjPtPxiV6M31aq2aywP9850AL1+xjBU5+PTbiowLxmhruhPR6jvh7Pcdw4GjWXgV8w06GSNQWOSsQZ8IAo65qYYl/vD1YfEHWOD2U1iDCbQbPSamAPY6E1uYSPYQxtyLISCpVSjf1gxItorsqPx0nixsPl3QEO/0eDeNuil0qwl3ZhtrkifeGPh0873+5Wuv7Dpau9wsn7I/k08xLGk8p3LqNt6xYonLbDsAE2BX0eoJ2M7bn8EsHY1MOmK5LYdUOMyrxrjtgrPGqQ212xtxT+uY+V4lEAnu1+gLqt+PjUO68xRvanxD56TFhNx00AcjFm3bEFpw4gqcMKkJFtjtAUIi4scYrEdlp5eRW61fMRBkGuv5omd1/qD19tX+4vbiKRJC1Vy01ZDAlntwsLWSmVMCdFlZZEEprsdJgif8M8EmkAC4LzuAUWozRVafGyCT8NTNElmIrm3Gk6Fw/HdbS8B9bDTH1hSgxCf92EhivgHfjQ13F/3evhrRL520DkB2Inf2TwZ9/jg8MfBp/Ymc4qZ1csP4r/uZ/pFiIf1xCeyKCuTJIYJdivO3djYC1Sd1UfsaQEGyG6LDX+/s6bUBLVM5HF4xzjie9kVIqq+cNoMmlXZCVnU79xOAQWnjQDRBLFajaOBj+cAVenCh+M3EjX/OOCYnQFqjVD10VuDnuv75wh1F7AaOdLKnrCKelPRbzrn139iHFWfTLTi3+N4HGGXlNROtcnMdeshFIksgQLHWbd0BdkfgM3o9gwSoWLbWxWEEwXKcmxSI9gYZdYSponSMzb+0i4Cv1x8ip3Fdv+dMkks1IW6d6g+qcLa9d+QP8boMRm3rB/8c6lTI50ff4bzskbWAQtiCrfyTSYQn0y5mD+NWPB42bbkxF5rPGTFo40SIBQ7mmgkSbYVXrlxpDo2HYXtjm/TgxewmL0KniZH/zeykqFQlVZfWGvA56Xwtts5qNsTDlvuUU5oAMRLTQ/bOrfse0nnKMgSk94xdND5tAnvOH3GvQhXO2W73G5C+O6QK5/Ul9Nyftq45rTjFalmuqcum0Jbs+ESY5GwpUy0dRW5kJiyb9Ha23pBC/JMOsx3Wpm51rjpTrNMwZ3uwTVYsEquztEWUHigMrhth7yjljBWOmq9fjNenQ4uhuREim7exrWPD5NT5jTS1MDYI+2HYiGiY29jAsz5Snz/NkudhndVK/2tPg7G4AW8hJ2AnGCZ/984dBZvJS19qWSX1VNta0tfOfHe/N6HIRuD7MbYMcALcLZx5j9UTLWEyvkG/kMtbLjKWiumd3QOYrhhRnq1K7mRC3kKhmmrqTsVwm6aPvSChJ+9nu9R28FyYQn/pypqqXPlhI4n2HVdjp7uzwQB1YQfNtuFnYOIvJT+PRpYBC29L/jn4eowIun1iTNt/DXSi6FpKAKOa1f8maRTELWW1AVbQgsmd3YGnVKmdu2/RpcO1h6YKcBbHJoa3uX17u5qDgJkTm7jpzTuSdwPdCrrAFHmudFrwQq/ft2wMSJD03gxY8oWUB8gWRmRUMDnr717kP8FvFSgdwJ5vNTYsjYMbB9/OL0+lDRRizSMiVPe4RJExeD8hH+A7fHtFqTD0InzRBlNw13ZYuQRQxVgWguaEEoAKnKU289Wd3XVe4X1GgtJ4fE9ARuyLyXTO4GzJ9Jhy329YbFD9VhBuZleUBHOjgm5/KC/PN0gId877lT2Ck4G2tvRqc/3n2gH0/RrV74apIsU93Fb/IyOFAG+pSX0cLykYYbu7n8RnsQx7TzL6/mim7u1A3EERcka/T3KrbsbW82n3jSetXUR2YclbIewPeuoBeiId0zDU6EaIKiO8GGgIJrCQ/DRQtdQgWGaAfLp9RDDL8nc+nZxVsi27Wj+C9WMmQ/9nb0f5WS/mJB4kLEV0rgrvWKDwJO1AgyPYNcb5GW/W0Q8QR6XJxvNkoT6Ve7iBBLGOdsSSli6nEquCqQ2L+7K0HBguWbkuCCJ6BTj0QREc0/p4t5G4tuFUyjrDgdyfLzOVFSI6GHHCMimDFWKWCC5qARUJ03demIdfrRkihdDZi52FT0MODVlPyYW68b/6AAV0qatn2q6iIUwqjVK6NMgvhWkASBHmrtJsJzWERRsGHAve1ylRoHK8DFmaGcN3iwhQWr8PcDL3tXAqi3IY8Xm6hlDnNljWVwoNzW9kIJczhb07znBFd7SdvH10Z2yihS8oFV4LMMss1U5MhwkN2I6X8F0CjsVxLUAP27CHcY4pVvXN06CU7PxJIgwbuSlrHzEevP8PpvvI7SdZM4fmHNzUdvXGAA4Yj2vaVTmqTf/JIQbuSyfPCHdFCsjnZkPC2v/L1xGqY/hOvjUgrNlJwXXZtyma0njPxaz8jj6JUA6RbXwmSeX3RQFiYXNf2JT3uauBMTrJuHQWWxnGrsimcYs8oNWUsUK1LmJeR9zzzEQxoB2DVzYYTIaUDSw96lmXCoxJ1kAR8EMyOoQSb4LGKJEIoRgvDC0Tnt3+kwUHQsrQ3Q0vUFdocZWuiUa5+6tgiHYoI0hFNv2uJGOcVBehxnVYPmD4/4mUyd2kUswcbDR4n4JwdH4kHJa5/x4/xyfnsXLaXgApQvCdMrMDjF6kI34H8ifQ2qGAmFsqryHdLzHlAdJFWV8zUEVJP2LKIJKiiQuKExn48KNZZMacrdtmnLqhYjYxwA+kXFMp6Mj47p+pz+X0UO/ZZJ068rz6zD+Hjdfd4CyM7vIeV7J2fbDLgMcag+3e1EhLKI8JiJZkGc5dv1yXa3EtrZSzXURIuxgdDZhazts2Y51WUeK5Y3BSInuM4/NCTGJ//5nWhnr8wxybj/S7P4t+EL7pKaXqgvGb/DybMp33o/CqUSF+uJJejZufYHqS2/119CNyOZaFe+3zWpYy+94J3sMx3XVbRfEtXIlYYO7RGGdov3SgrajCmTpHcpOMwUK/AznPAQ1IwRgZ9gmI8TPvv35LcnhpY8iT2MZgph3XkzDZ6Ewfo6XkTM1wRcZ2FGqNmXELqu8Xz5p3Kekj4SnIoUkYIyudnHMY3z+kjxPkzxUgxPEzRGw/IK+oD58Jp+ZqjL6lGMAAprEQ8ETrR407V4JTJgZPjFbSkYJhxyKx6qJmtRsYciNckeX1oUjMCbrTMIHKLj3Ksl/S+gh3SjAjn5q6OEnGIqbNo8bzwHjB6IqiHy6LMqnfCFN/5moSxepTjp+ugosqqa3T2gzM1vA0u3u1Sjl+XsukwgAFhkrsYUghfCyyq4yyUAyOaJt3Ac5piYArVoKu75lAum0zAVpd9AXRz0PF7UDUsKL7HPwHE4owKNXFE9aorU500HQ/oBcix/qBD8HJocS6qrWJj6TDXy0hMOzf+dDZGTJ57k3Fv4p+yfThRLklYa047scwr8ai1VA1bsQtcP/eHDB158iaLJHjIEWI1CQcTh0h/o6PvFZh3rjdyprpO3RXSbP9aa10NnXxatrscnJV69Mo4u/wp4EcjHYCunSqJasUFx/wZ5xDpf+Ly0q9qfomRSZE8efeKo13BBvAPcMcXl35/He10X/F1t3graDGCLaebORx2I1DvVGyAa45eTb7w527ImELbTe+QkOtnfItUwW794kK3GVzlotl3fQgu46CKBsb5l5AGjZ3TENCOs/XwZh8tlqdBD77SlPm69VREvUwAjXZv1FJRzhJZu1vFJfXwYb8YJwati9E8VIEaiXqeY9HVeGonOaDMZDcayGhBVmgxEvZjiw1ZFMTnST3KMzQNjodfLbdwT1Kj7Gi0+s6csa+0ssyvU448O8agxlRjWAKzzgDsNJ5FlOvpcfyYOAtUqFvQ+xaZd2JRJoFhDX6pOYEN6xEVn+My8GG2MZPKGOQ9ECwDaenhHmguLRb915AUJKjYov2uLvTRuc81kL7Xj/t7AP/dnxk+AeID2Ba8JrPeu6xfRJlzRA4NdMSTv9L6cJwQ/044qaJMx2Go3O4RRYtwIfMX48sgKAapTCpjotKLE+qToFhW5/sHmteEdhajOptcMY8MQa3r0qhLuiB19Zu+YyNxo0RwtG/1H2dBgPmqvQ/fVJ3sNMyOJ7iNbTa2GBKAR8ZIFk0UXrN3a6ryuRTgdlipRLs7ofibzIj7aaWycdsC4L5dwaKwQ+W9LidE/lh7TgvJ727cBLwYLZI3d91DR5Qpy0yU7rnaDv3xePhamZxd8y4+TDdgWpl72bdumY4aAtVwPAJcZxc3o7Ulmfnz+LtdrUVKD1/AW6XviNbEKaZfzVvXqEz+9IOxfT2QF5j8QwLj76wY/SQvPXdBpkowUm7Yg9+PcMGpk2mh0xwMLRXIa5wg6PXUQGqShtElE1WC/nJcQrGtgpPMnaH6Yx551RRttCyxME9sIGiz+vij1BeDxn3c//1IY9eyRYLzVShQAFWUFQk/9YST881BDfUtpVRId5WuZfx2IbVlcpXX2qnvEFiAwnmhKdW8TcpacgGQyK4D06Q0TOXhhHfJff9TMUzb7WwD7E+cf94Yym9H/zCoi40d2fDld12yhKYnMLQRQAXvxiEc0dpZmnOQJ1dJWU/82InOrIVmPzz8BRMxRtpF8m6bJ330/GK61R+j+O3ZgxaFN2+lLyj/N5SB4T8CWRvt3I9bMOIx0xS84rlP/CEWCS3YcN36MtCfDDNtGEj31uv7WkYimYErRR2VUa/iv4SkSNzKb4utC2hly0iO4qYIpiivWMYadLDyl7FE4sq6ecXpEVYXCDsH91xqxY+lVgrQ9qJYJUSogTtx1781EfjRUUknQIYMPaQHtGZ6AyidMOvxSwT2f5dF/KLLHwUbUmkXAviBCbTcXcZ6MjSFQpxeTTOQbOtbCHSAFDYtF8rziEMgZvfoiB2BKeJA5ZXkjkexOOxWsp690vbyf1MT698o1CpkOdWXF6WqtOR5+av/liT3cplVMaGeRQOqJ/PiXrhWJMUosCDZwM0maDCvNZ8+D1PmbMg/R2Sy+d54P4Z3ojiu89kH4sWUUQVsYuBP1KOHE2CWYSUyRkiyrw5cnH5GTOJIZdVGUXsv15Rol0B8l36X0uCihPTMFgXNjDc7eYQPoJoFB0Vhid4lXMAwtLrq3YriS4iF4qHm3lr1c9NWwylW65hj/kn+5nBeaL0ga0n9MUze0wDmP4JKyuHushc0BhljMKTBWgyzjSOp7OvThkCx92y5ViGoQae7xKHIsfS8XRoZUvNhReRWXg8/WrPpvxkiI+fh+++W5n0V7xRdYfYyu7xbqxQ1Va8OiAjYgIii84i22B9Ns0UFlVJ2e9kvZyVTKA5RKj4/LW+D9hhxuO5WZfW/EwBaJub5OpnFgSy6rGBBR0bpHjYki9g8Rnv+24KCJlj4Mn8qA6gSMbQcVjOG709wMxM49pWIwtp4zOgdPUDO71TEvMlfEo6F/l4qs3dJHSuSTC+KqovZIbWQfMtum89WJ2+4X34gbvJ8SyCwvIpmdGKYzT7y6f5xiA5PQIXfSql4Onh9oUjDvcrGXxoN4+rcjS5x1EhZBDd2XniQjIW+TpKVYgEq3N9BH9B9zzoRYrRQGU/tUDfIKenIsxnZGyRwWXA02tSOVKswE1tI9UZekYdE493KGHHIetwc8OjDgCoWjKVfVwU45f75xIiuldKmdrpD+Xjl/K4MMT7TlgFLXRkXfzJGfmohQyoGY0CwioFfpXm9oOV7xp8TTVk4NrIqjn5lWtyQXEfmvB5byTzXXXPW3DlwDTbyC7T/A5nelmImVCzFMCHEz9pFAoqeyklJp2YD+nbwIb82MCPSs8/+4u04chzdVOxvILf976438tlqY+UmXNHZkrMKAQfCKFkdunYvk6EZ+heLQS2Tu+0WHtCPdvljbA1ZIv3F3fgy7BEyPaULk4PANsQvoIZTrneEa+smff+cZMWl5V6edhfq2N36Q8IGBhMIQfNis3HD2pxD9vis6UNUNyJxNIsza4Uc8HV/gI/t9B2KGWJ5SwtKwluON6YMo1GfcnABgtAN/zHIpFB3oZfTIeh34Q2V8mOkDaCxzSjO8PKJsMdubaQiptXMnhrLU38DwEnbXHQHS2Wlno+TGuRRRzSoYbfwA30LnzKSNLgVHIVOq9O4vNKwLWVK9zov9/HodtZCjyyByMqlweUeYIcFaXx04ZlfRUcqHOscVjBx5/Lf1oFNxttGSMxtCjQhaRy6AWaMoY092QnkWdPa5VrduOdOOkGjqNiUWpGtrItkPvBxUfaj95wZInC06oMm3u1mHBTF85WesD1VVpSWxpVtiqQcSqIZnA2fqbXosLaGGY52CscEukA5hvT3o12GgfYD2BjNC06TrzSt9rAtBXX90s5/KQ80KsuAExQq4qLwp02yRsWCt0ZdmKgCTCb51oi0dn6gjO5deVuT/DZx6w8P07Q37MnpvFGE6XIAts863tJ2W+kH1H+J613Hqen4Jm93aXrHnNRXrfDZ0NK0KZoi96PBX3K/3sgd8CwlLPiiL8uXu1FHGhSgnNhEwdM1ybQkCUr4y84PRL3tE16pqGBgPSuIIXKlf3zxtC7seeb7By/N0BdyQdlTzQxVXJVs6DLTet56PruR1gPW8YWJwQTrph33AAJcWgpmBhxWr49E5P8AoR5qs4YLbG1uQghBNjP72t37lI4jPSDtkz0GRKl90SayTqsTBHvdDQ6sNhOkAdCKu9lRglIPbZFGo7J2WsnACYNQIPQFks7wptKOhYVVLPFCmK1VIrWUYpglhdumFNd8bEFRLBpmvVXceY6FR0M4qfdHeTTVhMh3hcY7tQpu99soEdjnK33N4ImxVLDhbnDpUkORCU80n2oiJlgO2qCEFKcisANBd/CXeM4z6q/qPOVG5kfUK+BL9mafzr3rweUFGFQb+UFWx+lBBFlulX0wGL/hoV9ohPSp75Kh9eOC2A93rQjgy6AgfjwuocCwD3sAzDt8yKuNYU9Of5TeQ1Fent5NZdpRRC1KgH8qIGj7x2l0lQNuF3kaszLzKnyOuO5XfIsgJJUwUI4mhfjweWiLpedY2ELIi+ZAUkZh0FV4uvnvXMVBFsRyuU6G520nLk3Q5E/fl1qK94M2VJHF9chPQ5P9U8479RI8PP/AbMtdEYQx/K4JtIViV9uO6YqsgIT1AGMYCaPWnsXGb2sqEbi5wNz8+gfRGs+f/0LNOl3YVaLvAMHpQ/yGucLXmL26a7GTvJuSKlKikwulCmaB7e5G/gGn2bn8hnmJq6cqPyJuKhOm0/4TiXKN6sKfdiz/zAf2GQH5cIlfQ7RRLUmS1E8Fyn/RGytbte5+QLSo2k2ul7i/TO337o82wv3ByaLVxooD2mdNkqyUghLpfa02EF7kmfODTpgxyNuUCc7LomkSJ9cSk/+QwJ7Wit+Ec09FLiPlVe7lIBPb6wa9Jl5cuLq0KRShn6B4viy7Q45sswa8aZtPL/PU3LR+B5O5UAYeXzX1T4IW9lx4mw1SOQwGazX5/ek2kMByu980Oqwyk0oHA/UihBsllrE165W7OYIS80sCRGZLSJB18Sv/tX/4NVmBmiuvZXSZjcna4MkUENWOVBVRqlp+Gdje2V4i7VYj9Xa9lUAEwKTEbkefMYyQ9NweFbOrA/iKTtPJmzuwRmyNh8LNySLjDoXpx4fSbNlSgiP0U9RiWThcBQk6+DWgukdMH0HS6ElcdWOtNho6dO4WcNV5cmVEtRQZGFXGNKj37S06apXvFMJbjq/1GTyxryhjxTgIyMMH7wEpCHgfQHHcCp50NQ7q3gar2cS4tSqMfo8Yyi3tacI2jHsnFF3My2yWLRAVbDyle9sIXlyAtYGrE6hkJnTbeYV1oAs64jTZl8boRp1QKr106YZKc49XY50WVeRbdtIyegLRFDQhA2Bv1fa+5AgkxZkrFE4Gq54j1JlQZfwJ7EDG6nj6Qjd7BPU1Y0foeqQvdZAsgDFZMWtV3dFxHwv4V9StWR0Y5fVQ7mLgp00Kdku+cgK0DFGbo0ZPSfcbX68+EpK6a7aPkAJv8ZLJ6j82JD/2tc+CyFKIGIRZvRbKRA0TZ5pmu6V56hxlJ1muXL2G+8ZjqxcgTe/T6Tv48bAQdNxgxPpUMap2YhcWK8u32FfMIrCr81qsvIObe/KbZfU74xB7tgygfn2ikvFkJ1ONZHr/cZJRJjMEK1r2OhKOqMMnOJJQbRzZdfU4CI8wG3SUMfbVghzzkosOad+Q6ruWeZpD3byjyUw8h0/hyhYyXQQ7YBmv07wH4jOpgQ4GnhPu0sYDytTVN1bcnY55OD/NJr0MBbSixzXVFrLGgDfRpYD7/j4AysyRFIzH+JSywWX1yMWDh2D1FcGDCcXCXMjemwim9EfhEGCha4OG/wmHRgIRRJJoWbD5ALbx3qFDjSh7T3UgYT3bQSSmc60wG9f5zV/+d3TvW+AR6Y2tgt39h59zlrJ4nq8YRjh6F2BOKK1pcUioMSjl/fTDfemddJ19l4C3g15udN1U1prQkPHRc1fwE2m+c4qqRdvoFoEQShVbeQarttTM947y6Otaa2J/3rIs4gcqcC/myHqAowfPeihOJtbf9qVixhno79Z/XWH9u5amBDPPNrOXywX/02Cfa1CpFp+NMOXlxlctpF++ljc4xEjuRdDGAM6HOLh4VgPOR44ffz218NZWEgmNL5BNjYunfsIl20CU1tKaL+Ft/HOp3z84EI+9OJfU14C3W90Fc9SvFGXJNvGEXsjfvyECGc7wGkfrqpPpjQe1rX/+xwCifm3dkQFzQW+fUNkwiahiR6qdIVwq37zbfPxfsMHRKoKiwehu/Y5We5/i9qogoHbqFB7MB61bOBSqzw+XFZiHrNCtVnYG6sHqlXLTTXjecU07bwyXW/xR83kjS71OXykj1vEUgMEi+mo3Mhzd5HbqcsvVljScdxElhlZQD4tZ9Fg+mpStQFCnto2YYC1lp8AF6HE8jR6mxB2wE/00kpvfjEGXY02EV0IeyFYZdoP7jVWJkZCwjRJRtti7Kbh6JTWx9/b6Mp2xni6Uv5k8tUyp0qlqO+9vBKo5E0FZotkFA/Upn0KZAaOcYJCX6KhMxYDIXgXqlijAbf1NVddEmOFKuOi9+VHCVIFXwBy6sZ0UfHkKThECDMx50u9mCSa1xpDiBQoUYX9D73o0rkTZrgf4Y5r7AU/uXG0ToeSuzp/ayYE4ypM3Hy2AU1XSynvk8dhLfD5QI+2gA1zEEegL4JxfrrJrAZhe3n8jzmfAWB369CJ5WRos1J/l51Hd21RNHBFExoRGjNbRG5dWFKHUccb9NpreaWT2RtTLbNAT6T0hYe5jBnxz+uVLCj7lJ549CGU1EjOrP2sF2acweSddoWPBll9C5hjyOIidEcJ959UYvbz5nWVsoCoy4ydEiCCbwwOvgp1zxoNjozl3cmjviHHwc3XSLIgPLmD4GWPkTNYWRUev5s1u0wm8D4o10fVQCcPAgAyj0wSFp76ZVTmiqqzj/WNdYK203BMkhT+KfV5T4I07hKxOBtrKfganbWBO5QicxaV6cPutuVdWIqjTTHs6badoaoSRysRnZj/NCrCiyLckVoMUODmN6nklKqxYfHn8bjW83NiToenCOBFfqxSlyHyRhYPALMxXqXMQg6nGTImnpoPOh8+J81LWfzEYMn4dKSShIEkhAldp2BGoui2J5EK0EvRrAgvYICGoMOJ+u3Z4Nhz8YQEEkfPsZ+Ei2QBVogKm6KmtKBKizC4yc3kt4wMW8IFoCXBOjVyrgrV6Z/uVjAiRx5tJwnecW4eHbS1uTZ66QbXHxR0wN2QTj723Pf8Q7nKxJdzCWi1EkUXCvxYETMUD5gS3OXn8HxovuqXk2sap1iYxpWx5ob2u09h4fCvGAGjsEpa/Vs6kQc7mnoWZTlVBzuLGYYDBaH1ogAefGYR7mX9jDvEgEeuMb7i6XYC5J1KmkSyOhKqb0rmIajTwbGQxU1o5eiQn1+zQwnlrMgEQNxOh/WZAH7EVLjdjJ86i4YVX6ktB41D6uCiqXi/AdIhm8Whz1sgzW5urjtUSOx/u7S6oBloApz/kJLwdvVXH2S8aTaXc5RCshj0vc/BEDffI585oW3t6AkIGCGsmuf9r+9ZKtspYjIDoRAiZqQw0Zs8fvoPkiM0PxKCj7ObD8DnLe4xJNVJ6KJ8Ln6FubbEALB5Jpg2TzTWKWr079Mbwnf3OfV816IlQ8mytjC9AbnH3fEadNNEiztx93eGaaZOn4XJCmn1m8P4YA/yflM8+uoanQU7vn8ct5Q9pl+RkAAAAA==" alt="Yamaha MT-07" /></a>
										<h3>Yamaha MT-07</h3>
										<p>Motocicleta naked con motor de 689cc y diseño agresivo.</p>
										<ul class="actions">
											<li><a href="#" class="button">Más Información</a></li>
										</ul>
									</article>
									<article class="col-4 col-6-medium col-12-small">
										<a href="#" class="image"><img src="https://th.bing.com/th/id/OIP.NY892KIa_gV2vKUoeerzaQHaEp?w=261&h=180&c=7&r=0&o=7&cb=12&pid=1.7&rm=3" alt="Kawasaki Z900" /></a>
										<h3>Kawasaki Z900</h3>
										<p>Motocicleta naked con motor de 948cc y estilo deportivo.</p>
										<ul class="actions">
											<li><a href="#" class="button">Más Información</a></li>
										</ul>
									</article>
									<article class="col-4 col-6-medium col-12-small">
										<a href="#" class="image"><img src="https://th.bing.com/th/id/OIP.b_tvpcEijrN3vKv0IOWsrgHaEo?w=270&h=180&c=7&r=0&o=7&cb=12&pid=1.7&rm=3" alt="Honda CBR600RR" /></a>
										<h3>Honda CBR600RR</h3>
										<p>Motocicleta deportiva con motor de 599cc y alto rendimiento.</p>
										<ul class="actions">
											<li><a href="#" class="button">Más Información</a></li>
										</ul>
									</article>
									<article class="col-4 col-6-medium col-12-small">
										<a href="#" class="image"><img src="https://th.bing.com/th/id/OIP.VceOyq-HBDpNFqLCfqbdrAHaEo?w=256&h=180&c=7&r=0&o=7&cb=12&pid=1.7&rm=3" alt="Yamaha R6" /></a>
										<h3>Yamaha R6</h3>
										<p>Supersport con diseño aerodinámico y motor de 600cc.</p>
										<ul class="actions">
											<li><a href="#" class="button">Más Información</a></li>
										</ul>
									</article>
									<article class="col-4 col-6-medium col-12-small">
										<a href="#" class="image"><img src="https://th.bing.com/th/id/OIP.J8h4F3-dXm0m0bHqMyS4YQHaEo?w=245&h=180&c=7&r=0&o=7&cb=12&pid=1.7&rm=3" alt="Kawasaki Ninja 400" /></a>
										<h3>Kawasaki Ninja 400</h3>
										<p>Naked bike ideal para principiantes con motor de 399cc.</p>
										<ul class="actions">
											<li><a href="#" class="button">Más Información</a></li>
										</ul>
									</article>
									<article class="col-4 col-6-medium col-12-small">
										<a href="#" class="image"><img src="images/Honda_Civic.png" alt="Suzuki Hayabusa" /></a>
										<h3>Suzuki Hayabusa</h3>
										<p>Hyperbike con velocidad máxima y motor de 1340cc.</p>
										<ul class="actions">
											<li><a href="#" class="button">Más Información</a></li>
										</ul>
									</article>
									<article class="col-4 col-6-medium col-12-small">
										<a href="#" class="image"><img src="images/Nissan_Sentra.png" alt="Ducati Panigale V4" /></a>
										<h3>Ducati Panigale V4</h3>
										<p>Moto de carreras con tecnología avanzada y motor V4.</p>
										<ul class="actions">
											<li><a href="#" class="button">Más Información</a></li>
										</ul>
									</article>
									<article class="col-4 col-6-medium col-12-small">
										<a href="#" class="image"><img src="images/Kia Rio.png" alt="BMW S1000RR" /></a>
										<h3>BMW S1000RR</h3>
										<p>Superbike alemana con alto rendimiento y electrónica sofisticada.</p>
										<ul class="actions">
											<li><a href="#" class="button">Más Información</a></li>
										</ul>
									</article>
									<article class="col-4 col-6-medium col-12-small">
										<a href="#" class="image"><img src="images/Toyota_Corolla.png" alt="Triumph Street Triple" /></a>
										<h3>Triumph Street Triple</h3>
										<p>Naked con motor de 765cc y manejo ágil.</p>
										<ul class="actions">
											<li><a href="#" class="button">Más Información</a></li>
										</ul>
									</article>
									<article class="col-4 col-6-medium col-12-small">
										<a href="#" class="image"><img src="images/Ford_Focus.png" alt="KTM Duke 390" /></a>
										<h3>KTM Duke 390</h3>
										<p>Moto urbana con diseño agresivo y motor de 373cc.</p>
										<ul class="actions">
											<li><a href="#" class="button">Más Información</a></li>
										</ul>
									</article>
									<article class="col-4 col-6-medium col-12-small">
										<a href="#" class="image"><img src="images/Volkswagen Golf.png" alt="Harley-Davidson Sportster" /></a>
										<h3>Harley-Davidson Sportster</h3>
										<p>Clásica americana con estilo retro y motor V-Twin.</p>
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
