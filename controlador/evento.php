<?php
require_once "../modelos/Eventos.php";
require_once '../public/fpdf186/fpdf.php';
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
$directorio = "C:/xampp/htdocs/colegio/data/eventos/";
$rutaImagenBD = ""; // Variable para guardar la ruta en la BD

switch ($_GET["op"]) {
    case 'guardaryeditar':
        // Verificar si se subió una imagen
        if (isset($_FILES["imagen"]) && is_uploaded_file($_FILES["imagen"]["tmp_name"])) {
            $imagen = $_FILES["imagen"];
            // Limpiar el título (eliminar caracteres especiales y espacios)
            $tituloLimpio = preg_replace("/[^a-zA-Z0-9]/", "_", trim($titulo));

            // Obtener la extensión del archivo
            $extension = pathinfo($imagen["name"], PATHINFO_EXTENSION);

            // Generar el nuevo nombre de la imagen con ID y título limpio
            $nombreImagen = $idEventos . $tituloLimpio . "." . $extension;
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
            $rspta = $evento->insertar($idEventos, $titulo, $descripcion, $rutaImagenBD, $departamento, $fechaInicio, $horaInicio, $fechaFin, $horaFin);
            echo $rspta ? "Evento registrado" : "No se pudieron registrar todos los datos del evento";
        } else {
            $rspta = $evento->editar($idEventos, $titulo, $descripcion, $rutaImagenBD, $departamento, $fechaInicio, $horaInicio, $fechaFin, $horaFin);
            echo $rspta ? "Evento actualizado" : "Evento no se pudo actualizar";
        }
        break;
    case 'listar':
        $rspta = $evento->listarRegistros();
        //Vamos a declarar un array
        $data = array();

        while ($reg = $rspta->fetch_object()) {
            $data[] = array(
                "0" => ($reg->estado) ? '<button class="btnEditar" onclick="mostrar(' . $reg->idEventos . ')"><i class="fa fa-pencil"></i></button>' .
                    ' <button class="btnDesactivar" onclick="desactivar(' . $reg->idEventos . ')"><i class="fa-solid fa-toggle-on"></i></button>' .
                    ' <button class="btnEliminar" onclick="eliminar(' . $reg->idEventos . ')"><i class="fa-solid fa-trash"></i></button>' .
                    ' <button class="btnPDF" onclick="descargarPDF(' . $reg->idEventos . ')"><i class="fa-solid fa-file-pdf"></i></button>' :
                    '<button class="btnEditar" onclick="mostrar(' . $reg->idEventos . ')"><i class="fa fa-pencil"></i></button>' .
                    ' <button class="btnActivar" onclick="activar(' . $reg->idEventos . ')"><i class="fa-solid fa-toggle-off"></i></button>' .
                    '<button class="btnEliminar" onclick="eliminar(' . $reg->idEventos . ')"><i class="fa-solid fa-trash"></i></button>' .
                    ' <button class="btnPDF" onclick="descargarPDF(' . $reg->idEventos . ')"><i class="fa-solid fa-file-pdf"></i></button>',
                //  "0"=>' <button  onclick="mostrar('.$reg->idEventos.')"><i class="fa-solid fa-pen-to-square"></i></button>',
                "1" => $reg->titulo,
                "2" => $reg->nombre,
                "3" => $reg->fechaInicio,
                "4" => $reg->horaInicio,
                "5" => $reg->fechaFin,
                "6" => $reg->horaFin,



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
    case 'listarCalendario':
        $rspta = $evento->listar();
        // Declarar un array
        $data = array();
        $rutaBase = "http://localhost/colegio/data/"; // URL base accesible desde el navegador
        while ($reg = $rspta->fetch_object()) {
            $data[] = array(
                "id" => $reg->idEventos,
                "title" => $reg->titulo,
                "description" => $reg->descripcion,
                "start" => $reg->fechaInicio . 'T' . $reg->horaInicio,
                "end" => $reg->fechaFin . 'T' . $reg->horaFin,
                "department" => $reg->nombre,
                "image" => $rutaBase . $reg->nombreImagen // Ajusta según el nombre del campo en tu base de datos
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
        $rspta = $evento->mostrar($idEventos);
        //Codificar el resultado utilizando json
        echo json_encode($rspta);
        break;
    case 'desactivar':
        $rspta = $evento->desactivar($idEventos);
        echo $rspta ? "Evento Desactivado" : "Evento no se puede desactivar";
        break;
    case 'activar':
        $rspta = $evento->activar($idEventos);
        echo $rspta ? "Evento Activado" : "Evento no se puede activar";
        break;
    case 'eliminar':
        $rspta = $evento->eliminar($idEventos);
        echo $rspta ? "Evento Eliminado" : "Evento no se puede eliminar";
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
                $this->Cell(160, 10, 'U.E. Manuel Diaz Rodriguez',0, 0, 'R');
                // Salto de línea
                $this->Ln(20);
                $this->SetFont('Arial', 'B', 16);

                $this->SetTextColor(3,4,94);
                // Título centrado
                $this->Cell(0, 10, 'REPORTE DE EVENTO', 0, 1, 'C');
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
        $idEventos = isset($_GET['id']) ? intval($_GET['id']) : 0;
        if ($idEventos == 0) {
            ob_end_clean();
            die(json_encode(['error' => 'ID inválido']));
        }

        // Obtener datos
        $rspta = $evento->detalleEvento($idEventos);
        $reg = $rspta->fetch_object();

        if (!$reg) {
            ob_end_clean();
            die(json_encode(['error' => 'Evento no encontrado']));
        }

        // Crear PDF
        $pdf = new PDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 12);

        // Contenido principal
        $pdf->SetX(25); // Respeta margen izquierdo

        // Título del evento
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->MultiCell(0, 8,utf8_decode('Título: '). utf8_decode($reg->titulo), 0, 'L');
        $pdf->Ln(12);

        // Detalles del evento
        $detalles = [
            'Fecha de Inicio' => date('d/m/Y', strtotime($reg->fechaInicio)) . ' - ' . $reg->horaInicio,
            'Fecha de Fin' => date('d/m/Y', strtotime($reg->fechaFin)) . ' - ' . $reg->horaFin,
            'Departamento' => utf8_decode($reg->nombre),
        ];

        foreach ($detalles as $titulo => $valor) {
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(50, 8, $titulo . ':', 0, 0);
            $pdf->SetFont('Arial', '', 12);
            $pdf->MultiCell(0, 8, $valor, 0, 'L');
            $pdf->Ln(5);
        }

        $pdf->Ln(10);

        // Descripción
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 8, utf8_decode('DESCRIPCIÓN DEL EVENTO:'), 0, 1);
        $pdf->SetFont('Arial', '', 12);
        $pdf->MultiCell(0, 8, utf8_decode($reg->descripcion), 0, 'J');

        // Salida
        ob_end_clean();
        $pdf->Output('D', 'Reporte_Evento_' . $idEventos . '.pdf');
        exit();
        break;
    default:
        echo "Operación no válida.";
        break;
}

?>