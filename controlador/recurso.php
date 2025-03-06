<?php
require_once "../modelos/Recursos.php";

$recurso = new recursos();

$idRecursos = isset($_POST["idRecursos"]) ? limpiarCadena($_POST["idRecursos"]) : "";
$tituloRecurso = isset($_POST["tituloRecurso"]) ? limpiarCadena($_POST["tituloRecurso"]) : "";
$descripcion = isset($_POST["descripcion"]) ? limpiarCadena($_POST["descripcion"]) : "";
$autor = isset($_POST["autor"]) ? limpiarCadena($_POST["autor"]) : "";
$fechaPublicacion = isset($_POST["fechaPublicacion"]) ? limpiarCadena($_POST["fechaPublicacion"]) : "";
$editorial = isset($_POST["editorial"]) ? limpiarCadena($_POST["editorial"]) : "";
$departamento = isset($_POST["departamento"]) ? limpiarCadena($_POST["departamento"]) : "";

$directorio = "C:/xampp/htdocs/colegio/data/recursos/";
$rutaImagenBD = "";
$rutaRecursoBD = "";

switch ($_GET["op"]) {
    case 'guardaryeditar':
        // Manejo de la imagen
        if (isset($_FILES["imagen"]) && is_uploaded_file($_FILES["imagen"]["tmp_name"])) {
            $extension = pathinfo($_FILES["imagen"]["name"], PATHINFO_EXTENSION);
            $nombreImagen = uniqid() . "." . $extension;
            $rutaImagen = $directorio . $nombreImagen;

            if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $rutaImagen)) {
                $rutaImagenBD = "recursos/" . $nombreImagen;
            } else {
                echo "Error al subir la imagen.";
                exit();
            }
        } else {
            $rutaImagenBD = isset($_POST["imagen"]) ? limpiarCadena($_POST["imagen"]) : "imgProductos/no-image.jpg";
        }

        // Manejo del recurso (solo PDF, Word, Excel)
        if (isset($_FILES["recurso"]) && is_uploaded_file($_FILES["recurso"]["tmp_name"])) {
            $extension = pathinfo($_FILES["recurso"]["name"], PATHINFO_EXTENSION);
            $extensionesPermitidas = ["pdf", "doc", "docx", "xls", "xlsx"];

            if (!in_array(strtolower($extension), $extensionesPermitidas)) {
                echo "Formato de archivo no permitido. Solo PDF, Word y Excel.";
                exit();
            }

            $nombreRecurso =$_FILES["recurso"]["name"];
            $rutaRecurso = $directorio . $nombreRecurso;

            if (move_uploaded_file($_FILES["recurso"]["tmp_name"], $rutaRecurso)) {
                $rutaRecursoBD = "recursos/" . $nombreRecurso;
            } else {
                echo "Error al subir el recurso.";
                exit();
            }
            } else {
                $rutaRecursoBD = isset($_POST["recurso"]) ? limpiarCadena($_POST["recurso"]) : "";
            }

        if (empty($idRecursos)) {
            $rspta = $recurso->insertar($idRecursos, $tituloRecurso, $descripcion, $autor, $fechaPublicacion, $editorial, $departamento, $rutaImagenBD, $rutaRecursoBD);
            echo $rspta ? "Recurso registrado" : "No se pudo registrar el recurso";
        } else {
            $rspta = $recurso->editar($idRecursos, $tituloRecurso, $descripcion,$autor, $fechaPublicacion, $editorial, $departamento, $rutaImagenBD, $rutaRecursoBD);
            echo $rspta ? "Recurso actualizado" : "No se pudo actualizar el recurso";
        }
        break;

    case 'listar':
        $rspta = $recurso->listar();
        $data = [];

        while ($reg = $rspta->fetch_object()) {
            $data[] = [
                // "0" => ($reg->estado) ?
                "0"=>'<button class="btnEditar" onclick="mostrar(' . $reg->idRecursos . ')"><i class="fa fa-pencil"></i></button>',
                "1" => $reg->tituloRecurso,
                "2" => $reg->descripcion,
                "3" => $reg->fotoPortada
            ];
        }

        $results = [
            "sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data
        ];
        echo json_encode($results);
        break;

    case 'mostrar':
        $rspta = $recurso->mostrar($idRecursos);
        echo json_encode($rspta);
        break;

    default:
        echo "Operación no válida.";
        break;
}
?>
