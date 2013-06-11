<?php
include('lib/session.php');
$Success=false;
$Error=false;

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

	//buscar numero de cortes establecidos por semestre
	$sqlnumcortes="SELECT valores as numcortes FROM tbl_configuraciones WHERE descripcion='num_cortes_semestre'";
	$numcortes=mysql_fetch_assoc(mysql_query($sqlnumcortes));

	//buscar numero de semanas del semestre
	$sqlnumsemanas="SELECT valores as numsemanas FROM tbl_configuraciones WHERE descripcion='num_semanas_semestre'";
	$numsemanas=mysql_fetch_assoc(mysql_query($sqlnumsemanas));

	//buscar los tipos de evaluaciones
	$sqltipoeval="SELECT * FROM tipos_evaluacion";
	$resulttipoeval=mysql_query($sqltipoeval);

	$a=1;
	for($a=1;$a<=$numcortes['numcortes'];$a++)
	{
		//obtener el valor de cada corte para materias sin excepcion
		$sqlcorte="SELECT valores FROM tbl_configuraciones WHERE descripcion='corte_".$a."'";
		${"corte".$a}=mysql_fetch_assoc(mysql_query($sqlcorte));

		//obtener el valor de cada corte para fisica 1 y 2 teoria
		$sql_teoria="SELECT valores FROM tbl_configuraciones WHERE descripcion='fisica_teoria_corte_".$a."'";
		$result_teoria=mysql_query($sql_teoria);
		${'teoria_corte_'.$a}=mysql_fetch_assoc($result_teoria);

		//obtener el valor de cada corte para fisica 1 y 2 laboratorio
		$sql_lab="SELECT valores FROM tbl_configuraciones WHERE descripcion='lab_fisica_corte_".$a."'";
		$result_lab=mysql_query($sql_lab);
		${'lab_corte_'.$a}=mysql_fetch_assoc($result_lab);

		//obtener el valor acumulado de evaluaciones para el corte
		$sqlsuma="SELECT SUM(porcentaje) as cantidad FROM plan_evaluacion WHERE corte=$a AND cod_mat='$cod_mat' AND sec_mat='$sec_mat' AND ced_prof=$cedula AND lapso=$lapso AND cod_nuc=$cod_nuc_mat";
		$resultadosuma=mysql_query($sqlsuma);
		${"suma".$a}=mysql_fetch_assoc($resultadosuma);	
	}


	//descripcion de la materia
	$sql="SELECT des_mat as mate FROM materias WHERE cod_mat='$cod_mat'";
	$resultado=mysql_query($sql);
	$materia=mysql_fetch_assoc($resultado);

	if( isset($_POST['agregar']) && $_POST['agregar']='Agregar' )
	{
		$Error=true;
		$Tipo=$_POST['Tipo'];
		$Corte=$_POST['Corte'];
		$Porcentaje=$_POST['Porcentaje'];
		$Semana=$_POST['Semana'];
		$num_eval=$_POST['num_eval'];

		$sqlexcepcion="SELECT * FROM materias_excepcion WHERE cod_mat='$cod_mat'";
		$resultadoexcepecion=mysql_query($sqlexcepcion);
		$cantexcepcion=mysql_num_rows($resultadoexcepecion);

		$sql_num_eval="SELECT * FROM plan_evaluacion WHERE ced_prof=$cedula AND cod_mat='$cod_mat' AND sec_mat='$sec_mat' AND cod_nuc=$cod_nuc_mat AND lapso=$lapso AND num_eval=$num_eval";
		$resultnum_eval=mysql_query($sql_num_eval);
		$cantnum_eval=mysql_num_rows($resultnum_eval);

		if ($Tipo=="")
		{
			$msgError='Debe elegir un tipo de evaluaci&oacute;n';
		}	
		elseif ($Corte=="")
		{
			$msgError='Debe elegir un corte donde se realizar&aacute; la evaluaci&oacute;n';
		}
		elseif (empty($Porcentaje) || !is_numeric($Porcentaje) )
		{
			$msgError='Ha dejado el campo de porcentaje de la evaluaci&oacute;n vac&iacute;o o ha usado caract&eacute;res no num&eacute;ricos' ;
		}
		elseif ($Semana=="")
		{
			$msgError='Debe Elegir una semana estimada en la que se realizar&aacute; la evaluaci&oacute;n';
		}elseif ($num_eval=="")
		{
			$msgError='Debe Elegir en que orden estar&aacute la evaluaci&oacute;n';
		}elseif ($cantnum_eval==1)
		{
			$msgError='Ya existe una evaluaci&oacute;n en el Plan de Evaluaci&oacute;n ubicada en el orden '.$num_eval;	
		}else
		{
			//para materias que tienen la excepcion de mas de 25% en una prueba
			if ($cantexcepcion>=1)
			{
				if ($Corte==1)
				{
					//numero de evaluaciones en el plan de evaluacion
					$sqllimitemat="SELECT * FROM plan_evaluacion WHERE corte=1 AND cod_mat='$cod_mat' AND sec_mat='$sec_mat' AND cod_nuc='$cod_nuc_mat' AND ced_prof=$cedula AND lapso=$lapso";
					$resultadolimitemat=mysql_query($sqllimitemat);
					$cantlimitemat=mysql_num_rows($resultadolimitemat);
					//cantidad maxima de evaluaciones en el corte
					$sql_maxevalcorte="SELECT valores FROM tbl_configuraciones WHERE descripcion='max_evaluaciones_corte_1'";
					$result_maxevalcorte=mysql_query($sql_maxevalcorte);
					$maxevalcorte=mysql_fetch_assoc($result_maxevalcorte);

					if ($cantlimitemat>=$maxevalcorte['valores'])
					{
						$msgError='Ya Ud. Ha Agregado 3 evaluaciones en el Primer Corte';
					}else
					{
						if ($suma1['cantidad']+$Porcentaje>40)
						{
							$msgError='Supera los 40% establecidos para el Primer Corte';
						}else
						{
							$sql="INSERT INTO plan_evaluacion (ced_prof, cod_mat, sec_mat, cod_nuc, tipo, porcentaje, corte, semana, lapso, num_eval) VALUES ('$cedula','$cod_mat','$sec_mat','$cod_nuc_mat','$Tipo','$Porcentaje','$Corte','$Semana','$lapso','$num_eval')";
							$resultado=mysql_query($sql);
							$Success=true;
							$Error=false;
							$msgSuccess='La Evaluaci&oacute;n se ha guardado exitosamente en el Plan de Evaluaci&oacute;n de la materia';
						}
					}	
				}else
				{
					$sqllimitemat="SELECT * FROM plan_evaluacion WHERE corte=2 AND cod_mat='$cod_mat' AND sec_mat='$sec_mat' AND cod_nuc='$cod_nuc_mat' AND ced_prof=$cedula AND lapso=$lapso";
					$resultadolimitemat=mysql_query($sqllimitemat);
					$cantlimitemat=mysql_num_rows($resultadolimitemat);
					//cantidad maxima de evaluaciones en el corte
					$sql_maxevalcorte="SELECT valores FROM tbl_configuraciones WHERE descripcion='max_evaluaciones_corte_2'";
					$result_maxevalcorte=mysql_query($sql_maxevalcorte);
					$maxevalcorte=mysql_fetch_assoc($result_maxevalcorte);

					if ($cantlimitemat>=$maxevalcorte['valores'])
					{
						$msgError='Ya Ud. Ha Agregado 4 evaluaciones en el Segundo Corte';
					}else
					{
						if ($suma2['cantidad']+$_POST['Porcentaje']>60)
						{
							$msgError='Supera los 60% establecidos para el Segundo Corte';
						}else
						{
							$sql="INSERT INTO plan_evaluacion (ced_prof, cod_mat, sec_mat, cod_nuc, tipo, porcentaje, corte, semana, lapso, num_eval) VALUES ('$cedula','$cod_mat','$sec_mat','$cod_nuc_mat','$Tipo','$Porcentaje','$Corte','$Semana','$lapso','$num_eval')";
							$resultado=mysql_query($sql);
							$Success=true;
							$Error=false;
							$msgSuccess='La Evaluaci&oacute;n se ha guardado exitosamente en el Plan de Evaluaci&oacute;n de la materia';
						}
					}	
				}
			}else if($cod_mat=='LAB02F' || $cod_mat=='LAB405')
			{
				if ($Porcentaje>6)
				{
					$msgError='Las Evaluaciones deben tener como m&aacute;ximo un porcentaje de 6%';
				}
				else
				{
					if ($Corte==1)
					{
						$sqllimitemat="SELECT * FROM plan_evaluacion WHERE corte=1 AND cod_mat='$cod_mat' AND sec_mat='$sec_mat' AND cod_nuc='$cod_nuc_mat' AND ced_prof=$cedula AND lapso=$lapso";
						$resultadolimitemat=mysql_query($sqllimitemat);
						$cantlimitemat=mysql_num_rows($resultadolimitemat);
						//cantidad maxima de evaluaciones en el corte
						$sql_maxevalcorte="SELECT valores FROM tbl_configuraciones WHERE descripcion='max_evaluaciones_lab_corte_1'";
						$result_maxevalcorte=mysql_query($sql_maxevalcorte);
						$maxevalcorte=mysql_fetch_assoc($result_maxevalcorte);

						if ($cantlimitemat>=$maxevalcorte['valores'])
						{
							$msgError='Ya Ud. Ha Agregado 2 evaluaciones en el Primer Corte';
						}else
						{
							if ($suma1['cantidad']+$Porcentaje>6)
							{
								$msgError='Supera los 6% establecidos para el Primer Corte';
							}else
							{
								$sql="INSERT INTO plan_evaluacion (ced_prof, cod_mat, sec_mat, cod_nuc, tipo, porcentaje, corte, semana, lapso, num_eval) VALUES ('$cedula','$cod_mat','$sec_mat','$cod_nuc_mat','$Tipo','$Porcentaje','$Corte','$Semana','$lapso','$num_eval')";
								$resultado=mysql_query($sql);
								$Success=true;
								$Error=false;
								$msgSuccess='La Evaluaci&oacute;n se ha guardado exitosamente en el Plan de Evaluaci&oacute;n de la materia';
							}
						}
					}else
					{
						$sqllimitemat="SELECT * FROM plan_evaluacion WHERE corte=2 AND cod_mat='$cod_mat' AND sec_mat='$sec_mat' AND cod_nuc='$cod_nuc_mat' AND ced_prof=$cedula AND lapso=$lapso";
						$resultadolimitemat=mysql_query($sqllimitemat);
						$cantlimitemat=mysql_num_rows($resultadolimitemat);
						//cantidad maxima de evaluaciones en el corte
						$sql_maxevalcorte="SELECT valores FROM tbl_configuraciones WHERE descripcion='max_evaluaciones_lab_corte_2'";
						$result_maxevalcorte=mysql_query($sql_maxevalcorte);
						$maxevalcorte=mysql_fetch_assoc($result_maxevalcorte);

						if ($cantlimitemat>=$maxevalcorte['valores'])
						{
							$msgError='Ya Ud. Ha Agregado 4 evaluaciones en el Segundo Corte';
						}else
						{
							if ($suma2['cantidad']+$_POST['Porcentaje']>12)
							{
								$msgError='Supera los 12% establecidos para el Segundo Corte';
							}else
							{
								$sql="INSERT INTO plan_evaluacion (ced_prof, cod_mat, sec_mat, cod_nuc, tipo, porcentaje, corte, semana, lapso, num_eval) VALUES ('$cedula','$cod_mat','$sec_mat','$cod_nuc_mat','$Tipo','$Porcentaje','$Corte','$Semana','$lapso', '$num_eval')";
								$resultado=mysql_query($sql);
								$Success=true;
								$Error=false;
								$msgSuccess='La Evaluaci&oacute;n se ha guardado exitosamente en el Plan de Evaluaci&oacute;n de la materia';
							}		
						}
					}
				}
			}else if($cod_mat=='FPT02F' || $cod_mat=='FPT03F')
			{
				if ($Porcentaje>25)
				{
					$msgError='Las Evaluaciones deben tener como m&aacute;ximo un porcentaje de 25%';
				}
				else
				{
					if ($Corte==1)
					{
						$sqllimitemat="SELECT * FROM plan_evaluacion WHERE corte=1 AND cod_mat='$cod_mat' AND sec_mat='$sec_mat' AND cod_nuc='$cod_nuc_mat' AND ced_prof=$cedula AND lapso=$lapso";
						$resultadolimitemat=mysql_query($sqllimitemat);
						$cantlimitemat=mysql_num_rows($resultadolimitemat);
						//cantidad maxima de evaluaciones en el corte
						$sql_maxevalcorte="SELECT valores FROM tbl_configuraciones WHERE descripcion='max_evaluaciones_corte_1'";
						$result_maxevalcorte=mysql_query($sql_maxevalcorte);
						$maxevalcorte=mysql_fetch_assoc($result_maxevalcorte);

						if ($cantlimitemat>=$maxevalcorte['valores'])
						{
							$msgError='Ya Ud. Ha Agregado 3 evaluaciones en el Primer Corte';
						}else
						{
							if ($suma1['cantidad']+$Porcentaje>34)
							{
								$msgError='Supera los 34% establecidos para el Primer Corte';
							}else
							{
								$sql="INSERT INTO plan_evaluacion (ced_prof, cod_mat, sec_mat, cod_nuc, tipo, porcentaje, corte, semana, lapso, num_eval) VALUES ('$cedula','$cod_mat','$sec_mat','$cod_nuc_mat','$Tipo','$Porcentaje','$Corte','$Semana','$lapso','$num_eval')";
								$resultado=mysql_query($sql);
								$Success=true;
								$Error=false;
								$msgSuccess='La Evaluaci&oacute;n se ha guardado exitosamente en el Plan de Evaluaci&oacute;n de la materia';
							}
						}
					}else
					{
						$sqllimitemat="SELECT * FROM plan_evaluacion WHERE corte=2 AND cod_mat='$cod_mat' AND sec_mat='$sec_mat' AND cod_nuc='$cod_nuc_mat' AND ced_prof=$cedula AND lapso=$lapso";
						$resultadolimitemat=mysql_query($sqllimitemat);
						$cantlimitemat=mysql_num_rows($resultadolimitemat);
						//cantidad maxima de evaluaciones en el corte
						$sql_maxevalcorte="SELECT valores FROM tbl_configuraciones WHERE descripcion='max_evaluaciones_corte_2'";
						$result_maxevalcorte=mysql_query($sql_maxevalcorte);
						$maxevalcorte=mysql_fetch_assoc($result_maxevalcorte);

						if ($cantlimitemat>=$maxevalcorte['valores'])
						{
							$msgError='Ya Ud. Ha Agregado 4 evaluaciones en el Segundo Corte';
						}else
						{
							if ($suma2['cantidad']+$_POST['Porcentaje']>48)
							{
								$msgError='Supera los 48% establecidos para el Segundo Corte';
							}else
							{
								$sql="INSERT INTO plan_evaluacion (ced_prof, cod_mat, sec_mat, cod_nuc, tipo, porcentaje, corte, semana, lapso, num_eval) VALUES ('$cedula','$cod_mat','$sec_mat','$cod_nuc_mat','$Tipo','$Porcentaje','$Corte','$Semana','$lapso','$num_eval')";
								$resultado=mysql_query($sql);
								$Success=true;
								$Error=false;
								$msgSuccess='La Evaluaci&oacute;n se ha guardado exitosamente en el Plan de Evaluaci&oacute;n de la materia';
							}		
						}
					}
				}


			}else
			{
				if ($Porcentaje>25)
				{
					$msgError='Las Evaluaciones deben tener como m&aacute;ximo un porcentaje de 25%';
				}
				else
				{
					if ($Corte==1)
					{
						$sqllimitemat="SELECT * FROM plan_evaluacion WHERE corte=1 AND cod_mat='$cod_mat' AND sec_mat='$sec_mat' AND cod_nuc='$cod_nuc_mat' AND ced_prof=$cedula AND lapso=$lapso";
						$resultadolimitemat=mysql_query($sqllimitemat);
						$cantlimitemat=mysql_num_rows($resultadolimitemat);
						//cantidad maxima de evaluaciones en el corte
						$sql_maxevalcorte="SELECT valores FROM tbl_configuraciones WHERE descripcion='max_evaluaciones_corte_1'";
						$result_maxevalcorte=mysql_query($sql_maxevalcorte);
						$maxevalcorte=mysql_fetch_assoc($result_maxevalcorte);

						if ($cantlimitemat>=$maxevalcorte['valores'])
						{
							$msgError='Ya Ud. Ha Agregado 3 evaluaciones en el Primer Corte';
						}else
						{
							if ($suma1['cantidad']+$Porcentaje>40)
							{
								$msgError='Supera los 40% establecidos para el Primer Corte';
							}else
							{
								$sql="INSERT INTO plan_evaluacion (ced_prof, cod_mat, sec_mat, cod_nuc, tipo, porcentaje, corte, semana, lapso, num_eval) VALUES ('$cedula','$cod_mat','$sec_mat','$cod_nuc_mat','$Tipo','$Porcentaje','$Corte','$Semana','$lapso','$num_eval')";
								//echo $sql;
								//die();

								$resultado=mysql_query($sql);
								$Success=true;
								$Error=false;
								$msgSuccess='La Evaluaci&oacute;n se ha guardado exitosamente en el Plan de Evaluaci&oacute;n de la materia';
							}
						}
					}else
					{
						$sqllimitemat="SELECT * FROM plan_evaluacion WHERE corte=2 AND cod_mat='$cod_mat' AND sec_mat='$sec_mat' AND cod_nuc='$cod_nuc_mat' AND ced_prof=$cedula AND lapso=$lapso";
						$resultadolimitemat=mysql_query($sqllimitemat);
						$cantlimitemat=mysql_num_rows($resultadolimitemat);
						//cantidad maxima de evaluaciones en el corte
						$sql_maxevalcorte="SELECT valores FROM tbl_configuraciones WHERE descripcion='max_evaluaciones_corte_2'";
						$result_maxevalcorte=mysql_query($sql_maxevalcorte);
						$maxevalcorte=mysql_fetch_assoc($result_maxevalcorte);


						if ($cantlimitemat>=$maxevalcorte['valores'])
						{
							$msgError='Ya Ud. Ha Agregado 4 evaluaciones en el Segundo Corte';
						}else
						{
							if ($suma2['cantidad']+$_POST['Porcentaje']>60)
							{
								$msgError='Supera los 60% establecidos para el Segundo Corte';
							}else
							{
								$sql="INSERT INTO plan_evaluacion (ced_prof, cod_mat, sec_mat, cod_nuc, tipo, porcentaje, corte, semana, lapso, num_eval) VALUES ('$cedula','$cod_mat','$sec_mat','$cod_nuc_mat','$Tipo','$Porcentaje','$Corte','$Semana','$lapso','$num_eval')";
								$resultado=mysql_query($sql);
								$Success=true;
								$Error=false;
								$msgSuccess='La Evaluaci&oacute;n se ha guardado exitosamente en el Plan de Evaluaci&oacute;n de la materia';
							}		
						}
					}
				}
			}
		}
	}
}
include('lib/header.php');
?>
			<div class="columna_central">
				<h2>Agregar Evaluaci&oacute;n al Plan de Evaluaci&oacute;n</h2>
				<strong>MATERIA: </strong><?php echo $materia['mate']; ?><br /><br />
				<a href="<?php echo 'planevaluacion.php?cod_mat='.$cod_mat.'&sec_mat='.$sec_mat.'&cod_nuc_mat='.$cod_nuc_mat;?>">Plan de Evaluaci&oacute;n</a><br /><br />
				<?php

				$a=1;
					for($a=1;$a<=$numcortes['numcortes'];$a++)
					{

						//obtener el valor de cada corte
						$sqlcorte="SELECT valores FROM tbl_configuraciones WHERE descripcion='corte_".$a."'";
						${"corte".$a}=mysql_fetch_assoc(mysql_query($sqlcorte));

						//obtener el valor de cada corte para fisica 1 y 2 teoria
						$sql_teoria="SELECT valores FROM tbl_configuraciones WHERE descripcion='fisica_teoria_corte_".$a."'";
						$result_teoria=mysql_query($sql_teoria);
						${'teoria_corte_'.$a}=mysql_fetch_assoc($result_teoria);

						//obtener el valor de cada corte para fisica 1 y 2 laboratorio
						$sql_lab="SELECT valores FROM tbl_configuraciones WHERE descripcion='lab_fisica_corte_".$a."'";
						$result_lab=mysql_query($sql_lab);
						${'lab_corte_'.$a}=mysql_fetch_assoc($result_lab);

						//obtener el valor acumulado de evaluaciones para el corte
						$sqlsuma="SELECT SUM(porcentaje) as cantidad FROM plan_evaluacion WHERE corte=$a AND cod_mat='$cod_mat' AND sec_mat='$sec_mat' AND ced_prof=$cedula AND lapso=$lapso AND cod_nuc=$cod_nuc_mat";
						$resultadosuma=mysql_query($sqlsuma);
						${"suma".$a}=mysql_fetch_assoc($resultadosuma);

						if($cod_mat=='LAB405' || $cod_mat=='LAB02F')
						{
							if(${"suma".$a}['cantidad']!="")
							{
								echo '<strong>Porcentaje Acumulado Corte '.$a.': </strong>'.${"suma".$a}['cantidad'].'% de '.${"lab_corte_".$a}['valores'].'%<br><br>';
							}else
							{
								echo '<strong>Porcentaje Acumulado Corte '.$a.': </strong>0% de '.${"lab_corte_".$a}['valores'].'%<br><br>';
							}

						}elseif($cod_mat=='FPT03F' || $cod_mat=='FPT02F')
						{
							if(${"suma".$a}['cantidad']!="")
							{
								echo '<strong>Porcentaje Acumulado Corte '.$a.': </strong>'.${"suma".$a}['cantidad'].'% de '.${"teoria_corte_".$a}['valores'].'%<br><br>';
							}else
							{
								echo '<strong>Porcentaje Acumulado Corte '.$a.': </strong>0% de '.${"teoria_corte_".$a}['valores'].'%<br><br>';
							}

						}else
						{	

							if(${"suma".$a}['cantidad']!="")
							{
								echo '<strong>Porcentaje Acumulado Corte '.$a.': </strong>'.${"suma".$a}['cantidad'].'% de '.${"corte".$a}['valores'].'%<br><br>';
							}else
							{
								echo '<strong>Porcentaje Acumulado Corte '.$a.': </strong>0% de '.${"corte".$a}['valores'].'%<br><br>';
							}
						}
					}
				 
				?>
				<form name="PlanEvaluacion" action="" method="post">
					<table align="center">
    					<tr align="center">
							<td><select name="Tipo">
									<option value="">Tipo de Evaluaci&oacute;n....</option>
									<?php
										include('procesos\conexion.php');
										$sqltipoeval="SELECT * FROM tipos_evaluacion";
										$resulttipoeval=mysql_query($sqltipoeval);
										while($filaeval=mysql_fetch_assoc($resulttipoeval))
											echo '<option value="'.$filaeval['cod_eval'].'">'.$filaeval['descripcion'].'</option>';
									?>
								</select>
             				</td>
        				</tr>
        				<tr>
            				<td><select name="Corte">
            						<option value="">Elegir Corte....</option>
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
    					<tr>
							<td><select name="Semana">
									<option value="">Elegir Semana....</option>
									<?php
            							$a=1;
										for($a=1;$a<=$numsemanas['numsemanas'];$a++)
										{
											echo '<option value="'.$a.'">Semana '.$a.'</option>';
										} 
            						?>
								</select>
            				</td>
        				</tr>
        				<tr>
            				<td><input type="text" name="num_eval" placeholder="N&uacute;mero Evaluaci&oacute;n" maxlength="1" value="" required/></td>
        				</tr>
        				<tr>
            				<td><input type="text" name="Porcentaje" placeholder="Porcentaje" maxlength="2" value="<?php if (isset($Porcentaje)){echo $Porcentaje;}?>" required/></td>
        				</tr>
        					<td colspan="2" style="text-align: center"><input type="submit" name="agregar" value="Agregar"></td>     
    				</table>
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
				</form>
			</div>

<?php include('lib/footer.php'); ?>
<script>
document.PlanEvaluacion.Corte.value='<?php if(isset($Corte)){ echo $Corte;}?>';
document.PlanEvaluacion.Semana.value='<?php if(isset($Semana)){ echo $Semana;}?>';
document.PlanEvaluacion.Tipo.value='<?php if(isset($Tipo)){ echo $Tipo;}?>';
</script>
