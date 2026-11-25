<footer class="footer">
    <div class="footer-top">
        <span>¿Listo para unirte a nuestra comunidad educativa?</span>
        <a href="emailcontacto" class="btn">Contáctanos</a>
    </div>
    <div class="footer-bottom">
        <ul>
            <li><a href="#">Política de Privacidad</a></li>
            <li><a href="#">Términos y Condiciones</a></li>
        </ul>
        <p>&copy; 2026 U.E. Manuel Díaz Rodríguez. Todos los derechos reservados.</p>
    </div>
</footer>
<!-- jQuery desde el CDN oficial -->


<script src="https://kit.fontawesome.com/3d7cd8560c.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

 <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0/css/select2.min.css" rel="stylesheet" />

 <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0/js/select2.min.js"></script>
 <!-- DataTables JS -->

<script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/buttons/3.2.2/js/dataTables.buttons.js"></script>
<script src="https://cdn.datatables.net/buttons/3.2.2/js/buttons.dataTables.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/3.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.2.2/js/buttons.print.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
if (window.jQuery && jQuery.fn && jQuery.fn.dataTable) {
  jQuery.extend(true, jQuery.fn.dataTable.defaults, {
    language: {
      processing: "Procesando...",
      search: "Buscar:",
      lengthMenu: "Mostrar _MENU_ registros",
      info: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
      infoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
      infoFiltered: "(filtrado de un total de _MAX_ registros)",
      infoPostFix: "",
      loadingRecords: "Cargando registros...",
      zeroRecords: "No se encontraron resultados",
      emptyTable: "Ningún dato disponible en esta tabla",
      paginate: {
        first: "Primero",
        previous: "Anterior",
        next: "Siguiente",
        last: "Último"
      },
      aria: {
        sortAscending: ": Activar para ordenar la columna de manera ascendente",
        sortDescending: ": Activar para ordenar la columna de manera descendente"
      },
      buttons: {
        copy: "Copiar",
        copyTitle: "Tabla Copiada",
        copySuccess: {
          _: "%d líneas copiadas",
          1: "1 línea copiada"
        }
      }
    }
  });
}
</script>
