<?php
include('../lib/session.php');
include('../lib/conexion.php');

//verifico si existe la variable coEmp que viaja por GET
if(isset($_GET['cedula']) && !empty($_GET['cedula'])){
	//preguntar a usuario  si desea eliminar el registro

		$sql ="DELETE FROM listaalumnos WHERE cedula='".$_GET['cedula']."'";
		//ejecuto consulta
		$resultado =mysql_query($sql);
		header('location:listaalumnos.php');
		exit();	
	} elseif(isset($_GET['procesar'])) {
		header('location:../listalumnos.php');
		exit();	
	}
	

?>