<?php
include('lib/session.php');

include('lib/conexion.php');


include('lib/header.php');
?>
			<div class="columna_central">
				<h2>Horario Lapso <?php echo $lapso?></h2>
				<table class=tabla-a>
					<tr class=tabla-cabecera>
						<td class=td-a>Código</td>
						<td class=td-a>Materia</td>
						<td class=td-a>Sección</td>
        				<td class=td-a>Edifício</td>
        				<td class=td-a>Aula 1</td>
        				<td class=td-a>Aula 2</td>
        				<td class=td-a>Aula 3</td>
    					<td class=td-a>Día 1</td>
        				<td class=td-a>Día 2</td>
        				<td class=td-a>Día 3</td>
        				<td class=td-a>Número Horas</td>
					</tr>
    				<?php 
		
						$sql= "SELECT cod_mat, sec_mat, cod_nuc, aula1, aula2, aula3, dia1, dia2, dia3,(SELECT des_mat FROM materias WHERE cod_mat=secciones.cod_mat LIMIT 0,1) AS materia, (SELECT edifi FROM horamate WHERE cod_mat=secciones.cod_mat AND sec_mat=secciones.sec_mat AND ced_prof=$cedula AND cod_nuc=secciones.cod_nuc LIMIT 0,1) as edificio, (SELECT COUNT(*) FROM horamate WHERE cod_mat=secciones.cod_mat AND sec_mat=secciones.sec_mat AND ced_prof=$cedula AND cod_nuc=secciones.cod_nuc AND lapso=secciones.lapso) as horasmateria FROM secciones WHERE ced_prof=$cedula AND lapso=$lapso AND EXISTS(SELECT * FROM inscripciones WHERE cod_mat=secciones.cod_mat AND sec_mat=secciones.sec_mat AND lapso=secciones.lapso AND cod_nuc=secciones.cod_nuc)";
						$resultado=mysql_query($sql);
						$cant=mysql_num_rows($resultado);
						if ($cant>0)
						{
							$totalhorassemana=0;
							while($fila=mysql_fetch_assoc($resultado))
							{
								echo '<tr>
										<td class=td-a>'.$fila['cod_mat'].'</td>
										<td class=td-a>'.$fila['materia'].'</td>
										<td class=td-a>'.$fila['sec_mat'].'</td>
										<td class=td-a>'.$fila['edificio'].'</td>
										<td class=td-a>'.$fila['aula1'].'</td>
										<td class=td-a>'.$fila['aula2'].'</td>
										<td class=td-a>'.$fila['aula3'].'</td>
										<td class=td-a>'.$fila['dia1'].'</td>
										<td class=td-a>'.$fila['dia2'].'</td>
										<td class=td-a>'.$fila['dia3'].'</td>
										<td class=td-a>'.$fila['horasmateria'].'</td>
									</tr>';
								$totalhorassemana=$totalhorassemana + $fila['horasmateria'];
							}
						} else
						{
						echo '<tr><td  class=td-a colspan="4">No se encontraron registros</td>';
						}	
					?>
				</table>
				<br />
				<?php
					$totalhoraslapso=$totalhorassemana * 16;
					echo '<table class=tabla-a><tr class=tabla-cabecera><td class=td-a>Horas Totales por Semana</td><td class=td-a>Horas Totales en el Lapso</td></tr><tr><td class=td-a>'.$totalhorassemana.' Horas Académicas</td><td class=td-a>'.$totalhoraslapso.' Horas Académicas</td></tr></table>';
				?>
			</div>
<?php include('lib/footer.php'); ?>
