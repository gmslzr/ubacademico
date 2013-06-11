<style type="text/css">
<!--
table.lista{
	border-collapse: collapse;
	width: 100%;
	margin-top: 20px;
	vertical-align: middle;
}
table.lista td{
	border: 2px solid black;
}
table.asistencia{
	border-collapse: collapse;
	width: 100%;
}


-->
</style>
<page>
		<img src='images/logo.jpg' alt='UBA'/><br><br>
		LISTADO DE ESTUDIANTES<br><br>
		<div style='margin-right: 0px; margin-left: 0px; margin-bottom: 0px; margin-top: 0px;' >
			<table style="width: 100%;">
				<tr>
					<td style="width: 30%;"><strong><?php echo utf8_encode($des_facultad); ?></strong></td>
					<td style="width: 70%;"><strong>ESCUELA DE <?php echo utf8_encode($des_escuela);?></strong></td>
				</tr>
				<tr>
					<td><strong>C&Oacute;DIGO MATERIA: </strong><?php echo $cod_mat; ?></td>
					<td><strong>NOMBRE MATERIA: </strong><?php echo $fila2['des_mat'];?></td>
				</tr>
				<tr>
					<td><strong>SECCI&Oacute;N MATERIA: </strong><?php echo $sec_mat; ?></td>
					<td><strong>PROFESOR:  </strong><?php echo utf8_encode($fila2['apellido']);?>, <?php echo utf8_encode($fila2['nombre']);?></td>
				</tr>	
				<tr>
					<td><strong>LAPSO: </strong><?php echo $lapso;?></td>
					<td><strong>FECHA: </strong><?php echo date("d/m/Y");?></td>
				</tr>
			</table>

		</div>
		<table class="lista" style="width: 100%;">
			<tr style=" text-align:center; background-color:#C2C2C2;">
				<td style="width: 4%;">#</td>		
				<td style="width: 10%;">C&Eacute;DULA</td>
				<td style="width: 50%;">NOMBRE</td>
				<td colspan="24" style="width: 22%;">ASISTENCIA</td>
			</tr>
			<?php
			$i=0;
			while ($fila=mysql_fetch_assoc($sqlresultado))
			{
				$i++;?>
				<tr>
					<td align='center'><?php echo $i;?></td>
					<td align='center'><?php echo $fila['cedula'];?></td>
					<td><?php echo utf8_encode($fila['nombre']);?></td>
					<td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td>
				</tr>
			<?php } ?>
		</table>
</page>




