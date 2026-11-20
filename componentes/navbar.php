<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$isEstudiante = !empty($_SESSION['Estudiante']) && $_SESSION['Estudiante'] == 1;
$isDocente = !empty($_SESSION['Docente']) && $_SESSION['Docente'] == 1;
$isAdmin = !empty($_SESSION['Administrativo']) && $_SESSION['Administrativo'] == 1;
?>
<div class="navbar-content">
  <nav role="navigation" class="navbar">
    <ul class="navbar-list">
      <li class="navbar-list__link"><a href="index.php">Inicio</a></li>
      <li class="navbar-list__link">
        <a href="./noticias.php">Noticias</a>
        <?php if ($isAdmin): ?>
        <ul class="dropdown">
          <li><a href="./noticiasEditar.php">Crear Noticias</a></li>
        </ul>
        <?php endif; ?>
      </li>
      <li class="navbar-list__link">
        <a href="eventos.php">Eventos</a>
        <?php if ($isAdmin): ?>
        <ul class="dropdown">
          <li><a href="eventoEditar.php">Crear Eventos</a></li>
        </ul>
        <?php endif; ?>
      </li>
      <li class="navbar-list__link">
        <a href="./recursos.php">Recursos</a>
        <?php if ($isAdmin || $isDocente): ?>
        <ul class="dropdown">
          <li><a href="./recursosEditar.php">Crear Recursos</a></li>
        </ul>
        <?php endif; ?>
      </li>
      <li class="navbar-list__link">
        <a href="./anuncio.php">Comunicación</a>
        <?php if ($isAdmin): ?>
        <ul class="dropdown">
          <li><a href="./comunicacionEditar.php">Crear Anuncio</a></li>
        </ul>
        <?php endif; ?>
      </li>
      <?php if ($isAdmin): ?>
      <li class="navbar-list__link"><a href="./usuariosEditar.php">Gestión de Usuario</a></li>
      <?php endif; ?>
    </ul>
    <ul class="navbar-list__right">
      <li class="navbar-list__link"><a href="controlador/usuario.php?op=salir" class="dropdown-item">Cerrar Sesión</a></li>
    </ul>
  </nav>
</div>
