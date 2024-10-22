<?php include 'componentes/header.php' ?>
<div class="layout">
    <div class="formulario-subir-noticia">
        <h2 class="formulario-subir-noticia__titulo">Registrar Nuevo Usuario</h2>

   
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
                        <button type="submit" class="formulario-subir-noticia__boton-enviar">Registrar Usuario</button>
                        <button type="reset" class="formulario-subir-noticia__boton-cancelar">Cancelar</button>
                    </div>
                </form>
    </div>
    <?php require 'componentes/footer.php' ?>