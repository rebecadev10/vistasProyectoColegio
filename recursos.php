<?php include 'componentes/header.php' ?>
<div class="layout">
  <h2 class="subtitulos">Recursos</h2>
  <div class="contenedor">


    <!-- aqui se debe insertar un for para iterar y traer cada una de las noticias registradas en la base de datos con nuestro componente cardBook -->

    <?php for ($i = 0; $i < 10; $i++) {
      include 'componentes/cardBook.php';
    }
    ?>
  </div>
</div>
<?php require 'componentes/footer.php' ?>