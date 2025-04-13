function init() {
  // //
  mostrarform(false);
  listar();
  // listarpagobol();

  $("#formulario").on("submit", function (e) {
    guardaryeditar(e);
  });
  //Cargamos los items al select categoria

  // Realizar la petición al controlador para obtener los departamentos
  //  $.post("controlador/evento.php?op=listarDepartamentos", function(response) {
  //     // Rellenar el select con las opciones recibidas
  // 	console.log(response);
  //     $("#departamento").html(response); // Agrega las opciones al select
  // });
}
function guardaryeditar(e) {
  e.preventDefault(); //No se activará la acción predeterminada del evento
  $("#btnGuardar").prop("disabled", true);
  var formData = new FormData($("#formulario")[0]);

  $.ajax({
    url: "controlador/comunicacion.php?op=guardaryeditar",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,

    success: function (datos) {
      const respuesta = datos.trim();
      let redireccion = "";
      console.log(respuesta);
      // Configurar según tipo de operación
      if (
        respuesta.includes("anuncio registrado") ||
        respuesta.includes("anuncio actualizado")
      ) {
        redireccion = "comunicacionEditar.php";
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
          if (redireccion) {
            window.location.href = redireccion;
          }
        },
      };
      if (redireccion) {
        Swal.fire(swalConfig);
      } else {
        Swal.fire({
          icon: "error",
          title: "Acción no completada",
          text: datos,
        });
      }
    },
  });
  // limpiar();
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
        url: "controlador/comunicacion.php?op=listar",
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
    })
    .DataTable();
}
function mostrar(idAnuncio) {
  // Carga la información desde tu controlador usando jQuery
  $.post(
    "controlador/comunicacion.php?op=mostrar",
    { idAnuncio: idAnuncio },
    function (data, status) {
      try {
        // Verifica si los datos recibidos son válidos y son JSON
        console.log("Respuesta recibida:", data);
        data = JSON.parse(data);
        mostrarform(true);

        if (data && data.idAnuncio) {
          // Cambiado de idEventos a idAnuncio
          // Muestra la información en el formulario
          $("#idAnuncio").val(data.idAnuncio);
          $("#titulo").val(data.titulo);
          $("#descripcion").val(data.descripcion);

          // Corrige la asignación de la imagen
          if (data.imagenAnuncio) {
            $("#imagenActual").attr("src", "data/" + data.imagenAnuncio);
          } else {
            $("#imagenActual").attr("src", "img/no-image.jpg"); // Imagen por defecto si no hay imagen
          }
        } else {
          console.error("Datos mal formateados o faltantes.");
        }
      } catch (e) {
        console.error("Error al parsear JSON: ", e);
      }
    }
  ).fail(function (xhr, status, error) {
    console.error("Error al realizar la solicitud: ", error);
  });
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
  $("#idAnuncio").val("");
  $("#titulo").val("");
  $("#descripcion").val("");
  $("#imagen").val("");
}

function cancelar() {
  window.location.href = "comunicacionEditar.php"; // Cambia "comunicacion.php" por la URL a la que deseas redirigir
}

function listarComunicacion() {
  $.ajax({
    url: "controlador/comunicacion.php?op=listar",
    type: "GET",
    dataType: "json",
    success: function (response) {
      console.log(response); // Verificar los datos en la consola

      if (response.aaData && response.aaData.length > 0) {
        let comunicacionHTML = "";

        response.aaData.forEach((anuncio) => {
          let imagenRuta = anuncio[3]
            ? `./data/${anuncio[3]}`
            : "./data/noticia.jpg";

          comunicacionHTML += `
                        <div class="cardAnuncio">
                            <img src="${imagenRuta}" alt="imagen referente">
							<div class="card-content">
                            <h3 class="card__titulo">${anuncio[1]}</h3>
                            <p class="card__descripcion">${anuncio[2]}</p>
							 <button type="button" class="btn-card" 
                                data-titulo="${anuncio[1].replace(
                                  /"/g,
                                  "&quot;"
                                )}"
                                data-contenido="${anuncio[2].replace(
                                  /"/g,
                                  "&quot;"
                                )}"
                                data-imagen="${imagenRuta}">
                                Leer más
                            </button>
                           
                        </div>
						</div>
                    `;
        });

        $("#contenedorComunicacion").html(comunicacionHTML);
        // Event Delegation para todos los botones
        $(document).on("click", ".btn-card", function () {
          const titulo = $(this).data("titulo");
          const contenido = $(this).data("contenido");
          const imagen = $(this).data("imagen");

          Swal.fire({
            title: titulo,
            html: `
                            <div class="swal2-news-modal">
                                <img src="${imagen}" class="swal2-news-image" alt="Imagen noticia">
                                <div class="swal2-news-content">${contenido}</div>
                            </div>
                        `,
            showCloseButton: true,
            width: "60%",
            customClass: {
              popup: "custom-modal",
              htmlContainer: "news-modal-html-container",
            },
          });
        });
      } else {
        $("#contenedorComunicacion").html(
          "<p>No hay noticias disponibles.</p>"
        );
      }
    },
    error: function (xhr, status, error) {
      console.error("Error cargando noticias: ", xhr.responseText);
    },
  });
}

function eliminar(idAnuncio) {
  Swal.fire({
    title: "¿Está seguro de eliminar el anuncio?",
    icon: "warning",
    text: "Ten en cuenta que no podrás recuperar la información que elimines",
    showCancelButton: true,
    confirmButtonText: "Sí, eliminar",
    cancelButtonText: "Cancelar",
  }).then((result) => {
    if (result.isConfirmed) {
      $.post(
        "controlador/comunicacion.php?op=eliminar",
        { idAnuncio: idAnuncio },
        function (e) {
          // bootbox.alert(e);
          tabla.ajax.reload();
        }
      );
      // Aquí colocas el código para desactivar el usuario
      Swal.fire(" Eliminado!", "Anuncio  ha sido Eliminado.", "success");
    }
  });
}
// Cargar noticias cuando la página termine de cargar
$(document).ready(function () {
  listarComunicacion();
});

listar();

listarComunicacion();
document.addEventListener("DOMContentLoaded", function () {
  // Función para actualizar el nombre del archivo seleccionado
  function actualizarNombreArchivo(input, spanId) {
    let fileName =
      input.files.length > 0
        ? input.files[0].name
        : "Ningún archivo seleccionado";
    document.getElementById(spanId).textContent = fileName;
  }

  // Detectar cambios en el input de imagen
  document.getElementById("imagen").addEventListener("change", function () {
    actualizarNombreArchivo(this, "file-name");
  });
});
init();
