<?php
include('lib/session.php');

include('lib/header.php');
?>
			<div class="columna_central">
				<h2>Reportes</h2>
				<?php
				if(isset($coord_gesac) && $coord_gesac==1)
				{
					echo '<li><a href="#" title="Carga Acad&eacute;mica Consolidada">Carga Acad&eacute;mica Consolidada</a></li>';
				}
				?>

				<li><a href="#" title="Reporte Por Materia">Reporte Por Materia</a></li>

				<li><a href="#" title="Reporte Por Profesor">Reporte Por Profesor</a></li>
			</div>
<?php include('lib/footer.php'); ?>