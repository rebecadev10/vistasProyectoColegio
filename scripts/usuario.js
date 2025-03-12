function init() {
  // //
  
  
  // listarpagobol();

  $("#formulario").on("submit", function (e) {
    guardaryeditar(e);
  });

}
function guardaryeditar(e) {
  e.preventDefault(); //No se activará la acción predeterminada del evento
  $("#btnGuardar").prop("disabled", true);
  var formData = new FormData($("#formulario")[0]);

  $.ajax({
    url: "controlador/usuario.php?op=guardaryeditar",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,

    success: function (datos) {
     

      window.alert("Exito!");
      window.location.href = "login.php";
    },
  });
  // limpiar();
}
init();
