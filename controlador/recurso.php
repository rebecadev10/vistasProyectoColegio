<?php
require_once "../modelos/Recursos.php";
require_once '../public/fpdf186/fpdf.php';

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
            $nombreImagen = $fechaPublicacion . "-" . preg_replace("/[^a-zA-Z0-9]/", "_", $tituloRecurso) . "." . $extension;

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

            $nombreRecurso = $idRecursos . "-" . $_FILES["recurso"]["name"];
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
            $rspta = $recurso->editar($idRecursos, $tituloRecurso, $descripcion, $autor, $fechaPublicacion, $editorial, $departamento, $rutaImagenBD, $rutaRecursoBD);
            echo $rspta ? "Recurso actualizado" : "No se pudo actualizar el recurso";
        }
        break;

    case 'listar':
        $buscarTitulo = isset($_GET['buscarTitulo']) ? $_GET['buscarTitulo'] : '';
        $filtroDepartamento = isset($_GET['departamento']) ? $_GET['departamento'] : '';

        $rspta = $recurso->listar($buscarTitulo, $filtroDepartamento);
        // $rspta = $recurso->listar();
        $data = [];

        while ($reg = $rspta->fetch_object()) {
            $data[] = [
                // "0" => ($reg->estado) ?
                "0" => '<button class="btnEditar" onclick="mostrar(' . $reg->idRecursos . ')"><i class="fa fa-pencil"></i></button>' .
                    ' <button class="btnEliminar" onclick="eliminar(' . $reg->idRecursos . ')"><i class="fa-solid fa-trash"></i></button>'. 
                    ' <button class="btnPDF" onclick="descargarPDF(' . $reg->idRecursos . ')"><i class="fa-solid fa-file-pdf"></i></button>'  ,
                "1" => $reg->tituloRecurso,
                "2" => $reg->descripcion,
                "3" => $reg->autor,
                "4" => $reg->fechaPublicacion,
                "5" => $reg->editorial,
                "6" => $reg->fotoPortada,
                "7" => $reg->dataRecurso
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
    case 'eliminar':
        $rspta = $recurso->eliminar($idRecursos);
        echo $rspta ? "Recurso Eliminado" : "Recurso no se puede eliminar";
        break;
    case 'exportarPdf':
        date_default_timezone_set('America/Caracas');

        // Configuración inicial
        ob_start();

        class PDF extends FPDF
        {
            private $fechaGeneracion;

            function __construct()
            {
                parent::__construct();
                $this->SetMargins(25, 25, 25); // Márgenes izquierdo, superior y derecho
                $this->SetAutoPageBreak(true, 25); // Margen inferior
            }

            function Header()
            {
                // Logo
                $this->Image('../public/img/logos/logo.jpeg', 10, 8, 33);
                // Arial bold 15
                $this->SetFont('Arial', 'B', 12);
                $this->SetTextColor(128);
                // Movernos a la derecha

                // Título
                $this->Cell(160, 10, 'U.E. Manuel Diaz Rodriguez', 0, 0, 'R');
                // Salto de línea
                $this->Ln(20);
                $this->SetFont('Arial', 'B', 16);

                $this->SetTextColor(3, 4, 94);
                // Título centrado
                $this->Cell(0, 10, 'REPORTE DE RECURSO', 0, 1, 'C');
                $this->Ln(15); // Espacio después del título
            }

            function Footer()
            {
                $this->SetY(-20); // Posicionar a 20mm del fondo
                $this->SetFont('Arial', 'I', 10);
                require_once "../modelos/Permisos.php";
                $permiso = new Permiso();
                // Formatear fecha en español
                $fecha = $permiso->formatearFecha(date('d-m-Y H:i'));

                // Texto alineado a la derecha
                $this->Cell(0, 6, 'Los Teques, ' . $fecha, 0, 0, 'R');
            }


        }

        // Validar ID
        $idRecursos = isset($_GET['id']) ? intval($_GET['id']) : 0;
        if ($idRecursos == 0) {
            ob_end_clean();
            die(json_encode(['error' => 'ID inválido']));
        }

        // Obtener datos
        $rspta = $recurso->detalleRecurso($idRecursos);
        $reg = $rspta->fetch_object();

        if (!$reg) {
            ob_end_clean();
            die(json_encode(['error' => 'recurso no encontrado']));
        }

        // Crear PDF
        $pdf = new PDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 12);

        // Contenido principal
        $pdf->SetX(25); // Respeta margen izquierdo

        // Título del recurso
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->MultiCell(0, 8, utf8_decode('Título: ') . utf8_decode($reg->tituloRecurso), 0, 'L');
        $pdf->Ln(12);




        // Descripción
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 8, utf8_decode('DESCRIPCIÓN:'), 0, 1);
        $pdf->SetFont('Arial', '', 12);
        $pdf->MultiCell(0, 8, utf8_decode($reg->descripcion), 0, 'J');

        // Detalles del recurso
        $detalles = [
            'Autor' => utf8_decode($reg->autor),
            utf8_decode('Fecha de publicación') => date('d/m/Y', strtotime($reg->fechaPublicacion)) ,
            'Editorial' => utf8_decode($reg->editorial),
            'Departamento' => utf8_decode($reg->nombre),
        ];

        foreach ($detalles as $titulo => $valor) {
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(50, 8, $titulo . ':', 0, 0);
            $pdf->SetFont('Arial', '', 12);
            $pdf->MultiCell(0, 8, $valor, 0, 'L');
            $pdf->Ln(5);
        }
        // Salida
        ob_end_clean();
        $pdf->Output('D', 'Reporte_recurso_' . $idRecursos . '.pdf');
        exit();
        break;
    default:
        echo "Operación no válida.";
        break;
}
?>