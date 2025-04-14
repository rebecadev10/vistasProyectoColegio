<?php include 'componentes/header.php' ?>
<div class="layout">
  <div class="componente" id="encabezado">
    <div class="componente__encabezado">
      <h2 class="componente__titulo">Usuarios Registrados</h2>
      <!-- <button class="componente__boton-subir"><a href="./formularioUsuario.php"> Crear nuevo usuario</a></button> -->
    </div>

    <div class="componente__contenedor-tabla" id="listadoregistros">
      <table id="tbllistado" class="  style="width:100%">
        <thead style="width:100%">
          <tr class="componente__fila--encabezado">
            <th class="componente__encabezado-tabla">Opción</th>
            <th class="componente__encabezado-tabla">Nombre</th>
            <th class="componente__encabezado-tabla">cedula</th>

          </tr>
        </thead>
        <tbody>


        </tbody>
      </table>
    </div>
  </div>
  <div class="formulario-subir-noticia" id="formularioregistros">
    <h2 class="formulario-subir-noticia__titulo">Actualizar Usuario</h2>
    <form id="formulario" class="formulario-subir-noticia__formulario" enctype="multipart/form-data" method="POST">


      <div class="formulario-subir-noticia__grupo">
        <input type="hidden" id="idUsuario" name="idUsuario">
        <!-- <input type="hidden" id="permisos" name="idPermiso" value=""> -->
        <label for="titulo" class="formulario-subir-noticia__etiqueta">Nombres:</label>
        <input type="text" id="nombre" name="nombre" class="formulario-subir-noticia__input" required>
      </div>
      <div class="formulario-subir-noticia__grupo">
        <label for="titulo" class="formulario-subir-noticia__etiqueta">Apellidos:</label>
        <input type="text" id="apellido" name="apellido" class="formulario-subir-noticia__input" required>
      </div>

      <div class="formulario-subir-noticia__grupo">
        <label for="titulo" class="formulario-subir-noticia__etiqueta">Cedula:</label>
        <input type="number" id="cedula" name="cedula" class="formulario-subir-noticia__input" required>
      </div>
     
      <label>Permisos:</label>
      <ul style="list-style: none;" id="permisos">
      </ul>
      <!-- Campo Imagen -->
 


      <!-- Botones -->
      <div class="formulario-subir-noticia__botones">

        <button type="reset" class="formulario-subir-noticia__boton-cancelar" onclick="cancelarform()">Cancelar</button>
        <button type="submit" class="formulario-subir-noticia__boton-enviar">Actualizar</button>
      </div>
    </form>
  </div>
</div>
<?php require 'componentes/footer.php' ?>
<script type="text/javascript" src="scripts/usuario.js"></script>