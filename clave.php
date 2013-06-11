<?php
include('lib/session.php');
$Success=false;
$Error=true;

include('lib/conexion.php');


if(isset($_POST['procesar']) && $_POST['procesar']=='Enviar')
{
	//creo mis variables locales para trabajar mas facil
	$contrase�aactual=$_POST['contrase�aactual'];
	$contrase�anueva1=$_POST['contrase�anueva1'];
	$contrase�anueva2=$_POST['contrase�anueva2'];
	$Error=false;
	
	if (strlen($contrase�aactual)<6 || strlen($contrase�aactual)>8)
	{
		$msgError='Error al escribir la contrase�a actual';
	}
	elseif(strlen($contrase�anueva1)<6 || strlen($contrase�anueva1)>8)
	{
		$msgError='La nueva contrase�a debe tener como minimo 6 caracteres y como maximo 8 caracteres';
	}
	elseif($contrase�anueva2!=$contrase�anueva1)
	{
		$msgError='Error al escribir la confirmacion de la nueva contrase�a';
	}
	else //secumplio la validacion
	{
		$sql="UPDATE profesores SET password='$contrase�anueva1' WHERE cedula=".$cedula." AND password='$contrase�aactual'";
		$sqlupdate=mysql_query($sql);
		$Success=true;
		$Error=true;
		$msgSuccess='Contrase�a Cambiada Correctamente';
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
								<td><input type="password" name="contrase�aactual" placeholder="Contrase�a Actual" value="" required/></td>
							</tr>
							<tr align="center">	
								<td>Contrase&ntilde;a Nueva: </td>
								<td><input type="password" name="contrase�anueva1" title="La Contrase�a debe tener un m&iacute;nimo de 6 caracteres y un m&aacute;ximo de 8" placeholder="Contrase�a Nueva" value="" required/></td>
							</tr>
							<tr align="center">
								<td>Confirmar Contrase&ntilde;a: </td>		
								<td><input type="password" name="contrase�anueva2" title="La Contrase�a debe tener un m&iacute;nimo de 6 caracteres y un m&aacute;ximo de 8" placeholder="Confirmar Contrase�a"value="" required/></td>
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
