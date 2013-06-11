<style type="text/css">
<!--
table.cabecera{
	width: 100%;
	vertical-align: middle;
	text-align: center;
}
table.datos{
	border-collapse: collapse;
	width: 100%;
	margin-top: 30px;
	vertical-align: middle;
}
table.datos td{
	border: 2px solid black;
}
table.lista{
	border-collapse: collapse;
	width: 100%;
	margin-top: 30px;
	vertical-align: middle;
	font-size: 11px;
}
table.lista td{
	border: 2px solid black;
}
table.lista td{
	text-align: center;
}

-->
</style>
<?php
$topebajo=1;
$guia=1;
for($a=1;$a<=$paginacion;$a++):
	$sql_inscritos="SELECT cedula FROM inscripciones WHERE lapso=$lapso AND cod_mat='$cod_mat' AND sec_mat='$sec_mat' AND cod_nuc=$cod_nuc_mat ORDER BY CEDULA";
	$result_inscritos=mysql_query($sql_inscritos);
	$cantinscritos=mysql_num_rows($result_inscritos);
	$remanente=$cantinscritos-$topebajo;
	if ($remanente>=18)
	{
		$topealto=$topebajo+17;
	}else
	{
		$topealto=$cantinscritos;
	}
	$id=1;

?>
<page>
	<table class="cabecera">
		<tr>
			<td><img src='images/logo_uba.jpg' alt='UBA'/></td>
			<td>
				<table  align="center">
					<tr><td>Rep&uacute;blica Bolivariana de Venezuela</td></tr>
					<tr><td>Universidad Bicentenaria de Aragua</td></tr>
					<tr><td>San Joaqu&iacute;n de Turmero - Venezuela</td></tr>
				</table>
			</td>
			<td>
				<table align="left">
					<tr><td>Registro de Calificaciones</td></tr>
					<tr><td>Vaciado de Calificaciones del Corte <?php echo $corte;?></td></tr>
					<tr><td>C&oacute;digo de Validaci&oacute;n: <?php echo round($codigo);?></td></tr>
				</table>
			</td>
		</tr>
	</table>
