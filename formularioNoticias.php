<?php include 'componentes/header.php'?>
<div class="layout">
<div class="formulario-subir-noticia">
    <h2 class="formulario-subir-noticia__titulo">Publicar Nueva Noticia</h2>

    <form id="formulario" class="formulario-subir-noticia__formulario" enctype="multipart/form-data" method="POST">
        <!-- Campo Título -->
        <div class="formulario-subir-noticia__grupo">
            <label for="titulo" class="formulario-subir-noticia__etiqueta">Título:</label>
            <input type="hidden" id="idNoticias" name="idNoticias">
            <input type="text" id="titulo" name="titulo" class="formulario-subir-noticia__input" required>
        </div>

        <!-- Campo Descripción -->
        <div class="formulario-subir-noticia__grupo">
            <label for="descripcion" class="formulario-subir-noticia__etiqueta">Descripción:</label>
            <textarea id="descripcion" name="descripcion" class="formulario-subir-noticia__textarea" rows="5" required></textarea>
        </div>

       

        <!-- Campo Imagen con estilo personalizado -->
<div class="formulario-subir-noticia__grupo">
    <label for="imagen" class="formulario-subir-noticia__etiqueta">Imagen:</label>
    <div class="formulario-subir-noticia__input-archivo-wrapper">
        <input type="file" id="imagen" name="imagen" class="formulario-subir-noticia__input-archivo" accept="image/*" required>
        <label for="imagen" class="formulario-subir-noticia__input-archivo-boton">Seleccionar archivo</label>
        <span id="file-name" class="formulario-subir-noticia__archivo-nombre">Ningún archivo seleccionado</span>
    </div>
</div>


        <!-- Botones -->
        <div class=" formulario-subir-noticia__botones">
            
            <button type="reset" class="formulario-subir-noticia__boton-cancelar"onclick="cancelar()">Cancelar</button>
            <button type="submit"  id="btnGuardar"  class="formulario-subir-noticia__boton-enviar">Publicar Noticia</button>
        </div>
    </form>
</div>
<?php require 'componentes/footer.php' ?>
<script type="text/javascript" src="./scripts/noticia.js"></script>