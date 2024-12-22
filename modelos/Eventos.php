<?php
require "../config/Conexion.php";
class Eventos
{
	//Implementamos nuestro constructor
	public function __construct()
	{
	}
    public function insertar($idEventos,$titulo,$descripcion,$nombreImagen,$departamento,$fechaInicio,$horaInicio,$fechaFin,$horaFin)
    {
     $sql="   INSERT INTO  eventos ( idEventos ,  titulo ,  descripcion ,  nombreImagen ,  departamento ,  fechaInicio ,  horaInicio ,  fechaFin ,  horaFin,estado ) 
     VALUES ('$idEventos','$titulo','$descripcion','$nombreImagen','$departamento','$fechaInicio','$horaInicio','$fechaFin','$horaFin','1')";
     return ejecutarConsulta($sql);
    }
    public function editar($idEventos,$titulo,$descripcion,$nombreImagen,$departamento,$fechaInicio,$horaInicio,$fechaFin,$horaFin)
    {
     $sql="  UPDATE `eventos` SET `titulo`='$titulo',`descripcion`='$descripcion',`nombreImagen`='$nombreImagen',`departamento`='$departamento',
     `fechaInicio`='$fechaInicio',`horaInicio`='$horaInicio',`fechaFin`='$fechaFin',`horaFin`='$horaFin' WHERE `idEventos`='$idEventos'";
     return ejecutarConsulta($sql);
    }
    public function listar(){
       $sql=" SELECT * FROM eventos e INNER JOIN departamentos d  ON e.departamento = d.idDepartamento WHERE estado='1'";
       return ejecutarConsulta($sql);
    }
    public function listarRegistros() {
      $sql = "SELECT e.idEventos idEventos, e.titulo, d.nombre, e.fechaInicio, e.horaInicio,e.estado
              FROM eventos e
              INNER JOIN departamentos d ON e.departamento = d.idDepartamento";
      return ejecutarConsulta($sql);
  }
  
    public function mostrar($idEventos){
        $sql="SELECT * FROM eventos e INNER JOIN departamentos d  WHERE idEventos='$idEventos'";
		return ejecutarConsultaSimpleFila($sql);
    }
    public function listarDepartamentos(){
      $sql ="SELECT * FROM departamentos";
      return ejecutarConsulta($sql);
    }
    public function desactivar($idEventos)
	{
		$sql="UPDATE eventos SET estado='0' WHERE idEventos='$idEventos'";

		//$sql = "UPDATE `usuario` SET `estatus` = '0' WHERE `usuario`.`ObjUsuario` = '$ObjUsuario'";

		return ejecutarConsulta($sql);
	}
  public function activar($idEventos)
	{
		$sql="UPDATE eventos SET estado='1' WHERE idEventos='$idEventos'";

		//$sql = "UPDATE `usuario` SET `estatus` = '1' WHERE `usuario`.`ObjUsuario` = '$ObjUsuario'";
		return ejecutarConsulta($sql);
	}


}