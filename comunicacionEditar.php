<?php include 'componentes/header.php'; ?>
<div class="layout">
  <div class="componente" id="encabezado">
    <div class="componente__encabezado">
      <h2 class="componente__titulo">Listado de Anuncios</h2>
      <button class="componente__boton-subir">
        <a href="./formularioAnuncio.php">Nuevo Anuncio</a>
      </button>
    </div>

    <div class="componente__contenedor-tabla" id="listadoregistros">
      <table id="tbllistado" class=" componente__tabla" style="width:100%">
        <thead style="width:100%">
          <tr class=" componente__fila--encabezado">
            <th class="componente__encabezado-tabla">Opción</th>
            <th class="componente__encabezado-tabla">Título</th>
            <th class="componente__encabezado-tabla">Descripcion</th>
          </tr>
        </thead>
        <tbody>


        </tbody>
      </table>
    </div>
  </div>
  <div class="formulario-subir-noticia" id="formularioregistros">
    <h2 class="formulario-subir-noticia__titulo">Nuevo Anuncio</h2>

    <div class="formulario-subir-noticia">
      <h2 class="formulario-subir-noticia__titulo">Publicar Nuevo Anuncio</h2>
      <form class="formulario-subir-noticia__formulario" enctype="multipart/form-data" method="POST">
        <div class="formulario-subir-noticia__grupo">
          <label for="titulo" class="formulario-subir-noticia__etiqueta">Título:</label>
          <input type="hidden" id="idAnuncio" name="idAnuncio">
          <input type="text" id="asunto" name="asunto" class="formulario-subir-noticia__input" required>
        </div>

        <!-- Campo Descripción -->
        <div class="formulario-subir-noticia__grupo">
          <label for="descripcion" class="formulario-subir-noticia__etiqueta">Descripción:</label>
          <textarea id="descripcion" name="descripcion" class="formulario-subir-noticia__textarea" rows="5"
            required></textarea>
        </div>

        <!-- Campo Imagen con estilo personalizado -->
        <div class="formulario-subir-noticia__grupo">
          <label for="imagen" class="formulario-subir-noticia__etiqueta">Imagen:</label>
          <div class="formulario-subir-noticia__input-archivo-wrapper">
            <input type="file" id="imagen" name="imagen" class="formulario-subir-noticia__input-archivo"
              accept="image/*" required>
            <label for="imagen" class="formulario-subir-noticia__input-archivo-boton">Seleccionar
              archivo</label>
            <span id="file-name" class="formulario-subir-noticia__archivo-nombre">Ningún archivo
              seleccionado</span>
          </div>
        </div>


        <!-- Botones -->
        <div class="formulario-subir-noticia__grupo formulario-subir-noticia__botones">
          <button type="submit" class="formulario-subir-noticia__boton-enviar">Publicar Anuncio</button>
          <button type="reset" class="formulario-subir-noticia__boton-cancelar" onclick="cancelar()">Cancelar</button>
        </div>
      </form>
    </div>
  </div>
  </div>
  <?php require 'componentes/footer.php'; ?>
<script type="text/javascript" src="scripts/comunicacion.js"></script>