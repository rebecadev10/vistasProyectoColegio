<?php include 'componentes/header.php' ?>
<div class="layout">
  <div class="componente" id="encabezado">
    <div class="componente__encabezado">
      <h2 class="componente__titulo">Lista de Recursos</h2>
      <button class="componente__boton-subir"><a href="./formularioRecurso.php"> Publicar Nuevo Recurso</a></button>
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
      <!-- Campo Título -->
      <div class="formulario-subir-noticia__grupo">
        <label for="titulo" class="formulario-subir-noticia__etiqueta">Título:</label>
        <input type="hidden" id="idRecursos" name="idRecursos">
        <input type="text" id="tituloRecurso" name="tituloRecurso" class="formulario-subir-noticia__input" required>
      </div>

      <!-- Campo Descripción -->
      <div class="formulario-subir-noticia__grupo">
        <label for="descripcion" class="formulario-subir-noticia__etiqueta">Descripción:</label>
        <textarea id="descripcion" name="descripcion" class="formulario-subir-noticia__textarea" rows="5"
          required></textarea>
      </div>
      <div class="formulario-subir-noticia__grupo">
        <label for="autor" class="formulario-subir-noticia__etiqueta">Autor:</label>
        <input type="text" id="autor" name="autor" class="formulario-subir-noticia__input" required>
      </div>

      <!-- Campo Fecha -->
      <div class="formulario-subir-noticia__grupo">
        <label for="fecha" class="formulario-subir-noticia__etiqueta">Fecha:</label>
        <input type="date" id="fechaPublicacion" name="fechaPublicacion" class="formulario-subir-noticia__input"
          required>
      </div>
      <div class="formulario-subir-noticia__grupo">
        <label for="editorial" class="formulario-subir-noticia__etiqueta">Editorial:</label>
        <input type="text" id="editorial" name="editorial" class="formulario-subir-noticia__input" required>
      </div>

      <!-- Campo Departamento -->
      <div class="formulario-subir-noticia__grupo">
        <label for="departamento" class="formulario-subir-evento__etiqueta">Departamento:</label>
        <select id="departamento" class="formulario-subir-noticia__input selectpicker" name="departamento"
          data-live-search="true"></select>

        <!-- <input type="text" id="departamento" name="departamento" class="formulario-subir-noticia__input" required> -->
      </div>

      <!-- Campo Imagen con estilo personalizado -->
      <!-- <div class="formulario-subir-noticia__grupo">
    <label for="imagen" class="formulario-subir-noticia__etiqueta">Imagen Portada:</label>
    <div class="formulario-subir-noticia__input-archivo-wrapper">
        <input type="file" id="imagen" name="imagen" class="formulario-subir-noticia__input-archivo" accept="image/*" required>
        <label for="imagen" class="formulario-subir-noticia__input-archivo-boton">Seleccionar archivo</label>
        <span id="file-name" class="formulario-subir-noticia__archivo-nombre">Ningún archivo seleccionado</span>
    </div>
</div> -->
      <div class="formulario-subir-noticia__grupo">
        <label for="imagen" class="formulario-subir-evento__etiqueta"> Imagen Actual:</label>
        <img id="imagenActual" alt="" class="imgFormulario">

      </div>
      <div class="formulario-subir-noticia__grupo">
        <label for="recurso" class="formulario-subir-evento__etiqueta"> Recurso Actual:</label>
        <input type="text" id="recursoActual" class="formulario-subir-noticia__input" required>

      </div>



      <!-- Botones -->
      <div class="formulario-subir-noticia__grupo formulario-subir-noticia__botones">
        <button type="submit" class="formulario-subir-noticia__boton-enviar">Actualizar Recurso</button>
        <button type="reset" class="formulario-subir-noticia__boton-cancelar" onclick="cancelar()">Cancelar</button>
      </div>
    </form>
  </div>
</div>
</div>
<?php require 'componentes/footer.php' ?>
<script type="text/javascript" src="scripts/recurso.js"></script>