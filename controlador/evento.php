<?php
require_once "../modelos/Eventos.php";

$evento = new Eventos();

$idEventos = isset($_POST["idEventos"]) ? limpiarCadena($_POST["idEventos"]) : "";
$titulo = isset($_POST["titulo"]) ? limpiarCadena($_POST["titulo"]) : "";
$descripcion = isset($_POST["descripcion"]) ? limpiarCadena($_POST["descripcion"]) : "";
$departamento = isset($_POST["departamento"]) ? limpiarCadena($_POST["departamento"]) : "";
$fechaInicio = isset($_POST["fechaInicio"]) ? limpiarCadena($_POST["fechaInicio"]) : "";
$horaInicio = isset($_POST["horaInicio"]) ? limpiarCadena($_POST["horaInicio"]) : "";
$fechaFin = isset($_POST["fechaFin"]) ? limpiarCadena($_POST["fechaFin"]) : "";
$horaFin = isset($_POST["horaFin"]) ? limpiarCadena($_POST["horaFin"]) : "";

// Directorio para guardar imágenes
$directorio = "C:/xampp/htdocs/colegio/data/";
$rutaImagenBD = ""; // Variable para guardar la ruta en la BD

switch ($_GET["op"]) {
    case 'guardaryeditar':
        // Verificar si se subió una imagen
        if (isset($_FILES["imagen"]) && is_uploaded_file($_FILES["imagen"]["tmp_name"])) {
            $imagen = $_FILES["imagen"];
            // Generar un nombre único para la imagen
            $nombreImagen = uniqid() . "-" . basename($imagen["name"]);
            $rutaImagen = $directorio . $nombreImagen;

            // Intentar mover el archivo al directorio
            if (move_uploaded_file($imagen["tmp_name"], $rutaImagen)) {
                $rutaImagenBD = "eventos/" . $nombreImagen; // Ruta relativa para la BD
            } else {
                echo "Error al subir la imagen.";
                exit();
            }
        } else {
            // Si no se sube una nueva imagen, mantener la actual (si aplica)
            $rutaImagenBD = isset($_POST["imagenProductoActual"]) ? limpiarCadena($_POST["imagenProductoActual"]) : "imgProductos/no-image.jpg";
        }

        if (empty($idEventos)) {
            $rspta = $evento->insertar($idEventos,$titulo,$descripcion,$nombreImagen,$departamento,$fechaInicio,$horaInicio,$fechaFin,$horaFin);
            echo $rspta ? "Evento registrado" : "No se pudieron registrar todos los datos del evento";
        } else {
            $rspta = $evento->editar($idEventos, $titulo, $descripcion, $rutaImagenBD, $departamento, $fechaInicio, $horaInicio, $fechaFin, $horaFin);
            echo $rspta ? "Evento actualizado" : "Evento no se pudo actualizar";
        }
        break;
    case 'listar':
            $rspta=$evento->listarRegistros();
             //Vamos a declarar un array
             $data= Array();
    
             while ($reg=$rspta->fetch_object()){
                 $data[]=array(
                    "0"=>($reg->estado)?'<button class="btnEditar" onclick="mostrar('.$reg->idEventos.')"><i class="fa fa-pencil"></i></button>'.
		 					' <button class="btnActivar" onclick="desactivar('.$reg->idEventos.')"><i class="fa fa-close"></i></button>':
		 					'<button class="btnEditar" onclick="mostrar('.$reg->idEventos.')"><i class="fa fa-pencil"></i></button>'.
		 					' <button class="btnDesactivar" onclick="activar('.$reg->idEventos.')"><i class="fa fa-check"></i></button>',
                    //  "0"=>' <button  onclick="mostrar('.$reg->idEventos.')"><i class="fa-solid fa-pen-to-square"></i></button>',
                    "1"=>$reg->titulo,
                    "2"=>$reg->nombre, 	 
                    "3"=>$reg->fechaInicio,
                    "4"=>$reg->horaInicio,
                     
                     
                     );
             }
             $results = array(
                 "sEcho"=>1, //Información para el datatables
                 "iTotalRecords"=>count($data), //enviamos el total registros al datatable
                 "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
                 "aaData"=>$data);
             echo json_encode($results);
    
        break;
        case 'listarCalendario':
            $rspta = $evento->listar();
            // Declarar un array
            $data = Array();
            $rutaBase = "http://localhost/colegio/data/"; // URL base accesible desde el navegador
            while ($reg = $rspta->fetch_object()) {
                $data[] = array(
                    "id" => $reg->idEventos,
                    "title" => $reg->titulo,
                    "start" => $reg->fechaInicio . 'T' . $reg->horaInicio,
                    "end" => $reg->fechaFin . 'T' . $reg->horaFin,
                    "department" => $reg->nombre,
                    "image" =>$rutaBase. $reg->nombreImagen // Ajusta según el nombre del campo en tu base de datos
                );
            }
            $results = array(
                "sEcho" => 1, // Información para el DataTables
                "iTotalRecords" => count($data), // Total de registros
                "iTotalDisplayRecords" => count($data), // Total de registros a visualizar
                "aaData" => $data
            );
            echo json_encode($results);
            break;
        
        case 'listarDepartamentos':
            $rspta = $evento->listarDepartamentos();
            
            if ($rspta) {
                while ($reg = $rspta->fetch_object()) {
                    echo '<option value="' . $reg->idDepartamento . '">' . $reg->nombre . '</option>';
                }
            } else {
                echo '<option value="">No se encontraron departamentos</option>';
            }
            break;
        case 'mostrar':
            $rspta=$evento->mostrar($idEventos);
                 //Codificar el resultado utilizando json
            echo json_encode($rspta);   
            break; 
        case 'desactivar':
            $rspta=$evento->desactivar($idEventos);
            echo $rspta ? "Evento Desactivado" : "Evento no se puede desactivar";
            break;
            case 'activar':
                $rspta=$evento->activar($idEventos);
                echo $rspta ? "Evento Activado" : "Evento no se puede activar";
                break;
    default:
        echo "Operación no válida.";
        break;
}

?>

