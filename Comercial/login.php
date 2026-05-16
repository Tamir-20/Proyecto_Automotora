<?php
include("config.php");
include("controlador.php");
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Ignitus</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="assets/css/main.css" />
</head>
<body class="single is-preload">

<div id="wrapper">

    <!-- Header -->
    <header id="header">
        <h1><a href="index.html">IGNITUS</a></h1>
        <nav class="links">
            <ul>
                <li><a href="index.html">Servicios</a></li>
                <li><a href="catalogo.html">Catálogo</a></li>
                <li><a href="index.html#clientes">Clientes</a></li>
                <li><a href="index.html#nosotros">Nosotros</a></li>
                <li><a href="index.html#contacto">Contacto</a></li>
            </ul>
        </nav>
    </header>

    <!-- Main -->
    <div id="main">

        <div class="login">
            <div class="card-switch">
                <label class="switch">
                    <input type="checkbox" class="toggle">
                    <span class="slider"></span>
                    <span class="card-side"></span>

                    <div class="flip-card__inner">

                        <!-- LOGIN -->
                        <div class="flip-card__front" id="login_pag">
                            <div class="title">Iniciar sesión</div>

                            <?php
                            if (!empty($error)) echo "<p style='color:red;'>$error</p>";
                            if (!empty($success)) echo "<p style='color:green;'>$success</p>";
                            ?>

                            <form class="flip-card__form" method="POST" action="">
                                <input class="flip-card__input" type="email" name="email" placeholder="Correo Electrónico" required>
                                <input class="flip-card__input" type="password" name="password" placeholder="Contraseña" required>
                                <button class="flip-card__btn" type="submit" name="login">Confirmar</button>
                            </form>
                        </div>

                        <!-- REGISTER -->
                        <div class="flip-card__back" id="register_pag">
                            <div class="title">Registrarse</div>

                            <?php
                            if (!empty($error)) echo "<p style='color:red;'>$error</p>";
                            if (!empty($success)) echo "<p style='color:green;'>$success</p>";
                            ?>

                            <form class="flip-card__form" method="POST" action="">
                                <input class="flip-card__input" name="nombre" placeholder="Nombre" type="text" required>
                                <input class="flip-card__input" name="apellido" placeholder="Apellido" type="text" required>
                                <input class="flip-card__input" name="email" placeholder="Correo Electrónico" type="email" required>
                                <input class="flip-card__input" name="password" placeholder="Contraseña" type="password" required>
                                <input class="flip-card__input" name="confirmar" placeholder="Confirmar Contraseña" type="password" required>
                                <button class="flip-card__btn" name="register" type="submit">Confirmar</button>
                            </form>

                        </div>

                    </div>
                </label>
            </div>
        </div>

    </div>

</div>

<!-- Scripts -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/browser.min.js"></script>
<script src="assets/js/breakpoints.min.js"></script>
<script src="assets/js/util.js"></script>
<script src="assets/js/main.js"></script>

</body>
</html>
