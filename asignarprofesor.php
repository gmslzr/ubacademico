<?php
include('lib/session.php');

include('lib/conexion.php');
$Success=false;
$Error=true;


if(isset($_POST['asignar']) && $_POST['asignar']=='Asignar')
{
	$Error=false;
	$ced_prof=$_POST['ced_prof'];
	$cod_mat=$_POST['cod_mat'];
	$sec_mat=$_POST['sec_mat'];
	$nucleo_prof=$_POST['nucleo_prof'];	
	
	$sql="SELECT * FROM profesores_asignados WHERE cedula='$ced_prof' AND cod_mat='$cod_mat' AND sec_mat='$sec_mat' AND cod_nuc='$nucleo_prof' AND lapso='".$lapso."'";
	$resultado=mysql_query($sql);
	$cant=mysql_num_rows($resultado);
		
	if(!is_numeric($ced_prof) || strlen($cedula)<6 || strlen($ced_prof)>8)
	{
        $msgError='Error al Escribir la C&eacute;dula';
 
	}elseif($cod_mat=="")
	{
        $msgError='Debe Elegir una Materia a Asignar';

	}elseif (strlen($sec_mat)!=1)
	{
        $msgError='La Secci&oacute;n de la materia debe ser una s&oacute;la Letra y en May&uacute;scula';

	}elseif($nucleo_prof=="")
	{
        $msgError='Debe Elegir un N&uacute;cleo de la Universidad';

	}elseif($cant>=1)
	{
        $msgError='Ya ex&iacute;ste una c&eacute;dula asiganada a esa materia y secci&oacute;n durante el lapso en curso';

	}else
	{
		$sql_personal="SELECT * FROM profesores WHERE cedula='$ced_prof'";
		$resultado_personal=mysql_query($sql_personal);
		$cant2=mysql_num_rows($resultado_personal);
		
		
		if($cant2==1)
		{
				$sql="INSERT INTO profesores_asignados (cedula, cod_mat, sec_mat, cod_nuc, lapso) VALUES ('$ced_prof','$cod_mat','$sec_mat','$nucleo_prof','$lapso')";
				$resultado=mysql_query($sql);
				$Success=true;
       			$Error=true;
       			$msgSuccess='El Profesor ha sido asignado correctamente a esta Materia';

		}else
		{
			$msgError='Esa c&eacute;dula no se encuentra registrada para ning&uacute;n profesor en nuestra base datos';

		}
	}
}


include('lib/header.php');?>

			<div class="columna_central">
				<h2>Asignar Profesor</h2>
				<form name="AsignarProfesor" action="" method="post">
					<table align="center">
        				<?php
							if($Error!=true && isset($Error)){ ?>
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
					<table>
				    	<tr>
				        	<td>C&eacute;dula del Profesor:</td>
				        	<td><input type="text" name="ced_prof" id="ced_prof" title="Escribir la C&eacute;dula del Profesor al que desea asignar una materia" size="8" maxlength="8" pattern="[0-9]{6,8}" value="<?php if (isset($ced_prof)){echo $ced_prof;}?>" /></td>
				        </tr>
				        <tr>
                            <td>Nombres:</td>
                            <td><input type="text" name="nombres" id="nombres" size="40" value="<?php if (isset($_POST['nombres'])){echo $_POST['nombres'];}?>" placeholder="Nombres del Docente" readonly/></td>
                        </tr>
                        <tr>
                            <td>Apellidos:</td>
                            <td><input type="text" name="apellidos" id="apellidos" size="40" value="<?php if (isset($_POST['apellidos'])){echo $_POST['apellidos'];}?>" placeholder="Apellidos del Docente" readonly/></td>
                        </tr>
				        <tr>
				        	<td>Coordinaci&oacute;n:</td>
				        	<td>
				        		<select name="cod_catedra" id="cod_cat">
				        			<option value="">Elegir C&aacute;tedra...</option>
				        			<?php
				        				$a=0;
				        				for($a=1;$a<=$coord_cat;$a++)
				        				{ 
				        					$sql_desc="SELECT desc_catedra FROM h_catedra WHERE cod_catedra='".${"cod_catedra".$a}."'";
				        					$result_desc=mysql_query($sql_desc);
				        					$descripcion=mysql_fetch_assoc($result_desc);
				        					echo '<option value="'.${"cod_catedra".$a}.'">'. ${"cod_catedra".$a}.' - '.$descripcion['desc_catedra'].'</option>';
				        				}
				        			?>
				        		</select>
				        	</td>
				        </tr>
				        <tr>
				        	<td>Materia:</td>
				            <td>
				            	<select name="cod_mat" id="cod_mat">
				            		<option value="">Elegir Materia...</option>
				   
				                </select>
				            </td>
				        </tr>
				        <tr>
				        	<td>Secci&oacute;n de la Materia:</td>
				        	<td><input type="text" name="sec_mat" title="Escriba la Secci&oacute;n de la materia que ser&aacute; asignada" size="1" maxlength="1" pattern="[A-Za-z0-9]" value="<?php if (isset($sec_mat)){echo $sec_mat;}?>" /></td>        
				        </tr>
				        <tr>
				        	<td>N&uacute;cleo:</td>
				            <td>
				            	<select name="nucleo_prof">
                                    <option value="">Elegir N&uacute;cleo...</option>
                                    <?php
                                        include('lib/conexion.php');
                                        $sqlnuc="SELECT ID, des_nucleo FROM nucleos ";
                                        $resultadonuc=mysql_query($sqlnuc);
                                        while($fila=mysql_fetch_assoc($resultadonuc))
                                        {
                                            echo '<option value='.$fila['ID'].'>'.$fila['des_nucleo'].'</option>';
                                        }
                                    ?>
                                </select>
				            </td>
				        </tr>
				        <tr>
				        	<td colspan="2" style="text-align: center"><input type="submit" name="asignar" value="Asignar"></td>
				        </tr>
				    </table>
				</form>
			</div>

<?php include('lib/footer.php'); ?>

<script>
document.AsignarProfesor.nucleo_prof.value='<?php if(isset($nucleo_prof)){ echo $nucleo_prof;}?>';
document.AsignarProfesor.cod_mat.value='<?php if(isset($cod_mat)){ echo $cod_mat;}?>';
</script>
