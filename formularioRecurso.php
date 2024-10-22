<?php include 'componentes/header.php'?>
<div class="layout">
<div class="formulario-subir-noticia">
    <h2 class="formulario-subir-noticia__titulo">Publicar Nuevo Recurso</h2>

    <form class="formulario-subir-noticia__formulario" enctype="multipart/form-data" action="subir-noticia.php" method="POST">
        <!-- Campo Título -->
        <div class="formulario-subir-noticia__grupo">
            <label for="titulo" class="formulario-subir-noticia__etiqueta">Título:</label>
            <input type="text" id="titulo" name="titulo" class="formulario-subir-noticia__input" required>
        </div>

        <!-- Campo Descripción -->
        <div class="formulario-subir-noticia__grupo">
            <label for="descripcion" class="formulario-subir-noticia__etiqueta">Descripción:</label>
            <textarea id="descripcion" name="descripcion" class="formulario-subir-noticia__textarea" rows="5" required></textarea>
        </div>
        <div class="formulario-subir-noticia__grupo">
            <label for="titulo" class="formulario-subir-noticia__etiqueta">Autor:</label>
            <input type="text" id="autor" name="autor" class="formulario-subir-noticia__input" required>
        </div>

        <!-- Campo Fecha -->
        <div class="formulario-subir-noticia__grupo">
            <label for="fecha" class="formulario-subir-noticia__etiqueta">Fecha:</label>
            <input type="date" id="fecha" name="fecha" class="formulario-subir-noticia__input" required>
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
        <div class="formulario-subir-noticia__grupo formulario-subir-noticia__botones">
            <button type="submit" class="formulario-subir-noticia__boton-enviar">Publicar Recurso</button>
            <button type="reset" class="formulario-subir-noticia__boton-cancelar">Cancelar</button>
        </div>
    </form>
</div>
<?php require 'componentes/footer.php' ?>
