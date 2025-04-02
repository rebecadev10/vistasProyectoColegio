<l?php if (strlen(session_id()) < 1)
    session_start();
?>
<div class="navbar-content">
  <nav role="navigation" class="navbar">
    <ul class="navbar-list">
      <li class="navbar-list__link"><a href="index.php">Inicio</a></li>
      <li class="navbar-list__link">
        <a href="./noticias.php">Noticias</a>
        <?php 
         if ($_SESSION['Administrativo'] == 1){?>
        <ul class="dropdown">
          <li><a href="./noticiasEditar.php">Crear Noticias</a></li>
         
        </ul>
       <?php } ?>
      </li>
      <li class="navbar-list__link">
        <a href="eventos.php">Eventos</a>
        <?php 
         if ($_SESSION['Administrativo'] == 1){?>
        <ul class="dropdown">
          <li><a href="eventoEditar.php">Crear Eventos</a></li>
         
        </ul>
        <?php } ?>
      </li>
      <li class="navbar-list__link">
        <a href="./recursos.php">Recursos</a>
        <?php 
       if ($_SESSION['Administrativo'] == 1 or $_SESSION['Docente']==1){?>
        <ul class="dropdown">
          <li><a href="./recursosEditar.php">Crear Recursos</a></li>
         
        </ul>
        <?php } ?>
      </li>
      <li class="navbar-list__link">
        <a href="./anuncio.php">Comunicación</a>
        <?php 
         if ($_SESSION['Administrativo'] == 1){?>
        <ul class="dropdown">
          <li><a href="./comunicacionEditar.php">Crear Anuncio</a></li>
         
        </ul>
        <?php } ?>
      </li>
      <?php 
         if ($_SESSION['Administrativo'] == 1){?>
      <li class="navbar-list__link"><a href="./usuariosEditar.php">Gestión de Usuario</a></li>
    </ul>
    <?php } ?>
    <ul class="navbar-list__right">
    <a class="dropdown-item" href="controlador/usuario.php?op=salir"><li class="navbar-list__link"> Cerrar Sesión</li></a>
      
    </ul>
  </nav>
</div>
