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
     $sql="   INSERT INTO  eventos ( idEventos ,  titulo ,  descripcion ,  nombreImagen ,  departamento ,  fechaInicio ,  horaInicio ,  fechaFin ,  horaFin ) 
     VALUES ('$idEventos','$titulo','$descripcion','$nombreImagen','$departamento','$fechaInicio','$horaInicio','$fechaFin','$horaFin')";
     return ejecutarConsulta($sql);
    }
    public function editar($idEventos,$titulo,$descripcion,$nombreImagen,$departamento,$fechaInicio,$horaInicio,$fechaFin,$horaFin)
    {
     $sql="  UPDATE `eventos` SET `titulo`='$titulo',`descripcion`='$descripcion',`nombreImagen`='$nombreImagen',`departamento`='$departamento',
     `fechaInicio`='$fechaInicio',`horaInicio`='$horaInicio',`fechaFin`='$fechaFin',`horaFin`='$horaFin' WHERE `idEventos`='$idEventos'";
     return ejecutarConsulta($sql);
    }
    public function listar(){
       $sql=" SELECT * FROM eventos";
       return ejecutarConsulta($sql);
    }
    public function motrar($idEventos){
        $sql="SELECT * FROM eventos WHERE idEventos='$idEventos'";
		return ejecutarConsultaSimpleFila($sql);
    }
    public function listarDepartamentos(){
      $sql ="SELECT * FROM departamentos";
      return ejecutarConsulta($sql);
    }
}