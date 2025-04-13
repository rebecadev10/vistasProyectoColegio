<?php
require "../config/Conexion.php";
class Recursos
{
	//Implementamos nuestro constructor
	public function __construct()
	{
	}
    public function insertar($idRecursos,$tituloRecurso,$descripcion,$autor,$fechaPublicacion,$editorial,$departamento,$fotoPortada,$dataRecurso)
    {
     $sql="   INSERT INTO  recursos (idRecursos,tituloRecurso,descripcion,autor,fechaPublicacion,editorial,idDepartamento,fotoPortada,dataRecurso) 
     VALUES ('$idRecursos','$tituloRecurso','$descripcion','$autor','$fechaPublicacion','$editorial','$departamento','$fotoPortada','$dataRecurso')";
     return ejecutarConsulta($sql);
    }
    public function editar($idRecursos,$tituloRecurso,$descripcion,$autor,$fechaPublicacion,$editorial,$departamento,$fotoPortada,$dataRecurso)
    {
        $sql="UPDATE `recursos` SET `tituloRecurso`='$tituloRecurso',`descripcion`='$descripcion',`autor`='$autor',`fechaPublicacion`='$fechaPublicacion',`editorial`='$editorial',
        `idDepartamento`='$departamento'
         WHERE `idRecursos`='$idRecursos'";
     
     return ejecutarConsulta($sql);
    }
    // public function listar(){
    //    $sql=" SELECT * FROM recursos";
    //    return ejecutarConsulta(sql: $sql);
    // }
  
    public function listar($buscarTitulo = "", $departamento = "") {
        $sql = "SELECT * FROM recursos WHERE 1=1";
        
        if(!empty($buscarTitulo)) {
            $sql .= " AND tituloRecurso LIKE '%$buscarTitulo%'";
        }
        
        if(!empty($departamento) && $departamento != 'todos') {
            $sql .= " AND idDepartamento = '$departamento'";
        }
        
        $sql .= " ORDER BY fechaPublicacion DESC";
        return ejecutarConsulta($sql);
    }
    public function mostrar($idRecursos){
        $sql="SELECT * FROM recursos    WHERE idRecursos='$idRecursos'";
		return ejecutarConsultaSimpleFila($sql);
    }
    public function eliminar ($idRecursos){
        $sql="DELETE FROM recursos WHERE idRecursos='$idRecursos'";
        return ejecutarConsulta($sql);
    }
   
  
}