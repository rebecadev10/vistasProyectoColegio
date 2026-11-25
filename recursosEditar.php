<?php include 'componentes/header.php' ?>
<div class="layout">
  <div class="componente" id="encabezado">
    <div class="componente__encabezado">
      <h2 class="componente__titulo">Lista de Recursos</h2>
      <a href="./formularioRecurso.php" class="componente__boton-subir">Publicar Nuevo Recurso</a>
    </div>

    <div class="componente__contenedor-tabla" id="listadoregistros">
      <table id="tbllistado"  style="width:100%">
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
    <h2 class="formulario-subir-noticia__titulo">Actualizar Recurso</h2>


    <form id="formulario" class="formulario-subir-noticia__formulario" enctype="multipart/form-data" method="POST">
      <input type="hidden" id="idRecursos" name="idRecursos">
      <input type="hidden" id="imagenProductoActual" name="imagenProductoActual">

      <!-- Campo Título -->
      <div class="formulario-subir-noticia__grupo">
        <label for="tituloRecurso" class="formulario-subir-noticia__etiqueta">Título:</label>
        <input type="text" id="tituloRecurso" name="tituloRecurso" class="formulario-subir-noticia__input" required>
      </div>

      <!-- Campo Descripción -->
      <div class="formulario-subir-noticia__grupo">
        <label for="descripcion" class="formulario-subir-noticia__etiqueta">Descripción:</label>
        <textarea id="descripcion" name="descripcion" class="formulario-subir-noticia__textarea" rows="4"
          required></textarea>
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
          <label for="departamento" class="formulario-subir-evento__etiqueta">Departamento:</label>
          <select id="departamento" class="formulario-subir-noticia__input selectpicker" name="departamento" data-live-search="true"></select>
        </div>
      </div>

      <!-- Imagen Actual y Cambiar Imagen en 2 Columnas -->
      <div class="form-row-2">
        <div class="formulario-subir-noticia__grupo">
          <label class="formulario-subir-evento__etiqueta">Imagen Actual:</label>
          <div class="preview-imagen-box">
            <img id="imagenActual" alt="Vista previa de portada" class="imgFormulario" style="max-height: 140px;">
          </div>
        </div>

        <div class="formulario-subir-noticia__grupo">
          <label for="imagen" class="formulario-subir-evento__etiqueta">Cambiar Portada (opcional):</label>
          <div class="formulario-subir-noticia__input-archivo-wrapper">
            <input type="file" id="imagen" name="imagen" class="formulario-subir-noticia__input-archivo" accept="image/*">
            <label for="imagen" class="formulario-subir-noticia__input-archivo-boton">
              <i class="fa-solid fa-cloud-arrow-up"></i> Seleccionar archivo
            </label>
            <span id="file-name" class="formulario-subir-noticia__archivo-nombre">Ningún archivo seleccionado</span>
          </div>
        </div>
      </div>

      <div class="formulario-subir-noticia__grupo">
        <label for="recursoActual" class="formulario-subir-evento__etiqueta">Recurso Actual:</label>
        <input type="text" id="recursoActual" class="formulario-subir-noticia__input" readonly>
      </div>

      <!-- Botones -->
      <div class="formulario-subir-noticia__grupo formulario-subir-noticia__botones">
        <button type="reset" class="formulario-subir-noticia__boton-cancelar" onclick="cancelarform()">Cancelar</button>
        <button type="submit" id="btnGuardar" class="formulario-subir-noticia__boton-enviar">Actualizar Recurso</button>
      </div>
    </form>
  </div>
</div>
</div>
<?php require 'componentes/footer.php' ?>
<script type="text/javascript" src="scripts/recurso.js"></script>