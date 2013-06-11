<?php
include('lib/session.php');

$cod_mat=$_GET['cod_mat'];
$sec_mat=$_GET['sec_mat'];
$cod_nuc_mat=$_GET['cod_nuc_mat'];

include('lib/conexion.php');

$sql_notas="SELECT * FROM calificaciones_parcial WHERE cod_mat='$cod_mat' AND sec_mat='$sec_mat' AND cod_nuc=$cod_nuc_mat AND lapso=$lapso";
$result_notas=mysql_query($sql_notas);
$cantnotas=mysql_num_rows($result_notas);
if($cantnotas>0)
{
	header("Location: menu.php");
}else
{
	//numero de cortes del semestre
	$sqlnumcortes="SELECT valores as numcortes FROM tbl_configuraciones WHERE descripcion='num_cortes_semestre'";
	$numcortes=mysql_fetch_assoc(mysql_query($sqlnumcortes));


	$a=1;
	for($a=1;$a<=$numcortes['numcortes'];$a++)
	{
		//obtener el valor de cada corte
		$sqlcorte="SELECT valores FROM tbl_configuraciones WHERE descripcion='corte_".$a."'";
		${"corte".$a}=mysql_fetch_assoc(mysql_query($sqlcorte));

		//obtener el valor acumulado de evaluaciones para el corte
		$sqlsuma="SELECT SUM(porcentaje) as cantidad FROM plan_evaluacion WHERE corte=$a AND cod_mat='$cod_mat' AND sec_mat='$sec_mat' AND ced_prof=$cedula AND lapso=$lapso AND cod_nuc=$cod_nuc_mat";
		$resultadosuma=mysql_query($sqlsuma);
		${"suma".$a}=mysql_fetch_assoc($resultadosuma);	
	}

	$sql="SELECT des_mat as mate FROM materias WHERE cod_mat='$cod_mat'";
	$resultado=mysql_query($sql);
	$materia=mysql_fetch_assoc($resultado);

	include('lib/header.php');
}
?>
			<div class="columna_central">

				<strong>MATERIA: </strong><?php echo $materia['mate']; ?><br /><br />

				<a href="<?php echo 'agregarevaluacion.php?cod_mat='.$cod_mat.'&sec_mat='.$sec_mat.'&cod_nuc_mat='.$cod_nuc_mat;?>">Agregar Evaluaci&oacute;n</a><br />

				<?php
					$a=1;
					for($a=1;$a<=$numcortes['numcortes'];$a++)
					{
						echo '<h3>Corte '.$a.'</h3>';
						if($cod_mat=='LAB405' || $cod_mat=='LAB02F')
						{
							$sql_lab="SELECT valores FROM tbl_configuraciones WHERE descripcion='lab_fisica_corte_".$a."'";
							$result_lab=mysql_query($sql_lab);
							${'lab_corte_'.$a}=mysql_fetch_assoc($result_lab);
							if(${"suma".$a}['cantidad']!="")
							{
								echo '<strong>Porcentaje Acumulado: </strong>'.${"suma".$a}['cantidad'].'% de '.${"lab_corte_".$a}['valores'].'%<br><br>';
							}else
							{
								echo '<strong>Porcentaje Acumulado: </strong>0% de '.${"lab_corte_".$a}['valores'].'%<br><br>';
							}
						}elseif ($cod_mat=='FPT03F' || $cod_mat=='FPT02F') 
						{
							$sql_teoria="SELECT valores FROM tbl_configuraciones WHERE descripcion='fisica_teoria_corte_".$a."'";
							$result_teoria=mysql_query($sql_teoria);
							${'teoria_corte_'.$a}=mysql_fetch_assoc($result_teoria);
							if(${"suma".$a}['cantidad']!="")
							{
								echo '<strong>Porcentaje Acumulado: </strong>'.${"suma".$a}['cantidad'].'% de '.${"teoria_corte_".$a}['valores'].'%<br><br>';
							}else
							{
								echo '<strong>Porcentaje Acumulado: </strong>0% de '.${"teoria_corte_".$a}['valores'].'%<br><br>';
							}

						}else
						{

							if(${"suma".$a}['cantidad']!="")
							{
								echo '<strong>Porcentaje Acumulado: </strong>'.${"suma".$a}['cantidad'].'% de '.${"corte".$a}['valores'].'%<br><br>';
							}else
							{
								echo '<strong>Porcentaje Acumulado: </strong>0% de '.${"corte".$a}['valores'].'%<br><br>';
							}
						}
							echo '<table class=tabla-a>
									<tr class=tabla-cabecera>
									<td class=td-a># Evaluaci&oacute;n</td>
									<td class=td-a>Tipo de Evaluaci&oacute;n</td>
									<td class=td-a>Porcentaje</td>
									<td class=td-a>Semana</td>
									<td class=td-a>Opci&oacute;n</td>
							</tr>';
						if(isset($cod_mat) && !empty($cod_mat) && isset($sec_mat) && !empty($sec_mat) && isset($cod_nuc_mat) && ($cod_nuc_mat)!="")
						{
							//seleccionar las evaluaciones que existen en el plan de evaluacion
							$sql="SELECT id, porcentaje, tipo, num_eval,(SELECT descripcion FROM tipos_evaluacion WHERE cod_eval=plan_evaluacion.tipo) AS desc_tipo, semana, ced_prof FROM plan_evaluacion WHERE ced_prof=$cedula AND  sec_mat='$sec_mat' AND cod_nuc=$cod_nuc_mat AND cod_mat='$cod_mat' AND corte=$a AND lapso=$lapso ORDER BY num_eval";
							$resultado=mysql_query($sql);
							$cant =mysql_num_rows($resultado);
							if ($cant>0)
							{
								while($fila=mysql_fetch_assoc($resultado))
								{
									echo '<tr>
											<td class=td-a>'.$fila['num_eval'].'</td>
											<td class=td-a>'.$fila['desc_tipo'].'</td>
											<td class=td-a>'.$fila['porcentaje'].'</td>
											<td class=td-a>'.$fila['semana'].'</td>
											<td class=td-opciones><a href="eliminarevaluacion.php?cod_mat='.$cod_mat.'&sec_mat='.$sec_mat.'&cod_nuc_mat='.$cod_nuc_mat.'&id='.$fila['id'].'" title="Eliminar Evaluaci&oacute;n"><div class="favorito3" id="EliminarEvaluacion"></div></a></td>
										</tr>';
								}
							} else
						 	{
								echo '<tr><td  class=td-a colspan="5">No se encontraron evaluaciones para este corte</td></tr>';
						 	}
						}
						echo '</table>';
					}
				?>
			</div>
<?php include('lib/footer.php'); ?>

