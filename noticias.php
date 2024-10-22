<?php include 'componentes/header.php'?>
<div class="layout">
    <h2 class="subtitulos">Foro de noticias</h2>
<div class="contenedor">


  <!-- aqui se debe insertar un for para iterar y traer cada una de las noticias registradas en la base de datos con nuestro componente card -->

  <?php  for ($i = 0; $i < 10; $i++) {
      include 'componentes/card.php';
    }
  ?>
  </div>
  </div>
  <?php require 'componentes/footer.php' ?>
