<?php
	/*
		Archivo de control de la autocompletacion
		para la busqueda y generacion de reportes.
	*/
 include('../../lib/session.php');
	include('../../lib/conexion.php');

	$columna = $_GET['columna'];
	$dato=$_GET['dato'];
	$tabla = $_GET['tabla'];

	$retorno = array();

	$query="SELECT $columna FROM $tabla WHERE $columna LIKE '%$dato%' ORDER BY $columna";

	$resultado = mysql_query( $query) or die(mysql_error());
	if($resultado)
	{
		while($row=mysql_fetch_array($resultado)){
			$retorno[] = $row[$columna];
		}
		echo json_encode($retorno);
	}
