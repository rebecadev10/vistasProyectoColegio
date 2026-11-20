<?php
require "../config/Conexion.php";
class Permiso
{
	//Implementamos nuestro constructor
	public function __construct()
	{
	}

    public function listar()
	{
		$sql="SELECT * FROM permisos";
		return ejecutarConsulta($sql);		
	}
	public function formatearFecha($fecha) {
		$meses = [
			'01' => 'enero', '02' => 'febrero', '03' => 'marzo',
			'04' => 'abril', '05' => 'mayo', '06' => 'junio',
			'07' => 'julio', '08' => 'agosto', '09' => 'septiembre',
			'10' => 'octubre', '11' => 'noviembre', '12' => 'diciembre'
		];
		
		$partes = explode('-', date('d-m-Y-H-i', strtotime($fecha)));
		return sprintf('%d de %s de %d a las %d:%02d',
			$partes[0],
			$meses[$partes[1]],
			$partes[2],
			$partes[3],
			$partes[4]
		);
	  }
}