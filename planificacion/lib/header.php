<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<meta name="google-site-verification" content="6w9FrEF8LRQPaIIOjQE2Fb1erDJQhmZuKgZJ2u0Jekg" />
		<title>Universidad Bicentenaria de Aragua</title>
		<link src="css/estilo.css" type="text/css"/>
		<link rel="stylesheet" href="css/estilo.css" type="text/css" media="screen" /> 
		<link type="text/css" rel="stylesheet" href="css/jquery-ui.css" />
		<link rel="shortcut icon" href="images/favicon.ico">
		<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css">
		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/jquery-ui.js"></script>
		<link type="text/css" rel="stylesheet" href="css/jquery-ui.css" />
				<script type="text/javascript">
			$(document).ready(function(){
				$("select").change(function () {
	    			if($(this).val() == "") $(this).addClass("empty");
	    			else $(this).removeClass("empty")
					});
				$("select").change();

				$( "#fecha" ).datepicker({
      				changeMonth: true,
      				changeYear: true,
      				dateFormat: "yy-mm-dd"
    			});
    			$("#fecha").keyup(function (){
    				var vacio = '';
    				$("#fecha").val(vacio);
    			});
			});
		</script>


</head>

<body>
	<div class="marco">
		<div class="cabecera">
			<div class="columna_derecha_cabecera">
			</div>
			<div class="columna_izquierda_cabecera">
			</div>
			<div class="columna_central_cabecera">
				<div id="link_logo"><a href="../menu.php"><img src="images/logo-cabecera.jpg" alt="UBA"/></a></div>
			</div>
		</div>
		<div class="cuerpo">
