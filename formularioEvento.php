<?php include 'componentes/header.php'?>
<div class="layout">
<div class="formulario-subir-noticia">
    <h2 class="formulario-subir-noticia__titulo">Publicar Nuevo Evento</h2>

    <form class="formulario-subir-noticia__formulario" enctype="multipart/form-data" action="subir-noticia.php" method="POST">
        <!-- Campo Título -->
        <div class="formulario-subir-noticia__grupo">
            <label for="titulo" class="formulario-subir-noticia__etiqueta">Tema:</label>
            <input type="text" id="titulo" name="titulo" class="formulario-subir-noticia__input" required>
        </div>

        <!-- Campo Descripción -->
        <div class="formulario-subir-noticia__grupo">
            <label for="descripcion" class="formulario-subir-noticia__etiqueta">Descripción:</label>
            <textarea id="descripcion" name="descripcion" class="formulario-subir-noticia__textarea" rows="5" required></textarea>
        </div>
       

        <!-- Campo Fecha -->
        <div class="formulario-subir-noticia__grupo">
            <label for="fecha" class="formulario-subir-noticia__etiqueta">Fecha:</label>
            <input type="date" id="fecha" name="fecha" class="formulario-subir-noticia__input" required>
        </div>




        <!-- Botones -->
        <div class="formulario-subir-noticia__grupo formulario-subir-noticia__botones">
            <button type="submit" class="formulario-subir-noticia__boton-enviar">Publicar Evento</button>
            <button type="reset" class="formulario-subir-noticia__boton-cancelar">Cancelar</button>
        </div>
    </form>
</div>
<?php require 'componentes/footer.php' ?>