<?php
if($corte==1)
{	
?>
	<table class="datos" style="width:100%;">
		<tr>
			<td style="width: 70%;"><strong>C&Oacute;DIGO:  </strong><?php echo $cod_mat;?></td>
			<td style="width: 30%;"><strong>FECHA:  </strong><?php echo date("d/m/Y");?></td>
		</tr>
		<tr>
			<td><strong>ASIGNATURA:  </strong><?php echo $des_mat['des_mat']?></td>
			<td><strong>SECCI&Oacute;N:  </strong><?php echo $sec_mat;?></td>
		</tr>
		<tr>
			<td><strong>PROFESOR:  </strong><?php echo $profesor['apellidos'].', '.$profesor['nombres'];?></td>
			<td><strong>C&Eacute;DULA:  </strong><?php echo $cedula;?></td>
		</tr>
	</table>
	<table class="lista" style="width:100%;">
		<tr>
			<td rowspan="2" colspan="3" style="width:10%;">DATOS DEL ESTUDIANTE</td>
			<?php
			for($i=1;$i<=${'max_evaluaciones_corte'.$corte}['valores'];$i++)
			echo  '<td style="width:5%;">Calif</td><td style="width:5%;">%</td>';
			?>
			<td rowspan="2">DEF CORTE</td>
			<td rowspan="2" colspan="3" style="width:15%;">RETROINFORMACION</td>
		</tr>
		<tr>
			<?php
			for($i=1;$i<=${'max_evaluaciones_corte'.$corte}['valores'];$i++)
			{
				if($porcentajes['PORC_'.$corte.$i.'']!=0)
				{
					echo  '<td align="center">Obtenida</td><td align="center">'.$porcentajes['PORC_'.$corte.$i.''].'</td>';
				}else
				{
					echo  '<td align="center">Obtenida</td><td align="center">0,00</td>';
				}
			}
			?>
		</tr>
		<tr>
			<td>#</td>
			<td>C&Eacute;DULA</td>
			<td>APELLIDOS Y NOMBRES</td>
			<?php
			for($i=1;$i<=${'max_evaluaciones_corte'.$corte}['valores'];$i++)
			echo  '<td>1 al 100</td><td>Nota</td>';
			?>
			<?php
			$total=0;
			for($i=1;$i<=${'max_evaluaciones_corte'.$corte}['valores'];$i++)
			{
				$total=$total+$porcentajes['PORC_'.$corte.$i.''];
			}
			echo '<td>'.$total.'</td>';
			?>
			<td style="width:5%;">Fecha</td>
			<td style="width:11%;">Firma</td>	
		</tr>
			<?php
			while($inscritos=mysql_fetch_assoc($result_inscritos))
			{
				if($id>=$topebajo && $id<=$topealto)
				{
				   	$sql_porcentajes="SELECT * FROM calificaciones_plan_temporal WHERE LAP_NOT=$lapso AND COD_MAT='$cod_mat' AND SEC_MAT='$sec_mat' AND COD_NUC=$cod_nuc_mat";
				    $result_porcentajes=mysql_query($sql_porcentajes);
				    $porcentajes=mysql_fetch_assoc($result_porcentajes);
				    $sql_estudiantes="SELECT NOM_APE from estudiantes WHERE CEDULA=".$inscritos['cedula'];
				    $result_estudiantes=mysql_query($sql_estudiantes);
				    $nombres_estu=mysql_fetch_assoc($result_estudiantes);
				    $tabla='<tr><td style="width:2%;">'.$id.'</td><td style="width:7%;">'.$inscritos['cedula'].'</td><td style="width:37%; text-align:left;">'.$nombres_estu['NOM_APE'].'</td>';
				    $sql_notas="SELECT * FROM calificaciones_parciales_temporal WHERE LAP_NOT=$lapso AND COD_MAT='$cod_mat' AND SEC_MAT='$sec_mat' AND COD_NUC=$cod_nuc_mat AND CEDULA=".$inscritos['cedula'];
				    $result_notas=mysql_query($sql_notas);
				    $notas=mysql_fetch_assoc($result_notas);
				    $totalnota=0;
				    $totalcorte=0;
				    for($i=1;$i<=${'max_evaluaciones_corte'.$corte}['valores'];$i++)
				    {
				        if(!empty($notas['CALIF_'.$corte.$i.'']))
				        {
				            $totalnota=($notas['CALIF_'.$corte.$i.'']*$porcentajes['PORC_'.$corte.$i.''])/100;
				            $tabla.='<td>'.$notas['CALIF_'.$corte.$i.''].'</td><td>'.$totalnota.'</td>';
				            $totalcorte=$totalcorte+$totalnota;
				        }else
				        {
				            $tabla.='<td></td><td>0,00</td>';
				        }
				    }

				    $tabla.='<td>'.$totalcorte.'</td><td style="width:7%;"></td><td></td></tr>';
				    echo $tabla;
					$topebajo++;
				}
				$id++;
			}
			
			?>
	</table>
<?php
}elseif($corte==2)
{
	if($cod_mat=='FPT02F' || $cod_mat=='FPT03F')
	{?>
			<table class="datos" style="width:100%;">
		<tr>
			<td style="width: 70%;"><strong>C&Oacute;DIGO:  </strong><?php echo $cod_mat;?></td>
			<td style="width: 30%;"><strong>FECHA:  </strong><?php echo date("d/m/Y");?></td>
		</tr>
		<tr>
			<td><strong>ASIGNATURA:  </strong><?php echo $des_mat['des_mat']?></td>
			<td><strong>SECCI&Oacute;N:  </strong><?php echo $sec_mat;?></td>
		</tr>
		<tr>
			<td><strong>PROFESOR:  </strong><?php echo $profesor['apellidos'].', '.$profesor['nombres'];?></td>
			<td><strong>C&Eacute;DULA:  </strong><?php echo $cedula;?></td>
		</tr>
	</table>
	<table class="lista" style="width:100%;">
		<tr>
			<td rowspan="2" colspan="3" style="width:38%;">DATOS DEL ESTUDIANTE</td>
			<td rowspan="2" style="width:4%;">DEF. 1 CORTE</td>
			<?php
			for($i=1;$i<=${'max_evaluaciones_corte'.$corte}['valores'];$i++)
			echo  '<td style="width:4%;">Calif</td><td style="width:4%;">%</td>';
			?>
			<td rowspan="2" style="width:4%;">DEF. 2 CORTE</td>
			<td rowspan="2" style="width:4%;">TOTAL Escala</td>
			<td rowspan="2" style="width:4%;">TOTAL Escala</td>
			<td rowspan="2" colspan="3" style="width:14%;">RETROINFORMACION</td>
		</tr>
		<tr>
			<?php
			for($i=1;$i<=${'max_evaluaciones_corte'.$corte}['valores'];$i++)
			{
				if($porcentajes['PORC_'.$corte.$i.'']!=0)
				{
					echo  '<td align="center">Obtenida</td><td align="center">'.$porcentajes['PORC_'.$corte.$i.''].'</td>';
				}else
				{
					echo  '<td align="center">Obtenida</td><td align="center">0,00</td>';
				}
			}
			?>
		</tr>
		<tr>
			<td>#</td>
			<td>C&Eacute;DULA</td>
			<td>APELLIDOS Y NOMBRES</td>
			<?php
			$total1=0;
			for($i=1;$i<=$max_evaluaciones_corte1['valores'];$i++)
			{
				$total1=$total1+$porcentajes['PORC_1'.$i.''];
			}
			echo '<td>'.$total1.' %</td>';
			?>
			<?php
			for($i=1;$i<=${'max_evaluaciones_corte'.$corte}['valores'];$i++)
			echo  '<td>1 al 100</td><td>Nota</td>';
			?>
			<?php
			$total=0;
			for($i=1;$i<=${'max_evaluaciones_corte'.$corte}['valores'];$i++)
			{
				$total=$total+$porcentajes['PORC_'.$corte.$i.''];
			}
			echo '<td>'.$total.' %</td>';
			?>
			<td>1 al 100</td>
			<td>1 al 20</td>
			<td style="width:5%;">Fecha</td>
			<td style="width:9%;">Firma</td>	
		</tr>
		<?php
			while($inscritos=mysql_fetch_assoc($result_inscritos))
			{
				if($id>=$topebajo && $id<=$topealto)
				{
				   	$sql_porcentajes="SELECT * FROM calificaciones_plan_temporal WHERE LAP_NOT=$lapso AND COD_MAT='$cod_mat' AND SEC_MAT='$sec_mat' AND COD_NUC=$cod_nuc_mat";
				    $result_porcentajes=mysql_query($sql_porcentajes);
				    $porcentajes=mysql_fetch_assoc($result_porcentajes);
				    $sql_estudiantes="SELECT NOM_APE from estudiantes WHERE CEDULA=".$inscritos['cedula'];
				    $result_estudiantes=mysql_query($sql_estudiantes);
				    $nombres_estu=mysql_fetch_assoc($result_estudiantes);
				    $tabla='<tr><td style="width:2%;">'.$id.'</td><td style="width:7%;">'.$inscritos['cedula'].'</td><td style="width:20%; text-align:left;">'.$nombres_estu['NOM_APE'].'</td>';
				    $sql_notas="SELECT * FROM calificaciones_parciales_temporal WHERE LAP_NOT=$lapso AND COD_MAT='$cod_mat' AND SEC_MAT='$sec_mat' AND COD_NUC=$cod_nuc_mat AND CEDULA=".$inscritos['cedula'];
				    $result_notas=mysql_query($sql_notas);
				    $notas=mysql_fetch_assoc($result_notas);
				    $totalnota1=0;
    				$totalcorte1=0;
				  	for($i=1;$i<=$max_evaluaciones_corte1['valores'];$i++)
    				{
        				if(!empty($notas['CALIF_1'.$i.'']))
        				{
            				$totalnota1=($notas['CALIF_1'.$i.'']*$porcentajes['PORC_1'.$i.''])/100;
            				$totalcorte1=$totalcorte1+$totalnota1;
        				}
    				}
				    $tabla.='<td>'.$totalcorte1.'</td>';
				    $totalnota=0;
				    $totalcorte=0;
				    for($i=1;$i<=${'max_evaluaciones_corte'.$corte}['valores'];$i++)
				    {
				        if(!empty($notas['CALIF_'.$corte.$i.'']))
				        {
				            $totalnota=($notas['CALIF_'.$corte.$i.'']*$porcentajes['PORC_'.$corte.$i.''])/100;
				            $tabla.='<td>'.$notas['CALIF_'.$corte.$i.''].'</td><td>'.$totalnota.'</td>';
				            $totalcorte=$totalcorte+$totalnota;
				        }else
				        {
				            $tabla.='<td></td><td>0,00</td>';
				        }
				    }
				    if($cod_mat=='FPT02F')
				    {
				    	$sql_lab="SELECT * FROM calificaciones_parciales_temporal WHERE cod_mat='LAB02F' AND cod_nuc=$cod_nuc_mat AND cedula=".$inscritos['cedula'];
				    	$sql_lab_porc="SELECT * FROM calificaciones_plan_temporal WHERE cod_mat='LAB02F' AND cod_nuc=$cod_nuc_mat AND cedula=".$inscritos['cedula'];
				    	$result_lab_porc=mysql_query($sql_lab_porc);
				    	$result_lab=mysql_query($sql_lab);
				    	$lab_porc=mysql_fetch_assoc($result_lab_porc);
				    	$lab=mysql_fetch_assoc($result_lab);
				    	$totallab=0;
				    	for($k=1;$k<=2;$k++)
				    	{
				    		for($l=1;$l<=${'max_evaluaciones_corte'.$k}['valores'];$l++)
				    		{
				    			if(!empty($lab['CALIF_'.$k.$l.'']))
				    			{
				    				$totallab=$totallab+(($lab['CALIF_'.$k.$l.'']*$lab_porc['PORC_'.$k.$l.''])/100);
				    			}
				    			
				    		}
				    	}
				    	
				    }else
				    {
				    	$sql_lab="SELECT * FROM calificaciones_parciales_temporal WHERE cod_mat='LAB405' AND cod_nuc=$cod_nuc_mat AND cedula=".$inscritos['cedula'];
				    	$result_lab=mysql_query($sql_lab);
				    	$lab=mysql_fetch_assoc($result_lab);
				    	$sql_lab_porc="SELECT * FROM calificaciones_plan_temporal WHERE cod_mat='LAB405' AND cod_nuc=$cod_nuc_mat AND sec_mat='".$lab['SEC_MAT']."'";
				    	$result_lab_porc=mysql_query($sql_lab_porc);
				    	$lab_porc=mysql_fetch_assoc($result_lab_porc);
				    	$totallab=0;
				    	for($k=1;$k<=2;$k++)
				    	{
				    		for($l=1;$l<=${'max_evaluaciones_corte'.$k}['valores'];$l++)
				    		{
				    			if(!empty($lab['CALIF_'.$k.$l.'']))
				    			{
				    				$totallab=$totallab+(($lab['CALIF_'.$k.$l.'']*$lab_porc['PORC_'.$k.$l.''])/100);
				    			}
				    			
				    		}
				    	}

				    }
				    
				    $totalcien=$totalcorte1+$totalcorte+$totallab;
				    $totalveinte=($totalcien*20)/100;
				    $tabla.='<td>'.$totalcorte.'</td><td>'.$totalcien.'</td><td>';
				    $tabla.=round($totalveinte).'</td><td style="width:5%;"></td><td style="width:9;"></td></tr>';
				    echo $tabla;
					$topebajo++;
				}
				$id++;
			}
			
			?>
	</table>
	<?php
	}else
	{
		?>
		<table class="datos" style="width:100%;">
		<tr>
			<td style="width: 70%;"><strong>C&Oacute;DIGO:  </strong><?php echo $cod_mat;?></td>
			<td style="width: 30%;"><strong>FECHA:  </strong><?php echo date("d/m/Y");?></td>
		</tr>
		<tr>
			<td><strong>ASIGNATURA:  </strong><?php echo $des_mat['des_mat']?></td>
			<td><strong>SECCI&Oacute;N:  </strong><?php echo $sec_mat;?></td>
		</tr>
		<tr>
			<td><strong>PROFESOR:  </strong><?php echo $profesor['apellidos'].', '.$profesor['nombres'];?></td>
			<td><strong>C&Eacute;DULA:  </strong><?php echo $cedula;?></td>
		</tr>
		</table>
		<table class="lista" style="width:100%;">
		<tr>
			<td rowspan="2" colspan="3" style="width:38%;">DATOS DEL ESTUDIANTE</td>
			<td rowspan="2" style="width:4%;">DEF. 1 CORTE</td>
			<?php
			for($i=1;$i<=${'max_evaluaciones_corte'.$corte}['valores'];$i++)
			echo  '<td style="width:4%;">Calif</td><td style="width:4%;">%</td>';
			?>
			<td rowspan="2" style="width:4%;">DEF. 2 CORTE</td>
			<td rowspan="2" style="width:4%;">TOTAL Escala</td>
			<td rowspan="2" style="width:4%;">TOTAL Escala</td>
			<td rowspan="2" colspan="3" style="width:14%;">RETROINFORMACION</td>
		</tr>
		<tr>
			<?php
			for($i=1;$i<=${'max_evaluaciones_corte'.$corte}['valores'];$i++)
			{
				if($porcentajes['PORC_'.$corte.$i.'']!=0)
				{
					echo  '<td align="center">Obtenida</td><td align="center">'.$porcentajes['PORC_'.$corte.$i.''].'</td>';
				}else
				{
					echo  '<td align="center">Obtenida</td><td align="center">0,00</td>';
				}
			}
			?>
		</tr>
		<tr>
			<td>#</td>
			<td>C&Eacute;DULA</td>
			<td>APELLIDOS Y NOMBRES</td>
			<?php
			$total1=0;
			for($i=1;$i<=$max_evaluaciones_corte1['valores'];$i++)
			{
				$total1=$total1+$porcentajes['PORC_1'.$i.''];
			}
			echo '<td>'.$total1.' %</td>';
			?>
			<?php
			for($i=1;$i<=${'max_evaluaciones_corte'.$corte}['valores'];$i++)
			echo  '<td>1 al 100</td><td>Nota</td>';
			?>
			<?php
			$total=0;
			for($i=1;$i<=${'max_evaluaciones_corte'.$corte}['valores'];$i++)
			{
				$total=$total+$porcentajes['PORC_'.$corte.$i.''];
			}
			echo '<td>'.$total.' %</td>';
			?>
			<td>1 al 100</td>
			<td>1 al 20</td>
			<td style="width:5%;">Fecha</td>
			<td style="width:9%;">Firma</td>	
		</tr>
		<?php
			while($inscritos=mysql_fetch_assoc($result_inscritos))
			{
				if($id>=$topebajo && $id<=$topealto)
				{
				   	$sql_porcentajes="SELECT * FROM calificaciones_plan_temporal WHERE LAP_NOT=$lapso AND COD_MAT='$cod_mat' AND SEC_MAT='$sec_mat' AND COD_NUC=$cod_nuc_mat";
				    $result_porcentajes=mysql_query($sql_porcentajes);
				    $porcentajes=mysql_fetch_assoc($result_porcentajes);
				    $sql_estudiantes="SELECT NOM_APE from estudiantes WHERE CEDULA=".$inscritos['cedula'];
				    $result_estudiantes=mysql_query($sql_estudiantes);
				    $nombres_estu=mysql_fetch_assoc($result_estudiantes);
				    $tabla='<tr><td style="width:2%;">'.$id.'</td><td style="width:7%;">'.$inscritos['cedula'].'</td><td style="width:20%; text-align:left;">'.$nombres_estu['NOM_APE'].'</td>';
				    $sql_notas="SELECT * FROM calificaciones_parciales_temporal WHERE LAP_NOT=$lapso AND COD_MAT='$cod_mat' AND SEC_MAT='$sec_mat' AND COD_NUC=$cod_nuc_mat AND CEDULA=".$inscritos['cedula'];
				    $result_notas=mysql_query($sql_notas);
				    $notas=mysql_fetch_assoc($result_notas);
				    $totalnota1=0;
    				$totalcorte1=0;
				  	for($i=1;$i<=$max_evaluaciones_corte1['valores'];$i++)
    				{
        				if(!empty($notas['CALIF_1'.$i.'']))
        				{
            				$totalnota1=($notas['CALIF_1'.$i.'']*$porcentajes['PORC_1'.$i.''])/100;
            				$totalcorte1=$totalcorte1+$totalnota1;
        				}
    				}
				    $tabla.='<td>'.$totalcorte1.'</td>';
				    $totalnota=0;
				    $totalcorte=0;
				    for($i=1;$i<=${'max_evaluaciones_corte'.$corte}['valores'];$i++)
				    {
				        if(!empty($notas['CALIF_'.$corte.$i.'']))
				        {
				            $totalnota=($notas['CALIF_'.$corte.$i.'']*$porcentajes['PORC_'.$corte.$i.''])/100;
				            $tabla.='<td>'.$notas['CALIF_'.$corte.$i.''].'</td><td>'.$totalnota.'</td>';
				            $totalcorte=$totalcorte+$totalnota;
				        }else
				        {
				            $tabla.='<td></td><td>0,00</td>';
				        }
				    }
				    $totalcien=$totalcorte1+$totalcorte;
				    $totalveinte=($totalcien*20)/($total1+$total);
				    $tabla.='<td>'.$totalcorte.'</td><td>'.$totalcien.'</td><td>';
				    $tabla.=round($totalveinte).'</td><td style="width:5%;"></td><td style="width:9;"></td></tr>';
				    echo $tabla;
					$topebajo++;
				}
				$id++;
			}
		?>
		</table>
		<?php
	}
}
?>
	<page_footer>
	<table class="cabecera" style="margin-top: 50px;">
		<tr>
			<td style="width:33%;"><strong>PROFESOR:  </strong><?php echo $profesor['apellidos'].', '.$profesor['nombres'];?></td>
			<td style="width:33%;"><strong>FECHA:  </strong><?php echo date("d/m/Y");?></td>
			<td style="width:33%;">
				<table align="center"><tr><td>________________________</td></tr><<tr><td>Firma del Profesor</td></tr></table>
			</td>
		</tr>
	</table>
	</page_footer>
</page>
<?php endfor; ?>