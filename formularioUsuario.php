<?php include 'componentes/header.php' ;
$idPermiso=1;?>
<div class="layout">
    <div class="formulario-subir-noticia">
        <h2 class="formulario-subir-noticia__titulo">Registrar Nuevo Usuario</h2>

   
        <form id="formulario" class="formulario-subir-noticia__formulario" enctype="multipart/form-data"
                     method="POST">


                    <div class="formulario-subir-noticia__grupo">
                    <input type="hidden" id="idUsuario" name="idUsuario">
                    <!-- <input type="hidden" id="permisos" name="idPermiso" value=""> -->
                        <label for="titulo" class="formulario-subir-noticia__etiqueta">Nombres:</label>
                        <input type="text" id="nombre" name="nombre" class="formulario-subir-noticia__input" required>
                    </div>
                    <div class="formulario-subir-noticia__grupo">
                        <label for="titulo" class="formulario-subir-noticia__etiqueta">Apellidos:</label>
                        <input type="text" id="apellido" name="apellido" class="formulario-subir-noticia__input" required>
                    </div>
                  
                    <div class="formulario-subir-noticia__grupo">
                        <label for="titulo" class="formulario-subir-noticia__etiqueta">Cedula:</label>
                        <input type="number" id="cedula" name="cedula" class="formulario-subir-noticia__input" required>
                    </div>
                    <div class="formulario-subir-noticia__grupo">
                        <label for="titulo" class="formulario-subir-noticia__etiqueta">Clave:</label>
                        <input type="password" id="clave" name="clave" class="formulario-subir-noticia__input" required>
                    </div>
                    <label>Permisos:</label>
                        <ul style="list-style: none;" id="permisos">
                        </ul>
                     <!-- Campo Imagen -->
            <div class="formulario-subir-noticia__grupo">
                <label for="imagen" class="formulario-subir-noticia__etiqueta">Foto de perfil:</label>
                <div class="formulario-subir-noticia__input-archivo-wrapper">
                <input type="file" id="imagen" name="imagen" class="formulario-subir-noticia__input-archivo" accept="image/*" required>
                <label for="imagen" class="formulario-subir-noticia__input-archivo-boton">Seleccionar archivo</label>
                <span id="file-name" class="formulario-subir-noticia__archivo-nombre">Ningún archivo seleccionado</span>
            </div>
            </div>


                    <!-- Botones -->
                    <div class="formulario-subir-noticia__grupo formulario-subir-noticia__botones">
                        <button type="submit" class="formulario-subir-noticia__boton-enviar">Registrar Usuario</button>
                        <button type="reset" class="formulario-subir-noticia__boton-cancelar">Cancelar</button>
                    </div>
                </form>
    </div>
    <?php require 'componentes/footer.php' ?>
    <script type="text/javascript" src="./scripts/usuario.js"></script>