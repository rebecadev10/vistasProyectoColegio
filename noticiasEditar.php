<?php include 'componentes/header.php'; ?>
<div class="layout">
  <div class="componente" id="encabezado">
    <div class="componente__encabezado">
      <h2 class="componente__titulo">Lista de Noticias</h2>
      <a href="./formularioNoticias.php" class="componente__boton-subir">Nueva Noticia</a>
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


    <div>
      <h2 class="formulario-subir-noticia__titulo">Editar Noticia</h2>

      <form id="formulario" enctype="multipart/form-data" method="POST">
        <input type="hidden" id="idNoticias" name="idNoticias">
        <input type="hidden" id="imagenProductoActual" name="imagenProductoActual">

        <!-- Campo Título -->
        <div class="formulario-subir-noticia__grupo">
          <label for="titulo" class="formulario-subir-noticia__etiqueta">Título:</label>
          <input type="text" id="titulo" name="titulo" class="formulario-subir-noticia__input" required>
        </div>

        <!-- Campo Descripción -->
        <div class="formulario-subir-noticia__grupo">
          <label for="descripcion" class="formulario-subir-noticia__etiqueta">Descripción:</label>
          <textarea id="descripcion" name="descripcion" class="formulario-subir-noticia__textarea" rows="4"
            required></textarea>
        </div>

        <!-- Sección de Imagen en 2 Columnas: Actual vs Nueva -->
        <div class="form-row-2">
          <div class="formulario-subir-noticia__grupo">
            <label class="formulario-subir-evento__etiqueta">Imagen Actual:</label>
            <div class="preview-imagen-box">
              <img id="imagenActual" alt="Vista previa" class="imgFormulario" style="max-height: 140px;">
            </div>
          </div>

          <div class="formulario-subir-noticia__grupo">
            <label for="imagen" class="formulario-subir-evento__etiqueta">Cambiar Imagen (opcional):</label>
            <div class="formulario-subir-noticia__input-archivo-wrapper">
              <input type="file" id="imagen" name="imagen" class="formulario-subir-noticia__input-archivo"
                accept="image/*">
              <label for="imagen" class="formulario-subir-noticia__input-archivo-boton">
                <i class="fa-solid fa-cloud-arrow-up"></i> Seleccionar archivo
              </label>
              <span id="file-name" class="formulario-subir-noticia__archivo-nombre">Ningún archivo seleccionado</span>
            </div>
          </div>
        </div>


        <!-- Botones -->
        <div class="formulario-subir-noticia__grupo formulario-subir-noticia__botones">
         
          <button type="reset" class="formulario-subir-noticia__boton-cancelar"
            onclick="cancelarform()">Cancelar</button>
            <button type="submit" id="btnGuardar" class="formulario-subir-noticia__boton-enviar">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php require 'componentes/footer.php'; ?>
<script type="text/javascript" src="scripts/noticia.js"></script>