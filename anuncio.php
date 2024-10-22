<?php include 'componentes/header.php' ?>
<div class="layout">
  <h2 class="subtitulos">Anuncios</h2>
  <div class="contenedor">
    
    <?php 
    // Iterar para mostrar los anuncios
    for ($i = 0; $i < 10; $i++) {
      include 'componentes/cardAnuncio.php';
    }
    ?>
  </div>
</div>
<?php require 'componentes/footer.php' ?>