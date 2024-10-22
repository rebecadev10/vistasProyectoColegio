<?php include 'componentes/header.php'?>
<div class="layout">
  <div class="componente">
    <div class="componente__encabezado">
      <h2 class="componente__titulo">Lista de Eventos</h2>
      <button class="componente__boton-subir"><a href="./formularioEvento.php"> Publicar Nuevo Evento</a></button>
    </div>

    <div class="componente__contenedor-tabla">
      <table class="componente__tabla">
        <thead>
          <tr class="componente__fila componente__fila--encabezado">
            <th class="componente__encabezado-tabla">Opción</th>
            <th class="componente__encabezado-tabla">Tema</th>
            <th class="componente__encabezado-tabla">Descripción</th>
            <th class="componente__encabezado-tabla">Fecha</th>
            
          </tr>
        </thead>
        <tbody>
          <!-- Aquí se iteran las recursos para mostrar cada una -->
          <tr class="componente__fila">
            <td class="componente__celda">
              <button class="componente__boton-editar">
                <i class="fa fa-edit"></i> <!-- Icono de edición -->
                <!-- aqui debes redireccionar al usuario al formualrio de editar enviando el id como parametro es decir algo asi formulario[id].php -->
              </button>
            </td>
            <td class="componente__celda">recurso 1</td>
            <td class="componente__celda">Breve descripción del recurso 1...</td>
            <td class="componente__celda">2024-10-18</td>
          
          </tr>
          <tr class="componente__fila">
            <td class="componente__celda">
              <button class="componente__boton-editar">
                <i class="fa fa-edit"></i> <!-- Icono de edición -->
              </button>
            </td>
            <td class="componente__celda">recurso 2</td>
            <td class="componente__celda">Breve descripción del recurso 2...</td>
            <td class="componente__celda">2024-10-15</td>
          </tr>
          <!-- Más filas con recursos publicadas -->
        </tbody>
      </table>
    </div>
  </div>
</div>
<?php require 'componentes/footer.php' ?>
