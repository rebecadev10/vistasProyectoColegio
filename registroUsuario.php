<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="./public/css/base/base.css">

    <link rel="stylesheet" href="./public/css/general/formulario.css">
    <link rel="stylesheet" href="./public/css/general/autenticacion.css">
</head>

<body>


    <div class="contenedorAutenticacion">
        <div class="area1">

            <img src="./public/img/contenido/3.jpg" alt="">
        </div>
        <div class="area2">
            <div class="logo">
                <img src="./public/img/logos/logo.jpeg" alt="">
            </div>
            <div class="formulario-subir-noticia">
                <h2 class="formulario-subir-noticia__titulo">Registrate</h2>

                <form class="formulario-subir-noticia__formulario" enctype="multipart/form-data"
                    action="subir-noticia.php" method="POST">


                    <div class="formulario-subir-noticia__grupo">
                        <label for="titulo" class="formulario-subir-noticia__etiqueta">Nombres:</label>
                        <input type="text" id="nombreUsu" name="nombreUsu" class="formulario-subir-noticia__input" required>
                    </div>
                    <div class="formulario-subir-noticia__grupo">
                        <label for="titulo" class="formulario-subir-noticia__etiqueta">Apellidos:</label>
                        <input type="text" id="nombreUsu" name="nombreUsu" class="formulario-subir-noticia__input" required>
                    </div>
                    <!-- Campo Nombre usuario -->
                    <div class="formulario-subir-noticia__grupo">
                        <label for="titulo" class="formulario-subir-noticia__etiqueta">Nombre de usuario:</label>
                        <input type="text" id="nombreUsu" name="nombreUsu" class="formulario-subir-noticia__input" required>
                    </div>
                    <div class="formulario-subir-noticia__grupo">
                        <label for="titulo" class="formulario-subir-noticia__etiqueta">Cedula:</label>
                        <input type="number" id="cedula" name="cedula" class="formulario-subir-noticia__input" required>
                    </div>
                    <div class="formulario-subir-noticia__grupo">
                        <label for="titulo" class="formulario-subir-noticia__etiqueta">Clave:</label>
                        <input type="password" id="clave" name="clave" class="formulario-subir-noticia__input" required>
                    </div>



                    <!-- Botones -->
                    <div class="formulario-subir-noticia__grupo formulario-subir-noticia__botones">
                        <button type="submit" class="formulario-subir-noticia__boton-enviar">Registrame</button>
                        <p class="btn-login">¿Ya tienes cuenta? <a href="./login.php" class="link">Iniciar sesion</a></p>
                    </div>
                </form>
            </div>
        </div>

</body>

</html>