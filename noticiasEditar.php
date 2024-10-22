<?php include 'componentes/header.php'?>
<div class="layout">
  <div class="componente">
    <div class="componente__encabezado">
      <h2 class="componente__titulo">Noticias Subidas</h2>
      <button class="componente__boton-subir"><a href="./formularioNoticias.php"> Publicar Nueva Noticia</a></button>
    </div>

    <div class="componente__contenedor-tabla">
      <table class="componente__tabla">
        <thead>
          <tr class="componente__fila componente__fila--encabezado">
            <th class="componente__encabezado-tabla">Opción</th>
            <th class="componente__encabezado-tabla">Título</th>
            <th class="componente__encabezado-tabla">Descripción</th>
            <th class="componente__encabezado-tabla">Fecha</th>
            <th class="componente__encabezado-tabla">Imagen</th>
          </tr>
        </thead>
        <tbody>
          <!-- Aquí se iteran las noticias para mostrar cada una -->
          <tr class="componente__fila">
            <td class="componente__celda">
              <button class="componente__boton-editar">
                <i class="fa fa-edit"></i> <!-- Icono de edición -->
                <!-- aqui debes redireccionar al usuario al formualrio de editar enviando el id como parametro es decir algo asi formulario[id].php -->
              </button>
            </td>
            <td class="componente__celda">Noticia 1</td>
            <td class="componente__celda">Breve descripción de la noticia 1...</td>
            <td class="componente__celda">2024-10-18</td>
            <td class="componente__celda">
              <img src="./public/img/contenido/1.jpeg" alt="Noticia 1" class="componente__imagen-pequena">
            </td>
          </tr>
          <tr class="componente__fila">
            <td class="componente__celda">
              <button class="componente__boton-editar">
                <i class="fa fa-edit"></i> <!-- Icono de edición -->
              </button>
            </td>
            <td class="componente__celda">Noticia 2</td>
            <td class="componente__celda">Breve descripción de la noticia 2...</td>
            <td class="componente__celda">2024-10-15</td>
            <td class="componente__celda">
              <img src="./public/img/contenido/1.jpeg" alt="Noticia 2" class="componente__imagen-pequena">
            </td>
          </tr>
          <!-- Más filas con noticias publicadas -->
        </tbody>
      </table>
    </div>
  </div>
</div>
<?php require 'componentes/footer.php' ?>
