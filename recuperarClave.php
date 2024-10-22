<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña</title>
    <link rel="stylesheet" href="./public/css/base/base.css">
    <link rel="stylesheet" href="./public/css/general/formulario.css">
    <link rel="stylesheet" href="./public/css/general/autenticacion.css">
</head>

<body>

    <div class="contenedorAutenticacion">
        <div class="area1">
            <img src="./public/img/contenido/4.jpg" alt="">
        </div>
        <div class="area2">
            <div class="logo">
                <img src="./public/img/logos/logo.jpeg" alt="Logo">
            </div>
            <div class="formulario-recuperar-contrasena">
                <h2 class="formulario-recuperar-contrasena__titulo">Recupera tu Contraseña</h2>

                <form class="formulario-recuperar-contrasena__formulario" action="recuperar-contrasena.php" method="POST">

                    <!-- Campo Email -->
                    <div class="formulario-recuperar-contrasena__grupo">
                        <label for="email" class="formulario-recuperar-contrasena__etiqueta">Correo Electrónico:</label>
                        <input type="email" id="email" name="email" class="formulario-recuperar-contrasena__input" required>
                    </div>

                    <!-- Botón Enviar -->
                    <div class="formulario-recuperar-contrasena__grupo formulario-recuperar-contrasena__botones">
                        <button type="submit" class="formulario-recuperar-contrasena__boton-enviar">Recuperar Contraseña</button>
                        <p class="btn-login">¿Recordaste tu contraseña? <a href="./login.php" class="link">Iniciar sesión</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>
