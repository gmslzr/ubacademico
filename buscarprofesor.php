<?php
include('lib/session.php');

include('lib/conexion.php');


$Error=true;

if(isset($_POST['buscar']) && $_POST['buscar']=='Buscar')
{
	$Error=false;
	$ced_prof=$_POST['ced_prof'];
	$sql_profesores="SELECT * FROM profesores WHERE cedula='$ced_prof'";
	$resultado_profesores=mysql_query($sql_profesores);
	$cant=mysql_num_rows($resultado_profesores);
	
	if(!is_numeric($cedula) || strlen($cedula)<6 || strlen($cedula)>8)
	{
        $msgError='Error al Escribir la C&eacute;dula';

	}elseif($cant==0)
	{
        $msgError='No Existe un Profesor con esa C&eacute;dula en nuestra base de datos';

	}else
	{
		header("Location: mostrarinformacionprofesor.php?ced_prof=$ced_prof");
	}
}
include('lib/header.php');
?>
			<div class="columna_central">
				<h2>Buscar Profesor</h2><br>
				<form name="BuscarProfesor" action="" method="post">
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
						?>
					</table>
					<table align="center">
				    	<tr>
				        	<td>C&eacute;dula del Profesor:</td>
				        	<td><input type="text" name="ced_prof" id="ced_prof" title="Escribir la C&eacute;dula del Profesor que desea buscar" size="8" value="<?php if (isset($ced_prof)){echo $ced_prof;}?>" /></td>
				        </tr>
				        <tr>
                            <td>Nombres:</td>
                            <td><input type="text" name="nombres" id="nombres" size="40" value="<?php if (isset($_POST['nombres'])){echo $_POST['nombres'];}?>" placeholder="Nombres del Docente" readonly="readonly"/></td>
                        </tr>
                        <tr>
                            <td>Apellidos:</td>
                            <td><input type="text" name="apellidos" id="apellidos" size="40" value="<?php if (isset($_POST['apellidos'])){echo $_POST['apellidos'];}?>" placeholder="Apellidos del Docente" readonly="readonly"/></td>
                        </tr>
				        <tr>
				     	   <td colspan="2" style="text-align: center"><input type="submit" name="buscar" value="Buscar"></td>
						</tr>    
				    </table>
				</form>
			</div>

<?php include('lib/footer.php'); ?>