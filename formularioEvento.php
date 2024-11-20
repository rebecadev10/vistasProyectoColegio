<?php include 'componentes/header.php'?>
<!--  <div class="formulario-subir-noticia__grupo">
            <label for="titulo" class="formulario-subir-noticia__etiqueta">Tema:</label>
            <input type="text" id="titulo" name="titulo" class="formulario-subir-noticia__input" required>
        </div> -->
<div class="layout">
<div class="formulario-subir-noticia">
    <h2 class="formulario-subir-noticia__titulo">Publicar Nuevo Evento</h2>

    <form id="formulario" class="formulario-subir-evento__formulario" enctype="multipart/form-data" method="POST">
            <!-- Campo ID (oculto) -->
            <input type="hidden" id="idEventos" name="idEventos">

            <!-- Campo Tema -->
            <div class="formulario-subir-noticia__grupo">
                <label for="titulo" class="formulario-subir-evento__etiqueta">Tema:</label>
                <input type="text" id="titulo" name="titulo" class="formulario-subir-noticia__input" required>
            </div>

            <!-- Campo Descripción -->
            <div class="formulario-subir-noticia__grupo">
                <label for="descripcion" class="formulario-subir-evento__etiqueta">Descripción:</label>
                <textarea id="descripcion" name="descripcion" class="formulario-subir-evento__textarea" rows="5" required></textarea>
            </div>

            <!-- Campo Departamento -->
            <div class="formulario-subir-noticia__grupo">
                <label for="departamento" class="formulario-subir-evento__etiqueta">Departamento:</label>
                <select id="departamento" class="formulario-subir-noticia__input selectpicker" name="departamento"  data-live-search="true" ></select>
  
                <!-- <input type="text" id="departamento" name="departamento" class="formulario-subir-noticia__input" required> -->
            </div>

            <!-- Campo Fecha Inicio -->
            <div class="formulario-subir-noticia__grupo">
                <label for="fechaInicio" class="formulario-subir-evento__etiqueta">Fecha de Inicio:</label>
                <input type="date" id="fechaInicio" name="fechaInicio" class="formulario-subir-noticia__input" required>
            </div>

            <!-- Campo Hora Inicio -->
            <div class="formulario-subir-noticia__grupo">
                <label for="horaInicio" class="formulario-subir-evento__etiqueta">Hora de Inicio:</label>
                <input type="time" id="horaInicio" name="horaInicio" class="formulario-subir-noticia__input" required>
            </div>

            <!-- Campo Fecha Fin -->
            <div class="formulario-subir-noticia__grupo">
                <label for="fechaFin" class="formulario-subir-evento__etiqueta">Fecha de Fin:</label>
                <input type="date" id="fechaFin" name="fechaFin" class="formulario-subir-noticia__input" required>
            </div>

            <!-- Campo Hora Fin -->
            <div class="formulario-subir-noticia__grupo">
                <label for="horaFin" class="formulario-subir-evento__etiqueta">Hora de Fin:</label>
                <input type="time" id="horaFin" name="horaFin" class="formulario-subir-noticia__input" required>
            </div>

            <!-- Campo Imagen -->
            <div class="formulario-subir-noticia__grupo">
                <label for="imagen" class="formulario-subir-evento__etiqueta">Subir Imagen:</label>
                <input type="file" id="imagen" name="imagen" class="formulario-subir-noticia__input">
                <!-- Campo oculto para la imagen actual (usado en edición) -->
                <input type="hidden" id="imagenProductoActual" name="imagenProductoActual">
            </div>

            <!-- Botones -->
            <div class="formulario-subir-noticia__grupo formulario-subir-evento__botones">
                <button type="submit" id="btnGuardar" class="formulario-subir-noticia__boton-enviar">Guardar</button>
                <button type="reset" class="formulario-subir-noticia__boton-cancelar">Cancelar</button>
            </div>
        </form>

</div>
<?php require 'componentes/footer.php' ?>
<script type="text/javascript" src="./scripts/evento.js"></script>



