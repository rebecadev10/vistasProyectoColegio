<?php
require_once "../modelos/Noticias.php";

$noticia = new Noticias();

$idNoticias = isset($_POST["idNoticias"]) ? limpiarCadena($_POST["idNoticias"]) : "";
$titulo = isset($_POST["titulo"]) ? limpiarCadena($_POST["titulo"]) : "";
$descripcion = isset($_POST["descripcion"]) ? limpiarCadena($_POST["descripcion"]) : "";

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
                $rutaImagenBD = "noticias/" . $nombreImagen; // Ruta relativa para la BD
            } else {
                echo "Error al subir la imagen.";
                exit();
            }
        } else {
            // Si no se sube una nueva imagen, mantener la actual (si aplica)
            $rutaImagenBD = isset($_POST["imagenProductoActual"]) ? limpiarCadena($_POST["imagenProductoActual"]) : "imgProductos/no-image.jpg";
        }

        if (empty($idNoticias)) {
            $rspta = $noticia->insertar($idNoticias,$titulo,$descripcion,$nombreImagen);
            echo $rspta ? "noticia registrado" : "No se pudieron registrar todos los datos del noticia";
        } else {
            $rspta = $noticia->editar($idNoticias, $titulo, $descripcion, $rutaImagenBD);
            echo $rspta ? "noticia actualizado" : "noticia no se pudo actualizar";
        }
        break;
    case 'listar':
            $rspta=$noticia->listar();
             //Vamos a declarar un array
             $data= Array();
    
             while ($reg=$rspta->fetch_object()){
                 $data[]=array(
                    "0"=>($reg->estado)?'<button class="btnEditar" onclick="mostrar('.$reg->idNoticias.')"><i class="fa fa-pencil"></i></button>'.
                    ' <button class="btnActivar" onclick="desactivar('.$reg->idNoticias.')"><i class="fa fa-close"></i></button>':
                    '<button class="btnEditar" onclick="mostrar('.$reg->idNoticias.')"><i class="fa fa-pencil"></i></button>'.
                    ' <button class="btnDesactivar" onclick="activar('.$reg->idNoticias.')"><i class="fa fa-check"></i></button>',
        
                    
                    "1"=>$reg->titulo,
                    "2"=>$reg->descripcion,
                    "3"=>$reg->nombreImagenN
                     
                     );
             }
             $results = array(
                 "sEcho"=>1, //Información para el datatables
                 "iTotalRecords"=>count($data), //enviamos el total registros al datatable
                 "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
                 "aaData"=>$data);
             echo json_encode($results);
    
        break;
       
        case 'listarActivos':
            $rspta=$noticia->listarActivo();
             //Vamos a declarar un array
             $data= Array();
    
             while ($reg=$rspta->fetch_object()){
                 $data[]=array(
                    "0"=>($reg->estado)?'<button class="btnEditar" onclick="mostrar('.$reg->idNoticias.')"><i class="fa fa-pencil"></i></button>'.
                    ' <button class="btnActivar" onclick="desactivar('.$reg->idNoticias.')"><i class="fa fa-close"></i></button>':
                    '<button class="btnEditar" onclick="mostrar('.$reg->idNoticias.')"><i class="fa fa-pencil"></i></button>'.
                    ' <button class="btnDesactivar" onclick="activar('.$reg->idNoticias.')"><i class="fa fa-check"></i></button>',
        
                    
                    "1"=>$reg->titulo,
                    "2"=>$reg->descripcion,
                    "3"=>$reg->nombreImagenN
                     
                     );
             }
             $results = array(
                 "sEcho"=>1, //Información para el datatables
                 "iTotalRecords"=>count($data), //enviamos el total registros al datatable
                 "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
                 "aaData"=>$data);
             echo json_encode($results);
    
        break;
       
       
        case 'mostrar':
            $rspta=$noticia->mostrar($idNoticias);
                 //Codificar el resultado utilizando json
            echo json_encode($rspta);   
            break; 
            case 'desactivar':
                $rspta=$noticia->desactivar($idNoticias);
                echo $rspta ? "Noticia Desactivado" : "Noticia no se puede desactivar";
                break;
                case 'activar':
                    $rspta=$noticia->activar($idNoticias);
                    echo $rspta ? "Noticia Activado" : "Noticia no se puede activar";
                    break;
        
    default:
        echo "Operación no válida.";
        break;
}

?>

