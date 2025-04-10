function init() {
  // //
  
  mostrarform(false);
  

  $("#formulario").on("submit", function (e) {
    guardaryeditar(e);
  });
  
  //Mostramos los permisos
	$.post("controlador/usuario.php?op=permisos&id=",function(r){
       $("#permisos").html(r);



  });
 
}
 
function guardaryeditar(e) {
  console.log("gurdar datos");
  e.preventDefault(); //No se activará la acción predeterminada del evento
  $("#btnGuardar").prop("disabled", true);
  
  var formData = new FormData($("#formulario")[0]);
console.log(formData);
  $.ajax({
    url: "controlador/usuario.php?op=guardaryeditar",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,

    success: function(datos) {
      const respuesta = datos.trim();
      let redireccion = "";
console.log(respuesta);
      // Configurar según tipo de operación
      if (respuesta.includes( "Usuario registrado")) {
          redireccion = "index.html";
      } else if (respuesta.includes( "Usuario actualizado")) {
          redireccion = "usuariosEditar.php";
      }

      // Configuración de SweetAlert
      const swalConfig = {
          icon: redireccion ? "success" : "error",
          title: redireccion ? "¡Éxito!" : "Error",
          text: datos,
          showConfirmButton: true,
          confirmButtonText: "Aceptar",
          confirmButtonColor: "#3085d6",
          willClose: () => {
              if(redireccion) {
                  window.location.href = redireccion;
              }
          },

      
  }
  if(redireccion) {
    Swal.fire(swalConfig);
} else {
    Swal.fire({
        icon: "error",
        title: "Acción no completada",
        text: datos
    });
}
},
});
   limpiar();
}
function listar() {
  tabla = $("#tbllistado")
    .dataTable({
      lengthMenu: [5, 10, 25, 75, 100], //mostramos el menú de registros a revisar
      aProcessing: true, //Activamos el procesamiento del datatables
      aServerSide: true, //Paginación y filtrado realizados por el servidor
      dom: "<Bl<f>rtip>", //Definimos los elementos del control de tabla
      buttons: ["copyHtml5", "excelHtml5", "csvHtml5", "pdf"],
      ajax: {
        url: "controlador/usuario.php?op=listar",
        type: "get",
        dataType: "json",
        error: function (e) {
          console.log(e.responseText);
        },
      },
      language: {
        lengthMenu: "Mostrar : _MENU_ registros",
        buttons: {
          copyTitle: "Tabla Copiada",
          copySuccess: {
            _: "%d líneas copiadas",
            1: "1 línea copiada",
          },
        },
      },
      bDestroy: true,
      iDisplayLength: 5, //Paginación
      order: [[0, "desc"]], //Ordenar (columna,orden)
      responsive: true,
      createdRow: function(row, data) {
				$(row).find('td:eq(2)').css({
					'max-width': '400px',
					'white-space': 'nowrap',
					'overflow': 'hidden',
					'text-overflow': 'ellipsis',
					'cursor': 'pointer'
				}).attr('title', data[2]);
			}
    })
    .DataTable();
}
function mostrarform(flag) {
  limpiar();
  if (flag) {
    $("#formularioregistros").show();
    $("#listadoregistros").hide();
    $("#encabezado").hide();
  } else {
    $("#listadoregistros").show();
    $("#formularioregistros").hide();
    $("#encabezado").show();
  }
}
function cancelarform() {
  limpiar();
  mostrarform(false);
}
function limpiar() {
  $("#idUsuario").val("");
        $("#nombre").val("");
        $("#apellido").val("");
        $("#cedula").val("");
        $("#permisos").val("");
  
}
function mostrar(idUsuario) {
  // Carga la información desde tu controlador usando jQuery
  $.post("controlador/usuario.php?op=mostrar", { idUsuario: idUsuario }, function(data, status) {
    try {
      // Verifica si los datos recibidos son válidos y son JSON
      console.log("Respuesta recibida:", data);
      data = JSON.parse(data);
      mostrarform(true);

      if (data && data.idUsuario) { // Cambiado de idEventos a idNoticias
        // Muestra la información en el formulario
        $("#idUsuario").val(data.idUsuario);
        $("#nombre").val(data.nombre);
        $("#apellido").val(data.apellido);
        $("#cedula").val(data.cedula);
        $("#permisos").val(data.permisos);
        
        // Corrige la asignación de la imagen
        if (data.nombreImagenN) {
          $("#imagenActual").attr("src", "data/" + data.nombreImagenN);
        } else {
          $("#imagenActual").attr("src", "img/no-image.jpg"); // Imagen por defecto si no hay imagen
        }
      } else {
        console.error("Datos mal formateados o faltantes.");
      }
    } catch (e) {
      console.error("Error al parsear JSON: ", e);
    }
  }).fail(function(xhr, status, error) {
    console.error("Error al realizar la solicitud: ", error);
  });
  $.post("controlador/usuario.php?op=permisos&id="+idUsuario,function(r){
    $("#permisos").html(r);



});
}
init();

$(document).ready(function(){
  let tabla=document.getElementById("tbllistado");
  if(tabla){
  listar();}
  else{
    console.log('sigue navegando');
  }
})
