<?php
session_start();

if($_SESSION['Loginadmin']!=true)
{
	header('Location: index.php');
}


include('lib/conexion.php');

$sql_lapso="SELECT valores FROM tbl_configuraciones WHERE descripcion='lapso_activo'";
$rs_lapso=mysql_query($sql_lapso);
$lapsoactivo=mysql_fetch_assoc($rs_lapso);

if(isset($_POST['cambiar']) && $_POST['cambiar']=='Cambiar')
{
	

	if(!is_numeric($_POST['lapso']) || strlen($_POST['lapso'])>1)
	{
		$Error=true;
        $msgError='Error al Escribir el Nuevo Lapso';

	}else
	{
		$Error=false;
		$Success=true;
		$nvolapso=date("Y");
		$nvolapso.=$_POST['lapso'];
		$sql_cambio="UPDATE tbl_configuraciones SET valores=$nvolapso WHERE descripcion='lapso_activo'";
		$rs_cambio=mysql_query($sql_cambio);
		$msgSuccess='El Lapso se ha cambiado Correctamente';
	}

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
				<h2>Cambio de Lapso Activo</h2><br>
				<table align="center">
                        <?php
                            if(isset($Error) && $Error==true){ ?>
                                <tr>
                                    <td colspan="2">
                                        <div class="warning"><?php echo $msgError ?></div>
                                    </td>
                                </tr>
                            <?php 
                            }
                            if(isset($Success) && $Success==true){ ?>
                                <tr>
                                    <td colspan="2">
                                        <div class="success"><?php echo $msgSuccess ?></div>
                                    </td>
                                </tr>
                </table>  
                            <?php }else{ ?>
                <center><strong>Lapso Activo: </strong><?php echo $lapsoactivo['valores'];?></center>
				<form name="cambiolapsoactivo" method="POST" action="">
					<table align="center">
						<tr>
							<td>Lapso <?php echo date("Y")?> -</td>
							<td><input type="text" name="lapso" maxlength="1" size="1" required="required" pattern="[0-9]{1}"></td>
						</tr>
						<tr><td><input type="submit" name="cambiar" value="Cambiar"></td></tr>
					</table>
				</form>
				<?php } ?>
			</div>
<?php include('lib/footer.php'); ?>