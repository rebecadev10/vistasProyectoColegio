<?php include 'componentes/header.php'; ?>
<div class="layout">
  <div class="componente" id="encabezado">
    <div class="componente__encabezado" >
      <h2 class="componente__titulo">Lista de Eventos</h2>
      <a href="./formularioEvento.php" class="componente__boton-subir">Publicar Nuevo Evento</a>
    </div>

    <div class="componente__contenedor-tabla" id="listadoregistros">
      <table id="tbllistado" >
        <thead >
          <tr class=" componente__fila--encabezado">
            <th class="componente__encabezado-tabla">Opción</th>
            <th class="componente__encabezado-tabla">Título</th>
            <th class="componente__encabezado-tabla">Departamento</th>
            <th class="componente__encabezado-tabla">Inicio de evento</th>
            <th class="componente__encabezado-tabla">Hora de apertura</th>
            <th class="componente__encabezado-tabla">Fin del Evento</th>
            <th class="componente__encabezado-tabla">Hora de cierre</th>
          </tr>
        </thead>
        <tbody >


        </tbody>
      </table>
    </div>
  </div>
  <div class="formulario-subir-noticia" id="formularioregistros">
    <h2 class="formulario-subir-noticia__titulo">Editar Evento</h2>

    <form id="formulario" class="formulario-subir-evento__formulario" enctype="multipart/form-data" method="POST">
      <!-- Campo ID e Imagen Actual (ocultos) -->
      <input type="hidden" id="idEventos" name="idEventos">
      <input type="hidden" id="imagenProductoActual" name="imagenProductoActual">

      <!-- Campo Tema -->
      <div class="formulario-subir-noticia__grupo">
        <label for="titulo" class="formulario-subir-evento__etiqueta">Tema:</label>
        <input type="text" id="titulo" name="titulo" class="formulario-subir-noticia__input" required>
      </div>

      <!-- Campo Descripción -->
      <div class="formulario-subir-noticia__grupo">
        <label for="descripcion" class="formulario-subir-evento__etiqueta">Descripción:</label>
        <textarea id="descripcion" name="descripcion" class="formulario-subir-evento__textarea" rows="4"
          required></textarea>
      </div>

      <!-- Campo Departamento -->
      <div class="formulario-subir-noticia__grupo">
        <label for="departamentoDescripcion" class="formulario-subir-evento__etiqueta">Departamento:</label>
        <input type="hidden" id="departamento" name="departamento">
        <input type="text" class="formulario-subir-noticia__input" name="departamentoDescripcion" id="departamentoDescripcion" disabled>
      </div>

      <!-- Fechas y Horas en 2 Columnas -->
      <div class="form-row-2">
        <div class="formulario-subir-noticia__grupo">
          <label for="fechaInicio" class="formulario-subir-evento__etiqueta">Fecha de Inicio:</label>
          <input type="date" id="fechaInicio" name="fechaInicio" class="formulario-subir-noticia__input" required>
        </div>

        <div class="formulario-subir-noticia__grupo">
          <label for="horaInicio" class="formulario-subir-evento__etiqueta">Hora de Inicio:</label>
          <input type="time" id="horaInicio" name="horaInicio" class="formulario-subir-noticia__input" required>
        </div>
      </div>

      <div class="form-row-2">
        <div class="formulario-subir-noticia__grupo">
          <label for="fechaFin" class="formulario-subir-evento__etiqueta">Fecha de Fin:</label>
          <input type="date" id="fechaFin" name="fechaFin" class="formulario-subir-noticia__input" required>
        </div>

        <div class="formulario-subir-noticia__grupo">
          <label for="horaFin" class="formulario-subir-evento__etiqueta">Hora de Fin:</label>
          <input type="time" id="horaFin" name="horaFin" class="formulario-subir-noticia__input" required>
        </div>
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
      <div class="formulario-subir-noticia__grupo formulario-subir-evento__botones">
        <button type="reset" class="formulario-subir-noticia__boton-cancelar" onclick="cancelarform()">Cancelar</button>
        <button type="submit" id="btnGuardar" class="formulario-subir-noticia__boton-enviar">Guardar</button>
      </div>
    </form>

  </div>
</div>

<?php require 'componentes/footer.php'; ?>
<script type="text/javascript" src="scripts/evento.js"></script>