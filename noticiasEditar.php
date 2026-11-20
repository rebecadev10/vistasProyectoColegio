<?php include 'componentes/header.php'; ?>
<div class="layout">
  <div class="componente" id="encabezado">
    <div class="componente__encabezado">
      <h2 class="componente__titulo">Lista de Noticias</h2>
      <button class="componente__boton-subir">
        <a href="./formularioNoticias.php">Nueva Noticia</a>
      </button>
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
        <!-- Campo Título -->
        <div class="formulario-subir-noticia__grupo">
          <label for="titulo" class="formulario-subir-noticia__etiqueta">Título:</label>
          <input type="hidden" id="idNoticias" name="idNoticias">
          <input type="text" id="titulo" name="titulo" class="formulario-subir-noticia__input" required>
        </div>

        <!-- Campo Descripción -->
        <div class="formulario-subir-noticia__grupo">
          <label for="descripcion" class="formulario-subir-noticia__etiqueta">Descripción:</label>
          <textarea id="descripcion" name="descripcion" class="formulario-subir-noticia__textarea" rows="5"
            required></textarea>
        </div>



        <!-- Campo Imagen con estilo personalizado -->
        <div class="formulario-subir-noticia__grupo">
          <label for="imagen" class="formulario-subir-evento__etiqueta"> Imagen Actual:</label>
          <img id="imagenActual" alt="" class="imgFormulario">

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