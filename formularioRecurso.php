<?php include 'componentes/header.php'?>
<div class="layout">
<div class="formulario-subir-noticia">
    <h2 class="formulario-subir-noticia__titulo">Publicar Nuevo Recurso</h2>

    <form id="formulario" class="formulario-subir-noticia__formulario" enctype="multipart/form-data"  method="POST">
        <!-- Campo Título -->
        <div class="formulario-subir-noticia__grupo">
            <label for="titulo" class="formulario-subir-noticia__etiqueta">Título:</label>
            <input type="hidden" id="idRecursos" name="idRecursos">
            <input type="text" id="tituloRecurso" name="tituloRecurso" class="formulario-subir-noticia__input" required>
        </div>

        <!-- Campo Descripción -->
        <div class="formulario-subir-noticia__grupo">
            <label for="descripcion" class="formulario-subir-noticia__etiqueta">Descripción:</label>
            <textarea id="descripcion" name="descripcion" class="formulario-subir-noticia__textarea" rows="5" required></textarea>
        </div>
        <!-- Autor y Editorial en 2 Columnas -->
        <div class="form-row-2">
            <div class="formulario-subir-noticia__grupo">
                <label for="autor" class="formulario-subir-noticia__etiqueta">Autor:</label>
                <input type="text" id="autor" name="autor" class="formulario-subir-noticia__input" required>
            </div>
            <div class="formulario-subir-noticia__grupo">
                <label for="editorial" class="formulario-subir-noticia__etiqueta">Editorial:</label>
                <input type="text" id="editorial" name="editorial" class="formulario-subir-noticia__input" required>
            </div>
        </div>

        <!-- Fecha y Departamento en 2 Columnas -->
        <div class="form-row-2">
            <div class="formulario-subir-noticia__grupo">
                <label for="fechaPublicacion" class="formulario-subir-noticia__etiqueta">Fecha de Publicación:</label>
                <input type="date" id="fechaPublicacion" name="fechaPublicacion" class="formulario-subir-noticia__input" required>
            </div>
            <div class="formulario-subir-noticia__grupo">
                <label for="departamento" class="formulario-subir-noticia__etiqueta">Departamento:</label>
                <select id="departamento" class="formulario-subir-noticia__input selectpicker" name="departamento" data-live-search="true"></select>
            </div>
        </div>

        <!-- Archivos en 2 Columnas -->
        <div class="form-row-2">
            <div class="formulario-subir-noticia__grupo">
                <label for="imagen" class="formulario-subir-noticia__etiqueta">Imagen Portada:</label>
                <div class="formulario-subir-noticia__input-archivo-wrapper">
                    <input type="file" id="imagen" name="imagen" class="formulario-subir-noticia__input-archivo" accept="image/*" required>
                    <label for="imagen" class="formulario-subir-noticia__input-archivo-boton">
                        <i class="fa-solid fa-image"></i> Seleccionar portada
                    </label>
                    <span id="file-name" class="formulario-subir-noticia__archivo-nombre">Ningún archivo seleccionado</span>
                </div>
            </div>

            <div class="formulario-subir-noticia__grupo">
                <label for="recurso" class="formulario-subir-noticia__etiqueta">Documento / Archivo:</label>
                <div class="formulario-subir-noticia__input-archivo-wrapper">
                    <input type="file" id="recurso" name="recurso" class="formulario-subir-noticia__input-archivo" required>
                    <label for="recurso" class="formulario-subir-noticia__input-archivo-boton">
                        <i class="fa-solid fa-file-arrow-up"></i> Seleccionar documento
                    </label>
                    <span id="file-name-recurso" class="formulario-subir-noticia__archivo-nombre">Ningún archivo seleccionado</span>
                </div>
            </div>
        </div>


        <!-- Botones -->
        <div class=" formulario-subir-noticia__botones">
            
            <button type="reset" class="formulario-subir-noticia__boton-cancelar" onclick="cancelar()">Cancelar</button>
            <button type="submit" class="formulario-subir-noticia__boton-enviar">Publicar</button>
        </div>
    </form>
</div>
<?php require 'componentes/footer.php' ?>
<script type="text/javascript" src="./scripts/recurso.js"></script>