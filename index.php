<?php
session_start();
ob_start();

if (!isset($_SESSION["login"])) {
    header("Location: index.html");
    exit();
} else {
    require 'componentes/header.php';
?>
<div class="layout">

    <!-- Hero Portal Académico 2026 -->
    <section class="hero-portal">
        <div class="hero-badge">
            <i class="fa-solid fa-sparkles"></i>
            <span>Plataforma Académica Digital 2026</span>
        </div>
        <h1 class="hero-title">
            Formando Líderes con <span class="gradient-text">Valores y Excelencia</span>
        </h1>
        <p class="hero-subtitle">
            Bienvenidos a la Unidad Educativa Manuel Díaz Rodríguez. Innovación, vocación y compromiso con la educación de calidad para el futuro.
        </p>

        <!-- Stats Grid (Fluentify / 2026 Style) -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fa-solid fa-award"></i>
                </div>
                <div class="stat-info">
                    <span class="stat-value">50+</span>
                    <span class="stat-label">Años de Trayectoria</span>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fa-solid fa-book-open-reader"></i>
                </div>
                <div class="stat-info">
                    <span class="stat-value">100%</span>
                    <span class="stat-label">Calidad Educativa</span>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fa-solid fa-school"></i>
                </div>
                <div class="stat-info">
                    <span class="stat-value">3</span>
                    <span class="stat-label">Niveles de Formación</span>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fa-solid fa-cloud-arrow-down"></i>
                </div>
                <div class="stat-info">
                    <span class="stat-value">24/7</span>
                    <span class="stat-label">Recursos en Línea</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Galería Visual del Colegio -->
    <section class="gallery-section">
        <div class="gallery-grid">
            <div class="gallery-item">
                <img src="./public/img/contenido/manuel.jfif" alt="Fachada del Colegio">
                <div class="gallery-overlay">
                    <span>Fachada Principal</span>
                </div>
            </div>
            <div class="gallery-item">
                <img src="./public/img/contenido/aula.jfif" alt="Aulas Climatizadas">
                <div class="gallery-overlay">
                    <span>Aulas de Aprendizaje</span>
                </div>
            </div>
            <div class="gallery-item">
                <img src="./public/img/contenido/patio.jfif" alt="Áreas Recreativas">
                <div class="gallery-overlay">
                    <span>Espacios Deportivos</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Bento Grid Institucional -->
    <section class="bento-section">
        <div class="bento-grid">
            <!-- Quiénes Somos -->
            <div class="bento-about">
                <h2><i class="fa-solid fa-landmark" style="color: var(--brand-primary); margin-right: 8px;"></i> Quiénes Somos</h2>
                <p>
                    Somos una institución educativa con más de 50 años de trayectoria impecable, comprometidos con la formación integral de nuestros estudiantes, brindándoles una educación de excelencia basada en principios éticos, ciudadanos y científicos.
                </p>
            </div>

            <!-- Misión (Card azul oscuro estilo Fluentify) -->
            <div class="bento-mision">
                <h3><i class="fa-solid fa-bullseye"></i> Nuestra Misión</h3>
                <p>
                    Brindar una educación integral que permita el desarrollo académico y personal de nuestros estudiantes, fomentando e impartiendo Valores Ciudadanos, el potencial científico, creativo, participativo y solidario, que favorezca la interacción activa Escuela – Comunidad para la transformación social.
                </p>
            </div>

            <!-- Visión -->
            <div class="bento-vision">
                <h3><i class="fa-solid fa-eye" style="color: var(--brand-primary);"></i> Nuestra Visión</h3>
                <p>
                    Ser una institución de reconocido prestigio y liderazgo en la formación integral de educandos, orientada a fortalecer el amor por la ciencia, la tecnología y la ética, generando participación activa y solidaria como instrumento de transformación humanista.
                </p>
            </div>

            <!-- Ubicación vinculada con Google Maps -->
            <div class="bento-ubicacion">
                <div class="bento-ubicacion-info">
                    <h2><i class="fa-solid fa-location-dot" style="color: var(--brand-primary); margin-right: 8px;"></i> Ubicación Estratégica</h2>
                    <p>
                        Ubicada en el sector La Estrella, pertenecemos con orgullo al Circuito Educativo # 151001001. Instalaciones seguras, accesibles y diseñadas para el óptimo desarrollo de los educandos.
                    </p>
                    <div style="display: flex; gap: 12px; align-items: center; flex-wrap: wrap;">
                        <span class="badge-pill badge-pill--primary">Circuito # 151001001</span>
                        <a href="https://maps.google.com/?q=U.E.+Manuel+D%C3%ADaz+Rodr%C3%ADguez,+La+Estrella,+Los+Teques" target="_blank" rel="noopener noreferrer" class="btn-maps-action">
                            <i class="fa-solid fa-diamond-turn-right"></i> Cómo llegar en Google Maps
                        </a>
                    </div>
                </div>
                <div class="bento-ubicacion-img">
                    <iframe 
                        title="Mapa de Google Maps - U.E. Manuel Díaz Rodríguez"
                        src="https://maps.google.com/maps?q=U.E.+Manuel+D%C3%ADaz+Rodr%C3%ADguez,+La+Estrella,+Los+Teques,+Miranda&t=&z=16&ie=UTF8&iwloc=&output=embed" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade" 
                        allowfullscreen>
                    </iframe>
                </div>
            </div>
        </div>
    </section>

</div>

<?php 
    include 'componentes/footer.php';
}
ob_end_flush();
?>
