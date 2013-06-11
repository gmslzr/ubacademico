<?php
include('lib/session.php');

include('lib/conexion.php');


include('lib/header.php');
?>
			<div class="columna_central">
				<h2>Informaci&oacute;n General</h2>
				<div style="border:1px solid #d8d8d8;background-color:#f3f3f3;padding:12px;">
					<p>Bienvenidos al Portal Web de la Secretar&iacute;a de la Universidad Bicentenaria de Aragua, creada con el fin de ofrecer al Docente <?php if ($coord_estatus==1){echo ' y/o Coordinador';};?> ubista un nuevo canal de comunicaci&oacute;n, ajustado al uso de la tecnolog&iacute;a. </p>
				</div>
			</div>	

<?php include('lib/footer.php'); ?>
