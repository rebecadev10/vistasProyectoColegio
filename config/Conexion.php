<?php 
require_once "global.php";

mysqli_report(MYSQLI_REPORT_OFF);
$conexion = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME, DB_PORT);

mysqli_query($conexion, 'SET NAMES "'.DB_ENCODE.'"');

// Si tenemos un posible error en la conexión lo mostramos
if (mysqli_connect_errno())
{
	printf("Falló conexión a la base de datos: %s\n", mysqli_connect_error());
	exit();
}

if (!function_exists('ejecutarConsulta'))
{
	function ejecutarConsulta($sql)
	{
		global $conexion;
		try {
			$query = $conexion->query($sql);
			return $query;
		} catch (Exception $e) {
			error_log("Error SQL: " . $e->getMessage() . " en query: " . $sql);
			return false;
		}
	}

	function ejecutarConsultaSimpleFila($sql)
	{
		global $conexion;
		try {
			$query = $conexion->query($sql);		
			$row = $query ? $query->fetch_assoc() : false;
			return $row;
		} catch (Exception $e) {
			error_log("Error SQL: " . $e->getMessage() . " en query: " . $sql);
			return false;
		}
	}

	function ejecutarConsulta_retornarID($sql)
	{
		global $conexion;
		try {
			$query = $conexion->query($sql);        
			return $query ? $conexion->insert_id : 0;
		} catch (Exception $e) {
			error_log("Error SQL: " . $e->getMessage() . " en query: " . $sql);
			return 0;
		}
	}


	function limpiarCadena($str)
	{
		global $conexion;
		$str = mysqli_real_escape_string($conexion,trim($str));
		return htmlspecialchars($str);
	}
}
?>