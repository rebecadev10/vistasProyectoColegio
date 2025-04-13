<?php
require "../config/Conexion.php";
class Comunicacion
{
	//Implementamos nuestro constructor
	public function __construct()
	{
	}
    public function insertar($idAnuncio,$asunto,$descripcion,$imagenAnuncio,$fecha)
    {
     $sql=" INSERT INTO `comunicacion`(idAnuncio,asunto,descripcion,imagenAnuncio,fecha) 
        
     VALUES ('$idAnuncio','$asunto','$descripcion','$imagenAnuncio','$fecha')";
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

    public function eliminar ($idAnuncio){
        $sql="DELETE FROM comunicacion WHERE idAnuncio='$idAnuncio'";
        return ejecutarConsulta($sql);
    }
   
   
}