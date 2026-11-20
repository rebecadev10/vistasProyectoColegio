<?php include 'componentes/header.php' ?>
<div class="layout">
  <h2 class="subtitulos">Recursos</h2>

  <!-- Contenedor de búsqueda -->
  <div class="buscador">
    <input type="text" 
           id="buscarTitulo" 
           class="buscador-input"
           placeholder="🔍 Buscar por título..."
           onkeyup="buscarRecursos()">
    
    <select id="departamento" 
            class="filtro-departamento"
            name="departamento" 
            title="Filtrar por departamento"
            onchange="buscarRecursos()">
        <option value="todos">Todos los departamentos</option>
        <!-- Opciones cargadas dinámicamente -->
    </select>
  </div>

  <!-- Contenedor donde se listan los recursos -->
  <div class="contenedor" id="contenedorRecursos">
    <!-- Aquí se insertarán los recursos desde JS -->
  </div>

</div>
<?php require 'componentes/footer.php' ?>
<script type="text/javascript" src="scripts/recurso.js"></script>