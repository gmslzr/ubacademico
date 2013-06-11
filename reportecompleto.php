<style type="text/css">
<!--

-->
</style>
<page>
	<table style="width: 100%;">
		<tr>
			<td style="width: 80%;"><strong>Universidad Bicentenaria de Aragua</strong></td>
			<td><strong>Fecha: </strong><?php echo date("d/m/Y")?></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td><strong>Reporte Completo</strong><br><br></td>
		</tr>
	</table>

	<?php
		while($filacarrera=mysql_fetch_assoc($result_carreras))
		{

			$sql_catedra="SELECT cod_catedra, desc_catedra FROM h_catedra WHERE cod_escu='".$filacarrera['cod_esc']."'";
			$result_catedra=mysql_query($sql_catedra);

	?>		
			<table>
					<tr>
						<td><strong><?php echo utf8_encode($filacarrera['Facultad']);?></strong></td>
					</tr>
	<?php

			while($filacatedra=mysql_fetch_assoc($result_catedra))
			{
				
				$sql_materia="SELECT cod_mat,(SELECT des_mat FROM materia WHERE cod_mat=h_catemate.cod_mat) as des_mat FROM h_catemate WHERE cod_catedra='".$filacatedra['cod_catedra']."'";
				$result_materia=mysql_query($sql_materia);
				while($filamateria=mysql_fetch_assoc($result_materia))
				{
	?>
					<tr>
						<td><?php echo utf8_encode($filamateria['des_mat']);?></td>
					</tr>
				
				}
			}
			</table>
	<?php 
		}
	?>
</page>