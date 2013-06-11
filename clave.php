<?php
include('lib/session.php');
$Success=false;
$Error=true;

include('lib/conexion.php');


if(isset($_POST['procesar']) && $_POST['procesar']=='Enviar')
{
	//creo mis variables locales para trabajar mas facil
	$contraseñaactual=$_POST['contraseñaactual'];
	$contraseñanueva1=$_POST['contraseñanueva1'];
	$contraseñanueva2=$_POST['contraseñanueva2'];
	$Error=false;
	
	if (strlen($contraseñaactual)<6 || strlen($contraseñaactual)>8)
	{
		$msgError='Error al escribir la contraseña actual';
	}
	elseif(strlen($contraseñanueva1)<6 || strlen($contraseñanueva1)>8)
	{
		$msgError='La nueva contraseña debe tener como minimo 6 caracteres y como maximo 8 caracteres';
	}
	elseif($contraseñanueva2!=$contraseñanueva1)
	{
		$msgError='Error al escribir la confirmacion de la nueva contraseña';
	}
	else //secumplio la validacion
	{
		$sql="UPDATE profesores SET password='$contraseñanueva1' WHERE cedula=".$cedula." AND password='$contraseñaactual'";
		$sqlupdate=mysql_query($sql);
		$Success=true;
		$Error=true;
		$msgSuccess='Contraseña Cambiada Correctamente';
	}
}

include('lib/header.php');
?>
			<div class="columna_central">
				<h2>Cambio de Clave</h2>
					<form name="clave" action="clave.php" method= "post">
						<table align="center">
							<tr align="center">
								<td>Contrase&ntilde;a Actual: </td>
								<td><input type="password" name="contraseñaactual" placeholder="Contraseña Actual" value="" required/></td>
							</tr>
							<tr align="center">	
								<td>Contrase&ntilde;a Nueva: </td>
								<td><input type="password" name="contraseñanueva1" title="La Contraseña debe tener un m&iacute;nimo de 6 caracteres y un m&aacute;ximo de 8" placeholder="Contraseña Nueva" value="" required/></td>
							</tr>
							<tr align="center">
								<td>Confirmar Contrase&ntilde;a: </td>		
								<td><input type="password" name="contraseñanueva2" title="La Contraseña debe tener un m&iacute;nimo de 6 caracteres y un m&aacute;ximo de 8" placeholder="Confirmar Contraseña"value="" required/></td>
							</tr>
							<tr align="center">
								<td style="text-align: center" colspan="2"><input type="submit" name="procesar" value="Enviar"></td>
							</tr>
							<?php
								if($Error!=true && isset($Error)){ ?>
								<tr>
									<td colspan="2">
										<div class="warning"><?php echo $msgError ?></div>
									</td>
								</tr>
								<?php 
								}
								if($Success==true && isset($Success)){ ?>
								<tr>
									<td colspan="2">
										<div class="success"><?php echo $msgSuccess ?></div>
									</td>
								</tr>
							<?php } ?>
						</table>
					</form>
			</div>
<?php include('lib/footer.php'); ?>
