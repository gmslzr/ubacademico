<?php
include('lib/session.php');

$cod_mat=$_GET['cod_mat'];
$sec_mat=$_GET['sec_mat'];
$cod_nuc_mat=$_GET['cod_nuc_mat'];
$corte=$_GET['corte'];
$Error=false;
$Success=false;

include('lib/conexion.php');

//busco la descripcion de la materia
$sqlmateria="SELECT des_mat as mate FROM materias WHERE cod_mat='$cod_mat'";
$resultado_materia=mysql_query($sqlmateria);
$materia=mysql_fetch_assoc($resultado_materia);

$sql_estudiantes= "SELECT cedula, (SELECT nom_ape FROM estudiantes WHERE cedula=inscripciones.cedula LIMIT 0,1) as nom_ape FROM inscripciones WHERE cod_mat='$cod_mat' AND sec_mat='$sec_mat' AND cod_nuc=$cod_nuc_mat AND lapso=$lapso";
$result_estudiantes= mysql_query($sql_estudiantes);
$cantestudiantes = mysql_num_rows($result_estudiantes);

	//Buscamos las evaluaciones que hay para el corte
	$sql_evaluacion = "SELECT tipo, id, porcentaje, (SELECT descripcion FROM tipos_evaluacion WHERE cod_eval=plan_evaluacion.tipo) as des_tipo FROM plan_evaluacion WHERE cod_mat='$cod_mat' AND sec_mat='$sec_mat' AND cod_nuc='$cod_nuc_mat' AND lapso=$lapso AND corte='$corte'";
	$resultado_evaluacion=mysql_query($sql_evaluacion);
	$numcolumnas=mysql_num_rows($resultado_evaluacion);

	$i=0;
	$tablaEncabezado ='<table class=tabla-notas align="center"><tr class="tabla-cabecera"><td>#</td><td class=td-a>C&eacute;dula</td><td>Nombre Estudiante</td>';
	//agregamos la descripcion de cada evaluacion
	while ($fila=mysql_fetch_assoc($resultado_evaluacion))
	{
		$tablaEncabezado .= "<td class=td-a style='width:120px!important'>".$fila['des_tipo']." ".$fila['porcentaje']."%</td>";	
	}
	$i=0;
	//agregamos los estudiantes y los input de text de cada evaluacion
	while($filaCalifi=mysql_fetch_assoc($result_estudiantes))
	{
		$i++;
		$tablaEncabezado .= "<tr><td class=td-a align='center'>".$i."</td><td class=td-a align='center'>".$filaCalifi['cedula']."</td><td class=td-a>".$filaCalifi['nom_ape']."</td>";
			
		$sql = "SELECT tipo, id, (SELECT descripcion FROM tipos_evaluacion WHERE cod_eval=plan_evaluacion.tipo) as des_tipo, (SELECT calificacion FROM calificaciones_parcial WHERE cod_mat='$cod_mat' AND cod_nuc=$cod_nuc_mat AND sec_mat='$sec_mat' AND lapso=$lapso AND corte=$corte AND id_plan_eval=plan_evaluacion.id AND ced_estu=".$filaCalifi['cedula'].") as calificacion FROM plan_evaluacion WHERE cod_mat='$cod_mat' AND sec_mat='$sec_mat' AND cod_nuc=$cod_nuc_mat AND lapso=$lapso AND corte=$corte";
		$resultado=mysql_query($sql);
		$j=0; 	
		while ($fila2=mysql_fetch_assoc($resultado))
		{
			$j++;
			if (isset($_POST['califi'.$i.$j]))
			{
				$tablaEncabezado .="<td class=td-notas><input type=\"text\" size=\"1\"  value=\"".$_POST['califi'.$i.$j]."\" name=\"califi$i$j\" maxlength=\"3\" pattern=\"^[0-9_]{1,3}$\" required/>
				<input type=\"hidden\" name=\"idcalifi$i$j\" value=\"".$fila2['id']."\" /></td>";
			}else
			{
				$tablaEncabezado .="<td class=td-notas><input type=\"text\" size=\"1\"  name=\"califi$i$j\" maxlength=\"3\" pattern=\"^[0-9_]{1,3}$\" value=\"".$fila2['calificacion']."\" required/>
				<input type=\"hidden\" name=\"idcalifi$i$j\" value=\"".$fila2['id']."\" /></td>";		
			}
		}
		$tablaEncabezado .= "</tr>";
	}
	$tablaEncabezado .= '</tr></table>';


