<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña — Colegio Manuel Díaz Rodríguez</title>
    
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
            <img src="./public/img/contenido/4.jpg" alt="Orientación Estudiantil">
        </div>
        <div class="area2">
            <div class="formulario__card">
                <div class="logo">
                    <img src="./public/img/logos/logo.jpeg" alt="Logo Colegio">
                </div>
                <div class="formulario" style="width: 100%;">
                    <h2 class="formulario__titulo">Recuperar Acceso</h2>
                    <p style="font-size: 13.5px; color: var(--slate-600); text-align: center; margin-bottom: 20px;">
                        Ingresa el correo electrónico o cédula registrada para restablecer tus credenciales.
                    </p>

                    <form method="POST">
                        <div class="formulario__grupo">
                            <label for="email" class="formulario__etiqueta"><i class="fa-solid fa-envelope" style="color: var(--brand-primary);"></i> Correo o Cédula:</label>
                            <input type="email" id="email" name="email" class="formulario__input" placeholder="correo@ejemplo.com" required>
                        </div>

                        <div class="formulario__botones" style="flex-direction: column;">
                            <button type="submit" class="formulario__enviar">
                                <span>Enviar Enlace de Recuperación</span>
                                <i class="fa-solid fa-paper-plane"></i>
                            </button>
                            <p class="btn-login">¿Recordaste tu contraseña? <a href="index.html" class="link">Iniciar sesión</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
