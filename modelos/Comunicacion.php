<?php
require "../config/Conexion.php";
class Comunicacion
{
	//Implementamos nuestro constructor
	public function __construct()
	{
	}
    public function insertar($idAnuncio,$asunto,$descripcion,$imagenAnuncio)
    {
     $sql=" INSERT INTO `comunicacion`(idAnuncio,asunto,descripcion,imagenAnuncio) 
        
     VALUES ('$idAnuncio','$asunto','$descripcion','$imagenAnuncio')";
     return ejecutarConsulta($sql);
    }
    public function editar($idAnuncio,$asunto,$descripcion,$imagenAnuncio)
    {
     $sql="  UPDATE `comunicacion ` SET `asunto`='$asunto',`descripcion`='$descripcion',`imagenAnuncio`='$imagenAnuncio'
      WHERE `idAnuncio`='$idAnuncio'";
     return ejecutarConsulta($sql);
    }
    public function listar(){
       $sql=" SELECT * FROM comunicacion";
       return ejecutarConsulta($sql);
    }
    
  
    public function mostrar($idAnuncio){
        $sql="SELECT * FROM comunicacion    WHERE idAnuncio='$idAnuncio'";
		return ejecutarConsultaSimpleFila($sql);
    }
   
   
}