if(isset($_POST['modificar']) && $_POST['agregar']='Modificar')
{
	//obtengo la cantidad de filas que tienen los input de notas
	$i=1;
	$Errorvalidacion=false;
	$sql_estudiantes= "SELECT cedula FROM inscripciones WHERE cod_mat='$cod_mat' AND sec_mat='$sec_mat' AND cod_nuc=$cod_nuc_mat AND lapso=$lapso AND EXISTS (SELECT * FROM calificaciones_parcial WHERE ced_estu=inscripciones.cedula AND cod_mat='$cod_mat' AND sec_mat='$sec_mat' AND cod_nuc=$cod_nuc_mat AND lapso=$lapso AND corte=$corte) ORDER BY cedula";
	$result_estudiantes= mysql_query($sql_estudiantes);
	while($estudiantes=mysql_fetch_assoc($result_estudiantes))
	{
		for($j=1;$j<=$numcolumnas;$j++)
		{
			if ($_POST['califi'.$i.$j]>100 || $_POST['califi'.$i.$j]==0)
			{
				$Errorvalidacion=true;
				$msgError='Las Notas agregadas no pueden ser iguales a 0 o mayores de 100 puntos';
			}
		}
		$i++;
	}
	if($Errorvalidacion!=true)
	{
		$i=1;
		$sql_estudiantes= "SELECT cedula FROM inscripciones WHERE cod_mat='$cod_mat' AND sec_mat='$sec_mat' AND cod_nuc=$cod_nuc_mat AND lapso=$lapso AND EXISTS (SELECT * FROM calificaciones_parcial WHERE ced_estu=inscripciones.cedula AND cod_mat='$cod_mat' AND sec_mat='$sec_mat' AND cod_nuc=$cod_nuc_mat AND lapso=$lapso AND corte=$corte) ORDER BY cedula";
		$result_estudiantes= mysql_query($sql_estudiantes);	
		while($estudiantes=mysql_fetch_assoc($result_estudiantes))
		{
			$total=0;
			$sql_update="UPDATE calificaciones_parciales_temporal SET";
			for($j=1;$j<=$numcolumnas;$j++)
			{
				$total=$total+$_POST['califi'.$i.$j];
				$sql_update.=" CALIF_".$corte.$j."='".$_POST['califi'.$i.$j]."',";
				$sql_update_nota="UPDATE calificaciones_parcial SET  calificacion='".$_POST['califi'.$i.$j]."' WHERE  ced_estu=".$estudiantes['cedula']." AND cod_mat='$cod_mat' AND sec_mat='$sec_mat' AND cod_nuc='$cod_nuc_mat' AND lapso='$lapso' AND id_plan_eval='".$_POST['idcalifi'.$i.$j]."' AND corte='$corte'";
				$result_update_notas=mysql_query($sql_update_nota);
					
			}
			$i++;

			$sql_update.=" ACUM_".$corte."C='".$total."' WHERE CEDULA=".$estudiantes['cedula']." AND COD_MAT='$cod_mat' AND SEC_MAT='$sec_mat' AND COD_NUC=$cod_nuc_mat AND LAP_NOT=$lapso";
			$result_update=mysql_query($sql_update);
		}
		$Success=true;
		$msgSuccess='Las Notas Han Sido Modificacas Satisfactoriamente';	
	}

}
include('lib/header.php');
?>
			<div class="columna_central">

				<strong>MATERIA: </strong><?php echo $materia['mate']; ?><br />
				<strong>SECCION: </strong><?php echo $sec_mat; ?><br /><br />
				<?php
				if (isset($Error) && $Error==true)
				{	
					echo '<table align="center"><tr><td colspan="2"><div class="warning">'.$msgError.'</div></td></tr></table>';
				}elseif (isset($Success) && $Success==true)
				{	
					echo '<table align="center"><tr><td colspan="2"><div class="success">'.$msgSuccess.'</div></td></tr></table>';
				}else
				{ ?>

					<table align="center"><tr><td colspan="2"><div class="success">Las notas agregadas deben ser en base a 100 puntos</div></td></tr></table>
					<?php

					if(isset($Errorvalidacion) && $Errorvalidacion==true)
					{
						echo '<table align="center"><tr><td colspan="2"><div class="warning">'.$msgError.'</div></td></tr></table>';
					}
					if(isset($i) && $i>=1)
					{
						echo '<form name="AgregarCalificacion" action="" method="post">'.$tablaEncabezado.'<table><tr><input align="center" style="margin-left:260px" type="submit" name="modificar" value="Modificar"></tr></table></form><br>';				
					}
				}
				?>
			</div>

<?php include('lib/footer.php'); ?>