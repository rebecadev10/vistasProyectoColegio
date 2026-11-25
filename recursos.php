<?php include 'componentes/header.php' ?>
<div class="layout">
  <div style="text-align: center; margin-top: 10px;">
    <span class="badge-pill badge-pill--primary"><i class="fa-solid fa-book-bookmark"></i> Biblioteca Pedagógica</span>
    <h2 class="subtitulos"><i class="fa-solid fa-folder-open" style="color: var(--brand-primary); margin-right: 8px;"></i> Recursos Educativos</h2>
  </div>

  <!-- Contenedor de búsqueda -->
  <div class="buscador">
    <i class="fa-solid fa-magnifying-glass" style="color: var(--slate-400); margin-left: 10px;"></i>
    <input type="text" 
           id="buscarTitulo" 
           class="buscador-input"
           placeholder="Buscar recursos por título..."
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