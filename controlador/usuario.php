<?php
require_once "../modelos/Usuario.php";

$usuario = new Usuarios();
// ($idUsuario,$nombre,$apellido,$cedula,$idPermiso,$imagenUsuario)
$idUsuario = isset($_POST["idUsuario"]) ? limpiarCadena($_POST["idUsuario"]) : "";
$nombre = isset($_POST["nombre"]) ? limpiarCadena($_POST["nombre"]) : "";
$apellido = isset($_POST["apellido"]) ? limpiarCadena($_POST["apellido"]) : "";
$cedula = isset($_POST["cedula"]) ? limpiarCadena($_POST["cedula"]) : "";
$idPermiso = isset($_POST["idPermiso"]) ? limpiarCadena($_POST["idPermiso"]) : "";
$clave = isset($_POST["clave"]) ? limpiarCadena($_POST["clave"]) : "";
$directorio = "C:/xampp/htdocs/colegio/data/usuarios/";
$rutaImagenBD = "";
$rutaUsuarioBD = "";

switch ($_GET["op"]) {
    case 'guardaryeditar':
        // Manejo de la imagen
        if (isset($_FILES["imagen"]) && is_uploaded_file($_FILES["imagen"]["tmp_name"])) {
            $extension = pathinfo($_FILES["imagen"]["name"], PATHINFO_EXTENSION);
            $nombreImagen = $cedula . "-" . preg_replace("/[^a-zA-Z0-9]/", "_", $tituloUsuario) . "." . $extension;

            $rutaImagen = $directorio . $nombreImagen;

            if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $rutaImagen)) {
                $rutaImagenBD = "usuarios/" . $nombreImagen;
            } else {
                echo "Error al subir la imagen.";
                exit();
            }
        } else {
            $rutaImagenBD = isset($_POST["imagen"]) ? limpiarCadena($_POST["imagen"]) : "imgProductos/no-image.jpg";
        }

        // Manejo del Usuario (solo PDF, Word, Excel)
        if (isset($_FILES["Usuario"]) && is_uploaded_file($_FILES["Usuario"]["tmp_name"])) {
            $extension = pathinfo($_FILES["Usuario"]["name"], PATHINFO_EXTENSION);
            $extensionesPermitidas = ["pdf", "doc", "docx", "xls", "xlsx"];

            if (!in_array(strtolower($extension), $extensionesPermitidas)) {
                echo "Formato de archivo no permitido. Solo PDF, Word y Excel.";
                exit();
            }

            $nombreUsuario = $idUsuario . "-" . $_FILES["Usuario"]["name"];
            $rutaUsuario = $directorio . $nombreUsuario;

            if (move_uploaded_file($_FILES["Usuario"]["tmp_name"], $rutaUsuario)) {
                $rutaUsuarioBD = "usuarios/" . $nombreUsuario;
            } else {
                echo "Error al subir el Usuario.";
                exit();
            }
        } else {
            $rutaUsuarioBD = isset($_POST["Usuario"]) ? limpiarCadena($_POST["Usuario"]) : "";
        }

        if (empty($idUsuario)) {
            // $idUsuario,$nombre,$apellido,$cedula,$idPermiso,$permisos,$imagenUsuario,$clave)
            $rspta = $usuario->insertar($idUsuario, $nombre, $apellido, $cedula, $idPermiso,$_POST['permiso'],$rutaImagenBD, $clave);
            echo $rspta ? "Usuario registrado" : "No se pudo registrar el Usuario";
        } else {
            $rspta = $usuario->editar($idUsuario, $nombre, $apellido, $cedula, $idPermiso, $_POST['permiso'],  $clave);
            echo $rspta ? "Usuario actualizado" : "No se pudo actualizar el Usuario";
        }
        break;

    case 'listar':
      
        $rspta = $usuario->listar();
        // $rspta = $Usuario->listar();
        $data = [];

        while ($reg = $rspta->fetch_object()) {
            $data[] = [
                // "0" => ($reg->estado) ?
                "0" => '<button class="btnEditar" onclick="mostrar(' . $reg->idUsuario . ')"><i class="fa fa-pencil"></i></button>',
                "1" => $reg->nombre.'-'.$reg->apellido,
                "2" => $reg->cedula
               
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
        $rspta = $usuario->mostrar($idUsuario);
        echo json_encode($rspta);
        break;
        case 'permisos':
            //Obtenemos todos los permisos de la tabla permisos
            require_once "../modelos/Permisos.php";
            $permiso = new Permiso();
            $rspta = $permiso->listar();
    
            //Obtener los permisos asignados al usuario
            $id=$_GET['id'];
            $marcados = $usuario->listarmarcados($id);
            //Declaramos el array para almacenar todos los permisos marcados
            $valores=array();
    
            //Almacenar los permisos asignados al usuario en el array
            while ($per = $marcados->fetch_object())
                {
                    array_push($valores, $per->idPermiso);
                }
    
            //Mostramos la lista de permisos en la vista y si están o no marcados
            while ($reg = $rspta->fetch_object())
                    {
                        $sw=in_array($reg->idPermiso,$valores)?'checked':'';
                        echo '<li> <input type="checkbox" class="form-check-input "  '.$sw.'  name="permiso[]" value="'.$reg->idPermiso.'">'.$reg->descripcion.'</li>';
                    }
        break;

        case 'verificar':
            $logina=$_POST['logina'];
            $clavea=$_POST['clavea'];
    
            //Hash SHA256 en la contraseña
    
            $rspta=$usuario->verificar($logina, $clavea);
    
            $fetch=$rspta->fetch_object();
    
            if (isset($fetch))
            {
                //Declaramos las variables de sesión
                $_SESSION['idUsuario']=$fetch->idUsuario;
                $_SESSION['idPermiso']=$fetch->idPermiso;
    
                $_SESSION['login']=$fetch->login;
    
                //Obtenemos los permisos del usuario
                $marcados = $usuario->listarmarcados($fetch->idUsuario);
    
                //Declaramos el array para almacenar todos los permisos marcados
                $valores=array();
    
                //Almacenamos los permisos marcados en el array
                while ($per = $marcados->fetch_object())
                    {
                        array_push($valores, $per->idPermiso);
                    }
    
                //Determinamos los accesos del usuario
                in_array(1,$valores)?$_SESSION['Escritorio']=1:$_SESSION['Escritorio']=0;
                in_array(2,$valores)?$_SESSION['Leyes']=1:$_SESSION['Leyes']=0;
                in_array(3,$valores)?$_SESSION['Tributaria']=1:$_SESSION['Tributaria']=0;
                in_array(4,$valores)?$_SESSION['Multas']=1:$_SESSION['Multas']=0;
                in_array(5,$valores)?$_SESSION['EstatusMulta']=1:$_SESSION['EstatusMulta']=0;
                in_array(6,$valores)?$_SESSION['Acceso']=1:$_SESSION['Acceso']=0;
                in_array(7,$valores)?$_SESSION['Reportes']=1:$_SESSION['Reportes']=0;
                in_array(8,$valores)?$_SESSION['ConsultarFuncionario']=1:$_SESSION['ConsultarFuncionario']=0;
                in_array(9,$valores)?$_SESSION['ConsultarLeyes']=1:$_SESSION['ConsultarLeyes']=0;
                in_array(10,$valores)?$_SESSION['ConsultarCiudadano']=1:$_SESSION['ConsultarCiudadano']=0;
                in_array(11,$valores)?$_SESSION['ConsultarDiaria']=1:$_SESSION['ConsultarDiaria']=0;
                in_array(12,$valores)?$_SESSION['ConsultarGeneral']=1:$_SESSION['ConsultarGeneral']=0;
                in_array(13,$valores)?$_SESSION['ConsultarUbicacion']=1:$_SESSION['ConsultarUbicacion']=0;
                in_array(14,$valores)?$_SESSION['ConsultarEstatus']=1:$_SESSION['ConsultarEstatus']=0;
                in_array(15,$valores)?$_SESSION['BaseDatos']=1:$_SESSION['BaseDatos']=0;
                in_array(16,$valores)?$_SESSION['Estadisticas']=1:$_SESSION['Estadisticas']=0;
            }
            echo json_encode($fetch);
        break;
        case 'salir':
            //Limpiamos las variables de sesión   
            session_unset();
            //Destruìmos la sesión
            session_destroy();
            //Redireccionamos al login
            header("Location: ../vistas/index.html");
    
        break;
    default:
        echo "Operación no válida.";
        break;
}
?>