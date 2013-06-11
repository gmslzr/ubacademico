<style type="text/css">
<!--

div.encabezado{
	text-align:center;
	font-style: italic;
	position: static;
}
table.lista{
	border-collapse: collapse;
	width: 100%;
	margin-top: 20px;
	vertical-align: middle;
	font-size:10px;
}
table.lista td{
	border: 2px solid black;
}
div.marco {
	margin: 0px 5px 20px 20px;
	width: 100%; 
}


-->
</style>
<?php $max = 30; ?>
<?php $bandera = 0; ?>
<?php $van = 1; ?>
<?php for($i=1;$i<=$paginas;$i++): ?>

<?php
$control = sizeof($alumnos) - $bandera;
if($control > $max){
	$tope = $max;
	$van = 1;
}else{
	$tope = $control;
	$van = 1;
}
 //Definimos el titulo 
    
?>


<page>
	
		<table style="width: 100%">
			<tr>
				<td style="width: 5%">
								<img src='images/logouba.jpg' alt='UBA'/>
				</td>
				<td style="width: 75%;">
					<div class="encabezado">REP&Uacute;BLICA BOLIVARIANA DE VENEZUELA</div>
			        <div class="encabezado">UNIVERSIDAD BICENTENARIA DE ARAGUA</div>
			        <div class="encabezado"><strong>VICERRECTORADO ACAD&Eacute;MICO</strong></div>
			        <div class="encabezado"><strong>FACULTAD DE INGENIER&Iacute;A</strong></div>
			        <div class="encabezado"><strong>Coordinacion de Pasant&iacute;as</strong></div>
			        <div class="encabezado"><strong>Escuela de Ingenier&iacute;a de Sistemas</strong></div>
			        <div class="encabezado">San Joaquin de Turmero - Estado Aragua.</div><br/><br/>
			    </td>
			    <td style="width: 5%">
			    <?php if ($cod_pas_escu == 1) { ?>
			    	<img src='images/logoesis.png' alt='ESIS'/>
			    <? } ?>
				
				<?php if ($cod_pas_escu == 2) { ?>
			    	<img src='images/logoelec.png' alt='ELEC'/>
			    <? } ?>

			    <?php if ($cod_pas_escu == 3) { ?>
			    	<img src='images/logoeade.png' alt='EADE'/>
			    <? } ?>

				<?php if ($cod_pas_escu == 4) { ?>
			    	<img src='images/logoecop.png' alt='ELEC'/>
			    <? } ?> 

			    <?php if ($cod_pas_escu == 5) { ?>
			    	<img src='images/logoedere.png' alt='EDERE'/>
			    <? } ?> 

			    <?php if ($cod_pas_escu == 6) { ?>
			    	<img src='images/logoecos.png' alt='ECOS'/>
			    <? } ?> 

			    <?php if ($cod_pas_escu == 7) { ?>
			    	<img src='images/logoepsi.png' alt='EPSI'/>
			    <? } ?> 
				</td>	

			</tr>	
			</table>
			
			<div align="center"><strong><h2>INFORME DE GESTION</h2></strong><br><br></div>
			<div align="center" style="text-align:justify;">Atendiendo a la demanda y siguiendo con la buena aceptación por parte de las</div>
			<div align="center" style="text-align:justify;">diferentes empresas a nivel Nacional de nuestros Pasantes, presentamos a continuación un </div>
			<div align="center" style="text-align:justify;">listado de las empresas visitadas, durante las ocho primeras semanas del lapso académico </div>
			<div align="center" style="text-align:justify;"> <?php echo $lpsc ?></div>

		<table class="lista" style="width: 100%;">
			<tr style="text-align:center; background-color:#C2C2C2;">
                <td style="width: 10%;">C&eacute;dula de Identidad</td>		
                <td style="width: 30%;">Alumnos Inscritos</td>
                <td style="width: 20%;">Empresa</td>
                <td style="width: 20%;">Tutor Industrial</td>	
                <td style="width: 20%;">Perfil Requerido</td>                
			</tr>
            
            <?php	for($j=$van;$j<=$tope;$j++):	?>
				<tr>
                	<!--<td><?php echo $bandera+1; ?></td>-->
					<td align='center'><?php echo $alumnos[$bandera]['cedula'];?></td>
					<td align='center'><?php echo utf8_encode($alumnos[$bandera]['NOM_APE']);?></td>
					<td align='center'><?php echo utf8_encode($alumnos[$bandera]['nom_emp']);?></td>
					<td align='center'><?php echo utf8_encode(mostrarTutor($alumnos[$bandera]['codTutor']));?></td>
					<td align='center'><?php echo utf8_encode(mostrarArea($alumnos[$bandera]['codPer']));?></td>
				</tr>
			<?php $van++; ?>
            <?php $bandera++; ?>
			<?php endfor; ?>
		
		</table><br />

		<div style="text-align:center"><strong> Total Alumnos: <?php echo $tope?></strong></div>
		<page_footer>
		
		<div><strong><i>“Una Universidad para la Creatividad”</i></strong></div>
		<hr>
		<div style="font-size:10px; text-align:center;"><i>Av. Intercomunal Santiago Mariño c/c Av. Universidad, Sector La Providencia,  San Joaquín de Turmero. Estado Aragua. Venezuela.</i></div>
		<div style="font-size:10px; text-align:center;"><i>Teléfono: Máster  (0243) 2650011 – 265.00.52 – 265.00.57 Fax: 265.00.62</i></div>
		<div style="font-size:10px; text-align:center;"><i>web site: <a>http://www.uba.edu.ve</a>  / e-mail: <a>ubaweb@uba.edu.ve</a></i></div>

		</page_footer>
</page>
<?php endfor; ?>




	<?php
	
		/*
			while ($fila=mysql_fetch_assoc($sqlresultado))
			{

			?>
				<tr>
					<td align='center'><?php echo $fila['cedula'];?></td>
					<td align='center'><?php echo utf8_encode($fila['NOM_APE']);?></td>
					<td align='center'><?php echo utf8_encode($fila['nom_emp']);?></td>
					<td align='center'><?php echo utf8_encode(mostrarTutor($fila['codTutor']));?></td>
					<td align='center'><?php echo utf8_encode(mostrarArea($fila['codPer']));?></td>
				</tr>

			<?php } */?>