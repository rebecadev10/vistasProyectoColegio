<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$isEstudiante = !empty($_SESSION['Estudiante']) && $_SESSION['Estudiante'] == 1;
$isDocente = !empty($_SESSION['Docente']) && $_SESSION['Docente'] == 1;
$isAdmin = !empty($_SESSION['Administrativo']) && $_SESSION['Administrativo'] == 1;

$rolNombre = 'Estudiante';
if ($isAdmin) {
    $rolNombre = 'Administrador';
} elseif ($isDocente) {
    $rolNombre = 'Docente';
}

$currentPage = basename($_SERVER['PHP_SELF']);
?>
<header class="navbar-wrapper">
  <div class="navbar-container">
    <!-- Brand / Logo -->
    <a href="index.php" class="navbar-brand">
      <div class="brand-badge-icon">
        <i class="fa-solid fa-graduation-cap"></i>
      </div>
      <div class="brand-text">
        <span class="brand-name">MDR 2026</span>
        <span class="brand-tag">U.E. Manuel Díaz Rodríguez</span>
      </div>
    </a>

    <!-- Navigation Menu -->
    <nav role="navigation" class="navbar-nav">
      <ul class="nav-links">
        <li class="nav-item <?php echo ($currentPage == 'index.php') ? 'nav-item--active' : ''; ?>">
          <a href="index.php" class="nav-link">
            <i class="fa-solid fa-house nav-icon"></i>
            <span>Inicio</span>
          </a>
        </li>

        <li class="nav-item nav-item--dropdown <?php echo ($currentPage == 'noticias.php' || $currentPage == 'noticiasEditar.php' || $currentPage == 'formularioNoticias.php') ? 'nav-item--active' : ''; ?>">
          <a href="./noticias.php" class="nav-link">
            <i class="fa-solid fa-newspaper nav-icon"></i>
            <span>Noticias</span>
            <?php if ($isAdmin): ?>
              <i class="fa-solid fa-chevron-down dropdown-arrow"></i>
            <?php endif; ?>
          </a>
          <?php if ($isAdmin): ?>
          <ul class="dropdown-menu">
            <li>
              <a href="./noticiasEditar.php" class="dropdown-link">
                <i class="fa-solid fa-pen-to-square"></i>
                <span>Gestionar Noticias</span>
              </a>
            </li>
            <li>
              <a href="./formularioNoticias.php" class="dropdown-link">
                <i class="fa-solid fa-plus-circle"></i>
                <span>Crear Noticia</span>
              </a>
            </li>
          </ul>
          <?php endif; ?>
        </li>

        <li class="nav-item nav-item--dropdown <?php echo ($currentPage == 'eventos.php' || $currentPage == 'eventoEditar.php' || $currentPage == 'formularioEvento.php') ? 'nav-item--active' : ''; ?>">
          <a href="eventos.php" class="nav-link">
            <i class="fa-solid fa-calendar-days nav-icon"></i>
            <span>Eventos</span>
            <?php if ($isAdmin): ?>
              <i class="fa-solid fa-chevron-down dropdown-arrow"></i>
            <?php endif; ?>
          </a>
          <?php if ($isAdmin): ?>
          <ul class="dropdown-menu">
            <li>
              <a href="eventoEditar.php" class="dropdown-link">
                <i class="fa-solid fa-list-check"></i>
                <span>Gestionar Eventos</span>
              </a>
            </li>
            <li>
              <a href="formularioEvento.php" class="dropdown-link">
                <i class="fa-solid fa-plus-circle"></i>
                <span>Publicar Evento</span>
              </a>
            </li>
          </ul>
          <?php endif; ?>
        </li>

        <li class="nav-item nav-item--dropdown <?php echo ($currentPage == 'recursos.php' || $currentPage == 'recursosEditar.php' || $currentPage == 'formularioRecurso.php') ? 'nav-item--active' : ''; ?>">
          <a href="./recursos.php" class="nav-link">
            <i class="fa-solid fa-book-bookmark nav-icon"></i>
            <span>Recursos</span>
            <?php if ($isAdmin || $isDocente): ?>
              <i class="fa-solid fa-chevron-down dropdown-arrow"></i>
            <?php endif; ?>
          </a>
          <?php if ($isAdmin || $isDocente): ?>
          <ul class="dropdown-menu">
            <li>
              <a href="./recursosEditar.php" class="dropdown-link">
                <i class="fa-solid fa-folder-open"></i>
                <span>Gestionar Recursos</span>
              </a>
            </li>
            <li>
              <a href="./formularioRecurso.php" class="dropdown-link">
                <i class="fa-solid fa-upload"></i>
                <span>Subir Recurso</span>
              </a>
            </li>
          </ul>
          <?php endif; ?>
        </li>

        <li class="nav-item nav-item--dropdown <?php echo ($currentPage == 'anuncio.php' || $currentPage == 'comunicacionEditar.php' || $currentPage == 'formularioAnuncio.php') ? 'nav-item--active' : ''; ?>">
          <a href="./anuncio.php" class="nav-link">
            <i class="fa-solid fa-bullhorn nav-icon"></i>
            <span>Comunicación</span>
            <?php if ($isAdmin): ?>
              <i class="fa-solid fa-chevron-down dropdown-arrow"></i>
            <?php endif; ?>
          </a>
          <?php if ($isAdmin): ?>
          <ul class="dropdown-menu">
            <li>
              <a href="./comunicacionEditar.php" class="dropdown-link">
                <i class="fa-solid fa-table-list"></i>
                <span>Listado de Anuncios</span>
              </a>
            </li>
            <li>
              <a href="./formularioAnuncio.php" class="dropdown-link">
                <i class="fa-solid fa-paper-plane"></i>
                <span>Nuevo Anuncio</span>
              </a>
            </li>
          </ul>
          <?php endif; ?>
        </li>

        <?php if ($isAdmin): ?>
        <li class="nav-item <?php echo ($currentPage == 'usuariosEditar.php') ? 'nav-item--active' : ''; ?>">
          <a href="./usuariosEditar.php" class="nav-link">
            <i class="fa-solid fa-users-gear nav-icon"></i>
            <span>Usuarios</span>
          </a>
        </li>
        <?php endif; ?>
      </ul>
    </nav>

    <!-- User & Session Controls -->
    <div class="navbar-actions">
      <div class="user-pill-tag">
        <span class="user-status-dot"></span>
        <span class="user-role-label"><?php echo htmlspecialchars($rolNombre); ?></span>
      </div>
      <a href="controlador/usuario.php?op=salir" class="btn-logout" title="Cerrar Sesión">
        <i class="fa-solid fa-arrow-right-from-bracket"></i>
        <span class="logout-text">Salir</span>
      </a>
    </div>
  </div>
</header>
