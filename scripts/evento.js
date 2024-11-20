function init(){
	// // 
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
	        //   bootbox.alert(datos);	          
	        //   mostrarform(false);
	        //   tabla.ajax.reload();
            window.alert("Exito!");
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
			dom: '<Bl<f>rtip>',//Definimos los elementos del control de tabla
			buttons: [		          
						'copyHtml5',
						'excelHtml5',
						'csvHtml5',
						'pdf'
					],
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
init();