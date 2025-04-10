function init() {
  // //
  mostrarform(false);
  
  // listarpagobol();

  $("#formulario").on("submit", function (e) {
    guardaryeditar(e);
  });

  // Realizar la petición al controlador para obtener los departamentos

  
}
function guardaryeditar(e) {
  e.preventDefault(); //No se activará la acción predeterminada del evento
  $("#btnGuardar").prop("disabled", true);
  var formData = new FormData($("#formulario")[0]);

  $.ajax({
    url: "controlador/recurso.php?op=guardaryeditar",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,

    success: function (datos) {
      //   bootbox.alert(datos);
      //   mostrarform(false);
      //   tabla.ajax.reload();

      window.alert("Exito!");
      window.location.href = "recursosEditar.php";
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
        url: "controlador/recurso.php?op=listar",
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
function listarDepartamentos(){
  $.post("controlador/evento.php?op=listarDepartamentos", function (response) {
    $("#departamento")
      .html(
        '<option value="todos">Filtrar por departamentos</option>' + response
      )
      .selectpicker("refresh"); // Actualiza el selectpicker
  });
}
function mostrar(idRecursos) {
  // Carga la información desde tu controlador usando jQuery
  $.post(
    "controlador/recurso.php?op=mostrar",
    { idRecursos: idRecursos },
    function (data, status) {
      try {
        // Verifica si los datos recibidos son válidos y son JSON
        console.log("Respuesta recibida:", data);
        data = JSON.parse(data);
        mostrarform(true);

        if (data && data.idRecursos) {
          // Cambiado de idEventos a idNoticias
          // Muestra la información en el formulario
          $("#idRecursos").val(data.idRecursos);
          $("#tituloRecurso").val(data.tituloRecurso);
          $("#descripcion").val(data.descripcion);
          $("#autor").val(data.autor);
          $("#fechaPublicacion").val(data.fechaPublicacion);
          $("#editorial").val(data.editorial);
          $("#departamento").val(data.idDepartamento);

          // Corrige la asignación de la imagen
          if (data.fotoPortada) {
            $("#imagenActual").attr("src", "data/" + data.fotoPortada);
          } else {
            $("#imagenActual").attr("src", "img/no-image.jpg"); // Imagen por defecto si no hay imagen
          }
          $("#recursoActual").val(data.dataRecurso);
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
  $("#idNoticias").val("");
  $("#titulo").val("");
  $("#descripcion").val("");
  $("#imagen").val("");
}

function cancelar() {
  window.location.href = "recursosEditar.php"; // Cambia "noticias.php" por la URL a la que deseas redirigir
}
function buscarRecursos() {
  const searchTerm = $("#buscarTitulo").val().trim();
  const departamento = $("#departamento").val();
  listarRecursos(searchTerm, departamento);
  console.log(
    "se llama a esta funcion buscar recursos recibimos" +
      searchTerm +
      "departamento:" +
      departamento
  );
}
function listarRecursos(titulo = "", idDepartamento = "") {
  console.log(titulo);
  console.log(idDepartamento);
  $.ajax({
    url: "controlador/recurso.php?op=listar",
    type: "GET",
    data: {
      buscarTitulo: titulo,
      departamento: idDepartamento,
    },
    dataType: "json",
    success: function (response) {
      if (response.aaData && response.aaData.length > 0) {
        let recursosHTML = "";

        response.aaData.forEach((recurso) => {
          let imagenRuta = recurso[6]
            ? `./data/${recurso[6]}`
            : "./data/noticia.jpg";
          let archivoRuta = `./data/${recurso[7]}`;
          recursosHTML += ` 
							<div class="card">
								<img src="${imagenRuta}" alt="Imagen del recurso">
								<div class="card-content">
									<h3 class="card__titulo">${recurso[1]}</h3>
									<p class="card__descripcion">${recurso[2]}</p>
                  
									  <div class="book">
			 
                      <div class="book-info">
                      <h4>Autor: ${recurso[3]}</h4>
                      <span>fecha publicacion:${recurso[4]} </span>
                      <span>Editorial:${recurso[5]} </span>
              			  </div>
                    </div>
                  
                </div>
                <button  class="btn-card"> <a href="${archivoRuta}" download>Descargar</a></button>
              </div>
						`;
        });

        $("#contenedorRecursos").html(recursosHTML);
      } else {
        $("#contenedorRecursos").html("<p>No hay recursos disponibles.</p>");
      }
    },
    error: function (xhr, status, error) {
      console.error("Error al listar recursos:", error);
    },
  });
}

// Cargar recursos cuando la página termine de cargar
$(document).ready(function () {
  let contenedor=document.getElementById("contenedorRecursos");
  let tabla=document.getElementById("tbllistado");
  let select = document.getElementById("departamento")
  if(contenedor){
    listarRecursos();
  }else{

  }
  if(tabla){
listar();
  }else{

  }
  if(select){
    listarDepartamentos()
  }
  
});

// document.addEventListener("DOMContentLoaded", function () {
//   // Función para actualizar el nombre del archivo seleccionado
//   function actualizarNombreArchivo(input, spanId) {
//     let fileName =
//       input.files.length > 0
//         ? input.files[0].name
//         : "Ningún archivo seleccionado";
//     document.getElementById(spanId).textContent = fileName;
//   }

//   // Detectar cambios en el input de imagen
//   document.getElementById("imagen").addEventListener("change", function () {
//     actualizarNombreArchivo(this, "file-name");
//   });

//   // Detectar cambios en el input de recurso
//   document.getElementById("recurso").addEventListener("change", function () {
//     actualizarNombreArchivo(this, "file-name-recurso");
//   });
// });

init();
