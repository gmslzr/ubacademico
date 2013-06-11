<?php
session_start();

if($_SESSION['Loginadmin']!=true)
{
	header('Location: index.php');
}
include('lib/conexion.php');

//verifico si existe la variable coEmp que viaja por GET
if(isset($_GET['cedula']) && !empty($_GET['cedula'])){
	//preguntar a usuario  si desea eliminar el registro

		$sql ="DELETE FROM profesores WHERE cedula='".$_GET['cedula']."'";
		//ejecuto consulta
		$resultado =mysql_query($sql);
		header('location:listarprofesores.php');
		exit();	
}
	

?>
