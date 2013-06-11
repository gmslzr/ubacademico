<?php
include('../lib/session.php');
include('../lib/conexion.php');

//verifico si existe la variable coEmp que viaja por GET
if(isset($_GET['codEmp']) && !empty($_GET['codEmp'])){
	//preguntar a usuario  si desea eliminar el registro

		$sql ="DELETE FROM empresas WHERE codEmp='".$_GET['codEmp']."'";
		//ejecuto consulta
		$resultado =mysql_query($sql);
		header('location:listempresa.php');
		exit();	
	} elseif(isset($_GET['procesar'])) {
		header('location:listempresa.php');
		exit();	
	}
	

?>
