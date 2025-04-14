<?php
require_once "../modelos/Comunicacion.php";
require_once '../public/fpdf186/fpdf.php';

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
            $rspta = $comunicacion->insertar($idAnuncio, $asunto, $descripcion, $rutaImagenBD, $fecha_mysql);
            echo $rspta ? "anuncio registrado" : "No se pudieron registrar todos los datos del noticia";
        } else {
            $rspta = $comunicacion->editar($idAnuncio, $asunto, $descripcion, $rutaImagenBD);
            echo $rspta ? "anuncio actualizado" : "noticia no se pudo actualizar";
        }
        break;
    case 'listar':
        $rspta = $comunicacion->listar();
        //Vamos a declarar un array
        $data = array();

        while ($reg = $rspta->fetch_object()) {
            $data[] = array(
                "0" => '<button class="btnEditar" onclick="mostrar(' . $reg->idAnuncio . ')"><i class="fa fa-pencil"></i></button>' .
                    ' <button class="btnEliminar" onclick="eliminar(' . $reg->idAnuncio . ')"><i class="fa-solid fa-trash"></i></button>'. 
                    ' <button class="btnPDF" onclick="descargarPDF(' . $reg->idAnuncio . ')"><i class="fa-solid fa-file-pdf"></i></button>'  ,
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
    case 'eliminar':
        $rspta = $comunicacion->eliminar($idAnuncio);
        echo $rspta ? "Anuncio Eliminado" : "Anucio no se puede eliminar";
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
        $idAnuncio = isset($_GET['id']) ? intval($_GET['id']) : 0;
        if ($idAnuncio == 0) {
            ob_end_clean();
            die(json_encode(['error' => 'ID inválido']));
        }

        // Obtener datos
        $rspta = $comunicacion->detalleAnuncio($idAnuncio);
        $reg = $rspta->fetch_object();

        if (!$reg) {
            ob_end_clean();
            die(json_encode(['error' => 'anuncio no encontrado']));
        }

        // Crear PDF
        $pdf = new PDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 12);

        // Contenido principal
        $pdf->SetX(25); // Respeta margen izquierdo

        // Título del anuncio
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->MultiCell(0, 8, utf8_decode('Asunto: ') . utf8_decode($reg->asunto), 0, 'L');
        $pdf->Ln(12);




        // Descripción
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 8, utf8_decode('DESCRIPCIÓN:'), 0, 1);
        $pdf->SetFont('Arial', '', 12);
        $pdf->MultiCell(0, 8, utf8_decode($reg->descripcion), 0, 'J');
        $pdf->Cell(0, 8, utf8_decode('Fecha de publicación:'), 0, 1);
        $pdf->Cell(0, 8,($reg->fechaPublicacion), 0, 1);
        
        // Detalles del recurso
       
        // Salida
        ob_end_clean();
        $pdf->Output('D', 'Reporte_recurso_' . $idAnuncio . '.pdf');
        exit();
        break;
    default:
        echo "Operación no válida.";
        break;
}

?>