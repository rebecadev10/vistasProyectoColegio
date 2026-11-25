<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario — Colegio Manuel Díaz Rodríguez</title>
    
    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- FontAwesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="./public/css/base/base.css">
    <link rel="stylesheet" href="./public/css/general/formulario.css">
    <link rel="stylesheet" href="./public/css/general/autenticacion.css">
</head>

<body>
    <div class="contenedorAutenticacion">
        <div class="area1">
            <img src="./public/img/contenido/3.jpg" alt="Comunidad Estudiantil">
        </div>
        <div class="area2">
            <div class="formulario__card">
                <div class="logo">
                    <img src="./public/img/logos/logo.jpeg" alt="Logo Colegio">
                </div>
                <div class="formulario" style="width: 100%;">
                    <h2 class="formulario__titulo">Crear Cuenta</h2>

                    <form id="formulario" method="POST">
                        <input type="hidden" id="idUsuario" name="idUsuario">

                        <div class="formulario__grupo">
                            <label for="nombre" class="formulario__etiqueta"><i class="fa-solid fa-user" style="color: var(--brand-primary);"></i> Nombres:</label>
                            <input type="text" id="nombre" name="nombre" class="formulario__input" placeholder="Ej: Carlos Eduardo" required>
                        </div>

                        <div class="formulario__grupo">
                            <label for="apellido" class="formulario__etiqueta"><i class="fa-solid fa-user-group" style="color: var(--brand-primary);"></i> Apellidos:</label>
                            <input type="text" id="apellido" name="apellido" class="formulario__input" placeholder="Ej: González Pérez" required>
                        </div>

                        <div class="formulario__grupo">
                            <label for="cedula" class="formulario__etiqueta"><i class="fa-solid fa-id-card" style="color: var(--brand-primary);"></i> Cédula:</label>
                            <input type="number" id="cedula" name="cedula" class="formulario__input" placeholder="Ej: 30123456" required>
                        </div>

                        <div class="formulario__grupo">
                            <label for="clave" class="formulario__etiqueta"><i class="fa-solid fa-lock" style="color: var(--brand-primary);"></i> Contraseña:</label>
                            <input type="password" id="clave" name="clave" class="formulario__input" placeholder="Mínimo 6 caracteres" required>
                        </div>

                        <!-- Botones -->
                        <div class="formulario__botones">
                            <button type="submit" id="btnGuardar" class="formulario__enviar">
                                <span>Registrarse</span>
                                <i class="fa-solid fa-check"></i>
                            </button>
                            <button type="reset" class="formulario__cancelar"><a href="index.html">Cancelar</a></button>
                        </div>
                        <p class="btn-login" style="margin-top: 16px;">¿Ya tienes cuenta? <a href="index.html" class="link">Inicia sesión</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script type="text/javascript" src="scripts/usuario.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
