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
}