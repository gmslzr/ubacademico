<?php include('../../../lib/conexion.php'); include('../../../lib/session.php');

	$opcion = $_GET['opcion'];
	
	switch($opcion){
		case 1:
			$tutor = $_GET['tutor'];
			$query = "SELECT cedula FROM datosproyecto WHERE nombres = '$tutor'";

			$resultado = mysql_query($query);
			if($resultado){
				$row = mysql_fetch_array($resultado);
				echo $row['cedula'];
			}

		break;

		case 2:
			$tutor = $_GET['tutor'];
			$query = "SELECT pcedula FROM profrg WHERE pnombres = '$tutor'";

			$resultado = mysql_query($query);
			if($resultado){
				$row = mysql_fetch_array($resultado);
				echo $row['pcedula'];
			}

		break;
	}


?>