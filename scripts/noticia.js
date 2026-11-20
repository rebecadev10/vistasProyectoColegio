function init(){
	// // 
	mostrarform(false);
	listar();
	// listarpagobol();

	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);	
	})
	//Cargamos los items al select categoria


	 // Realizar la petición al controlador para obtener los departamentos
	//  $.post("controlador/evento.php?op=listarDepartamentos", function(response) {
    //     // Rellenar el select con las opciones recibidas
	// 	console.log(response);
    //     $("#departamento").html(response); // Agrega las opciones al select
    // });
}
function guardaryeditar(e)
{
	e.preventDefault(); //No se activará la acción predeterminada del evento
	$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "controlador/noticia.php?op=guardaryeditar",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	    success: function(datos)
	    {                    
	   
			
				const respuesta = datos.trim();
				let redireccion = "";
		  console.log(respuesta);
				// Configurar según tipo de operación
				if (respuesta.includes("noticia registrado") || respuesta.includes("noticia actualizado")) {
					redireccion = "noticiasEditar.php";
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
	// limpiar();
}
function listar() {
	tabla = $("#tbllistado")
	  .dataTable({
		lengthMenu: [5, 10, 25, 75, 100], //mostramos el menú de registros a revisar
		aProcessing: true, //Activamos el procesamiento del datatables
		aServerSide: true, //Paginación y filtrado realizados por el servidor
		dom:  "<'topTabla'Bf>" +    // Botones y buscador
            "<'componente__tabla'tr>" + // Tabla
            "<'bottomTabla'ip>",   // Info y paginación", //Definimos los elementos del control de tabla
		buttons: [{
			extend: 'copyHtml5',
			title: 'Data Noticia'
		},{
			extend: 'excelHtml5',
			title: 'Data Noticia'
		},{
			extend: 'csvHtml5',
			title: 'Data Noticia'
		}],
		ajax: {
		  url: "controlador/noticia.php?op=listar",
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
	function mostrar(idNoticias) {
		// Carga la información desde tu controlador usando jQuery
		$.post("controlador/noticia.php?op=mostrar", { idNoticias: idNoticias }, function(data, status) {
			try {
				// Verifica si los datos recibidos son válidos y son JSON
				console.log("Respuesta recibida:", data);
				data = JSON.parse(data);
				mostrarform(true);
	
				if (data && data.idNoticias) { // Cambiado de idEventos a idNoticias
					// Muestra la información en el formulario
					$("#idNoticias").val(data.idNoticias);
					$("#titulo").val(data.titulo);
					$("#descripcion").val(data.descripcion);
					
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
	}
	
function mostrarform(flag)
{
	limpiar();
	if (flag)
	{
		
		$("#formularioregistros").show();
		$("#listadoregistros").hide();
		$("#encabezado").hide();
	}
	else
	{
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
		$("#encabezado").show();
		

	}
}
function cancelarform()
{
	limpiar();
	mostrarform(false);
}
function limpiar()
{
	$("#idNoticias").val("");
	$("#titulo").val("");
	$("#descripcion").val("");
	$("#imagen").val("");
	
}

function cancelar() {
    window.location.href = "noticiasEditar.php"; // Cambia "noticias.php" por la URL a la que deseas redirigir
}
function listarNoticias() {
    $.ajax({
        url: 'controlador/noticia.php?op=listarActivos',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            console.log(response);

            if (response.aaData && response.aaData.length > 0) {
                let noticiasHTML = "";

                response.aaData.forEach(noticia => {
                    const imagenRuta = noticia[3] ? `./data/${noticia[3]}` : './data/noticia.jpg';
                    
                    noticiasHTML += `
                        <div class="card">
                            <img src="${imagenRuta}" alt="imagen referente">
                            <div class="card-content">
                                <h3 class="card__titulo">${noticia[1]}</h3>
                                <p class="card__descripcion">${noticia[2].substring(0, 100)}...</p>
								
                            </div>
							<button type="button" class="btn-card" 
                                data-titulo="${noticia[1].replace(/"/g, '&quot;')}"
                                data-contenido="${noticia[2].replace(/"/g, '&quot;')}"
                                data-imagen="${imagenRuta}">
                                Leer más
                            </button>
                            
                        </div>
                    `;
                });

                $("#contenedorNoticias").html(noticiasHTML);

                // Event Delegation para todos los botones
                $(document).on('click', '.btn-card', function() {
                    const titulo = $(this).data('titulo');
                    const contenido = $(this).data('contenido');
                    const imagen = $(this).data('imagen');

                    Swal.fire({
                        title: titulo,
                        html: `
                            <div class="swal2-news-modal">
                                <img src="${imagen}" class="swal2-news-image" alt="Imagen noticia">
                                <div class="swal2-news-content">${contenido}</div>
                            </div>
                        `,
                        showCloseButton: true,
                        width: '60%',
                        customClass: {
                            popup: 'custom-modal',
							htmlContainer: 'news-modal-html-container'
                        }
                    });
                });

            } else {
                $("#contenedorNoticias").html("<p>No hay noticias disponibles.</p>");
            }
        },
        error: function(xhr) {
            console.error("Error:", xhr.responseText);
        }
    });
}

function desactivar(idNoticias)
{
	Swal.fire({
		title: '¿Está seguro de desactivar la noticia?',
		icon: 'warning',
		showCancelButton: true,
		confirmButtonText: 'Sí, desactivar',
		cancelButtonText: 'Cancelar'
	  }).then((result) => {
		if (result.isConfirmed) {
			$.post("controlador/noticia.php?op=desactivar", {idNoticias : idNoticias}, function(e){
        		// bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
		  // Aquí colocas el código para desactivar el usuario
		  Swal.fire(
			'Desactivado!',
			'La Noticia ha sido desactivado.',
			'success'
		  )
		}
	  })
}

//Función para activar registros
function activar(idNoticias)
{
	Swal.fire({
		title: '¿Está seguro de activar la noticia?',
		icon: 'warning',
		showCancelButton: true,
		confirmButtonText: 'Sí, activar',
		cancelButtonText: 'Cancelar'
	  }).then((result) => {
		if (result.isConfirmed) {
			$.post("controlador/noticia.php?op=activar", {idNoticias : idNoticias}, function(e){
        		// bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
		  // Aquí colocas el código para desactivar el usuario
		  Swal.fire(
			'activado!',
			'La Noticia ha sido activado.',
			'success'
		  )
		}
	  })
	  

}
function eliminar(idNoticias)
{
	Swal.fire({
		title: '¿Está seguro de eliminar la noticia?',
		icon: 'warning',
		text: 'Ten en cuenta que no podrás recuperar la información que elimines',
		showCancelButton: true,
		confirmButtonText: 'Sí, eliminar',
		cancelButtonText: 'Cancelar'
	  }).then((result) => {
		if (result.isConfirmed) {
			$.post("controlador/noticia.php?op=eliminar", {idNoticias : idNoticias}, function(e){
        		// bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
		  // Aquí colocas el código para desactivar el usuario
		  Swal.fire(
			' Eliminada!',
			'La Noticia ha sido Eliminada.',
			'success'
		  )
		}
	  })
}
function descargarPDF(idNoticias) {
    window.open('controlador/noticia.php?op=exportarPdf&id=' + idNoticias, '_blank'); 
}
// Cargar noticias cuando la página termine de cargar
$(document).ready(function () {
    listarNoticias();
});


listar();

listarNoticias();
// Modificar el evento DOMContentLoaded
document.addEventListener("DOMContentLoaded", function () {
    // Función para actualizar el nombre del archivo seleccionado
    function actualizarNombreArchivo(input, spanId) {
        let fileName = input.files.length > 0 ? input.files[0].name : "Ningún archivo seleccionado";
        document.getElementById(spanId).textContent = fileName;
    }

    // Verificar si el elemento existe antes de agregar el listener
    const imagenInput = document.getElementById("imagen");
    if (imagenInput) {
        imagenInput.addEventListener("change", function () {
            actualizarNombreArchivo(this, "file-name");
        });
    }
});

// Mover la llamada a init() dentro de DOMContentLoaded
document.addEventListener("DOMContentLoaded", function() {
    init();
});