<?php
include('lib/session.php');

include('lib/conexion.php');



include('lib/header.php');
?>

			<div class="columna_central">
				<h2>Carga Académica Lapso <?php echo $lapso?></h2>
				<table class=tabla-a>
					<tr class=tabla-cabecera>
						<td class=td-a>Código</td>
						<td class=td-a>Materia</td>
						<td class=td-a>Sección</td>
                		<td class=td-a>Inscritos</td>
                		<td class=td-a>N&uacute;cleo</td>
						<td class=td-a>Opciones</td>
					</tr>
					<?php
					//llamar al archivo conexion
					include('lib/conexion.php');
					$sqlBuscar = "SELECT cod_mat, sec_mat, cod_nuc as cod_nuc_mat, (SELECT des_nucleo FROM nucleos WHERE ID=secciones.cod_nuc) AS nucleo, (SELECT des_mat FROM materias WHERE cod_mat=secciones.cod_mat LIMIT 0,1) AS materia, (SELECT COUNT(*) FROM inscripciones WHERE cod_mat=secciones.cod_mat AND sec_mat=secciones.sec_mat AND lapso=secciones.lapso AND cod_nuc=secciones.cod_nuc) AS cant_alu FROM secciones WHERE ced_prof=$cedula AND EXISTS(SELECT * FROM inscripciones WHERE cod_mat=secciones.cod_mat AND sec_mat=secciones.sec_mat AND lapso=secciones.lapso AND cod_nuc=secciones.cod_nuc) AND lapso=$lapso";				
					//ejecuto la consulta
					$resultado = mysql_query($sqlBuscar);
					//verifico si hay registros
					$cant =mysql_num_rows($resultado);
					if ($cant>0)
					{
						while($fila=mysql_fetch_assoc($resultado))
						{
							echo '<tr>
							<td class=td-a>'.$fila['cod_mat'].'</td>
							<td class=td-a>'.$fila['materia'].'</td>
							<td class=td-a>'.$fila['sec_mat'].'</td>
							<td class=td-a>'.$fila['cant_alu'].'</td>
							<td class=td-a>'.$fila['nucleo'].'</td>';
							?>
							<td class=td-opciones2><table><tr><td><a href="#" title="Listado Provisional de Alumnos" onclick="open('<?php echo 'listadoalumnotopdf.php?cod_mat='.$fila['cod_mat'].'&sec_mat='.$fila['sec_mat'].'&cod_nuc_mat='.$fila['cod_nuc_mat']; ?>','','top=100,left=200,width=1000,height=800')"><div class="favorito3" id="ListadoDeAlumnos"></div></a></td><td><a href="<?php echo 'planevaluacion.php?cod_mat='.$fila['cod_mat'].'&sec_mat='.$fila['sec_mat'].'&cod_nuc_mat='.$fila['cod_nuc_mat']; ?>" title="Plan de Evaluación"><div class="favorito3" id="PlanEvaluacion"></div></a></td><td><a href="<?php echo 'notascorte.php?cod_mat='.$fila['cod_mat'].'&sec_mat='.$fila['sec_mat'].'&cod_nuc_mat='.$fila['cod_nuc_mat'];?>" title="Notas 1er y 2do Corte"><div class="favorito3" id="Notas"></div></a></td></tr></table></td>
							<?php echo '</tr>';
						}
					} else
					{
						echo '<tr><td  class=td-a colspan="5">No se encontraron registros</td></tr>';
					}
					?>				
			</table>
		</div>
<?php include('lib/footer.php'); ?>
 