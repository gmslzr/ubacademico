<?php
	include('../lib/conexion.php');
	
	$dato = $_GET['dato'];
	$tabla = $_GET['tabla'];
	$cond = $_GET['cond'];
	$busqueda = $_GET['busqueda'];

	$query = "SELECT $busqueda FROM $tabla WHERE $cond = '$dato'";

	$resultado = mysql_query($query) or die(mysql_error());
	if($resultado){
		$row = mysql_fetch_array($resultado);
		echo $row[$busqueda];
	}