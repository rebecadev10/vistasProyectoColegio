<?php
require "../config/Conexion.php";
class Noticias
{
	//Implementamos nuestro constructor
	public function __construct()
	{
	}
    public function insertar($idNoticias,$titulo,$descripcion,$nombreImagenN)
    {
     $sql="   INSERT INTO  noticias ( idNoticias ,  titulo ,  descripcion ,  nombreImagenN,estado ) 
     VALUES ('$idNoticias','$titulo','$descripcion','$nombreImagenN','1')";
     return ejecutarConsulta($sql);
    }
    public function editar($idNoticias,$titulo,$descripcion,$nombreImagenN)
    {
     $sql="  UPDATE noticias SET titulo='$titulo',descripcion='$descripcion',nombreImagenN='$nombreImagenN'
      WHERE `idNoticias`='$idNoticias'";
     return ejecutarConsulta($sql);
    }
    public function listar(){
       $sql=" SELECT * FROM noticias";
       return ejecutarConsulta($sql);
    }
    public function listarActivo(){
      $sql=" SELECT * FROM noticias WHERE estado='1'";
      return ejecutarConsulta($sql);
   }
   
  
    public function mostrar($idNoticias){
        $sql="SELECT * FROM noticias    WHERE idNoticias='$idNoticias'";
		return ejecutarConsultaSimpleFila($sql);
    }
   
    public function desactivar($idNoticias)
    {
      $sql="UPDATE noticias SET estado='0' WHERE idNoticias='$idNoticias'";
  
      //$sql = "UPDATE `usuario` SET `estatus` = '0' WHERE `usuario`.`ObjUsuario` = '$ObjUsuario'";
  
      return ejecutarConsulta($sql);
    }
    public function activar($idNoticias)
    {
      $sql="UPDATE noticias SET estado='1' WHERE idNoticias='$idNoticias'";
  
      //$sql = "UPDATE `usuario` SET `estatus` = '1' WHERE `usuario`.`ObjUsuario` = '$ObjUsuario'";
      return ejecutarConsulta($sql);
    }
    public function eliminar ($idNoticias){
      $sql="DELETE FROM noticias WHERE idNoticias='$idNoticias'";
      return ejecutarConsulta($sql);
  }
  
}