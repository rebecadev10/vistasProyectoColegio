<?php include 'componentes/header.php'?>
<div class="layout">
  <div class="componente">
    <div class="componente__encabezado">
      <h2 class="componente__titulo">Usuarios Registrados</h2>
      <button class="componente__boton-subir"><a href="./formularioUsuario.php"> Crear nuevo usuario</a></button>
    </div>

    <div class="componente__contenedor-tabla">
      <table class="componente__tabla">
        <thead>
          <tr class="componente__fila componente__fila--encabezado">
            <th class="componente__encabezado-tabla">Opción</th>
            <th class="componente__encabezado-tabla">Nombre</th>
            <th class="componente__encabezado-tabla">cedula</th>
            <th class="componente__encabezado-tabla">rol</th>
            <th class="componente__encabezado-tabla">Imagen</th>
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
            <td class="componente__celda">Pedro</td>
            <td class="componente__celda">12345678</td>
            <td class="componente__celda">Estudiante</td>
            <td class="componente__celda">
              <img src="./public/img/contenido/2.jpg" alt="recurso 1" class="componente__imagen-pequena">
            </td>
          </tr>
          <tr class="componente__fila">
            <td class="componente__celda">
              <button class="componente__boton-editar">
                <i class="fa fa-edit"></i> <!-- Icono de edición -->
              </button>
            </td>
            <td class="componente__celda">Marco</td>
            <td class="componente__celda">45321775</td>
            <td class="componente__celda">Profesor</td>
            <td class="componente__celda">
              <img src="./public/img/contenido/2.jpg" alt="recurso 2" class="componente__imagen-pequena">
            </td>
          </tr>
          <!-- Más filas con recursos publicadas -->
        </tbody>
      </table>
    </div>
  </div>
</div>
<?php require 'componentes/footer.php' ?>
