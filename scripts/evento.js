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
	 $.post("controlador/evento.php?op=listarDepartamentos", function(response) {
        // Rellenar el select con las opciones recibidas
		console.log(response);
        $("#departamento").html(response); // Agrega las opciones al select
    });
}
function guardaryeditar(e)
{
	e.preventDefault(); //No se activará la acción predeterminada del evento
	$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "controlador/evento.php?op=guardaryeditar",
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
      if (
        respuesta.includes("Evento registrado") ||
        respuesta.includes("Evento actualizado")
      ) {
        redireccion = "eventoEditar.php";
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
		
	    }

	});
	// limpiar();
}
function listar(){
	tabla=$('#tbllistado').dataTable(
		{
			"lengthMenu": [ 5, 10, 25, 75, 100],//mostramos el menú de registros a revisar
			"aProcessing": true,//Activamos el procesamiento del datatables
			"aServerSide": true,//Paginación y filtrado realizados por el servidor
			dom:  "<'topTabla'Bf>" +    // Botones y buscador
            "<'componente__tabla'tr>" + // Tabla
            "<'bottomTabla'ip>",   // Info y paginación", //Definimos los elementos del control de tabla
		buttons: [{
			extend: 'copyHtml5',
			title: 'Data Eventos'
		},{
			extend: 'excelHtml5',
			title: 'Data Eventos'
		},{
			extend: 'csvHtml5',
			title: 'Data Eventos'
		}],
			"ajax":
					{
						url: 'controlador/evento.php?op=listar',
						type : "get",
						dataType : "json",						
						error: function(e){
							console.log(e.responseText);	
						}
					},
			"language": {
				"lengthMenu": "Mostrar : _MENU_ registros",
				"buttons": {
				"copyTitle": "Tabla Copiada",
				"copySuccess": {
						_: '%d líneas copiadas',
						1: '1 línea copiada'
					}
				}
			},
			"bDestroy": true,
			"iDisplayLength": 5,//Paginación
			"order": [[ 0, "desc" ]]//Ordenar (columna,orden)
		}).DataTable();
	}
	function mostrar(idEventos) {
    // Carga la información desde tu controlador usando jQuery
    $.post("controlador/evento.php?op=mostrar", { idEventos: idEventos }, function(data, status) {
        try {
            // Verifica si los datos recibidos son válidos y son JSON
            console.log("Respuesta recibida:", data);
            data = JSON.parse(data);
			mostrarform(true);
            if (data && data.idEventos) {
                // Muestra la información en el formulario
                $("#idEventos").val(data.idEventos);
                $("#titulo").val(data.titulo);
                $("#descripcion").val(data.descripcion);
                    // Manejar el select dinámico
				$('#departamento').val(data.idDepartamento);
				$('#departamentoDescripcion').val(data.nombre); // Intenta seleccionar el valor directamente	
                $("#fechaInicio").val(data.fechaInicio);
                $("#horaInicio").val(data.horaInicio);
                $("#fechaFin").val(data.fechaFin);
                $("#horaFin").val(data.horaFin);
				$("#imagenActual").attr("src", "data/" + data.nombreImagen);
                $("#imagenActual").attr(data.imagen);

              
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
	$("#idEventos").val("");
	$("#titulo").val("");
	$("#descripcion").val("");
	$('#departamento').val("");  
	$("#fechaInicio").val("");
	$("#horaInicio").val("");
	$("#fechaFin").val("");
	$("#horaFin").val("");
	$("#imagen").val("");
	
}
function desactivar(idEventos)
{
	Swal.fire({
		title: '¿Está seguro de desactivar el evento?',
		icon: 'warning',
		showCancelButton: true,
		confirmButtonText: 'Sí, desactivar',
		cancelButtonText: 'Cancelar'
	  }).then((result) => {
		if (result.isConfirmed) {
			$.post("controlador/evento.php?op=desactivar", {idEventos : idEventos}, function(e){
        		// bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
		  // Aquí colocas el código para desactivar el usuario
		  Swal.fire(
			'Desactivado!',
			'El evento ha sido desactivado.',
			'success'
		  )
		}
	  })
	  
	// bootbox.confirm("¿Está Seguro de desactivar el usuario?", function(result){
	// 	if(result)
    //     {
        	
    //     }
	// })
}

//Función para activar registros
function activar(idEventos)
{
	Swal.fire({
		title: '¿Está seguro de activar el evento?',
		icon: 'warning',
		showCancelButton: true,
		confirmButtonText: 'Sí, activar',
		cancelButtonText: 'Cancelar'
	  }).then((result) => {
		if (result.isConfirmed) {
			$.post("controlador/evento.php?op=activar", {idEventos : idEventos}, function(e){
        		// bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
		  // Aquí colocas el código para desactivar el usuario
		  Swal.fire(
			'activado!',
			'El evento ha sido activado.',
			'success'
		  )
		}
	  })
	  

}
	
function cancelar() {
    window.location.href = "eventoEditar.php"; // Cambia "noticias.php" por la URL a la que deseas redirigir
}
document.addEventListener("DOMContentLoaded", function () {
    // Función para actualizar el nombre del archivo seleccionado
    function actualizarNombreArchivo(input, spanId) {
        let fileName = input.files.length > 0 ? input.files[0].name : "Ningún archivo seleccionado";
        document.getElementById(spanId).textContent = fileName;
    }

    // Detectar cambios en el input de imagen
    document.getElementById("imagen").addEventListener("change", function () {
        actualizarNombreArchivo(this, "file-name");
    });


});
function eliminar(idEventos)
{
	Swal.fire({
		title: '¿Está seguro de eliminar el evento?',
		icon: 'warning',
		text: 'Ten en cuenta que no podrás recuperar la información que elimines',
		showCancelButton: true,
		confirmButtonText: 'Sí, eliminar',
		cancelButtonText: 'Cancelar'
	  }).then((result) => {
		if (result.isConfirmed) {
			$.post("controlador/evento.php?op=eliminar", {idEventos : idEventos}, function(e){
        		// bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
		  // Aquí colocas el código para desactivar el usuario
		  Swal.fire(
			' Eliminada!',
			'El evento ha sido Eliminada.',
			'success'
		  )
		}
	  })
}
function descargarPDF(idEventos) {
    window.open('controlador/evento.php?op=exportarPdf&id=' + idEventos, '_blank'); 
}
init();