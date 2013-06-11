<?php
session_start();
$Error=false;

if(isset($_POST['procesar']) && $_POST['procesar']=='Enviar')
{

	$cedula=$_POST['cedula'];
	$carnet=$_POST['carnet']; 
	$password=$_POST['password'];
	$Error=true;


	if($cedula=='ubaadmin' && $carnet=='uba' && $password=='127.0.0.1')
	{
		
		$_SESSION['Loginadmin']=true;
		header("Location: menusu.php");
		exit;
	}
		
	if (!is_numeric($cedula) || strlen($_POST['cedula'])<6 || strlen($_POST['cedula'])>8)
	{
		$msgError='Error al Escribir la C&eacute;dula';
	}
	elseif(strlen($carnet)!=5 || !is_numeric($carnet))
	{
		$msgError='Por Favor Verifique Su N&uacute;mero de Carnet';
	}
	elseif(empty($password))
	{
		$msgError='Por Favor Indique Su Clave';
	}
	else
	{	
		include('lib/conexion.php');
		$sql="SELECT nombres, apellidos, cod_nuc, coord_estatus, (SELECT des_nucleo FROM nucleos WHERE ID=profesores.cod_nuc) as nucleo, (SELECT valores FROM tbl_configuraciones WHERE descripcion='lapso_activo') as lapso FROM profesores WHERE cedula=$cedula AND carnet=$carnet AND password='$password'";
		$resultado=mysql_query($sql);
		$fila1=mysql_fetch_assoc($resultado);
		$cantidad=mysql_num_rows($resultado);
		if($cantidad>0)
		{
			
			if($fila1['coord_estatus']==1)
			{	
				$sqlcoordinadores="SELECT * FROM coordinadores WHERE cedula=$cedula";
				$resultadocoordinadores=mysql_query($sqlcoordinadores);
				$i=0;

				$_SESSION['coord_estatus']=1;
				while($fila2=mysql_fetch_assoc($resultadocoordinadores))
				{	
					$i++;
					$_SESSION['cod_coord'.$i]=$fila2['cod_coord'];
					$_SESSION['cod_escu'.$i]=$fila2['cod_escu'];
				}
			}else
			{
				$_SESSION['coord_estatus']=0;
			}

			$_SESSION['Login']=true;
			$_SESSION['cedula']=$cedula;
			$_SESSION['lapso']=$fila1['lapso'];
			$_SESSION['nombres']=$fila1['nombres'];
			$_SESSION['apellidos']=$fila1['apellidos'];
			$_SESSION['nucleo']=$fila1['nucleo'];
			$_SESSION['cod_nuc_prof']=$fila1['cod_nuc'];
			$_SESSION['i']=$i;
			header("Location: menu.php");
			exit;
		}else
		{ 
			$msgError='Combinaci&oacute;n C&eacute;dula & Carnet son Incorrectos';
		}
	}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html class="no-js">
<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<meta name="google-site-verification" content="6w9FrEF8LRQPaIIOjQE2Fb1erDJQhmZuKgZJ2u0Jekg" />
		<title>Universidad Bicentenaria de Aragua</title>
		<link src="css/estilo.css" type="text/css"/>
		<link rel="stylesheet" href="css/estilo.css" type="text/css" media="screen" /> 
		<link rel="shortcut icon" href="images/favicon.ico">
		<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css">
		<script type="text/javascript" src="modernizr-latest.js"></script>
		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
</head>
<script type="text/javascript">
$(document).ready(function(){
	if (!Modernizr.input.placeholder) {
		$('[placeholder]').focus(function() {
		  var input = $(this);
		  if (input.val() == input.attr('placeholder')) {
		    input.val('');
		    input.removeClass('placeholder');
		  }
		}).blur(function() {
		  var input = $(this);
		  if (input.val() == '' || input.val() == input.attr('placeholder')) {
		    input.addClass('placeholder');
		    input.val(input.attr('placeholder'));
		  }
		}).blur().parents('form').submit(function() {
		  $(this).find('[placeholder]').each(function() {
		    var input = $(this);
		    if (input.val() == input.attr('placeholder')) {
		      input.val('');
		    }
		  })
		});
	}
});
</script>

<body>
	<div class="marco">
		<div class="cabecera">
			<div class="columna_derecha_cabecera">
			</div>
			<div class="columna_izquierda_cabecera">
			</div>
			<div class="columna_central_cabecera">
				<div id="link_logo"><a href="index.php"><img src="images/logo.jpg" alt="UBA"/></a></div>
			</div>
		</div>
		<div class="cuerpo">					
						<form name="logearse" action="index.php" method="post">
							<table align="center">
								<?php
								if($Error!=false && isset($Error)){ ?>
								<tr>
									<td colspan="2">
										<div class="warning"><?php echo $msgError ?></div>
									</td>
								</tr>
								<?php } ?>
								<tr>
									<td>C&eacute;dula: </td>
									<td style="text-align: center"><input id"lower" type="text" name="cedula" placeholder="C&Eacute;DULA" value="<?php if (isset($cedula)){echo $cedula;}?>" /></td>
								</tr>
								<tr>
									<td>Carnet: </td>
									<td style="text-align: center"><input type="password" name="carnet" placeholder="CARNET" value="" /></td>
								</tr>
								<tr>
									<td>Contrase&ntilde;a: </td>
									<td style="text-align: center"><input type="password" name="password" placeholder="CLAVE" value="" /></td>
								</tr>
								<tr><td style="text-align: center" colspan="2"><input type="submit" name="procesar" value="Enviar"></td></tr>
							</table>
						</form>
<?php include('lib/footer.php'); ?>