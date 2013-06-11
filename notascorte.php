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

//Numero de cortes establecidos por semestre
$sqlnumcortes="SELECT valores as numcortes FROM tbl_configuraciones WHERE descripcion='num_cortes_semestre'";
$numcortes=mysql_fetch_assoc(mysql_query($sqlnumcortes));


if (isset($_POST['enviar']) && $_POST['enviar']=='Enviar')
{
	$operacion=$_POST['operacion'];
	$corte=$_POST['corte'];

	if($cod_mat=='LAB405' || $cod_mat=='LAB02F')
	{
		$corteseleccionado="lab_fisica_corte_";

	}elseif ($cod_mat=='FPT03F' || $cod_mat=='FPT02F')
	{
		$corteseleccionado="fisica_teoria_corte_";
	}else
	{
		$corteseleccionado="corte_";
	}
	//verifico que el plan de evaluacion ha sido agregado por completo
	$sqlnumcortes="SELECT valores as numcortes FROM tbl_configuraciones WHERE descripcion='num_cortes_semestre'";
	$numcortes=mysql_fetch_assoc(mysql_query($sqlnumcortes));
	$total=0;

	for($i=1;$i<=$numcortes['numcortes'];$i++)
	{
		$sql_porcentaje_corte="SELECT valores FROM tbl_configuraciones WHERE descripcion='$corteseleccionado".$i."'";
		$result_porcentaje_corte=mysql_query($sql_porcentaje_corte);
		$porcentaje=mysql_fetch_assoc($result_porcentaje_corte);
		$total=$total+$porcentaje['valores'];
	}
	
	$sql_evaluaciones_corte="SELECT SUM(porcentaje) as suma FROM plan_evaluacion WHERE ced_prof=$cedula AND cod_mat='$cod_mat' AND sec_mat='$sec_mat' AND cod_nuc=$cod_nuc_mat";
	$result_evaluaciones_corte=mysql_query($sql_evaluaciones_corte);
	$suma_plan_evaluacion=mysql_fetch_assoc($result_evaluaciones_corte);

	if ($suma_plan_evaluacion['suma']!=$total)
	{
		$Error=true;
		$msgError='Debe Agregar por completo el plan de Evaluaci&oacute;n de la materia';
	}else
	{
		//verificamos que la notas de esta materia no han sido agregadas
		$sql_estudiantes= "SELECT cedula FROM inscripciones WHERE cod_mat='$cod_mat' AND sec_mat='$sec_mat' AND cod_nuc=$cod_nuc_mat AND lapso=$lapso ORDER BY cedula";
		$result_estudiantes= mysql_query($sql_estudiantes);
		$cantestudiantes = mysql_num_rows($result_estudiantes);

		$sql_notas="SELECT DISTINCT(ced_estu) FROM calificaciones_parcial WHERE cod_mat='$cod_mat' AND sec_mat='$sec_mat' AND cod_nuc=$cod_nuc_mat AND lapso=$lapso AND corte=$corte";
		$resultnotas=mysql_query($sql_notas);
		$cantnotas=mysql_num_rows($resultnotas);

		$sql_notas1="SELECT DISTINCT(ced_estu) FROM calificaciones_parcial WHERE cod_mat='$cod_mat' AND sec_mat='$sec_mat' AND cod_nuc=$cod_nuc_mat AND lapso=$lapso AND corte=1";
		$resultnotas1=mysql_query($sql_notas1);
		$cantnotas1=mysql_num_rows($resultnotas1);

		if ($operacion==1)
		{
			if ($cantnotas==$cantestudiantes)
			{
				$Error=true;
				$msgError='Las notas de esta materia ya han sido agregadas';
			}elseif($corte==2 && $cantnotas1==0)
			{
				$Error=true;
				$msgError='Debe agregar antes las notas del primer Corte';
			}else
			{
				header("Location: agregarcalificacion.php?cod_mat=$cod_mat&sec_mat=$sec_mat&cod_nuc_mat=$cod_nuc_mat&corte=$corte");
			}
		}
		if($operacion==2)
		{
			if($cantnotas!=$cantestudiantes)
			{
				$Error=true;
				$msgError='Debe agregar primero las notas de esta materia';
			}else
			{
				header("Location: modificarcalificacion.php?cod_mat=$cod_mat&sec_mat=$sec_mat&cod_nuc_mat=$cod_nuc_mat&corte=$corte");
			}
		}
		if($operacion==3)
		{
			if($cantnotas!=$cantestudiantes)
			{
				$Error=true;
				$msgError='Debe agregar primero las notas de esta materia';
			}elseif($corte==2)
			{
				if($cod_mat=='LAB405' || $cod_mat=='LAB02F')
				{
					$Error=true;
					$msgError='Las materias de Laboratorio de F&iacute;sica no generan Planilla Final';
				}else
				{
					header("Location: planillanotastopdf.php?cod_mat=$cod_mat&sec_mat=$sec_mat&cod_nuc_mat=$cod_nuc_mat&corte=$corte");
				}
			}else
			{
				header("Location: planillanotastopdf.php?cod_mat=$cod_mat&sec_mat=$sec_mat&cod_nuc_mat=$cod_nuc_mat&corte=$corte");
			}
		}
	}
}


include('lib/header.php');
?>

			<div class="columna_central">
				<h2>Notas</h2>

				<strong>MATERIA: </strong><?php echo $materia['mate']; ?><br />
				<strong>SECCI&Oacute;N: </strong><?php echo $sec_mat; ?><br /><br />
				<table align="center"><tr><td colspan="2"><div class="warning">En el momento que las notas sean agregadas no podr&aacute; modificar de nuevo el Plan de Evaluaci&oacute;n</div></td></tr></table>
				<form name="formularionotas" action="" method="post" target="_BLANK">
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
						<tr>
							<td>Operaci&oacute;n:</td>
							<td><select name="operacion" required>
									<option value="">Elegir Operaci&oacute;n....</option>
									<option value="1">Agregar</option>
									<option value="2">Modificar</option>
									<option value="3">Generar Planilla de Corte</option>
								</select>
							</td>
						</tr>	
						<tr>
							<td>Corte:</td>
							<td><select name="corte" required>
									<option value="">Elegir Operaci&oacute;n....</option>
									<?php
            							$a=1;
										for($a=1;$a<=$numcortes['numcortes'];$a++)
										{
											echo '<option value="'.$a.'">Corte '.$a.'</option>';
										} 
            						?>
								</select>
							</td>
						</tr>
						<td colspan="2" style="text-align: center"><input type="submit" name="enviar" value="Enviar"></td> 
					</table>
				</form>
			</div>
<?php include('lib/footer.php'); ?>