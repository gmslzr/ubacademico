<?php
session_start();

if($_SESSION['Loginadmin']!=true)
{
	header('Location: index.php');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<meta name="google-site-verification" content="6w9FrEF8LRQPaIIOjQE2Fb1erDJQhmZuKgZJ2u0Jekg" />
		<title>Universidad Bicentenaria de Aragua date</title>
		<link src="css/estilo.css" type="text/css"/>
		<link rel="stylesheet" href="css/estilo.css" type="text/css" media="screen" /> 
		<link rel="shortcut icon" href="images/favicon.ico">
		<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css">
		<script type="text/javascript" src="modernizr-latest.js"></script>
		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/jquery-ui.js"></script>
</head>
<body>
	<div class="marco">
		<div class="cabecera">
			<div class="columna_derecha_cabecera">
			</div>
			<div class="columna_izquierda_cabecera">
			</div>
			<div class="columna_central_cabecera">
				<div id="link_logo"><a href="menusu.php"><img src="images/logo.jpg" alt="UBA"/></a></div>
			</div>
		</div>
		<div class="cuerpo">
			<div class="columna_central">
				<li><a href="cambiarlapsoactivo.php">Cambiar Lapso Activo</a></li>
				<li><a href="#">Cambiar Porcentajes Cortes</a></li>
				<li><a href="listarprofesores.php">Listar Profesores</a></li>
				<li><a href="salir.php">Salir</a></li>
			</div>
<?php include('lib/footer.php'); ?>