<?php
require "../config/Conexion.php";
class Usuarios
{
	//Implementamos nuestro constructor
	public function __construct()
	{
	}
    public function insertar($idUsuario,$nombre,$apellido,$cedula,$permisos,$imagenUsuario,$clave)
    {
        $sql="  INSERT INTO  usuario ( idUsuario ,  nombre ,  apellido ,  cedula ,    imagenUsuario,clave) 
        VALUES ('$idUsuario','$nombre','$apellido','$cedula','$imagenUsuario','$clave')";
        $idUsuarioNew=ejecutarConsulta_retornarID($sql);
        $num_elementos=0;
        $sw=true;

 while ($num_elementos < count($permisos))
     {
         $sql_detalle = "INSERT INTO `usuariopermiso`(`idUsuario`, `idPermisos`) VALUES ( '$idUsuarioNew', '$permisos[$num_elementos]');";
        
         ejecutarConsulta($sql_detalle) or $sw = false;
         $num_elementos=$num_elementos + 1;
     }

     return $sw;
    }
    public function editar($idUsuario,$nombre,$apellido,$cedula,$permisos,$clave)
    {
        $sql="UPDATE  usuario  SET  nombre ='$nombre', apellido ='$apellido', cedula ='$cedula', clave='$clave'
         WHERE  idUsuario ='$idUsuario'";
     
     ejecutarConsulta($sql);
     //Eliminamos todos los permisos asignados para volverlos a registrar
		$sqldel="DELETE FROM usuariopermiso WHERE idUsuario='$idUsuario'";
		ejecutarConsulta($sqldel);

		$num_elementos=0;
		$sw=true;

		while ($num_elementos < count($permisos))
		{
			$sql_detalle = "INSERT INTO usuariopermiso(idUsuario, idPermisos) VALUES('$idUsuario', '$permisos[$num_elementos]')";
			ejecutarConsulta($sql_detalle) or $sw = false;
			$num_elementos=$num_elementos + 1;
		}

		return $sw;
    }
    public function listar(){
       $sql=" SELECT * FROM usuario";
       return ejecutarConsulta(sql: $sql);
    }
    public function listarmarcados($idUsuario)
	{
		$sql="SELECT * FROM usuariopermiso WHERE idUsuario='$idUsuario'";
		return ejecutarConsulta($sql);
	}
    //Función para verificar el acceso al sistema
	public function verificar($cedula,$clave)
    {
    	$sql="SELECT idUsuario,cedula,clave FROM usuario WHERE cedula='$cedula' AND clave='$clave' "; 
    	return ejecutarConsulta($sql);  
    }
  
    public function mostrar($idUsuario){
        $sql="SELECT idUsuario,cedula,nombre,apellido FROM usuario WHERE idUsuario='$idUsuario'";
		return ejecutarConsultaSimpleFila($sql);
    }
   
   
  
}