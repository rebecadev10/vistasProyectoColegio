<?php include 'componentes/header.php'; ?>
<div class="layout">
  <div class="componente">
    <div class="componente__encabezado">
      <h2 class="componente__titulo">Lista de Eventos</h2>
      <button class="componente__boton-subir">
        <a href="./formularioEvento.php">Publicar Nuevo Evento</a>
      </button>
    </div>

    <div class="componente__contenedor-tabla">
      <table id="tbllistado" class=" componente__tabla" style="width:100%" >
        <thead style="width:100%">
          <tr class=" componente__fila--encabezado">
            <th class="componente__encabezado-tabla">Opción</th>
            <th class="componente__encabezado-tabla">Título</th>
            <th class="componente__encabezado-tabla">Departamento</th>
            <th class="componente__encabezado-tabla">Fecha de Inicio</th>
            <th class="componente__encabezado-tabla">Hora de Inicio</th>
          </tr>
        </thead>
        <tbody>
       
         
        </tbody>
      </table>
    </div>
  </div>
</div>

<?php require 'componentes/footer.php'; ?>
<script type="text/javascript" src="scripts/evento.js"></script>