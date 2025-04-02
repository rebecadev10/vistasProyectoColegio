<?php
require_once "../modelos/Comunicacion.php";

$comunicacion = new Comunicacion();
// $idAnuncio,$asunto,$descripcion,$imagenAnuncio)
$idAnuncio = isset($_POST["idAnuncio"]) ? limpiarCadena($_POST["idAnuncio"]) : "";
$asunto = isset($_POST["asunto"]) ? limpiarCadena($_POST["asunto"]) : "";
$descripcion = isset($_POST["descripcion"]) ? limpiarCadena($_POST["descripcion"]) : "";

// Directorio para guardar imágenes
$directorio = "C:/xampp/htdocs/colegio/data/comunicacion/";
$rutaImagenBD = ""; // Variable para guardar la ruta en la BD

// manejo de fecha
$fecha = new DateTime('now', new DateTimeZone('America/Caracas'));
$fecha_mysql = $fecha->format('Y-m-d H:i:s');
switch ($_GET["op"]) {
    case 'guardaryeditar':
        // Verificar si se subió una imagen
        // Verificar si se subió una imagen
        if (isset($_FILES["imagen"]) && is_uploaded_file($_FILES["imagen"]["tmp_name"])) {
            $imagen = $_FILES["imagen"];

            // Limpiar el título (eliminar caracteres especiales y espacios)
            $asuntoLimpio = preg_replace("/[^a-zA-Z0-9]/", "_", trim($asunto));

            // Obtener la extensión del archivo
            $extension = pathinfo($imagen["name"], PATHINFO_EXTENSION);

            // Generar el nuevo nombre de la imagen con ID y título limpio
            $nombreImagen = $idAnuncio . $asuntoLimpio . "." . $extension;
            $rutaImagen = $directorio . $nombreImagen;

            // Intentar mover el archivo al directorio
            if (move_uploaded_file($imagen["tmp_name"], $rutaImagen)) {
                $rutaImagenBD = "comunicacion/" . $nombreImagen; // Ruta relativa para la BD
            } else {
                echo "Error al subir la imagen.";
                exit();
            }


        } else {
            // Si no se sube una nueva imagen, mantener la actual (si aplica)
            $rutaImagenBD = isset($_POST["imagenProductoActual"]) ? limpiarCadena($_POST["imagenProductoActual"]) : "imgProductos/no-image.jpg";
        }

        if (empty($idAnuncio)) {
            $rspta = $comunicacion->insertar($idAnuncio, $asunto, $descripcion, $rutaImagenBD,$fecha_mysql);
            echo $rspta ? "comunicacion registrado" : "No se pudieron registrar todos los datos del noticia";
        } else {
            $rspta = $comunicacion->editar($idAnuncio, $asunto, $descripcion, $rutaImagenBD);
            echo $rspta ? "noticia actualizado" : "noticia no se pudo actualizar";
        }
        break;
    case 'listar':
        $rspta = $comunicacion->listar();
        //Vamos a declarar un array
        $data = array();

        while ($reg = $rspta->fetch_object()) {
            $data[] = array(
                "0" =>'<button class="btnEditar" onclick="mostrar(' . $reg->idAnuncio . ')"><i class="fa fa-pencil"></i></button>',
                "1" => $reg->asunto,
                "2" => $reg->descripcion,
                "3" => $reg->imagenAnuncio

            );
        }
        $results = array(
            "sEcho" => 1, //Información para el datatables
            "iTotalRecords" => count($data), //enviamos el total registros al datatable
            "iTotalDisplayRecords" => count($data), //enviamos el total registros a visualizar
            "aaData" => $data
        );
        echo json_encode($results);

        break;
    case 'mostrar':
        $rspta = $comunicacion->mostrar($idAnuncio);
        //Codificar el resultado utilizando json
        echo json_encode($rspta);
        break;
    
    default:
        echo "Operación no válida.";
        break;
}

?>