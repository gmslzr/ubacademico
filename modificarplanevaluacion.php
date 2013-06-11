<?php
include('lib/session.php');

$cod_mat=$_GET['cod_mat'];
$sec_mat=$_GET['sec_mat'];
$cod_nuc_mat=$_GET['cod_nuc_mat'];
$Error=false;
$Success=false;

include('lib/conexion.php');

$sql="SELECT des_mat as mate FROM materias WHERE cod_mat='$cod_mat'";
$resultado=mysql_query($sql);
$materia=mysql_fetch_assoc($resultado);

if(isset($_POST['enviar']) && $_POST['enviar']=='Enviar')
{
	$sql_notas="SELECT * FROM calificaciones_parcial WHERE cod_mat='$cod_mat' AND sec_mat='$sec_mat' AND cod_nuc=$cod_nuc_mat AND lapso=$lapso";
	$result_notas=mysql_query($sql_notas);
	$cantnotas=mysql_num_rows($result_notas);
	if($cantnotas>0)
	{
		$Error=true;
		$msgError='No se pueden agregar o eliminar evaluaciones porque ya han sido cargadas notas para esta materia';
	}else
	{
		if($_POST['operacion']==1)
		{
			header("Location: agregarevaluacion.php?cod_mat=$cod_mat&sec_mat=$sec_mat&cod_nuc_mat=$cod_nuc_mat");
		}else
		{
			header("Location: planevaluacioneliminar.php?cod_mat=$cod_mat&sec_mat=$sec_mat&cod_nuc_mat=$cod_nuc_mat");
		}
	}
}



include('lib/header.php');
?>

			<div class="columna_central">
				<h2>Modificar Plan Evaluaci&oacute;n</h2>

				<strong>MATERIA: </strong><?php echo $materia['mate']; ?><br />
				<strong>SECCI&Oacute;N: </strong><?php echo $sec_mat; ?><br /><br />
				
				<form name="formulariomodificarplanevaluacion" action="" method="post">
					<table align="center">
						<?php
							if($Error==true && isset($Error)){ ?>
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
					<table align="center">
						<tr>
							<td>Operaci&oacute;n:</td>
							<td><select name="operacion" required>
									<option value="">Elegir Operaci&oacute;n....</option>
									<option value="1">Agregar Evaluaci&oacute;n</option>
									<option value="2">Eliminar Evaluaci&oacute;n</option>
								</select>
							</td>
						</tr>
						<td colspan="2" style="text-align: center"><input type="submit" name="enviar" value="Enviar"></td> 
					</table>
				</form>
			</div>
<?php include('lib/footer.php'); ?>